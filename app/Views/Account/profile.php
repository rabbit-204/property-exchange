<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/Views/teamplate/style.css">
    <style>
        .property-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .property-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
        }
        
        .remove-favorite {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255,255,255,0.8);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc3545;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .remove-favorite:hover {
            background-color: #dc3545;
            color: white;
        }
        
        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #1565C0;
            border-bottom: 3px solid #1565C0;
        }
    </style>
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
                        <a href="index.php?controller=account&action=changePassword" class="btn btn-outline-secondary">Đổi mật khẩu</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card mb-4">
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
                
                <!-- Tab navigation -->
                <ul class="nav nav-tabs" id="accountTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="favorites-tab" data-bs-toggle="tab" data-bs-target="#favorites" type="button" role="tab">
                            Bất động sản yêu thích <span class="badge bg-primary"><?= count($favoriteProducts) ?></span>
                        </button>
                    </li>
                    <?php if (!empty($products)): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">
                            Sản phẩm của tôi <span class="badge bg-primary"><?= count($products) ?></span>
                        </button>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <!-- Tab content -->
                <div class="tab-content" id="accountTabContent">
                    <!-- Favorites tab -->
                    <div class="tab-pane fade show active" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
                        <div class="mt-3">
                            <?php if (empty($favoriteProducts)): ?>
                                <div class="alert alert-info">
                                    Bạn chưa có bất động sản yêu thích nào. <a href="index.php?controller=home&action=index">Khám phá ngay</a>!
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ($favoriteProducts as $product): ?>
                                        <div class="col-md-6 mb-3">
                                            <div class="property-card" style="background-image: url('<?= htmlspecialchars(json_decode($product['pictures'], true)[0] ?? '') ?>');">
                                                <div class="remove-favorite" data-product-id="<?= htmlspecialchars($product['id']) ?>">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </div>
                                                <a href="index.php?controller=productdetail&action=index&id=<?= htmlspecialchars($product['id']) ?>" class="text-decoration-none">
                                                    <div class="property-overlay">
                                                        <h5 class="text-white mb-1"><?= htmlspecialchars($product['name']) ?></h5>
                                                        <div class="text-white mb-2" style="font-size: 14px;">
                                                            <i class="fa fa-location-dot"></i> <?= htmlspecialchars($product['location']) ?>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="text-white">
                                                                <i class="fa fa-bed"></i> <?= htmlspecialchars($product['bedrooms']) ?>
                                                                <i class="fa fa-bath ms-2"></i> <?= htmlspecialchars($product['toilets']) ?>
                                                                <i class="fa fa-maximize ms-2"></i> <?= htmlspecialchars($product['area']) ?>m²
                                                            </div>
                                                            <div class="fw-bold text-white"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-danger" id="btnLogout">Đăng xuất</button>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        // Handle removing favorite properties
        $('.remove-favorite').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const button = $(this);
            const productId = button.data('product-id');
            const productCard = button.closest('.col-md-6');
            
            // Confirm before removing
            if (confirm('Bạn có chắc muốn xóa bất động sản này khỏi danh sách yêu thích?')) {
                // Send AJAX request to toggle favorite status
                $.ajax({
                    url: 'index.php?controller=favorite&action=toggleFavorite',
                    type: 'POST',
                    data: { product_id: productId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Remove the card with animation
                            productCard.fadeOut(300, function() {
                                $(this).remove();
                                
                                // Update the count in the tab
                                const count = $('.property-card').length;
                                $('#favorites-tab .badge').text(count);
                                
                                // Show message if no favorites left
                                if (count === 0) {
                                    $('#favorites').html(
                                        '<div class="mt-3"><div class="alert alert-info">' +
                                        'Bạn chưa có bất động sản yêu thích nào. <a href="index.php?controller=home&action=index">Khám phá ngay</a>!' +
                                        '</div></div>'
                                    );
                                }
                            });
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra, vui lòng thử lại sau');
                    }
                });
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
    const btnLogout = document.getElementById("btnLogout");
    if (btnLogout) {
        btnLogout.addEventListener("click", function () {
            // console.log(document.cookie);
            // document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            // console.log(document.cookie);
            $.ajax({
                url: '/index.php?controller=login&action=logout', // Thay đổi URL phù hợp với controller của bạn
                method: 'POST',
                success: function (response) {
                    console.log(response);
                    // alert('Đăng xuất thành công!');
                    window.location.href = "/index.php?controller=login&action=index"; // Chuyển hướng về trang đăng nhập
                },
                error: function () {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
            // window.location.href = "/index.php?controller=login&action=index";
        });
    }


}
);
    </script>
</body>
</html>