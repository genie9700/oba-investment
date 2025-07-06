<?php

use Livewire\Volt\Component;
use App\Models\Plan;

new class extends Component {
    public string $activeTab = 'all';
    public $showHeading = true;


    public function setTab(string $tab)
    {
        $this->activeTab = $tab;
    }

    public function with()
    {
        $plansQuery = Plan::where('is_active', true);

        if ($this->activeTab !== 'all') {
            $plansQuery->where('tier', $this->activeTab);
        }

        $plans = $plansQuery->orderBy('price')->get();

        return [
            'plans' => $plans,
        ];
    }
}; ?>

<div>
    <section class="">
        <div class="max-w-7xl mx-auto">
            
                
            
            <div class="flex flex-wrap justify-center items-center mb-12 space-x-2 sm:space-x-4">
                <button wire:click="setTab('all')"
                    class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2 {{ $activeTab === 'all' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">All
                    Tiers</button>
                <button wire:click="setTab('pro')"
                    class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2 {{ $activeTab === 'pro' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">Professional</button>
                <button wire:click="setTab('elite')"
                    class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2 {{ $activeTab === 'elite' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">Elite</button>
                <button wire:click="setTab('institutional')"
                    class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2 {{ $activeTab === 'institutional' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">Institutional</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($plans as $plan)
                    <div class="relative h-full">
                        @if ($plan->is_featured)
                            <div
                                class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                Most Popular</div>
                        @endif

                        {{-- Card structure now exactly matches your preferred design --}}
                        <div
                            class="bg-white/5 border rounded-3xl p-6 flex flex-col h-full transition-all duration-300 hover:border-orange-400/50 {{ $plan->is_featured ? 'border-orange-400/50 scale-105 bg-gray-900' : 'border-white/10' }}">
                            <div class="flex-grow">
                                <h3 class="text-xl font-bold text-white">{{ $plan->name }}</h3>
                                <div class="mt-4 flex items-baseline">
                                    <span
                                        class="text-4xl font-extrabold tracking-tight text-white">${{ number_format($plan->price) }}</span>
                                </div>

                                <ul class="my-6 space-y-3 text-sm">
                                    <li class="flex items-center text-gray-300"><svg
                                            class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>Hash Power: <span
                                            class="font-semibold ml-1 text-white">{{ $plan->hash_power }}</span></li>
                                    <li class="flex items-center text-gray-300"><svg
                                            class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01">
                                            </path>
                                        </svg>Daily Earnings: <span
                                            class="font-semibold ml-1 text-white">${{ $plan->daily_earning_rate }}</span>
                                    </li>
                                    <li class="flex items-center text-gray-300"><svg
                                            class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>Duration: <span
                                            class="font-semibold ml-1 text-white">{{ $plan->duration_in_months }}
                                            Months</span></li>
                                    <li class="flex items-center text-gray-300"><svg
                                            class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h5M7 7l-3 3"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 20v-5h-5M17 17l3-3"></path>
                                        </svg>Withdrawal: <span
                                            class="font-semibold ml-1 text-white">{{ $plan->withdrawal_limit }}</span>
                                    </li>
                                </ul>

                                <div class="pt-4 border-t border-white/10 space-y-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-400">Est. Total Return</span>
                                        <span
                                            class="font-bold text-white">${{ number_format($plan->total_return, 2) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-400">Est. Return on Investment</span>
                                        <span
                                            class="font-bold text-green-400">{{ number_format($plan->roi_percentage, 1) }}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('user.invest') }}"
                                    class="w-full block text-center py-3 px-4 rounded-lg font-semibold transition-colors duration-300 bg-gradient-to-r from-orange-500 to-yellow-500 text-white hover:scale-105">
                                    Select Plan
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 text-center py-12 text-gray-400">
                        No investment plans are available at this time.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
