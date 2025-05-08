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
    <link rel="stylesheet" href="/Views/teamplateadmin/style.css">
    <!-- CSS riêng -->
    <?php if (!empty($extraCSS)): ?>
        <link rel="stylesheet" href="<?= $extraCSS ?>">
    <?php endif; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 100px 20px 20px 20px;
        }
    </style>

</head>

<body>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <form id="searchForm" class="d-flex justify-content-between align-items-center mb-3 px-2">
        <input type="text" name="search" id="searchInput" class="form-control me-2" style="max-width: 600px;"
            placeholder="Tìm kiếm theo tên hoặc vị trí...">

        <select id="cityFilter" class="form-select me-2" style="max-width: 200px;">
            <option value="">Tất cả thành phố</option>
            <option value="TP HCM" <?= $city == 'TP HCM' ? 'selected' : ''; ?>>TP.HCM</option>
            <option value="Hà Nội" <?= $city == 'Hà Nội' ? 'selected' : ''; ?>>Hà Nội</option>
            <option value="Khác" <?= $city == 'Khác' ? 'selected' : ''; ?>>Khác</option>
        </select>

        <select id="propertyTypeFilter" class="form-select me-2" style="max-width: 200px;">
            <option value="">Tất cả loại BĐS</option>
            <option value="DetachedHouse" <?= $type == 'DetachedHouse' ? 'selected' : ''; ?>>Nhà Đất</option>
            <option value="Apartment" <?= $type == 'Apartment' ? 'selected' : ''; ?>>Căn hộ</option>
            <option value="Villa" <?= $type == 'Villa' ? 'selected' : ''; ?>>Biệt thự</option>
        </select>

        <button type="button" class="btn btn-primary" id="filterButton">Tìm kiếm</button>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">+ Thêm
            sản phẩm</button>
    </form>

    <div id="productList" style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc; border-radius: 5px;">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th data-sort="price" style="cursor: pointer;" onclick="sortProducts('price')">Giá <i
                            class="fa fa-sort"></i></th>
                    <th>Vị trí</th>
                    <th>Thành phố</th>
                    <th>Loại BĐS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr onclick="window.location.href='?controller=productdetail&action=admin&id=<?= $product['id'] ?>'">
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= number_format($product['price']) ?> VND</td>
                            <td><?= htmlspecialchars($product['location']) ?></td>
                            <td><?= htmlspecialchars($product['city']) ?></td>
                            <td>
                                <?php
                                $type = $product['type_of_real_estate'];

                                $typeLabels = [
                                    'Apartment' => 'Căn hộ',
                                    'DetachedHouse' => 'Nhà đất',
                                    'Villa' => 'Biệt thự',
                                ];

                                $color = match ($type) {
                                    'Apartment' => 'orange',
                                    'DetachedHouse' => 'green',
                                    'Villa' => 'dodgerblue',
                                    default => 'black'
                                };

                                $displayName = $typeLabels[$type] ?? $type;
                                ?>
                                <span style="color: <?= $color ?>; font-weight: bold;">
                                    <?= htmlspecialchars($displayName) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Không tìm thấy sản phẩm nào.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <style>
        .clickable-row:hover {
            background-color: #e9ecef !important;
            cursor: pointer;
        }

        form input[type="text"] {
            flex-grow: 1;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }
    </style>


<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="productForm" action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data" class="modal-content needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body row g-3">
                <!-- Tên sản phẩm -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Tên sản phẩm" required
                           minlength="5" maxlength="100">
                    <div class="invalid-feedback">Vui lòng nhập tên sản phẩm (5-100 ký tự)</div>
                </div>

                <!-- Giá -->
                <div class="col-md-6">
                    <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Giá" required
                           min="1000000" step="100000">
                    <div class="invalid-feedback">Giá tối thiểu 1,000,000 VNĐ</div>
                </div>

                <!-- Phòng ngủ -->
                <div class="col-md-4">
                    <label for="bedrooms" class="form-label">Phòng ngủ</label>
                    <input type="number" name="bedrooms" id="bedrooms" class="form-control" placeholder="Phòng ngủ" 
                           min="0" max="20">
                    <div class="invalid-feedback">Số phòng ngủ từ 0-20</div>
                </div>

                <!-- Nhà vệ sinh -->
                <div class="col-md-4">
                    <label for="toilets" class="form-label">Nhà vệ sinh</label>
                    <input type="number" name="toilets" id="toilets" class="form-control" placeholder="Nhà vệ sinh" 
                           min="0" max="20">
                    <div class="invalid-feedback">Số nhà vệ sinh từ 0-20</div>
                </div>

                <!-- Diện tích -->
                <div class="col-md-4">
                    <label for="area" class="form-label">Diện tích (m²) <span class="text-danger">*</span></label>
                    <input type="number" name="area" id="area" class="form-control" placeholder="Diện tích (m²)" 
                           step="0.1" min="5" required>
                    <div class="invalid-feedback">Diện tích tối thiểu 5m²</div>
                </div>

                <!-- Vị trí -->
                <div class="col-md-6">
                    <label for="location" class="form-label">Vị trí <span class="text-danger">*</span></label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Vị trí" required
                           minlength="5" maxlength="200">
                    <div class="invalid-feedback">Vui lòng nhập vị trí (5-200 ký tự)</div>
                </div>

                <!-- Loại giao dịch -->
                <div class="col-md-6">
                    <label for="sell_type" class="form-label">Loại giao dịch <span class="text-danger">*</span></label>
                    <select name="sell_type" id="sell_type" class="form-control" required>
                        <option value="">Loại giao dịch</option>
                        <option value="BÁN">BÁN</option>
                        <option value="THUÊ">THUÊ</option>
                        <option value="DỰ ÁN">DỰ ÁN</option>
                    </select>
                    <div class="invalid-feedback">Vui lòng chọn loại giao dịch</div>
                </div>

                <!-- Ảnh chính -->
                <div class="col-md-12">
                    <label for="mainImage" class="form-label">Ảnh chính <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="mainImage" class="form-control" accept="image/*" required>
                    <div class="invalid-feedback">Vui lòng chọn ảnh chính (JPEG, PNG, GIF)</div>
                    <div id="mainImagePreview" class="mt-2" style="max-width: 200px;"></div>
                </div>

                <!-- Loại đặc điểm -->
                <div class="col-md-6">
                    <label for="high_light" class="form-label">Loại đặc điểm</label>
                    <select name="high_light" id="high_light" class="form-control">
                        <option value="">Loại đặc điểm</option>
                        <option value="NỔI BẬT">NỔI BẬT</option>
                        <option value="XU HƯỚNG">XU HƯỚNG</option>
                    </select>
                </div>

                <!-- Thành phố -->
                <div class="col-md-6">
                    <label for="city" class="form-label">Thành phố <span class="text-danger">*</span></label>
                    <select name="city" id="city" class="form-control" required>
                        <option value="">-- Thành phố --</option>
                        <option value="TP HCM">TP HCM</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="Khác">Khác</option>
                    </select>
                    <div class="invalid-feedback">Vui lòng chọn thành phố</div>
                </div>

                <!-- Loại BĐS -->
                <div class="col-md-6">
                    <label for="type_of_real_estate" class="form-label">Loại BĐS <span class="text-danger">*</span></label>
                    <select name="type_of_real_estate" id="type_of_real_estate" class="form-control" required>
                        <option value="">-- Loại BĐS --</option>
                        <option value="DetachedHouse">Nhà đất</option>
                        <option value="Villa">Biệt thự</option>
                        <option value="Apartment">Chung cư</option>
                        <option value="Others">Khác</option>
                    </select>
                    <div class="invalid-feedback">Vui lòng chọn loại bất động sản</div>
                </div>

                <!-- Tên môi giới -->
                <div class="col-md-6">
                    <label for="agent_name" class="form-label">Tên môi giới</label>
                    <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Tên môi giới"
                           maxlength="50">
                    <div class="invalid-feedback">Tối đa 50 ký tự</div>
                </div>

                <!-- SĐT -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="SĐT"
                           pattern="[0-9]{10,11}">
                    <div class="invalid-feedback">Số điện thoại phải có 10-11 chữ số</div>
                </div>

                <!-- Số tầng -->
                <div class="col-md-6">
                    <label for="floors" class="form-label">Số tầng / tầng thứ</label>
                    <input type="number" name="floors" id="floors" class="form-control" placeholder="Số tầng / tầng thứ"
                           min="0" max="50">
                    <div class="invalid-feedback">Số tầng / tầng thứ từ 0-50</div>
                </div>

                <!-- Hướng nhà -->
                <div class="col-md-6">
                    <label for="direction" class="form-label">Hướng nhà</label>
                    <input type="text" name="direction" id="direction" class="form-control" placeholder="Hướng nhà"
                           maxlength="20">
                    <div class="invalid-feedback">Tối đa 20 ký tự</div>
                </div>

                <!-- Vĩ độ -->
                <div class="col-md-3">
                    <label for="latitude" class="form-label">Vĩ độ</label>
                    <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Vĩ độ"
                           pattern="-?\d{1,3}\.\d+">
                    <div class="invalid-feedback">Nhập đúng định dạng vĩ độ (ví dụ: 10.8231)</div>
                </div>

                <!-- Kinh độ -->
                <div class="col-md-3">
                    <label for="longitude" class="form-label">Kinh độ</label>
                    <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Kinh độ"
                           pattern="-?\d{1,3}\.\d+">
                    <div class="invalid-feedback">Nhập đúng định dạng kinh độ (ví dụ: 106.6297)</div>
                </div>

                <!-- Chiều dài -->
                <div class="col-md-3">
                    <label for="length" class="form-label">Chiều dài</label>
                    <input type="number" name="length" id="length" class="form-control" placeholder="Chiều dài"
                           min="0" step="0.1">
                    <div class="invalid-feedback">Chiều dài phải là số dương</div>
                </div>

                <!-- Chiều rộng -->
                <div class="col-md-3">
                    <label for="width" class="form-label">Chiều rộng</label>
                    <input type="number" name="width" id="width" class="form-control" placeholder="Chiều rộng"
                           min="0" step="0.1">
                    <div class="invalid-feedback">Chiều rộng phải là số dương</div>
                </div>

                <!-- Ảnh chi tiết -->
                <div class="col-md-12">
                    <label for="imageInput" class="form-label">Ảnh chi tiết <span class="text-danger">*</span></label>
                    <input type="file" name="pictures[]" id="imageInput" class="form-control" accept="image/*"
                           multiple required>
                    <div class="invalid-feedback">Vui lòng chọn ít nhất 1 ảnh chi tiết</div>
                    <small class="text-muted">Có thể chọn nhiều ảnh cùng lúc</small>
                    <div id="previewContainer" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </form>
    </div>
</div>
    <script>
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', () => {
                const id = row.getAttribute('data-id');
                window.location.href = `?action=productDetailAdmin&id=${id}`;
            });
        });

        document.getElementById('searchForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const keyword = document.getElementById('searchInput').value;

            fetch(`index.php?controller=product&action=admin&search=${encodeURIComponent(keyword)}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('productList');
                    if (newContent) {
                        document.getElementById('productList').innerHTML = newContent.innerHTML;
                    } else {
                        console.error('Không tìm thấy phần tử productList trong HTML phản hồi.');
                    }
                })
                .catch(error => console.error('Lỗi tìm kiếm:', error));
        });
        document.getElementById('filterButton').addEventListener('click', function () {
            const keyword = document.getElementById('searchInput').value;
            const city = document.getElementById('cityFilter').value;
            const propertyType = document.getElementById('propertyTypeFilter').value;

            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            if (keyword) {
                params.set('search', keyword);
            } else {
                params.delete('search');
            }

            if (city) {
                params.set('city', city);
            } else {
                params.delete('city');
            }

            if (propertyType) {
                params.set('type_of_real_estate', propertyType);
            } else {
                params.delete('type_of_real_estate');
            }

            // Gửi lại yêu cầu với các tham số filter
            window.location.href = `${url.pathname}?${params.toString()}`;
        });

        function previewImages(event) {
            const input = event.target;
            const previewContainer = document.getElementById('previewContainer');

            // Xóa ảnh cũ nếu có
            previewContainer.innerHTML = '';

            if (input.files) {
                Array.from(input.files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxHeight = '150px';
                            img.style.marginRight = '10px';
                            img.style.marginBottom = '10px';
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        }
        let allImages = [];

        document.getElementById('mainImage').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Kiểm tra loại file
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            this.classList.add('is-invalid');
            return;
        } else {
            this.classList.remove('is-invalid');
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = document.getElementById('mainImagePreview');
            preview.innerHTML = `<img src="${event.target.result}" class="img-thumbnail" style="max-height: 150px;">`;
        };
        reader.readAsDataURL(file);
    }
});

// Xử lý hiển thị preview nhiều ảnh
document.getElementById('imageInput').addEventListener('change', function(e) {
    const files = e.target.files;
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';
    
    if (files.length === 0) {
        this.classList.add('is-invalid');
        return;
    } else {
        this.classList.remove('is-invalid');
    }

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        
        // Kiểm tra loại file
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            this.classList.add('is-invalid');
            continue;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.className = 'img-thumbnail';
            img.style.maxHeight = '100px';
            img.style.marginRight = '5px';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});

// Validation form
document.getElementById('productForm').addEventListener('submit', function(event) {
    const form = event.target;
    
    // Kiểm tra tất cả các trường bắt buộc
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
document.querySelectorAll('#productForm input, #productForm select').forEach(input => {
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



        let currentSortOrder = 'ASC';

        function sortProducts(column) {
            currentSortOrder = (currentSortOrder === 'ASC') ? 'DESC' : 'ASC';

            const headers = document.querySelectorAll("th[data-sort]");
            headers.forEach(header => {
                if (header.getAttribute('data-sort') === column) {
                    header.classList.toggle("asc", currentSortOrder === 'ASC');
                    header.classList.toggle("desc", currentSortOrder === 'DESC');
                } else {
                    header.classList.remove("asc", "desc");
                }
            });

            const xhr = new XMLHttpRequest();
            xhr.open("GET", `?controller=product&action=getSortedProducts&column=${column}&order=${currentSortOrder}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const products = JSON.parse(xhr.responseText);
                    const tbody = document.querySelector("tbody");
                    tbody.innerHTML = '';

                    products.forEach(product => {
                        const row = document.createElement("tr");
                        row.setAttribute("onclick", `window.location.href='?action=productDetailAdmin&id=${product.id}'`);
                        row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${new Intl.NumberFormat().format(product.price)} VND</td>
                    <td>${product.location}</td>
                    <td>${product.city}</td>
                    <td>${product.type_of_real_estate}</td>
                `;
                        tbody.appendChild(row);
                    });
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>