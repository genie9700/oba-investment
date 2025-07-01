<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class RecentTransactions extends Component
{
    public string $activeTab = 'all';

    public function setTab(string $tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $query = Transaction::where('user_id', Auth::id());

        if ($this->activeTab !== 'all') {
            $query->where('type', $this->activeTab);
        }

        $transactions = $query->latest()->take(5)->get();

        return view('livewire.recent-transactions', [
            'transactions' => $transactions,
        ]);
    }
}