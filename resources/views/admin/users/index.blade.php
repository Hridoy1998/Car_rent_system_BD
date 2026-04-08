<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12 text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-white/10 overflow-hidden shadow-xl sm:rounded-2xl p-6 relative">
                
                @if (session('success'))
                    <div class="mb-4 bg-green-500/10 border border-green-500/50 text-green-400 p-4 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-xl font-bold text-white">Platform Users</h3>
                    
                    <div class="inline-flex bg-gray-950 p-1 rounded-xl border border-white/5">
                        @foreach(['all' => 'All', 'customer' => 'Customers', 'owner' => 'Owners', 'admin' => 'Admins'] as $val => $label)
                            <a href="{{ route('admin.users.index', ['role' => $val]) }}" 
                               class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $Role === $val ? 'bg-indigo-600 text-white shadow' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 text-xs uppercase tracking-wider text-gray-500 bg-gray-950/50">
                                <th class="p-4 font-medium rounded-tl-xl">User</th>
                                <th class="p-4 font-medium">Role</th>
                                <th class="p-4 font-medium">Joined</th>
                                <th class="p-4 font-medium">Status / Verification</th>
                                <th class="p-4 font-medium text-right rounded-tr-xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($users as $user)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-white">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium uppercase tracking-wider
                                            @if($user->role === 'admin') bg-purple-500/10 text-purple-400 border border-purple-500/20
                                            @elseif($user->role === 'owner') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                            @else bg-gray-800 text-gray-300 border border-white/10 @endif">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-400 text-sm">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-1">
                                            @if($user->is_blocked)
                                                <span class="inline-flex w-fit items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/10 text-red-500 border border-red-500/20">
                                                    Blocked
                                                </span>
                                            @else
                                                <span class="inline-flex w-fit items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                                                    Active
                                                </span>
                                            @endif
                                            
                                            @if($user->is_verified)
                                                <span class="text-xs text-blue-400 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                    ID Verified
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-500">Unverified</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 text-right">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline-block">
                                                @csrf @method('PUT')
                                                @if($user->is_blocked)
                                                    <input type="hidden" name="is_blocked" value="0">
                                                    <button type="submit" class="px-3 py-1.5 bg-gray-800 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition-colors border border-white/10">
                                                        Unblock
                                                    </button>
                                                @else
                                                    <input type="hidden" name="is_blocked" value="1">
                                                    <button type="submit" onclick="return confirm('Are you sure you want to block this user? They will be unable to log in.')" class="px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg text-sm font-medium transition-colors border border-red-500/20">
                                                        Block
                                                    </button>
                                                @endif
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-500 italic">You</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
