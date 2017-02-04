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
    $id=_return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $data_user=user_getById($id);
    if(count($data_user)==0)
    {
        echo 'Không tồn tại user trong hệ thống';
        exit;
    }
    $data=(json_decode($_POST['value'],true));
    $permison_module='';
    $permison_form='';
    $permison_action="";
    $count_module=1;
    $count_form=1;
    $count_action=1;
    foreach($data as $row)
    {
        if(isset($row['check_action'])&&$row['check_action']==1){
            if($row['id']!=''){
                if($count_action==1){
                    $permison_action.=$row['id'];
                }
                else{
                    $permison_action.=','.$row['id'];
                }
                $count_action++;
            }
            if($row['check_module']!=''){
                if($count_module==1){
                    $permison_module.=$row['check_module'];
                }
                else{
                    $permison_module.=','.$row['check_module'];
                }
                $count_module++;
            }
            if($row['check_form']!=''){
                if($count_form==1){
                    $permison_form.=$row['check_form'];
                }
                else{
                    $permison_form.=','.$row['check_form'];
                }
                $count_form++;
            }
        }
    }
    $user_update = new user();
    $user_update->id=$id;
    $user_update->permison_module=$permison_module;
    $user_update->permison_form=$permison_form;
    $user_update->permison_action=$permison_action;
    user_update_quyen($user_update);
    echo 1;
}
else{
    echo 'Bạn vui lòng kiểm tra thông tin người dùng';
}