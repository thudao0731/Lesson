<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
    'pageTitle' => 'Tổng quan'
];

// Truy vấn database
$listCourse = getRaw("SELECT * FROM course");

$listblog = getRaw("SELECT * FROM blog WHERE status = 1 ORDER BY create_at DESC LIMIT 6");

$checkLogin = isLogin();

    if (!empty($checkLogin)) {
        layout('header', 'client');
       
    }else {
        layout('headerPre', 'client');
    }


?>

        <main>
            <!-- Popular -->
            <div class="popular" id="popular">
                <div class="main-content">
                    <div class="popular-top" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                        <div class="info">
                            <h2 class="heading lv2">Our popular courses</h2>
                            <p class="desc">
                                Build new skills with new trendy courses and
                                shine for the next future career.
                            </p>
                        </div>
                        <div class="controls">
                            <button class="controls-btn">
                                <img
                                    src="<?php echo _WEB_HOST_TEMPLATE?>/img/chevron-left.svg"
                                    alt=""
                                />
                            </button>
                            <button class="controls-btn">
                                <img
                                    src="<?php echo _WEB_HOST_TEMPLATE?>/img/chevron-right.svg"
                                    alt=""
                                />
                            </button>
                        </div>
                    </div>
                    <!-- Course List -->
                    <div class="course-list" data-aos="fade-up" data-aos-duration="3000">
                        <!-- Course item 1 -->
                        <?php
                            if(!empty($listCourse)):
                        ?>
                        <?php foreach($listCourse as $item): ?>
                        <div class="course-item">
                            <a href="<?php echo _WEB_HOST_ROOT.'?module=course&action=detail&id='.$item['id']; ?>"
                                ><img
                                    src="<?php echo $item['thumbnail'] ?>"
                                    alt=""
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <a href="<?php echo _WEB_HOST_ROOT.'?module=course&action=detail&id='.$item['id']; ?>"
                                        ><h3 class="title line-clamp break-all">
                                            <?php echo $item['title'] ?>
                                        </h3>
                                    </a>
                                    <div class="rating">
                                        <img
                                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/star.svg"
                                            alt="star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc break-all">
                                    <?php echo $item['description'] ?>
                                </p>
                                <div class="foot">
                                    <span class="price"><?php echo $item['price'] ?></span>
                                    <a href="<?php echo _WEB_HOST_ROOT.'?module=course&action=detail&id='.$item['id']; ?>" class="btn book-btn">
                                        Join Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info text-center">Chưa có khóa học</div>
                        <?php  endif; ?>
                    </div>
                </div>

                <!-- Feed Back -->
                <div class="feedback">
                    <div class="main-content">
                        <div class="feedback-list" data-aos="fade-right">
                            <!-- feedback item 1
                            <div class="feedback-item">
                                <div class="info">
                                    <img
                                        src="<?php echo _WEB_HOST_TEMPLATE?>/img/Ellipse 2649.jpg"
                                        alt="feedback-avatar"
                                        class="avatar"
                                    />
                                    <p class="title">Peter Moor</p>
                                    <p class="desc">Student of Web Design</p>
                                    <div class="dots">
                                        <span class="dot active"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <img
                                        src="<?php echo _WEB_HOST_TEMPLATE?>/img/open-quotes.svg"
                                        alt=""
                                        class="open-quotes"
                                    />
                                    <blockquote>
                                        Not only does my resume look
                                        impressive—filled with the names and
                                        logos of world-class institutions—but
                                        these certificates also bring me closer
                                        to my career goals by validating the
                                        skills I've learned."
                                    </blockquote>
                                </div>
                            </div> -->
                            <!-- feedback item 2 -->
                            <div class="feedback-item">
                                <div class="info">
                                    <img
                                        src="<?php echo _WEB_HOST_TEMPLATE?>/img/feedback-02.jpg"
                                        alt="feedback-avatar"
                                        class="avatar"
                                    />
                                    <p class="title">Phuong Thao</p>
                                    <p class="desc">Student of Web Design</p>
                                    <div class="dots">
                                        <span class="dot"></span>
                                        <span class="dot active"></span>
                                        <span class="dot"></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <img
                                        src="<?php echo _WEB_HOST_TEMPLATE?>/img/open-quotes.svg"
                                        alt=""
                                        class="open-quotes"
                                    />
                                    <blockquote>
                                        Not only does my resume look
                                        impressive—filled with the names and
                                        logos of world-class institutions—but
                                        these certificates also bring me closer
                                        to my career goals by validating the
                                        skills I've learned."
                                    </blockquote>
                                </div>
                            </div>
                            <!-- feedback item 3 -->
                            <div class="feedback-item">
                                <div class="info">
                                    <img
                                        src="<?php echo _WEB_HOST_TEMPLATE?>/img/feedback-03.jpg"
                                        alt="feedback-avatar"
                                        class="avatar"
                                    />
                                    <p class="title">Dao Thu</p>
                                    <p class="desc">Student of Web Design</p>
                                    <div class="dots">
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot active"></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <img
                                        src="<?php echo _WEB_HOST_TEMPLATE?>/img/open-quotes.svg"
                                        alt=""
                                        class="open-quotes"
                                    />
                                    <blockquote>
                                        Not only does my resume look
                                        impressive—filled with the names and
                                        logos of world-class institutions—but
                                        these certificates also bring me closer
                                        to my career goals by validating the
                                        skills I've learned."
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <!-- feedback item 1 -->
                    </div>
                </div>

               
                <!-- Feature 1-->
                <div class="feature">
                    <div class="main-content">
                        <div class="body">
                            <div class="feature-image">
                                <img
                                    src="<?php echo _WEB_HOST_TEMPLATE?>/img/feature-01.jpg"
                                    alt=""
                                    class="feature-1"
                                    data-aos="zoom-in-up"
                                />
                                <img
                                    src="<?php echo _WEB_HOST_TEMPLATE?>/img/image2.jpg"
                                    alt=""
                                    class="feature-2"
                                    data-aos="zoom-in-up"
                                />
                            </div>
                            <div class="info" data-aos="zoom-in-up">
                                <h2 class="heading lv2">
                                    Learner outcomes through our awesome
                                    platform
                                </h2>
                                <p class="desc">
                                    87% of people learning for professional
                                    development report career benefits like
                                    getting a promotion, a raise, or starting a
                                    new career.
                                </p>
                                <p class="desc">Lesson Impact Report (2022)</p>
                                <a href="<?php echo _WEB_HOST_ROOT.'?module=auth&action=loginClient'?>" class="btn feature-btn">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2-->
                <div class="feature feature-2nd">
                    <div class="main-content">
                        <div class="body">
                            <div class="info" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                                <h2 class="heading lv2">
                                    Take the next step toward your personal and
                                    professional goals with Lesson.
                                </h2>
                                <p class="desc">
                                    Take the next step toward. Join now to
                                    receive personalized and more
                                    recommendations from the full Coursera
                                    catalog.
                                </p>
                                <a href="#!" class="btn feature-btn"
                                    >Join Now</a
                                >
                            </div>

                            <div class="feature2-image" data-aos="flip-up">
                                <img
                                    src="<?php echo _WEB_HOST_TEMPLATE?>/img/feature-06.jpg"
                                    alt=""
                                    class=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog -->
            <div class="blog" id="blog">
                <div class="main-content">
                    <div class="blog-top" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1000">
                        <h2 class="heading lv2">Our Blog</h2>
                        <p class="desc">
                            Read our regular travel blog and know the latest
                            update of tour and travel
                        </p>
                    </div>
                    <div class="blog-list" data-aos="fade-up" data-aos-duration="2000">
                        <!-- Item 1 -->
                        <?php foreach($listblog as $item): ?>
                        <div class="item">
                            <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$item['id']; ?>"
                                ><img
                                    src="<?php echo $item['thumbnail'] ?>"
                                    alt=""
                                    class="thumb"
                            /></a>
                            <div class="info">
                                <span class="date">21 November 2021</span>
                                <h3 class="title">
                                    <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$item['id']; ?>" class="line-clamp"><?php echo $item['title'] ?></a>
                                </h3>
                                <a class="btn" href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$item['id']; ?>">Read More</a>
                            </div>
                        </div>
                        <?php endforeach; ?>                                                                             
                    </div>
                    <div class="dots">
                        <span class="dot"></span>
                        <span class="dot active-blog"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
        </main>
<?php

layout('footer', 'client');

