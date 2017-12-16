<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_booking_themmoi($data = array())
{
    $asign = array();
    $tieude = $data['title'];
    $action = $data['action'];
    $valid_name_user = "";
    $valid_name_dieuhanh = "";
    $valid_id_user = "";
    $valid_id_dieuhanh = "";
    $id_dieuhanh = '';
    $name_user = '';
    $name_dieuhanh = '';
    $id_user = '';
    $table_user = '';
    $table_dieuhanh = '';
    $ngay_bat_dau = '';
    $han_thanh_toan = '';
    $ngay_khoi_hanh = '';
    $ngay_ket_thuc = '';
    $readonly_name_tour = '';
    $readonly_name_customer = '';
    $readonly_name_dieuhanh = '';
    $readonly_name_user_tt = '';
    $readonly_type_tour = '';
    $readonly_tour_custom = '';
    $show_tour_custom = 'hidden';
    $show_tour_system = 'hidden';
    $xac_nhan_dieu_hanh = '';
    $xac_nhan_sales = '';
    $booking_id = '';
    $confirm_dieuhanh = '';
    $confirm_sales = '';
    $ngay_bat_dau_valid = '';
    $han_thanh_toan_valid = '';
    $ngay_khoi_hanh_valid = '';
    $ngay_ket_thuc_valid = '';
    $email_customer_valid = '';
    $name_user_tt = '';
    $id_user_tt = '';
    $confirm_admin_tiep_thi = '';
    $confirm_admin_tiep_thi = '';
    $price_tiep_thi = '';
    $id_tour = '';
    $select_type_hethong = '';
    $select_type_custom = '';
    $valid_name_tour = '';
    $name_tour = '';
    $readonly_info_order='disabled';
    $table_tour = '';
    $price_new = '';
    $price_11_new = '';
    $price_5_new = '';
    $total = '';
    $total_format = '';
    $vat_format = '0 vnđ';
    $conlai_format = '';

    $chuong_trinh = '';
    $chuong_trinh_valid = '';
    $chuong_trinh_price = 0;
    $chuong_trinh_price_format = '0 vnđ';
    $thoi_gian = '';
    $thoi_gian_valid = '';
    $thoi_gian_price = 0;
    $thoi_gian_price_format = '0 vnđ';
    $nguoi_lon = 1;
    $tre_em = 0;
    $tre_em = 0;
    $so_nguoi_price = 0;
    $so_nguoi_price_format = '0 vnđ';
    $khach_san = '';
    $khach_san_price = 0;
    $khach_san_price_format = '0 vnđ';
    $ngay_khoi_hanh_cus = '';
    $ngay_khoi_hanh_cus_valid = '';
    $ngay_khoi_hanh_price = 0;
    $ngay_khoi_hanh_price_format = '0 vnđ';
    $hang_bay = '';
    $hang_bay_price = 0;
    $hang_bay_price_format = '0 vnđ';
    $khac = '';
    $khac_price = 0;
    $khac_price_format = '0 vnđ';
    $note_cus = '';
    $show_update_dieuhanh = '';
    $show_update_sales='';
    if ($action == 2) {
        if ($_SESSION['user_role'] != 1) {
            $readonly_name_tour = 'disabled';
        }
        $action_name = 'edit';
        $readonly = "readonly";
        $hidden = "hidden";
        $valid_pass = "valid";
        $show_phone = "";
        $disabled = 'disabled';
        $data_sales = user_getById($data['data_user'][0]->user_id);
        if (count($data_sales) > 0) {
            if ($data_sales[0]->name != '') {
                $valid_name_user = 'valid';
                $name_user = $data_sales[0]->name;
            }
            $phong_ban = '';
            $number_tour = 0;
            $data_phongban = user_phongban_getByTop('', 'id=' . $data_sales[0]->phong_ban, '');
            $number_tour = booking_count('user_id=' . $data_sales[0]->id . ' and status!=5');
            if (count($data_phongban) > 0) {
                $phong_ban = $data_phongban[0]->name;
            }
            $id_user = $data_sales[0]->id;
            $valid_id_user = "valid";
            $table_user = '<tr> <td class="center">1</td><td><a>' . $name_user . '</a></td><td><span>' . $data_sales[0]->user_email . '</span></td> <td><span>' . $data_sales[0]->phone . '</span></td><td><span>' . $phong_ban . '</span></td><td>' . $number_tour . '</td></tr>';
        }
        $data_dieuhanh = user_getById($data['data_user'][0]->dieuhanh_id);
        if (count($data_dieuhanh) > 0) {
            if ($data_dieuhanh[0]->name != '') {
                $valid_name_dieuhanh = 'valid';
                $name_dieuhanh = $data_dieuhanh[0]->name;
            }
            $phong_ban = '';
            $number_tour = 0;
            $data_phongban = user_phongban_getByTop('', 'id=' . $data_dieuhanh[0]->phong_ban, '');
            $number_tour = booking_count('dieuhanh_id=' . $data_dieuhanh[0]->id . ' and status!=5');
            if (count($data_phongban) > 0) {
                $phong_ban = $data_phongban[0]->name;
            }
            $id_dieuhanh = $data_dieuhanh[0]->id;
            $valid_id_dieuhanh = "valid";
            $table_dieuhanh = '<tr> <td class="center">1</td><td><a>' . $data_dieuhanh[0]->name . '</a></td><td><span>' . $data_dieuhanh[0]->user_email . '</span></td> <td><span>' . $data_dieuhanh[0]->phone . '</span></td><td><span>' . $phong_ban . '</span></td><td>' . $number_tour . '</td></tr>';
        }

        $Random = _returnDataEditAdd($data['data_user'], 'code_booking');
        $ngay_bat_dau = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'ngay_bat_dau')));
        if ($ngay_bat_dau != '') {
            $ngay_bat_dau_valid = 'valid';
        }
        $han_thanh_toan = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'han_thanh_toan')));
        if ($han_thanh_toan != '') {
            $han_thanh_toan_valid = 'valid';
        }
        $ngay_khoi_hanh = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'ngay_khoi_hanh')));
        if ($ngay_khoi_hanh != '') {
            $ngay_khoi_hanh_valid = 'valid';
        }
        $ngay_ket_thuc = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'ngay_ket_thuc')));
        if ($ngay_ket_thuc != '') {
            $ngay_ket_thuc_valid = 'valid';
        }

// data user tiepthi

        $data_sales_tt = user_getById($data['data_user'][0]->user_tiep_thi_id);
        if (count($data_sales_tt) > 0) {
            $name_user_tt = $data_sales_tt[0]->user_code;
            $id_user_tt = $data_sales_tt[0]->id;
        }
        $price_tiep_thi = _returnDataEditAdd($data['data_user'], 'price_tiep_thi');
        if (is_numeric($price_tiep_thi) && $price_tiep_thi > 0) {
            $price_tiep_thi = "<b class='red'>" . number_format((int)$price_tiep_thi, 0, ",", ".") . ' vnđ </b>';
        }
        $confirm_tiep_thi = _returnDataEditAdd($data['data_user'], 'confirm_admin_tiep_thi');

        if ($confirm_tiep_thi == 1) {
            $confirm_admin_tiep_thi = 'checked';
        }

        //
        $confirm_admin = _returnDataEditAdd($data['data_user'], 'confirm_admin');
        $dieuhanh_id = _returnDataEditAdd($data['data_user'], 'dieuhanh_id');

        if ($_SESSION['user_role'] == 1) {
            $readonly_name_user_tt = '';
            $readonly_name_customer = '';
            $readonly_name_dieuhanh = '';
            $readonly_type_tour = '';
        } else {
            $readonly_name_customer = 'disabled';
            $readonly_name_user_tt = 'disabled';
            if ($dieuhanh_id == $_SESSION['user_id']) {
                $readonly_name_dieuhanh = 'disabled';
            }
            $readonly_type_tour = 'disabled';
        }
        $confirm_dieuhanh = _returnDataEditAdd($data['data_user'], 'confirm_dieuhanh');
        if ($confirm_dieuhanh == 1) {
            if ($_SESSION['user_role'] != 1) {
                $readonly_name_dieuhanh = 'disabled';
            }
            $readonly_tour_custom = 'disabled';
            $confirm_dieuhanh = '<button class="btn btn-sm btn-success green">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã xác nhận</span>
                                    </button>';
        } else {
            if ($_SESSION['user_role'] != 1) {
                if ($data['data_user'][0]->created_by == $data['data_user'][0]->user_id &&$data['data_user'][0]->user_id==$_SESSION['user_id'] && $confirm_dieuhanh == 2) {
                    $readonly_name_dieuhanh = '';
                } else {
                    $readonly_name_dieuhanh = 'disabled';
                }

            }
            if ($confirm_dieuhanh == 2) {

                $confirm_dieuhanh = '  <button filed="confirm_dieuhanh" class="btn btn-sm btn-danger confirm_booking">
                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã hủy</span>
                                    </button> ';
            } else {
                $confirm_dieuhanh = '  <button filed="confirm_dieuhanh" class="btn btn-sm btn-warning confirm_booking">
                                        <i class="ace-icon fa fa-exclamation-triangle bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đang đợi xác nhận</span>
                                    </button>>
                                    ';
            }

            if ($data['data_user'][0]->dieuhanh_id == $_SESSION['user_id']) {
                $show_update_dieuhanh = '
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Xác nhận</div>
                                            <div class="profile-info-value form-group">
                                                <label><input
                                                                            id="input_confirm_dieuhanh"
                                                                            name="confirm_dieuhanh"
                                                                            class="ace ace-switch ace-switch-6"
                                                                            type="checkbox">
                                                                        <span class="lbl"></span>
                                                                    </label>
                                            </div>
                                        </div>
';
            }
        }
        $confirm_sales = _returnDataEditAdd($data['data_user'], 'confirm_sales');
        if ($confirm_sales == 1) {
            $confirm_sales = '<button class="btn btn-sm btn-success green">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã xác nhận</span>
                                    </button>';
        } else {
            if($confirm_sales==2){
                $confirm_sales = ' <button filed="confirm_dieuhanh" class="btn btn-sm btn-danger confirm_booking">
                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã hủy</span>
                                    </button> ';
            }else{
                $confirm_sales = '  <button filed="confirm_dieuhanh" class="btn btn-sm btn-warning confirm_booking">
                                        <i class="ace-icon fa fa-exclamation-triangle bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đang đợi xác nhận</span>
                                    </button>';
            }
            if ($data['data_user'][0]->user_id == $_SESSION['user_id']) {
                $show_update_sales = '
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Xác nhận</div>
                                            <div class="profile-info-value form-group">
                                                <label><input
                                                                            id="input_confirm_dieuhanh"
                                                                            name="confirm_dieuhanh"
                                                                            class="ace ace-switch ace-switch-6"
                                                                            type="checkbox">
                                                                        <span class="lbl"></span>
                                                                    </label>
                                            </div>
                                        </div>
';
            }
        }
        $tour_custom = _returnDataEditAdd($data['data_user'], 'tour_custom');
        if ($tour_custom == 1) {
            $select_type_custom = 'selected="selected"';
            $show_tour_custom = '';
            $show_tour_system = 'hidden';

            // thông tin tour custom
            $data_tour = booking_tour_custom_getById(_returnDataEditAdd($data['data_user'], 'id_tour'));
            if (count($data_tour) > 0) {
                $chuong_trinh = _returnDataEditAdd($data_tour, 'chuong_trinh');
                if ($chuong_trinh != '') {
                    $chuong_trinh_valid = 'valid';
                }
                $chuong_trinh_price = _returnDataEditAdd($data_tour, 'chuong_trinh_price');
                if (is_numeric($chuong_trinh_price) && $chuong_trinh_price > 0) {
                    $chuong_trinh_price_format = number_format((int)$chuong_trinh_price, 0, ",", ".") . ' vnđ';
                }
                $thoi_gian = _returnDataEditAdd($data_tour, 'thoi_gian');
                if ($thoi_gian != '') {
                    $thoi_gian_valid = 'valid';
                }
                $thoi_gian_price = _returnDataEditAdd($data_tour, 'thoi_gian_price');
                if (is_numeric($thoi_gian_price) && $thoi_gian_price > 0) {
                    $thoi_gian_price_format = number_format((int)$thoi_gian_price, 0, ",", ".") . ' vnđ';
                }
                $nguoi_lon = _returnDataEditAdd($data_tour, 'nguoi_lon');
                $tre_em = _returnDataEditAdd($data_tour, 'tre_em');
                $tre_em_5 = _returnDataEditAdd($data_tour, 'tre_em_5');
                $so_nguoi_price = _returnDataEditAdd($data_tour, 'so_nguoi_price');
                if (is_numeric($so_nguoi_price) && $so_nguoi_price > 0) {
                    $so_nguoi_price_format = number_format((int)$so_nguoi_price, 0, ",", ".") . ' vnđ';
                }
                $khach_san = _returnDataEditAdd($data_tour, 'khach_san');
                $khach_san_price = _returnDataEditAdd($data_tour, 'khach_san_price');
                if (is_numeric($khach_san_price) && $khach_san_price > 0) {
                    $khach_san_price_format = number_format((int)$khach_san_price, 0, ",", ".") . ' vnđ';
                }
                $ngay_khoi_hanh_cus = date("d-m-Y", strtotime(_returnDataEditAdd($data_tour, 'ngay_khoi_hanh_cus')));
                if ($ngay_khoi_hanh_cus != '') {
                    $ngay_khoi_hanh_cus_valid = 'valid';
                }
                $ngay_khoi_hanh_price = _returnDataEditAdd($data_tour, 'ngay_khoi_hanh_price');
                if (is_numeric($ngay_khoi_hanh_price) && $ngay_khoi_hanh_price > 0) {
                    $ngay_khoi_hanh_price_format = number_format((int)$ngay_khoi_hanh_price, 0, ",", ".") . ' vnđ';
                }
                $hang_bay = _returnDataEditAdd($data_tour, 'hang_bay');
                $hang_bay_price = _returnDataEditAdd($data_tour, 'hang_bay_price');
                if (is_numeric($hang_bay_price) && $hang_bay_price > 0) {
                    $hang_bay_price_format = number_format((int)$hang_bay_price, 0, ",", ".") . ' vnđ';
                }
                $khac = _returnDataEditAdd($data_tour, 'khac');
                $khac_price = _returnDataEditAdd($data_tour, 'khac_price');
                if (is_numeric($khac_price) && $khac_price > 0) {
                    $khac_price_format = number_format((int)$khac_price, 0, ",", ".") . ' vnđ';
                }
                $note_cus = _returnDataEditAdd($data_tour, 'note');
            }
        } else {
            $select_type_hethong = 'selected="selected"';
            $show_tour_system = '';
            $show_tour_custom = 'hidden';
            $data_tour = tour_getById(_returnDataEditAdd($data['data_user'], 'id_tour'));
            if (count($data_tour) > 0) {
                if ($data_tour[0]->name != '') {
                    $id_tour = $data_tour[0]->id;
                }
                $data_departure = departure_getById($data_tour[0]->departure);
                if (count($data_departure) > 0) {
                    $departure_name = $data_departure[0]->name;
                }
                $so_cho = $data_tour[0]->so_cho;
            }
        }
        if ($data['data_user'][0]->user_id == $_SESSION['user_id']) {
            $readonly_info_order='';
        }

        if($_SESSION['user_role']==1){
            $readonly_tour_custom='';
            $readonly_info_order='';
        }

    } else {
        $action_name = 'add';
        $readonly = "readonly";
        $hidden = "";
        $valid_pass = "";
        $show_phone = "hidden";
        $disabled = '';
        $readonly_info_order='';
        $readonly_tour_custom='';
        $Random = _randomBooking('#', 'booking_count');
    }

    $num_nguoi_lon = _returnDataEditAdd($data['data_user'], 'num_nguoi_lon');
    if (!$num_nguoi_lon) {
        $num_nguoi_lon = 1;
    }
    $num_tre_em = _returnDataEditAdd($data['data_user'], 'num_tre_em');
    $num_tre_em_5 = _returnDataEditAdd($data['data_user'], 'num_tre_em_5');
    $note = _returnDataEditAdd($data['data_user'], 'note');
    $diem_don = _returnDataEditAdd($data['data_user'], 'diem_don');
    $diem_don_customer_valid = '';
    if ($diem_don != '') {
        $diem_don_customer_valid = 'valid';
    }
    $id_customer = _returnDataEditAdd($data['data_user'], 'id_customer');
    $data_customer = customer_getById($id_customer);
    $valid_name_customer = '';
    $name_customer = '';
    $id_customer = '';
    $email_customer = '';
    $phone_customer = '';
    $address_customer = '';
    $fax_customer = '';
    $nhom_kh = '';

    $phone_customer_valid = '';
    $address_customer_valid = '';
    if (count($data_customer) > 0) {
        if ($data_customer[0]->name != '') {
            $valid_name_customer = 'valid';
            $name_customer = $data_customer[0]->name;
            $id_customer = $data_customer[0]->id;
            $email_customer = $data_customer[0]->email;
            if ($email_customer != '') {
                $email_customer_valid = 'valid';
            }
            $phone_customer = $data_customer[0]->phone;
            if ($phone_customer != '') {
                $phone_customer_valid = 'valid';
            }
            $address_customer = $data_customer[0]->address;
            if ($address_customer != '') {
                $address_customer_valid = 'valid';
            }
            $fax_customer = $data_customer[0]->fax;
            $nhom_kh = $data_customer[0]->category;
        }
    }
    $vat = _returnDataEditAdd($data['data_user'], 'vat');
    $checked_vat = '';
    if ($vat == 1) {
        $checked_vat = 'checked';
    }


    $dat_coc = _returnDataEditAdd($data['data_user'], 'tien_thanh_toan');
    $dat_coc_format = '';
    if (is_numeric($dat_coc) && $dat_coc > 0) {
        $dat_coc_format = number_format((int)$dat_coc, 0, ",", ".") . ' vnđ';
    }

    $show_add_tour = '';
    $so_cho = '';
    $departure_name = '';

    $price_new = _returnDataEditAdd($data['data_user'], 'price_new');
    $name_tour = _returnDataEditAdd($data['data_user'], 'name_tour');
    if ($name_tour != '') {
        $valid_name_tour = 'valid';
    }
    $id_tour = _returnDataEditAdd($data['data_user'], 'id_tour');
    $price_new_format = number_format((int)$price_new, 0, ",", ".") . ' vnđ';
    $price_11_new = _returnDataEditAdd($data['data_user'], 'price_11_new');
    $price_11_new_format = number_format((int)$price_11_new, 0, ",", ".") . ' vnđ';
    $price_5_new = _returnDataEditAdd($data['data_user'], 'price_5_new');
    $price_5_new_format = number_format((int)$price_5_new, 0, ",", ".") . ' vnđ';

    $table_tour = '<tr> <td class="center">1</td><td><a id="name_tour_table">' . $so_cho . '</a></td>
        <td><span id="price_format_span">' . $price_new_format . '</span>';

    if ($price_new == '') {
        $price_new = 0;
    }
    if ($price_11_new == '') {
        $price_11_new = 0;
    }
    if ($price_5_new == '') {
        $price_5_new = 0;
    }
    $table_tour .= '<input hidden="" id="input_price_format" value="' . $price_new_format . '">
        <input hidden="" title="giá sửa" id="input_price" value="' . $price_new . '">
        <input hidden="" id="input_price_old" title="giá cũ" value="' . $price_new . '"> ';
    if ($_SESSION['user_role'] == 1 || $confirm_admin == 0) {
        $table_tour .= '| <a id="edit_price" href="javascript:void(0)"><i class="fa fa-edit" title="Sửa đơn giá"></i></a>
        <a id="reset_price" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
    } else {
        $show_add_tour = 'hidden';
    }

    $table_tour .= '</td>
        <td><span id="price_format_span_511">' . $price_11_new_format . '</span>';

    $table_tour .= '<input hidden="" title="giá sửa" id="input_price_511" value="' . $price_11_new . '"> <input hidden="" id="input_price_511_old" title="giá cũ" value="' . $price_11_new . '">';
    if ($_SESSION['user_role'] == 1 || $confirm_admin == 0) {
        $table_tour .= '| <a id="edit_price_511" href="javascript:void(0)">
        <i class="fa fa-edit" title="Sửa đơn giá"></i></a>
        <a id="reset_price_511" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
    }
    $table_tour .= '</td>
        <td><span id="price_format_span_5">' . $price_5_new_format . '</span>';

    $table_tour .= '<input hidden="" title="giá sửa" id="input_price_5" value="' . $price_5_new . '"> <input hidden="" id="input_price_5_old" title="giá cũ" value="' . $price_5_new . '"> ';
    if ($_SESSION['user_role'] == 1 || $confirm_admin == 0) {
        $table_tour .= '| <a id="edit_price_5" href="javascript:void(0)">
        <i class="fa fa-edit" title="Sửa đơn giá"></i></a><a id="reset_price_5" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
    }
    $table_tour .= '</td>
        <td>' . $departure_name . '</td> <td style="color:red">' . $so_cho . '</td></tr>';

    $total = 0;
    if (is_numeric($num_nguoi_lon) && is_numeric($price_new)) {
        $total = $total + ($num_nguoi_lon * $price_new);
    }
    if (is_numeric($num_tre_em) && is_numeric($price_11_new)) {
        $total = $total + ($num_tre_em * $price_11_new);
    }
    if (is_numeric($num_tre_em_5) && is_numeric($price_5_new)) {
        $total = $total + ($num_tre_em_5 * $price_5_new);
    }
    $total_format = number_format((int)$total, 0, ",", ".") . ' vnđ';
    if ($vat == 1) {
        $vat_price = ($total * 0.1);
        $vat_format = number_format((int)$vat_price, 0, ",", ".") . ' vnđ';
        $total = $total + $vat_price;
    }
    if (is_numeric($dat_coc) && $dat_coc > 0) {
        $total = $total - $dat_coc;
    }
    $conlai_format = number_format((int)$total, 0, ",", ".") . ' vnđ';

    $booking_id = _returnDataEditAdd($data['data_user'], 'id');
    $string_cus_tommer = '';
    $data_sub_khach_hang = customer_booking_getByTop('', 'booking_id=' . $booking_id, 'id asc');
    if (count($data_sub_khach_hang) > 0) {
        $count_stt_cus = 1;
        foreach ($data_sub_khach_hang as $row_sub_cus) {
//            $string_cus_tommer.='<tbody id="row_customer_'.$count_stt_cus.'"><tr>
//                                <td class="center stt_cus">'.$count_stt_cus.'</td>
//                                <td> <span class="input-icon width_100">
//                                <input id="input_name_customer_sub_'.$count_stt_cus.'" class="valid" type="text" name="name_customer_sub[]" value="'.$row_sub_cus->name.'">
//                                <i class="ace-icon fa fa-user blue"></i></span></td>
//                                <td><span class="input-icon width_100">
//                                <input id="input_email_customer_'.$count_stt_cus.'" type="text" class="valid" name="email_customer[]" value="'.$row_sub_cus->email.'">
//                                <i class="ace-icon fa fa-envelope blue"></i> </span></td>
//                                <td><span class="input-icon width_100">
//                                <input id="input_phone_customer_'.$count_stt_cus.'" class="valid" type="text" name="phone_customer[]" value="'.$row_sub_cus->phone.'">
//                                <i class="ace-icon fa fa-phone blue"></i></span></td>
//                                <td><span class="input-icon width_100">
//                                <input id="input_address_customer_'.$count_stt_cus.'" type="text" name="address_customer[]" value="'.$row_sub_cus->address.'">
//                                <i class="ace-icon fa fa-map-marker blue"></i></span></td>
//                                <td><a id="stt_custommer_'.$count_stt_cus.'" deleteid="'.$count_stt_cus.'" title="Xóa khách hàng" class="red btn_remove_customer" href="javascript:void()">
//                                <i class="ace-icon fa fa-trash-o bigger-130"></i></a></td></tr></tbody>';
            $price_item = '';
            if ($row_sub_cus->do_tuoi_number == 1) {
                $price_item = $price_new_format;
            } else {
                if ($row_sub_cus->do_tuoi_number == 2) {
                    $price_item = $price_11_new_format;
                } else {
                    if ($row_sub_cus->do_tuoi_number == 3) {
                        $price_item = $price_5_new_format;
                    }
                }
            }


            $string_cus_tommer .= '<tr  class="row_customer_' . $count_stt_cus . '">
                                    <td class="center stt_cus">' . $count_stt_cus . '</td>
                                    <td>
                                        <input style="height: 30px" name="name_customer_sub[]" value="' . $row_sub_cus->name . '"
                                               id="input_name_customer_sub_' . $count_stt_cus . '" type="text"
                                               class="valid input_table">
                                    </td>
                                    <td>
                                        <input style="padding-top: 0px;height: 30px" class="  valid" id="input_birthday_customer_sub_' . $count_stt_cus . '"
                                               name="birthday_customer[]" required="" type="date" value="' . $row_sub_cus->birthday . '">
                                    </td>
                                    <td>
                                        <input style="height: 30px" name="email_customer[]"
                                               id="input_email_customer_' . $count_stt_cus . '" type="text" value="' . $row_sub_cus->email . '"
                                               class="valid input_table">
                                    </td>
                                    <td>
                                        <input style="height: 30px" name="phone_customer[]" value="' . $row_sub_cus->phone . '"
                                               id="input_phone_customer_' . $count_stt_cus . '" type="text"
                                               class="valid input_table">
                                    </td>
                                    <td>
                                        <input style="height: 30px" name="address_customer[]" value="' . $row_sub_cus->address . '"
                                               id="input_address_customer_' . $count_stt_cus . '" type="text"
                                               class="valid input_table">
                                    </td>
                                    <td>
                                        <input hidden style="height: 30px" name="tuoi_number_customer[]" value="' . $row_sub_cus->do_tuoi_number . '"
                                               id="input_tuoi_number_customer_' . $count_stt_cus . '" type="text" class="valid input_table">
                                        <input  style="height: 30px" name="tuoi_customer[]" value="' . $row_sub_cus->do_tuoi . '"
                                               id="input_tuoi_customer_' . $count_stt_cus . '" type="text" class="valid input_table">
                                    </td>
                                    <td>
                                        <input style="height: 30px" name="passport_customer[]" value="' . $row_sub_cus->passport . '"
                                               id="input_passport_customer_' . $count_stt_cus . '" type="text"
                                               class="valid input_table">
                                    </td>

                                    <td>
                                        <input style="padding-top: 0px;height: 30px" value="" class=" valid" id="input_date_passport_customer_' . $count_stt_cus . '"
                                               name="date_passport_customer[]" required="" type="date" value="' . $row_sub_cus->date_passport . '"
                                             >
                                    </td>
                                    <td style="width: 130px">
                                        <span style="color: red; font-size: 12px">' . $price_item . '</span>
                                    </td>
                                </tr>';

            $count_stt_cus++;
        }
    }


    $tien_te = _returnDataEditAdd($data['data_user'], 'tien_te');
    $data_tien_te = tien_te_getById($tien_te);
    $tien_te_name = '';
    if (count($data_tien_te) > 0) {
        $tien_te_name = $data_tien_te[0]->name;
    }
    $data_list_tien_tee = tien_te_getByTop('', '', 'position asc');

    $hinh_thuc_thanh_toan = _returnDataEditAdd($data['data_user'], 'hinh_thuc_thanh_toan');
    $data_httt = httt_getById($hinh_thuc_thanh_toan);
    $httt_name = '';
    if (count($data_httt) > 0) {
        $httt_name = $data_httt[0]->name;
    }
    $data_list_httt = httt_getByTop('', '', 'position asc');

    $status = _returnDataEditAdd($data['data_user'], 'status');
    $data_status = trang_thai_don_hang_getById($status);
    $status_name = '';
    if (count($data_status) > 0) {
        $status_name = $data_status[0]->name;
    }
    $data_list_status = trang_thai_don_hang_getByTop('', '', 'position asc');
    $data_list_customer_category = customer_category_getByTop('', '', 'position asc');


    $nguon_tour = _returnDataEditAdd($data['data_user'], 'nguon_tour');
    $data_nguon_tour = tien_te_getById($nguon_tour);
    $nguon_tour_name = '';
    if (count($data_nguon_tour) > 0) {
        $nguon_tour_name = $data_nguon_tour[0]->name;
    }
    $data_list_nguon_tour = nguon_tour_getByTop('', '', 'position asc');
    $confirm_admin_tring = '';
    if ($action == 2) {
        if ($confirm_admin == 0) {
            if ($_SESSION['user_role'] == 1) {
                $confirm_admin_tring = ' <a href="javascript:void(0)" code="' . $Random . '" count_id="' . _return_mc_encrypt($booking_id, ENCRYPTION_KEY) . '" class="btn btn-xs btn-danger" id="confirm_order" type="button">
                    <i class="ace-icon fa fa-check"></i>
                    Xác nhận đơn hàng
                </a>';
            }
        }
    }

    $user_current = $_SESSION['user_id'];
    require_once DIR . '/view/default/template/module/booking/themmoi.php';
}

