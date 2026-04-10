<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Identity Registry') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Management of global system operators and participants</p>
            </div>
            <div class="flex gap-2 bg-gray-900 border border-white/10 p-1 rounded-2xl">
                <a href="{{ route('admin.users.index', ['role' => 'all']) }}" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $Role === 'all' ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-gray-500 hover:text-white' }}">All</a>
                <a href="{{ route('admin.users.index', ['role' => 'customer']) }}" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $Role === 'customer' ? 'bg-green-600 text-white shadow-xl shadow-green-600/20' : 'text-gray-500 hover:text-white' }}">Customers</a>
                <a href="{{ route('admin.users.index', ['role' => 'owner']) }}" class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $Role === 'owner' ? 'bg-purple-600 text-white shadow-xl shadow-purple-600/20' : 'text-gray-500 hover:text-white' }}">Owners</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Global Search & Filters -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between">
                <x-search-bar :route="route('admin.users.index')" placeholder="Search identities by name, email, or ID..." />
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                         <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                         <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Total: {{ $users->total() }} Identities</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-2xl font-bold text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 text-[9px] font-black uppercase tracking-[0.3em] text-gray-600">
                                <th class="py-6 pl-8">Operator Identity</th>
                                <th class="py-6">Authorization & Verification</th>
                                <th class="py-6">Platform Tenure</th>
                                <th class="py-6 text-right pr-8">Lifecycle Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($users as $user)
                                <tr class="group hover:bg-white/[0.03] transition-all duration-300">
                                    <td class="py-5 pl-8">
                                        <div class="flex items-center gap-4">
                                            <div class="relative group/photo">
                                                <div class="w-11 h-11 rounded-2xl bg-gray-800 border-2 border-white/5 flex items-center justify-center text-md font-black text-indigo-400 overflow-hidden shadow-2xl transition-all group-hover/photo:border-indigo-500/50">
                                                    @if($user->profile_photo)
                                                        <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                                                    @else
                                                        {{ substr($user->name, 0, 1) }}
                                                    @endif
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-gray-950 {{ $user->is_blocked ? 'bg-red-500' : 'bg-emerald-500' }} shadow-[0_0_8px_currentColor]"></div>
                                            </div>
                                            <div>
                                                <a href="{{ route('admin.users.show', $user) }}" class="text-sm font-black text-white hover:text-indigo-400 transition-colors block italic tracking-tight">{{ $user->name }}</a>
                                                <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wider mt-0.5 flex items-center gap-2">
                                                    <span>{{ $user->email }}</span>
                                                    <span class="text-gray-800">•</span>
                                                    <span class="text-gray-700 font-mono">ID:{{ $user->id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5">
                                        <div class="flex flex-col gap-1.5">
                                            @if($user->role === 'admin')
                                                <span class="w-fit px-2 py-0.5 bg-red-500/10 text-red-500 text-[8px] font-black uppercase tracking-widest rounded-md border border-red-500/20">Auth: Supreme Admin</span>
                                            @elseif($user->role === 'owner')
                                                <span class="w-fit px-2 py-0.5 bg-purple-500/10 text-purple-400 text-[8px] font-black uppercase tracking-widest rounded-md border border-purple-500/20">Auth: Fleet Host</span>
                                            @else
                                                <span class="w-fit px-2 py-0.5 bg-green-500/10 text-green-400 text-[8px] font-black uppercase tracking-widest rounded-md border border-green-500/20">Auth: Client Renter</span>
                                            @endif
                                            
                                            <div class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $user->is_verified ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                                <span class="text-[8px] font-black {{ $user->is_verified ? 'text-emerald-500' : 'text-amber-500' }} uppercase tracking-tighter italic">
                                                    {{ $user->is_verified ? 'Identity Verified' : 'Awaiting NID Audit' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5">
                                        <div class="text-[10px] font-black text-gray-400 font-mono">{{ $user->created_at->format('Y-m-d') }}</div>
                                        <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest mt-0.5">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="py-5 text-right pr-8">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.users.show', $user) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all shadow-lg" title="Full Identity Audit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>

                                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2.5 bg-indigo-600/10 hover:bg-indigo-600 text-indigo-400 hover:text-white rounded-xl border border-indigo-500/20 transition-all shadow-lg" title="Refactor Identity">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>

                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="is_blocked" value="{{ $user->is_blocked ? '0' : '1' }}">
                                                    <button type="submit" class="p-2.5 {{ $user->is_blocked ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20 hover:bg-emerald-500 hover:text-white' : 'bg-amber-500/10 text-amber-500 border-amber-500/20 hover:bg-amber-500 hover:text-white' }} rounded-xl border transition-all shadow-lg" title="{{ $user->is_blocked ? 'Authorization: Restore Access' : 'Authorization: Impose Block' }}">
                                                        @if($user->is_blocked)
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                                        @else
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                        @endif
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('SCUTTLE PROTOCOL: This identity node will be permanently purged. Confirm?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-2.5 bg-red-600/10 border border-red-500/20 text-red-500 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-lg" title="Scuttle Node">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-[7px] text-gray-700 font-black uppercase tracking-widest px-3 py-1.5 bg-white/5 border border-white/5 rounded-lg">Authority Node</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="p-8 border-t border-white/5">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            @if($users->isEmpty())
                <div class="py-20 text-center">
                    <div class="text-4xl mb-4 opacity-10">👤</div>
                    <h3 class="text-gray-500 font-black uppercase tracking-widest text-xs">No Identities Matched</h3>
                    <p class="text-gray-700 text-[10px] italic mt-1">Adjust your search parameters to reflect system participants.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
