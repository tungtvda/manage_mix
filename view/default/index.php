<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_index($data = array())
{
    $asign = array();
    $count_don_hang_moi=$data['count_don_hang_moi'];
    $count_dang_giao_dich=$data['count_dang_giao_dich'];
    $count_tam_dung=$data['count_tam_dung'];
    $count_no_tien=$data['count_no_tien'];
    $count_ket_thuc=$data['count_ket_thuc'];
    $count_ban_nhap=$data['count_ban_nhap'];
    require_once DIR . '/view/default/template/index.php';
}



