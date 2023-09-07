<?php

if(!defined('_INCODE'))
die('Access denied...');


$data = [
    'pageTitle' => 'Thêm chương học'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Truy vấn lấy ra danh sách nhóm
$allCourse = getRaw("SELECT id, title FROM course ORDER BY id");

// Xử lý thêm người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
    // Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = '** Bạn chưa nhập tên chương học!';
    }else {
        if(strlen(trim($body['name'])) <= 5) {
        $errors['name']['min'] = '** Tên chương học phải lớn hơn 5 ký tự!';
        }
    }

   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataInsert = [
        'name' => $body['name'],
        'course_id' => $body['course_id'],
        'create_at' => date('Y-m-d H:i:s'),
    ];

    $insertStatus = insert('chapter', $dataInsert);
    if ($insertStatus) {
        setFlashData('msg', 'Thêm chương học thành công');
        setFlashData('msg_type', 'success');
        redirect('admin/?module=chapter&action=lists');
    }else {
    setFlashData('msg', 'Hệ thống đang gặp sự cố, vui lòng thử lại sau');
    setFlashData('msg_type', 'danger');
    redirect('admin/?module=chapter&action=add'); 
    }

  }else {
    // Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra chính xác thông tin nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);  // giữ lại các trường dữ liệu hợp lê khi nhập vào
    redirect('admin/?module=chapter&action=add'); 
  }

}
$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
   

?>
    <div class="container">
        <hr/>
        <?php
            getMsg($msg, $msgType);
        ?>

        <form action="" method="post">
                <div class="col-8">

                    <div class="form-group">
                        <label for="name">Tên chương học</label>
                        <input type="text" name="name" id="name" class="form-control slug" value="<?php echo old('name', $old); ?>">
                        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                
                    <div class="form-group">
                        <select name="course_id" id="" class="form-control">
                        <option value="">Chọn khóa học</option>
                        <?php

                            if(!empty($allCourse)) {
                                foreach($allCourse as $item) {
                            ?>
                                <option value="<?php echo $item['id'] ?>" <?php  echo (!empty($courseId) && $courseId == $item['id'])?'selected':false; ?>><?php echo $item['title'] ?></option> 
                            
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-8">
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Thêm khóa học</button>
                            <a style="margin-left: 20px " href="<?php echo getLinkAdmin('chapter', 'lists') ?>" class="btn btn-success">Quay lại trang danh sách</a>
                        </div>
                    </div>
                </div>              
        </form>
    </div>


<?php
layout('footer', 'admin');





