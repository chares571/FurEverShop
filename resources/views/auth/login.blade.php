<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="space-y-6">
        <div class="space-y-2">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Welcome back</p>
            <h1 class="text-3xl font-black text-slate-900">Sign in to continue</h1>
            <p class="text-sm text-slate-600">Access your orders, saved carts, and personalized recommendations.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-slate-800">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-100"
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <div class="space-y-2">
                <label for="password" class="text-sm font-semibold text-slate-800">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-100"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <label for="remember_me" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 rounded border-slate-300 text-orange-500 focus:ring-orange-400"
                    >
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-orange-600 hover:text-orange-700" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <div class="space-y-3">
                <button type="submit" class="w-full rounded-2xl bg-orange-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-200">
                    Log in
                </button>
                <p class="text-center text-sm text-slate-600">
                    New to FurEver?
                    <a href="{{ route('register') }}" class="font-semibold text-orange-600 hover:text-orange-700">Create an account</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
