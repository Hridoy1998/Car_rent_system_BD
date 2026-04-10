<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 rounded-[2rem] bg-gray-900 border border-white/10 flex items-center justify-center text-3xl font-black text-indigo-400 shadow-2xl overflow-hidden">
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <h2 class="font-black text-3xl text-white leading-tight uppercase italic tracking-tighter">
                        Refactor Identity <span class="text-indigo-500">#{{ $user->id }}</span>
                    </h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.3em] mt-1 italic">Modifying platform permissions and core metadata</p>
                </div>
            </div>
            <a href="{{ route('admin.users.show', $user) }}" class="px-8 py-3 bg-white/5 text-gray-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all border border-white/5">Abort Refactor</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf @method('PUT')
                
                <!-- Core Identity Parameters -->
                <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl space-y-12">
                     <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                        <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                        Biological & Virtual Metadata
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Legal Name / Moniker</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-bold tracking-tight focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Communication Node (Email)</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-bold tracking-tight focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Contact Pulse (Phone)</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Authorization Role</label>
                            <select name="role" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-indigo-400 font-black uppercase tracking-widest text-xs focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Client Renter</option>
                                <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Fleet Host</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Supreme Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Identity Avatar (Neural Image)</label>
                        <div class="flex items-center gap-6 p-6 bg-gray-950 border border-white/5 rounded-[2rem]">
                            <div class="w-20 h-20 rounded-2xl bg-gray-900 border border-white/10 overflow-hidden flex-shrink-0">
                                @if($user->profile_photo)
                                    <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-700 font-black uppercase italic text-xs">NO IMG</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="profile_photo" class="text-[10px] text-gray-500 font-bold uppercase tracking-widest file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 transition-all cursor-pointer">
                                <p class="text-[8px] text-gray-700 mt-2 font-bold uppercase tracking-widest italic">Supported Formats: JPG, PNG, WEBP (Max 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Security Override -->
                    <div class="pt-6 border-t border-white/5 space-y-10">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-red-500 rounded-full"></span>
                            Security Protocol Override
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">New Access Cipher</label>
                                <input type="password" name="password" placeholder="••••••••" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-bold focus:ring-2 focus:ring-red-500 outline-none transition-all">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Verify Cipher</label>
                                <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-white font-bold focus:ring-2 focus:ring-red-500 outline-none transition-all">
                            </div>
                        </div>
                        <div class="p-6 bg-red-500/5 border border-red-500/10 rounded-2xl">
                            <p class="text-[9px] text-red-400 font-black uppercase tracking-widest italic">Critical Note: Leave blank if current access security is to remain intact.</p>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-6 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-sm uppercase tracking-[0.4em] rounded-[2rem] shadow-2xl shadow-indigo-600/20 transition-all transform hover:scale-[1.01] active:scale-[0.98]">Commit Identity Refactor</button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 p-8 rounded-[2.5rem] space-y-2">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-3 text-red-500 text-[10px] font-black uppercase tracking-widest">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </form>

        </div>
    </div>
</x-app-layout>
