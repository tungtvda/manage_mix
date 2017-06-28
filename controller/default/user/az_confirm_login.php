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
    'mess'=>'Xác nhận thất bại, bạn vui lòng kiểm tra lại mã xác nhận'
);
if(isset($_POST['ma_xac_nhan'])&&isset($_POST['email'])){
    $code_login=_returnPostParamSecurity('ma_xac_nhan');
    $user_email=_returnPostParamSecurity('email');
    if($code_login!=''&&$user_email!=''){
        $dk_check_user = "user_email ='" . $user_email . "' and code_login='".$code_login."'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if(count($data_check_exist_user)>0){
            if($data_check_exist_user[0]->status==1){
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
                );
                $res['mess']='';
            }else{
                if($data_check_exist_user[0]->status==2){
                    $res['mess']='Tài khoản của bạn đã bị khóa, bạn vui lòng liên hệ với AZBOOKING.VN để được giải đáp';
                }else{
                    $res['mess']='Tài khoản của bạn chưa được kích hoạt, bạn vui lòng thử lại sau';
                }
            }
        }
    }else{
        $res['mess']='Mã xác nhận không đúng, vui lòng thử lại';
    }
}else{
    $res['mess']='Xác nhận lỗi! bạn vui lòng thử lại';
}
echo json_encode($res);