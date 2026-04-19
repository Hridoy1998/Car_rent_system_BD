<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8 px-4 sm:px-0">
            <div class="text-center md:text-left">
                <h2 class="font-black text-3xl md:text-5xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Governance <span class="text-orange-500">Center</span>
                </h2>
                <div class="flex items-center justify-center md:justify-start gap-3 mt-4">
                    <span class="w-8 h-px bg-gray-200"></span>
                    <p class="text-[8px] md:text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] italic leading-none">
                        Institutional Operations Nexus
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap justify-center md:justify-end items-center gap-4 md:gap-8">
                <div class="flex flex-col items-center md:items-end">
                    <span class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none mb-2">System Load</span>
                    <span class="text-blue-900 flex items-center gap-2 text-[10px] md:text-[11px] font-black uppercase tracking-widest italic">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-900 animate-pulse"></span>
                        Nominal Status
                    </span>
                </div>
                <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>
                <div class="bg-[#050B1A] px-6 py-3 rounded-2xl border border-white/10 shadow-xl hidden sm:block">
                    <span class="text-white text-[9px] font-black uppercase tracking-[0.2em] italic">Intelligence Grid Online</span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Institutional Hero: Shared Branding Banner -->
    <div class="relative py-16 md:py-32 mb-8 md:mb-12 -mt-12 overflow-hidden rounded-b-[2.5rem] md:rounded-b-[5rem] group border-b border-gray-100 shadow-2xl shadow-[#050B1A]/5">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2000ms] group-hover:scale-110" style="background-image: url('{{ asset('images/assets/admin_nexus_banner.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-white/5 border border-white/10 rounded-xl mb-8 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                    <span class="text-[9px] md:text-[10px] font-black text-white uppercase tracking-widest italic leading-none">Global Sovereignty Nexus</span>
                </div>
                <h1 class="text-4xl md:text-8xl font-black text-white uppercase tracking-tighter italic leading-[0.85]">
                    Governance <br> <span class="text-orange-500">Unification.</span>
                </h1>
                <p class="text-gray-300 font-bold text-[10px] md:text-xs uppercase tracking-[0.4em] mt-8 italic opacity-80 leading-relaxed max-w-xl">
                    Administering platform integrity with absolute institutional authority and data-driven precision.
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-12 pb-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative z-10">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <!-- Strategic Performance Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            <!-- Revenue Command -->
            <a href="{{ route('admin.bookings.index') }}" class="relative group bg-white border border-gray-100 p-6 md:p-10 rounded-[2.5rem] md:rounded-[4rem] shadow-xl shadow-gray-200/50 transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-10 h-10 md:w-16 md:h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-lg md:text-2xl leading-none">৳</div>
                    <div class="text-right">
                         <div class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 md:mb-2 italic">Yield</div>
                         <div class="text-base md:text-xl font-black text-[#050B1A] tracking-tighter italic leading-none">৳{{ number_format($stats['settled_revenue'] / 1000, 1) }}K</div>
                    </div>
                </div>
                <h4 class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] mb-2 italic opacity-60">Settled Revenue</h4>
                <div class="text-2xl md:text-4xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">৳{{ number_format($stats['settled_revenue']) }}</div>
            </a>

            <!-- Success Velocity -->
            <div class="relative group bg-white border border-gray-100 p-6 md:p-10 rounded-[2.5rem] md:rounded-[4rem] shadow-xl shadow-gray-200/50 transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-10 h-10 md:w-16 md:h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-lg md:text-2xl leading-none">🛰️</div>
                    <div class="text-right">
                         <div class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 md:mb-2 italic">Velocity</div>
                         <div class="text-base md:text-xl font-black text-[#050B1A] tracking-tighter italic uppercase leading-none">{{ $stats['success_rate'] }}%</div>
                    </div>
                </div>
                <h4 class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] mb-2 italic opacity-60">Platform Success</h4>
                <div class="text-2xl md:text-4xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">{{ number_format($stats['total_bookings']) }}</div>
            </div>

            <!-- Global Users -->
            <a href="{{ route('admin.users.index') }}" class="relative group bg-white border border-gray-100 p-6 md:p-10 rounded-[2.5rem] md:rounded-[4rem] shadow-xl shadow-gray-200/50 transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-10 h-10 md:w-16 md:h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-lg md:text-2xl leading-none">👤</div>
                    <div class="text-right uppercase italic">
                         <div class="text-[7px] md:text-[9px] font-black text-red-500 uppercase tracking-widest mb-1 md:mb-2 italic">Blocked</div>
                         <div class="text-base md:text-xl font-black text-red-500 tracking-tighter italic leading-none">{{ $stats['blocked_users'] }}</div>
                    </div>
                </div>
                <h4 class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] mb-2 italic opacity-60">Operator Registry</h4>
                <div class="text-2xl md:text-4xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">{{ number_format($stats['total_users']) }}</div>
            </a>

            <!-- Fleet Registry -->
            <a href="{{ route('admin.cars.index') }}" class="relative group bg-white border border-gray-100 p-6 md:p-10 rounded-[2.5rem] md:rounded-[4rem] shadow-xl shadow-gray-200/50 transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-10 h-10 md:w-16 md:h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-lg md:text-2xl leading-none">🏎️</div>
                    <div class="text-right">
                         <div class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 md:mb-2 italic italic uppercase tracking-widest">Active</div>
                         <div class="text-base md:text-xl font-black text-[#050B1A] tracking-tighter italic leading-none">{{ $stats['total_cars'] ?? 0 }}</div>
                    </div>
                </div>
                <h4 class="text-[7px] md:text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] mb-2 italic opacity-60">Asset Inventory</h4>
                <div class="text-2xl md:text-4xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">Phase V</div>
            </a>
        </div>

        <!-- Operational Intelligence Hub -->
        <div class="space-y-8 md:space-y-12">
            
            <!-- Strategic Trajectory (Full Width Chart) -->
            <div class="bg-white border border-gray-100 p-8 md:p-14 lg:p-16 rounded-[4rem] shadow-xl shadow-gray-200/50 relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-orange-500/[0.02] rounded-full blur-[100px] group-hover:bg-orange-500/[0.05] transition-all duration-1000"></div>
                
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 md:mb-16 gap-8">
                    <div>
                        <h3 class="text-2xl md:text-4xl font-black text-gray-900 tracking-tighter uppercase italic leading-none flex items-center gap-4 md:gap-6">
                            <span class="w-10 md:w-16 h-1.5 bg-orange-500 rounded-full"></span>
                            Yield <span class="text-orange-500 text-glow-orange">Trajectory</span>
                        </h3>
                        <p class="text-[9px] md:text-[11px] text-gray-400 font-black uppercase tracking-[0.4em] mt-6 italic leading-none">GLOBAL PLATFORM REVENUE ANALYTICS PIPELINE</p>
                    </div>
                    <div class="hidden md:flex items-center gap-4 bg-[#050B1A] px-8 py-5 rounded-[2rem] border border-white/10 shadow-2xl">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-white text-[10px] font-black uppercase tracking-[0.3em] italic leading-none">Intelligence Sync Active</span>
                    </div>
                </div>

                <div class="h-64 md:h-96 flex items-end justify-between gap-2 md:gap-10 relative bg-gray-50/50 border-2 border-white rounded-[3rem] p-6 md:p-12 mb-4 overflow-hidden shadow-inner">
                    @php 
                        $maxVal = !empty($stats['monthly_revenue']) ? max($stats['monthly_revenue']) : 0;
                        $maxRev = $maxVal > 0 ? $maxVal : 1; 
                    @endphp
                    @foreach($stats['monthly_revenue'] ?? [] as $month => $sum)
                        <div class="flex-1 flex flex-col items-center group/item relative z-10 h-full justify-end">
                            <div class="text-[7px] md:text-[10px] text-gray-400 mb-6 md:mb-8 font-black uppercase tracking-widest transition-all group-hover/item:text-[#050B1A] italic leading-none">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                            <div class="w-full bg-[#050B1A] rounded-t-xl md:rounded-t-[2rem] transition-all duration-700 group-hover:bg-orange-600 relative overflow-hidden flex flex-col items-center justify-start border border-white/5" 
                                 style="height: {{ ($sum / $maxRev) * 80 }}%">
                                <div class="absolute inset-0 bg-white/5"></div>
                                <div class="absolute -top-16 left-1/2 -translate-x-1/2 bg-[#050B1A] text-[9px] md:text-[10px] font-black text-white px-4 py-2 rounded-xl opacity-0 translate-y-4 group-hover/item:opacity-100 group-hover/item:translate-y-0 transition-all scale-75 group-hover/item:scale-100 whitespace-nowrap z-50 shadow-2xl italic border border-white/10">
                                     ৳{{ number_format($sum / 1000, 1) }}k
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Operations Row: Pulse & Tasks -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
                <!-- Transaction Ledger (Pulse) -->
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-[3rem] md:rounded-[4rem] overflow-hidden shadow-xl shadow-gray-200/50 flex flex-col">
                    <div class="p-8 md:p-12 border-b border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-6 bg-gray-50/30">
                        <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tighter uppercase italic leading-none flex items-center gap-4">
                            <span class="w-10 h-1 bg-orange-500 rounded-full"></span>
                            Transaction <span class="text-orange-500">Pulse</span>
                        </h3>
                        <a href="{{ route('admin.bookings.index') }}" class="w-full sm:w-auto px-8 py-4 bg-[#050B1A] hover:bg-orange-600 text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl italic text-center leading-none">
                            Audit Feed
                        </a>
                    </div>

                    <!-- Desktop Pulse Table -->
                    <div class="hidden md:block overflow-x-auto flex-1">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50">
                                    <th class="px-12 py-8">Identity record</th>
                                    <th class="px-12 py-8">Asset Cluster</th>
                                    <th class="px-12 py-8 text-center">Protocol Status</th>
                                    <th class="px-12 py-8 text-right">Yield Artifact</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentBookings as $booking)
                                <tr class="group hover:bg-gray-50/50 transition-all duration-500">
                                    <td class="px-12 py-8">
                                        <div class="flex items-center space-x-6 min-w-0">
                                            <div class="w-14 h-14 rounded-2xl bg-[#050B1A] border-4 border-white flex items-center justify-center text-sm font-black text-white shadow-xl overflow-hidden shrink-0 italic">
                                                <img src="{{ $booking->customer->profile_photo_url }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="truncate">
                                                <a href="{{ route('profiles.show', $booking->customer) }}" class="text-[13px] font-black text-[#050B1A] hover:text-orange-600 transition-colors block uppercase tracking-tight italic truncate">{{ $booking->customer->name }}</a>
                                                <span class="text-[8px] text-gray-400 font-extrabold uppercase tracking-widest mt-2 italic leading-none block">Verified Bio-ID</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-8">
                                        <div class="flex flex-col">
                                            <span class="text-[11px] font-black text-[#050B1A] tracking-tighter uppercase italic leading-none mb-2">{{ $booking->car->brand }}</span>
                                            <span class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic leading-none">{{ $booking->car->model }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-8">
                                        <div class="flex items-center justify-center">
                                            @php
                                                $colors = [
                                                    'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                    'approved' => 'bg-blue-50 text-blue-900 border-blue-100',
                                                    'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                    'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                                ];
                                                $statusClass = $colors[$booking->status] ?? $colors['pending'];
                                            @endphp
                                            <span class="px-4 py-2 rounded-xl text-[8px] font-black uppercase tracking-[0.2em] italic border shadow-sm {{ $statusClass }}">
                                                {{ $booking->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-8 text-right">
                                        <span class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none font-outfit">৳{{ number_format($booking->total_price) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-10 py-32 text-center text-gray-300 italic">LOG VACANT</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Pulse Cards -->
                    <div class="block md:hidden divide-y divide-gray-50 flex-1">
                        @forelse($recentBookings as $booking)
                        <div class="p-8 space-y-6 group active:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-[#050B1A] flex items-center justify-center text-xs font-black text-white italic border-2 border-gray-100 shrink-0 uppercase">ID</div>
                                    <div class="min-w-0">
                                        <h5 class="text-[14px] font-black text-[#050B1A] uppercase italic leading-none truncate">{{ $booking->customer->name }}</h5>
                                        <span class="text-[8px] text-gray-400 uppercase font-black tracking-widest italic mt-2 block">Operator Registry</span>
                                    </div>
                                </div>
                                <span class="text-lg font-black text-[#050B1A] italic font-outfit">৳{{ number_format($booking->total_price) }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4 pt-4 border-t border-gray-50/50">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-[#050B1A] uppercase italic tracking-tight">{{ $booking->car->brand }}</span>
                                    <span class="text-[8px] text-gray-400 uppercase font-black italic tracking-widest mt-1">{{ $booking->car->model }}</span>
                                </div>
                                @php
                                    $statusClassMobile = $colors[$booking->status] ?? $colors['pending'];
                                @endphp
                                <span class="px-4 py-2 rounded-xl text-[8px] font-black uppercase tracking-widest italic border shadow-sm {{ $statusClassMobile }}">
                                    {{ $booking->status }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="py-24 text-center grayscale opacity-20">📡 NO SIGNAL</div>
                        @endforelse
                    </div>
                </div>

                <!-- Priority Command Center (Urgent Tasks) -->
                <div class="space-y-8 md:space-y-12">
                    <div class="bg-[#050B1A] p-8 md:p-12 rounded-[3rem] md:rounded-[4rem] shadow-2xl relative overflow-hidden group">
                        <div class="absolute -right-20 -top-20 w-48 h-48 bg-red-600/10 rounded-full blur-[80px] group-hover:bg-red-600/20 transition-all duration-1000"></div>
                        
                        <div class="flex items-center justify-between mb-12 relative z-10">
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] flex items-center gap-4 italic leading-none">
                                <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                                Urgent Tasks
                            </h3>
                            <span class="px-4 py-1.5 bg-red-600 text-white text-[8px] font-black rounded-lg uppercase tracking-widest italic shadow-lg shadow-red-600/20 leading-none">Priority</span>
                        </div>
                        
                        <div class="space-y-6 relative z-10">
                            <!-- Fleet Audit Directive -->
                            <div class="p-6 md:p-8 bg-white/5 border border-white/10 rounded-[2rem] md:rounded-[2.5rem] group/card hover:bg-white/10 transition-all hover:translate-y-[-4px] hover:shadow-2xl">
                                <div class="flex justify-between items-start mb-8">
                                    <div class="w-10 h-10 bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-white text-xl italic font-black shadow-inner">🛰️</div>
                                    <span class="text-[9px] font-black text-white bg-red-600 px-3 py-1.5 rounded-xl shadow-xl italic leading-none">{{ $stats['pending_cars_count'] }} Req.</span>
                                </div>
                                <h5 class="text-[10px] md:text-[11px] font-black text-white uppercase tracking-[0.2em] mb-3 italic leading-none">Fleet Audit</h5>
                                <p class="text-[8px] md:text-[9px] text-gray-500 font-bold uppercase tracking-widest italic leading-relaxed mb-8">Verify car listings awaiting platform approval.</p>
                                <a href="{{ route('admin.cars.index') }}" class="block w-full text-center py-4 bg-white text-[#050B1A] hover:bg-orange-600 hover:text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-xl transition-all shadow-xl italic leading-none active:scale-95">Review Cars</a>
                            </div>

                            <!-- Identity Audit Directive -->
                            <div class="p-6 md:p-8 bg-white/5 border border-white/10 rounded-[2rem] md:rounded-[2.5rem] group/card hover:bg-white/10 transition-all hover:translate-y-[-4px] hover:shadow-2xl">
                                <div class="flex justify-between items-start mb-8">
                                    <div class="w-10 h-10 bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-white text-xl italic font-black shadow-inner">🆔</div>
                                    <span class="text-[9px] font-black text-[#050B1A] bg-white px-3 py-1.5 rounded-xl shadow-xl italic leading-none">0 Req.</span>
                                </div>
                                <h5 class="text-[10px] md:text-[11px] font-black text-white uppercase tracking-[0.2em] mb-3 italic leading-none">Identity Audit</h5>
                                <p class="text-[8px] md:text-[9px] text-gray-500 font-bold uppercase tracking-widest italic leading-relaxed mb-8">Verify sensitive operator identity documents.</p>
                                <a href="{{ route('admin.verifications.index') }}" class="block w-full text-center py-4 bg-white text-[#050B1A] hover:bg-orange-600 hover:text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-xl transition-all shadow-xl italic leading-none active:scale-95">Verify ID</a>
                            </div>

                            <!-- Conflict Mediation Directive -->
                            <div class="p-6 md:p-8 bg-white/5 border border-white/10 rounded-[2rem] md:rounded-[2.5rem] group/card hover:bg-white/10 transition-all hover:translate-y-[-4px] hover:shadow-2xl">
                                <div class="flex justify-between items-start mb-8">
                                    <div class="w-10 h-10 bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-white text-xl italic font-black shadow-inner">🛡️</div>
                                    <span class="text-[9px] font-black text-white bg-red-600 px-3 py-1.5 rounded-xl shadow-xl italic leading-none">{{ $stats['pending_damages_count'] }} Faults</span>
                                </div>
                                <h5 class="text-[10px] md:text-[11px] font-black text-white uppercase tracking-[0.2em] mb-3 italic leading-none">Conflict Mediation</h5>
                                <p class="text-[8px] md:text-[9px] text-gray-400 font-bold uppercase tracking-widest italic leading-relaxed mb-8">Neutralize active damage disputes and claims.</p>
                                <a href="{{ route('admin.damage-reports.index') }}" class="block w-full text-center py-4 bg-red-600 hover:bg-white hover:text-[#050B1A] text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-xl transition-all shadow-xl italic leading-none active:scale-95">Resolve Hub</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
