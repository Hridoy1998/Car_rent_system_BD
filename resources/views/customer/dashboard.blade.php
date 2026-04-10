<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter">
                    {{ __('Customer Dashboard') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-black uppercase tracking-[0.3em] mt-1">Manage your rentals and wishlist</p>
            </div>
            <div class="flex items-center space-x-6 text-[10px] font-black uppercase tracking-widest text-gray-400">
                <div class="flex flex-col items-end">
                    <span class="text-gray-600">Sync Status</span>
                    <span class="text-emerald-500 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        LIVE
                    </span>
                </div>
                <div class="h-8 w-px bg-white/5"></div>
                <div>SECURE SESSION</div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <!-- Aesthetic Overlays -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[140px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[140px] -z-10" style="animation-delay: 2s"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Global Action Queue (Strategic Priority) -->
            @if(count($actionQueue) > 0)
            <div class="bg-gray-900/40 backdrop-blur-3xl border border-red-500/20 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-red-500/5 rounded-full blur-3xl group-hover:bg-red-500/10 transition-all"></div>
                <h3 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,1)] animate-ping"></span>
                    Pending Actions
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($actionQueue as $action)
                        <a href="{{ $action['link'] }}" class="flex items-center gap-6 p-6 bg-gray-950/60 border border-white/5 rounded-3xl hover:border-red-500/30 transition-all group/action shadow-xl">
                            <div class="w-14 h-14 rounded-2xl {{ $action['priority'] === 'critical' ? 'bg-red-500/20 text-red-500 border-red-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20' }} border flex items-center justify-center text-xl shadow-inner group-hover/action:scale-110 transition-transform">
                                @if($action['type'] === 'PAYMENT') 💳 @else ⚠️ @endif
                            </div>
                            <div class="flex-1">
                                <div class="text-[10px] font-black {{ $action['priority'] === 'critical' ? 'text-red-500' : 'text-amber-500' }} uppercase tracking-widest mb-1">{{ $action['title'] }}</div>
                                <div class="text-[11px] font-bold text-gray-300 leading-tight">{{ $action['desc'] }}</div>
                            </div>
                            <svg class="w-4 h-4 text-gray-700 group-hover/action:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Top Tier Intelligence Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Reputation Shield (Left) -->
                <div class="lg:col-span-1 space-y-10">
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group h-full">
                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
                        <h3 class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-10 flex items-center gap-2">
                             👤 Your Profile
                        </h3>
                        
                        <div class="text-center py-6">
                            <div class="relative inline-block mb-6">
                                <div class="w-32 h-32 rounded-full border-4 border-white/5 p-2 bg-gray-950 shadow-2xl">
                                    <div class="w-full h-full rounded-full bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-4xl font-black text-white shadow-[0_0_30px_rgba(79,70,229,0.4)] transition-all group-hover:scale-110">
                                        {{ number_format($reputation['avg_rating'], 1) }}
                                    </div>
                                </div>
                                <div class="absolute -bottom-2 -right-2 bg-emerald-500 p-2 rounded-xl shadow-xl text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.24.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                </div>
                            </div>
                            <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-1">User Rating</h4>
                            <p class="text-[10px] text-gray-600 font-bold uppercase tracking-widest italic">Based on {{ $reputation['review_count'] }} trips</p>
                        </div>

                        <div class="mt-8 grid grid-cols-2 gap-4">
                            <div class="p-4 bg-white/5 border border-white/5 rounded-2xl transition-colors group-hover:bg-white/10">
                                <div class="text-[9px] text-gray-500 font-black uppercase tracking-widest mb-1 text-center">Verification</div>
                                <div class="text-sm font-black text-center {{ $verification && $verification->status === 'approved' ? 'text-emerald-400' : 'text-red-500' }}">
                                    @if($verification && $verification->status === 'approved') VERIFIED @else RESTRICTED @endif
                                </div>
                            </div>
                            <div class="p-4 bg-white/5 border border-white/5 rounded-2xl transition-colors group-hover:bg-white/10">
                                <div class="text-[9px] text-gray-500 font-black uppercase tracking-widest mb-1 text-center">Total Trips</div>
                                <div class="text-sm font-black text-white text-center">{{ $stats['total_bookings'] }} Trips</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Overview (Center & Right) -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Fiscal Pulse Chart -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden h-full">
                         <div class="flex items-center justify-between mb-12">
                            <div>
                                <h3 class="text-xs font-black text-emerald-500 uppercase tracking-widest italic flex items-center gap-2">
                                    <span class="p-1 bg-emerald-500/20 rounded border border-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.3)] text-[8px]">ACTIVE</span>
                                    Spending Trend
                                </h3>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest mt-1">Monthly rental spending overview</p>
                            </div>
                        </div>

                        <div class="h-48 flex items-end justify-between gap-4 px-4 relative">
                            @php $maxSpend = !empty($fiscalPulse) && max($fiscalPulse) > 0 ? max($fiscalPulse) : 1; @endphp
                            @foreach($fiscalPulse as $month => $sum)
                                <div class="flex-1 flex flex-col items-center group/pulse relative h-full justify-end">
                                    <div class="text-[9px] text-gray-700 mb-4 font-black uppercase tracking-widest">{{ \Carbon\Carbon::create()->month($month)->format('M') }}</div>
                                    <div class="w-full bg-emerald-500/10 rounded-t-2xl transition-all duration-700 group-hover/pulse:bg-emerald-500 group-hover/pulse:shadow-[0_0_20px_rgba(16,185,129,0.3)] relative" 
                                         style="height: {{ ($sum / $maxSpend) * 100 }}%">
                                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-950 border border-white/10 text-[9px] font-black text-white px-2.5 py-1.5 rounded-xl opacity-0 group-hover/pulse:opacity-100 transition-all scale-75 group-hover/pulse:scale-100 whitespace-nowrap shadow-2xl">
                                            ৳ {{ number_format($sum) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if(empty($fiscalPulse))
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-800 text-[10px] font-black uppercase tracking-[0.4em] italic opacity-20">NO SPENDING HISTORY FOUND</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Deployment Tracker (Conditional) -->
            @if($activeTrip)
            <div class="bg-gradient-to-r from-indigo-950/40 via-gray-900/40 to-indigo-950/40 backdrop-blur-3xl border-2 border-indigo-500/30 p-10 rounded-[3rem] shadow-[0_0_60px_rgba(99,102,241,0.1)] relative overflow-hidden group">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-indigo-500/10 rounded-full blur-[80px] -z-10 animate-pulse"></div>
                
                <div class="flex flex-col lg:flex-row gap-12 items-center">
                    <div class="w-full lg:w-1/3 aspect-[4/3] rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl relative rotate-[-2deg] group-hover:rotate-0 transition-transform duration-700">
                        <img src="{{ $activeTrip->car->primary_image_url }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-indigo-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                             <span class="text-[10px] font-black text-white uppercase tracking-widest">Active Rental</span>
                        </div>
                    </div>
                    
                    <div class="flex-1 space-y-8">
                        <div>
                            <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">Current Rental Tracked</div>
                            <h4 class="text-4xl font-black text-white tracking-tighter">{{ $activeTrip->car->brand }} {{ $activeTrip->car->model }}</h4>
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-2">Operator: {{ $activeTrip->car->owner->name }}</p>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="space-y-1">
                                <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest">Pickup Date</div>
                                <div class="text-[11px] text-white font-black uppercase">{{ \Carbon\Carbon::parse($activeTrip->start_date)->format('M d, Y') }}</div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest">Return Date</div>
                                <div class="text-[11px] text-white font-black uppercase">{{ \Carbon\Carbon::parse($activeTrip->end_date)->format('M d, Y') }}</div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest">Location Hub</div>
                                <div class="text-[11px] text-white font-black uppercase">{{ $activeTrip->car->location }}</div>
                            </div>
                            <div class="space-y-1 text-right">
                                <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest italic">Total Price</div>
                                <div class="text-[13px] text-emerald-400 font-black">৳{{ number_format($activeTrip->total_price) }}</div>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-4 pt-4">
                            <a href="{{ route('customer.bookings.index') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-[0_0_30px_rgba(99,102,241,0.3)]">Manage Booking</a>
                            <a href="{{ route('bookings.messages.index', $activeTrip) }}" class="px-8 py-4 bg-white/5 hover:bg-white/10 text-white text-[10px] font-black uppercase tracking-widest border border-white/10 rounded-2xl transition-all">Message Owner</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Wishlist & Fleet Discovery Grid -->
            <div class="space-y-8">
                <div class="flex items-center justify-between px-2">
                    <h3 class="text-xl font-black text-white italic tracking-widest flex items-center gap-4">
                        <span class="w-10 h-0.5 bg-indigo-600"></span>
                        My Wishlist
                    </h3>
                    <a href="{{ route('home') }}" class="text-[10px] font-black text-gray-600 hover:text-white transition-colors uppercase tracking-[0.3em]">Browse Cars →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($wishlist as $fav)
                    <div class="group relative bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-6 rounded-[2.5rem] shadow-2xl transition-all hover:scale-[1.02] hover:bg-gray-900/60 overflow-hidden">
                        <div class="aspect-video rounded-3xl overflow-hidden border border-white/5 shadow-2xl relative mb-6">
                            <img src="{{ $fav->car->primary_image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <!-- Favorite Toggle (Remove) -->
                             <form action="{{ route('customer.favorites.toggle', $fav->car) }}" method="POST" class="absolute top-4 right-4 z-20">
                                @csrf
                                <button type="submit" class="p-2 bg-indigo-600 text-white rounded-xl shadow-xl transition-all hover:scale-110 active:scale-90 border border-indigo-400/50">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.657 0L10 6.343l1.172-1.171a4 4 0 115.657 5.657L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                </button>
                             </form>
                             <div class="absolute bottom-4 left-4">
                                <span class="px-2 py-1 bg-black/60 backdrop-blur-md text-[8px] font-black text-white rounded-lg uppercase tracking-tighter">৳{{ number_format($fav->car->price_per_day) }}/DAY</span>
                             </div>
                        </div>

                        <h4 class="text-sm font-black text-white hover:text-indigo-400 transition-colors cursor-pointer mb-2 truncate">{{ $fav->car->title }}</h4>
                        <div class="flex items-center justify-between pt-4 border-t border-white/5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-lg bg-white/5 flex items-center justify-center text-[8px] font-black text-gray-500 group-hover:bg-indigo-600 transition-colors group-hover:text-white">ID</div>
                                <span class="text-[9px] text-gray-600 font-black uppercase tracking-widest">{{ $fav->car->brand }}</span>
                            </div>
                            <a href="{{ route('cars.show', $fav->car) }}" class="text-[9px] font-black text-indigo-400 hover:text-indigo-300 transition-colors uppercase tracking-widest">View Details →</a>
                        </div>
                    </div>
                    @empty
                    <div class="lg:col-span-4 p-24 text-center bg-gray-900/20 border-2 border-dashed border-white/5 rounded-[4rem]">
                         <div class="text-4xl mb-6 grayscale opacity-20">🤍</div>
                         <h4 class="text-gray-500 font-black text-xs uppercase tracking-[0.4em] mb-2">Wishlist is Empty</h4>
                         <p class="text-gray-700 text-[10px] font-bold uppercase tracking-widest italic max-w-sm mx-auto leading-relaxed">Save cars you like to monitor them here.</p>
                         <a href="{{ route('home') }}" class="inline-block mt-8 px-8 py-3 bg-white/5 hover:bg-white/10 text-white text-[9px] font-black uppercase tracking-widest border border-white/10 rounded-2xl transition-all">Browse Marketplace</a>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
