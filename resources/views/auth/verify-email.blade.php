<x-guest-layout>

    @if (session('status') == 'verification-link-sent')
        <div class="ac-alert ac-alert-success" role="status" style="margin-bottom: 1.1rem;">
            ✔&nbsp; A new verification link has been sent to your email address.
        </div>
    @endif

    <p style="font-family: 'Rajdhani', sans-serif; font-size: .9rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1.5rem;">
        Thank you for registering. Before accessing the system, please verify your email address by clicking the link we sent you. If you did not receive the email, request a new one below.
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="ac-submit" style="margin-bottom: 1rem;">RESEND VERIFICATION EMAIL</button>
    </form>

    <div style="text-align: center;">
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit"
                    style="font-family: 'Share Tech Mono', monospace; font-size: .62rem; color: var(--gold); letter-spacing: .1em; background: none; border: none; cursor: pointer; opacity: .75;">
                LOG OUT
            </button>
        </form>
    </div>

</x-guest-layout>
</x-guest-layout>
