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
$data = array();
if (isset($_POST['number'])){
     $code_booking = _return_mc_decrypt(_returnPostParamSecurity('number'), '');
    if($code_booking==''){
        echo 0;
        exit;
    }
    $data_booking=booking_getByTop('1','code_booking="'.$code_booking.'"','id desc');
    if(count($data_booking)==0){
        echo 0;
        exit;
    }
    $arr_data=array();
    foreach($data_booking as $row){
       foreach($row as $key=>$value){
           $arr_data[$key]=$value;
       }
    }
    $arr_data_cus=array();
    $data_cus=customer_booking_getByTop('','','id desc');
    if(count($data_cus)>0){
        $arr_data['sub_customer']=$data_cus;
    }
    if(count($arr_data)>0){
        echo json_encode($arr_data);
        exit;
    }
    echo 0;
} else {
    echo 0;
}