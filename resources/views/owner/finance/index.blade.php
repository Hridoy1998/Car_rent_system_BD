<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Financial <span class="text-orange-500">Pulse</span>
                </h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">
                    CRS BD FISCAL MONITORING & SETTLEMENT LEDGER
                </p>
            </div>
            <div class="flex items-center gap-8">
                <div class="text-right">
                    <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-2">Net Liquidity</div>
                    <div class="text-3xl font-black text-[#050B1A] tracking-tighter italic">৳{{ number_format($stats['total_net']) }}</div>
                </div>
                <div class="h-12 w-px bg-gray-100 hidden md:block"></div>
                <div class="flex items-center gap-4 bg-[#050B1A] px-6 py-3 rounded-2xl border border-white/10 shadow-xl">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-white text-[10px] font-black uppercase tracking-[0.2em] italic">Accounting Secure</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">

            <!-- Strategic Yield Metrics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Gross Strategic Yield -->
                <div class="bg-white border border-gray-100 p-10 rounded-[3.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] relative group overflow-hidden hover:shadow-2xl transition-all duration-500">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-900/[0.02] rounded-full blur-3xl group-hover:bg-blue-900/[0.04] transition-all"></div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 italic">Gross Yield</h4>
                    <div class="text-4xl font-black text-[#050B1A] tracking-tighter italic leading-none mb-3">৳{{ number_format($stats['total_gross']) }}</div>
                    <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic leading-relaxed">
                        AGGREGATED REVENUE BEFORE PLATFORM OPTIMIZATION.
                    </p>
                </div>

                <!-- Platform Optimization -->
                <div class="bg-white border border-gray-100 p-10 rounded-[3.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] relative group overflow-hidden hover:shadow-2xl transition-all duration-500">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-orange-500/[0.02] rounded-full blur-3xl group-hover:bg-orange-500/[0.04] transition-all"></div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 italic">Commission Impact</h4>
                    <div class="text-4xl font-black text-orange-500 tracking-tighter italic leading-none mb-3">৳{{ number_format($stats['total_fees']) }}</div>
                    <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic leading-relaxed">
                        INFRASTRUCTURE & SERVICE LIABILITY SETTLEMENT.
                    </p>
                </div>

                <!-- Projected Pipeline -->
                <div class="bg-[#050B1A] p-10 rounded-[3.5rem] shadow-2xl relative group overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl opacity-50 group-hover:opacity-100 transition-all"></div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-6 italic">Projected Liquidity</h4>
                    <div class="text-4xl font-black text-white tracking-tighter italic leading-none mb-3">৳{{ number_format($stats['pending_settlement']) }}</div>
                    <p class="text-[9px] text-gray-500 font-extrabold uppercase tracking-widest italic leading-relaxed">
                        FUNDS CURRENTLY IN ACTIVE MISSION DEPLOYMENTS.
                    </p>
                </div>

            </div>

            <!-- Detailed Settlement Ledger -->
            <div class="space-y-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 px-4">
                    <h3 class="text-2xl font-black text-[#050B1A] tracking-tighter uppercase italic flex items-center gap-6">
                        <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                        Transaction Manifest
                    </h3>
                    <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                        <div class="w-full sm:flex-1 min-w-[300px]">
                            <x-search-bar :route="route('owner.finance.index')"
                                placeholder="SEARCH REFERENCE OR CAR..." />
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-[3.5rem] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.03)] border-b-0">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-12 py-10">Reference / Sequence</th>
                                    <th class="px-12 py-10">Asset Segment</th>
                                    <th class="px-12 py-10">Gross Yield</th>
                                    <th class="px-12 py-10 text-center">Fee impact</th>
                                    <th class="px-12 py-10 text-right">Net Yield</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($earnings as $earning)
                                <tr class="group hover:bg-gray-50/80 transition-all duration-300 cursor-pointer" 
                                    onclick="window.location='{{ route('owner.finance.show', $earning) }}'">
                                    <td class="px-12 py-12">
                                        <div class="text-sm font-black text-[#050B1A] uppercase tracking-tighter italic font-outfit">
                                            REF-{{ str_pad($earning->id, 6, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-[9px] text-orange-500 font-extrabold uppercase italic tracking-widest mt-2">
                                            {{ $earning->created_at->format('M d, Y | H:i') }}</div>
                                    </td>
                                    <td class="px-12 py-12">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-12 rounded-[1rem] bg-gray-50 border border-gray-100 overflow-hidden shrink-0 shadow-inner">
                                                @if($earning->booking->car->images->count() > 0)
                                                    <img src="{{ Storage::url($earning->booking->car->images->first()->image_path) }}"
                                                        class="w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-xs font-black text-[#050B1A] uppercase italic leading-none">{{ $earning->booking->car->brand }}</div>
                                                <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-1 italic">{{ $earning->booking->car->model }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-12">
                                        <div class="text-sm font-black text-[#050B1A] italic tracking-tighter">৳{{ number_format($earning->amount + $earning->platform_fee) }}</div>
                                    </td>
                                    <td class="px-12 py-12 text-center">
                                        <div class="inline-block px-4 py-1.5 bg-orange-500/10 border border-orange-500/20 rounded-xl text-orange-600 text-[10px] font-black italic">
                                            - ৳{{ number_format($earning->platform_fee) }}
                                        </div>
                                    </td>
                                    <td class="px-12 py-12 text-right">
                                        <div class="flex items-center justify-end gap-10">
                                            <div>
                                                <div class="text-xl font-black text-[#050B1A] tracking-tighter italic leading-none">৳{{ number_format($earning->amount) }}</div>
                                                <div class="text-[8px] text-emerald-500 font-black uppercase tracking-widest mt-2 italic flex items-center justify-end gap-2">
                                                    <span class="w-1 h-1 bg-emerald-500 rounded-full animate-pulse"></span>
                                                    Settled & Invoiced
                                                </div>
                                            </div>
                                            <div class="opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                                                <div class="w-10 h-10 bg-[#050B1A] rounded-xl flex items-center justify-center shadow-2xl">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Inline Reputation Stream --}}
                                @php
                                    $hasReviewed = \App\Models\UserReview::where('reviewer_id', auth()->id())
                                        ->where('booking_id', $earning->booking_id)
                                        ->exists();
                                @endphp
                                @if(!$hasReviewed)
                                    <tr class="bg-blue-900/[0.01]">
                                        <td colspan="5" class="px-12 py-8">
                                            <div class="flex items-center justify-between gap-12 bg-gray-50/50 p-6 rounded-[2rem] border border-gray-100">
                                                <div class="flex items-center gap-4 shrink-0">
                                                    <div class="w-1.5 h-6 bg-orange-500 rounded-full"></div>
                                                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] italic">Update Renter Reputation ({{ $earning->booking->customer->name }})</span>
                                                </div>
                                                <form action="{{ route('owner.bookings.review', $earning->booking) }}"
                                                    method="POST"
                                                    class="flex-1 flex items-center gap-6">
                                                    @csrf
                                                    <select name="rating" required
                                                        class="bg-white border border-gray-100 text-[#050B1A] rounded-xl text-[10px] py-3 px-6 font-black focus:ring-1 focus:ring-orange-500 outline-none uppercase italic">
                                                        <option value="5" class="bg-white">5 ★ Elite</option>
                                                        <option value="4" class="bg-white">4 ★ Reliable</option>
                                                        <option value="3" class="bg-white">3 ★ Average</option>
                                                        <option value="2" class="bg-white">2 ★ Sub-par</option>
                                                        <option value="1" class="bg-white">1 ★ Violation</option>
                                                    </select>
                                                    <input type="text" name="comment" placeholder="LOG CONDUCT ARTIFACTS..."
                                                        class="flex-1 bg-white border border-gray-100 text-[#050B1A] rounded-xl text-[10px] py-3 px-6 focus:ring-1 focus:ring-orange-500 outline-none font-black placeholder:text-gray-300 italic">
                                                    <button type="submit"
                                                        class="px-8 py-3 bg-[#050B1A] hover:bg-orange-600 text-white text-[9px] font-black uppercase rounded-xl transition-all shadow-xl leading-none italic tracking-widest whitespace-nowrap">
                                                        Log Reputation
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-12 py-32 text-center pointer-events-none">
                                            <div class="text-4xl grayscale opacity-10 mb-6">📉</div>
                                            <div class="text-gray-300 text-[10px] font-black uppercase tracking-[0.5em] italic">NO FISCAL ARTIFACTS DETECTED IN STREAM</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($earnings->hasPages())
                    <div class="mt-12 px-4">
                        {{ $earnings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
</x-app-layout>