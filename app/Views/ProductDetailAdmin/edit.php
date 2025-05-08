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

    .invalid-feedback {
        display: none;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .is-invalid ~ .invalid-feedback {
        display: block;
    }

    .required-field::after {
        content: " *";
        color: #dc3545;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Chỉnh sửa sản phẩm: <?= htmlspecialchars($product['name']) ?></h2>
        <a href="?controller=productdetail&action=admin&id=<?= $product['id'] ?>" class="btn btn-secondary">Quay lại</a>
    </div>

    <form id="editProductForm" action="index.php?controller=product&action=update" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <!-- Tên sản phẩm -->
        <div class="col-md-6">
            <label for="name" class="form-label required-field">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control"
                value="<?= htmlspecialchars($product['name']) ?>" required minlength="5" maxlength="100">
            <div class="invalid-feedback">Vui lòng nhập tên sản phẩm (5-100 ký tự)</div>
        </div>

        <!-- Giá -->
        <div class="col-md-6">
            <label for="price" class="form-label required-field">Giá</label>
            <input type="number" name="price" id="price" class="form-control" 
                value="<?= $product['price'] ?>" required min="1000000">
            <div class="invalid-feedback">Giá tối thiểu 1,000,000 VNĐ</div>
        </div>

        <!-- Phòng ngủ -->
        <div class="col-md-4">
            <label for="bedrooms" class="form-label">Phòng ngủ</label>
            <input type="number" name="bedrooms" id="bedrooms" class="form-control" 
                value="<?= $product['bedrooms'] ?>" min="0" max="20">
            <div class="invalid-feedback">Số phòng ngủ từ 0-20</div>
        </div>

        <!-- Nhà vệ sinh -->
        <div class="col-md-4">
            <label for="toilets" class="form-label">Nhà vệ sinh</label>
            <input type="number" name="toilets" id="toilets" class="form-control" 
                value="<?= $product['toilets'] ?>" min="0" max="20">
            <div class="invalid-feedback">Số nhà vệ sinh từ 0-20</div>
        </div>

        <!-- Diện tích -->
        <div class="col-md-4">
            <label for="area" class="form-label required-field">Diện tích (m²)</label>
            <input type="number" name="area" id="area" class="form-control" 
                value="<?= $product['area'] ?>" step="0.1" min="5" required>
            <div class="invalid-feedback">Diện tích tối thiểu 5m²</div>
        </div>

        <!-- Vị trí -->
        <div class="col-md-6">
            <label for="location" class="form-label required-field">Vị trí</label>
            <input type="text" name="location" id="location" class="form-control"
                value="<?= htmlspecialchars($product['location']) ?>" required minlength="5" maxlength="200">
            <div class="invalid-feedback">Vui lòng nhập vị trí (5-200 ký tự)</div>
        </div>

        <!-- Loại giao dịch -->
        <div class="col-md-6">
            <label for="sell_type" class="form-label required-field">Loại giao dịch</label>
            <select name="sell_type" id="sell_type" class="form-control" required>
                <option value="">-- Chọn loại giao dịch --</option>
                <option value="BÁN" <?= $product['sell_type'] == 'BÁN' ? 'selected' : '' ?>>BÁN</option>
                <option value="THUÊ" <?= $product['sell_type'] == 'THUÊ' ? 'selected' : '' ?>>THUÊ</option>
                <option value="DỰ ÁN" <?= $product['sell_type'] == 'DỰ ÁN' ? 'selected' : '' ?>>DỰ ÁN</option>
            </select>
            <div class="invalid-feedback">Vui lòng chọn loại giao dịch</div>
        </div>

        <!-- Ảnh chính -->
        <div class="col-md-12">
            <label for="image" class="form-label">Ảnh chính</label>
            <div class="mb-2">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="Current image"
                    style="max-height: 150px; border: 1px solid #ddd; padding: 5px;">
            </div>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <div class="invalid-feedback">Chỉ chấp nhận file ảnh (JPEG, PNG, GIF)</div>
            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
        </div>

        <!-- Đặc điểm -->
        <div class="col-md-6">
            <label for="high_light" class="form-label">Đặc điểm</label>
            <select name="high_light" id="high_light" class="form-control">
                <option value="">-- Chọn đặc điểm --</option>
                <option value="NỔI BẬT" <?= $product['high_light'] == 'NỔI BẬT' ? 'selected' : '' ?>>NỔI BẬT</option>
                <option value="XU HƯỚNG" <?= $product['high_light'] == 'XU HƯỚNG' ? 'selected' : '' ?>>XU HƯỚNG</option>
            </select>
        </div>

        <!-- Thành phố -->
        <div class="col-md-6">
            <label for="city" class="form-label required-field">Thành phố</label>
            <select name="city" id="city" class="form-control" required>
                <option value="">-- Chọn thành phố --</option>
                <option value="TP HCM" <?= $product['city'] == 'TP HCM' ? 'selected' : '' ?>>TP HCM</option>
                <option value="Hà Nội" <?= $product['city'] == 'Hà Nội' ? 'selected' : '' ?>>Hà Nội</option>
                <option value="Khác" <?= $product['city'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
            </select>
            <div class="invalid-feedback">Vui lòng chọn thành phố</div>
        </div>

        <!-- Loại BĐS -->
        <div class="col-md-6">
            <label for="type_of_real_estate" class="form-label required-field">Loại BĐS</label>
            <select name="type_of_real_estate" id="type_of_real_estate" class="form-control" required>
                <option value="">-- Chọn loại BĐS --</option>
                <option value="DetachedHouse" <?= $product['type_of_real_estate'] == 'DetachedHouse' ? 'selected' : '' ?>>
                    Nhà đất</option>
                <option value="Villa" <?= $product['type_of_real_estate'] == 'Villa' ? 'selected' : '' ?>>Biệt thự</option>
                <option value="Apartment" <?= $product['type_of_real_estate'] == 'Apartment' ? 'selected' : '' ?>>Chung cư
                </option>
                <option value="Others" <?= $product['type_of_real_estate'] == 'Others' ? 'selected' : '' ?>>Khác</option>
            </select>
            <div class="invalid-feedback">Vui lòng chọn loại bất động sản</div>
        </div>

        <!-- Tên môi giới -->
        <div class="col-md-6">
            <label for="agent_name" class="form-label">Tên môi giới</label>
            <input type="text" name="agent_name" id="agent_name" class="form-control"
                value="<?= htmlspecialchars($product['agent_name'] ?? '') ?>" maxlength="50">
            <div class="invalid-feedback">Tối đa 50 ký tự</div>
        </div>

        <!-- SĐT -->
        <div class="col-md-6">
            <label for="phone" class="form-label">SĐT</label>
            <input type="text" name="phone" id="phone" class="form-control"
                value="<?= htmlspecialchars($product['phone'] ?? '') ?>" pattern="[0-9]{10,11}">
            <div class="invalid-feedback">Số điện thoại phải có 10-11 chữ số</div>
        </div>

        <!-- Số tầng -->
        <div class="col-md-6">
            <label for="floors" class="form-label">Số tầng</label>
            <input type="number" name="floors" id="floors" class="form-control" 
                value="<?= $product['floors'] ?? '' ?>" min="0" max="50">
            <div class="invalid-feedback">Số tầng từ 0-50</div>
        </div>

        <!-- Hướng nhà -->
        <div class="col-md-6">
            <label for="direction" class="form-label">Hướng nhà</label>
            <input type="text" name="direction" id="direction" class="form-control"
                value="<?= htmlspecialchars($product['direction'] ?? '') ?>" maxlength="20">
            <div class="invalid-feedback">Tối đa 20 ký tự</div>
        </div>

        <!-- Vĩ độ -->
        <div class="col-md-3">
            <label for="latitude" class="form-label">Vĩ độ</label>
            <input type="text" name="latitude" id="latitude" class="form-control"
                value="<?= htmlspecialchars($product['latitude'] ?? '') ?>" pattern="-?\d{1,3}\.\d+">
            <div class="invalid-feedback">Nhập đúng định dạng vĩ độ (ví dụ: 10.8231)</div>
        </div>

        <!-- Kinh độ -->
        <div class="col-md-3">
            <label for="longitude" class="form-label">Kinh độ</label>
            <input type="text" name="longitude" id="longitude" class="form-control"
                value="<?= htmlspecialchars($product['longitude'] ?? '') ?>" pattern="-?\d{1,3}\.\d+">
            <div class="invalid-feedback">Nhập đúng định dạng kinh độ (ví dụ: 106.6297)</div>
        </div>

        <!-- Chiều dài -->
        <div class="col-md-3">
            <label for="length" class="form-label">Chiều dài</label>
            <input type="number" name="length" id="length" class="form-control" 
                value="<?= $product['length'] ?? '' ?>" min="0" step="0.1">
            <div class="invalid-feedback">Chiều dài phải là số dương</div>
        </div>

        <!-- Chiều rộng -->
        <div class="col-md-3">
            <label for="width" class="form-label">Chiều rộng</label>
            <input type="number" name="width" id="width" class="form-control" 
                value="<?= $product['width'] ?? '' ?>" min="0" step="0.1">
            <div class="invalid-feedback">Chiều rộng phải là số dương</div>
        </div>

        <!-- Ảnh chi tiết -->
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
            <div class="invalid-feedback">Chỉ chấp nhận file ảnh (JPEG, PNG, GIF)</div>
            <div id="newPicturesPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            <a href="index.php?controller=productdetail&action=admin&id=<?php echo $product['id']; ?>" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<script>
    // Xử lý hiển thị preview ảnh mới
    function previewNewImages(event) {
        const input = event.target;
        const previewContainer = document.getElementById('newPicturesPreview');
        previewContainer.innerHTML = '';

        if (input.files && input.files.length > 0) {
            // Kiểm tra loại file
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            let hasInvalidFile = false;

            Array.from(input.files).forEach(file => {
                if (!validTypes.includes(file.type)) {
                    hasInvalidFile = true;
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
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
            });

            if (hasInvalidFile) {
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        }
    }

    // Xử lý xóa ảnh
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

    // Validation form
    document.getElementById('editProductForm').addEventListener('submit', function(event) {
        const form = event.target;
        
        // Kiểm tra ảnh chính nếu có thay đổi
        const imageInput = document.getElementById('image');
        if (imageInput.files.length > 0) {
            const file = imageInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                imageInput.classList.add('is-invalid');
                event.preventDefault();
                event.stopPropagation();
            }
        }

        // Kiểm tra ảnh chi tiết mới nếu có
        const newPicturesInput = document.getElementById('new_pictures');
        if (newPicturesInput.files.length > 0) {
            const files = newPicturesInput.files;
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            let hasInvalidFile = false;

            Array.from(files).forEach(file => {
                if (!validTypes.includes(file.type)) {
                    hasInvalidFile = true;
                }
            });

            if (hasInvalidFile) {
                newPicturesInput.classList.add('is-invalid');
                event.preventDefault();
                event.stopPropagation();
            }
        }

        // Kiểm tra các trường bắt buộc
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            
            // Hiển thị thông báo lỗi cho các trường không hợp lệ
            const invalidFields = form.querySelectorAll(':invalid');
            invalidFields.forEach(field => {
                field.classList.add('is-invalid');
            });
        }

        form.classList.add('was-validated');
    });

    // Real-time validation khi người dùng nhập liệu
    document.querySelectorAll('#editProductForm input, #editProductForm select').forEach(input => {
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
            }
        });
        
        input.addEventListener('change', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
            }
        });
    });
</script>