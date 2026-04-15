<x-guest-layout>
    <x-auth-session-status class="mb-4 rounded-[22px] bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700" :status="session('status')" />

    <div class="space-y-6">
        <div class="space-y-2">
            <p class="fur-section-kicker">Welcome back</p>
            <h1 class="text-3xl font-black text-slate-900">Sign in to continue</h1>
            <p class="text-sm text-slate-600">Access your orders, saved carts, and a faster checkout flow.</p>
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
                    class="fur-input"
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
                    class="fur-input"
                    placeholder="Enter your password"
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
                <button type="submit" class="fur-button w-full">
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
