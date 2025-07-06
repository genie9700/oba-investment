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
            <livewire:landing.pricing-section />
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