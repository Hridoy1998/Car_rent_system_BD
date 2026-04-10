<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.verifications.index') }}" class="p-3 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/10 transition-all group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-3xl text-white tracking-tighter uppercase italic">
                         Operator Identity Audit
                    </h2>
                    <p class="text-[10px] text-purple-400 font-black uppercase tracking-[0.3em] mt-1 italic">Credential Authentication & Trust Protocol</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="px-4 py-2 bg-purple-500/10 text-purple-400 border border-purple-500/20 rounded-xl text-[10px] font-black uppercase tracking-widest">
                    RID: #{{ str_pad($verification->id, 6, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-purple-600/5 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                {{-- Left: Participant Profile --}}
                <div class="space-y-8">
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-purple-600 to-indigo-600 p-1 mb-6 shadow-2xl shadow-purple-500/20">
                                <div class="w-full h-full rounded-[1.8rem] bg-gray-900 flex items-center justify-center text-3xl font-black text-white">
                                    @if($verification->user->profile_photo)
                                        <img src="{{ asset('storage/' . $verification->user->profile_photo) }}" class="w-full h-full object-cover rounded-[1.8rem]">
                                    @else
                                        {{ strtoupper(substr($verification->user->name, 0, 1)) }}
                                    @endif
                                </div>
                            </div>
                            <h3 class="text-xl font-black text-white uppercase tracking-tight">{{ $verification->user->name }}</h3>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">{{ $verification->user->email }}</p>
                            
                            <div class="mt-8 grid grid-cols-2 gap-4 w-full">
                                <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                                    <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest mb-1">Status</div>
                                    <div class="text-[10px] font-black uppercase {{ $verification->status === 'approved' ? 'text-emerald-400' : ($verification->status === 'rejected' ? 'text-red-500' : 'text-amber-500') }}">
                                        {{ $verification->status }}
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                                    <div class="text-[8px] text-gray-600 font-black uppercase tracking-widest mb-1">Role</div>
                                    <div class="text-[10px] font-black uppercase text-indigo-400">
                                        {{ $verification->user->role }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl">
                        <h4 class="text-[10px] font-black text-white uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.5)]"></span>
                            Audit Actions
                        </h4>
                        
                        <form action="{{ route('admin.verifications.update', $verification) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            @if($verification->status === 'pending')
                                <button type="submit" name="status" value="approved" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-emerald-600/20 transition-all hover:scale-[1.02]">
                                    Approve Credentials
                                </button>
                                <button type="submit" name="status" value="rejected" class="w-full py-4 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl border border-red-500/20 transition-all">
                                    Reject Identity
                                </button>
                            @else
                                <div class="p-6 bg-white/5 border border-white/10 rounded-2xl text-center">
                                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">This audit is concluded</p>
                                    <p class="text-xs font-black text-white uppercase mt-2 italic">Status: {{ strtoupper($verification->status) }}</p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Right: Identity Evidence --}}
                <div class="lg:col-span-2 space-y-10">
                    <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                        <div class="p-10 border-b border-white/5 bg-white/[0.01]">
                            <h3 class="text-xl font-black text-white italic tracking-tight">DOCUMENTATION CLEARANCE</h3>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">High-resolution scans and biometric proof</p>
                        </div>
                        
                        <div class="p-10 space-y-12">
                            {{-- Field Pairs --}}
                            <div class="grid grid-cols-2 gap-10">
                                <div>
                                    <label class="text-[9px] text-gray-600 font-black uppercase tracking-widest block mb-4 italic">National Identification Number</label>
                                    <div class="text-lg font-black text-white tracking-widest italic border-b border-white/5 pb-2">
                                        {{ $verification->id_number ?: 'NOT_LOGGED' }}
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[9px] text-gray-600 font-black uppercase tracking-widest block mb-4 italic">Submission Epoch</label>
                                    <div class="text-sm font-black text-gray-400 border-b border-white/5 pb-2">
                                        {{ $verification->created_at->format('F d, Y | H:i:s v') }}
                                    </div>
                                </div>
                            </div>

                            {{-- Image Display --}}
                            <div class="space-y-6">
                                <label class="text-[9px] text-gray-600 font-black uppercase tracking-widest block italic">ID Asset Scan</label>
                                <div class="aspect-video bg-gray-950 border border-white/10 rounded-[2.5rem] overflow-hidden relative group">
                                    @if($verification->id_image)
                                        <img src="{{ Storage::url($verification->id_image) }}" class="w-full h-full object-contain p-4 group-hover:scale-[1.01] transition-transform duration-700">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                            <span class="px-6 py-3 bg-white/10 backdrop-blur-md rounded-2xl text-[10px] font-black text-white uppercase tracking-widest border border-white/20">Magnify Mode Active</span>
                                        </div>
                                    @else
                                        <div class="flex flex-col items-center justify-center h-full text-gray-800">
                                            <svg class="w-16 h-16 mb-4 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest italic">Asset missing from core database</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($verification->rejected_reason)
                            <div class="p-8 bg-red-500/5 border border-red-500/20 rounded-3xl">
                                <h4 class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-2 italic">Rejection Signal Reason</h4>
                                <p class="text-sm font-bold text-gray-400 leading-relaxed italic">"{{ $verification->rejected_reason }}"</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
