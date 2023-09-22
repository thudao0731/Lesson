<?php

$body = getBody();

if(!empty($body['id'])) {

    $orderCourse = $body['id'];
    // Kiểm tra Id có tồn tại trong hệ thống hay không
    $orderCourseDetail = getRows("SELECT id FROM orderCourse WHERE id=$orderCourse");
    if($orderCourseDetail > 0) {
        // Thực hiện xóa
            $condition = "id=$orderCourse";
   
            $deleteStatus = delete('orderCourse', $condition);
            if(!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa đơn hàng thành công');
                setFlashData('msg_type', 'success');
            }else {
                setFlashData('msg', 'Xóa đơn hàng không thành công. Vui lòng kiểm tra lại !');
                setFlashData('msg_type', 'danger');
            } 
    }
}


redirect('admin/?module=orderCourse&action=lists');