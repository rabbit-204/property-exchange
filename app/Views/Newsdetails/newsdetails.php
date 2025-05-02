<style>
    .news-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .news-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.2rem;
    }

    .news-meta {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 1.5rem;
    }

    .main-image {
        float: right;
        width: 300px;
        /* Cố định kích thước */
        height: auto;
        max-height: 300px;
        object-fit: cover;
        margin-left: 20px;
        margin-bottom: 10px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    }

    .news-description {
        font-size: 1.1rem;
        line-height: 1.7;
        text-align: justify;
        overflow: hidden;
        /* Clear float nếu cần */
    }

    .comment-box {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f9f9f9;
    }

    /* Clear float sau phần mô tả */
    .clearfix::after {
        content: "";
        display: block;
        clear: both;
    }
</style>

<div class="container mt-5 pt-4 news-wrapper">

    <!-- Tiêu đề & ngày đăng -->
    <div class="news-title"><?= htmlspecialchars($news['title']) ?></div>
    <div class="news-meta">Ngày đăng: <?= date('d/m/Y H:i', strtotime($news['created_at'])) ?></div>

    <div class="news-description clearfix">
        <?php if (!empty($news['image'])): ?>
            <img src="<?= htmlspecialchars($news['image']) ?>" class="main-image" ...>
        <?php endif; ?>

        <?php if (!empty($isAdmin)): ?>
            <!-- Nội dung gốc -->
            <div id="descriptionView">
                <p><?= nl2br(htmlspecialchars($news['description'])) ?></p>
                <button class="btn btn-sm btn-outline-primary me-2" onclick="toggleEditForm()">✏️ Sửa bài viết</button>

                <a href="index.php?controller=news&action=delete&id=<?= $news['id'] ?>"
                    class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?');">
                    🗑️ Xóa bài viết
                </a>
            </div>

            <!-- Form sửa - ẩn ban đầu -->
            <form id="editForm" style="display: none;" method="POST" action="index.php?controller=news&action=update"
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $news['id'] ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title']) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Nội dung</label>
                    <textarea name="description" class="form-control" rows="6"
                        required><?= htmlspecialchars($news['description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Ảnh hiện tại:</label><br>
                    <img src="<?= $news['image'] ?>" alt="Ảnh" style="max-height: 150px;">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Thay ảnh (nếu cần)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">💾 Lưu cập nhật</button>
                <button type="button" class="btn btn-secondary" onclick="toggleEditForm()">❌ Hủy</button>
            </form>
        <?php else: ?>
            <p><?= nl2br(htmlspecialchars($news['description'])) ?></p>
        <?php endif; ?>
    </div>

    <script>
        function toggleEditForm() {
            const view = document.getElementById('descriptionView');
            const form = document.getElementById('editForm');
            const isHidden = form.style.display === 'none';
            form.style.display = isHidden ? 'block' : 'none';
            view.style.display = isHidden ? 'none' : 'block';
        }
    </script>

    <!-- Bình luận -->
    <div class="mt-5 mb-4">
        <h5 class="mb-3">Bình luận</h5>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php foreach ($comments as $comment): ?>
            <div class="comment-box">
                <div class="d-flex justify-content-between">
                    <div><strong>👤 Người dùng #<?= $comment['user_id'] ?></strong></div>
                    <small class="text-muted"><?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?></small>
                </div>
                <p class="mt-2 mb-1"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>

                <?php if (!empty($isAdmin)): ?>
                    <form method="GET" action="index.php" onsubmit="return confirm('Xóa bình luận này?');">
                        <input type="hidden" name="controller" value="comment">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                        <input type="hidden" name="news_id" value="<?= $news['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Gửi bình luận -->
    <?php if (isset($_SESSION['user'])): ?>
        <div class="mb-5">
            <h5>Gửi bình luận</h5>
            <form method="POST" action="index.php?controller=comment&action=add">
                <input type="hidden" name="news_id" value="<?= $news['id'] ?>">
                <textarea class="form-control mb-2" name="content" rows="4" placeholder="Nhập nội dung..."
                    required></textarea>
                <button type="submit" class="btn btn-primary">Gửi bình luận</button>
            </form>
        </div>
    <?php else: ?>
        <p><a href="index.php?controller=login&action=index">Đăng nhập để bình luận</a></p>
    <?php endif; ?>
</div>

<!-- Modal ảnh -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<script>
    function showImageModal(img) {
        document.getElementById('modalImage').src = img.src;
    }
</script>