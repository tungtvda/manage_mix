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
if(isset($_POST['pass_old'])&&isset($_POST['pass'])&&isset($_POST['pass_confirm'])&&$_POST['pass_old']!=''&&$_POST['pass']!=''&&$_POST['pass_confirm']!='')
{
    $pass_old=_returnPostParamSecurity('pass_old');
    $Pass_check=hash_pass($pass_old);
    $pass=_returnPostParamSecurity('pass');
    $pass_confirm=_returnPostParamSecurity('pass_confirm');
    $dk="password='".$Pass_check."' and id=".$_SESSION['user_id'];
    $data_check=user_getByTop('1',$dk,'');


        if(count($data_check)==0){
            echo "Mật khẩu cũ không chính xác";
        }
        else{
            if($pass!=$pass_confirm){
                echo "Hai mật khẩu không khớp";
            }else{
                $user_update = new user();
                $user_update->id=$_SESSION['user_id'];
                $user_update->password=hash_pass($pass);
                user_update_password($user_update);
                echo 1;
            }

        }
}
else{
    echo "Bạn vui lòng check lại dữ liệu cần cập nhật";
}
?>


