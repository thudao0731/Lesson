<?php

if(!empty(getBody()['id'])) {
    $id = getBody()['id'];

$blogDetail = firstRaw("SELECT * FROM blog WHERE id='$id'");
$userId = $blogDetail['user_id'];
$infoUsers = firstRaw("SELECT users.thumbnail, fullname FROM users WHERE id = '$userId'");
    
    
}else {
    loadErrors(); // load giao diện 404
}

    layout('navbar', 'client');

?>
   <div class="main-blog">
        <div class="blog-detail">
            <h2 class="heading title-blog"><?php echo $blogDetail['title']; ?></h2>
            <div class="info-up">
                <div class="">
                    <img src="<?php echo $infoUsers['thumbnail'] ?>" alt="" class="avatar">
                    <img src="<?php echo _WEB_HOST_ROOT ?>/templates/client/img/king.svg" alt="" class="king">
                </div>
                <h3 class="heading lv3 fullname"><?php echo $infoUsers['fullname'] ?></h3>
            </div>
            <?php  echo html_entity_decode($blogDetail['content']) ?>
        </div>
   </div>
<?php
layout('footer', 'client');