<section class="space-y-6">
    <header>
        <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 1rem; letter-spacing: .14em; color: #f87171; margin-bottom: .35rem;">
            {{ __('Delete Account') }}
        </h2>
        <p style="font-family: 'Rajdhani', sans-serif; font-size: .88rem; color: #7a8fa8; line-height: 1.5;">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 1rem; letter-spacing: .14em; color: #f87171; margin-bottom: .5rem;">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p style="font-family: 'Rajdhani', sans-serif; font-size: .88rem; color: #94a3b8; line-height: 1.5; margin-bottom: 1.25rem;">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
