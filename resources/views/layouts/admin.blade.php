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
    <body class="h-screen overflow-hidden bg-[#fff8f0] text-slate-900 antialiased">
        <div
            x-data="{ toast: null, sidebarOpen: false }"
            x-on:notify.window="toast = { message: $event.detail.message, type: $event.detail.type || 'success' }; setTimeout(() => toast = null, 2400)"
            class="h-screen overflow-hidden md:flex"
        >
            <aside x-cloak class="fixed inset-y-0 left-0 z-50 w-80 transform border-r border-slate-200 bg-white shadow-xl transition-transform duration-300 ease-in-out md:relative md:translate-x-0" :class="{ '-translate-x-full': !sidebarOpen }">
                <div class="flex h-screen flex-col overflow-hidden">
                    <div class="border-b border-slate-200 px-5 py-5">
                        <div class="flex items-center justify-between gap-3 md:hidden">
                            <a href="{{ route('admin.dashboard') }}" class="min-w-0 flex-1">
                                <div class="rounded-[28px] border border-orange-100 bg-gradient-to-br from-[#fff8ee] via-white to-[#eef6ff] px-4 py-4 shadow-[0_10px_35px_-24px_rgba(15,23,42,0.45)]">
                                    <div class="flex items-center gap-3">
                                        <div class="grid h-12 w-12 place-items-center rounded-[20px] bg-gradient-to-br from-orange-500 to-amber-400 text-lg font-black text-white shadow-[0_16px_28px_-18px_rgba(249,115,22,0.95)]">
                                            F
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-lg font-black tracking-tight text-slate-900">FurEver</p>
                                            <div class="mt-1 inline-flex items-center rounded-full border border-slate-200 bg-white/90 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.28em] text-slate-600">
                                                Admin Console
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <button @click="sidebarOpen = false" type="button" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <a href="{{ route('admin.dashboard') }}" class="hidden md:block">
                            <div class="rounded-[28px] border border-orange-100 bg-gradient-to-br from-[#fff8ee] via-white to-[#eef6ff] px-4 py-4 shadow-[0_10px_35px_-24px_rgba(15,23,42,0.45)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_18px_42px_-28px_rgba(15,23,42,0.38)]">
                                <div class="flex items-center gap-3">
                                    <div class="grid h-14 w-14 place-items-center rounded-[22px] bg-gradient-to-br from-orange-500 to-amber-400 text-xl font-black text-white shadow-[0_16px_28px_-18px_rgba(249,115,22,0.95)]">
                                        F
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-orange-600">Control Center</p>
                                        <p class="mt-1 text-2xl font-black tracking-tight text-slate-900">FurEver</p>
                                        <div class="mt-2 inline-flex items-center rounded-full border border-slate-200 bg-white/90 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.32em] text-slate-600">
                                            Admin Console
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <nav class="flex-1 min-h-0 px-6 py-6 space-y-2 overflow-y-auto overflow-x-hidden">
                        <div class="mb-6">
                            <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500 mb-4">Management</p>
                            <div class="space-y-1">
                                <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-200' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4v4" />
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.products') }}" @click="sidebarOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.products') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-200' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    Products
                                </a>
                                <a href="{{ route('admin.orders') }}" @click="sidebarOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.orders') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-200' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Orders
                                </a>
                                <a href="{{ route('admin.reviews') }}" @click="sidebarOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('admin.reviews') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-200' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.01 3.11a1 1 0 00.95.69h3.27c.969 0 1.371 1.24.588 1.81l-2.645 1.922a1 1 0 00-.364 1.118l1.01 3.11c.3.921-.755 1.688-1.539 1.118l-2.645-1.922a1 1 0 00-1.176 0l-2.645 1.922c-.783.57-1.838-.197-1.539-1.118l1.01-3.11a1 1 0 00-.364-1.118L2.28 8.537c-.783-.57-.38-1.81.588-1.81h3.27a1 1 0 00.95-.69l1.01-3.11z" />
                                    </svg>
                                    Product Reviews
                                </a>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500 mb-4">Quick Actions</p>
                            <div class="space-y-1">
                                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition-all duration-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    View Shop
                                </a>
                            </div>
                        </div>
                    </nav>

                    <div class="border-t border-slate-200 px-6 py-6">
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

            <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/30 md:hidden"></div>

            <div class="flex flex-1 flex-col md:ml-0">
                <header class="border-b border-slate-200 bg-white px-6 py-4 shadow-sm md:hidden">
                    <div class="flex items-center justify-between">
                        <button @click="sidebarOpen = true" type="button" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Menu
                        </button>
                        <h1 class="text-lg font-bold text-slate-900">{{ $title ?? 'Admin Dashboard' }}</h1>
                        <div class="w-20"></div> <!-- Spacer -->
                    </div>
                </header>

                <main class="flex-1 min-h-0 bg-slate-50">
                    <div class="h-full min-h-0 px-6 py-8 sm:px-8 lg:px-12 overflow-y-auto">
                        @include('components.breadcrumb', ['breadcrumbs' => $breadcrumbs ?? []])
                        <div class="mx-auto max-w-7xl">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>

            <div
                x-show="toast"
                x-transition.opacity.duration.200ms
                class="fixed left-1/2 top-6 z-50 w-full max-w-sm -translate-x-1/2 px-4"
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
