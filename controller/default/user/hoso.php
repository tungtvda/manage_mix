<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../../config.php';
}
require_once DIR.'/controller/default/public.php';
$data=array();
if (_returnCheckAction(15) == 0) {
    redict(_returnLinkDangNhap());
}
_returnCheckExitUser();
$data_user_update=$data['data_user']=user_getById($_SESSION['user_id']);
if(count($data['data_user'])==0){
    redict(_returnLinkDangNhap());
}
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li><a href="'.SITE_NAME.'/nhan-vien/">Nhân viên</a></li><li class="active">Hồ sơ</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Hồ sơ nhân viên "'.$data['data_user'][0]->name.'"';
$count=8;
_deleteSubmitForm('user', 'user_delete');
$data['list']=user_getByTop('','','updated desc');
$data['module_valid'] = "user";
$data['title_print'] = 'Hồ sơn nhân viên "'.$data['data_user'][0]->name.'"';
if(isset($_POST['birthday'])&&isset($_POST['address_user'])&&isset($_POST['full_name'])&&isset($_POST['user_phone'])){
    $mr = _returnPostParamSecurity('mr');
    $full_name = _returnPostParamSecurity('full_name');
    $birthday = _returnPostParamSecurity('birthday');
    $gender = _returnPostParamSecurity('gender');
    $address_user = _returnPostParamSecurity('address_user');
    $phong_ban = _returnPostParamSecurity('phong_ban');
    $chuc_vu = _returnPostParamSecurity('chuc_vu');
     $guides = _returnPostParamSecurity('guides');
    if ($guides === "on" || $guides === 1) {
        $guides = 1;
    } else {
        $guides = 0;
    }
    $guide_card_number = _returnPostParamSecurity('guide_card_number');
    $tax_code = _returnPostParamSecurity('tax_code');
    $user_phone = _returnPostParamSecurity('user_phone');
    $mobi= _returnPostParamSecurity('mobi');
    $skype = _returnPostParamSecurity('skype');
    $facebook = _returnPostParamSecurity('facebook');
    $cmnd = _returnPostParamSecurity('cmnd');
    $date_range_cmnd = _returnPostParamSecurity('date_range_cmnd');
    $issued_by_cmnd = _returnPostParamSecurity('issued_by_cmnd');
    $number_passport = _returnPostParamSecurity('number_passport');
    $issued_by_passport = _returnPostParamSecurity('issued_by_passport');
    $date_range_passport = _returnPostParamSecurity('date_range_passport');
    $expiration_date_passport = _returnPostParamSecurity('expiration_date_passport');
    $account_number_bank = _returnPostParamSecurity('account_number_bank');
    $bank = _returnPostParamSecurity('bank');
    $open_bank = _returnPostParamSecurity('open_bank');
    $dan_toc = _returnPostParamSecurity('dan_toc');
    $ton_giao = _returnPostParamSecurity('religion');
    $ho_khau_tt = _returnPostParamSecurity('ho_khau_tt');
    $language = _returnPostParamSecurity('language');
    $note = _returnPostParamSecurity('note');
    if ($full_name != '' && $birthday != '' && $address_user != '' && $user_phone != '' ) {
        $array = (array)$data_user_update[0];
        if($array['birthday']!='0000-00-00'){
            $array['birthday']=date("Y-m-d", strtotime($array['birthday']));
        }
        if($array['ngay_lam_viec']!='0000-00-00'){
            $array['ngay_lam_viec']=date("Y-m-d", strtotime($array['ngay_lam_viec']));
        }
        if($array['ngay_chinh_thuc']!='0000-00-00'){
            $array['ngay_chinh_thuc']=date("Y-m-d", strtotime($array['ngay_chinh_thuc']));
        }
        $new_obj = new user($array);
        $new_obj->mr=$mr;
        $new_obj->name=$full_name;
        if ($birthday != '') {
            $new_obj->birthday=date("Y-m-d", strtotime($birthday));
        }
        $new_obj->gender=$gender;
        $new_obj->address=$address_user;
        $new_obj->phong_ban=$phong_ban;
        $new_obj->chuc_vu=$chuc_vu;
        $new_obj->guides=$guides;
        $new_obj->guide_card_number=$guide_card_number;
        $new_obj->tax_code=$tax_code;
        $new_obj->phone=$user_phone;
        $new_obj->mobi=$mobi;
        $new_obj->skype=$skype;
        $new_obj->facebook=$facebook;
        $new_obj->cmnd=$cmnd;
        if ($date_range_cmnd != '') {
            $new_obj->date_range_cmnd=date("Y-m-d", strtotime($date_range_cmnd));
        }
        $new_obj->issued_by_cmnd=$issued_by_cmnd;
        $new_obj->number_passport=$number_passport;
        $new_obj->issued_by_passport=$issued_by_passport;
        if ($date_range_passport != '') {
            $new_obj->date_range_passport=date("Y-m-d", strtotime($date_range_passport));
        }
        if ($expiration_date_passport != '') {
            $new_obj->expiration_date_passport=date("Y-m-d", strtotime($expiration_date_passport));
        }
        $new_obj->account_number_bank=$account_number_bank;
        $new_obj->bank=$bank;
        $new_obj->open_bank=$open_bank;
        $new_obj->dan_toc=$dan_toc;
        $new_obj->religion=$ton_giao;
        $new_obj->ho_khau_tt=$ho_khau_tt;
        $new_obj->language=$language;
        $new_obj->note=$note;
        $new_obj->updated = _returnGetDateTime();
        $new_obj->id = $_SESSION['user_id'];
        $folder = LocDau($data_user_update[0]->user_email);
        $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/" . $folder . '/';
        $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/" . $folder . '/');
        if ($avatar != '') {
            $new_obj->avatar=$avatar;
        }
        user_update($new_obj);
        $data['data_user']=user_getById($_SESSION['user_id']);
    }else{
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin bắt buộc")</script>';
    }
}
show_header($data);
show_left($data,'user','user_list');
show_breadcrumb($data);
show_navigation($data);
show_user_hoso($data);
show_footer($data);
//show_script_edit_user($data);
show_valid_form($data);
show_script_form($data);