<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 4:21 PM
 */
require_once DIR.'/model/userService.php';

function _returnCheckPermison($module_id=0,$form_id=0){
    // Kiểm tra có tồn tại user không
    _returnCheckExitUser();
    // Lấy thông tin user
    $data_user=user_getById($_SESSION['user_id']);
    if(count($data_user)==0)
    {
        redict(_returnLinkDangNhap());
    }
    // kiểm tra thời gian đăng nhập
    $date_compare =$data_user[0]->time_token;
    $date_check= date('Y-m-d H:i:s', strtotime('+15 minute', strtotime($date_compare)));
    $currentDate=_returnGetDateTime();
    if(strtotime($currentDate) > strtotime($date_check)) {
        redict(_returnLinkDangNhap());
    }
    $user_update=new user();
    $user_update->id=$_SESSION['user_id'];
    $user_update->time_token=_returnGetDateTime();
    user_update_time_login($user_update);
    // kiểm tra quyền có phải là super admin
    if($_SESSION['user_role']==1){
        return true;
    }
    $permison_module=explode(',',$data_user[0]->permison_module);
    $permison_form=explode(',',$data_user[0]->permison_form);
    $permison_action=explode(',',$data_user[0]->permison_action);
    if(!in_array($module_id,$permison_module)||$module_id==0)
    {
        redict(_returnLinkDangNhap());
    }
    if($form_id!=0)
    {
        if(!in_array($form_id,$permison_form)){
            redict(_returnLinkDangNhap());
        }
        else{
            return true;
        }
    }
    $_SESSION['user_permison_action']=$permison_action;
    return true;

}
function _returnCheckPermisonAction($action_id=0){
    _returnCheckExitUser();
    if($action_id==0){
        redict(_returnLinkDangNhap());
    }
    if(!in_array($action_id,$_SESSION['user_permison_action'])){
        redict(_returnLinkDangNhap());
    }
    return true;
}
function _returnCheckExitUser(){
    if(!isset($_SESSION['user_id'])||!isset($_SESSION['user_role'])){
        redict(_returnLinkDangNhap());
    }
}
function _returnLinkDangNhap(){
    return SITE_NAME.'/dang-nhap.html';
}
function _returnGetParamSecurity($param)
{
    if (isset($_GET[$param])) {
        $param_val = addslashes(strip_tags(trim($_GET[$param])));
        return $param_val;
    } else {
        return '';
    }
}
function _returnPostParamSecurity($param)
{
    if (isset($_POST[$param])) {
        $param_val = addslashes(strip_tags(trim($_POST[$param])));
        return $param_val;
    } else {
        return '';
    }
}
function _returnGetDate()
{
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    return date('Y-m-d');
}

function _returnGetDateTime()
{
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    return date('Y-m-d H:i:s');
}

function _returnDateFormatEn($date)
{
    $date = date_create($date);
    return date_format($date, 'g:ia l F j\, Y');
//        return date_format($date, 'j F Y  l');
//        echo date_format($date, 'd/m/y');
//#output: 24/03/12
//
//        echo date_format($date, 'g:i A');
//#output: 5:45 PM
//
//        echo date_format($date, 'G:ia');
//#output: 05:45pm
//
//        echo date_format($date, 'g:ia \o\n l jS F Y');
//#output: 5:45pm on Saturday 24th March 2012
}
function _returnDateFormatEnNot($date)
{
    $date = date_create($date);
    return date_format($date, 'g:i A');
}

function _returnDateFormatEnNotTime($date)
{
    $date = date_create($date);
    return date_format($date, 'F j\, Y');
}

function _returnDateFormatConvert($date)
{
    if ($date == '') {
        $DatesRemainder = '';
    } else {
        $DatesRemainder = date("Y-m-d H:i:s", strtotime($date));
    }
    return $DatesRemainder;
}
function _returnRandString( $length ) {
    $str='';
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen( $chars );
    for( $i = 0; $i < $length; $i++ ) {
        $str .= $chars[ rand( 0, $size - 1 ) ];
    }
    return $str;
}
function _returnLogin($data_arr,$user_update){
    $_SESSION["user_id"]=$data_arr['user_id'];
    $_SESSION["user_role"]=$data_arr['user_role'];
    $_SESSION['user_permison_action']=$data_arr['user_permison_action'];
    $_SESSION['user_permison_form']=$data_arr['user_permison_form'];
    $_SESSION['user_permison_module']=$data_arr['user_permison_module'];
    $user_update->time_token=_returnGetDateTime();
    $user_update->id=$data_arr['user_id'];
    user_update_time_login($user_update);
    if(isset($_SESSION['show_email'])){
        unset($_SESSION['show_email']);
    }
    if(isset($_SESSION['show_id'])){
        unset($_SESSION['show_id']);
    }
    if(isset($_SESSION["link_redict"])){
        redict($_SESSION["link_redict"]);
    }
    else{
        redict(SITE_NAME);
    }

}