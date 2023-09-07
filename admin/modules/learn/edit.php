<?php
$data = [
    'pageTitle' => 'Cập nhật content'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Truy vấn lấy ra danh sách nhóm
$allCourse = getRaw("SELECT id, title FROM course ORDER BY id");


// Lấy dữ liệu cũ của người dùng
$body = getBody();

if(!empty($body['id'])) {

    $learnId = $body['id'];

    $learnDetail  = firstRaw("SELECT * FROM learn WHERE id=$learnId");

    
    if (!empty($learnDetail)) {
        setFlashData('learnDetail', $learnDetail);
    }else {
        redirect('admin/?module=learn&action=lists');
    }
}

// Xử lý sửa người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
    // Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['title']))) {
        $errors['title']['required'] = '** Bạn chưa content!';
    }else {
        if(strlen(trim($body['title'])) <= 5) {
        $errors['title']['min'] = '** Content phải lớn hơn 5 ký tự!';
        }
    }
   
   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataUpdate = [
        'title' => $body['title'],
        'course_id' => $body['course_id'],
        'update_at' => date('Y-m-d H:i:s'),
    ];

    /////////////////////////////////////
    $condition = "id=$learnId";

    $updateStatus = update('learn', $dataUpdate, $condition);
    if ($updateStatus) {
        setFlashData('msg', 'Cập nhật content thành công');
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

  redirect('admin/?module=learn&action=edit&id='.$learnId);

}
$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$learnDetail = getFlashData('learnDetail');

if (!empty($learnDetail) && empty($old)) {
    $old = $learnDetail;
}

?>

     <!-- Main content -->
     <section class="content">
     <div class="container-fluid">
           <form action="" method="post">
           <hr/>
               <?php echo getMsg($msg, $msgType);  ?>
               <div class="col-8">
                    <div class="form-group">
                        <label for="name">Content</label>
                        <input type="text" name="title" id="name" class="form-control slug" value="<?php echo old('title', $old); ?>">
                        <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                
                    <div class="form-group">
                        <label for="">Chọn khóa học</label>
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
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a style="margin-left: 20px " href="<?php  echo getLinkAdmin('learn', 'lists') ?>" class="btn btn-success">Quay lại trang danh sách</a>
                        <input type="hidden" name="id" value="<?php echo $learnId; ?>">
                    </div>
                </div>    
                       
         
           </form>
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->

<?php
layout('footer', 'admin');