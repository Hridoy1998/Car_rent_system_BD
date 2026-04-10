<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NEON MONOLITH') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #020617; }
            ::-webkit-scrollbar-thumb { 
                background: #1e293b; 
                border-radius: 10px;
                border: 2px solid #020617;
            }
            ::-webkit-scrollbar-thumb:hover { background: #334155; }

            .neon-shadow-blue { box-shadow: 0 0 15px rgba(59, 130, 246, 0.5); }
            .neon-shadow-emerald { box-shadow: 0 0 15px rgba(16, 185, 129, 0.5); }
            .neon-shadow-purple { box-shadow: 0 0 15px rgba(168, 85, 247, 0.5); }
            
            .glass {
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            @keyframes pulse-neon {
                0%, 100% { opacity: 0.5; filter: blur(120px); }
                50% { opacity: 0.8; filter: blur(140px); }
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-100 bg-gray-950">
        <div class="min-h-screen relative overflow-hidden">
            <!-- Neon background glows -->
            <div class="absolute top-[-10rem] left-[-10rem] w-[30rem] h-[30rem] bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-10rem] right-[-10rem] w-[30rem] h-[30rem] bg-purple-600/20 rounded-full blur-[120px] pointer-events-none"></div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-transparent pt-20">
                    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="{{ isset($header) ? '' : 'pt-20' }}">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
