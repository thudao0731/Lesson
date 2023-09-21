<?php


$checkLogin = isLogin();

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}
$body = getBody();

$id = $body['id'];



$chapter = getRaw("SELECT * FROM chapter WHERE course_id = '$id'");
$listLesson = getRaw("SELECT lesson.id, lesson.name, lesson.chapter_id FROM lesson INNER JOIN chapter ON lesson.chapter_id = chapter.id");

// Xác định bài học hiện tại dựa trên tham số trong URL
if (isset($_GET['id'])) {
    $lessonId = $_GET['id'];
} else {
    // Nếu không có tham số id, mặc định hiển thị bài học đầu tiên
    $lessonId = 1;
}

// Lấy bài học hiện tại
$linkVideo = firstRaw("SELECT id, name, video, course_id FROM lesson WHERE id = '$lessonId'");
// Lấy ra ID khóa học hiện tại
$courseId =  $linkVideo['course_id'];

// Truy vấn cơ sở dữ liệu để lấy thông tin về bài học trước và bài học tiếp theo
$sqlPrevious = firstRaw("SELECT id, name, video, course_id FROM lesson WHERE id < $lessonId AND course_id = $courseId ORDER BY id DESC LIMIT 1");

$sqlNext = firstRaw("SELECT id, name, video FROM lesson WHERE id > $lessonId AND course_id = $courseId ORDER BY id ASC LIMIT 1");
?>   
        <main style="height: 700px;">

            <div class="main-content">
                <div class="learning-inner">
                                      
                    <div class="learning-media">
                                <h2 class="nameLesson">Bài: <?php echo $linkVideo['name'] ?></h2>
                            <div class="learning-video">
                                <video controls>
                                    <source src="<?php echo $linkVideo['video'] ?>" type="video/mp4">
                                </video>
                            </div>
                               
                        <div class="spacing-line"></div>

                        <div class="pagination-action">
                            <?php
                                    // Hiển thị liên kết đến bài học trước và bài học tiếp theo
                                    if ($sqlPrevious) {
                                        echo "<a class='btn btn-action' href='?module=course&action=learning&id={$sqlPrevious['id']}'>Bài học trước</a>";
                                    }
                                    if ($sqlNext) {
                                        echo "<a class='btn btn-action' href='?module=course&action=learning&id={$sqlNext['id']}'>Bài học tiếp theo</a>";
                                    }
                            ?>
                        </div>
                    </div>

                    <div class="learning-resources">
                        <h2 class="heading title-resources">Tài nguyên bài học</h2>
                        <div class="resources-list">
                            
                            <ul>
                                <li>Html video tag w3school</li>
                                <li>https://www.w3schools.com/cssref</li>
                                <li>https://www.w3schools.com/cssref</li>
                                <li>https://www.favicongenerator.org/</li>
                                <li>https://www.favicongenerator.org/</li>
                            </ul>
                         
                        </div>
                    </div>
                </div>

            </div>
            </div>
                
        </main> 
<?php

layout('footer', 'client');

