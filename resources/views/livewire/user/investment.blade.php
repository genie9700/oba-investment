<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Plan;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Deposit;
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

    public function submitInvestment()
    {
        $this->validate();
        // Use a database transaction to ensure all operations succeed or none do.
        DB::transaction(function () {
            // 1. Store the uploaded payment proof file.
            $proofPath = $this->paymentProof->store('proofs', 'private');

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

    <div class="p-6 md:p-8">
        <div>
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
                                    class="relative cursor-pointer bg-gray-900/50 border rounded-xl p-5 transition-all duration-200 
                                            {{ $selectedPlan && $selectedPlan->id === $plan->id ? 'border-orange-400/80 ring-2 ring-orange-400/50' : 'border-white/10 hover:border-white/30' }}">

                                    @if ($plan->is_featured)
                                        <div
                                            class="absolute -top-3 right-3 text-xs bg-orange-500 text-white font-bold px-2 py-0.5 rounded-full">
                                            Popular</div>
                                    @endif

                                    <h3 class="text-lg font-bold text-white">{{ $plan->name }}</h3>
                                    <p class="text-3xl font-bold my-2 text-white">${{ number_format($plan->price) }}</p>
                                    <ul class="text-xs text-gray-400 space-y-1">
                                        <li>Hash Power: {{ $plan->hash_power }}</li>
                                        <li>Daily Earnings: ${{ $plan->daily_earning_rate }}</li>
                                        <li>Duration: {{ $plan->duration_in_months }} Months</li>
                                    </ul>
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
                                            <span class="text-gray-400 text-xl">$</span></div>
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
                            
                            <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6 text-center flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Pay with Wallet Balance</h3>
                                    <p class="text-sm text-gray-400 mt-2">Use your available funds for an instant investment.</p>
                                    <div class="my-6">
                                        <p class="text-xs text-gray-400">Available Balance</p>
                                        <p class="text-2xl font-bold text-orange-400">${{ number_format(Auth::user()->balance, 2) }}</p>
                                    </div>
                                </div>
                                <button 
                                    wire:click="payWithBalance" 
                                    wire:loading.attr="disabled"
                                    @disabled(Auth::user()->balance < $amount)
                                    class="w-full mt-4 bg-orange-500 text-white px-6 py-3 rounded-full font-semibold transition-colors disabled:bg-gray-700 disabled:text-gray-400 disabled:cursor-not-allowed"
                                >
                                    <span wire:loading.remove wire:target="payWithBalance">Pay ${{ number_format($amount, 2) }} Now</span>
                                    <span wire:loading wire:target="payWithBalance">Processing...</span>
                                </button>
                            </div>

                            <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6 text-center flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Pay with Cryptocurrency</h3>
                                    <p class="text-sm text-gray-400 mt-2">Make a new deposit by sending BTC from an external wallet.</p>
                                    <div class="my-6">
                                        <p class="text-xs text-gray-400">Amount to Send</p>
                                        <p class="text-2xl font-bold text-white">{{ $this->btcAmount }} BTC</p>
                                    </div>
                                </div>
                                <button wire:click="goToStep(3)" class="w-full mt-4 bg-white/10 text-white px-6 py-3 rounded-full font-semibold hover:bg-white/20">
                                    Proceed to Crypto Payment
                                </button>
                            </div>

                        </div>

                        <div class="mt-8 flex justify-start">
                            <button wire:click="goToStep(1)" class="text-gray-400 hover:text-white font-semibold transition-colors">
                                &larr; Back to Plans
                            </button>
                        </div>
                    </div>
                @endif
                @if ($step === 3)
                    <div wire:key="step3">
                        {{-- This UI is now correctly shown as Step 3, similar to our Deposit page --}}
                        <h2 class="text-2xl font-bold text-white mb-6">Complete Your Payment</h2>
                        <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6">
                            <div class="grid md:grid-cols-2 gap-8 items-center">
                                <div class="text-center">
                                    <p class="text-sm text-gray-400 mb-2">Scan to pay</p>
                                    <div class="bg-white p-4 rounded-lg inline-block">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=bitcoin:{{ $walletAddress }}?amount={{ $this->btcAmount }}" alt="Bitcoin QR Code">
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <p class="text-lg text-gray-300">To complete your investment, please send exactly:</p>
                                    <p class="text-3xl font-bold text-orange-400">{{ $this->btcAmount }} BTC</p>
                                    <p class="text-sm text-gray-400">(equivalent to ${{ number_format($amount) }})</p>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-1">To the following Bitcoin wallet address:</label>
                                        <div x-data="{
                                                copyText: 'Copy',
                                                walletAddress: '{{ $walletAddress }}',
                                                copyToClipboard() {
                                                    navigator.clipboard.writeText(this.walletAddress).then(() => {
                                                        this.copyText = 'Copied!';
                                                        setTimeout(() => { this.copyText = 'Copy' }, 2000);
                                                    }).catch(err => {
                                                        // Fallback for non-secure contexts
                                                        const textarea = document.createElement('textarea');
                                                        textarea.value = this.walletAddress;
                                                        document.body.appendChild(textarea);
                                                        textarea.select();
                                                        document.execCommand('copy');
                                                        document.body.removeChild(textarea);
                                                        this.copyText = 'Copied!';
                                                        setTimeout(() => { this.copyText = 'Copy' }, 2000);
                                                    });
                                                }
                                            }">
                                                <div class="flex">
                                                    <input type="text" :value="walletAddress" readonly class="w-full truncate p-3 border border-white/20 rounded-l-lg bg-white/5 text-gray-300">
                                                    <button @click="copyToClipboard()" 
                                                            class="px-4 bg-orange-500 text-white font-semibold rounded-r-lg hover:bg-orange-600 w-24 text-center transition-colors" 
                                                            x-text="copyText"></button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-between items-center">
                            <button wire:click="goToStep(2)" class="text-gray-400 hover:text-white font-semibold transition-colors">&larr; Back to Method</button>
                            {{-- This button now proceeds to the final confirmation step (Step 4) --}}
                            <button wire:click="goToStep(4)" class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform">I Have Made the Payment</button>
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
                            <button wire:click="goToStep(2)"
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
