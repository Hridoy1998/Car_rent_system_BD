<nav class="h-20 bg-gray-950/50 backdrop-blur-xl border-b border-white/5 flex items-center justify-between px-6 shrink-0 z-40">
    <!-- Sidebar Toggle & Brand Presence -->
    <div class="flex items-center gap-6">
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all lg:hidden"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <button 
            @click="sidebarCollapsed = !sidebarCollapsed" 
            class="hidden lg:flex p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all"
            :title="sidebarCollapsed ? 'Activate Static Expansion' : 'Enable Dynamic Hover Mode'"
        >
            <!-- Pin Icon (Locked/Static) -->
            <svg x-show="!sidebarCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
            <!-- Expand Icon (Dynamic/Hover) -->
            <svg x-show="sidebarCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
        </button>

        <div class="hidden sm:flex items-center gap-3">
             <div class="w-1 h-6 bg-indigo-500 rounded-full"></div>
             <h2 class="text-sm font-black text-white uppercase tracking-[0.2em] italic">Command Deck</h2>
        </div>
    </div>

    <!-- Global Actions Terminal -->
    <div class="flex items-center gap-4">
        @auth
            <!-- Live Signal Terminal -->
            <livewire:notification-bell />

            <!-- Identity Module -->
            <div class="h-10 w-px bg-white/5 mx-2"></div>
            
            <x-dropdown align="right" width="64">
                <x-slot name="trigger">
                    <button class="flex items-center gap-3 px-3 py-1.5 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/5 transition-all group">
                        <div class="text-right hidden sm:block">
                            <div class="text-[9px] font-black text-white uppercase tracking-tighter">{{ auth()->user()->name }}</div>
                            <div class="text-[7px] text-gray-500 font-bold uppercase tracking-widest">{{ auth()->user()->role }}</div>
                        </div>
                        <div class="w-8 h-8 rounded-xl bg-gray-950 flex items-center justify-center text-[10px] font-black text-indigo-400 border border-white/10 group-hover:border-indigo-500">
                             {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-white/5">
                            <p class="text-[8px] font-black text-gray-500 uppercase tracking-widest mb-1">Authenticated Email</p>
                            <p class="text-[10px] font-bold text-white truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-[10px] font-black uppercase tracking-widest flex items-center gap-2 py-3">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Account Protocol') }}
                        </x-dropdown-link>

                        <div class="border-t border-white/5">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-[10px] font-black uppercase tracking-widest text-red-500 flex items-center gap-2 py-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('Exit System') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
        @else
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-xl shadow-indigo-600/20">Register Access</a>
            </div>
        @endauth
    </div>
</nav>