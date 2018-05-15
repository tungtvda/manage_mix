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
require_once DIR . '/email_template/tem_01_2018/index.php';
$data = array();
$res =array(
    'success'=>0,
    'mess'=>'Đăng nhập thất bại, bạn vui kiểm tra email và mật khẩu đăng nhập'
);
if(isset($_POST['username_login'])&&isset($_POST['password_login'])){
    $username_login=_returnPostParamSecurity('username_login');
    $password_login=_returnPostParamSecurity('password_login');
    $rememberme=_returnPostParamSecurity('rememberme');
    if($username_login!=''&&$password_login!=''){
        $Pass = hash_pass($password_login);
        $dk_check_user = "user_role=2 and user_email ='" . $username_login . "' and password='".$Pass."'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if(count($data_check_exist_user)>0){
            if($data_check_exist_user[0]->status==1){
                $user_login=new user((array)$data_check_exist_user[0]);
                $user_login->memori_login=$rememberme;
                $user_login->time_token=_returnGetDateTime();
                $rand_token_code=_return_mc_encrypt(_returnRandString(15));
                $user_login->token_code=$rand_token_code;
                if($data_check_exist_user[0]->login_two_steps==1){
                    $rand_string=_returnRandString(15);
                    $user_login->code_login=$rand_string;

                    $email_tem = returnEmail01218();
                    $email_tem = _returnReplaceEmailTem($email_tem);
                    $email_tem = str_replace('{{TITLE}}', 'Mã đăng nhập vào hệ thống AZBOOKING.VN', $email_tem);
                    $content = '  <div class="content_data" style="float: left; width: 100%">
                                            <div style="float: left;width: 100%">
                                                <p style="font-weight: normal">
                                                <p style="font-weight: normal; line-height: 25px">Mã đăng nhập: <b style="color: #0091ea;"> ' . $rand_string . '</b></p>
                                                <p>Bạn hãy nhập mã <b style="color: #0091ea;">' . $rand_string . '</b> để đăng nhập được vào hệ thống</p>
                                                
                                            </div>
                                         
                                          
                                        </div>';
                    $email_tem = str_replace('{{CONTENT}}', $content, $email_tem);
                    $subject = "Mã đăng nhập vào hệ thống AZBOOKING.VN";
                    if (SendMail($data_check_exist_user[0]->user_email, $email_tem, $subject, 1, 'AZBOOKING.VN')) {
                        user_update($user_login);
                        $res['success'] = 2;
                        $res['user_sec'] = array(
                            'email'=>_return_mc_encrypt($data_check_exist_user[0]->user_email,ENCRYPTION_KEY,1)
                        );
                        $res['mess'] = 'Azbooking.vn đã gửi mã đăng nhập về mail của bạn, bạn vui lòng kiểm tra email';
                    }
                }else{
                    user_update($user_login);
                    $res['success'] = 1;
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
                    $res['mess']='';
                }
            }else{
                if($data_check_exist_user[0]->status==2){
                    $res['mess']='Tài khoản của bạn đã bị khóa, bạn vui lòng liên hệ với AZBOOKING.VN để được giải đáp';
                }else{
                    $res['mess']='Tài khoản của bạn chưa được kích hoạt, bạn vui lòng thử lại sau';
                }
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