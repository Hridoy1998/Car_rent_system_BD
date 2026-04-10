<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.finance.index') }}" class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 transition-all text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                        Transaction Audit: #TX-{{ str_pad($booking->id, 8, '0', STR_PAD_LEFT) }}
                    </h2>
                    <p class="text-[10px] text-emerald-400 font-bold uppercase tracking-[0.2em] mt-1">Platform Financial Clearance Certificate</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest">Settled</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden text-slate-200">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-600/5 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Strategic Yield Header -->
            <div class="bg-gray-900 border border-white/10 p-12 rounded-[4rem] shadow-3xl relative overflow-hidden group">
                 <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-600/10 rounded-full blur-[100px] pointer-events-none group-hover:bg-emerald-600/20 transition-all"></div>
                 
                 <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 items-center relative z-10">
                     <div class="lg:col-span-1 border-r border-white/5 pr-12 text-center lg:text-left">
                         <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4 italic">Gross Platform Volume</h4>
                         <div class="text-6xl font-black text-white tracking-tighter italic">৳ {{ number_format($booking->total_price) }}</div>
                         <div class="mt-4 flex items-center justify-center lg:justify-start gap-2">
                             <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                             <span class="text-[8px] font-black text-emerald-500/80 uppercase tracking-widest leading-none">Authorization Finalized</span>
                         </div>
                     </div>
                     
                     <div class="lg:col-span-2 grid grid-cols-2 gap-8 text-center">
                         <div>
                             <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-2 italic">Platform Commission ({{ $commissionPercent }}%)</h4>
                             <div class="text-3xl font-black text-indigo-400">৳ {{ number_format($platformFee) }}</div>
                         </div>
                         <div>
                             <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-2 italic">Host Remittance</h4>
                             <div class="text-3xl font-black text-pink-500">৳ {{ number_format($hostEarning) }}</div>
                         </div>
                     </div>

                     <div class="lg:col-span-1 flex flex-col gap-3">
                         <button class="w-full py-4 bg-white/5 hover:bg-white/10 text-[9px] font-black text-gray-300 uppercase tracking-widest rounded-2xl border border-white/5 transition-all">Download Audit Artifact</button>
                         <button class="w-full py-4 bg-white/5 hover:bg-white/10 text-[9px] font-black text-gray-300 uppercase tracking-widest rounded-2xl border border-white/5 transition-all">Manual Adjust protocol</button>
                     </div>
                 </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Participants Intelligence -->
                <div class="lg:col-span-2 space-y-12">
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                        <div class="p-10 border-b border-white/5">
                             <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,1)]"></span>
                                Capital Flow Entities
                            </h3>
                        </div>
                        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-12">
                             <!-- Source / Renter -->
                             <div class="space-y-6">
                                 <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-widest italic">Source (Renter)</h4>
                                 <a href="{{ route('profiles.show', $booking->customer) }}" class="flex items-center gap-5 group/renter">
                                     <div class="w-20 h-20 rounded-3xl bg-gray-950 border border-white/5 flex items-center justify-center text-3xl font-black text-indigo-400 group-hover/renter:bg-indigo-600 group-hover/renter:text-white transition-all shadow-xl">{{ substr($booking->customer->name, 0, 1) }}</div>
                                     <div>
                                         <div class="text-lg font-black text-white uppercase tracking-tighter">{{ $booking->customer->name }}</div>
                                         <div class="text-[10px] text-gray-600 font-bold uppercase tracking-widest">{{ $booking->customer->email }}</div>
                                         <div class="mt-2 text-[8px] font-black text-gray-700 uppercase tracking-widest">Verified Identity Pool</div>
                                     </div>
                                 </a>
                             </div>

                             <!-- Destination / Host -->
                             <div class="space-y-6">
                                 <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-widest italic">Destination (Host)</h4>
                                 <a href="{{ route('profiles.show', $booking->car->owner) }}" class="flex items-center gap-5 group/host">
                                     <div class="w-20 h-20 rounded-3xl bg-gray-950 border border-white/5 flex items-center justify-center text-3xl font-black text-pink-500 group-hover/host:bg-pink-600 group-hover/host:text-white transition-all shadow-xl">{{ substr($booking->car->owner->name, 0, 1) }}</div>
                                     <div>
                                         <div class="text-lg font-black text-white uppercase tracking-tighter">{{ $booking->car->owner->name }}</div>
                                         <div class="text-[10px] text-gray-600 font-bold uppercase tracking-widest">{{ $booking->car->owner->email }}</div>
                                         <div class="mt-2 text-[8px] font-black text-gray-700 uppercase tracking-widest">Authorized Fleet Operator</div>
                                     </div>
                                 </a>
                             </div>
                        </div>
                    </div>

                    <!-- Asset & Deployment context -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                         <div class="p-10 border-b border-white/5">
                             <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-pink-500 shadow-[0_0_10px_rgba(236,72,153,1)]"></span>
                                Tactical Deployment Artifact
                            </h3>
                        </div>
                        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-12">
                             <div class="rounded-3xl border border-white/10 overflow-hidden bg-gray-950 aspect-[4/3] relative group shadow-2xl">
                                @if($booking->car->images->count() > 0)
                                    <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent pointer-events-none"></div>
                                <div class="absolute bottom-6 left-6">
                                    <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest italic">Asset Reference</div>
                                    <h4 class="text-xl font-black text-white uppercase tracking-tighter italic">{{ $booking->car->brand }} {{ $booking->car->model }}</h4>
                                </div>
                             </div>

                             <div class="space-y-8">
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-widest mb-4 italic">Operational Period</h4>
                                     <div class="flex items-center gap-6">
                                         <div class="flex-1 p-5 rounded-2xl bg-white/5 border border-white/5 text-center">
                                             <div class="text-[8px] text-gray-500 font-bold uppercase mb-1">Deployment</div>
                                             <div class="text-xs font-black text-white">{{ $booking->start_date }}</div>
                                         </div>
                                         <div class="w-4 h-px bg-white/10"></div>
                                         <div class="flex-1 p-5 rounded-2xl bg-white/5 border border-white/5 text-center">
                                             <div class="text-[8px] text-gray-500 font-bold uppercase mb-1">Termination</div>
                                             <div class="text-xs font-black text-white">{{ $booking->end_date }}</div>
                                         </div>
                                     </div>
                                 </div>
                                 
                                 <div>
                                     <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-widest mb-4 italic">Itinerary Statistics</h4>
                                     <div class="grid grid-cols-2 gap-6">
                                         <div class="p-5 rounded-2xl border border-white/5 bg-gray-950/50">
                                             <div class="text-[8px] text-gray-500 font-bold uppercase mb-1">Total Cycles</div>
                                             <div class="text-sm font-black text-indigo-400 italic">{{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) }} Units</div>
                                         </div>
                                         <div class="p-5 rounded-2xl border border-white/5 bg-gray-950/50">
                                             <div class="text-[8px] text-gray-500 font-bold uppercase mb-1">Yield Rate</div>
                                             <div class="text-sm font-black text-pink-500 italic">৳ {{ number_format($booking->car->price_per_day) }} / Unit</div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Audit Log -->
                <div class="space-y-8">
                    <div class="bg-gray-900 border border-white/10 p-10 rounded-[3rem] shadow-3xl sticky top-8">
                        <h3 class="text-sm font-black text-white italic tracking-widest uppercase mb-10 text-center">Audit Lifecycle Logs</h3>
                        
                        <div class="relative pl-12 space-y-12">
                             <div class="absolute left-6 top-1 bottom-1 w-px bg-white/5"></div>
                             
                             <div class="relative">
                                 <div class="absolute -left-7 top-1 w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,1)]"></div>
                                 <h5 class="text-[10px] font-black text-white uppercase tracking-widest mb-1">Liquidity Settlement</h5>
                                 <p class="text-[9px] text-gray-600 font-medium">Payment protocol verified and funds locked in platform escrow.</p>
                                 <div class="mt-2 text-[8px] text-gray-700 font-black italic">{{ $booking->created_at->format('M d, Y H:i') }}</div>
                             </div>

                             @foreach($booking->damageReports as $dr)
                             <div class="relative">
                                 <div class="absolute -left-7 top-1 w-3 h-3 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,1)]"></div>
                                 <h5 class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-1">Integrity Breach #{{ $dr->id }}</h5>
                                 <p class="text-[9px] text-gray-600 font-medium">Claim logged by host. Arbitration pending settlement of ৳ {{ number_format($dr->resolution_cost ?? 0) }}.</p>
                                 <div class="mt-2 text-[8px] text-gray-700 font-black italic">{{ $dr->created_at->format('M d, Y H:i') }}</div>
                             </div>
                             @endforeach

                             <div class="relative opacity-30">
                                 <div class="absolute -left-7 top-1 w-3 h-3 rounded-full bg-gray-800"></div>
                                 <h5 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Final Host Payout</h5>
                                 <p class="text-[9px] text-gray-800 font-medium italic">Protocol scheduled upon deployment termination.</p>
                             </div>
                        </div>

                        <div class="mt-20 pt-10 border-t border-white/5 text-center">
                            <div class="text-[10px] font-black text-indigo-400 italic mb-4">Official Verification Seal</div>
                            <div class="inline-block p-4 border-2 border-indigo-500/20 rounded-2xl opacity-40 grayscale group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
