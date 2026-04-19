<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div class="flex items-center gap-8">
                <div class="w-20 h-20 rounded-[2rem] bg-[#050B1A] border-4 border-white shadow-2xl flex items-center justify-center text-3xl font-black text-white italic overflow-hidden shrink-0">
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <h2 class="font-black text-4xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                        Identity <span class="text-indigo-500">Calibration</span>
                    </h2>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="w-8 h-px bg-indigo-500/30"></span>
                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.4em] italic leading-none">
                            RECONFIGURING ARTIFACT #{{ $user->id }} | {{ $user->name }}
                        </p>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('admin.users.show', $user) }}" class="px-8 py-3.5 bg-white border-2 border-gray-100 text-gray-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:border-red-500 hover:text-red-500 transition-all italic active:scale-95 leading-none shadow-sm">Abort Refactor</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf @method('PUT')
                
                <!-- Main Calibration Monolith -->
                <div class="bg-white border-2 border-gray-100 p-10 md:p-16 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] space-y-16">
                     <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] italic flex items-center gap-3">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        Parameter Calibration Grid
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Identity Parameters -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Legal Name Moniker</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic shadow-inner">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Communication Node (Email)</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic shadow-inner">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Contact Pulse (Phone)</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black tracking-widest text-xs focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic shadow-inner">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Authorization Protocol (Role)</label>
                            <select name="role" class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-indigo-600 font-black uppercase tracking-widest text-[10px] focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic appearance-none shadow-inner cursor-pointer">
                                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Client Renter Protocol</option>
                                <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Fleet Host Protocol</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Institutional Admin State</option>
                            </select>
                        </div>
                    </div>

                    <!-- Visual Proxy Management -->
                    <div class="space-y-6">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Visual Proxy Terminal (Avatar)</label>
                        <div class="flex items-center gap-10 p-10 bg-gray-50/50 border-2 border-white rounded-[2.5rem] shadow-inner group">
                            <div class="w-24 h-24 rounded-[1.8rem] bg-white border-4 border-white overflow-hidden shadow-2xl transition-transform group-hover:rotate-6">
                                @if($user->profile_photo)
                                    <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#050B1A]/20 font-black uppercase italic text-xs bg-gray-50">Null Proxy</div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-4">
                                <div class="relative group/input">
                                    <input type="file" name="profile_photo" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                    <div class="px-8 py-4 bg-white border-2 border-gray-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-indigo-600 group-hover/input:bg-indigo-600 group-hover/input:text-white transition-all italic text-center leading-none">Ingest New Artifact</div>
                                </div>
                                <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest italic text-center">Supported Nodes: JPG, PNG, WEBP artifact encryption (Max 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Security Protocol Override -->
                    <div class="pt-16 border-t-2 border-gray-50 space-y-12">
                         <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.4em] italic flex items-center gap-3">
                            <span class="w-2 h-6 bg-red-600 rounded-full shadow-[0_0_15px_rgba(239,68,68,0.3)]"></span>
                            Security Protocol Recalibration
                        </h4>
                        
                        <div class="bg-red-50/50 border-2 border-white p-10 rounded-[2.5rem] shadow-sm space-y-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-4">
                                    <label class="text-[9px] font-black text-red-400 uppercase tracking-widest italic ms-4">New Access Cipher</label>
                                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-white border-2 border-red-50 rounded-2xl p-5 text-[#050B1A] font-black focus:ring-8 focus:ring-red-500/5 focus:border-red-500 outline-none transition-all italic shadow-sm">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[9px] font-black text-red-400 uppercase tracking-widest italic ms-4">Verify Cipher Artifact</label>
                                    <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-white border-2 border-red-50 rounded-2xl p-5 text-[#050B1A] font-black focus:ring-8 focus:ring-red-500/5 focus:border-red-500 outline-none transition-all italic shadow-sm">
                                </div>
                            </div>
                            <div class="p-6 bg-white border-2 border-red-50 rounded-[1.8rem] flex items-center gap-6">
                                <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-500 font-black italic shadow-inner">!</div>
                                <p class="text-[9px] text-red-500 font-black uppercase tracking-widest italic leading-relaxed">Critical Recalibration Note: Leave blank if current access security protocols are to remain in place.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 text-center">
                        <button type="submit" class="w-full px-16 py-6 bg-[#050B1A] hover:bg-indigo-600 text-white font-black text-xs uppercase tracking-[0.5em] rounded-[2rem] shadow-2xl shadow-[#050B1A]/20 transition-all transform hover:scale-[1.02] active:scale-[0.98] italic">Commit Identity Refactor</button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border-2 border-red-100 p-10 rounded-[3rem] shadow-xl shadow-red-500/5 flex flex-col items-center gap-6">
                        <div class="w-12 h-12 bg-red-500 rounded-2xl flex items-center justify-center text-white font-black italic shadow-lg">!</div>
                        <div class="space-y-4 text-center">
                            @foreach ($errors->all() as $error)
                                <div class="text-red-600 text-[10px] font-black uppercase tracking-widest italic">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>

        </div>
    </div>
</x-app-layout>
