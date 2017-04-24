<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_booking_cost_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $title=$data['title'];
    $action_link=$data['action_link'];
    require_once DIR . '/view/default/template/module/booking/cost_list.php';
}



