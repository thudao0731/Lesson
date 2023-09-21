<?php

$checkLogin = isLogin();

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}


/// Xử lý phân trang
$allBlog = getRows("SELECT id FROM blog");
// 1. Xác định số lượng bản ghi trên 1 trang
$perPage = 9; // Mỗi trang có 3 bản ghi

//2. Tính số trang
$maxPage = ceil($allBlog / $perPage);

// 3. Xử lý số trang dựa vào phương thức GET
if(!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if($page < 1 and $page > $maxPage) {
        $page = 1;
    }
}else {
    $page = 1;
}

$offset = ($page - 1) * $perPage;

// Lấy dứ liệu blog
$listblog = getRaw("SELECT * FROM blog WHERE status = 1 ORDER BY create_at DESC LIMIT $offset, $perPage ");

// Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog','', $queryString);
    $queryString = str_replace('&page='.$page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&'.$queryString;
}

?>
     <!-- Blog -->

     <div class="blog blog-page" id="blog">
                <div class="main-content">
                    <div class="blog-top">
                        <h2 class="heading lv2">Blog của chúng tôi</h2>
                        <p class="desc">
                            Tổng hợp các bài viết chia sẻ về kinh nghiệm tự học lập trình online và các kỹ thuật lập trình web.
                        </p>
                    </div>
                    <div class="blog-list page">
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
                        
                    <!-- <div class="dots">
                        <span class="dot"></span>
                        <span class="dot active"></span>
                        <span class="dot"></span>
                    </div> -->
                </div>

                <nav>
                    <ul class="pagination">
                        <?php
                            if($page > 1) {
                                $prePage = $page - 1;
                            echo '<li class="pagination-item"><a class="pagination-item__link" href="'._WEB_HOST_ROOT.'/?module=blog'.$queryString. '&page='.$prePage.'"><i class="pagination-item__icon"> << </i></a></li>';
                            }
                        ?>


                        <?php 
                            // Giới hạn số trang
                            $begin = $page - 5;
                            $end = $page + 5;
                            if($begin < 1) {
                                $begin = 1;
                            }
                            if($end > $maxPage) {
                                $end = $maxPage;
                            }
                            for($index = $begin; $index <= $end; $index++){  ?>
                        <li class="pagination-item <?php echo ($index == $page) ? 'pagination-item__active' : false; ?> ">
                            <a class="pagination-item__link" href="<?php echo _WEB_HOST_ROOT.'?module=blog'.$queryString.'&page='.$index;  ?>"> <?php echo $index;?> </a>
                        </li>
                        <?php  } ?>
                        
                        <?php
                            if($page < $maxPage) {
                                $nextPage = $page + 1;
                                echo '<li class="pagination-item"><a class="pagination-item__link" href="'._WEB_HOST_ROOT.'?module=blog'.$queryString.'&page='.$nextPage.'"><i class="pagination-item__icon"> >> </i></a></li>';
                            }
                        ?>
                    </ul>
                </nav>
               
            </div>
<?php
layout('footer', 'client');