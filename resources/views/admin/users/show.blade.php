<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-8 text-center md:text-left">
                <div class="w-24 h-24 rounded-[2.5rem] bg-[#050B1A] border-4 border-white shadow-2xl flex items-center justify-center text-4xl font-black text-white italic overflow-hidden shrink-0">
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <h2 class="font-black text-3xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                        {{ $user->name }}
                    </h2>
                    <div class="flex items-center justify-center md:justify-start gap-4 mt-3">
                        <span class="hidden md:block w-12 h-px bg-[#050B1A]/20"></span>
                        <p class="text-[9px] md:text-[10px] text-gray-500 font-black uppercase tracking-[0.4em] italic leading-none">
                            Identity Registry #USR-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 w-full md:w-auto">
                <a href="{{ route('admin.users.edit', $user) }}" class="flex-1 md:flex-none text-center px-8 py-4 bg-white border-2 border-gray-100 text-[#050B1A] rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-gray-200/50 hover:bg-[#050B1A] hover:text-white hover:border-[#050B1A] transition-all italic active:scale-95 leading-none">Edit Identity</a>
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="flex-1 md:flex-none">
                    @csrf @method('PUT')
                    <input type="hidden" name="is_blocked" value="{{ $user->is_blocked ? '0' : '1' }}">
                    <button type="submit" class="w-full px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all italic active:scale-95 shadow-xl leading-none {{ $user->is_blocked ? 'bg-emerald-500 text-white shadow-emerald-500/20 hover:bg-emerald-600' : 'bg-red-600 text-white shadow-red-600/20 hover:bg-red-700' }}">
                        {{ $user->is_blocked ? 'Authorize' : 'Restrict' }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Profile & Core Intelligence (Sidebar) -->
                <div class="lg:col-span-1 space-y-10">
                    <div class="bg-white border-2 border-gray-100 p-8 md:p-10 rounded-[3.5rem] shadow-[0_45px_1000px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50 transition-all group-hover:scale-150"></div>
                        <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] mb-12 italic flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                            Core Intelligence
                        </h4>

                        <div class="space-y-8">
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Institutional Email</p>
                                <p class="text-sm font-black text-[#050B1A] uppercase tracking-tight italic break-all">{{ $user->email }}</p>
                            </div>
                            <div class="flex flex-wrap gap-4">
                                <div class="flex-1 min-w-[120px]">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Access Protocol</p>
                                    <span class="inline-block px-4 py-2 bg-indigo-50 border-2 border-indigo-100 text-indigo-600 text-[9px] font-black uppercase tracking-widest rounded-xl italic">{{ $user->role }}</span>
                                </div>
                                <div class="flex-1 min-w-[120px]">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Integrity</p>
                                    <span class="inline-block px-4 py-2 {{ $user->is_blocked ? 'bg-red-50 text-red-600 border-red-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100' }} border-2 text-[9px] font-black uppercase tracking-widest rounded-xl italic capitalize">
                                        {{ $user->is_blocked ? 'Blocked' : 'Nominal' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Operational Epoch</p>
                                <p class="text-xs font-black text-[#050B1A] uppercase italic tracking-tighter">{{ $user->created_at->format('M d, Y') }} <span class="text-gray-300 mx-2">|</span> <span class="text-gray-400 font-bold text-[10px]">{{ $user->created_at->diffForHumans() }}</span></p>
                            </div>
                        </div>

                        <div class="mt-12 pt-12 border-t border-gray-50 gap-4 grid grid-cols-2 text-center">
                            <div class="bg-gray-50/50 p-6 rounded-[2rem] border-2 border-white shadow-sm overflow-hidden relative group/q h-32 flex flex-col justify-center">
                                <div class="absolute inset-0 bg-indigo-500 opacity-0 group-hover/q:opacity-5 transition-opacity"></div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 italic leading-none">Fleet</p>
                                <p class="text-3xl font-black text-[#050B1A] italic tracking-tighter leading-none">{{ $cars->total() }}</p>
                            </div>
                            <div class="bg-gray-50/50 p-6 rounded-[2rem] border-2 border-white shadow-sm overflow-hidden relative group/q h-32 flex flex-col justify-center">
                                <div class="absolute inset-0 bg-orange-500 opacity-0 group-hover/q:opacity-5 transition-opacity"></div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 italic leading-none">Missions</p>
                                <p class="text-3xl font-black text-[#050B1A] italic tracking-tighter leading-none">{{ $bookings->total() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Terminal -->
                    <div class="bg-white border-2 border-gray-100 p-8 md:p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)]">
                        <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] mb-12 italic flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                            Audit Artifacts
                        </h4>
                        @if($user->verifications->count() > 0)
                            <div class="space-y-8">
                                @foreach($user->verifications as $v)
                                    <div class="p-6 bg-gray-50 border-2 border-white rounded-[2.5rem] shadow-sm group">
                                        <div class="flex justify-between items-center mb-6">
                                            <p class="text-[9px] font-black text-[#050B1A] uppercase tracking-widest italic leading-none">NID Briefing</p>
                                            <span class="px-3 py-1.5 bg-white rounded-xl {{ $v->status === 'approved' ? 'text-emerald-500 border-emerald-100' : 'text-orange-500 border-orange-100' }} text-[8px] font-black uppercase tracking-widest italic border-2">{{ $v->status }}</span>
                                        </div>
                                        <div class="aspect-[1.586/1] rounded-[1.8rem] bg-gray-200 border-4 border-white overflow-hidden shadow-xl mb-6 group-hover:scale-[1.02] transition-transform duration-500 cursor-pointer" onclick="window.location='{{ route('admin.verifications.show', $v) }}'">
                                            @if($v->document_path)
                                                <img src="{{ Storage::url($v->document_path) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 font-black italic tracking-widest uppercase bg-gray-50">Null Signal</div>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-3 text-[8px] text-gray-400 font-black uppercase italic tracking-widest leading-none">
                                            <span class="w-1.5 h-1.5 bg-gray-200 rounded-full"></span>
                                            ID: #VAL-{{ str_pad($v->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-24 text-center text-gray-200 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">No Artifacts Captured</div>
                        @endif
                    </div>
                </div>

                <!-- Functional Ledger System (Main Content) -->
                <div class="lg:col-span-2 space-y-12">

                    <!-- Fleet Registry (Host Specific) -->
                    @if($user->role === 'owner' || $cars->total() > 0)
                    <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100_rgba(0,0,0,0.02)] overflow-hidden transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                        <div class="p-8 md:p-12 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-8">
                             <div class="flex items-center gap-6">
                                 <div class="w-16 h-16 bg-[#050B1A] rounded-[1.8rem] flex items-center justify-center text-white italic font-black text-2xl shadow-2xl">FL</div>
                                 <div>
                                     <h4 class="text-xl md:text-2xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Fleet Ledger</h4>
                                     <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 italic">{{ $cars->total() }} Assets Active in Audit</p>
                                 </div>
                             </div>
                            <span class="hidden md:block px-6 py-2.5 bg-gray-50 rounded-2xl text-[10px] font-black text-gray-500 uppercase tracking-widest italic border-2 border-white shadow-sm">Fleet Oversight Terminal</span>
                        </div>

                        <!-- Desktop Terminal -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic">
                                        <th class="px-12 py-6">Asset Briefing</th>
                                        <th class="px-12 py-6 text-center">Operational Rate</th>
                                        <th class="px-12 py-6 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($cars as $car)
                                        <tr class="group hover:bg-gray-50/50 transition-all cursor-pointer" onclick="window.location='{{ route('admin.cars.show', $car) }}'">
                                            <td class="px-12 py-8">
                                                <div class="flex items-center gap-6">
                                                    <div class="w-24 h-16 bg-gray-100 rounded-2xl overflow-hidden border-2 border-white shadow-lg shrink-0 group-hover:scale-105 transition-transform">
                                                        @if($car->images->count() > 0)
                                                            <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="text-[14px] font-black text-[#050B1A] uppercase italic tracking-tight group-hover:text-indigo-600 transition-colors leading-none mb-2">{{ $car->brand }} {{ $car->model }}</div>
                                                        <div class="text-[10px] text-gray-400 font-black tracking-widest uppercase italic leading-none opacity-60">{{ $car->location }} Registry</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-12 py-8 text-center">
                                                <div class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none mb-1">৳{{ number_format($car->price_per_day) }}</div>
                                                <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Daily Mission Yield</div>
                                            </td>
                                            <td class="px-12 py-8 text-right">
                                                <span class="px-6 py-2.5 bg-white border-2 border-gray-100 text-gray-500 text-[9px] font-black uppercase tracking-widest rounded-xl italic group-hover:bg-[#050B1A] group-hover:text-white group-hover:border-[#050B1A] transition-all shadow-sm">{{ $car->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Tactical Manifest -->
                        <div class="block md:hidden p-6 space-y-6 bg-gray-50/50">
                            @foreach($cars as $car)
                                <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden active:scale-[0.98] transition-all" onclick="window.location='{{ route('admin.cars.show', $car) }}'">
                                    <div class="flex items-center justify-between">
                                        <div class="text-[10px] text-indigo-500 font-black uppercase tracking-widest italic leading-none">ASSET #FL-{{ str_pad($car->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        <span class="px-3 py-1 bg-white border-2 border-gray-50 rounded-lg text-[8px] font-black uppercase tracking-widest italic">{{ $car->status }}</span>
                                    </div>
                                    <div class="flex items-center gap-6">
                                        <div class="w-20 h-20 rounded-[1.8rem] bg-[#050B1A] border-4 border-white shadow-xl overflow-hidden shrink-0 flex items-center justify-center text-white italic font-black text-2xl">
                                            @if($car->images->count() > 0)
                                                <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-lg font-black text-[#050B1A] uppercase italic tracking-tighter leading-none mb-2 truncate">{{ $car->brand }} {{ $car->model }}</div>
                                            <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none opacity-60">{{ $car->location }} Registry</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                        <div>
                                            <div class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($car->price_per_day) }}</div>
                                            <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic mt-1 leading-none">Daily Mission Yield</div>
                                        </div>
                                        <div class="w-12 h-12 bg-[#050B1A] text-white rounded-[1.2rem] flex items-center justify-center shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Fleet Registry Pagination -->
                        @if($cars->hasPages())
                            <div class="px-8 py-10 md:px-12 bg-gray-50/20 border-t border-gray-50 overflow-x-auto">
                                {{ $cars->appends(request()->except('cars_page'))->links() }}
                            </div>
                        @endif
                    </div>
                    @endif

                    <!-- Fleet Mission Ledger (Received) -->
                    @if($user->role === 'owner' || $receivedBookings->total() > 0)
                        <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100_rgba(0,0,0,0.02)] overflow-hidden transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                            <div class="p-8 md:p-12 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-8">
                                <div class="flex items-center gap-6">
                                    <div class="w-16 h-16 bg-indigo-600 rounded-[1.8rem] flex items-center justify-center text-white italic font-black text-2xl shadow-2xl">ML</div>
                                    <div>
                                        <h4 class="text-xl md:text-2xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Mission Ledger</h4>
                                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 italic">{{ $receivedBookings->total() }} Incoming Directives Audited</p>
                                    </div>
                                </div>
                                <span class="hidden md:block px-6 py-2.5 bg-gray-50 rounded-2xl text-[10px] font-black text-gray-500 uppercase tracking-widest italic border-2 border-white shadow-sm">Host Operation History</span>
                            </div>

                            @if($receivedBookings->total() > 0)
                                <!-- Desktop Terminal -->
                                <div class="hidden md:block overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic">
                                                <th class="px-10 py-6">Mission Token</th>
                                                <th class="px-10 py-6">Operation Artifacts</th>
                                                <th class="px-10 py-6">Mission Yield</th>
                                                <th class="px-10 py-6 text-right">Audit Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-50">
                                            @foreach($receivedBookings as $b)
                                                <tr class="group hover:bg-gray-50/50 transition-all cursor-pointer" onclick="window.location='{{ route('admin.bookings.show', $b) }}'">
                                                    <td class="px-10 py-8">
                                                        <div>
                                                            <div class="text-[12px] font-black text-[#050B1A] uppercase italic tracking-tight group-hover:text-indigo-600 transition-colors leading-none mb-2">#FLEET-{{ strtoupper(substr($b->id, 0, 8)) }}</div>
                                                            <div class="text-[10px] text-gray-400 font-black tracking-widest uppercase italic leading-none opacity-60">{{ $b->created_at->format('M d, Y') }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="px-10 py-8">
                                                        <div class="flex items-center gap-4 mb-2">
                                                            <div class="text-[12px] font-black text-[#050B1A] uppercase italic leading-none tracking-tight">{{ $b->car->brand }} {{ $b->car->model }}</div>
                                                            <span class="text-gray-300 text-[8px]">|</span>
                                                            <div class="text-[10px] font-bold text-gray-400 italic leading-none uppercase">{{ $b->customer->name }}</div>
                                                        </div>
                                                        <div class="text-[9px] text-[#050B1A] font-black uppercase tracking-widest italic opacity-60">
                                                            {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} → {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-10 py-8">
                                                        <div class="text-[15px] font-black text-[#050B1A] italic tracking-tighter leading-none mb-1">৳{{ number_format($b->total_price) }}</div>
                                                    </td>
                                                    <td class="px-10 py-8 text-right">
                                                        <span class="px-4 py-2 bg-indigo-50 border-2 border-white text-indigo-500 text-[9px] font-black uppercase tracking-widest rounded-xl italic group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">{{ $b->status }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile Tactical Manifest -->
                                <div class="block md:hidden p-6 space-y-6 bg-gray-50/50">
                                    @foreach($receivedBookings as $b)
                                        <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden active:scale-[0.98] transition-all" onclick="window.location='{{ route('admin.bookings.show', $b) }}'">
                                            <div class="flex items-center justify-between">
                                                <div class="text-[10px] text-indigo-500 font-black uppercase tracking-widest italic leading-none">TOKEN #FL-{{ strtoupper(substr($b->id, 0, 6)) }}</div>
                                                <span class="px-3 py-1 bg-white border-2 border-gray-50 rounded-lg text-[8px] font-black uppercase tracking-widest italic">{{ $b->status }}</span>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="text-base font-black text-[#050B1A] uppercase italic tracking-tighter leading-none truncate">{{ $b->car->brand }} {{ $b->car->model }}</div>
                                                <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none opacity-60">Operator: {{ $b->customer->name }}</div>
                                            </div>
                                            <div class="p-4 bg-gray-50 border-2 border-white rounded-2xl">
                                                <div class="text-[9px] text-[#050B1A] font-black uppercase tracking-widest italic leading-none text-center">
                                                    {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} <span class="text-gray-300 mx-2">→</span> {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between pt-4">
                                                <div>
                                                    <div class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($b->total_price) }}</div>
                                                    <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic mt-1 leading-none">Mission Yield</div>
                                                </div>
                                                <div class="w-12 h-12 bg-[#050B1A] text-white rounded-[1.2rem] flex items-center justify-center shadow-lg">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Mission Ledger Pagination -->
                                @if($receivedBookings->hasPages())
                                    <div class="px-8 py-10 md:px-12 bg-gray-50/20 border-t border-gray-50 overflow-x-auto">
                                        {{ $receivedBookings->appends(request()->except('received_bookings_page'))->links() }}
                                    </div>
                                @endif
                            @else
                                <div class="py-24 text-center text-gray-200 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">No Operation Activity Logged</div>
                            @endif
                        </div>
                    @endif

                    <!-- Deployment Registry (Personal Missions) -->
                    @if($user->role === 'customer' || $bookings->total() > 0)
                    <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100_rgba(0,0,0,0.02)] overflow-hidden transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                        <div class="p-8 md:p-12 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-8">
                             <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-orange-600 rounded-[1.8rem] flex items-center justify-center text-white italic font-black text-2xl shadow-2xl">DL</div>
                                <div>
                                    <h4 class="text-xl md:text-2xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Deployment Ledger</h4>
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 italic">{{ $bookings->total() }} Operational Missions Authorized</p>
                                </div>
                             </div>
                            <span class="hidden md:block px-6 py-2.5 bg-gray-50 rounded-2xl text-[10px] font-black text-gray-500 uppercase tracking-widest italic border-2 border-white shadow-sm">User Personal Missions</span>
                        </div>

                        @if($bookings->total() > 0)
                            <!-- Desktop Terminal -->
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic">
                                            <th class="px-10 py-6">Mission Artifact</th>
                                            <th class="px-10 py-6">Mission Temporal Data</th>
                                            <th class="px-10 py-6">Mission Logic (Price)</th>
                                            <th class="px-10 py-6 text-right">Audit Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($bookings as $b)
                                            <tr class="group hover:bg-gray-50/50 transition-all cursor-pointer" onclick="window.location='{{ route('admin.bookings.show', $b) }}'">
                                                <td class="px-10 py-8">
                                                    <div>
                                                        <div class="text-[12px] font-black text-[#050B1A] uppercase italic tracking-tight group-hover:text-orange-600 transition-colors leading-none mb-2">#PERSONAL-{{ strtoupper(substr($b->id, 0, 8)) }}</div>
                                                        <div class="text-[11px] font-black text-[#050B1A] uppercase italic leading-none tracking-tighter">{{ $b->car->brand }} {{ $b->car->model }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-10 py-8">
                                                    <div class="text-[10px] font-black text-[#050B1A] uppercase italic leading-none tracking-tight">
                                                        {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} → {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-[8px] text-gray-300 mt-2 uppercase tracking-widest font-black italic">Institutional Registry OK</div>
                                                </td>
                                                <td class="px-10 py-8">
                                                    <div class="text-[15px] font-black text-[#050B1A] italic tracking-tighter leading-none mb-1">৳{{ number_format($b->total_price) }}</div>
                                                    <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Deployment Yield</div>
                                                </td>
                                                <td class="px-10 py-8 text-right">
                                                    <span class="px-4 py-2 bg-orange-50 border-2 border-white text-orange-600 text-[9px] font-black uppercase tracking-widest rounded-xl italic group-hover:bg-orange-600 group-hover:text-white transition-all shadow-sm">{{ $b->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Tactical Manifest -->
                            <div class="block md:hidden p-6 space-y-6 bg-gray-50/50">
                                @foreach($bookings as $b)
                                    <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden active:scale-[0.98] transition-all" onclick="window.location='{{ route('admin.bookings.show', $b) }}'">
                                        <div class="flex items-center justify-between">
                                            <div class="text-[10px] text-orange-500 font-black uppercase tracking-widest italic leading-none">TOKEN #PR-{{ strtoupper(substr($b->id, 0, 6)) }}</div>
                                            <span class="px-3 py-1 bg-white border-2 border-gray-50 rounded-lg text-[8px] font-black uppercase tracking-widest italic">{{ $b->status }}</span>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="text-base font-black text-[#050B1A] uppercase italic tracking-tighter leading-none truncate">{{ $b->car->brand }} {{ $b->car->model }}</div>
                                            <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none opacity-60">Personal Deployment</div>
                                        </div>
                                        <div class="p-4 bg-gray-50 border-2 border-white rounded-2xl">
                                            <div class="text-[9px] text-[#050B1A] font-black uppercase tracking-widest italic leading-none text-center">
                                                {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} <span class="text-gray-300 mx-2">→</span> {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between pt-4">
                                            <div>
                                                <div class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($b->total_price) }}</div>
                                                <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic mt-1 leading-none">Deployment Price</div>
                                            </div>
                                            <div class="w-12 h-12 bg-[#050B1A] text-white rounded-[1.2rem] flex items-center justify-center shadow-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Deployment Registry Pagination -->
                            @if($bookings->hasPages())
                                <div class="px-8 py-10 md:px-12 bg-gray-50/20 border-t border-gray-50 overflow-x-auto">
                                    {{ $bookings->appends(request()->except('bookings_page'))->links() }}
                                </div>
                            @endif
                        @else
                             <div class="py-24 text-center text-gray-200 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">No Personal Deployment Data Captured</div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>