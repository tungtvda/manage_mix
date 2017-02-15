<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_user_hoso($data = array())
{
    $asign = array();
    $title=$data['title'];

    $id_xac_minh=$id=_returnDataEditAdd($data['data_user'],'id');
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
    if($mr!=''){
        $name_show=$mr.'.'.$name;
    }
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
    $phone=_returnDataEditAdd($data['data_user'],'phone');
    $valid_phone="valid";
    if($phone==''){
        $valid_phone="";
    }
    $mobi=_returnDataEditAdd($data['data_user'],'mobi');
    $valid_mobi="valid";
    if($mobi==''){
        $valid_mobi="";
    }

    $skype=_returnDataEditAdd($data['data_user'],'skype');
    $face=_returnDataEditAdd($data['data_user'],'facebook');
    $ngay_lam_viec=_returnDataEditAdd($data['data_user'],'ngay_lam_viec');
    $ngay_chinh_thuc=_returnDataEditAdd($data['data_user'],'ngay_chinh_thuc');

    $gender_edit=$gender=_returnDataEditAdd($data['data_user'],'gender');
    if($gender==1){
        $gender="<i class=\"fa fa-male\" style=\"font-size: 16px;color:#1b6aaa;\" title='Nam'></i>";
    }
    else{
        if($gender==2){
            $gender="<i class=\"fa fa-female\" style=\"font-size: 16px;color:#D6487E;\" title='Nữ'></i>";
        }
        else{
            $gender="<i class=\"fa fa-user\" style=\"font-size: 16px\" title='Chưa xác định'></i>";
        }
    }
    $dan_toc=_returnDataEditAdd($data['data_user'],'dan_toc');
    $data_dantoc=dan_toc_getById($dan_toc);
    $dan_toc_name='';
    if(count($data_dantoc)>0){
        $dan_toc_name=$data_dantoc[0]->name;
    }
    $ton_giao=_returnDataEditAdd($data['data_user'],'religion');
    $data_ton_giao=ton_giao_getById($ton_giao);
    $ton_giao_name='';
    if(count($data_ton_giao)>0){
        $ton_giao_name=$data_ton_giao[0]->name;
    }
    $ho_khau_tt=_returnDataEditAdd($data['data_user'],'ho_khau_tt');

    $hon_nhan=_returnDataEditAdd($data['data_user'],'hon_nhan');
    $hon_nhan_name='';
    if($hon_nhan==0)
    {
        $hon_nhan_name="Độc thân";
    }else{
        if($hon_nhan==1)
        {
            $hon_nhan_name="Đang hẹn hò";
        }
        else{
            $hon_nhan_name="Kết hôn";
        }

    }

    $bang_cap=_returnDataEditAdd($data['data_user'],'bang_cap');
    $data_bang_cap=bang_cap_getById($bang_cap);
    $bang_cap_name='';
    if(count($data_bang_cap)>0){
        $bang_cap_name=$data_bang_cap[0]->name;
    }
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

    $guides=_returnDataEditAdd($data['data_user'],'guides');
    $guides_check="";
    if($guides==1)
    {
        $guides_check="checked";
    }

    $guide_card_number=_returnDataEditAdd($data['data_user'],'guide_card_number');
    $guide_card_number_name="";
    if($guide_card_number!=''&&$guides==1)
    {
        $guide_card_number_name="Mã thẻ: ".$guide_card_number;
    }

    $tax_code=_returnDataEditAdd($data['data_user'],'tax_code');
    $cmnd=_returnDataEditAdd($data['data_user'],'cmnd');
    $date_range_cmnd=_returnDataEditAdd($data['data_user'],'date_range_cmnd');
    $issued_by_cmnd=_returnDataEditAdd($data['data_user'],'issued_by_cmnd');
    $cmnd_name='';
    if($cmnd!=''){
       if($date_range_cmnd!="0000-00-00"){
           $cmnd_name.="Ngày cấp: ".date("Y-m-d", strtotime($date_range_cmnd));
           if($issued_by_cmnd!=""){
               $cmnd_name.=" - Nơi cấp: ".$issued_by_cmnd;
           }
       }
        else{
            $date_range_cmnd='';
        }

    }

    $number_passport=_returnDataEditAdd($data['data_user'],'number_passport');
    $date_range_passport=_returnDataEditAdd($data['data_user'],'date_range_passport');
    $issued_by_passport=_returnDataEditAdd($data['data_user'],'issued_by_passport');
    $expiration_date_passport=_returnDataEditAdd($data['data_user'],'expiration_date_passport');
    $number_passport_name='';
    if($issued_by_passport!=''){
        $number_passport_name.=" Nơi cấp: ".$issued_by_passport;
    }
    if($expiration_date_passport!="0000-00-00"){
    }else{
        $expiration_date_passport='';
    }
    $date_range_passport_name='';
    if($date_range_passport!="0000-00-00"){
        $date_range_passport_name.='Ngày cấp: '.date("Y-m-d", strtotime($date_range_passport));
        if($expiration_date_passport!="0000-00-00"){
            $date_range_passport_name.=' - Ngày hết hạn: '.date("Y-m-d", strtotime($expiration_date_passport));
        }
    }else{
        $date_range_passport='';
    }

    $ngon_ngu=_returnDataEditAdd($data['data_user'],'language');

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

    $created=_returnDataEditAdd($data['data_user'],'created');
    if($created!='0000-00-00 00:00:00'){
        $created= date("Y-m-d h:m:s", strtotime($created));
    }
    $note=_returnDataEditAdd($data['data_user'],'note');
    $login_two_steps=_returnDataEditAdd($data['data_user'],'login_two_steps');
    if($login_two_steps==1){
        $check_xacminh='checked';
        $mess_xacminh='Chức năng đăng nhập 2 bước đã được kích hoạt';
        $color_xacminh='blue';
    }else{
        $check_xacminh='';
        $mess_xacminh='Kích hoạt chức năng đăng nhập 2 bước';
        $color_xacminh='';
    }
    require_once DIR . '/view/default/template/module/user/hoso.php';
}



