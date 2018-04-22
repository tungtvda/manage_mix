<?php
/**
 * Created by PhpStorm.
 * User: Duc Tho
 * Date: 4/13/2018
 * Time: 11:38 PM
 */


require_once DIR . '/common/cls_fast_template.php';
function show_response_themmoi($data = array())
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

    $tour_name=_returnDataEditAdd($data['data_user'],'tour_name');
    $tour_code=_returnDataEditAdd($data['data_user'],'tour_code');
    $customer=$data['customer']?$data['customer'][0]->name:'';
    $domain=_returnDataEditAdd($data['data_user'],'domain');
    $content=_returnDataEditAdd($data['data_user'],'content');
    $departure=_returnDataEditAdd($data['data_user'],'departure');
    $program=_returnDataEditAdd($data['data_user'],'program');
    $show_program=_returnDataEditAdd($data['data_user'],'show_program')?'checked':'';
    $hotel=_returnDataEditAdd($data['data_user'],'hotel');
    $show_hotel=_returnDataEditAdd($data['data_user'],'show_hotel')?'checked':'';

    $comment=_returnDataEditAdd($data['data_user'],'comment');
    $show_coment=_returnDataEditAdd($data['data_user'],'show_coment')?'checked':'';
    $tour_guide_full=_returnDataEditAdd($data['data_user'],'tour_guide_full');
    $show_tour_guide_full=_returnDataEditAdd($data['data_user'],'show_tour_guide_full')?'checked':'';
    $tour_guide_local=_returnDataEditAdd($data['data_user'],'tour_guide_local');
    $show_tour_guide_local=_returnDataEditAdd($data['data_user'],'show_tour_guide_local')?'checked':'';
    $restaurant=_returnDataEditAdd($data['data_user'],'restaurant');
    $show_restaurant=_returnDataEditAdd($data['data_user'],'show_restaurant')?'checked':'';
    $transportation=_returnDataEditAdd($data['data_user'],'transportation');
    $show_transportation=_returnDataEditAdd($data['data_user'],'show_transportation')?'checked':'';
    $status=_returnDataEditAdd($data['data_user'],'status')?'checked':'';
    $upcoming_tour=_returnDataEditAdd($data['data_user'],'upcoming_tour');

    require_once DIR . '/view/default/template/module/response_customer/themmoi.php';
}



