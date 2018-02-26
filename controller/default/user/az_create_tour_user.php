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
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$array_res = array(
    'success' => 0,
    'mess' => 'Bạn vui lòng kiểu tra thông tin tạo tour'
);
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['name_tour']) && isset($_POST['time_tour']) && isset($_POST['khoi_hanh_date']) && isset($_POST['khoi_hanh_address']) && isset($_POST['user_tiep_thi'])) {

    $name = _returnPostParamSecurity('name');
    $email = _returnPostParamSecurity('email');
    $phone = _returnPostParamSecurity('phone');
    $address = _returnPostParamSecurity('address');
    //tour
    $name_tour = _returnPostParamSecurity('name_tour');
    $time_tour = _returnPostParamSecurity('time_tour');
    $khoi_hanh_date = _returnPostParamSecurity('khoi_hanh_date');
    $khoi_hanh_address = _returnPostParamSecurity('khoi_hanh_address');
    $note = _returnPostParamSecurity('note');
    $user_tiep_thi = _return_mc_decrypt(_returnPostParamSecurity('user_tiep_thi'));

    $id_edit = _returnPostParamSecurity('id_edit');
    $data_user = user_getById($user_tiep_thi);
    if ($name != '' && $email != '' && $phone != '' && $name_tour != '' && $time_tour != '' && $khoi_hanh_date != '' && $khoi_hanh_address != '') {
        if (count($data_user) > 0) {
            // check customer
            $customer_id = 0;
            $dk_check_customer = "email ='" . $email . "'";
            $data_check_exist_cus = customer_getByTop(1, $dk_check_customer, 'id desc');
            if (count($data_check_exist_cus) > 0) {
                $customer_id = $data_check_exist_cus[0]->id;
                $customer = new customer((array)$data_check_exist_cus[0]);
                $customer->name = $name;
                $customer->email = $email;
                $customer->address = $address;
                $customer->phone = $phone;
                $customer->mobi = $phone;
                customer_update($customer);
            } else {
                $customer = new customer();
                $customer->name = $name;
                $customer->email = $email;
                $customer->address = $address;
                $customer->phone = $phone;
                $customer->mobi = $phone;
                $customer->created_by = $user_tiep_thi;
                $customer->code = _randomBooking('cus', 'customer_count');
                customer_insert($customer);
                $dk_check_customer = "code ='" . $customer->code . "'";
                $data_check_exist_cus = customer_getByTop(1, $dk_check_customer, 'id desc');
                if (count($data_check_exist_cus) > 0) {
                    $customer_id = $data_check_exist_cus[0]->id;
                }
            }
            $data_tour_create = tour_create_user_getById($id_edit);
            if ($id_edit > 0 && count($data_tour_create) > 0 && $data_tour_create[0]->status == 0) {
                $tour = new tour_create_user((array)$data_tour_create[0]);
                $tour->user_id = $user_tiep_thi;
                $tour->customer_id = $customer_id;
                $tour->name_cus = $name;
                $tour->email_cus = $email;
                $tour->address_cus = $address;
                $tour->phone_cus = $phone;
                $tour->name_tour = $name_tour;
                $tour->time_tour = $time_tour;
                $tour->date_tour = date("Y-m-d", strtotime($khoi_hanh_date));;
                $tour->address_tour = $khoi_hanh_address;
                $tour->note_tour = $note;
                tour_create_user_update($tour);
                $data_check_tour = tour_create_user_getById($id_edit);
                if (count($data_check_tour) > 0) {
                    $row = (array)$data_check_tour[0];
                    $array_res['danhsach']=returnHtmlGen($row);
                    $array_res['success'] = 1;
                    $array_res['mess'] = 'Cập nhật tour "' . $name_tour . '" thành công';
                }


            } else {
                // tour create
                $tour = new tour_create_user();
                $tour->user_id = $user_tiep_thi;
                $tour->customer_id = $customer_id;
                $tour->name_cus = $name;
                $tour->email_cus = $email;
                $tour->address_cus = $address;
                $tour->phone_cus = $phone;
                $tour->name_tour = $name_tour;
                $tour->time_tour = $time_tour;
                $tour->date_tour = $khoi_hanh_date;
                $tour->address_tour = $khoi_hanh_address;
                $tour->created = _returnGetDateTime();
                $tour->note_tour = $note;
                $tour->status = 0; //0: đang đợi xác nhận, 1: đã xác nhận, 2 đã hủy
                $tour->code_tour = _randomBooking('tour_us', 'tour_create_user_count');
                tour_create_user_insert($tour);
                $dk_check_tour = "code_tour ='" . $tour->code_tour . "'";
                $data_check_tour = tour_create_user_getByTop(1, $dk_check_tour, 'id desc');
                if (count($data_check_tour) > 0) {
                    $id_edit = $data_check_tour[0]->id;
                    $row = (array)$data_check_tour[0];
                    $array_res['danhsach']=returnHtmlGen($row);
                    // send noti

                    $name_noti = 'Thành viên  ' . $data_user[0]->name . ' đã tạo tour "' . $name_tour . '", bạn hãy xác nhận tour theo yêu cầu này';
                    $link_noti = '/tour-user/sua?noti=1&confirm=1&id=' . _return_mc_encrypt($id_edit, ENCRYPTION_KEY);
                    $data_list_user_admin = user_getByTop('', 'user_role=1 and status=1', 'id desc');
                    if (count($data_list_user_admin) > 0) {
                        foreach ($data_list_user_admin as $row_admin) {
                            _insertNotification($name_noti, 0, $row_admin->id, $link_noti, 0, '');
                        }
                    }

                    //send email to admin
//                $body='Thành viên  '.$data_user[0]->name.' đã tạo tour "'.$name_tour.'", bạn hãy  <a href="'.$link_noti.'">truy cập vào đây</a> xác nhận tour theo yêu cầu này';
//                $subject='Xác nhận yêu cầu tạo tour thừ thành viên tiếp thị liên kết';
//                if (SendMail('tungtv.soist@gmail.com', $body, $subject, 1,'Hệ thống tiếp thị liên kết Azbooking.vn', 'az')) {}
                    $array_res['success'] = 1;
                    $array_res['mess'] = 'Tạo tour <b>' . $name_tour . '</b> thành công, chúng tôi sẽ liên hệ với khách hàng và xác nhận tour trong thời gian sớm nhất';
                }

            }
        }
    }
}
echo json_encode($array_res);
function returnHtmlGen($row){
    switch ($row['status']) {
        case '1':
            $status = '<a class="btn btn-success">Đã xác nhận</a>';
            break;
        case '2':
            $status = '<a class="btn btn-danger">Đã hủy</a>';
            break;
        default:
            $status = '<a class="btn btn-danger">Đang đợi xác nhận</a>';
    }

    $lien_he = '';
    if ($row['name_cus'] != '') {
        $lien_he .= '<p rel="tooltip" data-original-title="Tên: ' . $row['name_cus'] . '">
                <i class="fa fa-user" ></i> ' . $row['name_cus'] . ' </p>';
    }
    if ($row['email_cus'] != '') {
        $lien_he .= '<p rel="tooltip" data-original-title="Email: ' . $row['email_cus'] . '">
                <i class="fa fa-envelope" ></i> ' . $row['email_cus'] . ' </p>';
    }
    if ($row['phone_cus'] != '') {
        $lien_he .= '<p rel="tooltip" data-original-title="Điện thoại: ' . $row['phone_cus'] . '"><i class="fa fa-phone" ></i> ' . $row['phone_cus'] . '</p>';
    }
    if ($row['address_cus'] != '') {
        $lien_he .= '<p rel="tooltip" data-original-title="Địa chỉ: ' . $row['address_cus'] . '"><i class="fa fa-map-marker" ></i> ' . $row['address_cus'] . '</p>';
    }
    $lien_he .= '<input hidden value="' . $row['email_cus'] . '" id="email_cus_hidden_' . $row['id'] . '">';
    $lien_he .= ' <input hidden value="' . $row['name_cus'] . '" id="name_cus_hidden_' . $row['id'] . '">';
    $lien_he .= ' <input hidden value="' . $row['phone_cus'] . '" id="phone_cus_hidden_' . $row['id'] . '">';
    $lien_he .= ' <input hidden value="' . $row['address_cus'] . '" id="address_cus_hidden_' . $row['id'] . '">';
    $lien_he.=' <input hidden value="'.$row['status'].'" id="status_update_hidden_'.$row['id'].'">';
    $tour = '';
    if ($row['name_tour'] != '') {
        $tour .= '<p rel="tooltip" data-original-title="Tour: ' . $row['name_tour'] . '"><i class="fa fa-plane" ></i> ' . $row['name_tour'] . '</p>';
    }
    if ($row['time_tour'] != '') {
        $tour .= '<p rel="tooltip" data-original-title="Thời gian: ' . $row['time_tour'] . '"><i class="fa fa-clock-o" ></i> ' . $row['time_tour'] . '</p>';
    }
    $date = '';
    if ($row['date_tour'] != '0000-00-00') {
        $date = date("d-m-Y", strtotime($row['date_tour']));
        $tour .= '<p rel="tooltip" data-original-title="Ngày khởi hành: ' . date("d-m-Y", strtotime($row['date_tour'])) . '"><i class="fa fa-calculator" ></i> ' . date("d-m-Y", strtotime($row['date_tour'])) . '</p>';
    }
    if ($row['address_tour'] != '') {
        $tour .= '<p rel="tooltip" data-original-title="Điểm khởi hành: ' . $row['address_tour'] . '"><i class="fa fa-map-marker" ></i> ' . $row['address_tour'] . '</p>';
    }
    $tour .= '<input hidden value="' . $row['name_tour'] . '" id="name_tour_hidden_' . $row['id'] . '">';
    $tour .= '<input hidden value="' . $row['time_tour'] . '" id="time_tour_hidden_' . $row['id'] . '">';
    $tour .= '<input hidden value="' . $row['address_tour'] . '" id="address_tour_hidden_' . $row['id'] . '">';
    $tour .= '<input hidden value="' . $date . '" id="date_tour_hidden_' . $row['id'] . '">';
    $tour .= '<input hidden value="' . $row['note_tour'] . '" id="note_tour_hidden_' . $row['id'] . '">';


    $danhsach = '<tr id="tr-tour-'.$row['id'].'">
            <td >#</td>
             <td class="lienhe_thanhvien">' . $tour . '</td>
            <td class="lienhe_thanhvien">' . $lien_he . '</td>
            <td>' . _returnDateFormatConvert($row['created']) . '</td>
            <td>' . $status . '</td>
            <td>
            <a data-name="' . $row['name_tour'] . '" data-id="' . $row['id'] . '" rel="tooltip" data-original-title="Xem chi tiết"  style="margin-right: 5px; padding: 10px 9px; background-color: #337ab7;border-color: #2e6da4;" class="btn btn-primary view-tour-user">
            <i data-name="' . $row['name_tour'] . '" data-id="' . $row['id'] . '" style="background:none" class="fa fa-eye"></i></a>
            <a rel="tooltip" data-original-title="Xóa" href="javascript:void(0)" class="btn btn-danger">
                <i style="background:none" class="fa fa-trash"></i>
            </a>
            </td>
              </tr>';
    return $danhsach;
}