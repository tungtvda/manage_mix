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

    if($status==1 ||$status==2){
        if($status==1){
            $name_noti = 'Admin "'.$_SESSION['user_name'].'" đã xác nhận tour "' . $data_user[0]->name_tour . '"';
        }else{
            $name_noti = 'Admin "'.$_SESSION['user_name'].'" đã hủy tour "' . $data_user[0]->name_tour . '"';
        }

        $link_noti = SITE_NAME_AZ.'/tiep-thi-lien-ket/tour-yeu-cau?noti=1&confirm=1&id=' . _return_mc_encrypt($id, ENCRYPTION_KEY);
        _insertNotification($name_noti, $_SESSION['user_id'], $data_user[0]->user_id, $link_noti, 0, '');
    }

    echo 1;
}
else{
    echo 'Bạn vui lòng kiểm tra thông tin tour';
}