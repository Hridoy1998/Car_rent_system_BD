<section class="space-y-8">
    <header>
        <h2 class="text-lg font-black text-red-600 uppercase tracking-widest italic">
            {{ __('Account Termination Protocol') }}
        </h2>

        <p class="mt-2 text-[11px] text-red-400 font-black uppercase tracking-widest italic leading-relaxed">
            {{ __('Once this identity is purged, all associated mobility assets and neural data will be permanently decommissioned. Procedural recovery will not be possible.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-8 py-3 bg-red-600 hover:bg-black text-white font-black rounded-2xl transition-all shadow-xl shadow-red-600/20 uppercase tracking-[0.2em] text-[10px] italic"
    >{{ __('Initialize Deletion') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-10 md:p-14 bg-white rounded-[2.5rem] border border-red-100 shadow-2xl">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-2xl font-black text-red-600 uppercase tracking-tighter italic leading-none">
                    {{ __('Confirm Identity Purge') }}
                </h2>

                <p class="mt-4 text-[11px] text-gray-500 font-black uppercase tracking-widest italic leading-relaxed">
                    {{ __('Are you prepared to permanently terminate this operational identity? Security clearance required. Please input your primary access hash to authorize.') }}
                </p>

                <div class="mt-10">
                    <label for="password" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] ml-1 italic leading-none">Authentication Hash</label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-3 block w-full bg-gray-50 border-2 border-red-50 rounded-2xl p-5 text-red-600 font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all italic placeholder-red-200"
                        placeholder="{{ __('RED-LEVEL ACCESS CODE') }}"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 font-black text-[9px] uppercase tracking-tighter" />
                </div>

                <div class="mt-12 flex justify-end gap-4">
                    <button type="button" x-on:click="$dispatch('close')" class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#050B1A] transition-colors italic">
                        {{ __('Abort Protocol') }}
                    </button>

                    <button type="submit" class="px-10 py-4 bg-red-600 hover:bg-black text-white font-black rounded-2xl transition-all shadow-xl shadow-red-600/20 uppercase tracking-[0.2em] text-[10px] italic">
                        {{ __('Confirm Termination') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
