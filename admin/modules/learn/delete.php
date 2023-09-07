<?php

$body = getBody();

if(!empty($body['id'])) {

    $learnId = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $groupDetail = getRows("SELECT id FROM learn WHERE id=$learnId");
    if($groupDetail > 0) {
        // Thực hiện xóa
            $condition = "id=$learnId";
   
            $deleteStatus = delete('learn', $condition);
            if(!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa content thành công');
                setFlashData('msg_type', 'success');
            }else {
                setFlashData('msg', 'Xóa content không thành công. Vui lòng kiểm tra lại !');
                setFlashData('msg_type', 'danger');
            } 
    }
}


redirect('admin/?module=learn&action=lists');