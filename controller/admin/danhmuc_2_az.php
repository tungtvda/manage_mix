<?php
require_once '../../config.php';
require_once DIR.'/model/danhmuc_2Service.php';
require_once DIR.'/model/danhmuc_1Service.php';
require_once DIR.'/view/admin/danhmuc_2.php';
require_once DIR.'/common/messenger.php';
require_once DIR.'/common/locdautiengviet.php';
$data=array();
$insert=true;
$code_check_send_email='';

if(isset($_POST['code_check_send_email']))
{
    $code_check_send_email=_return_mc_decrypt($_POST['code_check_send_email']);
    if($code_check_send_email=='tungtv_az_mix_12345'){
        $code_check_send_email=1;
        unset($_POST['code_check_send_email']);
    }
}
if($code_check_send_email==1){
    if(isset($_POST['action'])){
        if(isset($_POST['id'])){
            $new_obj= new danhmuc_2();
            $new_obj->id=$_POST["id"];
            danhmuc_2_delete($new_obj);
        }
        exit;
    }
}
if($code_check_send_email==1 && isset($_POST["danhmuc1_id"])&&isset($_POST["name"])&&isset($_POST["name_url"])&&isset($_POST["img"])&&isset($_POST["position"])&&isset($_POST["title"])&&isset($_POST["keyword"])&&isset($_POST["description"]))
{
    $array=$_POST;
    if(!isset($array['id']))
        $array['id']='0';
    if(!isset($array['danhmuc1_id']))
        $array['danhmuc1_id']='0';
    if(!isset($array['name']))
        $array['name']='0';
    if(!isset($array['name_url']))
        $array['name_url']='0';
    $array['name_url']=LocDau($array['name']);
    if(!isset($array['img']))
        $array['img']='0';
    if(!isset($array['position']))
        $array['position']='0';
    if(!isset($array['title']))
        $array['title']='0';
    if(!isset($array['keyword']))
        $array['keyword']='0';
    if(!isset($array['description']))
        $array['description']='0';
    $new_obj=new danhmuc_2($array);
    if($array['id']==0)
    {
        danhmuc_2_insert($new_obj);
    }
    else
    {
        $new_obj->id=$array['id'];
        danhmuc_2_update($new_obj);
    }
}