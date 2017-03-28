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
    $arr_data['httt_name']='';
    $data_httt=httt_getById($data_booking[0]->hinh_thuc_thanh_toan);
    if(count($data_httt)>0){
        $arr_data['httt_name']=$data_httt[0]->name;
    }
    $arr_data['ttdh_name']='';
    $data_ttdh=trang_thai_don_hang_getById($data_booking[0]->status);
    if(count($data_ttdh)>0){
        $arr_data['ttdh_name']='Đơn hàng của quý khách đã được xác nhận. Trang thái hiện tại ( '.$data_ttdh[0]->name.' )';
    }
    $data_cus_booking=customer_getById($data_booking[0]->id_customer);
    if(count($data_cus_booking)>0){
        $arr_data['data_cus_booking']=$data_cus_booking;
    }

    if(count($arr_data)>0){
        echo json_encode($arr_data);
        exit;
    }
    echo 0;
} else {
    echo 0;
}