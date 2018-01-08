<?php
require_once DIR . '/view/default/public.php';
function view_script_index($data = array())
{
     $count_all=$data['count_all'];
     $count_don_hang_moi_rate=round($data['count_don_hang_moi'] / ($count_all) * 100,2);
     $count_dang_giao_dich_rate=round($data['count_dang_giao_dich'] / ($count_all) * 100,2);
     $count_tam_dung_rate=round($data['count_tam_dung'] / ($count_all) * 100,2);
     $count_no_tien_rate=round($data['count_no_tien'] / ($count_all) * 100,2);
     $count_ket_thuc_rate=round($data['count_ket_thuc'] / ($count_all) * 100,2);
    $count_ban_nhap_rate=round($data['count_ban_nhap'] / ($count_all) * 100,2);
    require_once DIR . '/view/default/template/script_index.php';
}
