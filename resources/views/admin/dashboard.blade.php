<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-6">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter">
                    {{ __('Admin Dashboard') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-black uppercase tracking-[0.3em] mt-1">Management Overview</p>
            </div>
            <div class="flex items-center space-x-4 md:space-x-6">
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Platform Activity</span>
                    <div class="flex gap-1 mt-1">
                        <div class="w-1 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                        <div class="w-1 h-3 bg-emerald-500 rounded-full animate-pulse" style="animation-delay: 0.1s"></div>
                        <div class="w-1 h-3 bg-indigo-500 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
                <div class="h-10 w-px bg-white/5"></div>
                <div class="flex items-center space-x-3">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                    </span>
                    <span class="text-white text-xs font-black uppercase tracking-widest">LIVE STATUS</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <!-- Master Glows -->
        <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[120px] -z-10 animate-pulse" style="animation-duration: 4s"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Strategic Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Revenue Command Card -->
                <a href="{{ route('admin.bookings.index') }}" class="relative group bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-8 rounded-[2rem] shadow-2xl transition-all hover:scale-[1.02] hover:bg-gray-900/60 overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-emerald-500 uppercase tracking-widest leading-none mb-1">Projected</div>
                             <div class="text-lg font-black text-white">৳ {{ number_format($stats['projected_revenue'] / 1000, 1) }}K</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Total Revenue</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">৳ {{ number_format($stats['settled_revenue']) }}</div>
                    <div class="mt-4 flex items-center justify-between text-[10px] font-bold">
                        <div class="flex items-center text-emerald-500">
                             <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                             Live Ledger
                        </div>
                        <span class="text-gray-600">Audit Status: Nominal</span>
                    </div>
                </a>

                <!-- Success Velocity Card -->
                <div class="relative group bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-8 rounded-[2rem] shadow-2xl transition-all overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-indigo-500/10 rounded-2xl border border-indigo-500/20 text-indigo-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-indigo-400 uppercase tracking-widest leading-none mb-1">Success Rate</div>
                             <div class="text-lg font-black text-white">{{ $stats['success_rate'] }}%</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Total Bookings</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">{{ number_format($stats['total_bookings']) }}</div>
                    <div class="mt-4">
                        <div class="w-full bg-indigo-500/10 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)]" style="width: {{ $stats['success_rate'] }}%"></div>
                        </div>
                        <div class="mt-2 flex justify-between text-[8px] font-black text-gray-600 uppercase tracking-widest">
                            <span>Platform Rate</span>
                            <span class="text-indigo-400">{{ $stats['active_bookings'] }} Current</span>
                        </div>
                    </div>
                </div>

                <!-- Identity Governance Card -->
                <a href="{{ route('admin.users.index') }}" class="relative group bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-8 rounded-[2rem] shadow-2xl transition-all hover:scale-[1.02] hover:bg-gray-900/60 overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-blue-500/10 rounded-2xl border border-blue-500/20 text-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-red-500 uppercase tracking-widest leading-none mb-1">Restricted</div>
                             <div class="text-lg font-black text-white">{{ $stats['blocked_users'] }}</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Platform Users</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">{{ number_format($stats['total_users']) }}</div>
                    <div class="mt-4 flex items-center space-x-2">
                        <div class="flex -space-x-2">
                            @foreach(range(1, 3) as $i)
                                <div class="w-5 h-5 rounded-full border border-gray-950 bg-gray-800 flex items-center justify-center text-[6px] font-bold text-gray-600">P</div>
                            @endforeach
                        </div>
                        <span class="text-[9px] font-black text-blue-500 uppercase tracking-tighter">+{{ $stats['velocity_24h']['users'] }} New 24h</span>
                    </div>
                </a>

                <!-- Fleet Asset Guard Card -->
                <a href="{{ route('admin.cars.index') }}" class="relative group bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-8 rounded-[2rem] shadow-2xl transition-all hover:scale-[1.02] hover:bg-gray-900/60 overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-purple-500/10 rounded-2xl border border-purple-500/20 text-purple-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-amber-500 uppercase tracking-widest leading-none mb-1">Critical Approval</div>
                             <div class="text-lg font-black text-white">{{ $stats['pending_cars_count'] }}</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Car Management</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">PHASE V</div>
                     <div class="mt-4 flex items-center justify-between">
                         <span class="px-3 py-1 bg-purple-600 text-white font-black text-[8px] uppercase tracking-widest rounded-lg animate-pulse">Action Required</span>
                         <span class="text-[9px] font-bold text-gray-600 uppercase tracking-widest">+{{ $stats['velocity_24h']['cars'] }} Reg. 24h</span>
                    </div>
                </a>

            </div>

            <!-- Dashboard Analytics & Intelligence -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Main Intelligence Hub -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Performance Charts -->
                    <div class="bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                         <div class="flex items-center justify-between mb-12">
                            <div>
                                <h3 class="text-2xl font-black text-white tracking-tight">Revenue Trend</h3>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest mt-1">Monthly platform revenue growth</p>
                            </div>
                            <div class="flex items-center space-x-2 text-[10px] font-black text-indigo-400 bg-indigo-500/10 px-4 py-2 rounded-xl border border-indigo-500/20 uppercase tracking-widest">
                                <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]"></span>
                                Live Feed
                            </div>
                        </div>

                        <div class="h-64 flex items-end justify-between gap-4 px-4 relative">
                            <!-- Horizontal Grid Lines -->
                             <div class="absolute inset-x-0 bottom-0 h-px bg-white/5"></div>
                             <div class="absolute inset-x-0 top-1/4 h-px bg-white/5"></div>
                             <div class="absolute inset-x-0 top-1/2 h-px bg-white/5 text-[8px] text-gray-800 font-black pl-2 pt-1 uppercase">Midway Threshold</div>
                             <div class="absolute inset-x-0 top-3/4 h-px bg-white/5"></div>

                            @php 
                                $maxVal = !empty($stats['monthly_revenue']) ? max($stats['monthly_revenue']) : 0;
                                $maxRev = $maxVal > 0 ? $maxVal : 1; 
                            @endphp
                            @foreach($stats['monthly_revenue'] ?? [] as $month => $sum)
                                <div class="flex-1 flex flex-col items-center group relative z-10 h-full justify-end">
                                    <div class="text-[10px] text-gray-600 mb-4 font-black uppercase tracking-widest transition-colors group-hover:text-indigo-400">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                                    <div class="w-full bg-gradient-to-t from-indigo-600/20 to-indigo-500/60 rounded-t-2xl transition-all duration-1000 group-hover:from-indigo-600/40 group-hover:to-indigo-400 group-hover:shadow-[0_0_30px_rgba(99,102,241,0.3)] relative" 
                                         style="height: {{ ($sum / $maxRev) * 80 }}%">
                                        <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-gray-950 border border-white/10 text-[10px] font-black text-white px-3 py-2 rounded-xl opacity-0 group-hover:opacity-100 transition-all scale-75 group-hover:scale-100 whitespace-nowrap z-20 shadow-2xl">
                                            <div class="text-indigo-400 text-[8px] uppercase mb-1">Gross Revenue</div>
                                            ৳ {{ number_format($sum) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if(empty($stats['monthly_revenue']))
                                <div class="absolute inset-0 flex items-center justify-center text-gray-700 text-[11px] font-black uppercase tracking-[0.4em] italic">No Financial Signal Detected</div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity Ledger -->
                    <div class="bg-gray-900/40 backdrop-blur-2xl border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl">
                        <div class="p-8 border-b border-white/5 flex items-center justify-between">
                            <h3 class="text-xl font-black text-white tracking-tight italic flex items-center gap-3">
                                <span class="p-1.5 bg-yellow-500 rounded-lg shadow-[0_0_15px_rgba(245,158,11,0.3)]"></span>
                                TRANSACTION PULSE
                            </h3>
                            <a href="{{ route('admin.bookings.index') }}" class="text-[10px] font-black text-indigo-400 bg-indigo-500/5 hover:bg-indigo-500 hover:text-white px-5 py-2.5 rounded-2xl border border-indigo-500/10 transition-all uppercase tracking-widest">Full Ledger →</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/[0.02]">
                                    <tr class="text-[9px] font-black text-gray-600 uppercase tracking-widest">
                                        <th class="px-8 py-5">Customer</th>
                                        <th class="px-8 py-5">Car</th>
                                        <th class="px-8 py-5">Booking Status</th>
                                        <th class="px-8 py-5 text-right">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @forelse($recentBookings as $booking)
                                    <tr class="group hover:bg-white/[0.02] transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-gray-800 to-gray-900 border border-white/10 flex items-center justify-center text-xs font-black text-indigo-400 shadow-xl overflow-hidden group-hover:scale-110 transition-transform">
                                                    @if($booking->customer->profile_photo)
                                                        <img src="{{ Storage::url($booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                                                    @else
                                                        {{ strtoupper(substr($booking->customer->name, 0, 1)) }}
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('profiles.show', $booking->customer) }}" class="text-xs font-black text-gray-200 hover:text-indigo-400 transition-colors block uppercase tracking-tight">{{ $booking->customer->name }}</a>
                                                    <div class="text-[9px] text-gray-600 font-bold">ID: #{{ $booking->customer_id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <a href="{{ route('cars.show', $booking->car) }}" class="flex flex-col hover:group/car transition-colors">
                                                <span class="text-xs font-bold text-white tracking-widest uppercase group-hover/car:text-indigo-400">{{ $booking->car->brand }}</span>
                                                <span class="text-[9px] text-gray-600 font-black uppercase">{{ $booking->car->model }}</span>
                                            </a>
                                        </td>
                                        <td class="px-8 py-6">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                                    'approved' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                                    'completed' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                                    'cancelled' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                                ];
                                                $color = $statusColors[$booking->status] ?? $statusColors['pending'];
                                            @endphp
                                            <div class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full {{ explode(' ', $color)[1] }} animate-pulse shadow-[0_0_8px_currentColor]"></span>
                                                <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $color }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <span class="text-sm font-black text-white italic tracking-tighter shadow-indigo-500/20 shadow-xl transition-all group-hover:text-indigo-400">৳ {{ number_format($booking->total_price) }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-20 text-center text-gray-600 text-xs font-black uppercase tracking-[0.4em] italic opacity-20">No recent activity</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Side Command Panel -->
                <div class="space-y-10">
                    
                    <!-- Critical Action Queue -->
                    <div class="bg-gray-900/40 backdrop-blur-2xl border border-indigo-500/10 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-[60px] -z-10"></div>
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-sm font-black text-white uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]"></span>
                                URGENT TASKS
                            </h3>
                            <span class="px-2 py-0.5 bg-red-500 text-white text-[8px] font-black rounded-md animate-bounce">Priority</span>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Fleet Audit Request -->
                            <div class="p-6 bg-gray-950/50 border border-white/5 rounded-3xl group hover:border-indigo-500/30 transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-2 bg-indigo-500/10 rounded-xl text-indigo-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-white bg-indigo-600 px-2 py-0.5 rounded-lg">{{ $stats['pending_cars_count'] }} Requests</span>
                                </div>
                                <h5 class="text-xs font-black text-gray-200 uppercase tracking-widest mb-1">Car Approval</h5>
                                <p class="text-[9px] text-gray-500 font-bold uppercase leading-relaxed mb-4">Review car listings awaiting platform approval.</p>
                                <a href="{{ route('admin.cars.index') }}" class="block w-full text-center py-2.5 bg-indigo-600/10 hover:bg-indigo-600 text-indigo-400 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-xl border border-indigo-500/20 transition-all">Review Cars</a>
                            </div>

                            <!-- Verification Requests -->
                            <div class="p-6 bg-gray-950/50 border border-white/5 rounded-3xl group hover:border-purple-500/30 transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-2 bg-purple-500/10 rounded-xl text-purple-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-white bg-purple-600 px-2 py-0.5 rounded-lg">{{ $stats['pending_verifications_count'] }} IDs</span>
                                </div>
                                <h5 class="text-xs font-black text-gray-200 uppercase tracking-widest mb-1">User Verification</h5>
                                <p class="text-[9px] text-gray-500 font-bold uppercase leading-relaxed mb-4">Verify identity documents for new users.</p>
                                <a href="{{ route('admin.verifications.index') }}" class="block w-full text-center py-2.5 bg-purple-600/10 hover:bg-purple-600 text-purple-400 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-xl border border-purple-500/20 transition-all">Verify Users</a>
                            </div>

                            <!-- Damage Dispute Resolution (MEDIATION) -->
                            <div class="p-6 bg-red-950/20 border-2 border-red-500/30 rounded-3xl group hover:border-red-500/60 transition-all shadow-[0_0_30px_rgba(239,68,68,0.15)] relative overflow-hidden">
                                <div class="absolute -right-4 -top-4 w-20 h-20 bg-red-500/10 rounded-full blur-2xl group-hover:bg-red-500/20 transition-all"></div>
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-2 bg-red-500/20 rounded-xl text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-white bg-red-600 px-2 py-0.5 rounded-lg shadow-lg">{{ $stats['pending_damages_count'] }} Breaches</span>
                                </div>
                                <h5 class="text-xs font-black text-white uppercase tracking-widest mb-1 font-italic flex items-center gap-2">
                                     <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span>
                                     Damage Disputes
                                </h5>
                                <p class="text-[9px] text-red-400 font-bold uppercase leading-relaxed mb-4">Resolve active damage claims between owners and renters.</p>
                                <a href="{{ route('admin.damage-reports.index') }}" class="block w-full text-center py-2.5 bg-red-600 hover:bg-red-500 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-red-600/20">Resolve Issues</a>
                            </div>
                        </div>
                    </div>

                    <!-- Platform Settings Quickview -->
                     <div class="bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl">
                         <h3 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            System Settings
                        </h3>
                        <div class="space-y-6">
                            <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest p-4 bg-gray-950/50 rounded-2xl border border-white/5">
                                <span class="text-gray-500">Commission %</span>
                                <span class="text-white">10.0%</span>
                            </div>
                             <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest p-4 bg-gray-950/50 rounded-2xl border border-white/5">
                                <span class="text-gray-500">Payout Period</span>
                                <span class="text-white">Instant</span>
                            </div>
                            <a href="{{ route('admin.settings.index') }}" class="block w-full text-center py-4 bg-indigo-600/10 hover:bg-indigo-600 text-indigo-400 hover:text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl border border-indigo-500/20 transition-all shadow-xl shadow-indigo-600/10">Manage Registry</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
