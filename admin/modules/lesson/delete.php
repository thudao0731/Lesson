<?php

$body = getBody();

if(!empty($body['id'])) {

    $lesson = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $lessonDetail = getRows("SELECT id FROM lesson WHERE id=$lesson");
    if($lessonDetail > 0) {
        // Thực hiện xóa
            $condition = "id=$lesson";
   
            $deleteStatus = delete('lesson', $condition);
            if(!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa bài học thành công');
                setFlashData('msg_type', 'success');
            }else {
                setFlashData('msg', 'Xóa bài học không thành công. Vui lòng kiểm tra lại !');
                setFlashData('msg_type', 'danger');
            } 
    }
}


redirect('admin/?module=lesson&action=lists');