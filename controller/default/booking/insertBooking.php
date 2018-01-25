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
// check thông tin khách hàng
$check_data_khach_hang = customer_getByTop('1', 'email="' . $email . '"', 'id desc');
if (count($check_data_khach_hang) > 0) {
    $id_customer = $check_data_khach_hang[0]->id;
    // update thông tin khách hàng
    $update_cus = new customer((array)$check_data_khach_hang[0]);
    $update_cus->name=$name_customer;
    $update_cus->address=$address;
    $update_cus->phone=$phone;
    $update_cus->fax=$fax;
    $update_cus->company_name=$cong_ty;
    if($nhom_khach_hang!=''){
        $update_cus->category=$nhom_khach_hang;
    }
    customer_update($update_cus);
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
print_r($price_submit);
exit;
$booking_model->price_new = $price_submit;
$booking_model->price_tre_em_m1_new = $price_m1_submit;
$booking_model->price_tre_em_m2_new = $price_m2_submit;
$booking_model->price_tre_em_m3_new = $price_m3_submit;
$booking_model->ty_le_m1 = $tyle_m1;
$booking_model->ty_le_m2 = $tyle_m2;
$booking_model->ty_le_m3 = $tyle_m3;
$booking_model->loi_nhuan = $loi_nhuan;
$booking_model->loi_nhuan_m1 = $loi_nhuan_m1;
$booking_model->loi_nhuan_m2 = $loi_nhuan_m2;
$booking_model->loi_nhuan_m3 = $loi_nhuan_m3;

$booking_model->num_nguoi_lon = $num_nguoi_lon;
$booking_model->num_tre_em_m1 = $num_tre_em_m1;
$booking_model->num_tre_em_m2 = $num_tre_em_m2;
$booking_model->num_tre_em_m3 = $num_tre_em_m3;

$booking_model->name_price = $do_tuoi_nguoi_lon;
$booking_model->name_price_m1 = $do_tuoi_tre_em_m1;
$booking_model->name_price_m2 = $do_tuoi_tre_em_m2;
$booking_model->name_price_m3 = $do_tuoi_tre_em_m3;

// type tour
$confirm_tien_hoa_hong=0;
if ($type_tour == 1 || $type_tour == 0) {
    if ($type_tour == 1) {

        if ($name_tour_cus == '' || $chuong_trinh == '' || $thoi_gian == '') {
            echo '<script>alert("Bạn vui lòng nhập thông tin tour")</script>';
            echo 'window.location.href = "'.SITE_NAME.'/'.$action_link.'";';
        }
        // lưu lại thông tin tour theo yêu cầu khách hàng
        $tour_custom = new booking_tour_custom();
        $tour_custom->name = $name_tour_cus;
        $tour_custom->chuong_trinh = $chuong_trinh;
        $tour_custom->chuong_trinh_price = $chuong_trinh_price;
        $tour_custom->thoi_gian = $thoi_gian;
        $tour_custom->thoi_gian_price = $thoi_gian_price;
        $tour_custom->so_nguoi_price = $so_nguoi_price;
        $tour_custom->khach_san = $khach_san;
        $tour_custom->khach_san_price = $khach_san_price;
        $tour_custom->ngay_khoi_hanh_cus = date("Y-m-d", strtotime($ngay_khoi_hanh_cus));
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
        $booking_model->phuong_tien = $hang_bay;
        $booking_model->price_tour = $price_submit;
        $booking_model->price_tre_em_m1 = $price_m1_submit;
        $booking_model->price_tre_em_m2 = $price_m2_submit;
        $booking_model->price_tre_em_m3 = $price_m3_submit;
        $booking_model->tour_custom = 1;
        $confirm_tien_hoa_hong=1;
    } else {
        $check_data_tour = tour_getById($id_tour);
        if (count($check_data_tour) == 0) {
            $mess = "Tour " . $name_tour . 'không tồn tại trong hệ thống';
            echo "<script>alert($mess)</script>";
            exit;
        }
        $price_old = $check_data_tour[0]->price;
        $price_tiep_thi = $check_data_tour[0]->price_tiep_thi;
        if(($check_data_tour[0]->price_tiep_thi=='' || $check_data_tour[0]->price_tiep_thi<=0) && _returnPostParamSecurity('hoa_hong_thanh_vien')>0){
            $confirm_tien_hoa_hong=1;
        }
        if($check_data_tour[0]->price_tiep_thi>0 && $user_tiep_thi_id != ''){
            $booking_model->status_tiep_thi=1;
            $booking_model->confirm_admin_tiep_thi=$_SESSION['user_id'];
        }
        $booking_model->id_tour = $id_tour;
        $booking_model->name_tour = $check_data_tour[0]->name;
        $booking_model->code_tour = $check_data_tour[0]->code;
        if(!is_numeric($check_data_tour[0]->price)){
            $check_data_tour[0]->price=0;
        }
        if(!is_numeric($check_data_tour[0]->price_2)){
            $check_data_tour[0]->price_2=0;
        }
        if(!is_numeric($check_data_tour[0]->price_3)){
            $check_data_tour[0]->price_3=0;
        }
        if(!is_numeric($check_data_tour[0]->price_4)){
            $check_data_tour[0]->price_4=0;
        }
        $booking_model->price_tour = $check_data_tour[0]->price;
        $booking_model->price_tre_em_m1 = $check_data_tour[0]->price_2;
        $booking_model->price_tre_em_m2 = $check_data_tour[0]->price_3;
        $booking_model->price_tre_em_m3 = $check_data_tour[0]->price_4;
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
        if($check_data_tour[0]->name_price!='' && $do_tuoi_nguoi_lon==''){
            $booking_model->name_price = $check_data_tour[0]->name_price;
        }
        if($check_data_tour[0]->name_price_2!='' && $do_tuoi_tre_em_m1==''){
            $booking_model->name_price_m1 = $check_data_tour[0]->name_price_2;
        }
        if($check_data_tour[0]->name_price_3!='' && $do_tuoi_tre_em_m2==''){
            $booking_model->name_price_m2 = $check_data_tour[0]->name_price_3;
        }
        if($check_data_tour[0]->name_price_4!='' && $do_tuoi_tre_em_m3==''){
            $booking_model->name_price_m3 = $check_data_tour[0]->name_price_3;
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

$booking_model->thuong_hieu = $thuong_hieu;
$booking_model->ma_doan = $ma_doan;
$booking_model->cong_ty = $cong_ty;
$booking_model->nguon_tour = $nguon_tour;
$booking_model->link_bang_gia = $link_bang_gia;
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
$booking_model->total_price = round($total,2);
$booking_model->tien_thanh_toan = $dat_coc;
$booking_model->user_id = $id_user;
$booking_model->dieuhanh_id = $dieuhanh_id;
$booking_model->note = $note;
$booking_model->vat = $vat;

if($price_tiep_thi =='' || $price_tiep_thi<=0){
    $price_tiep_thi= _returnPostParamSecurity('hoa_hong_thanh_vien');
    if($price_tiep_thi==''){
        $price_tiep_thi=0;
    }
}


$booking_model->price_tiep_thi = $price_tiep_thi;
if ($user_tiep_thi_id != '') {
    $check_data_user_tt = user_getById($user_tiep_thi_id);
    if (count($check_data_user_tt) > 0 && $price_tiep_thi != '') {
        if(strpos($check_data_user_tt[0]->user_code,'az_sa')!=''){
            $booking_model = _returnHoaHongBooking($booking_model, $check_data_user_tt, $price_tiep_thi,1);
        }else{
            $booking_model = _returnHoaHongBooking($booking_model, $check_data_user_tt, $price_tiep_thi);
        }

        $booking_model->user_tiep_thi_id = $user_tiep_thi_id;
        $save_tiepthi = 1;
    }
}else{
    if($name_user_tiepthi!='' && $email_thanh_vien!='' && $phone_thanh_vien!='' ){
        $check_data_user_tt = user_getByTop('','user_email="'.$email_thanh_vien.'"','');
        if(count($check_data_user_tt)>0){

            if(strpos($check_data_user_tt[0]->user_code,'az_sa')>=0){
                $booking_model = _returnHoaHongBooking($booking_model, $check_data_user_tt, $price_tiep_thi,1);
            }else{
                $booking_model = _returnHoaHongBooking($booking_model, $check_data_user_tt, $price_tiep_thi);
            }
            $booking_model->user_tiep_thi_id = $check_data_user_tt[0]->id;
            $save_tiepthi = 1;
        }else{
            $create_user=new user();
            $create_user->name=$name_user_tiepthi;
            $create_user->user_email=$email_thanh_vien;
            $create_user->user_name=$email_thanh_vien;
            $create_user->phone=$phone_thanh_vien;
            $create_user->login_two_steps = 0;
            $create_user->user_role = 2;
            $create_user->user_code = _randomBooking('az_sa', 'user_count');
            user_insert($create_user);
            $check_data_user_tt = user_getByTop('','user_code="'.$create_user->user_code.'"',1);
            if(count($check_data_user_tt)>0){
                $booking_model = _returnHoaHongBooking($booking_model, $check_data_user_tt, $price_tiep_thi,1);
                $booking_model->user_tiep_thi_id = $check_data_user_tt[0]->id;
                $save_tiepthi = 1;
            }
        }
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

// gửi thông bác xác nhận tiền hoa hồng cho thành viên của sales
$send_noti_truong_phong=0;
if($confirm_tien_hoa_hong==1 && $price_tiep_thi>0 && count($check_data_user)>0){
    if($check_data_user[0]->truong_phong_id!=0){
        $booking_model->confirm_admin_tiep_thi=$check_data_user[0]->truong_phong_id;
        $send_noti_truong_phong=1;
    }
}
booking_insert($booking_model);
$data_booking = booking_getByTop('1', 'code_booking="' . $code_booking . '"', '');
if (count($data_booking) > 0) {
    $id_booking = $data_booking[0]->id;
}
// gửi thông bác xác nhận tiền hoa hồng cho thành viên của sales
if($send_noti_truong_phong==1){
        $name_noti='Yêu cầu xác nhận hoa hồng từ nhân viên "'.$check_data_user[0]->name.'"';
        $link_noti = SITE_NAME . '/' . $action_link . '/sua?noti=1&id=' . _return_mc_encrypt($id_booking, ENCRYPTION_KEY);
        _insertNotification($name_noti,$check_data_user[0]->id, $check_data_user[0]->truong_phong_id, $link_noti, 0, '');
}

// cập nhật danh sách đoàn
_updateCustomerBooking($name_customer_sub, $email_customer_sub, $phone_customer_sub, $address_customer_sub, $tuoi_customer_sub, $tuoi_number_customer_sub, $birthday_customer_sub, $passport_customer_sub, $date_passport_customer_sub, $id_booking, $_SESSION['user_id']);

// Danh sách bảng giá dịch vụ
_updateDanhSachBangGia($name_dichvu,$type_dichvu,$price_dichvu,$soluong_dichvu,$thanhtien_dichvu,$ghichu_dichvu, $id_booking);

// tiep thi lien ket
if (isset($save_tiepthi) && $save_tiepthi == 1 && $send_noti_truong_phong!=1) {
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
$message .= '<a>Bạn vui lòng truy cập <a href="' . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
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
    $message .= '<a>Bạn vui lòng truy cập <a href="' . $link_noti . '">đường link</a> để xác nhận đơn hàng</p>';
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