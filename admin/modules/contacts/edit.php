<?php
$data = [
    'pageTitle' => 'Cập nhật liên hệ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);



// Lấy dữ liệu cũ của người dùng
$body = getBody();

if(!empty($body['id'])) {

    $contactsId = $body['id'];

    $contactsDetail  = firstRaw("SELECT * FROM contacts WHERE id=$contactsId");

    
    if (!empty($contactsDetail)) {
        setFlashData('contactsDetail', $contactsDetail);
    }else {
        redirect('admin/?module=contacts&action=lists');
    }
}

// Xử lý sửa người dùng
if(isPost()) {
    // Validate form
    $body = getBody(); // lấy tất cả dữ liệu trong form
    $errors = [];  // mảng lưu trữ các lỗi
    
    // Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['title']))) {
        $errors['title']['required'] = '** Bạn chưa nhập tiêu đều!';
    }else {
        if(strlen(trim($body['title'])) <= 5) {
        $errors['title']['min'] = '** Tiêu đề phải lớn hơn 5 ký tự!';
        }
    }

   
   // Kiểm tra mảng error
  if(empty($errors)) {
    // không có lỗi nào
    $dataUpdate = [
        'fullname' => $body['fullname'],
        'email' => $body['email'],
        'title' => $body['title'],
        'content' => $body['content'],
        'status' => $body['status'],
        'update_at' => date('Y-m-d H:i:s'),
    ];

    /////////////////////////////////////
    $condition = "id=$contactsId";

    $updateStatus = update('contacts', $dataUpdate, $condition);
    if ($updateStatus) {
        setFlashData('msg', 'Cập nhật liên hệ thành công');
        setFlashData('msg_type', 'success');
        redirect('admin/?module=contacts&action=lists');
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

  redirect('admin/?module=contacts&action=edit&id='.$contactsId);

}
$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$contactsDetail = getFlashData('contactsDetail');

if (!empty($contactsDetail) && empty($old)) {
    $old = $contactsDetail;
}


?>

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
           <form action="" method="post">
           <hr/>
               <?php echo getMsg($msg, $msgType);  ?>
                    <div class="form-group col-8">
                        <label for="name">Họ tên</label>
                        <input type="text" name="fullname" id="name" class="form-control slug" value="<?php echo old('fullname', $old); ?>">
                    </div>

                    <div class="form-group col-8">
                        <label for="name">Email</label>
                        <input type="text" name="email" id="name" class="form-control slug" value="<?php echo old('email', $old); ?>">
                        <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                    </div>

                    <div class="form-group col-8">
                        <label for="name">Tiêu đề</label>
                        <textarea name="title" class="form-control"><?php echo old('title', $old); ?></textarea>
                    </div>

                    <div class="form-group col-8">
                        <label for="name">Nội dung</label>
                        <textarea name="content" class="form-control" rows="5"><?php echo old('content', $old); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="">Chọn trạng thái</option>
                            <option value="0" <?php echo (old('status', $old) == 0) ? 'selected':false; ?>>Chưa xử lý</option>
                            <option value="1" <?php echo (old('status', $old) == 1) ? 'selected':false; ?>>Đã xử lý</option>
                        </select>
                    </div>
             
           <hr />
          
               <div class="row">
                   <button type="submit" class="btn btn-primary">Cập nhật</button>
                   <a style="margin-left: 20px " href="<?php  echo getLinkAdmin('contacts', 'lists') ?>" class="btn btn-success">Quay lại trang danh sách</a>
                   <input type="hidden" name="id" value="<?php echo $contactsId; ?>">
               </div>
         
           </form>
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->

<?php
layout('footer', 'admin');