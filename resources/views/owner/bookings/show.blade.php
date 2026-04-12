<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-white">
            <div>
                <h2 class="font-black text-3xl tracking-tighter uppercase italic">
                    {{ __('Operation Command') }} <span class="text-indigo-500">#{{ strtoupper(substr($booking->id, 0, 8)) }}</span>
                </h2>
                <div class="flex items-center gap-3 mt-1">
                    <span class="px-2.5 py-0.5 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[9px] font-black uppercase tracking-widest rounded-md">Live Stream Active</span>
                    <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Operator: {{ $booking->customer->name }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                 <div class="text-right">
                    <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest leading-none mb-1">Status Intelligence</p>
                    <p class="text-xl font-black {{ in_array($booking->status, ['completed', 'returned']) ? 'text-emerald-400' : 'text-amber-400 animate-pulse' }} uppercase italic tracking-tighter">{{ $booking->status }}</p>
                 </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
        <!-- Strategic Glows -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-red-600/5 rounded-full blur-[150px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px] -z-10 animate-pulse" style="animation-delay: 2s"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Core Operation Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Operation Intel Hub -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Asset Visualization & Status -->
                    <div class="bg-gray-900 border border-white/10 rounded-[3.5rem] overflow-hidden shadow-3xl">
                        <div class="p-10 border-b border-white/5 flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-2xl bg-gray-800 border border-white/10 overflow-hidden relative">
                                    <img src="{{ $booking->car->primary_image_url }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter">{{ $booking->car->brand }} {{ $booking->car->model }}</h3>
                                    <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">{{ $booking->car->license_plate }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest block mb-2">Operation Net Yield</span>
                                <span class="text-3xl font-black text-emerald-400 tracking-tighter">৳ {{ number_format($booking->total_price) }}</span>
                            </div>
                        </div>

                        <!-- Tactical Tracker Component Integrated -->
                        <div class="px-10 py-12 bg-gray-950/30">
                            <livewire:booking-status-tracker :booking="$booking" />
                        </div>
                    </div>

                    <!-- Strategic Operation Log (Timeline) -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3.5rem] overflow-hidden">
                        <div class="p-10 border-b border-white/5 flex items-center gap-4">
                             <div class="p-2 bg-indigo-500 rounded-xl text-white shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             </div>
                             <h3 class="text-xl font-black text-white uppercase italic tracking-tighter">Operational Timeline Artifacts</h3>
                        </div>

                        <div class="p-10 space-y-8">
                            <!-- Milestone: Authorization -->
                            <div class="flex gap-6 relative">
                                <div class="absolute left-6 top-10 bottom-0 w-px bg-white/5"></div>
                                <div class="w-12 h-12 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-500 z-10">✔</div>
                                <div>
                                    <h4 class="text-sm font-black text-white uppercase tracking-tight">Authorization Process Verified</h4>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Confirmed At: {{ $booking->updated_at->format('M d, H:i') }}</p>
                                    <div class="mt-4 p-4 bg-gray-950 rounded-2xl border border-white/5 text-[10px] text-gray-400 leading-relaxed italic">
                                        Asset status transitioned to APPROVED under administrative protocol 442. User identity verified via platform registry.
                                    </div>
                                </div>
                            </div>

                            <!-- Milestone: Deployed -->
                            @if($booking->checked_in_at)
                            <div class="flex gap-6 relative">
                                <div class="absolute left-6 top-10 bottom-0 w-px bg-white/5"></div>
                                <div class="w-12 h-12 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-500 z-10">🚀</div>
                                <div>
                                    <h4 class="text-sm font-black text-white uppercase tracking-tight">Active Deployment Protocol</h4>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Released At: {{ \Carbon\Carbon::parse($booking->checked_in_at)->format('M d, H:i') }}</p>
                                    <div class="mt-4 grid grid-cols-2 gap-4">
                                        <div class="p-4 bg-gray-950 rounded-2xl border border-white/5">
                                            <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Starting Mileage</p>
                                            <p class="text-xs font-black text-white font-mono">{{ number_format($booking->start_odo) }} KM</p>
                                        </div>
                                        <div class="p-4 bg-gray-950 rounded-2xl border border-white/5">
                                            <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Fuel Status</p>
                                            <p class="text-xs font-black text-white uppercase italic">FULL-TO-FULL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Milestone: Return Artifacts -->
                            @if($booking->returned_at)
                            <div class="flex gap-6 relative">
                                <div class="w-12 h-12 rounded-full bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-500 z-10">🏁</div>
                                <div>
                                    <h4 class="text-sm font-black text-white uppercase tracking-tight">Return & Integrity Audit</h4>
                                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Archived At: {{ \Carbon\Carbon::parse($booking->returned_at)->format('M d, H:i') }}</p>
                                    <div class="mt-4 grid grid-cols-2 gap-4 mb-6">
                                        <div class="p-4 bg-gray-950 rounded-2xl border border-white/5">
                                            <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Final Odometer</p>
                                            <p class="text-xs font-black text-white font-mono">{{ number_format($booking->end_odo) }} KM</p>
                                        </div>
                                        <div class="p-4 bg-gray-950 rounded-2xl border border-white/5">
                                            <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Fuel Recorded</p>
                                            <p class="text-xs font-black text-white uppercase italic">{{ $booking->end_fuel ?: 'VERIFIED' }}</p>
                                        </div>
                                    </div>
                                    @if($booking->inspection_notes)
                                    <p class="p-6 bg-purple-500/5 border border-purple-500/10 rounded-2xl text-[11px] text-gray-400 italic leading-relaxed">
                                        "{{ $booking->inspection_notes }}"
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Strategic Sidebar: Logistics & Actors -->
                <div class="space-y-10">
                    
                    <!-- Tactical Command Actions -->
                    <div class="bg-gray-900 border border-white/10 p-10 rounded-[4rem] shadow-2xl relative overflow-hidden group">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-10 italic flex items-center gap-3">
                            <span class="p-1 bg-red-500 rounded-md"></span>
                            Protocol Commands
                        </h4>

                        <div class="space-y-4">
                            @if(session('error'))
                                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl mb-4">
                                    <p class="text-[9px] font-black text-red-400 uppercase tracking-widest leading-tight">{{ session('error') }}</p>
                                </div>
                            @endif
                            
                            @if($errors->any())
                                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl mb-4">
                                    @foreach($errors->all() as $error)
                                        <p class="text-[9px] font-black text-red-400 uppercase tracking-widest mb-1 last:mb-0">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if($booking->status === 'pending')
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button class="w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-indigo-600/20 transition-all">Authorize Mission</button>
                                </form>
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="w-full py-5 bg-white/5 border border-white/5 text-gray-500 hover:bg-red-600 hover:text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl transition-all">Abort Access</button>
                                </form>
                            @elseif($booking->status === 'approved' && $booking->payment_status === 'paid')
                                <button onclick="togglePanel('handover-pnl')" class="w-full py-5 bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-emerald-600/20 transition-all">Log Handover</button>
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" class="mt-4">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="w-full py-4 bg-white/5 border border-white/5 text-gray-500 hover:bg-red-600 hover:text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl transition-all">Abort Access</button>
                                </form>
                            @elseif($booking->status === 'approved')
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="w-full py-5 bg-white/5 border border-white/5 text-gray-500 hover:bg-red-600 hover:text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl transition-all">Abort Access</button>
                                </form>
                            @elseif(in_array($booking->status, ['ongoing', 'returning']))
                                <button onclick="togglePanel('audit-pnl')" class="w-full py-5 bg-white text-gray-950 hover:bg-purple-600 hover:text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl transition-all">Conduct Final Audit</button>
                            @elseif($booking->status === 'returned' && !$booking->isLocked())
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button class="w-full py-6 bg-white text-gray-950 font-black text-sm uppercase tracking-[0.4em] rounded-2xl shadow-xl transition-all hover:scale-[1.02]">Finalize Operation</button>
                                </form>
                            @endif
                            
                            @if($booking->status === 'completed' && !(\App\Models\UserReview::where('reviewer_id', auth()->id())->where('booking_id', $booking->id)->exists()))
                                <button onclick="document.getElementById('review-pnl').classList.toggle('hidden')" class="w-full py-4 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-indigo-500 hover:text-white transition-all">Update Operator Rep</button>
                            @endif
                        </div>
                    </div>

                    <!-- Operator Identity Module -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                         <div class="absolute inset-0 bg-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                            Operator Identity
                        </h4>
                        
                        <a href="{{ route('profiles.show', $booking->customer) }}" class="flex items-center gap-6 group/id">
                            <div class="w-16 h-16 rounded-2xl bg-gray-800 border-2 border-indigo-500/30 overflow-hidden flex items-center justify-center text-xl font-black text-white shadow-xl group-hover/id:border-indigo-500 transition-all">
                                @if($booking->customer->profile_photo)
                                    <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($booking->customer->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-white uppercase tracking-tight group-hover/id:text-indigo-400 transition-colors">{{ $booking->customer->name }}</h5>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $booking->customer->is_verified ? 'bg-emerald-500' : 'bg-amber-500' }} shadow-[0_0_5px_currentColor]"></span>
                                    <span class="text-[8px] text-gray-500 font-black uppercase tracking-widest">{{ $booking->customer->is_verified ? 'Verified Bio-ID' : 'Awaiting ID Signal' }}</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Signal Terminal (Chat Integrated) -->
                    <div class="bg-gray-900 border border-white/10 rounded-[3.5rem] overflow-hidden shadow-2xl flex flex-col min-h-[500px]">
                        <div class="p-8 border-b border-white/5 bg-gray-950/50 flex items-center gap-4">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,1)]"></div>
                            <h4 class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Signal Terminal: Secure Stream</h4>
                        </div>

                        <div class="flex-1 p-8 overflow-y-auto space-y-6 max-h-[400px]" id="messages-hub">
                             @forelse($booking->messages as $msg)
                                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="flex flex-col {{ $msg->sender_id === auth()->id() ? 'items-end' : 'items-start' }} max-w-[85%]">
                                        <div class="px-5 py-4 rounded-3xl shadow-xl {{ $msg->sender_id === auth()->id() ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-800 text-gray-200 border border-white/10 rounded-bl-none' }}">
                                            <p class="text-xs leading-relaxed font-medium">{{ $msg->message }}</p>
                                        </div>
                                        <span class="mt-2 text-[8px] text-gray-600 font-black uppercase tracking-widest">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-center opacity-20">
                                    <div class="text-4xl mb-4">📡</div>
                                    <p class="text-[9px] font-black tracking-[0.2em] uppercase">No active signals detected in the stream</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="p-6 border-t border-white/5 bg-gray-950/30">
                            <form action="{{ route('bookings.messages.store', $booking) }}" method="POST" class="flex gap-3">
                                @csrf
                                <input type="text" name="message" required autocomplete="off" placeholder="Inscribe mission command..." class="flex-1 bg-gray-900 border border-white/5 rounded-2xl px-6 py-4 text-xs text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none italic">
                                <button type="submit" class="p-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl transition-all shadow-xl shadow-indigo-600/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Financial Breakdown (Sidebar) -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-l">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                            Fiscal Metadata
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between text-[11px] font-bold">
                                <span class="text-gray-500 uppercase tracking-widest italic">Base Contract</span>
                                <span class="text-white">৳ {{ number_format($booking->total_price) }}</span>
                            </div>
                            <div class="flex justify-between text-[11px] font-bold">
                                <span class="text-gray-500 uppercase tracking-widest italic">Secure Deposit</span>
                                <span class="text-white">৳ {{ number_format($booking->security_deposit_amount) }}</span>
                            </div>
                            <div class="flex justify-between text-[11px] font-bold">
                                <span class="text-gray-500 uppercase tracking-widest italic">Platform Flux</span>
                                <span class="text-gray-700">- ৳ {{ number_format($booking->platform_fee ?: ($booking->total_price * 0.1)) }}</span>
                            </div>
                            <div class="pt-4 border-t border-white/5 flex justify-between items-baseline">
                                <span class="text-[9px] font-black text-white uppercase tracking-widest">Net Realized</span>
                                <span class="text-xl font-black text-emerald-400 tracking-tighter shadow-lg">৳ {{ number_format($booking->total_price - ($booking->platform_fee ?: ($booking->total_price * 0.1))) }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Dynamic Intervention Panels (Hidden by default) -->
            
            {{-- Handover Logic --}}
            <div id="handover-pnl" class="hidden bg-gray-900/60 backdrop-blur-3xl border-4 border-emerald-500/20 p-12 rounded-[4rem] animate-in slide-in-from-bottom-5">
                 <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-10 flex items-center gap-4">
                    <span class="w-1.5 h-10 bg-emerald-500 rounded-full shadow-[0_0_20px_rgba(16,185,129,0.5)]"></span>
                    LOG HANDOVER ARTIFACTS
                 </h3>
                 <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="ongoing">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-6">Current Odometer Verification</label>
                            <input type="number" name="start_odo" required value="{{ $booking->start_odo }}" placeholder="Verify KM exactly..." class="w-full bg-gray-950 border border-white/10 rounded-3xl p-6 text-white text-xl font-mono focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-6">Starting Fuel Level</label>
                            <select name="start_fuel" required class="w-full bg-gray-950 border border-white/10 rounded-3xl p-6 text-white text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-emerald-500 outline-none appearance-none">
                                <option value="Full">Full (Nominal)</option>
                                <option value="3/4">3/4 Level</option>
                                <option value="1/2">1/2 Level</option>
                                <option value="1/4">1/4 Level</option>
                                <option value="Empty">Empty (Critical)</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-6 flex flex-col justify-between">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-6">Handover Condition Artifact</label>
                            <input type="file" name="handover_image" class="w-full text-xs text-gray-500 file:mr-4 file:py-4 file:px-8 file:rounded-3xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-emerald-500/10 file:text-emerald-400 hover:file:bg-emerald-500/20 transition-all border border-white/5 bg-gray-950 rounded-[2.5rem] p-4">
                        </div>
                        <div class="pt-4">
                            <p class="text-[9px] text-emerald-400 font-bold italic mb-5 leading-relaxed bg-emerald-500/5 p-4 rounded-2xl border border-emerald-500/10">
                                "Verify physical driver license and matching user bio-data before releasing the asset keys. Protocol enforcement required."
                            </p>
                            <button type="submit" class="w-full py-6 bg-emerald-600 hover:bg-emerald-500 font-black text-white uppercase tracking-widest rounded-3xl shadow-2xl shadow-emerald-600/30 transition-all hover:scale-[1.02]">Authorize Deployed State</button>
                        </div>
                    </div>
                 </form>
            </div>

            {{-- Audit & Return Logic --}}
            <div id="audit-pnl" x-data="{ damageDetected: false }" class="hidden bg-gray-900/60 backdrop-blur-3xl border-4 border-purple-500/20 p-12 rounded-[4rem] animate-in slide-in-from-bottom-5">
                 <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-10 flex items-center gap-4">
                    <span class="w-1.5 h-10 bg-purple-500 rounded-full shadow-[0_0_20px_rgba(168,85,247,0.5)]"></span>
                    CONDUCT FINAL INTEGRITY AUDIT
                 </h3>
                 <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="returned">
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="space-y-2">
                             <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Final Odometer (KM)</label>
                             <input type="number" name="end_odo" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-mono focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Fuel Status Trace</label>
                             <select name="end_fuel" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-black uppercase text-xs focus:ring-2 focus:ring-purple-500 outline-none">
                                <option value="Full">Full (Nominal)</option>
                                <option value="3/4">3/4 Level</option>
                                <option value="1/2">1/2 Level</option>
                                <option value="1/4">1/4 Level</option>
                                <option value="Empty">Empty (Critical)</option>
                             </select>
                        </div>
                         <div class="space-y-2">
                             <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Operational Snapshot</label>
                             <input type="file" name="inspection_image" class="w-full text-[10px] text-gray-700 file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:bg-white/5 file:text-purple-400 file:font-black">
                        </div>
                    </div>

                    <div class="p-8 bg-black/40 rounded-[2.5rem] border border-white/5 space-y-6">
                         <div class="flex items-center justify-between">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" x-model="damageDetected" class="w-6 h-6 rounded-lg bg-gray-950 border-white/10 text-red-600 focus:ring-red-600">
                                <span class="text-xs font-black text-white uppercase tracking-widest">Log Integrity Breach?</span>
                            </label>
                            <span :class="damageDetected ? 'text-red-500' : 'text-gray-700'" class="text-[9px] font-black uppercase tracking-[0.3em]" x-text="damageDetected ? 'SOVEREIGN LOCK ENGAGED' : 'INTEGRITY VERIFIED NOMINAL'"></span>
                         </div>

                         <div x-show="damageDetected" x-transition class="pt-8 border-t border-white/5 space-y-8">
                             <div>
                                <label class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-3 block">Environmental Description of Incident</label>
                                <textarea name="damage_description" placeholder="Detail the physical compromise..." class="w-full bg-gray-950 border border-red-500/20 rounded-3xl p-6 text-white text-xs italic focus:ring-2 focus:ring-red-600 outline-none"></textarea>
                             </div>
                             <div class="grid grid-cols-2 gap-10">
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-red-400 uppercase tracking-widest ms-4">Assessment Cost (৳)</label>
                                    <input type="number" name="damage_cost" placeholder="0.00" class="w-full bg-gray-950 border border-red-500/20 rounded-2xl p-5 text-white font-mono focus:ring-2 focus:ring-red-600 outline-none">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-red-400 uppercase tracking-widest ms-4">Incident Artifact (Photo)</label>
                                    <input type="file" name="damage_image" class="w-full text-[10px] text-gray-700 file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:bg-red-500/10 file:text-red-500 file:font-black">
                                </div>
                             </div>
                         </div>
                    </div>

                    <button type="submit" class="w-full py-6 bg-purple-600 hover:bg-purple-500 text-white font-black text-sm uppercase tracking-[0.4em] rounded-3xl shadow-2xl shadow-purple-600/20 transition-all">Archive Artifacts & Complete Audit</button>
                 </form>
            </div>

             {{-- Reputation Update Logic --}}
             <div id="review-pnl" class="hidden bg-gray-900 border-4 border-indigo-500/20 p-12 rounded-[4rem] animate-in slide-in-from-bottom-5">
                 <h3 class="text-2xl font-black text-white uppercase italic tracking-tighter mb-10 flex items-center gap-4">
                    <span class="w-1.5 h-10 bg-indigo-500 rounded-full shadow-[0_0_20px_rgba(99,102,241,0.5)]"></span>
                    LOG OPERATOR REPUTATION
                 </h3>
                 <form action="{{ route('owner.bookings.review', $booking) }}" method="POST" class="space-y-10">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                        <div class="md:col-span-1 space-y-4">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4 block">Rep Reputation Status</label>
                            <select name="rating" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-black uppercase text-xs focus:ring-2 focus:ring-indigo-500 outline-none">
                                <option value="5">5 ★ Elite Status</option>
                                <option value="4">4 ★ Reliable Operator</option>
                                <option value="3">3 ★ Nominal conduct</option>
                                <option value="2">2 ★ Below protocol</option>
                                <option value="1">1 ★ Protocol Violation</option>
                            </select>
                        </div>
                        <div class="md:col-span-3 space-y-4">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4 block">Conduct Testimony</label>
                            <input type="text" name="comment" required placeholder="Log conduct artifacts during deployment..." class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500 outline-none font-bold italic">
                        </div>
                    </div>
                    <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl shadow-indigo-600/20">Commit Reputation Artifact</button>
                 </form>
             </div>

        </div>
    </div>
    <script>
        window.onload = () => {
            const container = document.getElementById('messages-hub');
            if (container) container.scrollTop = container.scrollHeight;
        }

        function togglePanel(id) {
            const el = document.getElementById(id);
            if (!el) return;
            
            // Close other panels
            ['handover-pnl', 'audit-pnl', 'review-pnl'].forEach(pId => {
                if (pId !== id) {
                    const p = document.getElementById(pId);
                    if (p) p.classList.add('hidden');
                }
            });

            el.classList.toggle('hidden');
            
            if (!el.classList.contains('hidden')) {
                setTimeout(() => {
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            }
        }
    </script>
</x-app-layout>
