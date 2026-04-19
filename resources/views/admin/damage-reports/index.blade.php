<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8 px-4 sm:px-0">
            <div>
                <h2 class="font-black text-3xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Integrity <span class="text-orange-500">Mediation</span>
                </h2>
                <div class="flex items-center gap-4 mt-4">
                    <span class="w-10 h-px bg-[#050B1A]/20"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-500 font-black uppercase tracking-[0.4em] italic leading-none">
                        STRATEGIC ASSET PROTECTION & DISPUTE ARBITRATION
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="px-6 py-4 bg-[#050B1A] rounded-[1.8rem] shadow-sm shadow-[#050B1A]/10 border border-white/5">
                    <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest mb-1 italic">Active Signal</p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse shadow-[0_0_10px_rgba(239,68,68,1)]"></span>
                        <p class="text-xl font-black text-white italic tracking-tighter leading-none">{{ $breaches->where('status', 'disputed')->count() }} <span class="text-[10px] text-red-500 uppercase tracking-widest ml-1">Disputes</span></p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-2 border-emerald-100 text-emerald-600 p-6 rounded-[2rem] font-black text-xs flex items-center gap-4 shadow-xl italic animate-in fade-in slide-in-from-top-4">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm">✅</div>
                    {{ session('success') }}
                </div>
            @endif

            <!-- High-Priority Mediation Queue -->
            @if($breaches->where('status', 'disputed')->count() > 0)
            <div class="space-y-8">
                <h3 class="text-xs font-black text-red-600 uppercase tracking-[0.4em] flex items-center gap-4 italic opacity-80">
                    <span class="w-10 h-1 bg-red-500 rounded-full"></span>
                    Security Clearance: Disputed Breaches
                </h3>

                <div class="grid grid-cols-1 gap-8">
                    @foreach($breaches->where('status', 'disputed') as $b)
                    <div class="bg-white border-2 border-red-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(239,68,68,0.05)] overflow-hidden group hover:shadow-2xl transition-all duration-500">
                        <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
                            
                            <!-- Tactical Info -->
                            <div class="flex-1 p-10 md:p-14 space-y-10">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="flex items-center gap-6">
                                        <div class="w-20 h-20 rounded-[2rem] bg-red-50 border-4 border-white flex items-center justify-center text-3xl shadow-xl">⚠️</div>
                                        <div>
                                            <h4 class="text-2xl font-black text-[#050B1A] uppercase tracking-tighter italic leading-none mb-3 group-hover:text-red-600 transition-colors">{{ $b->booking->car->brand }} {{ $b->booking->car->model }}</h4>
                                            <div class="flex flex-wrap items-center gap-4">
                                                <span class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic opacity-60">ID: #BR-{{ $b->id }}</span>
                                                <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                                <a href="{{ route('admin.users.show', $b->booking->customer) }}" class="text-[9px] text-[#050B1A] font-black uppercase tracking-widest italic hover:text-red-500 transition-colors">Operator: {{ $b->booking->customer->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.bookings.show', $b->booking) }}" class="px-6 py-3 bg-gray-50 text-[9px] font-black text-[#050B1A] uppercase tracking-widest italic rounded-xl border-2 border-white shadow-sm hover:bg-[#050B1A] hover:text-white transition-all whitespace-nowrap">Full Protocol →</a>
                                </div>

                                <div class="grid grid-cols-1 xl:grid-cols-2 gap-10">
                                    <div class="space-y-6">
                                        <div class="p-8 bg-gray-50 rounded-[2.5rem] border-2 border-white shadow-inner relative group/note">
                                            <div class="text-[8px] text-gray-400 font-black uppercase tracking-[0.3em] mb-4 italic flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                                                Host Testimony
                                            </div>
                                            <p class="text-sm font-bold text-gray-600 leading-relaxed italic">"{{ $b->description }}"</p>
                                        </div>
                                        <div class="p-8 bg-red-50/30 rounded-[2.5rem] border-2 border-red-50/50 shadow-inner relative group/note">
                                            <div class="text-[8px] text-red-500 font-black uppercase tracking-[0.3em] mb-4 italic flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span>
                                                Operator Dispute Response
                                            </div>
                                            <p class="text-sm font-black text-red-600 leading-relaxed italic">"{{ $b->customer_notes ?? 'No response logged.' }}"</p>
                                        </div>
                                    </div>
                                    <div class="rounded-[2.5rem] overflow-hidden border-4 border-white bg-gray-100 aspect-video relative group/img shadow-2xl">
                                        @if($b->image)
                                            <img src="{{ Storage::url($b->image) }}" class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-700">
                                            <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 to-transparent pointer-events-none">
                                                <span class="text-[8px] text-white font-black uppercase tracking-widest italic opacity-80">Breach Artifact 01</span>
                                            </div>
                                        @else
                                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-4">
                                                <span class="text-4xl">📷</span>
                                                <span class="text-[10px] font-black uppercase tracking-[0.4em] italic opacity-40">No Artifact Attached</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Verdict Console -->
                            <div class="w-full lg:w-[400px] bg-gray-50/50 p-10 md:p-14 relative overflow-hidden group/form">
                                <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_-20%,rgba(239,68,68,0.05),transparent)]"></div>
                                <h5 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] mb-10 text-center italic flex items-center justify-center gap-4">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    Resolution Verdict
                                </h5>
                                <form action="{{ route('admin.damage-reports.resolve', $b) }}" method="POST" class="space-y-6 relative z-10">
                                    @csrf @method('PUT')
                                    <div class="space-y-3">
                                        <label class="block text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1 italic">Assessed Damages (৳ Volume)</label>
                                        <input type="number" name="resolution_cost" required 
                                            class="w-full bg-white border-2 border-gray-100 rounded-2xl p-5 text-center text-[#050B1A] text-2xl font-black focus:border-red-500 focus:ring-0 transition-all shadow-xl shadow-gray-200/50 italic placeholder-gray-200" 
                                            placeholder="0.00">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block text-[9px] font-black text-gray-500 uppercase tracking-widest ml-1 italic">Official Testimony</label>
                                        <textarea name="admin_notes" required rows="4" 
                                            class="w-full bg-white border-2 border-gray-100 rounded-2xl p-5 text-[11px] text-[#050B1A] font-bold focus:border-red-500 focus:ring-0 transition-all shadow-xl shadow-gray-200/50 italic placeholder-gray-300" 
                                            placeholder="LOG OFFICIAL RESOLUTION..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full py-5 bg-[#050B1A] hover:bg-red-600 text-white text-[11px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-2xl shadow-gray-400 italic active:scale-95">
                                        ISSUE FINAL VERDICT
                                    </button>
                                </form>
                                <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest text-center mt-6 italic opacity-60 leading-relaxed px-4">WARNING: Issued verdicts are final and will synchronize with the platform financial registry.</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Global Breach Ledger -->
            <div class="space-y-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <h3 class="text-xl md:text-2xl font-black text-[#050B1A] tracking-tighter uppercase italic flex items-center gap-6">
                        <span class="w-10 h-1 bg-[#050B1A] rounded-full"></span>
                        Integrity Audit Ledger
                    </h3>
                    <div class="w-full md:w-[450px]">
                        <form action="{{ route('admin.damage-reports.index') }}" method="GET" class="relative group">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="SEARCH INCIDENTS, CARS, OR OPERATORS..." 
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-[11px] font-black uppercase tracking-widest placeholder-gray-300 focus:border-[#050B1A] focus:ring-0 transition-all shadow-lg shadow-gray-200/50 italic">
                            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-hover:text-[#050B1A] transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                    
                    <!-- Desktop Terminal -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 border-b border-gray-50">
                                    <th class="px-12 py-8">Incident ID</th>
                                    <th class="px-12 py-8">Asset & Operator</th>
                                    <th class="px-12 py-8">Mediation Status</th>
                                    <th class="px-12 py-8">Log Timeline</th>
                                    <th class="px-12 py-8 text-right">Settlement</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($breaches as $b)
                                <tr class="group hover:bg-gray-50/50 transition-all duration-300 cursor-pointer" onclick="window.location='{{ route('admin.damage-reports.show', $b) }}'">
                                    <td class="px-12 py-10">
                                        <span class="text-sm font-black text-[#050B1A] uppercase italic tracking-tighter group-hover:text-red-500 transition-colors">#BR-{{ str_pad($b->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-12 py-10">
                                        <div class="flex flex-col">
                                            <span class="text-[11px] font-black text-[#050B1A] uppercase italic tracking-tight">{{ $b->booking->car->brand }} {{ $b->booking->car->model }}</span>
                                            <span class="text-[9px] text-gray-400 font-black uppercase mt-1 italic tracking-widest opacity-60">OP: {{ $b->booking->customer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-100 text-amber-600 border-amber-200',
                                                'acknowledged' => 'bg-emerald-100 text-emerald-600 border-emerald-200',
                                                'disputed' => 'bg-red-100 text-red-600 border-red-200 animate-pulse',
                                                'resolved' => 'bg-indigo-100 text-indigo-600 border-indigo-200',
                                            ];
                                            $color = $statusColors[$b->status] ?? 'bg-gray-100 text-gray-400 border-gray-200';
                                        @endphp
                                        <span class="px-4 py-1.5 rounded-xl border-2 {{ $color }} text-[8px] font-black uppercase tracking-widest italic leading-none inline-flex items-center gap-2 shadow-sm">
                                            {{ $b->status }}
                                        </span>
                                    </td>
                                    <td class="px-12 py-10">
                                        <span class="text-[10px] text-gray-400 font-black uppercase italic tracking-widest opacity-80">{{ $b->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="px-12 py-10 text-right">
                                        <div class="flex items-center justify-end gap-6 text-sm font-black text-[#050B1A] italic">
                                            @if($b->resolution_cost !== null)
                                                ৳{{ number_format($b->resolution_cost) }}
                                            @else
                                                <span class="text-[10px] text-gray-300 uppercase tracking-widest leading-none">AWAITING</span>
                                            @endif
                                            <div class="w-10 h-10 bg-gray-50 border-2 border-white rounded-xl flex items-center justify-center shadow-md transform group-hover:scale-110 group-hover:bg-[#050B1A] group-hover:text-white transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-12 py-32 text-center pointer-events-none">
                                            <div class="text-5xl opacity-10 mb-6">🛡️</div>
                                            <div class="text-gray-300 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">LOG SYNCHRONIZED. NO BREACH SIGNALS RECEIVED.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Tactical Manifest -->
                    <div class="block md:hidden p-6 space-y-6 bg-gray-50/30">
                        @forelse($breaches as $b)
                            <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden active:scale-[0.98] transition-all" onclick="window.location='{{ route('admin.damage-reports.show', $b) }}'">
                                <div class="flex items-center justify-between">
                                    <div class="text-[10px] text-red-500 font-black uppercase tracking-widest italic leading-none group-hover:text-red-700">BR #IDX-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    <span class="px-3 py-1 {{ $color }} rounded-lg text-[8px] font-black uppercase tracking-widest italic shadow-lg shadow-gray-200/50">{{ $b->status }}</span>
                                </div>
                                
                                <div class="space-y-4">
                                     <div class="space-y-1">
                                         <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic opacity-60">Asset & Operator</p>
                                         <p class="text-[13px] font-black text-[#050B1A] uppercase italic leading-none">{{ $b->booking->car->brand }} {{ $b->booking->car->model }}</p>
                                         <p class="text-[10px] text-gray-500 font-black uppercase tracing-widest italic opacity-80">{{ $b->booking->customer->name }}</p>
                                     </div>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                    <div>
                                        <div class="text-xl font-black text-[#050B1A] italic tracking-tighter leading-none">
                                            @if($b->resolution_cost !== null)
                                                ৳{{ number_format($b->resolution_cost) }}
                                            @else
                                                <span class="text-gray-200">৳ ----</span>
                                            @endif
                                        </div>
                                        <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic mt-1 leading-none">Assessed Settlement</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[9px] font-black text-gray-400 italic leading-none mb-1">{{ $b->created_at->format('d M y') }}</div>
                                        <div class="text-[8px] font-black text-gray-300 uppercase tracking-widest italic leading-none">Timestamp</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                             <div class="py-24 text-center">
                                <p class="text-gray-300 text-[9px] font-black uppercase tracking-[0.5em] italic leading-relaxed px-12">No Manifest Artifacts Detected in Registry</p>
                             </div>
                        @endforelse
                    </div>

                    <!-- Operational Pagination -->
                    @if($breaches->hasPages())
                        <div class="px-8 py-10 md:px-12 bg-gray-50/50 border-t border-gray-50 overflow-x-auto">
                            {{ $breaches->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
