<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/booking_transactionsService.php';
require_once DIR . '/model/bookingService.php';
_returnCheckPermison(6, 6);
if (isset($_POST['id']) && isset($_POST['code']) && isset($_POST['value'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $code = _returnPostParamSecurity('code');
    $value = _returnPostParamSecurity('value');
     if($id && $code && $value){

        $data_check=booking_getById($id);
         if($data_check){
             $obj=new booking_transactions();
             $obj->user_id=$_SESSION['user_id'];
             $obj->booking_id=$id;
             $obj->description=$value;
             $obj->created = _returnGetDateTime();
             $obj->updated = _returnGetDateTime();
             booking_transactions_insert($obj);
             echo _returnListGiaodich($id);
         }else{
             echo 0;
         }
     }else{
         echo 0;
     }
} else {
    echo 0;
}