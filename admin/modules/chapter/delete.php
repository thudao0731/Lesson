<?php

$body = getBody();

if(!empty($body['id'])) {

    $groupId = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $groupDetail = getRows("SELECT id FROM chapter WHERE id=$groupId");
    if($groupDetail > 0) {
        // Thực hiện xóa
            $condition = "id=$groupId";
   
            $deleteStatus = delete('chapter', $condition);
            if(!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa chương học thành công');
                setFlashData('msg_type', 'success');
            }else {
                setFlashData('msg', 'Xóa chương học không thành công. Vui lòng kiểm tra lại !');
                setFlashData('msg_type', 'danger');
            } 
    }
}


redirect('admin/?module=chapter&action=lists');