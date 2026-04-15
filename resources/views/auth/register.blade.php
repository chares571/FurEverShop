<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-2">
            <p class="fur-section-kicker">Join FurEver</p>
            <h1 class="text-3xl font-black text-slate-900">Create your account</h1>
            <p class="text-sm text-slate-600">Track orders, save favorites, and keep repeat pet shopping simple.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-slate-800">Full name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="fur-input"
                    placeholder="FurEver shopper"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-slate-800">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="fur-input"
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="space-y-2">
                    <label for="password" class="text-sm font-semibold text-slate-800">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="fur-input"
                        placeholder="Create a password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-semibold text-slate-800">Confirm password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="fur-input"
                        placeholder="Repeat your password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
                </div>
            </div>

            <div class="space-y-3">
                <button type="submit" class="fur-button w-full">
                    Create account
                </button>
                <p class="text-center text-sm text-slate-600">
                    Already registered?
                    <a href="{{ route('login') }}" class="font-semibold text-orange-600 hover:text-orange-700">Log in instead</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
