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
    
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="bg-gray-50 text-gray-800 font-['Inter'] antialiased selection:bg-blue-800 selection:text-white" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Navigation (Tactical CRS Hub) -->
    <nav class="fixed w-full z-50 transition-all duration-700" 
         :class="scrolled ? 'bg-white/95 backdrop-blur-xl border-b border-gray-100 shadow-2xl py-4' : 'bg-transparent py-6'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 transition-all duration-500">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="flex items-center">
                            <span class="text-3xl md:text-4xl font-black tracking-tighter italic transition-colors duration-500" 
                                  :class="scrolled || !@json(Route::is('home')) ? 'text-blue-900' : 'text-white'">CRS</span>
                            <span class="text-3xl md:text-4xl font-black text-orange-500 tracking-tighter italic ml-1">BD</span>
                        </div>
                    </a>
                </div>
                
                <div class="hidden lg:flex items-center space-x-12">
                    <a href="{{ route('home') }}" class="text-[10px] font-black uppercase tracking-[0.3em] italic transition-colors duration-500"
                       :class="scrolled || !@json(Route::is('home')) ? 'text-blue-900 hover:text-orange-500' : 'text-white/80 hover:text-white'">Intelligence</a>
                    <a href="{{ route('search') }}" class="text-[10px] font-black uppercase tracking-[0.3em] italic transition-colors duration-500"
                       :class="scrolled || !@json(Route::is('home')) ? 'text-gray-500 hover:text-blue-900' : 'text-white/60 hover:text-white'">Inventory</a>
                    <a href="{{ route('pages.how-it-works') }}" class="text-[10px] font-black uppercase tracking-[0.3em] italic transition-colors duration-500"
                       :class="scrolled || !@json(Route::is('home')) ? 'text-gray-500 hover:text-blue-900' : 'text-white/60 hover:text-white'">Protocol</a>
                    <a href="{{ route('pages.contact') }}" class="text-[10px] font-black uppercase tracking-[0.3em] italic transition-colors duration-500"
                       :class="scrolled || !@json(Route::is('home')) ? 'text-gray-500 hover:text-blue-900' : 'text-white/60 hover:text-white'">Frequency</a>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-3 rounded-2xl bg-blue-900 text-white text-[10px] font-black hover:bg-orange-500 transition-all duration-500 shadow-2xl shadow-blue-900/20 uppercase tracking-[0.2em] italic">Terminal</a>
                        @else
                            <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.3em] italic transition-colors duration-500"
                               :class="scrolled || !@json(Route::is('home')) ? 'text-gray-500 hover:text-blue-900' : 'text-white/60 hover:text-white'">Authenticate</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-8 py-3 rounded-2xl bg-orange-500 text-white text-[10px] font-black hover:bg-blue-900 transition-all duration-500 shadow-2xl shadow-orange-500/20 uppercase tracking-[0.2em] italic">
                                    Join Elite
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 focus:outline-none transition-transform hover:scale-110"
                            :class="scrolled || !@json(Route::is('home')) ? 'text-blue-900' : 'text-white'">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-10"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-10"
             class="lg:hidden bg-white border-b border-gray-100 py-8 px-6 shadow-2xl">
            <div class="flex flex-col space-y-6">
                <a href="{{ route('home') }}" class="text-[10px] font-black text-blue-900 uppercase tracking-widest italic">Intelligence</a>
                <a href="{{ route('search') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Inventory</a>
                <a href="{{ route('pages.how-it-works') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Protocol</a>
                <a href="{{ route('pages.contact') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Frequency</a>
                <hr class="border-gray-100">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[10px] font-black text-blue-900 uppercase tracking-widest italic">Terminal</a>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Authenticate</a>
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-900 text-white text-center rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-blue-900/20">Join Elite</a>
                @endauth
            </div>
        </div>
    </nav>
 
    <!-- Page Content -->
    <main class="min-h-screen">
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
                    <a href="#" class="px-8 py-4 bg-white/5 rounded-2xl border border-white/10 text-white font-black hover:bg-orange-500 hover:border-orange-500 transition-all uppercase tracking-widest italic group overflow-hidden relative">
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
                        Registry Links
                        <span class="absolute -bottom-3 left-0 w-8 h-1 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-6 text-gray-400 font-black uppercase tracking-widest">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Intelligence Base</a></li>
                        <li><a href="{{ route('search') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Unit Inventory</a></li>
                        <li><a href="{{ route('pages.how-it-works') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Deployment Guide</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-orange-500 transition-all flex items-center gap-3 group"><span class="w-2 h-2 rounded-full border border-orange-500/30 group-hover:bg-orange-500 transition-all"></span> Global Frequency</a></li>
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

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    </script>
</body>
</html>
