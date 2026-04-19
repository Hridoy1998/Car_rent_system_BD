<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8 px-4 sm:px-0">
            <div>
                <h2 class="font-black text-3xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Financial <span class="text-orange-500">Audit</span>
                </h2>
                <div class="flex items-center gap-4 mt-4">
                    <span class="w-10 h-px bg-[#050B1A]/20"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-500 font-black uppercase tracking-[0.4em] italic leading-none">
                        GLOBAL TRANSACTION SETTLEMENT & REVENUE GOVERNANCE
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="px-6 py-4 bg-[#050B1A] rounded-[1.8rem] shadow-xl shadow-[#050B1A]/20 border border-white/5">
                    <p class="text-[8px] text-gray-500 font-black uppercase tracking-widest mb-1 italic">Commission Rate</p>
                    <p class="text-xl font-black text-white italic tracking-tighter leading-none">{{ $stats['commission'] }}% <span class="text-[10px] text-orange-500 uppercase tracking-widest ml-1">Fixed</span></p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <!-- Global Financial Indicators -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                     <div class="absolute top-0 right-0 p-8 opacity-[0.05] group-hover:opacity-[0.1] transition-opacity">
                        <svg class="w-24 h-24 text-[#050B1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-6 italic flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Gross Platform Volume
                    </h4>
                    <div class="text-4xl font-black text-[#050B1A] tracking-tighter italic leading-none mb-6">৳{{ number_format($stats['total_volume']) }}</div>
                    <div class="flex items-center gap-3">
                        <span class="text-[9px] font-black text-emerald-600 uppercase tracking-[0.2em] italic bg-emerald-50 px-3 py-1 rounded-lg">Settlement Active</span>
                    </div>
                </div>

                <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <h4 class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-6 italic flex items-center gap-2">
                         <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                         Platform Net Yield
                    </h4>
                    <div class="text-4xl font-black text-orange-500 tracking-tighter italic leading-none mb-6">৳{{ number_format($stats['platform_cut']) }}</div>
                    <div class="w-full bg-gray-50 h-1.5 rounded-xl overflow-hidden border border-gray-100">
                        <div class="bg-orange-500 h-full w-[15%] rounded-full shadow-[0_0_10px_rgba(249,115,22,0.3)]"></div>
                    </div>
                    <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest mt-4 italic opacity-60">Net Yield after Host Payouts</p>
                </div>

                <div class="bg-[#050B1A] p-10 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_50%_-20%,#4f46e5,transparent)]"></div>
                    <h4 class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Host Disbursement</h4>
                    <div class="text-4xl font-black text-white tracking-tighter italic leading-none mb-6">৳{{ number_format($stats['host_earnings']) }}</div>
                    <div class="flex flex-wrap gap-3 relative z-10">
                         <span class="px-4 py-1.5 bg-white/5 rounded-xl text-[8px] font-black text-gray-400 uppercase tracking-widest italic border border-white/5">90:10 Split</span>
                         <span class="px-4 py-1.5 bg-white/5 rounded-xl text-[8px] font-black text-gray-400 uppercase tracking-widest italic border border-white/5">Instant-Sett</span>
                    </div>
                </div>

            </div>

            <!-- Ledger Activity -->
            <div class="space-y-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <h3 class="text-xl md:text-2xl font-black text-[#050B1A] tracking-tighter uppercase italic flex items-center gap-6">
                        <span class="w-10 h-1 bg-orange-500 rounded-full"></span>
                        Transaction Ledger
                    </h3>
                    <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                        <div class="w-full md:w-[350px]">
                            <form action="{{ route('admin.finance.index') }}" method="GET" class="relative group">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="SEARCH TX ID OR ENTITY..." 
                                    class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-[11px] font-black uppercase tracking-widest placeholder-gray-300 focus:border-[#050B1A] focus:ring-0 transition-all shadow-lg shadow-gray-200/50">
                                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-hover:text-[#050B1A] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </button>
                            </form>
                        </div>
                        <button class="w-full md:w-auto px-8 py-4 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-widest rounded-2xl border-2 border-white/10 hover:bg-orange-600 transition-all shadow-xl italic whitespace-nowrap">
                            Export Ledger
                        </button>
                    </div>
                </div>

                <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                    
                    <!-- Desktop Terminal -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 border-b border-gray-50">
                                    <th class="px-12 py-8">Trace ID / Sequence</th>
                                    <th class="px-12 py-8">Renter (Source)</th>
                                    <th class="px-12 py-8">Fleet Host (Dest)</th>
                                    <th class="px-12 py-8">Impact</th>
                                    <th class="px-12 py-8 text-right">Settled Volume</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($transactions as $tx)
                                <tr class="group hover:bg-gray-50/50 transition-all duration-300 cursor-pointer" onclick="window.location='{{ route('admin.finance.show', $tx) }}'">
                                    <td class="px-12 py-10">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-[#050B1A] uppercase italic tracking-tighter group-hover:text-indigo-600 transition-colors">#TX-{{ str_pad($tx->id, 8, '0', STR_PAD_LEFT) }}</span>
                                            <span class="text-[9px] text-gray-400 font-black uppercase mt-2 italic tracking-widest opacity-60">{{ $tx->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-gray-100 border-2 border-white flex items-center justify-center text-[10px] font-black text-[#050B1A] italic shadow-sm">{{ substr($tx->customer->name, 0, 1) }}</div>
                                            <span class="text-[11px] font-black text-[#050B1A] uppercase italic tracking-tight">{{ $tx->customer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-orange-50 border-2 border-white flex items-center justify-center text-[10px] font-black text-orange-500 italic shadow-sm">{{ substr($tx->car->owner->name, 0, 1) }}</div>
                                            <span class="text-[11px] font-black text-[#050B1A] uppercase italic tracking-tight">{{ $tx->car->owner->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        <div class="flex items-center gap-3">
                                            <span class="text-xs font-black text-gray-400 italic tracking-tighter leading-none">৳{{ number_format(($tx->total_price * $stats['commission']) / 100) }}</span>
                                            <span class="text-[8px] bg-orange-500/10 text-orange-500 px-2 py-0.5 rounded-full font-black uppercase italic">{{ $stats['commission'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10 text-right">
                                        <div class="flex items-center justify-end gap-8">
                                            <span class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($tx->total_price) }}</span>
                                            <div class="w-10 h-10 bg-[#050B1A] rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-12 py-32 text-center pointer-events-none">
                                            <div class="text-5xl opacity-10 mb-6">📓</div>
                                            <div class="text-gray-300 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">ZERO FINANCIAL ARTIFACTS DETECTED</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Tactical Manifest -->
                    <div class="block md:hidden p-6 space-y-6 bg-gray-50/30">
                        @forelse($transactions as $tx)
                            <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden active:scale-[0.98] transition-all" onclick="window.location='{{ route('admin.finance.show', $tx) }}'">
                                <div class="flex items-center justify-between">
                                    <div class="text-[10px] text-indigo-500 font-black uppercase tracking-widest italic leading-none">TX #IDX-{{ str_pad($tx->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    <span class="px-3 py-1 bg-[#050B1A] text-white rounded-lg text-[8px] font-black uppercase tracking-widest italic shadow-lg">SETTLED</span>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                     <div class="space-y-2">
                                         <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic">Source (Renter)</p>
                                         <p class="text-[11px] font-black text-[#050B1A] uppercase italic leading-none truncate">{{ $tx->customer->name }}</p>
                                     </div>
                                     <div class="space-y-2 text-right">
                                         <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic">Dest (Host)</p>
                                         <p class="text-[11px] font-black text-orange-500 uppercase italic leading-none truncate">{{ $tx->car->owner->name }}</p>
                                     </div>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                    <div>
                                        <div class="text-2xl font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($tx->total_price) }}</div>
                                        <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic mt-1 leading-none">Total Mission Volume</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-black text-orange-500 italic leading-none mb-1">৳{{ number_format(($tx->total_price * $stats['commission']) / 100) }}</div>
                                        <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Platform Fee (10%)</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                             <div class="py-24 text-center">
                                <p class="text-gray-300 text-[9px] font-black uppercase tracking-[0.5em] italic">No Manifest Artifacts Detected</p>
                             </div>
                        @endforelse
                    </div>

                    <!-- Operational Pagination -->
                    @if($transactions->hasPages())
                        <div class="px-8 py-10 md:px-12 bg-gray-50/50 border-t border-gray-50 overflow-x-auto">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
