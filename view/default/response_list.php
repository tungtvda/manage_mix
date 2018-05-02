<?php

require_once DIR . '/common/cls_fast_template.php';
function show_response_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    require_once DIR . '/view/default/template/module/response_customer/list.php';
}



