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
require_once DIR.'/model/userService.php';
if (isset($_GET['value']) && isset($_GET['table']) && isset($_GET['key']))
{
    $value=trim(_returnGetParamSecurity('value'));
    if($value!=''){
        $table=_returnGetParamSecurity('table');
        $key=_returnGetParamSecurity('key');
        if($table!=''&&$key!='')
        {
            $file_model = $table . 'Service.php';
            require_once DIR . '/model/' . $file_model;
            $dk=$key."='".$value."'";
            $function = $table . '_getByTop';
            $data_check=$function('1',$dk,'');
            if(count($data_check)==0){
                echo 1;
            }
            else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }
    else{
        echo 'Bạn vui lòng không nhập khoàng trắng trước và sau nôi dung';
    }

}
else{
    echo 0;
}
?>


