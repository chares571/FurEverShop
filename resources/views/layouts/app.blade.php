<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FurEver') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-[#fff8f0] text-slate-900 antialiased">
        <div class="min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
                <div class="fur-orb -left-24 top-16 h-72 w-72 bg-orange-200/40"></div>
                <div class="fur-orb right-0 top-24 h-80 w-80 bg-blue-200/25"></div>
            </div>

            @include('layouts.navigation')

            @isset($header)
                <header class="fur-shell py-8">
                    <div class="fur-card px-6 py-6 sm:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="pb-20">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
