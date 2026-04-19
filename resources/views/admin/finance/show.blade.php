<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.finance.index') }}" class="w-14 h-14 bg-white border-2 border-gray-100 rounded-2xl flex items-center justify-center text-[#050B1A] hover:bg-[#050B1A] hover:text-white hover:border-[#050B1A] transition-all shadow-lg active:scale-95 group">
                    <svg class="w-6 h-6 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl md:text-4xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                        Audit <span class="text-orange-500">Terminal</span>
                    </h2>
                    <div class="flex items-center gap-3 mt-3">
                        <span class="w-8 h-px bg-[#050B1A]/20"></span>
                        <p class="text-[9px] md:text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] italic leading-none">
                            Transaction Certificate #TX-{{ str_pad($booking->id, 8, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                 <span class="px-6 py-2.5 bg-emerald-50 text-emerald-600 border-2 border-white rounded-2xl text-[10px] font-black uppercase tracking-widest italic shadow-sm">Protocol Settled</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <!-- Strategic Yield Artifact Ribbon -->
            <div class="bg-[#050B1A] p-10 md:p-12 rounded-[3.5rem] md:rounded-[4.5rem] shadow-2xl relative overflow-hidden group">
                 <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_50%_-20%,#4f46e5,transparent)]"></div>
                 <div class="absolute -right-20 -top-20 w-80 h-80 bg-orange-500/10 rounded-full blur-[100px] pointer-events-none group-hover:bg-orange-500/20 transition-all"></div>
                 
                 <div class="grid grid-cols-1 md:grid-cols-4 gap-12 items-center relative z-10">
                     <div class="md:col-span-1 border-r border-white/5 pr-12 text-center md:text-left">
                         <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4 italic">Gross Platform Volume</h4>
                         <div class="text-5xl md:text-6xl font-black text-white tracking-tighter italic leading-none">৳{{ number_format($booking->total_price) }}</div>
                         <div class="mt-6 flex items-center justify-center md:justify-start gap-2">
                             <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                             <span class="text-[9px] font-black text-emerald-400 uppercase tracking-widest italic">Authorization Finalized</span>
                         </div>
                     </div>
                     
                     <div class="md:col-span-2 grid grid-cols-2 gap-8 text-center px-4">
                         <div>
                             <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-3 italic">Platform Commission ({{ $commissionPercent }}%)</h4>
                             <div class="text-3xl font-black text-orange-500 tracking-tighter italic">৳{{ number_format($platformFee) }}</div>
                         </div>
                         <div>
                             <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-3 italic">Host Remittance</h4>
                             <div class="text-3xl font-black text-indigo-400 tracking-tighter italic">৳{{ number_format($hostEarning) }}</div>
                         </div>
                     </div>

                     <div class="md:col-span-1 flex flex-col gap-4" x-data="{ showAdjust: false }">
                         <a href="{{ route('invoices.download', $booking) }}" class="w-full py-4 bg-white/5 hover:bg-orange-500 hover:text-white text-[9px] font-black text-gray-400 uppercase tracking-widest rounded-2xl border-2 border-white/5 hover:border-orange-500 transition-all text-center flex items-center justify-center italic">
                             Download Audit Artifact
                         </a>
                         <button @click="showAdjust = !showAdjust" class="w-full py-4 bg-white/5 hover:bg-white/10 text-[9px] font-black text-gray-400 uppercase tracking-widest rounded-2xl border-2 border-white/5 transition-all italic active:scale-95">
                            <span x-text="showAdjust ? 'Cancel Adjustment' : 'Manual Adjust protocol'"></span>
                         </button>

                         <!-- Strategic Adjustment Panel -->
                         <div x-show="showAdjust" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="mt-4 p-6 bg-gray-900 border-2 border-orange-500/20 rounded-[2rem] shadow-2xl relative" style="display: none;">
                             <div class="absolute -top-3 left-10 px-3 bg-orange-500 text-white text-[8px] font-black uppercase tracking-widest italic rounded-full shadow-lg">Manual Override</div>
                             <form action="{{ route('admin.finance.adjust', $booking) }}" method="POST" class="space-y-6">
                                 @csrf
                                 @method('PATCH')
                                 <div>
                                     <label class="text-[8px] text-gray-500 font-black uppercase tracking-widest block mb-2 italic">Revised Mission Volume (Gross ৳)</label>
                                     <input type="number" name="total_price" value="{{ $booking->total_price }}" step="0.01" required
                                            class="w-full bg-[#050B1A] border-2 border-white/5 rounded-xl px-4 py-3 text-sm font-black text-white focus:border-orange-500 focus:ring-0 transition-all italic">
                                 </div>
                                 <button type="submit" class="w-full py-3 bg-orange-500 text-white text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-orange-600 transition-all shadow-xl shadow-orange-500/20 italic">
                                     Commit Financial Adjustment
                                 </button>
                             </form>
                         </div>
                     </div>
                 </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Participants Intelligence -->
                <div class="lg:col-span-2 space-y-12">
                    <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)]">
                        <div class="p-10 border-b border-gray-50 bg-gray-50/50">
                             <h3 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] flex items-center gap-4 italic opacity-80">
                                <span class="w-2 h-7 bg-orange-500 rounded-full"></span>
                                Capital Flow Entities
                            </h3>
                        </div>
                        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-12">
                             <!-- Source / Renter -->
                             <div class="space-y-6">
                                 <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic flex items-center gap-2">
                                     <span class="w-5 h-px bg-gray-200"></span>
                                     Source (Operator)
                                 </h4>
                                 <a href="{{ route('admin.users.show', $booking->customer) }}" class="flex items-center gap-6 group/renter">
                                     <div class="w-24 h-24 rounded-[2rem] bg-[#050B1A] border-4 border-white flex items-center justify-center text-4xl font-black text-white group-hover/renter:scale-105 transition-all shadow-2xl italic shrink-0 overflow-hidden">
                                        @if($booking->customer->profile_photo)
                                            <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($booking->customer->name, 0, 1) }}
                                        @endif
                                     </div>
                                     <div class="min-w-0">
                                         <div class="text-xl font-black text-[#050B1A] uppercase tracking-tighter italic truncate group-hover:text-indigo-600 transition-colors leading-none mb-2">{{ $booking->customer->name }}</div>
                                         <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest truncate italic opacity-60 leading-none">Verified Identity #{{ $booking->customer->id }}</div>
                                         <div class="mt-4 flex items-center gap-2">
                                             <span class="px-3 py-1 bg-gray-100 rounded-lg text-[8px] font-black text-gray-500 uppercase tracking-widest italic border border-white">Institutional Renter</span>
                                         </div>
                                     </div>
                                 </a>
                             </div>

                             <!-- Destination / Host -->
                             <div class="space-y-6">
                                 <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic flex items-center gap-2 text-right justify-end md:justify-start">
                                     <span class="w-5 h-px bg-gray-200"></span>
                                     Destination (Host)
                                 </h4>
                                 <a href="{{ route('admin.users.show', $booking->car->owner) }}" class="flex items-center gap-6 group/host">
                                     <div class="w-24 h-24 rounded-[2rem] bg-orange-600 border-4 border-white flex items-center justify-center text-4xl font-black text-white group-hover/host:scale-105 transition-all shadow-2xl italic shrink-0 overflow-hidden">
                                        @if($booking->car->owner->profile_photo)
                                            <img src="{{ Storage::url($booking->car->owner->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($booking->car->owner->name, 0, 1) }}
                                        @endif
                                     </div>
                                     <div class="min-w-0">
                                         <div class="text-xl font-black text-[#050B1A] uppercase tracking-tighter italic truncate group-hover:text-orange-600 transition-colors leading-none mb-2">{{ $booking->car->owner->name }}</div>
                                         <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest truncate italic opacity-60 leading-none">Fleet Operator #{{ $booking->car->owner->id }}</div>
                                         <div class="mt-4 flex items-center gap-2">
                                             <span class="px-3 py-1 bg-orange-50 rounded-lg text-[8px] font-black text-orange-500 uppercase tracking-widest italic border border-white">Authorized Host</span>
                                         </div>
                                     </div>
                                 </a>
                             </div>
                        </div>
                    </div>

                    <!-- Asset & Deployment Context -->
                    <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)]">
                         <div class="p-10 border-b border-gray-50 bg-gray-50/50">
                             <h3 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] flex items-center gap-4 italic opacity-80">
                                <span class="w-2 h-7 bg-indigo-500 rounded-full"></span>
                                Tactical Deployment Artifact
                            </h3>
                        </div>
                        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-12">
                             <div class="rounded-[2.5rem] border-4 border-white overflow-hidden bg-gray-100 aspect-[4/3] relative group shadow-2xl cursor-pointer" onclick="window.location='{{ route('admin.cars.show', $booking->car) }}'">
                                @if($booking->car->images->count() > 0)
                                    <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#050B1A] via-transparent to-transparent pointer-events-none opacity-60"></div>
                                <div class="absolute bottom-8 left-8">
                                    <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest italic mb-2">Asset Reference #FL-{{ str_pad($booking->car_id, 4, '0', STR_PAD_LEFT) }}</div>
                                    <h4 class="text-2xl font-black text-white uppercase tracking-tighter italic leading-none">{{ $booking->car->brand }} {{ $booking->car->model }}</h4>
                                </div>
                             </div>

                             <div class="space-y-10">
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic">Operational Period</h4>
                                     <div class="flex items-center gap-4">
                                         <div class="flex-1 p-6 rounded-[1.8rem] bg-gray-50 border-2 border-white shadow-sm text-center">
                                             <div class="text-[8px] text-gray-400 font-black uppercase mb-1 italic">Deployment</div>
                                             <div class="text-sm font-black text-[#050B1A] italic">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</div>
                                         </div>
                                         <div class="shrink-0">
                                             <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7"></path></svg>
                                         </div>
                                         <div class="flex-1 p-6 rounded-[1.8rem] bg-gray-50 border-2 border-white shadow-sm text-center">
                                             <div class="text-[8px] text-gray-400 font-black uppercase mb-1 italic">Termination</div>
                                             <div class="text-sm font-black text-[#050B1A] italic">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                                         </div>
                                     </div>
                                 </div>
                                 
                                 <div class="pt-8 border-t border-gray-50">
                                     <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic">Itinerary Statistics</h4>
                                     <div class="grid grid-cols-2 gap-6">
                                         <div class="p-6 rounded-[1.8rem] border-2 border-white bg-gray-50/50 shadow-sm relative overflow-hidden group/stat">
                                             <div class="absolute inset-0 bg-indigo-500 opacity-0 group-hover/stat:opacity-5 transition-opacity"></div>
                                             <div class="text-[8px] text-gray-400 font-black uppercase mb-2 italic">Total Cycles</div>
                                             <div class="text-2xl font-black text-indigo-600 italic tracking-tighter leading-none">{{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) }} Units</div>
                                         </div>
                                         <div class="p-6 rounded-[1.8rem] border-2 border-white bg-gray-50/50 shadow-sm relative overflow-hidden group/stat">
                                             <div class="absolute inset-0 bg-orange-500 opacity-0 group-hover/stat:opacity-5 transition-opacity"></div>
                                             <div class="text-[8px] text-gray-400 font-black uppercase mb-2 italic">Yield Rate</div>
                                             <div class="text-2xl font-black text-orange-500 italic tracking-tighter leading-none">৳{{ number_format($booking->car->price_per_day) }} <span class="text-[10px]">/DAY</span></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Operational Log -->
                <div class="space-y-8">
                    <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] sticky top-8">
                        <h3 class="text-xs font-black text-[#050B1A] italic tracking-[0.4em] uppercase mb-12 text-center flex items-center justify-center gap-4">
                            <span class="w-2 h-2 bg-indigo-500 rounded-full animate-bounce"></span>
                            Audit Lifecycle
                        </h3>
                        
                        <div class="relative pl-12 space-y-12">
                             <div class="absolute left-6 top-1 bottom-1 w-0.5 bg-gray-100"></div>
                             
                             <!-- Initial Settlement -->
                             <div class="relative group/log">
                                 <div class="absolute -left-7 top-1 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-xl transition-transform group-hover/log:scale-125"></div>
                                 <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-widest mb-1 italic">Liquidity Primary Settlement</h5>
                                 <p class="text-[10px] text-gray-400 font-bold italic leading-relaxed">Payment protocol verified. Funds locked in platform escrow.</p>
                                 <div class="mt-3 text-[9px] text-[#050B1A] font-black italic bg-gray-50 inline-block px-3 py-1 rounded-lg border border-gray-100">{{ $booking->created_at->format('M d, Y | H:i') }}</div>
                             </div>

                             <!-- Deployment Phases (Damage Reports) -->
                             @foreach($booking->damageReports as $dr)
                             <div class="relative group/log">
                                 <div class="absolute -left-7 top-1 w-4 h-4 rounded-full bg-red-600 border-4 border-white shadow-xl transition-transform group-hover/log:scale-125"></div>
                                 <h5 class="text-[11px] font-black text-red-600 uppercase tracking-widest mb-1 italic">Integrity Breach Artifact #{{ $dr->id }}</h5>
                                 <p class="text-[10px] text-gray-400 font-bold italic leading-relaxed">Claim logged by operator. Arbitration pending at ৳{{ number_format($dr->resolution_cost ?? 0) }}.</p>
                                 <div class="mt-3 text-[9px] text-red-600 font-black italic bg-red-50 inline-block px-3 py-1 rounded-lg border border-red-100">{{ $dr->created_at->format('M d, Y | H:i') }}</div>
                             </div>
                             @endforeach

                             <!-- Termination Protocol -->
                             <div class="relative group/log {{ $booking->status === 'completed' ? '' : 'opacity-30 grayscale' }}">
                                 <div class="absolute -left-7 top-1 w-4 h-4 rounded-full {{ $booking->status === 'completed' ? 'bg-indigo-600' : 'bg-gray-300' }} border-4 border-white shadow-xl transition-transform group-hover/log:scale-125"></div>
                                 <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-widest mb-1 italic">Strategic Termination</h5>
                                 <p class="text-[10px] text-gray-400 font-bold italic leading-relaxed">Asset recovery finalized. Host remittance settlement sequence triggered.</p>
                                 @if($booking->status === 'completed')
                                    <div class="mt-3 text-[9px] text-indigo-600 font-black italic bg-indigo-50 inline-block px-3 py-1 rounded-lg border border-indigo-100">{{ $booking->updated_at->format('M d, Y | H:i') }}</div>
                                 @else
                                    <div class="mt-3 text-[8px] text-gray-400 font-black uppercase italic tracking-widest leading-none">Status: Deployment Pending End</div>
                                 @endif
                             </div>
                        </div>

                        <div class="mt-20 pt-10 border-t border-gray-50 text-center relative group/seal">
                            <div class="absolute inset-x-0 -top-px h-px bg-gradient-to-r from-transparent via-[#050B1A]/10 to-transparent"></div>
                            <div class="text-[10px] font-black text-[#050B1A] italic tracking-widest uppercase mb-6 opacity-40">Institutional Verification Seal</div>
                            <div class="inline-block p-6 bg-white border-2 border-gray-100 rounded-3xl opacity-20 group-hover/seal:opacity-100 group-hover/seal:border-indigo-100 group-hover/seal:scale-110 transition-all duration-500 shadow-xl relative">
                                <div class="absolute inset-0 bg-indigo-500 blur-2xl opacity-0 group-hover/seal:opacity-10 transition-opacity"></div>
                                <svg class="w-16 h-16 text-indigo-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
