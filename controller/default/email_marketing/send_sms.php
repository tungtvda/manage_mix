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
    $content_email='';
    if(isset( $_POST['content_email'])){
        $content_email = $_POST['content_email'];
    }
    $title_sms = _returnPostParamSecurity('title');
    $date_send = _returnPostParamSecurity('date_send');
    $time_send = _returnPostParamSecurity('time_send');
    $title = _returnPostParamSecurity('title');
    $id_record = _returnPostParamSecurity('id');
    $date_time_send =_returnGetDateTime();
    if($date_send!=''&&$time_send!=''){
        $date_time_send =date('Y-m-d', strtotime($date_send)).' '.$time_send;
    }
    if($date_send!=''){
        $date_send =date('Y-m-d', strtotime($date_send));
    }else{
        $date_send =_returnGetDateTime();
    }
    $arr_cus = $_POST['customer_birthday'];
    if($title==''){
        $title="Chúc mừng sinh nhật khách hàng";
    }

    // type =0 là chăm sóc khách hàng
    // type =1 là chúc mừng sinh nhật
    $type=0;
    if (isset($_POST['type'])) {
        $type = _returnPostParamSecurity('type');
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
        $array_check_push=array();
        foreach ($arr_cus as $row) {
            $id = addslashes(strip_tags(trim($row)));
            $cus_data = customer_getById($id);
            if (count($cus_data) > 0) {
                if(!in_array($cus_data[0]->id,$array_check_push)){
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
                    array_push($array_check_push,$cus_data[0]->id);
                }


            }
        }

        if($id_record!=''){
            $data_email_sms=sms_email_getById($id_record);
            if(count($data_email_sms)==0){
                echo  'Không tồn tại bản ghi với id='.$id_record;
                exit;
            }else{
                $insert = new sms_email((array)$data_email_sms[0]);
                $insert->update_by = $_SESSION['user_id'];
                $insert_check=0;
            }
        }else{
            $code=_randomBooking('#','sms_email_count','code');
            $insert = new sms_email();
            $insert->code = $code;
            $insert->count_success_sms = 0;
            $insert->count_success_email = 0;
            $insert->cus_false_sms = 0;
            $insert->cus_false_email = 0;
            $insert->created =  _returnGetDateTime();
            $insert->created_by = $_SESSION['user_id'];
            $insert->update_by = 0;
            $insert_check=1;
        }

        $insert->user = '';
        $insert->type = $type;
        $insert->customer =$string_cus;
        $insert->title = $title;
        $insert->content_sms = $message_sms;
        $insert->content_email = $content_email;
        $insert->status = $status;
        $insert->count_cus = $count_cus;
        $insert->date_send = $date_send;
        $insert->date_time_send = $date_time_send;
        $insert->updated =  _returnGetDateTime();

        if($type==1){
            $form=13;
            if($insert_check==1){
                $action=25;
                if (_returnCheckAction(25) == 0) {
                    echo 'Bạn không có quyền thực hiện thêm tin nhắn';
                    exit;
                }
                $mess_log='User '.$_SESSION['user_name'].' đã thực hiện tại tin nhắn chúc mừng sinh nhật khách hàng';
            }else{
                $action=26;
                if (_returnCheckAction(26) == 0) {
                    echo 'Bạn không có quyền thực hiện sửa tin nhắn';
                    exit;
                }
                $mess_log='User '.$_SESSION['user_name'].' đã thực hiện sửa tin nhắn chúc mừng sinh nhật khách hàng';
            }


        }else{
            $form=14;
            if($insert_check==1){
                $action=29;
                if (_returnCheckAction(29) == 0) {
                    echo 'Bạn không có quyền thực hiện thêm tin nhắn';
                    exit;
                }
                $mess_log='User '.$_SESSION['user_name'].' đã thực hiện tạo tin nhắn chăm sóc khách hàng';
            }else{
                $action=30;
                if (_returnCheckAction(30) == 0) {
                    echo 'Bạn không có quyền thực hiện sửa tin nhắn';
                    exit;
                }
                $mess_log='User '.$_SESSION['user_name'].' đã thực hiện sửa tin nhắn chăm sóc khách hàng';
            }

        }
        if($insert_check==1){
            sms_email_insert($insert);
            $data_res=sms_email_getByTop('1','code="'.$code.'"','id desc');
            if(count($data_res)>0)
            {
                $id_record=$data_res[0]->id;
                echo 1;
            }
            else{
                echo  'Lưu thất bại';
            }
        }else{
            sms_email_update($insert);
            echo 1;
        }
        _insertLog($_SESSION['user_id'],7,$form,$action,$id_record,'','',$mess_log);


    }
} else {
    echo 'Cập nhật trạng thái thất bại, vui lòng kiểm tra lại các tham số';
}
