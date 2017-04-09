<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_email_marketing_themmoi($data = array())
{
    $asign = array();
    $tieude=$data['title'];
    $action=$data['action'];
    if($action==2){
        $action_name='edit';
        $readonly="readonly";
        $hidden="hidden";
        $valid_pass="valid";
        $show_phone="";
        $disabled='disabled';

    }else{
        $action_name='add';
        $readonly="readonly";
        $hidden="";
        $valid_pass="";
        $show_phone="hidden";
        $disabled='';
    }
    $list=$data['list'];

    require_once DIR . '/view/default/template/module/email_marketing/themmoi.php';
}



