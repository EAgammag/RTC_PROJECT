<section>
    <header style="margin-bottom: 1.5rem;">
        <h2 style="font-family: 'Anton', sans-serif; font-size: 1rem; letter-spacing: .14em; color: #FFD700; margin-bottom: .35rem;">
            {{ __('Profile Information') }}
        </h2>
        <p style="font-family: 'Rajdhani', sans-serif; font-size: .88rem; color: #7a8fa8; line-height: 1.5;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: .75rem;">
                    <p style="font-family: 'Rajdhani', sans-serif; font-size: .88rem; color: #FFE44D;">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                                style="background: none; border: none; cursor: pointer; font-family: 'Share Tech Mono', monospace; font-size: .65rem; color: #FFD700; letter-spacing: .08em; text-decoration: underline; padding: 0;">
                            {{ __('Re-send verification email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: .5rem; font-family: 'Rajdhani', sans-serif; font-size: .85rem; color: #4ade80;">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="font-family: 'Share Tech Mono', monospace; font-size: .65rem; color: #4ade80; letter-spacing: .08em;"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
