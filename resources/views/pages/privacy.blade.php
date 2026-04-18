<x-public-layout>
    <!-- Header Hero: Unified CRS BD Branding -->
    <div class="relative pt-40 pb-24 bg-[#050B1A] overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/assets/institutional_safety_banner.png') }}');">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <div class="bg-black/10 backdrop-blur-md px-10 py-12 rounded-[3.2rem] border border-white/10 inline-block">
                <nav class="flex justify-center text-[10px] font-black uppercase tracking-[0.4em] text-white/70 mb-6 italic" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-3">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a></li>
                        <li><span class="text-orange-500">/</span></li>
                        <li class="text-white">Governance</li>
                    </ol>
                </nav>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase tracking-tighter leading-none italic mb-4">
                    Privacy <span class="text-orange-500">Shield</span>
                </h1>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.4em] leading-loose italic opacity-80">
                    CRS BD Institutional Data Protection Standards
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen py-32 italic">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-white border border-gray-100 rounded-[4rem] p-12 md:p-24 shadow-[0_40px_120px_rgba(0,0,0,0.05)] overflow-hidden" data-aos="fade-up">
                <!-- Watermark Graphic -->
                <div class="absolute -right-20 -top-20 opacity-10 pointer-events-none">
                    <img src="{{ asset('images/assets/privacy_shield.png') }}" class="w-96 h-96 grayscale">
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                    <!-- Sidebar Context -->
                    <div class="lg:col-span-4 space-y-10">
                        <div class="w-24 h-24 rounded-[1.8rem] bg-blue-50 border border-blue-100 flex items-center justify-center p-4">
                            <img src="{{ asset('images/assets/privacy_shield.png') }}" class="w-full h-full object-contain">
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-[10px] font-black text-blue-900 uppercase tracking-widest italic">Mission Objective</h4>
                            <p class="text-gray-500 text-[9px] font-bold uppercase tracking-widest leading-loose italic">Secure the baseline of all personnel data and operational telemetry across the Bangladesh territory.</p>
                        </div>
                    </div>

                    <!-- Policy Content -->
                    <div class="lg:col-span-8 space-y-20">
                        <section class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-px bg-orange-500"></span>
                                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">01. Intelligent Collection</h2>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose">
                                Our systems aggregate operational telemetry and personnel credentials required for unit allocation. This includes identity verification, geolocation data during active missions, and financial settlement records. All collection is performed through encrypted channels to maintain total field security.
                            </p>
                        </section>

                        <section class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-px bg-orange-500"></span>
                                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">02. Mission Utilization</h2>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose">
                                Aggregated data is utilized exclusively for mission optimization, fleet logistics, and personnel protection. We do not transmit intelligence to external non-operational entities. Your data remains isolated within the CRS BD secure environment to ensure continuous tactical privacy.
                            </p>
                        </section>

                        <section class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-px bg-orange-500"></span>
                                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">03. Hardened Protection</h2>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose">
                                Personnel records are protected by multi-signature encryption and isolated database clusters. We maintain a zero-tolerance policy regarding unauthorized data access, periodic integrity audits ensure our protection protocols exceed industry standard security benchmarks.
                            </p>
                        </section>

                        <div class="pt-16 border-t border-gray-50 flex items-center justify-between">
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic">Operational Audit: {{ date('F Y') }}</p>
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
