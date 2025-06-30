<footer class="relative z-10 pt-24 pb-8 px-6 lg:px-8 bg-black bg-opacity-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-12 gap-y-10 gap-x-8">
                
                <div class="md:col-span-12 lg:col-span-5">
                     <div class="flex items-center space-x-3 mb-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/cryptane-logo.png') }}" alt="logo" class="w-40">
                        </a>
                        {{-- <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-yellow-500 rounded-lg flex items-center justify-center bitcoin-glow">
                            <span class="text-white font-bold text-xl">C</span>
                        </div> --}}
                        {{-- <span class="text-white font-bold text-2xl tracking-tight">{{ config('app.name') }} Investment</span> --}}
                    </div>
                    <p class="text-gray-400 mb-6 max-w-sm">The premier platform for building your digital wealth with confidence and clarity.</p>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:investor@Cryptane-bitcoininvestment.com" class="text-gray-300 hover:text-orange-400 transition-colors">investor@Cryptane-bitcoininvestment.com</a>
                        </div>
                         <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"></path></svg>
                            <a href="mailto:{{ config('app.name') }}bitcoininvestment@gmail.com" class="text-gray-300 hover:text-orange-400 transition-colors">{{ config('app.name') }}bitcoininvestment@gmail.com</a>
                        </div>
                         <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.85 16.215c-1.002.542-5.516 2.763-6.205 2.45-1.127-.502-1.07-1.768-.99-2.458.083-.69.21-1.725.1-2.28-.11-.555-.54-1.137-.9-1.32-.36-.183-.87-.205-1.2-.18-1.5.11-2.1.33-3.3.705-1.2.375-2.1.72-2.7.9-.6.18-1.2.345-1.5.3-1.035-.15-1.335-1.162-.18-1.785 1.155-.623 6.915-3.21 7.515-3.51.6-.3 1.2-.45 1.5-.45.3 0 .6.15.75.3.15.15.225.375.225.6 0 .225-.075.45-.225.675-.15.225-1.125.975-3.375 2.85-2.25 1.875-2.625 2.25-2.775 2.4-.15.15-.3.3-.45.3-.15 0-.3-.075-.375-.15-.075-.075-2.1-1.95-2.85-2.625-.75-.675-1.35-1.275-1.35-2.175 0-.975.525-1.5 1.2-1.875l.15-.075c.675-.375 1.35-.6 2.1-.675.75-.075 1.35-.075 1.8 0 .45.075 1.2.375 1.8.825.6.45.9 1.2.975 2.1.075.9.075 1.65-.15 2.4l-.15.45c-.225.75-.45 1.5-.525 2.175-.075.675-.15 1.2-.075 1.425.075.225.375.45.825.45.45 0 .9-.15 1.35-.375s.9-.525 1.35-.825c.45-.3.9-.6 1.35-.825.45-.225.9-.45 1.2-.6.3-.15.6-.225.75-.225.3 0 .45.075.6.15.15.075.225.225.3.3.075.075.15.15.15.225.075.3-.15.75-.225.825z"></path></svg>
                             <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors">+1 725 329 5633 (Telegram)</a>
                         </div>
                    </div>
                </div>

                <div class="md:col-span-12 lg:col-span-1"></div>

                <div class="md:col-span-12 lg:col-span-6">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                         <div>
                            <h4 class="font-semibold text-white mb-4">Quick Links</h4>
                            <ul class="space-y-3">
                                <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-orange-400 transition-colors">About</a></li>
                                <li><a href="{{ route('invest') }}" class="text-gray-400 hover:text-orange-400 transition-colors">Invest</a></li>
                                <li><a href="{{ route('security') }}" class="text-gray-400 hover:text-orange-400 transition-colors">Security</a></li>
                                <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-orange-400 transition-colors">Contact</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white mb-4">Our Offices</h4>
                             <ul class="space-y-3">
                                <li class="text-gray-400 leading-snug">
                                    <span class="font-bold text-gray-200 block">Oakland, CA</span>
                                    248 3rd St #434,<br>Oakland CA, 94607
                                </li>
                                <li class="text-gray-400 leading-snug pt-2">
                                    <span class="font-bold text-gray-200 block">New York, NY</span>
                                    1350 Ave of the Americas,<br>Fl. 2 #1143, New York, NY 10019
                                </li>
                            </ul>
                        </div>
                         <div>
                            <h4 class="font-semibold text-white mb-4">Legal</h4>
                            <ul class="space-y-3">
                                <li><a href="#" class="text-gray-400 hover:text-orange-400 transition-colors">Privacy Policy</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-orange-400 transition-colors">Terms of Service</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-orange-400 transition-colors">Risk Disclosure</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 sm:mb-0">
                    &copy; 2025 {{ config('app.name') }} Investment Limited. All Rights Reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-orange-400 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.45L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.267.655 4.398 1.803 6.12l-1.214 4.433 4.515-1.182z"></path></svg>
                    </a>
                    </div>
            </div>
        </div>
    </footer>