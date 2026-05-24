<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>पासवर्ड रिसेट - News AI</title>
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

        .forgot-container {
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
        .forgot-left {
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

        .forgot-left::before {
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
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .logo-icon {
            font-size: 48px;
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

        .help-info {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 25px;
            margin-top: 40px;
            text-align: left;
        }

        .help-info h3 {
            font-size: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .help-info p {
            font-size: 15px;
            line-height: 1.6;
            opacity: 0.95;
            margin-bottom: 10px;
        }

        .help-info ul {
            list-style: none;
            margin-top: 15px;
        }

        .help-info ul li {
            padding: 8px 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .help-info ul li::before {
            content: '•';
            font-size: 20px;
        }

        /* Right Side - Forgot Password Form */
        .forgot-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .forgot-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .forgot-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 36px;
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
        }

        .forgot-header h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .forgot-header p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .forgot-form {
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

        .input-hint {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .reset-btn {
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
            margin-top: 10px;
        }

        .reset-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        .reset-btn:active {
            transform: translateY(0);
        }

        .reset-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }

        .back-to-login {
            text-align: center;
            margin-top: 30px;
        }

        .back-to-login a {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .back-to-login a:hover {
            color: #c82333;
            gap: 8px;
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

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            border-left: 4px solid #28a745;
            display: none;
        }

        .success-message.show {
            display: block;
            animation: slideIn 0.5s;
        }

        .success-message h4 {
            margin-bottom: 10px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .success-message p {
            line-height: 1.6;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* Info Box */
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .info-box h4 {
            color: #1976D2;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-box p {
            color: #555;
            font-size: 13px;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .forgot-container {
                grid-template-columns: 1fr;
            }

            .forgot-left {
                display: none;
            }

            .forgot-right {
                padding: 40px 30px;
            }

            .forgot-header h2 {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .forgot-right {
                padding: 30px 20px;
            }

            .forgot-header h2 {
                font-size: 24px;
            }

            .brand-title {
                font-size: 32px;
            }

            .forgot-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }
        }

        /* Loading State */
        .reset-btn.loading {
            position: relative;
            color: transparent;
        }

        .reset-btn.loading::after {
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

        /* Hidden form state */
        .forgot-form.hidden {
            display: none;
        }

        /* Alternative contact methods */
        .alternative-methods {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e9ecef;
        }

        .alternative-methods h4 {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        .contact-options {
            display: flex;
            gap: 15px;
            flex-direction: column;
        }

        .contact-option {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: #f8f9fa;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .contact-option:hover {
            border-color: #dc3545;
            background: #fff5f5;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .contact-option-content h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .contact-option-content p {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <!-- Left Side - Branding -->
        <div class="forgot-left">
            <div class="brand-content">
                <div class="logo-container">
                    <div class="logo">
                        <span class="logo-icon">🔐</span>
                    </div>
                </div>
                <h1 class="brand-title">News AI</h1>
                <p class="brand-tagline">चिन्ता नगर्नुहोस्, हामी तपाईंलाई मद्दत गर्नेछौं</p>
                
                <div class="help-info">
                    <h3>💡 सहायता चाहिन्छ?</h3>
                    <p>पासवर्ड रिसेट गर्न यी चरणहरू पालना गर्नुहोस्:</p>
                    <ul>
                        <li>आफ्नो दर्ता इमेल ठेगाना प्रविष्ट गर्नुहोस्</li>
                        <li>रिसेट लिङ्कको लागि आफ्नो इमेल जाँच गर्नुहोस्</li>
                        <li>नयाँ पासवर्ड सिर्जना गर्नुहोस्</li>
                        <li>आफ्नो खातामा लगइन गर्नुहोस्</li>
                    </ul>
                    <p style="margin-top: 20px;">यदि तपाईंलाई कुनै समस्या छ भने, हाम्रो समर्थन टोलीसँग सम्पर्क गर्नुहोस्।</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Forgot Password Form -->
        <div class="forgot-right">
            <div class="forgot-header">
                <div class="forgot-icon">🔑</div>
                <h2>पासवर्ड बिर्सनुभयो?</h2>
                <p>चिन्ता नगर्नुहोस्! हामी तपाईंलाई पासवर्ड रिसेट लिङ्क पठाउनेछौं</p>
            </div>

            <div class="error-message" id="errorMessage"></div>
            <div class="success-message" id="successMessage">
                <h4>✓ इमेल पठाइयो!</h4>
                <p>हामीले तपाईंको इमेल ठेगानामा पासवर्ड रिसेट निर्देशनहरू सहितको इमेल पठाएका छौं। कृपया आफ्नो इनबक्स (र स्प्याम फोल्डर) जाँच गर्नुहोस्।</p>
            </div>

            <form class="forgot-form" id="forgotForm" action="/forgot-password" method="POST">
                <div class="form-group">
                    <label for="email">इमेल ठेगाना</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="your@email.com" 
                            required
                            autocomplete="email"
                        >
                    </div>
                    <span class="input-hint">ℹ️ दर्ता गर्दा प्रयोग गरिएको इमेल प्रविष्ट गर्नुहोस्</span>
                </div>

                <button type="submit" class="reset-btn">रिसेट लिङ्क पठाउनुहोस्</button>

                <div class="info-box">
                    <h4>📧 इमेल प्राप्त भएन?</h4>
                    <p>कृपया आफ्नो स्प्याम वा जंक मेल फोल्डर जाँच गर्नुहोस्। यो त्यहाँ पुग्न सक्छ। यदि तपाईंले ५-१० मिनेट पछि पनि इमेल प्राप्त गर्नुभएन भने, कृपया फेरि प्रयास गर्नुहोस् वा समर्थनसँग सम्पर्क गर्नुहोस्।</p>
                </div>
            </form>

            <div class="back-to-login">
                <a href="/login">
                    ← लगइन पृष्ठमा फर्कनुहोस्
                </a>
            </div>

            <div class="alternative-methods">
                <h4>अन्य विकल्पहरू</h4>
                <div class="contact-options">
                    <a href="mailto:support@newsai.com" class="contact-option">
                        <div class="contact-icon">📧</div>
                        <div class="contact-option-content">
                            <h5>इमेल समर्थन</h5>
                            <p>support@newsai.com</p>
                        </div>
                    </a>
                    <a href="tel:+9779800000000" class="contact-option">
                        <div class="contact-icon">📞</div>
                        <div class="contact-option-content">
                            <h5>फोन समर्थन</h5>
                            <p>+977 980-0000000</p>
                        </div>
                    </a>
                    <a href="/help" class="contact-option">
                        <div class="contact-icon">❓</div>
                        <div class="contact-option-content">
                            <h5>सहायता केन्द्र</h5>
                            <p>सामान्य प्रश्नहरू हेर्नुहोस्</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form elements
        const forgotForm = document.getElementById('forgotForm');
        const resetBtn = forgotForm.querySelector('.reset-btn');
        const errorMessage = document.getElementById('errorMessage');
        const successMessage = document.getElementById('successMessage');
        const emailInput = document.getElementById('email');

        // Form submission handling
        forgotForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous messages
            errorMessage.classList.remove('show');
            successMessage.classList.remove('show');

            // Get form data
            const email = emailInput.value.trim();

            // Basic validation
            if (!email) {
                showError('कृपया इमेल ठेगाना प्रविष्ट गर्नुहोस्');
                return;
            }

            if (!isValidEmail(email)) {
                showError('कृपया मान्य इमेल ठेगाना प्रविष्ट गर्नुहोस्');
                return;
            }

            // Show loading state
            resetBtn.classList.add('loading');
            resetBtn.disabled = true;

            // Simulate API call (replace with actual API call)
            setTimeout(() => {
                // Remove loading state
                resetBtn.classList.remove('loading');
                resetBtn.disabled = false;

                // Here you would normally make an actual API call
                console.log('Password reset requested for:', email);
                
                // Show success message and hide form
                forgotForm.classList.add('hidden');
                successMessage.classList.add('show');
                
                // Uncomment below to actually submit the form
                // forgotForm.submit();
                
                // Optional: Add a resend timer
                addResendTimer();
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

        function addResendTimer() {
            // Add a "Resend" option after success
            let countdown = 60;
            const resendDiv = document.createElement('div');
            resendDiv.style.cssText = 'text-align: center; margin-top: 20px; color: #666; font-size: 14px;';
            resendDiv.innerHTML = `इमेल प्राप्त भएन? <span id="resendTimer">${countdown}</span> सेकेन्डमा फेरि पठाउन सक्नुहुन्छ`;
            
            successMessage.appendChild(resendDiv);

            const timer = setInterval(() => {
                countdown--;
                const timerElement = document.getElementById('resendTimer');
                if (timerElement) {
                    timerElement.textContent = countdown;
                }
                
                if (countdown <= 0) {
                    clearInterval(timer);
                    resendDiv.innerHTML = '<a href="#" id="resendLink" style="color: #dc3545; font-weight: 600; text-decoration: none;">फेरि पठाउनुहोस्</a>';
                    
                    document.getElementById('resendLink').addEventListener('click', function(e) {
                        e.preventDefault();
                        // Reset form and show it again
                        forgotForm.classList.remove('hidden');
                        successMessage.classList.remove('show');
                        successMessage.removeChild(resendDiv);
                        emailInput.focus();
                    });
                }
            }, 1000);
        }

        // Add input focus effects
        emailInput.addEventListener('focus', function() {
            this.parentElement.parentElement.style.transform = 'translateY(-2px)';
        });
        
        emailInput.addEventListener('blur', function() {
            this.parentElement.parentElement.style.transform = 'translateY(0)';
        });

        // Handle success message close and retry
        document.addEventListener('click', function(e) {
            if (e.target.closest('.back-to-login a')) {
                // Allow navigation to login page
                return true;
            }
        });
    </script>
</body>
</html>