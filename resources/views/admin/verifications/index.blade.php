<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Identity Authorization') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Audit and verify platform participant credentials</p>
            </div>
            <div class="flex items-center gap-4">
                 <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Active Queue: {{ $verifications->total() }} Identities</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden text-slate-200">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-6 rounded-[2rem] font-black text-xs uppercase tracking-widest flex items-center gap-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tactical Identity Search -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between">
                <x-search-bar :route="route('admin.verifications.index')" placeholder="Search by name, email, or status..." />
            </div>

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                @if($verifications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                    <th class="py-8 pl-8">Participant Identity</th>
                                    <th class="py-8">Authorization Schema</th>
                                    <th class="py-8">Evidence Artifact</th>
                                    <th class="py-8 text-right pr-8">Audit Lifecycle</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($verifications as $v)
                                    <tr class="group hover:bg-white/[0.02] transition-colors">
                                        <td class="py-8 pl-8">
                                            <div class="text-sm font-bold text-white">{{ $v->user->name }}</div>
                                            <div class="text-gray-600 text-[9px] font-black uppercase tracking-widest mt-1">{{ $v->user->email }}</div>
                                        </td>
                                        <td class="py-8">
                                            <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $v->document_type }}</span>
                                        </td>
                                        <td class="py-8">
                                            <a href="{{ Storage::url($v->document_file) }}" target="_blank" class="block w-20 h-14 bg-gray-950 rounded-2xl overflow-hidden border border-white/10 hover:border-indigo-500 transition-all shadow-lg group-hover:scale-105">
                                                <img src="{{ Storage::url($v->document_file) }}" alt="Doc" class="w-full h-full object-cover">
                                            </a>
                                        </td>
                                        <td class="py-8">
                                            <div class="flex items-center justify-end gap-3">
                                                 @if($v->status === 'pending')
                                                    <span class="px-3 py-1.5 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest animate-pulse">Awaiting Audit</span>
                                                @elseif($v->status === 'approved')
                                                    <span class="px-3 py-1.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">Authorized</span>
                                                @else
                                                    <span class="px-3 py-1.5 bg-red-500/10 text-red-500 border border-red-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">Denied</span>
                                                @endif

                                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <a href="{{ route('admin.verifications.show', $v) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all shadow-lg" title="Detailed Audit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    </a>
                                                    @if($v->status === 'pending')
                                                        <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="p-2.5 bg-emerald-600/10 hover:bg-emerald-600 text-emerald-400 hover:text-white rounded-xl border border-emerald-500/20 transition-all shadow-lg shadow-emerald-600/10" title="Grant Authorization">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="p-2.5 bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white rounded-xl border border-red-500/20 transition-all shadow-lg shadow-red-600/10" title="Deny Authorization">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
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
