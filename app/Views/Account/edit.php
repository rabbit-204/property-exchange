<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin tài khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .invalid-feedback {
            display: none;
            color: #dc3545;
        }
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
        .preview-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
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
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'] ?>
                                <?php unset($_SESSION['error']) ?>
                            </div>
                        <?php endif; ?>
                        
                        <form id="accountForm" action="index.php?controller=account&action=update" method="POST" enctype="multipart/form-data" novalidate>
                            <div class="mb-3 text-center">
                                <img id="avatarPreview" src="<?= !empty($account['img']) ? $account['img'] : 'https://via.placeholder.com/150' ?>" 
                                     alt="Avatar" class="preview-image mb-3">
                                
                                <div class="mb-3">
                                    <label for="img" class="form-label">Thay đổi ảnh đại diện</label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                    <div class="invalid-feedback" id="imgFeedback">Chỉ chấp nhận file ảnh (JPEG, PNG, GIF)</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fullname" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    value="<?= htmlspecialchars($account['fullname']) ?>" required
                                    minlength="2" maxlength="50">
                                <div class="invalid-feedback">Vui lòng nhập họ tên (từ 2-50 ký tự)</div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= htmlspecialchars($account['email']) ?>" required>
                                <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="<?= htmlspecialchars($account['phone'] ?? '') ?>"
                                    pattern="[0-9]{10,11}">
                                <div class="invalid-feedback">Số điện thoại phải có 10-11 chữ số</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php?controller=account&action=index" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xử lý hiển thị preview ảnh
        document.getElementById('img').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatarPreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Validation form
        document.getElementById('accountForm').addEventListener('submit', function(event) {
            const form = event.target;
            let isValid = true;

            // Validate ảnh đại diện
            const imgInput = document.getElementById('img');
            if (imgInput.files.length > 0) {
                const file = imgInput.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    imgInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    imgInput.classList.remove('is-invalid');
                }
            }

            // Validate họ tên
            const fullnameInput = document.getElementById('fullname');
            if (!fullnameInput.value.trim() || fullnameInput.value.length < 2 || fullnameInput.value.length > 50) {
                fullnameInput.classList.add('is-invalid');
                isValid = false;
            } else {
                fullnameInput.classList.remove('is-invalid');
            }

            // Validate email
            const emailInput = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                emailInput.classList.add('is-invalid');
                isValid = false;
            } else {
                emailInput.classList.remove('is-invalid');
            }

            // Validate số điện thoại (nếu có)
            const phoneInput = document.getElementById('phone');
            if (phoneInput.value && !/^[0-9]{10,11}$/.test(phoneInput.value)) {
                phoneInput.classList.add('is-invalid');
                isValid = false;
            } else {
                phoneInput.classList.remove('is-invalid');
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });

        // Real-time validation khi người dùng nhập liệu
        document.querySelectorAll('#accountForm input').forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                }
            });
        });
    </script>
</body>

</html>