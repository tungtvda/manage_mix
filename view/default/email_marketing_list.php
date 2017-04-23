<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_email_marketing_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $title=$data['title'];
    $action_link=$data['action_link'];
    $type=$data['type'];
    $form=$data['form'];
    $action_list=$data['action_list'];
    $action_them=$data['action_them'];
    $action_sua=$data['action_sua'];
    $action_xoa=$data['action_xoa'];
    require_once DIR . '/view/default/template/module/email_marketing/list.php';
}



