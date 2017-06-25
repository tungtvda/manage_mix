<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR . "/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$res ='';
if(isset($_POST['username_login'])&&isset($_POST['password_login'])){
    $username_login=_returnPostParamSecurity('username_login');
    $password_login=_returnPostParamSecurity('password_login');
    if($username_login!=''&&$password_login!=''){
        $Pass = hash_pass($password_login);
        $dk_check_user = "user_email ='" . $username_login . "' and password='".$Pass."'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if(count($data_check_exist_user)>0){
            $res=1;
        }else{
            $res='Đăng nhập thất bại, bạn vui lòng nhập email và mật khẩu đăng nhập';
        }
    }else{
        if($username_login==''&&$password_login==''){
            $res='Bạn vui lòng nhập email và mật khẩu đăng nhập';
        }else{
            if($username_login==''){
                $res='Bạn vui lòng nhập nhập email đăng nhập';
            }
            if($password_login==''){
                $res='Bạn vui lòng nhập nhập mật khẩu đăng nhập';
            }
        }
    }
}else{
    $res='Bạn vui lòng nhập email và mật khẩu đăng nhập';
}
echo $res;