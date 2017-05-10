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
    $id_booking=$data['id_booking'];
    $action_link=$data['action_link'];
    $code_booking=$data['data_booking_detail'][0]->code_booking;
    require_once DIR . '/view/default/template/module/booking/cost_list.php';
}



