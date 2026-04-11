<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-2">Create an Account</h2>
        <p class="text-gray-400 text-sm">Join CarRent BD to start sharing or renting cars today.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Full Name" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" class="mt-1" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email Address" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" class="mt-1" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone" value="Phone Number" />
            <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="+880 1712-345678" class="mt-1" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" value="Profile Photo (Optional)" />
            <input id="profile_photo" type="file" name="profile_photo" accept="image/*"
                class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 transition-colors border border-gray-700 rounded-xl bg-gray-900/50 cursor-pointer mt-1">
            <p class="mt-1 text-xs text-gray-500">Max size 2MB (JPEG, PNG, JPG, GIF).</p>
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
        </div>

        <!-- Account Type (Role) -->
        <div class="pt-2">
            <x-input-label value="I want to register as a:" class="mb-3" />
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
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="pt-2">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="mt-1" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="mt-1" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-6">
            <a class="text-sm text-gray-400 hover:text-white transition-colors underline" href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button>
                Create Account
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
