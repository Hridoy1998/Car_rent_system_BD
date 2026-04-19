<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-[#050B1A] tracking-tight uppercase italic leading-[1.1]">
                    Fleet <span class="text-orange-500">Inventory</span>
                </h2>
                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">
                    CRS BD Strategic Asset Management & Ledger
                </p>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('owner.cars.create') }}" class="group relative px-10 py-5 bg-[#050B1A] hover:bg-orange-500 text-white rounded-[2rem] transition-all duration-500 shadow-2xl hover:shadow-orange-500/30 hover:-translate-y-1 italic">
                    <span class="relative z-10 flex items-center gap-4 text-[11px] font-black uppercase tracking-widest leading-none">
                        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        Assemble New Asset
                    </span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen relative overflow-hidden pb-24 font-outfit">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 pt-12 space-y-16">
            
            @if(session('success'))
                <div class="bg-white border-2 border-emerald-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(16,185,129,0.05)] border-l-8 border-l-emerald-500 animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-emerald-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Transaction Success</h4>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.3em] mt-2 italic leading-none">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-white border-2 border-red-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(239,68,68,0.05)] border-l-8 border-l-red-500 animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 shadow-sm border border-red-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Fleet Ledger</h3>
                            <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">Authenticated Asset Registry</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Intelligence Overview Module -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-gray-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-14 h-14 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white italic font-black text-xl shadow-xl">
                            TA
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.4em] mb-1 italic">Total Assets</p>
                            <h4 class="text-3xl font-black text-[#050B1A] italic tracking-tighter">{{ $cars->total() }} <span class="text-xs text-gray-300 font-black uppercase tracking-widest ms-2">Units</span></h4>
                        </div>
                    </div>
                </div>
                <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white italic font-black text-xl shadow-xl shadow-emerald-500/20">
                            OU
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest italic leading-none">Deployed Units</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="text-4xl font-black text-[#050B1A] tracking-tight italic leading-none">{{ $cars->where('status', 'approved')->count() }}</span>
                                <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest leading-none">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="w-14 h-14 bg-amber-500 rounded-2xl flex items-center justify-center text-white italic font-black text-xl shadow-xl shadow-amber-500/20">
                            AP
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.4em] mb-1 italic">Audit Pipeline</p>
                            <h4 class="text-3xl font-black text-[#050B1A] italic tracking-tighter">{{ $cars->where('status', 'pending')->count() }} <span class="text-xs text-amber-500 font-black uppercase tracking-widest ms-2">Pending</span></h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tactical Fleet Search Bar -->
            <div class="py-12 border-y-2 border-gray-100">
                <div class="w-full md:w-96 relative group/search italic mx-auto">
                    <form action="{{ route('owner.cars.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Brand, Model or Plate..." class="w-full bg-gray-50 border-2 border-gray-100 rounded-[2rem] py-5 px-8 ps-14 text-sm font-black text-[#050B1A] uppercase tracking-widest focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all outline-none">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within/search:text-orange-500 transition-colors pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Asset Registry Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 pt-8">
                @forelse ($cars as $car)
                    <div class="group bg-white border-2 border-gray-100 rounded-[4rem] overflow-hidden shadow-[0_45px_110px_rgba(0,0,0,0.03)] transition-all hover:shadow-2xl hover:-translate-y-2">
                        
                        <!-- Visual Asset Container -->
                        <div class="relative h-72 overflow-hidden bg-gray-50">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#050B1A] via-transparent to-transparent opacity-60 z-10"></div>
                            @if($car->images->count() > 0)
                                <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-125">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center opacity-10">
                                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <!-- Static Price Signal -->
                            <div class="absolute top-8 right-8 z-20">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest italic leading-none">Yield Average</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-3xl font-black text-white tracking-tight italic leading-none">৳{{ number_format((int)$car->price_per_day) }}</span>
                                    <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest leading-none">Daily</span>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="absolute top-8 left-8 z-20">
                                @php
                                    $statusClasses = [
                                        'approved' => 'bg-emerald-500 text-white shadow-emerald-500/30',
                                        'pending' => 'bg-amber-500 text-white shadow-amber-500/30',
                                        'disabled' => 'bg-red-500 text-white shadow-red-500/30',
                                    ];
                                    $badgeClass = $statusClasses[$car->status] ?? 'bg-gray-500 text-white';
                                @endphp
                                <div class="px-4 py-1.5 {{ $badgeClass }} rounded-xl text-[9px] font-black uppercase tracking-[0.25em] italic border border-white/20 shadow-xl animate-in zoom-in-50 duration-500">
                                    {{ $car->status }}
                                </div>
                            </div>

                            <!-- Asset Title Area -->
                            <div class="absolute bottom-10 left-10 z-20">
                                <h3 class="text-3xl font-black text-white italic tracking-tighter uppercase leading-none">{{ $car->brand }}</h3>
                                <p class="text-[10px] text-white/70 font-black uppercase tracking-[0.4em] mt-2 italic">{{ $car->model }} <span class="text-orange-500">•</span> {{ $car->year }}</p>
                            </div>
                        </div>

                        <!-- Technical Matrix Overview -->
                        <div class="p-10 space-y-8">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="p-5 bg-gray-50 border border-gray-100 rounded-[2rem] group-hover:border-orange-500/20 transition-all">
                                    <p class="text-[8px] text-gray-400 font-extrabold uppercase tracking-widest mb-1 italic">Transmission</p>
                                    <p class="text-xs text-[#050B1A] font-black uppercase tracking-tighter italic">{{ $car->transmission }} Mode</p>
                                </div>
                                <div class="p-5 bg-gray-50 border border-gray-100 rounded-[2rem] group-hover:border-orange-500/20 transition-all">
                                    <p class="text-[8px] text-gray-400 font-extrabold uppercase tracking-widest mb-1 italic">Chassis Type</p>
                                    <p class="text-xs text-[#050B1A] font-black uppercase tracking-tighter italic">{{ $car->type }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between px-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-500/10 rounded-xl flex items-center justify-center text-orange-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    </div>
                                    <span class="text-[10px] text-[#050B1A] font-black uppercase tracking-widest italic">{{ $car->location }} node</span>
                                </div>
                                <div class="hidden md:flex flex-col items-end">
                                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-tight">Registry Status</span>
                                    <span class="text-[10px] font-black text-emerald-500 italic mt-1 leading-none">ALL SYSTEMS ONLINE</span>
                                </div>
                            </div>

                            <!-- Calibration Hub Link -->
                            <div class="grid grid-cols-4 gap-4">
                                <a href="{{ route('owner.cars.edit', $car) }}" class="col-span-3 py-6 bg-[#050B1A] hover:bg-orange-500 text-white font-black text-[10px] uppercase tracking-[0.4em] italic rounded-[2rem] shadow-xl hover:shadow-orange-500/20 transition-all flex items-center justify-center gap-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Tactical Edit
                                </a>
                                <form action="{{ route('owner.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Decommission institutional asset?')">
                                    @csrf @method('DELETE')
                                    <button class="w-full h-full py-6 bg-gray-100 hover:bg-red-500 text-gray-400 hover:text-white rounded-[2rem] border border-gray-200 hover:border-red-500 transition-all flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="lg:col-span-3 py-44 text-center bg-white border-4 border-dashed border-gray-100 rounded-[5rem] relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gray-50 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        <div class="relative z-10 max-w-lg mx-auto px-8">
                            <div class="w-32 h-32 bg-gray-50 rounded-[3rem] flex items-center justify-center mx-auto mb-10 text-5xl shadow-inner animate-pulse">
                                🛸
                            </div>
                            <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tighter mb-4">No Asset Deployment</h3>
                            <p class="text-[11px] text-gray-400 font-black uppercase tracking-[0.3em] leading-relaxed italic">
                                Your decentralized fleet ledger is currently empty. Initial asset ingestion is required to activate revenue streams and operational throughput.
                            </p>
                            <a href="{{ route('owner.cars.create') }}" class="inline-flex items-center gap-4 mt-12 text-[#050B1A] hover:text-orange-500 font-black text-[10px] uppercase tracking-[0.5em] italic transition-all group/link">
                                [ Execute First Registration ]
                                <svg class="w-5 h-5 transition-all group-hover/link:translate-x-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($cars->hasPages())
                <div class="pt-16 border-t border-gray-100">
                    {{ $cars->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
