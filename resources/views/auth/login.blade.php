<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-12 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 mb-4">
            <span class="w-10 h-0.5 bg-orange-500"></span>
            <span class="text-[11px] font-black text-orange-500 uppercase tracking-[0.4em]">Operational Access</span>
            <span class="w-10 h-0.5 bg-orange-500"></span>
        </div>
        <h2 class="text-4xl font-black text-gray-900 tracking-tighter mb-4 uppercase italic leading-none">Personnel <span class="text-blue-900">Login</span></h2>
        <p class="text-gray-600 font-bold text-[12px] uppercase tracking-[0.1em] leading-relaxed">Authenticate credentials to initialize terminal session.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-8" data-aos="fade-up" data-aos-delay="100">
        @csrf

        <!-- Email Address -->
        <div class="space-y-3">
            <label for="email" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] ml-1 italic">Email Address</label>
            <div class="relative group">
                <span class="absolute left-4 top-4 text-gray-500 group-focus-within:text-blue-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </span>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="yourname@email.com" class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest placeholder-gray-400 transition-all text-gray-900 shadow-sm" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-3">
            <div class="flex justify-between items-center px-1">
                <label for="password" class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] italic">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-black text-orange-500 hover:text-blue-900 transition-colors uppercase tracking-widest italic" href="{{ route('password.request') }}">
                        Forgot?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <span class="absolute left-4 top-4 text-gray-500 group-focus-within:text-blue-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full pl-12 pr-4 py-4 bg-white border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-[11px] uppercase tracking-widest placeholder-gray-400 transition-all text-gray-900 shadow-sm" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-[4px] border-gray-300 text-blue-900 shadow-sm focus:ring-blue-900 transition-colors cursor-pointer w-4 h-4" name="remember">
                <span class="ms-3 text-[11px] font-black text-gray-600 group-hover:text-blue-900 transition-colors uppercase tracking-[0.2em] italic">Persistent Session</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="group relative w-full py-5 bg-blue-900 hover:bg-orange-500 text-white font-black rounded-2xl shadow-2xl shadow-blue-900/20 transition-all duration-500 uppercase tracking-[0.4em] text-[11px] italic">
                <span>Authorize Login</span>
            </button>
        </div>

        <div class="text-center mt-10">
            <span class="text-gray-600 text-[11px] font-black uppercase tracking-widest italic">New Personnel?</span>
            <a href="{{ route('register') }}" class="text-orange-500 hover:text-blue-900 text-[11px] font-black ml-2 transition-colors uppercase tracking-[0.2em] italic border-b border-orange-500/0 hover:border-blue-900">Enlist Now</a>
        </div>
    </form>
</x-guest-layout>
