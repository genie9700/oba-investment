<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Plan;
use App\Models\PaymentMethod;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Deposit;
use Carbon\Carbon;
use App\Events\NewInvestmentSubmitted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Livewire\WithFileUploads;

new #[Layout('components.layouts.user')] class extends Component {
    use WithFileUploads;

    public int $step = 1;
    public $plans;
    public ?Plan $selectedPlan = null;
    public $amount;

    // Step 2
    public float $btcPrice;
    public $walletAddress = 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh';

    // Step 3
    public $transactionId;
    public $paymentProof;

    public $paymentMethods;
    public ?PaymentMethod $selectedPaymentMethod = null;

    // Add validation rules
    protected $rules = [
        'selectedPlan' => 'required',
        'amount' => 'required|numeric|min:1',
        'paymentProof' => 'required|image|max:2048', // 2MB Max
        'transactionId' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->plans = Plan::where('is_active', true)->get();

        // Fetch all active payment methods from the database
        $this->paymentMethods = PaymentMethod::where('is_active', true)->get();

        // Set a default selection
        $this->selectedPaymentMethod = $this->paymentMethods->first();

        try {
            // Remember the price for 5 minutes (300 seconds)
            $this->btcPrice = Cache::remember('btc_price', 300, function () {
                $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
                    'ids' => 'bitcoin',
                    'vs_currencies' => 'usd',
                ]);
                // Return the price from the API response, or a default if not found
                return $response->json('bitcoin.usd', 65000.0);
            });
        } catch (\Throwable $th) {
            // If the API call fails for any reason, fall back to a safe default price.
            $this->btcPrice = 65000.0;
            // You could also log the error here: Log::error('CoinGecko API fetch failed: ' . $th->getMessage());
        }
    }

    public function selectPlan($planId)
    {
        $this->selectedPlan = Plan::find($planId);
        if ($this->selectedPlan) {
            $this->amount = $this->selectedPlan->price;
        }
        $this->validateOnly('selectedPlan');
    }

    public function goToStep(int $stepNumber)
    {
        if ($this->step === 1 && $stepNumber === 2) {
            $this->validate([
                'selectedPlan' => 'required',
                'amount' => 'required|numeric|min:' . ($this->selectedPlan['price'] ?? 1),
            ]);
        }

        $this->step = $stepNumber;
    }

    public function getBtcAmountProperty()
    {
        if (!$this->amount || $this->btcPrice === 0) {
            return '0.00000000';
        }

        return number_format($this->amount / $this->btcPrice, 8, '.', '');
    }

    public function payWithBalance()
    {
        $user = Auth::user();
        $this->validate([
            'selectedPlan' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);

        if ($user->balance < $this->amount) {
            session()->flash('error', 'Insufficient wallet balance to make this investment.');
            return;
        }

        DB::transaction(function () use ($user) {
            // 1. Deduct amount from user's balance
            $user->balance -= $this->amount;
            $user->save();

            // 2. Create the Investment record
            $investment = Investment::create([
                'user_id' => $user->id,
                'plan_name' => $this->selectedPlan->name,
                'initial_amount' => $this->amount,
                'hash_power' => $this->selectedPlan->hash_power,
                'daily_earning_rate' => $this->selectedPlan->daily_earning_rate,
                'duration_in_months' => $this->selectedPlan->duration_in_months,
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths($this->selectedPlan->duration_in_months),
            ]);

            // 3. Create the corresponding Transaction record for the investment purchase
            $investment->transaction()->create([
                'user_id' => $user->id,
                'type' => 'investment',
                'amount' => -$this->amount, // Negative amount as it's a debit
                'status' => 'completed',
                'description' => 'Investment in ' . $this->selectedPlan->name,
                'balance_after' => $user->balance,
            ]);
        });

        session()->flash('message', 'Investment successful! Your plan is now active.');
        $this->reset(['step', 'selectedPlan', 'amount']);
        $this->dispatch('investmentMade'); // To refresh other components like stats
    }

    public function selectPaymentMethod($methodId)
    {
        $this->selectedPaymentMethod = $this->paymentMethods->find($methodId);
    }

    public function submitInvestment()
    {
        $this->validate();
        // Use a database transaction to ensure all operations succeed or none do.
        DB::transaction(function () {
            // 1. Store the uploaded payment proof file.
            $proofPath = $this->paymentProof->store('payment_proofs', 'public');

            // 2. Create the Deposit record.
            $deposit = Deposit::create([
                'user_id' => Auth::id(),
                'method' => 'BTC',
                'deposit_wallet_address' => $this->walletAddress,
                'amount_crypto' => $this->btcAmount,
                'transaction_hash' => $this->transactionId,
                'proof_path' => $proofPath,
            ]);

            // 3. Create the corresponding polymorphic Transaction record.
            $deposit->transaction()->create([
                'user_id' => Auth::id(),
                'type' => 'deposit',
                'amount' => $this->amount,
                'status' => 'pending', // Admin will verify and change to 'completed'
                'description' => 'Deposit for ' . $this->selectedPlan['name'],
                'balance_after' => Auth::user()->balance, // Balance doesn't change until approved
            ]);

            // 4. Fire the event to notify the admin.
            NewInvestmentSubmitted::dispatch($deposit);
        });

        // 5. Reset the form and show a success message.
        $this->reset(['step', 'selectedPlan', 'amount', 'transactionId', 'paymentProof']);
        session()->flash('message', 'Your investment has been submitted successfully for review!');
    }
}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Invest</h1>
        <div class="w-6"></div>
    </header>

    <div>
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-white mb-8">Create New Investment</h1>

            @if (session()->has('message'))
                <div class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 sm:p-8">
                <div class="flex justify-between items-center mb-10">
                    <div class="flex flex-col items-center font-semibold"
                        :class="$wire.step >= 1 ? 'text-orange-400' : 'text-gray-500'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2"
                            :class="$wire.step >= 1 ? 'bg-orange-400 text-white border-orange-400' : 'border-white/20'">
                            1</div>
                    </div>
                    <div class="flex-1 h-0.5 mx-2" :class="$wire.step >= 2 ? 'bg-orange-400' : 'bg-white/10'"></div>
                    <div class="flex flex-col items-center"
                        :class="$wire.step >= 2 ? 'text-orange-400 font-semibold' : 'text-gray-500'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2"
                            :class="$wire.step >= 2 ? 'bg-orange-400 text-white border-orange-400' : 'border-white/20'">
                            2</div>
                    </div>
                    <div class="flex-1 h-0.5 mx-2" :class="$wire.step >= 3 ? 'bg-orange-400' : 'bg-white/10'"></div>
                    <div class="flex flex-col items-center"
                        :class="$wire.step >= 3 ? 'text-orange-400 font-semibold' : 'text-gray-500'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2"
                            :class="$wire.step >= 3 ? 'bg-orange-400 text-white border-orange-400' : 'border-white/20'">
                            3</div>
                    </div>
                    <div class="flex-1 h-0.5 mx-2" :class="$wire.step >= 4 ? 'bg-orange-400' : 'bg-white/10'"></div>
                    <div class="flex flex-col items-center"
                        :class="$wire.step >= 4 ? 'text-orange-400 font-semibold' : 'text-gray-500'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2"
                            :class="$wire.step >= 4 ? 'bg-orange-400 text-white border-orange-400' : 'border-white/20'">
                            4</div>
                    </div>
                </div>

                @if ($step === 1)
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-6">Select an Investment Plan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($plans as $plan)
                                <div wire:click="selectPlan({{ $plan->id }})"
                                    class="relative cursor-pointer bg-gray-900/50 border rounded-xl p-5 flex flex-col transition-all duration-200 
                                    {{ $selectedPlan && $selectedPlan->id === $plan->id ? 'border-orange-400/80 ring-2 ring-orange-400/50' : 'border-white/10 hover:border-white/30' }}">

                                    @if ($plan->is_featured)
                                        <div
                                            class="absolute -top-3 right-3 text-xs bg-orange-500 text-white font-bold px-2 py-0.5 rounded-full">
                                            Popular</div>
                                    @endif

                                    <div class="flex-grow">
                                        <h3 class="text-lg font-bold text-white">{{ $plan->name }}</h3>
                                        <p class="text-3xl font-bold my-2 text-white">${{ number_format($plan->price) }}
                                        </p>

                                        {{-- 
                                            MODIFICATION: The list now shows all key details with icons
                                            for better readability and a more professional look.
                                        --}}
                                        <ul class="text-sm text-gray-300 space-y-3 mt-4">
                                            <li class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                <span>Hash Power: <span
                                                        class="font-semibold text-white">{{ $plan->hash_power }}</span></span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>

                                                <span>Daily Earnings: <span
                                                        class="font-semibold text-white">${{ $plan->daily_earning_rate }}</span></span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>Duration: <span
                                                        class="font-semibold text-white">{{ $plan->duration_in_months }}
                                                        Months</span></span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M4 4v5h5M7 7l-3 3"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M20 20v-5h-5M17 17l3-3"></path>
                                                </svg>
                                                <span>Withdrawal: <span
                                                        class="font-semibold text-white">{{ $plan->withdrawal_limit }}</span></span>
                                            </li>
                                            <li class="flex items-center pt-3 border-t border-white/10">
                                                <svg class="w-5 h-5 mr-2 text-green-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                                <span>Est. Total Return: <span
                                                        class="font-semibold text-white">${{ number_format($plan->total_return, 2) }}</span></span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-green-400 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                                <span>Est. ROI: <span
                                                        class="font-semibold text-white">{{ number_format($plan->roi_percentage, 1) }}%</span></span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="mt-6">
                                        <div
                                            class="w-full py-2 text-center rounded-lg font-semibold {{ $selectedPlan && $selectedPlan->id === $plan->id ? 'bg-orange-500/20 text-orange-300' : 'bg-white/10 text-gray-300' }}">
                                            {{ $selectedPlan && $selectedPlan->id === $plan->id ? 'Selected' : 'Select Plan' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($selectedPlan)
                            <div class="mt-8 pt-6 border-t border-white/10">
                                <h3 class="text-xl font-bold text-white mb-4">Confirm Investment Amount</h3>
                                <p class="text-sm text-gray-400 mb-4">Minimum for <span
                                        class="font-semibold">{{ $selectedPlan->name }}</span>:
                                    ${{ number_format($selectedPlan->price) }}</p>
                                <div>
                                    <label for="amount" class="sr-only">Amount</label>
                                    <div class="relative">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span class="text-gray-400 text-xl">$</span>
                                        </div>
                                        <input type="number" id="amount" wire:model.live="amount"
                                            min="{{ $selectedPlan->price }}"
                                            class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-8 flex justify-end">
                            <x-loading-button wire:click="goToStep(2)" :disabled="!$selectedPlan" target="goToStep(2)">
                                Proceed to Payment
                            </x-loading-button>
                        </div>
                    </div>
                @endif

                @if ($step === 2)
                    <div wire:key="step2">
                        <h2 class="text-2xl font-bold text-white mb-6">Choose Your Payment Method</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div
                                class="bg-gray-900/50 border border-white/10 rounded-xl p-6 text-center flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Pay with Wallet Balance</h3>
                                    <p class="text-sm text-gray-400 mt-2">Use your available funds for an instant
                                        investment.</p>
                                    <div class="my-6">
                                        <p class="text-xs text-gray-400">Available Balance</p>
                                        <p class="text-2xl font-bold text-orange-400">
                                            ${{ number_format(Auth::user()->balance, 2) }}</p>
                                    </div>
                                </div>
                                <button wire:click="payWithBalance" wire:loading.attr="disabled"
                                    @disabled(Auth::user()->balance < $amount)
                                    class="w-full mt-4 bg-orange-500 text-white px-6 py-3 rounded-full font-semibold transition-colors disabled:bg-gray-700 disabled:text-gray-400 disabled:cursor-not-allowed">
                                    <span wire:loading.remove wire:target="payWithBalance">Pay
                                        ${{ number_format($amount, 2) }} Now</span>
                                    <span wire:loading wire:target="payWithBalance">Processing...</span>
                                </button>
                            </div>

                            <div
                                class="bg-gray-900/50 border border-white/10 rounded-xl p-6 text-center flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Pay with Cryptocurrency</h3>
                                    <p class="text-sm text-gray-400 mt-2">Make a new deposit by sending BTC from an
                                        external wallet.</p>
                                    <div class="my-6">
                                        <p class="text-xs text-gray-400">Amount to Send</p>
                                        <p class="text-2xl font-bold text-white">{{ $this->btcAmount }} BTC</p>
                                    </div>
                                </div>
                                <button wire:click="goToStep(3)"
                                    class="w-full mt-4 bg-white/10 text-white px-6 py-3 rounded-full font-semibold hover:bg-white/20">
                                    Proceed to Crypto Payment
                                </button>
                            </div>

                        </div>

                        <div class="mt-8 flex justify-start">
                            <button wire:click="goToStep(1)"
                                class="text-gray-400 hover:text-white font-semibold transition-colors">
                                &larr; Back to Plans
                            </button>
                        </div>
                    </div>
                @endif
                @if ($step === 3)
                    <div wire:key="step3">
                        <div class="flex flex-col md:flex-row justify-between md:items-center mb-6">
                            <h2 class="text-2xl font-bold text-white">Complete Your Payment</h2>

                            <div class="flex items-center space-x-2 mt-4 md:mt-0 bg-white/5 p-1 rounded-lg">
                                @foreach ($paymentMethods as $method)
                                    {{--
                                        FIX: Replaced the AlpineJS :class with a standard Blade conditional.
                                        This is more reliable during Livewire re-renders.
                                    --}}
                                    <button wire:click="selectPaymentMethod({{ $method->id }})"
                                        class="px-3 py-1 text-sm font-semibold rounded-md transition-colors
                                            @if ($selectedPaymentMethod && $selectedPaymentMethod->id === $method->id) bg-white/10 text-white
                                            @else
                                                text-gray-400 hover:text-white @endif
                                        ">
                                        {{ $method->ticker }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        @if ($selectedPaymentMethod)
                            {{-- 
                                FIX 2: LOADING SPINNER
                                This 'relative' container holds the content and the loading overlay.
                                The 'wire:loading' overlay shows ONLY when the 'selectPaymentMethod' action is running.
                            --}}
                            <div class="relative">
                                <div wire:loading wire:target="selectPaymentMethod"
                                    class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center rounded-xl z-10">
                                    <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6">
                                    <div class="grid md:grid-cols-2 gap-8 items-center">
                                        <div class="text-center">
                                            <div class="bg-white p-4 rounded-lg inline-block">
                                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ $selectedPaymentMethod->name }}:{{ $selectedPaymentMethod->wallet_address }}?amount={{ $this->btcAmount }}"
                                                    alt="Crypto QR Code">
                                            </div>
                                        </div>
                                        <div class="space-y-4">
                                            <p class="text-lg text-gray-300">To complete your investment, please send
                                                the equivalent of <span
                                                    class="font-bold text-white">${{ number_format($amount) }}</span>
                                                to the address below:</p>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-300 mb-1">
                                                    Your <span class="font-bold">{{ $selectedPaymentMethod->name }}
                                                        ({{ $selectedPaymentMethod->ticker }})</span> Deposit Address:
                                                </label>
                                                <div class="flex" x-data="{ copyText: 'Copy' }">
                                                    <input type="text"
                                                        value="{{ $selectedPaymentMethod->wallet_address }}" readonly
                                                        class="w-full truncate p-3 border border-white/20 rounded-l-lg bg-white/5 text-gray-300">
                                                    <button
                                                        @click="navigator.clipboard.writeText('{{ $selectedPaymentMethod->wallet_address }}'); copyText = 'Copied!'; setTimeout(() => copyText = 'Copy', 2000)"
                                                        class="px-4 bg-orange-500 text-white font-semibold rounded-r-lg hover:bg-orange-600 w-24 text-center transition-colors"
                                                        x-text="copyText"></button>
                                                </div>
                                            </div>

                                            <div
                                                class="bg-yellow-500/10 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                                                <p class="text-sm text-yellow-300"><span
                                                        class="font-bold">Important:</span>
                                                    {{ $selectedPaymentMethod->network_warning }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-8 flex justify-between items-center">
                            <button wire:click="goToStep(2)"
                                class="text-gray-400 hover:text-white font-semibold transition-colors">&larr; Back to
                                Method</button>
                            <button wire:click="goToStep(4)"
                                class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform">I
                                Have Made the Payment</button>
                        </div>
                    </div>
                @endif

                @if ($step === 4)
                    <div wire:key="step3">
                        <h2 class="text-2xl font-bold text-white mb-2">Confirm Your Payment</h2>
                        <p class="text-gray-400 mb-6">Upload proof of your payment to finalize your investment.</p>
                        <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6 space-y-6">
                            <div class="flex justify-between items-center bg-white/5 p-4 rounded-lg">
                                <p class="text-gray-300">Investing in <span
                                        class="font-bold text-white">{{ $selectedPlan['name'] ?? 'your selected plan' }}</span>
                                </p>
                                <p class="text-xl font-bold text-white">${{ number_format($amount) }}</p>
                            </div>
                            <div>
                                <label for="transactionId"
                                    class="block text-sm font-medium text-gray-300 mb-1">Transaction ID / Hash
                                    (Optional)</label>
                                <input type="text" id="transactionId" wire:model="transactionId"
                                    placeholder="Enter the transaction ID from your wallet"
                                    class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment
                                    Screenshot</label>
                                <input type="file" wire:model="paymentProof"
                                    class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500/10 file:text-orange-300 hover:file:bg-orange-500/20">
                                <div wire:loading wire:target="paymentProof" class="text-sm text-gray-400 mt-2">
                                    Uploading...</div>
                                @error('paymentProof')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                                @if ($paymentProof)
                                    <p class="text-sm text-green-400 mt-2">File Ready:
                                        {{ $paymentProof->getClientOriginalName() }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-8 bg-blue-500/10 border-l-4 border-blue-400 p-4 rounded-r-lg">
                            <p class="text-sm text-blue-300"><span class="font-bold">What's Next?</span> Your
                                submission will be reviewed by our team. This typically takes 1-3 hours. You will be
                                notified by email once your investment plan is active.</p>
                        </div>
                        <div class="mt-8 flex justify-between items-center">
                            <button wire:click="goToStep(3)"
                                class="text-gray-400 hover:text-white font-semibold transition-colors">&larr; Back
                                to Payment</button>
                            {{-- <button wire:click="submitInvestment" wire:loading.attr="disabled" class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform">
                                <span wire:loading.remove wire:target="submitInvestment">Submit for Confirmation</span>
                                <span wire:loading wire:target="submitInvestment">Submitting...</span>
                            </button> --}}
                            <x-loading-button wire:click="submitInvestment" target="submitInvestment">
                                Submit for Confirmation
                            </x-loading-button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
