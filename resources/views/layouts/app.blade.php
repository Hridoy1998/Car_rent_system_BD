<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CRS BD') }} | Operational Nexus</title>

        <!-- Fonts: Institutional Stack -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            
            body { font-family: 'Outfit', sans-serif; }

            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: #050B1A; }
            ::-webkit-scrollbar-thumb { 
                background: rgba(255, 255, 255, 0.1); 
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }

            .institutional-grid {
                background-image: radial-gradient(rgba(0,0,0,0.05) 1px, transparent 1px);
                background-size: 32px 32px;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#F4F7FA]" x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true', sidebarHovered: false }" x-init="$watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', value))">
        <div class="min-h-screen flex relative overflow-hidden institutional-grid">
            <!-- Strategic Depth Decoration -->
            <div class="absolute top-0 right-0 w-2/3 h-screen bg-gradient-to-br from-blue-900/[0.03] to-transparent pointer-events-none"></div>

            <!-- Sidebar Station -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden lg:pl-20 transition-all duration-500 ease-in-out" :class="{ 'lg:pl-64': !sidebarCollapsed && !sidebarHovered }">
                @include('layouts.navigation')
                <x-live-notifications />
                <x-flash-messages />

                <div class="flex-1 overflow-y-auto custom-scrollbar relative">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white/40 backdrop-blur-xl border-b border-gray-100/50 sticky top-0 z-30">
                            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main class="p-6 sm:p-8 lg:p-12 relative z-10">
                        <div class="max-w-7xl mx-auto">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>

            <!-- Mobile Sidebar Overlay -->
            <div 
                x-show="sidebarOpen" 
                @click="sidebarOpen = false" 
                class="fixed inset-0 z-40 bg-gray-900/40 backdrop-blur-sm lg:hidden"
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
