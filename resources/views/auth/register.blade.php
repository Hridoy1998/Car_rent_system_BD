<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-2">Create an Account</h2>
        <p class="text-gray-400 text-sm">Join CarRent BD to start sharing or renting cars today.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="John Doe">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="john@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Phone Number</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="+880 1712-345678">
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Profile Photo -->
        <div>
            <label for="profile_photo" class="block text-sm font-medium text-gray-300 mb-1">Profile Photo (Optional)</label>
            <input id="profile_photo" type="file" name="profile_photo" accept="image/*"
                class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 transition-colors border border-gray-700 rounded-xl bg-gray-900/50 cursor-pointer">
            <p class="mt-1 text-xs text-gray-500">Max size 2MB (JPEG, PNG, JPG, GIF).</p>
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Account Type (Role) -->
        <div class="pt-2">
            <label class="block text-sm font-medium text-gray-300 mb-3">I want to register as a:</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="relative flex flex-col items-center justify-center p-4 border border-gray-700 rounded-xl cursor-pointer hover:bg-gray-800/50 transition-colors group has-[:checked]:bg-indigo-500/10 has-[:checked]:border-indigo-500/50">
                    <input type="radio" name="role" value="customer" class="peer sr-only" checked>
                    <div class="text-2xl mb-1">🚗</div>
                    <span class="text-sm font-medium text-gray-300 peer-checked:text-indigo-400">Customer</span>
                    <span class="text-xs text-gray-500 text-center mt-1">I want to rent cars</span>
                    
                    <!-- Selected indicator -->
                    <div class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-600 peer-checked:border-indigo-500 flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-indigo-500 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                    </div>
                </label>
                
                <label class="relative flex flex-col items-center justify-center p-4 border border-gray-700 rounded-xl cursor-pointer hover:bg-gray-800/50 transition-colors group has-[:checked]:bg-purple-500/10 has-[:checked]:border-purple-500/50">
                    <input type="radio" name="role" value="owner" class="peer sr-only">
                    <div class="text-2xl mb-1">🔑</div>
                    <span class="text-sm font-medium text-gray-300 peer-checked:text-purple-400">Owner</span>
                    <span class="text-xs text-gray-500 text-center mt-1">I want to list cars</span>

                    <!-- Selected indicator -->
                    <div class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-600 peer-checked:border-purple-500 flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-purple-500 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password -->
        <div class="pt-2">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                class="block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
        </div>

        <div class="flex items-center justify-between pt-6">
            <a class="text-sm text-gray-400 hover:text-white transition-colors underline" href="{{ route('login') }}">
                Already registered?
            </a>

            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl font-semibold shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] transition-all duration-300 border border-white/10">
                Create Account
            </button>
        </div>
    </form>
</x-guest-layout>
