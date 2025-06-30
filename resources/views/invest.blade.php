@extends('layouts.guest')

@section('content')

    
    <main>
        <section class="relative pt-32 pb-16 px-6 lg:px-8 text-center overflow-hidden">
            <div class="absolute inset-0 crypto-grid opacity-50"></div>
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white">
                    Investment <span class="text-gradient">Plans & Calculator</span>
                </h1>
                <p class="mt-6 text-xl text-gray-400 leading-relaxed">
                    Find the perfect plan to match your financial goals. Use our interactive calculator to project your potential returns based on your chosen investment amount.
                </p>
            </div>
        </section>

            <section class="py-24 px-6 lg:px-8">
                <div class="max-w-5xl mx-auto" x-data="{
                    investmentAmount: 25000,
                    selectedPlanName: 'Elite Plan',
                    plans: [
                        { name: 'Professional Plan', price: 5000, earnings: 25, duration: '12 Months' },
                        { name: 'Elite Plan', price: 25000, earnings: 135, duration: '18 Months' },
                        { name: 'Apex Plan', price: 100000, earnings: 550, duration: '24 Months' },
                        { name: 'Sovereign Plan', price: 500000, earnings: 2900, duration: '24 Months' },
                        { name: 'Institutional Plan', price: 1000000, earnings: 6200, duration: '36 Months' }
                    ],
                    get selectedPlan() {
                        return this.plans.find(p => p.name === this.selectedPlanName) || this.plans[1];
                    },
                    get projectedEarnings() {
                        const efficiencyRatio = this.selectedPlan.earnings / this.selectedPlan.price;
                        const daily = this.investmentAmount * efficiencyRatio;
                        const monthly = daily * 30.4;
                        
                        const durationMatch = this.selectedPlan.duration.match(/(\d+)/);
                        const months = durationMatch ? parseInt(durationMatch[1]) : 0;
                        const total = daily * months * 30.4;

                        return {
                            daily: daily.toFixed(2),
                            monthly: monthly.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0}),
                            total: total.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})
                        }
                    }
                }">
                    <div class="bg-black bg-opacity-20 border border-white/10 rounded-3xl p-8 lg:p-12">
                        <div class="grid lg:grid-cols-2 gap-12">
                            
                            <div class="space-y-8">
                                <div>
                                    <label for="investment-amount" class="text-lg font-bold text-white">Investment Amount</label>
                                    <p class="text-sm text-gray-400 mb-4">Slide to select your desired investment capital.</p>
                                    <div class="text-4xl font-bold text-gradient mb-4" x-text="`$${parseInt(investmentAmount).toLocaleString()}`"></div>
                                    <input type="range" id="investment-amount" x-model.number="investmentAmount" min="5000" max="1000000" step="1000" class="w-full h-2 bg-white/10 rounded-lg appearance-none cursor-pointer">
                                </div>
                                <div>
                                    <label for="plan-select" class="text-lg font-bold text-white">Reference Plan</label>
                                    <p class="text-sm text-gray-400 mb-4">Select a plan to calculate earnings based on its efficiency.</p>
                                    <select id="plan-select" x-model="selectedPlanName" class="w-full p-4 bg-white/5 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        <template x-for="plan in plans" :key="plan.name">
                                            <option class="bg-gray-800 text-white" x-text="plan.name"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                                <h3 class="text-2xl font-bold text-white mb-6">Your Projected Earnings</h3>
                                <div class="space-y-6">
                                    <div class="bg-gray-900/50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-400">Estimated Daily Earnings</p>
                                        <p class="text-3xl font-bold text-white" x-text="`$${projectedEarnings.daily}`"></p>
                                    </div>
                                    <div class="bg-gray-900/50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-400">Estimated Monthly Earnings</p>
                                        <p class="text-3xl font-bold text-white" x-text="`$${projectedEarnings.monthly}`"></p>
                                    </div>
                                    <div class="bg-gray-900/50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-400" x-text="`Projected Total Return (in ${selectedPlan.duration})`"></p>
                                        <p class="text-3xl font-bold text-green-400" x-text="`$${projectedEarnings.total}`"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="py-24 px-6 lg:px-8 bg-black bg-opacity-20">
                <div class="max-w-7xl mx-auto" x-data="{
            plans: [
                { name: 'Professional Plan', price: 5000, hashPower: '50 TH/s', earnings: 25, duration: '12 Months', withdrawalLimit: 'Weekly', featured: false, tier: 'pro' },
                { name: 'Elite Plan', price: 25000, hashPower: '260 TH/s', earnings: 135, duration: '18 Months', withdrawalLimit: 'Every 3 Days', featured: true, tier: 'pro' },
                { name: 'Apex Plan', price: 100000, hashPower: '1.1 PH/s', earnings: 550, duration: '24 Months', withdrawalLimit: 'Daily', featured: false, tier: 'elite' },
                { name: 'Sovereign Plan', price: 500000, hashPower: '5.8 PH/s', earnings: 2900, duration: '24 Months', withdrawalLimit: 'Daily Priority', featured: false, tier: 'elite' }, 
                { name: 'Institutional Plan', price: 1000000, hashPower: '12 PH/s', earnings: 6200, duration: '36 Months', withdrawalLimit: 'Dedicated OTC', featured: false, tier: 'institutional' }
            ],
            activeTab: 'all',
            getFilteredPlans() {
                if (this.activeTab === 'all') return this.plans;
                return this.plans.filter(p => p.tier === this.activeTab);
            },
            calculateTotalReturn(price, dailyEarning, duration) {
                const durationMatch = duration.match(/(\d+)\s*(Month|Months)/i);
                if (!durationMatch) return { total: 'Custom', roi: 'Custom' };
                const months = parseInt(durationMatch[1]);
                const days = months * 30.4; // More accurate approximation
                const totalEarnings = dailyEarning * days;
                const roi = ((totalEarnings / price) * 100).toFixed(1);
                return {
                    total: totalEarnings.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0}),
                    roi: roi
                };
            }
        }">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Institutional-Grade <span class="text-gradient">Investment Tiers</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    Choose from a range of professionally managed packages designed for serious investors seeking significant growth in the digital asset space.
                </p>
            </div>

            <div class="flex flex-wrap justify-center items-center mb-12 space-x-2 sm:space-x-4">
                <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'" class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2">All Tiers</button>
                <button @click="activeTab = 'pro'" :class="activeTab === 'pro' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'" class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2">Professional</button>
                <button @click="activeTab = 'elite'" :class="activeTab === 'elite' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'" class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2">Elite</button>
                <button @click="activeTab = 'institutional'" :class="activeTab === 'institutional' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'" class="px-5 py-2 rounded-full font-semibold transition duration-300 mb-2">Institutional</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="plan in getFilteredPlans()" :key="plan.name">
                    <div class="relative h-full">
                        <div x-show="plan.featured" class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-1.5 rounded-full text-sm font-bold shadow-lg">Most Popular</div>

                        <div :class="plan.featured ? 'border-orange-400/50 scale-105 bg-gray-900' : 'border-white/10'" class="bg-white/5 border rounded-3xl p-6 flex flex-col h-full transition-all duration-300 hover:border-orange-400/50 hover:scale-105">
                            <div class="flex-grow">
                                <h3 class="text-xl font-bold text-white" x-text="plan.name"></h3>
                                <div class="mt-4 flex items-baseline">
                                    <span class="text-4xl font-extrabold tracking-tight text-white" x-text="`$${plan.price.toLocaleString()}`"></span>
                                </div>
                                
                                <ul class="my-6 space-y-3 text-sm">
                                    <li class="flex items-center text-gray-300"><svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>Hash Power: <span class="font-semibold ml-1" x-text="plan.hashPower"></span></li>
                                    <li class="flex items-center text-gray-300"><svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>Daily Earnings: <span class="font-semibold ml-1" x-text="`$${plan.earnings}`"></span></li>
                                    <li class="flex items-center text-gray-300"><svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>Duration: <span class="font-semibold ml-1" x-text="plan.duration"></span></li>
                                    <li class="flex items-center text-gray-300"><svg class="w-5 h-5 mr-2 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M7 7l-3 3"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 20v-5h-5M17 17l3-3"></path></svg>Withdrawal: <span class="font-semibold ml-1" x-text="plan.withdrawalLimit"></span></li>
                                </ul>

                                <div class="pt-4 border-t border-white/10 space-y-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-400">Est. Total Return</span>
                                        <span class="font-bold text-white" x-text="`$${calculateTotalReturn(plan.price, plan.earnings, plan.duration).total}`"></span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-400">Est. Return on Investment</span>
                                        <span class="font-bold text-green-400" x-text="`${calculateTotalReturn(plan.price, plan.earnings, plan.duration).roi}%`"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button class="w-full py-3 px-4 rounded-lg font-semibold transition-colors duration-300 bg-gradient-to-r from-orange-500 to-yellow-500 text-white hover:scale-105">
                                    Select Plan
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

        </div>
        </section>

        <section class="py-24 px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                     <h2 class="text-3xl lg:text-4xl font-bold text-white">Feature-by-Feature Comparison</h2>
                     <p class="mt-4 text-lg text-gray-400">A detailed look at what each investment tier offers.</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-3xl p-2 sm:p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[800px]">
                            <thead>
                                <tr class="border-b border-white/10 text-left">
                                    <th class="py-4 px-4 font-medium text-gray-300">Feature</th>
                                    <th class="py-4 px-4 font-semibold text-white text-center">Professional</th>
                                    <th class="py-4 px-4 font-semibold text-orange-400 text-center">Elite</th>
                                    <th class="py-4 px-4 font-semibold text-white text-center">Apex</th>
                                    <th class="py-4 px-4 font-semibold text-purple-400 text-center">Institutional</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="border-b border-white/5"><td class="py-3 px-4 text-gray-300">Price Point</td><td class="py-3 px-4 text-center text-white">$5,000</td><td class="py-3 px-4 text-center text-white">$25,000</td><td class="py-3 px-4 text-center text-white">$100,000</td><td class="py-3 px-4 text-center text-white">$1,000,000+</td></tr>
                                <tr class="border-b border-white/5"><td class="py-3 px-4 text-gray-300">Hardware Allocation</td><td class="py-3 px-4 text-center text-white">Shared Pool</td><td class="py-3 px-4 text-center text-white">Priority Pool</td><td class="py-3 px-4 text-center text-white">Dedicated Rig</td><td class="py-3 px-4 text-center text-white">Custom Array</td></tr>
                                <tr class="border-b border-white/5"><td class="py-3 px-4 text-gray-300">Support Level</td><td class="py-3 px-4 text-center text-white">24/7 Email</td><td class="py-3 px-4 text-center text-white">Priority Chat</td><td class="py-3 px-4 text-center text-white">Dedicated Manager</td><td class="py-3 px-4 text-center text-white">Dedicated Team</td></tr>
                                <tr class="border-b border-white/5"><td class="py-3 px-4 text-gray-300">Advanced Analytics</td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></td></tr>
                                <tr><td class="py-3 px-4 text-gray-300">OTC Desk Access</td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></td><td class="py-3 px-4 text-center"><svg class="w-6 h-6 inline-block text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 lg:px-8">
            <div class="max-w-4xl mx-auto" x-data="{ openFaq: 1 }">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white">Your Questions, Answered</h2>
                    <p class="mt-4 text-lg text-gray-400">Everything you need to know about our investment plans.</p>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                        <button @click="openFaq = (openFaq === 1 ? null : 1)" class="w-full flex items-center justify-between text-left p-6">
                            <span class="text-lg font-semibold text-white">Are the returns on my investment guaranteed?</span>
                            <svg x-show="openFaq !== 1" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                        <div x-show="openFaq === 1" x-collapse class="px-6 pb-6"><p class="text-gray-400">While our earnings are based on stable, predictable models, no investment in the crypto market can be guaranteed. The "Estimated Total Return" is a projection based on the plan's hash power and historical network data. All investments carry risk, which we outline in our Risk Disclosure.</p></div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                         <button @click="openFaq = (openFaq === 2 ? null : 2)" class="w-full flex items-center justify-between text-left p-6">
                            <span class="text-lg font-semibold text-white">Can I upgrade my plan later?</span>
                            <svg x-show="openFaq !== 2" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                         </button>
                        <div x-show="openFaq === 2" x-collapse class="px-6 pb-6"><p class="text-gray-400">Yes, you can upgrade your plan at any time. You can choose to either reinvest your current earnings into a higher tier or make a new deposit. Please contact your account manager or our support team to facilitate a seamless upgrade.</p></div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection