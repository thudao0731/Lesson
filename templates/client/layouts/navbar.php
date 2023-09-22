<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lesson</title>
        <!-- Favicon -->
        <link
            rel="apple-touch-icon"
            sizes="57x57"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-57x57.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="60x60"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-60x60.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="72x72"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-72x72.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-76x76.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="114x114"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-114x114.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="120x120"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-120x120.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="144x144"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-144x144.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="152x152"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-152x152.png"
        />
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/apple-icon-180x180.png"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="192x192"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/android-icon-192x192.png"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/favicon-32x32.png"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="96x96"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/favicon-96x96.png"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/favicon-16x16.png"
        />
        <link rel="manifest" href="<?php echo _WEB_HOST_TEMPLATE?>/favicon/manifest.json" />
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta
            name="msapplication-TileImage"
            content="<?php echo _WEB_HOST_TEMPLATE?>/favicon/ms-icon-144x144.png"
        />
        <meta name="theme-color" content="#ffffff" />
        <!-- Reset CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/reset.css" />
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,400&family=Sen:wght@700&display=swap"
            rel="stylesheet"
        />

        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/js/bootstrap.min.js">
        <!-- Style CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/style.css" />
         <!-- Font Awesome -->
         <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/plugins/fontawesome-free/css/all.min.css">
         
        
        <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/ckfinder/ckfinder.js"></script>

    </head>
    <body>
        <!-- Header -->
        <header class="header fixed">
            <div class="main-content">
                <div class="body">
                    <!-- Logo -->
                    <a href="?module=home&action=lists">
                        <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/logo (4).svg" alt="logo"
                    /></a>
                    <!-- Navbar -->
                    <nav class="nav">
                        <ul>
                            <li class="menu-item active_header">
                                <a href="<?php echo _WEB_HOST_ROOT ?>">Trang chủ</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=course&action=lists' ?>">Khóa học</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=lists' ?>">Blog</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=contacts&action=page'?>">Liên hệ</a>
                            </li>
                        </ul>
                    </nav>
                    <?php
                        $userId = isLogin()['user_id'];
                        $userDetail = getUserInfo($userId); // Lấy thông tin người dùng
                    ?>
                    <!-- Info -->
                    <div class="dropdown-header">
                        <div class="info_Login">
                            <a href="#!"><img src="<?php echo $userDetail['thumbnail'] ?>" alt="" class="avatar-header"></a>
                            <img src="<?php echo _WEB_HOST_ROOT ?>/templates/client/img/king.svg" alt="" class="king">
                        </div>
                        <div class="dropdown-content">
                            <a href="#">Trang cá nhân</a>
                            <a href="#">Cài đặt</a>
                            <a href="?module=auth&action=loginClient">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="add-blog">
                <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=addClient' ?>">
                    <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/add.png" class="icon-addBlog" alt="">
                </a>
            </div>

            <div class="message">
                <a href="https://www.messenger.com/t/100010590132155" target="_blank">
                    <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/mes4.png" class="icon-mes" alt="">
                </a>
            </div>

            <div class="zalo">
                <a href="https://chat.zalo.me/" target="_blank">
                    <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/zalo.png" class="icon-zalo" alt="">
                </a>
            </div>
        <main>

