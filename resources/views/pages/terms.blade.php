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
                    Terms of <span class="text-orange-500">Service</span>
                </h1>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.4em] leading-loose italic opacity-80">
                    CRS BD Operational Guidelines & Mastery
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen py-32 italic">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-white border border-gray-100 rounded-[4rem] p-12 md:p-24 shadow-[0_40px_120px_rgba(0,0,0,0.05)] overflow-hidden" data-aos="fade-up">
                <!-- Watermark Graphic -->
                <div class="absolute -right-20 -top-20 opacity-10 pointer-events-none">
                    <img src="{{ asset('images/assets/governance_graphic.png') }}" class="w-96 h-96 grayscale">
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                    <!-- Sidebar Context -->
                    <div class="lg:col-span-4 space-y-10">
                        <div class="w-24 h-24 rounded-[1.8rem] bg-orange-50 border border-orange-100 flex items-center justify-center p-4">
                            <img src="{{ asset('images/assets/governance_graphic.png') }}" class="w-full h-full object-contain">
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">Governance Mission</h4>
                            <p class="text-gray-500 text-[9px] font-bold uppercase tracking-widest leading-loose italic">Enforce the baseline of operational safety and legal clarity across the mobilization network.</p>
                        </div>
                    </div>

                    <!-- Policy Content -->
                    <div class="lg:col-span-8 space-y-20">
                        <section class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-px bg-blue-900"></span>
                                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">01. Deployment Agreement</h2>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose">
                                By initializing mission parameters within the CRS BD directory, you agree to adhere to our operational standards. This includes the responsible handling of fleet units, timely settlement of logistical costs, and adherence to unit-specific usage restrictions as documented in the master ledger.
                            </p>
                        </section>

                        <section class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-px bg-blue-900"></span>
                                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">02. Proprietary Assets</h2>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose">
                                All platform telemetry, branding, and tactical interfaces are the exclusive property of CRS BD. Unauthorized extraction of system logic or asset modification is strictly prohibited. We maintain full intellectual protection over our mission coordination algorithms and registry structures.
                            </p>
                        </section>

                        <section class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="w-8 h-px bg-blue-900"></span>
                                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">03. Personnel Representation</h2>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose">
                                Operators must represent valid credentials at all times. Any deviation from the provided identity or fraudulent representation regarding mission intent will result in immediate tactical deactivation and termination of active unit allocation.
                            </p>
                        </section>

                        <div class="pt-16 border-t border-gray-50 flex items-center justify-between">
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic">Operational Revision: {{ date('F Y') }}</p>
                            <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(249,115,22,0.5)]"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
