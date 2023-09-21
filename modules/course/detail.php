<?php

if(!empty(getBody()['id'])) {

    $id = getBody()['id'];

   

    $chapterCount = getRows("SELECT id FROM chapter WHERE course_id = '$id'");
    $lessonCount = getRows("SELECT id FROM lesson WHERE course_id = '$id'");

    $chapter = getRaw("SELECT * FROM chapter WHERE course_id = '$id'");

    // $listLesson = getRaw("SELECT * FROM lesson WHERE course_id = '$id'");

    $courseDetail = firstRaw("SELECT * FROM course WHERE id='$id'");
    $listLesson = getRaw("SELECT lesson.id, lesson.name, lesson.chapter_id FROM lesson INNER JOIN chapter ON lesson.chapter_id = chapter.id WHERE lesson.course_id = '$id'");
        
    $courseLearn = getRaw("SELECT * FROM learn WHERE course_id = '$id'");
    if(empty($courseDetail)) {
        loadErrors();
    }
    
}else {
    loadErrors(); // load giao diện 404
}


$checkLogin = isLogin();

if(!empty($checkLogin)) {
    $userId = isLogin()['user_id'];
    $checkOrder = getRaw("SELECT * FROM ordercourse WHERE course_id = $id AND user_id = $userId AND status=1");
}

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}
?>
    <div class="main-content">
        <div class="course--detail">
            <div class="course--detail__content">
                <div class="course--detail__title">
                    <h1 class="heading"><?php echo $courseDetail['title'] ?></h1>
                    <p class="desc"><?php echo $courseDetail['description'] ?></p>
                </div>

                <div class="course--detail__learn">
                    <h2>Bạn sẽ học được gì?</h2>
                    <?php foreach($courseLearn as $item): ?>
                    <ul>
                        <li><?php  echo $item['title']?></li>
                    </ul>
                    <?php endforeach; ?>
                </div>

                <div class="course--detail__listCourse">
                    <h2>Nội dung khóa học</h2>
                    <div class="list">
                        <p><?php echo $chapterCount.' chương' ?></p>
                        <p class="floor">-</p>
                        <p><?php echo $lessonCount.' bài học' ?></p>
                        <p class="floor">-</p>
                        <p>10 bài tập</p>
                    </div>                
                </div>

                <div class="listLesson">              
                        <?php foreach($chapter as $chapterItem):?>
                            <button class="chapter"><?php echo $chapterItem['name']; ?></button>
                            <div class="panel">
                                <?php 
                                    if(!empty($listLesson)):
                                        $count = 0;                
                                    foreach($listLesson as  $lessonItem):?>
                                        <?php $count++; ?>
                                        <div class="lesson-item">
                                            <?php if(!empty($checkLogin) && !empty($checkOrder)) { ?>
                                                <a href="<?php echo getLinkClient('course','learning',['id' => $lessonItem['id']]); ?>"><?php echo ($lessonItem['chapter_id'] == $chapterItem['id'])?'<p>Bài '.$count.': '.$lessonItem['name'].'</p> <br />':false ?></a>  
                                            <?php } else { ?>
                                                <p><?php echo ($lessonItem['chapter_id'] == $chapterItem['id'])?'<p>Bài '.$count.': '.$lessonItem['name'].'</p> <br />':false ?></p>
                                            <?php } ?>
                                        </div>                     
                                <?php  endforeach; ?>  
                                <?php endif; ?>                      
                            </div>
                        <?php  endforeach; ?>
                </div>

                <div class="course--detail__required">
                    <h2>Yêu cầu cần có của học viên</h2>
                    <ul>
                        <li>Máy tính kết nối internet (từ Windowns 10 trở lên)</li>
                        <li>Ý thức cao, trách nhiệm cao trong việc tự học. Thực hành lại sau mỗi bài học</li>
                        <li>Khi học nếu có khúc mắc hãy tham gia hỏi đáp tại group Facebook</li>
                        <li>Bạn không cần biết gì hơn nữa, trong khóa học tôi sẽ chỉ cho bạn những gì bạn cần phải biết</li>
                        
                    </ul>
                </div>
            </div>
            <div class="course--detail__image">
                <div class="course-detail_image">
                    <img src="<?php  echo $courseDetail['thumbnail'] ?>" alt="" class="course--detail__thumb">
                </div>

                <div class="course-detail_image">
                    <img src="<?php echo _WEB_HOST_TEMPLATE ?>/img/ban1.png" alt="" class="course--detail__thumb2">
                </div>
                
                <?php  
                    if(!empty($checkLogin)) {
                ?>
                        <a href="<?php echo getLinkClient('course','order', ['id' => $id]) ?>" class="btn">Mua khóa học</a>
                <?php
                    } else {
                        ?>
                        <a href="<?php echo getLinkClient('auth', 'loginClient')?>" class="btn">Mua khóa học</a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
<?php
layout('footer', 'client');