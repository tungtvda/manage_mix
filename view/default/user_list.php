<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_user_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $phong_ban='';
    $data_list_phongban=user_phongban_getByTop('','','position asc');
    $data_list_user=user_getByTop('','status=1 and user_role!=2','name asc');
    require_once DIR . '/view/default/template/module/user/list.php';
//    require_once DIR . '/view/default/template/module/user/list_demo.php';
}



