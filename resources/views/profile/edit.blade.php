<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 leading-tight uppercase tracking-[0.2em] italic">
            {{ __('Identity Registry') }}
        </h2>
    </x-slot>

    <!-- Institutional Hero: Identity Safeguard Banner -->
    <div class="relative py-16 md:py-24 mb-8 md:mb-12 -mt-12 overflow-hidden rounded-b-[2rem] md:rounded-b-[4rem] group">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110" style="background-image: url('{{ asset('images/assets/institutional_safety_banner.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl" data-aos="fade-right">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-orange-500/10 border border-orange-500/20 rounded-xl mb-6 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] italic">Identity Protocol Active</span>
                </div>
                <h1 class="text-4xl md:text-7xl font-black text-white uppercase tracking-tighter italic leading-[0.9]">
                    Identity <br> <span class="text-orange-500">Safeguard.</span>
                </h1>
                <p class="text-gray-300 font-bold text-xs uppercase tracking-[0.3em] mt-6 italic opacity-80 leading-relaxed max-w-md">
                    Managing administrative credentials and persona integrity with institutional precision.
                </p>
            </div>
        </div>
    </div>

    <div class="pb-24 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
                
                <!-- Left: Identity Pulse & Visual Identity -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 lg:p-10 text-center shadow-[0_40px_100px_rgba(0,0,0,0.03)] sticky top-28 transition-all hover:translate-y-[-4px]">
                        <div class="relative inline-block group mb-8">
                            <div class="w-32 h-32 md:w-36 md:h-36 rounded-[2.5rem] overflow-hidden bg-gray-50 border-2 border-orange-500 shadow-xl mx-auto relative group-hover:shadow-orange-500/20 transition-all">
                                @if(auth()->user()->profile_photo)
                                    <img src="{{ Storage::url(auth()->user()->profile_photo) }}" class="w-full h-full object-cover" id="avatar-preview">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-5xl font-black text-orange-500 bg-orange-500/5 italic" id="avatar-placeholder">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <label for="profile_photo" class="absolute inset-0 bg-[#050B1A]/80 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-[10px] font-black uppercase tracking-[0.3em] italic backdrop-blur-sm">
                                    Override Asset
                                </label>
                            </div>
                        </div>

                        <h3 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">{{ auth()->user()->name }}</h3>
                        <div class="inline-flex items-center gap-2 mt-3 px-3 py-1 bg-gray-50 border border-gray-100 rounded-lg">
                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                            <p class="text-[9px] text-gray-500 font-black uppercase tracking-[0.2em] italic">{{ auth()->user()->role }} Account</p>
                        </div>

                        <div class="mt-10 pt-10 border-t border-gray-50 space-y-6">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">Integrity Status</span>
                                <span class="px-3 py-1 rounded-lg {{ auth()->user()->is_verified ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-orange-50 text-orange-600 border border-orange-100' }} font-black uppercase text-[8px] tracking-widest italic">
                                    {{ auth()->user()->is_verified ? 'Verified Asset' : 'Pending Verification' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">Commissioned</span>
                                <span class="text-[#050B1A] font-black text-[10px] uppercase tracking-tighter italic">{{ auth()->user()->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Management Blueprints -->
                <div class="lg:col-span-2 space-y-8 md:space-y-12">
                    
                    <!-- Form Phase: Information Registry -->
                    <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 md:p-14 shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:shadow-2xl">
                        <div class="flex items-center gap-6 mb-12">
                            <div class="w-14 h-14 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl">
                                ID
                            </div>
                            <div>
                                <h4 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Persona Blueprint</h4>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.3em] mt-2 italic items-center flex gap-3">
                                    Operational ID Management
                                    <span class="w-8 h-px bg-gray-100"></span>
                                </p>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-10">
                            @csrf
                            @method('patch')
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" onchange="previewAvatar(event)">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Full Legal Name</label>
                                    <input id="name" name="name" type="text" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-300" value="{{ old('name', $user->name) }}" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Neural Email Proxy</label>
                                    <input id="email" name="email" type="email" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-300" value="{{ old('email', $user->email) }}" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Operational Phone</label>
                                    <input id="phone" name="phone" type="text" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-400" value="{{ old('phone', $user->phone) }}" placeholder="+880 1XXX-XXXXXX" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Sector Base (Address)</label>
                                    <input id="address" name="address" type="text" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-400" value="{{ old('address', $user->address) }}" placeholder="e.g. DHAKA HQ, BD" />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Professional Narrative</label>
                                <textarea id="bio" name="bio" rows="4" class="w-full bg-gray-50 border-2 border-gray-100 rounded-[2rem] p-6 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-400 leading-relaxed" placeholder="DEFINE YOUR ROLE IN THE ECOSYSTEM...">{{ old('bio', $user->bio) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                            </div>

                            <div class="flex items-center gap-6 pt-4">
                                <button type="submit" class="px-12 py-5 bg-orange-500 hover:bg-[#050B1A] text-white font-black rounded-2xl transition-all shadow-xl shadow-orange-500/20 hover:shadow-[#050B1A]/20 uppercase tracking-[0.3em] text-[10px] italic">Commit Identity Changes</button>
                                
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 3000)"
                                        class="text-[10px] text-emerald-500 font-black uppercase tracking-widest italic"
                                    >// PROTOCOL UPDATED SUCCESSFULLY</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Security Phase: Encrypted Core -->
                    <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 md:p-14 shadow-[0_40px_100px_rgba(0,0,0,0.03)] transition-all hover:shadow-2xl">
                        <div class="flex items-center gap-6 mb-12">
                            <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl">
                                🔐
                            </div>
                            <div>
                                <h4 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Security Encryption</h4>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.3em] mt-2 italic items-center flex gap-3">
                                    Credential Core Maintenance
                                    <span class="w-8 h-px bg-gray-100"></span>
                                </p>
                            </div>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Termination Phase: Danger Zone -->
                    <div class="bg-red-50 border border-red-100 rounded-[2.5rem] p-8 md:p-14 shadow-lg">
                        <div class="flex items-center gap-6 mb-8">
                            <div class="w-12 h-12 bg-red-500/10 rounded-2xl flex items-center justify-center text-red-600 border border-red-500/20 italic font-black text-lg">
                                !
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-red-600 uppercase italic tracking-tighter leading-none">Memory Termination</h4>
                                <p class="text-[10px] text-red-400 font-black uppercase tracking-[0.3em] mt-2 italic">Destroy identity permanently</p>
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
