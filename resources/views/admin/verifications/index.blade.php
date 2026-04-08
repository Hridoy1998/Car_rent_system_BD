<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Verification Queue') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl relative">
                @if($verifications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-800/50 border-b border-white/10 uppercase text-xs tracking-wider text-gray-400">
                                    <th class="p-4 font-bold">User</th>
                                    <th class="p-4 font-bold">Document</th>
                                    <th class="p-4 font-bold">Preview</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($verifications as $v)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="p-4">
                                            <div class="text-white font-bold">{{ $v->user->name }}</div>
                                            <div class="text-gray-500 text-xs">{{ $v->user->email }}</div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-300">
                                            <span class="px-2 py-1 bg-gray-800 rounded">{{ $v->document_type }}</span>
                                        </td>
                                        <td class="p-4">
                                            <a href="{{ Storage::url($v->document_file) }}" target="_blank" class="block w-16 h-12 bg-gray-800 rounded overflow-hidden border border-white/10 hover:border-indigo-500 transition-colors">
                                                <img src="{{ Storage::url($v->document_file) }}" alt="Doc" class="w-full h-full object-cover">
                                            </a>
                                        </td>
                                        <td class="p-4">
                                            @if($v->status === 'pending')
                                                <span class="px-2 py-1 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 rounded text-xs font-bold uppercase tracking-wider">Pending</span>
                                            @elseif($v->status === 'approved')
                                                <span class="px-2 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded text-xs font-bold uppercase tracking-wider">Approved</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded text-xs font-bold uppercase tracking-wider">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <div class="flex gap-2">
                                                @if($v->status === 'pending')
                                                    <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="px-3 py-1.5 bg-green-500/10 hover:bg-green-500/20 text-green-400 text-xs font-bold uppercase tracking-wider rounded border border-green-500/30">Approve</button>
                                                    </form>
                                                    <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs font-bold uppercase tracking-wider rounded border border-red-500/30">Reject</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center text-gray-400">
                        No verifications in the queue.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
