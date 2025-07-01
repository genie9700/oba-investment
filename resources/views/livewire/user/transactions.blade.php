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
                    activeTab: 'all',
                    transactions: [
                        { id: 1, date: '2025-06-28', type: 'earning', description: 'Daily Earning - Elite Plan', amount: 135.00, status: 'Completed' },
                        { id: 2, date: '2025-06-27', type: 'deposit', description: 'Deposit via Bank Transfer', amount: 10000.00, status: 'Completed' },
                        { id: 3, date: '2025-06-26', type: 'withdrawal', description: 'Withdrawal to bc1q...wlh', amount: -1200.00, status: 'Completed' },
                        { id: 4, date: '2025-06-26', type: 'earning', description: 'Daily Earning - Elite Plan', amount: 135.00, status: 'Completed' },
                        { id: 5, date: '2025-06-25', type: 'investment', description: 'Invested in Elite Plan', amount: -25000.00, status: 'Completed' },
                        { id: 6, date: '2025-06-24', type: 'withdrawal', description: 'Withdrawal to Bank', amount: -500.00, status: 'Pending' }
                    ],
                    get filteredTransactions() {
                        if (this.activeTab === 'all') return this.transactions;
                        return this.transactions.filter(t => t.type === this.activeTab);
                    },
                    getTypeClass(type) {
                        const classes = {
                            deposit: 'bg-blue-500/10 text-blue-400',
                            withdrawal: 'bg-red-500/10 text-red-400',
                            earning: 'bg-green-500/10 text-green-400',
                            investment: 'bg-purple-500/10 text-purple-400'
                        };
                        return classes[type] || 'bg-gray-500/10 text-gray-400';
                    },
                    getAmountClass(amount) {
                        return amount > 0 ? 'text-green-400' : 'text-white';
                    }
                }">
                    <h1 class="text-3xl font-bold text-white mb-8 hidden lg:block">Transaction History</h1>

                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                        <div class="p-6 border-b border-white/10">
                             <div class="border-b border-white/10">
                                <nav class="-mb-px flex space-x-6">
                                   <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">All</button>
                                   <button @click="activeTab = 'deposit'" :class="activeTab === 'deposit' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Deposits</button>
                                   <button @click="activeTab = 'withdrawal'" :class="activeTab === 'withdrawal' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Withdrawals</button>
                                   <button @click="activeTab = 'earning'" :class="activeTab === 'earning' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Earnings</button>
                                   <button @click="activeTab = 'investment'" :class="activeTab === 'investment' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white'" class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors">Investments</button>
                                </nav>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[700px]">
                                <thead class="text-left text-xs text-gray-400 uppercase tracking-wider">
                                    <tr>
                                        <th class="p-4 font-medium">Date</th>
                                        <th class="p-4 font-medium">Type</th>
                                        <th class="p-4 font-medium">Description</th>
                                        <th class="p-4 font-medium">Amount</th>
                                        <th class="p-4 font-medium">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <template x-for="transaction in filteredTransactions" :key="transaction.id">
                                        <tr class="border-t border-white/5">
                                            <td class="p-4 text-gray-300" x-text="transaction.date"></td>
                                            <td class="p-4">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full capitalize" :class="getTypeClass(transaction.type)" x-text="transaction.type"></span>
                                            </td>
                                            <td class="p-4 font-medium text-white" x-text="transaction.description"></td>
                                            <td class="p-4 font-mono" :class="getAmountClass(transaction.amount)" x-text="`${transaction.amount > 0 ? '+' : ''}$${Math.abs(transaction.amount).toLocaleString('en-US', {minimumFractionDigits: 2})}`"></td>
                                            <td class="p-4 text-gray-300" x-text="transaction.status"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        
                         <div class="p-4 border-t border-white/10 flex justify-between items-center text-sm text-gray-400">
                           <p>Showing 1 to <span x-text="filteredTransactions.length"></span> of <span x-text="filteredTransactions.length"></span> results</p>
                           <div class="flex items-center space-x-2">
                               <button class="px-3 py-1 border border-white/20 rounded-md hover:bg-white/5">&larr; Previous</button>
                               <button class="px-3 py-1 border border-white/20 rounded-md hover:bg-white/5">Next &rarr;</button>
                           </div>
                        </div>
                    </div>

                </div>
            </main>
</div>
