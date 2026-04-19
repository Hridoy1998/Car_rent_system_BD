<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0 text-center md:text-left">
            <div class="w-full md:w-auto">
                <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Mission <span class="text-indigo-600">Authorize</span>
                </h2>
                <div class="flex items-center justify-center md:justify-start gap-4 mt-4 md:mt-3">
                    <span class="w-8 md:w-12 h-px bg-indigo-500/30"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] italic leading-none">
                        AUTHORIZATION QUEUE
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 bg-white border-2 border-gray-100 p-2 rounded-[1.8rem] shadow-xl shadow-gray-200/50 w-full md:w-auto justify-between md:justify-start">
                <div class="px-6 md:px-8 py-3 bg-[#050B1A] text-white rounded-[1.2rem] text-[10px] font-black uppercase tracking-widest italic shadow-xl shadow-[#050B1A]/20">
                    Active Queue
                </div>
                <div class="px-6 py-3 text-[#050B1A] font-black text-xl italic tracking-tighter shrink-0">
                    {{ $verifications->total() }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 md:py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A] px-4 md:px-0">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 md:space-y-10 relative z-10">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-2 border-emerald-100 text-emerald-600 p-6 rounded-[2rem] font-bold text-sm flex items-center gap-4 shadow-xl shadow-emerald-500/5 animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-emerald-500 rounded-xl md:rounded-2xl flex items-center justify-center text-white shadow-lg shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-widest italic mb-0.5">Authorization Updated</p>
                        <p class="text-xs font-bold italic tracking-tight opacity-90 leading-tight">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Tactical Search & Action Manifest -->
            <div class="bg-white border-2 border-gray-100 p-6 md:p-8 rounded-[2.5rem] md:rounded-[3rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] flex flex-col md:flex-row gap-6 md:gap-8 items-center justify-between group">
                <div class="flex-1 w-full">
                    <x-search-bar :route="route('admin.verifications.index')" placeholder="Audit queue by persona or status..." />
                </div>
                <div class="px-6 py-3.5 bg-gray-50 border-2 border-white rounded-xl shadow-inner text-gray-400 text-[9px] font-black uppercase tracking-widest italic leading-none w-full md:w-auto text-center">
                    Search Intelligence Active
                </div>
            </div>

            <!-- Verification Terminal Manifest -->
            <div class="space-y-6 md:space-y-0">
                @if($verifications->count() > 0)
                    <!-- Desktop Table View -->
                    <div class="hidden md:block bg-white border-2 border-gray-100 overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] rounded-[4.5rem] transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/50 text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 italic">
                                        <th class="py-8 pl-12 whitespace-nowrap">Participant Identity</th>
                                        <th class="py-8 px-6 whitespace-nowrap">Schema</th>
                                        <th class="py-8 px-6 whitespace-nowrap">Artifact</th>
                                        <th class="py-8 pr-12 text-right whitespace-nowrap">Audit Lifecycle</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($verifications as $v)
                                        <tr class="group hover:bg-gray-50/20 transition-all duration-500 cursor-pointer" onclick="if(!event.target.closest('button') && !event.target.closest('a')) window.location='{{ route('admin.verifications.show', $v) }}'">
                                            <td class="py-10 pl-12 whitespace-nowrap">
                                                <div class="flex items-center gap-6">
                                                    <div class="w-16 h-16 rounded-[1.8rem] bg-[#050B1A] border-4 border-white flex items-center justify-center text-xl font-black text-white italic shadow-2xl overflow-hidden shrink-0 group-hover:scale-105 transition-transform duration-500">
                                                        @if($v->user->profile_photo)
                                                            <img src="{{ Storage::url($v->user->profile_photo) }}" class="w-full h-full object-cover transition-all">
                                                        @else
                                                            {{ strtoupper(substr($v->user->name, 0, 1)) }}
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="text-[15px] font-black text-[#050B1A] uppercase italic tracking-tighter leading-none mb-1">{{ $v->user->name }}</div>
                                                        <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">{{ $v->user->email }} Registry</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-10 px-6 whitespace-nowrap">
                                                <span class="px-5 py-2 bg-indigo-50 border-2 border-indigo-100 rounded-xl text-[10px] font-black text-indigo-600 uppercase tracking-widest italic shadow-sm">{{ $v->document_type }}</span>
                                            </td>
                                            <td class="py-10 px-6 whitespace-nowrap">
                                                <div class="relative group/evidence">
                                                    <a href="{{ Storage::url($v->document_file) }}" target="_blank" class="block w-24 h-16 bg-gray-50 border-4 border-white rounded-[1.5rem] overflow-hidden shadow-xl hover:shadow-indigo-500/10 transition-all group-hover/evidence:scale-110 group-hover/evidence:rotate-2">
                                                        <img src="{{ Storage::url($v->document_file) }}" alt="Artifact" class="w-full h-full object-cover">
                                                    </a>
                                                    <div class="absolute -top-2 -right-2 bg-[#050B1A] w-6 h-6 rounded-lg text-white text-[8px] flex items-center justify-center font-black italic shadow-lg pointer-events-none opacity-0 group-hover/evidence:opacity-100 transition-opacity">IMG</div>
                                                </div>
                                            </td>
                                            <td class="py-10 pr-12 text-right whitespace-nowrap">
                                                <div class="flex items-center justify-end gap-6 overflow-hidden pr-2">
                                                    <div class="flex flex-col items-end">
                                                        @if($v->status === 'pending')
                                                            <span class="px-4 py-1.5 bg-orange-50 text-orange-600 border-2 border-orange-100 rounded-xl text-[9px] font-black uppercase tracking-widest italic animate-pulse shadow-sm">Awaiting Audit</span>
                                                        @elseif($v->status === 'approved')
                                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 border-2 border-emerald-100 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">Authorized</span>
                                                        @else
                                                            <span class="px-4 py-1.5 bg-red-50 text-red-600 border-2 border-red-100 rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-sm">Denied</span>
                                                        @endif
                                                    </div>

                                                    <div class="flex gap-3 opacity-0 translate-x-12 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-700">
                                                        <a href="{{ route('admin.verifications.show', $v) }}" class="w-12 h-12 bg-white hover:bg-[#050B1A] text-gray-400 hover:text-white rounded-2xl border-2 border-gray-100 flex items-center justify-center transition-all shadow-sm hover:shadow-2xl hover:shadow-[#050B1A]/20" title="Full Evidence Audit">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                        </a>
                                                        @if($v->status === 'pending')
                                                            <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="status" value="approved">
                                                                <button type="submit" class="w-12 h-12 bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white rounded-2xl border-2 border-emerald-100 flex items-center justify-center transition-all shadow-sm hover:shadow-xl hover:shadow-emerald-500/20 active:scale-95" title="Grant Authorization Protocol">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button type="submit" class="w-12 h-12 bg-red-50 hover:bg-red-600 text-red-500 hover:text-white rounded-2xl border-2 border-red-100 flex items-center justify-center transition-all shadow-sm hover:shadow-xl hover:shadow-red-600/20 active:scale-95" title="Deny Authorization Protocol">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
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
                    </div>

                    <!-- Mobile Card View -->
                    <div class="grid grid-cols-1 gap-6 md:hidden">
                        @foreach($verifications as $v)
                            <div class="bg-white border-2 border-gray-100 p-6 rounded-[2.5rem] shadow-xl space-y-6" onclick="if(!event.target.closest('button') && !event.target.closest('a')) window.location='{{ route('admin.verifications.show', $v) }}'">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 rounded-2xl bg-[#050B1A] border-4 border-white flex items-center justify-center text-lg font-black text-white italic shadow-lg overflow-hidden shrink-0">
                                        @if($v->user->profile_photo)
                                            <img src="{{ Storage::url($v->user->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($v->user->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-black text-[#050B1A] uppercase italic truncate tracking-tight">{{ $v->user->name }}</div>
                                        <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest truncate italic">{{ $v->user->email }}</div>
                                    </div>
                                    @if($v->status === 'pending')
                                        <div class="w-3 h-3 bg-orange-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(249,115,22,0.5)]"></div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-3 bg-gray-50 border-2 border-white rounded-2xl shadow-inner">
                                        <div class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic mb-1">Schema</div>
                                        <div class="text-[9px] font-black text-indigo-600 uppercase italic">{{ $v->document_type }}</div>
                                    </div>
                                    <div class="p-3 bg-gray-50 border-2 border-white rounded-2xl shadow-inner">
                                        <div class="text-[8px] text-gray-400 font-black uppercase tracking-widest italic mb-1">Status</div>
                                        <div class="text-[9px] font-black uppercase italic {{ $v->status === 'approved' ? 'text-emerald-500' : ($v->status === 'rejected' ? 'text-red-500' : 'text-orange-500') }}">
                                            {{ $v->status }}
                                        </div>
                                    </div>
                                </div>

                                <div class="relative rounded-2xl overflow-hidden border-4 border-white shadow-lg aspect-video">
                                    <img src="{{ Storage::url($v->document_file) }}" alt="Evidence" class="w-full h-full object-cover">
                                    <div class="absolute bottom-3 right-3">
                                        <a href="{{ Storage::url($v->document_file) }}" target="_blank" class="px-4 py-2 bg-[#050B1A]/80 backdrop-blur-md text-white text-[8px] font-black uppercase tracking-widest rounded-lg border border-white/20 italic">Expand Artifact</a>
                                    </div>
                                </div>

                                <div class="flex gap-3 pt-2">
                                    <a href="{{ route('admin.verifications.show', $v) }}" class="flex-1 py-3 bg-white border-2 border-gray-100 text-[#050B1A] font-black text-[9px] uppercase tracking-[0.2em] rounded-xl flex items-center justify-center gap-2 italic shadow-sm leading-none">
                                        Full Audit
                                    </a>
                                    @if($v->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="w-11 h-11 bg-emerald-500 text-white rounded-xl shadow-lg flex items-center justify-center active:scale-90 transition-transform">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.verifications.update', $v) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="w-11 h-11 bg-red-600 text-white rounded-xl shadow-lg flex items-center justify-center active:scale-90 transition-transform">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-32 text-center bg-white border-2 border-gray-100 rounded-[3rem] md:rounded-[4.5rem] shadow-sm">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-gray-50 rounded-[2rem] md:rounded-[2.5rem] flex items-center justify-center text-3xl md:text-4xl mx-auto mb-8 shadow-inner grayscale opacity-30 italic font-black">ID</div>
                        <h3 class="text-[#050B1A] font-black uppercase tracking-[0.4em] text-xs italic">Registry Signals Null</h3>
                        <p class="text-gray-400 text-[10px] italic mt-2 uppercase tracking-widest font-bold px-8">No active identities detected in the authorization queue at this epoch.</p>
                    </div>
                @endif
            </div>

             @if($verifications->hasPages())
                <div class="mt-8 md:mt-10">
                    <div class="p-6 md:p-10 bg-white border-2 border-gray-100 rounded-[2.5rem] md:rounded-[4.5rem] shadow-sm">
                        {{ $verifications->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
