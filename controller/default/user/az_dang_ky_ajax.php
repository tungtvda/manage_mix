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
if (isset($_POST['mail_create']) && isset($_POST['email_dangky']) && isset($_POST['username_dangky'])&& isset($_POST['password_dangky'])&& isset($_POST['confirm_password_dangky'])&& isset($_POST['confirm_res'])) {

    $user_email = _returnPostParamSecurity('email_dangky');
    $mail_create = _return_mc_decrypt(_returnPostParamSecurity('mail_create'),'');
    $name =_returnPostParamSecurity('username_dangky');
    $password =_returnPostParamSecurity('password_dangky');
    $password_confirm =_returnPostParamSecurity('confirm_password_dangky');
    $confirm_res = _returnPostParamSecurity('confirm_res');
    if($user_email!=''&&$name!=''&&$password!=''&&$password_confirm!=''&&$confirm_res==1&&$mail_create!=''){
        $dk_check_user = "user_email ='" . $user_email . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $array_res['mess']='Email đã tồn tại trong hệ thống, vui lòng nhập email khác';
        }else{
            if($password!=$password_confirm){
                $array_res['mess']='Hai mật khẩu không khớp';
            }else{
                $link_check='xac-nhan-dang-ky/?key='._return_mc_encrypt($user_email,ENCRYPTION_KEY,1);
                $mail_create=str_replace('[username_dangky]',$user_email,$mail_create);
                $mail_create=str_replace('[link_dangky]',$link_check,$mail_create);
                $dangky = new user();
                $dangky->name=$name;
                $dangky->user_email=$user_email;
                $Pass=hash_pass($password);
                $dangky->password=$Pass;
                $dangky->created=_returnGetDateTime();
                $dangky->login_two_steps=1;
                $dangky->user_role=2;
//                user_insert($dangky);
                $subject = "Thông báo đăng ký tài khoản tại AZBOOKING.VN";
                if(SendMail($user_email, $mail_create, $subject,1)){
                    $dangky->user_code=_randomBooking('az','user_count');
                    $array_res['success']=1;
                    $array_res['mess']='Azbooking.vn cảm ơn quý khách đã đăng ký tài khoản tiếp thị liên kết. Quý khách vui lòng truy cập email <b style="color: #2e7ec7">'.$user_email.'</b>  để xác thực tài khoản.';
                }

            }
        }
    }
}
echo json_encode($array_res);