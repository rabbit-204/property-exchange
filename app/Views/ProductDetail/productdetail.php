<?php
    $title=$title ?? "Trang chi tiết sản phẩm" ;
    $extraCSS=$extraCSS ?? "/Views/ProductDetail/style.css" ;
    $extraJS=$extraJS ?? "" ;
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($title) ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <!-- CSS chính -->
        <!-- <link rel="stylesheet" href="style.css"> -->
        <link rel="stylesheet" href="/Views/teamplate/style.css">

        <!-- CSS riêng -->
        <?php if (!empty($extraCSS)): ?>
            <link rel="stylesheet" href="<?= $extraCSS ?>">
        <?php endif; ?>
    </head>

    <body>
    <div class="container my-5">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="property-image" style="background-image: url('image-url.jpg');"></div>
        </div>

        <div class="col-md-8">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><i class="fa fa-location-dot"></i> <?= htmlspecialchars($product['location']) ?></p>

            <div class="row mb-3">
                <div class="col-4">
                    <p class="detail-label"><i class="fa fa-bed"></i> Phòng ngủ:</p>
                    <p><?= htmlspecialchars($product['bedrooms']) ?></p>
                </div>
                <div class="col-4">
                    <p class="detail-label"><i class="fa fa-bath"></i> Phòng tắm:</p>
                    <p><?= htmlspecialchars($product['bathrooms']) ?></p>
                </div>
                <div class="col-4">
                    <p class="detail-label"><i class="fa fa-maximize"></i> Diện tích:</p>
                    <p><?= htmlspecialchars($product['area']) ?></p>
                </div>
            </div>

            <div class="info-box mb-4">
                <h5 class="mb-3">Mô tả chi tiết</h5>
                <p><?= htmlspecialchars($product['description']) ?></p>
            </div>

            <div class="info-box">
                <h5 class="mb-3">Thông tin liên hệ</h5>
                <p><strong>Người bán:</strong> <?= htmlspecialchars($product['contact']) ?></p>
                <p><strong>Điện thoại:</strong> <?= htmlspecialchars($product['phone']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($product['email']) ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <h4 class="text-danger">Giá: <?= htmlspecialchars($product['price']) ?></h4>
                <button class="btn btn-primary w-100 mt-3">Liên hệ ngay</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.js"></script>
    
    </body>
</html>