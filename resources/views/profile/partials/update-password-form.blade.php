<section style="background-color: #f0f7f4; border-radius: 10px; padding: 20px; ">
    <header style="text-align: center; margin-bottom: 20px;">
        <h2 class="text-lg font-medium" style="color: #4a7c59; font-family: 'Poppins', sans-serif;">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm" style="color: #678f6f; font-family: 'Poppins', sans-serif;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="input-label">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input-field" autocomplete="current-password" />
            <x-input-error class="error-message mt-2" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
    <label for="update_password_current_password" class="input-label">Current Password</label>
    <div class="password-wrapper">
        <input id="update_password_current_password" name="current_password" type="password" class="input-field" autocomplete="current-password" />
        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('update_password_current_password', this)"></i>
    </div>
    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
</div>

<div>
    <label for="update_password_password" class="input-label">New Password</label>
    <div class="password-wrapper">
        <input id="update_password_password" name="password" type="password" class="input-field" autocomplete="new-password" />
        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('update_password_password', this)"></i>
    </div>
    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
</div>

<div>
    <label for="update_password_password_confirmation" class="input-label">Confirm Password</label>
    <div class="password-wrapper">
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-field" autocomplete="new-password" />
        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('update_password_password_confirmation', this)"></i>
    </div>
    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
</div>


        <div class="flex items-center gap-4">
            <button type="submit" class="button-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="saved-message">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<style>
    .password-wrapper {
    position: relative;
}

.password-wrapper .toggle-password {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #678f6f;
}

 
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    section {
        /* background-color: #f0f7f4; */
        border-radius: 10px;
        padding: 20px;
        /* box-shadow: 0 4px 8px rgba(0, 128, 0, 0.1); */
        max-width: 600px;
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
