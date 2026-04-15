<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-2">
            <p class="fur-section-kicker">Password reset</p>
            <h1 class="text-3xl font-black text-slate-900">Reset your password</h1>
            <p class="text-sm leading-7 text-slate-600">
                Tell us the email address linked to your account and we will send a reset link so you can choose a new password.
            </p>
        </div>

        <x-auth-session-status class="rounded-[22px] bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>

            <div class="flex justify-end">
                <x-primary-button>
                    {{ __('Email reset link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
