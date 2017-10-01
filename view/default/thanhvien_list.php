<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_thanhvien_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $title_module=$data['title_print'];
    require_once DIR . '/view/default/template/module/thanhvien/list.php';
//    require_once DIR . '/view/default/template/module/user/list_demo.php';
}



