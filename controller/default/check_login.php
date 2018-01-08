<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}
require_once DIR.'/controller/default/public.php';
require_once DIR.'/model/userService.php';

if(isset($_GET['value'])&&isset($_GET['key']))
{
    $value=trim(_returnGetParamSecurity('value'));
    if($value!=''){
        $key=_returnGetParamSecurity('key');
        $dk=$key."='".$value."'";
        $data_check=user_getByTop('1',$dk,'');
        if(count($data_check)==0){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        echo 'Bạn vui lòng không nhập khoàng trắng trước và sau mã nhân viên';
    }

}
else{
    echo 0;
}
?>


