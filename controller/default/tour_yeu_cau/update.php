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

if(isset($_POST['id'])&&isset($_POST['value'])&&isset($_POST['note_confirm'])){
    $id=_returnPostParamSecurity('id');
    $status=_returnPostParamSecurity('value');
    $note_confirm=_returnPostParamSecurity('note_confirm');
    $data_user=tour_create_user_getById($id);
    if(count($data_user)==0)
    {
        echo 'Không tồn tại tour yêu cầu trong hệ thống trong hệ thống';
        exit;
    }
    $new =new tour_create_user((array)$data_user[0]);
    $new->status=$status;
    $new->note_confirm=$note_confirm;
    $new->admin_confirm=$_SESSION['user_id'];
    tour_create_user_update($new);
    echo 1;
}
else{
    echo 'Bạn vui lòng kiểm tra thông tin tour';
}