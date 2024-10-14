<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="login-container">
        
        <div class="login-left">
            <div class="login-content">
                <h2 class="login-title">LOGIN</h2>
                <p class="login-subtitle">helo ebribadi</p>
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
            
                    <div class="input-group">
                        <label for="email" class="block">Username</label>
                            <div class="icon"> <i class="fa-solid fa-user"></i> </div>
                        <input id="email" class="form-input" type="email" name="email" required autofocus autocomplete="username" />
                    </div>
    
                    <div class="input-group">
                        <label for="password" class="block">Password</label>
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                    </div>
                    <div class="forgot-pass">
                        <a href="#">Forgot password?</a>
                    </div>
    
                    <div class="form-actions">
                        <button type="submit" class="login-btn">Login Now</button>
                    </div>
                </form>
    
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>
        </div>

        <div class="login-right"></div>
        
    </div>
</body>
</html>