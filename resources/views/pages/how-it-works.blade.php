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
                        <li class="text-white">Service Excellence</li>
                    </ol>
                </nav>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase tracking-tighter leading-none italic mb-4">
                    How it <span class="text-orange-500">Works</span>
                </h1>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.4em] leading-loose italic opacity-80">
                    CRS BD Guide to Mastering The Elite Rental Experience
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen py-32 italic">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Path: Renter Journey -->
            <div class="space-y-40">
                <div class="text-center mb-32" data-aos="fade-up">
                    <h4 class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] mb-4 italic">FOR RENTERS</h4>
                    <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic">Rent in <span class="text-blue-900">3 Easy Steps</span></h2>
                </div>

                <!-- Renter Step 1 -->
                <div class="flex flex-col lg:flex-row items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 1</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Pick and Reserve <br/> a Premium Car</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-lg">Survey our elite fleet directory, select your unit, and initiate secure booking protocols via our master console.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-gray-50">
                        <img src="{{ asset('images/assets/rent_banner.png') }}" class="w-full h-[450px] object-cover">
                    </div>
                </div>

                <!-- Renter Step 2 -->
                <div class="flex flex-col lg:flex-row-reverse items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 2</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Customize Your <br/> Preferences</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-lg">Establish mission timeline and deployment protocols. Our encrypted layer ensures rapid one-time validation.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-gray-50">
                        <img src="{{ asset('images/assets/preferences_banner.png') }}" class="w-full h-[450px] object-cover">
                    </div>
                </div>
            </div>

            <!-- Separator -->
            <div class="my-40 h-px bg-gray-100 relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="px-8 bg-white text-[10px] font-black text-gray-300 uppercase tracking-[0.8em] italic">Operational Switch</div>
                </div>
            </div>

            <!-- Path: Host Journey -->
            <div class="space-y-40">
                <div class="text-center mb-32" data-aos="fade-up">
                    <h4 class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] mb-4 italic">FOR HOSTS</h4>
                    <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic">Earn in <span class="text-blue-900">3 Easy Steps</span></h2>
                </div>

                <!-- Host Step 1 -->
                <div class="flex flex-col lg:flex-row items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 1</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Register Your <br/> Elite Fleet</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-lg">Transmit your unit's technical specs and high-fidelity imagery to our central registry for free activation.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-gray-50">
                        <img src="{{ asset('images/assets/earn_banner.png') }}" class="w-full h-[450px] object-cover">
                    </div>
                </div>

                <!-- Host Step 2 -->
                <div class="flex flex-col lg:flex-row-reverse items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 2</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Command & <br/> Control Requests</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-lg">Assume total oversight. Screen renter profiles and authorize deployment requests at your full discretion.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-gray-50">
                        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=1200" class="w-full h-[450px] object-cover">
                    </div>
                </div>
            </div>

            <!-- Join CTA Section -->
            <div class="mt-40 bg-blue-900 rounded-[4rem] p-20 text-center relative overflow-hidden" data-aos="zoom-in">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 opacity-50"></div>
                <div class="relative z-10 space-y-10">
                    <h2 class="text-4xl md:text-6xl font-black text-white uppercase italic tracking-tighter">Ready to <span class="text-orange-500">Initialize?</span></h2>
                    <p class="text-white/70 font-bold uppercase tracking-widest text-xs max-w-2xl mx-auto leading-loose">Join the premier peer-to-peer mobilization network in Bangladesh and experience elite autonomy.</p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ route('register') }}" class="px-12 py-6 bg-orange-500 hover:bg-white hover:text-orange-500 text-white font-black rounded-2xl transition-all uppercase italic text-[11px] tracking-widest shadow-2xl shadow-orange-500/20">Become a Host</a>
                        <a href="{{ route('search') }}" class="px-12 py-6 bg-white hover:bg-orange-500 hover:text-white text-blue-900 font-black rounded-2xl transition-all uppercase italic text-[11px] tracking-widest shadow-2xl shadow-white/10">Start Renting</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
