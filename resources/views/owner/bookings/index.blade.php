<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-[#050B1A] tracking-tight uppercase italic leading-[1.1]">
                    Operations <span class="text-orange-500">Hub</span>
                </h2>
                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">
                    CRS BD Strategic Fleet Logistics & Revenue Terminal
                </p>
            </div>
            <div class="flex items-center gap-6">
                 <div class="hidden md:flex flex-col items-end">
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-tight">Global Server Time</span>
                    <span class="text-[10px] font-black text-[#050B1A] italic mt-1 leading-none">{{ now()->format('H:i:s T') }}</span>
                </div>
                <div class="h-10 w-px bg-gray-200 mx-2"></div>
                <div class="flex items-center gap-3 px-6 py-3 bg-white border border-gray-100 rounded-2xl shadow-sm italic">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest">Active Sync</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen relative overflow-hidden pb-24 font-outfit">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>

        <!-- Institutional Hero: Operations Hub Banner -->
        <div class="relative py-24 md:py-32 mb-12 md:mb-16 -mt-12 overflow-hidden rounded-b-[3rem] md:rounded-b-[5rem] group border-b border-gray-200 shadow-2xl shadow-indigo-500/5">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2000ms] group-hover:scale-110" style="background-image: url('{{ asset('images/assets/operations_hub_banner.png') }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
            
            <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-3 px-4 py-2 bg-white/5 border border-white/10 rounded-xl mb-6 backdrop-blur-md">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-white uppercase tracking-widest italic">Mission Critical Node</span>
                    </div>
                    <h1 class="text-5xl md:text-8xl font-black text-white uppercase tracking-tight italic leading-[1.1] mb-8">
                        Operational <br> <span class="text-orange-500 text-glow-orange">Integrity.</span>
                    </h1>
                    <p class="text-gray-300 font-bold text-xs uppercase tracking-widest mt-6 italic opacity-80 leading-relaxed max-w-xl">
                        Managing decentralized asset logistics and mission throughput. Monitor real-time fleet handovers and revenue settlement protocols.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            
            <!-- Strategic Intelligence Module (Stats) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <!-- Stat: Mission Volume -->
                <div class="bg-white border border-gray-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:scale-[1.02] hover:shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-gray-50 rounded-full group-hover:bg-indigo-50 transition-colors"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 bg-[#050B1A] rounded-xl flex items-center justify-center text-white shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest italic leading-none">Total Volume</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-black text-[#050B1A] tracking-tight italic leading-none">{{ $bookings->total() }}</span>
                            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest leading-none">Missions</span>
                        </div>
                    </div>
                </div>

                <!-- Stat: Active Deployments -->
                <div class="bg-white border border-gray-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:scale-[1.02] hover:shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:bg-emerald-100 transition-colors"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest italic leading-none">Active Missions</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-black text-[#050B1A] tracking-tight italic leading-none">{{ $bookings->whereIn('status', ['ongoing', 'returning'])->count() }}</span>
                            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest leading-none">Handovers</span>
                        </div>
                    </div>
                </div>

                <!-- Stat: Unverified Assets -->
                <div class="bg-white border border-gray-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:scale-[1.02] hover:shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-50 rounded-full group-hover:bg-orange-100 transition-colors"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3m0 18a10.003 10.003 0 01-9.757-9.474.12.12 0 01.054-.09c.64-.322 1.341-.486 2.052-.468a3.992 3.992 0 013.066 1.481"></path></svg>
                            </div>
                            <span class="text-[9px] font-black text-orange-500 uppercase tracking-widest italic leading-none">Auth Queue</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-black text-[#050B1A] tracking-tight italic leading-none">{{ $bookings->where('status', 'pending')->count() }}</span>
                            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest leading-none">Requests</span>
                        </div>
                    </div>
                </div>

                <!-- Stat: Revenue Target -->
                <div class="bg-[#050B1A] border border-white/5 p-8 rounded-[3rem] shadow-2xl transition-all hover:scale-[1.02] group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/5 rounded-full group-hover:bg-white/10 transition-all"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#050B1A] shadow-lg">
                                <span class="text-xs font-black">৳</span>
                            </div>
                            <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest italic leading-none">Total Yield</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-white tracking-tight italic leading-none">৳{{ number_format($bookings->sum('total_price'), 0) }}</span>
                            <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest leading-none">Gross</span>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-12 bg-white border border-emerald-50 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(16,185,129,0.05)] border-l-8 border-l-emerald-500 animate-in slide-in-from-top-4 duration-500">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 shadow-sm border border-emerald-100 italic">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Protocol Finalized</h4>
                            <p class="text-[9px] text-emerald-600 font-black uppercase tracking-widest mt-2 italic leading-none">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Operations Ledger Terminal -->
            <div class="bg-white border border-gray-100 rounded-[4rem] shadow-[0_60px_120px_rgba(0,0,0,0.03)] overflow-hidden transition-all hover:shadow-2xl group">
                
                <div class="p-10 md:p-14 border-b border-gray-50">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-[#050B1A] rounded-[1.5rem] flex items-center justify-center text-white shadow-2xl border border-white/10 group-hover:rotate-12 transition-transform italic font-black text-2xl">
                                OL
                            </div>
                            <div>
                                <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none group-hover:translate-x-1 transition-transform">Operations Ledger</h3>
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">Live Fleet Mission Registry</p>
                            </div>
                        </div>

                        <div class="w-full md:w-96 relative group/search italic">
                            <form action="{{ route('owner.bookings.index') }}" method="GET">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Operator, Unit or ID..." class="w-full bg-gray-50 border-2 border-gray-100 rounded-[2rem] py-5 px-8 ps-14 text-sm font-black text-[#050B1A] uppercase tracking-widest focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all outline-none">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within/search:text-orange-500 transition-colors pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if($bookings->count() > 0)
                    <div class="overflow-x-auto overflow-y-hidden">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="py-10 pl-14 text-left text-[10px] font-black uppercase tracking-widest text-gray-500 italic leading-none">Mission Context & Unit</th>
                                    <th class="py-10 text-left text-[10px] font-black uppercase tracking-widest text-gray-500 italic leading-none">Tactical Operator</th>
                                    <th class="py-10 text-left text-[10px] font-black uppercase tracking-widest text-gray-500 italic leading-none">Temporal Logic</th>
                                    <th class="py-10 text-left text-[10px] font-black uppercase tracking-widest text-gray-500 italic leading-none">Yield Vector</th>
                                    <th class="py-10 text-left text-[10px] font-black uppercase tracking-widest text-gray-500 italic leading-none">Operational Status</th>
                                    <th class="py-10 pr-14 text-right text-[10px] font-black uppercase tracking-widest text-gray-500 italic leading-none">Tactical Action Hub</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($bookings as $booking)
                                    <tr class="group/row hover:bg-gray-50/80 transition-all duration-500">
                                        <td class="py-10 pl-14">
                                            <div class="flex items-center gap-6">
                                                <div class="relative group/asset">
                                                    <div class="w-24 h-16 rounded-2xl bg-[#050B1A] border-2 border-gray-100 overflow-hidden shadow-sm group-hover/asset:border-orange-500 transition-all duration-700">
                                                        @if($booking->car->images->count() > 0)
                                                            <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover group-hover/asset:scale-125 transition-transform duration-[1500ms]">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="{{ route('cars.show', $booking->car) }}" class="text-sm font-black text-[#050B1A] uppercase italic tracking-tight hover:text-orange-500 transition-colors block leading-tight">
                                                        {{ $booking->car->brand }} <span class="text-orange-500">{{ $booking->car->model }}</span>
                                                    </a>
                                                    <div class="text-[9px] text-gray-500 font-black uppercase tracking-widest mt-2 italic flex items-center gap-3 leading-none">
                                                        <span class="w-1.5 h-1.5 bg-gray-200 rounded-full"></span>
                                                        {{ $booking->car->location }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-10">
                                            <a href="{{ route('profiles.show', $booking->customer) }}" class="flex items-center gap-5 group/operator">
                                                <div class="w-12 h-12 rounded-[1rem] bg-[#050B1A] border border-white/10 flex items-center justify-center text-white font-black text-sm group-hover/operator:bg-orange-500 transition-all shadow-xl">
                                                    {{ substr($booking->customer->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-black text-[#050B1A] uppercase tracking-tight italic group-hover/operator:translate-x-1 transition-transform leading-none">{{ $booking->customer->name }}</div>
                                                    <div class="text-[8px] text-emerald-500 font-bold uppercase tracking-widest mt-1 opacity-80 leading-none italic">Verified Identity</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="py-10">
                                            <div class="space-y-4">
                                                <div class="text-xs font-black text-[#050B1A] font-outfit tracking-tight italic flex items-center gap-3 leading-none">
                                                    <span class="px-3 py-1 bg-gray-100 rounded-lg text-gray-500 text-[10px] leading-none tracking-normal italic">In</span>
                                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('d M, Y') }}
                                                </div>
                                                <div class="text-xs font-black text-[#050B1A] font-outfit tracking-tight italic flex items-center gap-3 leading-none">
                                                    <span class="px-3 py-1 bg-orange-500/10 rounded-lg text-orange-600 text-[10px] leading-none tracking-normal italic">Out</span>
                                                    {{ \Carbon\Carbon::parse($booking->end_date)->format('d M, Y') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-10">
                                            <div class="text-2xl font-black text-[#050B1A] tracking-tight italic leading-none">
                                                <span class="text-xs text-orange-500 mr-1 italic">৳</span>{{ number_format($booking->total_price, 0) }}
                                            </div>
                                            <div class="inline-flex items-center gap-3 mt-3 px-3 py-1.5 rounded-full {{ $booking->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-[0_0_20px_rgba(16,185,129,0.05)]' : 'bg-orange-50 text-orange-600 border border-orange-100' }} leading-none italic">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $booking->payment_status === 'paid' ? 'bg-emerald-500 animate-pulse' : 'bg-orange-500' }}"></span>
                                                <span class="text-[8px] font-black uppercase tracking-widest">{{ $booking->payment_status === 'paid' ? 'Cleared' : 'Settlement Pending' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-10">
                                            @php
                                                $statusMap = [
                                                    'pending' => ['label' => 'Awaiting Auth', 'color' => 'bg-orange-50 text-orange-600 border-orange-100'],
                                                    'approved' => ['label' => 'Authorized', 'color' => 'bg-blue-50 text-blue-600 border-blue-100'],
                                                    'ongoing' => ['label' => 'Deployment', 'color' => 'bg-emerald-50 text-emerald-600 border-emerald-100'],
                                                    'returning' => ['label' => 'Retrograde', 'color' => 'bg-purple-50 text-purple-600 border-purple-100 animate-pulse'],
                                                    'returned' => ['label' => 'Landed', 'color' => 'bg-purple-50 text-purple-600 border-purple-100'],
                                                    'completed' => ['label' => 'Archived', 'color' => 'bg-gray-100 text-gray-500 border-gray-200'],
                                                    'rejected' => ['label' => 'Denied', 'color' => 'bg-red-50 text-red-600 border-red-100'],
                                                    'cancelled' => ['label' => 'Aborted', 'color' => 'bg-red-50 text-red-600 border-red-100'],
                                                ];
                                                $config = $statusMap[$booking->status] ?? ['label' => $booking->status, 'color' => 'bg-gray-50 text-gray-500 border-gray-100'];
                                            @endphp
                                            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-2xl text-[9px] font-black uppercase tracking-widest border shadow-sm {{ $config['color'] }} italic leading-none">
                                                {{ $config['label'] }}
                                            </div>
                                        </td>
                                        <td class="py-10 pr-14 text-right" x-data="{ openHandover: false, openAudit: false }">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('owner.bookings.show', $booking) }}" class="w-12 h-12 bg-white border-2 border-gray-100 flex items-center justify-center rounded-2xl text-gray-400 hover:text-[#050B1A] hover:border-orange-500 transition-all hover:-translate-y-1 shadow-sm" title="Open Brief">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                                
                                                @if($booking->status === 'pending')
                                                    <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="px-8 py-4 bg-[#050B1A] hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl hover:-translate-y-1 hover:shadow-orange-500/20 italic leading-none">Authorize</button>
                                                    </form>
                                                @elseif($booking->status === 'approved')
                                                    <button @click="openHandover = true" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl hover:-translate-y-1 hover:shadow-emerald-500/20 italic">Initiate Handover</button>

                                                    <!-- Handover Modal -->
                                                    <div x-show="openHandover" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-[#050B1A]/80 backdrop-blur-xl" x-cloak>
                                                        <div @click.away="openHandover = false" class="bg-white border-2 border-gray-100 rounded-[4rem] w-full max-w-xl p-12 md:p-16 shadow-[0_80px_160px_rgba(0,0,0,0.5)] text-left relative overflow-hidden">
                                                            <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-50 rounded-full blur-[100px] pointer-events-none"></div>
                                                            
                                                            <div class="relative z-10">
                                                                <div class="flex items-center gap-6 mb-12">
                                                                    <div class="w-16 h-16 bg-emerald-500 rounded-[1.5rem] flex items-center justify-center text-white shadow-2xl border-4 border-emerald-50 italic font-black text-2xl leading-none">HI</div>
                                                                    <div>
                                                                        <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-tight">Handover Protocol</h3>
                                                                        <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">Initiating Deployment Sequence</p>
                                                                    </div>
                                                                </div>

                                                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <input type="hidden" name="status" value="ongoing">
                                                                    <div class="space-y-10">
                                                                        <div class="space-y-4">
                                                                            <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Current Odometer (km)</label>
                                                                            <input type="number" name="start_odo" required placeholder="Enter displacement constant..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-3xl tracking-tight focus:bg-white focus:border-emerald-500 transition-all italic font-outfit outline-none">
                                                                        </div>
                                                                        <div class="p-8 bg-emerald-50/50 border-2 border-emerald-100 rounded-[2.5rem] text-[11px] text-emerald-700 font-black uppercase tracking-widest leading-relaxed italic text-center">
                                                                            <span class="text-emerald-500 block mb-2 text-sm leading-none">SECURITY ADVISORY</span>
                                                                            Verify operator credentials physically before releasing asset prototype.
                                                                        </div>
                                                                        <div class="grid grid-cols-2 gap-6 pt-4">
                                                                            <button type="button" @click="openHandover = false" class="py-6 bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-[2rem] hover:bg-gray-200 transition-all italic leading-none">Abort</button>
                                                                            <button type="submit" class="py-6 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-[2rem] shadow-xl shadow-emerald-500/20 hover:bg-emerald-600 transition-all italic leading-none">Authorize Release</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif(in_array($booking->status, ['ongoing', 'returning']))
                                                    <button @click="openAudit = true" class="px-8 py-4 {{ $booking->status === 'returning' ? 'bg-purple-600 animate-pulse scale-105' : 'bg-[#050B1A] text-white' }} hover:scale-105 text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl hover:shadow-purple-500/20 italic flex items-center gap-3">
                                                        <svg class="w-5 h-5 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        Conduct Audit
                                                    </button>

                                                    <!-- Audit Modal -->
                                                    <div x-show="openAudit" x-data="{ damageDetected: false }" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-[#050B1A]/80 backdrop-blur-xl" x-cloak>
                                                        <div @click.away="openAudit = false" class="bg-white border-2 border-gray-100 rounded-[4rem] w-full max-w-2xl p-12 md:p-16 shadow-[0_80px_160px_rgba(0,0,0,0.5)] text-left relative overflow-y-auto max-h-[90vh]">
                                                            <div class="absolute -right-20 -top-20 w-80 h-80 bg-purple-50 rounded-full blur-[100px] pointer-events-none"></div>
                                                            
                                                            <div class="relative z-10">
                                                                <div class="flex items-center gap-6 mb-12">
                                                                    <div class="w-16 h-16 bg-purple-600 rounded-[1.5rem] flex items-center justify-center text-white shadow-2xl border-4 border-purple-50 italic font-black text-2xl leading-none">RA</div>
                                                                    <div>
                                                                        <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-tight">Return Audit</h3>
                                                                        <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">Asset De-deployment Sequence</p>
                                                                    </div>
                                                                </div>

                                                                <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                                                                    @csrf @method('PUT')
                                                                    <input type="hidden" name="status" value="returned">
                                                                    
                                                                    <div class="grid grid-cols-2 gap-8 p-10 bg-gray-50/50 border-2 border-gray-100 rounded-[3rem] shadow-inner mb-12">
                                                                        <div>
                                                                            <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest italic mb-2 block leading-none">Departure Log</span>
                                                                            <div class="text-2xl font-black text-[#050B1A] font-outfit italic tracking-tight leading-none">{{ number_format($booking->start_odo) }} <span class="text-[11px] text-gray-400 uppercase tracking-widest ml-1 font-bold">km</span></div>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <span class="text-[9px] font-black text-purple-600 uppercase tracking-widest italic mb-2 block leading-none">Renter's Projected Final</span>
                                                                            <div class="text-2xl font-black text-purple-600 font-outfit italic tracking-tight leading-none">{{ number_format($booking->renter_end_odo ?? $booking->start_odo) }} <span class="text-[11px] text-gray-300 uppercase tracking-widest ml-1 font-bold">km</span></div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="grid grid-cols-2 gap-10">
                                                                        <div class="space-y-4">
                                                                            <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Verified Displacement</label>
                                                                            <input type="number" name="end_odo" required value="{{ $booking->renter_end_odo ?? $booking->start_odo }}" class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-2xl tracking-tight focus:bg-white focus:border-purple-500 transition-all italic font-outfit outline-none">
                                                                        </div>
                                                                        <div class="space-y-4">
                                                                            <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Fuel Reserves</label>
                                                                            <div class="relative">
                                                                                <select name="end_fuel" required class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-[11px] uppercase tracking-widest focus:bg-white focus:border-purple-500 transition-all italic appearance-none cursor-pointer outline-none">
                                                                                    <option value="Full">Institutional Full</option>
                                                                                    <option value="3/4">3/4 Tactical</option>
                                                                                    <option value="1/2">1/2 Tactical</option>
                                                                                    <option value="1/4">1/4 Tactical</option>
                                                                                    <option value="Empty">Depleted</option>
                                                                                </select>
                                                                                <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="p-10 border-2 rounded-[3.5rem] transition-all duration-700" :class="damageDetected ? 'bg-red-50 border-red-200 shadow-[0_45px_100px_rgba(239,68,68,0.1)]' : 'bg-gray-50/50 border-gray-100'">
                                                                        <div class="flex items-center justify-between mb-8">
                                                                            <label class="flex items-center gap-4 cursor-pointer group/toggle">
                                                                                <div class="relative">
                                                                                    <input type="checkbox" x-model="damageDetected" class="sr-only">
                                                                                    <div class="w-14 h-8 rounded-full transition-colors duration-500" :class="damageDetected ? 'bg-red-500' : 'bg-gray-200'"></div>
                                                                                    <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition-transform duration-500 shadow-md" :class="damageDetected ? 'translate-x-6' : 'translate-x-0'"></div>
                                                                                </div>
                                                                                <span class="text-[11px] font-black uppercase tracking-widest italic leading-none" :class="damageDetected ? 'text-red-700' : 'text-[#050B1A]'">Any Damage Detected?</span>
                                                                            </label>
                                                                            <span x-show="damageDetected" class="text-[9px] font-black text-red-500 uppercase tracking-widest animate-pulse leading-none italic">Critical Ingestion Triggered</span>
                                                                        </div>

                                                                        <div x-show="damageDetected" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8 pt-8 border-t border-red-200/50">
                                                                            <div class="space-y-4">
                                                                                <label class="text-[10px] font-black text-red-500 uppercase tracking-widest ms-6 italic leading-none">Compromise Narrative</label>
                                                                                <textarea name="damage_description" x-bind:required="damageDetected" placeholder="Describe the structural compromise..." class="w-full bg-white border-2 border-red-100 rounded-[2.5rem] p-8 text-red-900 font-bold text-xs tracking-widest italic focus:border-red-500 outline-none resize-none transition-all leading-tight"></textarea>
                                                                            </div>
                                                                            <div class="grid grid-cols-2 gap-8">
                                                                                <div class="space-y-4">
                                                                                    <label class="text-[10px] font-black text-red-500 uppercase tracking-widest ms-6 italic leading-none">Assessment (৳)</label>
                                                                                    <input type="number" step="0.01" name="damage_cost" x-bind:required="damageDetected" placeholder="0.00" class="w-full bg-white border-2 border-red-100 rounded-[2rem] p-6 text-red-600 font-black text-2xl tracking-tight italic font-outfit outline-none leading-none">
                                                                                </div>
                                                                                <div class="space-y-4">
                                                                                    <label class="text-[10px] font-black text-red-500 uppercase tracking-widest ms-6 italic leading-none">Visual Evidence</label>
                                                                                    <div class="relative italic">
                                                                                        <input type="file" name="damage_image" class="block w-full text-[9px] text-gray-400 file:mr-6 file:py-4 file:px-8 file:rounded-2xl file:border-0 file:bg-red-500/10 file:text-red-600 file:font-black file:uppercase file:tracking-widest cursor-pointer group-hover:file:bg-red-500 group-hover:file:text-white transition-all">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="space-y-4">
                                                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Audit Testimony (Optional)</label>
                                                                        <textarea name="inspection_notes" rows="2" placeholder="Record final inspection metadata..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2.5rem] p-8 text-[#050B1A] font-bold text-xs tracking-widest italic focus:bg-white focus:border-purple-500 outline-none resize-none transition-all shadow-sm leading-tight"></textarea>
                                                                    </div>

                                                                    <div class="grid grid-cols-2 gap-6 pt-6">
                                                                        <button type="button" @click="openAudit = false" class="py-6 bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-[2rem] hover:bg-gray-200 transition-all italic leading-none">Abort</button>
                                                                        <button type="submit" class="py-6 bg-purple-600 text-white text-[10px] font-black uppercase tracking-widest rounded-[2.5rem] shadow-xl shadow-purple-500/20 hover:bg-purple-700 transition-all italic leading-none">Authorize De-deployment</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif($booking->status === 'returned')
                                                    @if($booking->isLocked())
                                                        <div class="px-6 py-3 bg-red-50 border-2 border-red-100 rounded-2xl flex items-center gap-4 animate-pulse">
                                                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                                            <div class="text-right">
                                                                <div class="text-[10px] font-black text-red-600 uppercase tracking-widest italic mb-0.5">Integrity Locked</div>
                                                                <div class="text-[8px] text-red-400 font-bold uppercase tracking-widest leading-none">Dispute Active</div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="px-8 py-4 bg-white border-2 border-gray-100 text-[#050B1A] hover:bg-emerald-500 hover:text-white hover:border-emerald-500 text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl italic flex items-center gap-3 group/final leading-none" onclick="return confirm('Finalize mission and settle transaction yield?');">
                                                                <svg class="w-5 h-5 group-hover/final:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                Finalize Mission
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>

                                            @if($booking->status === 'completed' && !(\App\Models\UserReview::where('reviewer_id', auth()->id())->where('booking_id', $booking->id)->exists()))
                                                <div class="mt-8 p-8 bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-[3rem] text-left">
                                                    <h4 class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest mb-6 flex items-center gap-4 italic opacity-80 leading-none">
                                                        <span class="w-1.5 h-4 bg-orange-500 rounded-full"></span>
                                                        Operator Reputation Update
                                                    </h4>
                                                    <form action="{{ route('owner.bookings.review', $booking) }}" method="POST" class="flex flex-col md:flex-row gap-6 italic">
                                                        @csrf
                                                        <div class="relative shrink-0">
                                                            <select name="rating" required class="w-full md:w-48 bg-white border-2 border-gray-100 text-[#050B1A] rounded-2xl text-[10px] font-black uppercase tracking-widest py-4 px-6 appearance-none cursor-pointer focus:border-orange-500 outline-none leading-none">
                                                                <option value="5">Excellent</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Poor</option>
                                                                <option value="1">Critical</option>
                                                            </select>
                                                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="comment" placeholder="Log operator conduct during mission..." class="flex-1 bg-white border-2 border-gray-100 text-[#050B1A] rounded-[2rem] text-xs font-bold py-4 px-8 focus:border-orange-500 outline-none uppercase tracking-widest shadow-sm">
                                                        <button type="submit" class="px-10 py-4 bg-[#050B1A] hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl transition-all shrink-0 leading-none">Log</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-40 text-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-[0.02] pointer-events-none grayscale" style="background-image: url('{{ asset('images/assets/empty_operations.png') }}'); background-size: cover; background-position: center;"></div>
                        <div class="relative z-10 max-w-md mx-auto">
                            <div class="w-32 h-32 bg-gray-50 border-2 border-gray-100 rounded-[3rem] flex items-center justify-center mx-auto mb-10 text-5xl shadow-sm rotate-12">🛰️</div>
                            <h3 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none mb-6">No Active Operations</h3>
                            <p class="text-[11px] text-gray-500 font-black uppercase tracking-widest italic mb-10 leading-relaxed px-6">Your fleet is currently dormant. Deploy units to the marketplace to initiate mission throughput.</p>
                            <a href="{{ route('owner.cars.create') }}" class="inline-flex items-center gap-4 px-10 py-5 bg-[#050B1A] hover:bg-orange-500 text-white text-[11px] font-black uppercase tracking-widest rounded-[2rem] shadow-2xl transition-all hover:-translate-y-1 hover:shadow-orange-500/20 italic leading-none">
                                Deploy New Asset
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            @if($bookings->hasPages())
                <div class="mt-16 flex justify-center institutional-pagination">
                    {{ $bookings->links() }}
                </div>
            @endif

        </div>
    </div>

    <style>
        .text-glow-orange { text-shadow: 0 0 30px rgba(249, 115, 22, 0.4); }
        .institutional-pagination nav { @apply flex items-center gap-2; }
        .institutional-pagination nav div { @apply hidden; }
        .institutional-pagination .relative.inline-flex { @apply bg-white border-2 border-gray-100 rounded-2xl p-4 text-[11px] font-black text-[#050B1A] uppercase italic tracking-widest hover:border-orange-500 transition-all shadow-sm; }
        .institutional-pagination .bg-white.border-gray-300 { @apply border-gray-100; }
        .animate-spin-slow { animation: spin 8s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        [x-cloak] { display: none !important; }
        select { -webkit-appearance: none; }
    </style>
</x-app-layout>
