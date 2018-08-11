<?php
/**
 * Created by PhpStorm.
 * User: Duc Tho
 * Date: 4/13/2018
 * Time: 11:38 PM
 */


require_once DIR . '/common/cls_fast_template.php';
function show_response_hotel_themmoi($data = array())
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
    }
    $id=_returnDataEditAdd($data['data_user'],'id');
    if($id!=''){
        $id=_return_mc_encrypt($id, ENCRYPTION_KEY);
    }

    $hotel_name=_returnDataEditAdd($data['data_user'],'hotel_name');
    $hotel_code=_returnDataEditAdd($data['data_user'],'hotel_code');
    $customer=$data['customer']?$data['customer'][0]->name:'';
    $domain=_returnDataEditAdd($data['data_user'],'domain');
    $content=_returnDataEditAdd($data['data_user'],'content');
    $start_date=_returnDataEditAdd($data['data_user'],'start_date');
    $end_date=_returnDataEditAdd($data['data_user'],'end_date');
    $clear=_returnDataEditAdd($data['data_user'],'clear');
    $show_clear=_returnDataEditAdd($data['data_user'],'show_clear')?'checked':'';
    $comfort=_returnDataEditAdd($data['data_user'],'comfort');
    $show_comfort=_returnDataEditAdd($data['data_user'],'show_comfort')?'checked':'';

    $comment=_returnDataEditAdd($data['data_user'],'comment');
    $show_coment=_returnDataEditAdd($data['data_user'],'show_coment')?'checked':'';
    $convenient=_returnDataEditAdd($data['data_user'],'convenient');
    $show_convenient=_returnDataEditAdd($data['data_user'],'show_convenient')?'checked':'';
    $staff=_returnDataEditAdd($data['data_user'],'staff');
    $show_staff=_returnDataEditAdd($data['data_user'],'show_staff')?'checked':'';
    $room=_returnDataEditAdd($data['data_user'],'room');
    $show_room=_returnDataEditAdd($data['data_user'],'show_room')?'checked':'';
    $price=_returnDataEditAdd($data['data_user'],'price');
    $show_price=_returnDataEditAdd($data['data_user'],'show_price')?'checked':'';
    $place=_returnDataEditAdd($data['data_user'],'place');
    $show_place=_returnDataEditAdd($data['data_user'],'show_place')?'checked':'';
    $food=_returnDataEditAdd($data['data_user'],'food');
    $show_food=_returnDataEditAdd($data['data_user'],'show_food')?'checked':'';
    $status=_returnDataEditAdd($data['data_user'],'status')?'checked':'';
    $upcoming_tour=_returnDataEditAdd($data['data_user'],'upcoming_tour');

    require_once DIR . '/view/default/template/module/response_hotel/themmoi.php';
}



