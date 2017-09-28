<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/bookingService.php';
require_once DIR . '/model/notificationService.php';
require_once DIR . '/model/logService.php';
if(!isset($_SESSION['user_id'])){
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
if (isset($_GET['id'])) {
    $id= _return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    if ($id != '') {

        $data_check = booking_getById($id);
        if (count($data_check) > 0) {
            $array = (array)$data_check[0];
            $new = new booking($array);
            $new->id = $id;
            $new->confirm_admin = $_SESSION['user_id'];
            $new->updated = _returnGetDateTime();
            booking_update($new);
            $name_noti=$_SESSION['user_name'].' đã xác nhận đơn hàng "'.$data_check[0]->code_booking.'"';
            $link_noti='/booking/sua?noti=1&id='._return_mc_encrypt($data_check[0]->id, ENCRYPTION_KEY);
            _insertNotification($name_noti,$_SESSION['user_id'],$data_check[0]->user_id,$link_noti,0,'');
            _insertLog($_SESSION['user_id'],6,6,22,$data_check[0]->id,'','',$_SESSION['user_name'].'đã xác nhận đơn hàng "'.$data_check[0]->code_booking.'"');
            echo 1;
        } else {
            echo 'Xác nhận đơn hàng thất bại, bản ghi không tồn tại trong hệ thống';
        }
    } else {
        echo 'Xác nhận đơn hàng thất bại, vui lòng kiểm tra lại các tham số';
    }


} else {
    echo 'Xác nhận đơn hàng thất bại, vui lòng kiểm tra lại các tham số';
}