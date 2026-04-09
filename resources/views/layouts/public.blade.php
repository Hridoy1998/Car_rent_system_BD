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
</head>
<body class="bg-gray-950 text-slate-200 font-['Inter'] antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-gray-950/80 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform">
                            CR
                        </div>
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                            CarRent BD
                        </span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="relative group px-6 py-2.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300 overflow-hidden">
                                    <span class="relative z-10 text-sm font-medium text-white group-hover:text-white transition-colors">Register</span>
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
    <footer class="bg-gray-950 border-t border-white/5 py-12 text-gray-400 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                        CR
                    </div>
                    <span class="text-xl font-bold text-white">CarRent BD</span>
                </div>
                <p class="mb-4 max-w-sm">The premier peer-to-peer car sharing marketplace in Bangladesh. Rent out your car to earn, or book one for your next trip.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Marketplace</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.how-it-works') }}" class="hover:text-white transition-colors">How it works</a></li>
                    <li><a href="{{ route('pages.safety') }}" class="hover:text-white transition-colors">Trust & Safety</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-white transition-colors">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-wider">Support</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="mailto:support@carrent-bd.com" class="hover:text-white transition-colors">Contact Support</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-xs">
            <p>&copy; {{ date('Y') }} CarRent BD. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="text-gray-500 hover:text-white transition-colors">Facebook</a>
                <a href="#" class="text-gray-500 hover:text-white transition-colors">Twitter</a>
                <a href="#" class="text-gray-500 hover:text-white transition-colors">Instagram</a>
            </div>
        </div>
    </footer>

</body>
</html>
