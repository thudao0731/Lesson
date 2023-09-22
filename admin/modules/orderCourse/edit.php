<?php

if(!defined('_INCODE'))
die('Access denied...');


$data = [
    'pageTitle' => 'Cập nhật đơn hàng'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);



// Truy vấn lấy ra danh sách nhóm
$allCourse = getRaw("SELECT id, title FROM course ORDER BY id");

$allEmailUser = getRaw("SELECT id, email FROM users");

// Xử lý hiện dữ liệu cũ của người dùng
$body = getBody();
if(!empty($body['id'])) {
    $orderCourseId = $body['id'];
   
    $orderCourseDetail  = firstRaw("SELECT * FROM orderCourse WHERE id=$orderCourseId");
    if (!empty($orderCourseDetail)) {
        // Tồn tại
        // Gán giá trị orderCourseDetail vào setFalsh
        setFlashData('orderCourseDetail', $orderCourseDetail);
    
    }else {
    redirect('admin/?module=orderCourse&action=lists');
    }
}


// Xử lý sửa người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataUpdate = [
        'course_id' => $body['course_id'],
        'user_id' => $body['user_id'],
        'status' => $body['status'],
    ];

    /////////////////////////////////////
    $condition = "id=$orderCourseId";
    $updateStatus = update('orderCourse', $dataUpdate, $condition);
    if ($updateStatus) {
        setFlashData('msg', 'Cập nhật đơn hàng thành công');
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

  redirect('admin/?module=orderCourse&action=edit&id='.$orderCourseId);

}
$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
// $orderCourseDetail = getFlashData('orderCourseDetail');

if (!empty($orderCourseDetail) && empty($old)) {
    $old = $orderCourseDetail;
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
                        <label for="">Email kích hoạt</label>
                        <select name="user_id" id="" class="form-control">
                            <option value="">Chọn Email</option>
                            <?php

                                if(!empty($allEmailUser)) {
                                    foreach($allEmailUser as $item) {
                                ?>
                                    <option value="<?php echo $item['id'] ?>" <?php  echo (old('user_id', $old) == $item['id'])?'selected':false; ?>><?php echo $item['email'] ?></option> 
                                
                                <?php
                                    }
                                }
                                ?>
                        </select>
                        <?php echo form_error('user_id', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="">Chọn trạng thái</option>
                            <option value="0" <?php echo (old('status', $old) == 0) ? 'selected':false; ?>>Not Active</option>
                            <option value="1" <?php echo (old('status', $old) == 1) ? 'selected':false; ?>>Active</option>
                        </select>
                    </div>

                </div>             
            </div>
            <div class="col">
                <div class="row">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a style="margin-left: 40px " href="?module=orderCourse&action=lists" class="btn btn-success">Quay lại danh sách</a>
                    <input type="hidden" name="id" value="<?php echo $orderCourseId; ?>">
                </div>
            </div>
        </form>
    </div>


<?php
layout('footer', 'admin');





