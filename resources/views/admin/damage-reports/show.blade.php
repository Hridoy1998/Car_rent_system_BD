<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.damage-reports.index') }}" class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 transition-all text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                        Arbitration Hub: #BR-{{ str_pad($damageReport->id, 6, '0', STR_PAD_LEFT) }}
                    </h2>
                    <p class="text-[10px] text-red-500 font-black uppercase tracking-[0.2em] mt-1">Integrity Breach Mediation Center</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-red-500/10 text-red-500 border border-red-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest">{{ $damageReport->status }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden text-slate-200">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-red-600/5 rounded-full blur-[120px] -z-10"></div>

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
                            Evidentiary Stream
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Host Testimony -->
                            <div class="bg-gray-900/40 backdrop-blur-xl border border-white/5 p-8 rounded-[2.5rem] shadow-xl relative">
                                <div class="absolute top-6 right-8 text-[8px] text-gray-700 font-black uppercase italic">Source: Host</div>
                                <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Damage Description</h4>
                                <div class="p-6 bg-white/5 rounded-3xl border border-white/5">
                                    <p class="text-xs font-bold text-gray-300 leading-relaxed">"{{ $damageReport->description }}"</p>
                                </div>
                            </div>

                            <!-- Renter Response -->
                            <div class="bg-gray-900/40 backdrop-blur-xl border border-red-500/10 p-8 rounded-[2.5rem] shadow-xl relative">
                                <div class="absolute top-6 right-8 text-[8px] text-red-500/60 font-black uppercase italic">Source: Rentee</div>
                                <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Dispute Response</h4>
                                <div class="p-6 bg-red-500/5 rounded-3xl border border-red-500/10">
                                    <p class="text-xs font-black text-red-200 leading-relaxed italic">"{{ $damageReport->customer_notes ?? 'No response logged.' }}"</p>
                                </div>
                            </div>
                        </div>

                        <!-- Platform Logs -->
                        <div class="bg-gray-900/40 backdrop-blur-xl border border-white/5 p-8 rounded-[2.5rem] shadow-xl">
                             <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Digital Communication Artifacts</h4>
                             <div class="space-y-4 max-h-64 overflow-y-auto pr-4 custom-scrollbar">
                                 @forelse($damageReport->booking->messages as $msg)
                                    <div class="p-4 rounded-2xl @if($msg->sender_id === $damageReport->booking->customer_id) bg-red-500/5 border border-red-500/10 ml-12 @else bg-white/5 border border-white/5 mr-12 @endif">
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

                <!-- Arbitration decision -->
                <div class="space-y-8">
                    <div class="bg-gray-900 border border-white/10 p-10 rounded-[3rem] shadow-3xl sticky top-8 overflow-hidden group">
                        <div class="absolute -right-20 -top-20 w-40 h-40 bg-red-600/10 rounded-full blur-[80px] pointer-events-none group-hover:bg-red-600/20 transition-all"></div>
                        
                        <div class="text-center mb-10">
                            <h3 class="text-xl font-black text-white italic tracking-tighter mb-2 uppercase">Official Verdict</h3>
                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Platform Neutral Mediation</p>
                        </div>

                        @if($damageReport->status !== 'resolved')
                            <form action="{{ route('admin.damage-reports.resolve', $damageReport) }}" method="POST" class="space-y-6">
                                @csrf @method('PUT')
                                
                                <div>
                                    <label class="block text-[9px] font-black text-gray-600 uppercase tracking-widest mb-3 ml-2 italic">Assessed Damages (৳)</label>
                                    <div class="relative">
                                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-lg font-black text-gray-700">৳</span>
                                        <input type="number" name="resolution_cost" required class="w-full bg-gray-950 border-white/5 rounded-[1.5rem] py-5 pl-12 pr-6 text-white text-2xl font-black focus:ring-red-500 shadow-inner" placeholder="0.00">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[9px] font-black text-gray-600 uppercase tracking-widest mb-3 ml-2 italic">Resolution Testimony</label>
                                    <textarea name="admin_notes" required rows="4" class="w-full bg-gray-950 border-white/5 rounded-[1.5rem] p-6 text-[11px] text-gray-400 font-bold focus:ring-red-500 shadow-inner resize-none" placeholder="Provide objective reasoning for this verdict..."></textarea>
                                </div>
                                
                                <div class="p-6 bg-red-500/5 rounded-3xl border border-red-500/10">
                                     <p class="text-[8px] text-red-500/60 font-black uppercase italic leading-relaxed">Verdicts are binding and irreversible. Financial artifacts will be adjusted upon submission.</p>
                                </div>

                                <button type="submit" class="w-full py-5 bg-red-600 hover:bg-red-500 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-2xl transition-all shadow-xl shadow-red-600/20 active:scale-95">
                                    ISSUE VERDICT
                                </button>
                            </form>
                        @else
                           <div class="p-10 bg-emerald-500/5 rounded-[2.5rem] border border-emerald-500/10 text-center">
                               <div class="w-16 h-16 rounded-full bg-emerald-500/10 flex items-center justify-center mx-auto mb-6 text-emerald-500 border border-emerald-500/20">
                                   <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                               </div>
                               <h4 class="text-sm font-black text-emerald-400 uppercase tracking-widest mb-2">Verdict Settled</h4>
                               <div class="text-3xl font-black text-white italic tracking-tighter mb-4">৳ {{ number_format($damageReport->resolution_cost) }}</div>
                               <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest leading-relaxed px-4">Case #BR-{{ $damageReport->id }} closed on {{ $damageReport->updated_at->format('M d, Y') }}</p>
                               
                               <div class="mt-8 p-6 bg-gray-950/50 rounded-2xl border border-white/5 text-left">
                                   <div class="text-[8px] text-gray-700 font-black uppercase italic mb-2 leading-none">Official Notes</div>
                                   <p class="text-[10px] text-gray-400 font-medium leading-relaxed italic">"{{ $damageReport->admin_notes }}"</p>
                               </div>
                           </div>
                        @endif

                    </div>
                    
                    <!-- Quick Reference -->
                    <div class="bg-gray-900/40 backdrop-blur-xl border border-white/5 p-8 rounded-[2.5rem] shadow-xl">
                         <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic">Asset Lifecycle Context</h4>
                         <div class="space-y-4">
                             <div class="flex justify-between py-2 border-b border-white/5">
                                 <span class="text-[9px] text-gray-600 font-bold uppercase">Incident Date</span>
                                 <span class="text-[9px] font-black text-gray-300 uppercase italic">{{ $damageReport->created_at->format('M d, Y') }}</span>
                             </div>
                             <div class="flex justify-between py-2 border-b border-white/5">
                                 <span class="text-[9px] text-gray-600 font-bold uppercase">Asset</span>
                                 <span class="text-[9px] font-black text-gray-300 uppercase italic">{{ $damageReport->booking->car->brand }} {{ $damageReport->booking->car->model }}</span>
                             </div>
                              <div class="flex justify-between py-2 border-b border-white/5">
                                 <span class="text-[9px] text-gray-600 font-bold uppercase">Operator</span>
                                 <span class="text-[9px] font-black text-indigo-400 uppercase italic">{{ $damageReport->booking->customer->name }}</span>
                             </div>
                         </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
