<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-100 bg-gray-950">
        <div class="min-h-screen relative overflow-hidden">
            <!-- Neon background glows -->
            <div class="absolute top-[-10rem] left-[-10rem] w-[30rem] h-[30rem] bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-10rem] right-[-10rem] w-[30rem] h-[30rem] bg-purple-600/20 rounded-full blur-[120px] pointer-events-none"></div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-transparent mt-4">
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
    </body>
</html>
