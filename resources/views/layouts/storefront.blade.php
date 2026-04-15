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
    <body class="min-h-screen bg-[#fff8f0] text-slate-900 antialiased">
        <div
            x-data="{ toast: null }"
            x-init="
                @if (session('success'))
                    toast = { message: @js(session('success')), type: 'success' };
                    setTimeout(() => toast = null, 2400);
                @endif
            "
            x-on:notify.window="toast = { message: $event.detail.message, type: $event.detail.type || 'success' }; setTimeout(() => toast = null, 2400)"
            class="relative min-h-screen overflow-hidden"
        >
            <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
                <div class="fur-orb -left-24 top-16 h-72 w-72 bg-orange-200/40"></div>
                <div class="fur-orb right-0 top-32 h-80 w-80 bg-blue-200/30"></div>
                <div class="fur-orb bottom-0 left-1/3 h-80 w-80 bg-emerald-200/20"></div>
            </div>

            @include('layouts.navigation')

            <main class="relative pb-20 pt-6 sm:pt-8">
                {{ $slot }}
            </main>

            <footer class="border-t border-white/70 bg-white/60 backdrop-blur-xl">
                <div class="fur-shell py-10">
                    <div class="fur-card flex flex-col gap-6 px-6 py-6 sm:px-8 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="fur-section-kicker">FurEver</p>
                            <p class="mt-2 text-2xl font-black tracking-tight text-slate-900">Thoughtful essentials for every kind of companion.</p>
                        </div>
                        <div class="space-y-1 text-sm text-slate-500 lg:text-right">
                            <p>Made for pet owners who want shopping to feel calm, clear, and caring.</p>
                            <p>&copy; {{ date('Y') }} FurEver. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>

            <div
                x-show="toast"
                x-transition.opacity.duration.200ms
                class="fixed left-1/2 top-6 z-50 w-full max-w-sm -translate-x-1/2 px-4"
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
