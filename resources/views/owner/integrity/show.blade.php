<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('owner.integrity.index') }}" class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 transition-all text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                        Breach Analysis: #BR-{{ str_pad($damageReport->id, 6, '0', STR_PAD_LEFT) }}
                    </h2>
                    <p class="text-[10px] text-red-500 font-black uppercase tracking-[0.2em] mt-1">Asset Integrity Verification & Containment Hub</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-red-500/10 text-red-500 border border-red-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest">{{ $damageReport->status }} Breach</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden text-slate-200">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-red-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Artifact preview -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-1 rounded-[3rem] shadow-2xl overflow-hidden relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-600/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                        <div class="w-full aspect-video rounded-[2.8rem] overflow-hidden border border-white/5 bg-gray-950 flex items-center justify-center">
                            @if($damageReport->image)
                                <img src="{{ Storage::url($damageReport->image) }}" alt="Incident Artifact" class="w-full h-full object-cover">
                            @else
                                <div class="text-[10px] font-black text-gray-800 uppercase tracking-[0.4em] italic pointer-events-none">No Artifact Attached</div>
                            @endif
                        </div>
                    </div>

                    <!-- Testimony Stream -->
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] px-4 flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,1)]"></span>
                            Incident Evidence artifacts
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Host Testimony -->
                            <div class="bg-gray-900/40 backdrop-blur-xl border border-white/5 p-8 rounded-[2.5rem] shadow-xl relative">
                                <div class="absolute top-6 right-8 text-[8px] text-gray-700 font-black uppercase italic">Logged by You</div>
                                <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Damage Declaration</h4>
                                <div class="p-6 bg-white/5 rounded-3xl border border-white/5">
                                    <p class="text-xs font-bold text-gray-300 leading-relaxed">"{{ $damageReport->description }}"</p>
                                </div>
                            </div>

                            <!-- Renter Response -->
                            <div class="bg-gray-900/40 backdrop-blur-xl border border-red-500/10 p-8 rounded-[2.5rem] shadow-xl relative">
                                <div class="absolute top-6 right-8 text-[8px] text-red-500/60 font-black uppercase italic">Renter's testimony</div>
                                <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Operator Response</h4>
                                <div class="p-6 bg-red-500/5 rounded-3xl border border-red-500/10">
                                    <p class="text-xs font-black text-red-200 leading-relaxed italic">"{{ $damageReport->customer_notes ?? 'No response logged by rentee.' }}"</p>
                                </div>
                            </div>
                        </div>

                         <!-- Communication Log -->
                         <div class="bg-gray-900/40 backdrop-blur-xl border border-white/5 p-8 rounded-[2.5rem] shadow-xl">
                             <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Secure COMMS Archive</h4>
                             <div class="space-y-4 max-h-64 overflow-y-auto pr-4 custom-scrollbar">
                                 @forelse($damageReport->booking->messages as $msg)
                                    <div class="p-4 rounded-2xl @if($msg->sender_id === auth()->id()) bg-indigo-500/5 border border-indigo-500/10 ml-12 @else bg-white/5 border border-white/5 mr-12 @endif">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-[8px] font-black text-gray-600 uppercase">{{ $msg->sender->name }}</span>
                                            <span class="text-[8px] text-gray-700">{{ $msg->created_at->format('H:i') }}</span>
                                        </div>
                                        <p class="text-[10px] text-gray-400 font-medium">{{ $msg->content }}</p>
                                    </div>
                                 @empty
                                    <div class="py-10 text-center text-gray-800 text-[10px] font-black uppercase tracking-widest italic opacity-20">No relevant communications logged</div>
                                 @endforelse
                             </div>
                        </div>
                    </div>
                </div>

                <!-- Resolution console -->
                <div class="space-y-8">
                    <div class="bg-gray-900 border border-white/10 p-10 rounded-[3rem] shadow-3xl sticky top-8 overflow-hidden group">
                        <div class="absolute -right-20 -top-20 w-40 h-40 bg-red-600/10 rounded-full blur-[80px] pointer-events-none group-hover:bg-red-600/20 transition-all"></div>
                        
                        <div class="text-center mb-10">
                            <h3 class="text-xl font-black text-white italic tracking-tighter mb-2 uppercase">Resolution Delta</h3>
                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Platform Mediation Phase</p>
                        </div>

                        @if($damageReport->status === 'resolved')
                             <div class="p-10 bg-emerald-500/5 rounded-[2.5rem] border border-emerald-500/10 text-center">
                               <div class="w-16 h-16 rounded-full bg-emerald-500/10 flex items-center justify-center mx-auto mb-6 text-emerald-500 border border-emerald-500/20">
                                   <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                               </div>
                               <h4 class="text-sm font-black text-emerald-400 uppercase tracking-widest mb-2">Case Resolved</h4>
                               <div class="text-3xl font-black text-white italic tracking-tighter mb-4">৳ {{ number_format($damageReport->resolution_cost) }}</div>
                               <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest leading-relaxed px-4">Funds successfully added to yield settlement for current deployment.</p>
                               
                               <div class="mt-8 p-6 bg-gray-950/50 rounded-2xl border border-white/5 text-left">
                                   <div class="text-[8px] text-gray-700 font-black uppercase italic mb-2 leading-none">Platform Admin Verdict</div>
                                   <p class="text-[10px] text-gray-400 font-medium leading-relaxed italic">"{{ $damageReport->admin_notes }}"</p>
                               </div>
                           </div>
                        @else
                            <div class="p-10 bg-white/5 rounded-[2.5rem] border border-white/5 text-center">
                               <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6 text-gray-600">
                                   <svg class="w-8 h-8 font-black uppercase" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                               </div>
                               <h4 class="text-sm font-black text-gray-400 uppercase tracking-widest mb-2">Awaiting Mediation</h4>
                               <p class="text-[9px] text-gray-600 font-bold uppercase tracking-widest leading-relaxed">This breach artifact is currently being audited by Platform Administration. Keep all photo documentation secure.</p>
                               
                               <div class="mt-8 flex flex-col gap-3">
                                   <a href="{{ route('owner.bookings.show', $damageReport->booking) }}" class="w-full py-4 bg-white/5 hover:bg-white/10 text-[9px] font-black text-gray-300 uppercase tracking-[0.2em] rounded-xl border border-white/5 transition-all">Inspect Full Protocol</a>
                                   <button class="w-full py-4 bg-white/5 text-gray-700 text-[9px] font-black uppercase tracking-[0.2em] rounded-xl border border-white/5 cursor-not-allowed">Protocol Locked</button>
                               </div>
                           </div>
                        @endif

                        <div class="mt-12 pt-8 border-t border-white/5 space-y-4 text-center">
                             <div class="text-[8px] font-black text-indigo-400 uppercase tracking-widest italic">Mediation Policy Hub</div>
                             <p class="text-[8px] text-gray-600 font-medium leading-relaxed uppercase">Disputed claims are subject to forensic audit. Valid documentation is required for settlement authorization.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
