<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-950 text-white p-4">
            <div>
                <h2 class="font-black text-3xl tracking-tighter uppercase italic text-white mb-1">
                    {{ __('Asset Intelligence') }}
                </h2>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,0.5)]"></span>
                    <span class="text-[10px] text-gray-500 font-extrabold uppercase tracking-[0.3em] font-mono">ID: {{ strtoupper(substr($car->id, 0, 8)) }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                 <a href="{{ route('owner.cars.edit', $car) }}" class="px-6 py-3 bg-white/5 border border-white/10 text-white font-black rounded-2xl hover:bg-white/10 transition-all uppercase tracking-widest text-[10px]">
                    Update Configuration
                 </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
        <!-- Strategic Glows -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Asset Vector: Visual & Core Specs -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Tactical Visualization -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="relative group bg-gray-900 border border-white/10 rounded-[3.5rem] overflow-hidden shadow-3xl">
                        <div class="aspect-[16/7] overflow-hidden relative">
                            <img src="{{ $car->primary_image_url }}" class="w-full h-full object-cover grayscale-[0.2] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-10 left-10">
                                <h1 class="text-5xl font-black text-white tracking-tighter italic uppercase drop-shadow-2xl">{{ $car->brand }} {{ $car->model }}</h1>
                                <div class="flex items-center gap-4 mt-3">
                                    <span class="px-4 py-1.5 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl shadow-lg shadow-indigo-600/20">Operational</span>
                                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ $car->year }} Prototype</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 p-10 bg-gray-950/50 backdrop-blur-xl gap-8 border-t border-white/5">
                            <div class="text-center">
                                <div class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-1">Yield / Day</div>
                                <div class="text-xl font-black text-emerald-400">৳ {{ number_format($car->price_per_day) }}</div>
                            </div>
                            <div class="text-center border-l border-white/5 px-4">
                                <div class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-1">Confirmed Trips</div>
                                <div class="text-xl font-black text-white">{{ $car->bookings->count() }} Hits</div>
                            </div>
                            <div class="text-center border-l border-white/5 px-4">
                                <div class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-1">Global Rating</div>
                                <div class="text-xl font-black text-indigo-400">{{ number_format($car->reviews->avg('rating') ?: 5.0, 1) }} ★</div>
                            </div>
                            <div class="text-center border-l border-white/5 px-4">
                                <div class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-1">Integrity Score</div>
                                <div class="text-xl font-black text-white">98% Nominal</div>
                            </div>
                        </div>
                    </div>

                    <!-- Fleet Technical Matrix -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-12 rounded-[3.5rem] shadow-2xl">
                         <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.3em] mb-10 border-b border-white/5 pb-6">Technical Architecture Matrix</h3>
                         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest italic">Drivetrain</p>
                                <p class="text-sm font-black text-white uppercase">{{ $car->transmission }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest italic">Power Stream</p>
                                <p class="text-sm font-black text-white uppercase">{{ $car->fuel_type }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest italic">Engine Displacement</p>
                                <p class="text-sm font-black text-white uppercase">{{ $car->engine_capacity ?: 'N/A' }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest italic">Internal Configuration</p>
                                <p class="text-sm font-black text-white uppercase">{{ $car->seats }} Units (Seating)</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest italic">License Plate Identity</p>
                                <p class="text-sm font-black text-indigo-400 uppercase font-mono">{{ $car->license_plate }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest italic">Physical Location</p>
                                <p class="text-sm font-black text-white uppercase">{{ $car->location }}</p>
                            </div>
                         </div>
                    </div>
                </div>

                <!-- Strategic Insights: Earnings & Logistics -->
                <div class="space-y-10">
                    
                    <!-- Yield Analysis -->
                    <div class="bg-gray-900 border border-white/10 p-10 rounded-[4rem] shadow-2xl relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-all"></div>
                        <h4 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                            Yield Intelligence
                        </h4>
                        
                        <div class="space-y-6">
                            <div class="flex justify-between items-baseline border-b border-white/5 pb-4">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Aggregate Gross</span>
                                <span class="text-2xl font-black text-white tracking-tighter">৳ {{ number_format($car->bookings()->where('status', 'completed')->sum('total_price')) }}</span>
                            </div>
                            <div class="flex justify-between items-baseline border-b border-white/5 pb-4">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Pending Settlement</span>
                                <span class="text-lg font-black text-emerald-500">৳ {{ number_format($car->bookings()->where('status', 'ongoing')->sum('total_price')) }}</span>
                            </div>
                            <div class="flex justify-between items-baseline">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Host Delta / Mo</span>
                                <span class="text-sm font-black text-gray-300 italic">+ 12.4% Impulse</span>
                            </div>
                        </div>

                         <a href="{{ route('owner.finance.index') }}" class="block w-full text-center py-4 bg-white/5 hover:bg-white text-gray-500 hover:text-gray-950 font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl mt-10 transition-all">Detailed Ledger Audit</a>
                    </div>

                    <!-- Logistics Pipeline -->
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-10 rounded-[3rem] shadow-l">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                            Deployment History
                        </h4>
                        <div class="space-y-6">
                            @foreach($car->bookings()->latest()->take(5)->get() as $booking)
                            <div class="flex items-center justify-between p-4 bg-gray-950/60 rounded-2xl border border-white/5 group hover:border-indigo-500/30 transition-all">
                                <div>
                                    <p class="text-[11px] font-black text-white uppercase tracking-tighter">{{ $booking->customer->name }}</p>
                                    <p class="text-[8px] text-gray-600 font-bold uppercase">{{ $booking->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-black {{ $booking->status === 'completed' ? 'text-emerald-500' : 'text-amber-500 animate-pulse' }} uppercase tracking-widest">{{ $booking->status }}</p>
                                    <p class="text-[9px] text-white/50 font-mono">৳ {{ number_format($booking->total_price) }}</p>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($car->bookings->count() === 0)
                                <div class="py-12 text-center text-gray-800 text-[10px] font-black uppercase tracking-widest italic opacity-20">No deployment data available</div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

             <!-- Qualitative Feed: Reviews & Feedback -->
             <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] shadow-2xl overflow-hidden">
                <div class="p-10 border-b border-white/5">
                    <h3 class="text-xl font-black text-white italic tracking-tighter flex items-center gap-4">
                        <span class="p-1.5 bg-yellow-500 rounded-lg shadow-lg"></span>
                        QUALITATIVE FEEDBACK ARRAY
                    </h3>
                </div>
                
                <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($car->reviews as $review)
                    <div class="p-8 bg-gray-950/80 rounded-[2.5rem] border border-white/5 relative group hover:border-yellow-500/20 transition-all">
                         <div class="flex items-center gap-6 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gray-900 border border-white/10 flex items-center justify-center text-xs font-black text-white uppercase">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-black text-white uppercase tracking-tight">{{ $review->user->name }}</h4>
                                <div class="flex gap-0.5 text-yellow-500 text-[8px]">
                                    @for($i=0; $i<$review->rating; $i++) ★ @endfor
                                </div>
                            </div>
                         </div>
                         <p class="text-xs text-gray-400 italic leading-relaxed">"{{ $review->comment }}"</p>
                         <div class="absolute bottom-6 right-8 text-[8px] font-bold text-gray-700 uppercase tracking-widest">{{ $review->created_at->format('M Y') }}</div>
                    </div>
                    @empty
                        <div class="md:col-span-2 py-24 text-center text-gray-800 text-xs font-black uppercase tracking-[0.4em] italic opacity-20">No qualitative artifacts recorded</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
