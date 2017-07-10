<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR . "/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$res = array(
    'success' => 0,
);
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['user_email']) && isset($_POST['user_code']) && isset($_POST['token_code'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $name = _return_mc_decrypt(_returnPostParamSecurity('name'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $user_code = _return_mc_decrypt(_returnPostParamSecurity('user_code'));
    $token_code = _return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        if(isset($_POST['top_5'])){
            $count_active=notification_count('status=0 and user_id='.$id);
            $count_un_read=notification_count('status=2 and user_id='.$id);
            $current=isset($_POST['page'])?$_POST['page']:'1';;
            $pagesize=5;
            $data_noti=notification_getByPaging($current,$pagesize,'id desc','user_id='.$id);
            $res['success']=1;
            $res['count_active']=$count_active;
            $res['count_un_read']=$count_un_read;
            $res['data_noti']=$data_noti;
            if(count($data_noti)>0){
                $res['current']=$current+1;
            }else{
                $res['current']=$current;
            }
            $res['pagesize']=$pagesize;
        }else{

        }
    }
}
echo json_encode($res);