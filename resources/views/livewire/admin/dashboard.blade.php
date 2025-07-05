<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Investment;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.admin')] class extends Component {
    public int $totalUsers;
    public float $totalInvested;
    public int $pendingWithdrawalsCount;
    public int $pendingDepositsCount;
    public $latestUsers;
    public $pendingTransactions;

    public function mount()
    {
        $this->totalUsers = User::where('is_admin', 0)->count();
        $this->totalInvested = Investment::where('status', 'active')->sum('initial_amount');

        $this->pendingWithdrawalsCount = Transaction::where('type', 'withdrawal')->where('status', 'pending')->count();
        $this->pendingDepositsCount = Transaction::where('type', 'deposit')->where('status', 'pending')->count();

        $this->latestUsers = User::where('is_admin', 0)->latest()->take(5)->get();
        $this->pendingTransactions = Transaction::whereIn('status', ['pending'])->latest()->take(5)->get();
    }

}; ?>

<div>
    <div class="p-6 md:p-8">
    <h1 class="text-3xl font-bold text-white mb-8">Admin Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <p class="text-sm font-medium text-gray-400">Total Users</p>
            <p class="text-3xl font-bold text-white mt-2">{{ number_format($totalUsers) }}</p>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
            <p class="text-sm font-medium text-gray-400">Total Active Investments</p>
            <p class="text-3xl font-bold text-white mt-2">${{ number_format($totalInvested, 2) }}</p>
        </div>
        <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-6">
            <p class="text-sm font-medium text-yellow-400">Pending Deposits</p>
            <p class="text-3xl font-bold text-yellow-400 mt-2">{{ number_format($pendingDepositsCount) }}</p>
        </div>
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6">
            <p class="text-sm font-medium text-red-400">Pending Withdrawals</p>
            <p class="text-3xl font-bold text-red-400 mt-2">{{ number_format($pendingWithdrawalsCount) }}</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white/5 border border-white/10 rounded-xl">
            <h2 class="text-xl font-bold text-white p-6">Pending Actions</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="text-left text-xs text-gray-400 uppercase">
                        <tr>
                            <th class="p-4 font-medium">User</th>
                            <th class="p-4 font-medium">Type</th>
                            <th class="p-4 font-medium">Amount</th>
                            <th class="p-4 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingTransactions as $transaction)
                            <tr class="border-t border-white/5">
                                <td class="p-4 text-white">{{ $transaction->user->name }}</td>
                                <td class="p-4 text-white capitalize">{{ $transaction->type }}</td>
                                <td class="p-4 text-white font-mono">${{ number_format(abs($transaction->amount), 2) }}</td>
                                <td class="p-4 text-gray-400">{{ $transaction->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-400">No pending actions.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl">
            <h2 class="text-xl font-bold text-white p-6">Latest User Registrations</h2>
             <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="text-left text-xs text-gray-400 uppercase">
                        <tr>
                            <th class="p-4 font-medium">Name</th>
                            <th class="p-4 font-medium">Email</th>
                            <th class="p-4 font-medium">Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestUsers as $user)
                            <tr class="border-t border-white/5">
                                <td class="p-4 text-white">{{ $user->name }}</td>
                                <td class="p-4 text-gray-400">{{ $user->email }}</td>
                                <td class="p-4 text-gray-400">{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="3" class="p-6 text-center text-gray-400">No new users.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
