<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

new 
#[Layout('components.layouts.user')] 
#[Title('Transactions')] 
class extends Component {
    use WithPagination;

    public $activeTab = 'all';
    public string $search = '';

    // This method resets the page number whenever the search or tab is changed.
    public function updated($property)
    {
        if ($property === 'search' || $property === 'activeTab') {
            $this->resetPage();
        }
    }

    public function setTab(string $tab)
    {
        $this->activeTab = $tab;
    }

    public function with(): array
    {
        $query = Transaction::where('user_id', Auth::id());

        // Filter by the active tab
        if ($this->activeTab !== 'all') {
            $query->where('type', $this->activeTab);
        }

        // Apply search query
        if (!empty($this->search)) {
            $query->where('description', 'like', '%' . $this->search . '%');
        }

        $transactions = $query->latest()->paginate(15); // Paginate the results
        return [
            'transactions' => $transactions,
        ];
    }
}; ?>

<div>

    <div>
        <div>
            <div>
                <h1 class="text-3xl font-bold text-white mb-8">Transaction History</h1>

                <div class="bg-white/5 border border-white/10 rounded-2xl">

                    <div class="p-6 border-b border-white/10">
                        <div class="border-b border-white/10">
                            <nav class="-mb-px flex space-x-6">
                                <button wire:click="setTab('all')"
                                    class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'all' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">All</button>
                                <button wire:click="setTab('deposit')"
                                    class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'deposit' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Deposits</button>
                                <button wire:click="setTab('withdrawal')"
                                    class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'withdrawal' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Withdrawals</button>
                                <button wire:click="setTab('earning')"
                                    class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'earning' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Earnings</button>
                                <button wire:click="setTab('investment')"
                                    class="px-1 pb-3 text-sm font-semibold border-b-2 transition-colors {{ $activeTab === 'investment' ? 'text-orange-400 border-orange-400' : 'text-gray-400 border-transparent hover:text-white' }}">Investments</button>
                            </nav>
                        </div>
                        <div class="mt-4">
                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="Search by description..."
                                class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
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
                                @forelse($transactions as $transaction)
                                    <tr class="border-t border-white/5">
                                        <td class="p-4 text-gray-300">
                                            {{ $transaction->created_at->format('M d, Y, g:i A') }}</td>
                                        <td class="p-4">
                                            @php
                                                $typeClasses = match ($transaction->type) {
                                                    'deposit' => 'bg-blue-500/10 text-blue-400',
                                                    'withdrawal' => 'bg-red-500/10 text-red-400',
                                                    'earning' => 'bg-green-500/10 text-green-400',
                                                    'investment' => 'bg-purple-500/10 text-purple-400',
                                                    default => 'bg-gray-500/10 text-gray-400',
                                                };
                                            @endphp
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full capitalize {{ $typeClasses }}">{{ $transaction->type }}</span>
                                        </td>
                                        <td class="p-4 font-medium text-white">{{ $transaction->description }}</td>
                                        <td
                                            class="p-4 font-mono {{ $transaction->amount > 0 ? 'text-green-400' : 'text-white' }}">
                                            {{ $transaction->amount > 0 ? '+' : '' }}${{ number_format(abs($transaction->amount), 2) }}
                                        </td>
                                        <td class="p-4 text-gray-300 capitalize">{{ $transaction->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-gray-400">No transactions found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-white/10">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
