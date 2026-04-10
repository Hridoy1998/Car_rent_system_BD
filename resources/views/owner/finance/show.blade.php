<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('owner.finance.index') }}" class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 transition-all text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                        Fiscal Artifact: REF-{{ str_pad($earning->id, 6, '0', STR_PAD_LEFT) }}
                    </h2>
                    <p class="text-[10px] text-emerald-400 font-bold uppercase tracking-[0.2em] mt-1">Authorized Revenue Settlement Statement</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest">Settled & Available</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden text-slate-200">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Yield Delta Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                    <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2 italic">Gross Tactical Revenue</h4>
                    <div class="text-5xl font-black text-white tracking-tighter shadow-emerald-500/10 group-hover:text-emerald-400 transition-colors">৳ {{ number_format($earning->amount + $earning->platform_fee) }}</div>
                    <div class="mt-6 flex items-center text-[10px] font-black text-emerald-500/60 uppercase tracking-widest leading-none">Total Itinerary Value</div>
                </div>

                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                    <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2 italic">Platform Optimization</h4>
                    <div class="text-5xl font-black text-red-500/80 tracking-tighter shadow-red-500/10">-৳ {{ number_format($earning->platform_fee) }}</div>
                    <div class="mt-6 flex items-center text-[10px] font-black text-red-500/40 uppercase tracking-widest leading-none">Infrastructure & Liability Fee</div>
                </div>

                <div class="bg-gray-900 border-2 border-emerald-500/20 backdrop-blur-3xl p-10 rounded-[3rem] shadow-3xl relative overflow-hidden group">
                     <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl"></div>
                    <h4 class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-2 italic">Net Liquidity Yield</h4>
                    <div class="text-5xl font-black text-white tracking-tighter shadow-emerald-500/20 italic">৳ {{ number_format($earning->amount) }}</div>
                    <div class="mt-6 flex items-center text-[10px] font-black text-emerald-500 uppercase tracking-widest leading-none">Available for Retrieval</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Deployment context -->
                <div class="lg:col-span-2 space-y-12">
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3.5rem] overflow-hidden shadow-2xl">
                        <div class="p-10 border-b border-white/5 flex items-center justify-between">
                            <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                Operation Intelligence
                            </h3>
                            <a href="{{ route('owner.bookings.show', $earning->booking) }}" class="text-[10px] font-black text-indigo-400 hover:text-white uppercase tracking-widest transition-colors">Full Protocol Audit →</a>
                        </div>
                        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-12">
                             <div class="space-y-6">
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-700 uppercase tracking-widest mb-3 italic">Operator Artifact</h4>
                                     <div class="flex items-center gap-4">
                                         <div class="w-14 h-14 rounded-2xl bg-gray-950 border border-white/5 flex items-center justify-center text-xl font-black text-indigo-400">{{ substr($earning->booking->customer->name, 0, 1) }}</div>
                                         <div>
                                             <div class="text-sm font-black text-white uppercase tracking-tighter">{{ $earning->booking->customer->name }}</div>
                                             <div class="text-[9px] text-gray-600 font-bold uppercase tracking-widest italic">Identity Verified</div>
                                         </div>
                                     </div>
                                 </div>
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-700 uppercase tracking-widest mb-3 italic">Deployment Site</h4>
                                     <div class="text-sm font-black text-gray-300 uppercase italic">Urban Sector {{ $earning->booking->car->location }}</div>
                                 </div>
                             </div>

                             <div class="space-y-6">
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-700 uppercase tracking-widest mb-3 italic">Deployment Timeline</h4>
                                     <div class="text-sm font-black text-white tracking-widest">{{ $earning->booking->start_date }} → {{ $earning->booking->end_date }}</div>
                                     <div class="text-[9px] text-gray-600 font-bold uppercase mt-1 italic">{{ \Carbon\Carbon::parse($earning->booking->start_date)->diffInDays(\Carbon\Carbon::parse($earning->booking->end_date)) }} Total Deployment Units</div>
                                 </div>
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-700 uppercase tracking-widest mb-3 italic">Settlement Timestamp</h4>
                                     <div class="text-sm font-black text-emerald-400/80 italic tracking-tighter">{{ $earning->created_at->format('M d, Y | H:i') }}</div>
                                 </div>
                             </div>
                        </div>
                    </div>

                    <!-- Asset details -->
                    <div class="bg-gray-900 border border-white/5 p-10 rounded-[3.5rem] shadow-2xl overflow-hidden relative group">
                        <div class="flex items-center gap-10">
                            <div class="w-48 aspect-video rounded-3xl overflow-hidden border border-white/10 shadow-3xl bg-gray-950 group-hover:scale-105 transition-all duration-500">
                                @if($earning->booking->car->images->count() > 0)
                                    <img src="{{ Storage::url($earning->booking->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500/10 via-transparent to-transparent"></div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[11px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-2 italic">Yield-Generating Asset</h4>
                                <h3 class="text-3xl font-black text-white tracking-tighter italic uppercase underline decoration-indigo-500/30 underline-offset-8">{{ $earning->booking->car->brand }} {{ $earning->booking->car->model }}</h3>
                                <div class="mt-6 flex gap-3">
                                    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-gray-500 uppercase tracking-widest">Year: {{ $earning->booking->car->year }}</span>
                                    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-gray-500 uppercase tracking-widest">Plate: {{ $earning->booking->car->license_plate }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Invoicing -->
                <div class="space-y-8">
                    <div class="bg-gray-900 border border-white/10 p-10 rounded-[3rem] shadow-3xl sticky top-8 text-center">
                        <h3 class="text-sm font-black text-white italic tracking-widest uppercase mb-10">Statement Controller</h3>
                        
                        <div class="space-y-4">
                            <a href="{{ route('invoices.download', $earning->booking) }}" class="block w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl shadow-indigo-600/20 active:scale-95">
                                Download PDF Statement
                            </a>
                            <button class="block w-full py-5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl border border-white/5 transition-all">
                                Request Tactical Audit
                            </button>
                        </div>

                        <div class="mt-12 pt-8 border-t border-white/5">
                             <div class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-4">Integrity Verification</div>
                             <div class="p-6 bg-gray-950/50 rounded-[2rem] border border-white/5">
                                 <svg class="w-12 h-12 text-emerald-500/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                 <div class="text-[8px] text-gray-700 font-black uppercase italic leading-relaxed">This transaction has been cryptographically verified and matched against platform deployment metadata.</div>
                             </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
