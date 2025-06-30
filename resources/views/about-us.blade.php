@extends('layouts.guest')

@section('content')

  <main>
        <!-- ======================================================================= -->
        <!-- ======================= 2. PAGE HEADER ============================ -->
        <!-- ======================================================================= -->
        <section class="relative pt-40 pb-24 px-6 lg:px-8 text-center overflow-hidden">
            <div class="absolute inset-0 crypto-grid opacity-50"></div>
            <div class="max-w-4xl mx-auto">
                <p class="text-lg font-semibold text-orange-400 mb-4">Our Mission</p>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white">
                    Pioneering a Secure & Transparent Future for Digital Asset Investing
                </h1>
                <p class="mt-6 text-xl text-gray-400 leading-relaxed">
                    We are a team of financial experts and technology innovators united by a single mission: to provide the most secure and accessible path to digital wealth.
                </p>
            </div>
        </section>

        <!-- ======================================================================= -->
        <!-- ======================= 3. OUR STORY SECTION ======================== -->
        <!-- ======================================================================= -->
        <section class="py-24 px-6 lg:px-8">
            <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white">From a Simple Idea to an Industry Leader</h2>
                    <p class="text-lg text-gray-400 leading-relaxed">
                        Founded in 2021, Cryptane Investment was born from a simple observation: the world of cryptocurrency was powerful, but unnecessarily complex and often intimidating for serious investors. The tools were either too basic for professionals or too insecure for anyone to trust with significant capital.
                    </p>
                    <p class="text-lg text-gray-400 leading-relaxed">
                        We brought together the best minds in finance, cybersecurity, and blockchain engineering to build the platform we, as investors, wanted for ourselves. Today, Cryptane stands as a testament to that vision—a robust, secure, and intuitive ecosystem for building and managing digital wealth.
                    </p>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2684&auto=format&fit=crop" alt="A professional team collaborating in a modern office." class="rounded-2xl shadow-2xl shadow-orange-500/10">
                </div>
            </div>
        </section>
        
        <!-- ======================================================================= -->
        <!-- ======================= 4. MEET THE LEADERSHIP ==================== -->
        <!-- ======================================================================= -->
        <section class="py-24 px-6 lg:px-8 bg-black bg-opacity-20">
            <div class="max-w-7xl mx-auto">
                 <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-white">Meet Our Leadership</h2>
                    <p class="mt-4 text-lg text-gray-400">Our team's strength lies in its blend of deep financial expertise and pioneering technological innovation.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Profile Card 1 -->
                    <div class="text-center group p-6 border border-transparent hover:border-white/10 hover:bg-white/5 rounded-2xl transition-all">
                        <img class="h-32 w-32 rounded-full object-cover mx-auto mb-4" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=2574&auto=format&fit=crop" alt="Portrait of James Carter">
                        <h3 class="text-xl font-bold text-white">James Carter</h3>
                        <p class="text-orange-400 mb-2">CEO & Founder</p>
                        <p class="text-gray-400 text-sm">20+ years in wealth management and fintech innovation.</p>
                    </div>
                     <!-- Profile Card 2 -->
                    <div class="text-center group p-6 border border-transparent hover:border-white/10 hover:bg-white/5 rounded-2xl transition-all">
                        <img class="h-32 w-32 rounded-full object-cover mx-auto mb-4" src="https://images.unsplash.com/photo-1488229297570-58520851e868?q=80&w=2669&auto=format&fit=crop" alt="Portrait of Anya Sharma">
                        <h3 class="text-xl font-bold text-white">Anya Sharma</h3>
                        <p class="text-orange-400 mb-2">Chief Technology Officer</p>
                        <p class="text-gray-400 text-sm">Lead architect of secure, scalable blockchain infrastructures.</p>
                    </div>
                     <!-- Profile Card 3 -->
                    <div class="text-center group p-6 border border-transparent hover:border-white/10 hover:bg-white/5 rounded-2xl transition-all">
                        <img class="h-32 w-32 rounded-full object-cover mx-auto mb-4" src="https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=2670&auto=format&fit=crop" alt="Portrait of Marcus Thorne">
                        <h3 class="text-xl font-bold text-white">Marcus Thorne</h3>
                        <p class="text-orange-400 mb-2">Head of Security</p>
                        <p class="text-gray-400 text-sm">Former cybersecurity lead for a top-tier financial institution.</p>
                    </div>
                     <!-- Profile Card 4 -->
                    <div class="text-center group p-6 border border-transparent hover:border-white/10 hover:bg-white/5 rounded-2xl transition-all">
                        <img class="h-32 w-32 rounded-full object-cover mx-auto mb-4" src="https://images.unsplash.com/photo-1541709440582-8f682639a445?q=80&w=2584&auto=format&fit=crop" alt="Portrait of Elena Petrova">
                        <h3 class="text-xl font-bold text-white">Elena Petrova</h3>
                        <p class="text-orange-400 mb-2">Head of Investor Relations</p>
                        <p class="text-gray-400 text-sm">Dedicated to providing unparalleled service and support.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======================================================================= -->
        <!-- ======================= 5. FINAL CTA SECTION ======================== -->
        <!-- ======================================================================= -->
        <section class="py-24 px-6 lg:px-8">
             <div class="max-w-4xl mx-auto text-center relative">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Join Us on Our Mission</h2>
                <p class="text-lg text-gray-400 leading-relaxed mb-10">
                    Invest with a team you can trust. Explore our professionally managed investment plans and start your journey today.
                </p>
                <a href="{{ route('invest') }}" class="inline-block bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-10 py-4 rounded-full font-semibold hover:scale-105 transition-transform shadow-lg shadow-orange-500/20">
                    View Investment Plans
                </a>
            </div>
        </section>

    </main>


@endsection