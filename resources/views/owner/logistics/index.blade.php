<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter">
                    {{ __('FLEET LOGISTICS') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-black uppercase tracking-[0.3em] mt-1">Movement Tracking & Deployment Schedule</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 bg-gray-900 border border-emerald-500/20 rounded-2xl">
                    <div class="text-[8px] font-black text-gray-500 uppercase tracking-widest mb-1">Fleet Velocity</div>
                    <div class="text-xs font-black text-emerald-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Nominal Flow
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Quick Glance: Mission Critical Movement -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- Upcoming Handovers -->
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-all"></div>
                    <h3 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.5)]"></span>
                        T-Minus Handover (Next 7D)
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($upcomingHandovers as $b)
                        <div class="p-6 bg-gray-950/60 border border-white/5 rounded-3xl hover:border-blue-500/30 transition-all flex items-center justify-between group/item">
                            <div class="flex items-center gap-6">
                                <div class="w-14 h-14 rounded-2xl bg-gray-900 border border-white/10 overflow-hidden relative shadow-xl">
                                    @if($b->car->images->count() > 0)
                                        <img src="{{ Storage::url($b->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                    @endif
                                    <div class="absolute inset-0 bg-blue-600/10 mix-blend-overlay"></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">{{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} @ {{ \Carbon\Carbon::parse($b->start_date)->diffForHumans() }}</div>
                                    <h4 class="text-sm font-black text-white uppercase tracking-tight">{{ $b->car->brand }} {{ $b->car->model }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="w-4 h-4 rounded-full bg-gray-800 border border-white/10 flex items-center justify-center text-[6px] font-black text-gray-500">{{ substr($b->customer->name, 0, 1) }}</div>
                                        <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">{{ $b->customer->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right flex flex-col items-end gap-3">
                                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 text-[8px] font-black uppercase tracking-widest rounded-lg border border-emerald-500/20">
                                    @if($b->customer->isVerified()) VERIFIED @else UNVERIFIED @endif
                                </span>
                                <a href="{{ route('owner.bookings.show', $b) }}" class="text-[9px] font-black text-blue-500 hover:text-white transition-colors uppercase tracking-widest">Protocol →</a>
                            </div>
                        </div>
                        @empty
                        <div class="py-12 text-center text-gray-700 text-[10px] font-black uppercase tracking-[0.4em] italic opacity-20">No imminent handovers detected</div>
                        @endforelse
                    </div>
                </div>

                <!-- Strategic Returns -->
                <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-all"></div>
                    <h3 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-purple-500 shadow-[0_0_10px_rgba(168,85,247,0.5)] animate-pulse"></span>
                        T-Minus Returns (Active)
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($activeReturns as $b)
                        <div class="p-6 bg-gray-950/60 border border-white/5 rounded-3xl hover:border-purple-500/30 transition-all flex items-center justify-between group/item">
                            <div class="flex items-center gap-6">
                                <div class="w-14 h-14 rounded-2xl bg-gray-900 border border-white/10 overflow-hidden relative shadow-xl">
                                    @if($b->car->images->count() > 0)
                                        <img src="{{ Storage::url($b->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                    @endif
                                    <div class="absolute inset-0 bg-purple-600/10 mix-blend-overlay"></div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-black text-purple-400 uppercase tracking-widest mb-1">Due {{ \Carbon\Carbon::parse($b->end_date)->format('M d') }}</div>
                                    <h4 class="text-sm font-black text-white uppercase tracking-tight">{{ $b->car->brand }} {{ $b->car->model }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">Operator: {{ $b->customer->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('owner.bookings.show', $b) }}" class="px-5 py-2 bg-purple-600/10 hover:bg-purple-600 text-purple-400 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-xl border border-purple-500/20 transition-all">Inspect Asset</a>
                            </div>
                        </div>
                        @empty
                        <div class="py-12 text-center text-gray-700 text-[10px] font-black uppercase tracking-[0.4em] italic opacity-20">Fleet currently at rest</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Global Movement Timeline -->
            <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                <div class="p-10 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-xl font-black text-white italic tracking-tighter flex items-center gap-4">
                        <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                        MOVEMENT LEDGER (PHASE IV)
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white/[0.02] text-[10px] font-black text-gray-500 uppercase tracking-widest">
                                <th class="px-10 py-6">Operation Index</th>
                                <th class="px-10 py-6">Asset Intelligence</th>
                                <th class="px-10 py-6">Status Delta</th>
                                <th class="px-10 py-6">Timeline</th>
                                <th class="px-10 py-6 text-right">Yield</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($timeline as $b)
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="px-10 py-8 text-xs font-black text-gray-200 uppercase tracking-tighter italic">#OP-{{ $b->id }}</td>
                                <td class="px-10 py-8">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-black text-white tracking-widest uppercase">{{ $b->car->brand }} {{ $b->car->model }}</span>
                                        <span class="text-[9px] text-gray-600 font-bold uppercase">{{ $b->customer->name }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @php
                                        $statusColors = [
                                            'approved' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                            'ongoing' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            'returned' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                        ];
                                        $color = $statusColors[$b->status] ?? 'bg-white/5 text-gray-400 border-white/10';
                                    @endphp
                                    <span class="px-3 py-1.5 rounded-xl border {{ $color }} text-[9px] font-black uppercase tracking-widest">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="text-[10px] text-gray-400 font-medium">
                                        {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($b->end_date)->format('M d') }}
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-right font-black text-white text-xs">৳{{ number_format($b->total_price) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-24 text-center text-gray-800 text-xs font-black uppercase tracking-[0.4em] italic opacity-20">Timeline is currently static</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
