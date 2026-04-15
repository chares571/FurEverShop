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
                <div class="absolute left-1/2 top-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-100/35 blur-3xl"></div>
            </div>

            <div class="relative mx-auto flex max-w-6xl flex-col gap-10 lg:flex-row lg:items-center">
                <div class="space-y-6 lg:w-1/2">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-orange-600 transition hover:text-orange-700">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-white shadow-sm">&larr;</span>
                        Back to Shop
                    </a>

                    <div class="flex items-center gap-3">
                        <img
                            src="{{ asset('furreverlogo.jpg') }}"
                            alt="FurEver Logo"
                            width="36"
                            height="36"
                            class="h-9 w-9 shrink-0 rounded-xl border border-white/80 object-cover shadow-sm shadow-orange-200/50"
                            style="width: 36px; height: 36px;"
                        >
                        <div>
                            <p class="text-2xl font-black tracking-tight text-slate-900">FurEver</p>
                            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Pet essentials with heart</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="fur-section-kicker">Account access</p>
                        <h1 class="text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">A calmer way to shop and manage every pet order.</h1>
                    </div>

                    <p class="max-w-xl text-lg leading-relaxed text-slate-600">
                        Log in or create an account to track orders, move through checkout faster, and keep your pet essentials in one tidy place.
                    </p>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="fur-card flex items-center gap-3 px-4 py-4">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-orange-100 text-orange-600 font-black">OK</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Secure checkout</p>
                                <p class="text-xs text-slate-500">Encrypted and protected</p>
                            </div>
                        </div>
                        <div class="fur-card flex items-center gap-3 px-4 py-4">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-amber-100 text-amber-700 font-black">24h</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Fast delivery</p>
                                <p class="text-xs text-slate-500">Nationwide coverage</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <div class="fur-card relative overflow-hidden p-6 sm:p-8 min-h-[720px] w-full mx-auto">
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-32 bg-gradient-to-r from-orange-100/80 via-white/20 to-blue-100/70"></div>
                        <div class="relative">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
