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
        <!-- Style CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE?>/css/style.css" />

        <!-- Animation -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    </head>
    <body>
        <!-- Header -->
        <header class="header fixed">
            <div class="main-content">
                <div class="body">
                    <!-- Logo -->
                    <a href="#">
                        <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/logo (4).svg" alt="logo"
                    /></a>
                    <!-- Navbar -->
                    <nav class="nav">
                        <ul>
                            <li class="active_header">
                                <a href="#">Trang chủ</a>
                            </li>
                            <li class="">
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=course&action=lists' ?>">Khóa học</a>
                            </li>
                            <li class="">
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=lists' ?>">Blog</a>
                            </li>
                            <li class="">
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=contacts&action=page'?>">Liên hệ</a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Avtion -->
                    <div class="action">
                        <a href="?module=auth&action=loginClient" class="btn sign-up-btn">Sign In</a>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <!-- Hero -->
            <div class="hero">
                <div class="main-content">
                    <div class="body">
                        <!-- Hero-left -->
                        <div class="media-block">
                            <img
                                src="<?php echo _WEB_HOST_TEMPLATE?>/img/hero-image.png"
                                alt=""
                                data-aos="fade-down"
                                data-aos-easing="linear"
                                data-aos-duration="1500"
                            />
                            <div class="hero-sumary"  data-aos="fade-up" data-aos-duration="3000">
                                <div class="item">
                                    <div class="icon icon-1">
                                        <img
                                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/ui-ux.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div class="info">
                                        <p class="label">20 Courses</p>
                                        <p class="title">UI/UX Design</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="icon icon-2">
                                        <img
                                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/develop.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div class="info">
                                        <p class="label">20 Courses</p>
                                        <p class="title">Development</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="icon icon-3">
                                        <img
                                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/make.svg"
                                            alt=""
                                        />
                                    </div>
                                    <div class="info">
                                        <p class="label">30 Courses</p>
                                        <p class="title">Marketing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hero right -->
                        <div class="content-block" data-aos="fade-up"
                            data-aos-duration="3000">
                            <h1 class="heading lv1">
                                Learn without limits and spread knowledge.
                               
                            </h1>
                            <p class="desc">
                                Build new skills for that “this is my year”
                                feeling with courses, certificates, and degrees
                                from world-class universities and companies.
                            </p>
                            <div class="cta-group">
                                <a href="#!" class="btn btn-cta">
                                    See Courses
                                </a>
                                <button class="watch-video">
                                    <div class="icon">
                                        <img
                                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/play.svg"
                                            alt=""
                                        />
                                    </div>
                                    <span>Watch Video</span>
                                </button>
                            </div>
                            <p class="desc">Recent engagement</p>
                            <p class="desc stars">
                                <strong>50K</strong> Students
                                <strong>70+</strong> Courses
                            </p>
                        </div>
                    </div>
                </div>
            </div>