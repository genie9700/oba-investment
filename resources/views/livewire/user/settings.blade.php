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
                <div class="p-6 md:p-8">
                    <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Settings</h1>

                    <div x-data="{ activeTab: 'profile', addAddressModalOpen: false }">
                        <div class="border-b border-white/10 mb-8">
                            <nav class="-mb-px flex space-x-6">
                                <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Profile</button>
                                <button @click="activeTab = 'security'" :class="activeTab === 'security' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Security</button>
                                <button @click="activeTab = 'withdrawal'" :class="activeTab === 'withdrawal' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Withdrawal Settings</button>
                                <button @click="activeTab = 'notifications'" :class="activeTab === 'notifications' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Notifications</button>
                            </nav>
                        </div>

                        <div>
                            <div x-show="activeTab === 'profile'" x-transition class="bg-white/5 border border-white/10 rounded-2xl">
                                <div class="p-6 sm:p-8">
                                    <h2 class="text-xl font-bold text-white">Personal Information</h2>
                                    <p class="text-sm text-gray-400 mt-1">Update your profile details.</p>
                                    <form class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
                                        <div class="sm:col-span-3">
                                            <label for="full-name" class="block text-sm font-medium text-gray-300">Full Name</label>
                                            <input type="text" id="full-name" value="John Doe" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                                            <input type="email" id="email" value="john.doe@email.com" readonly class="mt-2 block w-full px-4 py-3 bg-black/20 border border-white/10 rounded-lg text-gray-400 cursor-not-allowed">
                                        </div>
                                    </form>
                                </div>
                                <div class="p-6 border-t border-white/10 flex justify-end">
                                    <button class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition-transform">Save Changes</button>
                                </div>
                            </div>
                            
                            <div x-show="activeTab === 'security'" x-transition>
                                <div class="bg-white/5 border border-white/10 rounded-2xl mb-8">
                                    <div class="p-6 sm:p-8">
                                        <h2 class="text-xl font-bold text-white">Change Password</h2>
                                        <p class="text-sm text-gray-400 mt-1">It's a good idea to use a strong, unique password.</p>
                                        <form class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
                                            <div class="sm:col-span-6"><label for="current-password" class="block text-sm font-medium text-gray-300">Current Password</label><input type="password" id="current-password" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500"></div>
                                            <div class="sm:col-span-3"><label for="new-password" class="block text-sm font-medium text-gray-300">New Password</label><input type="password" id="new-password" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500"></div>
                                            <div class="sm:col-span-3"><label for="confirm-new-password" class="block text-sm font-medium text-gray-300">Confirm New Password</label><input type="password" id="confirm-new-password" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500"></div>
                                        </form>
                                    </div>
                                    <div class="p-6 border-t border-white/10 flex justify-end"><button class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition-transform">Update Password</button></div>
                                </div>
                                <div class="bg-white/5 border border-white/10 rounded-2xl">
                                    <div class="p-6 sm:p-8 flex justify-between items-center">
                                        <div>
                                            <h2 class="text-xl font-bold text-white">Two-Factor Authentication (2FA)</h2>
                                            <p class="text-sm text-gray-400 mt-1">Add an extra layer of security to your account.</p>
                                        </div>
                                        <button class="px-6 py-2 rounded-full font-semibold bg-green-500/10 text-green-300 border border-green-500/30">Enabled</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div x-show="activeTab === 'withdrawal'" x-transition class="bg-white/5 border border-white/10 rounded-2xl">
                                <div class="p-6 sm:p-8">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-xl font-bold text-white">Whitelisted Withdrawal Addresses</h2>
                                            <p class="text-sm text-gray-400 mt-1">For your security, you can only withdraw to pre-approved addresses.</p>
                                        </div>
                                        <button @click="addAddressModalOpen = true" class="mt-4 sm:mt-0 bg-white/10 text-white px-4 py-2 rounded-lg font-semibold hover:bg-white/20 transition-colors text-sm flex-shrink-0">
                                            Add New Address
                                        </button>
                                    </div>
                                    <ul class="mt-6 space-y-3">
                                        <li class="p-4 bg-gray-900/50 border border-white/10 rounded-lg flex justify-between items-center"><div><p class="font-mono text-sm text-white">bc1q...wlh</p><p class="text-xs text-gray-400">My Ledger Wallet (BTC)</p></div><button class="text-red-400 hover:text-red-300 text-sm font-semibold">Remove</button></li>
                                        <li class="p-4 bg-gray-900/50 border border-white/10 rounded-lg flex justify-between items-center"><div><p class="font-mono text-sm text-white">0x12...a4bC</p><p class="text-xs text-gray-400">My Metamask Wallet (ETH)</p></div><button class="text-red-400 hover:text-red-300 text-sm font-semibold">Remove</button></li>
                                    </ul>
                                </div>
                            </div>

                             <div x-show="activeTab === 'notifications'" x-transition class="bg-white/5 border border-white/10 rounded-2xl">
                                <div class="p-6 sm:p-8">
                                     <h2 class="text-xl font-bold text-white">Notification Preferences</h2>
                                     <p class="text-sm text-gray-400 mt-1">Choose how you want to be notified.</p>
                                     <form class="mt-6 space-y-4">
                                        <div class="relative flex items-start"><div class="flex h-6 items-center"><input id="deposits" type="checkbox" checked class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500"></div><div class="ml-3 text-sm leading-6"><label for="deposits" class="font-medium text-gray-300">Deposits & Withdrawals</label><p class="text-gray-400">Get an email upon successful deposits and withdrawals.</p></div></div>
                                        <div class="relative flex items-start"><div class="flex h-6 items-center"><input id="earnings" type="checkbox" class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500"></div><div class="ml-3 text-sm leading-6"><label for="earnings" class="font-medium text-gray-300">Daily Earnings</label><p class="text-gray-400">Receive a daily summary of your earnings.</p></div></div>
                                        <div class="relative flex items-start"><div class="flex h-6 items-center"><input id="promotions" type="checkbox" checked class="h-4 w-4 rounded bg-white/10 border-white/30 text-orange-500 focus:ring-orange-500"></div><div class="ml-3 text-sm leading-6"><label for="promotions" class="font-medium text-gray-300">Platform Updates</label><p class="text-gray-400">Get notified about new features and investment plans.</p></div></div>
                                     </form>
                                </div>
                                <div class="p-6 border-t border-white/10 flex justify-end"><button class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition-transform">Save Preferences</button></div>
                            </div>

                        </div>
                        <div x-show="addAddressModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                            <div x-show="addAddressModalOpen" @click="addAddressModalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
                            
                            <div x-show="addAddressModalOpen" @click.stop x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-gray-900 border border-white/10 rounded-2xl w-full max-w-lg p-8">
                                <h2 class="text-2xl font-bold text-white mb-6">Add New Withdrawal Address</h2>
                                <form action="#" class="space-y-6">
                                    <div>
                                        <label for="address-label" class="block text-sm font-medium text-gray-300">Label</label>
                                        <input type="text" id="address-label" placeholder="e.g. My Ledger Wallet" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    </div>
                                    <div>
                                        <label for="cryptocurrency" class="block text-sm font-medium text-gray-300">Cryptocurrency</label>
                                        <select id="cryptocurrency" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                            <option class="bg-gray-800">Bitcoin (BTC)</option>
                                            <option class="bg-gray-800">Ethereum (ETH)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="wallet-address" class="block text-sm font-medium text-gray-300">Wallet Address</label>
                                        <textarea id="wallet-address" rows="3" placeholder="Enter the full wallet address" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                                    </div>
                                    <div class="pt-4 flex justify-end space-x-4">
                                        <button type="button" @click="addAddressModalOpen = false" class="px-6 py-2 rounded-full font-semibold text-gray-300 bg-white/10 hover:bg-white/20 transition-colors">Cancel</button>
                                        <button type="submit" class="px-6 py-2 rounded-full font-semibold text-white bg-gradient-to-r from-orange-500 to-yellow-500 hover:scale-105 transition-transform">Save Address</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </main>
</div>
