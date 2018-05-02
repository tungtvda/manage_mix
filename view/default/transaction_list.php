<?php
/**
 * Created by PhpStorm.
 * User: Duc Tho
 * Date: 2/26/2018
 * Time: 11:02 PM
 */
require_once DIR . '/common/cls_fast_template.php';
function show_transaction_list($data = array())
{
    $asign = array();
    $list=$data['list'];
    $title=$data['title'];
    $customerList=$data['customerList'];
    require_once DIR . '/view/default/template/module/transaction/list.php';
}



