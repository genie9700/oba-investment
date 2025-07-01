<div class="bg-white/5 border border-white/10 rounded-xl p-6">
    <h2 class="text-xl font-bold text-white mb-4">Recent Activity</h2>
    <div class="flex items-center space-x-2 border-b border-white/10 mb-4">
       <button wire:click="setTab('all')" class="px-3 py-2 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'all' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">All</button>
       <button wire:click="setTab('deposit')" class="px-3 py-2 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'deposit' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Deposits</button>
       <button wire:click="setTab('withdrawal')" class="px-3 py-2 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'withdrawal' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Withdrawals</button>
       <button wire:click="setTab('earning')" class="px-3 py-2 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'earning' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Earnings</button>
    </div>
    <div class="space-y-4">
        @forelse($transactions as $transaction)
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 bg-white/5 rounded-full mr-3">
                        @php
                            $icon = match($transaction->type) {
                                'deposit' => '<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                'withdrawal' => '<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                'earning' => '<svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>',
                                default => '<svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
                            };
                        @endphp
                        {!! $icon !!}
                    </div>
                    <div>
                        <p class="font-semibold text-white text-sm">{{ $transaction->description }}</p>
                        <p class="text-xs text-gray-400">{{ $transaction->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <p class="font-mono text-sm {{ $transaction->amount > 0 ? 'text-green-400' : 'text-white' }}">
                    {{ $transaction->amount > 0 ? '+' : '' }}${{ number_format(abs($transaction->amount), 2) }}
                </p>
            </div>
        @empty
             <p class="text-sm text-center text-gray-400 py-4">No transactions found for {{ $activeTab }}.</p>
        @endforelse
    </div>
</div>