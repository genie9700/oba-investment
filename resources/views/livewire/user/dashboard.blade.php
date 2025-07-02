<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.user')] class extends Component {
    
}; ?>

<div>
    <header class="lg:hidden flex items-center justify-between p-4 border-b border-white/10 bg-gray-900">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-xl font-bold text-white">Dashboard</h1>
        <div class="w-6"></div>
    </header>
    <div class="p-6 md:p-8">
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
