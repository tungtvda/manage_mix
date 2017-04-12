<?php

if (!defined('DIR')) require_once '../../../config.php';
echo DIR;
require_once DIR . '/model/userService.php';
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/sms_emailService.php';
require_once DIR . '/model/short_codeService.php';
require_once DIR . '/model/logService.php';
$data_user=user_getById(1);
$new =new user((array)$data_user[0]);
$new->mr="Mrs";
user_update($new);

exit;
$data_short_code_cus=short_code_getByTop('','type=1','position asc');
$time_now=_returnGetDateTime();
$dk_find="status=0 and date_time_send<='".$time_now."'";
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
        if($row->content_email!='')
        {
            if($customer!=''){
                $array_customer=explode(',',$customer);
                if(count($array_customer)>0){
                    returnStringReplace($title_email,$row->content_email,$array_customer,$data_short_code_cus,0,0);
                }
            }
            if($user!=''){
                $array_user=explode(',',$user);
                if(count($array_user)>0){
                     returnStringReplace($title_email,$row->content_email,$array_user,$data_short_code_cus,1,0);
                }
            }
        }

        if($row->content_sms!='')
        {
            if($customer!=''){
                $array_customer=explode(',',$customer);
                if(count($array_customer)>0){
                    returnStringReplace($title_email,$row->content_sms,$array_customer,$data_short_code_cus,0,1);
                }
            }
            if($user!=''){
                $array_user=explode(',',$user);
                if(count($array_user)>0){
                    returnStringReplace($title_email,$row->content_sms,$array_user,$data_short_code_cus,1,1);
                }
            }
        }

    }
}
function returnStringReplace($title_email,$content='',$array_customer,$data_short_code_cus, $type_user=0,$type_content=0){

    // type_user=0 là khách hàng
    // type_user=1 là user
    //$type_content=0 nội dung email
    //$type_content=1 nội dung sms

    if($type_user==0){
        foreach($array_customer as $row_cus){
            $content_res=$content;
            $title_res=$title_email;
            $data_customer=customer_getById($row_cus);
            if(count($data_customer)>0){
                $data_customer=(array)$data_customer[0];
                foreach($data_short_code_cus as $row_short_code)
                {
                    if(strpos($content,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_customer[$field])){
                            if($type_content==1)
                            {
                                $content_res=str_replace($row_short_code->name,LocDau($data_customer[$field]),$content_res);
                            }else{
                                $content_res=str_replace($row_short_code->name,$data_customer[$field],$content_res);
                            }

                        }
                    }
                    if(strpos($title_res,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_customer[$field])){
                            if($type_content==1)
                            {

                            }else{
                                $title_res=str_replace($row_short_code->name,$data_customer[$field],$title_res);
                            }

                        }
                    }
                }
                if($content_res!=''){
                    if($type_content==1)
                    {
                        // send sms

                    }else{
                        // send email
                        if($title_res==''){
                            $title_res="Chăm sóc khách hàng";
                        }
                        SendMail($data_customer['email'], $content_res, $title_res);
                    }

                }
                // send email khach hang
            }

        }

    }else{
        foreach($array_customer as $row_cus){
            $content_res=$content;
            $title_res=$title_email;
            $data_user=user_getById($row_cus);
            if(count($data_user)>0){
                $data_user=(array)$data_user[0];
                foreach($data_short_code_cus as $row_short_code)
                {
                    if(strpos($content,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_user[$field])){
                            if($type_content==1)
                            {
                                $content_res=str_replace($row_short_code->name,LocDau($data_user[$field]),$content_res);
                            }else{
                                $content_res=str_replace($row_short_code->name,$data_user[$field],$content_res);
                            }

                        }
                    }
                    if(strpos($title_res,$row_short_code->name)!=''){
                        $field=$row_short_code->field;
                        if(isset($data_user[$field])){
                            if($type_content==1)
                            {

                            }else{
                                $title_res=str_replace($row_short_code->name,$data_user[$field],$title_res);
                            }

                        }
                    }
                }
                if($content_res!=''){
                    if($type_content==1)
                    {
                        // send sms

                    }else{
                        // send email
                        if($title_res==''){
                            $title_res="Thông báo";
                        }
                        SendMail($data_user['user_email'], $content_res, $title_res);
                    }

                }
            }
        }
    }

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