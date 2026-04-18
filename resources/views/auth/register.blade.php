<x-guest-layout>
    <div class="mb-12 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 mb-4">
            <span class="w-12 h-0.5 bg-orange-500"></span>
            <span class="text-[12px] font-black text-orange-500 uppercase tracking-[0.5em]">Account Registration</span>
            <span class="w-12 h-0.5 bg-orange-500"></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter mb-4 uppercase italic leading-none">Create <span class="text-blue-900">Account</span></h2>
        <p class="text-gray-700 font-bold text-[13px] uppercase tracking-[0.1em] leading-relaxed">Join Bangladesh's premier car rental network.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-10" data-aos="fade-up" data-aos-delay="100">
        @csrf

        <!-- Name & Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <label for="name" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-900 rounded-full"></span>
                    Full Name
                </label>
                <div class="relative group">
                    <span class="absolute left-4 top-4 text-gray-500 group-focus-within:text-blue-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="E.G. JOHN DOE" class="w-full pl-12 pr-4 py-5 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest placeholder-gray-400 transition-all text-gray-900 shadow-sm" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="space-y-4">
                <label for="email" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-900 rounded-full"></span>
                    Email Address
                </label>
                <div class="relative group">
                    <span class="absolute left-4 top-4 text-gray-500 group-focus-within:text-blue-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                    </span>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="NAME@EMAIL.COM" class="w-full pl-12 pr-4 py-5 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest placeholder-gray-400 transition-all text-gray-900 shadow-sm" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Phone & Photo -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-2">
            <div class="space-y-4">
                <label for="phone" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-900 rounded-full"></span>
                    Phone Number
                </label>
                <div class="relative group">
                    <span class="absolute left-4 top-4 text-gray-500 group-focus-within:text-blue-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </span>
                    <input id="phone" type="text" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="+8801..." class="w-full pl-12 pr-4 py-5 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest placeholder-gray-400 transition-all text-gray-900 shadow-sm" />
                </div>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="space-y-4">
                <label for="profile_photo" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-900 rounded-full"></span>
                    Profile Photo (Optional)
                </label>
                <input id="profile_photo" type="file" name="profile_photo" accept="image/*"
                    class="block w-full text-[11px] uppercase tracking-widest font-black text-gray-700 file:mr-4 file:py-4 file:px-8 file:rounded-xl file:border-0 file:text-[11px] file:font-black file:bg-blue-900 file:text-white hover:file:bg-orange-500 transition-all border-2 border-gray-200 rounded-2xl bg-white cursor-pointer pt-1 shadow-sm">
                <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
            </div>
        </div>

        <!-- Role Selection -->
        <div class="pt-6 space-y-6">
            <label class="text-[11px] font-black text-gray-900 uppercase tracking-[0.3em] ml-1 block italic flex items-center gap-2">
                <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                Who are you?
            </label>
            <div class="grid grid-cols-2 gap-8">
                <label class="relative flex flex-col items-center justify-center p-10 border-2 border-gray-200 rounded-[2.5rem] cursor-pointer hover:border-blue-900/30 transition-all duration-500 group has-[:checked]:bg-blue-900/[0.04] has-[:checked]:border-blue-900 has-[:checked]:shadow-2xl has-[:checked]:shadow-blue-900/5">
                    <input type="radio" name="role" value="customer" class="peer sr-only" checked>
                    <div class="text-5xl mb-6 group-hover:scale-110 transition-transform duration-500">🏎️</div>
                    <span class="text-[12px] font-black text-gray-900 uppercase tracking-widest italic border-b-2 border-blue-900/10 pb-1">I want to Rent</span>
                    <span class="text-[10px] text-gray-700 uppercase font-black mt-4 text-center leading-relaxed tracking-wider px-2">I am looking for a car to rent</span>
                    
                    <div class="absolute top-6 right-6 w-6 h-6 rounded-full border-2 border-gray-200 peer-checked:border-blue-900 flex items-center justify-center transition-all bg-white shadow-sm">
                        <div class="w-3 h-3 rounded-full bg-blue-900 opacity-0 peer-checked:opacity-100 transition-all scale-50 peer-checked:scale-100"></div>
                    </div>
                </label>
                
                <label class="relative flex flex-col items-center justify-center p-10 border-2 border-gray-200 rounded-[2.5rem] cursor-pointer hover:border-orange-500/30 transition-all duration-500 group has-[:checked]:bg-orange-500/[0.04] has-[:checked]:border-orange-500 has-[:checked]:shadow-2xl has-[:checked]:shadow-orange-500/5">
                    <input type="radio" name="role" value="owner" class="peer sr-only">
                    <div class="text-5xl mb-6 group-hover:scale-110 transition-transform duration-500">🏢</div>
                    <span class="text-[12px] font-black text-gray-900 uppercase tracking-widest italic border-b-2 border-orange-500/10 pb-1">I want to Host</span>
                    <span class="text-[10px] text-gray-700 uppercase font-black mt-4 text-center leading-relaxed tracking-wider px-2">I want to list my own cars</span>

                    <div class="absolute top-6 right-6 w-6 h-6 rounded-full border-2 border-gray-200 peer-checked:border-orange-500 flex items-center justify-center transition-all bg-white shadow-sm">
                        <div class="w-3 h-3 rounded-full bg-orange-500 opacity-0 peer-checked:opacity-100 transition-all scale-50 peer-checked:scale-100"></div>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password Logic -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
            <div class="space-y-4">
                <label for="password" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-900 rounded-full"></span>
                    Create Password
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="w-full px-6 py-5 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest transition-all placeholder-gray-400 text-gray-900 shadow-sm" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="space-y-4">
                <label for="password_confirmation" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-blue-900 rounded-full"></span>
                    Confirm Password
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="w-full px-6 py-5 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest transition-all placeholder-gray-400 text-gray-900 shadow-sm" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="pt-8 space-y-8">
            <button type="submit" class="group relative w-full py-6 bg-blue-900 hover:bg-orange-500 text-white font-black rounded-2xl shadow-2xl shadow-blue-900/20 transition-all duration-500 uppercase tracking-[0.5em] text-[12px] italic">
                <span>Complete Registration</span>
            </button>
            <div class="text-center">
                <a class="text-[11px] font-black text-gray-700 hover:text-blue-900 transition-colors uppercase tracking-[0.2em] italic border-b-2 border-gray-100 hover:border-blue-900 pb-1" href="{{ route('login') }}">
                    Already have an account? Login
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
