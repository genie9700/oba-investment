<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout; 
use Livewire\WithPagination;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

new #[Layout('components.layouts.admin')] class extends Component { 
    use WithPagination;

    public function approveWithdrawal(Withdrawal $withdrawal)
    {
        DB::transaction(function () use ($withdrawal) {
            $user = $withdrawal->user;
            $amountToWithdraw = abs($withdrawal->transaction->amount);

            // Double-check if the user still has sufficient balance
            if ($user->balance < $amountToWithdraw) {
                session()->flash('error', 'User has insufficient balance. Cannot approve withdrawal.');
                $this->rejectWithdrawal($withdrawal); // Automatically reject if balance is too low
                return;
            }

            // 1. Deduct the amount from the user's balance
            $user->decrement('balance', $amountToWithdraw);

            // 2. Update the transaction status to 'completed'
            $withdrawal->transaction->update([
                'status' => 'completed',
                'balance_after' => $user->fresh()->balance,
            ]);

            // TODO: Trigger API to send funds & notify user
        });
        

        session()->flash('message', 'Withdrawal has been approved.');
    }

    public function rejectWithdrawal(Withdrawal $withdrawal)
    {
        $withdrawal->transaction->update(['status' => 'failed']);
        // TODO: Send user notification email
        session()->flash('message', 'Withdrawal has been rejected.');
    }

    public function with(): array
    {
        $pendingWithdrawals = Withdrawal::whereHas('transaction', function ($query) {
            $query->where('status', 'pending');
        })->with('user', 'transaction')->latest()->paginate(10);

        return [
            'withdrawals' => $pendingWithdrawals,
        ];
    }
}; ?>

<div class="p-6 md:p-8">
    <h1 class="text-3xl font-bold text-white mb-8">Pending Withdrawals</h1>

    @if (session('message'))
        <div class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-500/10 text-red-300 border border-red-500/30 rounded-lg p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white/5 border border-white/10 rounded-2xl">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="text-left text-xs text-gray-400 uppercase">
                    <tr>
                        <th class="p-4 font-medium">User</th>
                        <th class="p-4 font-medium">Amount</th>
                        <th class="p-4 font-medium">Method</th>
                        <th class="p-4 font-medium">Destination</th>
                        <th class="p-4 font-medium">Date</th>
                        <th class="p-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($withdrawals as $withdrawal)
                        <tr class="border-t border-white/5">
                            <td class="p-4">
                                <p class="font-semibold text-white">{{ $withdrawal->user->name }}</p>
                                <p class="text-gray-400">{{ $withdrawal->user->email }}</p>
                            </td>
                            <td class="p-4 font-mono text-red-400">${{ number_format(abs($withdrawal->transaction->amount), 2) }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full capitalize {{ $withdrawal->method === 'btc' ? 'bg-orange-500/10 text-orange-400' : 'bg-blue-500/10 text-blue-400' }}">
                                    {{ $withdrawal->method }}
                                </span>
                            </td>
                            <td class="p-4 font-mono text-gray-300 text-xs">
                                @if($withdrawal->method === 'btc')
                                    {{ $withdrawal->wallet_address }}
                                @else
                                    {{ $withdrawal->bank_details['bank_name'] ?? '' }} - ****{{ substr($withdrawal->bank_details['account_number'] ?? '', -4) }}
                                @endif
                            </td>
                            <td class="p-4 text-gray-400">{{ $withdrawal->created_at->format('M d, Y') }}</td>
                            <td class="p-4">
                                <div class="flex space-x-2">
                                    <button wire:click="approveWithdrawal({{ $withdrawal->id }})" class="px-3 py-1 text-xs font-semibold bg-green-500/10 text-green-400 rounded-full hover:text-white">Approve</button>
                                    <button wire:click="rejectWithdrawal({{ $withdrawal->id }})" class="px-3 py-1 text-xs font-semibold bg-red-500/10 text-red-400 rounded-full hover:text-white">Reject</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-400">There are no pending withdrawals.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/10">
            {{ $withdrawals->links() }}
        </div>
    </div>
</div>
