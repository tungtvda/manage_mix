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
require_once(DIR."/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$array_res=array(
    'success'=>0,
    'mess'=>'Bạn vui lòng kiểu tra thông tin đăng ký'
);
if (isset($_POST['email_dangky']) && isset($_POST['username_dangky'])&& isset($_POST['password_dangky'])&& isset($_POST['confirm_password_dangky'])&& isset($_POST['confirm_res'])) {
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('email_dangky'), '');
    $name = _return_mc_decrypt(_returnPostParamSecurity('username_dangky'), '');
    $password = _return_mc_decrypt(_returnPostParamSecurity('password_dangky'), '');
    $password_confirm = _return_mc_decrypt(_returnPostParamSecurity('confirm_password_dangky'), '');
    $confirm_res = _return_mc_decrypt(_returnPostParamSecurity('confirm_res'), '');
    if($user_email!=''&&$name!=''&&$password!=''&&$password_confirm!=''&&$confirm_res==1){
        $dk_check_user = "user_email ='" . $user_email . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $array_res['mess']='Email đã tồn tại trong hệ thống, vui lòng nhập email khác';
        }else{
            if($password!=$password_confirm){
                $array_res['mess']='Hai mật khẩu không khớp';
            }else{
                $dangky = new user();
                $dangky->name=$name;
                $dangky->user_email=$email;
                $Pass=hash_pass($password);
                $dangky->password=$Pass;
                $dangky->created=_returnGetDateTime();
                $dangky->login_two_steps=1;
                $dangky->user_role=2;
//                user_insert($dangky);
            }
        }
    }
}
echo json_encode($array_res);