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
    'mess' => 'Xác nhận tài khoản lỗi, vui lòng thử lại'
);
if (isset($_POST['mail_confirm']) && isset($_POST['mail_send'])) {

    $mail_confirm = _return_mc_decrypt(_returnPostParamSecurity('mail_confirm'), '');
    $mail_send = _returnPostParamSecurity('mail_send');

    if ($mail_confirm != '' && $mail_send != '' ) {
        $mail_send=base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($mail_send)))));
        $dk_check_user = "user_email ='" . $mail_send . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $dangky = new user((array)$data_check_exist_user[0]);
            $dangky->status=1;
            $link_check = 'thanh-vien/';
            $mail_confirm = str_replace('[username_dangky]', $data_check_exist_user[0]->name, $mail_confirm);
            $mail_confirm = str_replace('[link_dangky]', $link_check, $mail_confirm);
            $subject = "Thông báo xác nhận tài khoản AZBOOKING.VN";
            if (SendMail($data_check_exist_user[0]->user_email, $mail_confirm, $subject, 1, 'AZBOOKING.VN')) {
                $dangky->user_code = _randomBooking('az', 'user_count');
                user_update($dangky);
                $array_res['success'] = 1;
                $array_res['mess'] = 'Azbooking.vn xác nhận tài khoản của bạn đã đã được kích hoạt, Bạn hãy đăng nhập để bắt đầu chiến dịch tiếp thị liên kết';
            }
        }
    }
}
echo json_encode($array_res);