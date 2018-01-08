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
_returnCheckPermison(6, 6);


if (!isset($_GET['id'])) {
    redict(_returnLinkDangNhap());
}

$data['id_booking'] = $id = _returnGetParamSecurity('id');
$id_pass = _return_mc_decrypt($id, ENCRYPTION_KEY);
$data['data_booking_detail'] = booking_getById($id_pass);
if (count($data['data_booking_detail']) == 0) {
    redict(_returnLinkDangNhap());
}
$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$action_link = str_replace('manage_mix', '', $_SERVER['REQUEST_URI']);
$action_link = str_replace('?id=' . $id, '', $action_link);
$action_link = str_replace('chi-phi', '', $action_link);
$action_link = str_replace('/', '', $action_link);
$data_dk_list = 'booking_id = ' . $id_pass;
$data_dk_fill = '';
$active_tab_left = 'booking_list';
if ($_SESSION['user_role'] == 0) {
    $data_dk_fill .= ' and created_by=' . $_SESSION['user_id'];
    $data_dk_list .= ' and user_id=' . $_SESSION['user_id'];
}

switch ($action_link) {
    case 'booking-new':
        $data['title'] = 'Danh sách đơn hàng mới';
        $active_tab_left = 'booking_new';
        if ($data_dk_fill != '') {
            $data_dk_fill .= ' and ';
        }
        $data_dk_fill .= ' status=1';
        break;
    case 'booking-giao-dich':
        $data['title'] = 'Danh sách đơn hàng đang giao dịch';
        $active_tab_left = 'booking_giao_dich';
        if ($data_dk_fill != '') {
            $data_dk_fill .= ' and ';
        }
        $data_dk_fill .= ' status=2 ';
        break;
    case 'booking-tam-dung':
        $data['title'] = 'Danh sách đơn hàng tạm dừng';
        $active_tab_left = 'booking_tam_dung';
        if ($data_dk_fill != '') {
            $data_dk_fill .= ' and ';
        }
        $data_dk_fill .= ' status=3 ';
        break;
    case 'booking-no-tien':
        $data['title'] = 'Danh sách đơn hàng còn nợ tiền';
        $active_tab_left = 'booking_no_tien';
        if ($data_dk_fill != '') {
            $data_dk_fill .= ' and ';
        }
        $data_dk_fill .= ' status=4 ';
        break;
    case 'booking-ket-thuc':
        $data['title'] = 'Danh sách đơn hàng kết thúc';
        $active_tab_left = 'booking_ket_thuc';
        if ($data_dk_fill != '') {
            $data_dk_fill .= ' and ';
        }
        $data_dk_fill .= ' status=5 ';
        break;
    case 'booking-ban-nhap':
        $data['title'] = 'Danh sách đơn hàng nháp';
        $active_tab_left = 'booking_ban_nhap';
        if ($data_dk_fill != '') {
            $data_dk_fill .= ' and ';
        }
        $data_dk_fill .= ' status=6 ';
        break;
    default:
        $data['title'] = 'Danh sách đặt tour';
        $active_tab_left = 'booking_list';

}
if (isset($_POST['name_gia']) && isset($_POST['price_cost']) && isset($_POST['created'])) {
    $name_gia = _returnPostParamSecurity('name_gia');
    $price_cost = _returnPostParamSecurity('price_cost');
    $created = _returnPostParamSecurity('created');
    $description = _returnPostParamSecurity('description');
    if ($name_gia != "" && $price_cost != '' && $created != '') {
        if (isset($_POST['check_edit']) && isset($_POST['id_edit']) && $_POST['check_edit'] === "edit" && $_POST['id_edit'] != '') {
            $data_detail = booking_cost_getById(_return_mc_decrypt(_returnPostParamSecurity('id_edit'), ENCRYPTION_KEY));
            if (count($data_detail) == 0) {
                echo '<script>alert("Chi phí không tồn tại")</script>';
            } else {
                $obj = new booking_cost((array)$data_detail[0]);
                $obj->updated_by = $_SESSION['user_id'];
                $obj->name = $name_gia;
                $obj->price = $price_cost;
                $obj->description = $description;
                $obj->created = date('Y-m-d', strtotime($created));
                $obj->updated = _returnGetDateTime();
                booking_cost_update($obj);
                _insertLog($_SESSION['user_id'],6,6,33,_return_mc_decrypt(_returnPostParamSecurity('id_edit'), ENCRYPTION_KEY),'','',$_SESSION['user_name'].' đã sửa chi phí "'.$name_gia.'"');
                redict(SITE_NAME . '/' . $action_link . '/chi-phi?id=' . $id);
            }
        } else {
            $obj = new booking_cost();
            $obj->booking_id = $id_pass;
            $obj->user_id = $_SESSION['user_id'];
            $obj->name = $name_gia;
            $obj->price = $price_cost;
            $obj->description = $description;
            $obj->created = date('Y-m-d', strtotime($created));
            $obj->created_by = $_SESSION['user_id'];
            booking_cost_insert($obj);
            _insertLog($_SESSION['user_id'],6,6,33,0,'','',$_SESSION['user_name'].' đã thêm chi phí "'.$name_gia.'"');
            redict(SITE_NAME . '/' . $action_link . '/chi-phi?id=' . $id);
        }
    } else {
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin")</script>';
    }
}

_deleteSubmitForm('booking_cost', 'booking_cost_delete',6,6,35);

$data['dk_find'] = $data_dk_fill;
$url_bread = '<li class="active">Booking</li>';
$data['breadcrumbs'] = $url_bread;
$data['action_link'] = $action_link;
$count = 5;

$data['list'] = booking_cost_getByTop('', $data_dk_list, 'updated desc');
$data['module_valid'] = "booking";
$data['title_print'] = $data['title'];
show_header($data);
show_left($data, 'booking', $active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_booking_cost_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data, $count);