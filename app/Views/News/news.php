<?php
$title = $title ?? "Trang tin tức";
$extraCSS = $extraCSS ?? "/Views/news/style.css";
$extraJS = $extraJS ?? "/Views/news/script.js";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
</body>

</html>

<div class="container" style="margin-top: 2rem;">
    <div class="tim-kiem">
        <h5>Tìm kiếm từ khóa:</h5>
        <form class="row g-3" action="index.php" method="GET">
            <input type="hidden" name="controller" value="news">
            <input type="hidden" name="action" value="index">

            <div class="col-auto">
                <input type="text" class="form-control" placeholder="Nhập tiêu đề hoặc nội dung tin tức..."
                    aria-label="Search" name="search" value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <div class="section-header">
        <?php
        if (!isset($_GET["search"]))
            echo
                '<h3>Tin tức</h3>
        </h3>';
        else {
            echo
                '<h3>Kết quả tìm kiếm: ' . $search . '</h3>';
        }
        ?>
    </div>
    <form class="row g-3 align-items-center" method="GET" action="index.php">
        <input type="hidden" name="controller" value="news">
        <input type="hidden" name="action" value="index">
        <input type="hidden" name="search" value="<?= htmlspecialchars($search ?? '') ?>">

        <div class="col-auto">
            <label for="order" class="col-form-label">Sắp xếp theo:</label>
        </div>
        <div class="col-auto">
            <select class="form-select" name="order" onchange="this.form.submit()">
                <option value="DESC" <?= (($_GET['order'] ?? '') == 'DESC' ? 'selected' : '') ?>>Mới nhất</option>
                <option value="ASC" <?= (($_GET['order'] ?? '') == 'ASC' ? 'selected' : '') ?>>Cũ nhất</option>
            </select>
        </div>
    </form>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($newsList as $news): ?>
            <div class="col">
                <div class="card h-100">
                    <a href="index.php?controller=newsdetails&action=index&id=<?php echo $news['id']; ?>">
                        <img src="<?php echo $news['image']; ?>" class="card-img-top" alt="Ảnh tin tức" height="200">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="index.php?controller=newsdetails&action=index&id=<?php echo $news['id']; ?>">
                                <?php echo htmlspecialchars($news['title']); ?>
                            </a>
                        </h5>
                        <p class="card-text">
                            <?php echo nl2br(htmlspecialchars(mb_substr($news['description'], 0, 100))) . '...'; ?>
                        </p>
                        <p class="text-muted"><small>Ngày đăng:
                                <?php echo date('d/m/Y', strtotime($news['created_at'])); ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Phân trang -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">

            <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="index.php?controller=news&action=index&page=<?= $currentPage - 1 ?>&search=<?= urlencode($search ?? '') ?>&order=<?= urlencode($order ?? '') ?>">
                        « Trước
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                    <a class="page-link"
                        href="index.php?controller=news&action=index&page=<?= $i ?>&search=<?= urlencode($search ?? '') ?>&order=<?= urlencode($order ?? '') ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="index.php?controller=news&action=index&page=<?= $currentPage + 1 ?>&search=<?= urlencode($search ?? '') ?>&order=<?= urlencode($order ?? '') ?>">
                        Sau »
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>
</div>
</div>
</div>