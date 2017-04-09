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
//    $data_list_status=trang_thai_don_hang_getByTop('','','position asc');
    require_once DIR . '/view/default/template/module/email_marketing/list.php';
}



