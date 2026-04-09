<section class="max-w-xl">
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Current Identity Hash</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-purple-500 outline-none transition-all" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">New Security Key</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-purple-500 outline-none transition-all" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Verify New Key</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-purple-500 outline-none transition-all" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-8 py-3 bg-white text-gray-950 font-black rounded-xl transition-all hover:bg-gray-200 uppercase tracking-widest text-xs">Update Key</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-400 font-bold"
                >{{ __('Key updated.') }}</p>
            @endif
        </div>
    </form>
</section>
