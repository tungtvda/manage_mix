<?php
if (!defined('DIR')) require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/birthday_sms_emailService.php';
if (isset($_POST['message_birthday']) && isset($_POST['customer_birthday'])) {
    $message_sms = _returnPostParamSecurity('message_birthday');
    $content_email = _returnPostParamSecurity('content_email');
    $arr_cus = $_POST['customer_birthday'];
    $status = 1;
    if (isset($_POST['status'])) {
        $status = _returnPostParamSecurity('status');
    }
    if ($message_sms == '' || count($arr_cus) == 0) {
        if ($message_sms == '') {
            echo 'Bạn vui lòng nhập nội dung tin nhắn';
            exit;
        } else {
            echo 'Bạn vui lòng chọn khách hàng';
            exit;
        }
    } else {
        $string_cus = '';
        $count = 0;
        $count_success_sms=$count_cus = count($arr_cus);
        $cus_false_sms=0;
        foreach ($arr_cus as $row) {
            $id = addslashes(strip_tags(trim($row)));
            $cus_data = customer_getById($id);
            if (count($cus_data) > 0) {
                $name = $cus_data[0]->name;
                $tuoi = _returnGetAge($cus_data[0]->birthday);
                $mess_send = str_replace('[ten_kh]', $name, $message_sms);
                $mess_send = str_replace('[tuoi_kh]', $tuoi, $mess_send);
                if ($count > 0) {
                    $string_cus .= $cus_data[0]->id . ',';
                } else {
                    $string_cus .= ',' . $cus_data[0]->id . ',';
                }
                $count++;

            }
        }
        $insert = new birthday_sms_email();
        $insert->user = '';
        $insert->customer =$string_cus;
        $insert->content_sms = $message_sms;
        $insert->content_email = $content_email;
        $insert->status = $status;
        $insert->count_cus = $count_cus;
        $insert->count_success_sms = $count_success_sms;
        $insert->count_success_email = 0;
        $insert->cus_false_sms = $cus_false_sms;
        $insert->cus_false_email = '';
        $insert->date_send = _returnGetDateTime();
        $insert->created =  _returnGetDateTime();
        $insert->created_by = $_SESSION['user_id'];
        birthday_sms_email_insert($insert);
        echo $string_cus;
    }
} else {
    echo 'Cập nhật trạng thái thất bại, vui lòng kiểm tra lại các tham số';
}
