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
