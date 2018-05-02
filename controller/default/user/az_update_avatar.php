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
//print_r($_FILES);
//print_r($_POST);
//exit;
$data = array();
$res = array(
    'success' => 0,
    'mess' => 'Lỗi! bạn vui lòng F5 và thử lại',
);
if (isset($_FILES['avatar']) && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['user_email']) && isset($_POST['user_code']) && isset($_POST['token_code'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $name = _return_mc_decrypt(_returnPostParamSecurity('name'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $user_code = _return_mc_decrypt(_returnPostParamSecurity('user_code'));
    $token_code = _return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        $user =new user((array)$data_check_exist_user[0]);
        $folder = LocDau($data_check_exist_user[0]->user_email);
        $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/users/" . $folder . '/';
        $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/users/" . $folder . '/');
        if ($avatar != '') {
            $user->avatar=$avatar;
            user_update($user);
            $res['success']=1;
            $avatar=SITE_NAME.$avatar;
            $res['avatar_code']=_return_mc_encrypt($avatar);
            $res['avatar']=$avatar;
        }
    }
}
echo json_encode($res);