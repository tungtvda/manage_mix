<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_user_themmoi($data = array())
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
    }else{
        $action_name='add';
        $readonly="readonly";
        $hidden="";
        $valid_pass="";
        $show_phone="hidden";
    }
    $id=_returnDataEditAdd($data['data_user'],'id');
    if($id!=''){
        $id=_return_mc_encrypt($id, ENCRYPTION_KEY);
    }
    $avatar=SITE_NAME._returnDataEditAdd($data['data_user'],'avatar');
    if($avatar=='')
    {
        $avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
    }
    $name=_returnDataEditAdd($data['data_user'],'name');
    $valid_name="valid";
    if($name==''){
        $valid_name="";
    }

    $user_code=_returnDataEditAdd($data['data_user'],'user_code');
    $valid_user_code="valid";
    if($user_code==''){
        $valid_user_code="";
    }

    $birthday=_returnDataEditAdd($data['data_user'],'birthday');
    $valid_birthday="valid";
    if($birthday==''){
        $valid_birthday="";
    }
    $mr=_returnDataEditAdd($data['data_user'],'mr');
    $user_role=_returnDataEditAdd($data['data_user'],'user_role');
    if($user_role==1){
        $user_role="checked";
    }
    else{
        $user_role='';
    }
    $user_email=_returnDataEditAdd($data['data_user'],'user_email');
    $valid_email="valid";
    if($user_email==''){
        $valid_email="";
    }
    $address=_returnDataEditAdd($data['data_user'],'address');
    $valid_address="valid";
    if($address==''){
        $valid_address="";
    }
    $user_name=_returnDataEditAdd($data['data_user'],'user_name');
    $valid_user_name="valid";
    if($user_name==''){
        $valid_user_name="";
    }
    $password=_returnDataEditAdd($data['data_user'],'password');

    $phone=_returnDataEditAdd($data['data_user'],'phone');
    $valid_phone="valid";
    if($action==2){
        if($phone==''){
            $valid_phone="";
        }
    }
    $ngay_lam_viec=_returnDataEditAdd($data['data_user'],'ngay_lam_viec');
    $ngay_chinh_thuc=_returnDataEditAdd($data['data_user'],'ngay_chinh_thuc');


    require_once DIR . '/view/default/template/module/user/themmoi.php';
}



