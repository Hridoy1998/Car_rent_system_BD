<x-app-layout x-data="{ showSettingsModal: false }">
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8 px-4 sm:px-0">
            <div class="text-center md:text-left">
                <h2 class="font-black text-3xl md:text-5xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                    Registry <span class="text-orange-500">Command</span>
                </h2>
                <div class="flex items-center justify-center md:justify-start gap-4 mt-4">
                    <span class="w-10 h-px bg-[#050B1A]/20"></span>
                    <p class="text-[9px] md:text-[10px] text-gray-500 font-black uppercase tracking-[0.4em] italic leading-none">
                        SOVEREIGN PARAMETER GOVERNANCE
                    </p>
                </div>
            </div>
            <div class="flex justify-center md:justify-end items-center gap-6">
                <button @click="$dispatch('open-settings-modal')" class="px-8 py-4 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-widest rounded-2xl border-2 border-white/10 hover:bg-orange-600 hover:shadow-orange-500/20 transition-all shadow-sm shadow-[#050B1A]/10 italic whitespace-nowrap active:scale-95">
                    Establish New Key
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden text-[#050B1A]">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-2 border-emerald-100 text-emerald-600 p-6 rounded-[2rem] font-black text-xs flex items-center gap-4 shadow-xl italic animate-in fade-in slide-in-from-top-4">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm">✅</div>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Dashboard Statistics Ribbon -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-white border-2 border-gray-100 p-6 md:p-8 rounded-3xl shadow-xl shadow-gray-200/50 flex flex-col justify-between group hover:border-[#050B1A]/20 transition-all">
                    <h5 class="text-[7px] md:text-[8px] font-black text-gray-400 uppercase tracking-widest mb-4 italic">Registry Count</h5>
                    <div class="text-xl md:text-3xl font-black text-[#050B1A] italic leading-none tracking-tighter">{{ $settings->count() }} <span class="text-[10px] uppercase opacity-20">Keys</span></div>
                </div>
                <div class="bg-white border-2 border-gray-100 p-6 md:p-8 rounded-3xl shadow-xl shadow-gray-200/50 flex flex-col justify-between group hover:border-orange-500/20 transition-all">
                    <h5 class="text-[7px] md:text-[8px] font-black text-gray-400 uppercase tracking-widest mb-4 italic">Logic Split</h5>
                    <div class="text-xl md:text-3xl font-black text-orange-500 italic leading-none tracking-tighter">90:10 <span class="text-[10px] uppercase opacity-20 text-[#050B1A]">Ratio</span></div>
                </div>
                <div class="col-span-2 bg-[#050B1A] p-6 md:p-8 rounded-3xl shadow-2xl flex items-center justify-between group relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_50%_-20%,#4f46e5,transparent)]"></div>
                    <div>
                        <h5 class="text-[7px] md:text-[8px] font-black text-gray-500 uppercase tracking-widest mb-2 italic">Institutional Integrity</h5>
                        <div class="text-[10px] md:text-sm font-black text-white italic tracking-tighter uppercase leading-none">Command Protocol <span class="text-emerald-500">Active</span></div>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center shadow-xl">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Registry Manifest -->
            <div class="space-y-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-[10px] md:text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] flex items-center gap-4 italic opacity-80 leading-none">
                        <span class="w-6 md:w-10 h-1 bg-[#050B1A] rounded-full"></span>
                        Sovereign Registry
                    </h3>
                </div>

                <!-- Desktop Terminal: High Density Table -->
                <div class="hidden md:block bg-white border-2 border-gray-100 rounded-[4.5rem] overflow-hidden shadow-[0_45px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl hover:shadow-gray-200/50">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic bg-gray-50/50 border-b border-gray-50">
                                    <th class="px-12 py-8">Parameter Key</th>
                                    <th class="px-12 py-8">Active Logic Value</th>
                                    <th class="px-12 py-8">Intent / Context</th>
                                    <th class="px-12 py-8 text-right">Registry Operations</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($settings as $setting)
                                <tr class="group hover:bg-gray-50/50 transition-all duration-300">
                                    <td class="px-12 py-10">
                                        <div class="flex items-center gap-6">
                                            <div class="w-12 h-12 rounded-2xl bg-[#050B1A] border-4 border-white flex items-center justify-center text-[11px] font-black text-white shadow-xl italic tracking-tighter shrink-0 uppercase italic">Key</div>
                                            <div class="min-w-0">
                                                <span class="text-sm font-black text-[#050B1A] uppercase italic tracking-tighter group-hover:text-orange-500 transition-colors truncate block">{{ $setting->key }}</span>
                                                <span class="text-[8px] text-gray-400 font-black uppercase mt-1 italic tracking-widest opacity-60">Est. {{ $setting->created_at->format('M Y') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        <form action="{{ route('admin.settings.update', $setting) }}" method="POST" id="update-form-{{ $setting->id }}" class="flex items-center gap-3">
                                            @csrf @method('PUT')
                                            <input type="text" name="value" value="{{ $setting->value }}" 
                                                class="bg-gray-50 border-2 border-white rounded-xl px-4 py-3 text-sm font-black text-[#050B1A] italic w-full focus:border-orange-500 focus:ring-0 transition-all shadow-inner placeholder-gray-300"
                                                placeholder="Enter Logic Value...">
                                        </form>
                                    </td>
                                    <td class="px-12 py-10">
                                        <input type="text" form="update-form-{{ $setting->id }}" name="description" value="{{ $setting->description }}" 
                                            class="bg-transparent border-none text-[10px] text-gray-400 font-bold italic w-full focus:ring-0 p-0 placeholder-gray-200" 
                                            placeholder="NO CONTEXT DEFINED...">
                                    </td>
                                    <td class="px-12 py-10 text-right">
                                        <div class="flex items-center justify-end gap-3 opacity-20 group-hover:opacity-100 transition-all">
                                            <button type="submit" form="update-form-{{ $setting->id }}" 
                                                class="w-11 h-11 bg-emerald-50 text-emerald-600 border-2 border-white rounded-xl flex items-center justify-center shadow-lg hover:bg-emerald-600 hover:text-white transition-all transform hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" onsubmit="return confirm('DECOMMISSION LOGIC KEY?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                    class="w-11 h-11 bg-red-50 text-red-500 border-2 border-white rounded-xl flex items-center justify-center shadow-lg hover:bg-red-600 hover:text-white transition-all transform hover:scale-110">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-12 py-32 text-center pointer-events-none">
                                            <div class="text-gray-300 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">LOG SYNCHRONIZED. REGISTRY IS VACANT.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile Manifest: Tactical Registry Cards -->
                <div class="block md:hidden space-y-6">
                    @forelse($settings as $setting)
                        <div class="bg-white border-2 border-gray-100 p-8 rounded-[3rem] shadow-xl space-y-6 relative overflow-hidden group active:scale-[0.98] transition-all">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-[#050B1A] flex items-center justify-center text-[9px] font-black text-white shrink-0 italic italic uppercase">Key</div>
                                    <h4 class="text-[13px] font-black text-[#050B1A] uppercase italic tracking-tight truncate">{{ $setting->key }}</h4>
                                </div>
                                <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" onsubmit="return confirm('DECOMMISSION LOGIC KEY?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center active:bg-red-600 active:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>

                            <div class="space-y-4">
                                <form action="{{ route('admin.settings.update', $setting) }}" method="POST" class="space-y-2">
                                    @csrf @method('PUT')
                                    <label class="block text-[8px] font-black text-gray-400 uppercase tracking-widest italic ml-1 leading-none mb-1">Active Logic Value</label>
                                    <div class="flex gap-2">
                                        <input type="text" name="value" value="{{ $setting->value }}" 
                                            class="flex-1 bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-black text-[#050B1A] italic focus:border-orange-500 focus:ring-0 transition-all shadow-inner">
                                        <button type="submit" class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center shadow-lg active:scale-90 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <label class="block text-[8px] font-black text-gray-400 uppercase tracking-widest italic ml-1 leading-none mb-1">Registry Context</label>
                                        <input type="text" name="description" value="{{ $setting->description }}" 
                                            class="w-full bg-transparent border-none text-[10px] text-gray-400 font-bold italic focus:ring-0 p-0 placeholder-gray-200" 
                                            placeholder="NO CONTEXT LOGGED IN REGISTRY...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="py-24 text-center">
                            <p class="text-gray-300 text-[9px] font-black uppercase tracking-[0.5em] italic leading-relaxed px-12">Registry Log is Synchronized & Empty</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Logic Establishment Modal -->
    <div 
        x-data="{ showSettingsModal: false }"
        x-on:open-settings-modal.window="showSettingsModal = true"
        x-show="showSettingsModal" 
        x-on:keydown.escape.window="showSettingsModal = false"
        x-cloak
        class="fixed inset-0 bg-[#050B1A]/90 backdrop-blur-md z-[100] flex items-center justify-center p-6 transition-all duration-300"
    >
        <div 
            @click.away="showSettingsModal = false"
            x-show="showSettingsModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            class="bg-white border-2 border-white/20 p-6 md:p-12 rounded-[2.5rem] md:rounded-[4.5rem] w-full max-w-xl shadow-[0_50px_100px_rgba(0,0,0,0.5)] relative overflow-hidden max-h-[90vh] overflow-y-auto custom-scrollbar"
        >
            <div class="flex items-center gap-4 md:gap-6 mb-8 md:mb-10">
                <div class="w-10 h-10 md:w-16 md:h-16 rounded-xl md:rounded-[1.5rem] bg-[#050B1A] flex items-center justify-center text-lg md:text-2xl shadow-xl">⚙️</div>
                <div>
                    <h3 class="text-xl md:text-3xl font-black text-[#050B1A] italic tracking-tighter uppercase leading-none mb-2">Establish <span class="text-orange-500">Key</span></h3>
                    <p class="text-[8px] md:text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] italic leading-none">Initialize Registry Parameter</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-6 md:space-y-8 relative z-10">
                @csrf
                <div class="space-y-3">
                    <label class="text-[9px] md:text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2 italic">Registry Key</label>
                    <input type="text" name="key" required placeholder="e.g. platform_split" 
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-6 py-4 md:py-5 text-[#050B1A] focus:border-[#050B1A] focus:ring-0 transition-all outline-none font-black text-sm tracking-widest italic placeholder-gray-200">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="space-y-3">
                        <label class="text-[9px] md:text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2 italic">Logic Value</label>
                        <input type="text" name="value" placeholder="10.00" 
                            class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-6 py-4 md:py-5 text-[#050B1A] focus:border-[#050B1A] focus:ring-0 transition-all outline-none text-sm font-black italic placeholder-gray-200">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[9px] md:text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2 italic">Category</label>
                        <select class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-6 py-4 md:py-5 text-[#050B1A] focus:border-[#050B1A] focus:ring-0 transition-all outline-none text-[9px] md:text-[10px] font-black uppercase tracking-widest italic shadow-inner">
                            <option>FINANCIALS</option>
                            <option>OPERATIONS</option>
                            <option>GOVERNANCE</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="text-[9px] md:text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2 italic">Context Description</label>
                    <textarea name="description" placeholder="IDENTIFY LOGIC INTENT..." 
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-6 py-4 md:py-5 text-[#050B1A] focus:border-[#050B1A] focus:ring-0 transition-all outline-none text-[10px] md:text-[11px] font-black italic h-24 md:h-32 tracking-tight placeholder-gray-200"></textarea>
                </div>

                <div class="flex flex-col-reverse md:flex-row gap-4 md:gap-6 pt-4 md:pt-6">
                    <button type="button" @click="showSettingsModal = false" 
                        class="w-full py-4 md:py-5 bg-gray-100 text-gray-400 text-[10px] md:text-[11px] font-black uppercase tracking-widest rounded-xl md:rounded-2xl hover:bg-gray-200 hover:text-gray-600 transition-all italic active:scale-95">CANCEL</button>
                    <button type="submit" 
                        class="w-full py-4 md:py-5 bg-[#050B1A] text-white text-[10px] md:text-[11px] font-black uppercase tracking-widest rounded-xl md:rounded-2xl shadow-xl shadow-[#050B1A]/20 hover:bg-orange-600 transition-all italic active:scale-95">ESTABLISH KEY</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
