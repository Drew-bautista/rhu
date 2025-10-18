<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Rural Health Unit - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/medic_logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: url('{{ asset('img/gabaldon_BG.jpeg') }}') center/cover fixed;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(0, 50, 100, 0.6) 0%, 
                rgba(0, 80, 120, 0.7) 25%,
                rgba(20, 100, 140, 0.6) 50%,
                rgba(40, 120, 160, 0.5) 75%,
                rgba(60, 140, 180, 0.4) 100%);
            z-index: -1;
        }

        /* Enhanced Background with better contrast */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: url('{{ asset('img/gabaldon_BG.jpeg') }}') center/cover fixed;
            filter: brightness(1.1) contrast(1.2) saturate(1.1);
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(0, 60, 120, 0.4) 0%, 
                rgba(20, 80, 140, 0.3) 50%,
                rgba(40, 100, 160, 0.2) 100%);
            animation: float 6s ease-in-out infinite;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 10%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-wrapper {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            border-radius: 24px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 
                0 25px 60px rgba(0, 50, 100, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, 
                #0066cc, 
                #0080e6, 
                #0099ff, 
                #0080e6, 
                #0066cc);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(60px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .logo-bg {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0066cc, #0099ff);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 102, 204, 0.4);
            animation: pulse 2s infinite;
        }

        .logo-bg i {
            font-size: 36px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 10px 30px rgba(0, 102, 204, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 15px 40px rgba(0, 102, 204, 0.5);
            }
        }

        .title {
            font-size: 28px;
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 16px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .welcome-text {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 400;
        }

        .form-container {
            margin-top: 30px;
        }

        .input-group {
            margin-bottom: 24px;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            color: #1f2937;
            background-color: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .input-group input:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.15);
            outline: none;
            transform: translateY(-2px);
        }

        .input-group input:focus + .input-wrapper i,
        .input-group.focused i {
            color: #0066cc;
        }

        .input-group input:focus + label,
        .input-group.focused label {
            color: #0066cc;
        }

        .submit-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #0066cc 0%, #0099ff 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 8px;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3);
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 204, 0.4);
            background: linear-gradient(135deg, #0052a3 0%, #0080e6 100%);
        }

        .submit-button:hover::before {
            left: 100%;
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .submit-button.loading::after {
            content: "";
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .signup-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .signup-link p {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }

        .signup-link a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .signup-link a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #0066cc, #0099ff);
            transition: width 0.3s ease;
        }

        .signup-link a:hover {
            color: #0052a3;
        }

        .signup-link a:hover::after {
            width: 100%;
        }

        .error-message {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            .login-wrapper {
                padding: 40px 30px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .subtitle {
                font-size: 14px;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .login-wrapper {
                background: rgba(17, 24, 39, 0.95);
                color: white;
            }
            
            .title {
                color: white;
            }
            
            .input-group label {
                color: #d1d5db;
            }
            
            .input-group input {
                background-color: rgba(31, 41, 55, 0.8);
                border-color: #374151;
                color: white;
            }
        }
        
        /* Watermark for login page */
        .login-watermark {
            position: fixed;
            color: rgba(255, 0, 0, 0.05);
            font-size: 16px;
            font-weight: bold;
            user-select: none;
            pointer-events: none;
            z-index: 0;
            transform: rotate(-45deg);
        }
        
        .login-watermark-corner {
            position: fixed;
            color: rgba(255, 0, 0, 0.08);
            font-size: 10px;
            font-weight: 600;
            user-select: none;
            pointer-events: none;
            z-index: 0;
            font-family: monospace;
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
        $isExpired = Carbon::now()->gt('2025-10-31');
    @endphp
    
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>
    
    {{-- Always Visible Demo Watermarks --}}
    @for($i = 0; $i < 4; $i++)
        @for($j = 0; $j < 3; $j++)
            <span class="login-watermark" style="top: {{ $j * 250 + 180 }}px; left: {{ $i * 350 + 180 }}px; color: rgba(255, 0, 0, 0.08); font-size: 16px; font-weight: bold; text-shadow: 0 0 1px rgba(255,255,255,0.3);">NOT PAID</span>
        @endfor
    @endfor
    <span class="login-watermark-corner" style="top: 10px; right: 10px; color: rgba(255, 0, 0, 0.18); font-size: 12px; font-weight: bold; text-shadow: 0 0 1px rgba(255,255,255,0.5);">TRIAL</span>
    <span class="login-watermark-corner" style="bottom: 10px; left: 10px; color: rgba(255, 0, 0, 0.18); font-size: 12px; font-weight: bold; text-shadow: 0 0 1px rgba(255,255,255,0.5);">NOT PAID</span>
    <span class="login-watermark-corner" style="top: 10px; left: 10px; color: rgba(255, 0, 0, 0.15); font-size: 11px; font-weight: bold;">DEMO</span>
    <span class="login-watermark-corner" style="bottom: 10px; right: 10px; color: rgba(255, 0, 0, 0.15); font-size: 11px; font-weight: bold;">UNPAID</span>
    
    {{-- Heavier Watermarks After Expiration --}}
    @if($isExpired)
        @for($i = 0; $i < 5; $i++)
            @for($j = 0; $j < 4; $j++)
                <span class="login-watermark" style="top: {{ $j * 200 + 100 }}px; left: {{ $i * 250 + 100 }}px;">EXPIRED</span>
            @endfor
        @endfor
        <span class="login-watermark-corner" style="top: 5px; left: 5px; color: rgba(255, 0, 0, 0.15);">EXPIRED</span>
        <span class="login-watermark-corner" style="top: 5px; right: 5px; color: rgba(255, 0, 0, 0.15);">EXPIRED</span>
        <span class="login-watermark-corner" style="bottom: 5px; left: 5px; color: rgba(255, 0, 0, 0.15);">NOT PAID</span>
        <span class="login-watermark-corner" style="bottom: 5px; right: 5px; color: rgba(255, 0, 0, 0.15);">EXPIRED</span>
    @endif

    <div class="container">
        <div class="login-wrapper">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-container">
                    <div class="logo-bg">
                        <i class="fas fa-user-md"></i>
                    </div>
                </div>
                <h1 class="title">Rural Health Unit</h1>
                <p class="subtitle">Gabaldon Health Management</p>
                <p class="welcome-text">Welcome back! Please sign in to your account</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <div class="form-container">
                <form method="POST" action="{{ route('login') }}" onsubmit="showLoading(event)">
                    @csrf
                    
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email" required autocomplete="email">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" 
                                   placeholder="Enter your password" required autocomplete="current-password">
                        </div>
                    </div>

                    <button class="submit-button" type="submit">
                        <span class="button-text">Sign In</span>
                    </button>
                </form>

                <!-- Sign Up Link -->
                <div class="signup-link">
                    <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced loading effect with better UX
        function showLoading(event) {
            const form = event.target;
            const button = form.querySelector('.submit-button');
            const buttonText = button.querySelector('.button-text');
            
            // Only show loading if form is valid
            if (form.checkValidity()) {
                button.classList.add('loading');
                button.disabled = true;
                if (buttonText) {
                    buttonText.textContent = 'Signing In...';
                }
            }
        }

        // Add focus effects to input groups
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-group input');
            
            inputs.forEach(input => {
                const inputGroup = input.closest('.input-group');
                
                input.addEventListener('focus', function() {
                    inputGroup.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!input.value) {
                        inputGroup.classList.remove('focused');
                    }
                });
                
                // Check if input has value on page load
                if (input.value) {
                    inputGroup.classList.add('focused');
                }
            });
        });

        // Add smooth transitions for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add entrance animation delay for form elements
            const formElements = document.querySelectorAll('.input-group, .submit-button, .signup-link');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });
        });
    </script>
</body>

</html>
