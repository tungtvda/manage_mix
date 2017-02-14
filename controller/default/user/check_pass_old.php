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
require_once(DIR."/common/hash_pass.php");
_returnCheckExitUser();
$data_user=user_getById($_SESSION['user_id']);
if(isset($_GET['value']))
{
    $value=_returnGetParamSecurity('value');
    $Pass=hash_pass($value);
        $dk="password='".$Pass."' and id=".$_SESSION['user_id'];
        $data_check=user_getByTop('1',$dk,'');
        if(count($data_check)==0){
            echo 0;
        }
        else{
            echo 1;

        }
}
else{
    echo 0;
}
?>


