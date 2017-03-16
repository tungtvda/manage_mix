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
if (_returnCheckAction(19) == 0) {
    echo 0;
    exit;
}
if(isset($_GET['id'])&&$_GET['id']!=""){

    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data_user=booking_getById($id);
    if(count($data_user)==0)
    {
        echo 0;
    }
    $new_obj= new booking();
    $new_obj->id=$id;
    booking_delete($new_obj);
    echo 1;
}
else{
    echo 0;
}