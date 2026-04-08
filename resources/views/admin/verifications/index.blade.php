<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('ID Verifications') }}
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
                    <h3 class="text-xl font-bold text-white">Document Queue</h3>
                    
                    <div class="inline-flex bg-gray-950 p-1 rounded-xl border border-white/5">
                        @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $val => $label)
                            <a href="{{ route('admin.verifications.index', ['status' => $val]) }}" 
                               class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $status === $val ? 'bg-indigo-600 text-white shadow' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
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
                                <th class="p-4 font-medium">Document Type</th>
                                <th class="p-4 font-medium">File</th>
                                <th class="p-4 font-medium">Submitted</th>
                                <th class="p-4 font-medium text-right rounded-tr-xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($verifications as $verification)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="p-4">
                                        <div class="font-bold text-white">{{ $verification->user->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $verification->user->email }}</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-800 text-gray-300 border border-white/10 uppercase tracking-wider">
                                            {{ $verification->document_type }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ Storage::url($verification->document_file) }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            View Document
                                        </a>
                                    </td>
                                    <td class="p-4 text-gray-400 text-sm">
                                        {{ $verification->created_at->diffForHumans() }}
                                    </td>
                                    <td class="p-4 text-right">
                                        @if($verification->status === 'pending')
                                            <div class="flex items-center justify-end gap-2">
                                                <form action="{{ route('admin.verifications.update', $verification) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" onclick="return confirm('Approve this document?')" class="px-3 py-1.5 bg-green-500/10 hover:bg-green-500/20 text-green-400 rounded-lg text-sm font-medium transition-colors border border-green-500/20">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.verifications.update', $verification) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" onclick="return confirm('Reject this document?')" class="px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg text-sm font-medium transition-colors border border-red-500/20">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 capitalize">{{ $verification->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500">No verifications found in this queue.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $verifications->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
