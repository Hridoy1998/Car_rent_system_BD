<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('owner.logistics.index') }}" class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 transition-all text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                        Logistics Protocol: #OP-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                    </h2>
                    <p class="text-[10px] text-blue-400 font-bold uppercase tracking-[0.2em] mt-1">Tactical Asset Movement & Handoff Directive</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-blue-500/10 text-blue-500 border border-blue-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest">{{ $booking->status }} Phase</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden text-slate-200">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Mission Critical Timing -->
            <div class="bg-gray-900 border-2 @if($booking->status === 'approved') border-emerald-500/30 @else border-white/5 @endif p-12 rounded-[4rem] shadow-3xl relative overflow-hidden group">
                 <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-600/10 rounded-full blur-[100px] pointer-events-none group-hover:bg-blue-600/20 transition-all"></div>
                 
                 <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center relative z-10">
                     <div class="text-center lg:text-left">
                         <h4 class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4 italic">Next Operational Milestone</h4>
                         @if($booking->status === 'approved')
                            <div class="text-5xl font-black text-white tracking-tighter italic">Handover Scheduled</div>
                            <div class="mt-4 text-xs font-black text-emerald-400 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                T-Minus {{ \Carbon\Carbon::parse($booking->start_date)->diffForHumans() }}
                            </div>
                         @elseif($booking->status === 'ongoing')
                            <div class="text-5xl font-black text-white tracking-tighter italic">Asset Deployment</div>
                            <div class="mt-4 text-xs font-black text-blue-400 uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                Termination in {{ \Carbon\Carbon::parse($booking->end_date)->diffForHumans() }}
                            </div>
                         @else
                            <div class="text-5xl font-black text-white tracking-tighter italic">Protocol Terminated</div>
                            <div class="mt-4 text-xs font-black text-gray-600 uppercase tracking-widest">Operation Closed</div>
                         @endif
                     </div>
                     
                     <div class="flex items-center justify-center gap-12 border-x border-white/5 px-12">
                         <div class="text-center">
                             <div class="text-[9px] font-black text-gray-700 uppercase tracking-widest mb-1">Start Phase</div>
                             <div class="text-lg font-black text-white italic tracking-tighter">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</div>
                         </div>
                         <div class="w-10 h-px bg-white/10"></div>
                         <div class="text-center">
                             <div class="text-[9px] font-black text-gray-700 uppercase tracking-widest mb-1">End Phase</div>
                             <div class="text-lg font-black text-white italic tracking-tighter">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                         </div>
                     </div>

                     <div class="flex flex-col gap-3">
                         <a href="{{ route('owner.bookings.show', $booking) }}" class="w-full py-5 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl shadow-blue-600/20 text-center">Execute Protocol Action</a>
                         <button class="w-full py-4 bg-white/5 hover:bg-white/10 text-[9px] font-black text-gray-300 uppercase tracking-widest rounded-2xl border border-white/5 transition-all">Print Movement Directive</button>
                     </div>
                 </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Tactical Metadata -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Participant Profile -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3.5rem] overflow-hidden shadow-2xl">
                         <div class="p-10 border-b border-white/5">
                             <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,1)]"></span>
                                Assigned Operator
                            </h3>
                        </div>
                        <div class="p-10 flex flex-col md:flex-row items-center gap-10">
                             <div class="w-32 h-32 rounded-[2.5rem] bg-gray-950 border border-white/5 flex items-center justify-center text-5xl font-black text-indigo-400 shadow-2xl">{{ substr($booking->customer->name, 0, 1) }}</div>
                             <div class="flex-1 space-y-6 text-center md:text-left">
                                 <div>
                                     <h4 class="text-2xl font-black text-white uppercase tracking-tighter italic">{{ $booking->customer->name }}</h4>
                                     <div class="text-sm font-black text-indigo-500 uppercase tracking-[0.2em] mt-1 italic">Verified Platform Participant</div>
                                 </div>
                                 <div class="grid grid-cols-2 gap-8 max-w-sm mx-auto md:mx-0">
                                     <div>
                                         <div class="text-[8px] text-gray-700 font-black uppercase tracking-widest mb-1">Authorization Status</div>
                                         <div class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Identity Authorized</div>
                                     </div>
                                     <div>
                                         <div class="text-[8px] text-gray-700 font-black uppercase tracking-widest mb-1">Reputation Score</div>
                                         <div class="text-[10px] font-black text-white uppercase tracking-widest">4.9 / 5.0</div>
                                     </div>
                                 </div>
                             </div>
                             <div class="flex flex-col gap-3">
                                 <button class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-gray-400 uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all">Initiate Secure COMMS</button>
                                 <a href="{{ route('profiles.show', $booking->customer) }}" class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-gray-400 uppercase tracking-widest hover:bg-white/10 transition-all text-center">View Asset History</a>
                             </div>
                        </div>
                    </div>

                    <!-- Communication Stream -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3.5rem] overflow-hidden shadow-2xl">
                         <div class="p-10 border-b border-white/5">
                             <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,1)]"></span>
                                Secure Communication Artifacts
                            </h3>
                        </div>
                        <div class="p-10">
                             <div class="space-y-6 max-h-96 overflow-y-auto pr-4 custom-scrollbar">
                                 @forelse($booking->messages as $msg)
                                    <div class="flex gap-6 @if($msg->sender_id === auth()->id()) flex-row-reverse @endif">
                                        <div class="w-10 h-10 rounded-xl bg-gray-950 border border-white/5 flex items-center justify-center text-[10px] font-black @if($msg->sender_id === auth()->id()) text-indigo-400 @else text-blue-400 @endif">{{ substr($msg->sender->name, 0, 1) }}</div>
                                        <div class="flex-1 p-6 rounded-3xl @if($msg->sender_id === auth()->id()) bg-indigo-500/10 border border-indigo-500/20 @else bg-white/5 border border-white/5 @endif relative">
                                            <div class="flex justify-between items-center mb-3">
                                                <span class="text-[9px] font-black @if($msg->sender_id === auth()->id()) text-indigo-400 @else text-white @endif uppercase">{{ $msg->sender->name }}</span>
                                                <span class="text-[8px] text-gray-700">{{ $msg->created_at->format('H:i') }}</span>
                                            </div>
                                            <p class="text-[11px] text-gray-400 font-medium leading-relaxed">{{ $msg->content }}</p>
                                        </div>
                                    </div>
                                 @empty
                                    <div class="py-20 text-center text-gray-800 text-[10px] font-black uppercase tracking-[0.4em] italic opacity-20">Communication stream is currently silent</div>
                                 @endforelse
                             </div>
                        </div>
                    </div>
                </div>

                <!-- Asset Intel -->
                <div class="space-y-8">
                    <div class="bg-gray-900 border border-white/10 p-1 rounded-[3.5rem] shadow-3xl sticky top-8 overflow-hidden group">
                        <div class="aspect-[4/3] rounded-[3.2rem] overflow-hidden bg-gray-950 relative">
                             @if($booking->car->images->count() > 0)
                                <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                             @endif
                             <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                             <div class="absolute bottom-10 left-10">
                                 <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1 italic">Tactical Asset</div>
                                 <h4 class="text-3xl font-black text-white uppercase italic tracking-tighter">{{ $booking->car->brand }}</h4>
                                 <p class="text-sm font-black text-gray-600 uppercase">{{ $booking->car->model }}</p>
                             </div>
                        </div>

                        <div class="p-10 space-y-8">
                             <div>
                                 <h5 class="text-[9px] font-black text-gray-700 uppercase tracking-widest mb-4 italic">Deployment Metadata</h5>
                                 <div class="grid grid-cols-2 gap-4">
                                     <div class="p-4 rounded-xl bg-white/5 border border-white/5">
                                         <div class="text-[8px] text-gray-600 font-bold uppercase mb-1">License</div>
                                         <div class="text-[10px] font-black text-white uppercase">{{ $booking->car->license_plate }}</div>
                                     </div>
                                      <div class="p-4 rounded-xl bg-white/5 border border-white/5">
                                         <div class="text-[8px] text-gray-600 font-bold uppercase mb-1">Color Mark</div>
                                         <div class="text-[10px] font-black text-white uppercase">{{ $booking->car->color }}</div>
                                     </div>
                                 </div>
                             </div>

                             <div>
                                 <h5 class="text-[9px] font-black text-gray-700 uppercase tracking-widest mb-4 italic">Deployment Statistics</h5>
                                 <div class="space-y-4">
                                     <div class="flex justify-between py-2 border-b border-white/5 cursor-help" title="Distance from center">
                                         <span class="text-[9px] text-gray-600 font-bold uppercase">Sector Radius</span>
                                         <span class="text-[9px] font-black text-gray-300 uppercase italic">15.4 KM</span>
                                     </div>
                                     <div class="flex justify-between py-2 border-b border-white/5">
                                         <span class="text-[9px] text-gray-600 font-bold uppercase">Telematics Signal</span>
                                         <span class="text-[9px] font-black text-emerald-400 uppercase italic">Nominal</span>
                                     </div>
                                 </div>
                             </div>

                             <div class="mt-8 pt-8 border-t border-white/5">
                                 <div class="text-[10px] font-black text-indigo-400 italic mb-4 text-center">Logistics Integrity Seal</div>
                                 <div class="flex justify-center gap-4 opacity-30 grayscale group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                      <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                                      <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"></path></svg>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
