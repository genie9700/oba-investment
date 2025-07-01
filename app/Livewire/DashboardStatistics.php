<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Investment;  

class DashboardStatistics extends Component
{
     public $name = '';
    public float $activeInvestment = 0;
    public float $totalEarnings = 0;
    public float $dailyEarnings = 0;
    public float $pendingWithdrawals = 0;
    public float $totalWithdrawn = 0;


    public function mount()
    {
        $user = Auth::user();

        // Calculate the total value of all currently 'active' investments.
        $this->activeInvestment = Investment::where('user_id', $user->id)
            ->where('status', 'active')
            ->sum('initial_amount');

        // Calculate the sum of all 'earning' type transactions.
        $this->totalEarnings = Transaction::where('user_id', $user->id)
            ->where('type', 'earning')
            ->sum('amount');

        // Calculate earnings just from today.
        $this->dailyEarnings = Transaction::where('user_id', $user->id)
            ->where('type', 'earning')
            ->whereDate('created_at', today())
            ->sum('amount');

        // Calculate the sum of all 'withdrawal' transactions that are still 'pending'.
        // The amount is negative in the DB, so we use abs() to get a positive number.
        $this->pendingWithdrawals = abs(Transaction::where('user_id', $user->id)
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->sum('amount'));

        // Calculate the sum of all 'withdrawal' transactions that are 'completed'.
        $this->totalWithdrawn = abs(Transaction::where('user_id', $user->id)
            ->where('type', 'withdrawal')
            ->where('status', 'completed')
            ->sum('amount'));

    }

    public function render()
    {
        return view('livewire.dashboard-statistics');
    }
}