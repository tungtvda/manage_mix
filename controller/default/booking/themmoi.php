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
    $url_bread = '<li><a href="' . SITE_NAME . '/' . $action_link . '/">Danh sách đặt tour</a></li><li class="active">Chỉnh sửa đơn hàng "' . $data['data_user'][0]->code_booking . '"</li>';
    $data['title'] = 'Chỉnh sửa đơn hàng "' . $data['data_user'][0]->code_booking . '"';
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
    $num_tre_em = _returnPostParamSecurity('num_tre_em');
    $num_tre_em_5 = _returnPostParamSecurity('num_tre_em_5');
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
    $price_511_submit = _returnPostParamSecurity('price_511_submit');
    $price_5_submit = _returnPostParamSecurity('price_5_submit');
    $check_edit = _returnPostParamSecurity('check_edit');
    $id_edit = _returnPostParamSecurity('id_edit');
    $note = _returnPostParamSecurity('note');
    $user_tiep_thi_id = _returnPostParamSecurity('id_user_tt');
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
    $price_submit = str_replace('.', '', $price_submit);
    $price_submit = str_replace(',', '', $price_submit);
    $price_511_submit = str_replace('.', '', $price_511_submit);
    $price_511_submit = str_replace(',', '', $price_511_submit);
    $price_5_submit = str_replace('.', '', $price_5_submit);
    $price_5_submit = str_replace(',', '', $price_5_submit);

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
    if (is_numeric($num_tre_em) && is_numeric($price_511_submit)) {
        $total = $total + ($num_tre_em * $price_511_submit);
    }
    if (is_numeric($num_tre_em_5) && is_numeric($price_5_submit)) {
        $total = $total + ($num_tre_em_5 * $price_5_submit);
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
    if (isset($_POST['check_edit']) && $_POST['check_edit'] == 'edit' && isset($_POST['id_edit']) && $_POST['id_edit'] != '') {
        $string_value_old = '';
        $string_value_new = '';
        $data_detail = $data['data_user'];
        $user_tiep_thi_id_old = $data_detail[0]->user_tiep_thi_id;
        $price_tiep_thi = $data_detail[0]->price_tiep_thi;
        $array_detail = ((array)$data_detail[0]);

        $booking_update = new booking($array_detail);
        if($array_detail['status']!=5){
            // thay đổi điều hành
            if($array_detail['confirm_dieuhanh']!=1 || $_SESSION['user_role']==1){
                if ($dieuhanh_id != $array_detail['dieuhanh_id'] && isset($_POST['dieuhanh_id']) ) {
                    $check_data_dieuhanh = user_getById($dieuhanh_id);
                    if (count($check_data_dieuhanh) >0) {
                        $booking_update->dieuhanh_id = $dieuhanh_id;
                        $booking_update->confirm_dieuhanh=0;
                        $string_value_old .= ' Điều hành: "' .$array_detail['dieuhanh_id'] . '" </br>';
                        $string_value_new .= ' Điều hành mới: "' . $name_dieuhanh.'_'.$dieuhanh_id . '" </br> ';
                        $edit_dieuhanh = $array_detail['dieuhanh_id'];
                        // gửi email và noti đến điều hành
                        $name_noti = $_SESSION['user_name'] . ' đã chọn bạn làm điều hành cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng';
                        $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                        _insertNotification($name_noti, $_SESSION['user_id'], $dieuhanh_id, $link_noti, 0, '');
//                        $subject = 'Xác nhận đơn hàng ' . $code_booking;
//                        $message = '<p>Nhân viên ' . $_SESSION['user_name'] . ' vừa tạo đơn hàng mã ' . $code_booking . '</p>';
//                        $message .= '<a>Bạn vui lòng truy cập <a href="' . SITE_NAME . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
//                        SendMail($check_data_dieuhanh[0]->user_email, $message, $subject);
                        // hủy điều hành
                        if($array_detail['dieuhanh_id']!=''){
                            $name_noti = $_SESSION['user_name'] . ' đã hủy quyền điều hành cho đơn hàng '.$code_booking.'';
                            $link_noti = '';
                            _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['dieuhanh_id'], $link_noti, 0, '');
                        }
                    }


                }
            }
            if($array_detail['confirm_sales']!=1 || $_SESSION['user_role']==1){
                if ($id_user != $array_detail['user_id'] && isset($_POST['id_user'])) {
                    // gửi đơn hàng tới sales
                    $check_data_user = user_getById($id_user);
                    if (count($check_data_user) > 0) {
                        $booking_update->user_id = $id_user;
                        $booking_update->confirm_sales=0;
                        $string_value_old .= ' Sales: "' . $array_detail['user_id'] . '" </br> ';
                        $string_value_new .= ' Sales mới: "' . $name_user.'_'.$id_user . '" </br> ';
                        $edit_user = $array_detail['user_id'];

                        if ($id_user != $_SESSION['user_id']) {
                            //
                            $name_noti = $_SESSION['user_name'] . ' đã chọn bạn làm sales cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng';
                            $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                            _insertNotification($name_noti, $_SESSION['user_id'], $id_user, $link_noti, 0, '');

//                            $subject = 'Xác nhận đơn hàng ' . $code_booking;
//                            $mess_log = 'Nhân viên ' . $_SESSION['user_name'] . ' đã thực hiện việc sửa đơn hàng';
//                            $message = '<p>Nhân viên ' . $_SESSION['user_name']  . ' đã chọn bạn làm sales cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng</p>';
//                            $message .= '<a>Bạn vui lòng truy cập <a href="' . SITE_NAME . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
//                            SendMail($check_data_user[0]->user_email , $message, $subject);
                        }else{
                            $name_noti = 'Bạn đã tạo thành công đơn hàng '.$code_booking;
                            $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                            _insertNotification($name_noti, $_SESSION['user_id'], $id_user, $link_noti, 0, '');

//                            $subject = 'Thông báo sửa đơn hàng ' . $code_booking.' thành công';
//                            $message = '<p>Bạn vừa tạo thành công đơn hàng mã ' . $code_booking . '</p>';
//                            SendMail($check_data_user[0]->user_email, $message, $subject);
//                            $mess_log = 'Nhân viên ' . $check_data_user[0]->name . ' đã thực hiện việc sửa đơn hàng';
                        }
                        if($array_detail['user_id']!=''){
                            $name_noti = $_SESSION['user_name'] . ' đã hủy quyền sales cho đơn hàng '.$code_booking.'';
                            $link_noti = '';
                            _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['user_id'], $link_noti, 0, '');
                        }
                    }
                }
            }
            if($array_detail['user_id']==$_SESSION['user_id'] ||$array_detail['dieuhanh_id']==$_SESSION['user_id'] || $_SESSION['user_role']==1){
                if ($price_submit != $array_detail['price_new'] && isset($_POST['price_submit'])) {
                    $booking_update->price_new = $price_submit;
                    $string_value_old .= ' Giá người lớn: "' . $array_detail['price_new'] . '"</br> ';
                    $string_value_new .= ' Giá người lớn mới: "' . $price_submit . '" </br> ';
                }

                if ($price_511_submit != $array_detail['price_11_new'] && isset($_POST['price_511_submit'])) {
                    $booking_update->price_11_new = $price_511_submit;
                    $string_value_old .= ' Giá trẻ em 5->11 tuổi: "' . $array_detail['price_11_new'] . '" </br> ';
                    $string_value_new .= ' Giá trẻ em 5->11 tuổi mới: "' . $price_511_submit . '" </br>';
                }

                if ($price_5_submit != $array_detail['price_5_new'] && isset($_POST['price_5_submit'])) {
                    $booking_update->price_5_new = $price_5_submit;
                    $string_value_old .= ' Giá trẻ em dưới 5 tuổi: "' . $array_detail['price_5_new'] . '" </br> ';
                    $string_value_new .= ' Giá trẻ em dưới 5 tuổi mới: "' . $price_5_submit . '" </br> ';
                }
                $total = 0;
                if (is_numeric($num_nguoi_lon) && is_numeric($price_submit)) {
                    $total = $total + ($num_nguoi_lon * $price_submit);
                }
                if (is_numeric($num_tre_em) && is_numeric($price_511_submit)) {
                    $total = $total + ($num_tre_em * $price_511_submit);
                }
                if (is_numeric($num_tre_em_5) && is_numeric($price_5_submit)) {
                    $total = $total + ($num_tre_em_5 * $price_5_submit);
                }
                if ($vat == 1) {
                    $vat_price = ($total * 0.1);
                    $total = $total + $vat_price;
                }
                $booking_update->total_price=$total;
                if($array_detail['tour_custom']==1){
                    if($array_detail['name_tour']!=$name_tour_cus && isset($_POST['name_tour_cus'])){
                        $booking_update->name_tour = $name_tour_cus;
                        $string_value_old .= ' Tên tour: "' . $array_detail['name_tour'] . '" </br> ';
                        $string_value_new .= ' Tên tour mới: "' . $name_tour_cus . '" </br> ';
                    }
                    $data_tour_cus=booking_tour_custom_getById($array_detail['id_tour']);
                    if($data_tour_cus){
                        $array_detail_tour_cus = ((array)$data_tour_cus[0]);
                        $bookingTour=new booking_tour_custom($array_detail_tour_cus);
                        if($array_detail['name_tour']!=$name_tour_cus && isset($_POST['name_tour_cus'])){
                            $bookingTour->name=$name_tour_cus;
                            $booking_update->name_tour = $name_tour_cus;
                            $string_value_old .= ' Tên tour: "' . $array_detail['name_tour'] . '" </br> ';
                            $string_value_new .= ' Tên tour mới: "' . $name_tour_cus . '" </br> ';
                        }
                        if($array_detail_tour_cus['chuong_trinh']!=$chuong_trinh && isset($_POST['chuong_trinh'])){
                            $bookingTour->chuong_trinh=$chuong_trinh;
                            $string_value_old .= ' Chương trình: "' . $array_detail_tour_cus['chuong_trinh'] . '" </br> ';
                            $string_value_new .= ' Chương trình mới: "' . $chuong_trinh . '" </br> ';
                        }
                        if($array_detail_tour_cus['chuong_trinh_price']!=$chuong_trinh_price && isset($_POST['chuong_trinh_price'])){
                            $bookingTour->chuong_trinh_price=$chuong_trinh_price;
                            $string_value_old .= ' Giá trương trình: "' . $array_detail_tour_cus['chuong_trinh_price'] . '" </br> ';
                            $string_value_new .= ' Giá trương trình mới: "' . $chuong_trinh_price . '" </br> ';
                        }
                        if($array_detail_tour_cus['thoi_gian']!=$thoi_gian && isset($_POST['thoi_gian'])){
                            $bookingTour->thoi_gian=$thoi_gian;
                            $string_value_old .= ' Thời gian: "' . $array_detail_tour_cus['thoi_gian'] . '" </br> ';
                            $string_value_new .= ' Thời gian mới: "' . $thoi_gian . '" </br> ';
                        }
                        if($array_detail_tour_cus['thoi_gian_price']!=$thoi_gian_price && isset($_POST['thoi_gian_price'])){
                            $bookingTour->thoi_gian_price=$thoi_gian_price;
                            $string_value_old .= ' Giá thời gian: "' . $array_detail_tour_cus['thoi_gian_price'] . '" </br> ';
                            $string_value_new .= ' Giá thời gian mới: "' . $thoi_gian_price . '" </br> ';
                        }
                        if($array_detail_tour_cus['nguoi_lon']!=$nguoi_lon && isset($_POST['nguoi_lon'])){
                            $bookingTour->nguoi_lon=$nguoi_lon;
                            $string_value_old .= ' Số người lớn: "' . $array_detail_tour_cus['nguoi_lon'] . '" </br> ';
                            $string_value_new .= ' Số người lớn mới: "' . $nguoi_lon . '" </br> ';
                        }
                        if($array_detail_tour_cus['tre_em']!=$nguoi_lon && isset($_POST['tre_em'])){
                            $bookingTour->tre_em=$tre_em;
                            $string_value_old .= ' Số trẻ em: "' . $array_detail_tour_cus['tre_em'] . '" </br> ';
                            $string_value_new .= ' Số trẻ em mới: "' . $tre_em . '" </br> ';
                        }
                        if($array_detail_tour_cus['tre_em_5']!=$nguoi_lon && isset($_POST['tre_em_5'])){
                            $bookingTour->tre_em_5=$tre_em_5;
                            $string_value_old .= ' Số trẻ em dưới 5 tuổi: "' . $array_detail_tour_cus['tre_em_5'] . '" </br> ';
                            $string_value_new .= ' Số trẻ em dưới 5 tuổi mới: "' . $tre_em_5 . '" </br> ';
                        }
                        if($array_detail_tour_cus['so_nguoi_price']!=$so_nguoi_price && isset($_POST['so_nguoi_price'])){
                            $bookingTour->so_nguoi_price=$so_nguoi_price;
                            $string_value_old .= ' Giá số người: "' . $array_detail_tour_cus['so_nguoi_price'] . '" </br> ';
                            $string_value_new .= ' Giá số người mới: "' . $so_nguoi_price . '" </br> ';
                        }
                        if($array_detail_tour_cus['khach_san']!=$khach_san && isset($_POST['khach_san'])){
                            $bookingTour->khach_san=$khach_san;
                            $string_value_old .= ' Khách sạn: "' . $array_detail_tour_cus['khach_san'] . '" </br> ';
                            $string_value_new .= ' Khách sạn mới: "' . $khach_san . '" </br> ';
                        }
                        if($array_detail_tour_cus['khach_san_price']!=$khach_san_price && isset($_POST['khach_san_price'])){
                            $bookingTour->khach_san_price=$khach_san_price;
                            $string_value_old .= ' Giá khách sạn: "' . $array_detail_tour_cus['khach_san_price'] . '" </br> ';
                            $string_value_new .= ' Giá khách sạn mới: "' . $khach_san_price . '" </br> ';
                        }
                        $ngay_khoi_hanh_cus = date('Y-m-d', strtotime($ngay_khoi_hanh_cus));
                        if($array_detail_tour_cus['ngay_khoi_hanh_cus']!=$ngay_khoi_hanh_cus && isset($_POST['ngay_khoi_hanh_cus'])){
                            $bookingTour->ngay_khoi_hanh_cus=$ngay_khoi_hanh_cus;
                            $string_value_old .= ' Ngày khởi hành: "' . $array_detail_tour_cus['ngay_khoi_hanh_cus'] . '" </br> ';
                            $string_value_new .= ' Ngày khởi hành mới: "' . $ngay_khoi_hanh_cus . '" </br> ';
                        }
                        if($array_detail_tour_cus['ngay_khoi_hanh_price']!=$ngay_khoi_hanh_price && isset($_POST['ngay_khoi_hanh_price'])){
                            $bookingTour->ngay_khoi_hanh_price=$ngay_khoi_hanh_price;
                            $string_value_old .= ' Giá ngày khởi hành: "' . $array_detail_tour_cus['ngay_khoi_hanh_price'] . '" </br> ';
                            $string_value_new .= ' Giá ngày khỏi hành mới: "' . $ngay_khoi_hanh_price . '" </br> ';
                        }
                        if($array_detail_tour_cus['hang_bay']!=$hang_bay && isset($_POST['hang_bay'])){
                            $bookingTour->hang_bay=$hang_bay;
                            $string_value_old .= ' Phương tiện: "' . $array_detail_tour_cus['hang_bay'] . '" </br> ';
                            $string_value_new .= ' Phương tiện mới: "' . $hang_bay . '" </br> ';
                        }
                        if($array_detail_tour_cus['hang_bay_price']!=$hang_bay_price && isset($_POST['hang_bay_price'])){
                            $bookingTour->hang_bay_price=$hang_bay_price;
                            $string_value_old .= ' Giá phương tiện: "' . $array_detail_tour_cus['hang_bay_price'] . '" </br> ';
                            $string_value_new .= ' Giá phương tiện mới: "' . $hang_bay_price . '" </br> ';
                        }
                        if($array_detail_tour_cus['khac']!=$khac && isset($_POST['khac'])){
                            $bookingTour->khac=$khac;
                            $string_value_old .= ' Dịch vụ khác: "' . $array_detail_tour_cus['khac'] . '" </br> ';
                            $string_value_new .= '  Dịch vụ khác mới: "' . $khac . '" </br> ';
                        }
                        if($array_detail_tour_cus['khac_price']!=$khac_price && isset($_POST['khac_price'])){
                            $bookingTour->khac_price=$khac_price;
                            $string_value_old .= ' Giá dịch vụ khác: "' . $array_detail_tour_cus['khac_price'] . '" </br> ';
                            $string_value_new .= '  Giá dịch vụ khác mới: "' . $khac_price . '" </br> ';
                        }
                        if($array_detail_tour_cus['note']!=$note_cus && isset($_POST['note_cus'])){
                            $bookingTour->note=$note_cus;
                            $string_value_old .= ' Ghi chú: "' . $array_detail_tour_cus['note'] . '" </br> ';
                            $string_value_new .= '  Ghi chú mới: "' . $note_cus . '" </br> ';
                        }
                        booking_tour_custom_update($bookingTour);
                    }
                }
            }

            if ($data_detail[0]->confirm_admin == 0 || $_SESSION['user_role'] == 1) {
//            if ($id_user != $array_detail['user_id']) {
//                $booking_update->user_id = $id_user;
//                $string_value_old .= ' Sales: "' . $array_detail['user_id'] . '" - ';
//                $string_value_new .= ' Sales: "' . $id_user . '" - ';
//                $edit_user = $array_detail['user_id'];
//            }

//            if ($id_customer != $array_detail['id_customer']) {
//                $booking_update->id_customer = $id_customer;
//                $string_value_old .= ' Khách hàng: "' . $array_detail['id_customer'] . '" - ';
//                $string_value_new .= ' Khách hàng: "' . $id_customer . '" - ';
//            }

//            if ($id_tour != $array_detail['id_tour']) {
//                $booking_update->id_tour = $id_tour;
//                $string_value_old .= ' Tour: "' . $array_detail['id_tour'] . '" - ';
//                $string_value_new .= ' Tour: "' . $id_tour . '" - ';
//                $check_data_tour = tour_getById($id_tour);
//                if (count($check_data_tour) == 0) {
//                    $mess = "Tour " . $name_tour . 'không tồn tại trong hệ thống';
//                    echo "<script>alert($mess)</script>";
//                    $link = SITE_NAME . '/' . $action_link . '/';
//                    echo '<script>window.location="' . $link . '";</script>';
//                    exit;
//                }
//                $price_tiep_thi = $check_data_tour[0]->price_tiep_thi;
//                $booking_update->price_tour = $check_data_tour[0]->price;
//                $booking_update->price_11 = $check_data_tour[0]->price;
//                $booking_update->price_5 = $check_data_tour[0]->price;
//                $booking_update->name_tour = $check_data_tour[0]->name;
//                $booking_update->id_tour = $id_tour;
//                $booking_update->code_tour = $check_data_tour[0]->code;
//            }
            }
            if ($tien_te != $array_detail['tien_te'] && isset($_POST['tien_te'])) {
                $booking_update->tien_te = $tien_te;
                $string_value_old .= ' Tiền tệ: "' . $array_detail['tien_te'] . '" </br> ';
                $string_value_new .= ' Tiền tệ mới: "' . $tien_te . '" </br>';
            }
            if ($ty_gia != $array_detail['ty_gia'] ) {
                $booking_update->ty_gia = $ty_gia;
                $string_value_old .= ' Tỷ giá: "' . $array_detail['ty_gia'] . '" </br> ';
                $string_value_new .= ' Tỷ giá mới: "' . $ty_gia . '" </br> ';
            }
            if ($nguon_tour != $array_detail['nguon_tour'] && isset($_POST['nguon_tour'])) {
                $booking_update->nguon_tour = $nguon_tour;
                $string_value_old .= ' Nguồn tour: "' . $array_detail['nguon_tour'] . '" </br> ';
                $string_value_new .= ' Nguồn tour mới: "' . $nguon_tour . '" </br> ';
            }
            $ngay_bat_dau = date('Y-m-d', strtotime($ngay_bat_dau));
            if ($ngay_bat_dau != $array_detail['ngay_bat_dau'] && isset($_POST['ngay_bat_dau'])) {
                $booking_update->ngay_bat_dau = date('Y-m-d', strtotime($ngay_bat_dau));
                $string_value_old .= ' Ngày bắt đầu: "' . $array_detail['ngay_bat_dau'] . '" </br> ';
                $string_value_new .= ' Ngày bắt đầu mới: "' . $ngay_bat_dau . '" </br> ';
            }
            $han_thanh_toan = date('Y-m-d', strtotime($han_thanh_toan));
            if ($han_thanh_toan != $array_detail['han_thanh_toan'] && isset($_POST['han_thanh_toan'])) {
                $booking_update->han_thanh_toan = date('Y-m-d', strtotime($han_thanh_toan));
                $string_value_old .= ' Hạn thanh toán: "' . $array_detail['han_thanh_toan'] . '" </br> ';
                $string_value_new .= ' Hạn thanh toán mới: "' . $han_thanh_toan . '" </br> ';
            }
            if ($status != $array_detail['status'] && isset($_POST['status'])) {
                $booking_update->status = $status;
                $string_value_old .= ' Trạng thái đơn hàng: "' . $array_detail['status'] . '" </br> ';
                $string_value_new .= ' Trạng thái đơn hàng mới: "' . $status . '" </br> ';
            }
            if ($hinh_thuc_thanh_toan != $array_detail['hinh_thuc_thanh_toan'] && isset($_POST['hinh_thuc_thanh_toan'])) {
                $booking_update->hinh_thuc_thanh_toan = $hinh_thuc_thanh_toan;
                $string_value_old .= ' Hình thức thanh toán: "' . $array_detail['hinh_thuc_thanh_toan'] . '" </br> ';
                $string_value_new .= ' Hình thức thanh toán mới: "' . $hinh_thuc_thanh_toan . '" </br> ';
            }
            if ($num_nguoi_lon != $array_detail['num_nguoi_lon'] && isset($_POST['num_nguoi_lon'])) {
                $booking_update->num_nguoi_lon = $num_nguoi_lon;
                $string_value_old .= ' Số người lớn: "' . $array_detail['num_nguoi_lon'] . '" </br> ';
                $string_value_new .= ' Số người lớn mới: "' . $num_nguoi_lon . '" </br> ';
            }
            if ($num_tre_em != $array_detail['num_tre_em'] && isset($_POST['num_tre_em'])) {
                $booking_update->num_tre_em = $num_tre_em;
                $string_value_old .= ' Số trẻ em 5->11 tuổi: "' . $array_detail['num_tre_em'] . '" </br> ';
                $string_value_new .= ' Số trẻ em 5->11 tuổi mới: "' . $num_tre_em . '" </br> ';
            }
            if ($num_tre_em_5 != $array_detail['num_tre_em_5'] && isset($_POST['num_tre_em_5'])) {
                $booking_update->num_tre_em_5 = $num_tre_em_5;
                $string_value_old .= ' Số trẻ em 5 tuổi: "' . $array_detail['num_tre_em_5'] . '" </br> ';
                $string_value_new .= ' Số trẻ em 5 tuổi mới: "' . $num_tre_em_5 . '" </br> ';
            }
            if ($vat != $array_detail['vat'] && isset($_POST['vat'])) {
                $booking_update->vat = $vat;
                $string_value_old .= ' VAT: "' . $array_detail['vat'] . '" </br> ';
                $string_value_new .= ' VAT mới: "' . $vat . '" </br> ';
            }

            if ($diem_don != $array_detail['diem_don'] && isset($_POST['diem_don'])) {
                $booking_update->diem_don = $diem_don;
                $string_value_old .= ' Điểm đón: "' . $array_detail['diem_don'] . '" </br> ';
                $string_value_new .= ' Điểm đón mới: "' . $diem_don . '" </br> ';
            }
            $ngay_khoi_hanh = date('Y-m-d', strtotime($ngay_khoi_hanh));
            if ($ngay_khoi_hanh != $array_detail['ngay_khoi_hanh'] && isset($_POST['ngay_khoi_hanh'])) {
                $booking_update->ngay_khoi_hanh =$ngay_khoi_hanh;
                $string_value_old .= ' Ngày khởi hành: "' . $array_detail['ngay_khoi_hanh'] . '" </br> ';
                $string_value_new .= ' Ngày khởi hành mới: "' . $ngay_khoi_hanh . '" </br> ';
            }
            $ngay_ket_thuc = date('Y-m-d', strtotime($ngay_ket_thuc));
            if ($ngay_ket_thuc != $array_detail['ngay_ket_thuc'] && isset($_POST['ngay_ket_thuc'])) {
                $booking_update->ngay_ket_thuc = $ngay_ket_thuc;
                $string_value_old .= ' Ngày kết thúc: "' . $array_detail['ngay_ket_thuc'] . '" </br> ';
                $string_value_new .= ' Ngày kết thúc mới: "' . $ngay_ket_thuc . '" </br> ';
            }
            if ($dat_coc != $array_detail['tien_thanh_toan'] && isset($_POST['dat_coc'])) {
                $booking_update->tien_thanh_toan = $dat_coc;
                $string_value_old .= ' Tiền thanh toán: "' . $array_detail['tien_thanh_toan'] . '" </br> ';
                $string_value_new .= ' Tiền thanh toán mới: "' . $dat_coc . '" </br> ';
            }

            if ($note != $array_detail['note'] && isset($_POST['note'])) {
                $booking_update->note = $note;
                $string_value_old .= ' Chú ý: "' . $array_detail['note'] . '" </br> ';
                $string_value_new .= ' Chú ý mới: "' . $note . '" </br> ';
            }
            if ($price_tiep_thi != '' && $user_tiep_thi_id_old == 0) {
                if ($user_tiep_thi_id != '') {
                    $check_data_user_tt = user_getById($user_tiep_thi_id);
                    if (count($check_data_user_tt) > 0) {
                        $booking_update->user_tiep_thi_id = $user_tiep_thi_id;
                        $save_tiepthi = 1;
                    }
                }
            }
            $booking_update->price_tiep_thi = $price_tiep_thi;
            $customer_update = new customer();
            $customer_update->booking_id = 0;
            customer_update_booking($customer_update, $array_detail['id']);
            _updateCustomerBooking($name_customer_sub, $email_customer_sub, $phone_customer_sub, $address_customer_sub, $tuoi_customer_sub, $tuoi_number_customer_sub, $birthday_customer_sub, $passport_customer_sub, $date_passport_customer_sub, $array_detail['id'], $_SESSION['user_id']);
            if($confirm_dieuhanh=='on'||$confirm_dieuhanh=='1'){
                $check_data_dieuhanh = user_getById($dieuhanh_id);
                if (count($check_data_dieuhanh)> 0) {
                    $booking_update->confirm_dieuhanh=1;
                    $name_noti = $check_data_dieuhanh[0]->name . ' đã đã xác nhận điều hành đơn hàng "' . $booking_update->code_booking . '"';
                    $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                    _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, $content_noti);
                }
            }
            if($confirm_sales=='on'||$confirm_sales=='1'){
                $check_data_user = user_getById($id_user);
                if (count($check_data_user) > 0) {
                    $booking_update->confirm_sales=1;
                    if($_SESSION['user_id']!=$booking_update->created_by){
                        $name_noti = $check_data_user[0]->name . ' đã xác nhận sales đơn hàng "' . $booking_update->code_booking . '"';
                        $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                        _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, $content_noti);
                    }
                }


            }
            if($booking_update->created_by==0){
                $booking_update->created_by=$_SESSION['user_id'];
            }
            $booking_update->updated = _returnGetDateTime();
            booking_update($booking_update);
            $data_detail = booking_getById($data_detail[0]->id);
            if ($data_detail) {
                if ($data_detail[0]->price_tiep_thi != '' && $data_detail[0]->status_tiep_thi != 1 && $data_detail[0]->confirm_admin_tiep_thi == 0 && $data_detail[0]->user_tiep_thi_id != '' && $data_detail[0]->status == 5 && $data_detail[0]->confirm_admin != 0) {
                    _returnConfirmTiepthi($data_detail, 0);
                }
            }

            if (isset($save_tiepthi) && $save_tiepthi == 1) {
                $array_user['user_name'] = $check_data_user_tt[0]->name;
                $array_user['user_email'] = $check_data_user_tt[0]->user_email;
                _insertNotification('Khách hàng ' . $name_customer . ' đã đặt tour được gắn mã tiếp thị của bạn', 0, $check_data_user_tt[0]->id, '/tiep-thi-lien-ket/don-hang/chi-tiet?noti=1&confirm=1&id=' . _return_mc_encrypt($booking_update->id, ENCRYPTION_KEY) . '', 0, '');
                $subject = 'Thông báo đơn hàng tiếp thị liên kết';
                $message_tt = '<p>Chào ' . $check_data_user_tt[0]->name . '!</p>';
                $message_tt .= '<p>Khách hàng ' . $name_customer . ' vừa đặt đơn hàng <a href="' . SITE_NAME_AZ . '/tiep-thi-lien-ket/don-hang/chi-tiet?id=' . _return_mc_encrypt($booking_update->id, ENCRYPTION_KEY) . '">"' . $booking_update->code_booking . '"</a> được gắn mã tiếp thị liên kết của bạn. Bạn hãy truy cập thông tin đơn hàng để theo dõi tiến trình và nhận hoa hồng</p>';
                $message_tt .= '<p style="text-align:center"><a href="' . SITE_NAME_AZ . '/tiep-thi-lien-ket/don-hang/chi-tiet?id=' . _return_mc_encrypt($booking_update->id, ENCRYPTION_KEY) . '" style="text-decoration:none;color:#ffffff;background-color:#f36f21;padding:10px 10px" >"Thông tin đơn hàng"</a></p>';
                SendMail($check_data_user_tt[0]->user_email, $message_tt, $subject, 'AZbOOKING.VN');
            }
            if ($string_value_old != '') {
                $arr_send_noti = array();
                _insertLog($_SESSION['user_id'], 6, 6, 22, $data_detail[0]->id, $string_value_old, $string_value_new, 'Cập nhật đơn hàng "' . $data_detail[0]->code_booking . '"');
                $link_noti = '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($data_detail[0]->id, ENCRYPTION_KEY);
                $content_noti = '__________Gía trị cũ_________' . $string_value_old . '__________Gía trị mới_________' . $string_value_new;
                $name_noti = $_SESSION['user_name'] . ' đã thay đổi thông tin đơn hàng "' . $booking_update->code_booking . '"';
                $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                if(!isset($edit_dieuhanh) && $array_detail['dieuhanh_id']!=0){
                    _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['dieuhanh_id'], $link_noti, 0, $content_noti);
                }
                if(!isset($edit_user) && $array_detail['user_id']!=0){
                    _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['user_id'], $link_noti, 0, $content_noti);
                }
                if($data_detail[0]->created_by!=$array_detail['user_id']){
                    _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, $content_noti);
                }
            }
        }

        redict(SITE_NAME . '/' . $action_link . '/');
    } else {
        if ($id_user != '' && $name_user != '' && $name_dieuhanh != '' && $code_booking != '' && $ngay_bat_dau != '' && $han_thanh_toan != '' && $hinh_thuc_thanh_toan != '' && $num_nguoi_lon != '' && $num_nguoi_lon != 0 && $name_customer != '' && $email != '' && $address != '' && $phone != '' && $diem_don != '' && $price_submit != '') {
            // check thông tin khách hàng
            $check_data_khach_hang = customer_getByTop('1', 'email="' . $email . '"', 'id desc');
            if (count($check_data_khach_hang) > 0) {
                $id_customer = $check_data_khach_hang[0]->id;
            } else {
                $dangky = new customer();
                $dangky->name = $name_customer;
                $dangky->code = _randomBooking('cus', 'customer_count');
                $dangky->mr = '';
                $dangky->email = $email;
                $dangky->address = $address;
                $dangky->created = _returnGetDateTime();
                $dangky->updated = _returnGetDateTime();
                $dangky->mobi = $phone;
                $dangky->fax = $fax;
                $dangky->status = 1;
                $dangky->phone = $phone;
                $dangky->created_by = $_SESSION['user_id'];
                $dangky->category = $nhom_khach_hang;
                customer_insert($dangky);
                $data_khachhang = customer_getByTop('1', 'email="' . $email . '"', 'id desc');
                if (count($data_khachhang) > 0) {
                    $id_customer = $data_khachhang[0]->id;
                } else {
                    echo '<script>alert("Khách hàng chưa được cập nhật vào hệ thống, bạn vui lòng thử lại")</script>';
                    exit;
                }

            }
            $price_old = 0;
            $price_tiep_thi = 0;
            $booking_model = new booking();
            // type tour
            if ($type_tour == 1 || $type_tour == 0) {
                if ($type_tour == 1) {
                    if ($name_tour_cus == '' || $chuong_trinh == '' || $thoi_gian == '' || $nguoi_lon == '') {
                        echo '<script>alert("Bạn vui lòng nhập thông tin tour")</script>';
                        exit;
                    }
                    // lưu lại thông tin tour theo yêu cầu khách hàng
                    $tour_custom = new booking_tour_custom();
                    $tour_custom->name = $name_tour_cus;
                    $tour_custom->chuong_trinh = $chuong_trinh;
                    $tour_custom->chuong_trinh_price = $chuong_trinh_price;
                    $tour_custom->thoi_gian = $thoi_gian;
                    $tour_custom->thoi_gian_price = $thoi_gian_price;
                    $tour_custom->nguoi_lon = $nguoi_lon;
                    $tour_custom->tre_em = $tre_em;
                    $tour_custom->chuong_trinh = $tre_em_5;
                    $tour_custom->so_nguoi_price = $so_nguoi_price;
                    $tour_custom->khach_san = $khach_san;
                    $tour_custom->khach_san_price = $khach_san_price;
                    $tour_custom->ngay_khoi_hanh_cus = date("d-m-Y", strtotime($ngay_khoi_hanh_cus));
                    $tour_custom->ngay_khoi_hanh_price = $ngay_khoi_hanh_price;
                    $tour_custom->hang_bay = $hang_bay;
                    $tour_custom->hang_bay_price = $hang_bay_price;
                    $tour_custom->khac = $khac;
                    $tour_custom->khac_price = $khac_price;
                    $tour_custom->note = $note_cus;
                    $tour_custom->code = _randomBooking('#', 'booking_tour_custom_count');
                    booking_tour_custom_insert($tour_custom);
                    $data_check_tour_custom = booking_tour_custom_getByTop(1, 'code="' . $tour_custom->code . '"', 'id desc');
                    if (!$data_check_tour_custom) {
                        echo '<script>alert("Lưu thông tin tour thất bại")</script>';
                        exit;
                    }
                    $booking_model->id_tour = $data_check_tour_custom[0]->id;
                    $booking_model->name_tour = $data_check_tour_custom[0]->name;
                    $booking_model->code_tour = $data_check_tour_custom[0]->code;
                    $booking_model->price_tour = $price_submit;
                    $booking_model->price_11 = $price_511_submit;
                    $booking_model->price_5 = $price_5_submit;
                    $booking_model->phuong_tien = $hang_bay;
                    $booking_model->tour_custom = 1;

                } else {
                    $check_data_tour = tour_getById($id_tour);
                    if (count($check_data_tour) == 0) {
                        $mess = "Tour " . $name_tour . 'không tồn tại trong hệ thống';
                        echo "<script>alert($mess)</script>";
                        exit;
                    }
                    $price_old = $check_data_tour[0]->price;
                    $price_tiep_thi = $check_data_tour[0]->price_tiep_thi;
                    $booking_model->id_tour = $id_tour;
                    $booking_model->name_tour = $check_data_tour[0]->name;
                    $booking_model->code_tour = $check_data_tour[0]->code;
                    $booking_model->price_tour = $check_data_tour[0]->price;
                    $booking_model->price_11 = $check_data_tour[0]->price_2;
                    $booking_model->price_5 = $check_data_tour[0]->price_3;
                    $booking_model->phuong_tien = $check_data_tour[0]->vehicle;
                    if ($check_data_tour[0]->so_cho >= 0) {
                        $update_tour = new tour((array)$check_data_tour[0]);
                        $con_lai = $check_data_tour[0]->so_cho - ($num_nguoi_lon + $num_tre_em + $num_tre_em_5);
                        if ($con_lai < 0) {
                            $con_lai = 0;
                        }
                        $update_tour->so_cho = $con_lai;
                        tour_update($update_tour);
                    }
                }
            } else {
                echo '<script>alert("Bạn vui lòng chọn loại tour")</script>';
                exit;
            }

            $check_data_user = user_getById($id_user);
            if (count($check_data_user) == 0) {
                $mess = "Sales " . $name_user . ' không tồn tại trong hệ thống';
                echo "<script>alert($mess)</script>";
                exit;
            }

            $check_data_dieuhanh = user_getById($dieuhanh_id);
            if (count($check_data_dieuhanh) == 0) {
                $mess = "Điều hành " . $name_dieuhanh . ' không tồn tại trong hệ thống';
                echo "<script>alert($mess)</script>";
                exit;
            }

            if ($id_user == $_SESSION['user_id']) {
                $booking_model->confirm_sales = 1;
            }
            if ($dieuhanh_id == $_SESSION['user_id']) {
                $booking_model->confirm_dieuhanh = 1;
            }
            $booking_model->price_new = $price_submit;
            $booking_model->price_11_new = $price_511_submit;
            $booking_model->price_5_new = $price_5_submit;
            $booking_model->nguon_tour = $nguon_tour;
            $booking_model->tien_te = $tien_te;
            $booking_model->ty_gia = $ty_gia;
            $booking_model->ngay_bat_dau = date("Y-m-d", strtotime($ngay_bat_dau));
            $booking_model->han_thanh_toan = date("Y-m-d", strtotime($han_thanh_toan));;
            $booking_model->loai_khach_hang = $nhom_khach_hang;
            $booking_model->hinh_thuc_thanh_toan = $hinh_thuc_thanh_toan;
            $booking_model->id_customer = $id_customer;
            $booking_model->diem_don = $diem_don;
            $booking_model->diem_tra = $diem_don;
            $booking_model->ngay_khoi_hanh = date("Y-m-d", strtotime($ngay_khoi_hanh));
            $booking_model->ngay_ket_thuc = date("Y-m-d", strtotime($ngay_ket_thuc));

            $booking_model->num_nguoi_lon = $num_nguoi_lon;
            $booking_model->num_tre_em = $num_tre_em;
            $booking_model->num_tre_em_5 = $num_tre_em_5;
            $booking_model->total_price = $total;
            $booking_model->tien_thanh_toan = $dat_coc;
            $booking_model->user_id = $id_user;
            $booking_model->dieuhanh_id = $dieuhanh_id;
            $booking_model->note = $note;
            $booking_model->vat = $vat;
            $booking_model->price_tiep_thi = $price_tiep_thi;
            if ($user_tiep_thi_id != '') {
                $check_data_user_tt = user_getById($user_tiep_thi_id);
                if (count($check_data_user_tt) > 0 && $price_tiep_thi != '') {
                    $booking_model = _returnHoaHongBooking($booking_model, $check_data_user_tt, $price_tiep_thi);
                    $booking_model->user_tiep_thi_id = $user_tiep_thi_id;
                    $save_tiepthi = 1;
                }
            }
            if ($status == '') {
                $status = 1;
            }
            $booking_model->status = $status;
            if ($_SESSION['user_role'] == 1) {
                $booking_model->confirm_admin = $_SESSION['user_id'];
            } else {
                $booking_model->confirm_admin = 0;
            }

            $booking_model->created_by = $_SESSION['user_id'];
            $booking_model->created = _returnGetDateTime();
            $booking_model->updated = _returnGetDateTime();
            $data_check_code = booking_count('code_booking="' . $code_booking . '"');
            if ($data_check_code > 0) {
                $code_booking = _randomBooking('#', 'booking_count', 'code_booking');
            }
            $booking_model->code_booking = $code_booking;
            booking_insert($booking_model);
            $data_booking = booking_getByTop('1', 'code_booking="' . $code_booking . '"', '');
            if (count($data_booking) > 0) {
                $id_booking = $data_booking[0]->id;
            }
            _updateCustomerBooking($name_customer_sub, $email_customer_sub, $phone_customer_sub, $address_customer_sub, $tuoi_customer_sub, $tuoi_number_customer_sub, $birthday_customer_sub, $passport_customer_sub, $date_passport_customer_sub, $id_booking, $_SESSION['user_id']);

            // tiep thi lien ket
            if (isset($save_tiepthi) && $save_tiepthi == 1) {
                print_r($save_tiepthi);
                $array_user['user_name'] = $check_data_user_tt[0]->name;
                $array_user['user_email'] = $check_data_user_tt[0]->user_email;
                _insertNotification('Khách hàng ' . $name_customer . ' đã đặt tour được gắn mã tiếp thị của bạn', 0, $check_data_user_tt[0]->id, '/tiep-thi-lien-ket/don-hang/chi-tiet?noti=1&confirm=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY) . '', 0, '');
                $subject = 'Thông báo đơn hàng tiếp thị liên kết';
                $message_tt .= '<p>Chào ' . $check_data_user_tt[0]->name . '!</p>';
                $message_tt .= '<p>Khách hàng ' . $name_customer . ' vừa đặt đơn hàng <a href="' . SITE_NAME_AZ . '/tiep-thi-lien-ket/don-hang/chi-tiet?id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY) . '">"' . $code_booking . '"</a> được gắn mã tiếp thị liên kết của bạn. Bạn hãy truy cập thông tin đơn hàng để theo dõi tiến trình và nhận hoa hồng</p>';
                $message_tt .= '<p style="text-align:center"><a href="' . SITE_NAME_AZ . '/tiep-thi-lien-ket/don-hang/chi-tiet?id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY) . '" style="text-decoration:none;color:#ffffff;background-color:#f36f21;padding:10px 10px" >"Thông tin đơn hàng"</a></p>';
                SendMail($check_data_user_tt[0]->user_email, $message_tt, $subject, 'AZbOOKING.VN');
            }


            if ($_SESSION['user_role'] != 1) {
//                $name_noti = $_SESSION['user_name'] . ' đã thêm một đơn hàng';
//                $link_noti = '/' . $action_link . '/sua?noti=1&confirm=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY);
//                $data_list_user_admin = user_getByTop('', 'user_role=1 and status=1', 'id desc');
//                if (count($data_list_user_admin) > 0) {
//                    foreach ($data_list_user_admin as $row_admin) {
//                        _insertNotification($name_noti, $_SESSION['user_id'], $row_admin->id, $link_noti, 0, '');
//                    }
//                }
//                $subject = 'Xác nhận đơn hàng ' . $code_booking;
//                $message .= '<p>Nhân viên ' . $check_data_user[0]->name . ' vừa tạo đơn hàng mã ' . $code_booking . '</p>';
//                $message .= '<a>Bạn vui lòng truy cập <a href="' . SITE_NAME . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
//                SendMail(SEND_EMAIL, $message, $subject);
//                $mess_log = 'Nhân viên ' . $check_data_user[0]->name . ' đã thực hiện việc tạo đơn hàng';
            } else {
//                $name_noti = $_SESSION['user_name'] . ' đã thêm một đơn hàng cho bạn';
//                $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY);
//                _insertNotification($name_noti, $_SESSION['user_id'], $id_user, $link_noti, 0, '');

//                $subject='Xác nhận đơn hàng '.$code_booking;
//                $message.='<p>Admin '.$_SESSION['user_name'].' vừa tạo đơn hàng mã '.$code_booking.'</p>';
//                $message.='<a>Bạn vui lòng truy cập <a href="'.$link_noti.'">đường link</a> để xác nhận đơn hàng</p>';
//                SendMail($check_data_user[0]->email, $message, $subject);
                $mess_log = 'Admin ' . $_SESSION['user_name'] . ' đã thực hiện việc tạo đơn hàng';
            }
            // gửi email và noti đến điều hành
            $name_noti = $_SESSION['user_name'] . ' đã chọn bạn làm điều hành cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng';
            $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY);
            _insertNotification($name_noti, $_SESSION['user_id'], $dieuhanh_id, $link_noti, 0, '');

            $subject = 'Xác nhận đơn hàng ' . $code_booking;
            $message = '<p>Nhân viên ' . $_SESSION['user_name'] . ' đã chọn bạn làm điều hành cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng</p>';
            $message .= '<a>Bạn vui lòng truy cập <a href="' . SITE_NAME . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
            SendMail($check_data_dieuhanh[0]->user_email, $message, $subject);

            // gửi đơn hàng tới sales
            if ($id_user != $_SESSION['user_id']) {
                //
                $name_noti = $_SESSION['user_name'] . ' đã chọn bạn làm sales cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng';
                $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY);
                _insertNotification($name_noti, $_SESSION['user_id'], $id_user, $link_noti, 0, '');

                $subject = 'Xác nhận đơn hàng ' . $code_booking;
                $mess_log = 'Nhân viên ' . $_SESSION['user_name'] . ' đã thực hiện việc tạo đơn hàng';
                $message = '<p>Nhân viên ' . $_SESSION['user_name']  . ' đã chọn bạn làm sales cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng</p>';
                $message .= '<a>Bạn vui lòng truy cập <a href="' . SITE_NAME . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
                SendMail($check_data_user[0]->user_email , $message, $subject);
            }else{
                $name_noti = 'Bạn đã tạo thành công đơn hàng '.$code_booking;
                $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY);
                _insertNotification($name_noti, $_SESSION['user_id'], $id_user, $link_noti, 0, '');

                $subject = 'Thông báo tạo đơn hàng ' . $code_booking.' thành công';
                $message = '<p>Bạn vừa tạo thành công đơn hàng mã ' . $code_booking . '</p>';
                SendMail($check_data_user[0]->user_email, $message, $subject);
                $mess_log = 'Nhân viên ' . $check_data_user[0]->name . ' đã thực hiện việc tạo đơn hàng';
            }

//            $subject='Xác nhận đơn hàng '.$code_booking;
//            $message.='<p>Nhân viên '.$check_data_user[0]->name.' vừa tạo đơn hàng mã '.$code_booking.'</p>';
//            $message.='<a>Bạn vui lòng truy cập <a href="'.SITE_NAME.$link_noti.'">đường link</a> để xác nhận đơn hàng</p>';
//            SendMail(SEND_EMAIL, $message, $subject);
//            $mess_log='Nhân viên '.$check_data_user[0]->name.' đã thực hiện việc tạo đơn hàng';


            _insertLog($_SESSION['user_id'], 6, 6, 21, $id_booking, '', '', $mess_log);
            redict(SITE_NAME . '/' . $action_link . '/');

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

