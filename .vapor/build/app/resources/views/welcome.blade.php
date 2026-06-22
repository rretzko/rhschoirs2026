<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'rhschoirs2026') }}</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="antialiased font-sans bg-zinc-50 dark:bg-zinc-900">
        <!-- Header -->
        <header class="w-full bg-white dark:bg-zinc-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-zinc-800 dark:text-white">
                    {{ config('app.name', 'rhschoirs2026') }}
                </h1>
                <nav class="flex items-center gap-4">
                    @auth
                        <flux:button href="{{ url('/dashboard') }}" variant="primary">
                            Dashboard
                        </flux:button>
                    @else
                        <flux:button href="{{ route('login') }}" variant="primary">
                            Log in
                        </flux:button>
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <main>
            <div class="relative overflow-hidden" style="background-color: #1A5C05;">
                <img src="{{ asset('images/ridge-high-school.jpg') }}" alt="Ridge High School" class="absolute inset-0 w-full h-full object-cover opacity-30" />
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:py-40">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight">
                            Ridge High School
                        </h2>
                        <p class="mt-4 text-xl sm:text-2xl text-white/90">
                            Choir Alumni Directory
                        </p>
                        <p class="mt-6 max-w-2xl mx-auto text-lg text-white/80">
                            Connecting Ridge High School choir alumni from 1983 to the present.
                            Log in to search and browse the alumni directory.
                        </p>
                        <div class="mt-10">
                            @auth
                                <flux:button href="{{ url('/dashboard') }}" variant="primary">
                                    Go to Dashboard
                                </flux:button>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2 text-base font-semibold text-green-900 bg-white rounded-lg shadow-lg hover:bg-green-100 hover:scale-105 transition">
                                    Log in to Get Started
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid gap-8 md:grid-cols-3">
                    <div class="text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">Search Alumni</h3>
                        <p class="mt-2 text-zinc-600 dark:text-zinc-400">Find choir alumni by name and discover classmates.</p>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">Browse by Year</h3>
                        <p class="mt-2 text-zinc-600 dark:text-zinc-400">View choir rosters organized by senior year.</p>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">Connect</h3>
                        <p class="mt-2 text-zinc-600 dark:text-zinc-400">Over 40 years of choir alumni in one place.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-zinc-800 border-t border-zinc-200 dark:border-zinc-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-zinc-500 dark:text-zinc-400">
                {{ config('app.name', 'rhschoirs2026') }} &copy; {{ date('Y') }}
            </div>
        </footer>
    </body>
</html>
