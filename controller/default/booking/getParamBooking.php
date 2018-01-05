<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
$name_user = _returnPostParamSecurity('name_user');
$name_dieuhanh = _returnPostParamSecurity('name_dieuhanh');
$id_user = _returnPostParamSecurity('id_user');
$dieuhanh_id = _returnPostParamSecurity('dieuhanh_id');

$code_booking = _returnPostParamSecurity('code_booking');
$tien_te = _returnPostParamSecurity('tien_te');
$ty_gia = '';
if ($tien_te != '') {
    $data_ty_gia = tien_te_getById($tien_te);
    if (count($data_ty_gia) > 0) {
        $ty_gia = $data_ty_gia[0]->value;
    }
}

$nguon_tour = _returnPostParamSecurity('nguon_tour');
$ngay_bat_dau = _returnPostParamSecurity('ngay_bat_dau');
$han_thanh_toan = _returnPostParamSecurity('han_thanh_toan');
$status = _returnPostParamSecurity('status');
$action_link = _returnLinkBooking($status);
$hinh_thuc_thanh_toan = _returnPostParamSecurity('hinh_thuc_thanh_toan');

$num_nguoi_lon = _returnPostParamSecurity('num_nguoi_lon');
if($num_nguoi_lon==''||$num_nguoi_lon<=0){
    $num_nguoi_lon=1;
}
$num_tre_em_m1 = _returnPostParamSecurity('num_tre_em_m1');
if($num_tre_em_m1==''||$num_tre_em_m1<=0){
    $num_tre_em_m1=0;
}
$num_tre_em_m2 = _returnPostParamSecurity('num_tre_em_m2');
if($num_tre_em_m2==''||$num_tre_em_m2<=0){
    $num_tre_em_m2=0;
}
$num_tre_em_m3 = _returnPostParamSecurity('num_tre_em_m3');
if($num_tre_em_m3==''||$num_tre_em_m3<=0){
    $num_tre_em_m3=0;
}

$do_tuoi_nguoi_lon = _returnPostParamSecurity('do_tuoi_nguoi_lon');
$do_tuoi_tre_em_m1 = _returnPostParamSecurity('do_tuoi_tre_em_m1');
$do_tuoi_tre_em_m2 = _returnPostParamSecurity('do_tuoi_tre_em_m2');
$do_tuoi_tre_em_m3 = _returnPostParamSecurity('do_tuoi_tre_em_m3');

$vat = _returnPostParamSecurity('vat');
if ($vat == '') {
    $vat = 0;
} else {
    if ($vat === "on" || $vat === 1 || $vat === "On") {
        $vat = 1;
    } else {
        $vat = 0;
    }
}
$name_customer = _returnPostParamSecurity('name_customer');
$id_customer = _returnPostParamSecurity('id_customer');
$email = _returnPostParamSecurity('email');
$address = _returnPostParamSecurity('address');
$phone = _returnPostParamSecurity('phone');
$fax = _returnPostParamSecurity('fax');
$nhom_khach_hang = _returnPostParamSecurity('nhom_khach_hang');
$diem_don = _returnPostParamSecurity('diem_don');
$ngay_khoi_hanh = _returnPostParamSecurity('ngay_khoi_hanh');
$ngay_ket_thuc = _returnPostParamSecurity('ngay_ket_thuc');
$name_tour = _returnPostParamSecurity('name_tour');
$id_tour = _returnPostParamSecurity('id_tour');
$dat_coc = _returnPostParamSecurity('dat_coc');

$price_submit = _returnPostParamSecurity('price_submit');
if($price_submit=='' || $price_submit<0){
    $price_submit=0;
}
$price_m1_submit = _returnPostParamSecurity('price_m1_submit');
if($price_m1_submit=='' || $price_m1_submit<0){
    $price_m1_submit=0;
}
$price_m2_submit = _returnPostParamSecurity('price_m2_submit');
if($price_m2_submit=='' || $price_m2_submit<0){
    $price_m2_submit=0;
}
$price_m3_submit = _returnPostParamSecurity('price_m3_submit');
if($price_m3_submit=='' || $price_m3_submit<0){
    $price_m3_submit=0;
}

$tyle_m1 = _returnPostParamSecurity('tyle_m1');
if($tyle_m1=='' || $tyle_m1<0){
    $tyle_m1=0;
}
$tyle_m2 = _returnPostParamSecurity('tyle_m2');
if($tyle_m2=='' || $tyle_m2<0){
    $tyle_m2=0;
}
$tyle_m3 = _returnPostParamSecurity('tyle_m3');
if($tyle_m3=='' || $tyle_m3<0){
    $tyle_m3=0;
}

$loi_nhuan = _returnPostParamSecurity('loi_nhuan');
if(!is_numeric($loi_nhuan)){
    $loi_nhuan=0;
}
$loi_nhuan_m1 = _returnPostParamSecurity('loi_nhuan_m1');
if(!is_numeric($loi_nhuan_m1)){
    $loi_nhuan_m1=0;
}
$loi_nhuan_m2 = _returnPostParamSecurity('loi_nhuan_m2');
if(!is_numeric($loi_nhuan_m2)){
    $loi_nhuan_m2=0;
}
$loi_nhuan_m3 = _returnPostParamSecurity('loi_nhuan_m3');
if(!is_numeric($loi_nhuan_m3)){
    $loi_nhuan_m3=0;
}

$check_edit = _returnPostParamSecurity('check_edit');
$id_edit = _returnPostParamSecurity('id_edit');
$note = _returnPostParamSecurity('note');
$user_tiep_thi_id = _returnPostParamSecurity('id_user_tt');
$name_user_tiepthi = _returnPostParamSecurity('name_user_tiepthi');
$email_thanh_vien = _returnPostParamSecurity('email_thanh_vien');
$phone_thanh_vien = _returnPostParamSecurity('phone_thanh_vien');
$confirm_admin_tiep_thi = _returnPostParamSecurity('confirm_admin_tiep_thi');

$type_tour = _returnPostParamSecurity('type_tour');
$name_tour_cus = _returnPostParamSecurity('name_tour_cus');
$chuong_trinh = _returnPostParamSecurity('chuong_trinh');
$chuong_trinh_price = _returnPostParamSecurity('chuong_trinh_price');
$thoi_gian = _returnPostParamSecurity('thoi_gian');
$thoi_gian_price = _returnPostParamSecurity('thoi_gian_price');
$nguoi_lon = _returnPostParamSecurity('nguoi_lon');
$tre_em = _returnPostParamSecurity('tre_em');
$tre_em_5 = _returnPostParamSecurity('tre_em_5');
$so_nguoi_price = _returnPostParamSecurity('so_nguoi_price');
$khach_san = _returnPostParamSecurity('khach_san');
$khach_san_price = _returnPostParamSecurity('khach_san_price');
$ngay_khoi_hanh_cus = _returnPostParamSecurity('ngay_khoi_hanh_cus');
$ngay_khoi_hanh_price = _returnPostParamSecurity('ngay_khoi_hanh_price');
$hang_bay = _returnPostParamSecurity('hang_bay');
$hang_bay_price = _returnPostParamSecurity('hang_bay_price');
$khac = _returnPostParamSecurity('khac');
$khac_price = _returnPostParamSecurity('khac_price');
$note_cus = _returnPostParamSecurity('note_cus');
$confirm_dieuhanh = _returnPostParamSecurity('confirm_dieuhanh');
$confirm_sales = _returnPostParamSecurity('confirm_sales');



if ($confirm_admin_tiep_thi == '') {
    $confirm_admin_tiep_thi = 0;
} else {
    if ($confirm_admin_tiep_thi === "on" || $confirm_admin_tiep_thi === 1 || $confirm_admin_tiep_thi === "On") {
        $confirm_admin_tiep_thi = 1;
    } else {
        $confirm_admin_tiep_thi = 0;
    }
}

$name_customer_sub = array();
$email_customer_sub = array();
$phone_customer_sub = array();
$address_customer_sub = array();
$tuoi_customer_sub = array();
$tuoi_number_customer_sub = array();
$birthday_customer_sub = array();
$passport_customer_sub = array();
$date_passport_customer_sub = array();

$total = 0;
if (is_numeric($num_nguoi_lon) && is_numeric($price_submit)) {
    $total = $total + ($num_nguoi_lon * $price_submit);
}
if (is_numeric($num_tre_em_m1) && is_numeric($price_m1_submit)) {
    $total = $total + ($num_tre_em_m1 * $price_m1_submit);
}
if (is_numeric($num_tre_em_m2) && is_numeric($price_m2_submit)) {
    $total = $total + ($num_tre_em_m2 * $price_m2_submit);
}
if (is_numeric($num_tre_em_m3) && is_numeric($price_m3_submit)) {
    $total = $total + ($num_tre_em_m3 * $price_m3_submit);
}
if ($vat == 1) {
    $vat_price = ($total * 0.1);
    $total = $total + $vat_price;
}
if (isset($_POST['name_customer_sub'])) {
    $name_customer_sub = $_POST['name_customer_sub'];
}
if (isset($_POST['email_customer'])) {
    $email_customer_sub = $_POST['email_customer'];
}
if (isset($_POST['phone_customer'])) {
    $phone_customer_sub = $_POST['phone_customer'];
}
if (isset($_POST['address_customer'])) {
    $address_customer_sub = $_POST['address_customer'];
}
if (isset($_POST['tuoi_customer'])) {
    $tuoi_customer_sub = $_POST['tuoi_customer'];
}
if (isset($_POST['tuoi_number_customer'])) {
    $tuoi_number_customer_sub = $_POST['tuoi_number_customer'];
}
if (isset($_POST['birthday_customer'])) {
    $birthday_customer_sub = $_POST['birthday_customer'];
}
if (isset($_POST['passport_customer'])) {
    $passport_customer_sub = $_POST['passport_customer'];
}
if (isset($_POST['date_passport_customer'])) {
    $date_passport_customer_sub = $_POST['date_passport_customer'];
}

if (isset($_POST['name_dichvu'])) {
    $name_dichvu = $_POST['name_dichvu'];
}
if (isset($_POST['type_dichvu'])) {
    $type_dichvu = $_POST['type_dichvu'];
}
if (isset($_POST['price_dichvu'])) {
    $price_dichvu = $_POST['price_dichvu'];
}
if (isset($_POST['soluong_dichvu'])) {
    $soluong_dichvu = $_POST['soluong_dichvu'];
}
if (isset($_POST['thanhtien_dichvu'])) {
    $thanhtien_dichvu = $_POST['thanhtien_dichvu'];
}
if (isset($_POST['ghichu_dichvu'])) {
    $ghichu_dichvu = $_POST['ghichu_dichvu'];
}

