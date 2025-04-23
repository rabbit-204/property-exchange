<div>
    <!-- <iframe class="elementor-background-video-embed" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" title="CRV Corporate Video" width="640" height="360" src="https://www.youtube.com/embed/tOwf2zywavM?controls=0&rel=0&playsinline…https%3A%2F%2Fcentralretail.com.vn%2Fgioi-thieu%2F%23top&aoriginsup=1&vf=6" id="widget2" style="width: 2560px; height: 1440px;"> -->
    <!-- <iframe width="560" height="315" src="https://www.youtube.com/watch?v=rbMjgSUNjEM" 
    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
    <!-- <iframe class="elementor-background-video-embed" frameborder="0" allowfullscreen="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" title="CRV Corporate Video" width="640" height="360" src="https://www.youtube.com/embed/tOwf2zywavM?controls=0&amp;rel=0&amp;playsinline=1&amp;enablejsapi=1&amp;origin=https%3A%2F%2Fcentralretail.com.vn&amp;widgetid=1&amp;forigin=https%3A%2F%2Fcentralretail.com.vn%2Fgioi-thieu%2F%23top&amp;aoriginsup=1&amp;vf=6" id="widget2" style="width: 1619.56px; height: 911px;"></iframe> -->
    <!-- <iframe
        src="https://www.youtube.com/embed/rbMjgSUNjEM?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&loop=1&playlist=rbMjgSUNjEM"
    frameborder="0" 
    allow="autoplay" 
    allowfullscreen 
    referrerpolicy="strict-origin-when-cross-origin"
    style="width: 100vw; height: 100vh; object-fit: cover; z-index: -1; pointer-events: none;">
</iframe> -->
    <iframe
        src="https://www.youtube.com/embed/C0ThpPnQwEM?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&loop=1&playlist=C0ThpPnQwEM"
        frameborder="0"
        allow="autoplay"
        allowfullscreen
        style=" width: 100vw; height:100vh; object-fit: cover; pointer-events: none; ">
    </iframe>
    <!-- <iframe
  width="560"
  height="315"
  src="https://www.youtube.com/embed/C0ThpPnQwEM?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&loop=1&playlist=C0ThpPnQwEM"
  title="YouTube video player"
  frameborder="0"
  allow="autoplay; encrypted-media"
  allowfullscreen
  sandbox="allow-same-origin allow-scripts">
</iframe> -->

    <div class="intro_sentence" style="padding: 0 20px;">
        <h4>BKHome là một trong những</h4>
        <h2>Nền tảng bất động sản hàng đầu tại Việt Nam, với vốn đầu tư mạnh mẽ và uy tín trên thị trường</h2>
        <p> Chúng tôi tập trung vào ba mảng kinh doanh cốt lõi: Mua bán nhà đất, Cho thuê bất động sản và Đầu tư/Phát triển dự án</p>
    </div>
    <!-- <div class="list_slide" style="padding:0 20px;">
        <div class="slider-container">
            <button style="cursor: pointer; border:none; background: transparent" onclick="prevSlide()">
                < </button>
                    <div class="slider">
                        <div class="image-list" id="province-container"></div>
                    </div>
                    <button style="cursor: pointer; border:none; background: transparent" onclick="nextSlide()">></button>
        </div>
    </div> -->




    <div class="swiper-container-wrapper">
        <h2 style="text-align:center; margin-bottom:20px; ">Bất Động Sản Tại Các Thành Phố Nổi Bật</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($listProvince as $province): ?>
                    <div class="swiper-slide">
                        <div class="province-card">
                            <img src="<?= htmlspecialchars($province['thumbnail']) ?>" alt="<?= htmlspecialchars($province['name']) ?>">
                            <div class="province-info">
                                <h3><?= htmlspecialchars($province['name']) ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Nút điều hướng -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>




    <!-- <div style="padding: 0 20px;">
        <div class="box_vision">
            <img id="loadImg" src="https://centralretail.com.vn/wp-content/uploads/elementor/thumbs/1-5-q6l2uv57f2ewvvpoex3o96haxsdgyrcxc7ncosi8p4.jpg" alt="">
            <div class="box_vision-content">
                <h2>Tầm Nhìn</h2>
                <p>Chúng tôi hướng đến việc kiến tạo những không gian sống đẳng cấp, góp phần nâng cao chất lượng cuộc sống và thúc đẩy sự thịnh vượng bền vững cho cộng đồng Việt Nam.</p>
            </div>
        </div>
    </div>
    <div style="background: #f0f1f3; padding: 0 20px;">
        <div class="box_vision box_vision_reverse">
            <div class="box_vision-content">
                <h2>Thành Tựu</h2>
                <p>Với nhiều năm hoạt động trong lĩnh vực bất động sản, BKHome đã khẳng định vị thế vững chắc trên thị trường và được ghi nhận bởi khách hàng, đối tác nhờ những đóng góp vào sự phát triển đô thị hiện đại và nâng cao chất lượng sống cho cộng đồng.</p>
            </div>
            <img id="loadImg" src="https://centralretail.com.vn/wp-content/uploads/2021/07/AWARD@2X-1.png.webp" alt="">
        </div>
    </div>
    <div style="padding: 0 20px;">
        <div class="box_vision">
            <img id="loadImg" src="https://centralretail.com.vn/wp-content/uploads/2023/10/banner_aboutus-1024x682.jpg" alt="">
            <div class="box_vision-content">
                <h2>Đội Ngũ</h2>
                <p>Chúng tôi tự hào sở hữu đội ngũ chuyên gia giàu kinh nghiệm, tận tâm và không ngừng đổi mới, luôn đặt khách hàng làm trung tâm. Với tinh thần làm việc chuyên nghiệp và đạo đức nghề nghiệp, chúng tôi cam kết mang đến những giải pháp bất động sản tối ưu nhất.</p>
            </div>
        </div>
    </div> -->
    <?php $i = 1;
    foreach ($listIntro as $Intro): ?>
        <div style="padding: 0 20px; <?= ($i % 2 == 0) ? 'background: #f0f1f3;' : ''; ?>">
            <div class="box_vision <?= ($i % 2 == 0) ? 'box_vision_reverse' : ''; ?>">
                <img id="loadImg" src="<?= htmlspecialchars($Intro['img']) ?>" alt="<?= htmlspecialchars($Intro['name']) ?>">
                <div class="box_vision-content">
                    <h2><?= htmlspecialchars($Intro['name']) ?></h2>
                    <p><?= htmlspecialchars($Intro['detail']) ?></p>
                </div>
            </div>
        </div>
    <?php $i++;
    endforeach; ?>


</div>