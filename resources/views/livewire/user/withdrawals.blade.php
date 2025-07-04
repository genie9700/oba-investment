<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\WhitelistedAddress;
use App\Models\Withdrawal;
use App\Models\Transaction;
// use App\Events\WithdrawalRequested; // You would create this event

new #[Layout('components.layouts.user')] class extends Component {
    public string $method = 'btc';
    public ?float $amount = null;
    public float $withdrawalFee = 0.005;

    // These will now hold the ID of the selected whitelisted address
    public ?int $selectedBtcAddressId = null;
    public ?int $selectedBankAccountId = null;

    // Bank Fields
    public ?string $bankName = '';
    public ?string $accountNumber = '';
    public ?string $accountName = '';
    public ?string $swiftCode = '';

 // These will hold the collections of addresses from the database
    public $btcAddresses;
    public $bankAccounts;
    public float $availableBalance = 0;

    public function mount()
    {
        $this->availableBalance = Auth::user()->balance;

        // Fetch all of the user's whitelisted addresses
        $addresses = WhitelistedAddress::where('user_id', Auth::id())->get();

        // Separate them into BTC and Bank collections
        $this->btcAddresses = $addresses->where('method', 'btc');
        $this->bankAccounts = $addresses->where('method', 'bank');
    }

    public function getFeeAmountProperty(): float
    {
        return $this->amount ? $this->amount * $this->withdrawalFee : 0;
    }

    public function getNetAmountProperty(): float
    {
        return $this->amount ? $this->amount - $this->feeAmount : 0;
    }

    public function rules()
    {
        $rules = [
            'amount' => ['required', 'numeric', 'min:1', 'max:' . $this->availableBalance],
            'method' => ['required', 'in:btc,bank'],
        ];

        if ($this->method === 'btc') {
            // Validate that the selected ID exists in our collection of the user's addresses
            $rules['selectedBtcAddressId'] = ['required', 'in:' . $this->btcAddresses->pluck('id')->implode(',')];
        }

        if ($this->method === 'bank') {
            $rules['selectedBankAccountId'] = ['required', 'in:' . $this->bankAccounts->pluck('id')->implode(',')];
        }

        return $rules;
    }

    public function submitWithdrawal()
    {
        $this->validate();

        $selectedAddress = null;
        if ($this->method === 'btc') {
            $selectedAddress = $this->btcAddresses->find($this->selectedBtcAddressId);
        } else {
            $selectedAddress = $this->bankAccounts->find($this->selectedBankAccountId);
        }

        dd($selectedAddress);

        DB::transaction(function () use ($selectedAddress) {
            $user = Auth::user();

            // 1. Create the Withdrawal record with specific details
            $withdrawal = Withdrawal::create([
                'user_id' => $user->id,
                'method' => $this->method,
                'wallet_address' => $selectedAddress->address,
                'bank_details' => $selectedAddress->bank_details,
            ]);

            // 2. Create the corresponding polymorphic Transaction record
            $withdrawal->transaction()->create([
                'user_id' => $user->id,
                'type' => 'withdrawal',
                'amount' => -$this->amount, // Withdrawals are a negative value
                'status' => 'pending', // Admin must approve it
                'description' => 'Withdrawal via ' . $selectedAddress->label,
                'balance_after' => $user->balance, // Balance does not change until approved
            ]);

            // 3. Fire an event to notify admin
            // WithdrawalRequested::dispatch($withdrawal);
        });

        session()->flash('message', 'Your withdrawal request has been submitted successfully for review.');
        $this->reset(['amount', 'selectedBtcAddress', 'bankName', 'accountNumber', 'accountName', 'swiftCode']);
    }
}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Dashboard</h1>
        <div class="w-6"></div>
    </header>

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Withdraw Funds</h1>

            <!-- Main Withdrawal Component -->
            <div class="max-w-4xl mx-auto">
                <form wire:submit.prevent="submitWithdrawal">
                    <div class="grid lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl p-6 sm:p-8">
                            <div class="mb-8 p-4 bg-gray-900/50 rounded-lg border border-white/10">
                                <p class="text-sm text-gray-400">Available for Withdrawal</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($availableBalance, 2) }}</p>
                            </div>

                            <div class="mb-6">
                                <p class="text-sm font-medium text-gray-300 mb-2">Select Withdrawal Method</p>
                                <div class="grid grid-cols-2 gap-4 bg-white/5 p-1 rounded-lg">
                                    <button type="button" @click="$wire.set('method', 'btc')"
                                        :class="$wire.method === 'btc' ? 'bg-white/10 text-white' :
                                            'text-gray-400 hover:bg-white/5'"
                                        class="flex items-center justify-center p-3 rounded-md font-semibold transition-colors">
                                        Cryto
                                    </button>
                                    <button type="button" @click="$wire.set('method', 'bank')"
                                        :class="$wire.method === 'bank' ? 'bg-white/10 text-white' :
                                            'text-gray-400 hover:bg-white/5'"
                                        class="flex items-center justify-center p-3 rounded-md font-semibold transition-colors">
                                        Bank Transfer
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount
                                    (USD)</label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-gray-400 text-xl">$</span>
                                    </div>
                                    <input type="number" id="amount" wire:model.live="amount" placeholder="0.00"
                                        class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-orange-500">
                                </div>
                                @error('amount')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-show="$wire.method === 'btc'" class="mt-6 space-y-4">
                                <div>
                                    <label for="btc-address" class="block text-sm font-medium text-gray-300 mb-2">Select Whitelisted BTC Address</label>
                                    <select id="btc-address" wire:model="selectedBtcAddressId" class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        <option value="">Select an address...</option>
                                        @foreach($btcAddresses as $address)
                                            <option class="bg-gray-800" value="{{ $address->id }}">{{ $address->label }} ({{ Str::limit($address->address, 15) }})</option>
                                        @endforeach
                                    </select>
                                    @error('selectedBtcAddressId') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div x-show="$wire.method === 'bank'" class="mt-6 space-y-4">
                                <div>
                                    <label for="bank-account" class="block text-sm font-medium text-gray-300 mb-2">Select
                                        Bank Account
                                    </label>
                                    <select id="bank-account" wire:model="selectedBankAccountId" class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        <option value="">Select an account...</option>
                                        @foreach($bankAccounts as $account)
                                            <option class="bg-gray-800" value="{{ $account->id }}">{{ $account->label }} - ****{{ substr($account->bank_details['account_number'], -4) }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedBankAccountId') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1 bg-gray-900/50 border border-white/10 rounded-2xl p-6 flex flex-col">
                            <h3 class="text-xl font-bold text-white mb-6">Withdrawal Summary</h3>
                            <div class="flex-grow space-y-4 text-sm">
                                <div class="flex justify-between text-gray-300">
                                    <span>Withdrawal Amount:</span>
                                    <span>${{ number_format($amount ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-300">
                                    <span>Fee (0.5%):</span>
                                    <span class="text-red-400">-${{ number_format($this->feeAmount, 2) }}</span>
                                </div>
                                <div class="pt-4 border-t border-white/10 flex justify-between font-bold text-white text-base">
                                    <span>You will receive:</span>
                                    <span>${{ number_format($this->netAmount, 2) }}</span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <x-loading-button type="submit" target="submitWithdrawal" class="w-full">
                                    Request Withdrawal
                                </x-loading-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
