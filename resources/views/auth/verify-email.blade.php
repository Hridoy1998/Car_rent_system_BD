<x-guest-layout>
    <div class="mb-6 text-sm text-gray-400 leading-relaxed text-center">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-emerald-400 text-center bg-emerald-500/10 p-4 rounded-xl border border-emerald-500/20">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-8 flex flex-col items-center justify-center space-y-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <x-primary-button class="w-full py-3 text-lg">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-400 hover:text-white transition-colors underline bg-transparent border-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
