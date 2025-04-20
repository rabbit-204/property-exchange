<!-- filepath: e:\hk242\WEB\ASSIGNMENT\app\Views\Login\index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 900px;
            height: 500px;
            display: flex;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .form-container {
            width: 100%;
            height: 100%;
            display: none;
            /* Ẩn form mặc định */
            flex-direction: row;
            justify-content: center;
            align-items: center;
            transition: opacity 0.6s ease-in-out;
        }

        .form-container.active {
            display: flex;
            /* Hiển thị form khi có lớp active */
        }

        .form-section {
            width: 100%;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
        }

        .form-section h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-section button {
            background-color: #00bfa6;
            color: #fff;
        }

        .form-section button:hover {
            background-color: #009f8c;
        }

        .image-section {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .image-section h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .image-section p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .image-section button {
            padding: 10px 20px;
            font-size: 16px;
            color: #00bfa6;
            background-color: #fff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .image-section button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Login Form -->
        <div class="form-container active" id="loginForm">
            <div class="form-section">
                <h1>Login hire.</h1>
                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

            </div>
            <div class="image-section">
                <p>Don't have an account?</p>
                <button id="showRegister">Register</button>
            </div>
        </div>
        <!-- Register Form -->
        <div class="form-container" id="registerForm">
            <div class="image-section">
                <p>Already have an account?</p>
                <button id="showLogin">Login</button>
            </div>
            <div class="form-section">
                <h1>Register hire.</h1>
                <form action="register_process.php" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const showRegister = document.getElementById('showRegister');
        const showLogin = document.getElementById('showLogin');

        showRegister.addEventListener('click', () => {
            loginForm.classList.remove('active');
            registerForm.classList.add('active');
        });

        showLogin.addEventListener('click', () => {
            registerForm.classList.remove('active');
            loginForm.classList.add('active');
        });
    </script>
</body>

</html>