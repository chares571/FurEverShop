<section class="space-y-6">
    <header>
        <p class="fur-section-kicker">Danger zone</p>
        <h2 class="mt-2 text-2xl font-black text-slate-900">
            Delete account
        </h2>

        <p class="mt-2 text-sm leading-7 text-slate-500">
            Deleting your account permanently removes your profile and related data. Make sure you truly want to clear everything before continuing.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-full bg-red-600 px-5 py-3 text-sm font-semibold uppercase tracking-normal"
    >{{ __('Delete account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-slate-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm leading-7 text-slate-500">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Enter your password to confirm this action.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-500" />
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="rounded-full px-5 py-3 text-sm font-semibold uppercase tracking-normal">
                    {{ __('Delete account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
