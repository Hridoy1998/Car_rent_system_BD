<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left: Profile Preview & Photo -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 text-center shadow-2xl sticky top-28">
                        <div class="relative inline-block group mb-6">
                            <div class="w-32 h-32 rounded-[2.5rem] overflow-hidden bg-gray-800 border-2 border-indigo-500 shadow-[0_0_30px_rgba(79,70,229,0.3)] mx-auto relative">
                                @if(auth()->user()->profile_photo)
                                    <img src="{{ Storage::url(auth()->user()->profile_photo) }}" class="w-full h-full object-cover" id="avatar-preview">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-4xl font-black text-indigo-400 bg-indigo-500/10" id="avatar-placeholder">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <label for="profile_photo" class="absolute inset-0 bg-black/60 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-[10px] font-black uppercase tracking-widest">
                                    Change Photo
                                </label>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-xs text-indigo-400 font-bold uppercase tracking-widest mt-1">{{ auth()->user()->role }}</p>

                        <div class="mt-8 pt-8 border-t border-white/5 space-y-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-500 font-bold uppercase tracking-widest">Verification Status</span>
                                <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-black uppercase text-[9px]">{{ auth()->user()->is_verified ? 'Verified' : 'Pending' }}</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-500 font-bold uppercase tracking-widest">Joined</span>
                                <span class="text-gray-300 font-mono">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Detailed Forms -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Bio & Personal Info -->
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-10 shadow-2xl">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 border border-indigo-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-white">Personal Blueprint</h4>
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Update your identity and reachability</p>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('patch')
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" onchange="previewAvatar(event)">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ms-2">Full Name</label>
                                    <x-text-input id="name" name="name" type="text" class="w-full bg-gray-950 border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500" :value="old('name', $user->name)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ms-2">Email Identity</label>
                                    <x-text-input id="email" name="email" type="email" class="w-full bg-gray-950 border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500" :value="old('email', $user->email)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ms-2">Phone Contact</label>
                                    <input id="phone" name="phone" type="text" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500 outline-none transition-all" value="{{ old('phone', $user->phone) }}" placeholder="+880 1XXX-XXXXXX" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ms-2">Home Base (Address)</label>
                                    <input id="address" name="address" type="text" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500 outline-none transition-all" value="{{ old('address', $user->address) }}" placeholder="e.g. Dhaka, Bangladesh" />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ms-2">Short Bio</label>
                                <textarea id="bio" name="bio" rows="4" class="w-full bg-gray-950 border border-white/5 rounded-3xl p-5 text-white focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm leading-relaxed" placeholder="Tell the community about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button type="submit" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-2xl transition-all shadow-xl shadow-indigo-600/20 uppercase tracking-widest text-xs">Save Changes</button>
                                
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-emerald-400 font-bold"
                                    >{{ __('Updated successfully.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Security: Password -->
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-10 shadow-2xl">
                         <div class="flex items-center gap-4 mb-10">
                            <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-400 border border-purple-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-white">Encrypted Core</h4>
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Update your security credentials</p>
                            </div>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-red-500/5 border border-red-500/10 rounded-[2.5rem] p-10 shadow-2xl">
                         <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 bg-red-500/10 rounded-xl flex items-center justify-center text-red-500 border border-red-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-red-400">Purge Memory</h4>
                                <p class="text-[10px] text-gray-600 font-black uppercase tracking-widest">Destroy this account permanently</p>
                            </div>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('avatar-preview') || document.getElementById('avatar-placeholder');
                if(output.tagName === 'IMG') {
                    output.src = reader.result;
                } else {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.className = 'w-full h-full object-cover';
                    img.id = 'avatar-preview';
                    output.parentNode.replaceChild(img, output);
                }
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
