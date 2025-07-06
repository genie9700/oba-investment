<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Earning;
use App\Models\Transaction;
use App\Models\Investment;
use Illuminate\Support\Facades\DB;

new 
#[Layout('components.layouts.admin')] 
#[Title('Edit User')]
class extends Component {
    use WithPagination;

    // KPI Properties
    public $activeInvestment;
    public float $totalInvestment;
    public float $totalEarnings;
    public float $totalWithdrawn;
    public float $availableBalance;
    public User $user;

    // Form Properties
    public ?float $earningAmount = null;
    public string $earningDescription = '';

    // For Balance Adjustment Modal
    public bool $showAdjustBalanceModal = false;
    public ?float $adjustmentAmount = null;
    public string $adjustmentType = 'credit';
    public string $adjustmentReason = '';

    public function mount(User $user)
    {
        $this->user = $user;
        $this->calculateKpis();
    }

    public function calculateKpis()
    {
         $this->availableBalance = $this->user->balance;
        $this->activeInvestment = Investment::where('user_id', $this->user->id)->where('status', 'active')->latest()->first();
        $this->totalInvestment = abs(Transaction::where('user_id', $this->user->id)->where('type', 'investment')->sum('amount'));
        $this->totalEarnings = Transaction::where('user_id', $this->user->id)->where('type', 'earning')->sum('amount');
        $this->totalWithdrawn = abs(Transaction::where('user_id', $this->user->id)->where('type', 'withdrawal')->where('status', 'completed')->sum('amount'));
    }

    public function addEarning()
    {
        $this->validate([
            'earningAmount' => 'required|numeric|min:0.01',
            'earningDescription' => 'required|string|max:255',
        ]);

        DB::transaction(function () {
            // 1. Create the Earning record first. We assume it's tied to the user's first active investment for this example.
            $investment = $this->user->investments()->where('status', 'active')->first();

            if (!$investment) {
                session()->flash('error', 'This user has no active investment to associate the earning with.');
                return;
            }

            $earning = Earning::create([
                'user_id' => $this->user->id,
                'investment_id' => $investment->id,
                'description' => $this->earningDescription,
            ]);

            // 2. Now, create the transaction THROUGH the earning relationship.
            // This automatically sets transactionable_id and transactionable_type.
            $earning->transaction()->create([
                'user_id' => $this->user->id,
                'type' => 'earning',
                'amount' => $this->earningAmount,
                'status' => 'completed',
                'description' => $this->earningDescription,
                'balance_after' => $this->user->balance + $this->earningAmount,
            ]);

            // 3. Finally, update the user's balance
            $this->user->increment('balance', $this->earningAmount);
        });

        $this->reset('earningAmount', 'earningDescription');
        $this->calculateKpis();
        session()->flash('message', 'Earning added successfully.');
    }

    public function toggleSuspension()
    {
        $this->user->update(['is_suspended' => !$this->user->is_suspended]);
        session()->flash('message', 'User status updated successfully.');
    }

    public function sendPasswordReset()
    {
        // This uses Laravel's built-in password reset functionality
        // Illuminate\Support\Facades\Password::sendResetLink($this->user->only('email'));
        session()->flash('message', 'Password reset link sent to user.');
    }

    public function adjustBalance()
    {
        $this->validate([
            'adjustmentAmount' => 'required|numeric|min:0.01',
            'adjustmentType' => 'required|in:credit,debit',
            'adjustmentReason' => 'required|string|max:255',
        ]);

        DB::transaction(function () {
            $amount = $this->adjustmentType === 'credit' ? $this->adjustmentAmount : -$this->adjustmentAmount;

            // First, update the user's balance
            $this->user->increment('balance', $amount);

            // THE FIX: Create the Transaction directly, without a parent model.
            // The polymorphic fields (transactionable_id, transactionable_type) will be NULL.
            Transaction::create([
                'user_id' => $this->user->id,
                'type' => 'adjustment',
                'amount' => $amount,
                'status' => 'completed',
                'description' => $this->adjustmentReason,
                'balance_after' => $this->user->balance, // Use the already-updated balance
            ]);
        });

        $this->showAdjustBalanceModal = false;
        $this->reset('adjustmentAmount', 'adjustmentReason', 'adjustmentType');
        $this->calculateKpis(); // Recalculate stats
        session()->flash('message', 'User balance adjusted successfully.');
    }

    public function with(): array
    {
        return [
            'recentEarnings' => Transaction::where('user_id', $this->user->id)->where('type', 'earning')->latest()->take(5)->get(),
        ];
    }
}; ?>

<div>
    <div class="p-6 md:p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
            <p class="text-gray-400">{{ $user->email }}</p>
        </div>
        <div class="mb-6">
            @if ($user->is_suspended)
                <span class="px-3 py-1 text-sm font-semibold bg-red-500/10 text-red-400 rounded-full">Suspended</span>
            @else
                <span class="px-3 py-1 text-sm font-semibold bg-green-500/10 text-green-400 rounded-full">Active</span>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-6">
                <p class="text-sm font-medium text-blue-400">Available Balance</p>
                <p class="text-3xl font-bold text-white mt-2">${{ number_format($availableBalance, 2) }}</p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <p class="text-sm font-medium text-gray-400">Active Investment</p>
                <p class="text-3xl font-bold text-white mt-2">{{ $activeInvestment->plan_name ?? 'No Active Plan' }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <p class="text-sm font-medium text-gray-400">Total Investment</p>
                <p class="text-3xl font-bold text-white mt-2">${{ number_format($totalInvestment, 2) }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <p class="text-sm font-medium text-gray-400">Total Earnings</p>
                <p class="text-3xl font-bold text-green-400 mt-2">${{ number_format($totalEarnings, 2) }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <p class="text-sm font-medium text-gray-400">Total Withdrawn</p>
                <p class="text-3xl font-bold text-white mt-2">${{ number_format($totalWithdrawn, 2) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-white/5 border border-white/10 rounded-2xl p-6 h-fit">
                <h2 class="text-xl font-bold text-white mb-6">Admin Actions</h2>

                @if (session('message'))
                    <div class="bg-green-500/10 text-green-300 text-sm rounded-lg p-3 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit="addEarning" class="space-y-4">
                    <h3 class="font-semibold text-white">Add Manual Earning</h3>
                    <div>
                        <label for="earningAmount" class="text-sm text-gray-300">Amount (USD)</label>
                        <input type="number" step="0.01" id="earningAmount" wire:model="earningAmount"
                            class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        @error('earningAmount')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="earningDescription" class="text-sm text-gray-300">Description</label>
                        <input type="text" id="earningDescription" wire:model="earningDescription"
                            placeholder="e.g., Bonus Earning"
                            class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        @error('earningDescription')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pt-2">
                        <x-loading-button type="submit" target="addEarning" class="w-full">Add
                            Earning</x-loading-button>
                    </div>
                    <div class="pt-6 space-y-4">
                        {{-- Suspend User Button --}}
                        <div>
                            <button type="button" wire:click="toggleSuspension" wire:confirm="Are you sure?"
                                class="w-full text-left p-3 rounded-lg hover:bg-white/5 transition-colors">
                                <p class="font-semibold text-white">
                                    {{ $user->is_suspended ? 'Un-suspend User' : 'Suspend User' }}</p>
                                <p class="text-xs text-gray-400">Prevent user from logging in or making transactions.
                                </p>
                            </button>
                        </div>
                        {{-- Adjust Balance Button --}}
                        <div>
                            <button type="button" @click="$wire.set('showAdjustBalanceModal', true)"
                                class="w-full text-left p-3 rounded-lg hover:bg-white/5 transition-colors">
                                <p class="font-semibold text-white">Adjust Balance</p>
                                <p class="text-xs text-gray-400">Manually credit or debit the user's main balance.</p>
                            </button>
                        </div>
                        {{-- Password Reset Button --}}
                        <div>
                            <button type="button" wire:click="sendPasswordReset"
                                wire:confirm="Are you sure you want to send a password reset link?"
                                class="w-full text-left p-3 rounded-lg hover:bg-white/5 transition-colors">
                                <p class="font-semibold text-white">Send Password Reset</p>
                                <p class="text-xs text-gray-400">Send a secure password reset link to the user's email.
                                </p>
                            </button>
                        </div>
                    </div>
                </form>


            </div>

            <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-4">Latest Earnings</h2>
                <ul class="space-y-4">
                    @forelse($recentEarnings as $earning)
                        <li class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <p class="text-white font-medium">{{ $earning->description }}</p>
                                <p class="text-gray-400 text-sm">{{ $earning->created_at->format('M d, Y') }}</p>
                            </div>
                            <p class="font-mono text-green-400">+${{ number_format($earning->amount, 2) }}</p>
                        </li>
                    @empty
                        <li class="text-center text-gray-400 py-4">No earnings recorded yet.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Adjust Balance Modal --}}
            <div x-data="{ isOpen: @entangle('showAdjustBalanceModal') }" x-show="isOpen" @keydown.escape.window="isOpen = false" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center">
                <div x-show="isOpen" @click="isOpen = false" x-transition.opacity
                    class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

                <div x-show="isOpen" @click.stop x-transition
                    class="relative bg-gray-900 border border-white/10 rounded-2xl w-full max-w-lg p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Adjust User Balance</h2>

                    <form wire:submit.prevent="adjustBalance">
                        <div class="space-y-6">
                            <div>
                                <label for="adjustmentAmount" class="block text-sm font-medium text-gray-300">Amount
                                    (USD)</label>
                                <input type="number" step="0.01" id="adjustmentAmount" wire:model="adjustmentAmount"
                                    class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                @error('adjustmentAmount')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="adjustmentType" class="block text-sm font-medium text-gray-300">Adjustment
                                    Type</label>
                                <select id="adjustmentType" wire:model="adjustmentType"
                                    class="mt-1 block w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option class="bg-gray-800" value="credit">Credit (Add to balance)</option>
                                    <option class="bg-gray-800" value="debit">Debit (Subtract from balance)</option>
                                </select>
                            </div>

                            <div>
                                <label for="adjustmentReason" class="block text-sm font-medium text-gray-300">Reason
                                    for Adjustment</label>
                                <input type="text" id="adjustmentReason" wire:model="adjustmentReason"
                                    placeholder="e.g., Promotional bonus, Fee refund"
                                    class="mt-1 w-full px-4 py-2 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                @error('adjustmentReason')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="pt-4 flex justify-end space-x-4">
                                <button type="button" @click="isOpen = false"
                                    class="px-6 py-2 rounded-full font-semibold text-gray-300 bg-white/10 hover:bg-white/20 transition-colors">
                                    Cancel
                                </button>
                                <x-loading-button type="submit" target="adjustBalance">
                                    Apply Adjustment
                                </x-loading-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
