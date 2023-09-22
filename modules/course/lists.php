<?php
$data = [
    'pageTitle' => 'Danh sách Blog'
];

$checkLogin = isLogin();

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}



$listCourse = getRaw("SELECT * FROM course");

?>
    
    <div class="popular course-list">
        <div class="main-content">
                    <div class="popular-top">
                        <div class="info">
                            <h2 class="heading lv2">Our popular courses</h2>
                            
                        </div>
                    </div>
                    <!-- Course List -->
                    <div class="course-list">
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
    </div>
<?php
layout('footer', 'client');