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
if(isset($_GET['id'])&&$_GET['id']!=""){
    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data_user=user_getById($id);
    if(count($data_user)==0)
    {
        redict(SITE_NAME.'/nhan-vien/');
    }
    $new_obj= new user();
    $new_obj->id=$id;
    user_delete($new_obj);
    redict(SITE_NAME.'/nhan-vien/');
}
else{
    redict(SITE_NAME.'/nhan-vien/');
}