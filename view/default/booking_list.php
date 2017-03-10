<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_booking_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $data_list_status=trang_thai_don_hang_getByTop('','','position asc');
    require_once DIR . '/view/default/template/module/booking/list.php';
}



