<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title.' — ' : '' }}{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-zinc-900 antialiased">
        <div class="min-h-screen flex flex-col">
            <header class="sticky top-0 z-50 border-b border-zinc-200/80 bg-white/90 backdrop-blur-md shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-[4.25rem] flex items-center justify-between gap-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-xl p-1.5 -ml-1.5 ring-1 ring-transparent hover:ring-zinc-200/80 hover:bg-zinc-50/80 transition shrink-0">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm ring-1 ring-indigo-500/30">
                            <x-application-logo class="h-6 w-auto fill-current text-white" />
                        </span>
                        <span class="font-bold text-zinc-900 hidden sm:block">{{ config('app.name') }}</span>
                    </a>
                    <nav class="flex flex-wrap items-center justify-end gap-1 sm:gap-2 text-sm font-semibold">
                        <a href="{{ route('about') }}" class="rounded-lg px-3 py-2 transition {{ request()->routeIs('about') ? 'bg-indigo-50 text-indigo-800 ring-1 ring-indigo-200/80' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900' }}">
                            {{ __('About Us') }}
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 transition">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('tickets.index') }}" class="rounded-lg px-3 py-2 text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 transition">
                                {{ __('Tickets') }}
                            </a>
                        @else
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 transition">
                                    {{ __('Log in') }}
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white shadow-sm hover:bg-indigo-700 ring-1 ring-indigo-500/20 transition">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>
            </header>

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="border-t border-zinc-200/80 bg-white/60 backdrop-blur-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-zinc-900 text-white">
                                <x-application-logo class="h-5 w-auto fill-current text-white" />
                            </span>
                            <div class="text-left">
                                <p class="font-bold text-zinc-900">{{ config('app.name') }}</p>
                                <p class="text-xs text-zinc-500">{{ __('Built with care by our team.') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 text-sm">
                            <a href="{{ route('about') }}" class="font-medium text-zinc-600 hover:text-indigo-700">{{ __('About Us') }}</a>
                            @guest
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="font-medium text-zinc-600 hover:text-indigo-700">{{ __('Log in') }}</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-zinc-200/80 text-center text-xs text-zinc-500">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
