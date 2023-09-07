<?php

$body = getBody();

if(!empty($body['id'])) {

    $blogId = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $pageDetail = getRows("SELECT id FROM blog WHERE id=$blogId");
    if($pageDetail > 0) {
        // Thực hiện xóa
        $condition = "id=$blogId";

        $deleteStatus = delete('blog', $condition);
        if(!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa blog thành công');
            setFlashData('msg_type', 'success');
        }else {
            setFlashData('msg', 'Xóa blog không thành công. Vui lòng kiểm tra lại !');
            setFlashData('msg_type', 'danger');
        } 

    }
}


redirect('admin/?module=blog&action=lists');