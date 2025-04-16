<?php
    $title=$title ?? "Trang web" ;
    $extraCSS=$extraCSS ?? "" ;
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

        <!-- CSS chính -->
        <!-- <link rel="stylesheet" href="style.css"> -->
        <link rel="stylesheet" href="/Views/template/style.css">
        <!-- <style>
            ._header {
                background: transparent;
                display: flex;
                justify-content:
                    space-between;
                align-items: center;
                padding: 10px 20px;

            }

            ._logo {
                font-size: 1.5em;
                font-weight: bold;
            }

            ._navi {
                display: flex;
                gap: 20px;
                list-style-type: none;
            }

            ._navi_ele {
                font-weight: 500;
            }

            .testimonial-section {
                background-color: #1f4b43;
                color: white;
                padding: 60px 0;
            }

            .section-title {
                font-size: 28px;
                color: #e7c873;
                font-weight: bold;
            }

            .stats {
                margin: 20px 0;
            }

            .stats h3 {
                font-size: 24px;
                font-weight: bold;
            }

            .stars {
                color: gold;
                font-size: 20px;
            }

            .testimonial {
                max-width: 600px;
                margin: 30px auto;
                text-align: center;
            }

            .avatar {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                margin-bottom: 10px;
            }

            .sub-text {
                font-size: 14px;
                color: #bbb;
            }

            .review-text {
                font-size: 16px;
                font-style: italic;
                margin-top: 10px;
            }

            .navigation {
                margin-top: 15px;
            }

            .btn-nav {
                background: transparent;
                border: 1px solid white;
                color: white;
                padding: 5px 10px;
                margin: 5px;
                border-radius: 50%;
                font-size: 18px;
                cursor: pointer;
            }

            .btn-nav:hover {
                background: white;
                color: black;
            }

            .divider {
                border-top: 1px solid rgba(255, 255, 255, 0.3);
                margin: 40px 0;
            }

            .trusted-text {
                color: #bbb;
                font-size: 14px;
                margin-bottom: 20px;
            }

            .brands img {
                max-height: 40px;
                margin: 10px 20px;
                opacity: 0.7;
                transition: 0.3s;
            }

            .brands img:hover {
                opacity: 1;
            }

            .button {
                --primary: #ff5569;
                --neutral-1: #f7f8f7;
                --neutral-2: #e7e7e7;
                --radius: 14px;

                cursor: pointer;
                border-radius: var(--radius);
                text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
                border: none;
                box-shadow: 0 0.5px 0.5px 1px rgba(255, 255, 255, 0.2),
                    0 10px 20px rgba(0, 0, 0, 0.2), 0 4px 5px 0px rgba(0, 0, 0, 0.05);
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                transition: all 0.3s ease;
                min-width: 200px;
                padding: 20px;
                height: 68px;
                font-family: "Galano Grotesque", Poppins, Montserrat, sans-serif;
                font-style: normal;
                font-size: 18px;
                font-weight: 600;
            }

            .button:hover {
                transform: scale(1.02);
                box-shadow: 0 0 1px 2px rgba(255, 255, 255, 0.3),
                    0 15px 30px rgba(0, 0, 0, 0.3), 0 10px 3px -3px rgba(0, 0, 0, 0.04);
            }

            .button:active {
                transform: scale(1);
                box-shadow: 0 0 1px 2px rgba(255, 255, 255, 0.3),
                    0 10px 3px -3px rgba(0, 0, 0, 0.2);
            }

            .button:after {
                content: "";
                position: absolute;
                inset: 0;
                border-radius: var(--radius);
                border: 2.5px solid transparent;
                background: linear-gradient(var(--neutral-1), var(--neutral-2)) padding-box,
                    linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.45)) border-box;
                z-index: 0;
                transition: all 0.4s ease;
            }

            .button:hover::after {
                transform: scale(1.05, 1.1);
                box-shadow: inset 0 -1px 3px 0 rgba(255, 255, 255, 1);
            }

            .button::before {
                content: "";
                inset: 7px 6px 6px 6px;
                position: absolute;
                background: linear-gradient(to top, var(--neutral-1), var(--neutral-2));
                border-radius: 30px;
                filter: blur(0.5px);
                z-index: 2;
            }

            .state p {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .state .icon {
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                margin: auto;
                transform: scale(1.25);
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .state .icon svg {
                overflow: visible;
            }

            /* Outline */
            .outline {
                position: absolute;
                border-radius: inherit;
                overflow: hidden;
                z-index: 1;
                opacity: 0;
                transition: opacity 0.4s ease;
                inset: -2px -3.5px;
            }

            .outline::before {
                content: "";
                position: absolute;
                inset: -100%;
                background: conic-gradient(from 180deg,
                        transparent 60%,
                        white 80%,
                        transparent 100%);
                animation: spin 2s linear infinite;
                animation-play-state: paused;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .button:hover .outline {
                opacity: 1;
            }

            .button:hover .outline::before {
                animation-play-state: running;
            }

            /* Letters */
            .state p span {
                display: block;
                opacity: 0;
                animation: slideDown 0.8s ease forwards calc(var(--i) * 0.03s);
            }

            .button:hover p span {
                opacity: 1;
                animation: wave 0.5s ease forwards calc(var(--i) * 0.02s);
            }

            .button:focus p span {
                opacity: 1;
                animation: disapear 0.6s ease forwards calc(var(--i) * 0.03s);
            }

            @keyframes wave {
                30% {
                    opacity: 1;
                    transform: translateY(4px) translateX(0) rotate(0);
                }

                50% {
                    opacity: 1;
                    transform: translateY(-3px) translateX(0) rotate(0);
                    color: var(--primary);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0) translateX(0) rotate(0);
                }
            }

            @keyframes slideDown {
                0% {
                    opacity: 0;
                    transform: translateY(-20px) translateX(5px) rotate(-90deg);
                    color: var(--primary);
                    filter: blur(5px);
                }

                30% {
                    opacity: 1;
                    transform: translateY(4px) translateX(0) rotate(0);
                    filter: blur(0);
                }

                50% {
                    opacity: 1;
                    transform: translateY(-3px) translateX(0) rotate(0);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0) translateX(0) rotate(0);
                }
            }

            @keyframes disapear {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                    transform: translateX(5px) translateY(20px);
                    color: var(--primary);
                    filter: blur(5px);
                }
            }

            /* Plane */
            .state--default .icon svg {
                animation: land 0.6s ease forwards;
            }

            .button:hover .state--default .icon {
                transform: rotate(45deg) scale(1.25);
            }

            .button:focus .state--default svg {
                animation: takeOff 0.8s linear forwards;
            }

            .button:focus .state--default .icon {
                transform: rotate(0) scale(1.25);
            }

            @keyframes takeOff {
                0% {
                    opacity: 1;
                }

                60% {
                    opacity: 1;
                    transform: translateX(70px) rotate(45deg) scale(2);
                }

                100% {
                    opacity: 0;
                    transform: translateX(160px) rotate(45deg) scale(0);
                }
            }

            @keyframes land {
                0% {
                    transform: translateX(-60px) translateY(30px) rotate(-50deg) scale(2);
                    opacity: 0;
                    filter: blur(3px);
                }

                100% {
                    transform: translateX(0) translateY(0) rotate(0);
                    opacity: 1;
                    filter: blur(0);
                }
            }

            /* Contrail */
            .state--default .icon:before {
                content: "";
                position: absolute;
                top: 50%;
                height: 2px;
                width: 0;
                left: -5px;
                background: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.5));
            }

            .button:focus .state--default .icon:before {
                animation: contrail 0.8s linear forwards;
            }

            @keyframes contrail {
                0% {
                    width: 0;
                    opacity: 1;
                }

                8% {
                    width: 15px;
                }

                60% {
                    opacity: 0.7;
                    width: 80px;
                }

                100% {
                    opacity: 0;
                    width: 160px;
                }
            }

            /* States */
            .state {
                padding-left: 29px;
                z-index: 2;
                display: flex;
                position: relative;
            }

            .state--default span:nth-child(4) {
                margin-right: 5px;
            }

            .state--sent {
                display: none;
            }

            .state--sent svg {
                transform: scale(1.25);
                margin-right: 8px;
            }

            .button:focus .state--default {
                position: absolute;
            }

            .button:focus .state--sent {
                display: flex;
            }

            .button:focus .state--sent span {
                opacity: 0;
                animation: slideDown 0.8s ease forwards calc(var(--i) * 0.2s);
            }

            .button:focus .state--sent .icon svg {
                opacity: 0;
                animation: appear 1.2s ease forwards 0.8s;
            }

            @keyframes appear {
                0% {
                    opacity: 0;
                    transform: scale(4) rotate(-40deg);
                    color: var(--primary);
                    filter: blur(4px);
                }

                30% {
                    opacity: 1;
                    transform: scale(0.6);
                    filter: blur(1px);
                }

                50% {
                    opacity: 1;
                    transform: scale(1.2);
                    filter: blur(0);
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .form-input {
                width: 100%;
                padding: 10px;
                border: none;
                background-color: #fff;
                color: #333;
                border-radius: 5px;
            }

            /* From Uiverse.io by SelfMadeSystem */
            .rating {
                display: flex;
                flex-direction: row-reverse;
                gap: 0.3rem;
                --stroke: #666;
                --fill: #ffc73a;
            }

            .rating input {
                appearance: unset;
            }

            .rating label {
                cursor: pointer;
            }

            .rating svg {
                width: 2rem;
                height: 2rem;
                overflow: visible;
                fill: transparent;
                stroke: var(--stroke);
                stroke-linejoin: bevel;
                stroke-dasharray: 12;
                animation: idle 4s linear infinite;
                transition: stroke 0.2s, fill 0.5s;
            }

            @keyframes idle {
                from {
                    stroke-dashoffset: 24;
                }
            }

            .rating label:hover svg {
                stroke: var(--fill);
            }

            .rating input:checked~label svg {
                transition: 0s;
                animation: idle 4s linear infinite, yippee 0.75s backwards;
                fill: var(--fill);
                stroke: var(--fill);
                stroke-opacity: 0;
                stroke-dasharray: 0;
                stroke-linejoin: miter;
                stroke-width: 8px;
            }

            @keyframes yippee {
                0% {
                    transform: scale(1);
                    fill: var(--fill);
                    fill-opacity: 0;
                    stroke-opacity: 1;
                    stroke: var(--stroke);
                    stroke-dasharray: 10;
                    stroke-width: 1px;
                    stroke-linejoin: bevel;
                }

                30% {
                    transform: scale(0);
                    fill: var(--fill);
                    fill-opacity: 0;
                    stroke-opacity: 1;
                    stroke: var(--stroke);
                    stroke-dasharray: 10;
                    stroke-width: 1px;
                    stroke-linejoin: bevel;
                }

                30.1% {
                    stroke: var(--fill);
                    stroke-dasharray: 0;
                    stroke-linejoin: miter;
                    stroke-width: 8px;
                }

                60% {
                    transform: scale(1.2);
                    fill: var(--fill);
                }
            }

            textarea {
                border-radius: 8px;
                height: 100px;
                width: 100%;
                resize: none;
                outline: 0;
                padding: 8px 14px;
                border: 1px solid rgb(219, 213, 213);
            }
        </style> -->

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
                    <li class="_navi_ele"><a class="nav-link" aria-current="page" href="index.php?controller=homepage&action=index">Trang chủ</a></li>
                    <li class="_navi_ele"><a class="nav-link" aria-current="page" href="index.php?controller=intro&action=index">Giới thiệu</a></li>
                    <li class="_navi_ele"><a class="nav-link" aria-current="page" href="index.php?controller=product&action=index">Sản phẩm</a></li>
                    <li class="_navi_ele"><a class="nav-link" aria-current="page" href="index.php?controller=post&action=index">Tin tức</a></li>
                    <li class="_navi_ele"><a class="nav-link" aria-current="page" href="index.php?controller=answerandquestion&action=index">Hỏi đáp</a></li>
                    <li class="_navi_ele"><a class="nav-link" aria-current="page" href="index.php?controller=contact&action=index">Liên hệ</a></li>

                </ul>
                <i style="display: none" class="fa-solid fa-bars"></i>

                <button class="btn btn-outline-dark">Login</button>

                <div class="_sidebar" id="sidebar">
                    <i onclick="handleCloseSidebar()" class="fa-solid fa-x"></i>
                    <div class="_sidebar-item"><a class="nav-link" aria-current="page" href="index.php?controller=homepage&action=index">Trang chủ</a></div>
                    <div class="_sidebar-item"><a class="nav-link" aria-current="page" href="index.php?controller=intro&action=index">Giới thiệu</a></div>
                    <div class="_sidebar-item"><a class="nav-link" aria-current="page" href="index.php?controller=product&action=index">Sản phẩm</a></div>
                    <div class="_sidebar-item"><a class="nav-link" aria-current="page" href="index.php?controller=post&action=index">Tin tức</a></div>
                    <div class="_sidebar-item"><a class="nav-link" aria-current="page" href="index.php?controller=answerandquestion&action=index">Hỏi đáp</a></div>
                    <div class="_sidebar-item"><a class="nav-link" aria-current="page" href="index.php?controller=contact&action=index">Liên hệ</a></div>
                </div>
            </nav>


            <?php include $viewFile; ?>

            <footer class="_footer">
                <section class="testimonial-section">
                    <div class="container d-flex justify-content-center gap-5 mg-10 text-center flex-wrap">
                        <div class="w-50">
                            <h2 class="section-title">Khách Hàng Nói Gì Về Chúng Tôi</h2>
                            <div class="stats d-flex justify-content-center gap-5 flex-wrap">
                                <div>
                                    <h3>10m+</h3>
                                    <p>Happy People</p>
                                </div>
                                <div>
                                    <h3>4.88</h3>
                                    <p>Overall rating</p>
                                    <div class="stars">★★★★★</div>
                                </div>
                            </div>
                        </div>


                        <!-- Đánh giá của khách hàng -->
                        <div class="testimonial">
                            <div class="d-flex gap-3">
                                <img src="https://picsum.photos/200/300" class="rounded-circle img-fluid" style="width: 50px; height: 50px; object-fit: cover;" alt="img">
                                <div class="text-start">
                                    <h4>Trần Thế Đại Phát</h4>
                                    <p class="sub-text">Người dùng lâu năm</p>
                                </div>
                            </div>

                            <p class="review-text">
                                Trải nghiệm tuyệt vời! Giao diện trực quan, dễ dàng tìm kiếm bất động sản phù hợp. Tôi đã tìm được ngôi nhà ưng ý chỉ trong vài phút.
                            </p>

                            <!-- Nút điều hướng -->
                            <div class="navigation">
                                <button class="btn-nav">&lt;</button>
                                <button class="btn-nav">&gt;</button>
                            </div>
                        </div>
                    </div>


                    <!-- Logo đối tác -->
                    <!-- <hr class="divider">
                    <p class="trusted-text">Thousands of world’s leading companies trust Space</p>
                    <div class="brands">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Amazon">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/AMD_Logo.svg" alt="AMD">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Cisco_logo.svg" alt="Cisco">
                        <img src="https://via.placeholder.com/100x40" alt="Dropcam">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Logitech_logo.svg" alt="Logitech">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Spotify_logo_with_text.svg" alt="Spotify">
                    </div> -->
                </section>
                <section>
                    <form class="container my-5 d-flex flex-column align-items-center text-center mw-100" style="width:400px;">
                        <h2 class="text-center">Đánh Giá Trang Web 🌟</h2>
                        <p class="text-center text-muted">Hãy cho chúng tôi biết cảm nhận của bạn về trang web này!</p>
                        <div class="rating ">
                            <input type="radio" id="star-1" name="star-radio" value="star-1">
                            <label for="star-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star-2" name="star-radio" value="star-1">
                            <label for="star-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star-3" name="star-radio" value="star-1">
                            <label for="star-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star-4" name="star-radio" value="star-1">
                            <label for="star-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star-5" name="star-radio" value="star-1">
                            <label for="star-5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                                </svg>
                            </label>
                        </div>
                        <textarea class="my-4" placeholder="Your message"></textarea>
                        <button class="button" type="button">
                            <div class="outline"></div>
                            <div class="state state--default">
                                <div class="icon">
                                    <svg
                                        width="1em"
                                        height="1em"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g style="filter: url(#shadow)">
                                            <path
                                                d="M14.2199 21.63C13.0399 21.63 11.3699 20.8 10.0499 16.83L9.32988 14.67L7.16988 13.95C3.20988 12.63 2.37988 10.96 2.37988 9.78001C2.37988 8.61001 3.20988 6.93001 7.16988 5.60001L15.6599 2.77001C17.7799 2.06001 19.5499 2.27001 20.6399 3.35001C21.7299 4.43001 21.9399 6.21001 21.2299 8.33001L18.3999 16.82C17.0699 20.8 15.3999 21.63 14.2199 21.63ZM7.63988 7.03001C4.85988 7.96001 3.86988 9.06001 3.86988 9.78001C3.86988 10.5 4.85988 11.6 7.63988 12.52L10.1599 13.36C10.3799 13.43 10.5599 13.61 10.6299 13.83L11.4699 16.35C12.3899 19.13 13.4999 20.12 14.2199 20.12C14.9399 20.12 16.0399 19.13 16.9699 16.35L19.7999 7.86001C20.3099 6.32001 20.2199 5.06001 19.5699 4.41001C18.9199 3.76001 17.6599 3.68001 16.1299 4.19001L7.63988 7.03001Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M10.11 14.4C9.92005 14.4 9.73005 14.33 9.58005 14.18C9.29005 13.89 9.29005 13.41 9.58005 13.12L13.16 9.53C13.45 9.24 13.93 9.24 14.22 9.53C14.51 9.82 14.51 10.3 14.22 10.59L10.64 14.18C10.5 14.33 10.3 14.4 10.11 14.4Z"
                                                fill="currentColor"></path>
                                        </g>
                                        <defs>
                                            <filter id="shadow">
                                                <fedropshadow
                                                    dx="0"
                                                    dy="1"
                                                    stdDeviation="0.6"
                                                    flood-opacity="0.5"></fedropshadow>
                                            </filter>
                                        </defs>
                                    </svg>
                                </div>
                                <p>
                                    <span style="--i:0">S</span>
                                    <span style="--i:1">e</span>
                                    <span style="--i:2">n</span>
                                    <span style="--i:3">d</span>
                                    <!-- <span style="--i:4">M</span>
                                <span style="--i:5">e</span>
                                <span style="--i:6">s</span>
                                <span style="--i:7">s</span>
                                <span style="--i:8">a</span>
                                <span style="--i:9">g</span>
                                <span style="--i:10">e</span> -->
                                </p>
                            </div>
                            <div class="state state--sent">
                                <div class="icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        height="1em"
                                        width="1em"
                                        stroke-width="0.5px"
                                        stroke="black">
                                        <g style="filter: url(#shadow)">
                                            <path
                                                fill="currentColor"
                                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"></path>
                                            <path
                                                fill="currentColor"
                                                d="M10.5795 15.5801C10.3795 15.5801 10.1895 15.5001 10.0495 15.3601L7.21945 12.5301C6.92945 12.2401 6.92945 11.7601 7.21945 11.4701C7.50945 11.1801 7.98945 11.1801 8.27945 11.4701L10.5795 13.7701L15.7195 8.6301C16.0095 8.3401 16.4895 8.3401 16.7795 8.6301C17.0695 8.9201 17.0695 9.4001 16.7795 9.6901L11.1095 15.3601C10.9695 15.5001 10.7795 15.5801 10.5795 15.5801Z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <p>
                                    <span style="--i:5">S</span>
                                    <span style="--i:6">e</span>
                                    <span style="--i:7">n</span>
                                    <span style="--i:8">t</span>
                                </p>
                            </div>
                        </button>
                    </form>
                </section>
                <section class="testimonial-section" style="padding: 60px 10% ; width:100vw;">
                    <div class="row d-flex justify-content-evenly">
                        <div class="col-md-6 text-start">
                            <h5>BKHome</h5>
                        </div>

                        <div class="col-md-6 text-end">
                            <span>Follow Us</span>
                            <div class="d-inline-block ms-2">
                                <i class="fa-brands fa-square-facebook"></i>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-instagram"></i>
                                <i class="fab fa-linkedin"></i>
                            </div>
                        </div>

                    </div>
                    <hr class="my-4">
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <h6>Khám Phá</h6>
                            <ul class="list-unstyled">
                                <li>Hồ Chí Minh</li>
                                <li>Hà Nội</li>
                                <li>Đà Nẵng</li>
                                <li>Hải Phòng</li>
                                <li>Cần Thơ</li>
                                <li>Phú Quốc</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h6>Truy Cập Nhanh</h6>
                            <ul class="list-unstyled">
                                <li>Chúng tôi là ai?</li>
                                <li>Liên Lạc</li>
                                <li>Tin tức</li>
                                <li>Blog</li>
                                <li>Dự Án</li>
                                <li>Chính sách cá nhân</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h6>Liên Hệ Với Chúng Tôi</h6>
                            <p>Email: bk.home@gmail.com</p>
                            <p>Điện thoại: (123) 456-7890</p>
                        </div>
                        <div class="col-md-3">
                            <h6>Địa chỉ của chúng tôi</h6>
                            <p>268, Lý Thường Kiệt, Quận 10, TP.HCM</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class=" text-center">
                            <p class="mb-0">Copyright © 2025. BKHome</p>
                        </div>
                    </div>
                </section>
            </footer>
        </main>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- JS chính -->
        <script src="/Views/template/script.js"></script>

        <!-- JS riêng -->
        <?php if (!empty($extraJS)): ?>
            <script src="<?= $extraJS ?>"></script>
        <?php endif; ?>

    </body>

    </html>
