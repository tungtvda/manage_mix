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
$array_res = array(
    'success' => 0,
    'mess' => 'Reset mật khẩu lỗi, vui lòng thử lại'
);
if (isset($_POST['email_forget']) && isset($_POST['value']) && isset($_POST['key'])) {

    $mail_send = _returnPostParamSecurity('email_forget');
    $email = _returnPostParamSecurity('value');
    $key = _returnPostParamSecurity('key');

    if ($mail_send != '' && $mail_send != '' &&  $key!='') {
        $dk_check_user = "user_email ='" . $mail_send . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $pas_word = _returnRandomString();
            $mail_confirm = str_replace('[username_dangky]', $data_check_exist_user[0]->name, $mail_confirm);
            $mail_confirm = str_replace('[pass_new]', $pas_word, $mail_confirm);
            $subject = "Thông báo reset mật khẩu AZBOOKING.VN";
            if (SendMail($data_check_exist_user[0]->user_email, $mail_confirm, $subject, 1, 'AZBOOKING.VN')) {
                $dangky = new user((array)$data_check_exist_user[0]);
                $dangky->password=hash_pass($pas_word);
                user_update($dangky);
                $array_res['success'] = 1;
                $array_res['mess'] = 'Bạn vui lòng kiểm tra email để nhận mật khẩu mới';
            }
        }
    }
}
echo json_encode($array_res);