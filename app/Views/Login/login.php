<div class="login-container">
    <!-- Form Section -->
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
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="social-login d-flex justify-content-center gap-2 mt-3">
            <a href="#" class="btn btn-outline-secondary">F</a>
            <a href="#" class="btn btn-outline-secondary">G</a>
            <a href="#" class="btn btn-outline-secondary">in</a>
        </div>
    </div>
    <!-- Image Section -->
    <div class="image-section">
        <h2>Start your journey now</h2>
        <p>If you don’t have an account yet, join us and start your journey.</p>
        <a href="register.php" class="btn btn-light">Register</a>
    </div>
</div>