<?php

require_once DIR . '/common/cls_fast_template.php';
function show_response_hotel_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    require_once DIR . '/view/default/template/module/response_hotel/list.php';
}



