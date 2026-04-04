<section>
    @unless(isset($hidePartialHeader) && $hidePartialHeader)
    <header style="margin-bottom: 1.5rem;">
        <h2 style="font-size: 1rem; font-weight: 700; letter-spacing: .04em; color: #800000; margin-bottom: .35rem;">
            {{ __('Profile Information') }}
        </h2>
        <p style="font-size: .88rem; color: #6b7280; line-height: 1.5;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    @endunless

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
                    <p style="font-size: .88rem; color: #800000;">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                                style="background: none; border: none; cursor: pointer; font-size: .75rem; color: #800000; letter-spacing: .02em; text-decoration: underline; padding: 0;">
                            {{ __('Re-send verification email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: .5rem; font-size: .85rem; color: #16a34a;">
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
                    style="font-size: .75rem; color: #16a34a; letter-spacing: .02em;"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
