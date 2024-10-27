
<section style="background-color: #f0f7f4; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 128, 0, 0.1);">
    <header style="text-align: center; margin-bottom: 20px;">
        <h2 class="text-lg font-medium" style="color: #4a7c59; font-family: 'Poppins', sans-serif;">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm" style="color: #678f6f; font-family: 'Poppins', sans-serif;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" style="color: #4a7c59; font-family: 'Poppins', sans-serif;" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" style="background-color: #e6f3ea; border: 1px solid #a4d4b4; border-radius: 8px; color: #4a7c59;" :value="old('name', $user->first_name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" style="color: #d9534f;" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" style="color: #4a7c59; font-family: 'Poppins', sans-serif;" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" style="background-color: #e6f3ea; border: 1px solid #a4d4b4; border-radius: 8px; color: #4a7c59;" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" style="color: #d9534f;" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2" style="color: #678f6f; font-family: 'Poppins', sans-serif;">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm hover:text-green-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="color: #a4d4b4;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm" style="color: #4caf50; font-family: 'Poppins', sans-serif;">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color: #6bbf59; border-radius: 8px; font-family: 'Poppins', sans-serif; color: white; padding: 8px 16px; box-shadow: 0 2px 4px rgba(0, 128, 0, 0.3);">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm"
                    style="color: #4caf50; font-family: 'Poppins', sans-serif;"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
 
    .input-label, .input-field {
        font-family: 'Poppins', sans-serif;
    }

    .input-label {
        color: #4a7c59;
    }

    .input-field {
        background-color: #e6f3ea;
        border: 1px solid #a4d4b4;
        border-radius: 8px;
        color: #4a7c59;
    }

    .error-message {
        color: #d9534f;
    }

    .verification-text {
        color: #678f6f;
        font-family: 'Poppins', sans-serif;
    }

    .button-primary {
        background-color: #6bbf59;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        color: white;
        padding: 8px 16px;
        box-shadow: 0 2px 4px rgba(0, 128, 0, 0.3);
    }

    .saved-message {
        color: #4caf50;
        font-family: 'Poppins', sans-serif;
    }
</style>
