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
require_once(DIR."/common/hash_pass.php");
$data = array();
$res = array(
    'success' => 0,
    'mess' => 'Lỗi! bạn vui lòng F5 và thử lại',
);
if (isset($_POST['pass_old']) && isset($_POST['pass'])&& isset($_POST['pass_confirm']) && isset($_POST['form_noti'])) {
    $id = '';
    $name = '';
    $user_email = '';
    $user_code = '';
    $token_code = '';
   foreach($_POST['form_noti'] as $row_check){
       if(isset($row_check['name']) && isset($row_check['value'])){
           if($row_check['name']=='id'){
               $id = _return_mc_decrypt($row_check['value']);
           }
           if($row_check['name']=='name'){
               $name = _return_mc_decrypt($row_check['value']);
           }
           if($row_check['name']=='user_email'){
               $user_email = _return_mc_decrypt($row_check['value']);
           }
           if($row_check['name']=='user_code'){
               $user_code = _return_mc_decrypt($row_check['value']);
           }
           if($row_check['name']=='token_code'){
               $token_code = _return_mc_decrypt($row_check['value']);
           }
       }
   }
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        $user =new user((array)$data_check_exist_user[0]);
        $pass_old=_returnPostParamSecurity('pass_old');
        $Pass_check=hash_pass($pass_old);
        $pass=_returnPostParamSecurity('pass');
        $pass_confirm=_returnPostParamSecurity('pass_confirm');
        if($Pass_check!=$data_check_exist_user[0]->password){
            $res['mess']="Mật khẩu cũ không chính xác";
        }
        else{
            if($pass!=$pass_confirm){
                $res['mess']= "Hai mật khẩu không khớp";
            }else{
                $user->password=hash_pass($pass);
                user_update($user);
                $res['success']=1;
            }
        }
    }
}

echo json_encode($res);