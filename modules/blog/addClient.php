<?php

$checkLogin = isLogin();

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}


// Lấy userId dăng nhập
$userId = isLogin()['user_id'];

if(isPost()) {
     // Validate form
     $body = getBody(); // lấy tất cả dữ liệu trong form
     $errors = [];  // mảng lưu trữ các lỗi

     // Valide họ tên: Bắt buộc phải nhập, >=5 ký tự
    if(empty(trim($body['title']))) {
        $errors['title']['required'] = '** Bạn chưa nhập tiêu đề blog!';
    }else {
        if(strlen(trim($body['title'])) <= 5) {
        $errors['title']['min'] = '** Tiêu đề blog phải lớn hơn 5 ký tự!';
        }
    }
    // Kiểm tra mảng error
  if(empty($errors)) {

    $dataInsert = [
        'title' => $body['title'],
        'thumbnail' => $body['thumbnail'],
        'description' => $body['description'],
        'content' => $body['content'],
        'user_id' => $userId,
        'create_at' => date('Y-m-d H:i:s', ),
    ];
    $insertStatus = insert('blog', $dataInsert);
    if ($insertStatus) {
        setFlashData('msg', '* Đăng bài blog thành công, cám ơn bạn đã đóng góp trang Web');
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
}

$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');


   
?>

    <!-- Main content -->
      <div class="main-content">
            <div class="create-blog">
                <form action="" method="post">
                    <?php echo getMsg($msg, $msgType);?>
                        <div class="">
                            <label for="name">Tiêu đề *</label><br/>
                            <input type="text" name="title" id="name" class="inputData">
                        </div>

                        <div class="">
                            <label for="name">Ảnh nền *</label><br/>
                            <div class="row ckfinder-group">
                                <div class="col-8">
                                    <input type="text" name="thumbnail" id="name" class="inputData image-render">   
                                </div>
                                <div class="">
                                    <button type="button" style="margin-bottom: 30px" class="btnUp-image choose-image">Chọn ảnh</button>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="">
                            <label for="name">Mô tả ngắn *</label><br/>
                            <textarea name="description" class="blog-desc"></textarea>
                        </div>

                        <div class="" >
                            <label for="name">Nội dung</label><br/>
                            <textarea name="content" class="editor"></textarea>
                        </div>
                        
            
                    <div class="">
                        <button type="submit" class="btnUp-blog">Đăng bài</button>
                    </div>
            
                </form>
            </div>
      </div><!-- /.container-fluid -->
    <!-- /.content -->

<?php
layout('footer', 'client');