<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .fixed-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    #newPicturesPreview img {
        height: 150px;
        width: auto;
        object-fit: cover;
    }
</style>
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><?= htmlspecialchars($product['name']) ?></h2>
        <div class="d-flex gap-4">
            <button type="button" class="btn btn-primary"
                onclick="window.location.href='index.php?controller=product&action=edit&id=<?= $product['id'] ?>'">Sửa</button>
            <a href="?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-danger"
                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">Xóa</a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <img src="<?= $product['image'] ?>" alt="Ảnh sản phẩm" class="img-fluid rounded border shadow"
                data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal(this)">
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item"><strong>Giá:</strong> <?= number_format($product['price']) ?> VND</li>
                <li class="list-group-item"><strong>Phòng ngủ:</strong> <?= $product['bedrooms'] ?></li>
                <li class="list-group-item"><strong>Nhà vệ sinh:</strong> <?= $product['toilets'] ?></li>
                <li class="list-group-item"><strong>Diện tích:</strong> <?= $product['area'] ?> m²</li>
                <li class="list-group-item"><strong>Vị trí:</strong> <?= $product['location'] ?></li>
                <li class="list-group-item"><strong>Loại giao dịch:</strong> <?= $product['sell_type'] ?></li>
                <li class="list-group-item"><strong>Đặc điểm:</strong> <?= $product['high_light'] ?></li>
                <li class="list-group-item"><strong>Thành phố:</strong> <?= $product['city'] ?></li>
                <li class="list-group-item">
                    <strong>Loại BĐS:</strong>
                    <?php
                        switch ($product['type_of_real_estate']) {
                            case 'DetachedHouse':
                                echo 'Nhà mặt đất';
                                break;
                            case 'Villa':
                                echo 'Biệt thự';
                                break;
                            case 'Apartment':
                                echo 'Chung cư';
                                break;
                            case 'Others':
                                echo 'Khác';
                                break;
                            default:
                                echo 'Không xác định';
                                break;
                        }
                    ?>
                    </li>
                <li class="list-group-item"><strong>Tên môi giới:</strong> <?= $product['agent_name'] ?></li>
                <li class="list-group-item"><strong>SĐT:</strong> <?= $product['phone'] ?></li>
                <li class="list-group-item"><strong>Số tầng:</strong> <?= $product['floors'] ?></li>
                <li class="list-group-item"><strong>Hướng nhà:</strong> <?= $product['direction'] ?></li>
                <li class="list-group-item"><strong>Tọa độ:</strong> <?= $product['latitude'] ?>,
                    <?= $product['longitude'] ?>
                </li>
                <li class="list-group-item"><strong>Kích thước:</strong> Dài <?= $product['length'] ?> m x Rộng
                    <?= $product['width'] ?> m
                </li>
            </ul>
        </div>
    </div>

    <?php if (!empty($product['pictures'])): ?>
        <h5>Hình ảnh chi tiết:</h5>
        <div class="row g-3">
            <div class=" d-flex flex-wrap gap-2 justify-content-start" id="newPicturesPreview">
                <?php foreach (json_decode($product['pictures'], true) as $pic): ?>
                    <div class=" d-flex flex-wrap gap-2 justify-content-center" id="newPicturesPreview">
                        <img src="<?= $pic ?>" class="fixed-image" alt="Ảnh chi tiết" data-bs-toggle="modal"
                            data-bs-target="#imageModal" onclick="showImageModal(this)">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center">
                    <img src="" id="modalImage" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>


    <script>
        function showImageModal(img) {
            const modalImg = document.getElementById("modalImage");
            modalImg.src = img.src;

            modalImg.style.width = 'auto';  // Đặt chiều rộng là tự động
            modalImg.style.height = 'auto';  // Đặt chiều cao là tự động
            modalImg.style.maxWidth = '100%'; // Đảm bảo ảnh không vượt quá kích thước của modal
            modalImg.style.maxHeight = '80vh'; // Giới hạn chiều cao của ảnh (để ảnh không bị lớn quá màn hình)

        }
    </script>