<?php
    $title=$title ?? "Trang sản phẩm" ;
    $extraCSS=$extraCSS ?? "/Views/Product/style.css" ;
    $extraJS=$extraJS ?? "/Views/Product/script.js" ;
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
        <style>
            @media (max-width: 1100px) {
            .search-container .row {
                justify-content: center;
                text-align: center; 
            }

            .filter-col {
                flex: 0 0 100%; 
                max-width: 100%;
                margin-bottom: 15px; 
            }

            .btn-filter, .btn-search {
                width: 100%; 
                margin-bottom: 10px;
            }
        }

            @media (max-width: 363px) {
            .nav-tabs {
                display: flex;
                flex-wrap: wrap; 
                justify-content: center; 
                gap: 5px; 
            }

            .nav-tabs .nav-item {
                flex: 1 1 calc(50% - 10px); 
                text-align: center; 
            }

            .nav-tabs .nav-link {
                white-space: nowrap; 
                padding: 10px; 
                font-size: 14px; 
            }
        }
            @media (max-width: 500px) {
            .pagination {
                display: flex
                justify-content: center; 
            }

            .pagination .page-item:first-child .page-link, 
            .pagination .page-item:last-child .page-link { 
                padding-right: 15px !important; 
                padding-left: 15px  !important; 
            }

            .pagination .page-item:first-child,
            .pagination .page-item:last-child{
                display: hidden;
            }

            .pagination .page-link {
                padding: 8px 12px; 
                font-size: 14px; 
            }
        }

            @media (max-width: 449px) {
            .pagination .page-item:first-child, 
            .pagination .page-item:last-child { 
                display: none !important; 
            }
        }
               
        </style>
    </head>

    <body>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link <?= !isset($_GET['sell_type']) || $_GET['sell_type'] === 'All' ? 'active' : '' ?>" 
            href="?<?= http_build_query(array_merge($_GET, ['sell_type' => 'All', 'page' => 1])) ?>">Tất cả</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?= isset($_GET['sell_type']) && $_GET['sell_type'] === 'BÁN' ? 'active' : '' ?>" 
            href="?<?= http_build_query(array_merge($_GET, ['sell_type' => 'BÁN', 'page' => 1])) ?>">Nhà bán</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?= isset($_GET['sell_type']) && $_GET['sell_type'] === 'THUÊ' ? 'active' : '' ?>" 
            href="?<?= http_build_query(array_merge($_GET, ['sell_type' => 'THUÊ', 'page' => 1])) ?>">Nhà thuê</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?= isset($_GET['sell_type']) && $_GET['sell_type'] === 'DỰ ÁN' ? 'active' : '' ?>" 
            href="?<?= http_build_query(array_merge($_GET, ['sell_type' => 'DỰ ÁN', 'page' => 1])) ?>">Dự án</a>
        </li>
    </ul>

  <!-- Filter Form -->
    <div class="search-container">
    <div class="row g-3 align-items-end">
            <!-- Filter Thành phố -->
            <div class="col-md-3 filter-col position-relative">
                <label class="form-label">Thành phố</label>
                <select class="form-select" id="cityFilter">
                    <option value="All" <?= isset($_GET['city']) && $_GET['city'] === 'All' ? 'selected' : '' ?>>Tất cả</option>
                    <option value="Hà Nội" <?= isset($_GET['city']) && $_GET['city'] === 'Hà Nội' ? 'selected' : '' ?>>Hà Nội</option>
                    <option value="TP HCM" <?= isset($_GET['city']) && $_GET['city'] === 'TP HCM' ? 'selected' : '' ?>>TP HCM</option>
                    <option value="Khác" <?= isset($_GET['city']) && $_GET['city'] === 'Khác' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>

            <!-- Filter Loại nhà đất -->
            <div class="col-md-3 filter-col">
                <label class="form-label">Loại nhà đất</label>
                <select class="form-select" id="typeFilter">
                    <option value="All" <?= isset($_GET['type_of_real_estate']) && $_GET['type_of_real_estate'] === 'All' ? 'selected' : '' ?>>Tất cả</option>
                    <option value="Villa" <?= isset($_GET['type_of_real_estate']) && $_GET['type_of_real_estate'] === 'Villa' ? 'selected' : '' ?>>Villa</option>
                    <option value="DetachedHouse" <?= isset($_GET['type_of_real_estate']) && $_GET['type_of_real_estate'] === 'DetachedHouse' ? 'selected' : '' ?>>Nhà đất</option>
                    <option value="Apartment" <?= isset($_GET['type_of_real_estate']) && $_GET['type_of_real_estate'] === 'Apartment' ? 'selected' : '' ?>>Chung cư</option>
                    <option value="Others" <?= isset($_GET['type_of_real_estate']) && $_GET['type_of_real_estate'] === 'Others' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>

            <!-- Filter Giá -->
            <div class="col-md-3 filter-col">
                <label class="form-label">Giá</label>
                <select class="form-select" id="priceFilter">
                    <option value="All" <?= isset($_GET['price_range']) && $_GET['price_range'] === 'All' ? 'selected' : '' ?>>Tất cả</option>
                    <option value="under_10m" <?= isset($_GET['price_range']) && $_GET['price_range'] === 'under_10m' ? 'selected' : '' ?>>Dưới 10 triệu</option>
                    <option value="10m_to_100m" <?= isset($_GET['price_range']) && $_GET['price_range'] === '10m_to_100m' ? 'selected' : '' ?>>10 triệu - 100 triệu</option>
                    <option value="100m_to_3b" <?= isset($_GET['price_range']) && $_GET['price_range'] === '100m_to_3b' ? 'selected' : '' ?>>100 triệu - 3 tỷ</option>
                    <option value="above_3b" <?= isset($_GET['price_range']) && $_GET['price_range'] === 'above_3b' ? 'selected' : '' ?>>Trên 3 tỷ</option>
                </select>
            </div>
        
            <div class="col-md-3 d-flex justify-content-center align-items-center gap-5">
            <button class="btn btn-filter" id="applyFilter"><i class="bi bi-sliders"></i> Filter</button>
                <button class="btn btn-search" id="searchButton">Search</button>
            </div>
            <div id="searchBar" class="search-bar">
                <input type="text" id="searchInput" class="form-control" placeholder="Nhập tên hoặc địa chỉ sản phẩm..." 
                    value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row g-4"> 
            <?php echo '<script>console.log(' . json_encode($products) . ');</script>'; ?>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4">
                            <a href="index.php?controller=productdetail&action=index&id=<?= htmlspecialchars($product['id']) ?>" class="text-decoration-none">
                                <div class="property-card zoom-on-hover" style="background-image: url('<?= htmlspecialchars($product['image']) ?>');">
                                    <div class="property-overlay">
                                        <div class="property-tags mb-2">
                                            <span class="tag-ban"><?= htmlspecialchars($product['sell_type']) ?></span>
                                            <span class="tag-hot"><?= htmlspecialchars($product['high_light']) ?></span>
                                        </div>

                                        <div>
                                            <h5 class="text-white mb-1" style="margin-bottom: 2px;"><?= htmlspecialchars($product['name']) ?></h5>
                                            <div class="text-white" style="font-size: 14px; margin-bottom: 4px;">
                                                <i class="fa fa-location-dot"></i> <?= htmlspecialchars($product['location']) ?>
                                            </div>

                                            <div class="property-footer d-flex justify-content-between align-items-center">
                                                <div class="text-white">
                                                    <i class="fa fa-bed" style="padding-left: 5px;"></i> <?= htmlspecialchars($product['bedrooms']) ?>
                                                    <i class="fa fa-bath ms-2"></i> <?= htmlspecialchars($product['toilets']) ?>
                                                    <i class="fa fa-maximize ms-2"></i> <?= htmlspecialchars($product['area']) ?>m²
                                                </div>
                                                <div class="fw-bold text-white" style="padding-right: 20px;">Giá: <?= number_format($product['price'], 0, ',', '.') ?> VNĐ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <p>Không có sản phẩm nào để hiển thị.</p>
                <?php endif; ?>
            </div>
        </div>
 
        <?php if ($totalPages > 1): ?>
            <div class="pagination-container text-center mt-4">
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php
                        $queryParams = $_GET;
                        unset($queryParams['page']);
                        ?>

                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($queryParams, ['page' => $currentPage - 1])) ?>">Trước</a>
                            </li>
                        <?php endif; ?>

                        <?php
                        $startPage = max(1, $currentPage - 2); 
                        $endPage = min($totalPages, $currentPage + 2); 
                        ?>

                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query(array_merge($queryParams, ['page' => $i])) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($queryParams, ['page' => $currentPage + 1])) ?>">Tiếp</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $extraJS ?>"></script>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchButton = document.getElementById("searchButton");
            const searchBar = document.getElementById("searchBar");
            const searchInput = document.getElementById("searchInput");

            if (searchButton && searchBar) {
                searchButton.addEventListener("click", function () {
                    searchBar.classList.toggle("active"); 
                });
            }

            if (searchInput) {
                searchInput.addEventListener("keypress", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        const keyword = searchInput.value.trim();
                        if (keyword) {
                            const urlParams = new URLSearchParams(window.location.search);
                            urlParams.set('search', keyword);
                            urlParams.set('page', 1); 
                            window.location.href = `?${urlParams.toString()}`;
                        }
                    }
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            const applyFilterButton = document.getElementById("applyFilter");

            if (applyFilterButton) {
                applyFilterButton.addEventListener("click", function () {
                    const city = document.getElementById("cityFilter").value;
                    const type = document.getElementById("typeFilter").value;
                    const price = document.getElementById("priceFilter").value;

                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('city', city);
                    urlParams.set('type_of_real_estate', type);
                    urlParams.set('price_range', price);
                    urlParams.set('page', 1); 

                    window.location.href = `?${urlParams.toString()}`;
                });
            }
        });
    </script>
</html>