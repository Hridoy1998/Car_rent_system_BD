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
                <form action="{{ route('admin.cars.index') }}" method="GET" class="relative w-full md:w-96">
                    <input type="hidden" name="status" value="{{ $status ?? 'pending' }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by brand, model, or location..." class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 pl-12 text-sm text-white focus:ring-indigo-500">
                    <svg class="absolute left-4 top-4 w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
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
                                        <div class="flex justify-end gap-2">
                                            @if($car->status === 'pending')
                                                <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="px-5 py-2 bg-emerald-500 text-gray-950 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-400 transition-all shadow-lg shadow-emerald-500/10">Authorize</button>
                                                </form>
                                                <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="px-5 py-2 bg-red-500/10 border border-red-500/30 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-500 hover:text-white transition-all">Deny</button>
                                                </form>
                                            @else
                                                <div class="flex flex-col items-end">
                                                    <span class="px-3 py-1 bg-white/5 text-gray-400 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg border border-white/10">{{ $car->status }}</span>
                                                    <p class="text-[8px] text-gray-600 font-bold uppercase mt-1">Registered {{ $car->updated_at->format('M d') }}</p>
                                                </div>
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
