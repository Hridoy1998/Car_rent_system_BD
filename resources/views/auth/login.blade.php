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
        
        <div class="text-center mt-6">
            <span class="text-gray-500 text-sm">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium ml-1 transition-colors">Register now</a>
        </div>
    </form>
</x-guest-layout>
