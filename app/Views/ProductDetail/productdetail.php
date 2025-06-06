<?php
    $title=$title ?? "Trang chi tiết sản phẩm" ;
    $extraCSS=$extraCSS ?? "/Views/ProductDetail/style.css" ;
    $extraJS=$extraJS ?? "/Views/ProductDetail/script.js" ;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- CSS chính -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <link rel="stylesheet" href="/Views/teamplate/style.css"> -->
    <!-- Leaflet CSS (Corrected integrity) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin="" />

<!-- Leaflet JS (Corrected integrity) -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

    <!-- CSS riêng -->
    <?php if (!empty($extraCSS)): ?>
    <link rel="stylesheet" href="<?= $extraCSS ?>">
    <?php endif; ?>

    <style>
    .image-container {
        position: relative;
        width: 100%;
        height: 500px;
        background-color: #f5f5f5;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-item img {
        height: 500px;
        object-fit: cover;
    }

    .contact-card-container {
        position: relative;
    }

    .contact-card {
        background: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .contact-card .btn {
        width: 100%;
    }

    .contact-card .phone-number {
        display: none;
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }

    .property-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        height: 280px;
        background-size: cover;
        background-position: center;
        color: white;
        margin-bottom: 50px;
    }

    .zoom-on-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        border-radius: 10px;
    }

    .zoom-on-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        z-index: 2;
    }

    .property-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .property-tags span {
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 5px;
    }

    .tag-ban {
        background-color: #0B6E4F;
    }

    .tag-thue {
        background-color: #007B83;
    }

    .tag-hot {
        background-color: #E2C169;
        color: black;
    }

    .property-footer {
        font-size: 14px;
        color: #DDDDDD;
    }

    .btn-load-more {
        background-color: #E2C169;
        color: black;
        font-weight: bold;
        border-radius: 30px;
        padding: 8px 30px;
        margin-bottom: 50px;
    }

    h5 {
        margin: 0;
    }

    .property-footer {
        font-size: 14px;
        color: #DDDDDD;
    }

    .property-footer .fw-bold {
        color: white;
    }

    .property-overlay::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
        z-index: 0;
    }

    .property-overlay>* {
        position: relative;
        z-index: 1;
    }

    .product-info {
        display: flex;
        flex-direction: row;
        /* Sắp xếp các phần tử theo hàng ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        gap: 20px;
        /* Khoảng cách giữa các phần tử */
    }

    .product-info .price {
        order: 1;
        /* Giá nằm trước */
        font-size: 27px;
        font-weight: bold;
    }

    .product-info .details {
        order: 2;
        /* Chi tiết nằm sau */
        display: flex;
        gap: 15px;
        /* Khoảng cách giữa các chi tiết */
    }


    @media (max-width: 768px) {
        .product-info {
            display: flex;
            flex-direction: column;
            /* Chuyển các phần tử thành cột */
            align-items: flex-start;
            /* Căn trái nội dung */
            gap: 10px;
            /* Thêm khoảng cách giữa các phần tử */
        }

        .product-info .price {
            order: 1;
            /* Đặt phần giá lên trên */
            font-size: 30px;
            /* Điều chỉnh kích thước chữ */
            font-weight: bold;
        }

        .product-info .details {
            order: 2;
            /* Đặt phần diện tích, bedroom, toilet xuống dưới */
            font-size: 30px;
            display: flex;
            flex-wrap: wrap;
            /* Cho phép xuống dòng nếu không đủ không gian */
            gap: 10px;
            /* Thêm khoảng cách giữa các chi tiết */
        }

        .product-info .details span {
            display: flex;
            align-items: center;
            gap: 5px;
            /* Thêm khoảng cách giữa icon và text */
        }
    }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8">
                <?php $pictures = json_decode($product['pictures'], true); ?>
                <div class="image-container">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <?php foreach ($pictures as $index => $image): ?>
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="<?= $index ?>"
                                class="<?= $index === 0 ? 'active' : '' ?>"
                                aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                                aria-label="Slide <?= $index + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner">
                            <?php foreach ($pictures as $index => $image): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="<?= htmlspecialchars($image) ?>" class="d-block w-100"
                                    alt="Hình ảnh sản phẩm <?= $index + 1 ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card-container">
                    <div class="contact-card" id="contactCard">
                        <h5 style="margin-bottom:5px"><strong>Liên hệ tư vấn</strong></h5>
                        <p>Người môi giới: <strong><?= htmlspecialchars($product['agent_name']) ?></strong></p>
                        <?php if (isset($_SESSION['user'])): ?>
                        <!-- Hiển thị nếu đã đăng nhập -->
                        <button class="btn btn-primary" id="showPhoneBtn">Hiển thị số điện thoại</button>
                        <p class="phone-number" id="phoneNumber"><?= htmlspecialchars($product['phone']) ?></p>
                        <a href="https://zalo.me/<?= htmlspecialchars($product['phone']) ?>" target="_blank"
                            class="btn btn-outline-primary" style="margin-top: 10px">Nhắn tin qua Zalo</a>
                        <?php else: ?>
                        <!-- Hiển thị nếu chưa đăng nhập -->
                        <p class="text-danger">Vui lòng <a href="/index.php?controller=login&action=index">đăng nhập</a>
                            để xem thông tin.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <!-- Add this button right after the product name in your product detail page -->
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h3>
                <?php if (isset($_SESSION['user'])): ?>
                <?php 
        // Check if product is already in favorites
        require_once __DIR__ . '/../../Models/FavoriteModel.php'; // Updated path
        $favoriteModel = new FavoriteModel();
        $isFavorite = $favoriteModel->isFavorite($_SESSION['user']['id'], $product['id']);
        ?>
                <button id="favoriteBtn" class="btn <?= $isFavorite ? 'btn-danger' : 'btn-outline-danger' ?>"
                    data-product-id="<?= htmlspecialchars($product['id']) ?>">
                    <i class="fa fa-heart"></i>
                    <span><?= $isFavorite ? 'Đã yêu thích' : 'Yêu thích' ?></span>
                </button>
                <?php else: ?>
                <a href="/index.php?controller=login&action=index" class="btn btn-outline-danger">
                    <i class="fa fa-heart"></i> Yêu thích
                </a>
                <?php endif; ?>
            </div>
            <p class="text-muted" style="font-size: 22px;">
                Vị trí: <?= htmlspecialchars($product['location']) ?>
            </p>
            <h4 class="d-flex align-items-center">
                <div class="product-info">
                    <div class="price text-primary fw-bold">
                        Giá: <?= htmlspecialchars($product['formatted_price']) ?>
                        <span class="text-muted ms-2">(<?= htmlspecialchars($product['price_per_m2']) ?> /m²)</span>
                    </div>
                    <div class="details">
                        <span><i class="fa fa-maximize"></i> <?= htmlspecialchars($product['area']) ?> m²</span>
                        <span><i class="fa fa-bed"></i> <?= htmlspecialchars($product['bedrooms']) ?></span>
                        <span><i class="fa fa-bath"></i> <?= htmlspecialchars($product['toilets']) ?></span>
                    </div>
                </div>
            </h4>
        </div>
        <div class="mt-4">
            <h5 class="" style="color: #1565C0; font-weight: bold;">Tổng quan</h5>
            <p>Nhà đẹp, ngay Trung tâm kinh doanh sầm uất <?= htmlspecialchars($product['location']) ?></p>
            <p>Nhà vị trí đẹp, giá tốt. Phù hợp an cư lâu dài, làm văn phòng CTY, đầu tư giữ tiền, tăng giá trị tài sản.
            </p>
            <ul>
                <li><strong>Diện tích:</strong> (dài x rộng:
                    <?= htmlspecialchars($product['length'] . " x " . $product['width']) ?>)
                    <?= htmlspecialchars($product['area']) ?>m²</li>
                <li><strong>Kết cấu:</strong> <?= htmlspecialchars($product['floors']) ?> lầu,
                    <?= htmlspecialchars($product['bedrooms']) ?>PN, <?= htmlspecialchars($product['toilets']) ?>WC</li>
                <li><strong>Vị trí:</strong> thông thoáng, sạch sẽ, rất yên tĩnh, dân trí cao, an ninh.</li>
                <li><strong>Tiện ích:</strong> Bước ra đầu hẻm thứ gì cũng có.</li>
                <li><strong>Pháp lý:</strong> SHR, không bị quy hoạch, công chứng sang tên ngay</li>
            </ul>
            <p><strong>Giá bán:</strong> <?= htmlspecialchars($product['formatted_price']) ?> (thương lượng nhẹ)</p>
        </div>
        <div class="mt-5">
            <h5 class="" style="color: #1565C0; font-weight: bold">Chi tiết</h5>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Diện tích</td>
                                <td><?= htmlspecialchars($product['area']) ?> m²</td>
                            </tr>
                            <tr>
                                <td>Pháp lý</td>
                                <td>
                                    <?= $product['type_of_real_estate'] === 'Apartment' ? 'Sổ hồng' : 'Sổ đỏ' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số phòng ngủ</td>
                                <td><?= htmlspecialchars($product['bedrooms']) ?> phòng</td>
                            </tr>
                            <tr>
                                <td>Hướng</td>
                                <td><?= htmlspecialchars($product['direction'] ?? '-') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Rộng x Dài</td>
                                <td><?= htmlspecialchars($product['length'] . " x " . $product['width'] ) ?></td>
                            </tr>
                            <tr>
                                <td>Số tầng</td>
                                <td>
                                    <?php if ($product['type_of_real_estate'] === 'Apartment'): ?>
                                        Tầng thứ <?= htmlspecialchars($product['floors']) ?>
                                    <?php else: ?>
                                        <?= htmlspecialchars($product['floors']) ?> tầng
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số toilet</td>
                                <td><?= htmlspecialchars($product['toilets']) ?> phòng</td>
                            </tr>
                            <tr>
                                <td>Mức giá</td>
                                <td><?= htmlspecialchars($product['formatted_price']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-left: 50px; margin-right: 50px;">
        <h5 style="margin-bottom: 10px; color: #1565C0; font-weight: bold;">Vị trí trên bản đồ</h5>
        <div id="map" style="width: 100%; height: 400px; border: 1px solid #ddd;"></div>
    </div>

    <div class="mt-5" style="margin-left: 20px; margin-right: 20px;">
        <h5 class="" style="margin-bottom: 10px; color: #1565C0; font-weight: bold;">Bất động sản dành cho bạn</h5>
        <div class="row">
            <?php foreach (array_slice($suggestedProducts, 0, 3) as $suggestedProduct): ?>
            <div class="col-md-4">
                <a href="index.php?controller=productdetail&action=index&id=<?= htmlspecialchars($suggestedProduct['id']) ?>"
                    class="text-decoration-none">
                    <div class="property-card zoom-on-hover"
                        style="background-image: url('<?= htmlspecialchars($suggestedProduct['image']) ?>');">
                        <div class="property-overlay">
                            <div class="property-tags mb-2">
                                <span class="tag-ban"><?= htmlspecialchars($suggestedProduct['sell_type']) ?></span>
                                <span class="tag-hot"><?= htmlspecialchars($suggestedProduct['high_light']) ?></span>
                            </div>

                            <div>
                                <h5 class="text-white mb-1" style="margin-bottom: 2px;">
                                    <?= htmlspecialchars($suggestedProduct['name']) ?></h5>
                                <div class="text-white" style="font-size: 14px; margin-bottom: 4px;">
                                    <i class="fa fa-location-dot"></i>
                                    <?= htmlspecialchars($suggestedProduct['location']) ?>
                                </div>

                                <div class="property-footer d-flex justify-content-between align-items-center">
                                    <div class="text-white">
                                        <i class="fa fa-bed" style="padding-left: 5px;"></i>
                                        <?= htmlspecialchars($suggestedProduct['bedrooms']) ?>
                                        <i class="fa fa-bath ms-2"></i>
                                        <?= htmlspecialchars($suggestedProduct['toilets']) ?>
                                        <i class="fa fa-maximize ms-2"></i>
                                        <?= htmlspecialchars($suggestedProduct['area']) ?>m²
                                    </div>
                                    <div class="fw-bold text-white" style="padding-right: 20px;">Giá:
                                        <?= number_format($suggestedProduct['price'], 0, ',', '.') ?> VNĐ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    document.getElementById('showPhoneBtn').addEventListener('click', function() {
        const phoneNumber = document.getElementById('phoneNumber');
        phoneNumber.style.display = 'block';
        this.style.display = 'none';
    });
    </script>

    <script>
    const map = L.map('map').setView([<?= htmlspecialchars($product['latitude']) ?>,
        <?= htmlspecialchars($product['longitude']) ?>
    ], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([<?= htmlspecialchars($product['latitude']) ?>, <?= htmlspecialchars($product['longitude']) ?>])
        .addTo(map)
        .bindPopup("<b><?= htmlspecialchars($product['name']) ?></b><br><?= htmlspecialchars($product['location']) ?>")
        .openPopup();
    </script>

    <script>
    $(document).ready(function() {
        // Handle favorite button click
        $('#favoriteBtn').on('click', function() {
            const button = $(this);
            const productId = button.data('product-id');

            // Send AJAX request to toggle favorite status
            $.ajax({
                url: 'index.php?controller=favorite&action=toggleFavorite',
                type: 'POST',
                data: {
                    product_id: productId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update button appearance based on new favorite status
                        if (response.isFavorite) {
                            button.removeClass('btn-outline-danger').addClass('btn-danger');
                            button.find('span').text('Đã yêu thích');
                        } else {
                            button.removeClass('btn-danger').addClass('btn-outline-danger');
                            button.find('span').text('Yêu thích');
                        }

                        // Show a toast or notification (optional)
                        showToast(response.message);
                    } else {
                        // Show error message
                        showToast(response.message, 'error');
                    }
                },
                error: function() {
                    showToast('Có lỗi xảy ra, vui lòng thử lại sau', 'error');
                }
            });
        });

        // Simple toast function (you can replace with your preferred notification system)
        function showToast(message, type = 'success') {
            const toastClass = type === 'success' ? 'bg-success' : 'bg-danger';

            const toast = `
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
                <div class="toast ${toastClass} text-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            </div>
        `;

            $('body').append(toast);
            $('.toast').toast({
                delay: 3000
            }).toast('show');

            // Remove toast after it's hidden
            $('.toast').on('hidden.bs.toast', function() {
                $(this).parent().remove();
            });
        }
    });
    </script>


    <!-- Leaflet JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>