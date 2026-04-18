<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Car Rent System') }}</title>
 
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
 
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Inter'] text-gray-900 antialiased bg-gray-50 min-h-screen flex flex-col items-center pt-8 pb-16 relative overflow-x-hidden selection:bg-blue-900 selection:text-white">
        
        <!-- Abstract Background Shapes (CRS BD Style) -->
        <div class="fixed top-0 right-0 w-1/3 h-full bg-blue-900 rounded-bl-[100px] skew-x-[-5deg] translate-x-20 opacity-[0.03] pointer-events-none"></div>
        <div class="fixed bottom-0 left-0 w-1/3 h-full bg-orange-500 rounded-tr-[100px] skew-x-[5deg] -translate-x-20 opacity-[0.03] pointer-events-none"></div>
 
        <div class="w-full sm:max-w-md mx-auto relative z-10 px-6 py-12">
            <!-- Logo Section -->
            <div class="flex flex-col items-center justify-center mb-10">
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <div class="flex items-center">
                        <span class="text-4xl font-black text-blue-900 tracking-tight italic">CRS</span>
                        <span class="text-4xl font-black text-orange-500 tracking-tight italic ml-2">BD</span>
                    </div>
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] mt-1 ml-1">Car Rent System Bangladesh</span>
                </a>
            </div>
 
            <!-- Content Card -->
            <div class="w-full px-8 py-10 bg-white border border-gray-100 shadow-2xl shadow-blue-900/5 sm:rounded-3xl relative overflow-hidden">
                <!-- Subtle indicator line -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-orange-500"></div>
                
                {{ $slot }}
            </div>
            
            <p class="text-center text-gray-600 text-[10px] font-bold uppercase tracking-widest mt-8">
                &copy; {{ date('Y') }} <span class="text-blue-900">CRS BD</span> • Tactical Registry
            </p>
        </div>
    </body>
</html>
