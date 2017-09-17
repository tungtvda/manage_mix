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
//           $res= _returnConfirmTiepthi($data_check, $return='');
//            exit;
            if($data_check[0]->price_tiep_thi!=''&&$data_check[0]->status_tiep_thi==0){
                if($data_check[0]->user_tiep_thi_id!=''){
                    $data_user = user_getById($data_check[0]->user_tiep_thi_id);
                    if(count($data_user)>0){
                        if($data_user[0]->user_role==2){
                            $array = (array)$data_check[0];
                            $new = new booking($array);
                            $new->id = $id;
                            $new->confirm_admin_tiep_thi = $_SESSION['user_id'];
                            $new->status_tiep_thi = 1;
                            $new->updated = _returnGetDateTime();
                            booking_update($new);
                            $hoa_hong=$data_user[0]->hoa_hong+$data_check[0]->price_tiep_thi;
                            $array_user = (array)$data_user[0];
                            $new_user = new user($array_user);
                            $new_user->hoa_hong=$hoa_hong;
                            user_update($new_user);
                            $name_noti=$_SESSION['user_name'].' đã xác nhận hoa hồng đơn hàng "'.$data_check[0]->code_booking.'"';
                            $link_noti='/tiep-thi-lien-ket/don-hang/chi-tiet?noti=1&id='._return_mc_encrypt($data_check[0]->id, ENCRYPTION_KEY);
                            _insertNotification($name_noti,$_SESSION['user_id'],$data_check[0]->user_tiep_thi_id,$link_noti,0,'');
                            _insertLog($_SESSION['user_id'],6,6,22,$data_check[0]->id,'','',$name_noti);
                            echo 1;
                        }else{
                            echo 'Sales không có quyền nhận hoa hồng';
                        }

                    }else{
                        echo 'Sales không tồn tại trong hệ thống';
                    }

                }else{
                    echo 'Đơn hàng không tồn tại sales';
                }

            }else{
                echo 'Đơn hàng không có hoa hồng hoặc đã được xác nhận';
            }

        } else {
            echo 'Xác nhận hoa hồng thất bại, bản ghi không tồn tại trong hệ thống';
        }
    } else {
        echo 'Xác nhận hoa hồng thất bại, vui lòng kiểm tra lại các tham số';
    }

} else {
    echo 'Xác nhận hoa hồng thất bại, vui lòng kiểm tra lại các tham số';
}