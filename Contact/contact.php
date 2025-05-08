<div class="container pt-4 mt-4">
    <div class="contact-card">
        <h2>Liên hệ với chúng tôi</h2>
        <?php foreach ($listInfo as $info): ?>
            <div class="contact-info">
                <p><strong>Cơ sở:</strong> <?= htmlspecialchars($info['id']) ?></p>
                <p><strong>Điện thoại:</strong> <?= htmlspecialchars($info['phone']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($info['email']) ?></p>
                <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($info['address']) ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<div class="pb-4 mb-4">
    <div class="hero">
        <img src="uploads/homescreen6.jpg" alt="Căn hộ hiện đại" class="hero-bg" />
        <div class="overlay">
            <div class="hero-content">
                <h1>Trao Đổi Trực Tiếp<br>Với chúng Tôi</h1>
                <a href="index.php?controller=answerandquestion&action=index" class="hero-button">Bắt Đầu Ngay →</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="contact-card">
        <h2 class="mt-4">Vị trí công ty trên bản đồ</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5275.140347383273!2d106.80281137619451!3d10.88055848927464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d8a5568c997f%3A0xdeac05f17a166e0c!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJBIUUcgVFAuSENN!5e1!3m2!1svi!2s!4v1746706475789!5m2!1svi!2s" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>