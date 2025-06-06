<?php
$title = $title ?? "Trang web";
$extraCSS = $extraCSS ?? "";
$extraJS = $extraJS ?? "";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icon chính -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- CSS chính -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="/Views/template/style.css">

    <!-- CSS riêng -->
    <?php if (!empty($extraCSS)): ?>
        <link rel="stylesheet" href="<?= $extraCSS ?>">
    <?php endif; ?>
</head>

<body>

    <!-- Nội dung trang -->
    <main>

        <nav class="_header mw-100">
            <div onclick="handleOpenSidebar()" class="_bar"><i class="fa-solid fa-bars"></i></div>
            <!-- <i class='' class="fa-solid fa-bars"></i> -->
            <div class="_logo">BKHome</div>
            <ul class="_navi">
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=homepage&action=admin">Trang chủ</a></li>
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=intro&action=admin">Giới thiệu</a></li>
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=product&action=admin">Sản phẩm</a></li>
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=news&action=admin">Tin tức</a></li>
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=answerandquestion&action=admin">Hỏi đáp</a></li>
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=contact&action=admin">Liên hệ</a></li>
                <li class="_navi_ele"><a class="nav-link" aria-current="page"
                        href="index.php?controller=account&action=admin">Người dùng</a></li>

            </ul>
            <i style="display: none" class="fa-solid fa-bars"></i>
            <?php if (isset($_SESSION['admin'])): ?>
                <button class="btn btn-outline-light" id="btnLogout">Logout</button>
            <?php else: ?>
                <button class="btn btn-outline-light" id="btnLogin">Login</button>
            <?php endif; ?>
            <!-- <button class="btn btn-outline-dark" id="btnLogin">Login</button> -->

            <div class="_sidebar" id="sidebar">
                <i onclick="handleCloseSidebar()" class="fa-solid fa-x"></i>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=homepage&action=admin">Trang chủ</a></div>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=intro&action=admin">Giới thiệu</a></div>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=product&action=admin">Sản phẩm</a></div>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=news&action=admin">Tin tức</a></div>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=answerandquestion&action=admin">Hỏi đáp</a></div>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=contact&action=admin">Liên hệ</a></div>
                <div class="_sidebar-item"><a class="nav-link" aria-current="page"
                        href="index.php?controller=account&action=admin">Người dùng</a></div>
            </div>
        </nav>


        <?php include $viewFile; ?>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS chính -->
    <script src="/Views/templateAdmin/script.js"></script>

    <!-- JS riêng -->
    <?php if (!empty($extraJS)): ?>
        <script src="<?= $extraJS ?>"></script>
    <?php endif; ?>

</body>

</html>