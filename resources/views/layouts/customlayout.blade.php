<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title.' | ' : '' }}{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex gap-8">
                            <a href="{{ url('/') }}" class="shrink-0 flex items-center">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>

                            <x-nav-link :href="route('photos.index')" :active="request()->routeIs('photos.*')">
                                {{ __('Photos') }}
                            </x-nav-link>
                        </div>

                        <div class="flex items-center gap-4 text-sm">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    {{ Auth::user()->name }}
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    {{ __('Log in') }}
                                </a>
                                <a href="{{ route('register') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    {{ __('Register') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 max-w-7xl w-full mx-auto py-12 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
                </div>
            </footer>
        </div>
    </body>
</html>
