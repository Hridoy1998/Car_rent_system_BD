<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                    {{ __('Financial Audit Hub') }}
                </h2>
                <p class="text-[10px] text-emerald-400 font-bold uppercase tracking-[0.2em] mt-1">Global transaction tracking and revenue settlement platform</p>
            </div>
            <div class="flex gap-4">
                 <div class="px-6 py-2 bg-gray-900 border border-white/10 rounded-2xl">
                    <p class="text-[8px] text-gray-600 font-black uppercase mb-1">Commission Rate</p>
                    <p class="text-sm font-black text-white italic">{{ $stats['commission'] }}% Fixed</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600/5 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Global Financial Indicators -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                     <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-20 h-20 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 italic">Gross Platform Volume</h4>
                    <div class="text-5xl font-black text-white tracking-tighter shadow-emerald-500/20 drop-shadow-2xl">৳ {{ number_format($stats['total_volume']) }}</div>
                    <div class="mt-6 flex items-center text-[10px] font-black text-emerald-500 bg-emerald-500/10 w-fit px-4 py-1.5 rounded-xl border border-emerald-500/20">
                         LIVE SETTLEMENT FLOW
                    </div>
                </div>

                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                     <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 italic">Platform Net Revenue</h4>
                    <div class="text-5xl font-black text-indigo-400 tracking-tighter">৳ {{ number_format($stats['platform_cut']) }}</div>
                    <div class="mt-6 space-y-2">
                        <div class="w-full bg-white/5 h-1 rounded-full overflow-hidden">
                            <div class="bg-indigo-500 h-full w-full opacity-50"></div>
                        </div>
                        <p class="text-[9px] text-gray-600 font-bold uppercase">Estimated Yield after Host Payouts</p>
                    </div>
                </div>

                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                     <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 italic">Host Life Earnings</h4>
                    <div class="text-5xl font-black text-pink-500 tracking-tighter">৳ {{ number_format($stats['host_earnings']) }}</div>
                    <div class="mt-6 flex gap-2">
                         <span class="px-3 py-1 bg-white/5 rounded-lg text-[8px] font-black text-gray-500 uppercase">90% Split</span>
                         <span class="px-3 py-1 bg-white/5 rounded-lg text-[8px] font-black text-gray-500 uppercase">Instant Pay</span>
                    </div>
                </div>

            </div>

            <!-- Ledger Activity -->
            <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                <div class="p-10 border-b border-white/5 flex items-center justify-between">
                    <div>
                         <h3 class="text-2xl font-black text-white tracking-tight italic">Transaction Ledger</h3>
                         <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Audit of every paid lease agreement on the platform</p>
                    </div>
                    <button class="px-6 py-3 bg-white/5 hover:bg-white/10 text-[10px] font-black text-gray-300 uppercase tracking-widest rounded-2xl border border-white/5 transition-all">Export CSV Manifest</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[9px] font-black text-gray-600 uppercase tracking-[0.3em] bg-white/[0.02]">
                                <th class="px-10 py-6">Trace ID</th>
                                <th class="px-10 py-6">Renter (Source)</th>
                                <th class="px-10 py-6">Fleet Host (Destination)</th>
                                <th class="px-10 py-6">Platform Fee</th>
                                <th class="px-10 py-6 text-right">Settled Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($transactions as $tx)
                            <tr class="group hover:bg-white/[0.01] transition-colors">
                                <td class="px-10 py-8">
                                    <div class="flex flex-col">
                                        <span class="text-[11px] font-mono font-black text-indigo-400">#TX-{{ str_pad($tx->id, 8, '0', STR_PAD_LEFT) }}</span>
                                        <span class="text-[8px] text-gray-700 font-black uppercase mt-1">{{ $tx->created_at->format('M d, Y H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <a href="{{ route('profiles.show', $tx->customer) }}" class="flex items-center space-x-3 group/renter">
                                        <div class="w-8 h-8 rounded-xl bg-gray-800 flex items-center justify-center text-[10px] font-black text-gray-500 group-hover/renter:bg-indigo-600 group-hover/renter:text-white transition-all">{{ substr($tx->customer->name, 0, 1) }}</div>
                                        <span class="text-xs font-black text-gray-200 uppercase group-hover/renter:text-indigo-400 transition-colors">{{ $tx->customer->name }}</span>
                                    </a>
                                </td>
                                <td class="px-10 py-8">
                                    <a href="{{ route('profiles.show', $tx->car->owner) }}" class="flex items-center space-x-3 group/host">
                                        <div class="w-8 h-8 rounded-xl bg-gray-800 flex items-center justify-center text-[10px] font-black text-pink-500 group-hover/host:bg-pink-600 group-hover/host:text-white transition-all">{{ substr($tx->car->owner->name, 0, 1) }}</div>
                                        <span class="text-xs font-black text-gray-200 uppercase group-hover/host:text-pink-400 transition-colors">{{ $tx->car->owner->name }}</span>
                                    </a>
                                </td>
                                <td class="px-10 py-8">
                                    <span class="text-[11px] font-black text-gray-500 italic">৳ {{ number_format(($tx->total_price * $stats['commission']) / 100) }}</span>
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <span class="text-lg font-black text-white italic tracking-tighter">৳ {{ number_format($tx->total_price) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-10 border-t border-white/5 bg-white/[0.01]">
                    {{ $transactions->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
