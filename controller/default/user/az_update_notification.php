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
$res = array(
    'success' => 0,
);
if (isset($_POST['noti_name'])) {
    $data_user = json_decode(_return_mc_decrypt($_POST['noti_name']), true);
    if (isset($data_user['id']) && isset($data_user['name']) && isset($data_user['user_email']) && isset($data_user['user_code']) && isset($data_user['token_code'])) {
        $id = _return_mc_decrypt($data_user['id']);
        $name = _return_mc_decrypt($data_user['name']);
        $user_email = _return_mc_decrypt($data_user['user_email']);
        $user_code = _return_mc_decrypt($data_user['user_code']);
        $token_code = _return_mc_decrypt($data_user['token_code']);
        $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $notification_obj = new notification();
            $notification_obj->status = 2;
            notification_update_list($notification_obj, $dk = 'user_id=' . $id . ' and status=0');
            $count_un_read = notification_count('status=2 and user_id=' . $id);
            $res['success']=1;
            $res['count_un_read']=$count_un_read;
        }
    }
}


echo json_encode($res);