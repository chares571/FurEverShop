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
    </head>
    <body class="min-h-screen bg-[#fff8f0] text-slate-900 antialiased">
        <div class="relative isolate overflow-hidden min-h-screen px-4 py-10 sm:px-6 lg:px-10">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -left-24 top-10 h-60 w-60 rounded-full bg-orange-200/50 blur-3xl"></div>
                <div class="absolute -right-16 bottom-10 h-72 w-72 rounded-full bg-amber-100 blur-3xl"></div>
            </div>

            <div class="relative mx-auto flex max-w-6xl flex-col gap-10 lg:flex-row lg:items-center">
                <div class="space-y-6 lg:w-1/2">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-orange-600 hover:text-orange-700">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-white shadow-sm">←</span>
                        Back to Shop
                    </a>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('furreverlogo.jpg') }}" alt="FurEver Logo" class="h-12 w-12 rounded-2xl shadow-lg shadow-orange-200/70">
                        <div>
                            <p class="text-2xl font-black tracking-tight text-slate-900">FurEver</p>
                            <p class="text-sm font-medium text-slate-500">Pet essentials with heart</p>
                        </div>
                    </div>
                    <p class="text-lg leading-relaxed text-slate-600">
                        Log in or create an account to track orders, save favorites, and enjoy faster checkout on every visit.
                    </p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="flex items-center gap-3 rounded-2xl bg-white/80 px-4 py-3 shadow-sm ring-1 ring-white/60 backdrop-blur">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-orange-100 text-orange-600 font-black">✓</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Secure checkout</p>
                                <p class="text-xs text-slate-500">Encrypted & protected</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl bg-white/80 px-4 py-3 shadow-sm ring-1 ring-white/60 backdrop-blur">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-amber-100 text-amber-700 font-black">🚚</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Fast delivery</p>
                                <p class="text-xs text-slate-500">Nationwide coverage</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <div class="rounded-3xl bg-white/95 p-6 shadow-xl ring-1 ring-slate-200 backdrop-blur sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
