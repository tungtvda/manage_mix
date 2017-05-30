<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_thong_ke_danh_thu($data = array())
{
    $asign = array();
    $list=$data['list'];
    $trang_thai_don_hang=$data['trang_thai_don_hang'];
    require_once DIR . '/view/default/template/module/thongke/doanh_thu_don_hang.php';
}



