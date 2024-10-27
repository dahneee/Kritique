<section style="background-color: #f0f7f4; border-radius: 10px; padding: 20px;">
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
    <label for="name" class="input-label">Name</label>
    <input id="name" name="first_name" type="text" class="input-field" value="{{ old('first_name', $user->first_name) }}" readonly />
    <x-input-error class="error-message mt-2" :messages="$errors->get('first_name')" />
</div>


        <div>
            <label for="email" class="input-label">Email</label>
            <input id="email" name="email" type="email" class="input-field" value="{{ old('email', $user->email) }}" readonly />
            <x-input-error class="error-message mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="verification-text mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="button-link">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="saved-message mt-2">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- <div class="flex items-center gap-4">
            <button type="submit" class="button-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="saved-message">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div> -->
    </form>
</section>

<style>
   
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }


    section {
        background-color: transparent!important;
        border-radius: 10px;
        padding: 20px;
        /* box-shadow: 0 4px 8px rgba(0, 128, 0, 0.1); */
        max-width: 800px!important;
        margin: auto;
    }

    header h2 {
        color: #4a7c59;
    }

    header p {
        color: #678f6f;
    }

  
    .input-label {
        display: block;
        color: #4a7c59;
        margin-bottom: 5px;
    }

   
    .input-field {
        background-color: #e6f3ea;
        border: 1px solid #a4d4b4;
        border-radius: 8px;
        color: #4a7c59;
        padding: 10px;
        width: 100%;
        font-size: 1rem;
    }

 
    .error-message {
        color: #d9534f;
        font-size: 0.875rem;
    }

   
    .verification-text {
        color: #678f6f;
        font-size: 0.875rem;
    }

    .button-link {
        color: #a4d4b4;
        text-decoration: underline;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        padding: 0;
    }

    
    .button-primary {
        background-color: #6bbf59;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 128, 0, 0.3);
        font-size: 1rem;
        border: none;
        cursor: pointer;
    }

    .button-primary:hover {
        background-color: #5aa94d;
    }

    
    .saved-message {
        color: #4caf50;
        font-size: 0.875rem;
    }

    @media (max-width: 600px) {
        .flex.items-center.gap-4 {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
