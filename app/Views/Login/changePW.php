<!-- filepath: e:\hk242\WEB\ASSIGNMENT\app\Views\Login\index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Views/Login/style.css">
</head>

<!-- filepath: e:\hk242\WEB\ASSIGNMENT\app\Views\Login\index.php -->
<body>
    <div class="container">
        <div class="form-container active" id="changepwForm">
            <div class="image-section">
                <p>Hmmm... Đổi mật khẩu bây giờ hay để hôm khác nhỉ? </p>
                <button id="returnHP">Thôi, để sau</button>
            </div>
            <div class="form-section">
                <h1>Thay đổi mật khẩu</h1>
                <?php if (isset($error) ) : ?>
                    <p style="color: red;"><?= $error ?></p>
                <?php endif; ?>
                <form action="/index.php?controller=login&action=changePW" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="pwcurrent" placeholder="Mật khẩu hiện tại" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="newpw" placeholder="Mật khẩu mới" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="confirmpw" placeholder="Nhập lại mật khẩu mới" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
                </form>
                <!-- <div style="align-self:flex-start; margin-top: 20px; cursor: pointer;" id="returnHP1">Thôi, để sau</div> -->
                <a href="index.php?controller=homepage&action=index" style="align-self:flex-end;  color: black; font-size: 16px; text-decoration: none; margin-top: 10px;" id="returnHP1">Thôi, để sau</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    </script>
</body>

</html>