<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="fur-section-kicker">Profile</p>
            <h2 class="text-3xl font-black tracking-tight text-slate-900">
                Account settings
            </h2>
        </div>
    </x-slot>

    <div class="fur-shell space-y-6 pb-16">
        <div class="fur-card p-6 sm:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="fur-card p-6 sm:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="fur-card p-6 sm:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
