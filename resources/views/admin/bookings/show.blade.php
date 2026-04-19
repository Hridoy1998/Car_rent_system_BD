<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div>
                <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Mission <span class="text-indigo-500">Control</span>
                </h2>
                <div class="flex items-center gap-4 mt-3">
                    <span class="w-12 h-px bg-indigo-500/30"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-600 font-black uppercase tracking-[0.4em] italic leading-none">
                        AUDIT TRAIL #OP-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white border-2 border-gray-200 p-2 rounded-2xl shadow-xl shadow-gray-200/50">
                <span class="px-6 py-2.5 bg-[#050B1A] text-white rounded-xl text-[10px] font-black uppercase tracking-widest italic shadow-xl shadow-[#050B1A]/20">
                    {{ $booking->status }}
                </span>
                <span class="px-6 py-2.5 border-2 border-gray-100 bg-gray-50 text-gray-500 rounded-xl text-[10px] font-black uppercase tracking-widest italic">
                    {{ $booking->payment_status === 'paid' ? 'Settled' : 'Payment Pending' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- Operator Identity (Customer) -->
                <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
                    <h3 class="text-xs font-black text-[#050B1A] mb-10 uppercase tracking-[0.4em] italic flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                        Operator Identity
                    </h3>
                    <div class="flex flex-col md:flex-row items-center gap-8 mb-10">
                        <div class="w-24 h-24 rounded-[2rem] bg-gray-50 border-4 border-white flex items-center justify-center text-4xl font-black text-[#050B1A] shadow-2xl overflow-hidden italic shrink-0">
                            @if($booking->customer->profile_photo)
                                <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($booking->customer->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="text-center md:text-left">
                            <a href="{{ route('admin.users.show', $booking->customer) }}" class="block group">
                                <h4 class="text-3xl font-black text-[#050B1A] group-hover:text-indigo-600 transition-colors uppercase italic tracking-tighter leading-none">{{ $booking->customer->name }}</h4>
                            </a>
                            <p class="text-gray-400 font-bold text-xs mt-2 italic tracking-tighter">{{ $booking->customer->email }}</p>
                            <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-4">
                                @if($booking->customer->is_verified)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border-2 border-emerald-100 rounded-xl text-[8px] font-black uppercase tracking-widest italic">Identity Verified</span>
                                @else
                                    <span class="px-3 py-1 bg-red-50 text-red-600 border-2 border-red-100 rounded-xl text-[8px] font-black uppercase tracking-widest italic">Unverified</span>
                                @endif
                                <span class="px-3 py-1 bg-gray-50 text-gray-500 border-2 border-white rounded-xl text-[8px] font-black uppercase tracking-widest italic">User #ID: {{ $booking->customer->id }}</span>
                                <a href="{{ route('admin.users.show', $booking->customer) }}" class="px-3 py-1 bg-[#050B1A] text-white rounded-xl text-[8px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all italic shadow-lg shadow-[#050B1A]/10">Audit ID →</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-6 bg-gray-50/50 border-2 border-white rounded-3xl shadow-sm">
                            <p class="text-[9px] text-gray-400 font-black uppercase mb-1 italic tracking-widest">Operation Counter</p>
                            <p class="text-xl font-black text-[#050B1A] italic tracking-tighter">{{ $booking->customer->bookings()->count() }} Missions</p>
                        </div>
                        <div class="p-6 bg-gray-50/50 border-2 border-white rounded-3xl shadow-sm">
                            <p class="text-[9px] text-gray-400 font-black uppercase mb-1 italic tracking-widest">Registry Age</p>
                            <p class="text-xl font-black text-[#050B1A] italic tracking-tighter">{{ $booking->customer->created_at->format('M Y') }} Hub</p>
                        </div>
                    </div>
                </div>

                <!-- Host Authority (Owner) -->
                <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-pink-50 rounded-full blur-3xl opacity-50"></div>
                    <h3 class="text-xs font-black text-[#050B1A] mb-10 uppercase tracking-[0.4em] italic flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-pink-500 rounded-full"></span>
                        Host Authority
                    </h3>
                    <div class="flex flex-col md:flex-row items-center gap-8 mb-10">
                        <div class="w-24 h-24 rounded-[2rem] bg-gray-50 border-4 border-white flex items-center justify-center text-4xl font-black text-[#050B1A] shadow-2xl overflow-hidden italic shrink-0">
                             @if($booking->car->owner->profile_photo)
                                <img src="{{ Storage::url($booking->car->owner->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($booking->car->owner->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="text-center md:text-left">
                            <a href="{{ route('admin.users.show', $booking->car->owner) }}" class="block group">
                                <h4 class="text-3xl font-black text-[#050B1A] group-hover:text-pink-600 transition-colors uppercase italic tracking-tighter leading-none">{{ $booking->car->owner->name }}</h4>
                            </a>
                            <p class="text-gray-400 font-bold text-xs mt-2 italic tracking-tighter">{{ $booking->car->owner->email }}</p>
                            <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-4">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border-2 border-indigo-100 rounded-xl text-[8px] font-black uppercase tracking-widest italic">Institutional Host</span>
                                <span class="px-3 py-1 bg-gray-50 text-gray-500 border-2 border-white rounded-xl text-[8px] font-black uppercase tracking-widest italic">Fleet Oversight: {{ $booking->car->owner->cars()->count() }}</span>
                                <a href="{{ route('admin.users.show', $booking->car->owner) }}" class="px-3 py-1 bg-[#050B1A] text-white rounded-xl text-[8px] font-black uppercase tracking-widest hover:bg-pink-600 transition-all italic shadow-lg shadow-[#050B1A]/10">Audit Host →</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-6 bg-gray-50/50 border-2 border-white rounded-3xl shadow-sm">
                            <p class="text-[9px] text-gray-400 font-black uppercase mb-1 italic tracking-widest">Lifetime Yield</p>
                            <p class="text-xl font-black text-[#050B1A] italic tracking-tighter">৳{{ number_format($booking->car->owner->earnings()->sum('amount'), 0) }}</p>
                        </div>
                        <div class="p-6 bg-gray-50/50 border-2 border-white rounded-3xl shadow-sm">
                            <p class="text-[9px] text-gray-400 font-black uppercase mb-1 italic tracking-widest">Host Sentiment</p>
                            <p class="text-xl font-black text-[#050B1A] italic tracking-widest">0.99 SIGNAL</p>
                        </div>
                    </div>
                </div>

                <!-- Registered Platform Asset (Car) -->
                <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] lg:col-span-2 relative overflow-hidden group">
                     <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                        <h3 class="text-2xl font-black text-[#050B1A] flex items-center gap-4 uppercase italic tracking-tighter">
                            <span class="w-5 h-5 bg-[#050B1A] rounded-md text-white flex items-center justify-center text-[10px]">A</span>
                            Asset Briefing
                        </h3>
                        <a href="{{ route('cars.show', $booking->car) }}" class="px-6 py-2 border-2 border-gray-100 bg-gray-50 text-[10px] font-black text-indigo-500 uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all rounded-xl italic leading-none">View Platform Artifact →</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="md:col-span-1">
                            <div class="aspect-video rounded-[2.5rem] overflow-hidden border-4 border-gray-50 shadow-2xl bg-gray-100">
                                 @if($booking->car->images->count() > 0)
                                    <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="mt-4 grid grid-cols-3 gap-3">
                                @foreach($booking->car->images->slice(1, 3) as $img)
                                    <div class="aspect-square rounded-2xl overflow-hidden border-2 border-gray-50 group-hover:border-indigo-500/30 transition-all shadow-sm">
                                        <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mb-10">
                                <div class="p-6 bg-gray-50/50 border-2 border-white rounded-[1.8rem] shadow-sm">
                                    <p class="text-[8px] text-gray-400 font-black uppercase mb-2 italic tracking-widest">Brand/Model</p>
                                    <p class="text-[11px] font-black text-[#050B1A] uppercase italic leading-none tracking-tight">{{ $booking->car->brand }} {{ $booking->car->model }}</p>
                                </div>
                                <div class="p-6 bg-gray-50/50 border-2 border-white rounded-[1.8rem] shadow-sm">
                                    <p class="text-[8px] text-gray-400 font-black uppercase mb-2 italic tracking-widest">License Plate</p>
                                    <p class="text-[11px] font-black text-emerald-600 uppercase italic leading-none">{{ $booking->car->license_plate }}</p>
                                </div>
                                <div class="p-6 bg-gray-50/50 border-2 border-white rounded-[1.8rem] shadow-sm">
                                    <p class="text-[8px] text-gray-400 font-black uppercase mb-2 italic tracking-widest">Gear System</p>
                                    <p class="text-[11px] font-black text-[#050B1A] uppercase italic leading-none tracking-tight">{{ $booking->car->transmission }}</p>
                                </div>
                                <div class="p-6 bg-gray-50/50 border-2 border-white rounded-[1.8rem] shadow-sm">
                                    <p class="text-[8px] text-gray-400 font-black uppercase mb-2 italic tracking-widest">Deployment</p>
                                    <p class="text-[11px] font-black text-[#050B1A] uppercase italic leading-none tracking-tight">{{ $booking->car->location }}</p>
                                </div>
                            </div>
                            <div class="bg-indigo-50/50 border-2 border-white p-8 rounded-[2.5rem] shadow-sm prose prose-sm max-w-none">
                                <h4 class="text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-4 italic flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Institutional Inspection Override
                                </h4>
                                <p class="text-[11px] text-gray-600 leading-relaxed italic font-bold">"Technical parameters verified on registration epoch. Asset exhibits standard performance metrics for its class. Insurance coverage active through platform institutional provider. Asset integrity confirmed by Host Authority."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Command Protocol (Lifecycle Manifest) -->
                <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] lg:col-span-2">
                    <h3 class="text-2xl font-black text-[#050B1A] mb-12 flex items-center gap-4 uppercase italic tracking-tighter">
                        <span class="w-5 h-5 bg-orange-500 rounded-md text-white flex items-center justify-center text-[10px]">P</span>
                        Command Protocol
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <div class="md:col-span-1 space-y-6">
                            <div class="p-8 bg-[#050B1A] rounded-[2.5rem] text-center shadow-2xl shadow-[#050B1A]/20">
                                <p class="text-[10px] text-gray-400 font-black uppercase mb-3 italic tracking-widest">Final Yield (৳)</p>
                                <p class="text-3xl font-black text-white italic tracking-tighter leading-none">৳{{ number_format($booking->total_price, 0) }}</p>
                            </div>
                            <div class="p-8 bg-gray-50 border-2 border-white rounded-[2.5rem] shadow-sm">
                                <p class="text-[10px] text-gray-400 font-black uppercase mb-4 italic tracking-widest">Target Window</p>
                                <div class="space-y-4">
                                    <div class="flex flex-col">
                                        <span class="text-[8px] text-gray-400 font-black uppercase italic tracking-widest mb-1">Mission Start:</span>
                                        <span class="text-[11px] text-[#050B1A] font-black uppercase italic leading-none tracking-tight">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[8px] text-gray-400 font-black uppercase italic tracking-widest mb-1">Mission End:</span>
                                        <span class="text-[11px] text-[#050B1A] font-black uppercase italic leading-none tracking-tight">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-3 space-y-12">
                            {{-- Asset Integrity Mediation Hub --}}
                            @if($booking->damageReports->count() > 0)
                            <div class="bg-red-50/50 border-4 border-white p-10 rounded-[3.5rem] shadow-xl shadow-red-500/5">
                                <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.4em] mb-10 flex items-center gap-4 italic">
                                    <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse shadow-[0_0_15px_rgba(239,68,68,0.5)]"></span>
                                    Security Breach Mediation
                                </h4>
                                
                                <div class="space-y-8">
                                    @foreach($booking->damageReports as $report)
                                    <div class="p-8 bg-white border-2 border-gray-50 rounded-[2.5rem] shadow-sm group">
                                         <div class="flex flex-col md:flex-row gap-8">
                                            <div class="flex-1">
                                                <div class="flex justify-between items-start mb-6">
                                                    <span class="px-4 py-2 bg-gray-50 rounded-xl text-[9px] font-black text-gray-400 uppercase tracking-widest border-2 border-white italic">Artifact #BR-{{ $report->id }}</span>
                                                    <span class="px-4 py-2 {{ $report->status === 'disputed' ? 'bg-red-500 text-white shadow-lg shadow-red-500/20 animate-pulse' : 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/10' }} rounded-xl text-[9px] font-black uppercase tracking-widest italic border-2 border-white">{{ $report->status }}</span>
                                                </div>
                                                <p class="text-[11px] text-[#050B1A] italic mb-6 font-bold leading-relaxed">"{{ $report->description }}"</p>
                                                @if($report->status === 'disputed')
                                                    <div class="p-6 bg-red-50 border-2 border-white rounded-[2rem] shadow-inner">
                                                        <span class="text-[8px] text-red-600 font-black uppercase mb-2 block italic tracking-widest">Operator Testimony artifact</span>
                                                        <p class="text-[10px] text-red-800 font-bold leading-relaxed italic">"{{ $report->customer_notes ?? 'No testimony provided.' }}"</p>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            @if($report->status === 'disputed')
                                            <div class="w-full md:w-72">
                                                <form action="{{ route('admin.damage-reports.resolve', $report) }}" method="POST" class="space-y-5">
                                                    @csrf @method('PUT')
                                                    <div class="space-y-2">
                                                        <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Verdict Amount (৳)</label>
                                                        <input type="number" name="resolution_cost" required class="w-full bg-gray-50 border-2 border-white rounded-2xl p-4 text-center text-[#050B1A] text-sm font-black focus:ring-8 focus:ring-red-500/5 focus:border-red-500 outline-none transition-all italic shadow-inner" placeholder="0.00">
                                                    </div>
                                                    <div class="space-y-2">
                                                        <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Official Decree</label>
                                                        <textarea name="admin_notes" required rows="2" class="w-full bg-gray-50 border-2 border-white rounded-2xl p-5 text-[11px] text-gray-600 font-bold focus:ring-8 focus:ring-red-500/5 focus:border-red-500 outline-none transition-all italic leading-relaxed shadow-inner" placeholder="Enter resolution intelligence..."></textarea>
                                                    </div>
                                                    <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-red-500/20 italic active:scale-95 leading-none">Issue Resolution</button>
                                                </form>
                                            </div>
                                            @elseif($report->status === 'resolved')
                                            <div class="w-full md:w-72 p-8 bg-indigo-50/50 border-2 border-white rounded-[2.5rem] text-center shadow-inner">
                                                <div class="text-[9px] text-indigo-500 font-black uppercase mb-2 italic tracking-widest">Administrative Verdict</div>
                                                <div class="text-3xl font-black text-[#050B1A] mb-4 italic tracking-tighter leading-none">৳{{ number_format($report->resolution_cost) }}</div>
                                                <div class="text-[10px] text-gray-500 font-bold italic leading-relaxed">"{{ $report->admin_notes }}"</div>
                                            </div>
                                            @endif
                                         </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="bg-gray-50 border-2 border-white p-10 rounded-[3.5rem] shadow-sm">
                                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-8 italic">Institutional Authorization Overrides</h4>
                                <div class="flex flex-wrap gap-4">
                                     @if(!in_array($booking->status, ['completed', 'cancelled', 'rejected']))
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-10 py-4 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-emerald-500/20 italic active:scale-95 leading-none">Force Approve</button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-600/20 italic active:scale-95 leading-none">Mark Completed</button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="px-10 py-4 bg-white border-2 border-red-100 hover:bg-red-600 hover:border-red-600 hover:text-white text-red-600 text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all italic active:scale-95 leading-none shadow-sm">Cancel Booking</button>
                                        </form>
                                     @else
                                        <div class="flex items-center gap-6 text-gray-400 italic text-[11px] font-black uppercase tracking-[0.3em] py-4">
                                            <div class="w-12 h-12 bg-white rounded-2xl border-2 border-gray-100 flex items-center justify-center shadow-sm">
                                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                            Command Override Locked<br><span class="text-[8px] tracking-widest font-bold">Target lifecycle state reached</span>
                                        </div>
                                     @endif
                                </div>
                                <div class="mt-12 pt-10 border-t-2 border-white flex flex-col md:flex-row items-center justify-between gap-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 border-2 border-white flex items-center justify-center text-emerald-500 shadow-sm">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-[9px] text-gray-400 font-black uppercase italic tracking-widest mb-1">Payment Registry State</p>
                                            <p class="text-[13px] font-black text-[#050B1A] uppercase italic leading-none">{{ strtoupper($booking->payment_status) }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center md:text-right">
                                         <p class="text-[9px] text-gray-400 font-black uppercase italic tracking-widest mb-1">Operational Request Logged</p>
                                         <p class="text-[13px] font-black text-[#050B1A] uppercase italic leading-none">{{ $booking->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
