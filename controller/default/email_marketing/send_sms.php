<?php
if (!defined('DIR')) require_once '../../../config.php';
if (!isset($_SESSION['user_id'])) {
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/sms_emailService.php';
require_once DIR . '/model/logService.php';
if (isset($_POST['message_birthday']) && isset($_POST['customer_birthday'])) {
    $message_sms = _returnPostParamSecurity('message_birthday');
    $content_email = _returnPostParamSecurity('content_email');
    $title_sms = _returnPostParamSecurity('title_sms');
    if($title_sms==''){
        $title_sms="Chúc mừng sinh nhật khách hàng";
    }
    $title_email = _returnPostParamSecurity('title_email');
    $arr_cus = $_POST['customer_birthday'];
    // type =0 là chăm sóc khách hàng
    // type =1 là chúc mừng sinh nhật
    $type=0;
    if (isset($_POST['type'])) {
        $type = _returnPostParamSecurity('type');
    }
    if($type==1){
        $form=13;
        $action=25;
        if (_returnCheckAction(25) == 0) {
            redict(_returnLinkDangNhap());
        }
        $mess_log='User '.$_SESSION['user_name'].' đã thực hiện tại tin nhắn chúc mừng sinh nhật khách hàng';

    }else{
        $form=14;
        $action=29;
        if (_returnCheckAction(29) == 0) {
            redict(_returnLinkDangNhap());
        }
        $mess_log='User '.$_SESSION['user_name'].' đã thực hiện tại tin nhắn chăm sóc khách hàng';
    }
    $status = 0;
    if (isset($_POST['status'])) {
        $status = _returnPostParamSecurity('status');
    }
    if (count($arr_cus) == 0) {
        echo 'Bạn vui lòng chọn khách hàng';
        exit;
    } else {
        $string_cus = '';
        $count = 0;
        $count_cus = count($arr_cus);
        $cus_false_sms=0;
        foreach ($arr_cus as $row) {
            $id = addslashes(strip_tags(trim($row)));
            $cus_data = customer_getById($id);
            if (count($cus_data) > 0) {
//                $name = $cus_data[0]->name;
//                $tuoi = _returnGetAge($cus_data[0]->birthday);
//                $mess_send = str_replace('[ten_kh]', $name, $message_sms);
//                $mess_send = str_replace('[tuoi_kh]', $tuoi, $mess_send);
                if ($count > 0) {
                    $string_cus .= $cus_data[0]->id . ',';
                } else {
                    $string_cus .= ',' . $cus_data[0]->id . ',';
                }
                $count++;

            }
        }
        $code=_randomBooking('#','sms_email_count','code');
        $insert = new sms_email();
        $insert->code = $code;
        $insert->user = '';
        $insert->type = $type;
        $insert->customer =$string_cus;
        $insert->title_sms = $title_sms;
        $insert->title_email = $title_email;
        $insert->content_sms = $message_sms;
        $insert->content_email = $content_email;
        $insert->status = $status;
        $insert->count_cus = $count_cus;
        $insert->count_success_sms = 0;
        $insert->count_success_email = 0;
        $insert->cus_false_sms = 0;
        $insert->cus_false_email = 0;
        $insert->date_send = _returnGetDateTime();
        $insert->date_time_send = $date_check = date('Y-m-d H:i:s', strtotime('+2 minute', strtotime(_returnGetDateTime())));
        $insert->created =  _returnGetDateTime();
        $insert->created_by = $_SESSION['user_id'];
        $insert->updated =  _returnGetDateTime();
        $insert->update_by = 0;
        sms_email_insert($insert);
        $data_res=sms_email_getByTop('1','code="'.$code.'"','id desc');
        if(count($data_res)>0)
        {
            $id=$data_res[0]->id;
            _insertLog($_SESSION['user_id'],7,$form,$action,$id,'','',$mess_log);
            echo 1;
        }
        else{
            echo  'Lưu thất bại';
        }

    }
} else {
    echo 'Cập nhật trạng thái thất bại, vui lòng kiểm tra lại các tham số';
}
