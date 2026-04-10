<aside 
    x-show="true" 
    :class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full lg:translate-x-0': !sidebarOpen,
        'w-64': !sidebarCollapsed,
        'w-20': sidebarCollapsed
    }"
    class="fixed inset-y-0 left-0 z-50 bg-gray-950 border-r border-white/5 transition-all duration-300 transform lg:static lg:inset-0 flex flex-col"
>
    <!-- Branding Header -->
    <div class="h-20 flex items-center px-6 border-b border-white/5 bg-gray-950/50 backdrop-blur-xl shrink-0">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group overflow-hidden">
            <x-application-logo class="w-8 h-8 shadow-lg shadow-indigo-500/20 group-hover:rotate-12 transition-transform shrink-0" />
            <span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="text-lg font-black bg-clip-text text-transparent bg-gradient-to-r from-white to-indigo-400 tracking-tighter italic uppercase whitespace-nowrap">
                Neon Monolith
            </span>
        </a>
    </div>

    <!-- Navigation Streams -->
    <nav class="flex-1 p-4 space-y-8 overflow-y-auto custom-scrollbar overflow-x-hidden">
        
        <!-- Dashboard Section -->
        <div>
            <h4 x-show="!sidebarCollapsed" class="px-4 text-[9px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4 italic whitespace-nowrap">Core Command</h4>
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'bg-indigo-600/10 text-white border border-indigo-500/20 shadow-xl shadow-indigo-600/5' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'text-indigo-400' : 'text-gray-600 group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Neural Center') }}</span>
                </a>
            </div>
        </div>

        @auth
            <!-- Role Specific Sections -->
            @if(auth()->user()->role === 'admin')
                <div>
                    <h4 x-show="!sidebarCollapsed" class="px-4 text-[9px] font-black text-red-500 uppercase tracking-[0.3em] mb-4 italic whitespace-nowrap">Authority Console</h4>
                    <div class="space-y-1">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('admin.users.*') ? 'bg-red-600/10 text-white border border-red-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Identities') }}</span>
                        </a>
                        
                        <a href="{{ route('admin.cars.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('admin.cars.*') ? 'bg-indigo-600/10 text-white border border-indigo-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Fleet') }}</span>
                        </a>

                        <a href="{{ route('admin.verifications.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('admin.verifications.*') ? 'bg-amber-600/10 text-white border border-amber-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04c0 4.835 3.012 8.951 7.272 10.511a11.953 11.953 0 007.296-1.096L17.5 14.5l3.5-7z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Audit') }}</span>
                        </a>

                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('admin.bookings.*') ? 'bg-indigo-600/10 text-white border border-indigo-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Ledger') }}</span>
                        </a>

                        <a href="{{ route('admin.finance.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('admin.finance.*') ? 'bg-emerald-600/10 text-white border border-emerald-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 8V7"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Finance') }}</span>
                        </a>

                        <a href="{{ route('admin.damage-reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('admin.damage-reports.*') ? 'bg-red-600/10 text-white border border-red-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Damages') }}</span>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role === 'owner')
                <div>
                    <h4 x-show="!sidebarCollapsed" class="px-4 text-[9px] font-black text-purple-500 uppercase tracking-[0.3em] mb-4 italic whitespace-nowrap">Host Terminal</h4>
                    <div class="space-y-1">
                        <a href="{{ route('owner.cars.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('owner.cars.*') ? 'bg-purple-600/10 text-white border border-purple-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Fleet') }}</span>
                        </a>

                        <a href="{{ route('owner.bookings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('owner.bookings.*') ? 'bg-purple-600/10 text-white border border-purple-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Missions') }}</span>
                        </a>

                        <a href="{{ route('owner.finance.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('owner.finance.*') ? 'bg-emerald-600/10 text-white border border-emerald-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 8V7"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Revenue') }}</span>
                        </a>

                        <a href="{{ route('owner.logistics.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('owner.logistics.*') ? 'bg-purple-600/10 text-white border border-purple-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Logistics') }}</span>
                        </a>

                        <a href="{{ route('owner.integrity.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('owner.integrity.*') ? 'bg-red-600/10 text-white border border-red-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Integrity') }}</span>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role === 'customer')
                <div>
                    <h4 x-show="!sidebarCollapsed" class="px-4 text-[9px] font-black text-green-500 uppercase tracking-[0.3em] mb-4 italic whitespace-nowrap">Operator Module</h4>
                    <div class="space-y-1">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('home') ? 'bg-green-600/10 text-white border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Scout Fleet') }}</span>
                        </a>

                        <a href="{{ route('customer.bookings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('customer.bookings.*') ? 'bg-green-600/10 text-white border border-green-500/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-3 1v8l-2-2-2 2V5a1 1 0 011-1h2a1 1 0 011 1z"></path></svg>
                            <span x-show="!sidebarCollapsed" class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ __('Deployments') }}</span>
                        </a>
                    </div>
                </div>
            @endif
        @endauth

    </nav>

    <!-- Identity Audit Trigger -->
    <div class="p-6 border-t border-white/5 bg-gray-950/80 backdrop-blur-xl transition-all duration-300 overflow-hidden">
        @auth
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-gray-900 border border-white/10 flex items-center justify-center text-xs font-black text-indigo-400 shadow-xl shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div x-show="!sidebarCollapsed" class="flex-1 min-w-0 transition-opacity duration-300">
                    <div class="text-[11px] font-black text-white truncate uppercase tracking-tighter">{{ auth()->user()->name }}</div>
                    <div class="text-[8px] text-gray-600 font-bold truncate uppercase tracking-widest">{{ auth()->user()->role }} operator</div>
                </div>
                <form x-show="!sidebarCollapsed" method="POST" action="{{ route('logout') }}" class="shrink-0">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        @endauth
    </div>
</aside>
