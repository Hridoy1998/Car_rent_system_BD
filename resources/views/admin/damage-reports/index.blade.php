<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter">
                    {{ __('INTEGRITY MEDIATION') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-black uppercase tracking-[0.3em] mt-1">Strategic Asset Protection & Dispute Arbitration</p>
            </div>
            <div class="flex items-center gap-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                    {{ $breaches->where('status', 'disputed')->count() }} Active Disputes
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- High-Priority Mediation Queue -->
            @if($breaches->where('status', 'disputed')->count() > 0)
            <div class="bg-gray-900/40 backdrop-blur-3xl border-2 border-red-500/20 p-10 rounded-[3rem] shadow-[0_0_60px_rgba(239,68,68,0.1)] relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-red-500/5 rounded-full blur-[60px] animate-pulse"></div>
                
                <h3 class="text-xs font-black text-white uppercase tracking-[0.4em] mb-10 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,1)]"></span>
                    SECURITY CLEARANCE: DISPUTED BREACHES
                </h3>

                <div class="space-y-6">
                    @foreach($breaches->where('status', 'disputed') as $b)
                    <div class="p-8 bg-gray-950/60 border border-white/5 rounded-[2.5rem] hover:border-red-500/30 transition-all group/item shadow-2xl">
                        <div class="flex flex-col lg:flex-row gap-10">
                            <div class="flex-1 space-y-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-500 text-xl border border-red-500/20">⚠️</div>
                                        <div>
                                            <h4 class="text-lg font-black text-white tracking-tighter uppercase">{{ $b->booking->car->brand }} {{ $b->booking->car->model }}</h4>
                                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest italic">Incident Index: #BR-{{ $b->id }} | Operator: {{ $b->booking->customer->name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.bookings.show', $b->booking) }}" class="text-[9px] font-black text-indigo-400 hover:text-white transition-colors uppercase tracking-widest">Full Protocol →</a>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <div class="p-6 bg-white/5 rounded-3xl border border-white/5">
                                            <div class="text-[8px] text-gray-500 font-black uppercase tracking-[0.3em] mb-3 italic">Host Testimony</div>
                                            <p class="text-xs font-bold text-gray-300 leading-relaxed">"{{ $b->description }}"</p>
                                        </div>
                                        <div class="p-6 bg-red-500/5 rounded-3xl border border-red-500/10">
                                            <div class="text-[8px] text-red-500/60 font-black uppercase tracking-[0.3em] mb-3 italic">Operator Dispute Response</div>
                                            <p class="text-xs font-black text-red-200 leading-relaxed italic">"{{ $b->customer_notes ?? 'No response logged.' }}"</p>
                                        </div>
                                    </div>
                                    <div class="rounded-[2.5rem] overflow-hidden border-2 border-white/5 bg-gray-950 neon-shadow-red/5 group-hover:neon-shadow-red transition-all shadow-inner relative group/img">
                                        @if($b->image)
                                            <img src="{{ Storage::url($b->image) }}" class="w-full h-full object-cover opacity-60 group-hover/img:opacity-100 transition-opacity">
                                        @else
                                            <div class="w-full h-full min-h-[160px] flex items-center justify-center text-gray-900 text-[10px] font-black uppercase tracking-[0.4em] italic pointer-events-none">No Artifact Attached</div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent pointer-events-none"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full lg:w-96 bg-gray-900/60 p-10 rounded-[3rem] border border-white/10 backdrop-blur-3xl shadow-3xl relative overflow-hidden group/form">
                                <div class="absolute -right-10 -top-10 w-40 h-40 bg-red-500/10 rounded-full blur-[80px] pointer-events-none"></div>
                                <h5 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-8 text-center italic flex items-center justify-center gap-3">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span>
                                    Final Verdict
                                </h5>
                                <form action="{{ route('admin.damage-reports.resolve', $b) }}" method="POST" class="space-y-4">
                                    @csrf @method('PUT')
                                    <div>
                                        <label class="block text-[8px] font-black text-gray-600 uppercase tracking-widest mb-2 ml-1 italic text-center">Assessed Damages (৳)</label>
                                        <input type="number" name="resolution_cost" required class="w-full bg-gray-950 border-white/5 rounded-xl text-center text-white text-lg font-black focus:ring-red-500" placeholder="0.00">
                                    </div>
                                    <div>
                                        <textarea name="admin_notes" required rows="3" class="w-full bg-gray-950 border-white/5 rounded-xl text-[10px] text-gray-400 focus:ring-red-500" placeholder="Official resolution testimony..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-[0_0_20px_rgba(239,68,68,0.2)]">ISSUE VERDICT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Global Breach Ledger -->
            <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                <div class="p-10 border-b border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                    <h3 class="text-xl font-black text-white italic tracking-tighter flex items-center gap-4">
                        <span class="p-1.5 bg-indigo-500 rounded-lg shadow-lg"></span>
                        INTEGRITY AUDIT LOG
                    </h3>
                    <div class="w-full md:w-auto">
                        <x-search-bar :route="route('admin.damage-reports.index')" placeholder="Search incidents, cars, or participants..." />
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white/[0.02] text-[10px] font-black text-gray-500 uppercase tracking-widest">
                                <th class="px-10 py-6">Incident ID</th>
                                <th class="px-10 py-6">Asset Source</th>
                                <th class="px-10 py-6">Host Status</th>
                                <th class="px-10 py-6">Timeline</th>
                                <th class="px-10 py-6 text-right">Settlement</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($breaches as $b)
                            <tr class="group hover:bg-white/[0.02] transition-colors cursor-pointer" onclick="window.location='{{ route('admin.damage-reports.show', $b) }}'">
                                <td class="px-10 py-8 text-xs font-black text-gray-200 uppercase tracking-tighter italic">#BR-{{ $b->id }}</td>
                                <td class="px-10 py-8">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-black text-white tracking-widest uppercase">{{ $b->booking->car->brand }} {{ $b->booking->car->model }}</span>
                                        <span class="text-[9px] text-gray-600 font-bold uppercase">UID: {{ $b->booking->customer->name }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                            'acknowledged' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            'disputed' => 'bg-red-500/10 text-red-500 border-red-500/20 animate-pulse',
                                            'resolved' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
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
                                     <div class="flex items-center justify-end gap-4">
                                        @if($b->resolution_cost !== null)
                                            ৳{{ number_format($b->resolution_cost) }}
                                        @else
                                            <span class="text-gray-600 italic">AWAITING</span>
                                        @endif
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                             <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-24 text-center text-gray-800 text-xs font-black uppercase tracking-[0.4em] italic opacity-20">Log synchronized. No breach signals received.</td>
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
    </div>
</x-app-layout>
