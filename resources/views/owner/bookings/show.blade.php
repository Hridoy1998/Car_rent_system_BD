<x-app-layout x-data="{ activePanel: null }">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-[#050B1A] tracking-tight uppercase italic leading-[1.1]">
                    Operation <span class="text-orange-500">Brief</span>
                </h2>
                <div class="flex items-center gap-4 mt-3">
                    <span class="px-3 py-1 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-widest rounded-lg italic shadow-xl">#{{ strtoupper(substr($booking->id, 0, 8)) }}</span>
                    <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest italic">Secure Mission Briefing Node</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                 <div class="hidden md:flex flex-col items-end">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-tight">Live Sync Status</span>
                    <span class="text-[10px] font-black text-emerald-500 animate-pulse italic mt-1">STREAM ACTIVE</span>
                </div>
                <div class="h-10 w-px bg-gray-200 mx-2"></div>
                <a href="{{ route('owner.bookings.index') }}" class="text-[10px] font-black text-gray-500 hover:text-[#050B1A] uppercase tracking-widest italic flex items-center gap-3 transition-all group">
                    <svg class="w-5 h-5 group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7 7-7"></path></svg>
                    Return to Hub
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen relative overflow-hidden pb-24 font-outfit">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>

        <!-- Institutional Hero: Operation Brief Banner -->
        <div class="relative py-24 md:py-32 mb-12 md:mb-16 -mt-12 overflow-hidden rounded-b-[3rem] md:rounded-b-[5rem] group border-b border-gray-200 shadow-2xl shadow-indigo-500/5">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2000ms] group-hover:scale-110" style="background-image: url('{{ asset('images/assets/operation_brief_banner.png') }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-3 px-4 py-2 bg-white/5 border border-white/10 rounded-xl mb-6 backdrop-blur-md">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-white uppercase tracking-widest italic">Operational State: {{ strtoupper($booking->status) }}</span>
                    </div>
                    <h1 class="text-5xl md:text-8xl font-black text-white uppercase tracking-tight italic leading-[1.1] mb-8">
                        Mission <br> <span class="text-orange-500 text-glow-orange">Command.</span>
                    </h1>
                    <p class="text-gray-300 font-bold text-xs uppercase tracking-widest mt-6 italic opacity-80 leading-relaxed max-w-xl">
                        Accessing secure mission artifacts and telemetry for operational unit #{{ $booking->id }}. Verified parameters and signal integrity enforced.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
                
                <!-- Operation Intel Hub (Left Context) -->
                <div class="lg:col-span-2 space-y-12">
                    
                    <!-- Module: Asset Intelligence Hub -->
                    <div class="bg-white border border-gray-100 rounded-[2rem] md:rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] overflow-hidden transition-all hover:shadow-2xl group">
                        <div class="p-6 sm:p-10 md:p-14 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-10">
                            <div class="flex flex-col sm:flex-row items-center gap-6 md:gap-8 text-center sm:text-left">
                                <div class="relative group/asset">
                                    <div class="w-32 h-20 bg-[#050B1A] rounded-2xl border-4 border-gray-50 overflow-hidden shadow-2xl group-hover/asset:border-orange-500 transition-all duration-700">
                                        <img src="{{ $booking->car->primary_image_url }}" class="w-full h-full object-cover group-hover/asset:scale-125 transition-transform duration-[1500ms]">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-tight group-hover:translate-x-1 transition-transform">
                                        {{ $booking->car->brand }} <span class="text-orange-500">{{ $booking->car->model }}</span>
                                    </h3>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic flex items-center justify-center sm:justify-start gap-3 md:gap-4 leading-none">
                                        Asset: {{ $booking->car->license_plate }}
                                        <span class="hidden sm:block h-px w-12 md:w-20 bg-gray-100"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-center md:text-right border-t border-gray-50 md:border-none pt-6 md:pt-0 w-full md:w-auto">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-1 italic leading-none">Contract Yield</span>
                                <span class="text-3xl md:text-4xl font-black text-[#050B1A] tracking-tight italic leading-none"><span class="text-orange-500 text-sm md:text-base italic mr-1">৳</span>{{ number_format($booking->total_price) }}</span>
                            </div>
                        </div>

                        <!-- Tactical Tracker -->
                        <div class="px-6 md:px-10 py-10 md:py-16 bg-gray-50/30 overflow-hidden">
                            <livewire:booking-status-tracker :booking="$booking" />
                        </div>
                    </div>

                    <!-- Module: Operational Timeline Artifacts -->
                    <div class="bg-white border border-gray-100 p-6 sm:p-10 md:p-16 rounded-[2rem] md:rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] transition-all hover:shadow-2xl">
                        <div class="flex items-center gap-4 md:gap-6 mb-10 md:mb-16 px-2">
                            <div class="w-12 h-12 md:w-16 md:h-16 bg-[#050B1A] rounded-2xl md:rounded-[1.5rem] flex items-center justify-center text-white shadow-2xl border border-white/10 italic font-black text-xl md:text-2xl">
                                TL
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl md:text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-tight">Timeline</h3>
                                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic flex items-center gap-3 md:gap-4 leading-none">
                                    Breadcrumb Registry
                                    <span class="h-px flex-1 bg-gray-50"></span>
                                </p>
                            </div>
                        </div>

                        <div class="space-y-12 md:space-y-16 relative">
                            <!-- Track Line -->
                            <div class="absolute left-7 md:left-14 top-16 bottom-0 w-px bg-gray-100"></div>

                            <!-- Milestone: Authorization -->
                            <div class="flex gap-6 md:gap-14 relative z-10 px-2 group/milestone">
                                <div class="w-10 h-10 md:w-20 md:h-20 bg-emerald-50 rounded-2xl md:rounded-[2rem] border-2 md:border-4 border-white flex items-center justify-center text-emerald-500 shadow-xl group-hover/milestone:bg-emerald-500 group-hover/milestone:text-white transition-all duration-500 flex-shrink-0">
                                    <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base md:text-xl font-black text-[#050B1A] uppercase tracking-tight italic leading-tight group-hover/milestone:translate-x-2 transition-transform">Bio-ID Verified</h4>
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic leading-none truncate">{{ $booking->updated_at->format('d M, Y | H:i') }}</p>
                                    <div class="mt-6 md:mt-8 p-6 md:p-8 bg-gray-50/80 border-2 border-gray-100 rounded-3xl md:rounded-[3rem] text-[10px] md:text-[11px] text-gray-500 font-black uppercase tracking-widest italic leading-relaxed shadow-inner">
                                        Asset status transitioned to APPROVED under administrative protocol. User identity verified via secure platform registry.
                                    </div>
                                </div>
                            </div>

                            <!-- Milestone: Deployed -->
                            @if($booking->checked_in_at)
                            <div class="flex gap-6 md:gap-14 relative z-10 px-2 group/milestone">
                                <div class="w-10 h-10 md:w-20 md:h-20 bg-blue-50 rounded-2xl md:rounded-[2rem] border-2 md:border-4 border-white flex items-center justify-center text-blue-500 shadow-xl group-hover/milestone:bg-blue-600 group-hover/milestone:text-white transition-all duration-500 flex-shrink-0">
                                    <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base md:text-xl font-black text-[#050B1A] uppercase tracking-tight italic leading-tight group-hover/milestone:translate-x-2 transition-transform">Deployed Handover</h4>
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic leading-none">{{ \Carbon\Carbon::parse($booking->checked_in_at)->format('d M | H:i') }}</p>
                                    <div class="mt-6 md:mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                                        <div class="p-6 md:p-8 bg-white border-2 border-gray-100 rounded-2xl md:rounded-[2.5rem] shadow-sm italic transition-all hover:border-blue-500/20 hover:shadow-xl">
                                            <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 md:mb-3 leading-none">Odo Start</p>
                                            <p class="text-xl md:text-2xl font-black text-[#050B1A] font-outfit tracking-tight leading-none">{{ number_format($booking->start_odo) }} <span class="text-[10px] uppercase text-gray-400 font-bold tracking-widest ml-1">km</span></p>
                                        </div>
                                        <div class="p-6 md:p-8 bg-white border-2 border-gray-100 rounded-2xl md:rounded-[2.5rem] shadow-sm italic transition-all hover:border-blue-500/20 hover:shadow-xl">
                                            <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 md:mb-3 leading-none">Fuel Level</p>
                                            <p class="text-xl md:text-2xl font-black text-[#050B1A] uppercase italic leading-none">Institutional Full</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Milestone: Return Artifacts -->
                            @if($booking->returned_at)
                            <div class="flex gap-6 md:gap-14 relative z-10 px-2 group/milestone">
                                <div class="w-10 h-10 md:w-20 md:h-20 bg-purple-50 rounded-2xl md:rounded-[2rem] border-2 md:border-4 border-white flex items-center justify-center text-purple-600 shadow-xl group-hover/milestone:bg-purple-600 group-hover/milestone:text-white transition-all duration-500 flex-shrink-0">
                                    <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base md:text-xl font-black text-[#050B1A] uppercase tracking-tight italic leading-tight group-hover/milestone:translate-x-2 transition-transform">Audit Complete</h4>
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic leading-none">{{ \Carbon\Carbon::parse($booking->returned_at)->format('d M | H:i') }}</p>
                                    <div class="mt-6 md:mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mb-6 md:mb-8">
                                        <div class="p-6 md:p-8 bg-white border-2 border-gray-100 rounded-2xl md:rounded-[2.5rem] shadow-sm italic transition-all hover:border-purple-500/20 hover:shadow-xl">
                                            <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 md:mb-3 leading-none">Odo Final</p>
                                            <p class="text-xl md:text-2xl font-black text-[#050B1A] font-outfit tracking-tight leading-none">{{ number_format($booking->end_odo) }} <span class="text-[10px] uppercase text-gray-400 font-bold tracking-widest ml-1">km</span></p>
                                        </div>
                                        <div class="p-6 md:p-8 bg-white border-2 border-gray-100 rounded-2xl md:rounded-[2.5rem] shadow-sm italic transition-all hover:border-purple-500/20 hover:shadow-xl">
                                            <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 md:mb-3 leading-none">Fuel Audit</p>
                                            <p class="text-xl md:text-2xl font-black text-[#050B1A] uppercase italic leading-none">{{ $booking->end_fuel ?: 'Full' }}</p>
                                        </div>
                                    </div>
                                    @if($booking->inspection_notes)
                                    <div class="p-6 md:p-10 bg-purple-50 rounded-3xl md:rounded-[3rem] border-2 border-purple-100 text-[10px] md:text-[11px] font-black text-purple-700 uppercase tracking-widest italic leading-relaxed text-center relative overflow-hidden group/notes">
                                        <div class="absolute -right-10 -bottom-10 w-24 h-24 md:w-32 md:h-32 bg-purple-100 rounded-full blur-2xl group-hover/notes:scale-150 transition-transform"></div>
                                        <span class="relative z-10">"{{ $booking->inspection_notes }}"</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tactical Intervention Panels -->
                    <div class="space-y-12">
                        @include('owner.bookings.partials.intervention-panels')
                    </div>
                </div>

                <!-- Mission Command Sidebar (Right Context) -->
                <div class="space-y-12">
                    
                    <!-- Sidebar: Protocol Commands -->
                    <div class="bg-white border-2 border-gray-100 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] relative overflow-hidden group">
                         <div class="absolute -right-10 -top-10 w-48 h-48 bg-orange-50 rounded-full blur-[80px] group-hover:bg-orange-100 transition-all duration-700"></div>
                         
                         <h4 class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest mb-12 italic flex items-center gap-4 relative z-10 leading-none">
                            <span class="w-2 h-2 bg-orange-500 rounded-full shadow-[0_0_10px_rgba(249,115,22,0.8)]"></span>
                            Protocol Commands
                        </h4>

                        <div class="space-y-6 relative z-10">
                            @if(session('error'))
                                <div class="p-6 bg-red-50 border-2 border-red-100 rounded-2xl mb-8 animate-pulse italic">
                                    <p class="text-[10px] font-black text-red-600 uppercase tracking-widest leading-tight">PROTOCOL FAULT: {{ session('error') }}</p>
                                </div>
                            @endif
                            
                            @if($errors->any())
                                <div class="p-6 bg-red-50 border-2 border-red-100 rounded-2xl mb-8 italic">
                                    @foreach($errors->all() as $error)
                                        <p class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-1 last:mb-0">• {{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if($booking->status === 'pending')
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button class="w-full py-8 bg-[#050B1A] hover:bg-emerald-500 text-white font-black text-[11px] uppercase tracking-widest rounded-[2rem] shadow-2xl transition-all hover:-translate-y-1 italic leading-none">Authorize Mission</button>
                                </form>
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="w-full py-6 bg-white border-2 border-gray-100 text-gray-500 hover:bg-red-500 hover:text-white hover:border-red-500 font-black text-[10px] uppercase tracking-[0.3em] rounded-[2rem] transition-all italic">Abort Access</button>
                                </form>
                            @elseif($booking->status === 'approved' && $booking->payment_status === 'paid')
                                <button @click="activePanel = 'handover'" class="w-full py-8 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[11px] uppercase tracking-[0.4em] rounded-[2rem] shadow-xl shadow-emerald-500/20 transition-all hover:-translate-y-1 italic">Tactical Handover</button>
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" class="mt-6">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="w-full py-6 bg-white border-2 border-gray-100 text-gray-500 hover:bg-red-500 hover:text-white hover:border-red-500 font-black text-[10px] uppercase tracking-[0.3em] rounded-[2rem] transition-all italic">Abort Mission</button>
                                </form>
                            @elseif($booking->status === 'approved')
                                <div class="p-8 bg-orange-50 border-2 border-orange-100 rounded-[2.5rem] mb-8 italic text-center">
                                    <p class="text-[11px] font-black text-orange-600 uppercase tracking-widest leading-relaxed">Awaiting Settlement Node Discovery</p>
                                </div>
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="w-full py-6 bg-white border-2 border-gray-100 text-gray-500 hover:bg-red-500 hover:text-white hover:border-red-500 font-black text-[10px] uppercase tracking-[0.3em] rounded-[2rem] transition-all italic">Abort Mission</button>
                                </form>
                            @elseif(in_array($booking->status, ['ongoing', 'returning']))
                                <button @click="activePanel = 'audit'" class="w-full py-8 bg-[#050B1A] text-white hover:bg-purple-600 font-black text-[11px] uppercase tracking-[0.4em] rounded-[2rem] shadow-2xl transition-all hover:-translate-y-1 italic">Conduct Final Audit</button>
                            @elseif($booking->status === 'returned' && !$booking->isLocked())
                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button class="w-full py-10 bg-[#050B1A] hover:bg-emerald-500 text-white font-black text-[13px] uppercase tracking-[0.6em] rounded-[2.5rem] shadow-2xl transition-all hover:scale-[1.02] italic">Finalize Operation</button>
                                </form>
                            @endif
                            
                            @if($booking->status === 'completed' && !(\App\Models\UserReview::where('reviewer_id', auth()->id())->where('booking_id', $booking->id)->exists()))
                                <button @click="activePanel = 'review'" class="w-full py-6 bg-white border-2 border-gray-100 text-gray-500 hover:text-[#050B1A] hover:border-orange-500 font-black text-[10px] uppercase tracking-[0.3em] rounded-[2rem] transition-all italic">Update Operator Reputation</button>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar: Operator Dossier -->
                    <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] relative overflow-hidden group">
                         <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-indigo-50 rounded-full blur-[80px] group-hover:bg-indigo-100 transition-all duration-700"></div>
                         
                         <h4 class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest mb-12 italic flex items-center gap-4 relative z-10 leading-none">
                            <span class="w-2 h-2 bg-indigo-500 rounded-full shadow-[0_0_10px_rgba(99,102,241,0.8)]"></span>
                            Operator Dossier
                        </h4>
                        
                        <div class="relative z-10">
                            <a href="{{ route('profiles.show', $booking->customer) }}" class="flex items-center gap-6 group/id">
                                <div class="w-20 h-20 rounded-[1.5rem] bg-[#050B1A] border-4 border-gray-50 overflow-hidden flex items-center justify-center text-2xl font-black text-white shadow-2xl group-hover/id:border-orange-500 transition-all">
                                    @if($booking->customer->profile_photo)
                                        <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($booking->customer->name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-lg font-black text-[#050B1A] uppercase tracking-tight italic leading-none group-hover/id:translate-x-1 transition-transform">{{ $booking->customer->name }}</h5>
                                    <div class="flex items-center gap-3 mt-3">
                                        <span class="w-2 h-2 rounded-full {{ $booking->customer->is_verified ? 'bg-emerald-500' : 'bg-amber-500' }} shadow-[0_0_8px_currentColor]"></span>
                                        <span class="text-[9px] text-gray-500 font-black uppercase tracking-widest italic leading-none">{{ $booking->customer->is_verified ? 'Verified Bio-ID' : 'Pending Bio-ID' }}</span>
                                    </div>
                                </div>
                                <div class="text-gray-300">
                                    <svg class="w-6 h-6 group-hover/id:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </a>

                            <div class="mt-10 pt-10 border-t border-gray-50 grid grid-cols-2 gap-6">
                                <div class="p-6 bg-gray-50/50 rounded-2xl border border-gray-100 flex flex-col items-center">
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Verified Mob.</span>
                                    <span class="text-[10px] font-black text-[#050B1A]">{{ $booking->customer->phone ?: 'NOT DEPLOYED' }}</span>
                                </div>
                                <div class="p-6 bg-gray-50/50 rounded-2xl border border-gray-100 flex flex-col items-center text-center">
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Operator Rep.</span>
                                    <div class="flex items-center gap-1">
                                        <span class="text-[10px] font-black text-[#050B1A]">{{ $booking->customer->rating ?? '5.0' }}</span>
                                        <span class="text-orange-500 text-[10px]">★</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar: Secure Signal Terminal (Chat) -->
                    <div class="bg-white border-2 border-gray-100 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col min-h-[500px] md:min-h-[600px] group/chat">
                        <div class="p-8 md:p-10 border-b border-gray-50 bg-gray-50/50 flex flex-col gap-4 relative">
                            <div class="flex items-center gap-4 relative z-10">
                                <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.8)]"></div>
                                <h4 class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest italic leading-none">Signal Stream: SECURE</h4>
                            </div>
                            <p class="text-[8px] text-gray-500 font-bold uppercase tracking-widest italic mt-1 leading-none">Multi-Vector Encrypted Mission Protocol</p>
                        </div>

                        <div class="flex-1 p-6 md:p-10 overflow-y-auto space-y-8 md:space-y-10 max-h-[450px] scrollbar-hide" id="messages-hub">
                             @forelse($booking->messages as $msg)
                                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} animate-in slide-in-from-bottom-2 duration-500">
                                    <div class="flex flex-col {{ $msg->sender_id === auth()->id() ? 'items-end' : 'items-start' }} max-w-[90%]">
                                        <div class="px-6 md:px-8 py-4 md:py-6 rounded-[2rem] md:rounded-[2.5rem] shadow-xl {{ $msg->sender_id === auth()->id() ? 'bg-[#050B1A] text-white rounded-br-none' : 'bg-white text-gray-900 border-2 border-gray-100 rounded-bl-none shadow-sm' }}">
                                            <p class="text-[11px] md:text-xs leading-relaxed font-bold italic tracking-wide">{{ $msg->message }}</p>
                                        </div>
                                        <span class="mt-2 md:mt-4 text-[7px] md:text-[8px] text-gray-400 font-black uppercase tracking-[0.3em] italic">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-center opacity-20 grayscale">
                                    <div class="w-24 h-24 bg-gray-50 rounded-[2.5rem] flex items-center justify-center text-4xl mb-6 shadow-inner italic font-black">📡</div>
                                    <p class="text-[10px] text-gray-800 font-black tracking-[0.4em] uppercase italic">Awaiting Signal Synchronization</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="p-4 md:p-10 border-t border-gray-50 bg-gray-50/30">
                            <form action="{{ route('bookings.messages.store', $booking) }}" method="POST" class="relative group/form">
                                @csrf
                                <div class="flex items-center gap-2 md:gap-4 bg-white border-2 border-gray-100 rounded-2xl md:rounded-3xl p-2 md:p-3 focus-within:border-orange-500 focus-within:ring-4 focus-within:ring-orange-500/10 transition-all shadow-sm">
                                    <input type="text" name="message" required autocomplete="off" placeholder="Inscribe command..." class="flex-1 bg-transparent border-none text-[11px] md:text-sm font-black text-[#050B1A] outline-none focus:ring-0 italic uppercase tracking-widest placeholder:text-gray-300 ps-2 md:ps-4">
                                    <button type="submit" class="w-10 h-10 md:w-14 md:h-14 bg-[#050B1A] hover:bg-orange-500 text-white rounded-xl md:rounded-2xl flex items-center justify-center transition-all shadow-xl hover:-translate-y-0.5 flex-shrink-0">
                                        <svg class="w-4 h-4 md:w-6 md:h-6 rotate-45 -translate-y-0.5 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sidebar: Fiscal Metadata -->
                    <div class="bg-[#050B1A] border border-white/5 p-8 md:p-14 rounded-[2.5rem] md:rounded-[4rem] shadow-2xl relative overflow-hidden group">
                         <div class="absolute -right-20 -top-20 w-64 h-64 bg-emerald-500/5 rounded-full blur-[100px] group-hover:bg-emerald-500/10 transition-all duration-700"></div>
                         
                         <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-12 italic flex items-center gap-4 relative z-10 leading-none">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.8)]"></span>
                            Fiscal Metadata
                        </h4>
                        
                        <div class="space-y-8 relative z-10">
                            <div class="flex justify-between items-center group/item">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic group-hover:text-white transition-colors leading-none">Base Contract</span>
                                <span class="text-lg font-black text-white italic tracking-tight leading-none">৳ {{ number_format($booking->total_price) }}</span>
                            </div>
                            <div class="flex justify-between items-center group/item">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic group-hover:text-white transition-colors leading-none">Secure Deposit</span>
                                <span class="text-lg font-black text-white italic tracking-tight leading-none">৳ {{ number_format($booking->security_deposit_amount) }}</span>
                            </div>
                            <div class="flex justify-between items-center group/item">
                                <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest italic group-hover:text-red-400 transition-colors leading-none">Platform Flux</span>
                                <span class="text-lg font-black text-red-500/50 italic tracking-tight leading-none">- ৳ {{ number_format($booking->platform_fee ?: ($booking->total_price * 0.1)) }}</span>
                            </div>
                            
                            <div class="pt-10 border-t border-white/5 flex flex-col items-end">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-3 italic leading-none">Net Realized Artifact</span>
                                <span class="text-5xl font-black text-white tracking-tight italic text-glow-emerald leading-none">
                                    <span class="text-emerald-500 text-xl italic mr-2 leading-none">৳</span>{{ number_format($booking->total_price - ($booking->platform_fee ?: ($booking->total_price * 0.1))) }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Scripts Integration -->
    <script>
        window.onload = () => {
            const container = document.getElementById('messages-hub');
            if (container) container.scrollTop = container.scrollHeight;
        }
    </script>
    <style>
        .text-glow-orange { text-shadow: 0 0 40px rgba(249, 115, 22, 0.4); }
        .text-glow-emerald { text-shadow: 0 0 50px rgba(16, 185, 129, 0.4); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-app-layout>
