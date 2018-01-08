<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_customer_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    require_once DIR . '/view/default/template/module/customer/list.php';
}



