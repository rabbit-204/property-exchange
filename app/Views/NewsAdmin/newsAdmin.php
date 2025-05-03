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

    <form id="searchForm" class="d-flex align-items-center mb-3 px-2" style="gap: 10px;">
        <!-- Input tìm kiếm -->
        <input type="text" name="search" id="searchInput" class="form-control" style="max-width: 400px;"
            placeholder="Tìm kiếm theo tên hoặc vị trí...">

        <!-- Nút Tìm kiếm -->
        <button type="submit" class="btn btn-outline-primary">🔍 Tìm kiếm</button>

        <!-- Nút Thêm tin tức -->
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addNewsModal">
            ➕ Thêm tin tức
        </button>
    </form>

    <div class="container mt-4">
        <h3 class="mb-3">Danh sách tin tức</h3>

        <div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc; border-radius: 5px;">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Ngày đăng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($newsList)): ?>
                        <?php foreach ($newsList as $news): ?>
                            <tr onclick="window.location.href='?controller=newsdetails&action=index&id=<?= $news['id'] ?>'">
                                <td><?= htmlspecialchars($news['id']) ?></td>
                                <td><?= htmlspecialchars($news['title']) ?></td>
                                <td><?= mb_strimwidth(strip_tags($news['description']), 0, 100, '...') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($news['created_at'])) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Không có tin tức nào.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- STYLE -->
    <style>
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }
    </style>

    <!-- MODAL THÊM TIN TỨC -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form action="index.php?controller=news&action=store" method="POST" enctype="multipart/form-data"
                class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Thêm tin tức mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body row g-3">
                    <!-- Tiêu đề -->
                    <div class="col-md-12">
                        <input type="text" name="title" class="form-control" placeholder="Tiêu đề tin tức" required>
                    </div>

                    <!-- Mô tả -->
                    <div class="col-md-12">
                        <textarea name="description" class="form-control" rows="5"
                            placeholder="Nội dung mô tả tin tức..." required></textarea>
                    </div>

                    <!-- Ảnh đại diện -->
                    <div class="col-md-12">
                        <label for="image" class="form-label">Ảnh đại diện:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>