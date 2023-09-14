<?php

$checkLogin = isLogin();

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}




if(isPost()) {
     // Validate form
     $body = getBody(); // lấy tất cả dữ liệu trong form

     $errors = [];  // mảng lưu trữ các lỗi

     if(empty(trim($body['name']))) {
        $errors['name']['required'] = '** Bạn chưa nhập họ tên!';
    }

     if(empty(trim($body['title']))) {
        $errors['title']['required'] = '** Bạn chưa nhập tiêu đề tin nhắn!';
    }
    // Kiểm tra mảng error
  if(empty($errors)) {

    $dataInsert = [
        'fullname' => trim(strip_tags($body['name'])),
        'email' => trim(strip_tags($body['email'])),
        'title' => trim(strip_tags( $body['title'])),
        'content' => trim(strip_tags($body['content'])),
        'create_at' => date('Y-m-d H:i:s')
    ];
    $insertStatus = insert('contacts', $dataInsert);

    if ($insertStatus) {
        setFlashData('msg', '* Gửi tin nhắn thành công, vui lòng nhận phản hồi qua email !');
        setFlashData('msg_type', 'success');
        // redirect('?module=contacts&action=page');
    }

  } else {  
        setFlashData('msg', '* Vui lòng kiểm tra lại thông tin nhập vào !');
        setFlashData('msg_type', 'danger');
        // redirect('?module=contacts&action=page'); // Load lại trang 
  }
}

$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');



?>
    <div class="main-content">
        <div class="contact-inner">
            <div class="contact-info">
                <h2 class="heading-contact">Giữ liên lạc với chúng tôi</h2>
                <div class="item">
                    <div class="icon icon-1">
                        <img
                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/make.svg"
                            alt=""
                        />
                    </div>
                    <div class="info">
                        <p class="label">Thành phố Hải Phòng</p>
                    </div>
                </div>

                <div class="item">
                    <div class="icon icon-1">
                        <img
                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/make.svg"
                            alt=""
                        />
                    </div>
                    <div class="info">
                        <p class="label">0367.012.859</p>
                    </div>
                </div>

                <div class="item">
                    <div class="icon icon-1">
                        <img
                            src="<?php echo _WEB_HOST_TEMPLATE?>/img/make.svg"
                            alt=""
                        />
                    </div>
                    <div class="info">
                        <p class="label">Thu86065@st.vimaru.edu.vn</p>
                    </div>
                </div>
            </div>

            <div class="contact-meassage">
                <form action="" method="post">
                    <h2 class="heading-contact">Gửi tin nhắn</h2>
                    <?php echo getMsg($msg, $msgType);?>
                    <br/>   
                    <div class="row-info">
                        <div class="info-name">
                            <label for="">Họ tên *</label>
                            <input type="text" name="name" class="name" id="">
                        </div>

                        <div class="info-email">
                            <label for="">Email *</label>
                            <input type="email" name="email" class="email" id="">
                        </div>
                    </div>

                    <div class="info-title">
                        <label for="">Tiêu đề </label>
                        <input type="text" name="title" class="title" id="">
                    </div>

                    <div class="info-content">
                        <label for="">Nội dung </label>
                        <textarea name="content" class="content" id=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit">Gửi tin nhắn</button>
                </form>
            </div>
        </div>
        
    </div>
    <div class="contact-map">
            <iframe class="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.8635921149084!2d106.69221537608436!3d20.83721408076461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a9c2ee478df%3A0x6039ffe1614ede5c!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBIw6BuZyBo4bqjaSBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1694332094477!5m2!1svi!2s"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

<?php
layout('footer', 'client');