<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CarRent BD - Peer-to-Peer Car Sharing' }}</title>

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
<body class="bg-gray-950 text-slate-200 font-['Inter'] antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 border-b border-white/5 bg-gray-950/60 backdrop-blur-3xl" x-data="{ atTop: true }" @scroll.window="atTop = (window.pageYOffset > 40) ? false : true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24 transition-all duration-500" :class="atTop ? 'h-24' : 'h-20'">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                        <x-application-logo class="w-10 h-10 shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform" />
                        <div class="flex flex-col">
                            <span class="text-xl font-black text-white tracking-widest leading-none">Car Rent System</span>
                            <span class="text-[9px] font-black text-indigo-400 tracking-[0.4em] uppercase mt-1 italic">Premium Car Sharing</span>
                        </div>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-10">
                    <a href="{{ route('search') }}" class="text-[10px] font-black text-gray-400 hover:text-white uppercase tracking-[0.2em] transition-colors">Search Cars</a>
                    <a href="{{ route('pages.how-it-works') }}" class="text-[10px] font-black text-gray-400 hover:text-white uppercase tracking-[0.2em] transition-colors">How it Works</a>
                    <a href="{{ route('pages.safety') }}" class="text-[10px] font-black text-gray-400 hover:text-white uppercase tracking-[0.2em] transition-colors">Safety</a>
                </div>

                <div class="flex items-center space-x-6">
                    @auth
                        <div class="flex items-center gap-6">
                            <a href="{{ route('dashboard') }}" class="text-[10px] font-black text-white bg-indigo-600 hover:bg-indigo-500 px-6 py-3 rounded-2xl shadow-[0_10px_20px_rgba(99,102,241,0.2)] transition-all uppercase tracking-widest">Dashboard</a>
                            <livewire:notification-bell />
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black text-gray-400 hover:text-white uppercase tracking-widest transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-6 py-3 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-indigo-500/50 transition-all duration-300 group">
                            <span class="text-[10px] font-black text-white uppercase tracking-widest group-hover:text-glow">Register</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-white/5 py-24 text-gray-400 text-sm overflow-hidden relative">
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-500/5 blur-[100px] rounded-full -z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-20 mb-20">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-4 mb-8">
                    <x-application-logo class="w-10 h-10 shadow-lg shadow-indigo-500/20" />
                    <span class="text-2xl font-black text-white tracking-widest uppercase italic">Car Rent System</span>
                </div>
                <p class="mb-8 max-w-sm leading-relaxed text-gray-500 font-medium">The premier peer-to-peer car sharing marketplace in Bangladesh. Secure rentals and professional standards for every journey.</p>
                <div class="flex gap-6">
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">FB</a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">TW</a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">IG</a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-black mb-8 uppercase text-[10px] tracking-[0.3em] italic">Information</h4>
                <ul class="space-y-4 text-[11px] font-bold uppercase tracking-widest">
                    <li><a href="{{ route('pages.how-it-works') }}" class="hover:text-indigo-400 transition-colors">How it Works</a></li>
                    <li><a href="{{ route('pages.safety') }}" class="hover:text-indigo-400 transition-colors">Security & Trust</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-indigo-400 transition-colors">Help & FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-black mb-8 uppercase text-[10px] tracking-[0.3em] italic">Support</h4>
                <ul class="space-y-4 text-[11px] font-bold uppercase tracking-widest">
                    <li><a href="{{ route('pages.mediation') }}" class="hover:text-indigo-400 transition-colors">Support Center</a></li>
                    <li><a href="{{ route('pages.contact') }}" class="hover:text-indigo-400 transition-colors">Contact Us</a></li>
                    <li><a href="{{ route('pages.termination') }}" class="hover:text-indigo-400 transition-colors">Cancelation Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center">
            <p class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-700 italic">&copy; {{ date('Y') }} Car Rent System. PREMIUM CAR SHARING NETWORK.</p>
            <div class="flex gap-8 mt-6 md:mt-0 text-[9px] font-black uppercase tracking-widest">
                <a href="#" class="text-gray-700 hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="text-gray-700 hover:text-white transition-colors">Privacy Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>
