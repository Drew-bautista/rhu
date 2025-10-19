<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rural Health Unit</title>
    <link rel="icon" type="image/png" href="{{ asset('img/medic_logo.png') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body,
        html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #495057;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: fadeInBox 1s ease-in-out;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes fadeInBox {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            margin: 16px 0 24px 0;
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-grid.single {
            grid-template-columns: 1fr;
        }

        .input-group {
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #343a40;
            font-weight: 500;
        }

        .input-group label .required {
            color: #dc3545;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
            color: #343a40;
            background-color: #fff;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-group textarea {
            resize: vertical;
            min-height: 60px;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
        }

        .submit-button:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .submit-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .login-link {
            margin-top: 20px;
            font-size: 14px;
            color: #495057;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #dc3545;
            font-weight: bold;
            text-transform: uppercase;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            text-align: left;
            font-size: 14px;
        }

        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #343a40;
            margin: 25px 0 15px 0;
            text-align: left;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        /* Spinner styling */
        .submit-button.loading::after {
            content: "";
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-top-color: transparent;
            border-radius: 50%;
            position: absolute;
            right: 15px;
            animation: spinner 0.6s linear infinite;
        }

        .submit-button.loading {
            pointer-events: none;
            opacity: 0.8;
            position: relative;
        }

        @keyframes spinner {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .register-box {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('img/gabaldon_BG.jpeg') }}" alt="register background"
            style="position:fixed; width:100%; height:100%; z-index:-1; object-fit:cover; filter:brightness(60%);">
        
        <div class="register-box">
            <div class="title">Rural Health Unit</div>
            <h2>Create Account</h2>
            
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}" onsubmit="showLoading(event)">
                @csrf
                
                <div class="section-title">Personal Information</div>
                
                <div class="form-grid">
                    <div class="input-group">
                        <label for="firstname">First Name <span class="required">*</span></label>
                        <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="middlename">Middle Name</label>
                        <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}">
                    </div>
                    
                    <div class="input-group">
                        <label for="lastname">Last Name <span class="required">*</span></label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="birthdate">Birth Date <span class="required">*</span></label>
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="sex">Sex <span class="required">*</span></label>
                        <select id="sex" name="sex" required>
                            <option value="">Select Sex</option>
                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    
                    <div class="input-group">
                        <label for="role">Role <span class="required">*</span></label>
                        <select id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                            <option value="nurse" {{ old('role') == 'nurse' ? 'selected' : '' }}>Nurse</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="medtech" {{ old('role') == 'medtech' ? 'selected' : '' }}>Medical Technologist</option>
                            <option value="head" {{ old('role') == 'head' ? 'selected' : '' }}>Head/Supervisor</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        </select>
                    </div>
                </div>
                
                <div class="section-title">Contact Information</div>
                
                <div class="form-grid">
                    <div class="input-group">
                        <label for="contact_no">Contact Number <span class="required">*</span></label>
                        <input type="text" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" 
                               placeholder="09XXXXXXXXX" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="emergency_contact">Emergency Contact <span class="required">*</span></label>
                        <input type="text" id="emergency_contact" name="emergency_contact" 
                               value="{{ old('emergency_contact') }}" pattern="[0-9]{11}" 
                               title="Emergency contact must be exactly 11 digits" 
                               placeholder="09XXXXXXXXX" required>
                    </div>
                </div>
                
                <div class="form-grid single">
                    <div class="input-group">
                        <label for="address">Complete Address <span class="required">*</span></label>
                        <textarea id="address" name="address" required>{{ old('address') }}</textarea>
                    </div>
                </div>
                
                <div class="section-title">Account Credentials</div>
                
                <div class="form-grid">
                    <div class="input-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="input-group">
                        <!-- Empty space for layout balance -->
                    </div>
                    
                    <div class="input-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <input type="password" id="password" name="password" required 
                               placeholder="Minimum 8 characters">
                    </div>
                    
                    <div class="input-group">
                        <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                
                <button class="submit-button" type="submit">Register</button>
                
                <p class="login-link">Already have an account? <a href="{{ route('login') }}">Log in here</a></p>
            </form>
        </div>
    </div>

    <script>
        // Add loading effect to the button on form submission
        function showLoading(event) {
            const form = event.target;
            const button = form.querySelector('.submit-button');
            
            // Basic client-side validation
            if (form.checkValidity()) {
                button.classList.add('loading');
                button.disabled = true;
                button.textContent = 'Creating Account...';
            }
        }
        
        // Password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            
            if (confirmation && password !== confirmation) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>

</html>
