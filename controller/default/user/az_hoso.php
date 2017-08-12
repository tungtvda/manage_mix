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
$data = array();
$res = array(
    'success' => 0,
    'hoa_hong' => 0,
);
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['user_email']) && isset($_POST['user_code']) && isset($_POST['token_code'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $name = _return_mc_decrypt(_returnPostParamSecurity('name'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $user_code = _return_mc_decrypt(_returnPostParamSecurity('user_code'));
    $token_code = _return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        unset($data_check_exist_user[0]->password);
        unset($data_check_exist_user[0]->token_code);
        unset($data_check_exist_user[0]->time_token);
        if($data_check_exist_user[0]->avatar=="")
        {
            $data_check_exist_user[0]->avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
        }
        else{
            $data_check_exist_user[0]->avatar=SITE_NAME.$data_check_exist_user[0]->avatar;
        }
        $res['user']=$data_check_exist_user[0];
        $res['success']=1;
    }
}
else{
    if(isset($_POST['id'])){
        $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
        $data_check_exist_user = user_getById($id);
        if (count($data_check_exist_user) > 0) {
            unset($data_check_exist_user[0]->password);
            unset($data_check_exist_user[0]->token_code);
            unset($data_check_exist_user[0]->time_token);
            if ($data_check_exist_user[0]->avatar == "") {
                $data_check_exist_user[0]->avatar = SITE_NAME . '/view/default/themes/images/no-avatar.png';
            } else {
                $data_check_exist_user[0]->avatar = SITE_NAME . $data_check_exist_user[0]->avatar;
            }
            $res['user'] = array(
                'code' => $data_check_exist_user[0]->user_code
            );
            $res['success'] = 1;
        }
    }
}
echo json_encode($res);