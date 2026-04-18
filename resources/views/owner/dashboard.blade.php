<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Fleet <span class="text-orange-500">Command</span>
                </h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">
                    CRS BD Institutional Fleet Operations Center
                </p>
            </div>
            <div class="flex items-center gap-8">
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic leading-none mb-1">Fleet Pulse</span>
                    <span class="text-emerald-500 flex items-center gap-2 text-[11px] font-black uppercase tracking-widest italic">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Operational
                    </span>
                </div>
                <div class="h-10 w-px bg-gray-200"></div>
                <div class="bg-[#050B1A] px-6 py-3 rounded-2xl border border-white/10 shadow-xl">
                    <span class="text-white text-[10px] font-black uppercase tracking-[0.2em] italic">Session Secured</span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Institutional Hero: Shared Branding Banner -->
    <div class="relative py-16 md:py-24 mb-8 md:mb-12 -mt-12 overflow-hidden rounded-b-[2rem] md:rounded-b-[4rem] group">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110" style="background-image: url('{{ asset('images/assets/owner_command_banner.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-orange-500/10 border border-orange-500/20 rounded-xl mb-6 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">Strategic Asset Management</span>
                </div>
                <h1 class="text-4xl md:text-7xl font-black text-white uppercase tracking-tighter italic leading-[0.9]">
                    Command <br> <span class="text-orange-500">The Fleet.</span>
                </h1>
                <p class="text-gray-300 font-bold text-xs uppercase tracking-[0.3em] mt-6 italic opacity-80 leading-relaxed max-w-md">
                    Orchestrating elite automotive deployments with institutional precision and maximum yield optimization.
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-12 pb-24">
        
        <!-- Strategic Core Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Liquidity Pulse -->
            <div class="relative group bg-white border border-gray-100 p-6 md:p-8 lg:p-10 rounded-[2.5rem] md:rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-900/[0.03] rounded-full blur-3xl group-hover:bg-blue-900/5 transition-all duration-700"></div>
                <div class="flex justify-between items-start mb-8 lg:mb-10">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl">
                        ৳
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-2 italic">24H Δ Signal</div>
                         <div class="text-xl font-black text-emerald-500 tracking-tighter italic leading-none">+৳{{ number_format($stats['revenue_24h']) }}</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Gross Yield</h4>
                <div class="text-3xl lg:text-4xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">৳{{ number_format($stats['total_earnings']) }}</div>
                <div class="mt-8 flex items-center justify-between">
                     <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Net Liquidity</span>
                     <a href="{{ route('owner.finance.index') }}" class="px-5 py-2 bg-[#050B1A] hover:bg-orange-500 text-white text-[9px] font-black uppercase tracking-widest italic rounded-xl transition-all shadow-lg leading-none">Audit →</a>
                </div>
            </div>

            <!-- Operational Deployment -->
            <div class="relative group bg-white border border-gray-100 p-6 lg:p-10 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden font-outfit">
                <div class="flex justify-between items-start mb-8 lg:mb-10">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl">
                        🛰️
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic leading-none">Active Load</div>
                         <div class="text-xl font-black text-[#050B1A] tracking-tighter italic uppercase leading-none">{{ $stats['active_bookings'] }} Missions</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Deployment Phase</h4>
                <div class="text-3xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none">Operations</div>
                <div class="mt-8">
                    <div class="w-full bg-gray-50 h-2 rounded-full overflow-hidden border border-gray-100">
                        <div class="bg-orange-500 h-full rounded-full animate-pulse" style="width: 75%"></div>
                    </div>
                </div>
            </div>

            <!-- Fleet Inventory -->
            <div class="relative group bg-white border border-gray-100 p-6 lg:p-10 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden">
                <div class="flex justify-between items-start mb-8 lg:mb-10">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl">
                        🏎️
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic leading-none">Registry Status</div>
                         <div class="text-xl font-black text-orange-500 tracking-tighter italic uppercase leading-none">{{ $stats['pending_cars'] }} Pending</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Total Units</h4>
                <div class="text-3xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">{{ $stats['approved_cars'] }} Active</div>
                <div class="mt-8 flex items-center justify-between">
                     <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Inventory High</span>
                     <a href="{{ route('owner.cars.index') }}" class="px-5 py-2 bg-gray-900 border border-gray-100 hover:bg-[#050B1A] text-white text-[9px] font-black uppercase tracking-widest italic rounded-xl transition-all shadow-lg leading-none">Audit →</a>
                </div>
            </div>

            <!-- Integrity Alert -->
            <div class="relative group bg-white border border-gray-100 p-6 lg:p-10 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden {{ $stats['pending_damages'] > 0 ? 'border-red-500/20 shadow-red-500/5' : '' }}">
                <div class="flex justify-between items-start mb-8 lg:mb-10">
                    <div class="w-14 h-14 lg:w-16 lg:h-16 {{ $stats['pending_damages'] > 0 ? 'bg-red-600 shadow-red-600/20' : 'bg-emerald-500 shadow-emerald-500/20' }} rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl">
                        🛡️
                    </div>
                    <div class="text-right">
                         <div class="text-[9px] font-black {{ $stats['pending_damages'] > 0 ? 'text-red-500' : 'text-emerald-500' }} uppercase tracking-widest mb-2 italic leading-none">Alert Status</div>
                         <div class="text-xl font-black text-[#050B1A] tracking-tighter italic uppercase leading-none">{{ $stats['pending_damages'] > 0 ? $stats['pending_damages'] . ' Breaches' : 'Null Signal' }}</div>
                    </div>
                </div>
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2 italic leading-none">Integrity Monitor</h4>
                <div class="text-3xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none font-outfit">{{ $stats['pending_damages'] > 0 ? 'Breach' : 'Secure' }}</div>
                <div class="mt-8 text-[8px] font-black text-gray-400 uppercase tracking-widest italic leading-tight group-hover:text-[#050B1A] transition-colors">
                     {{ $stats['pending_damages'] > 0 ? 'PROTOCOL BREACH DETECTED - AUDIT REQUIRED' : 'NO ACTIVE FLEET INTEGRITY ISSUES' }}
                </div>
            </div>

        </div>

        <!-- Operational Intelligence Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Marshaling Terminal (Left/Center) -->
            <div class="lg:col-span-2 space-y-12">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 px-6">
                    <h3 class="text-2xl font-black text-gray-900 italic tracking-tighter uppercase leading-none flex items-center gap-6">
                        <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                        Active <span class="text-orange-500">Marshaling</span>
                    </h3>
                    <a href="{{ route('owner.bookings.index') }}" class="px-8 py-4 bg-[#050B1A] hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-xl italic group whitespace-nowrap">Full Operations Ledger <span class="inline-block transition-transform group-hover:translate-x-1 ml-1">→</span></a>
                </div>

                <div class="bg-white border border-gray-100 p-2 lg:p-4 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] overflow-hidden min-h-[500px]">
                    <livewire:owner-action-queue />
                </div>
            </div>

            <!-- Strategic Insights (Right) -->
            <div class="space-y-12">
                
                <!-- Yield Pulse Chart -->
                <div class="bg-[#050B1A] p-8 lg:p-12 rounded-[3.5rem] shadow-2xl shadow-blue-900/20 relative overflow-hidden group h-[400px] flex flex-col">
                     <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/[0.03] rounded-full blur-[80px] group-hover:bg-white/[0.05] transition-all duration-700"></div>
                     <h3 class="text-[10px] font-black text-white/40 uppercase tracking-[0.4em] mb-12 flex items-center gap-4 italic leading-none shrink-0">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                        Yield Trajectory
                     </h3>
                     
                     <div class="h-48 flex items-end justify-between gap-4 px-4 overflow-hidden flex-1 relative">
                         <div class="absolute inset-x-0 bottom-0 h-px bg-white/5"></div>
                        @php $maxEarn = !empty($stats['monthly_earnings']) && max($stats['monthly_earnings']) > 0 ? max($stats['monthly_earnings']) : 1; @endphp
                        @foreach($stats['monthly_earnings'] ?? [] as $month => $sum)
                            <div class="flex-1 flex flex-col items-center group/bar relative h-full justify-end">
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-white text-[9px] font-black text-[#050B1A] px-4 py-2 rounded-xl opacity-0 translate-y-4 group-hover/bar:opacity-100 group-hover/bar:translate-y-0 transition-all scale-75 group-hover/bar:scale-100 whitespace-nowrap z-50 shadow-2xl italic border border-white/10 uppercase font-outfit">৳{{ number_format($sum) }}</div>
                                <div class="w-full bg-white/5 rounded-t-2xl transition-all duration-700 group-hover/bar:bg-orange-500 group-hover/bar:shadow-[0_0_40px_rgba(255,107,0,0.4)] relative mt-auto" 
                                    style="height: {{ ($sum / $maxEarn) * 100 }}%">
                                    <div class="absolute inset-0 bg-gradient-to-b from-white/10 to-transparent"></div>
                                </div>
                                <div class="text-[8px] text-white/30 mt-6 font-black uppercase tracking-widest italic leading-none">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                            </div>
                        @endforeach
                        @if(empty($stats['monthly_earnings']))
                            <div class="w-full h-full flex flex-col items-center justify-center text-white/10 text-[10px] font-black uppercase tracking-[0.5em] italic">NULL FISCAL SIGNAL</div>
                        @endif
                    </div>
                </div>

                <!-- Portfolio Registry -->
                <div class="bg-white border border-gray-100 p-8 lg:p-12 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] space-y-10">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.4em] italic leading-none">Fleet Registry</h3>
                        <a href="{{ route('owner.cars.index') }}" class="text-[9px] text-orange-500 hover:text-[#050B1A] transition-colors uppercase font-black tracking-widest italic leading-none">Full Audit →</a>
                    </div>
                    
                    <div class="space-y-6">
                        @forelse($recentCars as $car)
                        <div class="flex items-center justify-between p-6 bg-gray-50/50 hover:bg-white border border-gray-100 rounded-[2.5rem] transition-all group hover:shadow-xl hover:translate-y-[-4px]">
                            <div class="flex items-center space-x-6 min-w-0">
                                <div class="w-14 h-14 lg:w-16 lg:h-16 rounded-2xl bg-gray-100 border border-gray-100 overflow-hidden relative shadow-inner shrink-0">
                                    <img src="{{ $car->primary_image_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-tr from-[#050B1A]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] lg:text-[12px] font-black text-[#050B1A] uppercase tracking-tight group-hover:text-orange-500 transition-colors italic truncate leading-none mb-2 font-outfit">{{ $car->brand }} {{ $car->model }}</p>
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $car->status === 'approved' ? 'bg-emerald-500' : 'bg-orange-500' }} shadow-[0_0_10px_rgba(0,0,0,0.1)]"></span>
                                        <span class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic leading-none">{{ $car->status }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('owner.cars.edit', $car) }}" class="w-10 h-10 bg-white hover:bg-[#050B1A] text-gray-300 hover:text-white rounded-xl border border-gray-100 shadow-sm transition-all flex items-center justify-center group-hover:border-[#050B1A] shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                        </div>
                        @empty
                        <div class="py-12 text-center text-gray-300 text-[10px] font-black uppercase tracking-[0.5em] italic opacity-20">ZERO SIGNAL</div>
                        @endforelse
                    </div>

                    <a href="{{ route('owner.cars.create') }}" class="flex items-center justify-center gap-4 p-8 bg-[#050B1A] hover:bg-orange-500 text-white font-black text-[10px] uppercase tracking-[0.3em] rounded-[2rem] shadow-2xl shadow-blue-900/20 transition-all hover:translate-y-[-4px] italic group leading-none">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        Deploy New Unit
                    </a>
                </div>

            </div>
        </div>

            </div>
        </div>

    </div>
</x-app-layout>
