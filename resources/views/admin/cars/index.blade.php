<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div class="text-center md:text-left">
                <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Fleet <span class="text-indigo-500">Oversight</span>
                </h2>
                <div class="flex items-center justify-center md:justify-start gap-4 mt-4">
                    <span class="w-12 h-px bg-indigo-500/30"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-600 font-black uppercase tracking-[0.4em] italic leading-none">
                        AUDIT AND AUTHORIZE PLATFORM ASSETS
                    </p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-4 bg-white border-2 border-gray-200 p-2 rounded-2xl shadow-xl shadow-gray-200/50 w-full md:w-auto">
                <a href="{{ route('admin.cars.index', ['status' => 'pending']) }}" class="w-full sm:w-auto px-10 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all italic text-center {{ ($status ?? 'pending') === 'pending' ? 'bg-[#050B1A] text-white shadow-xl shadow-[#050B1A]/20' : 'text-gray-400 hover:text-[#050B1A]' }}">Pending</a>
                <a href="{{ route('admin.cars.index', ['status' => 'approved']) }}" class="w-full sm:w-auto px-10 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all italic text-center {{ ($status ?? 'pending') === 'approved' ? 'bg-[#050B1A] text-white shadow-xl shadow-[#050B1A]/20' : 'text-gray-400 hover:text-[#050B1A]' }}">Active</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 relative z-10">
            
            <!-- Global Search & Registry Analytics -->
            <div class="bg-white border-2 border-gray-200 p-8 md:p-12 rounded-[2.5rem] md:rounded-[4rem] shadow-xl shadow-gray-200/30 flex flex-col md:flex-row gap-8 items-center justify-between group">
                <div class="w-full md:w-auto flex-1 order-2 md:order-1">
                    <x-search-bar :route="route('admin.cars.index')" placeholder="Search by brand, model, or location..." />
                </div>
                <div class="flex items-center justify-between md:justify-end gap-10 shrink-0 w-full md:w-auto order-1 md:order-2">
                    <div class="flex flex-col md:items-end">
                         <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Fleet Analytics</div>
                         <div class="flex items-center gap-3">
                             <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                             <span class="text-[11px] font-black text-[#050B1A] uppercase tracking-widest italic leading-none">Registry Count: {{ $cars->total() }}</span>
                         </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border-2 border-emerald-100 text-emerald-700 p-8 rounded-[2rem] font-black text-xs flex items-center gap-6 animate-in fade-in slide-in-from-top duration-500 italic uppercase tracking-widest shadow-lg shadow-emerald-500/5">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0 shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border-2 border-gray-200 overflow-hidden shadow-2xl shadow-gray-200/40 rounded-[3rem] md:rounded-[5rem]">
                <!-- Desktop Fleet Table -->
                <div class="hidden lg:block p-12 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] font-black uppercase tracking-[0.3em] text-gray-600 italic">
                                <th class="pb-8 pl-10">Asset Identity</th>
                                <th class="pb-8">Registrator Artifact</th>
                                <th class="pb-8">Revenue Logic</th>
                                <th class="pb-8 text-right pr-10">Institutional Authorization</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($cars as $car)
                                <tr class="group hover:bg-gray-50/50 transition-all duration-300">
                                    <td class="py-10 pl-10 whitespace-nowrap">
                                        <div class="flex items-center gap-8">
                                            <div class="w-28 h-20 rounded-2xl overflow-hidden border-4 border-white shadow-2xl flex-shrink-0 relative group-hover:scale-110 transition-transform duration-700 bg-gray-100">
                                                <img src="{{ $car->primary_image_url }}" alt="Car" class="w-full h-full object-cover">
                                                @if($car->status === 'pending')
                                                    <div class="absolute inset-0 bg-[#050B1A]/5 backdrop-blur-[1px]"></div>
                                                @endif
                                                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-[#050B1A]/20 to-transparent"></div>
                                            </div>
                                            <div>
                                                <a href="{{ route('cars.show', $car) }}" class="font-black text-xl text-[#050B1A] hover:text-indigo-600 transition-colors block italic tracking-tighter leading-none uppercase">{{ $car->brand }} <span class="text-indigo-500">{{ $car->model }}</span></a>
                                                <div class="flex items-center gap-4 mt-3">
                                                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-700 italic px-3 py-1 bg-gray-100 rounded-lg group-hover:bg-indigo-50 transition-colors">{{ $car->year }}</span>
                                                    <span class="w-1.5 h-1.5 bg-gray-200 rounded-full"></span>
                                                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-600 italic">{{ $car->location }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-10 whitespace-nowrap">
                                        <a href="{{ route('profiles.show', $car->owner) }}" class="flex items-center gap-5 group/owner">
                                            <div class="w-12 h-12 rounded-2xl bg-gray-50 border-2 border-white flex items-center justify-center text-sm font-black text-[#050B1A] group-hover/owner:bg-[#050B1A] group-hover/owner:text-white transition-all shadow-xl italic uppercase">
                                                {{ substr($car->owner->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-black text-[#050B1A] group-hover/owner:text-indigo-600 transition-colors italic tracking-tight">{{ $car->owner->name }}</div>
                                                <div class="text-[8px] text-gray-400 font-black uppercase tracking-widest mt-1.5 italic">View Source Credentials →</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="py-10">
                                        <div class="text-lg font-black text-[#050B1A] italic tracking-tighter leading-none">৳{{ number_format($car->price_per_day) }}<span class="text-[9px] text-gray-400 font-extrabold uppercase ml-3 tracking-widest">Daily Artifact</span></div>
                                        <div class="text-[9px] text-gray-500 font-black uppercase tracking-widest mt-2.5 italic">৳{{ number_format($car->price_per_month) }} <span class="text-[7px] text-gray-400 font-bold opacity-60">Term Yield</span></div>
                                    </td>
                                    <td class="py-10 text-right pr-10 whitespace-nowrap">
                                        <div class="flex justify-end gap-3 items-center">
                                            <a href="{{ route('admin.cars.show', $car) }}" class="w-12 h-12 bg-white hover:bg-[#050B1A] text-gray-400 hover:text-white rounded-xl border-2 border-gray-100 flex items-center justify-center transition-all shadow-xl shadow-gray-200/50 group/icon" title="Audit Asset">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('admin.cars.edit', $car) }}" class="w-12 h-12 bg-indigo-50 hover:bg-indigo-600 text-indigo-500 hover:text-white rounded-xl border-2 border-indigo-100 flex items-center justify-center transition-all shadow-xl shadow-indigo-500/10 group/icon" title="Edit Profile">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('CRITICAL: Scrap this asset artifact from the platform? This cannot be undone.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-12 h-12 bg-red-50 hover:bg-red-600 text-red-500 hover:text-white rounded-xl border-2 border-red-100 flex items-center justify-center transition-all shadow-xl shadow-red-500/10 group/icon" title="Scrap Asset">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>

                                            <div class="h-10 w-px bg-gray-100 mx-5"></div>

                                            @if($car->status === 'pending')
                                                <div class="flex items-center gap-4">
                                                    <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="px-8 py-3.5 bg-white border-2 border-red-100 text-red-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-red-600 hover:text-white transition-all shadow-xl italic active:scale-95 leading-none">Decline</button>
                                                    </form>
                                                    
                                                    <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="px-10 py-3.5 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-emerald-500 transition-all shadow-2xl shadow-[#050B1A]/20 italic active:scale-95 leading-none">Authorize</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="px-8 py-3 bg-gray-50 text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl border-2 border-gray-100 italic shadow-inner">{{ $car->status }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-40 text-center uppercase italic font-black text-gray-400 tracking-widest">Null Fleet Artifacts</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Fleet cards -->
                <div class="block lg:hidden divide-y divide-gray-100">
                    @forelse ($cars as $car)
                        <div class="p-8 space-y-8 group hover:bg-gray-50 transition-all duration-500">
                            <!-- Card Header: Image & Identity -->
                            <div class="flex items-start gap-6">
                                <div class="w-32 h-24 rounded-[1.5rem] overflow-hidden border-4 border-white shadow-xl flex-shrink-0 relative bg-gray-100">
                                    <img src="{{ $car->primary_image_url }}" alt="Car" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#050B1A]/30 to-transparent"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('cars.show', $car) }}" class="text-sm font-black text-[#050B1A] uppercase italic leading-[1.3] block">
                                        {{ $car->brand }} <span class="text-indigo-500">{{ $car->model }}</span>
                                    </a>
                                    <div class="flex flex-wrap items-center gap-3 mt-4">
                                        <span class="text-[8px] font-black uppercase tracking-widest text-[#050B1A] px-2 py-1 bg-white border border-gray-100 shadow-sm rounded-md italic">{{ $car->year }}</span>
                                        <span class="text-[8px] font-black uppercase tracking-widest text-gray-400 italic">@ {{ $car->location }}</span>
                                    </div>
                                    <div class="mt-4 flex flex-col gap-1">
                                         <span class="text-base font-black text-[#050B1A] italic">৳{{ number_format($car->price_per_day) }} <span class="text-[8px] text-gray-400 font-black uppercase tracking-widest">Daily Yield</span></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Registrator Intel -->
                            <div class="flex items-center justify-between gap-6 p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-[#050B1A] text-white flex items-center justify-center font-black text-xs italic border-2 border-white shadow-xl">
                                        {{ substr($car->owner->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="text-[11px] font-black text-[#050B1A] italic block">{{ $car->owner->name }}</span>
                                        <span class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic">Asset Registrator</span>
                                    </div>
                                </div>
                                <a href="{{ route('admin.cars.show', $car) }}" class="px-5 py-2.5 bg-white text-[#050B1A] text-[9px] font-black uppercase tracking-widest rounded-xl border border-gray-100 shadow-sm italic transition-all group-active:scale-95">Audit Log</a>
                            </div>

                            <!-- Action Command Row -->
                            <div class="pt-2 flex flex-col gap-4">
                                @if($car->status === 'pending')
                                    <div class="grid grid-cols-2 gap-4">
                                        <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="w-full">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="w-full py-4 bg-white border-2 border-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-red-600 hover:text-white transition-all italic leading-none active:scale-95">Decline Asset</button>
                                        </form>
                                        <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="w-full">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="w-full py-4 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-500 transition-all italic leading-none active:scale-95 shadow-xl shadow-[#050B1A]/20">Authorize</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between gap-4 p-4 border border-gray-50 rounded-2xl bg-white shadow-inner">
                                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Institutional Status:</span>
                                        <span class="px-6 py-2 bg-gray-50 text-gray-500 text-[9px] font-black uppercase tracking-widest rounded-xl border-2 border-gray-100 italic">{{ $car->status }}</span>
                                    </div>
                                @endif

                                <div class="grid grid-cols-2 gap-4">
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="flex items-center justify-center gap-3 w-full py-4 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-2xl italic border border-indigo-100 active:scale-95">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Modify Asset
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="w-full">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center gap-3 w-full py-4 bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-2xl italic border border-red-100 active:scale-95">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Scrap Registry
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-40 text-center uppercase italic font-black text-gray-400 tracking-widest">Null Fleet Manifest</div>
                    @endforelse
                </div>

                <!-- Hardened Pagination Manifest -->
                @if($cars->hasPages())
                    <div class="px-8 md:px-12 py-12 md:py-16 bg-gray-50/30 border-t border-gray-100 flex justify-center">
                        <div class="pagination-harden w-full sm:w-auto">
                            {{ $cars->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Institutional Pagination Styles -->
    <style>
        .pagination-harden nav { display: flex; justify-content: center; gap: 8px; }
        .pagination-harden nav span, .pagination-harden nav a { 
            background: white !important; 
            border: 2px solid #f3f4f6 !important; 
            border-radius: 1rem !important; 
            padding: 12px 20px !important;
            font-weight: 900 !important;
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            color: #050B1A !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
            font-style: italic !important;
        }
        .pagination-harden nav a:hover {
            border-color: #6366f1 !important;
            background: #6366f1 !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.2), 0 4px 6px -2px rgba(99, 102, 241, 0.1) !important;
        }
        .pagination-harden nav span[aria-current="page"] {
            background: #050B1A !important;
            color: white !important;
            border-color: #050B1A !important;
        }
        @media (max-width: 640px) {
            .pagination-harden nav { gap: 4px; }
            .pagination-harden nav span:not([aria-current="page"]), .pagination-harden nav a:not([rel="prev"]):not([rel="next"]) {
                display: none !important;
            }
            .pagination-harden nav [rel="prev"], .pagination-harden nav [rel="next"], .pagination-harden nav span[aria-current="page"] {
                flex: 1;
                text-align: center;
                padding: 16px !important;
            }
        }
    </style>
</x-app-layout>
