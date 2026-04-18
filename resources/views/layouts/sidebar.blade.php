<aside 
    x-show="true" 
    @mouseenter="sidebarHovered = true"
    @mouseleave="sidebarHovered = false"
    :class="{
        'translate-x-0 w-64': sidebarOpen,
        '-translate-x-full lg:translate-x-0': !sidebarOpen,
        'lg:w-64': !sidebarCollapsed || sidebarHovered,
        'lg:w-20': sidebarCollapsed && !sidebarHovered && !sidebarOpen
    }"
    class="fixed inset-y-0 left-0 z-50 bg-[#050B1A] border-r border-white/5 transition-all duration-500 ease-in-out transform lg:inset-y-0 flex flex-col group"
>
    <!-- Branding Header: Elite Presence -->
    <div class="h-24 flex items-center px-8 border-b border-white/5 bg-[#050B1A] shrink-0">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group overflow-hidden">
            <div class="flex items-center shrink-0">
                <span class="text-3xl font-black text-white tracking-tighter italic leading-none">CRS</span>
                <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-3xl font-black text-orange-500 tracking-tighter italic leading-none ml-1">BD</span>
            </div>
        </a>
    </div>

    <!-- Navigation Streams: High Fidelity Navigation -->
    <nav class="flex-1 p-4 space-y-10 overflow-y-auto custom-scrollbar overflow-x-hidden">
        
        <!-- CORE COMMAND Section -->
        <div>
            <h4 x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="px-5 text-[10px] font-black text-white/30 uppercase tracking-[0.4em] mb-6 italic">CORE COMMAND</h4>
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'bg-orange-500 text-white shadow-2xl shadow-orange-500/20' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Neural Center</span>
                </a>
            </div>
        </div>

        @auth
            <!-- AUTHORITY CONSOLE Section -->
            @if(auth()->user()->role === 'admin')
                <div>
                    <h4 x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="px-5 text-[10px] font-black text-white/30 uppercase tracking-[0.4em] mb-6 italic">AUTHORITY CONSOLE</h4>
                    <div class="space-y-2">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Identities</span>
                        </a>
                        
                        <a href="{{ route('admin.cars.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('admin.cars.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Fleet</span>
                        </a>

                        <a href="{{ route('admin.verifications.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('admin.verifications.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Audit</span>
                        </a>

                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('admin.bookings.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Ledger</span>
                        </a>

                        <a href="{{ route('admin.finance.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('admin.finance.*') ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20 shadow-xl shadow-orange-500/5' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 8V7"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Finance</span>
                        </a>

                        <a href="{{ route('admin.damage-reports.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('admin.damage-reports.*') ? 'bg-red-500/10 text-red-500 border border-red-500/20 shadow-xl shadow-red-500/5' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">Damages</span>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role === 'owner')
                <div>
                    <h4 x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="px-5 text-[10px] font-black text-white/30 uppercase tracking-[0.4em] mb-6 italic">Asset Management</h4>
                    <div class="space-y-2">
                        <a href="{{ route('owner.cars.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('owner.cars.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">{{ __('Fleet Registry') }}</span>
                        </a>

                        <a href="{{ route('owner.bookings.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('owner.bookings.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">{{ __('Live Sessions') }}</span>
                        </a>

                        <a href="{{ route('owner.finance.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('owner.finance.*') ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20 shadow-xl shadow-orange-500/5' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 8V7"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">{{ __('Yield Track') }}</span>
                        </a>

                        <a href="{{ route('owner.logistics.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('owner.logistics.*') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">{{ __('Logistics') }}</span>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role === 'customer')
                <div>
                    <h4 x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="px-5 text-[10px] font-black text-white/30 uppercase tracking-[0.4em] mb-6 italic">Identity Access</h4>
                    <div class="space-y-2">
                        <a href="{{ route('search') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('search') ? 'bg-white/10 text-white border border-white/10 shadow-xl' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">{{ __('Find Units') }}</span>
                        </a>

                        <a href="{{ route('customer.bookings.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all group {{ request()->routeIs('customer.bookings.*') ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20 shadow-xl shadow-orange-500/5' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-3 1v8l-2-2-2 2V5a1 1 0 011-1h2a1 1 0 011 1z"></path></svg>
                            <span x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="text-[11px] font-black uppercase tracking-widest whitespace-nowrap italic">{{ __('Portfolio') }}</span>
                        </a>
                    </div>
                </div>
            @endif
        @endauth

    </nav>

    <!-- Identity Trigger: High Fidelity Footer -->
    <div class="p-6 border-t border-white/5 bg-black/20 transition-all duration-300 overflow-hidden">
        @auth
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-[1rem] bg-orange-500 flex items-center justify-center text-sm font-black text-white shadow-2xl shadow-orange-500/20 shrink-0 italic">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" class="flex-1 min-w-0 transition-opacity duration-300">
                    <div class="text-[11px] font-black text-white truncate uppercase italic">{{ auth()->user()->name }}</div>
                    <div class="text-[9px] text-white/30 font-black uppercase tracking-[0.2em] italic">{{ auth()->user()->role }}</div>
                </div>
                <form x-show="!sidebarCollapsed || sidebarHovered || sidebarOpen" method="POST" action="{{ route('logout') }}" class="shrink-0">
                    @csrf
                    <button type="submit" class="text-white/20 hover:text-orange-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        @endauth
    </div>
</aside>
