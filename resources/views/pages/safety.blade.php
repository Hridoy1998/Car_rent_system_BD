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
                        <li class="text-white">Safety Intelligence</li>
                    </ol>
                </nav>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase tracking-tighter leading-none italic mb-4">
                    Safety <span class="text-orange-500">Center</span>
                </h1>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.4em] leading-loose italic opacity-80">
                    CRS BD Institutional Security & Safety Center
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen py-32 italic">
        <!-- Feature Graphic Section: Institutional CRS BD Signage -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32" data-aos="fade-up">
            <div class="relative bg-gray-900 rounded-[4rem] p-12 md:p-24 overflow-hidden shadow-2xl">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                    <div class="space-y-10">
                        <div class="inline-flex items-center gap-4">
                            <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                            <span class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] italic">AUTHORITATIVE STANDARDS</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter italic leading-[1.1]">CRS BD Safety <br> <span class="text-orange-500">Protection</span> network</h2>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs leading-loose">The safety of our personnel and fleet is governed by the CRS BD institutional framework, ensuring maximum verification and uninterrupted service across all deployment zones.</p>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('images/assets/safety_sign.png') }}" class="w-full h-auto rounded-[3.5rem] shadow-2xl border border-white/10">
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-orange-500/10 rounded-full blur-[80px]"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Safety Item 1: Verification -->
                <div class="bg-white border border-gray-100 rounded-[3rem] p-12 shadow-[0_40px_100px_rgba(0,0,0,0.03)] text-center group hover:border-blue-500/20 transition-all duration-500" data-aos="fade-up">
                    <div class="w-24 h-24 rounded-[2rem] bg-blue-50/50 border border-blue-100 flex items-center justify-center text-blue-600 mx-auto mb-10 transition-transform group-hover:scale-110 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tight italic">Verified Fleet</h3>
                    <p class="text-gray-500 font-bold uppercase tracking-widest text-[9px] leading-loose">All rental partners undergo rigorous background validation and periodic vehicle inspections to maintain the highest fleet standards.</p>
                </div>

                <!-- Safety Item 2: Assistance -->
                <div class="bg-white border border-gray-100 rounded-[3rem] p-12 shadow-[0_40px_100px_rgba(0,0,0,0.03)] text-center group hover:border-orange-500/20 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-24 h-24 rounded-[2rem] bg-orange-50/50 border border-orange-100 flex items-center justify-center text-orange-500 mx-auto mb-10 transition-transform group-hover:scale-110 shadow-sm relative">
                        <span class="absolute top-4 right-4 w-2 h-2 bg-orange-500 rounded-full animate-ping"></span>
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tight italic">24/7 Assistance</h3>
                    <p class="text-gray-500 font-bold uppercase tracking-widest text-[9px] leading-loose">Drive with peace of mind. Our professional roadside assistance and support teams are available 24/7 for immediate help.</p>
                </div>

                <!-- Safety Item 3: Transact -->
                <div class="bg-white border border-gray-100 rounded-[3rem] p-12 shadow-[0_40px_100px_rgba(0,0,0,0.03)] text-center group hover:border-emerald-500/20 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-24 h-24 rounded-[2rem] bg-emerald-50/50 border border-emerald-100 flex items-center justify-center text-emerald-600 mx-auto mb-10 transition-transform group-hover:scale-110 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tight italic">Secure Payment</h3>
                    <p class="text-gray-500 font-bold uppercase tracking-widest text-[9px] leading-loose">Financial transactions are protected by industry-leading encryption and secure verification protocols for your total protection.</p>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
