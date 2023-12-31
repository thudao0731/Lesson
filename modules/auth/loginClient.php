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
                    setFlashData('msg', '** Vui lòng kiểm tra lại thông tin !');
                    setFlashData('msg_type', 'danger');
                }

            }else{
                setFlashData('msg', '** Mật khẩu chưa chính xác !');
                setFlashData('msg_type', 'danger');
            }
        }else{
            setFlashData('msg', '** Email chưa tồn tại trong hệ thống !');
            setFlashData('msg_type', 'danger');
        }
    }

    redirect('/?module=auth&action=loginClient');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$old = getFlashData('old');

?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body class="body-login">
        <div class="login">
            <?php echo getMsg($msg, $msgType) ?>
            <img src="<?php echo _WEB_HOST_TEMPLATE?>/img/logo (4).svg" alt="logo">
            
            <form action="" method="post" class="form-login">
                
                <div class="email-inner">
                    <label for="">Email</label>
                    <input type="email" name="email" class="" placeholder="Địa chỉ email..." required value="<?php echo old('email', $old); ?>">
                </div>
                <div class="pass-inner">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" class="" required minlength="6" placeholder="Mật khẩu...">
                </div>
                <button type="submit" class="btn btn-block">Đăng nhập</button>
                <hr>
                <p class="forgot-inner"><a class="forgot-link" href="?module=auth&action=forgotClient">Quên mật khẩu?</a></p>
            </form>
        </div>
        </body>
        </html>
<?php
