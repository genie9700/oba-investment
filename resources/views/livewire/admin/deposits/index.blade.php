<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Investment;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

new 
#[Layout('components.layouts.admin')] 
#[Title('Manage Deposits')] 
class extends Component {
    use WithPagination;

    public function approveDeposit(Deposit $deposit)
    {
        DB::transaction(function () use ($deposit) {
            // 1. Update the deposit status
            $deposit->transaction->update(['status' => 'completed']);

            // 2. Add the funds to the user's main balance
            $user = $deposit->user;
            $user->balance += $deposit->transaction->amount;
            $user->save();

            // 3. Update the transaction with the new balance
            $deposit->transaction->update(['balance_after' => $user->balance]);

            // 4. Create the Investment record since the deposit was for a plan
            // In a real app, you'd pull this from the deposit/transaction record
            $planData = Plan::firstWhere('price', $deposit->transaction->amount); // Simplified logic
            if ($planData) {
                $investment = Investment::create([
                    'user_id' => $user->id, 
                    'plan_name' => $planData->name,
                    'initial_amount' => $deposit->transaction->amount,
                    'hash_power' => $planData->hash_power,
                    'daily_earning_rate' => $planData->daily_earning_rate,
                    'duration_in_months' => $planData->duration_in_months,
                    'projected_total_return' => $planData->daily_earning_rate * $planData->duration_in_months * 30.4,
                    'status' => 'active',
                    'expires_at' => Carbon::now()->addMonths($planData->duration_in_months),
                ]);

                // Create the "investment" transaction (debit from balance)
                $investment->transaction()->create([
                    'user_id' => $user->id,
                    'type' => 'investment',
                    'amount' => -$deposit->transaction->amount,
                    'status' => 'completed',
                    'description' => 'Investment in ' . $planData->name,
                    'balance_after' => $user->balance - $deposit->transaction->amount,
                ]);

                // Update user balance again after investment debit
                $user->balance -= $deposit->transaction->amount;
                $user->save();
            }

            // TODO: Send user notification email
        });

        session()->flash('message', 'Deposit has been approved and the investment is now active.');
    }

    public function rejectDeposit(Deposit $deposit)
    {
        $deposit->transaction->update(['status' => 'failed']);
        // TODO: Send user notification email
        session()->flash('message', 'Deposit has been rejected.');
    }

    public function with(): array
    {
        // Fetch all deposits that have a pending transaction
        $pendingDeposits = Deposit::whereHas('transaction', function ($query) {
            $query->where('status', 'pending');
        })
            ->with('user', 'transaction')
            ->latest()
            ->paginate(10);

        return [
            'deposits' => $pendingDeposits,
        ];
    }
}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Deposits</h1>
        <div class="w-6"></div>
    </header>
    <div class="p-6 md:p-8">
        <h1 class="text-3xl font-bold text-white mb-8">Pending Deposits</h1>

        @if (session()->has('message'))
            <div class="bg-green-500/10 text-green-300 border border-green-500/30 rounded-lg p-4 mb-6">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-2xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="text-left text-xs text-gray-400 uppercase">
                        <tr>
                            <th class="p-4 font-medium">User</th>
                            <th class="p-4 font-medium">Amount</th>
                            <th class="p-4 font-medium">TxID / Proof</th>
                            <th class="p-4 font-medium">Date</th>
                            <th class="p-4 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($deposits as $deposit)
                            <tr class="border-t border-white/5">
                                <td class="p-4">
                                    <p class="font-semibold text-white">{{ $deposit->user->name }}</p>
                                    <p class="text-gray-400">{{ $deposit->user->email }}</p>
                                </td>
                                <td class="p-4 font-mono text-white">
                                    ${{ number_format($deposit->transaction->amount, 2) }}</td>
                                <td class="p-4">
                                    @if ($deposit->proof_path)
                                        <a href="{{ Storage::url($deposit->proof_path) }}" target="_blank"
                                            class="text-orange-400 underline hover:text-orange-300">View Proof</a>
                                    @else
                                        <span class="text-gray-500">No proof</span>
                                    @endif
                                </td>
                                <td class="p-4 text-gray-400">{{ $deposit->created_at->format('M d, Y') }}</td>
                                <td class="p-4">
                                    <div class="flex space-x-2">
                                        <button wire:click="approveDeposit({{ $deposit->id }})"
                                            class="px-3 py-1 text-xs font-semibold bg-green-500/10 text-green-400 rounded-full hover:text-white">Approve</button>
                                        <button wire:click="rejectDeposit({{ $deposit->id }})"
                                            class="px-3 py-1 text-xs font-semibold bg-red-500/10 text-red-400 rounded-full hover:text-white">Reject</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">There are no pending deposits.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-white/10">
                {{ $deposits->links() }}
            </div>
        </div>
    </div>
</div>
