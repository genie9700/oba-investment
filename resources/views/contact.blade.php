@extends('layouts.guest')

@section('content')

    <main>
        <section class="relative pt-40 pb-24 px-6 lg:px-8 text-center overflow-hidden">
            <div class="absolute inset-0 crypto-grid opacity-50"></div>
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white">
                    Get In <span class="text-gradient">Touch</span>
                </h1>
                <p class="mt-6 text-xl text-gray-400 leading-relaxed">
                    We're here to help. Whether you're a prospective investor or a current partner, our team is ready to assist you.
                </p>
            </div>
        </section>

        <section class="py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-8 w-full">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white mb-6">Send Us a Message</h2>
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300">Full Name</label>
                            <input type="text" name="name" id="name" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                            <input type="email" name="email" id="email" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300">Subject</label>
                            <input type="text" name="subject" id="subject" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300">Message</label>
                            <textarea name="message" id="message" rows="4" class="mt-2 block w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-12 w-full">
    <div>
        <h3 class="text-2xl font-bold text-white mb-4">Investor Relations</h3>
        <div class="space-y-4 text-base sm:text-lg">
            <div class="flex items-start min-w-0">
                <svg class="w-6 h-6 mr-3 text-orange-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <a href="mailto:investor@Cryptane-BitcoinInvestment.com" class="text-gray-300 hover:text-white break-words w-0 flex-1">
                    investor@Cryptane-BitcoinInvestment.com
                </a>
            </div>
        </div>
    </div>
    <div>
        <h3 class="text-2xl font-bold text-white mb-4">General Inquiries</h3>
        <div class="space-y-4 text-base sm:text-lg">
            <div class="flex items-start min-w-0">
                <svg class="w-6 h-6 mr-3 text-orange-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <a href="mailto:cryptanebitcoininvestment@gmail.com" class="text-gray-300 hover:text-white break-words w-0 flex-1">
                    cryptanebitcoininvestment@gmail.com
                </a>
            </div>
            <div class="flex items-start min-w-0">
                <svg class="w-6 h-6 mr-3 text-orange-400 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.45L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.267.655 4.398 1.803 6.12l-1.214 4.433 4.515-1.182z"></path></svg>
                <a href="#" class="text-gray-300 hover:text-white break-words w-0 flex-1">
                    +1 (910) 360-2020 (WhatsApp)
                </a>
            </div>
            <div class="flex items-start min-w-0">
                <svg class="w-6 h-6 mr-3 text-orange-400 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.85 16.215c-1.002.542-5.516 2.763-6.205 2.45-1.127-.502-1.07-1.768-.99-2.458.083-.69.21-1.725.1-2.28-.11-.555-.54-1.137-.9-1.32-.36-.183-.87-.205-1.2-.18-1.5.11-2.1.33-3.3.705-1.2.375-2.1.72-2.7.9-.6.18-1.2.345-1.5.3-1.035-.15-1.335-1.162-.18-1.785 1.155-.623 6.915-3.21 7.515-3.51.6-.3 1.2-.45 1.5-.45.3 0 .6.15.75.3.15.15.225.375.225.6 0 .225-.075.45-.225.675-.15.225-1.125.975-3.375 2.85-2.25 1.875-2.625 2.25-2.775 2.4-.15.15-.3.3-.45.3-.15 0-.3-.075-.375-.15-.075-.075-2.1-1.95-2.85-2.625-.75-.675-1.35-1.275-1.35-2.175 0-.975.525-1.5 1.2-1.875l.15-.075c.675-.375 1.35-.6 2.1-.675.75-.075 1.35-.075 1.8 0 .45.075 1.2.375 1.8.825.6.45.9 1.2.975 2.1.075.9.075 1.65-.15 2.4l-.15.45c-.225.75-.45 1.5-.525 2.175-.075.675-.15 1.2-.075 1.425.075.225.375.45.825.45.45 0 .9-.15 1.35-.375s.9-.525 1.35-.825c.45-.3.9-.6 1.35-.825.45-.225.9-.45 1.2-.6.3-.15.6-.225.75-.225.3 0 .45.075.6.15.15.075.225.225.3.3.075.075.15.15.15.225.075.3-.15.75-.225.825z"></path></svg>
                <a href="#" class="text-gray-300 hover:text-white break-words w-0 flex-1">
                    +1 (725) 329-5633 (Telegram)
                </a>
            </div>
        </div>
    </div>
    <div>
        <h3 class="text-2xl font-bold text-white mb-4">Our Offices</h3>
        <div class="space-y-4 text-base sm:text-lg">
            <div class="flex items-start min-w-0">
                <svg class="w-6 h-6 mr-3 text-orange-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657l-4.243 4.243a2 2 0 01-2.828 0l-4.243-4.243a2 2 0 010-2.828l4.243-4.243a2 2 0 012.828 0l4.243 4.243a2 2 0 010 2.828z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <p class="text-gray-300 break-words w-0 flex-1">248 3rd St #434, Oakland CA, 94607</p>
            </div>
            <div class="flex items-start min-w-0">
                <svg class="w-6 h-6 mr-3 text-orange-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <p class="text-gray-300 break-words w-0 flex-1">1350 Ave of the Americas, Fl. 2 #1143, New York, NY 10019 (General Correspondence)</p>
            </div>
        </div>
    </div>
</div>

            </div>
        </section>
        
    </main>

@endsection