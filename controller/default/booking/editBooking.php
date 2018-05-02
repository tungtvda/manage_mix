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
$string_value_old = '';
$string_value_new = '';
$data_detail = $data['data_user'];
$user_tiep_thi_id_old = $data_detail[0]->user_tiep_thi_id;
$price_tiep_thi = $data_detail[0]->price_tiep_thi;
$price_tiep_thi_thuc_te = $data_detail[0]->price_tiep_thi_thuc_te;
$array_detail = ((array)$data_detail[0]);
$booking_update = new booking($array_detail);

if($array_detail['status']!=5){
    // cập nhật thông tin khách hàng
    $check_data_khach_hang = customer_getByTop('1', 'email="' . $email . '"', 'id desc');
    if (count($check_data_khach_hang) > 0) {
        $id_customer = $check_data_khach_hang[0]->id;
        // update thông tin khách hàng
        $update_cus = new customer((array)$check_data_khach_hang[0]);

        if ($name_customer != $check_data_khach_hang[0]->name) {
            $update_cus->name=$name_customer;
            $string_value_old .= ' Tên khách hàng: "' .$check_data_khach_hang[0]->name. '" </br> ';
            $string_value_new .= ' Tên khách hàng mới: "' . $name_customer . '" </br> ';
        }

        if ($address != $check_data_khach_hang[0]->address) {
            $update_cus->address=$address;
            $string_value_old .= ' Địa chỉ khách hàng: "' .$check_data_khach_hang[0]->address. '" </br> ';
            $string_value_new .= ' Địa chỉ khách hàng mới: "' . $address . '" </br> ';
        }

        if ($phone != $check_data_khach_hang[0]->phone) {
            $update_cus->phone=$phone;
            $string_value_old .= ' Điện thoại khách hàng: "' .$check_data_khach_hang[0]->phone. '" </br> ';
            $string_value_new .= ' Điện thoại khách hàng mới: "' . $phone . '" </br> ';
        }
        if ($fax != $check_data_khach_hang[0]->fax) {
            $update_cus->fax=$fax;
            $string_value_old .= ' Số fax khách hàng: "' .$check_data_khach_hang[0]->fax. '" </br> ';
            $string_value_new .= ' Số fax khách hàng mới: "' . $fax . '" </br> ';
        }
        if ($cong_ty != $check_data_khach_hang[0]->company_name) {
            $update_cus->company_name=$cong_ty;
            $string_value_old .= ' Công ty khách hàng: "' .$check_data_khach_hang[0]->company_name. '" </br> ';
            $string_value_new .= ' Công ty khách hàng mới: "' . $cong_ty . '" </br> ';
        }

        if($nhom_khach_hang!=''){
            $update_cus->category=$nhom_khach_hang;
        }
        customer_update($update_cus);
    }

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
    // thay đổi sales
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

                    $subject = 'Xác nhận đơn hàng ' . $code_booking;
                    $mess_log = 'Nhân viên ' . $_SESSION['user_name'] . ' đã thực hiện việc sửa đơn hàng';
                    $message = '<p>Nhân viên ' . $_SESSION['user_name']  . ' đã chọn bạn làm sales cho đơn hàng '.$code_booking.'. Bạn hãy xác nhận đơn hàng</p>';
                    $message .= '<a>Bạn vui lòng truy cập <a href="' . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
                    SendMail($check_data_user[0]->user_email , $message, $subject);
                }else{
                    $name_noti = 'Bạn đã tạo thành công đơn hàng '.$code_booking;
                    $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
                    _insertNotification($name_noti, $_SESSION['user_id'], $id_user, $link_noti, 0, '');

                    $subject = 'Thông báo sửa đơn hàng ' . $code_booking.' thành công';
                    $message = '<p>Bạn vừa tạo thành công đơn hàng mã ' . $code_booking . '</p>';
                    SendMail($check_data_user[0]->user_email, $message, $subject);
                    $mess_log = 'Nhân viên ' . $check_data_user[0]->name . ' đã thực hiện việc sửa đơn hàng';
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
        $change_total=0;
        if ($num_nguoi_lon != $array_detail['num_nguoi_lon'] && isset($_POST['num_nguoi_lon'])) {
            $booking_update->num_nguoi_lon = $num_nguoi_lon;
            $string_value_old .= ' Số người lớn: "' . $array_detail['num_nguoi_lon'] . '" </br> ';
            $string_value_new .= ' Số người lớn mới: "' . $num_nguoi_lon . '" </br> ';
            $change_total=1;
        }

        if ($num_tre_em_m1 != $array_detail['num_tre_em_m1'] && isset($_POST['num_tre_em_m1'])) {
            $booking_update->num_tre_em_m1 = $num_tre_em_m1;
            $string_value_old .= ' Số trẻ em mức 1: "' . $array_detail['num_tre_em_m1'] . '" </br> ';
            $string_value_new .= ' Số trẻ em mức 1 mới: "' . $num_tre_em_m1 . '" </br> ';
            $change_total=1;
        }

        if ($num_tre_em_m2 != $array_detail['num_tre_em_m2'] && isset($_POST['num_tre_em_m2'])) {
            $booking_update->num_tre_em_m2 = $num_tre_em_m2;
            $string_value_old .= ' Số trẻ em mức 2: "' . $array_detail['num_tre_em_m2'] . '" </br> ';
            $string_value_new .= ' Số trẻ em mức 2 mới: "' . $num_tre_em_m2 . '" </br> ';
            $change_total=1;
        }
        if ($num_tre_em_m3 != $array_detail['num_tre_em_m3'] && isset($_POST['num_tre_em_m3'])) {
            $booking_update->num_tre_em_m3 = $num_tre_em_m3;
            $string_value_old .= ' Số trẻ em mức 3: "' . $array_detail['num_tre_em_m3'] . '" </br> ';
            $string_value_new .= ' Số trẻ em mức 3 mới: "' . $num_tre_em_m3 . '" </br> ';
            $change_total=1;
        }
        if(!isset($_POST['num_nguoi_lon'])){
            $num_nguoi_lon=$array_detail['num_nguoi_lon'];
        }
        if(!isset($_POST['num_tre_em_m1'])){
            $num_tre_em_m1=$array_detail['num_tre_em_m1'];
        }
        if(!isset($_POST['num_tre_em_m2'])){
            $num_tre_em_m2=$array_detail['num_tre_em_m2'];
        }
        if(!isset($_POST['num_tre_em_m3'])){
            $num_tre_em_m3=$array_detail['num_tre_em_m3'];
        }
        if ($tyle_m1 != $array_detail['ty_le_m1'] && isset($_POST['tyle_m1'])) {
            $booking_update->ty_le_m1 = $tyle_m1;
            $string_value_old .= ' Tỷ lệ trẻ em mức 1: "' . $array_detail['ty_le_m1'] . '" </br> ';
            $string_value_new .= ' Tỷ lệ trẻ em mức 1 mới: "' . $tyle_m1 . '" </br> ';
        }
        if ($tyle_m2 != $array_detail['ty_le_m2'] && isset($_POST['tyle_m2'])) {
            $booking_update->ty_le_m2 = $tyle_m2;
            $string_value_old .= ' Tỷ lệ trẻ em mức 2: "' . $array_detail['ty_le_m2'] . '" </br> ';
            $string_value_new .= ' Tỷ lệ trẻ em mức 2 mới: "' . $tyle_m2. '" </br> ';
        }
        if ($tyle_m1 != $array_detail['ty_le_m3'] && isset($_POST['tyle_m3'])) {
            $booking_update->ty_le_m3 = $tyle_m3;
            $string_value_old .= ' Tỷ lệ trẻ em mức 3: "' . $array_detail['ty_le_m3'] . '" </br> ';
            $string_value_new .= ' Tỷ lệ trẻ em mức 3 mới: "' . $tyle_m3 . '" </br> ';
        }

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
    if ($thuong_hieu != $array_detail['thuong_hieu'] && isset($_POST['thuong_hieu']) && $tien_te!=0) {
        $booking_update->thuong_hieu = $tien_te;
        $string_value_old .= ' Thương hiệu: "' . $array_detail['thuong_hieu'] . '" </br> ';
        $string_value_new .= ' Thương hiệu mới: "' . $thuong_hieu . '" </br>';
    }
    if ($ma_doan != $array_detail['ma_doan'] && isset($_POST['ma_doan']) ) {
        $booking_update->ma_doan = $ma_doan;
        $string_value_old .= ' Mã đoàn: "' . $array_detail['ma_doan'] . '" </br> ';
        $string_value_new .= ' Mã đoàn mới: "' . $ma_doan . '" </br>';
    }
    if ($cong_ty != $array_detail['cong_ty'] && isset($_POST['cong_ty']) ) {
        $booking_update->cong_ty = $cong_ty;
        $string_value_old .= ' Công ty khách hàng: "' . $array_detail['cong_ty'] . '" </br> ';
        $string_value_new .= ' Công ty khách hàng mới: "' . $cong_ty . '" </br>';
    }
    if ($tien_te != $array_detail['tien_te'] && isset($_POST['tien_te']) && $tien_te!=0) {
        $booking_update->tien_te = $tien_te;
        $string_value_old .= ' Tiền tệ: "' . $array_detail['tien_te'] . '" </br> ';
        $string_value_new .= ' Tiền tệ mới: "' . $tien_te . '" </br>';
    }
    if ($ty_gia != $array_detail['ty_gia'] ) {
        $booking_update->ty_gia = $ty_gia;
        $string_value_old .= ' Tỷ giá: "' . $array_detail['ty_gia'] . '" </br> ';
        $string_value_new .= ' Tỷ giá mới: "' . $ty_gia . '" </br> ';
    }
    if ($link_bang_gia != $array_detail['link_bang_gia'] && isset($_POST['link_bang_gia'])) {
        $booking_update->link_bang_gia = $link_bang_gia;
        $string_value_old .= ' Link bảng giá: "' . $array_detail['link_bang_gia'] . '" </br> ';
        $string_value_new .= ' Link bảng giá mới: "' . $link_bang_gia . '" </br> ';
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
    if ($vat != $array_detail['vat'] && isset($_POST['vat'])) {
        $booking_update->vat = $vat;
        $string_value_old .= ' VAT: "' . $array_detail['vat'] . '" </br> ';
        $string_value_new .= ' VAT mới: "' . $vat . '" </br> ';
    }

//    if($total!=$array_detail['total_price']){
//        $booking_update->total_price=$total;
//    }
    if ($price_submit != $array_detail['price_new'] && isset($_POST['price_submit'])) {
        $booking_update->price_new = $price_submit;
        $string_value_old .= ' Đơn giá người lớn: "' .number_format((float) $array_detail['price_new'], 0, ",", ".") . ' vnđ" </br> ';
        $string_value_new .= ' Đơn giá ngưới lớn mới: "' . number_format((float) $price_submit, 0, ",", ".") . '" vnđ</br> ';
        $change_total=1;
    }
    if ($price_m1_submit != $array_detail['price_tre_em_m1_new'] && isset($_POST['price_m1_submit'])) {
        $booking_update->price_tre_em_m1_new = $price_m1_submit;
        $string_value_old .= ' Đơn giá trẻ em mức 1: "' . number_format((float) $array_detail['price_tre_em_m1_new'], 0, ",", ".") . '" vnđ</br> ';
        $string_value_new .= ' Đơn giá trẻ em mức 1 mới: "' . number_format((float) $price_m1_submit, 0, ",", ".") . '" vnđ</br> ';
        $change_total=1;
    }
    if ($price_m2_submit != $array_detail['price_tre_em_m2_new'] && isset($_POST['price_m2_submit'])) {
        $booking_update->price_tre_em_m2_new = $price_m2_submit;
        $string_value_old .= ' Đơn giá trẻ em mức 2: "' . number_format((float) $array_detail['price_tre_em_m2_new'], 0, ",", ".") . '" vnđ</br> ';
        $string_value_new .= ' Đơn giá trẻ em mức 2 mới: "' . number_format((float) $price_m2_submit, 0, ",", ".") . '" vnđ</br> ';
        $change_total=1;
    }
    if ($price_m3_submit != $array_detail['price_tre_em_m3_new'] && isset($_POST['price_m3_submit'])) {
        $booking_update->price_tre_em_m3_new = $price_m3_submit;
        $string_value_old .= ' Đơn giá trẻ em mức 3: "' . number_format((float) $array_detail['price_tre_em_m3_new'], 0, ",", ".") . '" vnđ</br> ';
        $string_value_new .= ' Đơn giá trẻ em mức 3 mới: "' . number_format((float) $price_m3_submit, 0, ",", ".") . '" vnđ</br> ';
        $change_total=1;
    }

    if(!isset($_POST['price_submit'])){
        $price_submit=$array_detail['price_new'];
    }
    if(!isset($_POST['price_m1_submit'])){
        $price_m1_submit=$array_detail['price_tre_em_m1_new'];
    }
    if(!isset($_POST['price_m2_submit'])){
        $price_m2_submit=$array_detail['price_tre_em_m2_new'];
    }
    if(!isset($_POST['price_m3_submit'])){
        $price_m3_submit=$array_detail['price_tre_em_m3_new'];
    }

    $total_new = 0;
    if (is_numeric($num_nguoi_lon) && is_numeric($price_submit)) {
        $total_new = $total_new + ($num_nguoi_lon * $price_submit);
    }
    if (is_numeric($num_tre_em_m1) && is_numeric($price_m1_submit)) {
        $total_new = $total_new + ($num_tre_em_m1 * $price_m1_submit);
    }
    if (is_numeric($num_tre_em_m2) && is_numeric($price_m2_submit)) {
        $total_new = $total_new + ($num_tre_em_m2 * $price_m2_submit);
    }
    if (is_numeric($num_tre_em_m3) && is_numeric($price_m3_submit)) {
        $total_new = $total_new + ($num_tre_em_m3 * $price_m3_submit);
    }

    $total_old = 0;
    if (is_numeric($array_detail['num_nguoi_lon']) && is_numeric($array_detail['price_new'])) {
        $total_old = $total_old + ($array_detail['num_nguoi_lon'] * $array_detail['price_new']);
    }
    if (is_numeric($array_detail['num_tre_em_m1']) && is_numeric($array_detail['price_tre_em_m1_new'])) {
        $total_old = $total_old + ($array_detail['num_tre_em_m1'] * $array_detail['price_tre_em_m1_new']);
    }
    if (is_numeric($array_detail['num_tre_em_m2']) && is_numeric($array_detail['price_tre_em_m2_new'])) {
        $total_old = $total_old + ($array_detail['num_tre_em_m2'] * $array_detail['price_tre_em_m2_new']);
    }
    if (is_numeric($array_detail['num_tre_em_m3']) && is_numeric($array_detail['price_tre_em_m3_new'])) {
        $total_old = $total_old + ($array_detail['num_tre_em_m3'] * $array_detail['price_tre_em_m3_new']);
    }


    if($total_old!=$total_new){
        $booking_update->total_price = round($total_new,2);
        $string_value_old .= ' Tổng tiền: "' . number_format((float)$total_old, 0, ",", ".") . '" vnđ </br> ';
        $string_value_new .= ' Tổng tiền mới: "' . number_format((float)$total_new, 0, ",", ".") . '" vnđ </br> ';
    }
    // thêm hoa hồng cho đơn hàng
    if ($price_tiep_thi_thuc_te != '' && $user_tiep_thi_id_old == 0) {
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
    // Danh sách bảng giá dịch vụ
    // delete danh sách bảng giá dịch vụ
    if($name_dichvu && $type_dichvu && $price_dichvu && $soluong_dichvu && $thanhtien_dichvu && $ghichu_dichvu && ($_SESSION['user_id']== $booking_update->dieuhanh_id || $_SESSION['user_role']==1)){
        list_bang_gia_booking_delete($array_detail['id']);
        _updateDanhSachBangGia($name_dichvu,$type_dichvu,$price_dichvu,$soluong_dichvu,$thanhtien_dichvu,$ghichu_dichvu, $array_detail['id']);
    }
    if($_SESSION['user_id']==$dieuhanh_id){
        $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
        $check_data_dieuhanh = user_getById($dieuhanh_id);
        if (count($check_data_dieuhanh)> 0) {
            if(($confirm_dieuhanh==''||$confirm_dieuhanh=='1') &&  $booking_update->confirm_dieuhanh!=1){
                    $booking_update->confirm_dieuhanh=1;
                    $name_noti = $check_data_dieuhanh[0]->name . ' đã xác nhận quyền điều hành đơn hàng "' . $booking_update->code_booking . '"';
                    _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, '');
                    _insertBookingTran($booking_update->id,0,$_SESSION['user_id'],'Xác nhận điều hành',$name_noti);

            }else{
                if($confirm_dieuhanh==0 &&  $booking_update->confirm_dieuhanh!=1){
                    $booking_update->confirm_dieuhanh=0;
                    $name_noti = $check_data_dieuhanh[0]->name . ' đã hủy quyền điều hành đơn hàng "' . $booking_update->code_booking . '"';
                    _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, '');
                    if($ly_do_dieu_hanh!=''){
                        $name_noti.='</br> Lý do: '.$ly_do_dieu_hanh;
                    }
                    _insertBookingTran($booking_update->id,0,$_SESSION['user_id'],'Hủy quyền điều hành',$name_noti);
                }
            }
        }

    }
    if($_SESSION['user_id']==$id_user){
        $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($array_detail['id'], ENCRYPTION_KEY);
        $check_data_user = user_getById($id_user);
        if (count($check_data_user) > 0) {
            if(($confirm_sales==''||$confirm_sales=='1') && $booking_update->confirm_sales!=1){
                $booking_update->confirm_sales=1;
                if($_SESSION['user_id']!=$booking_update->created_by){
                    $name_noti = $check_data_user[0]->name . ' đã xác nhận quyền sales đơn hàng "' . $booking_update->code_booking . '"';
                    _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, '');
                    _insertBookingTran($booking_update->id,0,$_SESSION['user_id'],'Xác nhận sales',$name_noti);
                }
            }else{
                if($confirm_sales==0 && $booking_update->confirm_sales!=1){
                    $booking_update->confirm_sales=0;
                    $name_noti = $check_data_user[0]->name . ' đã hủy quyền sales đơn hàng "' . $booking_update->code_booking . '"';
                    _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, '');
                    if($ly_do_sales!=''){
                        $name_noti.='</br> Lý do: '.$ly_do_sales;
                    }
                    _insertBookingTran($booking_update->id,0,$_SESSION['user_id'],'Hủy quyền sales',$name_noti);
                }
            }

        }
    }


    if($booking_update->created_by==0 && $_SESSION['user_role']==1){
        $booking_update->created_by=$_SESSION['user_id'];
    }
    // xác nhận tiền hoa hồng
    $confirm_status_tiep_thi=0;
    $booking_update->updated = _returnGetDateTime();

    if($_SESSION['user_id']==$booking_update->confirm_admin_tiep_thi && $user_tiep_thi_id_old!=0 && $price_tiep_thi_thuc_te!='' && $price_tiep_thi_thuc_te>0 && $booking_update->status_tiep_thi==0){
        $booking_update->status_tiep_thi=1;
        $confirm_status_tiep_thi=1;
        $hoa_hong_thanh_vien= _returnPostParamSecurity('hoa_hong_thanh_vien');
        if($hoa_hong_thanh_vien==''){
            $hoa_hong_thanh_vien=0;
        }
        if($hoa_hong_thanh_vien!=$price_tiep_thi_thuc_te && $hoa_hong_thanh_vien!=''){
            $check_data_user_tt = user_getById($user_tiep_thi_id_old);
            if (count($check_data_user_tt) > 0) {
                if(strpos($check_data_user_tt[0]->user_code,'az_sa')!=''){
                    $booking_update = _returnHoaHongBooking($booking_update, $check_data_user_tt, $hoa_hong_thanh_vien,1);
                }else{
                    $booking_update = _returnHoaHongBooking($booking_update, $check_data_user_tt, $hoa_hong_thanh_vien);
                }
            }
        }
    }

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
    $link_noti =SITE_NAME.'/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($data_detail[0]->id, ENCRYPTION_KEY);
    $name_noti = $_SESSION['user_name'] . ' đã thay đổi thông tin đơn hàng "' . $booking_update->code_booking . '"';
    if ($string_value_old != '' && $confirm_status_tiep_thi==0) {
        $arr_send_noti = array();
        $content_noti = '__________Gía trị cũ_________</br>' . $string_value_old . '__________Gía trị mới_________</br>' . $string_value_new;
        if(!isset($edit_dieuhanh) && $array_detail['dieuhanh_id']!=0 && $array_detail['dieuhanh_id']!=$_SESSION['user_id']){
            _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['dieuhanh_id'], $link_noti, 0, $content_noti);
        }
        if(!isset($edit_user) && $array_detail['user_id']!=0 && $array_detail['user_id']!=$_SESSION['user_id']){
            _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['user_id'], $link_noti, 0, $content_noti);
        }
        if($data_detail[0]->created_by!=$_SESSION['user_id']){
            _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, $content_noti);
        }
        $name_noti.='</br>'.$content_noti;
        _insertBookingTran($booking_update->id,0,$_SESSION['user_id'],'Xác nhận sales',$name_noti);
    }else{
        if($confirm_status_tiep_thi==1){
            $name_noti = $_SESSION['user_name'] . ' đã xác nhận hoa hồng cho đơn hàng "' . $booking_update->code_booking . '"';
            if($array_detail['dieuhanh_id']!=0){
                _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['dieuhanh_id'], $link_noti, 0, '');
            }
            if($array_detail['user_id']!=0){
                _insertNotification($name_noti, $_SESSION['user_id'], $array_detail['user_id'], $link_noti, 0, '');
            }
            if($array_detail['created_by']){
                _insertNotification($name_noti, $_SESSION['user_id'], $data_detail[0]->created_by, $link_noti, 0, '');
            }
            _insertBookingTran($booking_update->id,0,$_SESSION['user_id'],'Xác nhận sales',$name_noti);
        }
    }
    _insertLog($_SESSION['user_id'], 6, 6, 22, $data_detail[0]->id, $string_value_old, $string_value_new, 'Cập nhật đơn hàng "' . $data_detail[0]->code_booking . '"');
}