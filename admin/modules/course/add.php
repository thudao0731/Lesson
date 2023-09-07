<?php

if(!defined('_INCODE'))
die('Access denied...');


$data = [
    'pageTitle' => 'Thêm khóa học'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Xử lý thêm người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
    // Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['title']))) {
        $errors['title']['required'] = '** Bạn chưa nhập tên khóa học!';
    }else {
        if(strlen(trim($body['title'])) <= 5) {
        $errors['title']['min'] = '** Tên khóa học phải lớn hơn 5 ký tự!';
        }
    }
   
   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataInsert = [
        'thumbnail' => $body['thumbnail'],
        'title' => $body['title'],
        'description' => $body['description'],
        'price' => $body['price'],
        'create_at' => date('Y-m-d H:i:s'),
    ];

    $insertStatus = insert('course', $dataInsert);
    if ($insertStatus) {
        setFlashData('msg', 'Thêm khóa học thành công');
        setFlashData('msg_type', 'success');
        redirect('admin/?module=course&action=lists');
    }else {
    setFlashData('msg', 'Hệ thống đang gặp sự cố, vui lòng thử lại sau');
    setFlashData('msg_type', 'danger');
    redirect('admin/?module=course&action=add'); 
    }

  }else {
    // Có lỗi xảy ra
    setFlashData('msg', 'Vui lòng kiểm tra chính xác thông tin nhập vào');
    setFlashData('msg_type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);  // giữ lại các trường dữ liệu hợp lê khi nhập vào
    redirect('admin/?module=course&action=add'); 
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
                        <label for="name">Ảnh</label>
                        <div class="row ckfinder-group">
                            <div class="col-8">
                                <input type="text" name="thumbnail" id="name" class="form-control image-render" value="<?php echo old('thumbnail', $old); ?>">   
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-success choose-image">Chọn ảnh</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Tên khóa học</label>
                        <input type="text" name="title" id="name" class="form-control slug" value="<?php echo old('v', $old); ?>">
                        <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Mô tả ngắn</label>
                        <textarea name="description" class="form-control"><?php echo old('description', $old); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="name">Giá</label>
                        <input type="text" name="price" id="name" class="form-control slug" value="<?php echo old('price', $old); ?>">
                        <?php echo form_error('price', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                    <div class="form-group col-8">
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Thêm khóa học</button>
                            <a style="margin-left: 20px " href="<?php echo getLinkAdmin('course', 'lists') ?>" class="btn btn-success">Quay lại trang danh sách</a>
                        </div>
                    </div>
                </div>              
        </form>
    </div>


<?php
layout('footer', 'admin');





