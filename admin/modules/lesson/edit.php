<?php

if(!defined('_INCODE'))
die('Access denied...');


$data = [
    'pageTitle' => 'Cập nhật bài học'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);



// Truy vấn lấy ra danh sách nhóm
$allCourse = getRaw("SELECT id, title FROM course ORDER BY id");

$allChapter = getRaw("SELECT id, name FROM chapter ORDER BY id");

// Xử lý hiện dữ liệu cũ của người dùng
$body = getBody();
if(!empty($body['id'])) {
    $lessonId = $body['id'];
   
    $lessonDetail  = firstRaw("SELECT * FROM lesson WHERE id=$lessonId");
    if (!empty($lessonDetail)) {
        // Tồn tại
        // Gán giá trị lessonDetail vào setFalsh
        setFlashData('lessonDetail', $lessonDetail);
    
    }else {
    redirect('admin/?module=lesson&action=lists');
    }
}


// Xử lý sửa người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
    // Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = '** Bạn chưa nhập tên bài học!';
    }else {
        if(strlen(trim($body['name'])) <= 5) {
        $errors['name']['min'] = '** Tên bài học phải lớn hơn 5 ký tự!';
        }
    }

   
   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataUpdate = [
        'name' => $body['name'],
        'video' => $body['video'],
        'course_id' => $body['course_id'],
        'chapter_id' => $body['chapter_id'],
        'update_at' => date('Y-m-d H:i:s'),
    ];

    /////////////////////////////////////
    $condition = "id=$lessonId";
    $updateStatus = update('lesson', $dataUpdate, $condition);
    if ($updateStatus) {
        setFlashData('msg', 'Cập nhật bài học thành công');
        setFlashData('msg_type', 'success');
    }else {
    setFlashData('msg', 'Hệ thống đang gặp sự cố, vui lòng thử lại sau');
    setFlashData('msg_type', 'danger');
}

  }else {
    // Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra chính xác thông tin nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);  // giữ lại các trường dữ liệu hợp lê khi nhập vào
  }

  redirect('admin/?module=lesson&action=edit&id='.$lessonId);

}
$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
// $lessonDetail = getFlashData('lessonDetail');

if (!empty($lessonDetail) && empty($old)) {
    $old = $lessonDetail;
}

?>
    <div class="container">
        <hr/>
        <?php
            getMsg($msg, $msgType);
        ?>

        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">Tên bài học</label>
                        <input type="text" name="name" id="" class="form-control" value="<?php echo old('name', $old); ?>">
                        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Video</label>
                        <input type="text" name="video" id="name" class="form-control slug" value="<?php echo old('video', $old); ?>">
                        <?php echo form_error('video', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Khóa học</label>
                        <select name="course_id" id="" class="form-control">
                            <option value="">Chọn khóa học</option>
                            <?php

                                if(!empty($allCourse)) {
                                    foreach($allCourse as $item) {
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php  echo (old('course_id', $old) == $item['id'])?'selected':false; ?>><?php echo $item['title'] ?></option> 
                                
                                <?php
                                    }
                                }
                                ?>
                        </select>
                        <?php echo form_error('course_id', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="">Chương học</label>
                        <select name="chapter_id" id="" class="form-control">
                            <option value="">Chọn chương học</option>
                            <?php

                                if(!empty($allChapter)) {
                                    foreach($allChapter as $item) {
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php  echo (old('chapter_id', $old) == $item['id'])?'selected':false; ?>><?php echo $item['name'] ?></option> 
                                
                                <?php
                                    }
                                }
                                ?>
                        </select>
                        <?php echo form_error('chapter_id', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                </div>             
            </div>
            <div class="col">
                <div class="row">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a style="margin-left: 40px " href="?module=lesson&action=lists" class="btn btn-success">Quay lại danh sách</a>
                    <input type="hidden" name="id" value="<?php echo $lessonId; ?>">
                </div>
            </div>
        </form>
    </div>


<?php
layout('footer', 'admin');





