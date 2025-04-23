<style>
    body {
        background-color: #f8f9fa;
    }

    h2 {
        font-weight: 600;
        color: #343a40;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
    }

    .form-control {
        border-radius: 0.5rem;
        box-shadow: none;
        transition: box-shadow 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        padding: 10px 20px;
        border-radius: 0.5rem;
        font-weight: 500;
        background-color: #0d6efd;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .btn-secondary {
        padding: 10px 20px;
        border-radius: 0.5rem;
        font-weight: 500;
        background-color: #6c757d;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
    }

    .img-thumbnail {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 5px;
        background-color: #fff;
    }

    #currentPicturesContainer img,
    #newPicturesPreview img {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    #currentPicturesContainer .position-relative,
    #newPicturesPreview .position-relative {
        border: 1px dashed #dee2e6;
        padding: 4px;
        border-radius: 0.5rem;
        background-color: #fff;
    }

    .form-check-label {
        font-weight: 400;
        color: #6c757d;
    }

    .container {
        background: #fff;
        border-radius: 1rem;
        padding: 30px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Chỉnh sửa sản phẩm: <?= htmlspecialchars($product['name']) ?></h2>
        <a href="index.php?controller=product&action=admin" class="btn btn-secondary">Quay lại</a>
    </div>

    <form action="index.php?controller=product&action=update" method="POST" enctype="multipart/form-data"
        class="row g-3">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="col-md-6">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control"
                value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="col-md-4">
            <label for="bedrooms" class="form-label">Phòng ngủ</label>
            <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="<?= $product['bedrooms'] ?>"
                min="0">
        </div>

        <div class="col-md-4">
            <label for="toilets" class="form-label">Nhà vệ sinh</label>
            <input type="number" name="toilets" id="toilets" class="form-control" value="<?= $product['toilets'] ?>"
                min="0">
        </div>

        <div class="col-md-4">
            <label for="area" class="form-label">Diện tích (m²)</label>
            <input type="number" name="area" id="area" class="form-control" value="<?= $product['area'] ?>" step="0.1">
        </div>

        <div class="col-md-6">
            <label for="location" class="form-label">Vị trí</label>
            <input type="text" name="location" id="location" class="form-control"
                value="<?= htmlspecialchars($product['location']) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="sell_type" class="form-label">Loại giao dịch</label>
            <select name="sell_type" id="sell_type" class="form-control" required>
                <option value="">-- Chọn loại giao dịch --</option>
                <option value="BÁN" <?= $product['sell_type'] == 'BÁN' ? 'selected' : '' ?>>BÁN</option>
                <option value="THUÊ" <?= $product['sell_type'] == 'THUÊ' ? 'selected' : '' ?>>THUÊ</option>
                <option value="DỰ ÁN" <?= $product['sell_type'] == 'DỰ ÁN' ? 'selected' : '' ?>>DỰ ÁN</option>
            </select>
        </div>

        <div class="col-md-12">
            <label for="image" class="form-label">Ảnh chính</label>
            <div class="mb-2">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="Current image"
                    style="max-height: 150px; border: 1px solid #ddd; padding: 5px;">
            </div>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
        </div>

        <div class="col-md-6">
            <label for="high_light" class="form-label">Đặc điểm</label>
            <select name="high_light" id="high_light" class="form-control">
                <option value="">-- Chọn đặc điểm --</option>
                <option value="NỔI BẬT" <?= $product['high_light'] == 'NỔI BẬT' ? 'selected' : '' ?>>NỔI BẬT</option>
                <option value="XU HƯỚNG" <?= $product['high_light'] == 'XU HƯỚNG' ? 'selected' : '' ?>>XU HƯỚNG</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="city" class="form-label">Thành phố</label>
            <select name="city" id="city" class="form-control" required>
                <option value="">-- Chọn thành phố --</option>
                <option value="TP HCM" <?= $product['city'] == 'TP HCM' ? 'selected' : '' ?>>TP HCM</option>
                <option value="Hà Nội" <?= $product['city'] == 'Hà Nội' ? 'selected' : '' ?>>Hà Nội</option>
                <option value="Khác" <?= $product['city'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="type_of_real_estate" class="form-label">Loại BĐS</label>
            <select name="type_of_real_estate" id="type_of_real_estate" class="form-control" required>
                <option value="">-- Chọn loại BĐS --</option>
                <option value="DetachedHouse" <?= $product['type_of_real_estate'] == 'DetachedHouse' ? 'selected' : '' ?>>
                    Nhà đất</option>
                <option value="Villa" <?= $product['type_of_real_estate'] == 'Villa' ? 'selected' : '' ?>>Biệt thự</option>
                <option value="Apartment" <?= $product['type_of_real_estate'] == 'Apartment' ? 'selected' : '' ?>>Chung cư
                </option>
                <option value="Others" <?= $product['type_of_real_estate'] == 'Others' ? 'selected' : '' ?>>Khác</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="agent_name" class="form-label">Tên môi giới</label>
            <input type="text" name="agent_name" id="agent_name" class="form-control"
                value="<?= htmlspecialchars($product['agent_name'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">SĐT</label>
            <input type="text" name="phone" id="phone" class="form-control"
                value="<?= htmlspecialchars($product['phone'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label for="floors" class="form-label">Số tầng</label>
            <input type="number" name="floors" id="floors" class="form-control" value="<?= $product['floors'] ?? '' ?>">
        </div>

        <div class="col-md-6">
            <label for="direction" class="form-label">Hướng nhà</label>
            <input type="text" name="direction" id="direction" class="form-control"
                value="<?= htmlspecialchars($product['direction'] ?? '') ?>">
        </div>

        <div class="col-md-3">
            <label for="latitude" class="form-label">Vĩ độ</label>
            <input type="text" name="latitude" id="latitude" class="form-control"
                value="<?= htmlspecialchars($product['latitude'] ?? '') ?>">
        </div>

        <div class="col-md-3">
            <label for="longitude" class="form-label">Kinh độ</label>
            <input type="text" name="longitude" id="longitude" class="form-control"
                value="<?= htmlspecialchars($product['longitude'] ?? '') ?>">
        </div>

        <div class="col-md-3">
            <label for="length" class="form-label">Chiều dài</label>
            <input type="number" name="length" id="length" class="form-control" value="<?= $product['length'] ?? '' ?>">
        </div>

        <div class="col-md-3">
            <label for="width" class="form-label">Chiều rộng</label>
            <input type="number" name="width" id="width" class="form-control" value="<?= $product['width'] ?? '' ?>">
        </div>

        <div class="col-md-12">
            <label class="form-label">Ảnh chi tiết hiện tại:</label>
            <div class="d-flex flex-wrap mb-3 gap-2" id="currentPicturesContainer">
                <?php if (!empty($product['pictures'])): ?>
                    <?php foreach (json_decode($product['pictures'], true) as $key => $pic): ?>
                        <div class="position-relative" id="image-container-<?= $key ?>">
                            <img src="<?= htmlspecialchars($pic) ?>" class="img-thumbnail" style="height: 150px;">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                onclick="deleteImage('<?= $product['id'] ?>', '<?= htmlspecialchars($pic) ?>', <?= $key ?>)">
                                <i class="fas fa-times"></i> X
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Không có ảnh chi tiết</p>
                <?php endif; ?>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="keep_existing_pictures"
                    id="keep_existing_pictures" value="1" checked>
                <label class="form-check-label" for="keep_existing_pictures">
                    Giữ lại ảnh chi tiết hiện tại
                </label>
            </div>

            <label for="new_pictures" class="form-label">Thêm ảnh chi tiết mới:</label>
            <input type="file" name="pictures[]" id="new_pictures" class="form-control" accept="image/*" multiple
                onchange="previewNewImages(event)">
            <div id="newPicturesPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            <a href="index.php?controller=productdetail&action=admin&id=<?php echo $product['id']; ?>" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<script>
    function deleteImage(productId, imagePath, imageIndex) {
        if (!confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
            return;
        }

        const formData = new FormData();
        formData.append('id', productId);
        formData.append('image_path', imagePath);

        fetch('index.php?controller=product&action=deleteImage', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('image-container-' + imageIndex).remove();
                    alert(data.message);
                } else {
                    alert('Lỗi: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi xóa ảnh');
            });
    }
    function previewNewImages(event) {
        const input = event.target;
        const previewContainer = document.getElementById('newPicturesPreview');

        previewContainer.innerHTML = '';

        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'position-relative';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail';
                        img.style.height = '150px';

                        imgContainer.appendChild(img);
                        previewContainer.appendChild(imgContainer);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }
</script>