<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8 px-4 sm:px-0">
            <div>
                <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Fleet <span class="text-indigo-500">Logistics</span>
                </h2>
                <div class="flex items-center gap-4 mt-3">
                    <span class="w-12 h-px bg-indigo-500/30"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-600 font-black uppercase tracking-[0.4em] italic">
                        MOVEMENT TRACKING & DEPLOYMENT SCHEDULE
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="px-6 py-3 bg-white border border-gray-100 rounded-2xl shadow-xl shadow-gray-200/50">
                    <div class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1 italic">Fleet Velocity</div>
                    <div class="text-[10px] font-black text-emerald-600 uppercase tracking-widest flex items-center gap-2 italic">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Nominal Flow
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <!-- Mission Critical Movements -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                
                <!-- Deployment Matrix (Handovers) -->
                <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative group overflow-hidden transition-all hover:shadow-2xl">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-50 rounded-full blur-3xl"></div>
                    <h3 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.3em] mb-10 flex items-center gap-3 italic">
                        <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                        Handover Matrix (T-7D)
                    </h3>
                    
                    <div class="space-y-6">
                        @forelse($upcomingHandovers as $b)
                        <div class="p-6 bg-gray-50/50 border border-gray-100 rounded-[2rem] hover:bg-white hover:border-blue-500/30 transition-all duration-500 flex items-center justify-between group/item shadow-sm hover:shadow-xl">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-12 rounded-xl bg-gray-950 overflow-hidden relative border-2 border-white shadow-lg">
                                    <img src="{{ $b->car->primary_image_url }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-blue-500/10"></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1 italic">{{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} @ {{ \Carbon\Carbon::parse($b->start_date)->diffForHumans() }}</div>
                                    <h4 class="text-sm font-black text-[#050B1A] uppercase tracking-tighter italic leading-none">{{ $b->car->brand }} <span class="text-blue-500">{{ $b->car->model }}</span></h4>
                                    <div class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mt-2 italic flex items-center gap-2">
                                        <div class="w-1 h-1 rounded-full bg-gray-400"></div>
                                        Operator: {{ $b->customer->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-3">
                                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-600 text-[8px] font-black uppercase tracking-widest rounded-lg border border-emerald-500/10 italic">
                                    @if($b->customer->isVerified()) IDENTITY OK @else UNVERIFIED @endif
                                </span>
                                <a href="{{ route('owner.bookings.show', $b) }}" class="text-[9px] font-black text-gray-600 hover:text-blue-500 transition-colors uppercase tracking-[0.2em] italic">Brief →</a>
                            </div>
                        </div>
                        @empty
                        <div class="py-16 text-center text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] italic leading-relaxed">No Imminent Handovers Detected</div>
                        @endforelse
                    </div>
                </div>

                <!-- Retrieval Matrix (Returns) -->
                <div class="bg-white border border-gray-100 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative group overflow-hidden transition-all hover:shadow-2xl">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-purple-50 rounded-full blur-3xl"></div>
                    <h3 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.3em] mb-10 flex items-center gap-3 italic">
                        <span class="w-2 h-6 bg-purple-500 rounded-full"></span>
                        Retrieval Matrix (ACTIVE)
                    </h3>
                    
                    <div class="space-y-6">
                        @forelse($activeReturns as $b)
                        <div class="p-6 bg-gray-50/50 border border-gray-100 rounded-[2rem] hover:bg-white hover:border-purple-500/30 transition-all duration-500 flex items-center justify-between group/item shadow-sm hover:shadow-xl">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-12 rounded-xl bg-gray-950 overflow-hidden relative border-2 border-white shadow-lg">
                                    <img src="{{ $b->car->primary_image_url }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-purple-500/10"></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-black text-purple-500 uppercase tracking-widest mb-1 italic">Due {{ \Carbon\Carbon::parse($b->end_date)->format('M d') }}</div>
                                    <h4 class="text-sm font-black text-[#050B1A] uppercase tracking-tighter italic leading-none">{{ $b->car->brand }} <span class="text-purple-500">{{ $b->car->model }}</span></h4>
                                    <div class="text-[9px] text-gray-600 font-bold uppercase tracking-widest mt-2 italic flex items-center gap-2">
                                        <div class="w-1 h-1 rounded-full bg-gray-400"></div>
                                        Sector: {{ $b->car->location }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('owner.bookings.show', $b) }}" class="px-6 py-2.5 bg-[#050B1A] hover:bg-purple-500 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl italic leading-none">Inspect</a>
                            </div>
                        </div>
                        @empty
                        <div class="py-16 text-center text-gray-500 text-[10px] font-black uppercase tracking-[0.4em] italic leading-relaxed">Fleet Currently Stationary</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Global Movement Ledger -->
            <div class="bg-white border border-gray-100 rounded-[3rem] md:rounded-[4rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)]">
                <div class="p-8 md:p-12 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white italic font-black text-xl shadow-2xl">ML</div>
                        <div>
                            <h3 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Ledger Manifest</h3>
                            <p class="text-[9px] text-gray-600 font-black uppercase tracking-widest mt-2 italic">Institutional Movement Analytics</p>
                        </div>
                    </div>
                    <div class="w-full md:w-96">
                        <x-search-bar :route="route('owner.logistics.index')" placeholder="Search operations, assets..." />
                    </div>
                </div>
                
                <div class="overflow-x-auto px-4 md:px-0">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] italic">
                                <th class="px-10 py-6">Operation ID</th>
                                <th class="px-10 py-6">Asset Intelligence</th>
                                <th class="px-10 py-6 text-center">Status</th>
                                <th class="px-10 py-6">Deployment Lifecycle</th>
                                <th class="px-10 py-6 text-right">Yield</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($timeline as $b)
                            <tr class="group hover:bg-gray-50/50 transition-colors cursor-pointer" onclick="window.location='{{ route('owner.logistics.show', $b) }}'">
                                <td class="px-10 py-8">
                                    <div class="text-[11px] font-black text-[#050B1A] uppercase tracking-tighter italic">#OP-{{ str_pad($b->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-[7px] text-gray-600 font-black uppercase tracking-widest mt-1">Registry Log</div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-8 rounded-lg bg-gray-950 overflow-hidden border border-gray-100 shrink-0">
                                            <img src="{{ $b->car->primary_image_url }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[11px] font-black text-[#050B1A] tracking-widest uppercase italic leading-none">{{ $b->car->brand }} {{ $b->car->model }}</span>
                                            <span class="text-[8px] text-gray-600 font-bold mt-1.5 uppercase tracking-widest italic truncate max-w-[120px]">{{ $b->customer->name }} Artifact</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    @php
                                        $statusStyles = [
                                            'approved' => 'bg-blue-50 text-blue-600 border-blue-100',
                                            'ongoing' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'returned' => 'bg-purple-50 text-purple-600 border-purple-100',
                                        ];
                                        $style = $statusStyles[$b->status] ?? 'bg-gray-50 text-gray-400 border-gray-100';
                                    @endphp
                                    <span class="px-4 py-1.5 rounded-xl border {{ $style }} text-[9px] font-black uppercase tracking-widest italic inline-block whitespace-nowrap shadow-sm">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="text-[10px] text-[#050B1A] font-black uppercase tracking-tighter italic">
                                        {{ \Carbon\Carbon::parse($b->start_date)->format('d M') }} 
                                        <span class="text-gray-400 mx-2">→</span> 
                                        {{ \Carbon\Carbon::parse($b->end_date)->format('d M') }}
                                    </div>
                                    <div class="text-[7px] text-gray-600 font-black uppercase mt-1 tracking-[0.2em] italic">Timeline Latency Nominal</div>
                                </td>
                                <td class="px-10 py-8 text-right">
                                     <div class="flex items-center justify-end gap-6">
                                        <span class="text-xs font-black text-[#050B1A] italic tracking-tighter">৳{{ number_format($b->total_price) }}</span>
                                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all group-hover:bg-[#050B1A] group-hover:text-white group-hover:rotate-12">
                                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             @empty
                            <tr>
                                <td colspan="5" class="py-32 text-center text-gray-500 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">System Idle: No Movement Data detected</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
