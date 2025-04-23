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


    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data"
                class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm" required>
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="price" class="form-control" placeholder="Giá" required>
                    </div>

                    <div class="col-md-4">
                        <input type="number" name="bedrooms" class="form-control" placeholder="Phòng ngủ" min="0">
                    </div>

                    <div class="col-md-4">
                        <input type="number" name="toilets" class="form-control" placeholder="Nhà vệ sinh" min="0">
                    </div>

                    <div class="col-md-4">
                        <input type="number" name="area" class="form-control" placeholder="Diện tích (m²)" step="0.1">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="location" class="form-control" placeholder="Vị trí" required>
                    </div>

                    <div class="col-md-6">
                        <select name="sell_type" class="form-control" required>
                            <option value="">Loại giao dịch</option>
                            <option value="BÁN">BÁN</option>
                            <option value="THUÊ">THUÊ</option>
                            <option value="DỰ ÁN">DỰ ÁN</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <select name="high_light" class="form-control">
                            <option value="">Loại đặc điểm</option>
                            <option value="NỔI BẬT">NỔI BẬT</option>
                            <option value="XU HƯỚNG">XU HƯỚNG</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <select name="city" class="form-control" required>
                            <option value="">-- Thành phố --</option>
                            <option value="TP HCM">TP HCM</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <select name="type_of_real_estate" class="form-control" required>
                            <option value="">-- Loại BĐS --</option>
                            <option value="DetachedHouse">Nhà đất</option>
                            <option value="Villa">Biệt thự</option>
                            <option value="Apartment">Chung cư</option>
                            <option value="Others">Khác</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="agent_name" class="form-control" placeholder="Tên môi giới">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" placeholder="SĐT">
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="floors" class="form-control" placeholder="Số tầng">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="direction" class="form-control" placeholder="Hướng nhà">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="latitude" class="form-control" placeholder="Vĩ độ">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="longitude" class="form-control" placeholder="Kinh độ">
                    </div>

                    <div class="col-md-3">
                        <input type="number" name="length" class="form-control" placeholder="Chiều dài">
                    </div>

                    <div class="col-md-3">
                        <input type="number" name="width" class="form-control" placeholder="Chiều rộng">
                    </div>

                    <div class="col-md-12">
                        <label for="imageInput" class="form-label">Ảnh chi tiết:</label>
                        <input type="file" name="pictures[]" id="imageInput" class="form-control" accept="image/*"
                            multiple required>
                        <div id="previewContainer" style="margin-top: 10px; display: flex; flex-wrap: wrap;"></div>
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

        document.getElementById('imageInput').addEventListener('change', function (event) {
            const files = event.target.files;
            allImages = [];

            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = '';

            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    allImages.push(file);
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