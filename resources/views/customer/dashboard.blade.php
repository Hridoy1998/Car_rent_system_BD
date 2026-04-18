<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Customer <span class="text-orange-500">Nexus</span>
                </h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">
                    CRS BD Institutional Customer Excellence Hub
                </p>
            </div>
            <div class="flex items-center gap-8">
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic leading-none mb-1">Status</span>
                    <span class="text-emerald-500 flex items-center gap-2 text-[11px] font-black uppercase tracking-widest italic">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Operational
                    </span>
                </div>
                <div class="h-10 w-px bg-gray-200"></div>
                <div class="bg-[#050B1A] px-6 py-3 rounded-2xl border border-white/10 shadow-xl">
                    <span class="text-white text-[10px] font-black uppercase tracking-[0.2em] italic">Secure Session Verified</span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Institutional Hero: Shared Branding Banner -->
    <div class="relative py-16 md:py-24 mb-8 md:mb-12 -mt-12 overflow-hidden rounded-b-[2rem] md:rounded-b-[4rem] group">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110" style="background-image: url('{{ asset('images/assets/customer_elite_banner.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-orange-500/10 border border-orange-500/20 rounded-xl mb-6 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">Institutional Portfolio</span>
                </div>
                <h1 class="text-4xl md:text-7xl font-black text-white uppercase tracking-tighter italic leading-[0.9]">
                    Excellence <br> <span class="text-orange-500">Redefined.</span>
                </h1>
                <p class="text-gray-300 font-bold text-[10px] md:text-xs uppercase tracking-[0.3em] mt-6 italic opacity-80 leading-relaxed max-w-md">
                    Managing your elite car rental portfolio with absolute precision and institutional integrity.
                </p>
            </div>
        </div>
    </div>

    <div class="space-y-12 pb-24">
        
        <!-- Global Action Queue: Strategic Alert Module -->
        @if(count($actionQueue) > 0)
        <div class="bg-white border border-gray-100 p-6 md:p-10 lg:p-12 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-48 h-48 bg-orange-500/[0.03] rounded-full blur-3xl group-hover:bg-orange-500/5 transition-all duration-700"></div>
            
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.4em] flex items-center gap-4 italic leading-none">
                    <span class="w-8 h-1 bg-orange-500 rounded-full"></span>
                    Operational Directives
                </h3>
                <span class="px-3 py-1 bg-orange-50 border border-orange-100 rounded-xl text-[8px] font-black text-orange-500 uppercase tracking-widest italic leading-none">
                    {{ count($actionQueue) }} Actions
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($actionQueue as $action)
                    <a href="{{ $action['link'] }}" class="flex items-center gap-6 p-6 md:p-8 bg-gray-50 border border-gray-200/60 rounded-[2.5rem] hover:border-orange-500/50 transition-all group/action shadow-sm hover:shadow-xl hover:translate-y-[-4px]">
                        <div class="w-14 h-14 lg:w-16 lg:h-16 rounded-[1.5rem] {{ $action['priority'] === 'critical' ? 'bg-red-50 text-red-600 border-red-200' : 'bg-orange-50 text-orange-500 border-orange-200' }} border-2 flex items-center justify-center text-xl shadow-inner transition-transform group-hover/action:scale-110 duration-500 italic shrink-0">
                            @if($action['type'] === 'PAYMENT') 💳 @elseif($action['type'] === 'VERIFICATION') 🛡️ @else ⚠️ @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-[9px] lg:text-[10px] font-black {{ $action['priority'] === 'critical' ? 'text-red-600' : 'text-orange-600' }} uppercase tracking-[0.2em] mb-2 italic truncate">{{ $action['title'] }}</div>
                            <div class="text-[11px] lg:text-[12px] font-black text-gray-900 leading-tight italic truncate">{{ $action['desc'] }}</div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover/action:text-orange-500 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- High Fidelity Intelligence Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Identity Pulse Shield -->
            <div class="lg:col-span-1">
                <div class="bg-[#050B1A] p-8 lg:p-12 rounded-[3.5rem] shadow-2xl shadow-blue-900/20 relative overflow-hidden group h-full flex flex-col">
                    <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/[0.03] rounded-full blur-[80px] group-hover:bg-white/[0.05] transition-all duration-700"></div>
                    
                    <h3 class="text-[10px] font-black text-white/40 uppercase tracking-[0.4em] mb-12 flex items-center gap-4 italic leading-none shrink-0">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                        Branding Identity Pulse
                    </h3>
                    
                    <div class="text-center py-8 flex-1 flex flex-col justify-center">
                        <div class="relative inline-block mb-10 mx-auto">
                            <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-full border-2 border-white/5 p-3 bg-white/5 shadow-[0_0_50px_rgba(0,0,0,0.3)] relative overflow-hidden transition-transform duration-700 group-hover:scale-105">
                                <div class="w-full h-full rounded-full bg-gradient-to-br from-[#050B1A] to-blue-900 flex flex-col items-center justify-center text-white shadow-inner">
                                    <span class="text-3xl lg:text-4xl font-black italic leading-none">{{ number_format($reputation['avg_rating'], 1) }}</span>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-white/40 mt-1 italic">Score</span>
                                </div>
                            </div>
                            <div class="absolute -bottom-1 -right-1 bg-orange-500 p-2 lg:p-3 rounded-2xl shadow-2xl text-white border-4 border-[#050B1A]">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.24.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                            </div>
                        </div>
                        <h4 class="text-xl lg:text-2xl font-black text-white uppercase tracking-tighter mb-2 italic leading-none">Institutional Grade</h4>
                        <p class="text-[9px] text-white/30 font-black uppercase tracking-[0.3em] italic leading-none">Validated via {{ $reputation['review_count'] }} Operational Cycles</p>
                    </div>

                    <div class="mt-12 grid grid-cols-2 gap-4 lg:gap-6 shrink-0">
                        <div class="p-5 lg:p-6 bg-white/5 border border-white/5 rounded-3xl transition-all hover:bg-white/10 text-center flex flex-col justify-center">
                            <div class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mb-2 italic leading-none">Status</div>
                            <div class="text-[10px] lg:text-[11px] font-black italic tracking-widest {{ $verification && $verification->status === 'approved' ? 'text-emerald-400' : 'text-orange-500' }} leading-tight">
                                @if($verification && $verification->status === 'approved') VERIFIED IDENTITY @else ACCESS RESTRICTED @endif
                            </div>
                        </div>
                        <div class="p-5 lg:p-6 bg-white/5 border border-white/5 rounded-3xl transition-all hover:bg-white/10 text-center flex flex-col justify-center">
                            <div class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mb-2 italic leading-none">Engagement</div>
                            <div class="text-[10px] lg:text-[11px] font-black text-white italic tracking-widest uppercase leading-tight">{{ $stats['total_bookings'] }} Hub Cycles</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Strategic Expenditure Nexus -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-100 p-8 lg:p-12 rounded-[3.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.03)] relative overflow-hidden h-full flex flex-col group/chart">
                     <div class="flex items-center justify-between mb-12 lg:mb-16 px-4 shrink-0">
                        <div>
                            <h3 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.4em] flex items-center gap-4 italic leading-none">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                                Fiscal Analytics
                            </h3>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-3 italic leading-none">Monthly Portfolio Expenditure Signal</p>
                        </div>
                        <div class="w-12 h-12 lg:w-14 lg:h-14 bg-orange-500 border border-orange-400 shadow-xl shadow-orange-500/20 rounded-2xl flex items-center justify-center text-white font-black italic text-sm transition-transform group-hover/chart:scale-110">
                            ৳
                        </div>
                    </div>

                    <div class="h-64 lg:h-72 flex items-end justify-between gap-4 lg:gap-8 px-8 relative flex-1 bg-gray-50/30 rounded-[2rem] py-6 border border-gray-100 mb-4">
                        <div class="absolute inset-x-0 bottom-0 h-px bg-gray-200"></div>
                        @php $maxSpend = !empty($fiscalPulse) && max($fiscalPulse) > 0 ? max($fiscalPulse) : 1; @endphp
                        @foreach($fiscalPulse as $month => $sum)
                            <div class="flex-1 flex flex-col items-center group/pulse relative h-full justify-end">
                                <div class="text-[10px] text-gray-900 mb-4 font-black uppercase tracking-widest group-hover/pulse:text-orange-500 transition-colors italic leading-none">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                                <div class="w-full bg-orange-500 rounded-t-[1.5rem] transition-all duration-700 group-hover/pulse:bg-[#050B1A] group-hover/pulse:shadow-2xl relative overflow-hidden" 
                                     style="height: {{ ($sum / $maxSpend) * 100 }}%">
                                    <div class="absolute inset-0 bg-white/20 text-[8px]"></div>
                                    <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-[#050B1A] text-[10px] font-black text-white px-4 py-2 rounded-xl opacity-0 group-hover/pulse:opacity-100 transition-all scale-75 group-hover/pulse:scale-100 whitespace-nowrap shadow-2xl italic border border-white/10 z-20 translate-y-2 group-hover/pulse:translate-y-0">
                                        ৳ {{ number_format($sum) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if(empty($fiscalPulse))
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-200 text-[10px] font-black uppercase tracking-[0.5em] italic">NULL FISCAL SIGNAL DETECTED</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Deployment Briefing (Conditional) -->
        @if($activeTrip)
        <div class="bg-white border border-gray-100 p-8 lg:p-12 rounded-[4rem] shadow-[0_60px_120px_rgba(0,0,0,0.05)] relative overflow-hidden group">
            <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-blue-900/[0.02] rounded-full blur-[100px] -z-10 group-hover:bg-blue-900/5 transition-all duration-1000"></div>
            
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-center">
                <div class="w-full lg:w-2/5 aspect-[16/10] rounded-[3.5rem] overflow-hidden border border-gray-100 shadow-[0_40px_80px_rgba(0,0,0,0.1)] relative group/image">
                    <img src="{{ $activeTrip->car->primary_image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover/image:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#050B1A]/40 to-transparent opacity-0 group-hover/image:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute bottom-6 left-6 lg:bottom-8 lg:left-8 flex items-center gap-3">
                         <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse border-2 border-white shadow-lg"></div>
                         <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] italic drop-shadow-lg leading-none">Mission Active</span>
                    </div>
                </div>
                
                <div class="flex-1 space-y-8 lg:space-y-10 w-full">
                    <div>
                        <div class="text-[10px] font-black text-orange-500 uppercase tracking-[0.5em] mb-4 italic leading-none">Operational Deployment Tracker</div>
                        <h4 class="text-4xl lg:text-5xl font-black text-gray-900 tracking-tighter uppercase italic leading-[0.9] font-outfit">{{ $activeTrip->car->brand }} <span class="text-orange-500">{{ $activeTrip->car->model }}</span></h4>
                        <div class="flex items-center gap-4 mt-6">
                            <div class="px-4 py-2 bg-gray-900/5 border border-gray-100 rounded-xl flex items-center gap-3">
                                <span class="w-1.5 h-1.5 bg-[#050B1A] rounded-full"></span>
                                <span class="text-[9px] font-black text-[#050B1A] uppercase tracking-widest italic leading-none truncate">Managed by {{ $activeTrip->car->owner->name }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-10 border-y border-gray-50 py-8 lg:py-10">
                        <div class="space-y-2">
                            <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">Entry Cycle</div>
                            <div class="text-[11px] lg:text-[12px] text-gray-900 font-black uppercase italic leading-none">{{ \Carbon\Carbon::parse($activeTrip->start_date)->format('M d, Y') }}</div>
                        </div>
                        <div class="space-y-2">
                            <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">Exit Cycle</div>
                            <div class="text-[11px] lg:text-[12px] text-gray-900 font-black uppercase italic leading-none">{{ \Carbon\Carbon::parse($activeTrip->end_date)->format('M d, Y') }}</div>
                        </div>
                        <div class="space-y-2">
                            <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">Hub Hub</div>
                            <div class="text-[11px] lg:text-[12px] text-gray-900 font-black uppercase italic leading-none truncate">{{ $activeTrip->car->location }}</div>
                        </div>
                        <div class="space-y-2 text-right">
                            <div class="text-[9px] text-orange-500/50 font-black uppercase tracking-widest italic leading-none">Budget Signal</div>
                            <div class="text-xl text-[#050B1A] font-black italic tracking-tighter leading-none font-outfit">৳{{ number_format($activeTrip->total_price) }}</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="{{ route('customer.bookings.index') }}" class="flex-1 lg:flex-none text-center px-8 lg:px-10 py-5 bg-[#050B1A] hover:bg-orange-500 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl italic group">
                            Manage Deployment <span class="inline-block transition-transform group-hover:translate-x-1 ml-1">→</span>
                        </a>
                        <a href="{{ route('bookings.messages.index', $activeTrip) }}" class="flex-1 lg:flex-none text-center px-8 lg:px-10 py-5 bg-white hover:bg-gray-50 text-gray-900 text-[11px] font-black uppercase tracking-[0.2em] border-2 border-gray-100 rounded-2xl transition-all shadow-sm italic group">
                             Operational Comm <span class="inline-block transition-transform group-hover:translate-x-1 ml-1">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Fleet Registry Hub: Favorites Grid -->
        <div class="space-y-12">
            <div class="flex items-center justify-between px-6">
                <h3 class="text-2xl font-black text-gray-900 italic tracking-tighter uppercase leading-none flex items-center gap-6">
                    <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                    Portfolio <span class="text-orange-500">Favorites</span>
                </h3>
                <a href="{{ route('home') }}" class="text-[10px] font-black text-[#050B1A] hover:text-orange-500 transition-colors uppercase tracking-[0.4em] italic leading-none">Marketplace Access →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
                @forelse($wishlist as $fav)
                <div x-data="{ saving: false, removed: false }" x-show="!removed" x-transition.opacity.duration.500ms class="group relative bg-white border border-gray-100 p-6 lg:p-8 rounded-[3.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.03)] transition-all hover:translate-y-[-8px] hover:shadow-2xl overflow-hidden animate-fade-up">
                    <div class="aspect-[4/3] rounded-[2.5rem] overflow-hidden border border-gray-50 shadow-inner relative mb-8 group/img">
                        <img src="{{ $fav->car->primary_image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover/img:scale-110">
                         <form @submit.prevent="
                            saving = true;
                            fetch('{{ route('customer.favorites.toggle', $fav->car) }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            }).then(res => {
                                if(res.ok) removed = true;
                            }).finally(() => saving = false)
                         " class="absolute top-4 right-4 z-20">
                            @csrf
                            <button type="submit" :disabled="saving" class="w-10 h-10 lg:w-12 lg:h-12 bg-white/90 backdrop-blur-md hover:bg-orange-500 text-red-500 hover:text-white rounded-2xl shadow-2xl transition-all hover:scale-110 active:scale-90 border border-white/20 flex items-center justify-center disabled:opacity-50">
                                <svg x-show="!saving" class="w-4 h-4 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.657 0L10 6.343l1.172-1.171a4 4 0 115.657 5.657L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                <svg x-show="saving" class="w-4 h-4 lg:w-5 lg:h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </button>
                         </form>
                         <div class="absolute bottom-4 left-4 lg:bottom-6 lg:left-6">
                            <span class="px-4 lg:px-5 py-2 bg-[#050B1A] text-[9px] lg:text-[10px] font-black text-white rounded-xl uppercase tracking-widest shadow-2xl italic border border-white/10 shrink-0">৳{{ number_format($fav->car->price_per_day) }}/DAY</span>
                         </div>
                    </div>

                    <h4 class="text-[15px] lg:text-lg font-black text-gray-900 group-hover:text-orange-500 transition-colors mb-3 truncate uppercase tracking-tight italic px-2 leading-none">{{ $fav->car->brand }} <span class="opacity-40 leading-none">{{ $fav->car->model }}</span></h4>
                    <div class="flex items-center justify-between pt-6 border-t border-gray-50 mx-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-7 h-7 rounded-xl bg-gray-50 shrink-0 flex items-center justify-center text-[9px] font-black text-gray-400 italic">ID</div>
                            <span class="text-[8px] lg:text-[9px] text-gray-400 font-extrabold uppercase tracking-widest italic truncate">{{ $fav->car->brand }}</span>
                        </div>
                        <a href="{{ route('cars.show', $fav->car) }}" class="text-[9px] lg:text-[10px] font-black text-orange-500 hover:text-[#050B1A] transition-colors uppercase tracking-[0.2em] italic shrink-0">Audit →</a>
                    </div>
                </div>
                @empty
                <div class="lg:col-span-4 p-16 lg:p-24 text-center bg-white border-2 border-dashed border-gray-100 rounded-[4rem] shadow-sm">
                     <div class="text-5xl lg:text-6xl mb-8 grayscale opacity-10">🛡️</div>
                     <h4 class="text-gray-900 font-black text-sm uppercase tracking-[0.5em] mb-4 italic leading-none">Registry Is Clear</h4>
                     <p class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.3em] italic max-w-sm mx-auto leading-relaxed">Your institutional favorites portfolio is currently awaiting strategic signals.</p>
                     <a href="{{ route('home') }}" class="inline-block mt-10 px-10 lg:px-12 py-5 bg-[#050B1A] hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-2xl shadow-blue-900/10 italic">Explore Total Fleet</a>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
