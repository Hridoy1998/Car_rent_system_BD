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
                <form action="{{ route('admin.users.index') }}" method="GET" class="relative w-full md:w-96">
                    <input type="hidden" name="role" value="{{ $Role }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or ID..." class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 pl-12 text-sm text-white focus:ring-indigo-500">
                    <svg class="absolute left-4 top-4 w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
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
                            <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                <th class="py-8 pl-8">Operator Identity</th>
                                <th class="py-8">Authorization Level</th>
                                <th class="py-8">Platform Tenure</th>
                                <th class="py-8 text-right pr-8">Lifecycle Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($users as $user)
                                <tr class="group hover:bg-white/[0.02] transition-colors">
                                    <td class="py-8 pl-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-lg font-black text-indigo-400 overflow-hidden shadow-lg">
                                                @if($user->profile_photo)
                                                    <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ substr($user->name, 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('profiles.show', $user) }}" class="font-bold text-white hover:text-indigo-400 transition-colors block">{{ $user->name }}</a>
                                                <div class="text-[10px] text-gray-600 font-bold uppercase tracking-widest truncate max-w-[200px]">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8">
                                        @if($user->role === 'admin')
                                            <span class="px-3 py-1 bg-red-500/10 text-red-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-red-500/20">System Admin</span>
                                        @elseif($user->role === 'owner')
                                            <span class="px-3 py-1 bg-purple-500/10 text-purple-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-purple-500/20">Fleet Host</span>
                                        @else
                                            <span class="px-3 py-1 bg-green-500/10 text-green-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-green-500/20">Client Renter</span>
                                        @endif
                                        @if($user->is_verified)
                                            <div class="flex items-center gap-1.5 mt-2">
                                                <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="text-[8px] font-black text-emerald-500 uppercase">Verified</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-8">
                                        <div class="text-xs font-bold text-gray-400">{{ $user->created_at->format('M d, Y') }}</div>
                                        <div class="text-[9px] text-gray-600 font-bold uppercase mt-1 tracking-widest">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="py-8 text-right pr-8">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="is_blocked" value="{{ $user->is_blocked ? '0' : '1' }}">
                                                <button type="submit" class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all 
                                                    {{ $user->is_blocked 
                                                        ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-600 hover:text-white' 
                                                        : 'bg-red-600/10 text-red-400 border border-red-500/20 hover:bg-red-600 hover:text-white' }}">
                                                    {{ $user->is_blocked ? 'Authorize Access' : 'Invoke Restriction' }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[9px] text-gray-700 font-black uppercase tracking-widest">Active Authority</span>
                                        @endif
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
