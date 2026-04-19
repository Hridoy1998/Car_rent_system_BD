<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 px-4 sm:px-0">
            <div class="flex items-center gap-8">
                <a href="{{ route('admin.verifications.index') }}" class="w-14 h-14 bg-white border-2 border-gray-100 flex items-center justify-center rounded-2xl shadow-xl shadow-gray-200/50 group transition-all hover:bg-[#050B1A] hover:border-[#050B1A] active:scale-90">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-4xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                         Audit <span class="text-indigo-600">Detail</span>
                    </h2>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="w-12 h-px bg-indigo-500/30"></span>
                        <p class="text-[9px] md:text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] italic leading-none">
                            IDENTITY AUTHORIZATION RECORD BRIEFING
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white border-2 border-gray-100 p-2 rounded-[1.8rem] shadow-xl shadow-gray-200/50">
                <span class="px-8 py-3 bg-[#050B1A] text-white rounded-[1.2rem] text-[10px] font-black uppercase tracking-widest italic shadow-xl shadow-[#050B1A]/20">
                    RID #{{ str_pad($verification->id, 6, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                {{-- Left: Participant Profile & Decision Hub --}}
                <div class="space-y-10">
                    <!-- Participant Briefing Monolith -->
                    <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50 transition-all group-hover:scale-150"></div>
                        <div class="flex flex-col items-center text-center relative z-10">
                            <div class="w-32 h-32 rounded-[2.5rem] bg-[#050B1A] border-4 border-white shadow-2xl flex items-center justify-center text-5xl font-black text-white italic overflow-hidden mb-8 transition-transform group-hover:scale-105 duration-500">
                                @if($verification->user->profile_photo)
                                    <img src="{{ Storage::url($verification->user->profile_photo) }}" class="w-full h-full object-cover transition-all">
                                @else
                                    {{ strtoupper(substr($verification->user->name, 0, 1)) }}
                                @endif
                            </div>
                            <h3 class="text-3xl font-black text-[#050B1A] uppercase tracking-tighter italic leading-none">{{ $verification->user->name }}</h3>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">{{ $verification->user->email }}</p>
                            
                            <div class="mt-12 grid grid-cols-2 gap-6 w-full">
                                <div class="p-6 bg-gray-50/50 border-2 border-white rounded-[2rem] shadow-inner flex flex-col items-center">
                                    <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-2 italic">Registry State</div>
                                    <div class="text-[11px] font-black uppercase italic {{ $verification->status === 'approved' ? 'text-emerald-500' : ($verification->status === 'rejected' ? 'text-red-500' : 'text-orange-500 animate-pulse') }}">
                                        {{ $verification->status }}
                                    </div>
                                </div>
                                <div class="p-6 bg-gray-50/50 border-2 border-white rounded-[2rem] shadow-inner flex flex-col items-center">
                                    <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-2 italic">Operator Role</div>
                                    <div class="text-[11px] font-black uppercase text-indigo-600 italic">
                                        {{ $verification->user->role }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decision Protocol Hub -->
                    <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)]">
                        <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] mb-10 italic flex items-center gap-3">
                            <span class="w-2 h-6 bg-indigo-600 rounded-full"></span>
                            Decision Protocol
                        </h4>
                        
                        <form action="{{ route('admin.verifications.update', $verification) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            @if($verification->status === 'pending')
                                <button type="submit" name="status" value="approved" class="w-full py-6 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[11px] uppercase tracking-[0.4em] rounded-[2rem] shadow-2xl shadow-emerald-500/20 transition-all transform hover:scale-[1.02] active:scale-[0.98] italic flex items-center justify-center gap-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Authorize Persona
                                </button>
                                <button type="submit" name="status" value="rejected" class="w-full py-6 bg-white border-2 border-red-100 hover:bg-red-600 hover:border-red-600 text-red-500 hover:text-white font-black text-[11px] uppercase tracking-[0.4em] rounded-[2rem] transition-all transform hover:scale-[1.02] active:scale-[0.98] italic flex items-center justify-center gap-4 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Deny Authorization
                                </button>
                            @else
                                <div class="px-8 py-10 bg-gray-50 border-2 border-white rounded-[2.5rem] text-center shadow-inner space-y-4">
                                    <div class="w-16 h-16 bg-white border-2 border-gray-100 rounded-2xl flex items-center justify-center mx-auto shadow-sm">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1 italic">Lifecycle Concluded</p>
                                        <p class="text-xl font-black text-[#050B1A] uppercase italic tracking-tighter">{{ $verification->status }} STATE</p>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Right: Identity Evidence Terminal --}}
                <div class="lg:col-span-2 space-y-12">
                    <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] overflow-hidden">
                        <div class="p-10 md:p-12 border-b-2 border-gray-50 bg-gray-50/30 flex items-center justify-between gap-6">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-[#050B1A] rounded-[1.8rem] flex items-center justify-center text-white italic font-black text-2xl shadow-2xl">ID</div>
                                <div>
                                    <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Identity Evidence</h3>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-2 italic">OPERATOR CREDENTIAL ARTIFACT BRIEFING</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-10 md:p-16 space-y-16">
                            {{-- Parameter Registry --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                <div class="bg-gray-50 border-2 border-white p-8 rounded-[2.5rem] shadow-sm relative group">
                                    <div class="absolute inset-0 bg-indigo-500 opacity-0 group-hover:opacity-5 transition-opacity rounded-[2.5rem]"></div>
                                    <label class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] block mb-6 italic">Registry Identifier (NID)</label>
                                    <div class="text-3xl font-black text-[#050B1A] tracking-tighter italic leading-none uppercase">
                                        {{ $verification->id_number ?: 'NULL_SIGNAL' }}
                                    </div>
                                </div>
                                <div class="bg-gray-50 border-2 border-white p-8 rounded-[2.5rem] shadow-sm relative group">
                                    <div class="absolute inset-0 bg-orange-500 opacity-0 group-hover:opacity-5 transition-opacity rounded-[2.5rem]"></div>
                                    <label class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] block mb-6 italic">Registry Ingestion Epoch</label>
                                    <div class="text-2xl font-black text-[#050B1A] tracking-tighter italic leading-none uppercase">
                                        {{ $verification->created_at->format('M d, Y') }} <span class="text-gray-300 mx-2">|</span> {{ $verification->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </div>

                            {{-- High-Fidelity Image Terminal --}}
                            <div class="space-y-10">
                                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                                    <div>
                                        <h4 class="text-xl font-black text-[#050B1A] uppercase italic italic tracking-tighter">Evidence Monolith</h4>
                                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-1 italic leading-none">Original document artifact scan</p>
                                    </div>
                                    @if($verification->document_file)
                                        <a href="{{ Storage::url($verification->document_file) }}" target="_blank" class="px-8 py-3 bg-[#050B1A] text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-[#050B1A]/20 transition-all hover:bg-indigo-600 italic active:scale-95 leading-none">Full Scale Expansion →</a>
                                    @endif
                                </div>
                                <div class="aspect-video bg-gray-50 border-4 border-white rounded-[3.5rem] md:rounded-[4.5rem] overflow-hidden relative shadow-2xl group cursor-zoom-in">
                                    @if($verification->document_file)
                                        <img src="{{ Storage::url($verification->document_file) }}" class="w-full h-full object-contain p-8 md:p-12 transition-all duration-1000 group-hover:scale-105">
                                        <a href="{{ Storage::url($verification->document_file) }}" target="_blank" class="absolute inset-0 bg-[#050B1A]/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center backdrop-blur-md">
                                            <div class="flex flex-col items-center gap-6">
                                                <div class="w-20 h-20 bg-white/20 border-2 border-white rounded-[2rem] flex items-center justify-center text-white italic font-black text-3xl shadow-2xl">Z</div>
                                                <span class="px-10 py-4 bg-white rounded-2xl text-[10px] font-black text-[#050B1A] uppercase tracking-[0.4em] italic shadow-2xl">Expand Artifact Zoom</span>
                                            </div>
                                        </a>
                                    @else
                                        <div class="flex flex-col items-center justify-center h-full text-gray-200">
                                            <div class="w-24 h-24 bg-gray-100 rounded-[2.5rem] flex items-center justify-center text-5xl mb-6 shadow-inner opacity-30 grayscale">?</div>
                                            <p class="text-[10px] font-black uppercase tracking-[0.4em] italic leading-none">No document artifact detected</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($verification->rejected_reason)
                            <div class="bg-red-50 border-2 border-red-100 p-10 rounded-[3.5rem] shadow-xl shadow-red-500/5 flex flex-col items-center gap-6 animate-in slide-in-from-bottom-4 duration-500">
                                <div class="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center text-white font-black italic shadow-xl text-xl">R</div>
                                <div class="text-center space-y-3">
                                    <h4 class="text-[10px] font-black text-red-600 uppercase tracking-[0.4em] italic">Official Denied Verdict Reassurance</h4>
                                    <p class="text-xl font-black text-red-800 leading-none italic tracking-tighter">"{{ $verification->rejected_reason }}"</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
