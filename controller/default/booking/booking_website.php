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
$data = array();
if (isset($_POST['name_customer']) && isset($_POST['email'])&& isset($_POST['phone'])&& isset($_POST['address'])&& isset($_POST['ngay_khoi_hanh'])&& isset($_POST['id_tour'])&& isset($_POST['name_tour'])&& isset($_POST['code_tour'])&& isset($_POST['ng_tour'])&& isset($_POST['n1'])&& isset($_POST['n2'])&& isset($_POST['n3'])&& isset($_POST['po1'])&& isset($_POST['po2'])&& isset($_POST['po3'])&& isset($_POST['pn1'])&& isset($_POST['pn2'])&& isset($_POST['pn3'])) {

    $name_customer = _return_mc_decrypt(_returnPostParamSecurity('name_customer'), '');
    $email = _return_mc_decrypt(_returnPostParamSecurity('email'), '');
    $address = _return_mc_decrypt(_returnPostParamSecurity('address'), '');
    $phone = _return_mc_decrypt(_returnPostParamSecurity('phone'), '');
    $diem_don = $address;
    $ngay_khoi_hanh = _return_mc_decrypt(_returnPostParamSecurity('ngay_khoi_hanh'), '');
    $name_tour = _return_mc_decrypt(_returnPostParamSecurity('name_tour'), '');
    $id_tour = _return_mc_decrypt(_returnPostParamSecurity('id_tour'), '');
    $nguon_tour = _return_mc_decrypt(_returnPostParamSecurity('ng_tour'), '');

    $price = _return_mc_decrypt(_returnPostParamSecurity('po1'), '');
    $price_511 = _return_mc_decrypt(_returnPostParamSecurity('po2'), '');
    $price_5 = _return_mc_decrypt(_returnPostParamSecurity('po3'), '');

    $price_new = _return_mc_decrypt(_returnPostParamSecurity('pn1'), '');
    $price_511_new = _return_mc_decrypt(_returnPostParamSecurity('pn2'), '');
    $price_5_new = _return_mc_decrypt(_returnPostParamSecurity('pn3'), '');

    $httt = _return_mc_decrypt(_returnPostParamSecurity('httt'), '');
    $note = _return_mc_decrypt(_returnPostParamSecurity('note'), '');
    $ngay_bat_dau = _returnGetDateTime();
    $status=1;
    $num_nguoi_lon=_return_mc_decrypt(_returnPostParamSecurity('n1'), '');
    $num_tre_em=_return_mc_decrypt(_returnPostParamSecurity('n2'), '');
    $num_tre_em_5=_return_mc_decrypt(_returnPostParamSecurity('n3'), '');

    $name_customer_sub=_return_mc_decrypt(_returnPostParamSecurity('name_customer_sub'), '');
    $email_customer_sub=_return_mc_decrypt(_returnPostParamSecurity('email_customer_sub'), '');
    $phone_customer_sub=_return_mc_decrypt(_returnPostParamSecurity('phone_customer_sub'), '');
    $address_customer_sub=_return_mc_decrypt(_returnPostParamSecurity('address_customer_sub'), '');
    $tuoi_customer_sub=_return_mc_decrypt(_returnPostParamSecurity('tuoi_customer_sub'), '');

    $name_price=_return_mc_decrypt(_returnPostParamSecurity('name_price'), '');
    $name_price_2=_return_mc_decrypt(_returnPostParamSecurity('name_price_2'), '');
    $name_price_3=_return_mc_decrypt(_returnPostParamSecurity('name_price_3'), '');

    $number=_return_mc_decrypt(_returnPostParamSecurity('number'), '');
    $number_2=_return_mc_decrypt(_returnPostParamSecurity('number_2'), '');
    $number_3=_return_mc_decrypt(_returnPostParamSecurity('number_3'), '');
    $gen=_return_mc_decrypt(_returnPostParamSecurity('gen'), '');
    $tol=_return_mc_decrypt(_returnPostParamSecurity('tol'), '');




} else {
    echo 'khong ton tai';
}