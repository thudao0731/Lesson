<?php


$checkLogin = isLogin();

if (!empty($checkLogin)) {
    layout('navbar', 'client');
}else {
    layout('navbarPre', 'client');
}
$body = getBody();
$id = getBody()['id'];

$user_id = isLogin()['user_id'];

$userInfo = getUserInfo($user_id);

$courseDetail = firstRaw("SELECT * FROM course WHERE id='$id'");
?>
        <main style="height: 500px;">
                <div class="main-content">
                    <div class="order">
                        <h2 class="heading lv3">Thông tin đơn hàng</h2>
                        <div class="order-line"></div>
                        <div class="order-inner">
                            <div class="order-info">
                                <p class="desc">Khóa học: <strong><?php echo $courseDetail['title'] ?></strong></p>
                                <p class="desc">Giá: <?php echo $courseDetail['price'] ?></p>
                                <p class="desc">
                                    <strong>Thông tin thanh toán</strong>
                                </p>
                                <p class="desc">Ngân hàng VietComBank - Chi nhánh Hải Phòng</p>
                                <p class="desc">- Số tài khoản: 1018299401</p>
                                <p class="desc">- Chủ tài khoản: Đào Văn Thu</p>
                                <p class="desc">- Số tiền: <?php echo $courseDetail['price'] ?></p>
                                <p class="desc">- Nội dung: <?php echo $userInfo['email'].' - '.$courseDetail['active_code'] ?></p>
                            </div>
                            <div class="order-qr">
                                <img class="order-imageQR" src="<?php echo _WEB_HOST_TEMPLATE?>/img/QR.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>             
        </main> 
<?php

layout('footer', 'client');

