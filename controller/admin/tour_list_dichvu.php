<?php
require_once '../../config.php';
require_once DIR . '/model/tour_list_dichvuService.php';
require_once DIR . '/model/tourService.php';
require_once DIR . '/common/messenger.php';
$data = array();
$insert = true;
$link = '';
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
            $new_obj= new tour_list_dichvu();
            $new_obj->id=$_POST["id"];
            tour_list_dichvu_delete($new_obj);
            echo 1;
        }
        exit;
    }
}
if($_POST['tour_id']){
    $data_tour=tour_getByTop('1','code_az_mix="'.$_POST['tour_id'].'"','id desc');
    if($data_tour){
        $_POST['tour_id']=$data_tour[0]->id;
    }else{
        echo 0;
    }
}

if (isset($_POST["name"]) && isset($_POST["type"]) && isset($_POST["price"]) && isset($_POST["number"]) && isset($_POST["note"])) {
    $array = $_POST;
    if (!isset($array['id']))
        $array['id'] = '0';
    if (!isset($array['tour_id']))
        $array['tour_id'] = '0';
    if (!isset($array['name']))
        $array['name'] = '0';
    if (!isset($array['type']))
        $array['type'] = '0';
    if (!isset($array['price']))
        $array['price'] = '0';
    if (!isset($array['number']))
        $array['number'] = '1';
    if (!isset($array['note']))
        $array['note'] = '';
    $new_obj = new tour_list_dichvu($array);
    if($array['id']==0){
        tour_list_dichvu_insert($new_obj);
        echo  1;
    } else {
        $new_obj->id = $array['id'];
        tour_list_dichvu_update($new_obj);
        echo 1;
    }
}