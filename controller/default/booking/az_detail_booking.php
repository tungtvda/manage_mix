<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/paging.php';
$data = array();
$res = array(
    'success' => 0,
);
if (isset($_POST['id']) && isset($_POST['id_noti'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $id_noti = _return_mc_decrypt(_returnPostParamSecurity('id_noti'));
    if($id_noti!=''){
        $data_noti=notification_getById($id_noti);
        if(count($data_noti)>0){
            $noti=new notification((array)$data_noti[0]);
            $noti->status=1;
            notification_update($noti);
        }
    }
    $data_booking=booking_getById($id);
    if(count($data_booking)>0){
        $res['success']=1;
        $data_cus=customer_getById($data_booking[0]->id_customer);
        if(count($data_cus)>0){
            $data_booking[0]->customer=$data_cus[0];
        }
        $res['data']=$data_booking;

    }
}
echo json_encode($res);