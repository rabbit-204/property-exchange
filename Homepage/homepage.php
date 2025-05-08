<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
    window.imageData = [
        <?php foreach ($listScreen as $screen): ?> "data:image/jpeg;base64,<?= base64_encode($screen['image']) ?>",
        <?php endforeach; ?>
    ];

    window.captionData = [
        <?php foreach ($listScreen as $screen): ?> <?= json_encode($screen['caption']) ?>,
        <?php endforeach; ?>
    ]
</script>

<body>

    <div class="image-slider">
        <div class="slider-wrapper" id="sliderWrapper">
            <img class="slider-image" src="uploads/homescreen1.png" alt="Slideshow" />
        </div>
        <div class="slider-text">Welcome to BKHOME!</div>
        <button class="slider-button left" onclick="prevImage()">&lt;</button>
        <button class="slider-button right" onclick="nextImage()">&gt;</button>
    </div>

    <div class="pt-4 mt-4 pb-4 mb-4">
        <div class="container">
            <h2 class="mb-4 text-center">Bất Động Sản Tại Các Thành Phố Nổi Bật</h2>
            <div class="hp1_row">
                <?php foreach ($listCard as $card): ?>
                    <div class="">
                        <div class="city-card">
                            <img src="data:image/jpeg;base64,<?= base64_encode($card['image']) ?>" alt="<?= htmlspecialchars($card['name']) ?>" />
                            <div class="card-overlay">
                                <h5 class="mb-0"><?= htmlspecialchars($card['name']) ?></h5>
                                <small><?= htmlspecialchars($card['num']) ?>+ Bất động sản</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="pb-4 mb-4">
        <div class="hero">
            <img src="uploads/homescreen6.jpg" alt="Căn hộ hiện đại" class="hero-bg" />
            <div class="overlay">
                <div class="hero-content">
                    <h1>Khám Phá Căn Hộ<br>Phù Hợp Với Bạn</h1>
                    <a href="index.php?controller=product&action=index" class="hero-button">View Properties →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-4 mb-4">
        <div class="container">
            <h2 class="text-center mb-5">Tại Sao Bạn Nên Chọn Chúng Tôi</h2>
            <div class="row">

                <?php foreach ($listIntroduction as $introduction): ?>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="<?= htmlspecialchars($introduction['symbol']) ?>"></i>
                            </div>
                            <h4><?= htmlspecialchars($introduction['title']) ?></h4>
                            <p><?= htmlspecialchars($introduction['detail']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="pb-4 mb-4">
        <div class="container">
            <div class="cta-section">
                <div class="row align-items-center d-flex justify-content-between">
                    <div class="col-md-7 ps-5">
                        <h3>Đăng Nhập Để Trải Nghiệm Toàn Bộ Dịch Vụ</h3>
                        <p>
                            Chúng tôi cung cấp nhiều thông tin chi tiết hơn cho người dùng đã đăng ký tài khoản bao gồm các đề xuất cá nhân hóa và thông tin đặt
                            chỗ.
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <button class="btn" style="background-color: #E7C873;" onclick="window.location.href='index.php?controller=login&action=index'">Đăng ký hoặc đăng nhập tài khoản</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mb-4 pb-4">
        <div class="hero">
            <img src="uploads/homescreen5.jpg" alt="Căn hộ hiện đại" class="hero-bg" />
            <div class="overlay">
                <div class="hero-content">
                    <h1>Cập Nhật<br>Những Tin Tức Mới Nhất</h1>
                    <a href="index.php?controller=news&action=index" class="hero-button">View News →</a>
                </div>
            </div>
        </div>
    </div>

</body>