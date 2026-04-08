<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CarRent BD') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Inter'] text-slate-200 antialiased bg-gray-950 min-h-screen flex flex-col items-center pt-8 pb-16 relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">
        
        <!-- Background Neon Glows -->
        <div class="fixed top-[-20%] left-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-br from-indigo-600/30 to-purple-600/30 blur-[120px] pointer-events-none"></div>
        <div class="fixed bottom-[-20%] right-[-10%] w-[600px] h-[600px] rounded-full bg-gradient-to-br from-purple-600/20 to-pink-600/20 blur-[120px] pointer-events-none"></div>

        <div class="w-full sm:max-w-md mx-auto relative z-10 px-6 py-12">
            <!-- Logo Section -->
            <div class="flex flex-col items-center justify-center mb-10">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg shadow-indigo-500/30 transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300">
                        CR
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                        CarRent BD
                    </span>
                </a>
            </div>

            <!-- Content Card -->
            <div class="w-full px-8 py-8 bg-white/5 backdrop-blur-2xl border border-white/10 shadow-2xl shadow-black/50 sm:rounded-3xl relative overflow-hidden">
                <!-- Subtle inner top glow -->
                <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>
                
                {{ $slot }}
            </div>
            
            <p class="text-center text-gray-500 text-sm mt-8">
                &copy; {{ date('Y') }} CarRent BD. All rights reserved.
            </p>
        </div>
    </body>
</html>
