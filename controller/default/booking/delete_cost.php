<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../../config.php';
}
require_once DIR.'/controller/default/public.php';
$data=array();
if (_returnCheckAction(35) == 0) {
    echo 0;
    exit;
}
if(isset($_GET['id'])&&$_GET['id']!=""&&isset($_GET['booking_id'])&&$_GET['booking_id']!=""){

    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data_user=booking_cost_getById($id);
    if(count($data_user)==0)
    {
        echo 0;
    }
    $new_obj= new customer();
    $new_obj->id=$id;
    booking_cost_delete($new_obj);
    _insertLog($_SESSION['user_id'],6,6,35,$id,'','',$_SESSION['user_name'].' đã xóa chi phí "'.$data_user[0]->name.'"');
    echo 1;
}
else{
    echo 0;
}