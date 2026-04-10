<x-public-layout>
    <div class="relative pt-32 pb-24 overflow-hidden">
        <div class="absolute top-0 right-1/2 translate-x-1/2 w-[1000px] h-[400px] bg-emerald-500/5 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-emerald-600/10 border border-emerald-500/20 mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,1)]"></span>
                <span class="text-[9px] font-black text-white uppercase tracking-[0.3em] italic">Status: Secure Line Active</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-black text-white italic tracking-tighter mb-8 uppercase">
                CONTACT <span class="text-emerald-500">TERMINAL</span>
            </h1>
            
            <div class="max-w-2xl mx-auto">
                <p class="text-gray-400 leading-relaxed font-medium mb-12 uppercase text-xs tracking-widest">
                    Direct signal interface for technical support, tactical inquiries, and partnership proposals. Our response protocols average 120 minutes.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <div class="bg-white/5 backdrop-blur-3xl border border-white/10 p-8 rounded-[2rem] hover:border-emerald-500/30 transition-all text-center group">
                        <div class="w-12 h-12 rounded-xl bg-emerald-600/20 flex items-center justify-center mx-auto mb-6 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-6 h-6 text-emerald-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-white font-black text-xs uppercase tracking-widest italic mb-2">Signal Ops</h3>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest leading-relaxed">support@neon-monolith.com</p>
                    </div>

                    <div class="bg-white/5 backdrop-blur-3xl border border-white/10 p-8 rounded-[2rem] hover:border-indigo-500/30 transition-all text-center group">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600/20 flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 transition-colors">
                            <svg class="w-6 h-6 text-indigo-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                        <h3 class="text-white font-black text-xs uppercase tracking-widest italic mb-2">Registry HQ</h3>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest leading-relaxed">Dhaka Command Sector, BD</p>
                    </div>
                </div>

                <form class="bg-gray-950/40 p-8 md:p-12 rounded-[3rem] border border-white/5 text-left shadow-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-[8px] text-gray-600 font-black uppercase tracking-widest mb-2 italic">Operator Identity</label>
                            <input type="text" placeholder="Full Name..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs font-black text-white focus:ring-emerald-500 focus:border-emerald-500 transition-all placeholder-gray-800">
                        </div>
                        <div>
                            <label class="block text-[8px] text-gray-600 font-black uppercase tracking-widest mb-2 italic">Signal Address</label>
                            <input type="email" placeholder="Email@domain.com..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs font-black text-white focus:ring-emerald-500 focus:border-emerald-500 transition-all placeholder-gray-800">
                        </div>
                    </div>
                    <div class="mb-8">
                        <label class="block text-[8px] text-gray-600 font-black uppercase tracking-widest mb-2 italic">Communication Payload</label>
                        <textarea rows="4" placeholder="Briefing details..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 text-xs font-black text-white focus:ring-emerald-500 focus:border-emerald-500 transition-all placeholder-gray-800"></textarea>
                    </div>
                    <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-2xl transition-all shadow-lg shadow-emerald-500/20">Transmit Signal</button>
                </form>
            </div>
        </div>
    </div>
</x-public-layout>
