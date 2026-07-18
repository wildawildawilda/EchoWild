<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EchoWild - Document Your Feelings</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased text-gray-900 selection:bg-emerald-500 selection:text-white">
        
        <div class="relative min-h-screen bg-gradient-to-br from-gray-50 to-emerald-50 dark:from-gray-900 dark:to-emerald-900/20 overflow-hidden flex flex-col">
            
            <!-- Global subtle grain/texture -->
            <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>

            <!-- Abstract Background Blobs -->
            <div class="absolute -top-40 -left-40 w-[30rem] h-[30rem] bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob z-0"></div>
            <div class="absolute top-20 -right-20 w-[30rem] h-[30rem] bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 z-0"></div>
            <div class="absolute -bottom-40 left-1/2 w-[30rem] h-[30rem] bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000 z-0"></div>

            <!-- Header / Navbar -->
            <header class="relative z-20 bg-white/40 dark:bg-gray-900/40 backdrop-blur-md border-b border-white/20 dark:border-gray-800/50">
                <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                    <x-application-logo class="w-auto h-8 text-gray-900 dark:text-gray-100" />
                    
                    @if (Route::has('login'))
                        <nav class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-gray-700 dark:text-gray-200 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl hover:shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5 transition-all duration-300">Sign up</a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </header>

            <!-- Main Content (Hero Section) -->
            <main class="relative z-10 flex-grow flex items-center justify-center px-6 py-20">
                <div class="max-w-4xl w-full text-center space-y-10">
                    
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 font-medium text-sm mx-auto shadow-sm animate-fade-in-up">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Powered by AI Sentiment Analysis
                    </div>

                    <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-tight">
                        Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500">Private</span> Space to Grow
                    </h1>
                    
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
                        EchoWild is an aesthetic digital journal that helps you record daily reflections, automatically analyze emotions using AI, and visualize your inner journey.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-gray-900 dark:bg-white dark:text-gray-900 rounded-2xl hover:shadow-2xl hover:shadow-gray-900/20 transform hover:-translate-y-1 transition-all duration-300">
                                Go to Dashboard
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-gray-900 dark:bg-white dark:text-gray-900 rounded-2xl hover:shadow-2xl hover:shadow-gray-900/20 transform hover:-translate-y-1 transition-all duration-300">
                                Start Writing for Free
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-bold text-gray-700 dark:text-gray-200 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-2xl hover:bg-white dark:hover:bg-gray-800 hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                                Log in to your Account
                            </a>
                        @endauth
                    </div>
                    
                </div>
            </main>

            <!-- Footer -->
            <footer class="relative z-10 text-center py-8 text-gray-500 dark:text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} EchoWild. Made with style (and a lot of complaints).</p>
            </footer>

        </div>
    </body>
</html>
