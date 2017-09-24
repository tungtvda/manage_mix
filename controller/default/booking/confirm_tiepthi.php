<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/bookingService.php';
require_once DIR . '/model/notificationService.php';
require_once DIR . '/model/logService.php';
require_once DIR . '/model/userService.php';
if(!isset($_SESSION['user_id'])){
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
if($_SESSION['user_role'] != 1){
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
if (isset($_GET['id'])) {
    $id= _return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    if ($id != '') {
        $data_check = booking_getById($id);
        if (count($data_check) > 0) {
           $res= _returnConfirmTiepthi($data_check, 1);
            echo $res;
        } else {
            echo 'Xác nhận hoa hồng thất bại, bản ghi không tồn tại trong hệ thống';
        }
    } else {
        echo 'Xác nhận hoa hồng thất bại, vui lòng kiểm tra lại các tham số';
    }

} else {
    echo 'Xác nhận hoa hồng thất bại, vui lòng kiểm tra lại các tham số';
}