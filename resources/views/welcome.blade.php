@extends('layouts.guest')

@section('content')
    

    <!-- hero section -->
    <section class="relative z-10 px-6 pb-20 pt-32">
        <div class="absolute inset-0 crypto-grid opacity-30"></div>
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center space-x-3 bg-white/5 backdrop-blur-sm border border-white/10 rounded-full px-4 py-2 fade-in">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-gray-300 text-sm">BTC/USD</span>
                        <span class="text-white font-semibold" id="btc-price">$67,432.50</span>
                        <span class="text-green-400 text-sm" id="btc-change">+3.24%</span>
                    </div>

                    <div class="space-y-4">
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold leading-[0.85] tracking-tight text-white slide-up"
                            style="animation-delay: 0.2s">
                            Unlock the
                            <br>
                            <span class="text-gradient">Future</span>
                            of Wealth
                        </h1>
                        <p class="text-xl text-gray-300 leading-relaxed slide-up" style="animation-delay: 0.4s">
                            Dive into the world of cryptocurrency and watch your investment soar with an incredible 
                            potential for 900% profit! Start your journey today with just $5,000.

                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 slide-up" style="animation-delay: 0.6s">
                        <button
                            class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-orange-600 hover:to-yellow-600 transition-all transform hover:scale-105 shadow-2xl">
                            Start Investing Now
                        </button>
                        <button
                            class="border-2 border-white/20 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white/10 transition-all backdrop-blur-sm">
                            Watch Demo
                        </button>
                    </div>

                    <div class="flex items-center space-x-8 slide-up" style="animation-delay: 0.8s">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white" id="users-count">2.5M+</div>
                            <div class="text-sm text-gray-400">Active Users</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">$12B+</div>
                            <div class="text-sm text-gray-400">Assets Managed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">98.5%</div>
                            <div class="text-sm text-gray-400">Uptime</div>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center justify-center">
                    <div class="relative">
                        <div
                            class="w-72 h-72 bg-gradient-to-br from-orange-400 to-yellow-500 rounded-full flex items-center justify-center bitcoin-glow floating">
                            <span class="text-white text-8xl font-bold">₿</span>

                            <div class="absolute inset-0">
                                <div class="orbit-1 absolute w-4 h-4 bg-blue-400 rounded-full"
                                    style="animation: orbit 10s linear infinite;"></div>
                                <div class="orbit-2 absolute w-3 h-3 bg-green-400 rounded-full"
                                    style="animation: orbit 15s linear infinite reverse;"></div>
                                <div class="orbit-3 absolute w-5 h-5 bg-purple-400 rounded-full"
                                    style="animation: orbit 12s linear infinite;"></div>
                            </div>
                        </div>

                        <div
                            class="absolute inset-0 w-80 h-80 bg-gradient-to-br from-orange-400/30 to-yellow-500/30 rounded-full blur-3xl -z-10">
                        </div>
                    </div>

                    <div class="absolute top-10 -left-10 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-4 floating"
                        style="animation-delay: -2s">
                        <div class="text-green-400 text-sm font-semibold">24h Volume</div>
                        <div class="text-white text-lg font-bold">$28.5B</div>
                    </div>

                    <div class="absolute bottom-10 -right-5 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-4 floating"
                        style="animation-delay: -4s">
                        <div class="text-orange-400 text-sm font-semibold">Market Cap</div>
                        <div class="text-white text-lg font-bold">$1.32T</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- trust bar section -->
    <section class="relative z-10 py-16 bg-black bg-opacity-20 backdrop-blur-sm border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 text-center">

                <div class="flex flex-col items-center">
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl mb-4">
                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Bank-Grade Security</h3>
                    <p class="text-gray-400">Offline cold storage & FDIC insurance on USD.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl mb-4">
                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Transparent Fees</h3>
                    <p class="text-gray-400">Keep more of your profits with our clear pricing.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl mb-4">
                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">2.5M+ Investors</h3>
                    <p class="text-gray-400">Join a thriving community of digital wealth builders.</p>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl mb-4">
                        <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">24/7 Expert Support</h3>
                    <p class="text-gray-400">Our global team is always available to assist you.</p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- features and benefits -->
    <section class="relative z-10 py-24 px-6 lg:px-8 overflow-hidden">
        <div class="max-w-7xl mx-auto">
    
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    The Platform for <span class="text-gradient">Serious Investors</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    {{ config('app.name') }} provides the institutional-grade tools and unwavering security you need to build and manage
                    your digital wealth with confidence.
                </p>
            </div>
    
            <div class="relative group transition-all duration-300 hover:scale-[1.02] mb-20">
                <div
                    class="hidden lg:block absolute -top-1/4 -left-20 w-96 h-96 bg-gradient-to-r from-orange-500/5 to-yellow-500/5 rounded-full blur-3xl -z-10">
                </div>
                <div
                    class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center p-8 border border-white/10 group-hover:border-white/20 rounded-3xl transition-colors duration-300">
                    <div class="text-center">
                        <div class="inline-block p-8 bg-white/5 border border-white/10 rounded-3xl">
                            <svg class="w-24 h-24 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6">Invest with Absolute Peace of Mind</h3>
                        <p class="text-lg text-gray-400 leading-relaxed mb-6">
                            Your assets are protected by multi-layered, bank-grade security. 98% of funds are held in
                            offline cold storage, and your account is insured up to $250,000.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">FDIC Insured up to $250,000</span>
                            </li>
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">Military-Grade 256-bit Encryption</span>
                            </li>
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">Multi-Signature Cold Storage Wallets</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="relative group transition-all duration-300 hover:scale-[1.02] mb-20">
                <div
                    class="hidden lg:block absolute -top-1/4 -right-20 w-96 h-96 bg-gradient-to-l from-orange-500/5 to-yellow-500/5 rounded-full blur-3xl -z-10">
                </div>
                <div
                    class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center p-8 border border-white/10 group-hover:border-white/20 rounded-3xl transition-colors duration-300">
                    <div class="lg:order-last">
                        <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6">Keep More of What You Earn</h3>
                        <p class="text-lg text-gray-400 leading-relaxed mb-6">
                            Our transparent, low-fee structure means more of your money stays in your portfolio, working for
                            you. No hidden costs, no surprise charges.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">Industry-leading low trading fees</span>
                            </li>
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">$0 for deposits and withdrawals</span>
                            </li>
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">No monthly account fees</span>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center lg:order-first">
                        <div class="inline-block p-8 bg-white/5 border border-white/10 rounded-3xl">
                            <svg class="w-24 h-24 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1h4a1 1 0 011 1v10a1 1 0 01-1 1h-4v-1m-4-8H5v10h2m-2 0h-1a1 1 0 01-1-1V7a1 1 0 011-1h1m0 10V7m0 10a1 1 0 001-1V7a1 1 0 00-1-1h-1m0 10h1m-1-1V7m1 10v-1m0-1v-1m0-1V9m0 2v1m0-1V7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="relative group transition-all duration-300 hover:scale-[1.02] mb-20">
                <div
                    class="hidden lg:block absolute -top-1/4 -left-20 w-96 h-96 bg-gradient-to-r from-orange-500/5 to-yellow-500/5 rounded-full blur-3xl -z-10">
                </div>
                <div
                    class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center p-8 border border-white/10 group-hover:border-white/20 rounded-3xl transition-colors duration-300">
                    <div class="text-center">
                        <div class="inline-block p-8 bg-white/5 border border-white/10 rounded-3xl">
                            <svg class="w-24 h-24 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 4v5h5M20 20v-5h-5M4 20h5v-5M20 4h-5v5"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15a3 3 0 100-6 3 3 0 000 6z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6">Put Your Growth on Autopilot</h3>
                        <p class="text-lg text-gray-400 leading-relaxed mb-6">
                            Effortlessly build your portfolio over time with our Auto-Invest feature. Set up recurring buys
                            daily, weekly, or monthly and take advantage of dollar-cost averaging.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">Set recurring buys from as little as $10</span>
                            </li>
                            <li class="flex items-center">
                                <div
                                    class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300">Automate your investment strategy</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="grid lg:grid-cols-2 gap-8">
                <div
                    class="relative group transition-all duration-300 hover:scale-[1.02] p-8 border border-white/10 group-hover:border-white/20 rounded-3xl">
                    <div class="flex items-start space-x-6">
                        <div class="p-4 bg-white/5 border border-white/10 rounded-xl">
                            <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Your Portfolio, in Your Pocket</h3>
                            <p class="text-gray-400">Manage your investments on the go with our secure and intuitive mobile
                                app for iOS and Android.</p>
                        </div>
                    </div>
                </div>
                <div
                    class="relative group transition-all duration-300 hover:scale-[1.02] p-8 border border-white/10 group-hover:border-white/20 rounded-3xl">
                    <div class="flex items-start space-x-6">
                        <div class="p-4 bg-white/5 border border-white/10 rounded-xl">
                            <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Expert Help, Whenever You Need It</h3>
                            <p class="text-gray-400">Our global support team is available 24/7 via chat, email, or phone to
                                assist you with any questions.</p>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </section>

    <!-- how it works -->
    <section class="relative z-10 py-24 px-6 lg:px-8 bg-black bg-opacity-20">
        <div class="max-w-7xl mx-auto">
    
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Start in <span class="text-gradient">3 Simple Steps</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    Getting started with your Bitcoin portfolio is faster and easier than you think. Follow this clear path to begin your investment journey.
                </p>
            </div>
    
            <div class="grid md:grid-cols-3 gap-x-12 gap-y-20">
    
                <div class="relative text-center">
                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 text-[10rem] font-black text-white/5 -z-10">01</div>
                    
                    <div class="relative group transition-all duration-300 hover:scale-105 bg-white/5 border border-white/10 hover:border-white/20 rounded-3xl p-8 h-full">
                        <div class="inline-block p-5 bg-gradient-to-br from-orange-500 to-yellow-500 rounded-2xl mb-6 bitcoin-glow group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Create Your Account</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Sign up in under two minutes. All you need is an email and a password to get started.
                        </p>
                    </div>
    
                    <div class="hidden md:block absolute top-1/2 -right-12 w-24 h-px bg-white/10 border-b border-dashed border-white/20"></div>
                </div>
    
                <div class="relative text-center">
                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 text-[10rem] font-black text-white/5 -z-10">02</div>
    
                    <div class="relative group transition-all duration-300 hover:scale-105 bg-white/5 border border-white/10 hover:border-white/20 rounded-3xl p-8 h-full">
                        <div class="inline-block p-5 bg-gradient-to-br from-orange-500 to-yellow-500 rounded-2xl mb-6 bitcoin-glow group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Link & Deposit Funds</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Securely connect your bank account and deposit funds. Start with as little as $1.
                        </p>
                    </div>
    
                    <div class="hidden md:block absolute top-1/2 -right-12 w-24 h-px bg-white/10 border-b border-dashed border-white/20"></div>
                </div>
    
                <div class="relative text-center">
                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 text-[10rem] font-black text-white/5 -z-10">03</div>
    
                    <div class="relative group transition-all duration-300 hover:scale-105 bg-white/5 border border-white/10 hover:border-white/20 rounded-3xl p-8 h-full">
                        <div class="inline-block p-5 bg-gradient-to-br from-orange-500 to-yellow-500 rounded-2xl mb-6 bitcoin-glow group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Buy Bitcoin & Grow</h3>
                        <p class="text-gray-400 leading-relaxed">
                           Purchase Bitcoin instantly and track your portfolio's growth with our powerful analytics tools.
                        </p>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

    <!-- real-time Dashboard preview -->
    <section class="relative z-10 py-24 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
    
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Your Command Center for <span class="text-gradient">Digital Wealth</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    Experience an intuitive, powerful, and clean interface designed to give you full control over your investment portfolio.
                </p>
            </div>
    
            <div class="max-w-6xl mx-auto">
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl shadow-orange-500/5">
                    
                    <div class="h-14 flex items-center justify-between px-4 sm:px-6 border-b border-white/10">
                        <div class="flex items-center space-x-2">
                            <div class="w-3.5 h-3.5 bg-red-500 rounded-full"></div>
                            <div class="w-3.5 h-3.5 bg-yellow-500 rounded-full"></div>
                            <div class="w-3.5 h-3.5 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="hidden sm:block text-gray-400 text-xs sm:text-sm">app.{{ config('app.name') }}.com/dashboard</div>
                        <div class="w-12 sm:w-16"></div> </div>
    
                    <div class="grid lg:grid-cols-12 gap-6 md:gap-8 p-4 sm:p-6 md:p-8">
                        
                        <div class="lg:col-span-8 space-y-6 md:space-y-8">
                            <div>
                                <p class="text-gray-400 mb-2">Portfolio Value</p>
                                <div class="flex items-baseline space-x-3 sm:space-x-4">
                                   <h3 class="text-4xl sm:text-5xl font-bold text-white">$117,492.50</h3>
                                   <p class="text-lg sm:text-xl font-semibold text-green-400">+4.12%</p>
                                </div>
                            </div>
    
                            <div class="h-60 sm:h-80 w-full">
                                <svg viewBox="0 0 400 150" class="w-full h-full" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" style="stop-color:#f79318; stop-opacity:0.3" />
                                            <stop offset="100%" style="stop-color:#f79318; stop-opacity:0" />
                                        </linearGradient>
                                    </defs>
                                    <path d="M0,100 C20,80 40,75 60,90 S100,120 140,100 S180,60 220,70 S260,110 300,90 S340,50 380,60 L400,50" fill="none" stroke="#f79318" stroke-width="2.5" />
                                    <path d="M0,100 C20,80 40,75 60,90 S100,120 140,100 S180,60 220,70 S260,110 300,90 S340,50 380,60 L400,50 V150 H0 Z" fill="url(#chartGradient)" />
                                </svg>
                            </div>
    
                            <div>
                                <h4 class="text-xl font-bold text-white mb-4">My Investment Packages</h4>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-3 sm:p-4 bg-white/5 rounded-lg">
                                        <div class="flex items-center space-x-3 sm:space-x-4">
                                            <div class="p-2 bg-blue-500/10 rounded-lg flex-shrink-0">
                                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-4l-6 6l-6-6"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-white text-sm sm:text-base">Core Portfolio</p>
                                                <p class="text-xs sm:text-sm text-gray-400">Conservative Growth</p>
                                            </div>
                                        </div>
                                        <div class="text-right flex-shrink-0 pl-2">
                                            <p class="font-bold text-white text-sm sm:text-base">$85,210.00</p>
                                            <p class="text-xs sm:text-sm text-green-400">+8.2% All Time</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-3 sm:p-4 bg-white/5 rounded-lg">
                                        <div class="flex items-center space-x-3 sm:space-x-4">
                                            <div class="p-2 bg-purple-500/10 rounded-lg flex-shrink-0">
                                                 <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-white text-sm sm:text-base">Growth Portfolio</p>
                                                <p class="text-sm text-gray-400">Aggressive Growth</p>
                                            </div>
                                        </div>
                                        <div class="text-right flex-shrink-0 pl-2">
                                            <p class="font-bold text-white text-sm sm:text-base">$32,282.50</p>
                                            <p class="text-xs sm:text-sm text-green-400">+21.5% All Time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="lg:col-span-4 space-y-6 md:space-y-8">
                            <div class="bg-white/5 rounded-lg p-6">
                                <h4 class="text-xl font-bold text-white mb-6">Quick Actions</h4>
                                <div class="space-y-4">
                                    <button class="w-full text-center py-3 bg-gradient-to-r from-orange-500 to-yellow-500 text-white font-bold rounded-lg hover:scale-105 transition-transform">Buy / Deposit</button>
                                    <button class="w-full text-center py-3 bg-white/10 text-white font-bold rounded-lg hover:bg-white/20 transition-colors">Withdraw</button>
                                </div>
                            </div>
                            
                            <div class="bg-white/5 rounded-lg p-6">
                                <h4 class="text-xl font-bold text-white mb-6">Recent Activity</h4>
                                <div class="space-y-5">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="font-semibold text-white text-sm sm:text-base">'Core Portfolio' Top-up</p>
                                            <p class="text-xs sm:text-sm text-gray-400">June 25, 2025</p>
                                        </div>
                                        <p class="font-mono text-green-400 text-sm sm:text-base">+$2,500</p>
                                    </div>
                                     <div class="flex items-start justify-between">
                                        <div>
                                            <p class="font-semibold text-white text-sm sm:text-base">USD Deposit</p>
                                            <p class="text-xs sm:text-sm text-gray-400">June 24, 2025</p>
                                        </div>
                                        <p class="font-mono text-green-400 text-sm sm:text-base">+$10,000</p>
                                    </div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="font-semibold text-white text-sm sm:text-base">'Growth Portfolio' Purchase</p>
                                            <p class="text-xs sm:text-sm text-gray-400">June 23, 2025</p>
                                        </div>
                                        <p class="font-mono text-green-400 text-sm sm:text-base">+$7,500</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- security and trust section -->
    <section class="relative z-10 py-24 px-6 lg:px-8 bg-black bg-opacity-20">
        <div class="max-w-7xl mx-auto">
    
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    A Fortress for Your <span class="text-gradient">Digital Assets</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    Your security is the bedrock of our platform. We've engineered a multi-layered defense system to ensure your funds and data are protected at all times.
                </p>
            </div>
    
            <div class="grid md:grid-cols-3 gap-8 mb-20 text-center">
                
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                    <div class="inline-block p-5 bg-white/5 rounded-2xl mb-6">
                        <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Asset Security</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Industry-leading custody and insurance solutions mean your funds are protected against theft. USD balances are held with FDIC-insured partners.
                    </p>
                </div>
    
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                    <div class="inline-block p-5 bg-white/5 rounded-2xl mb-6">
                        <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Platform Security</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Your data is safeguarded with AES-256 encryption. We enforce 2FA and other proactive measures to prevent unauthorized account access.
                    </p>
                </div>
    
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                    <div class="inline-block p-5 bg-white/5 rounded-2xl mb-6">
                        <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Regulatory Compliance</h3>
                    <p class="text-gray-400 leading-relaxed">
                        We adhere to strict regulatory standards, including KYC and AML compliance, and partner with leading auditors to ensure platform integrity.
                    </p>
                </div>
            </div>
    
            <div class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-x-8 gap-y-6">
                
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-gray-300">98% Cold Storage of Crypto Assets</span>
                </div>
    
                 <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-gray-300">FDIC Insurance on USD Balances</span>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-gray-300">Two-Factor Authentication (2FA)</span>
                </div>
    
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-gray-300">SSL Encrypted Connections</span>
                </div>
    
                 <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-gray-300">Biometric & Passcode Access</span>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-5 h-5 flex-shrink-0 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="text-gray-300">Regular 3rd-Party Security Audits</span>
                </div>
    
            </div>
    
        </div>
    </section>

    <!-- testimonials section -->
    <section class="relative z-10 py-24 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
    
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Trusted by Investors <span class="text-gradient">Like You</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    We're proud to be the platform of choice for thousands of investors. Here’s what some of them have to say about their experience with {{ config('app.name') }}.
                </p>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-8">
    
                <div class="group bg-white/5 border border-white/10 rounded-2xl p-8 transition-all duration-300 hover:scale-105 hover:border-orange-400/50">
                    <div class="flex items-center mb-6">
                        <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=2576&auto=format&fit=crop" alt="Photo of Sarah L., a corporate lawyer.">
                        <div class="ml-4">
                            <p class="font-bold text-white text-lg">Sarah L.</p>
                            <p class="text-gray-400">Corporate Lawyer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <blockquote class="text-white text-lg leading-relaxed">"As someone who values security above all else, {{ config('app.name') }} was the clear choice. The setup was surprisingly simple, and their transparency regarding cold storage and insurance gave me the confidence to finally step into crypto investing."</blockquote>
                </div>
    
                <div class="group bg-white/5 border border-white/10 rounded-2xl p-8 transition-all duration-300 hover:scale-105 hover:border-orange-400/50">
                    <div class="flex items-center mb-6">
                        <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1557862921-37829c790f19?q=80&w=2671&auto=format&fit=crop" alt="Photo of David C., a software developer.">
                        <div class="ml-4">
                            <p class="font-bold text-white text-lg">David C.</p>
                            <p class="text-gray-400">Software Developer</p>
                        </div>
                    </div>
                     <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <blockquote class="text-white text-lg leading-relaxed">"I've tried other exchanges, but the analytics tools on {{ config('app.name') }} are on another level. The dashboard is clean, fast, and gives me all the data I need to make informed decisions. The low fees are a huge bonus."</blockquote>
                </div>
    
                <div class="group bg-white/5 border border-white/10 rounded-2xl p-8 transition-all duration-300 hover:scale-105 hover:border-orange-400/50">
                    <div class="flex items-center mb-6">
                        <img class="h-16 w-16 rounded-full object-cover" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=2561&auto=format&fit=crop" alt="Photo of Maria G., a retiree.">
                        <div class="ml-4">
                            <p class="font-bold text-white text-lg">Maria G.</p>
                            <p class="text-gray-400">Retiree & Investor</p>
                        </div>
                    </div>
                     <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <blockquote class="text-white text-lg leading-relaxed">"The 'Auto-Invest' feature has been a game-changer for my retirement strategy. I set it up once, and now I'm consistently building my Bitcoin position without any stress. It's the perfect 'set it and forget it' tool."</blockquote>
                </div>
    
            </div>
        </div>
    </section>

    <!-- about us -->
    <section class="relative z-10 py-24 px-6 lg:px-8 bg-black bg-opacity-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <div class="space-y-8">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white">
                        Built on a Foundation of <span class="text-gradient">Trust & Transparency</span>
                    </h2>
                    <p class="text-xl text-gray-300 leading-relaxed">
                        {{ config('app.name') }} Investment was founded by a team of veteran financial analysts and blockchain engineers who saw a critical need for a secure, transparent, and user-focused platform in the digital asset space.
                    </p>
                    <p class="text-gray-400 leading-relaxed">
                        Frustrated by the complexity and insecurity of existing solutions, we set out to build a platform that we would use ourselves—one that pairs institutional-grade security with powerful, intuitive tools for everyone from seasoned professionals to new investors. Our mission is to democratize access to digital wealth building.
                    </p>
                    <div>
                        <a href="#" class="inline-block bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform">
                            Learn More About Us
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 md:gap-6">
                    
                    <div class="text-center group">
                        <div class="relative inline-block">
                            <img class="h-40 w-40 md:w-48 md:h-48 rounded-2xl object-cover" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=2574&auto=format&fit=crop" alt="Portrait of James Carter, CEO & Founder">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-2xl"></div>
                            <div class="absolute bottom-4 left-4 text-left">
                                <p class="font-bold text-white">James Carter</p>
                                <p class="text-sm text-orange-400">CEO & Founder</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center group mt-12">
                        <div class="relative inline-block">
                            <img class="h-40 w-40 md:w-48 md:h-48 rounded-2xl object-cover" src="https://images.unsplash.com/photo-1488229297570-58520851e868?q=80&w=2669&auto=format&fit=crop" alt="Portrait of Anya Sharma, Chief Technology Officer">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-2xl"></div>
                            <div class="absolute bottom-4 left-4 text-left">
                                <p class="font-bold text-white">Anya Sharma</p>
                                <p class="text-sm text-orange-400">Chief Technology Officer</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center group">
                        <div class="relative inline-block">
                            <img class="h-40 w-40 md:w-48 md:h-48 rounded-2xl object-cover" src="https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=2670&auto=format&fit=crop" alt="Portrait of Marcus Thorne, Head of Security">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-2xl"></div>
                            <div class="absolute bottom-4 left-4 text-left">
                                <p class="font-bold text-white">Marcus Thorne</p>
                                <p class="text-sm text-orange-400">Head of Security</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center group mt-12">
                        <div class="relative inline-block">
                            <img class="h-40 w-40 md:w-48 md:h-48 rounded-2xl object-cover" src="https://images.unsplash.com/photo-1541709440582-8f682639a445?q=80&w=2584&auto=format&fit=crop" alt="Portrait of Elena Petrova, Head of Investor Relations">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-2xl"></div>
                            <div class="absolute bottom-4 left-4 text-left">
                                <p class="font-bold text-white">Elena Petrova</p>
                                <p class="text-sm text-orange-400">Investor Relations</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- pricing section -->
    <section class="relative z-10 py-24 px-6 lg:px-8">
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
                                        <span class="font-bold text-white" x-text="`${calculateTotalReturn(plan.price, plan.earnings, plan.duration).total}`"></span>
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

    <!-- FAQ -->
    <section class="relative z-10 py-24 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Frequently Asked <span class="text-gradient">Questions</span>
                </h2>
                <p class="text-xl text-gray-400 leading-relaxed">
                    Have questions? We've got answers. If you can't find what you're looking for, feel free to contact our 24/7 support team.
                </p>
            </div>

            <div class="max-w-4xl mx-auto" x-data="{ openFaq: 1 }">
                <div class="space-y-4">

                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                        <button @click="openFaq = (openFaq === 1 ? null : 1)" class="w-full flex items-center justify-between text-left p-6">
                            <span class="text-lg font-semibold text-white">Is my investment secure with {{ config('app.name') }}?</span>
                            <svg x-show="openFaq === 1" class="w-6 h-6 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            <svg x-show="openFaq !== 1" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                        <div x-show="openFaq === 1" x-collapse class="px-6 pb-6">
                            <p class="text-gray-400 leading-relaxed">
                                Absolutely. Security is our highest priority. 98% of all crypto assets are held in offline cold storage wallets, protected from online threats. Furthermore, any USD balances you hold are FDIC-insured up to $250,000. Our platform also uses bank-grade encryption and requires 2FA for all sensitive actions.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                        <button @click="openFaq = (openFaq === 2 ? null : 2)" class="w-full flex items-center justify-between text-left p-6">
                            <span class="text-lg font-semibold text-white">How are the "Daily Earnings" calculated?</span>
                            <svg x-show="openFaq === 2" class="w-6 h-6 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            <svg x-show="openFaq !== 2" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                        <div x-show="openFaq === 2" x-collapse class="px-6 pb-6">
                            <p class="text-gray-400 leading-relaxed">
                                The daily earnings for each plan are determined by the allocated hash power, the current Bitcoin network difficulty, and block rewards. Our system calculates the most efficient mining strategy to generate a stable and predictable daily return, which is then credited to your {{ config('app.name') }} account.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                        <button @click="openFaq = (openFaq === 3 ? null : 3)" class="w-full flex items-center justify-between text-left p-6">
                            <span class="text-lg font-semibold text-white">Can I withdraw my money at any time?</span>
                            <svg x-show="openFaq === 3" class="w-6 h-6 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            <svg x-show="openFaq !== 3" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                        <div x-show="openFaq === 3" x-collapse class="px-6 pb-6">
                            <p class="text-gray-400 leading-relaxed">
                                Yes. You can withdraw your earnings according to the withdrawal limit specified in your chosen plan (e.g., "Once in 7 days"). The initial investment is tied to the duration of the plan to secure the hash power. Once the plan duration is complete, your initial capital is returned to your account and can be withdrawn or reinvested.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl">
                        <button @click="openFaq = (openFaq === 4 ? null : 4)" class="w-full flex items-center justify-between text-left p-6">
                            <span class="text-lg font-semibold text-white">What happens at the end of my plan's duration?</span>
                            <svg x-show="openFaq === 4" class="w-6 h-6 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            <svg x-show="openFaq !== 4" class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                        <div x-show="openFaq === 4" x-collapse class="px-6 pb-6">
                            <p class="text-gray-400 leading-relaxed">
                            At the end of your plan's term, your contract is complete. Your initial investment capital is returned to your main {{ config('app.name') }} wallet. From there, you have the complete freedom to withdraw it to your bank account, or reinvest it into a new plan to continue growing your assets.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="relative z-10 py-24 px-6 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center relative">
            <!-- Background Glow -->
            <div class="absolute -top-1/2 -left-1/2 -z-10 w-[100vw] h-[100vw] sm:w-[150vw] sm:h-[150vw] lg:w-[200%] lg:h-[200%] bg-gradient-to-r from-orange-500/10 via-transparent to-transparent rounded-full blur-3xl pointer-events-none"></div>

            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6">
                Ready to Build Your <span class="text-gradient">Digital Future?</span>
            </h2>
            <p class="text-base sm:text-xl text-gray-400 leading-relaxed mb-6 sm:mb-10">
                Join thousands of successful investors on the most secure and transparent platform for digital assets. Your journey to financial sovereignty starts now.
            </p>
            
            <a href="#" class="inline-block w-full sm:w-auto bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 sm:px-12 py-4 sm:py-5 rounded-full text-base sm:text-lg font-bold hover:scale-105 transition-transform shadow-2xl shadow-orange-500/20">
                Start Investing in 2 Minutes
            </a>

            <p class="text-gray-500 text-xs sm:text-sm mt-4 sm:mt-6">
                No lengthy paperwork • Bank-grade security • 24/7 support
            </p>
        </div>
    </section>

@endsection

