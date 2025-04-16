<?php
    $title=$title ?? "Trang sản phẩm" ;
    $extraCSS=$extraCSS ?? "/Views/Product/style.css" ;
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

    <!-- Tabs -->
  <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="ban-tab" data-bs-toggle="tab" type="button" role="tab">Nhà đất bán</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="thue-tab" data-bs-toggle="tab" type="button" role="tab">Nhà đất thuê</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="duan-tab" data-bs-toggle="tab" type="button" role="tab">Dự án</button>
    </li>
  </ul>

  <!-- Filter Form -->
  <div class="search-container">
    <div class="row g-3 align-items-end">
      <div class="col-md-3 filter-col position-relative">
        <label class="form-label">Thành phố</label>
        <select class="form-select">
          <option selected>Tất cả thành phố</option>
          <option>Hà Nội</option>
          <option>TP HCM</option>
        </select>
      </div>
      <div class="col-md-3 filter-col">
        <label class="form-label">Loại nhà đất</label>
        <select class="form-select">
          <option selected>Tất cả loại nhà đất</option>
          <option>Chung cư</option>
          <option>Nhà riêng</option>
        </select>
      </div>
      <div class="col-md-3 filter-col">
        <label class="form-label">Giá</label>
        <select class="form-select">
          <option selected>Tất cả giá</option>
          <option>Dưới 1 tỷ</option>
          <option>1 - 3 tỷ</option>
        </select>
      </div>
      <div class="col-md-3 d-flex justify-content-center align-items-center gap-5">
        <button class="btn btn-filter">
          <i class="bi bi-sliders"></i> Filter
        </button>
        <button class="btn btn-search">
          Search
        </button>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row g-4"> 
      <!-- Card Mẫu -->
        <!-- <div class="col-md-4">
            <div class="property-card zoom-on-hover" style="background-image: url('https://duanvinhomescoloa.vn/wp-content/uploads/2021/07/nha-vinhomes.jpg');">
                <div class="property-overlay">
                    <div class="property-tags mb-2">
                    <span class="tag-ban">BÁN</span>
                    <span class="tag-hot">NỔI BẬT</span>
                </div>

                <div>
                    <h5 class="text-white mb-1" style="margin-bottom: 2px;">Vinhomes Grand Park</h5>
                    <div class="text-white" style="font-size: 14px; margin-bottom: 4px;"><i class="fa fa-location-dot"></i> Quận 9, Hồ Chí Minh</div>

                <div class="property-footer d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <i class="fa fa-bed" style="padding-left: 5px;"></i> 2
                        <i class="fa fa-bath ms-2"></i> 2
                        <i class="fa fa-maximize ms-2"></i> 80m²
                    </div>
                        <div class="fw-bold text-white" style="padding-right: 20px;">Giá: 4,6 tỷ VNĐ</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="property-card zoom-on-hover" style="background-image: url('https://duanvinhomescoloa.vn/wp-content/uploads/2021/07/nha-vinhomes.jpg');">
                <div class="property-overlay">
                    <div class="property-tags mb-2">
                    <span class="tag-ban">BÁN</span>
                    <span class="tag-hot">NỔI BẬT</span>
                </div>

                <div>
                    <h5 class="text-white mb-1" style="margin-bottom: 2px;">Vinhomes Grand Park</h5>
                    <div class="text-white" style="font-size: 14px; margin-bottom: 4px;"><i class="fa fa-location-dot"></i> Quận 9, Hồ Chí Minh</div>

                <div class="property-footer d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <i class="fa fa-bed" style="padding-left: 5px;"></i> 2
                        <i class="fa fa-bath ms-2"></i> 2
                        <i class="fa fa-maximize ms-2"></i> 80m²
                    </div>
                        <div class="fw-bold text-white" style="padding-right: 20px;">Giá: 4,6 tỷ VNĐ</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="property-card zoom-on-hover" style="background-image: url('https://duanvinhomescoloa.vn/wp-content/uploads/2021/07/nha-vinhomes.jpg');">
                <div class="property-overlay">
                    <div class="property-tags mb-2">
                    <span class="tag-ban">BÁN</span>
                    <span class="tag-hot">NỔI BẬT</span>
                </div>

                <div>
                    <h5 class="text-white mb-1" style="margin-bottom: 2px;">Vinhomes Grand Park</h5>
                    <div class="text-white" style="font-size: 14px; margin-bottom: 4px;"><i class="fa fa-location-dot"></i> Quận 9, Hồ Chí Minh</div>

                <div class="property-footer d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <i class="fa fa-bed" style="padding-left: 5px;"></i> 2
                        <i class="fa fa-bath ms-2"></i> 2
                        <i class="fa fa-maximize ms-2"></i> 80m²
                    </div>
                        <div class="fw-bold text-white" style="padding-right: 20px;">Giá: 4,6 tỷ VNĐ</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="property-card zoom-on-hover" style="background-image: url('https://duanvinhomescoloa.vn/wp-content/uploads/2021/07/nha-vinhomes.jpg');">
                <div class="property-overlay">
                    <div class="property-tags mb-2">
                    <span class="tag-ban">BÁN</span>
                    <span class="tag-hot">NỔI BẬT</span>
                </div>

                <div>
                    <h5 class="text-white mb-1" style="margin-bottom: 2px;">Vinhomes Grand Park</h5>
                    <div class="text-white" style="font-size: 14px; margin-bottom: 4px;"><i class="fa fa-location-dot"></i> Quận 9, Hồ Chí Minh</div>

                <div class="property-footer d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <i class="fa fa-bed" style="padding-left: 5px;"></i> 2
                        <i class="fa fa-bath ms-2"></i> 2
                        <i class="fa fa-maximize ms-2"></i> 80m²
                    </div>
                        <div class="fw-bold text-white" style="padding-right: 20px;">Giá: 4,6 tỷ VNĐ</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="property-card zoom-on-hover" style="background-image: url('https://duanvinhomescoloa.vn/wp-content/uploads/2021/07/nha-vinhomes.jpg');">
                <div class="property-overlay">
                    <div class="property-tags mb-2">
                    <span class="tag-ban">BÁN</span>
                    <span class="tag-hot">NỔI BẬT</span>
                </div>

                <div>
                    <h5 class="text-white mb-1" style="margin-bottom: 2px;">Vinhomes Grand Park</h5>
                    <div class="text-white" style="font-size: 14px; margin-bottom: 4px;"><i class="fa fa-location-dot"></i> Quận 9, Hồ Chí Minh</div>

                <div class="property-footer d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <i class="fa fa-bed" style="padding-left: 5px;"></i> 2
                        <i class="fa fa-bath ms-2"></i> 2
                        <i class="fa fa-maximize ms-2"></i> 80m²
                    </div>
                        <div class="fw-bold text-white" style="padding-right: 20px;">Giá: 4,6 tỷ VNĐ</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="property-card zoom-on-hover" style="background-image: url('https://duanvinhomescoloa.vn/wp-content/uploads/2021/07/nha-vinhomes.jpg');">
                <div class="property-overlay">
                    <div class="property-tags mb-2">
                    <span class="tag-ban">BÁN</span>
                    <span class="tag-hot">NỔI BẬT</span>
                </div>

                <div>
                    <h5 class="text-white mb-1" style="margin-bottom: 2px;">Vinhomes Grand Park</h5>
                    <div class="text-white" style="font-size: 14px; margin-bottom: 4px;"><i class="fa fa-location-dot"></i> Quận 9, Hồ Chí Minh</div>

                <div class="property-footer d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <i class="fa fa-bed" style="padding-left: 5px;"></i> 2
                        <i class="fa fa-bath ms-2"></i> 2
                        <i class="fa fa-maximize ms-2"></i> 80m²
                    </div>
                        <div class="fw-bold text-white" style="padding-right: 20px;">Giá: 4,6 tỷ VNĐ</div>
                    </div>
                    </div>
                </div>
            </div>
        </div> -->
      <!-- Lặp lại thêm nhiều card như trên... -->

      <?php echo '<script>console.log(' . json_encode($products) . ');</script>'; ?>
      <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="property-card zoom-on-hover" style="background-image: url('<?= htmlspecialchars($product['image_url']) ?>');">
                        <div class="property-overlay">
                            <div class="property-tags mb-2">
                                <span class="tag-ban"><?= htmlspecialchars($product['status']) ?></span>
                                <span class="tag-hot"><?= htmlspecialchars($product['highlight']) ?></span>
                            </div>

                            <div>
                                <h5 class="text-white mb-1" style="margin-bottom: 2px;"><?= htmlspecialchars($product['name']) ?></h5>
                                <div class="text-white" style="font-size: 14px; margin-bottom: 4px;">
                                    <i class="fa fa-location-dot"></i> <?= htmlspecialchars($product['location']) ?>
                                </div>

                                <div class="property-footer d-flex justify-content-between align-items-center">
                                    <div class="text-white">
                                        <i class="fa fa-bed" style="padding-left: 5px;"></i> <?= htmlspecialchars($product['bedrooms']) ?>
                                        <i class="fa fa-bath ms-2"></i> <?= htmlspecialchars($product['bathrooms']) ?>
                                        <i class="fa fa-maximize ms-2"></i> <?= htmlspecialchars($product['area']) ?>m²
                                    </div>
                                    <div class="fw-bold text-white" style="padding-right: 20px;">Giá: <?= number_format($product['price'], 0, ',', '.') ?> VNĐ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào để hiển thị.</p>
        <?php endif; ?>
    </div>
</div>
 
      <div class="col-12 text-center mt-4">
        <button class="btn btn-load-more">Xem thêm <i class="fa fa-arrow-right"></i></button>
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.js"></script>
    
    </body>
</html>