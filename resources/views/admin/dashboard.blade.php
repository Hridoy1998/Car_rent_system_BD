<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Governance <span class="text-orange-500">Center</span>
                </h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">
                    CRS BD Institutional Platform Operations Nexus
                </p>
            </div>
            <div class="flex items-center gap-8">
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic leading-none mb-1">System Load</span>
                    <span class="text-blue-900 flex items-center gap-2 text-[11px] font-black uppercase tracking-widest italic">
                        <span class="w-2 h-2 rounded-full bg-blue-900 animate-pulse"></span>
                        Nominal Operations
                    </span>
                </div>
                <div class="h-10 w-px bg-gray-200"></div>
                <div class="bg-[#050B1A] px-6 py-3 rounded-2xl border border-white/10 shadow-xl">
                    <span class="text-white text-[10px] font-black uppercase tracking-[0.2em] italic">Intelligence Grid Online</span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Institutional Hero: Shared Branding Banner -->
    <div class="relative py-16 md:py-28 mb-8 md:mb-12 -mt-12 overflow-hidden rounded-b-[2rem] md:rounded-b-[4rem] group">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110" style="background-image: url('{{ asset('images/assets/admin_nexus_banner.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-3xl" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-orange-500/10 border border-orange-500/20 rounded-xl mb-8 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">Global Sovereignty Nexus</span>
                </div>
                <h1 class="text-4xl md:text-8xl font-black text-white uppercase tracking-tighter italic leading-[0.85]">
                    Governance <br> <span class="text-orange-500">Unification.</span>
                </h1>
                <p class="text-gray-300 font-bold text-xs uppercase tracking-[0.4em] mt-8 italic opacity-80 leading-relaxed max-w-xl">
                    Administering platform integrity with absolute institutional authority and data-driven precision.
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-12 pb-24">
        
        <!-- Strategic Performance Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Revenue Command -->
            <a href="{{ route('admin.bookings.index') }}" class="relative group bg-white border border-gray-100 p-6 md:p-8 lg:p-10 rounded-[2.5rem] md:rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-900/[0.03] rounded-full blur-3xl group-hover:bg-blue-900/5 transition-all duration-700"></div>
                <div class="flex justify-between items-start mb-8 lg:mb-12">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl leading-none">
                        ৳
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-blue-900 uppercase tracking-widest leading-none mb-2 italic">Projected Flow</div>
                         <div class="text-xl font-black text-blue-900 tracking-tighter italic leading-none font-outfit">৳{{ number_format($stats['projected_revenue'] / 1000, 1) }}K</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Total Revenue</h4>
                <div class="text-3xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">৳{{ number_format($stats['settled_revenue']) }}</div>
                <div class="mt-8 flex items-center justify-between">
                    <div class="flex items-center text-emerald-500 text-[9px] font-black uppercase tracking-widest italic leading-none">
                         <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                         Live Ledger
                    </div>
                    <span class="text-gray-300 text-[10px] font-black uppercase tracking-widest italic leading-none">Audit: Nominal</span>
                </div>
            </a>

            <!-- Success Velocity -->
            <div class="relative group bg-white border border-gray-100 p-6 lg:p-10 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-8 lg:mb-12">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl font-outfit leading-none">
                        🛰️
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-2 italic">Success Rate</div>
                         <div class="text-xl font-black text-[#050B1A] tracking-tighter italic uppercase leading-none font-outfit">{{ $stats['success_rate'] }}%</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Total Bookings</h4>
                <div class="text-3xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">{{ number_format($stats['total_bookings']) }}</div>
                <div class="mt-8">
                    <div class="w-full bg-gray-50 h-2 rounded-full overflow-hidden border border-gray-100">
                        <div class="bg-orange-500 h-full rounded-full" style="width: {{ $stats['success_rate'] }}%"></div>
                    </div>
                    <div class="mt-4 flex justify-between text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] italic leading-none">
                        <span>Platform Rate</span>
                        <span class="text-[#050B1A]">{{ $stats['active_bookings'] }} Current</span>
                    </div>
                </div>
            </div>

            <!-- Global Users -->
            <a href="{{ route('admin.users.index') }}" class="relative group bg-white border border-gray-100 p-6 lg:p-10 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-8 lg:mb-12">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl overflow-hidden leading-none">
                        👤
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-red-500 uppercase tracking-widest leading-none mb-2 italic">Restricted</div>
                         <div class="text-xl font-black text-[#050B1A] tracking-tighter italic uppercase leading-none font-outfit">{{ $stats['blocked_users'] }}</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Platform Users</h4>
                <div class="text-3xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">{{ number_format($stats['total_users']) }}</div>
                <div class="mt-8 flex items-center gap-3">
                    <div class="flex -space-x-2">
                        @foreach(range(1, 3) as $i)
                            <div class="w-6 h-6 rounded-lg border-2 border-white bg-gray-100 flex items-center justify-center text-[9px] font-black text-[#050B1A] shadow-sm italic overflow-hidden">U</div>
                        @endforeach
                        <div class="w-6 h-6 rounded-lg border-2 border-white bg-orange-500 flex items-center justify-center text-[7px] font-black text-white shadow-sm italic overflow-hidden">+{{ $stats['velocity_24h']['users'] }}</div>
                    </div>
                    <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic ml-1 leading-none">24H Flow</span>
                </div>
            </a>

            <!-- Fleet Registry -->
            <a href="{{ route('admin.cars.index') }}" class="relative group bg-white border border-gray-100 p-6 lg:p-10 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-8 lg:mb-12">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl font-outfit leading-none">
                        🏎️
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-red-600 uppercase tracking-widest leading-none mb-2 italic">Critical Approval</div>
                         <div class="text-xl font-black text-red-600 tracking-tighter italic uppercase leading-none font-outfit">{{ $stats['pending_cars_count'] }}</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Car Management</h4>
                <div class="text-3xl lg:text-5xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">Phase V</div>
                 <div class="mt-8 flex items-center justify-between">
                     <span class="px-5 py-2 bg-red-600 text-white font-black text-[9px] uppercase tracking-widest rounded-xl italic leading-none shadow-lg shadow-red-500/20">Action Required</span>
                     <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic leading-none font-outfit">+{{ $stats['velocity_24h']['cars'] }} Reg. 24h</span>
                </div>
            </a>
        </div>

        <!-- Operational Intelligence Hub -->
        <div class="space-y-12">
            
            <!-- Strategic Trajectory (Full Width Focused) -->
            <div class="bg-white border border-gray-100 p-6 md:p-12 lg:p-16 rounded-[2.5rem] md:rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-orange-500/[0.02] rounded-full blur-[100px] group-hover:bg-orange-500/[0.05] transition-all duration-1000"></div>
                
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 px-4 gap-8">
                    <div>
                        <h3 class="text-3xl lg:text-4xl font-black text-gray-900 tracking-tighter uppercase italic leading-none flex items-center gap-6">
                            <span class="w-16 h-1.5 bg-orange-500 rounded-full"></span>
                            Yield <span class="text-orange-500">trajectory</span>
                        </h3>
                        <p class="text-[11px] text-gray-400 font-black uppercase tracking-[0.4em] mt-6 italic leading-none">GLOBAL PLATFORM REVENUE ANALYTICS PIPELINE</p>
                    </div>
                    <div class="flex items-center gap-4 bg-[#050B1A] px-8 py-5 rounded-[2rem] border border-white/10 shadow-2xl">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-white text-[11px] font-black uppercase tracking-[0.3em] italic">Intelligence Sync Active</span>
                    </div>
                </div>

                <div class="h-96 flex items-end justify-between gap-4 lg:gap-10 px-10 relative bg-gray-50/40 rounded-[3rem] border border-gray-100 py-12 mb-4">
                    <div class="absolute inset-x-0 bottom-0 h-px bg-gray-200"></div>
                    @php 
                        $maxVal = !empty($stats['monthly_revenue']) ? max($stats['monthly_revenue']) : 0;
                        $maxRev = $maxVal > 0 ? $maxVal : 1; 
                    @endphp
                    @foreach($stats['monthly_revenue'] ?? [] as $month => $sum)
                        <div class="flex-1 flex flex-col items-center group/item relative z-10 h-full justify-end">
                            <div class="text-[10px] text-gray-900 mb-8 font-black uppercase tracking-widest transition-all group-hover/item:text-orange-500 group-hover/item:mb-10 italic leading-none">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                            <div class="w-full bg-orange-500 rounded-t-[2rem] transition-all duration-700 group-hover/item:bg-[#050B1A] group-hover/item:shadow-[0_0_80px_rgba(5,11,26,0.1)] relative overflow-hidden flex flex-col items-center justify-start border border-transparent group-hover/item:border-white/5" 
                                 style="height: {{ ($sum / $maxRev) * 80 }}%">
                                <div class="absolute inset-0 bg-white/20"></div>
                                <div class="absolute -top-16 left-1/2 -translate-x-1/2 bg-[#050B1A] text-[11px] font-black text-white px-6 py-3 rounded-2xl opacity-0 translate-y-4 group-hover/item:opacity-100 group-hover/item:translate-y-0 transition-all scale-75 group-hover/item:scale-100 whitespace-nowrap z-50 shadow-2xl italic border border-white/10 font-outfit">
                                     ৳ {{ number_format($sum) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Operations Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Transaction Ledger (Left 2 Columns) -->
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-[4rem] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.03)] flex flex-col">
                    <div class="p-8 lg:p-12 border-b border-gray-100 flex items-center justify-between gap-6">
                        <h3 class="text-2xl font-black text-gray-900 tracking-tighter uppercase italic leading-none flex items-center gap-6">
                            <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                            Transaction <span class="text-orange-500">Pulse</span>
                        </h3>
                        <a href="{{ route('admin.bookings.index') }}" class="px-8 py-4 bg-[#050B1A] hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl italic whitespace-nowrap group">
                            Audit Feed <span class="inline-block transition-transform group-hover:translate-x-1 ml-1">→</span>
                        </a>
                    </div>
                    <div class="overflow-x-auto p-4 flex-1">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 rounded-2xl">
                                    <th class="px-6 lg:px-10 py-8">Identity record</th>
                                    <th class="px-6 lg:px-10 py-8">Asset</th>
                                    <th class="px-6 lg:px-10 py-8 text-center">Protocol</th>
                                    <th class="px-6 lg:px-10 py-8 text-right font-outfit">Yield</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentBookings as $booking)
                                <tr class="group hover:bg-gray-50/50 transition-all duration-500">
                                    <td class="px-6 lg:px-10 py-10">
                                        <div class="flex items-center space-x-6 min-w-0">
                                            <div class="w-14 h-14 rounded-2xl bg-[#050B1A] border-2 border-white/10 flex items-center justify-center text-sm font-black text-white shadow-2xl overflow-hidden transition-transform duration-700 group-hover:scale-110 italic shrink-0">
                                                @if($booking->customer->profile_photo)
                                                    <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ strtoupper(substr($booking->customer->name, 0, 1)) }}
                                                @endif
                                            </div>
                                            <div class="truncate">
                                                <a href="{{ route('profiles.show', $booking->customer) }}" class="text-[13px] font-black text-[#050B1A] hover:text-orange-500 transition-colors block uppercase tracking-tight italic truncate">{{ $booking->customer->name }}</a>
                                                <div class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest mt-1.5 italic leading-none">Source Identifier</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 lg:px-10 py-10">
                                        <a href="{{ route('cars.show', $booking->car) }}" class="flex flex-col group/car min-w-[120px]">
                                            <span class="text-[11px] font-black text-[#050B1A] tracking-tighter uppercase group-hover/car:text-orange-500 transition-colors italic leading-none mb-1.5">{{ $booking->car->brand }}</span>
                                            <span class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">{{ $booking->car->model }}</span>
                                        </a>
                                    </td>
                                    <td class="px-6 lg:px-10 py-10 text-center">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                'approved' => 'bg-blue-100 text-[#050B1A] border-blue-200',
                                                'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                            ];
                                            $color = $statusColors[$booking->status] ?? $statusColors['pending'];
                                        @endphp
                                        <div class="flex items-center justify-center">
                                            <span class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] italic border shadow-sm {{ $color }}">
                                                {{ $booking->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 lg:px-10 py-10 text-right">
                                        <span class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none font-outfit">৳{{ number_format($booking->total_price) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-10 py-32 text-center pointer-events-none">
                                        <div class="text-5xl grayscale opacity-10 mb-8">🛰️</div>
                                        <div class="text-gray-300 text-[11px] font-black uppercase tracking-[0.5em] italic">NULL ACTIVITY SIGNAL DETECTED</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Priority Command Center (Right 1 Column) -->
                <div class="space-y-12 h-full flex flex-col">
                    <!-- Critical Directives -->
                    <div class="bg-white border border-gray-100 p-8 lg:p-12 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] relative overflow-hidden group flex-1">
                        <div class="absolute -right-10 -top-10 w-48 h-48 bg-red-600/[0.03] rounded-full blur-[80px] group-hover:bg-red-600/5 transition-all duration-700"></div>
                        
                        <div class="flex items-center justify-between mb-12">
                            <h3 class="text-[10px] font-black text-[#050B1A] uppercase tracking-[0.4em] flex items-center gap-4 italic leading-none">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                                Urgent Tasks
                            </h3>
                            <span class="px-4 py-1.5 bg-red-50 text-red-600 text-[9px] font-black rounded-xl uppercase tracking-widest italic border border-red-100 shadow-sm leading-none">Priority</span>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Fleet Audit Card -->
                            <div class="p-6 bg-gray-50 border border-gray-100 rounded-[2.5rem] group/card hover:border-red-500/20 transition-all hover:translate-y-[-4px] hover:bg-white hover:shadow-2xl">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-[#050B1A] shadow-inner font-black text-xl italic group-hover/card:bg-[#050B1A] group-hover/card:text-white transition-all">
                                        🛰️
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] font-black text-white bg-[#050B1A] px-3 py-1.5 rounded-xl shadow-lg italic leading-none">{{ $stats['pending_cars_count'] }} Requests</span>
                                    </div>
                                </div>
                                <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-[0.2em] mb-2 italic leading-none font-outfit">Car Approval</h5>
                                <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic leading-relaxed mb-6">Review car listings awaiting platform approval.</p>
                                <a href="{{ route('admin.cars.index') }}" class="block w-full text-center py-3 bg-[#050B1A] hover:bg-red-600 text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-xl transition-all shadow-xl italic leading-none">Review Cars</a>
                            </div>

                            <!-- Identity Audit Card -->
                            <div class="p-6 bg-gray-50 border border-gray-100 rounded-[2.5rem] group/card hover:border-orange-500/20 transition-all hover:translate-y-[-4px] hover:bg-white hover:shadow-2xl">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-orange-500 shadow-inner font-black text-xl italic group-hover/card:bg-orange-500 group-hover/card:text-white transition-all">
                                        🆔
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] font-black text-white bg-orange-500 px-3 py-1.5 rounded-xl shadow-lg italic leading-none">0% Requests</span>
                                    </div>
                                </div>
                                <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-[0.2em] mb-2 italic leading-none font-outfit">User Verification</h5>
                                <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic leading-relaxed mb-6">Verify identity documents for new users.</p>
                                <a href="{{ route('admin.verifications.index') }}" class="block w-full text-center py-3 bg-orange-500 hover:bg-[#050B1A] text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-xl transition-all shadow-xl italic leading-none">Verify Users</a>
                            </div>

                            <!-- Damage Dispute Card -->
                            <div class="p-6 bg-gray-50 border border-gray-100 rounded-[2.5rem] group/card hover:border-red-500/20 transition-all hover:translate-y-[-4px] hover:bg-white hover:shadow-2xl">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-red-600 shadow-inner font-black text-xl italic group-hover/card:bg-red-600 group-hover/card:text-white transition-all">
                                        🛡️
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] font-black text-white bg-red-600 px-3 py-1.5 rounded-xl shadow-lg italic leading-none">{{ $stats['pending_damages_count'] }} Breaches</span>
                                    </div>
                                </div>
                                <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-[0.2em] mb-2 italic leading-none font-outfit">Damage Disputes</h5>
                                <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic leading-relaxed mb-6">Resolve active damage claims between owners and renters.</p>
                                <a href="{{ route('admin.damage-reports.index') }}" class="block w-full text-center py-3 bg-red-600 hover:bg-[#050B1A] text-white text-[9px] font-black uppercase tracking-[0.3em] rounded-xl transition-all shadow-xl italic leading-none">Resolve Issues</a>
                            </div>
                        </div>
                    </div>

                    <!-- System Vitality -->
                    <div class="bg-white border border-gray-100 p-8 lg:p-12 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-48 h-48 bg-blue-600/[0.03] rounded-full blur-[80px] group-hover:bg-blue-600/5 transition-all duration-700"></div>
                        
                        <div class="flex items-center justify-between mb-10">
                            <h3 class="text-[10px] font-black text-[#050B1A] uppercase tracking-[0.4em] flex items-center gap-4 italic leading-none">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-900"></span>
                                System Settings
                            </h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Commission %</span>
                                <span class="text-xs font-black text-[#050B1A] italic leading-none font-outfit">10.0%</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Payout Period</span>
                                <span class="text-xs font-black text-[#050B1A] italic leading-none font-outfit uppercase">Instant</span>
                            </div>
                            
                            <a href="{{ route('admin.settings.index') }}" class="flex items-center justify-center gap-4 p-6 bg-[#050B1A] hover:bg-orange-500 text-white font-black text-[9px] uppercase tracking-[0.4em] rounded-[1.5rem] transition-all shadow-xl italic group mt-4 leading-none">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-180 duration-1000" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                Manage Registry
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
   </div>
</x-app-layout>
