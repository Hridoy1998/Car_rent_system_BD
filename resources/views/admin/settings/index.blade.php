<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter italic">
                    {{ __('Registry Command Hub') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-[0.2em] mt-1 italic">Sovereign control over platform-wide operational parameters</p>
            </div>
            <div class="flex gap-4">
                 <button onclick="document.getElementById('create-setting-modal').classList.remove('hidden')" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20">
                    Establish New Key
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-6 rounded-3xl font-black text-xs flex items-center gap-3 animate-pulse shadow-2xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
                <div class="p-10 border-b border-white/5 flex items-center justify-between bg-white/[0.02]">
                    <h3 class="text-xl font-black text-white tracking-tight italic">Sovereign Registry</h3>
                    <div class="text-[10px] text-gray-500 font-black uppercase tracking-[0.2em]">{{ $settings->count() }} Parameters Defined</div>
                </div>

                <div class="overflow-x-auto text-slate-200">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[9px] font-black text-gray-600 uppercase tracking-[0.3em] bg-white/[0.01]">
                                <th class="px-10 py-6">Parameter Key</th>
                                <th class="px-10 py-6">Current Value</th>
                                <th class="px-10 py-6">Logic Description</th>
                                <th class="px-10 py-6 text-right">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($settings as $setting)
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-gray-800 border border-white/10 flex items-center justify-center text-[10px] font-black text-indigo-400">#</div>
                                        <span class="text-xs font-mono font-black text-indigo-400 tracking-tighter">{{ $setting->key }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <form action="{{ route('admin.settings.update', $setting) }}" method="POST" id="update-form-{{ $setting->id }}">
                                        @csrf @method('PUT')
                                        <input type="text" name="value" value="{{ $setting->value }}" class="bg-gray-950/50 border border-white/5 text-xs text-white p-3 rounded-xl focus:ring-indigo-500 w-full font-bold">
                                    </form>
                                </td>
                                <td class="px-10 py-8">
                                    <input type="text" form="update-form-{{ $setting->id }}" name="description" value="{{ $setting->description }}" class="bg-transparent border-none text-[10px] text-gray-500 p-0 focus:ring-0 w-full italic font-bold placeholder-gray-800" placeholder="No logic defined...">
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <button type="submit" form="update-form-{{ $setting->id }}" class="p-2.5 bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white rounded-xl border border-emerald-500/20 transition-all shadow-lg" title="Commit Changes">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                        <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" onsubmit="return confirm('WARNING: Decommissioning this logic key may disable core services. Proceed?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl border border-red-500/20 transition-all shadow-lg" title="Decommission Key">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-24 text-center">
                                    <div class="text-xs text-gray-700 font-black uppercase tracking-[0.4em] italic opacity-20 text-center">No platform logic defined in registry</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Create Setting Modal -->
    <div id="create-setting-modal" class="hidden fixed inset-0 bg-gray-950/90 backdrop-blur-2xl z-[100] flex items-center justify-center p-6">
        <div class="bg-gray-900 border border-white/10 p-10 rounded-[3rem] w-full max-w-lg shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-600/10 rounded-full blur-3xl -z-10"></div>
            
            <h3 class="text-2xl font-black text-white italic tracking-tight mb-2">Establish Logic Key</h3>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-8">Define new global platform parameter</p>

            <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Registry Key</label>
                    <input type="text" name="key" required placeholder="e.g. payout_limit" class="w-full bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-black text-xs tracking-widest italic">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Logic Value</label>
                    <input type="text" name="value" placeholder="Numeric or textual value" class="w-full bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none text-xs">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Contextual Description</label>
                    <textarea name="description" placeholder="Intent behind this logic..." class="w-full bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none text-[10px] font-bold italic h-24"></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('create-setting-modal').classList.add('hidden')" class="flex-1 py-4 bg-white/5 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-600/20 hover:scale-[1.02] transition-all">Establish Key</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
