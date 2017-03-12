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
    $valid_name_user="";
    $valid_id_user="";
    $name_user='';
    $id_user='';
    $table_user='';
    $ngay_bat_dau='';
    if($action==2){
        $action_name='edit';
        $readonly="readonly";
        $hidden="hidden";
        $valid_pass="valid";
        $show_phone="";
        $disabled='disabled';
        $data_sales=user_getById($data['data_user'][0]->user_id);
        if(count($data_sales)>0){
            if($data_sales[0]->name!=''){
                $valid_name_user='valid';
                $name_user=$data_sales[0]->name;
            }
            $phong_ban='';
            $number_tour=0;
            $data_phongban=user_phongban_getByTop('','id='.$data_sales[0]->phong_ban,'');
            $number_tour=booking_count('user_id='.$data_sales[0]->id.' and status!=5');
            if(count($data_phongban)>0){
                $phong_ban=$data_phongban[0]->name;
            }
            $id_user=$data_sales[0]->id;
            $valid_id_user="valid";
            $table_user='<tr> <td class="center">1</td><td><a>'.$name_user.'</a></td><td><span>'.$data_sales[0]->user_email.'</span></td> <td><span>'.$data_sales[0]->phone.'</span></td><td><span>'.$phong_ban.'</span></td><td>'.$number_tour.'</td></tr>';
        }
        $Random=_returnDataEditAdd($data['data_user'],'code_booking');
        $ngay_bat_dau=_returnDataEditAdd($data['data_user'],'code_booking');
    }else{
        $action_name='add';
        $readonly="readonly";
        $hidden="";
        $valid_pass="";
        $show_phone="hidden";
        $disabled='';
        $Random=_randomBooking('#','booking_count');
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


    $nguon_tour=_returnDataEditAdd($data['data_user'],'nguon_tour');
    $data_nguon_tour=tien_te_getById($nguon_tour);
    $nguon_tour_name='';
    if(count($data_nguon_tour)>0){
        $nguon_tour_name=$data_nguon_tour[0]->name;
    }
    $data_list_nguon_tour=nguon_tour_getByTop('','','position asc');
    require_once DIR . '/view/default/template/module/booking/themmoi.php';
}

