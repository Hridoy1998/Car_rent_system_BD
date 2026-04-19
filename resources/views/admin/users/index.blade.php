<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div>
                <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Identity <span class="text-indigo-600">Registry</span>
                </h2>
                <div class="flex items-center gap-4 mt-3">
                    <span class="w-12 h-px bg-indigo-500/30"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-500 font-black uppercase tracking-[0.4em] italic leading-none">
                        GLOBAL OPERATOR OVERSIGHT TERMINAL
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-2 bg-white border-2 border-gray-100 p-2 rounded-[1.8rem] shadow-xl shadow-gray-200/50">
                <a href="{{ route('admin.users.index', ['role' => 'all']) }}" class="px-6 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all italic {{ $Role === 'all' ? 'bg-[#050B1A] text-white shadow-xl shadow-[#050B1A]/20' : 'text-gray-400 hover:text-[#050B1A]' }}">All Operational</a>
                <a href="{{ route('admin.users.index', ['role' => 'customer']) }}" class="px-6 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all italic {{ $Role === 'customer' ? 'bg-emerald-500 text-white shadow-xl shadow-emerald-500/20' : 'text-gray-400 hover:text-emerald-500' }}">Client Renters</a>
                <a href="{{ route('admin.users.index', ['role' => 'owner']) }}" class="px-6 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all italic {{ $Role === 'owner' ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-gray-400 hover:text-indigo-600' }}">Fleet Hosts</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 relative z-10">
            
            <!-- Global Search & Intelligence Manifest -->
            <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] flex flex-col md:flex-row gap-8 items-center justify-between group">
                <div class="flex-1 w-full">
                    <x-search-bar :route="route('admin.users.index')" placeholder="Audit identities by name, communication endpoint, or registry hash..." />
                </div>
                <div class="flex items-center gap-6 bg-gray-50 border-2 border-white px-8 py-4 rounded-2xl shadow-inner">
                    <div class="flex flex-col items-end">
                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic mb-1">Active Identities</span>
                        <p class="text-[13px] font-black text-[#050B1A] uppercase italic leading-none tracking-tighter">{{ $users->total() }} Registry Nodes captured</p>
                    </div>
                    <div class="w-10 h-10 bg-[#050B1A] rounded-xl flex items-center justify-center text-white italic font-black text-lg">I</div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border-2 border-emerald-100 text-emerald-600 p-6 rounded-[2rem] font-bold text-sm flex items-center gap-4 shadow-lg shadow-emerald-500/5 animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6 uppercase italic font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest italic mb-0.5">Registry Protocol Updated</p>
                        <p class="text-xs font-bold italic tracking-tight opacity-80">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Identity Registry Monolith -->
            <div class="bg-white border-2 border-gray-100 overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] rounded-[3.5rem] md:rounded-[4.5rem] transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                
                <!-- Desktop Terminal (Visible on MD+) -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 italic">
                                <th class="py-8 pl-12">Operator Identity</th>
                                <th class="py-8 px-6">Authorization & Integrity</th>
                                <th class="py-8 px-6">Temporal Registry</th>
                                <th class="py-8 pr-12 text-right whitespace-nowrap">Governance Overrides</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($users as $user)
                                <tr class="group hover:bg-gray-50/20 transition-all duration-500 cursor-pointer" onclick="if(!event.target.closest('button') && !event.target.closest('form') && !event.target.closest('a')) window.location='{{ route('admin.users.show', $user) }}'">
                                    <td class="py-8 pl-12 whitespace-nowrap">
                                        <div class="flex items-center gap-6">
                                            <div class="relative group/photo shrink-0">
                                                <div class="w-16 h-16 rounded-[1.8rem] bg-gray-50 border-4 border-white flex items-center justify-center text-xl font-black text-[#050B1A] overflow-hidden shadow-2xl transition-all group-hover/photo:border-indigo-500/30 group-hover/photo:scale-105 italic">
                                                    @if($user->profile_photo)
                                                        <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover transition-all">
                                                    @else
                                                        {{ substr($user->name, 0, 1) }}
                                                    @endif
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-lg border-2 border-white {{ $user->is_blocked ? 'bg-red-500' : 'bg-emerald-500' }} shadow-xl shadow-gray-200"></div>
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.users.show', $user) }}" class="text-[15px] font-black text-[#050B1A] hover:text-indigo-600 transition-colors block uppercase italic tracking-tighter leading-none mb-2">{{ $user->name }}</a>
                                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight flex items-center gap-3 italic">
                                                    <span>{{ $user->email }}</span>
                                                    <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                                    <span class="text-gray-300 font-black tracking-widest">ID:{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8 px-6 whitespace-nowrap">
                                        <div class="flex flex-col gap-3">
                                            @if($user->role === 'admin')
                                                <span class="w-fit px-4 py-1.5 bg-red-50 text-red-600 text-[9px] font-black uppercase tracking-widest rounded-xl border-2 border-red-100 italic">Auth: Supreme Admin</span>
                                            @elseif($user->role === 'owner')
                                                <span class="w-fit px-4 py-1.5 bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase tracking-widest rounded-xl border-2 border-indigo-100 italic">Auth: Fleet Host</span>
                                            @else
                                                <span class="w-fit px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest rounded-xl border-2 border-emerald-100 italic">Auth: Client Renter</span>
                                            @endif
                                            
                                            <div class="flex items-center gap-2 px-1">
                                                <div class="w-2.5 h-2.5 rounded-full {{ $user->is_verified ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.3)]' : 'bg-orange-500 shadow-[0_0_10px_rgba(249,115,22,0.3)]' }} animate-pulse"></div>
                                                <span class="text-[9px] font-black {{ $user->is_verified ? 'text-emerald-600' : 'text-orange-600' }} uppercase tracking-widest italic leading-none">
                                                    {{ $user->is_verified ? 'Identity Verified' : 'Awaiting Audit' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8 px-6 whitespace-nowrap">
                                        <div class="text-[11px] font-black text-[#050B1A] tracking-tight italic">{{ $user->created_at->format('M d, Y') }}</div>
                                        <div class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1.5 italic leading-none">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="py-8 pr-12 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-3 translate-x-4 opacity-70 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
                                            <a href="{{ route('admin.users.show', $user) }}" class="w-11 h-11 bg-white hover:bg-[#050B1A] text-gray-400 hover:text-white rounded-xl border-2 border-gray-50 flex items-center justify-center transition-all shadow-sm hover:shadow-xl hover:shadow-[#050B1A]/20" title="Identity Audit Terminal">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>

                                            <a href="{{ route('admin.users.edit', $user) }}" class="w-11 h-11 bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white rounded-xl border-2 border-indigo-100 flex items-center justify-center transition-all shadow-sm hover:shadow-xl hover:shadow-indigo-600/20" title="Refactor Node Integrity">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>

                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="is_blocked" value="{{ $user->is_blocked ? '0' : '1' }}">
                                                    <button type="submit" class="w-11 h-11 transition-all rounded-xl border-2 flex items-center justify-center shadow-sm {{ $user->is_blocked ? 'bg-emerald-50 border-emerald-100 text-emerald-500 hover:bg-emerald-500 hover:text-white hover:shadow-emerald-500/20' : 'bg-orange-50 border-orange-100 text-orange-500 hover:bg-orange-600 hover:text-white hover:shadow-orange-600/20' }} active:scale-90" title="{{ $user->is_blocked ? 'Institutional Restore' : 'Invoke Restriction' }}">
                                                        @if($user->is_blocked)
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                                        @else
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                        @endif
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('SCUTTLE PROTOCOL: This identity node will be permanently purged. Confirm?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="w-11 h-11 bg-red-50 hover:bg-red-600 text-red-500 hover:text-white rounded-xl border-2 border-red-100 transition-all shadow-sm hover:shadow-xl hover:shadow-red-600/20 active:scale-95" title="Scuttle Node Permanently">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-[7px] text-gray-400 font-black uppercase tracking-[0.4em] px-4 py-2.5 bg-gray-50 border-2 border-white rounded-xl italic leading-none select-none">Supreme Node Authority</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Tactical Card Manifest (Visible on < MD) -->
                <div class="block md:hidden p-6 space-y-6 bg-gray-50/50">
                    @foreach ($users as $user)
                        <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-8 relative overflow-hidden group active:scale-[0.98] transition-all" onclick="if(!event.target.closest('button') && !event.target.closest('form') && !event.target.closest('a')) window.location='{{ route('admin.users.show', $user) }}'">
                            <div class="flex items-center justify-between">
                                <div class="space-y-2">
                                    <div class="text-[10px] text-indigo-500 font-black uppercase tracking-widest italic leading-none">ID-HASH: {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    <div class="flex gap-2">
                                        @if($user->role === 'admin')
                                            <span class="px-3 py-1 bg-red-50 border-2 border-red-100 text-red-600 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Supreme</span>
                                        @elseif($user->role === 'owner')
                                            <span class="px-3 py-1 bg-indigo-50 border-2 border-indigo-100 text-indigo-600 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Host</span>
                                        @else
                                            <span class="px-3 py-1 bg-emerald-50 border-2 border-emerald-100 text-emerald-600 rounded-lg text-[8px] font-black uppercase tracking-widest italic">Client</span>
                                        @endif
                                        <div class="flex items-center gap-2 px-2 py-1 bg-white border-2 border-gray-50 rounded-lg shadow-sm">
                                            <div class="w-2 h-2 rounded-full {{ $user->is_verified ? 'bg-emerald-500' : 'bg-orange-500' }} animate-pulse"></div>
                                            <span class="text-[7px] font-black uppercase tracking-widest italic leading-none {{ $user->is_verified ? 'text-emerald-500' : 'text-orange-500' }}">
                                                {{ $user->is_verified ? 'Verified' : 'Audit' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] font-black text-[#050B1A] uppercase italic leading-none mb-1">{{ $user->created_at->format('M d, Y') }}</div>
                                    <div class="text-[7px] text-gray-400 font-black uppercase tracking-widest opacity-60 italic leading-none">Registry Entry</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="relative group/photo shrink-0">
                                    <div class="w-16 h-16 rounded-[1.5rem] bg-[#050B1A] border-4 border-white shadow-xl overflow-hidden italic flex items-center justify-center text-white font-black text-xl">
                                        @if($user->profile_photo)
                                            <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($user->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-lg border-2 border-white {{ $user->is_blocked ? 'bg-red-500' : 'bg-emerald-500' }} shadow-lg"></div>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-lg font-black text-[#050B1A] uppercase italic tracking-tighter leading-none mb-2 truncate">{{ $user->name }}</div>
                                    <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none opacity-60 truncate">{{ $user->email }}</div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-50 gap-2 overflow-x-auto no-scrollbar">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="w-10 h-10 bg-white border-2 border-gray-100 text-gray-400 rounded-xl flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="w-10 h-10 bg-indigo-50 border-2 border-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                </div>
                                <div class="flex gap-2">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="is_blocked" value="{{ $user->is_blocked ? '0' : '1' }}">
                                            <button type="submit" class="w-10 h-10 rounded-xl border-2 flex items-center justify-center shadow-lg active:scale-90 transition-transform {{ $user->is_blocked ? 'bg-emerald-50 border-emerald-100 text-emerald-500' : 'bg-orange-50 border-orange-100 text-orange-500' }}">
                                                @if($user->is_blocked)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                @endif
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('PURGE IDENTITY?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-red-50 border-2 border-red-100 text-red-500 rounded-xl flex items-center justify-center shadow-lg active:scale-90 transition-transform">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Operational Pagination -->
            @if($users->hasPages())
                <div class="px-4 py-8">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif

            @if($users->isEmpty())
                <div class="py-32 text-center bg-white border-2 border-gray-100 rounded-[4.5rem] shadow-sm">
                    <div class="w-24 h-24 bg-gray-50 rounded-[2.5rem] flex items-center justify-center text-4xl mx-auto mb-8 shadow-inner grayscale opacity-50">👤</div>
                    <h3 class="text-[#050B1A] font-black uppercase tracking-[0.4em] text-xs italic">No Registry Signals Detected</h3>
                    <p class="text-gray-400 text-[10px] italic mt-2 uppercase tracking-widest font-bold">Adjust your search parameters to reflect system participants data artifacts.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
