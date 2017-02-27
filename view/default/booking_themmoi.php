<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_booking_themmoi($data = array())
{
    $asign = array();
    $tieude=$data['title'];
    $action=$data['action'];
    if($action==2){
        $action_name='edit';
        $readonly="readonly";
        $hidden="hidden";
        $valid_pass="valid";
        $show_phone="";
        $disabled='disabled';

    }else{
        $action_name='add';
        $readonly="readonly";
        $hidden="";
        $valid_pass="";
        $show_phone="hidden";
        $disabled='';
    }

    $tien_te=_returnDataEditAdd($data['data_user'],'tien_te');
    $data_tien_te=tien_te_getById($tien_te);
    $tien_te_name='';
    if(count($data_tien_te)>0){
        $tien_te_name=$data_tien_te[0]->name;
    }
    $data_list_tien_tee=tien_te_getByTop('','','position asc');

    $hinh_thuc_thanh_toan=_returnDataEditAdd($data['data_user'],'hinh_thuc_thanh_toan');
    $data_httt=httt_getById($hinh_thuc_thanh_toan);
    $httt_name='';
    if(count($data_httt)>0){
        $httt_name=$data_httt[0]->name;
    }
    $data_list_httt=httt_getByTop('','','position asc');

    $status=_returnDataEditAdd($data['data_user'],'status');
    $data_status=trang_thai_don_hang_getById($status);
    $status_name='';
    if(count($data_status)>0){
        $status_name=$data_status[0]->name;
    }
    $data_list_status=trang_thai_don_hang_getByTop('','','position asc');
    $data_list_customer_category=customer_category_getByTop('','','position asc');

    echo $number_1=strtotime(_returnGetDateTime()).$_SESSION['user_id'];
    require_once DIR . '/view/default/template/module/booking/themmoi.php';
}
