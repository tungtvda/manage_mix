<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/booking_transactionsService.php';
//_returnCheckPermison(6,6);
if(isset($_GET['id'])) {

    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    if ($id != '') {
       $data=booking_giao_dich('booking_id='.$id);
        print_r($data);
        exit;
        if($data){
            foreach($data as $row){
//                echo
            }
        }else{
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}