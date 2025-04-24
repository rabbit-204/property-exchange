<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin tài khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Chỉnh sửa thông tin tài khoản</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-success">
                                <?= $_SESSION['message'] ?>
                                <?php unset($_SESSION['message']) ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'] ?>
                                <?php unset($_SESSION['error']) ?>
                            </div>
                        <?php endif; ?>
                        <form action="index.php?controller=account&action=update" method="POST"
                            enctype="multipart/form-data">
                            <div class="mb-3 text-center">
                                <?php if (!empty($account['img'])): ?>
                                    <img src="<?= $account['img'] ?>" alt="Avatar" class="img-fluid rounded-circle mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/150" alt="Avatar"
                                        class="img-fluid rounded-circle mb-3">
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="img" class="form-label">Thay đổi ảnh đại diện</label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fullname" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    value="<?= htmlspecialchars($account['fullname']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= htmlspecialchars($account['email']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="<?= htmlspecialchars($account['phone'] ?? '') ?>">
                            </div>

                            <div class="mb-4">
                                <a href="index.php?controller=account&action=changePassword" class="btn btn-outline-primary">Đổi mật khẩu</a>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php?controller=account&action=profile" class="btn btn-secondary">Quay
                                    lại</a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>