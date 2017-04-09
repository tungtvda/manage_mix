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
    $list_short_code='';
    if(count($data['list_short_code'])>0){
        foreach($data['list_short_code'] as $row_short_code){
            $list_short_code.=' <tr ><td><span class="label label-warning arrowed-right arrowed-in key_birthday" countId="'.$row_short_code->id.'">'.$row_short_code->name.'</span>
                                                    <span style="font-size: 12px">'.$row_short_code->description.'</span>
                                                    <input class="input_key_birthday" id="value_key_'.$row_short_code->id.'" countId="'.$row_short_code->id.'" type="text" value="'.$row_short_code->name.'">
                                                </td> </tr>';
        }
    }
    require_once DIR . '/view/default/template/module/email_marketing/themmoi.php';
}



