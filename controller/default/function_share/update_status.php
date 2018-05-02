<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/notificationService.php';
require_once DIR . '/model/logService.php';
if(!isset($_SESSION['user_id'])){
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
if (isset($_GET['id']) && isset($_GET['table']) && isset($_GET['field']) && isset($_GET['status'])) {
    $id = _returnGetParamSecurity('id');
    $table = _returnGetParamSecurity('table');
    $field = _returnGetParamSecurity('field');
    $status = _returnGetParamSecurity('status');
    if ($id != '' && $table != '' && $field != '' && $status != '') {


        $file_model = $table . 'Service.php';
        require_once DIR . '/model/' . $file_model;

        $function_id = $table . '_getById';
        $data_check = $function_id($id);
        if (count($data_check) > 0) {
            $array = (array)$data_check[0];
            $new = new $table($array);
            switch($table){
                case 'booking':
                    if($data_check[0]->price_tiep_thi!=''&&$data_check[0]->status_tiep_thi!=1&&$data_check[0]->confirm_admin_tiep_thi==0&&$data_check[0]->user_tiep_thi_id!='' && $status==5 && $data_check[0]->confirm_admin!=0){
                        $new=_returnConfirmTiepthi($data_check, 0,1);
                    }
                    break;
            }
            $new->id = $id;
            $new->$field = $status;
            $new->updated = _returnGetDateTime();
            if(isset($_GET['action'])&&$_GET['action']!='')
            {
                $function_update =_returnGetParamSecurity('action');
            }
            else{
                $function_update = $table . '_update_status';
            }
            $function_update($new);
            echo 1;
        } else {
            echo 'Cập nhật trạng thái thất bại, bản ghi không tồn tại trong hệ thống';
        }
    } else {
        echo 'Cập nhật trạng thái thất bại, vui lòng kiểm tra lại các tham số';
    }


} else {
    echo 'Cập nhật trạng thái thất bại, vui lòng kiểm tra lại các tham số';
}