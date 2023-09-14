<?php

$body = getBody();

if(!empty($body['id'])) {

    $contactsId = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $pageDetail = getRows("SELECT id FROM contacts WHERE id=$contactsId");
    if($pageDetail > 0) {
        // Thực hiện xóa
        $condition = "id=$contactsId";

        $deleteStatus = delete('contacts', $condition);
        if(!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa liên hệ thành công');
            setFlashData('msg_type', 'success');
        }else {
            setFlashData('msg', 'Xóa liên hệ không thành công. Vui lòng kiểm tra lại !');
            setFlashData('msg_type', 'danger');
        } 

    }
}


redirect('admin/?module=contacts&action=lists');