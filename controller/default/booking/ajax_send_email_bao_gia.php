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

$data = array();
$res = array(
    'success' => 0,
);
$user_data=array();
if(isset($_POST['email_cus_submit'])){
    $email_cus_submit=_returnPostParamSecurity('email_cus_submit');
    $email_cus_submit='';
    if(isset($_POST['content_email'])){
        $email_cus_submit=$_POST['content_email'];
    }

//    print_r($_POST);
    print_r($_FILES['file_email']);
    exit;
    $subject = 'Xác nhận đơn hàng ';
    SendMail($email_cus_submit,$email_cus_submit, $subject,'','','',$_FILES['file_email']);
    print_r($_FILES['file_attack']);
    exit;
}
echo json_encode($user_data);