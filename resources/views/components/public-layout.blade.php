<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CRS BD - Car Rent System Bangladesh' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes neon-pulse {
            0%, 100% { opacity: 1; filter: drop-shadow(0 0 5px rgba(99,102,241,0.8)); }
            50% { opacity: 0.8; filter: drop-shadow(0 0 15px rgba(99,102,241,1)); }
        }
        .glass {
            background: rgba(17, 24, 39, 0.6);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .text-glow { text-shadow: 0 0 15px rgba(255, 255, 255, 0.3); }
        .indigo-glow { text-shadow: 0 0 20px rgba(99, 102, 241, 0.5); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-['Inter'] antialiased selection:bg-blue-800 selection:text-white transition-all duration-300" 
      :class="{ 'overflow-hidden': mobileMenuOpen }"
      x-data="{ mobileMenuOpen: false, scrolled: false }" 
      @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Navigation (Tactical CRS Hub) -->
    <nav class="fixed w-full z-[110] transition-all duration-700 bg-[#121212]" 
         :class="scrolled ? 'py-3 shadow-2xl border-b border-white/5' : 'py-5'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left Sector: Menu & Logo -->
                <div class="flex items-center gap-6">
                    <!-- Hamburger (Left) -->
                    <button @click="mobileMenuOpen = true" class="p-2 text-white hover:bg-white/10 rounded-lg transition-colors group flex items-center gap-2">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="hidden md:block text-sm font-black uppercase tracking-tighter italic">Menu</span>
                    </button>

                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <span class="text-2xl md:text-3xl font-black tracking-tighter italic text-white underline underline-offset-8 decoration-orange-500/30">CRS</span>
                        <span class="text-2xl md:text-3xl font-black text-orange-500 tracking-tighter italic ml-0.5">BD</span>
                    </a>
                </div>
                
                <!-- Center Sector: Desktop Nav (Sidebar Style) -->
                <div class="hidden lg:flex items-center space-x-12">
                    <a href="{{ route('search') }}" class="flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-white/30 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="text-[11px] font-black uppercase tracking-[0.3em] italic text-white/70 group-hover:text-white transition-colors">Search Cars</span>
                    </a>
                    <a href="{{ route('pages.how-it-works') }}" class="flex items-center gap-2 group">
                        <svg class="w-4 h-4 text-white/30 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[11px] font-black uppercase tracking-[0.3em] italic text-white/60 group-hover:text-white transition-colors">How it Works</span>
                    </a>
                </div>

                <!-- Right Sector: Account Hub -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 rounded-xl bg-blue-900 text-white text-[10px] font-black hover:bg-orange-500 transition-all uppercase tracking-widest italic shadow-xl shadow-blue-900/20">Dashboard</a>
                    @else
                        <div class="hidden md:flex items-center gap-6 mr-4 border-r border-white/10 pr-6">
                            <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.3em] italic text-white/70 hover:text-white transition-colors">Login</a>
                        </div>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full bg-orange-500 text-white text-[10px] font-black hover:bg-white hover:text-orange-500 transition-all uppercase tracking-widest italic font-['Inter']">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Drawer (IMDb Pattern) -->
    <div x-show="mobileMenuOpen" class="fixed inset-0 z-[1000]" x-cloak>
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false" 
             class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

        <!-- Drawer Content -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="relative w-[85%] max-w-[340px] h-full bg-[#1A1C1E] shadow-2xl flex flex-col pt-20 pb-10 overflow-y-auto">
            
            <!-- Close Button -->
            <button @click="mobileMenuOpen = false" class="absolute top-6 right-6 p-2 text-white/50 hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Navigation Categories -->
            <div class="px-8 space-y-12">
                <!-- Group 1: Core Explorer -->
                <div class="space-y-6">
                    <h3 class="text-[10px] font-black text-orange-500 uppercase tracking-[0.4em] italic">CRS BD Fleet</h3>
                    <div class="space-y-4">
                        <a href="{{ route('home') }}" class="flex items-center gap-4 text-white hover:text-orange-500 transition-colors group">
                            <svg class="w-5 h-5 text-white/40 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="text-xl font-bold italic uppercase tracking-tighter">Home</span>
                        </a>
                        <a href="{{ route('search') }}" class="flex items-center gap-4 text-white hover:text-orange-500 transition-colors group">
                            <svg class="w-5 h-5 text-white/40 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="text-xl font-bold italic uppercase tracking-tighter">Search Cars</span>
                        </a>
                        <a href="{{ route('pages.how-it-works') }}" class="flex items-center gap-4 text-white hover:text-orange-500 transition-colors group">
                            <svg class="w-5 h-5 text-white/40 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xl font-bold italic uppercase tracking-tighter">How it Works</span>
                        </a>
                    </div>
                </div>

                <!-- Group 2: Tactical Hub -->
                <div class="space-y-6">
                    <h3 class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] italic">Tactical Actions</h3>
                    <div class="space-y-4">
                        <a href="{{ route('pages.contact') }}" class="flex items-center gap-4 text-white/80 hover:text-white transition-colors group">
                            <svg class="w-5 h-5 text-white/20 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-lg font-bold italic uppercase tracking-tighter leading-none">Contact Us</span>
                        </a>
                        <div class="h-px w-12 bg-white/5"></div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="flex items-center gap-4 text-white group">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-lg font-bold italic uppercase tracking-tighter text-blue-500">My Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-lg font-bold italic uppercase tracking-tighter text-white/60 hover:text-white transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="block w-full py-4 rounded-2xl bg-orange-500 text-white text-center text-lg font-black uppercase italic tracking-widest shadow-2xl shadow-orange-500/20 active:scale-95 transition-transform">Register</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Bottom Metadata (IMDbPro Style) -->
            <div class="mt-auto px-8 py-10 border-t border-white/5 space-y-4">
                <div class="flex items-center justify-between text-[8px] font-black text-white/20 uppercase tracking-[0.4em] italic">
                    <span>Bangladesh Logistics</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </div>
                <div class="text-[10px] text-white/40 font-bold italic">CRS BD v2.0 - Mastering Local Mobility Patterns.</div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer (CRS BD Strategic Hub) -->
    <footer class="bg-[#050B1A] pt-32 pb-16 text-[10px] relative overflow-hidden border-t border-white/5">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-900/5 rounded-bl-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-orange-500/5 rounded-tr-full blur-[80px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Modern Eye-Catch Header inside Footer -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10 mb-20 pb-20 border-b border-white/5">
                <div class="flex items-center gap-4">
                    <div class="flex items-center">
                        <span class="text-5xl font-black text-white tracking-tighter italic">CRS</span>
                        <span class="text-5xl font-black text-orange-500 tracking-tighter italic ml-2">BD</span>
                    </div>
                    <div class="h-12 w-px bg-white/10 hidden md:block"></div>
                    <p class="text-gray-400 font-bold uppercase tracking-[0.3em] text-[8px] leading-tight max-w-[200px]">
                        Architecting <span class="text-white">Elite Mobility</span> in Bangladesh Hub.
                    </p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('pages.contact') }}" class="px-8 py-4 bg-white/5 rounded-2xl border border-white/10 text-white font-black hover:bg-orange-500 hover:border-orange-500 transition-all uppercase tracking-widest italic group overflow-hidden relative">
                         <span class="relative z-10 flex items-center gap-2">Protocol Access <span class="group-hover:translate-x-1 transition-transform">→</span></span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-24">
                <!-- Mission Column -->
                <div class="space-y-10">
                    <h4 class="text-white text-xs font-black uppercase tracking-[0.4em] italic mb-8">Strategic Mission</h4>
                    <p class="text-gray-500 font-bold uppercase tracking-widest text-[9px] leading-loose">
                        We maintain the most advanced car rental infrastructure in <span class="text-white">Bangladesh (BD)</span>, delivering mission-critical mobility with absolute 24/7 tactical support.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white hover:bg-orange-500 transition-all border border-white/10 shadow-xl group">
                            <span class="group-hover:scale-125 transition-transform">𝕏</span>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white hover:bg-orange-500 transition-all border border-white/10 shadow-xl group">
                            <span class="group-hover:scale-125 transition-transform">in</span>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-white hover:bg-orange-500 transition-all border border-white/10 shadow-xl group">
                            <span class="group-hover:scale-125 transition-transform">IG</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Logistics -->
                <div>
                    <h4 class="text-white text-xs font-black mb-10 uppercase tracking-[0.4em] relative inline-block italic">
                        Quick Links
                        <span class="absolute -bottom-3 left-0 w-8 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-6 text-gray-400 font-black uppercase tracking-widest">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Home Base</a></li>
                        <li><a href="{{ route('search') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Rent a car</a></li>
                        <li><a href="{{ route('pages.how-it-works') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> How it Works</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Contact Us</a></li>
                    </ul>
                </div>

                <!-- Support Infrastructure -->
                <div>
                    <h4 class="text-white text-xs font-black mb-10 uppercase tracking-[0.4em] relative inline-block italic">
                        Tactical Support
                        <span class="absolute -bottom-3 left-0 w-8 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-6 text-gray-500 font-black uppercase tracking-widest">
                        <li><a href="{{ route('pages.privacy') }}" class="hover:text-white transition-all">Privacy Shield Protocol</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="hover:text-white transition-all">Rules of Engagement (Terms)</a></li>
                        <li><a href="{{ route('pages.faq') }}" class="hover:text-white transition-all">Operational Intel (FAQ)</a></li>
                        <li><a href="{{ route('pages.safety') }}" class="hover:text-white transition-all">Safety & Integrity Nexus</a></li>
                    </ul>
                </div>

                <!-- Hub Location -->
                <div>
                    <h4 class="text-white text-xs font-black mb-10 uppercase tracking-[0.4em] relative inline-block italic">
                        Command Center
                        <span class="absolute -bottom-3 left-0 w-8 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <div class="space-y-10">
                        <div class="p-8 bg-white/5 rounded-[2.5rem] border border-white/5 hover:bg-white/10 transition-all group">
                             <div class="flex items-start gap-5 mb-4">
                                <svg class="w-6 h-6 text-orange-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                <div>
                                    <h5 class="text-white font-black uppercase tracking-widest mb-1 italic">Dhaka Base Hub</h5>
                                    <p class="text-gray-500 font-bold uppercase tracking-widest text-[8px] leading-loose">Sector 01, Main Grid, Dhaka 1212, BD</p>
                                </div>
                             </div>
                             <div class="flex items-center gap-3 text-emerald-500 mt-4 font-black">
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </span>
                                <span class="uppercase tracking-widest text-[8px]">Global Ops Online</span>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Operational Copyright -->
            <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
                <p class="text-gray-500 font-bold uppercase tracking-[0.4em] italic leading-relaxed">
                    &copy; {{ date('Y') }} <span class="text-white">CRS BD</span> Tactical Registry. <span class="text-orange-500">Total Mobility Secured.</span>
                </p>
                <div class="flex gap-10 text-[8px] font-black text-gray-500 uppercase tracking-widest">
                    <a href="#" class="hover:text-white transition-all">Mission Log</a>
                    <a href="#" class="hover:text-white transition-all">Support Center</a>
                    <span class="text-white/10">•</span>
                    <a href="#" class="text-white/40 italic">Bangladesh National Network</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
