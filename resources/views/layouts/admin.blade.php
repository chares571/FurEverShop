@php
    $adminName = 'FurEver Admin';
    $adminInitials = 'FA';
@endphp

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
    <body class="h-screen overflow-hidden bg-[#fff5ea] text-slate-900 antialiased">
        <div
            x-data="{ sidebarOpen: false }"
            class="h-screen overflow-hidden md:flex"
        >
            <aside x-cloak class="fixed inset-y-0 left-0 z-50 w-[304px] transform border-r border-slate-300 bg-[linear-gradient(180deg,#fff7ee_0%,#fffdf9_38%,#ffffff_100%)] transition-transform duration-300 ease-in-out md:relative md:translate-x-0" :class="{ '-translate-x-full': !sidebarOpen }">
                <div class="flex h-screen flex-col overflow-hidden">
                    <div class="h-12 border-b border-slate-300 px-5 py-5">
                        <div class="flex items-center justify-end md:hidden">
                            <button @click="sidebarOpen = false" type="button" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <nav class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden px-5 py-8">
                        <div class="space-y-10">
                            <section>
                                <div class="mb-5 px-2">
                                    <p class="text-[13px] font-black uppercase tracking-[0.04em] text-slate-600">Management</p>
                                </div>
                                <div class="rounded-[28px] border border-slate-300/90 bg-white/95 p-2 shadow-[0_24px_50px_-34px_rgba(15,23,42,0.28)] backdrop-blur-sm">
                                    <div class="space-y-1">
                                <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-[22px] border-2 px-4 py-4 text-sm font-bold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2 {{ request()->routeIs('admin.dashboard') ? 'border-orange-400 bg-orange-100 text-orange-700' : 'border-slate-400 bg-white text-slate-900 hover:bg-slate-50' }}">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-[14px] {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-700' : 'bg-slate-50 text-slate-700' }}">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 10.5 12 6l6 4.5V18a1 1 0 0 1-1 1h-3.5v-5h-3v5H7a1 1 0 0 1-1-1v-7.5Z" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p>Dashboard</p>
                                    </div>
                                </a>
                                <a href="{{ route('admin.products') }}" @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-[22px] border-2 px-4 py-4 text-sm font-bold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2 {{ request()->routeIs('admin.products') ? 'border-orange-400 bg-orange-100 text-orange-700' : 'border-slate-400 bg-white text-slate-900 hover:bg-slate-50' }}">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-[14px] {{ request()->routeIs('admin.products') ? 'bg-orange-50 text-orange-700' : 'bg-slate-50 text-slate-700' }}">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p>Products</p>
                                    </div>
                                </a>
                                <a href="{{ route('admin.orders') }}" @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-[22px] border-2 px-4 py-4 text-sm font-bold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2 {{ request()->routeIs('admin.orders') ? 'border-orange-400 bg-orange-100 text-orange-700' : 'border-slate-400 bg-white text-slate-900 hover:bg-slate-50' }}">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-[14px] {{ request()->routeIs('admin.orders') ? 'bg-orange-50 text-orange-700' : 'bg-slate-50 text-slate-700' }}">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p>Orders</p>
                                    </div>
                                </a>
                                <a href="{{ route('admin.reviews') }}" @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-[22px] border-2 px-4 py-4 text-sm font-bold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2 {{ request()->routeIs('admin.reviews') ? 'border-orange-400 bg-orange-100 text-orange-700' : 'border-slate-400 bg-white text-slate-900 hover:bg-slate-50' }}">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-[14px] {{ request()->routeIs('admin.reviews') ? 'bg-orange-50 text-orange-700' : 'bg-slate-50 text-slate-700' }}">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.01 3.11a1 1 0 00.95.69h3.27c.969 0 1.371 1.24.588 1.81l-2.645 1.922a1 1 0 00-.364 1.118l1.01 3.11c.3.921-.755 1.688-1.539 1.118l-2.645-1.922a1 1 0 00-1.176 0l-2.645 1.922c-.783.57-1.838-.197-1.539-1.118l1.01-3.11a1 1 0 00-.364-1.118L2.28 8.537c-.783-.57-.38-1.81.588-1.81h3.27a1 1 0 00.95-.69l1.01-3.11z" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p>Product Reviews</p>
                                    </div>
                                </a>
                                    </div>
                                </div>
                            </section>

                            <section class="border-t border-slate-400 pt-8">
                                <div class="mb-5 px-2">
                                    <p class="text-[13px] font-black uppercase tracking-[0.04em] text-slate-600">Quick Actions</p>
                                </div>
                                <div class="rounded-[28px] border border-slate-300/90 bg-white/95 p-2 shadow-[0_24px_50px_-34px_rgba(15,23,42,0.28)] backdrop-blur-sm">
                                    <div class="space-y-1.5">
                                <a href="{{ route('home') }}" target="_blank" class="group flex items-center gap-3 rounded-[22px] border-2 border-[#a9c4ff] bg-white px-4 py-4 text-sm font-bold text-slate-900 transition-all duration-200 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-[14px] bg-slate-50 text-slate-700">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p>View Shop</p>
                                    </div>
                                </a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </nav>

                    <div class="border-t border-slate-400 bg-white/90 px-5 py-6">
                        <div class="mb-4 flex items-center gap-3 rounded-[24px] border border-slate-300 bg-[#f6faff] px-4 py-4 shadow-[0_14px_32px_-28px_rgba(15,23,42,0.3)]">
                            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-slate-900 text-sm font-black tracking-[0.22em] text-white">
                                {{ $adminInitials }}
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-[15px] font-black text-slate-900">{{ $adminName }}</p>
                                <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-slate-500">Administrator</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-[24px] bg-slate-900 px-5 py-4 text-left text-[15px] font-bold text-white shadow-[0_18px_34px_-24px_rgba(15,23,42,0.45)] transition duration-200 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2">
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
                <header class="border-b border-orange-200/80 bg-white/95 px-6 py-4 shadow-sm md:hidden">
                    <div class="flex items-center justify-between">
                        <button @click="sidebarOpen = true" type="button" class="inline-flex items-center gap-2 rounded-2xl border border-orange-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-orange-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Menu
                        </button>
                        <h1 class="text-lg font-bold text-slate-900">{{ $title ?? 'Admin Dashboard' }}</h1>
                        <div class="w-20"></div> <!-- Spacer -->
                    </div>
                </header>

                <main class="flex-1 min-h-0 bg-[#fff8ef]">
                    <div class="h-full min-h-0 px-6 py-8 sm:px-8 lg:px-12 overflow-y-auto">
                        @include('components.breadcrumb', ['breadcrumbs' => $breadcrumbs ?? []])
                        <div class="mx-auto max-w-7xl">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <div id="flash-message" class="pointer-events-none fixed inset-x-0 top-4 z-[100] hidden justify-center px-4 sm:top-6">
            <div id="flash-message-card" class="fur-flash fur-flash--success pointer-events-auto w-full max-w-lg px-4 py-4 sm:px-5">
                <div class="flex items-start gap-4">
                    <div id="flash-message-badge" class="fur-flash-badge fur-flash-badge--success shrink-0">
                        <span id="flash-message-indicator" class="h-3 w-3 rounded-full bg-white/95"></span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p id="flash-message-title" class="text-xs font-black uppercase tracking-[0.28em] text-emerald-700">Success</p>
                        <p id="flash-message-text" class="mt-1 text-sm font-semibold leading-6 text-slate-800 sm:text-[15px]"></p>
                    </div>
                </div>
                <div id="flash-message-progress" class="fur-flash-progress fur-flash-progress--success"></div>
            </div>
        </div>

        <script>
            (() => {
                const container = document.getElementById('flash-message');
                const card = document.getElementById('flash-message-card');
                const badge = document.getElementById('flash-message-badge');
                const indicator = document.getElementById('flash-message-indicator');
                const title = document.getElementById('flash-message-title');
                const text = document.getElementById('flash-message-text');
                const progress = document.getElementById('flash-message-progress');
                const flashedError = @js(session('error'));
                const flashedSuccess = @js(session('success') ?? session('status'));
                let hideTimer = null;

                if (! container || ! card || ! badge || ! indicator || ! title || ! text || ! progress) {
                    return;
                }

                const showFlashMessage = (message, type = 'success') => {
                    if (! message) {
                        return;
                    }

                    const isError = type === 'error';

                    text.textContent = message;
                    title.textContent = isError ? 'Attention' : 'Success';
                    title.className = `text-xs font-black uppercase tracking-[0.28em] ${isError ? 'text-red-700' : 'text-emerald-700'}`;
                    card.classList.remove('fur-flash--success', 'fur-flash--error', 'fur-flash-visible');
                    badge.classList.remove('fur-flash-badge--success', 'fur-flash-badge--error');
                    progress.classList.remove('fur-flash-progress--success', 'fur-flash-progress--error', 'fur-flash-progress-run');
                    indicator.classList.remove('bg-white/95', 'bg-red-100');

                    card.classList.add(isError ? 'fur-flash--error' : 'fur-flash--success', 'fur-flash-visible');
                    badge.classList.add(isError ? 'fur-flash-badge--error' : 'fur-flash-badge--success');
                    progress.classList.add(isError ? 'fur-flash-progress--error' : 'fur-flash-progress--success');
                    indicator.classList.add(isError ? 'bg-red-100' : 'bg-white/95');
                    container.classList.remove('hidden');
                    container.classList.add('flex');

                    if (hideTimer) {
                        clearTimeout(hideTimer);
                    }

                    progress.classList.remove('fur-flash-progress-run');
                    void progress.offsetWidth;
                    progress.classList.add('fur-flash-progress-run');

                    hideTimer = window.setTimeout(() => {
                        container.classList.add('hidden');
                        container.classList.remove('flex');
                    }, 2400);
                };

                const handleBrowserEvent = (event) => {
                    showFlashMessage(event.detail?.message, event.detail?.type || 'success');
                };

                window.addEventListener('notify', handleBrowserEvent);
                window.addEventListener('flash-message', handleBrowserEvent);
                document.addEventListener('notify', handleBrowserEvent);
                document.addEventListener('flash-message', handleBrowserEvent);

                document.addEventListener('livewire:init', () => {
                    if (! window.Livewire?.on) {
                        return;
                    }

                    window.Livewire.on('notify', (payload = {}) => {
                        showFlashMessage(payload.message, payload.type || 'success');
                    });

                    window.Livewire.on('flash-message', (payload = {}) => {
                        showFlashMessage(payload.message, payload.type || 'success');
                    });
                });

                showFlashMessage(flashedError, 'error');
                showFlashMessage(flashedSuccess, 'success');
            })();
        </script>

        @livewireScripts
    </body>
</html>
