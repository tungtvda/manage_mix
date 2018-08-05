<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 7/27/2018
 * Time: 10:32 AM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/email_template/tem_hotel_07_2018/index.php';
 $email_tem = returnEmailHotel01218();
$message=(isset($_POST['content']))?_return_mc_decrypt($_POST['content']):'';
$hotel_sales=(isset($_POST['hotel_sales']))?_return_mc_decrypt($_POST['hotel_sales']):'';
$link=(isset($_POST['link']))?(_return_mc_decrypt($_POST['link'])):'';
$email_tem=str_replace('{{CONTENT}}',$message,$email_tem);
$email_tem=str_replace('{{TOUR_NOI_BAT}}',$hotel_sales,$email_tem);
$email_tem=str_replace('{{LINK_DETAIL}}',$link,$email_tem);
$email_tem=_returnReplaceEmailTemHotel($email_tem);
$name = _returnPostParamSecurity('name');
$email = _returnPostParamSecurity('email');
$code = _returnPostParamSecurity('code_send');
if($name && $email && $code){


    $subject_admin='Xác nhận đơn hàng '.$code;
    $email_tem_admin=str_replace('{{TITLE}}',$subject_admin,$email_tem);
    $res_email=SendMail(SEND_EMAIL, $email_tem_admin, $subject_admin,1);

    $subject='Thông báo đặt hàng thành công cho đơn hàng "'.$code.'"';
    $email_tem_user=str_replace('{{TITLE}}',$subject,$email_tem);
    $res_email=SendMail($email, $email_tem_user, $subject,1);
}
