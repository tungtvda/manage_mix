<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_customer_themmoi($data = array())
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
    $id=_returnDataEditAdd($data['data_user'],'id');
    if($id!=''){
        $id=_return_mc_encrypt($id, ENCRYPTION_KEY);
    }
    $avatar=SITE_NAME._returnDataEditAdd($data['data_user'],'avatar');
    if(_returnDataEditAdd($data['data_user'],'avatar')=='')
    {
        $avatar=SITE_NAME.'/view/default/themes/images/no-image.jpg';
    }
    $name=_returnDataEditAdd($data['data_user'],'name');
    $valid_name="valid";
    if($name==''){
        $valid_name="";
    }

    $code=_returnDataEditAdd($data['data_user'],'code');
    $valid_code="valid";
    if($code==''){
        $valid_code="";
    }

    $birthday=_returnDataEditAdd($data['data_user'],'birthday');
    if($birthday=="0000-00-00"||$birthday=='')
    {
        $birthday='';

    }else{
        $birthday=date("d-m-Y", strtotime($birthday));
    }
    $valid_birthday="valid";
    $mr=_returnDataEditAdd($data['data_user'],'mr');

    $user_role=_returnDataEditAdd($data['data_user'],'user_role');
    if($user_role==1){
        $user_role="checked";
    }
    else{
        $user_role='';
    }
    $user_email=_returnDataEditAdd($data['data_user'],'email');
    $valid_email="valid";
    if($user_email==''){
        $valid_email="";
    }
    $address=_returnDataEditAdd($data['data_user'],'address');
    $valid_address="valid";
    if($address==''){
        $valid_address="";
    }

    $phone=_returnDataEditAdd($data['data_user'],'phone');
    $valid_phone="valid";
    if($action==2){
        if($phone==''){
            $valid_phone="";
        }
    }
    $mobi=_returnDataEditAdd($data['data_user'],'mobi');
    $valid_mobi="valid";
    if($mobi==''){
        $valid_mobi="";
    }

    $fax=_returnDataEditAdd($data['data_user'],'fax');

    $category=_returnDataEditAdd($data['data_user'],'category');
    $data_category=customer_category_getById($category);
    $category_name='';
    if(count($data_category)>0){
        $category_name=$data_category[0]->name;
    }
    $data_list_category=customer_category_getByTop('','','position asc');

    $resources_to=_returnDataEditAdd($data['data_user'],'resources_to');
    $data_resources_to=customer_resources_to_getById($resources_to);
    $resources_to_name='';
    if(count($data_resources_to)>0){
        $resources_to_name=$data_resources_to[0]->name;
    }
    $data_list_resources_to=customer_resources_to_getByTop('','','position asc');

    $nganh_nghe=_returnDataEditAdd($data['data_user'],'nganh_nghe');
    $data_nganh_nghe=customer_career_getById($nganh_nghe);
    $nganh_nghe_name='';
    if(count($data_nganh_nghe)>0){
        $nganh_nghe_name=$data_nganh_nghe[0]->name;
    }
    $data_list_nganh_nghe=customer_career_getByTop('','','position asc');

    $company_name=_returnDataEditAdd($data['data_user'],'company_name');
    $director_name=_returnDataEditAdd($data['data_user'],'director_name');
    $company_email=_returnDataEditAdd($data['data_user'],'company_email');
    $skype=_returnDataEditAdd($data['data_user'],'skype');

    $chuc_vu=_returnDataEditAdd($data['data_user'],'chuc_vu');
    $data_chuc_vu=user_chucvu_getById($chuc_vu);
    $chuc_vu_name='';
    if(count($data_chuc_vu)>0){
        $chuc_vu_name=$data_chuc_vu[0]->name;
    }
    $data_list_chucvu=user_chucvu_getByTop('','','position asc');

    $phong_ban=_returnDataEditAdd($data['data_user'],'phong_ban');
    $data_phong_ban=user_phongban_getById($phong_ban);
    $phong_ban_name='';
    if(count($data_phong_ban)>0){
        $phong_ban_name=$data_phong_ban[0]->name;
    }
    $data_list_phongban=user_phongban_getByTop('','','position asc');

    $account_number_bank=_returnDataEditAdd($data['data_user'],'account_number_bank');
    $bank=_returnDataEditAdd($data['data_user'],'bank');
    $open_bank=_returnDataEditAdd($data['data_user'],'open_bank');
    $account_number_bank_name="";
    $bank_name='';
    if($account_number_bank!=''){
        $account_number_bank_name.=$account_number_bank;
        if($bank!=''){
            $bank_name.=" Ngân hàng: ".$bank;
        }
    }
    $open_bank_name="";
    if($open_bank!=""){
        $open_bank_name="Chi nhánh: ".$open_bank;
    }
    $face=_returnDataEditAdd($data['data_user'],'facebook');

    $cmnd=_returnDataEditAdd($data['data_user'],'cmnd');
    $date_range_cmnd=_returnDataEditAdd($data['data_user'],'date_range_cmnd');
    $issued_by_cmnd=_returnDataEditAdd($data['data_user'],'issued_by_cmnd');
    $cmnd_name='';
    if($cmnd!=''){
        if($date_range_cmnd!="0000-00-00"){
            $cmnd_name.="Ngày cấp: ".date("d-m-Y", strtotime($date_range_cmnd));
            if($issued_by_cmnd!=""){
                $cmnd_name.=" - Nơi cấp: ".$issued_by_cmnd;
            }
        }
        else{
            $date_range_cmnd='';
        }

    }else{
        $date_range_cmnd='';
    }
    if($date_range_cmnd=="0000-00-00"||$date_range_cmnd==""){
        $date_range_cmnd='';
    }
    else{
        $date_range_cmnd=date("d-m-Y", strtotime($date_range_cmnd));
    }
    $note=_returnDataEditAdd($data['data_user'],'note');

    require_once DIR . '/view/default/template/module/customer/themmoi.php';
}



