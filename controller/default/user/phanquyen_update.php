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
if(isset($_POST['id'])&&isset($_POST['value'])&&$_POST['id']!=""&&$_POST['value']!=""){
    echo $id=_return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $data=(json_decode($_POST['value'],true));
    foreach($data as $row)
    {
        if(isset($row['check_action'])&&$row['check_action']==1){
            print_r($row);
        }
    }
}
else{
    echo 'Bạn vui lòng kiểm tra thông tin người dùng';
}