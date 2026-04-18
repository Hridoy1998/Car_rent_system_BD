<section class="max-w-2xl">
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="space-y-3">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Security Identity Hash</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-400" autocomplete="current-password" placeholder="CURRENT ACCESS KEY" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-3">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">New Encryption Protocol</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-400" autocomplete="new-password" placeholder="NEW SECURITY KEY" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-3">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] ml-1 italic leading-none">Confirm New Key</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all italic placeholder-gray-400" autocomplete="new-password" placeholder="RE-ENTER NEW KEY" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-12 py-5 bg-[#050B1A] hover:bg-orange-500 text-white font-black rounded-2xl transition-all shadow-xl shadow-[#050B1A]/20 hover:shadow-orange-500/20 uppercase tracking-[0.3em] text-[10px] italic">Re-Cipher Identity</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-[10px] text-emerald-500 font-black uppercase tracking-widest italic"
                >// SECURITY HASH ROTATED SUCCESSFULLY</p>
            @endif
        </div>
    </form>
</section>
