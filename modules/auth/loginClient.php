<?php
if (!defined('_INCODE')) die('Access Deined...');
/*
 * File này chứa chức năng đăng nhập
 * */


layout('header-login', 'client');


//Kiểm tra trạng thái đăng nhập
// if (isLogin()){
//     redirect('admin');
// }

//Xử lý đăng nhập
if (isPost()){
    $body = getBody();
    if (!empty(trim($body['email'])) && !empty(trim($body['password']))){
        //Kiểm tra đăng nhập
        $email = $body['email'];
        $password = $body['password'];

        //Truy vấn lấy thông tin user theo email
        $userQuery = firstRaw("SELECT id, password FROM users WHERE email='$email'");

        if (!empty($userQuery)){
            $passwordHash = $userQuery['password'];
            $user_id = $userQuery['id'];
            if (password_verify($password, $passwordHash)){

                //Tạo token login
                $tokenLogin = sha1(uniqid().time());

                //Insert dữ liệu vào bảng login_token
                $dataToken = [
                    'user_id' => $user_id,
                    'token' => $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s')
                ];

                $insertTokenStatus = insert('login_token', $dataToken);
                if ($insertTokenStatus){
                    //Insert token thành công       
                    //Lưu loginToken vào session
                    setSession('loginToken', $tokenLogin);
                    //Chuyển hướng qua trang quản lý users
                    redirect('?module=home&action=lists');
                }else{
                    setFlashData('msg', 'Lỗi hệ thống, bạn không thể đăng nhập vào lúc này');
                    //redirect('?module=auth&action=login');
                }

            }else{
                setFlashData('msg', '** Mật khẩu không chính xác!');
                setFlashData('old', $body);
                //redirect('?module=auth&action=login');
            }
        }else{
            setFlashData('msg', '** Email chưa được kích hoạt!');
            setFlashData('old', $body);
            //redirect('?module=auth&action=login');
        }
    }else{
        setFlashData('msg', '** Vui lòng kiểm tra email và mật khẩu!');
        setFlashData('old', $body);
        //redirect('?module=auth&action=login');
    }

    redirect('/?module=auth&action=loginClient');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$old = getFlashData('old');
?>

   
        <div class="login">
            <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/logo (4).svg" alt="logo">
            
            <form action="" method="post" class="form-login">
                
                <div class="email-inner">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Địa chỉ email..." value="<?php echo old('email', $old); ?>">
                </div>
                <div class="pass-inner">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                <hr>
                <p class="forgot-inner"><a class="forgot-link" href="?module=auth&action=forgot">Quên mật khẩu?</a></p>
            </form>
        </div>
<?php

