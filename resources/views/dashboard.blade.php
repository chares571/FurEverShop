<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="fur-section-kicker">Dashboard</p>
                <h2 class="text-3xl font-black tracking-tight text-slate-900">
                    Your account hub
                </h2>
            </div>
            <a href="{{ route('shop.index') }}" class="fur-button-secondary">Go to shop</a>
        </div>
    </x-slot>

    <div class="fur-shell pb-16">
        <div class="fur-card px-6 py-8 sm:px-8">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Signed in</p>
            <h3 class="mt-3 text-3xl font-black tracking-tight text-slate-900">You are ready to keep shopping.</h3>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">
                Use the navigation to review your orders, update your profile, or head back to the storefront for your next pet essential.
            </p>
        </div>
    </div>
</x-app-layout>
