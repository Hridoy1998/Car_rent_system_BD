<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-950 text-white p-4">
            <div>
                <h2 class="font-black text-3xl tracking-tighter uppercase italic text-white mb-1">
                    {{ __('Fiscal Intel Ledger') }}
                </h2>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                    <span class="text-[10px] text-gray-500 font-extrabold uppercase tracking-[0.3em]">Accounting Stream Verified</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                 <div class="text-right">
                    <div class="text-[9px] font-black text-gray-600 uppercase tracking-widest leading-none mb-1">Net Liquidity</div>
                    <div class="text-xl font-black text-emerald-400">৳ {{ number_format($stats['total_net']) }}</div>
                 </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
        <!-- Strategic Glows -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-emerald-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Strategic Yield Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Gross Strategic Yield -->
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative group overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
                    <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4">Gross Yield</h4>
                    <div class="text-4xl font-black text-white tracking-tighter mb-2">৳ {{ number_format($stats['total_gross']) }}</div>
                    <p class="text-[9px] text-gray-700 font-black uppercase tracking-widest italic leading-relaxed">Aggregated revenue before platform optimization applied.</p>
                </div>

                <!-- Platform Optimization (Fees) -->
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative group overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-red-500/5 rounded-full blur-3xl group-hover:bg-red-500/10 transition-all"></div>
                    <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4">Commission Impact</h4>
                    <div class="text-4xl font-black text-red-400/80 tracking-tighter mb-2">৳ {{ number_format($stats['total_fees']) }}</div>
                    <p class="text-[9px] text-gray-700 font-black uppercase tracking-widest italic leading-relaxed">Platform infrastructure & insurance liability settlement.</p>
                </div>

                <!-- Projected Pipeline -->
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative group overflow-hidden border-emerald-500/20">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-all"></div>
                    <h4 class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] mb-4">Projected Liquidity</h4>
                    <div class="text-4xl font-black text-white tracking-tighter mb-2">৳ {{ number_format($stats['pending_settlement']) }}</div>
                    <p class="text-[9px] text-gray-700 font-black uppercase tracking-widest italic leading-relaxed">Authorized funds currently in ongoing rental deployments.</p>
                </div>

            </div>

            <!-- Detailed Settlement Ledger -->
            <div class="space-y-8">
                 <div class="flex items-center justify-between px-6">
                    <h3 class="text-xl font-black text-white italic tracking-tight flex items-center gap-4">
                        <span class="w-1.5 h-8 bg-white/10 rounded-full"></span>
                        TRANSACTION MANIFEST
                    </h3>
                    <div class="flex gap-4">
                         <div class="px-5 py-2 bg-white/5 border border-white/10 rounded-2xl text-[9px] font-black text-gray-500 uppercase tracking-widest">Sort: Latest</div>
                    </div>
                </div>

                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3.5rem] overflow-hidden shadow-3xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[9px] font-black text-gray-600 uppercase tracking-[0.3em] bg-white/[0.01] border-b border-white/5">
                                    <th class="px-10 py-8">Reference / Date</th>
                                    <th class="px-10 py-8">Asset Segment</th>
                                    <th class="px-10 py-8">Gross Revenue</th>
                                    <th class="px-10 py-8 text-center text-red-500">Fee Impact</th>
                                    <th class="px-10 py-8 text-right text-emerald-400">Net Yield</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($earnings as $earning)
                                <tr class="group hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                                    <td class="px-10 py-10">
                                        <div class="text-xs font-black text-white uppercase tracking-tighter">REF-{{ str_pad($earning->id, 6, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-[9px] text-gray-600 font-bold uppercase italic mt-1">{{ $earning->created_at->format('M d, Y | H:i') }}</div>
                                    </td>
                                    <td class="px-10 py-10">
                                        <a href="{{ route('cars.show', $earning->booking->car) }}" class="flex items-center gap-4 group/asset">
                                            <div class="w-10 h-10 rounded-xl bg-gray-800 border border-white/10 overflow-hidden flex-shrink-0">
                                                @if($earning->booking->car->images->count() > 0)
                                                    <img src="{{ Storage::url($earning->booking->car->images->first()->image_path) }}" class="w-full h-full object-cover grayscale group-hover/asset:grayscale-0 transition-all">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-xs font-black text-gray-400 group-hover/asset:text-white transition-colors uppercase italic">{{ $earning->booking->car->brand }}</div>
                                                <div class="text-[9px] text-gray-700 font-black uppercase tracking-widest">{{ $earning->booking->car->model }}</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="px-10 py-10">
                                        <div class="text-xs font-bold text-gray-300">৳ {{ number_format($earning->amount + $earning->platform_fee) }}</div>
                                    </td>
                                    <td class="px-10 py-10 text-center">
                                         <div class="inline-block px-3 py-1 bg-red-500/5 border border-red-500/10 rounded-lg text-red-500/60 text-[10px] font-black italic">
                                            - ৳ {{ number_format($earning->platform_fee) }}
                                         </div>
                                    </td>
                                    <td class="px-10 py-10 text-right">
                                        <div class="text-sm font-black text-emerald-400 tracking-tighter shadow-emerald-500/20">৳ {{ number_format($earning->amount) }}</div>
                                        <div class="text-[7px] text-gray-700 font-black uppercase tracking-widest mt-1">Settled & Invoiced</div>
                                    </td>
                                </tr>
                                
                                {{-- Inline Reputation Stream --}}
                                @php
                                    $hasReviewed = \App\Models\UserReview::where('reviewer_id', auth()->id())
                                        ->where('booking_id', $earning->booking_id)
                                        ->exists();
                                @endphp
                                @if(!$hasReviewed)
                                <tr class="bg-indigo-500/[0.02]">
                                    <td colspan="5" class="px-10 py-6">
                                        <div class="flex items-center justify-between gap-8">
                                            <div class="flex items-center gap-3">
                                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Update Renter Reputation ({{ $earning->booking->customer->name }})</span>
                                            </div>
                                            <form action="{{ route('owner.bookings.review', $earning->booking) }}" method="POST" class="flex-1 flex items-center gap-4 bg-gray-950/50 p-2 rounded-2xl border border-white/5">
                                                @csrf
                                                <select name="rating" required class="bg-transparent border-0 text-white rounded-xl text-[10px] py-1 px-3 font-black focus:ring-0 outline-none">
                                                    <option value="5" class="bg-gray-900">5 ★ Elite</option>
                                                    <option value="4" class="bg-gray-900">4 ★ Reliable</option>
                                                    <option value="3" class="bg-gray-900">3 ★ Average</option>
                                                    <option value="2" class="bg-gray-900">2 ★ Sub-par</option>
                                                    <option value="1" class="bg-gray-900">1 ★ Violation</option>
                                                </select>
                                                <div class="w-px h-4 bg-white/10"></div>
                                                <input type="text" name="comment" placeholder="Log conduct artifacts..." class="flex-1 bg-transparent border-0 text-white rounded-xl text-[10px] py-1 px-2 focus:ring-0 outline-none font-bold placeholder:text-gray-700">
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-[8px] font-black uppercase rounded-lg transition-all shadow-lg shadow-indigo-600/20 leading-none">Log Reputation</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="5" class="px-10 py-32 text-center">
                                         <div class="text-[10px] text-gray-700 font-black uppercase tracking-[0.5em] italic opacity-20">No fiscal artifacts found in the accounting stream</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($earnings->hasPages())
                    <div class="mt-12">
                         {{ $earnings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
