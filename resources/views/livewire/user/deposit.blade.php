<?php

use Livewire\Volt\Component;
use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.user')] class extends Component {
    public $paymentMethods;
    public ?PaymentMethod $selectedMethod = null;

    public function mount()
    {
        // Fetch all active payment methods from the database
        $this->paymentMethods = PaymentMethod::where('is_active', true)->get();

        // Set a default selection
        if ($this->paymentMethods->isNotEmpty()) {
            $this->selectedMethod = $this->paymentMethods->first();
        }
    }

    public function selectMethod($methodId)
    {
        // Update the selected method when a user clicks a button
        $this->selectedMethod = $this->paymentMethods->find($methodId);
    }
}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Deposit</h1>
        <div class="w-6"></div>
    </header>

    <div>
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Deposit Funds</h1>

            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-300 mb-4">1. Select currency to deposit</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        {{-- Loop through payment methods from the database --}}
                        @foreach ($paymentMethods as $method)
                            <button wire:click="selectMethod({{ $method->id }})"
                                class="p-4 border rounded-xl text-center transition-all
                                {{ $selectedMethod && $selectedMethod->id === $method->id ? 'border-orange-400/80 ring-2 ring-orange-400/50 bg-white/10' : 'border-white/10 hover:border-white/30' }}">

                                <p class="font-bold text-white mt-2">{{ $method->name }}</p>
                                <p class="text-xs text-gray-400">{{ $method->ticker }}</p>
                            </button>
                        @endforeach
                    </div>
                </div>

                @if ($selectedMethod)
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 sm:p-8">
                        <h2 class="text-lg font-semibold text-gray-300 mb-6">2. Send <span
                                class="font-bold text-white">{{ $selectedMethod->name }}</span> to your deposit address
                        </h2>
                        <div class="grid md:grid-cols-3 gap-8 items-center">
                            <div class="md:col-span-1 text-center">
                                <div class="bg-white p-4 rounded-lg inline-block">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ $selectedMethod->name }}:{{ $selectedMethod->wallet_address }}"
                                        alt="Crypto QR Code">
                                </div>
                            </div>
                            <div class="md:col-span-2 space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Your
                                        {{ $selectedMethod->name }} Deposit Address:</label>
                                    <div class="flex" x-data="{ copyText: 'Copy' }">
                                        <input type="text" value="{{ $selectedMethod->wallet_address }}" readonly
                                            class="w-full truncate p-3 border border-white/20 rounded-l-lg bg-white/5 text-gray-300">
                                        <button
                                            @click="navigator.clipboard.writeText('{{ $selectedMethod->wallet_address }}'); copyText = 'Copied!'; setTimeout(() => copyText = 'Copy', 2000)"
                                            class="px-4 bg-orange-500 text-white font-semibold rounded-r-lg hover:bg-orange-600 w-24 text-center transition-colors"
                                            x-text="copyText"></button>
                                    </div>
                                </div>
                                <div class="bg-yellow-500/10 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                                    <p class="text-sm text-yellow-300"><span class="font-bold">Important:</span>
                                        {{ $selectedMethod->network_warning }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-gray-900/50 border border-white/10 rounded-2xl p-6 text-center">
                        <h3 class="text-lg font-semibold text-white">Finished your deposit?</h3>
                        <p class="mt-2 text-sm text-gray-400 max-w-md mx-auto">Your balance will be updated after the
                            required network confirmations. You can monitor the status on your transactions page.</p>
                        <div class="mt-6">
                            <a href="{{ route('user.dashboard') }}"
                                class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform inline-block">
                                Go to My Dashboard
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-gray-400">Please add a payment method in the admin panel.</div>
                @endif

            </div>
        </div>
    </div>
</div>
