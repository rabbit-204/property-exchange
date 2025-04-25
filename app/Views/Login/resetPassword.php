<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 500px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            margin: 0 auto;
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
        .password-strength {
            height: 5px;
            border-radius: 3px;
            margin-top: 8px;
            transition: all 0.3s ease;
        }
        #passwordFeedback {
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .strength-weak {
            background-color: #dc3545;
            width: 30%;
        }
        .strength-medium {
            background-color: #ffc107;
            width: 60%;
        }
        .strength-strong {
            background-color: #28a745;
            width: 100%;
        }
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
            color: #6c757d;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
        }
        .row {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-key me-2"></i>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="/index.php?controller=login&action=resetPassword" method="POST">
                            <input type="hidden" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                            <input type="hidden" name="resetCode" value="<?php echo isset($resetCode) ? htmlspecialchars($resetCode) : ''; ?>">
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button type="button" class="toggle-password" aria-label="toggle password visibility">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength" id="passwordStrength"></div>
                                <div id="passwordFeedback" class="form-text"></div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                    <button type="button" class="toggle-password" aria-label="toggle password visibility">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                <div id="confirmFeedback" class="form-text"></div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirmPassword');
        const strengthBar = document.getElementById('passwordStrength');
        const passwordFeedback = document.getElementById('passwordFeedback');
        const confirmFeedback = document.getElementById('confirmFeedback');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            // Check password strength
            if (password.length === 0) {
                strengthBar.className = 'password-strength';
                strengthBar.style.width = '0';
                passwordFeedback.textContent = '';
            } else if (password.length < 6) {
                strengthBar.className = 'password-strength strength-weak';
                passwordFeedback.textContent = 'Password is too weak';
                passwordFeedback.className = 'form-text text-danger';
            } else if (password.length < 10) {
                strengthBar.className = 'password-strength strength-medium';
                passwordFeedback.textContent = 'Password is medium strength';
                passwordFeedback.className = 'form-text text-warning';
            } else {
                strengthBar.className = 'password-strength strength-strong';
                passwordFeedback.textContent = 'Password is strong';
                passwordFeedback.className = 'form-text text-success';
            }
            
            // Check if confirmation matches
            if (confirmInput.value) {
                checkPasswordMatch();
            }
        });
        
        confirmInput.addEventListener('input', checkPasswordMatch);
        
        function checkPasswordMatch() {
            if (passwordInput.value === confirmInput.value) {
                confirmFeedback.textContent = 'Passwords match';
                confirmFeedback.className = 'form-text text-success';
            } else {
                confirmFeedback.textContent = 'Passwords do not match';
                confirmFeedback.className = 'form-text text-danger';
            }
        }
        
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>