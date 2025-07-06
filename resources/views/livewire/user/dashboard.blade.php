<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};

new 
#[Layout('components.layouts.user')] 
#[Title('Withdrawals')] 
class extends Component {
    
}; ?>

<div>
    
    <div>
        <h1 class="text-3xl font-bold text-white mb-6 hidden lg:block">Dashboard</h1>

        <!-- kpi cards -->
       <livewire:dashboard-statistics />


        <!-- charts and all -->
        <livewire:portfolio-chart />
       

        <!-- tables -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- active investment plans -->
            <livewire:active-plans />
           

            <!-- recent activity   -->
            <livewire:recent-transactions />
        </div>
    </div>
</div>
