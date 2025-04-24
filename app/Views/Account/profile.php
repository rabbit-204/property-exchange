<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Views/teamplate/style.css">
</head>
<body>
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if (!empty($account['img'])): ?>
                            <img src="<?= $account['img'] ?>" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/150" alt="Avatar" class="img-fluid rounded-circle mb-3">
                        <?php endif; ?>
                        
                        <h4><?= htmlspecialchars($account['fullname']) ?></h4>
                        <p class="text-muted">Vai trò: <?= htmlspecialchars($account['role']) ?></p>
                        
                        <a href="index.php?controller=account&action=update" class="btn btn-primary">Chỉnh sửa thông tin</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thông tin chi tiết</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-success">
                                <?= $_SESSION['message'] ?>
                                <?php unset($_SESSION['message']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'] ?>
                                <?php unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-bold">Họ và tên:</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext"><?= htmlspecialchars($account['fullname']) ?></p>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-bold">Email:</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext"><?= htmlspecialchars($account['email']) ?></p>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label fw-bold">Số điện thoại:</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext"><?= htmlspecialchars($account['phone'] ?? 'Chưa cập nhật') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if (!empty($products)): ?>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['id'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($product['name'] ?? '') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>