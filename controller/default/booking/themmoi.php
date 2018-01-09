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
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR . "/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
_returnCheckPermison(6, 6);
$action_link = str_replace('manage_mix', '', $_SERVER['REQUEST_URI']);
$action_link = str_replace('dat-tour', '', $action_link);
$action_link = str_replace('/', '', $action_link);
if (isset($_GET['id']) && $_GET['id'] != '') {
    $action_link = str_replace('sua?id=' . $_GET['id'], '', $action_link);
}
switch ($action_link) {
    case 'booking-new':
        $active_tab_left = 'booking_new';
        break;
    case 'booking-giao-dich':
        $active_tab_left = 'booking_giao_dich';
        break;
    case 'booking-tam-dung':
        $active_tab_left = 'booking_tam_dung';
        break;
    case 'booking-no-tien':
        $active_tab_left = 'booking_no_tien';
        break;
    case 'booking-ket-thuc':
        $active_tab_left = 'booking_ket_thuc';
        break;
    case 'booking-ban-nhap':
        $active_tab_left = 'booking_ban_nhap';
        break;
    default:
        $active_tab_left = 'booking_list';

}
if($_SESSION['user_role']!=1){
    $data['dk_find']=' user_id='.$_SESSION['user_id'].' or dieuhanh_id='.$_SESSION['user_id'].' or created_by='.$_SESSION['user_id'];
}
if (isset($_GET['id']) && $_GET['id'] != '') {
    $data['action'] = 2;
    if (_returnCheckAction(22) == 0) {
        redict(_returnLinkDangNhap());
    }
//    echo $_GET['id'];
    $id = _return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user'] = booking_getById($id);

    if (count($data['data_user']) == 0) {
        redict(SITE_NAME . '/' . $action_link . '/');
    }
    if ($_SESSION['user_role']!=1) {
        if($data['data_user'][0]->created_by !=$_SESSION['user_id'] && $data['data_user'][0]->dieuhanh_id !=$_SESSION['user_id']&& $data['data_user'][0]->user_id !=$_SESSION['user_id'])
        redict(SITE_NAME . '/' . $action_link . '/');
    }
    $url_bread = '<li><a href="' . SITE_NAME . '/' . $action_link . '/">Danh sách đặt tour</a></li><li class="active">Thông tin đơn hàng "' . $data['data_user'][0]->code_booking . '"</li>';
    $data['title'] = 'Thông tin đơn hàng "' . $data['data_user'][0]->code_booking . '"';
    _updateStatusNoti();

} else {
    if (_returnCheckAction(21) == 0) {
        redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
    }
    $data['data_user'] = '';
    $data['action'] = 1;
    $url_bread = '<li><a href="' . SITE_NAME . '/' . $action_link . '/">Danh sách đặt tour</a></li><li class="active">Đặt tour</li>';
    $data['title'] = 'Đặt tour';
}

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$data['breadcrumbs'] = $url_bread;
$data['module_valid'] = "booking";

if (isset($_POST['code_booking'])) {
    include 'getParamBooking.php';
    if (isset($_POST['check_edit']) && $_POST['check_edit'] == 'edit' && isset($_POST['id_edit']) && $_POST['id_edit'] != '') {
        include 'editBooking.php';
        redict(SITE_NAME . '/' . $action_link . '/');
    } else {
        if ($id_user != '' && $name_user != '' && $name_dieuhanh != '' && $code_booking != '' && $ngay_bat_dau != '' && $han_thanh_toan != '' && $hinh_thuc_thanh_toan != '' && $num_nguoi_lon != '' && $num_nguoi_lon != 0 && $name_customer != '' && $email != '' && $address != '' && $phone != '' && $diem_don != '' && $price_submit != '') {
            include 'insertBooking.php';

        } else {
            echo '<script>alert("Bạn vui lòng kiểm tra lại thông tin đặt tour")</script>';
        }
    }
}
show_header($data);
show_left($data, 'booking', $active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_booking_themmoi($data);
show_footer($data);

show_valid_form($data);
show_script_form($data);

