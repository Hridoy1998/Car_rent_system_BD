<nav x-data="{ open: false }" class="glass sticky top-0 z-50 border-b border-white/5 shadow-[0_4px_30px_rgba(0,0,0,0.1)]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="group transition-all duration-500">
                        <div class="bg-indigo-600/10 p-2.5 rounded-2xl border border-indigo-500/20 group-hover:bg-indigo-600 transition-all shadow-[0_0_20px_rgba(99,102,241,0.1)] group-hover:shadow-indigo-500/40">
                             <x-application-logo class="block h-8 w-auto text-indigo-500 group-hover:text-white" />
                        </div>
                    </a>
                </div>
 
                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-12 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('*.dashboard')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                        <div class="flex items-center gap-2">
                             <span class="w-1 h-1 rounded-full {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                             {{ __('Dashboard') }}
                        </div>
                    </x-nav-link>
 
                    @auth
                        @if(auth()->user()->role === 'owner')
                            <x-nav-link :href="route('owner.cars.index')" :active="request()->routeIs('owner.cars.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('owner.cars.*') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('My Cars') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('owner.bookings.index')" :active="request()->routeIs('owner.bookings.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('owner.bookings.*') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Bookings') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('owner.logistics.index')" :active="request()->routeIs('owner.logistics.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('owner.logistics.*') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Handovers') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('owner.finance.index')" :active="request()->routeIs('owner.finance.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('owner.finance.*') ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Finance') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('owner.integrity.index')" :active="request()->routeIs('owner.integrity.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('owner.integrity.*') ? 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Damages') }}
                                     @php $breachCount = \App\Models\DamageReport::whereHas('booking.car', fn($q) => $q->where('user_id', auth()->id()))->whereIn('status', ['pending', 'disputed'])->count(); @endphp
                                     @if($breachCount > 0)
                                         <span class="ms-1 px-1.5 py-0.5 bg-red-600 text-white text-[8px] font-black rounded-md animate-pulse">{{ $breachCount }}</span>
                                     @endif
                                </div>
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.cars.index')" :active="request()->routeIs('admin.cars.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('admin.cars.*') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Fleet') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.verifications.index')" :active="request()->routeIs('admin.verifications.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('admin.verifications.*') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Verification') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('admin.bookings.*') ? 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Bookings') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.finance.index')" :active="request()->routeIs('admin.finance.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('admin.finance.*') ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Financials') }}
                                </div>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.damage-reports.index')" :active="request()->routeIs('admin.damage-reports.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                     <span class="w-1 h-1 rounded-full {{ request()->routeIs('admin.damage-reports.*') ? 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,1)]' : 'bg-gray-700' }}"></span>
                                     {{ __('Damages') }}
                                </div>
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'customer')
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                {{ __('Browse Cars') }}
                            </x-nav-link>
                            <x-nav-link :href="route('customer.bookings.index')" :active="request()->routeIs('customer.bookings.*')" class="px-4 py-2 rounded-xl hover:bg-white/5 transition-all text-[11px] font-black uppercase tracking-widest">
                                {{ __('My Trips') }}
                            </x-nav-link>
                            @php
                                $isVerified = \App\Models\Verification::where('user_id', auth()->id())->where('status', 'approved')->exists();
                            @endphp
                            @if(!$isVerified)
                                <x-nav-link :href="route('customer.verifications.index')" :active="request()->routeIs('customer.verifications.*')" class="text-amber-500 font-bold px-4 py-2 rounded-xl">
                                    {{ __('Verify Account') }}
                                    <span class="ms-1 w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                </x-nav-link>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
 
            <!-- User Auth Profile -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6">
                @auth
                    <!-- Notifications Bell -->
                    <div class="p-1 px-4 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-indigo-500/30 transition-all flex items-center h-10">
                        <livewire:notification-bell />
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center p-1 px-4 bg-indigo-600/10 hover:bg-indigo-600 hover:text-white transition-all duration-300 rounded-2xl border border-indigo-500/20 group h-10">
                                <div class="text-[10px] font-black uppercase tracking-widest mr-3">{{ Auth::user()->name }}</div>
                                <div class="w-6 h-6 rounded-lg bg-gray-950 flex items-center justify-center text-[8px] font-black border border-white/10 group-hover:border-indigo-400 transition-all">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-[10px] font-black uppercase tracking-widest">
                                {{ __('Account Settings') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-[10px] font-black uppercase tracking-widest text-red-400 transition-colors">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white transition-colors">Log In</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-[0_0_20px_rgba(79,70,229,0.3)]">Join Network</a>
                    </div>
                @endauth
            </div>
 
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-300 hover:bg-gray-800 transition duration-150 ease-in-out border border-white/5">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
 
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-950 border-t border-white/5">
        <div class="pt-4 pb-4 space-y-2 px-4 italic">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-2xl border border-white/5 font-black uppercase text-[10px] tracking-widest">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <!-- Add other mobile links as needed, matching the theme -->
        </div>
    </div>
</nav>
