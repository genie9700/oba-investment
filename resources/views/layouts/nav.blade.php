 <nav class="fixed top-0 w-full z-50 bg-gray-900/80 backdrop-blur-2xl border-b border-orange-500/20"
        x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/cryptane-logo.png') }}" alt="logo" class="w-40">
                    </a>
                </div>

                <div class="hidden lg:flex items-center space-x-12">
                    <a href="{{ route('invest') }}"
                        class="text-gray-300 hover:text-orange-400 transition-all duration-300 font-medium text-lg relative group">
                        Invest
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('about') }}"
                        class="text-gray-300 hover:text-orange-400 transition-all duration-300 font-medium text-lg relative group">
                        About Us
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('security') }}"
                        class="text-gray-300 hover:text-orange-400 transition-all duration-300 font-medium text-lg relative group">
                        Security
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-300 hover:text-orange-400 transition-all duration-300 font-medium text-lg relative group">
                        Contact
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <div class="hidden lg:flex items-center space-x-4">
                    @auth
                        <a href="{{ route('user.dashboard') }}"
                            class="block px-6 py-3 text-white border-2 border-gray-600 rounded-2xl hover:border-orange-500 hover:text-orange-400 transition-all duration-300 font-semibold">
                            Dashboard
                        </a>
                        <a href="{{ route('logout') }}"
                            class="block bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-2xl font-bold transition-all transform hover:scale-105"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @else
                        
                        <a href="{{ route('login') }}"
                            class="block px-6 py-3 text-white border-2 border-gray-600 rounded-2xl hover:border-orange-500 hover:text-orange-400 transition-all duration-300 font-semibold">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                            class="block bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-2xl font-bold transition-all transform hover:scale-105">
                            Get Started
                        </a>
                    @endauth
                </div>

                <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2 rounded-xl hover:bg-gray-800 transition-colors">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
                class="lg:hidden border-t border-orange-500/20">
                <div class="px-4 py-8 space-y-6">
                    <a href="{{ route('invest') }}" class="block text-gray-300 hover:text-orange-400 font-semibold text-xl py-3">Invest</a>
                    <a href="{{ route('about') }}"
                        class="block text-gray-300 hover:text-orange-400 font-semibold text-xl py-3">About Us</a>
                    <a href="{{ route('security') }}"
                        class="block text-gray-300 hover:text-orange-400 font-semibold text-xl py-3">Security</a>
                    <a href="{{ route('contact') }}" class="block text-gray-300 hover:text-orange-400 font-semibold text-xl py-3">Contact</a>
                    <div class="pt-6 space-y-4 border-t border-orange-500/20">
                        @auth
                            <a href="{{ route('user.dashboard') }}"
                                class="w-full px-6 py-4 text-white border-2 border-gray-600 rounded-2xl font-semibold text-lg">Dashboard</a>
                            <a href="{{ route('logout') }}"
                                class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white font-bold px-8 py-4 rounded-2xl"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full px-6 py-4 text-white border-2 border-gray-600 rounded-2xl font-semibold text-lg">Sign
                                In</a>
                            <a href="{{ route('register') }}"
                                class="w-full px-8 py-4 bg-gradient-to-r from-orange-500 to-yellow-500 text-white font-bold rounded-2xl text-lg">Get
                                Started</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>