<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_tour_yeu_cau_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $title=$data['title'];
    require_once DIR . '/view/default/template/module/tour_yeu_cau/list.php';
}



