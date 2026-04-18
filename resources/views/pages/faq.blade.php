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
                        <li class="text-white">Support</li>
                    </ol>
                </nav>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase tracking-tighter leading-none italic mb-4">
                    Information <span class="text-orange-500">Nexus</span>
                </h1>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.4em] leading-loose italic opacity-80">
                    CRS BD Foundational Support Hub
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen py-32 italic">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-32" data-aos="fade-up">
            <h4 class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] mb-4 italic">KNOWLEDGE BASE</h4>
            <h2 class="text-5xl md:text-7xl font-black text-blue-900 uppercase tracking-tighter italic">Common <span class="text-gray-900">Inquiries</span></h2>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20 items-start">
                <!-- Sidebar Graphic Context -->
                <div class="lg:col-span-4 sticky top-40" data-aos="fade-right">
                    <div class="relative rounded-[4rem] overflow-hidden shadow-2xl bg-gray-50 border border-gray-100 p-12">
                        <img src="{{ asset('images/assets/faq_graphic.png') }}" class="w-full h-auto object-contain">
                        <div class="mt-12 space-y-6">
                            <h4 class="text-[10px] font-black text-blue-900 uppercase tracking-widest italic">Operational Assistance</h4>
                            <p class="text-gray-500 text-[9px] font-bold uppercase tracking-widest leading-loose italic">Our tactical support teams are available 24/7 to resolve mécanical friction or logistical anomalies.</p>
                        </div>
                    </div>
                </div>

                <!-- Interactive Accordion Layer -->
                <div class="lg:col-span-8 space-y-6" x-data="{ active: null }">
                    <!-- FAQ Module 1 -->
                    <div class="border border-gray-100 rounded-[2.5rem] bg-white transition-all duration-300" :class="active === 1 ? 'shadow-[0_40px_100px_rgba(0,0,0,0.08)] border-orange-500/20' : 'hover:border-gray-300'">
                        <button @click="active = active === 1 ? null : 1" class="w-full text-left px-10 py-10 flex items-center justify-between group">
                            <span class="text-xl md:text-2xl font-black text-blue-900 uppercase italic tracking-tight group-hover:text-orange-500 transition-colors">Initiating Unit Allocation</span>
                            <span class="w-10 h-10 rounded-full border-2 border-gray-100 flex items-center justify-center transition-all duration-500" :class="active === 1 ? 'rotate-180 border-orange-500 bg-orange-500 text-white' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div x-show="active === 1" x-collapse x-cloak>
                            <div class="px-10 pb-10">
                                <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-2xl border-t border-gray-50 pt-8 mt-2">
                                    Reservations are processed through our central directory. Select your unit, authenticate your credentials, and establish your mission parameters to finalize allocation.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Module 2 -->
                    <div class="border border-gray-100 rounded-[2.5rem] bg-white transition-all duration-300" :class="active === 2 ? 'shadow-[0_40px_100px_rgba(0,0,0,0.08)] border-orange-500/20' : 'hover:border-gray-300'">
                        <button @click="active = active === 2 ? null : 2" class="w-full text-left px-10 py-10 flex items-center justify-between group">
                            <span class="text-xl md:text-2xl font-black text-blue-900 uppercase italic tracking-tight group-hover:text-orange-500 transition-colors">Credential Verification Protocols</span>
                            <span class="w-10 h-10 rounded-full border-2 border-gray-100 flex items-center justify-center transition-all duration-500" :class="active === 2 ? 'rotate-180 border-orange-500 bg-orange-500 text-white' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div x-show="active === 2" x-collapse x-cloak>
                            <div class="px-10 pb-10">
                                <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-2xl border-t border-gray-50 pt-8 mt-2">
                                    Operators must transmit a valid National ID or Passport along with a verified driving permit. Our system performs a one-time validation through an encrypted security layer.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Module 3 -->
                    <div class="border border-gray-100 rounded-[2.5rem] bg-white transition-all duration-300" :class="active === 3 ? 'shadow-[0_40px_100px_rgba(0,0,0,0.08)] border-orange-500/20' : 'hover:border-gray-300'">
                        <button @click="active = active === 3 ? null : 3" class="w-full text-left px-10 py-10 flex items-center justify-between group">
                            <span class="text-xl md:text-2xl font-black text-blue-900 uppercase italic tracking-tight group-hover:text-orange-500 transition-colors">Mission Modifications & Termination</span>
                            <span class="w-10 h-10 rounded-full border-2 border-gray-100 flex items-center justify-center transition-all duration-500" :class="active === 3 ? 'rotate-180 border-orange-500 bg-orange-500 text-white' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div x-show="active === 3" x-collapse x-cloak>
                            <div class="px-10 pb-10">
                                <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-2xl border-t border-gray-50 pt-8 mt-2">
                                    Active contracts can be adjusted via the User Dashboard. Cancellation protocols follow a tiered structure based on the deactivation timeline to maintain fleet stability.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Module 4 -->
                    <div class="border border-gray-100 rounded-[2.5rem] bg-white transition-all duration-300" :class="active === 4 ? 'shadow-[0_40px_100px_rgba(0,0,0,0.08)] border-orange-500/20' : 'hover:border-gray-300'">
                        <button @click="active = active === 4 ? null : 4" class="w-full text-left px-10 py-10 flex items-center justify-between group">
                            <span class="text-xl md:text-2xl font-black text-blue-900 uppercase italic tracking-tight group-hover:text-orange-500 transition-colors">Technical Field Assistance</span>
                            <span class="w-10 h-10 rounded-full border-2 border-gray-100 flex items-center justify-center transition-all duration-500" :class="active === 4 ? 'rotate-180 border-orange-500 bg-orange-500 text-white' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div x-show="active === 4" x-collapse x-cloak>
                            <div class="px-10 pb-10">
                                <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-[10px] max-w-2xl border-t border-gray-50 pt-8 mt-2">
                                    We provide 24/7 technical oversight. In cases of mechanical friction or operational anomalies, tactical support teams are deployed to your precise coordinates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Join CTA Section -->
            <div class="mt-40 bg-blue-900 rounded-[4rem] p-20 text-center relative overflow-hidden" data-aos="zoom-in">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 opacity-50"></div>
                <div class="relative z-10 space-y-10">
                    <h4 class="text-orange-500 font-black text-[12px] uppercase tracking-[0.6em] italic">UNRESOLVED?</h4>
                    <h2 class="text-4xl md:text-6xl font-black text-white uppercase italic tracking-tighter leading-none">Persistent <span class="text-orange-500">Support Hub</span></h2>
                    <p class="text-white/70 font-bold uppercase tracking-widest text-xs max-w-2xl mx-auto leading-loose">Initiate a direct frequency with our tactical support team for complex inquiries or operational de-escalation.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('pages.contact') }}" class="group relative inline-flex items-center justify-center px-12 py-6 bg-orange-500 hover:bg-white hover:text-orange-500 text-white font-black rounded-2xl transition-all uppercase italic text-[11px] tracking-widest shadow-2xl shadow-orange-500/20">
                            <span>Deploy Contact Request</span>
                            <svg class="w-4 h-4 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
