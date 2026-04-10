<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'NEON MONOLITH - Premium Peer-to-Peer Mobility' }}</title>
 
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
 
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-slate-200 font-['Inter'] antialiased selection:bg-indigo-500 selection:text-white">
 
    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-gray-950/80 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <x-application-logo class="w-10 h-10 shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform" />
                        <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-white to-indigo-400 tracking-tighter italic uppercase">
                            NEON MONOLITH
                        </span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-white transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-white transition-colors">Log in</a>
 
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="relative group px-6 py-2.5 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300 overflow-hidden">
                                    <span class="relative z-10 text-[10px] font-black uppercase tracking-widest text-white transition-colors">Register</span>
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
 
    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
 
    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-white/5 py-12 text-gray-500 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    <x-application-logo class="w-8 h-8 opacity-50" />
                    <span class="text-xl font-black text-white italic uppercase tracking-tighter">NEON MONOLITH</span>
                </div>
                <p class="mb-4 max-w-sm text-xs font-medium leading-relaxed uppercase tracking-tighter italic text-gray-600">The premier peer-to-peer car sharing marketplace. Secure asset management with professional standards.</p>
            </div>
            <div>
                <h4 class="text-white text-[10px] font-black mb-4 uppercase tracking-[0.3em]">Operational</h4>
                <ul class="space-y-2 text-[10px] font-black uppercase tracking-widest text-gray-600">
                    <li><a href="{{ route('pages.how-it-works') }}" class="hover:text-white transition-colors">How it Works</a></li>
                    <li><a href="{{ route('pages.safety') }}" class="hover:text-white transition-colors">Safety Standards</a></li>
                    <li><a href="{{ route('pages.mediation') }}" class="hover:text-white transition-colors italic text-indigo-400">Support & Disputes</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-white transition-colors">Help & FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-[10px] font-black mb-4 uppercase tracking-[0.3em]">Legal & Support</h4>
                <ul class="space-y-2 text-[10px] font-black uppercase tracking-widest text-gray-600">
                    <li><a href="{{ route('pages.contact') }}" class="hover:text-emerald-400 transition-colors italic">Contact Support</a></li>
                    <li><a href="{{ route('pages.termination') }}" class="hover:text-white transition-colors">Cancelation Policy</a></li>
                    <li><a href="{{ route('pages.terms') }}" class="hover:text-white transition-colors">Terms of Service</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-[9px] font-black uppercase tracking-widest">
            <p>&copy; {{ date('Y') }} NEON MONOLITH • PREMIUM CAR SHARING NETWORK</p>
            <div class="flex space-x-6 mt-4 md:mt-0 opacity-40">
                <a href="#" class="hover:text-white transition-colors">Facebook</a>
                <a href="#" class="hover:text-white transition-colors">Twitter</a>
                <a href="#" class="hover:text-white transition-colors">Instagram</a>
            </div>
        </div>
    </footer>

</body>
</html>
