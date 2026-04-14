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
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <div
            x-data="{ toast: null, sidebarOpen: false }"
            x-on:notify.window="toast = { message: $event.detail.message, type: $event.detail.type || 'success' }; setTimeout(() => toast = null, 2400)"
            class="min-h-screen md:flex"
        >
            <aside class="absolute inset-y-0 left-0 z-40 w-64 transform border-r border-slate-200 bg-white shadow-xl transition duration-300 ease-in-out md:relative md:w-56 md:translate-x-0" :class="{ '-translate-x-full': !sidebarOpen }">
                <div class="flex h-full flex-col">
                    <div class="border-b border-slate-200 px-4 py-4">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                            <div class="grid h-10 w-10 place-items-center rounded-3xl bg-orange-50 text-orange-600 shadow-sm">
                                <span class="text-base font-black">F</span>
                            </div>
                            <div>
                                <p class="text-base font-black tracking-tight text-slate-900">FurEver</p>
                                <p class="text-[10px] font-medium uppercase tracking-[0.25em] text-slate-500">Admin</p>
                            </div>
                        </a>
                    </div>

                    <nav class="px-4 py-4 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4v4" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.products') }}" class="flex items-center gap-3 rounded-2xl px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('admin.products') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Products
                        </a>
                        <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 rounded-2xl px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('admin.orders') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Orders
                        </a>
                        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-2xl px-3 py-2 text-sm font-semibold transition text-slate-600 hover:bg-slate-50">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            View Shop
                        </a>
                    </nav>

                    <div class="mt-auto px-4 pb-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-3xl bg-slate-900 px-4 py-3 text-left text-sm font-semibold text-white transition hover:bg-slate-800">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="flex flex-1 flex-col">
                <main class="flex-1 overflow-auto bg-slate-100">
                    <div class="min-h-screen px-4 py-4 sm:px-5 lg:px-6">
                        <div class="md:hidden mb-3">
                            <button @click="sidebarOpen = !sidebarOpen" type="button" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Menu
                            </button>
                        </div>
                        {{ $slot }}
                    </div>
                </main>
            </div>

            <div
                x-show="toast"
                x-transition.opacity.duration.200ms
                class="fixed bottom-6 right-6 z-50 max-w-sm"
                style="display: none;"
            >
                <div class="fur-card flex items-center gap-3 px-5 py-4 shadow-lg">
                    <span class="h-3 w-3 rounded-full" :class="toast?.type === 'error' ? 'bg-red-400' : 'bg-emerald-400'"></span>
                    <p class="text-sm font-medium text-slate-700" x-text="toast?.message"></p>
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
