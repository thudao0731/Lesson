<?php
$data = [
    'pageTitle' => 'Cập nhật blog'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);



// Lấy dữ liệu cũ của người dùng
$body = getBody();

if(!empty($body['id'])) {

    $blogId = $body['id'];

    $blogDetail  = firstRaw("SELECT * FROM blog WHERE id=$blogId");

    
    if (!empty($blogDetail)) {
        setFlashData('blogDetail', $blogDetail);
    }else {
        redirect('admin/?module=blog&action=lists');
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
        'title' => $body['title'],
        'thumbnail' => $body['thumbnail'],
        'description' => $body['description'],
        'content' => $body['content'],
        'update_at' => date('Y-m-d H:i:s'),
    ];

    /////////////////////////////////////
    $condition = "id=$blogId";

    $updateStatus = update('blog', $dataUpdate, $condition);
    if ($updateStatus) {
        setFlashData('msg', 'Cập nhật blog thành công');
        setFlashData('msg_type', 'success');
        redirect('admin/?module=blog&action');
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

  redirect('admin/?module=blog&action=edit&id='.$blogId);

}
$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$blogDetail = getFlashData('blogDetail');

if (!empty($blogDetail) && empty($old)) {
    $old = $blogDetail;
}


?>

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
           <form action="" method="post">
           <hr/>
               <?php echo getMsg($msg, $msgType);  ?>
                    <div class="form-group col-8">
                        <label for="name">Tiêu đề</label>
                        <input type="text" name="title" id="name" class="form-control slug" value="<?php echo old('title', $old); ?>">
                        <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
                    </div>

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

                    <div class="form-group col-8">
                        <label for="name">Mô tả ngắn</label>
                        <textarea name="description" class="form-control"><?php echo old('description', $old); ?></textarea>
                    </div>

                    <div class="form-group col-8">
                        <label for="name">Nội dung</label>
                        <textarea name="content" class="form-control editor"><?php echo old('content', $old); ?></textarea>
                    </div>
             
           <hr />
          
               <div class="row">
                   <button type="submit" class="btn btn-primary">Cập nhật</button>
                   <a style="margin-left: 20px " href="<?php  echo getLinkAdmin('blog', 'lists') ?>" class="btn btn-success">Quay lại trang danh sách</a>
                   <input type="hidden" name="id" value="<?php echo $blogId; ?>">
               </div>
         
           </form>
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->

<?php
layout('footer', 'admin');