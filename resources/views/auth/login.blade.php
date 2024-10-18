<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kritique</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="/src/logow.png">
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo-container">
                <div class="logo-img-container">
                    <img src="src/logow.png" alt="Kritique" class="logo-img">
                </div>
            </div>

            <div class="login-content">
                <h2 class="login-title">Welcome to Kritique!</h2>
                <p class="login-subtitle">Please login to your account</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <div class="icon icon-left">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <input id="email" class="form-input" type="email" name="email" required autofocus autocomplete="username"
                        placeholder="Email address"/>
                    </div>

                    <div class="input-group">
                        <div class="icon icon-left">
                            <i class="fa fa-lock"></i>
                        </div>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" 
                        placeholder="Password"/>
                        <div class="icon icon-right">
                            <i class="fa fa-eye" id="togglePassword"></i>
                        </div>
                    </div>

                    <div class="remember-me-container">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="forgot-pass">
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="login-btn">Login</button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger error-message">
                        {{ $errors->first() }}
                    </div>
                @endif

            </div>
        </div>

        <div class="login-right">
            <img src="src/stuwitteach.png" alt="Student and Teacher" class="right-image">
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
