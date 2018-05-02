<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/customer_transactionService.php';
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/transactionService.php';
//_returnCheckPermison(6, 6);;
if (isset($_GET['id'])) {
    $id = _return_mc_decrypt(addslashes(strip_tags(trim($_GET['id']))), ENCRYPTION_KEY);
    echo _returnListTrans($id);
}
if (isset($_POST['id']) && isset($_POST['value'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $value = _returnPostParamSecurity('value');
    $created = _returnPostParamSecurity('created');
    $time = _returnPostParamSecurity('time');
    $customer_id = _returnPostParamSecurity('customer_id');
    if($time==''){
        $time=date("H:i:s", strtotime(_returnGetDateTime()));
    }
    if($created==''){
        $created=_returnGetDateTime();
    }else{
        $created=date("Y-m-d", strtotime($created));
    }
  //  $created=$created.' '.$time;

    if($id){
        $data_check=transaction_getById($id);
        if($data_check){
            $obj=new customer_transaction();
            $obj->created_by=$_SESSION['user_id'];
            $obj->updated_by=$_SESSION['user_id'];
            $obj->transaction_id=$id;
            $obj->description=$value;
            $obj->date = $created;
            $obj->time = $time;
            $obj->customer_id = $customer_id;
            $obj->updated_at = _returnGetDateTime();
            $obj->created_at = _returnGetDateTime();
            customer_transaction_insert($obj);
            echo _returnListTrans($id);
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
}