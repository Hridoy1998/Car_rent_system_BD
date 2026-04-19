<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8 px-4 sm:px-0">
            <div>
                <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Financial <span class="text-orange-500">Pulse</span>
                </h2>
                <div class="flex items-center gap-4 mt-3">
                    <span class="w-12 h-px bg-orange-500/30"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] italic">
                        CRS BD FISCAL SETTLEMENT LEDGER
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-6 md:gap-10">
                <div class="text-right">
                    <div class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-2">Net Liquidity</div>
                    <div class="text-3xl md:text-4xl font-black text-[#050B1A] tracking-tighter italic leading-none group">
                        <span class="text-orange-500 text-sm md:text-base mr-1">৳</span>{{ number_format($stats['total_net']) }}
                    </div>
                </div>
                <div class="h-10 w-px bg-gray-100 hidden md:block"></div>
                <div class="flex items-center gap-3 bg-[#050B1A] px-5 py-3 rounded-2xl border border-white/5 shadow-2xl">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-white text-[9px] font-black uppercase tracking-[0.2em] italic">Secure</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">

            <!-- Strategic Yield Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10">

                <!-- Gross Yield -->
                <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative group overflow-hidden transition-all hover:shadow-2xl">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-50/50 rounded-full blur-3xl group-hover:bg-indigo-100/50 transition-all duration-700"></div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                        Gross Yield
                        <span class="w-8 h-px bg-gray-100"></span>
                    </h4>
                    <div class="text-4xl md:text-5xl font-black text-[#050B1A] tracking-tighter italic leading-none mb-3 group-hover:translate-x-1 transition-transform">
                        <span class="text-orange-500 text-sm md:text-base mr-1 italic">৳</span>{{ number_format($stats['total_gross']) }}
                    </div>
                    <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic leading-relaxed">Aggregated Platform Inflow Artifacts.</p>
                </div>

                <!-- Platform Fee -->
                <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative group overflow-hidden transition-all hover:shadow-2xl">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-orange-50/50 rounded-full blur-3xl group-hover:bg-orange-100/50 transition-all duration-700"></div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                        Platform Fee
                        <span class="w-8 h-px bg-gray-100"></span>
                    </h4>
                    <div class="text-4xl md:text-5xl font-black text-orange-500 tracking-tighter italic leading-none mb-3 group-hover:translate-x-1 transition-transform">
                        <span class="text-gray-300 text-sm md:text-base mr-1 italic">৳</span>{{ number_format($stats['total_fees']) }}
                    </div>
                    <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic leading-relaxed">Service Infrastructure Liabilities Settled.</p>
                </div>

                <!-- Pipeline -->
                <div class="bg-[#050B1A] p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-2xl relative group overflow-hidden transition-all hover:scale-[1.02]">
                    <div class="absolute -right-6 -top-6 w-40 h-40 bg-orange-500/10 rounded-full blur-3xl group-hover:bg-orange-500/20 transition-all duration-1000"></div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                        Projected Pipeline
                        <span class="w-8 h-px bg-white/5"></span>
                    </h4>
                    <div class="text-4xl md:text-5xl font-black text-white tracking-tighter italic leading-none mb-3">
                        <span class="text-emerald-500 text-sm md:text-base mr-1 italic">৳</span>{{ number_format($stats['pending_settlement']) }}
                    </div>
                    <p class="text-[8px] text-gray-500 font-black uppercase tracking-widest italic leading-relaxed">Funds Committed in Active Deployments.</p>
                </div>
            </div>

            <!-- Tactical Settlement Ledger -->
            <div class="space-y-8 md:space-y-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 px-4">
                    <div class="flex items-center gap-5">
                        <div class="w-10 h-10 bg-[#050B1A] rounded-xl flex items-center justify-center text-white italic font-black text-lg shadow-xl shadow-[#050B1A]/20">LM</div>
                        <div>
                            <h3 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Ledger Manifest</h3>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-1.5 italic">Sequential Transaction Registry</p>
                        </div>
                    </div>
                    <div class="w-full md:w-96">
                        <x-search-bar :route="route('owner.finance.index')" placeholder="Audit Registry..." />
                    </div>
                </div>

                <div class="space-y-6">
                    @forelse($earnings as $earning)
                        <div class="bg-white border border-gray-100 rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group/card relative">
                            <!-- Track Visual -->
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gray-50 group-hover/card:bg-orange-500 transition-colors"></div>
                            
                            <div class="p-6 md:p-10 flex flex-col md:flex-row items-center gap-10">
                                <!-- Sequence Artifact -->
                                <div class="flex items-center gap-6 w-full md:w-auto">
                                    <div class="w-16 h-16 bg-gray-50 rounded-2xl flex flex-col items-center justify-center border border-gray-100 shadow-inner group-hover/card:bg-[#050B1A] group-hover/card:text-white transition-all duration-700">
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">{{ $earning->created_at->format('M') }}</span>
                                        <span class="text-2xl font-black italic leading-none">{{ $earning->created_at->format('d') }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic mb-1">FISCAL REF</div>
                                        <div class="text-sm font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">REF-{{ str_pad($earning->id, 6, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>

                                <!-- Asset Link -->
                                <div class="flex items-center gap-6 flex-1 w-full md:w-auto border-t md:border-t-0 md:border-l border-gray-50 pt-6 md:pt-0 md:pl-10">
                                    <div class="w-20 h-14 bg-gray-900 rounded-xl overflow-hidden shadow-2xl relative group/img shrink-0 border-2 border-white">
                                        <img src="{{ $earning->booking->car->primary_image_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-125">
                                        <div class="absolute inset-0 bg-orange-500/10 opacity-0 group-hover/card:opacity-100 transition-opacity"></div>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-black text-[#050B1A] uppercase italic leading-none truncate">{{ $earning->booking->car->brand }} <span class="text-orange-500">{{ $earning->booking->car->model }}</span></div>
                                        <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-2 italic flex items-center gap-3">
                                            {{ $earning->booking->car->license_plate }}
                                            <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                            {{ \Carbon\Carbon::parse($earning->booking->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($earning->booking->end_date)->format('d M') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Settlement Delta -->
                                <div class="flex items-center gap-8 md:gap-14 w-full md:w-auto border-t md:border-t-0 md:border-l border-gray-50 pt-6 md:pt-0 md:pl-10">
                                    <div class="text-center md:text-left">
                                        <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Gross Artifact</div>
                                        <div class="text-sm font-black text-gray-400 italic line-through decoration-orange-500/30">৳{{ number_format($earning->amount + $earning->platform_fee) }}</div>
                                    </div>
                                    <div class="text-center md:text-right flex-1 md:flex-none">
                                        <div class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-1 italic">Net Settlement</div>
                                        <div class="text-3xl font-black text-[#050B1A] italic tracking-tighter leading-none group-hover/card:text-orange-500 transition-colors">৳{{ number_format($earning->amount) }}</div>
                                    </div>
                                </div>

                                <!-- Command Artifact -->
                                <div class="w-full md:w-auto pt-6 md:pt-0">
                                    <a href="{{ route('owner.finance.show', $earning) }}" class="flex items-center justify-center gap-3 py-4 md:py-0 md:w-16 md:h-16 bg-gray-50 md:bg-transparent rounded-2xl md:rounded-3xl hover:bg-[#050B1A] hover:text-white transition-all duration-500 border border-gray-100 md:border-none">
                                        <span class="md:hidden text-[9px] font-black uppercase tracking-widest italic">View Artifact</span>
                                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Post-Mortem Stream (Inline Review) -->
                            @php
                                $hasReviewed = \App\Models\UserReview::where('reviewer_id', auth()->id())
                                    ->where('booking_id', $earning->booking_id)
                                    ->exists();
                            @endphp
                            @if(!$hasReviewed)
                                <div class="px-6 md:px-10 pb-6 md:pb-10">
                                    <div class="bg-gray-50/50 rounded-3xl border border-gray-100 p-5 md:p-8 flex flex-col lg:flex-row items-center gap-8">
                                        <div class="flex items-center gap-4 shrink-0 w-full lg:w-auto">
                                            <div class="w-1.5 h-8 bg-orange-500 rounded-full"></div>
                                            <div class="min-w-0">
                                                <div class="text-[10px] font-black text-[#050B1A] uppercase italic">Update Renter Reputation</div>
                                                <div class="text-[8px] text-gray-400 font-bold uppercase tracking-widest mt-1 truncate">{{ $earning->booking->customer->name }} Identity Artifact</div>
                                            </div>
                                        </div>
                                        <form action="{{ route('owner.bookings.review', $earning->booking) }}" method="POST" class="flex-1 w-full flex flex-col sm:flex-row items-center gap-4">
                                            @csrf
                                            <div class="relative w-full sm:w-48">
                                                <select name="rating" required class="w-full bg-white border border-gray-100 rounded-xl py-3 px-5 text-[10px] font-black uppercase italic italic appearance-none focus:ring-4 focus:ring-orange-500/5 focus:border-orange-500 outline-none transition-all">
                                                    <option value="5">5 ★ Elite</option>
                                                    <option value="4">4 ★ Reliable</option>
                                                    <option value="3">3 ★ Nominal</option>
                                                    <option value="2">2 ★ Breach</option>
                                                    <option value="1">1 ★ Violation</option>
                                                </select>
                                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                                </div>
                                            </div>
                                            <input type="text" name="comment" required placeholder="Log conduct artifacts..." class="flex-1 w-full bg-white border border-gray-100 rounded-xl py-3 px-5 text-[10px] font-black uppercase italic placeholder:text-gray-200 focus:ring-4 focus:ring-orange-500/5 focus:border-orange-500 outline-none transition-all">
                                            <button type="submit" class="w-full sm:w-auto px-10 py-3 bg-[#050B1A] hover:bg-orange-500 text-white text-[9px] font-black uppercase tracking-widest italic rounded-xl transition-all shadow-xl leading-none">Log ARTIFACT</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="bg-white border border-gray-100 rounded-[3.5rem] p-32 text-center">
                            <div class="text-5xl grayscale opacity-10 mb-8">📉</div>
                            <h3 class="text-gray-300 text-[10px] font-black uppercase tracking-[0.5em] italic">No Fiscal Streams Detected</h3>
                        </div>
                    @endforelse
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