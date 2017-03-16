<?php
if (!defined('DIR')) require_once '../../../config.php';
_returnCheckPermison(0,0);
if (isset($_POST['id']) && isset($_POST['table'])) {
    $id=_return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $table = _returnPostParamSecurity('table');
    if ($id != '' && $table != '') {


        $file_model = $table . 'Service.php';
        require_once DIR . '/model/' . $file_model;

        $function_id = $table . '_getById';
        $data_check = $function_id($id);
        if (count($data_check) > 0) {
            if(isset($data_check[0]->code)){
                if($data_check[0]->code==''){
                    $data_check[0]->code=_randomBooking('cus','customer_count');
                }
            }
            if(isset($data_check[0]->created)){
                if($data_check[0]->created==''){
                    $data_check[0]->created=_returnDateNotTimieFormatConvertVn($data_check[0]->created);
                }
            }
            if(isset($data_check[0]->birthday)){
                    $data_check[0]->birthday=_returnDateNotTimieFormatConvertVn($data_check[0]->birthday);
            }
          echo $data=json_encode($data_check[0]);
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}