<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EchoWild') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased selection:bg-emerald-500 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-emerald-50 dark:from-gray-900 dark:to-emerald-900/20 relative overflow-hidden">
            
            <!-- Global subtle grain/texture -->
            <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>

            <!-- Abstract Background Blobs -->
            <div class="absolute top-10 left-10 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob z-0"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 z-0"></div>

            <div class="relative z-10 mb-8 transform hover:scale-105 transition-transform duration-500">
                <a href="/">
                    <x-application-logo class="w-auto h-20 fill-current text-gray-800 dark:text-gray-200 drop-shadow-md" />
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md mt-6 px-8 py-10 bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-white/20 dark:border-gray-700/50">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
