<style>
    body {
        background: linear-gradient(to right, #74ebd5, #ACB6E5);
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
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert {
        border-radius: 8px;
        font-size: 0.95rem;
    }

    label {
        font-weight: 500;
    }

    .form-text {
        font-size: 0.85rem;
        color: #6c757d;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Forgot Password</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php if (isset($resetLink)): ?>
                            <div class="alert alert-info">
                                <a href="<?php echo $resetLink; ?>"><?php echo $resetLink; ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <form action="/index.php?controller=login&action=forgotPassword" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="form-text">We'll send a password reset link to this email.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Reset Link</button>
                    </form>
                    
                    <div class="mt-3">
                        <a href="/index.php?controller=login&action=index">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>