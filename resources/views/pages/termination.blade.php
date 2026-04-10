<x-public-layout>
    <div class="relative pt-32 pb-24 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[400px] bg-red-500/5 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-red-600/10 border border-red-500/20 mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-[0_0_8px_rgba(239,68,68,1)]"></span>
                <span class="text-[9px] font-black text-white uppercase tracking-[0.3em] italic">Protocol: Engagement Exit</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-black text-white italic tracking-tighter mb-8 uppercase">
                TERMINATION <span class="text-red-500">POLICY</span>
            </h1>
            
            <div class="prose prose-invert max-w-none">
                <div class="bg-white/5 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl mb-12">
                    <h2 class="text-xl font-black text-white uppercase tracking-widest italic mb-6">Exit & Refund Framework</h2>
                    <p class="text-gray-400 leading-relaxed font-medium mb-8">
                        Car Rent System provides a structured termination protocol to protect both Asset Owners and Users. All cancellations are audited for timestamp precision and adherence to specific epoch thresholds.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-6 p-4 bg-gray-950/40 rounded-2xl border border-white/5">
                            <div class="text-red-500 font-black text-xl italic tracking-tighter w-16">24H+</div>
                            <p class="text-[11px] text-gray-500 uppercase font-bold tracking-widest leading-relaxed">Early Termination: 100% Refund (minus platform processing fees) if cancelled 24 hours before deployment.</p>
                        </div>
                        <div class="flex items-center gap-6 p-4 bg-gray-950/40 rounded-2xl border border-white/5">
                            <div class="text-red-500 font-black text-xl italic tracking-tighter w-16"><24H</div>
                            <p class="text-[11px] text-gray-500 uppercase font-bold tracking-widest leading-relaxed">Late Termination: 50% Refund if cancelled within 24 hours of scheduled deployment.</p>
                        </div>
                        <div class="flex items-center gap-6 p-4 bg-gray-950/40 rounded-2xl border border-white/5 border-dashed">
                            <div class="text-red-500 font-black text-xl italic tracking-tighter w-16">POST</div>
                            <p class="text-[11px] text-gray-500 uppercase font-bold tracking-widest leading-relaxed">Force Majeure: No refund after deployment authorization unless technical failure is audited.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <section>
                        <h3 class="text-lg font-black text-white uppercase italic tracking-widest mb-4">Refund Cycles</h3>
                        <p class="text-sm text-gray-500 leading-relaxed font-medium">Funds are typically re-routed to the source payment node within 72 hours of termination approval. Processing deltas depends on the financial institution's protocol.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
