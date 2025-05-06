<div>

    <iframe
        src="https://www.youtube.com/embed/C0ThpPnQwEM?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&loop=1&playlist=C0ThpPnQwEM"
        frameborder="0"
        allow="autoplay"
        allowfullscreen
        style=" width: 100vw; height:100vh; object-fit: cover; pointer-events: none; ">
    </iframe>


    <div class="intro_sentence" style="padding: 0 20px;">
        <h2><?= htmlspecialchars($listTitle[0]['title']) ?></h2>
        <p><?= htmlspecialchars($listTitle[1]['title']) ?></p>
    </div>




    <div class="swiper-container-wrapper">
        <h2 style="text-align:center; margin-bottom:20px; ">Bất Động Sản Tại Các Thành Phố Nổi Bật</h2>
        <div class="swiper mySwiper1">
            <div class="swiper-wrapper">
                <?php foreach ($listProvince as $province): ?>
                    <div class="swiper-slide">
                        <div class="province-card">
                            <img src="data:image/jpeg;base64,<?= base64_encode($province['thumbnail']) ?>" alt="<?= htmlspecialchars($province['name']) ?>">

                            <div class="province-info">
                                <h3><?= htmlspecialchars($province['name']) ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Nút điều hướng -->
            <div class="swiper-button-next navi_cus"></div>
            <div class="swiper-button-prev navi_cus"></div>
        </div>
    </div>

    <?php $i = 1;
    foreach ($listIntro as $Intro): ?>
        <div style="padding: 0 20px; <?= ($i % 2 == 0) ? 'background: #f0f1f3;' : ''; ?>">
            <div class="box_vision <?= ($i % 2 == 0) ? 'box_vision_reverse' : ''; ?>">
                <img id="loadImg"
                    src="data:image/jpeg;base64,<?= base64_encode($Intro['img']) ?>"
                    alt="<?= htmlspecialchars($Intro['name']) ?>">
            
                <div class="box_vision-content">
                    <h2><?= htmlspecialchars($Intro['name']) ?></h2>
                    <p><?= htmlspecialchars($Intro['detail']) ?></p>
                </div>
            </div>
        </div>
    <?php $i++;
    endforeach; ?>


</div>