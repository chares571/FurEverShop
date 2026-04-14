@php
    $isAdminShopView = auth()->check()
        && auth()->user()->isAdmin()
        && (request()->routeIs('shop.*') || request()->routeIs('home'));
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/80 bg-[#fff8f0]/90 backdrop-blur">
    <div class="fur-shell">
        <div class="flex min-h-20 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('furreverlogo.jpg') }}" alt="FurEver Logo" class="h-11 w-11 rounded-2xl shadow-lg shadow-orange-200/70">
                <div>
                    <p class="text-lg font-extrabold tracking-tight text-slate-900">FurEver</p>
                    <p class="text-xs font-medium text-slate-500">Pet essentials with heart</p>
                </div>
            </a>

            <div class="hidden items-center gap-2 lg:flex">
                <a href="{{ route('home') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'bg-white text-orange-500 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('shop.*') ? 'bg-white text-orange-500 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">Shop</a>
                @auth
                    @if (auth()->user()->isAdmin() && ! $isAdminShopView)
                        <a href="{{ route('admin.dashboard') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('admin.*') ? 'bg-white text-orange-500 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">Admin</a>
                    @elseif (! auth()->user()->isAdmin())
                        <a href="{{ route('orders.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('orders.*') ? 'bg-white text-orange-500 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">My Orders</a>
                    @endif

                    @if (! $isAdminShopView)
                        <a href="{{ route('profile.edit') }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('profile.*') ? 'bg-white text-orange-500 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">Profile</a>
                    @endif
                @endauth
            </div>

            <div class="hidden items-center gap-3 lg:flex">
                @if (! auth()->check() || ! auth()->user()->isAdmin())
                    @livewire('cart-counter')
                @endif

                @auth
                    @if ($isAdminShopView)
                        <a href="{{ route('admin.dashboard') }}" class="fur-button-secondary">Back to Dashboard</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="fur-button-secondary">Log out</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="fur-button-secondary">Log in</a>
                    <a href="{{ route('register') }}" class="fur-button">Join FurEver</a>
                @endauth
            </div>

            <button @click="open = !open" type="button" class="inline-flex rounded-2xl border border-slate-200 bg-white p-3 text-slate-700 lg:hidden">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition class="space-y-2 pb-5 lg:hidden" style="display: none;">
            <a href="{{ route('home') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Home</a>
            <a href="{{ route('shop.index') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Shop</a>
            @auth
                @if ($isAdminShopView)
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Back to Dashboard</a>
                @elseif (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Admin Dashboard</a>
                @else
                    <a href="{{ route('orders.index') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">My Orders</a>
                    <a href="{{ route('cart.index') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Cart</a>
                @endif

                @if (! $isAdminShopView)
                    <a href="{{ route('profile.edit') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full rounded-2xl bg-white px-4 py-3 text-left text-sm font-semibold text-slate-700">Log out</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="block rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-700">Log in</a>
                <a href="{{ route('register') }}" class="block rounded-2xl bg-orange-400 px-4 py-3 text-sm font-semibold text-white">Join FurEver</a>
            @endauth
        </div>
    </div>
</nav>
