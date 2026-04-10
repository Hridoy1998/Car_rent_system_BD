<x-public-layout>
    <div class="relative pt-32 pb-24 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[400px] bg-indigo-500/5 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-indigo-600/10 border border-indigo-500/20 mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]"></span>
                <span class="text-[9px] font-black text-white uppercase tracking-[0.3em] italic">Support & Disputes</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-black text-white italic tracking-tighter mb-8 uppercase">
                SUPPORT <span class="text-indigo-500">CENTER</span>
            </h1>
            
            <div class="prose prose-invert max-w-none">
                <div class="bg-white/5 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl mb-12">
                    <h2 class="text-xl font-black text-white uppercase tracking-widest italic mb-6">Dispute Resolution Process</h2>
                    <p class="text-gray-400 leading-relaxed font-medium mb-8">
                        The Car Rent System Support Center helps resolve any disagreements between car owners and renters. Our goal is to ensure neutral, fair resolutions using provided photographic evidence and trip logs.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-950/40 p-6 rounded-3xl border border-white/5">
                            <div class="text-indigo-400 font-black text-xs uppercase tracking-widest mb-3">Phase 01: Chat</div>
                            <p class="text-[11px] text-gray-500 uppercase font-bold leading-relaxed tracking-wider">
                                Parties should first try to resolve issues through the direct trip chat. Most issues are resolved at this stage.
                            </p>
                        </div>
                        <div class="bg-gray-950/40 p-6 rounded-3xl border border-white/5">
                            <div class="text-indigo-400 font-black text-xs uppercase tracking-widest mb-3">Phase 02: Support</div>
                            <p class="text-[11px] text-gray-500 uppercase font-bold leading-relaxed tracking-wider">
                                If the chat fails, a Support Request can be filed. This triggers a review of all damage reports and photos by our team.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <section>
                        <h3 class="text-lg font-black text-white uppercase italic tracking-widest mb-4">Evidence Requirements</h3>
                        <ul class="list-none space-y-4 p-0">
                            <li class="flex items-start gap-4 text-sm text-gray-500">
                                <span class="text-indigo-500 font-black mt-1">/</span>
                                <div><strong class="text-gray-300 uppercase italic mr-2">Photos:</strong> High-resolution images from the pickup and return process.</div>
                            </li>
                            <li class="flex items-start gap-4 text-sm text-gray-500">
                                <span class="text-indigo-500 font-black mt-1">/</span>
                                <div><strong class="text-gray-300 uppercase italic mr-2">Trip Data:</strong> Odometer readings and fuel levels recorded during the handover.</div>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
            
            <div class="mt-16 pt-8 border-t border-white/5">
                <a href="{{ route('pages.contact') }}" class="inline-flex px-10 py-4 bg-white text-gray-950 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-gray-200 transition-all">Submit Support Request</a>
            </div>
        </div>
    </div>
</x-public-layout>
