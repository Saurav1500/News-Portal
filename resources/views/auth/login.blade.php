<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>लगइन - News AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Devanagari', sans-serif;
            background: linear-gradient(135deg, #dc3545, #c82333);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            animation: slideIn 0.5s ease-out;
        }
        .input-error {
            color: red;
            font-size: 14px;
            margin-top: 5px;            
        }
        .alert {
            padding: 10px;
            /* background-color: #f44336; */
            height: 50px;
            width: 100%;
            border:Solid 1px #f44336;
            border-radius: 5px;
            color: white;
            margin-bottom: 10px;
            animation: slideIn 0.5s ease-out;
        }
        .alert-danger{
            background-color: #f44336;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Side - Branding */
        .login-left {
            background: linear-gradient(135deg, #dc3545, #c82333);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .brand-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: #dc3545;
        }

        .brand-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .brand-tagline {
            font-size: 18px;
            opacity: 0.95;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .brand-features {
            list-style: none;
            text-align: left;
            margin-top: 40px;
        }

        .brand-features li {
            padding: 12px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-features li::before {
            content: '✓';
            background: rgba(255,255,255,0.2);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Right Side - Login Form */
        .login-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-header p {
            color: #666;
            font-size: 16px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
            margin-left: 5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .form-group input {
            padding: 15px 15px 15px 45px;
            border: 2px solid #111315;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            font-family: 'Noto Sans Devanagari', sans-serif;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #dc3545;
            background: white;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: -10px 0 10px 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #dc3545;
        }

        .remember-me label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
            font-weight: 400;
        }

        .forgot-password {
            color: #dc3545;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #c82333;
            text-decoration: underline;
        }

        .login-btn {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Noto Sans Devanagari', sans-serif;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            color: #999;
            font-size: 14px;
        }

        .social-login {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: white;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: #dc3545;
            color: #dc3545;
            background: #fff5f5;
        }

        .social-icon {
            width: 20px;
            height: 20px;
        }

        .signup-link {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .signup-link a:hover {
            color: #c82333;
            text-decoration: underline;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            border-left: 4px solid #dc3545;
            display: none;
        }

        .error-message.show {
            display: block;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }

            .login-left {
                display: none;
            }

            .login-right {
                padding: 40px 30px;
            }

            .login-header h2 {
                font-size: 28px;
            }

            .social-login {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .login-right {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 24px;
            }

            .brand-title {
                font-size: 32px;
            }
        }

        /* Loading State */
        .login-btn.loading {
            position: relative;
            color: transparent;
        }

        .login-btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
  
    <div class="login-container">
         {{-- show error --}}
         

        <!-- Left Side - Branding -->
        <div class="login-left">
            <div class="brand-content">
                <div class="logo-container">
                    <div class="logo">
                        <span class="logo-text">NA</span>
                    </div>
                </div>
                <h1 class="brand-title">News AI</h1>
                <p class="brand-tagline">{{ __('site.auth.brand_tagline') }}</p>
                <ul class="brand-features">
                    <li>{{ __('site.auth.features.fresh') }}</li>
                    <li>{{ __('site.auth.features.categories') }}</li>
                    <li>{{ __('site.auth.features.analysis') }}</li>
                    <li>{{ __('site.auth.features.always_on') }}</li>
                </ul>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  @if (session('success'))
                      <div class="alert" style="background-color: #28a745; border-color: #28a745;">
                          {{ session('success') }}
                      </div>
                  @endif
                <h2>{{ __('site.auth.login.title') }}</h2>
                <p>{{ __('site.auth.login.subtitle') }}</p>
            </div>

            <div class="error-message" id="errorMessage">
                <!-- Error messages will be displayed here -->
            </div>

            <form class="login-form" id="loginForm" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('site.auth.email') }}</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="your@email.com" 
                            required
                            autocomplete="email"
                            value="{{ old('email') }}"
                        >
                    </div>
                    {{-- <span class="input-error" id="emailError"></span> --}}
                    @error('email')
                        <span class="input-error" id="emailError" >{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('site.auth.password') }}</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••" 
                            required
                            value="{{ old('password') }}"
                            autocomplete="current-password"
                        >

                    </div>
                    @error('password')
                        <span class="input-error" id="passwordError" >{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">{{ __('site.auth.remember') }}</label>
                    </div>
                    <a href="/forgot-password" class="forgot-password">{{ __('site.auth.forgot_password') }}</a>
                </div>

                <button type="submit" class="login-btn">{{ __('site.auth.login.button') }}</button>
            </form>

            <div class="divider">
                <span>{{ __('site.auth.or') }}</span>
            </div>

            <div class="social-login">
                <a href="/auth/google" class="social-btn">
                    <svg class="social-icon" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    {{ __('site.auth.google') }}
                </a>
                <a href="/auth/facebook" class="social-btn">
                    <svg class="social-icon" viewBox="0 0 24 24">
                        <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    {{ __('site.auth.facebook') }}
                </a>
            </div>

            <div class="signup-link">
                {{ __('site.auth.no_account') }} <a href="/register">{{ __('site.auth.signup_link') }}</a>
            </div>
        </div>
    </div>
    <script>
        // remove alert in 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
        // loading login
        // const loginForm = document.getElementById('loginForm');
        // const loginBtn = loginForm.querySelector('.login-btn');
        // loginBtn.addEventListener('click', () => {
        //     loginBtn.classList.add('loading');
        // });

    </script>
    {{-- <script>
        // Form submission handling
        const loginForm = document.getElementById('loginForm');
        const loginBtn = loginForm.querySelector('.login-btn');
        const errorMessage = document.getElementById('errorMessage');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            errorMessage.classList.remove('show');
            errorMessage.textContent = '';

            // Get form data
            const formData = new FormData(loginForm);
            const email = formData.get('email');
            const password = formData.get('password');

            // Basic validation
            if (!email || !password) {
                showError('कृपया सबै क्षेत्रहरू भर्नुहोस्');
                return;
            }

            if (!isValidEmail(email)) {
                showError('कृपया मान्य इमेल ठेगाना प्रविष्ट गर्नुहोस्');
                return;
            }

            // Show loading state
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;

            // Simulate API call (replace with actual API call)
            setTimeout(() => {
                // Remove loading state
                loginBtn.classList.remove('loading');
                loginBtn.disabled = false;

                // Here you would normally make an actual API call
                // For demonstration, we'll just log the data
                console.log('Login attempt:', { email, password });
                
                // Uncomment below to actually submit the form
                // loginForm.submit();
                
                // For demo purposes, show success message
                alert('लगइन सफल! (यो डेमो मोड हो)');
            }, 1500);
        });

        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.classList.add('show');
            
            // Remove error after 5 seconds
            setTimeout(() => {
                errorMessage.classList.remove('show');
            }, 5000);
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Add input focus effects
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script> --}}
</body>
</html>