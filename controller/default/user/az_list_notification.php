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
);

if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['user_email'])&&isset($_POST['user_code'])&&isset($_POST['token_code'])&&isset($_POST['time_token'])){
   $id=_return_mc_decrypt(_returnPostParamSecurity('id'));
     $name=_return_mc_decrypt(_returnPostParamSecurity('name'));
     $user_email=_return_mc_decrypt(_returnPostParamSecurity('user_email'));
     $user_code=_return_mc_decrypt(_returnPostParamSecurity('user_code'));
     $token_code=_return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $time_token=_return_mc_decrypt(_returnPostParamSecurity('time_token'));
    $dk_check_user ="id=".$id." and user_email ='" . $user_email . "' and name='".$name."' and user_code='".$user_code."' and token_code ='".$token_code."' and time_token='".$time_token."'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if(count($data_check_exist_user)>0){
        $user_login=new user((array)$data_check_exist_user[0]);
        $user_login->time_token=_returnGetDateTime();
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
            'token_code'=>_return_mc_encrypt($data_check_exist_user[0]->token_code,ENCRYPTION_KEY,1),
            'time_token'=>_return_mc_encrypt($data_check_exist_user[0]->time_token,ENCRYPTION_KEY,1),
        );
    }

}
echo json_encode($res);