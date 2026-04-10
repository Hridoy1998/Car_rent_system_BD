<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase italic">
                    {{ __('Owner Dashboard') }}
                </h2>
                <p class="text-[10px] text-emerald-400 font-black uppercase tracking-[0.3em] mt-1 italic">Earnings & Fleet Overview</p>
            </div>
            <div class="flex items-center space-x-6">
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Earnings Pulse</span>
                    <div class="flex gap-1 mt-1">
                        <div class="w-1 h-3 bg-emerald-500 rounded-full animate-bounce"></div>
                        <div class="w-1 h-3 bg-emerald-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-1 h-3 bg-indigo-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
                <div class="h-10 w-px bg-white/5"></div>
                <div class="flex items-center space-x-3">
                    <span class="text-white text-[10px] font-black uppercase tracking-widest">Status:</span>
                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest">Online</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <!-- Strategic Glows -->
        <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-emerald-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[120px] -z-10 animate-pulse" style="animation-duration: 4s"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Core Strategic Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Liquidity Pulse -->
                <div class="relative group bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl transition-all hover:bg-gray-900/60 overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 text-emerald-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-emerald-500 uppercase tracking-widest leading-none mb-1">+24h Δ</div>
                             <div class="text-lg font-black text-white">৳ {{ number_format($stats['revenue_24h']) }}</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Total Earnings</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">৳ {{ number_format($stats['total_earnings']) }}</div>
                    <div class="mt-4 flex items-center justify-between text-[8px] font-black text-gray-600 uppercase tracking-widest">
                         <span>Net Balance</span>
                         <a href="{{ route('owner.finance.index') }}" class="text-emerald-400 hover:text-white transition-colors">Details →</a>
                    </div>
                </div>

                <!-- Active Bookings -->
                <div class="relative group bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl transition-all overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-indigo-500/10 rounded-2xl border border-indigo-500/20 text-indigo-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-indigo-400 uppercase tracking-widest mb-1">Current</div>
                             <div class="text-lg font-black text-white">{{ $stats['active_bookings'] }} Bookings</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Trip Status</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">IN PROGRESS</div>
                    <div class="mt-4">
                        <div class="w-full bg-indigo-500/10 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)] animate-pulse" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                <!-- Fleet Readiness -->
                <div class="relative group bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl transition-all overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-purple-500/10 rounded-2xl border border-purple-500/20 text-purple-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-amber-500 uppercase tracking-widest mb-1">Pending</div>
                             <div class="text-lg font-black text-white">{{ $stats['pending_cars'] }} Units</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Car Inventory</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">{{ $stats['approved_cars'] }} APPROVED</div>
                    <div class="mt-4 flex items-center justify-between text-[8px] font-black text-gray-600 uppercase tracking-widest">
                         <span>Status: Active</span>
                         <a href="{{ route('owner.cars.index') }}" class="text-purple-400">Details →</a>
                    </div>
                </div>

                <!-- Damage Disputes -->
                <div class="relative group bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl transition-all overflow-hidden {{ $stats['pending_damages'] > 0 ? 'border-red-500/20' : '' }}">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-red-500/5 rounded-full blur-3xl group-hover:bg-red-500/10 transition-all"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-red-500/10 rounded-2xl border border-red-500/20 text-red-500">
                            <svg class="w-6 h-6 {{ $stats['pending_damages'] > 0 ? 'animate-pulse' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-red-500 uppercase tracking-widest mb-1">Claims</div>
                             <div class="text-lg font-black text-white">{{ $stats['pending_damages'] }} Alerts</div>
                        </div>
                    </div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Damage Status</h4>
                    <div class="text-3xl font-black text-white tracking-tighter">{{ $stats['pending_damages'] > 0 ? 'CLAIM' : 'SECURE' }}</div>
                    <div class="mt-4 text-[8px] font-black text-gray-600 uppercase tracking-widest">
                         {{ $stats['pending_damages'] > 0 ? 'Action required on damage claims' : 'No active damage claims' }}
                    </div>
                </div>

            </div>

            <!-- Intelligence Hub -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Action Queue (The Marshaling Protocol) -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="flex items-center justify-between px-4">
                        <h3 class="text-xl font-black text-white italic tracking-tight flex items-center gap-3">
                            <span class="p-1.5 bg-indigo-500 rounded-lg shadow-[0_0_15px_rgba(99,102,241,0.3)]"></span>
                            ACTION REQUIRED
                        </h3>
                        <a href="{{ route('owner.bookings.index') }}" class="text-[10px] font-black text-indigo-400 bg-indigo-500/5 hover:bg-indigo-500 hover:text-white px-5 py-2.5 rounded-2xl border border-indigo-500/10 transition-all uppercase tracking-widest">View All Bookings →</a>
                    </div>

                    <livewire:owner-action-queue />
                </div>

                <!-- Strategic Insights (Side Panel) -->
                <div class="space-y-10">
                    
                    <!-- Yield Trajectory -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                         <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl -z-10 group-hover:bg-emerald-500/10 transition-all"></div>
                         <h3 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-10 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                            Revenue Delta
                         </h3>
                         
                         <div class="h-40 flex items-end justify-between gap-1.5 px-2">
                            @php $maxEarn = !empty($stats['monthly_earnings']) && max($stats['monthly_earnings']) > 0 ? max($stats['monthly_earnings']) : 1; @endphp
                            @foreach($stats['monthly_earnings'] ?? [] as $month => $sum)
                                <div class="flex-1 flex flex-col items-center group/bar relative h-full">
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-950 border border-white/10 text-[8px] font-bold text-white px-2 py-1 rounded-lg opacity-0 group-bar/bar:opacity-100 transition-all scale-75 group-bar/bar:scale-100 whitespace-nowrap z-20 shadow-xl">৳{{ number_format($sum) }}</div>
                                    <div class="w-full bg-emerald-500/10 rounded-t-lg transition-all duration-700 group-bar/bar:bg-emerald-500 group-bar/bar:shadow-[0_0_15px_rgba(16,185,129,0.4)] relative mt-auto" 
                                        style="height: {{ ($sum / $maxEarn) * 100 }}%">
                                    </div>
                                    <div class="text-[7px] text-gray-700 mt-2 font-black uppercase">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                                </div>
                            @endforeach
                            @if(empty($stats['monthly_earnings']))
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-700 text-[10px] font-black uppercase tracking-[0.2em] italic opacity-20">No data available</div>
                            @endif
                        </div>
                    </div>

                    <!-- Fleet High-Velocity Overlook -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl space-y-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-black text-white uppercase tracking-[0.2em]">Your Fleet</h3>
                            <a href="{{ route('owner.cars.index') }}" class="text-[9px] text-gray-500 hover:text-white transition-colors uppercase font-black tracking-widest">Manage All →</a>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($recentCars as $car)
                            <div class="flex items-center justify-between p-4 bg-gray-950/50 hover:bg-white/[0.02] border border-white/5 rounded-3xl transition-all group">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl bg-gray-900 border border-white/10 overflow-hidden relative shadow-lg">
                                        <img src="{{ $car->primary_image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @if($car->status === 'pending')
                                            <div class="absolute inset-0 bg-amber-500/10 backdrop-blur-[2px]"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-gray-200 uppercase tracking-tight group-hover:text-emerald-400 transition-colors">{{ $car->brand }} {{ $car->model }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $car->status === 'approved' ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' }} shadow-[0_0_5px_currentColor]"></span>
                                            <span class="text-[8px] text-gray-600 font-bold uppercase tracking-widest">{{ $car->status }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('owner.cars.edit', $car) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-600 hover:text-white rounded-xl border border-white/5 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                            </div>
                            @empty
                            <div class="py-10 text-center text-gray-700 text-[9px] font-black uppercase tracking-[0.3em] italic opacity-20">Register your first car</div>
                            @endforelse
                        </div>

                        <a href="{{ route('owner.cars.create') }}" class="flex items-center justify-center gap-3 p-5 bg-emerald-600 hover:bg-emerald-500 text-white font-black text-[10px] uppercase tracking-widest rounded-3xl shadow-xl shadow-emerald-500/20 transition-all hover:scale-[1.02]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Add New Car
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
