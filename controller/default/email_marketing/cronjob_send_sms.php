<?php
define("SITE_NAME", "http://manage.mixtourist.com.vn");
define("DIR", str_replace('/controller/default/email_marketing','',dirname(__FILE__)));
define('SERVER','localhost');
define('DB_USERNAME','mixtourvn_manage');
define('DB_PASSWORD','m2SjhVJT6R');
define('DB_NAME','mixtourvn_manage');
define('CACHE',false);
define('DATETIME_FORMAT',"y-m-d H:i:s");
define('DATETIME_FORMAT_VN',"d-m-y H:i:s");
define('PRIVATE_KEY','hoidinhnvbk');

require_once DIR . '/model/userService.php';
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/sms_emailService.php';
require_once DIR . '/model/short_codeService.php';
require_once DIR . '/model/logService.php';
require_once DIR . '/common/class.phpmailer.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time_now=gmdate("Y-m-d H:i:s", time());
$data_short_code_cus=short_code_getByTop('','type=1','position asc');
$data_short_code_user=short_code_getByTop('','type=2','position asc');

$dk_find="status=1 and date_time_send<='".$time_now."'";
$data_email=sms_email_getByTop('',$dk_find,'id desc');
$content_email_customer='';
$content_email_user='';
$content_sms_customer='';
$content_sms_user='';
$title_email='';
if(count($data_email)>0){
    foreach($data_email as $row){
        $customer=trim($row->customer,',');
        $user=trim($row->user,',');
        $title_email=$row->title;

            if($customer!=''){
                $array_customer=explode(',',$customer);
                if(count($array_customer)>0){
                    returnStringReplace($title_email,$array_customer,$data_short_code_cus,0,$row->content_email,$row->content_sms,$row);
                }
            }
            if($user!=''){
                $array_user=explode(',',$user);
                if(count($array_user)>0){
                     returnStringReplace($title_email,$array_user,$data_short_code_user,1,$row->content_email,$row->content_sms,$row);
                }
            }
    }
}
function returnStringReplace($title_email,$array_customer,$data_short_code_cus, $type_user=0,$content_email,$content_sms,$row){
    // type_user=0 là khách hàng
    // type_user=1 là user
    $count_success_sms=0;
    $count_success_email=0;
    $cus_false_sms=0;
    $cus_false_email=0;
    $content_sms_false='';
    $content_email_false='';
    $content_sms_true='';
    $content_email_true='';
    if($type_user==0){
        foreach($array_customer as $row_cus){
            $content_res_sms=$content_sms;
            $content_res_email=$content_email;
            $title_res=$title_email;
            $data_customer=customer_getById($row_cus);
            if(count($data_customer)>0){
                $data_customer=(array)$data_customer[0];
                foreach($data_short_code_cus as $row_short_code)
                {
                    if(strpos($content_sms,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_customer[$field])){
                            $content_res_sms=str_replace($row_short_code->name,LocDau($data_customer[$field]),$content_res_sms);
                        }
                    }
                    if(strpos($content_email,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_customer[$field])){
                            $content_res_email=str_replace($row_short_code->name,$data_customer[$field],$content_res_email);
                        }
                    }

                    if(strpos($title_res,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_customer[$field])){
                            $title_res=str_replace($row_short_code->name,$data_customer[$field],$title_res);
                        }
                    }
                }

                    if($content_res_sms!='')
                    {
                        // send sms
                    }
                if($content_res_email!='')
                {
                        // send email
                        if($title_res==''){
                            $title_res="Chăm sóc khách hàng";
                        }
                        $email_suc=SendMail($data_customer['email'], $content_res_email, $title_res);
                        if($email_suc==1){
                            $count_success_email=$count_success_email+1;
                            $content_email_true.="<p>Khách hàng: ".$data_customer['name']." - ".$data_customer['email']."</p>";
                        }else{
                            $content_email_false.="<p>Khách hàng: ".$data_customer['name']." - ".$data_customer['email']." : ".$email_suc."</p>";
                            $cus_false_email=$cus_false_email+1;
                        }
                }
            }

        }

    }else{
        foreach($array_customer as $row_cus){
            $content_res_sms=$content_sms;
            $content_res_email=$content_email;
            $title_res=$title_email;
            $data_user=user_getById($row_cus);
            if(count($data_user)>0){
                $data_user=(array)$data_user[0];
                foreach($data_short_code_cus as $row_short_code)
                {
                    if(strpos($content_sms,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_user[$field])){
                            $content_res_sms=str_replace($row_short_code->name,LocDau($data_user[$field]),$content_res_sms);
                        }
                    }
                    if(strpos($content_email,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_user[$field])){
                            $content_res_email=str_replace($row_short_code->name,$data_user[$field],$content_res_email);
                        }
                    }
                    if(strpos($title_res,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_user[$field])){
                            $title_res=str_replace($row_short_code->name,$data_user[$field],$title_res);
                        }
                    }
                }

                if($content_res_sms!='')
                {
                    // send sms
                }
                if($content_res_email!='')
                {
                        // send email
                        if($title_res==''){
                            $title_res="Thông báo";
                        }
                        $email_suc=SendMail($data_user['user_email'], $content_res_email, $title_res);
                        if($email_suc==1){
                            $count_success_email=$count_success_email+1;
                            $content_email_true.="<p>User: ".$data_user['name']." - ".$data_user['user_email']."</p>";
                        }else{
                            $content_email_false.="<p>User: ".$data_user['name']." - ".$data_user['user_email']." : ".$email_suc."</p>";
                            $cus_false_email=$cus_false_email+1;
                        }
                }
            }
        }

    }
    $new=new sms_email((array)$row);
    if($count_success_email>0||$count_success_sms>0){
        $new->status=2;
    }else{
        $new->status=1;
    }
    $new->count_success_sms=$count_success_sms;
    $new->count_success_email=$count_success_email;
    $new->cus_false_sms=$cus_false_sms;
    $new->cus_false_email=$cus_false_email;
    $new->content_sms_false=$content_sms_false;
    $new->content_email_false=$content_email_false;
    $new->content_sms_true=$content_sms_true;
    $new->content_email_true=$content_email_true;
    sms_email_update($new);
    if($row->type==0){
        $form_id=14;
        $action_id=29;
    }else{
        $form_id=13;
        $action_id=25;
    }
    _insertLog($row->created_by,7,$form_id,$action_id,$row->id,$content_sms_true.$content_sms_false,$content_email_true.$content_email_false,'Hệ thống tự động gửi Email - SMS "'.$row->code.'"');

//    return $content;

}

function LocDau($str)
{
    if(!$str) return false;
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẽ|Ẻ|Ẹ|Ê|Ề|Ế|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Õ|Ỏ|Ọ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ũ|Ủ|Ụ|U|Ư|Ừ|Ứ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
    return $str;
}

function SendMail($Sendto,$Body,$Subject)
{
    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";

    $mail->IsSMTP();

    $mail->SMTPDebug = 0;

    $mail->Debugoutput = "html";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = 'manage.system.mixtourist@gmail.com';
    $mail->Password = 'ttulgbiqnksxueze';
    $mail->SetFrom('thanhtuyen@mixmedia.vn', 'Hệ thống quản lý MIXTOURIST');
    $mail->AddReplyTo('thanhtuyen@mixmedia.vn', "");
    $mail->AddAddress($Sendto,'');
    $mail->Subject = "" . $Subject . "";
    $mail->MsgHTML("" . $Body . "");
    $mail->AltBody = "" . $Subject . "";

    if (!$mail->Send()) {
        return '<span style="color:red">'.$mail->ErrorInfo.'</span>';
    } else {
        return 1;
    }
}
function _insertLog($user_id, $module_id, $form_id, $action_id, $item_id, $value_old, $value_new, $description)
{
    $log_model = new log();
    $log_model->user_id = $user_id;
    $log_model->module_id = $module_id;
    $log_model->form_id = $form_id;
    $log_model->action_id = $action_id;
    $log_model->item_id = $item_id;
    $log_model->value_old = $value_old;
    $log_model->value_new = $value_new;
    $log_model->description = $description;
    $log_model->created =gmdate("Y-m-d H:i:s", time());
    log_insert($log_model);
}
