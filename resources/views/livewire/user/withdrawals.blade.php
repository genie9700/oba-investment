<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.user')] class extends Component {
    //
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
            <div class="max-w-4xl mx-auto" x-data="{
                method: 'btc',
                amount: '',
                withdrawalFee: 0.005, // Example fee as a percentage
                get feeAmount() {
                    return this.amount ? this.amount * this.withdrawalFee : 0;
                },
                get netAmount() {
                    return this.amount ? this.amount - this.feeAmount : 0;
                }
            }">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Form & Controls (Left) -->
                    <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl p-6 sm:p-8">
                        <!-- Balance Display -->
                        <div class="mb-8 p-4 bg-gray-900/50 rounded-lg border border-white/10">
                            <p class="text-sm text-gray-400">Available for Withdrawal</p>
                            <p class="text-2xl font-bold text-white">$47,512.80</p>
                        </div>

                        <!-- Method Toggle -->
                        <div class="mb-6">
                            <p class="text-sm font-medium text-gray-300 mb-2">Select Withdrawal Method</p>
                            <div class="grid grid-cols-2 gap-4 bg-white/5 p-1 rounded-lg">
                                <button @click="method = 'btc'"
                                    :class="method === 'btc' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5'"
                                    class="flex items-center justify-center p-3 rounded-md font-semibold transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-12h2v2h-2v-2zm0 4h2v6h-2v-6z">
                                        </path>
                                    </svg>
                                    Bitcoin
                                </button>
                                <button @click="method = 'bank'"
                                    :class="method === 'bank' ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5'"
                                    class="flex items-center justify-center p-3 rounded-md font-semibold transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M3 21h18v-2H3v2zM3 7v2h18V7H3zM4 12h16v3H4v-3zM2 5h20v2H2V5zM2 17h20v2H2v-2z">
                                        </path>
                                    </svg>
                                    Bank Transfer
                                </button>
                            </div>
                        </div>

                        <!-- Amount Input -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount
                                (USD)</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"><span
                                        class="text-gray-400 text-xl">$</span></div>
                                <input type="number" id="amount" x-model.number="amount" placeholder="0.00"
                                    class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>

                        <!-- Bitcoin Fields -->
                        <div x-show="method === 'btc'" x-transition class="mt-6 space-y-4">
                            <div>
                                <label for="btc-address" class="block text-sm font-medium text-gray-300 mb-2">Select
                                    Whitelisted BTC Address</label>
                                <select id="btc-address"
                                    class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option class="bg-gray-800">Select an address...</option>
                                    <option class="bg-gray-800">bc1q...wlh (My Ledger Wallet)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Bank Fields -->
                        <div x-show="method === 'bank'" x-transition class="mt-6 space-y-4">
                            <div>
                                <label for="bank-account" class="block text-sm font-medium text-gray-300 mb-2">Select
                                    Bank Account</label>
                                <select id="bank-account"
                                    class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option class="bg-gray-800">Select an account...</option>
                                    <option class="bg-gray-800">Bank of America - **** 1234</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- Summary & Submit (Right) -->
                    <div class="lg:col-span-1 bg-gray-900/50 border border-white/10 rounded-2xl p-6 flex flex-col">
                        <h3 class="text-xl font-bold text-white mb-6">Withdrawal Summary</h3>
                        <div class="flex-grow space-y-4 text-sm">
                            <div class="flex justify-between text-gray-300"><span>Withdrawal Amount:</span><span
                                    x-text="`$${amount ? amount.toFixed(2) : '0.00'}`"></span></div>
                            <div class="flex justify-between text-gray-300"><span>Fee (0.5%):</span><span
                                    class="text-red-400" x-text="`-$${feeAmount.toFixed(2)}`"></span></div>
                            <div
                                class="pt-4 border-t border-white/10 flex justify-between font-bold text-white text-base">
                                <span>You will receive:</span><span x-text="`$${netAmount.toFixed(2)}`"></span></div>
                        </div>
                        <div class="mt-6">
                            <button
                                class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform disabled:opacity-50 disabled:cursor-not-allowed"
                                :disabled="!amount > 0">
                                Request Withdrawal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
