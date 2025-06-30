@extends('layouts.guest')

@section('content')

 <main>
        <section class="relative pt-40 pb-24 px-6 lg:px-8 text-center overflow-hidden">
            <div class="absolute inset-0 crypto-grid opacity-50"></div>
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white">
                    A Multi-Layered <span class="text-gradient">Fortress for Your Assets</span>
                </h1>
                <p class="mt-6 text-xl text-gray-400 leading-relaxed">
                    At Cryptane, security isn't a feature—it's our foundation. We've engineered a comprehensive, defense-in-depth security architecture to protect your investments and your data at every level.
                </p>
            </div>
        </section>

        <section class="py-24 px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white">Protecting Your Funds</h2>
                    <p class="mt-4 text-lg text-gray-400">How we secure every dollar and digital asset you entrust to us.</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                        <div class="inline-block p-4 bg-orange-500/10 rounded-xl mb-4"><svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg></div>
                        <h3 class="text-xl font-bold text-white mb-2">Cold Storage</h3>
                        <p class="text-gray-400">98% of all client crypto assets are held offline in air-gapped, geographically-distributed cold storage wallets, completely isolated from online threats.</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                        <div class="inline-block p-4 bg-orange-500/10 rounded-xl mb-4"><svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></div>
                        <h3 class="text-xl font-bold text-white mb-2">Asset Insurance</h3>
                        <p class="text-gray-400">Your USD balances are held at US-regulated banks and are eligible for FDIC insurance up to $250,000. Our cold storage wallets are insured against theft by a leading global syndicate.</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                        <div class="inline-block p-4 bg-orange-500/10 rounded-xl mb-4"><svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-1.026.976-2.19.976-3.432a8.025 8.025 0 00-4.08-6.93M7.002 11a1 1 0 11-2 0 1 1 0 012 0z"></path></svg></div>
                        <h3 class="text-xl font-bold text-white mb-2">Multi-Signature Wallets</h3>
                        <p class="text-gray-400">All withdrawals from storage require coordinated, multi-party consent from several key executives, eliminating single points of failure.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 lg:px-8 bg-black bg-opacity-20">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white">Securing Your Account & Data</h2>
                    <p class="mt-4 text-lg text-gray-400">Proactive measures to safeguard your personal information and account access.</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                     <div class="text-center"><div class="p-4 inline-block bg-white/5 rounded-2xl"><svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg></div><h3 class="mt-4 text-lg font-semibold text-white">End-to-End Encryption</h3><p class="mt-1 text-gray-400">Data is protected in transit with TLS 1.3 and at rest with AES-256 encryption.</p></div>
                     <div class="text-center"><div class="p-4 inline-block bg-white/5 rounded-2xl"><svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div><h3 class="mt-4 text-lg font-semibold text-white">Two-Factor Authentication</h3><p class="mt-1 text-gray-400">Secure your account with 2FA via authenticator apps or security keys.</p></div>
                     <div class="text-center"><div class="p-4 inline-block bg-white/5 rounded-2xl"><svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg></div><h3 class="mt-4 text-lg font-semibold text-white">Withdrawal Whitelisting</h3><p class="mt-1 text-gray-400">Restrict crypto withdrawals to only pre-approved addresses for an added layer of safety.</p></div>
                     <div class="text-center"><div class="p-4 inline-block bg-white/5 rounded-2xl"><svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg></div><h3 class="mt-4 text-lg font-semibold text-white">Regular Security Audits</h3><p class="mt-1 text-gray-400">Our platform undergoes regular penetration testing by independent third-party security firms.</p></div>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 lg:px-8">
             <div class="max-w-4xl mx-auto text-center relative">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Invest with Confidence</h2>
                <p class="text-lg text-gray-400 leading-relaxed mb-10">
                    Now that you understand our commitment to security, you can explore our investment plans with complete peace of mind.
                </p>
                <a href="{{ route('invest') }}" class="inline-block bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-10 py-4 rounded-full font-semibold hover:scale-105 transition-transform shadow-lg shadow-orange-500/20">
                    View Investment Plans
                </a>
            </div>
        </section>
        
    </main>

@endsection