<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Fleet Oversight') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1 text-center md:text-left">Audit and authorize platform assets</p>
            </div>
            <div class="flex gap-2 bg-gray-900 border border-white/10 p-1 rounded-2xl">
                <a href="{{ route('admin.cars.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ ($status ?? 'pending') === 'pending' ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-gray-500 hover:text-white' }}">Pending</a>
                <a href="{{ route('admin.cars.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ ($status ?? 'pending') === 'approved' ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-gray-500 hover:text-white' }}">Active</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Global Search & Filters -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between">
                <x-search-bar :route="route('admin.cars.index')" placeholder="Search by brand, model, or location..." />
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-right">
                         <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                         <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Global Fleet: {{ $cars->total() }} Units</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-2xl font-bold text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                <div class="p-8">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                <th class="pb-6 pl-4">Asset Identity</th>
                                <th class="pb-6">Registrar (Owner)</th>
                                <th class="pb-6">Revenue Potential</th>
                                <th class="pb-6 text-right pr-4">Authorization</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse ($cars as $car)
                                <tr class="group hover:bg-white/[0.02] transition-colors">
                                    <td class="py-6 pl-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-20 h-14 rounded-2xl overflow-hidden border border-white/10 flex-shrink-0 shadow-lg relative">
                                                @if($car->images->count() > 0)
                                                    <img src="{{ Storage::url($car->images->first()->image_path) }}" alt="Car" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-[10px] font-black text-gray-600">NO VISUAL</div>
                                                @endif
                                                @if($car->status === 'pending')
                                                    <div class="absolute inset-0 bg-yellow-500/10 backdrop-blur-[2px]"></div>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('cars.show', $car) }}" class="font-bold text-white hover:text-indigo-400 transition-colors block">{{ $car->title }}</a>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[9px] font-black uppercase tracking-widest text-gray-600">{{ $car->brand }}</span>
                                                    <span class="w-1 h-1 bg-gray-800 rounded-full"></span>
                                                    <span class="text-[9px] font-black uppercase tracking-widest text-gray-600">{{ $car->location }}</span>
                                                </div>
                                                @if($car->status === 'pending' && $car->last_edit_reason)
                                                    <div class="mt-3 p-3 bg-amber-500/5 border border-amber-500/20 rounded-xl max-w-xs group-hover:bg-amber-500/10 transition-colors">
                                                        <div class="text-[8px] font-black text-amber-500 uppercase tracking-widest mb-1 flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            Change Intel
                                                        </div>
                                                        <p class="text-[10px] text-gray-400 italic font-medium leading-relaxed">"{{ $car->last_edit_reason }}"</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6">
                                        <a href="{{ route('profiles.show', $car->owner) }}" class="flex items-center gap-3 group/owner">
                                            <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-xs font-black text-indigo-400 group-hover/owner:bg-indigo-600 group-hover/owner:text-white transition-all">
                                                {{ substr($car->owner->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-white group-hover/owner:text-indigo-400 transition-colors">{{ $car->owner->name }}</div>
                                                <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">View Credentials</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="py-6">
                                        <div class="text-sm font-black text-white">৳{{ number_format($car->price_per_day) }}<span class="text-[10px] text-gray-500 font-bold uppercase ml-1">Daily</span></div>
                                        <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-0.5">৳{{ number_format($car->price_per_month) }} Monthly</div>
                                    </td>
                                    <td class="py-6 text-right pr-4">
                                        <div class="flex justify-end gap-2 items-center">
                                            <a href="{{ route('admin.cars.show', $car) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all shadow-lg" title="Audit Asset">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <a href="{{ route('admin.cars.edit', $car) }}" class="p-2.5 bg-indigo-500/10 hover:bg-indigo-600 text-indigo-400 hover:text-white rounded-xl border border-indigo-500/20 transition-all shadow-lg" title="Edit Profile">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('CRITICAL: Scrap this asset artifact from the platform? This cannot be undone.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2.5 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white rounded-xl border border-red-500/20 transition-all shadow-lg" title="Scrap Asset">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>

                                            <div class="h-6 w-px bg-white/5 mx-2"></div>

                                            @if($car->status === 'pending')
                                                <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="px-5 py-2 bg-emerald-500 text-gray-950 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-400 transition-all shadow-lg shadow-emerald-500/10">Authorize</button>
                                                </form>
                                            @else
                                                <span class="px-3 py-1 bg-white/5 text-gray-400 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg border border-white/10">{{ $car->status }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center">
                                        <div class="text-4xl mb-4 opacity-10">🛡️</div>
                                        <h3 class="text-gray-500 font-black uppercase tracking-widest text-xs">Clearance Complete</h3>
                                        <p class="text-gray-700 text-[10px] italic mt-1">No {{ $status }} assets require immediate auditing.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($cars->hasPages())
                        <div class="mt-8 pt-8 border-t border-white/5">
                            {{ $cars->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
