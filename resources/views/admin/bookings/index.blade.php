<x-app-layout>
    <x-slot name="header">
        <style>
            select.appearance-none {
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                appearance: none !important;
            }
            select.appearance-none::-ms-expand {
                display: none !important;
            }
        </style>
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div class="flex items-center gap-8">
                <div class="w-20 h-20 rounded-[2.2rem] bg-[#050B1A] border-4 border-white shadow-2xl flex items-center justify-center text-white italic font-black text-3xl shrink-0 group hover:rotate-6 transition-transform duration-500">
                    BL
                </div>
                <div>
                    <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                        Transaction <span class="text-orange-500">Oversight</span>
                    </h2>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="w-12 h-px bg-[#050B1A]/20"></span>
                        <p class="text-[9px] md:text-[10px] text-gray-500 font-black uppercase tracking-[0.4em] italic leading-none">
                            Global Lease Manifest Registry & Financial Audit
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="px-8 py-3.5 bg-white border-2 border-gray-100 rounded-2xl shadow-xl shadow-gray-200/50 flex flex-col items-end">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic mb-1">Active Ledger</span>
                    <span class="text-xs font-black text-[#050B1A] uppercase italic">{{ $bookings->total() }} Records Authenticated</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <!-- Hardened Search Manifest -->
            <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] flex flex-col lg:flex-row gap-8 items-center justify-between group">
                <div class="w-full lg:max-w-xl">
                    <x-search-bar :route="route('admin.bookings.index')" placeholder="PROTOCOL SCAN: SEARCH BY USER, CAR, OR ID..." />
                </div>
                <div class="flex flex-wrap justify-center gap-4 w-full lg:w-auto">
                    <div class="relative group/select w-full md:w-auto">
                        <select onchange="window.location.href = this.value" class="appearance-none bg-gray-50 border-2 border-gray-100 rounded-2xl px-8 py-4 text-[10px] font-black uppercase tracking-widest text-[#050B1A] focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic cursor-pointer pr-14 w-full">
                            <option value="{{ route('admin.bookings.index') }}">Status: All States</option>
                            <option value="{{ route('admin.bookings.index', ['status' => 'pending']) }}" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Audit</option>
                            <option value="{{ route('admin.bookings.index', ['status' => 'approved']) }}" {{ request('status') === 'approved' ? 'selected' : '' }}>Institutional Auth</option>
                            <option value="{{ route('admin.bookings.index', ['status' => 'completed']) }}" {{ request('status') === 'completed' ? 'selected' : '' }}>Succeeded Cycle</option>
                            <option value="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Voided Protocols</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 group-hover/select:text-indigo-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Monolith -->
            <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] overflow-hidden transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                
                <!-- Desktop Terminal (Visible on MD+) -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic">
                                <th class="px-10 py-8">Lease Manifest</th>
                                <th class="px-10 py-8">Stakeholders</th>
                                <th class="px-10 py-8 text-center">Protocol Yield</th>
                                <th class="px-10 py-8">Process Cycle</th>
                                <th class="px-10 py-8 text-right pr-12">Audit Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($bookings as $booking)
                                <tr class="group hover:bg-gray-50/50 transition-all cursor-pointer" onclick="if(!event.target.closest('button') && !event.target.closest('a')) window.location='{{ route('admin.bookings.show', $booking) }}'">
                                    <td class="px-10 py-8 whitespace-nowrap">
                                        <div class="flex items-center gap-6">
                                            <div class="w-20 h-14 rounded-2xl overflow-hidden border-2 border-white shadow-xl bg-gray-100 grow-0 group-hover:scale-105 transition-transform duration-500">
                                                @if($booking->car->images->count() > 0)
                                                    <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover transition-all">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-[#050B1A] text-white text-[8px] font-black">NULL</div>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <div class="text-[9px] text-indigo-500 font-black uppercase tracking-widest mb-1 italic leading-none">
                                                    TOKEN #ID-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <div class="font-black text-[13px] text-[#050B1A] uppercase italic tracking-tight group-hover:text-indigo-600 transition-colors leading-none truncate">
                                                    {{ $booking->car->brand }} {{ $booking->car->model }}
                                                </div>
                                                <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-1.5 italic leading-none opacity-60">
                                                    {{ $booking->car->location }} Registry
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 whitespace-nowrap">
                                        <div class="space-y-4" onclick="event.stopPropagation()">
                                            <div class="flex items-center gap-4 group/h">
                                                <div class="w-8 h-8 rounded-xl bg-[#050B1A] border-2 border-white flex items-center justify-center text-[10px] font-black text-white italic shadow-lg group-hover/h:scale-110 transition-transform">H</div>
                                                <div>
                                                    <a href="{{ route('profiles.show', $booking->car->owner) }}" class="text-[11px] font-black text-[#050B1A] uppercase italic tracking-tight hover:text-indigo-600 transition-colors leading-none block">{{ $booking->car->owner->name }}</a>
                                                    <span class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic mt-1 leading-none">Fleet Host</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-4 group/c">
                                                <div class="w-8 h-8 rounded-xl bg-gray-50 border-2 border-white flex items-center justify-center text-[10px] font-black text-indigo-500 italic shadow-lg group-hover/c:scale-110 transition-transform">C</div>
                                                <div>
                                                    <a href="{{ route('profiles.show', $booking->customer) }}" class="text-[11px] font-black text-[#050B1A] uppercase italic tracking-tight hover:text-indigo-600 transition-colors leading-none block">{{ $booking->customer->name }}</a>
                                                    <span class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic mt-1 leading-none">Mission Operator</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 text-center whitespace-nowrap">
                                        <div class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none mb-2">৳ {{ number_format($booking->total_price) }}</div>
                                        <div class="flex items-center justify-center gap-2">
                                            @if($booking->payment_status === 'paid')
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                                                <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest italic leading-none">Liquidity Settled</span>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-orange-500/30"></span>
                                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Awaiting Settlement</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 whitespace-nowrap">
                                        <div class="mb-4">
                                            @if($booking->status === 'pending')
                                                <span class="px-4 py-2 bg-orange-50 border-2 border-orange-100 text-orange-500 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">
                                                    Pending Audit
                                                </span>
                                            @elseif($booking->status === 'approved')
                                                <span class="px-4 py-2 bg-indigo-50 border-2 border-indigo-100 text-indigo-500 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">
                                                    Institutional Auth
                                                </span>
                                            @elseif($booking->status === 'completed')
                                                <span class="px-4 py-2 bg-emerald-50 border-2 border-emerald-100 text-emerald-500 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">
                                                    Succeeded Cycle
                                                </span>
                                            @elseif($booking->status === 'cancelled')
                                                <span class="px-4 py-2 bg-red-50 border-2 border-red-100 text-red-500 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">
                                                    Voided Protocol
                                                </span>
                                            @elseif($booking->status === 'rejected')
                                                <span class="px-4 py-2 bg-rose-50 border-2 border-rose-100 text-rose-600 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">
                                                    Auth Refused
                                                </span>
                                            @else
                                                <span class="px-4 py-2 bg-gray-50 border-2 border-gray-100 text-gray-400 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">
                                                    {{ strtoupper($booking->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-[9px] text-[#050B1A] font-black uppercase italic tracking-[0.2em] leading-none">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} <span class="text-gray-300 mx-1">→</span> {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 text-right pr-12 whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-6">
                                            <div class="flex justify-end gap-3" onclick="event.stopPropagation()">
                                                <!-- High-Fidelity View Portal -->
                                                <a href="{{ route('admin.bookings.show', $booking) }}" class="w-11 h-11 bg-white border-2 border-gray-100 hover:bg-[#050B1A] hover:text-white text-[#050B1A] rounded-xl transition-all shadow-xl shadow-gray-200/50 flex items-center justify-center group/btn active:scale-95" title="Expand Audit Details">
                                                    <svg class="w-5 h-5 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                                
                                                <!-- Tactical Purge Operation -->
                                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('CRITICAL ACTION: ARE YOU SURE YOU WANT TO PURGE THIS TRANSACTION FROM THE REGISTRY? THIS ACTION IS IRREVERSIBLE.')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="w-11 h-11 bg-white border-2 border-gray-100 hover:bg-red-600 hover:text-white text-red-500 rounded-xl transition-all shadow-xl shadow-gray-200/50 flex items-center justify-center group/btn active:scale-95" title="Invoke Global Purge">
                                                        <svg class="w-5 h-5 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-4 group-hover:translate-x-0 hidden lg:block">
                                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Tactical Card Manifest (Visible on < MD) -->
                <div class="block md:hidden p-6 space-y-6 bg-gray-50/50">
                    @foreach ($bookings as $booking)
                        <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-8 relative overflow-hidden group active:scale-[0.98] transition-all" onclick="if(!event.target.closest('button') && !event.target.closest('form')) window.location='{{ route('admin.bookings.show', $booking) }}'">
                            <div class="flex items-center justify-between">
                                <div class="space-y-2">
                                    <div class="text-[10px] text-indigo-500 font-black uppercase tracking-widest italic leading-none">TOKEN #ID-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    <div class="flex">
                                        @if($booking->status === 'approved')
                                            <span class="px-3 py-1 bg-indigo-50 border-2 border-indigo-100 text-indigo-500 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Auth</span>
                                        @elseif($booking->status === 'completed')
                                            <span class="px-3 py-1 bg-emerald-50 border-2 border-emerald-100 text-emerald-500 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Success</span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="px-3 py-1 bg-red-50 border-2 border-red-100 text-red-500 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Voided</span>
                                        @elseif($booking->status === 'rejected')
                                            <span class="px-3 py-1 bg-rose-50 border-2 border-rose-100 text-rose-600 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Refused</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-[9px] text-[#050B1A] font-black uppercase italic tracking-widest text-right leading-tight">
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }}<br>
                                    <span class="text-gray-300">to</span><br>
                                    {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-[1.5rem] bg-[#050B1A] border-4 border-white shadow-xl overflow-hidden shrink-0 italic flex items-center justify-center text-white font-black text-xl">
                                    @if($booking->car->images->count() > 0)
                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        BL
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="text-base font-black text-[#050B1A] uppercase italic tracking-tighter leading-none mb-2 truncate">{{ $booking->car->brand }} {{ $booking->car->model }}</div>
                                    <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none opacity-60">{{ $booking->car->location }} Registry</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 border-2 border-white rounded-[1.5rem] shadow-inner text-center">
                                    <p class="text-[7px] font-black text-gray-400 uppercase tracking-widest mb-1">Host Entity</p>
                                    <p class="text-[9px] font-black text-[#050B1A] uppercase italic truncate">{{ $booking->car->owner->name }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 border-2 border-white rounded-[1.5rem] shadow-inner text-center">
                                    <p class="text-[7px] font-black text-gray-400 uppercase tracking-widest mb-1">Operator</p>
                                    <p class="text-[9px] font-black text-[#050B1A] uppercase italic truncate">{{ $booking->customer->name }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                <div>
                                    <div class="text-lg font-black text-[#050B1A] italic tracking-tighter leading-none">৳ {{ number_format($booking->total_price) }}</div>
                                    <div class="text-[8px] font-black text-emerald-500 uppercase tracking-widest italic mt-1">{{ $booking->payment_status === 'paid' ? 'Liquidity Settled' : 'Unsettled' }}</div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="w-12 h-12 bg-white border-2 border-gray-100 text-[#050B1A] rounded-[1.2rem] flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('PURGE TRANSACTION?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-12 h-12 bg-white border-2 border-gray-100 text-red-500 rounded-[1.2rem] flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Operational Pagination -->
            <div class="px-4">
                {{ $bookings->appends(request()->query())->links() }}
            </div>

            <!-- Empty Signal State -->
            @if($bookings->isEmpty())
                <div class="py-32 flex flex-col items-center justify-center text-center space-y-8">
                    <div class="w-32 h-32 bg-white border-2 border-gray-100 rounded-[3rem] shadow-2xl flex items-center justify-center text-6xl italic grayscale opacity-20">📜</div>
                    <div class="space-y-3">
                        <h3 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] italic">Null Registry Signal</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">No lease manifests detected in the current audit sector.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>