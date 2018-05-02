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
if(isset($_GET['type'])&&$_GET['type']==1){
    $form=13;
    $action_xoa=27;
}
else{
    $form=14;
    $action_xoa=31;
}

if (_returnCheckAction($action_xoa) == 0) {
    echo 0;
    exit;
}
if(isset($_GET['id'])&&$_GET['id']!=""){

    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data_user=sms_email_getById($id);
    if(count($data_user)==0)
    {
        echo 0;
    }
    $new_obj= new customer();
    $new_obj->id=$id;
    sms_email_delete($new_obj);
    _insertLog($_SESSION['user_id'],7,$form,$action_xoa,$id,'','',$_SESSION['user_name'].' đã xóa tin nhắn "'.$data_user[0]->code.'"');
    echo 1;
}
else{
    echo 0;
}