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
                <h1 class="text-xl font-bold text-white">Deposit</h1>
                <div class="w-6"></div> 
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">
                <div class="p-6 md:p-8">
                    <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Deposit Funds</h1>

                    <div class="max-w-4xl mx-auto" x-data="{
                        selectedCoin: 'BTC',
                        copyText: 'Copy',
                        coins: {
                            'BTC': { 
                                name: 'Bitcoin', 
                                address: 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
                                warning: 'Send only Bitcoin (BTC) to this address. Sending any other asset will result in permanent loss.'
                            },
                            'ETH': { 
                                name: 'Ethereum', 
                                address: '0x1234AbCdEf5678GhIjKlMnOp9012QrStUvWxYz3456',
                                warning: 'Send only Ethereum (ETH) on the ERC-20 network. Do not use other networks (e.g., BSC, Polygon).'
                            },
                            'USDT': { 
                                name: 'Tether', 
                                address: '0x7890BcDeFg1234HiJkLmNoPq5678RsTuVwXyZaBcDeF',
                                warning: 'Send only Tether (USDT) on the ERC-20 network. This is an Ethereum network address.'
                            }
                        },
                        get currentCoin() {
                            return this.coins[this.selectedCoin];
                        }
                    }">
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-300 mb-4">1. Select currency to deposit</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <button @click="selectedCoin = 'BTC'" :class="selectedCoin === 'BTC' ? 'border-orange-400/80 ring-2 ring-orange-400/50 bg-white/10' : 'border-white/10 hover:border-white/30'" class="p-4 border rounded-xl text-center transition-all">
                                    <svg class="w-10 h-10 mx-auto text-orange-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.61 14.39c.67.67 1.74.67 2.41 0 .67-.67.67-1.74 0-2.41l-1.42-1.42c.9-.45 1.6-1.15 2-2.07.4-.92.59-1.95.59-2.98 0-2.21-1.79-4-4-4H9v2h5c1.1 0 2 .9 2 2s-.9 2-2 2h-3v2h3v2h-3v2h3c.69 0 1.32-.28 1.77-.73l2.84 2.84zM9 11h3v2H9v-2zm0-4h3v2H9V7z"></path></svg>
                                    <p class="font-bold text-white mt-2">Bitcoin</p>
                                    <p class="text-xs text-gray-400">BTC</p>
                                </button>
                                <button @click="selectedCoin = 'ETH'" :class="selectedCoin === 'ETH' ? 'border-orange-400/80 ring-2 ring-orange-400/50 bg-white/10' : 'border-white/10 hover:border-white/30'" class="p-4 border rounded-xl text-center transition-all">
                                     <svg class="w-10 h-10 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM12 7.5l-4 5.5 4 5.5 4-5.5-4-5.5z"></path></svg>
                                    <p class="font-bold text-white mt-2">Ethereum</p>
                                    <p class="text-xs text-gray-400">ETH</p>
                                </button>
                                <button @click="selectedCoin = 'USDT'" :class="selectedCoin === 'USDT' ? 'border-orange-400/80 ring-2 ring-orange-400/50 bg-white/10' : 'border-white/10 hover:border-white/30'" class="p-4 border rounded-xl text-center transition-all">
                                    <svg class="w-10 h-10 mx-auto text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM9 11h6v2H9v-2z"></path></svg>
                                    <p class="font-bold text-white mt-2">Tether</p>
                                    <p class="text-xs text-gray-400">USDT (ERC-20)</p>
                                </button>
                            </div>
                        </div>

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 sm:p-8">
                            <h2 class="text-lg font-semibold text-gray-300 mb-6">2. Send <span x-text="selectedCoin" class="font-bold text-white"></span> to your deposit address</h2>
                             <div class="grid md:grid-cols-3 gap-8 items-center">
                                <div class="md:col-span-1 text-center">
                                     <div class="bg-white p-4 rounded-lg inline-block">
                                        <svg class="w-40 h-40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path fill="#000" d="M128 128h32v32h-32v-32ZM96 96H64V64h32v32Zm0 32H64v32h32v-32Zm-32-32H32V64h32v32Zm32 64H64v32h32v-32Zm64-64h32v32h-32v-32Zm-32 32h32v32h-32v-32Zm64 64h32v32h-32v-32Zm-32-32h32v32h-32v-32Zm-96-64h32v32H64V96Zm128-64h32v32h-32V32Zm-32 0h32v32h-32V32Zm-32 0h32v32h-32V32ZM64 32h32v32H64V32ZM32 0v256h256V0H32Zm224 224H64V64h192v160Z"/></svg>
                                    </div>
                                </div>
                                <div class="md:col-span-2 space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-1" x-text="`Your ${currentCoin.name} Deposit Address`"></label>
                                        <div class="flex">
                                            <input type="text" :value="currentCoin.address" readonly class="w-full truncate p-3 border border-white/20 rounded-l-lg bg-white/5 text-gray-300">
                                            <button @click="navigator.clipboard.writeText(currentCoin.address); copyText = 'Copied!'; setTimeout(() => copyText = 'Copy', 2000)" 
                                                    class="px-4 bg-orange-500 text-white font-semibold rounded-r-lg hover:bg-orange-600 w-24 text-center transition-colors" 
                                                    x-text="copyText"></button>
                                        </div>
                                    </div>
                                     <div class="bg-yellow-500/10 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                                        <p class="text-sm text-yellow-300"><span class="font-bold">Important:</span> <span x-text="currentCoin.warning"></span></p>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="mt-8 bg-gray-900/50 border border-white/10 rounded-2xl p-6 text-center">
                            <h3 class="text-lg font-semibold text-white">Have you sent your deposit?</h3>
                            <p class="mt-2 text-sm text-gray-400 max-w-md mx-auto">
                                Once you have completed the transfer from your wallet, please click the button below. Your balance will be updated after the required network confirmations.
                            </p>
                            <div class="mt-6">
                                <button class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform transform">
                                    I Have Sent My Deposit
                                </button>
                            </div>
                             <p class="mt-4 text-xs text-gray-500">
                                You can monitor the status on your <a href="#" class="underline hover:text-orange-400">Transactions</a> page.
                            </p>
                        </div>

                    </div>
                </div>
            </main>
</div>
