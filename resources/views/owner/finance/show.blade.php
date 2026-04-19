<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 px-4">
            <div class="flex items-center gap-6 w-full md:w-auto">
                <a href="{{ route('owner.finance.index') }}" class="group/nav w-14 h-14 bg-white hover:bg-[#050B1A] rounded-[1.5rem] border border-gray-100 flex items-center justify-center transition-all shadow-xl shadow-gray-200/50">
                    <svg class="w-6 h-6 text-gray-400 group-hover/nav:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-3xl md:text-4xl text-[#050B1A] uppercase tracking-tighter italic leading-none">
                        Fiscal <span class="text-orange-500">Artifact</span>
                    </h2>
                    <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-[0.3em] mt-2 italic flex items-center gap-3">
                        <span class="w-12 h-px bg-orange-500/20"></span>
                        REF-{{ str_pad($earning->id, 6, '0', STR_PAD_LEFT) }} Settlement Summary
                    </p>
                </div>
            </div>
            <div class="w-full md:w-auto flex items-center justify-between md:justify-end gap-6 bg-white p-2 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50">
                <div class="px-6 py-2">
                    <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Registry Log</div>
                    <div class="text-[10px] font-black text-[#050B1A] italic tracking-widest">{{ strtoupper(substr(md5($earning->id), 0, 12)) }}</div>
                </div>
                <span class="px-6 py-3 bg-emerald-500/10 text-emerald-600 border border-emerald-500/10 rounded-2xl text-[9px] font-black uppercase tracking-widest italic animate-pulse">Settled</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/5 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <!-- Yield Delta Analysis -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                <div class="bg-white border border-gray-100 p-10 rounded-[2.5rem] md:rounded-[4rem] group hover:shadow-2xl transition-all relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-gray-50 rounded-full blur-3xl"></div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                        Gross Yield
                        <span class="w-8 h-px bg-gray-100"></span>
                    </h4>
                    <div class="text-5xl font-black text-[#050B1A] tracking-tighter italic leading-none group-hover:translate-x-1 transition-transform">
                        <span class="text-orange-500 text-xl mr-2">৳</span>{{ number_format($earning->amount + $earning->platform_fee) }}
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-50 text-[9px] font-black text-gray-300 uppercase tracking-widest italic leading-none">Aggregated Deployment Inflow</div>
                </div>

                <div class="bg-white border border-gray-100 p-10 rounded-[2.5rem] md:rounded-[4rem] group hover:shadow-2xl transition-all relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-orange-50/50 rounded-full blur-3xl"></div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                        Platform Fee
                        <span class="w-8 h-px bg-gray-100"></span>
                    </h4>
                    <div class="text-5xl font-black text-orange-500 tracking-tighter italic leading-none group-hover:translate-x-1 transition-transform">
                        <span class="text-gray-300 text-xl mr-2">-৳</span>{{ number_format($earning->platform_fee) }}
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-50 text-[9px] font-black text-gray-300 uppercase tracking-widest italic leading-none">Infrastructure Optimization Liability</div>
                </div>

                <div class="bg-[#050B1A] p-10 rounded-[2.5rem] md:rounded-[4rem] shadow-3xl relative overflow-hidden group">
                    <div class="absolute -right-6 -top-6 w-40 h-40 bg-orange-500/10 rounded-full blur-3xl group-hover:bg-orange-500/20 transition-all duration-1000"></div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                        Net Settlement
                        <span class="w-8 h-px bg-white/5"></span>
                    </h4>
                    <div class="relative z-10 text-6xl font-black text-white tracking-tighter italic leading-none group-hover:scale-105 transition-transform duration-700">
                        <span class="text-orange-500 text-2xl mr-2 italic">৳</span>{{ number_format($earning->amount) }}
                    </div>
                    <div class="mt-8 pt-6 border-t border-white/5 text-[9px] font-black text-gray-500 uppercase tracking-widest italic leading-none">Authorized Liquidity for Release</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Operation Intelligence -->
                <div class="lg:col-span-8 space-y-12">
                    <div class="bg-white border border-gray-100 rounded-[3rem] md:rounded-[4rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] group">
                        <div class="p-8 md:p-12 border-b border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-orange-500 border border-gray-100 shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Operation Brief</h3>
                                    <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest mt-2 italic">Institutional Context Registry</p>
                                </div>
                            </div>
                            <a href="{{ route('owner.bookings.show', $earning->booking) }}" class="px-8 py-3 bg-[#050B1A] hover:bg-orange-500 text-white text-[9px] font-black uppercase tracking-widest italic rounded-xl transition-all shadow-xl group-hover:scale-105">Protocol Audit →</a>
                        </div>
                        <div class="p-8 md:p-12 grid grid-cols-1 md:grid-cols-2 gap-12">
                             <div class="space-y-10">
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-5 italic flex items-center gap-3">
                                         Operator Artifact
                                         <span class="w-4 h-px bg-gray-100"></span>
                                     </h4>
                                     <div class="flex items-center gap-5">
                                         <div class="w-16 h-16 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-center text-2xl font-black text-orange-500 italic shadow-xl rotate-3 group-hover:rotate-0 transition-transform">{{ substr($earning->booking->customer->name, 0, 1) }}</div>
                                         <div>
                                             <div class="text-base font-black text-[#050B1A] uppercase tracking-tighter leading-none">{{ $earning->booking->customer->name }}</div>
                                             <div class="text-[9px] text-emerald-500 font-bold uppercase tracking-widest mt-2 italic flex items-center gap-2">
                                                 <span class="w-1 h-1 bg-emerald-500 rounded-full animate-pulse"></span>
                                                 Identity Verified
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 italic flex items-center gap-3">
                                         Deployment Sector
                                         <span class="w-4 h-px bg-gray-100"></span>
                                     </h4>
                                     <div class="text-base font-black text-gray-600 uppercase italic tracking-tight">Urban Territory: <span class="text-[#050B1A]">{{ $earning->booking->car->location }}</span></div>
                                 </div>
                             </div>

                             <div class="space-y-10">
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 italic flex items-center gap-3">
                                         Mission Timeline
                                         <span class="w-4 h-px bg-gray-100"></span>
                                     </h4>
                                     <div class="text-base font-black text-[#050B1A] italic tracking-tighter leading-none">
                                         {{ \Carbon\Carbon::parse($earning->booking->start_date)->format('d M') }} 
                                         <span class="text-orange-500 px-3">→</span> 
                                         {{ \Carbon\Carbon::parse($earning->booking->end_date)->format('d M, Y') }}
                                     </div>
                                     <div class="text-[9px] text-gray-400 font-black uppercase mt-3 italic">Total Units: {{ \Carbon\Carbon::parse($earning->booking->start_date)->diffInDays(\Carbon\Carbon::parse($earning->booking->end_date)) }} Tactical Cycles</div>
                                 </div>
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 italic flex items-center gap-3">
                                         Settlement Artifact
                                         <span class="w-4 h-px bg-gray-100"></span>
                                     </h4>
                                     <div class="text-lg font-black text-emerald-500 italic tracking-tighter leading-none">{{ $earning->created_at->format('M d, Y | H:i') }}</div>
                                 </div>
                             </div>
                        </div>
                    </div>

                    <!-- Asset Registry -->
                    <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[3.5rem] md:rounded-[4.5rem] group transition-all hover:shadow-2xl shadow-[0_45px_100px_rgba(0,0,0,0.02)]">
                        <div class="flex flex-col md:flex-row items-center gap-12">
                            <div class="w-full md:w-72 aspect-video rounded-3xl overflow-hidden border-4 border-white shadow-2xl relative">
                                <img src="{{ $earning->booking->car->primary_image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                <div class="absolute inset-0 bg-orange-500/5 mix-blend-overlay"></div>
                                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-[#050B1A]/40 to-transparent"></div>
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h4 class="text-[11px] font-black text-orange-500 uppercase tracking-[0.4em] mb-4 italic">Yield Asset Artifact</h4>
                                <h3 class="text-4xl md:text-5xl font-black text-[#050B1A] tracking-tighter italic uppercase leading-none">{{ $earning->booking->car->brand }} <span class="text-orange-500">{{ $earning->booking->car->model }}</span></h3>
                                <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-4">
                                    <span class="px-5 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-black text-gray-400 uppercase tracking-widest italic group-hover:bg-[#050B1A] group-hover:text-white transition-all">Y: {{ $earning->booking->car->year }}</span>
                                    <span class="px-5 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-[10px] font-black text-gray-400 uppercase tracking-widest italic group-hover:bg-[#050B1A] group-hover:text-white transition-all">Plate: {{ $earning->booking->car->license_plate }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Invoicing -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[3rem] shadow-3xl sticky top-8 text-center group">
                        <div class="w-20 h-20 bg-emerald-50 rounded-[2rem] border border-emerald-100 flex items-center justify-center mx-auto mb-10 group-hover:rotate-12 transition-transform shadow-inner text-emerald-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-[#050B1A] italic tracking-tighter uppercase mb-2 leading-none">Controller</h3>
                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mb-12 italic">Tactical Fiscal Management</p>
                        
                        <div class="space-y-4">
                            <a href="{{ route('invoices.download', $earning->booking) }}" class="flex items-center justify-center w-full py-5 bg-[#050B1A] hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-2xl active:scale-95 italic">
                                DOWNLOAD PDF STATEMENT
                            </a>
                            <button class="w-full py-5 bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-[#050B1A] text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl border border-gray-100 transition-all italic">
                                REQUEST FISCAL AUDIT
                            </button>
                        </div>

                        <div class="mt-12 pt-10 border-t border-gray-100">
                             <div class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-6 italic">Integrity Protocol</div>
                             <div class="p-8 bg-gray-50 rounded-[2.5rem] border border-gray-100 flex flex-col items-center">
                                 <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center text-white mb-6 shadow-xl shadow-emerald-500/20">
                                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                 </div>
                                 <div class="text-[9px] text-gray-400 font-black uppercase italic leading-relaxed tracking-widest">TRANSACTION CRYPTOGRAPHICALLY VERIFIED AGAINST MISSION LEDGER LOGS.</div>
                             </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
