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
$res =array(
    'success'=>0,
    'mess'=>'Đăng nhập thất bại, bạn vui kiểm tra email và mật khẩu đăng nhập'
);
if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['email'])){
    $id=_returnPostParamSecurity('id');
    $name=_returnPostParamSecurity('name');
    $email=_returnPostParamSecurity('email');
    $mail_create = _return_mc_decrypt(_returnPostParamSecurity('mail_create'), '');
    if($id!=''&&$name!=''&&$email!=''&&$mail_create!=''){
        $pas_old='az_'.$id.rand(1,100);
        $Pass = hash_pass($pas_old);
        $dk_check_user = "user_email ='" . $email . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if(count($data_check_exist_user)>0){
            if($data_check_exist_user[0]->status==1){
                $user_login=new user((array)$data_check_exist_user[0]);
                $user_login->memori_login=$rememberme;
                $user_login->time_token=_returnGetDateTime();
                $rand_token_code=_return_mc_encrypt(_returnRandString(15));
                $user_login->token_code=$rand_token_code;
                user_update($user_login);
                $res['success'] = 1;
                $res['login'] = 1;
                if($data_check_exist_user[0]->avatar=="")
                {
                    $avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
                }
                else{
                    $avatar=SITE_NAME.$data_check_exist_user[0]->avatar;
                }
                $res['user_sec'] = array(
                    'id'=>_return_mc_encrypt($data_check_exist_user[0]->id,ENCRYPTION_KEY,1),
                    'name'=>_return_mc_encrypt($data_check_exist_user[0]->name,ENCRYPTION_KEY,1),
                    'user_email'=>_return_mc_encrypt($data_check_exist_user[0]->user_email,ENCRYPTION_KEY,1),
                    'user_code'=>_return_mc_encrypt($data_check_exist_user[0]->user_code,ENCRYPTION_KEY,1),
                    'created'=>_return_mc_encrypt($data_check_exist_user[0]->created,ENCRYPTION_KEY,1),
                    'avatar'=>_return_mc_encrypt($avatar,ENCRYPTION_KEY,1),
                    'token_code'=>_return_mc_encrypt($rand_token_code,ENCRYPTION_KEY,1),
                    'time_token'=>_return_mc_encrypt($user_login->time_token,ENCRYPTION_KEY,1),
                );
            }else{
                if($data_check_exist_user[0]->status==2){
                    $res['mess']='Tài khoản của bạn đã bị khóa, bạn vui lòng liên hệ với AZBOOKING.VN để được giải đáp';
                }else{
                    $res['mess']='Tài khoản của bạn chưa được kích hoạt, bạn vui lòng thử lại sau';
                }
            }

        }else{
            $mail_create = str_replace('[username_dangky]', $name, $mail_create);
            $mail_create = str_replace('[user_email]', $email, $mail_create);
            $mail_create = str_replace('[user_password]', $pas_old, $mail_create);
            $dangky = new user();
            $dangky->name = $name;
            $dangky->user_email = $email;
            $dangky->user_name = $email;
            $dangky->password = $Pass;
            $dangky->created = _returnGetDateTime();
            $dangky->login_two_steps = 0;
            $dangky->status = 1;
            $dangky->user_role = 2;
            $dangky->time_token=_returnGetDateTime();
            $rand_token_code=_return_mc_encrypt(_returnRandString(15));
            $dangky->token_code=$rand_token_code;
            $subject = "Thông báo đăng ký tài khoản tại AZBOOKING.VN";
            if (SendMail($email, $mail_create, $subject, 1, 'AZBOOKING.VN')) {
                $dangky->user_code = _randomBooking('az', 'user_count');
                user_insert($dangky);
                $dk_check_user = "user_email ='" . $email . "'";
                $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
                $res['success'] = 1;
                $res['dang_ky'] = 1;
                $res['mess'] = 'Azbooking.vn cảm ơn quý khách đã đăng ký tài khoản tiếp thị liên kết.';
                $res['user_sec'] = array(
                    'id'=>_return_mc_encrypt($data_check_exist_user[0]->id,ENCRYPTION_KEY,1),
                    'name'=>_return_mc_encrypt($data_check_exist_user[0]->name,ENCRYPTION_KEY,1),
                    'user_email'=>_return_mc_encrypt($data_check_exist_user[0]->user_email,ENCRYPTION_KEY,1),
                    'user_code'=>_return_mc_encrypt($data_check_exist_user[0]->user_code,ENCRYPTION_KEY,1),
                    'created'=>_return_mc_encrypt($data_check_exist_user[0]->created,ENCRYPTION_KEY,1),
                    'avatar'=>_return_mc_encrypt(SITE_NAME.'/view/default/themes/images/no-avatar.png',ENCRYPTION_KEY,1),
                    'token_code'=>_return_mc_encrypt($rand_token_code,ENCRYPTION_KEY,1),
                    'time_token'=>_return_mc_encrypt($user_login->time_token,ENCRYPTION_KEY,1),
                );
            }
        }

    }else{
        if($username_login==''&&$password_login==''){
            $res['mess']='Bạn vui lòng nhập email và mật khẩu đăng nhập';
        }else{
            if($username_login==''){
                $res['mess']='Bạn vui lòng nhập nhập email đăng nhập';
            }
            if($password_login==''){
                $res['mess']='Bạn vui lòng nhập nhập mật khẩu đăng nhập';
            }
        }
    }
}else{
    $res['mess']='Bạn vui lòng nhập email và mật khẩu đăng nhập';
}
echo json_encode($res);