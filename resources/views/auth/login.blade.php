<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
        <p class="text-gray-400 text-sm">Log in to your CarRent BD account.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="john@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded bg-gray-900 border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-gray-950 transition-colors cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Remember me</span>
            </label>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full flex justify-center py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl font-bold shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] transition-all duration-300 border border-white/10 text-lg">
                Sign In
            </button>
        </div>

        <!-- Quick Demo Login -->
        <div class="mt-8 pt-8 border-t border-white/5" x-data="{ 
            login(email, password) {
                document.getElementById('email').value = email;
                document.getElementById('password').value = password;
                document.querySelector('form').submit();
            }
        }">
            <p class="text-center text-xs font-semibold text-gray-500 uppercase tracking-widest mb-4">Quick Demo Access</p>
            <div class="grid grid-cols-3 gap-3">
                <button type="button" @click="login('admin@gmail.com', 'password')" class="flex flex-col items-center p-3 rounded-xl bg-gray-900/40 border border-white/5 hover:border-indigo-500/50 hover:bg-indigo-500/5 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/20 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 group-hover:text-indigo-400 transition-colors">ADMIN</span>
                </button>
                
                <button type="button" @click="login('owner@gmail.com', 'password')" class="flex flex-col items-center p-3 rounded-xl bg-gray-900/40 border border-white/5 hover:border-emerald-500/50 hover:bg-emerald-500/5 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 group-hover:text-emerald-400 transition-colors">OWNER</span>
                </button>

                <button type="button" @click="login('customer@gmail.com', 'password')" class="flex flex-col items-center p-3 rounded-xl bg-gray-900/40 border border-white/5 hover:border-amber-500/50 hover:bg-amber-500/5 transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-amber-500/20 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 group-hover:text-amber-400 transition-colors">CLIENT</span>
                </button>
            </div>
        </div>
        
        <div class="text-center mt-6">
            <span class="text-gray-500 text-sm">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium ml-1 transition-colors">Register now</a>
        </div>
    </form>
</x-guest-layout>
