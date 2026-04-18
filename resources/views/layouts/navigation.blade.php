<nav class="h-24 bg-white/40 backdrop-blur-xl border-b border-gray-100/50 flex items-center justify-between px-4 lg:px-8 shrink-0 z-40 sticky top-0 transition-all duration-500">
    <!-- Sidebar Toggle & Strategic Brand Presence -->
    <div class="flex items-center gap-4 lg:gap-8">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="p-2.5 bg-white/80 hover:bg-white text-gray-500 hover:text-orange-500 rounded-xl border border-gray-100 shadow-sm transition-all lg:hidden"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <button 
            @click="sidebarCollapsed = !sidebarCollapsed" 
            class="hidden lg:flex p-3 bg-white/80 hover:bg-white text-gray-400 hover:text-orange-500 rounded-2xl border border-gray-100 shadow-sm transition-all group"
            :title="sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'"
        >
            <svg x-show="!sidebarCollapsed" class="w-5 h-5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
            <svg x-show="sidebarCollapsed" class="w-5 h-5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
        </button>

        <div class="hidden sm:flex items-center gap-4">
             <div class="flex gap-1.5">
                 <div class="w-1.5 h-6 bg-orange-500 rounded-full italic"></div>
                 <div class="w-1.5 h-4 bg-orange-500/30 rounded-full mt-1"></div>
             </div>
             <div class="flex flex-col">
                 <h2 class="text-[11px] font-black text-gray-900 uppercase tracking-[0.3em] italic leading-none">Operational Nexus</h2>
                 <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest mt-1">CRS BD Central Command</p>
             </div>
        </div>
    </div>

    <!-- Global Actions Terminal: High Fidelity Module -->
    <div class="flex items-center gap-6">
        @auth
            <!-- Live Signal Terminal -->
            <div class="hidden sm:flex items-center gap-3 px-4 py-2 bg-emerald-50 border border-emerald-100 rounded-xl">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[9px] font-black text-emerald-700 uppercase tracking-widest">System Secure</span>
            </div>

            <livewire:notification-bell />

            <!-- Identity Module -->
            <div class="h-10 w-px bg-gray-200/50 mx-2"></div>
            
            <x-dropdown align="right" width="64">
                <x-slot name="trigger">
                    <button class="flex items-center gap-4 group">
                        <div class="text-right hidden md:block">
                            <div class="text-[11px] font-black text-gray-900 uppercase tracking-tighter italic">{{ auth()->user()->name }}</div>
                            <div class="text-[9px] text-orange-500 font-black uppercase tracking-widest italic">{{ auth()->user()->role }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-[#050B1A] flex items-center justify-center text-[12px] font-black text-white border border-white/10 shadow-2xl transition-transform group-hover:scale-105 active:scale-95 italic">
                             {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-5 py-4 border-b border-gray-100 bg-[#050B1A] rounded-t-[1.5rem]">
                            <p class="text-[9px] font-black text-white/30 uppercase tracking-[0.2em] mb-1 italic">Administrative Identity</p>
                            <p class="text-[11px] font-black text-white truncate italic">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="p-2">
                             <x-dropdown-link :href="route('profile.edit')" class="text-[11px] font-black text-gray-700 uppercase tracking-widest flex items-center gap-3 py-4 px-4 rounded-xl hover:bg-gray-50 hover:text-blue-900 transition-all italic">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ __('Identity Profile') }}
                            </x-dropdown-link>
                        </div>

                        <div class="p-2 border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-[11px] font-black text-red-600 uppercase tracking-widest flex items-center gap-3 py-4 px-4 rounded-xl hover:bg-red-50 transition-all italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('Deauthorize Session') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
        @else
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="text-[10px] font-black text-gray-600 hover:text-orange-500 transition-colors uppercase tracking-[0.3em] italic">Access Portal</a>
                <a href="{{ route('register') }}" class="px-8 py-3.5 bg-orange-500 hover:bg-orange-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-xl shadow-orange-500/20 italic">Register Gateway</a>
            </div>
        @endauth
    </div>
</nav>