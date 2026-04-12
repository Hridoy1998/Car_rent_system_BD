<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Car Rent System') }}</title>

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
    <body class="font-sans antialiased text-gray-100 bg-gray-950" x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true', sidebarHovered: false }" x-init="$watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', value))">
        <div class="min-h-screen flex bg-gray-950 relative overflow-hidden">
            <!-- Neon background glows -->
            <div class="absolute top-[-10rem] left-[-10rem] w-[40rem] h-[40rem] bg-indigo-600/10 rounded-full blur-[140px] pointer-events-none animate-pulse-neon"></div>
            <div class="absolute bottom-[-10rem] right-[-10rem] w-[40rem] h-[40rem] bg-purple-600/10 rounded-full blur-[140px] pointer-events-none animate-pulse-neon" style="animation-delay: 2s"></div>

            <!-- Sidebar Station -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden lg:pl-20 transition-all duration-300" :class="{ 'lg:pl-64': !sidebarCollapsed && !sidebarHovered }">
                @include('layouts.navigation')
                <x-live-notifications />
                <x-flash-messages />

                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-transparent pt-8">
                            <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>

            <!-- Mobile Sidebar Overlay -->
            <div 
                x-show="sidebarOpen" 
                @click="sidebarOpen = false" 
                class="fixed inset-0 z-40 bg-gray-950/60 backdrop-blur-sm lg:hidden"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>
        </div>
    </body>
</html>
