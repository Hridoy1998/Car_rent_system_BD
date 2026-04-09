<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-950 text-white p-4">
            <div>
                <h2 class="font-black text-3xl tracking-tighter uppercase italic text-white mb-1">
                    {{ __('Asset Inventory') }}
                </h2>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] text-gray-500 font-extrabold uppercase tracking-[0.3em]">Fleet Deployment Active</span>
                </div>
            </div>
            <a href="{{ route('owner.cars.create') }}" class="group relative px-6 py-3 bg-white text-gray-950 font-black rounded-2xl shadow-2xl hover:bg-emerald-500 hover:text-white transition-all overflow-hidden uppercase tracking-widest text-[10px]">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    Register Asset
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
         <!-- Strategic Glows -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px] -z-10 animate-pulse" style="animation-duration: 5s"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-6 rounded-[2rem] font-black text-xs uppercase tracking-widest flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="p-2 bg-emerald-500 rounded-xl shadow-[0_0_15px_rgba(16,185,129,0.4)] text-gray-950">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-6 rounded-[2rem] font-black text-xs uppercase tracking-widest flex items-center gap-4">
                    <div class="p-2 bg-red-500 rounded-xl shadow-[0_0_15px_rgba(239,68,68,0.4)] text-white">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($cars as $car)
                <div class="group relative bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3.5rem] overflow-hidden shadow-2xl transition-all hover:bg-gray-900/60 hover:-translate-y-2 hover:shadow-indigo-500/5">
                    
                    <!-- Visual Asset -->
                    <div class="relative h-64 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent z-10"></div>
                        @if($car->images->count() > 0)
                            <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-800 flex flex-col items-center justify-center space-y-3 opacity-20">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">No Visual Seed</span>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-6 left-6 z-20">
                            @php
                                $statusColors = [
                                    'approved' => 'bg-emerald-600/80 text-white shadow-emerald-500/20',
                                    'pending' => 'bg-amber-600/80 text-white shadow-amber-500/20',
                                    'disabled' => 'bg-red-600/80 text-white shadow-red-500/20',
                                ];
                                $colorClass = $statusColors[$car->status] ?? 'bg-white/10 text-white';
                            @endphp
                            <div class="px-4 py-1.5 backdrop-blur-md rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] {{ $colorClass }} border border-white/20">
                                {{ $car->status }}
                            </div>
                        </div>

                        <!-- Price Tag -->
                        <div class="absolute top-6 right-6 z-20 flex flex-col items-end">
                             <div class="px-4 py-1.5 bg-gray-950/80 backdrop-blur-md border border-white/10 rounded-2xl">
                                <span class="text-xs font-black text-white">৳ {{ number_format($car->price_per_day) }}</span>
                                <span class="text-[8px] text-gray-500 font-bold uppercase tracking-tight">/ Day</span>
                             </div>
                        </div>
                    </div>

                    <!-- Asset Intelligence -->
                    <div class="p-8 space-y-6">
                        <div>
                             <h3 class="text-2xl font-black text-white tracking-tighter uppercase italic mb-1">{{ $car->brand }} {{ $car->model }}</h3>
                             <div class="flex items-center gap-3">
                                 <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest">{{ $car->year }} Prototype</span>
                                 <span class="w-1 h-1 rounded-full bg-gray-800"></span>
                                 <span class="text-[10px] text-indigo-400 font-black uppercase tracking-widest">{{ $car->type }}</span>
                             </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-white/5 border border-white/5 rounded-3xl group-hover:bg-white/10 transition-colors">
                                <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest mb-1">Transmission</div>
                                <div class="text-[10px] text-gray-300 font-black uppercase tracking-widest">{{ $car->transmission }}</div>
                            </div>
                            <div class="p-4 bg-white/5 border border-white/5 rounded-3xl group-hover:bg-white/10 transition-colors">
                                <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest mb-1">Fueling</div>
                                <div class="text-[10px] text-gray-300 font-black uppercase tracking-widest">{{ $car->fuel_type }}</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/5">
                             <div class="flex items-center gap-2">
                                 <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 scale-90">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                 </div>
                                 <span class="text-[9px] text-gray-500 font-black uppercase tracking-widest">{{ $car->location }}</span>
                             </div>
                             
                             <div class="flex gap-2 relative z-10">
                                <a href="{{ route('owner.cars.edit', $car) }}" class="p-3 bg-white/5 hover:bg-indigo-600 text-gray-400 hover:text-white rounded-2xl border border-white/5 transition-all shadow-xl shadow-indigo-500/0 hover:shadow-indigo-500/20 group/btn">
                                    <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('owner.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Decommission asset from global fleet?')">
                                    @csrf @method('DELETE')
                                    <button class="p-3 bg-white/5 hover:bg-red-600 text-gray-400 hover:text-white rounded-2xl border border-white/5 transition-all shadow-xl shadow-red-500/0 hover:shadow-red-500/20 group/btn">
                                        <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                             </div>
                        </div>
                    </div>

                    <!-- Internal Asset Deep Link -->
                    <a href="{{ route('cars.show', $car) }}" class="absolute inset-0 z-0 opacity-0 cursor-default"></a>
                </div>
                @empty
                <div class="lg:col-span-3 py-32 text-center bg-gray-900/20 border border-dashed border-white/5 rounded-[4rem]">
                    <div class="w-24 h-24 bg-gray-900 border border-white/5 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 text-4xl grayscale opacity-30 shadow-2xl">📦</div>
                    <h3 class="text-white font-black uppercase tracking-[0.4em] text-sm mb-4">No Assets Deployed</h3>
                    <p class="text-gray-700 text-[11px] font-black uppercase italic tracking-widest max-w-sm mx-auto leading-relaxed">Your decentralized fleet assembly begins here. Register your first vehicle to start generating logarithmic revenue.</p>
                </div>
                @endforelse
            </div>

            @if($cars->hasPages())
                <div class="mt-16">
                    {{ $cars->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
