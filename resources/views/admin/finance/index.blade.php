<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Financial <span class="text-orange-500">Audit</span>
                </h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">
                    GLOBAL TRANSACTION SETTLEMENT & REVENUE GOVERNANCE
                </p>
            </div>
            <div class="flex items-center gap-8">
                <div class="px-8 py-4 bg-[#050B1A] border border-white/10 rounded-[1.5rem] shadow-2xl">
                    <p class="text-[8px] text-gray-500 font-black uppercase tracking-widest mb-1 italic">Commission Rate</p>
                    <p class="text-xl font-black text-white italic tracking-tighter leading-none">{{ $stats['commission'] }}% <span class="text-[10px] text-orange-500 uppercase tracking-widest ml-1">Fixed</span></p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <!-- Global Financial Indicators -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                
                <div class="bg-white border border-gray-100 p-12 rounded-[3.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                     <div class="absolute top-0 right-0 p-10 opacity-[0.02] group-hover:opacity-[0.05] transition-opacity">
                        <svg class="w-32 h-32 text-[#050B1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic">Gross Platform Volume</h4>
                    <div class="text-5xl font-black text-[#050B1A] tracking-tighter italic leading-none mb-6">৳{{ number_format($stats['total_volume']) }}</div>
                    <div class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[9px] font-black text-emerald-500 uppercase tracking-[0.2em] italic">Live Settlement Flow</span>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 p-12 rounded-[3.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic">Platform Net Yield</h4>
                    <div class="text-5xl font-black text-orange-500 tracking-tighter italic leading-none mb-6">৳{{ number_format($stats['platform_cut']) }}</div>
                    <div class="w-full bg-gray-50 h-1.5 rounded-full overflow-hidden border border-gray-100">
                        <div class="bg-orange-500 h-full w-[15%] rounded-full shadow-[0_0_10px_rgba(249,115,22,0.5)]"></div>
                    </div>
                    <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest mt-4 italic">Estimated Yield after Host Payouts</p>
                </div>

                <div class="bg-[#050B1A] p-12 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Host Disbursment</h4>
                    <div class="text-5xl font-black text-white tracking-tighter italic leading-none mb-6">৳{{ number_format($stats['host_earnings']) }}</div>
                    <div class="flex gap-3">
                         <span class="px-4 py-1.5 bg-white/5 rounded-xl text-[8px] font-black text-gray-400 uppercase tracking-widest italic border border-white/5">90% Spl-Sec</span>
                         <span class="px-4 py-1.5 bg-white/5 rounded-xl text-[8px] font-black text-gray-400 uppercase tracking-widest italic border border-white/5">Instant-Sett</span>
                    </div>
                </div>

            </div>

            <!-- Ledger Activity -->
            <div class="space-y-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 px-4">
                    <h3 class="text-2xl font-black text-[#050B1A] tracking-tighter uppercase italic flex items-center gap-6">
                        <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                        Transaction Ledger
                    </h3>
                    <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                        <div class="w-full md:w-[400px]">
                            <x-search-bar :route="route('admin.finance.index')" placeholder="SEARCH TX ID OR ENTITY..." />
                        </div>
                        <button class="px-8 py-4 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-widest rounded-2xl border border-white/10 hover:bg-orange-600 transition-all shadow-xl italic whitespace-nowrap">
                            Export Ledger
                        </button>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-[3.5rem] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.03)] border-b-0">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-12 py-10">Trace ID / Sequence</th>
                                    <th class="px-12 py-10">Renter (Source)</th>
                                    <th class="px-12 py-10">Fleet Host (Destination)</th>
                                    <th class="px-12 py-10">Platform impact</th>
                                    <th class="px-12 py-10 text-right">Settled Volume</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($transactions as $tx)
                                <tr class="group hover:bg-gray-50/80 transition-all duration-300 cursor-pointer" onclick="window.location='{{ route('admin.finance.show', $tx) }}'">
                                    <td class="px-12 py-12">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-[#050B1A] uppercase italic tracking-tighter">#TX-{{ str_pad($tx->id, 8, '0', STR_PAD_LEFT) }}</span>
                                            <span class="text-[9px] text-orange-500 font-extrabold uppercase mt-2 italic tracking-widest">{{ $tx->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-12">
                                        <div class="flex items-center gap-6 group/renter">
                                            <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-xs font-black text-[#050B1A] group-hover/renter:bg-[#050B1A] group-hover/renter:text-white transition-all duration-500 italic shadow-inner">{{ substr($tx->customer->name, 0, 1) }}</div>
                                            <span class="text-xs font-black text-[#050B1A] uppercase italic tracking-tighter group-hover/renter:text-orange-500 transition-colors">{{ $tx->customer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-12">
                                        <div class="flex items-center gap-6 group/host">
                                            <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-xs font-black text-orange-500 group-hover/host:bg-orange-500 group-hover/host:text-white transition-all duration-500 italic shadow-inner">{{ substr($tx->car->owner->name, 0, 1) }}</div>
                                            <span class="text-xs font-black text-[#050B1A] uppercase italic tracking-tighter group-hover/host:text-orange-500 transition-colors">{{ $tx->car->owner->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-12">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-black text-gray-400 italic tracking-tighter leading-none">৳{{ number_format(($tx->total_price * $stats['commission']) / 100) }}</span>
                                            <span class="text-[8px] bg-orange-500/10 text-orange-500 px-2 py-0.5 rounded-full font-black uppercase italic">{{ $stats['commission'] }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-12 text-right">
                                        <div class="flex items-center justify-end gap-10">
                                            <span class="text-2xl font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($tx->total_price) }}</span>
                                            <div class="opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                                                <div class="w-10 h-10 bg-[#050B1A] rounded-xl flex items-center justify-center shadow-2xl">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-12 py-40 text-center pointer-events-none">
                                            <div class="text-5xl grayscale opacity-10 mb-8">📓</div>
                                            <div class="text-gray-300 text-[11px] font-black uppercase tracking-[0.5em] italic">ZERO FINANCIAL ARTIFACTS DETECTED IN LEDGER</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($transactions->hasPages())
                    <div class="px-4">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

        </div>
    </div>
</x-app-layout>
