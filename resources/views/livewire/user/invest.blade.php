<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.user')] class extends Component {
    //
}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
                <button @click="sidebarOpen = !sidebarOpen" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h1 class="text-xl font-bold text-white">Dashboard</h1>
                <div class="w-6"></div> 
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">
                <div class="p-6 md:p-8" x-data="{
                    step: 1,
                    selectedPlan: null,
                    amount: 0,
                    plans: [
                        { id: 1, name: 'Professional Plan', price: 5000, hashPower: '50 TH/s', earnings: 25, duration: '12 Months', featured: false },
                        { id: 2, name: 'Elite Plan', price: 25000, hashPower: '260 TH/s', earnings: 135, duration: '18 Months', featured: true },
                        { id: 3, name: 'Apex Plan', price: 100000, hashPower: '1.1 PH/s', earnings: 550, duration: '24 Months', featured: false }
                        // ... other plans
                    ],
                    btcPrice: 65000, // Placeholder BTC price for calculation
                    walletAddress: 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh', // Placeholder wallet address
                    copyText: 'Copy',
                    transactionId: '',
                    paymentProof: null,
                    isUploading: false,
                    progress: 0,
                    get btcAmount() {
                        if (!this.amount || this.btcPrice === 0) return 0;
                        return (this.amount / this.btcPrice).toFixed(8);
                    },
                    selectPlan(plan) {
                        this.selectedPlan = plan;
                        this.amount = plan.price;
                    }
                }">
                    <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Create New Investment</h1>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 sm:p-8">
                        <div class="flex justify-between items-center mb-10">
                            <div class="flex flex-col items-center text-orange-400 font-semibold">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center bg-orange-400 text-white border-2 border-orange-400">1</div>
                                <div class="mt-2 text-sm text-center">Select Plan</div>
                            </div>
                            <div class="flex-1 h-0.5 mx-4" :class="step >= 2 ? 'bg-orange-400' : 'bg-white/10'"></div>
                            <div class="flex flex-col items-center" :class="step >= 2 ? 'text-orange-400 font-semibold' : 'text-gray-500'">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center border-2" :class="step >= 2 ? 'bg-orange-400 text-white border-orange-400' : 'border-white/20'">2</div>
                                <div class="mt-2 text-sm text-center">Payment</div>
                            </div>
                            <div class="flex-1 h-0.5 mx-4" :class="step >= 3 ? 'bg-orange-400' : 'bg-white/10'"></div>
                            <div class="flex flex-col items-center" :class="step >= 3 ? 'text-orange-400 font-semibold' : 'text-gray-500'">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center border-2" :class="step >= 3 ? 'bg-orange-400 text-white border-orange-400' : 'border-white/20'">3</div>
                                <div class="mt-2 text-sm text-center">Confirmation</div>
                            </div>
                        </div>

                        <div x-show="step === 1">
                            <h2 class="text-2xl font-bold text-white mb-6">Select an Investment Plan</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <template x-for="plan in plans" :key="plan.id">
                                    <div @click="selectPlan(plan)"
                                         :class="selectedPlan && selectedPlan.id === plan.id ? 'border-orange-400/80 ring-2 ring-orange-400/50' : 'border-white/10 hover:border-white/30'"
                                         class="relative cursor-pointer bg-gray-900/50 border rounded-xl p-5 transition-all duration-200">
                                        
                                        <div x-show="plan.featured" class="absolute -top-3 right-3 text-xs bg-orange-500 text-white font-bold px-2 py-0.5 rounded-full">Popular</div>
                                        
                                        <h3 class="text-lg font-bold text-white" x-text="plan.name"></h3>
                                        <p class="text-3xl font-bold my-2 text-white" x-text="`$${plan.price.toLocaleString()}`"></p>
                                        <ul class="text-xs text-gray-400 space-y-1">
                                            <li x-text="`Hash Power: ${plan.hashPower}`"></li>
                                            <li x-text="`Daily Earnings: $${plan.earnings}`"></li>
                                            <li x-text="`Duration: ${plan.duration}`"></li>
                                        </ul>
                                    </div>
                                </template>
                            </div>

                            <div x-show="selectedPlan" x-transition class="mt-8 pt-6 border-t border-white/10">
                                <h3 class="text-xl font-bold text-white mb-4">Confirm Investment Amount</h3>
                                <p class="text-sm text-gray-400 mb-4">Minimum for <span x-text="selectedPlan.name" class="font-semibold"></span>: <span x-text="`$${selectedPlan.price.toLocaleString()}`"></span></p>
                                <div>
                                    <label for="amount" class="sr-only">Amount</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span class="text-gray-400 text-xl">$</span>
                                        </div>
                                        <input type="number" id="amount" x-model.number="amount" :min="selectedPlan.price"
                                               class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white text-xl focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 flex justify-end">
                                <button @click="step = 2" :disabled="!selectedPlan" 
                                        :class="!selectedPlan ? 'bg-gray-500 cursor-not-allowed' : 'bg-gradient-to-r from-orange-500 to-yellow-500 hover:scale-105'"
                                        class="text-white px-8 py-3 rounded-full font-semibold transition-transform transform">
                                    Proceed to Payment
                                </button>
                            </div>
                        </div>

                        <div x-show="step === 2" x-transition>
                            <h2 class="text-2xl font-bold text-white mb-6">Complete Your Payment</h2>

                            <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6">
                                <div class="grid md:grid-cols-2 gap-8 items-center">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-400 mb-2">Scan to pay</p>
                                        <div class="bg-white p-4 rounded-lg inline-block">
                                            <svg class="w-40 h-40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path fill="#000" d="M128 128h32v32h-32v-32ZM96 96H64V64h32v32Zm0 32H64v32h32v-32Zm-32-32H32V64h32v32Zm32 64H64v32h32v-32Zm64-64h32v32h-32v-32Zm-32 32h32v32h-32v-32Zm64 64h32v32h-32v-32Zm-32-32h32v32h-32v-32Zm-96-64h32v32H64V96Zm128-64h32v32h-32V32Zm-32 0h32v32h-32V32Zm-32 0h32v32h-32V32ZM64 32h32v32H64V32ZM32 0v256h256V0H32Zm224 224H64V64h192v160Z"/></svg>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <p class="text-lg text-gray-300">To complete your investment, please send exactly:</p>
                                        <p class="text-3xl font-bold text-orange-400" x-text="`${btcAmount} BTC`"></p>
                                        <p class="text-sm text-gray-400" x-text="`(equivalent to $${amount.toLocaleString()})`"></p>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-1">To the following Bitcoin wallet address:</label>
                                            <div class="flex">
                                                <input type="text" :value="walletAddress" readonly class="w-full truncate p-3 border border-white/20 rounded-l-lg bg-white/5 text-gray-300">
                                                <button @click="navigator.clipboard.writeText(walletAddress); copyText = 'Copied!'; setTimeout(() => copyText = 'Copy', 2000)" 
                                                        class="px-4 bg-orange-500 text-white font-semibold rounded-r-lg hover:bg-orange-600 w-24 text-center" 
                                                        x-text="copyText"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 bg-yellow-500/10 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                                    <p class="text-sm text-yellow-300"><span class="font-bold">Important:</span> Send only BTC to this address. Sending any other currency may result in the permanent loss of your funds.</p>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-between items-center">
                                <button @click="step = 1" class="text-gray-400 hover:text-white font-semibold transition-colors">
                                    &larr; Back to Plans
                                </button>
                                <button @click="step = 3" class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform">
                                    I Have Made the Payment
                                </button>
                            </div>
                        </div>
                        <div x-show="step === 3" x-transition>
                            <h2 class="text-2xl font-bold text-white mb-2">Confirm Your Payment</h2>
                            <p class="text-gray-400 mb-6">Upload proof of your payment to finalize your investment.</p>
                            
                            <div class="bg-gray-900/50 border border-white/10 rounded-xl p-6 space-y-6">
                                
                                <div class="flex justify-between items-center bg-white/5 p-4 rounded-lg">
                                    <p class="text-gray-300">Investing in <span x-text="selectedPlan.name" class="font-bold text-white"></span></p>
                                    <p class="text-xl font-bold text-white" x-text="`$${amount.toLocaleString()}`"></p>
                                </div>

                                <div>
                                    <label for="transactionId" class="block text-sm font-medium text-gray-300 mb-1">Transaction ID / Hash (Optional)</label>
                                    <input type="text" id="transactionId" x-model="transactionId" placeholder="Enter the transaction ID from your wallet" class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Payment Screenshot</label>
                                    <div class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-white/20 px-6 py-10"
                                         x-data="{ isHovering: false }"
                                         @dragover.prevent="isHovering = true"
                                         @dragleave.prevent="isHovering = false"
                                         @drop.prevent="isHovering = false; /* Handle file drop */"
                                         :class="{ 'border-orange-400 bg-orange-500/10': isHovering }">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                            <div class="mt-4 flex text-sm text-gray-400">
                                                <label for="payment-proof" class="relative cursor-pointer rounded-md font-medium text-orange-400 hover:text-orange-300">
                                                    <span>Upload a file</span>
                                                    <input id="payment-proof" name="payment-proof" type="file" class="sr-only">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 bg-blue-500/10 border-l-4 border-blue-400 p-4 rounded-r-lg">
                                <p class="text-sm text-blue-300"><span class="font-bold">What's Next?</span> Your submission will be reviewed by our team. This typically takes 1-3 hours. You will be notified by email once your investment plan is active.</p>
                            </div>

                            <div class="mt-8 flex justify-between items-center">
                                <button @click="step = 2" class="text-gray-400 hover:text-white font-semibold transition-colors">
                                    &larr; Back to Payment
                                </button>
                                <button @click="/* Handle final submission */" class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform">
                                    Submit for Confirmation
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
</div>
