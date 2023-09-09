<?php
if (!defined('_INCODE')) die('Access Deined...');
/*File này chứa chức năng quên mật khẩu*/
$data = [
    'pageTitle' => 'Đặt lại mật khẩu'
];

layout('header-login','client');


//Xử lý đăng nhập
if (isPost()){
    $body = getBody();
    if (!empty($body['email'])){
        $email = $body['email'];
        $queryUser = firstRaw("SELECT id FROM users WHERE email='$email'");

        if (!empty($queryUser)){

            $user_id = $queryUser['id'];

            //Tạo forget_token
            $forget_token = sha1(uniqid().time());

            $dataUpdate = [
                'forget_token' => $forget_token
            ];

            $updateStatus = update('users', $dataUpdate, "id=$user_id");

            if ($updateStatus){

                //Tạo link khôi phục
                $link = _WEB_HOST_ROOT.'/?module=auth&action=reset&token='.$forget_token;

                //Thiết lập gửi email
                $subject = 'Yêu cầu khôi phục mật khẩu';
                $content = 'Chào bạn: '.$email.'<br />';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để khôi phục'.'<br />';
                $content .= $link.'<br />';
                $content .= 'Trân trọng !';

                //Tiến hành gửi email
                $senStatus = sendMail($email, $subject, $content);
                if ($senStatus){
                    setFlashData('msg', 'Vui lòng kiểm tra email !');
                    setFlashData('msg_type', 'success');
                }else{
                    setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                    setFlashData('msg_type', 'danger');
                }
            }else{
                setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                setFlashData('msg_type', 'danger');
            }

        }else{
            setFlashData('msg', 'Địa chỉ email không tồn tại trong hệ thống');
            setFlashData('msg_type', 'danger');
        }
    }else{

    }

    redirect('/?module=auth&action=forgotClient');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>
        <div class="forgot">
            <h3 class="title">Forgot</h3>
            <form action="" method="post">
                <div class="email-inner">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Địa chỉ email...">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
                <hr>
                <p class="login-inner"><a href="?module=auth&action=loginClient" class="login-link">Đăng nhập</a></p>
            </form>
        </div>
       
   
<?php

layout('footer-login', 'admin');