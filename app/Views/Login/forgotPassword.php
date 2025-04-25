<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Thay đổi thành nền trắng */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            margin: 0 auto; /* Đảm bảo card nằm giữa */
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        .card-body {
            padding: 25px 30px;
            background-color: #ffffff;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
            background-color: #fff;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 8px;
            font-size: 0.95rem;
            padding: 12px 15px;
        }
        label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #495057;
        }
        .form-text {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 8px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            margin-top: 15px;
        }
        .back-link i {
            margin-right: 6px;
        }
        .verification-form {
            display: none;
        }
        .verification-form.active {
            display: block;
        }
        .email-form.hidden {
            display: none;
        }
        .code-input {
            letter-spacing: 10px;
            font-size: 1.2rem;
            text-align: center;
            font-weight: 600;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center w-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-lock me-2"></i>Forgot Password</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($success) && $success === true): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>A verification code has been sent to your email.
                            </div>
                        <?php endif; ?>
                        
                        <!-- Email Form -->
                        <form id="emailForm" action="/index.php?controller=login&action=forgotPassword" method="POST" class="email-form <?php echo (isset($success) && $success === true) ? 'hidden' : ''; ?>">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>We'll send a verification code to this email.
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Send Verification Code
                                </button>
                            </div>
                        </form>
                        
                        <!-- Verification Code Form -->
                        <form id="verificationForm" action="/index.php?controller=login&action=verifyResetCode" method="POST" class="verification-form <?php echo (isset($success) && $success === true) ? 'active' : ''; ?>">
                            <input type="hidden" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            
                            <div class="text-center mb-4">
                                <i class="fas fa-envelope-open-text text-primary" style="font-size: 3rem;"></i>
                                <h5 class="mt-3">Check Your Email</h5>
                                <p class="text-muted">We've sent a 6-digit code to your email</p>
                            </div>
                            
                            <div class="mb-4">
                                <label for="resetCode" class="form-label">Verification Code</label>
                                <input type="text" class="form-control code-input" id="resetCode" name="resetCode" maxlength="6" placeholder="------" required>
                                <div class="form-text text-center">
                                    Enter the 6-digit code we sent to your email
                                </div>
                            </div>
                            
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-2"></i>Verify Code
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <p class="mb-0">Didn't receive the code? <a href="#" id="resendCode">Resend Code</a></p>
                            </div>
                        </form>
                        
                        <div class="text-center mt-3">
                            <a href="/index.php?controller=login&action=index" class="back-link">
                                <i class="fas fa-arrow-left"></i>Back to Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle resend code click
        document.getElementById('resendCode').addEventListener('click', function(e) {
            e.preventDefault();
            // Submit the email form again
            document.getElementById('emailForm').submit();
        });
        
        // Focus on code input when verification form is active
        if (document.querySelector('.verification-form.active')) {
            setTimeout(function() {
                document.getElementById('resetCode').focus();
            }, 500);
        }
    </script>
</body>
</html>