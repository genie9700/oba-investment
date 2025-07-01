<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Investment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class ActivePlans extends Component
{
    public Collection $investments;

    public function mount()
    {
        // Fetch the 5 most recent investments for the current user.
        $this->investments = Investment::where('user_id', Auth::id())
            ->latest() // Orders by created_at descending
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.active-plans');
    }
}