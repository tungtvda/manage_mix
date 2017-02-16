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
    $ton_giao = _returnPostParamSecurity('ton_giao');
    $ho_khau_tt = _returnPostParamSecurity('ho_khau_tt');
    $language = _returnPostParamSecurity('language');
    $note = _returnPostParamSecurity('note');

    if ($full_name != '' && $birthday != '' && $address_user != '' && $user_phone != '' ) {

    }else{
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin bắt buộc")</script>';
    }


}else{
    echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin bắt buộc")</script>';
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