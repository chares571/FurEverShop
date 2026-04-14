<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'FurEver') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen">
        <div
            x-data="{ toast: null }"
            x-on:notify.window="toast = { message: $event.detail.message, type: $event.detail.type || 'success' }; setTimeout(() => toast = null, 2400)"
            class="relative min-h-screen"
        >
            @include('layouts.navigation')

            <main class="pb-16">
                {{ $slot }}
            </main>

            <div
                x-show="toast"
                x-transition.opacity.duration.200ms
                class="fixed bottom-6 right-6 z-50 max-w-sm"
                style="display: none;"
            >
                <div class="fur-card flex items-center gap-3 px-5 py-4">
                    <span class="h-3 w-3 rounded-full" :class="toast?.type === 'error' ? 'bg-red-400' : 'bg-emerald-400'"></span>
                    <p class="text-sm font-medium text-slate-700" x-text="toast?.message"></p>
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
