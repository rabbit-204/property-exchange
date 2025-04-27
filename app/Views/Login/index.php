<!-- filepath: e:\hk242\WEB\ASSIGNMENT\app\Views\Login\index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Views/Login/style.css">
</head>

<!-- filepath: e:\hk242\WEB\ASSIGNMENT\app\Views\Login\index.php -->
<body>
    <div class="container">
        <!-- Login Form -->
        <div class="form-container <?= isset($showRegister) && $showRegister ? '' : 'active' ?>" id="loginForm">
            <div class="form-section">
                <h1>Đăng nhập.</h1>
                <?php if (isset($error) && !isset($showRegister)) : ?>
                    <p style="color: red;"><?= $error ?></p>
                <?php endif; ?>
                <form action="/index.php?controller=login&action=login" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="/index.php?controller=login&action=forgotPassword" class="text-decoration-none">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
                <div class="d-flex justify-content-between mt-3">
                    <a href="index.php?controller=homepage&action=index" style="align-self:flex-end;  color: black; font-size: 16px; text-decoration: none;">Quay về trang chủ</a>
                    <div id="showRegister1"> Đăng ký</div>
                </div>
            </div>
            <div class="image-section">
                <p>Bạn chưa có tài khoản?</p>
                <button id="showRegister">Đăng ký</button>
            </div>
        </div>

        <!-- Register Form -->
        <div class="form-container <?= isset($showRegister) && $showRegister ? 'active' : '' ?>" id="registerForm">
            <div class="image-section">
                <p>Bạn đã có tài khoản?</p>
                <button id="showLogin">Đăng nhập</button>
            </div>
            <div class="form-section">
                <h1>Đăng ký</h1>
                <?php if (isset($error) && isset($showRegister)) : ?>
                    <p style="color: red;"><?= $error ?></p>
                <?php endif; ?>
                <form action="/index.php?controller=login&action=register" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="confirmPW" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                </form>
                <div style="align-self:flex-start; margin-top: 20px; cursor: pointer;" id="showLogin1">Đăng nhập</div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const showRegister = document.getElementById('showRegister');
        const showRegister1 = document.getElementById('showRegister1');
        const showLogin = document.getElementById('showLogin');
        const showLogin1 = document.getElementById('showLogin1');

        showRegister.addEventListener('click', () => {
            loginForm.classList.remove('active');
            registerForm.classList.add('active');
        });

        showLogin.addEventListener('click', () => {
            registerForm.classList.remove('active');
            loginForm.classList.add('active');
        });
        showRegister1.addEventListener('click', () => {
            loginForm.classList.remove('active');
            registerForm.classList.add('active');
        });

        showLogin1.addEventListener('click', () => {
            registerForm.classList.remove('active');
            loginForm.classList.add('active');
        });
    </script>
</body>

</html>