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
require_once DIR . '/common/paging.php';
$data = array();
$res = array(
    'success' => 0,
);
$user_data=array();
if (isset($_POST['id']) && isset($_POST['user_email']) && isset($_POST['main']) && isset($_POST['module'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $main = _return_mc_decrypt(_returnPostParamSecurity('main'));
    $module = _return_mc_decrypt(_returnPostParamSecurity('module'));
    if($id!='' && $user_email=="tungtv.soict@gmail.com" && $main=='azbooking.vn' && $module=='tour'){
        $dk='(user_role=1 or user_role=0) and (status=1)';
       $user_data=user_getByTopCustomField(' id, name ','',$dk,'name asc');
    }
}
echo json_encode($user_data);