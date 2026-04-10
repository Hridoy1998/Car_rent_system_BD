<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter">
                    {{ __('ASSET INTEGRITY') }}
                </h2>
                <p class="text-[10px] text-red-500 font-black uppercase tracking-[0.3em] mt-1">Breach Containment & Resolution Center</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 bg-gray-900 border border-red-500/20 rounded-2xl">
                    <div class="text-[8px] font-black text-gray-500 uppercase tracking-widest mb-1">Defense Readiness</div>
                    <div class="text-xs font-black text-red-500 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                        Active Breaches
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Quick Glance: Mission Critical Movement -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Critical Alerts -->
                <div class="lg:col-span-1 bg-gray-900/40 backdrop-blur-3xl border border-red-500/20 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group h-full">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-red-500/5 rounded-full blur-3xl group-hover:bg-red-500/10 transition-all"></div>
                    <h3 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,1)] animate-ping"></span>
                        Strategic Alerts
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($breaches->whereIn('status', ['pending', 'disputed']) as $b)
                        <div class="p-6 bg-red-500/5 border border-red-500/20 rounded-3xl hover:bg-red-500/10 transition-all group/item shadow-xl">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center text-red-500 text-lg">⚠️</div>
                                <div>
                                    <h4 class="text-xs font-black text-white uppercase tracking-widest">{{ $b->booking->car->brand }} {{ $b->booking->car->model }}</h4>
                                    <div class="text-[9px] text-red-400 font-bold uppercase tracking-tighter">{{ $b->status }} BREACH</div>
                                </div>
                            </div>
                            <p class="text-[10px] text-gray-400 italic leading-relaxed mb-4">"{{ Str::limit($b->description, 80) }}"</p>
                            <a href="{{ route('owner.bookings.show', $b->booking) }}" class="block w-full text-center py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-colors border border-red-500/20">Manage Case</a>
                        </div>
                        @endforeach
                        
                        @if($breaches->whereIn('status', ['pending', 'disputed'])->count() === 0)
                        <div class="py-12 text-center text-gray-700 text-[10px] font-black uppercase tracking-[0.4em] italic opacity-20">Fleet integrity 100% Nominal</div>
                        @endif
                    </div>
                </div>

                <!-- Main Breach Ledger -->
                <div class="lg:col-span-2 bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl h-full">
                    <div class="p-10 border-b border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                        <h3 class="text-xl font-black text-white italic tracking-tighter flex items-center gap-4">
                            <span class="p-1.5 bg-red-500 rounded-lg shadow-lg"></span>
                            INTEGRITY BREACH LEDGER
                        </h3>
                        <div class="w-full md:w-auto">
                            <x-search-bar :route="route('owner.integrity.index')" placeholder="Search breaches, cars, or operators..." />
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white/[0.02] text-[10px] font-black text-gray-500 uppercase tracking-widest">
                                    <th class="px-10 py-6">Incident ID</th>
                                    <th class="px-10 py-6">Asset Source</th>
                                    <th class="px-10 py-6">Containment Status</th>
                                    <th class="px-10 py-6">Reported At</th>
                                    <th class="px-10 py-6 text-right">Settlement</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($breaches as $b)
                                <tr class="group hover:bg-white/[0.02] transition-colors cursor-pointer" onclick="window.location='{{ route('owner.integrity.show', $b) }}'">
                                    <td class="px-10 py-8 text-xs font-black text-gray-200 uppercase tracking-tighter italic">#BR-{{ $b->id }}</td>
                                    <td class="px-10 py-8">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-black text-white tracking-widest uppercase">{{ $b->booking->car->brand }}</span>
                                            <span class="text-[9px] text-gray-600 font-bold uppercase">UID: {{ $b->booking->customer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                                'disputed' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                                'resolved' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                                'acknowledged' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                            ];
                                            $color = $statusColors[$b->status] ?? 'bg-white/5 text-gray-400 border-white/10';
                                        @endphp
                                        <span class="px-3 py-1.5 rounded-xl border {{ $color }} text-[8px] font-black uppercase tracking-widest">
                                            {{ $b->status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="text-[10px] text-gray-400 font-medium">
                                            {{ $b->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 text-right font-black text-white text-xs">
                                         <div class="flex items-center justify-end gap-6">
                                            {{ $b->resolution_cost ? '৳'.number_format($b->resolution_cost) : 'AWAITING' }}
                                            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                                 <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-24 text-center text-gray-800 text-xs font-black uppercase tracking-[0.4em] italic opacity-20">No breach history detected</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-8 border-t border-white/5">
                        {{ $breaches->links() }}
                    </div>
                </div>
            </div>

            <!-- Resolution Protocol Notice -->
            <div class="bg-gray-900 border border-white/5 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                <div class="flex items-center gap-8">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-600/10 flex items-center justify-center text-indigo-400 border border-indigo-500/20 shadow-xl group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-2">Platform Mediation Guard</h4>
                        <p class="text-gray-500 text-xs font-medium leading-relaxed max-w-2xl">If the Rentee disputes an integrity breach claim, the platform administration will review the metadata and physical documentation to resolve the conflict. Keep all photo documentation secure for the duration of the mediation cycle.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
