<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Booking Command Center') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Audit Trail #B-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="flex gap-3">
                <span class="px-4 py-2 bg-gray-900 border border-white/10 rounded-xl text-[10px] font-black uppercase tracking-widest text-indigo-400">
                    {{ ucfirst($booking->status) }}
                </span>
                 <span class="px-4 py-2 bg-gray-900 border border-white/10 rounded-xl text-[10px] font-black uppercase tracking-widest text-emerald-400">
                    {{ $booking->payment_status === 'paid' ? 'Settled' : 'Payment Pend.' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Quad 1: The Renter (Customer) -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                        <span class="w-1 h-6 bg-indigo-500 rounded-full"></span>
                        Customer Identity
                    </h3>
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-20 h-20 rounded-3xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-3xl font-black text-indigo-400 shadow-xl overflow-hidden">
                            @if($booking->customer->profile_photo)
                                <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($booking->customer->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <h4 class="text-2xl font-black text-white">{{ $booking->customer->name }}</h4>
                            <p class="text-gray-500 font-bold text-sm">{{ $booking->customer->email }}</p>
                            <div class="flex gap-2 mt-2">
                                @if($booking->customer->is_verified)
                                    <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest">Identity Verified</span>
                                @else
                                    <span class="px-2 py-0.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest">Unverified</span>
                                @endif
                                <span class="px-2 py-0.5 bg-white/5 text-gray-500 border border-white/10 rounded-lg text-[8px] font-black uppercase tracking-widest">User #{{ $booking->customer->id }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                            <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Total Trips taken</p>
                            <p class="text-white font-black">{{ $booking->customer->bookings()->count() }}</p>
                        </div>
                        <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                            <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Joined</p>
                            <p class="text-white font-black">{{ $booking->customer->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quad 2: The Host (Owner) -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                        <span class="w-1 h-6 bg-pink-500 rounded-full"></span>
                        Host Authority
                    </h3>
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-20 h-20 rounded-3xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-3xl font-black text-pink-400 shadow-xl overflow-hidden">
                             @if($booking->car->owner->profile_photo)
                                <img src="{{ Storage::url($booking->car->owner->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($booking->car->owner->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <h4 class="text-2xl font-black text-white">{{ $booking->car->owner->name }}</h4>
                            <p class="text-gray-500 font-bold text-sm">{{ $booking->car->owner->email }}</p>
                            <div class="flex gap-2 mt-2">
                                <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest">Professional Host</span>
                                <span class="px-2 py-0.5 bg-white/5 text-gray-500 border border-white/10 rounded-lg text-[8px] font-black uppercase tracking-widest">Fleet Size: {{ $booking->car->owner->cars()->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                            <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Lifetime Earnings</p>
                            <p class="text-white font-black">৳ {{ number_format($booking->car->owner->earnings()->sum('amount'), 0) }}</p>
                        </div>
                        <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                            <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Host Rating</p>
                            <p class="text-white font-black">4.9 / 5.0</p>
                        </div>
                    </div>
                </div>

                <!-- Quad 3: The Asset (Car) -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl lg:col-span-2">
                     <div class="flex justify-between items-start mb-8">
                        <h3 class="text-xl font-bold text-white flex items-center gap-3">
                            <span class="w-1 h-6 bg-emerald-500 rounded-full"></span>
                            Registered Platform Asset
                        </h3>
                        <a href="{{ route('cars.show', $booking->car) }}" class="text-[10px] font-black text-indigo-400 uppercase tracking-widest hover:text-white transition-colors">View Public Listing →</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-1">
                            <div class="aspect-video rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                                 @if($booking->car->images->count() > 0)
                                    <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="mt-4 grid grid-cols-3 gap-2">
                                @foreach($booking->car->images->slice(1, 3) as $img)
                                    <div class="aspect-square rounded-xl overflow-hidden border border-white/5">
                                        <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                                <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                                    <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Brand/Model</p>
                                    <p class="text-sm font-black text-white">{{ $booking->car->brand }} {{ $booking->car->model }}</p>
                                </div>
                                <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                                    <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">License Plate</p>
                                    <p class="text-sm font-black text-white">{{ $booking->car->license_plate }}</p>
                                </div>
                                <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                                    <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Gearbox</p>
                                    <p class="text-sm font-black text-white">{{ $booking->car->transmission }}</p>
                                </div>
                                <div class="p-4 bg-gray-950 border border-white/5 rounded-2xl">
                                    <p class="text-[9px] text-gray-600 font-bold uppercase mb-1">Deployment</p>
                                    <p class="text-sm font-black text-white">{{ $booking->car->location }}</p>
                                </div>
                            </div>
                            <div class="bg-emerald-500/5 border border-emerald-500/10 p-6 rounded-3xl">
                                <h4 class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-3">Admin Notes / Inspection</h4>
                                <p class="text-xs text-gray-500 leading-relaxed italic">Technical parameters verified on registration. Asset exhibits standard performance metrics for its class. Insurance coverage active through platform provider.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quad 4: The Transaction (Booking) -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl lg:col-span-2">
                    <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                        <span class="w-1 h-6 bg-orange-500 rounded-full"></span>
                        Command Protocol (Lifecycle)
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="md:col-span-1 space-y-4">
                            <div class="p-6 bg-gray-950 border border-white/5 rounded-3xl text-center">
                                <p class="text-[10px] text-gray-600 font-black uppercase mb-2">Total Revenue (৳)</p>
                                <p class="text-3xl font-black text-white">৳ {{ number_format($booking->total_price, 0) }}</p>
                            </div>
                            <div class="p-6 bg-gray-950 border border-white/5 rounded-3xl">
                                <p class="text-[10px] text-gray-600 font-black uppercase mb-3">Timeframe</p>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-gray-500">START:</span>
                                        <span class="text-white font-bold">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-gray-500">END:</span>
                                        <span class="text-white font-bold">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-3 space-y-8">
                            {{-- Asset Integrity Mediation Hub (IN-CONTEXT) --}}
                            @if($booking->damageReports->count() > 0)
                            <div class="bg-red-950/20 border-2 border-red-500/30 p-8 rounded-[2.5rem] shadow-[0_0_30px_rgba(239,68,68,0.1)]">
                                <h4 class="text-[10px] font-black text-red-400 uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span>
                                    Security Breach Mediation
                                </h4>
                                
                                <div class="space-y-6">
                                    @foreach($booking->damageReports as $report)
                                    <div class="p-6 bg-gray-950 border border-white/5 rounded-3xl group">
                                         <div class="flex flex-col md:flex-row gap-6">
                                            <div class="flex-1">
                                                <div class="flex justify-between items-start mb-4">
                                                    <span class="px-3 py-1 bg-white/5 rounded-lg text-[8px] font-black text-gray-500 uppercase tracking-widest border border-white/5">#BR-{{ $report->id }}</span>
                                                    <span class="px-3 py-1 {{ $report->status === 'disputed' ? 'bg-red-500/10 text-red-500 animate-pulse' : 'bg-blue-500/10 text-blue-400' }} rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/5">{{ $report->status }}</span>
                                                </div>
                                                <p class="text-[10px] text-gray-400 italic mb-4">"{{ $report->description }}"</p>
                                                @if($report->status === 'disputed')
                                                    <div class="p-4 bg-red-500/5 rounded-2xl border border-red-500/10">
                                                        <span class="text-[8px] text-red-400 font-black uppercase mb-1 block italic">Operator Testimony</span>
                                                        <p class="text-[10px] text-red-300 font-bold">"{{ $report->customer_notes ?? 'No testimony provided.' }}"</p>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            @if($report->status === 'disputed')
                                            <div class="w-full md:w-64">
                                                <form action="{{ route('admin.damage-reports.resolve', $report) }}" method="POST" class="space-y-4">
                                                    @csrf @method('PUT')
                                                    <input type="number" name="resolution_cost" required class="w-full bg-gray-950 border-white/5 rounded-xl text-center text-white text-xs font-black shadow-inner" placeholder="Verdict Amount (৳)">
                                                    <textarea name="admin_notes" required rows="2" class="w-full bg-gray-950 border-white/5 rounded-xl text-[9px] text-gray-500" placeholder="Official Decree..."></textarea>
                                                    <button type="submit" class="w-full py-2.5 bg-red-600 hover:bg-red-500 text-white text-[8px] font-black uppercase tracking-widest rounded-xl transition-all shadow-lg">Issue Resolution</button>
                                                </form>
                                            </div>
                                            @elseif($report->status === 'resolved')
                                            <div class="w-full md:w-64 p-4 bg-blue-500/10 border border-blue-500/20 rounded-2xl text-center">
                                                <div class="text-[8px] text-blue-400 font-black uppercase mb-1">Administrative Verdict</div>
                                                <div class="text-lg font-black text-white mb-2">৳ {{ number_format($report->resolution_cost) }}</div>
                                                <p class="text-[9px] text-gray-500 italic leading-tight">"{{ $report->admin_notes }}"</p>
                                            </div>
                                            @endif
                                         </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="bg-gray-950/50 border border-white/10 p-8 rounded-[2.5rem]">
                                <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6">Authorization Overrides</h4>
                                <div class="flex flex-wrap gap-4">
                                     @if(!in_array($booking->status, ['completed', 'cancelled', 'rejected']))
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-emerald-600/20">Force Approve</button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-600/20">Mark Completed</button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="px-8 py-4 bg-red-600/10 border border-red-600/30 hover:bg-red-600 hover:text-white text-red-500 text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all">Cancel Booking</button>
                                        </form>
                                     @else
                                        <div class="flex items-center gap-4 text-gray-600 italic text-[10px] font-black uppercase tracking-[0.2em] py-4">
                                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            Command Override Locked (Target status reached)
                                        </div>
                                     @endif
                                </div>
                                <div class="mt-8 pt-8 border-t border-white/5 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 font-bold uppercase">Payment Status</p>
                                            <p class="text-sm font-black text-white">{{ strtoupper($booking->payment_status) }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                         <p class="text-[10px] text-gray-500 font-bold uppercase">Booking Requested</p>
                                         <p class="text-sm font-black text-white">{{ $booking->created_at->format('M d, Y H:i') }}</p>
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
