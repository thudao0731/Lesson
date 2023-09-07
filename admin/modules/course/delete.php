<?php

$body = getBody();

if(!empty($body['id'])) {

    $groupId = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $groupDetail = getRows("SELECT id FROM course WHERE id=$groupId");
    if($groupDetail > 0) {
        // Thực hiện xóa
        $condition = "id=$groupId";

        // Kiểm tra xem trong nhóm còn người dùng không
        $userNum = getRows("SELECT id FROM chapter WHERE course_id=$groupId");
        if($userNum > 0) {
            setFlashData('msg', 'Xóa khóa học không thành công. Trong khóa còn '.$userNum.' chương học !');
            setFlashData('msg_type', 'danger');
        }else {
            $deleteStatus = delete('course', $condition);
            if(!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa khóa học thành công');
                setFlashData('msg_type', 'success');
            }else {
                setFlashData('msg', 'Xóa khóa học không thành công. Vui lòng kiểm tra lại !');
                setFlashData('msg_type', 'danger');
            } 
        }

    }
}


redirect('admin/?module=course&action=lists');