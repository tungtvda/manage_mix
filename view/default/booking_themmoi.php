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
    // danh sách danh mục dịch vụ
    $data_danhmuc_dichvu=danhmuc_dichvu_getByTop('','','position asc');
    $list_danhmuc_dichvu='';
    if($data_danhmuc_dichvu){
        foreach($data_danhmuc_dichvu as $row_dm){
            $list_danhmuc_dichvu .='<option value="'.$row_dm->id.'">'.$row_dm->name.'</option>';
        }
    }
    $code_booking='';
    $id_booking='';
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
    $readonly_name_user = '';
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
    $code_user_tt = '';
    $id_user_tt = '';
    $name_user_tt = '';
    $email_user_tt = '';
    $phone_user_tt = '';
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
    $price_tre_em_m1_new = '';
    $price_tre_em_m2_new = '';
    $price_tre_em_m3_new = '';
    $total = '';
    $total_format = '';
    $vat_format = '0 vnđ';
    $conlai_format = '';
    $do_tuoi_nguoi_lon='';
    $do_tuoi_tre_em_m1='';
    $do_tuoi_tre_em_m2='';
    $do_tuoi_tre_em_m3='';

    $do_tuoi_tre_em_m1='';
    $do_tuoi_tre_em_m2='';
    $do_tuoi_tre_em_m3='';

    $name_price_nguoi_lon='Đơn giá người lớn';
    $name_price_tre_em_m1='Đơn giá trẻ em mức 1';
    $name_price_tre_em_m2='Đơn giá trẻ em mức 2';
    $name_price_tre_em_m3='Đơn giá trẻ em mức 3';

    $total_dicvu_format='0 vnđ';
    $total_khach='1';
    $don_gia_net='0 vnđ';
    $loi_nhuan='0';
    $gia_ban='0 vnđ';

    $tyle_m1='0';
    $total_khach_m1='0';
    $don_gia_net_m1='0 vnđ';
    $loi_nhuan_m1='0';
    $gia_ban_m1='0 vnđ';

    $tyle_m2='0';
    $total_khach_m2='0';
    $don_gia_net_m2='0 vnđ';
    $loi_nhuan_m2='0';
    $gia_ban_m2='0 vnđ';

    $tyle_m3='0';
    $total_khach_m3='0';
    $don_gia_net_m3='0 vnđ';
    $loi_nhuan_m3='0';
    $gia_ban_m3='0 vnđ';

    $loi_nhuan_format='';
    $loi_nhuan_m1_format='';
    $loi_nhuan_m2_format='';
    $loi_nhuan_m3_format='';

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
    $tre_em_5 = 0;
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
    $hidden_don_gia_dichvu='hidden';
    $hoa_hong_thanh_vien='';
    $hoa_hong_thanh_vien_format='';
    $link_bang_gia='';
    $btn_link_bang_gia='';
    $list_dich_vu='';
    $num_nguoi_lon = _returnDataEditAdd($data['data_user'], 'num_nguoi_lon');
    if (!$num_nguoi_lon) {
        $num_nguoi_lon = 1;
    }
    $num_tre_em_m1= _returnDataEditAdd($data['data_user'], 'num_tre_em_m1');
    if (!$num_tre_em_m1) {
        $num_tre_em_m1 = 0;
    }
    $num_tre_em_m2= _returnDataEditAdd($data['data_user'], 'num_tre_em_m2');
    if (!$num_tre_em_m2) {
        $num_tre_em_m2 = 0;
    }
    $num_tre_em_m3= _returnDataEditAdd($data['data_user'], 'num_tre_em_m3');
    if (!$num_tre_em_m3) {
        $num_tre_em_m3 = 0;
    }
    $hoa_hong_thanh_vien= _returnDataEditAdd($data['data_user'], 'price_tiep_thi_thuc_te');
    if (!$hoa_hong_thanh_vien) {
        $hoa_hong_thanh_vien = 0;
    }else{
        $hoa_hong_thanh_vien_format = "<b class='red'>" . number_format((float)$hoa_hong_thanh_vien, 0, ",", ".") . ' vnđ </b>';
    }
    $link_bang_gia= _returnDataEditAdd($data['data_user'], 'link_bang_gia');
    if ($link_bang_gia!='') {
        $btn_link_bang_gia='<a title="Xem chi tiết link bảng giá" target="_blank" class="btn btn-success" style="padding: 2px 10px;" href="'.$link_bang_gia.'"><i class="fa fa-link"></i></a>';
    }
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
        $code_booking=_returnDataEditAdd($data['data_user'], 'code_booking');
        $id_booking=_returnDataEditAdd($data['data_user'], 'id');
        $Random = _returnDataEditAdd($data['data_user'], 'code_booking');
        if(_returnDataEditAdd($data['data_user'], 'ngay_bat_dau')!='0000-00-00'){
            $ngay_bat_dau = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'ngay_bat_dau')));
        }

        if ($ngay_bat_dau != '') {
            $ngay_bat_dau_valid = 'valid';
        }
        if(_returnDataEditAdd($data['data_user'], 'han_thanh_toan')!='0000-00-00'){
            $han_thanh_toan = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'han_thanh_toan')));
        }
        if ($han_thanh_toan != '') {
            $han_thanh_toan_valid = 'valid';
        }
        if(_returnDataEditAdd($data['data_user'], 'ngay_khoi_hanh')!='0000-00-00'){
            $ngay_khoi_hanh = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'ngay_khoi_hanh')));
        }
        if ($ngay_khoi_hanh != '') {
            $ngay_khoi_hanh_valid = 'valid';
        }
        if(_returnDataEditAdd($data['data_user'], 'ngay_ket_thuc')!='0000-00-00'){
            $ngay_ket_thuc = date("d-m-Y", strtotime(_returnDataEditAdd($data['data_user'], 'ngay_ket_thuc')));
        }
        if ($ngay_ket_thuc != '') {
            $ngay_ket_thuc_valid = 'valid';
        }

// data user tiepthi

        $data_sales_tt = user_getById($data['data_user'][0]->user_tiep_thi_id);
        if (count($data_sales_tt) > 0) {
            $code_user_tt = $data_sales_tt[0]->user_code;
            $id_user_tt = $data_sales_tt[0]->id;
            $name_user_tt = $data_sales_tt[0]->name;
            $email_user_tt = $data_sales_tt[0]->user_email;
            $phone_user_tt =  $data_sales_tt[0]->phone;;
        }
        $price_tiep_thi = _returnDataEditAdd($data['data_user'], 'price_tiep_thi');
        if (is_numeric($price_tiep_thi) && $price_tiep_thi > 0) {
            $price_tiep_thi = "<b class='red'>" . number_format((float)$price_tiep_thi, 0, ",", ".") . ' vnđ </b>';
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

                $confirm_dieuhanh = '  <a filed="confirm_dieuhanh" class="btn btn-sm btn-danger confirm_booking">
                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã hủy</span>
                                    </a> ';
            } else {
                $text_dieu_hanh='Đang đợi xác nhận';
                if($data['data_user'][0]->dieuhanh_id==0){
                    $text_dieu_hanh='Chưa chọn điều hành';
                }
                $confirm_dieuhanh = '  <a filed="confirm_dieuhanh" class="btn btn-sm btn-warning confirm_booking">
                                        <i class="ace-icon fa fa-exclamation-triangle bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">'.$text_dieu_hanh.'</span>
                                    </a>
                                    ';
            }

            if ($data['data_user'][0]->dieuhanh_id == $_SESSION['user_id']) {
                $show_update_dieuhanh = '
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Xác nhận</div>
                                            <div class="profile-info-value form-group">
                                              <select id="input_confirm_dieuhanh" name="confirm_dieuhanh">
                                        <option  value="">Bạn hãy xác nhận quyền điều hành ...</option>
                                        <option value="1">Xác nhận</option>
                                        <option value="0">Từ chối</option>
                                    </select>
                                    <input hidden name="ly_do_dieu_hanh" id="input_ly_do_dieu_hanh" class="valid" style="height: 30px;border: 1px solid #d5d5d5;padding: 10px; width: 50%" placeholder="Lý do từ chối quyền điều hành...">
                                            <p class="error-color  error-color-size" id="error_ly_do_dieu_hanh">Bạn vui lòng xác nhận quyền điều hành</p>
                                            </div>
                                        </div>
';
            }
        }
        $confirm_sales = _returnDataEditAdd($data['data_user'], 'confirm_sales');
        if ($confirm_sales == 1) {
            $confirm_sales = '<a class="btn btn-sm btn-success green">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã xác nhận</span>
                                    </a>';
        } else {
            if($confirm_sales==2){
                $confirm_sales = ' <a filed="confirm_sales" class="btn btn-sm btn-danger confirm_booking">
                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">Đã hủy</span>
                                    </a> ';
            }else{
                $text_sales='Đang đợi xác nhận';
                if($data['data_user'][0]->user_id==0){
                    $text_sales='Chưa chọn sales';
                }
                $confirm_sales = '  <a filed="confirm_sales" class="btn btn-sm btn-warning confirm_booking">
                                        <i class="ace-icon fa fa-exclamation-triangle bigger-110"></i>
                                        <span class="bigger-110 no-text-shadow">'.$text_sales.'</span>
                                    </a>';
            }
            if ($data['data_user'][0]->user_id == $_SESSION['user_id']) {
                $show_update_sales = '
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Xác nhận</div>
                                            <div class="profile-info-value form-group">
                                             <select id="input_confirm_sales" name="confirm_sales">
                                        <option  value="">Bạn hãy xác nhận quyền sales ...</option>
                                        <option value="1">Xác nhận</option>
                                        <option value="0">Từ chối</option>
                                    </select>
                                    <input hidden name="ly_do_sales" id="input_ly_do_sales" class="valid" style="height: 30px;border: 1px solid #d5d5d5;padding: 10px; width: 50%" placeholder="Lý do từ chối quyền sales...">
                                              <p class="error-color  error-color-size" id="error_ly_do_sales">Bạn vui lòng xác nhận quyền điều hành</p>
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
            $valid_name_tour='valid';
            // thông tin tour custom
            $data_tour = booking_tour_custom_getById(_returnDataEditAdd($data['data_user'], 'id_tour'));
            if (count($data_tour) > 0) {
                $chuong_trinh = _returnDataEditAdd($data_tour, 'chuong_trinh');
                if ($chuong_trinh != '') {
                    $chuong_trinh_valid = 'valid';
                }
                $chuong_trinh_price = _returnDataEditAdd($data_tour, 'chuong_trinh_price');
                if (is_numeric($chuong_trinh_price) && $chuong_trinh_price > 0) {
                    $chuong_trinh_price_format = number_format((float)$chuong_trinh_price, 0, ",", ".") . ' vnđ';
                }
                $thoi_gian = _returnDataEditAdd($data_tour, 'thoi_gian');
                if ($thoi_gian != '') {
                    $thoi_gian_valid = 'valid';
                }
                $thoi_gian_price = _returnDataEditAdd($data_tour, 'thoi_gian_price');
                if (is_numeric($thoi_gian_price) && $thoi_gian_price > 0) {
                    $thoi_gian_price_format = number_format((float)$thoi_gian_price, 0, ",", ".") . ' vnđ';
                }
                $nguoi_lon = _returnDataEditAdd($data_tour, 'nguoi_lon');
                $tre_em = _returnDataEditAdd($data_tour, 'tre_em');
                $tre_em_5 = _returnDataEditAdd($data_tour, 'tre_em_5');
                $so_nguoi_price = _returnDataEditAdd($data_tour, 'so_nguoi_price');
                if (is_numeric($so_nguoi_price) && $so_nguoi_price > 0) {
                    $so_nguoi_price_format = number_format((float)$so_nguoi_price, 0, ",", ".") . ' vnđ';
                }
                $khach_san = _returnDataEditAdd($data_tour, 'khach_san');
                $khach_san_price = _returnDataEditAdd($data_tour, 'khach_san_price');
                if (is_numeric($khach_san_price) && $khach_san_price > 0) {
                    $khach_san_price_format = number_format((float)$khach_san_price, 0, ",", ".") . ' vnđ';
                }
                $ngay_khoi_hanh_cus = date("d-m-Y", strtotime(_returnDataEditAdd($data_tour, 'ngay_khoi_hanh_cus')));
                if ($ngay_khoi_hanh_cus != '') {
                    $ngay_khoi_hanh_cus_valid = 'valid';
                }
                $ngay_khoi_hanh_price = _returnDataEditAdd($data_tour, 'ngay_khoi_hanh_price');
                if (is_numeric($ngay_khoi_hanh_price) && $ngay_khoi_hanh_price > 0) {
                    $ngay_khoi_hanh_price_format = number_format((float)$ngay_khoi_hanh_price, 0, ",", ".") . ' vnđ';
                }
                $hang_bay = _returnDataEditAdd($data_tour, 'hang_bay');
                $hang_bay_price = _returnDataEditAdd($data_tour, 'hang_bay_price');
                if (is_numeric($hang_bay_price) && $hang_bay_price > 0) {
                    $hang_bay_price_format = number_format((float)$hang_bay_price, 0, ",", ".") . ' vnđ';
                }
                $khac = _returnDataEditAdd($data_tour, 'khac');
                $khac_price = _returnDataEditAdd($data_tour, 'khac_price');
                if (is_numeric($khac_price) && $khac_price > 0) {
                    $khac_price_format = number_format((float)$khac_price, 0, ",", ".") . ' vnđ';
                }
                $note_cus = _returnDataEditAdd($data_tour, 'note');
            }
        } else {
            $select_type_hethong = 'selected="selected"';
            $show_tour_system = '';
            $show_tour_custom = 'hidden';
            $chuong_trinh_valid = 'valid';
            $thoi_gian_valid = 'valid';
            $ngay_khoi_hanh_cus_valid = 'valid';
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
        $do_tuoi_nguoi_lon=$data['data_user'][0]->name_price;
        $do_tuoi_tre_em_m1=$data['data_user'][0]->name_price_m1;
        $do_tuoi_tre_em_m2=$data['data_user'][0]->name_price_m2;
        $do_tuoi_tre_em_m3=$data['data_user'][0]->name_price_m2;

        $name_price_nguoi_lon='Đơn giá người lớn '.$do_tuoi_nguoi_lon;
        if($do_tuoi_tre_em_m1!=''){
            $name_price_tre_em_m1='Đơn giá trẻ em '.$do_tuoi_tre_em_m1;
        }
        if($do_tuoi_tre_em_m2!=''){
            $name_price_tre_em_m2='Đơn giá trẻ em '.$do_tuoi_tre_em_m2;
        }
        if($do_tuoi_tre_em_m3!=''){
            $name_price_tre_em_m3='Đơn giá trẻ em '.$do_tuoi_tre_em_m3;
        }
        $hidden_don_gia_dichvu='';

        // thông tin đơn giá dịch vụ
        $loi_nhuan=$data['data_user'][0]->loi_nhuan;
        if($loi_nhuan==''){
            $loi_nhuan=0;
        }


        $tyle_m1=$data['data_user'][0]->ty_le_m1;
        if($tyle_m1==''){
            $tyle_m1=0;
        }
        $loi_nhuan_m1=$data['data_user'][0]->loi_nhuan_m1;
        if($loi_nhuan_m1==''){
            $loi_nhuan_m1=0;
        }

        $tyle_m2=$data['data_user'][0]->ty_le_m2;
        if($tyle_m2==''){
            $tyle_m2=0;
        }
        $loi_nhuan_m2=$data['data_user'][0]->loi_nhuan_m2;
        if($loi_nhuan_m2==''){
            $loi_nhuan_m2=0;
        }

        $tyle_m3=$data['data_user'][0]->ty_le_m3;
        if($tyle_m3==''){
            $tyle_m3=0;
        }
        $loi_nhuan_m3=$data['data_user'][0]->loi_nhuan_m3;
        if($loi_nhuan_m3==''){
            $loi_nhuan_m3=0;
        }
        $loi_nhuan_format=number_format((float)round($loi_nhuan,2), 0, ",", ".") . ' vnđ';
        $loi_nhuan_m1_format=number_format((float)round($loi_nhuan_m1,2), 0, ",", ".") . ' vnđ';
        $loi_nhuan_m2_format=number_format((float)round($loi_nhuan_m2,2), 0, ",", ".") . ' vnđ';
        $loi_nhuan_m3_format=number_format((float)round($loi_nhuan_m3,2), 0, ",", ".") . ' vnđ';
        $data_list_dichvu=booking_list_dichvu_getByTop('','booking_id='.$data['data_user'][0]->id,'id asc');
        $readonly_bang_gia_dv='disabled';
        if($data['data_user'][0]->dieuhanh_id==$_SESSION['user_id'] || $_SESSION['user_role']==1)
        {
            $readonly_bang_gia_dv='';
        }
        $total_dicvu=0;
        if($data_list_dichvu>0){
            $count_dv=1;
            foreach ($data_list_dichvu as $row_dv){
                if($row_dv->price==''){
                    $row_dv->price=0;
                }
                if($row_dv->number=='' || $row_dv->number==0){
                    $row_dv->number=1;
                }
                $thanh_tien_dv=$row_dv->price*$row_dv->number;
                $total_dicvu=$total_dicvu+$thanh_tien_dv;
                $price_item_dv= number_format((float)$row_dv->price, 0, ",", ".") . ' vnđ';
                $list_dich_vu.=' <tr id="item_dichvu_'.$count_dv.'" data-value="'.$count_dv.'" class="item_dichvu">
                                            <td id="stt_dichvu_td_'.$count_dv.'">'.$count_dv.'</td>
                                            <td><input style="height: 30px;     width: 100%;" value="'.$row_dv->name.'" '.$readonly_bang_gia_dv.' name="name_dichvu[]" id="input_name_dichvu_'.$count_dv.'" type="text" class="valid input_table"></td>
                                            <td>
                                                <select '.$readonly_bang_gia_dv.' style="width: 100%;" name="type_dichvu[]" id="input_type_dichvu_'.$count_dv.'">';
                if($data_danhmuc_dichvu){
                    foreach($data_danhmuc_dichvu as $row_dm){
                        $selected='';
                        if($row_dv->type==$row_dm->id){
                            $selected='selected="selected"';
                        }
                        $list_dich_vu .='<option '.$selected.' value="'.$row_dm->id.'">'.$row_dm->name.'</option>';
                    }
                }

                $list_dich_vu.='</select>
                                            </td>
                                            <td>
                                                <input '.$readonly_bang_gia_dv.' data-value="'.$count_dv.'" style="height: 30px;width: 86%;" value="'.$row_dv->price.'" name="price_dichvu[]" id="input_price_dichvu_'.$count_dv.'" type="number" class="valid input_table input_price_dichvu">
                                                <div class="btn-group" style="width: 10%;">
                                                    <button style="padding: 4px 5px;margin-top: 0px; margin-bottom: 3px;" data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird" aria-expanded="false"> <i class="fa fa-usd" aria-hidden="true"></i></button>
                                                    <ul class="dropdown-menu dropdown-danger"> <li> <a role="button" data-toggle="modal" class="edit_function">Đơn giá: <b id="price_dichvu_format_'.$count_dv.'">'.$price_item_dv.'</span></a> </li> </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <input '.$readonly_bang_gia_dv.' data-value="'.$count_dv.'"  style="height: 30px; width:100%" value="'.$row_dv->number.'" name="soluong_dichvu[]" min="1" id="input_soluong_dichvu_'.$count_dv.'" type="number" class="valid input_table input_soluong_dichvu">
                                            </td>
                                            <td><input readonly style="height: 30px; width: 100%;" value="'.$row_dv->total.'" name="thanhtien_dichvu[]" id="input_thanhtien_dichvu_'.$count_dv.'" type="text" class="valid input_table "></td>
                                            <td><input '.$readonly_bang_gia_dv.' style="height: 30px; width: 100%;" value="'.$row_dv->note.'" name="ghichu_dichvu[]" id="input_ghichu_dichvu_'.$count_dv.'" type="text" class="valid input_table"></td>
                                            <td><a  id="remove_item_dichvu_'.$count_dv.'" data-remove="'.$count_dv.'" style="padding: 0px 5px;" href="javascript:void(0)" class="red btn  btn-danger remove_item_dichvu"><i class="fa fa-trash-o"></i></if></a></td>

                                        </tr>';
                $count_dv++;
            }
        }
        $total_dicvu_format=number_format((float)$total_dicvu, 0, ",", ".") . ' vnđ';
        $don_gia_nguoi_lon=$total_dicvu/$num_nguoi_lon;
        $don_gia_tre_em_m1=$total_dicvu*($tyle_m1/100);
        $don_gia_tre_em_m2=$total_dicvu*($tyle_m2/100);
        $don_gia_tre_em_m3=$total_dicvu*($tyle_m3/100);
        $don_gia_net=number_format((float)round($don_gia_nguoi_lon,2), 0, ",", ".") . ' vnđ';
        $don_gia_nguoi_lon=$loi_nhuan+$don_gia_nguoi_lon;
        $gia_ban=number_format((float)round($don_gia_nguoi_lon,2), 0, ",", ".") . ' vnđ';

        if($num_tre_em_m1>0){
            $don_gia_tre_em_m1=$don_gia_tre_em_m1/$num_tre_em_m1;
        }
        $don_gia_net_m1=number_format((float)round($don_gia_tre_em_m1,2), 0, ",", ".") . ' vnđ';
        $don_gia_tre_em_m1=$loi_nhuan_m1+$don_gia_tre_em_m1;
        $gia_ban_m1=number_format((float)round($don_gia_tre_em_m1,2), 0, ",", ".") . ' vnđ';

        if($num_tre_em_m2>0){
            $don_gia_tre_em_m2=$don_gia_tre_em_m2/$num_tre_em_m2;
        }
        $don_gia_net_m2=number_format((float)round($don_gia_tre_em_m2,2), 0, ",", ".") . ' vnđ';
        $don_gia_tre_em_m2=$loi_nhuan_m2+$don_gia_tre_em_m2;
        $gia_ban_m2=number_format((float)round($don_gia_tre_em_m2,2), 0, ",", ".") . ' vnđ';

        if($num_tre_em_m3>0){
            $don_gia_tre_em_m3=$don_gia_tre_em_m3/$num_tre_em_m3;
        }
        $don_gia_net_m3=number_format((float)round($don_gia_tre_em_m3,2), 0, ",", ".") . ' vnđ';
        $don_gia_tre_em_m3=$loi_nhuan_m3+$don_gia_tre_em_m3;
        $gia_ban_m3=number_format((float)round($don_gia_tre_em_m3,2), 0, ",", ".") . ' vnđ';
        if ($data['data_user'][0]->user_id == $_SESSION['user_id']) {
            $readonly_info_order='';
        }

        if($_SESSION['user_role']==1){
            $readonly_tour_custom='';
            $readonly_info_order='';
        }
        if($data['data_user'][0]->status==5){
            $readonly_tour_custom='disabled';
            $readonly_info_order='disabled';
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
        if($_SESSION['user_role']!=1){
            $name_user = $_SESSION['user_name'];
            $readonly_name_user = 'disabled';
        }
    }



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
        $dat_coc_format = number_format((float)$dat_coc, 0, ",", ".") . ' vnđ';
    }

    $show_add_tour = '';
    $so_cho = '';
    $departure_name = '';


    $name_tour = _returnDataEditAdd($data['data_user'], 'name_tour');
    if ($name_tour != '') {
        $valid_name_tour = 'valid';
    }
    $id_tour = _returnDataEditAdd($data['data_user'], 'id_tour');
    $price_new = _returnDataEditAdd($data['data_user'], 'price_new');
    $price_tre_em_m1_new = _returnDataEditAdd($data['data_user'], 'price_tre_em_m1_new');
    $price_tre_em_m2_new = _returnDataEditAdd($data['data_user'], 'price_tre_em_m2_new');
    $price_tre_em_m3_new = _returnDataEditAdd($data['data_user'], 'price_tre_em_m3_new');
    if ($price_new == '') {
        $price_new = 0;
    }
    if ($price_tre_em_m1_new == '') {
        $price_tre_em_m1_new = 0;
    }
    if ($price_tre_em_m2_new == '') {
        $price_tre_em_m2_new = 0;
    }
    if ($price_tre_em_m3_new == '') {
        $price_tre_em_m3_new = 0;
    }
    $price_new_format = number_format((float)$price_new, 0, ",", ".") . ' vnđ';
    $price_tre_em_m1_new_format = number_format((float)$price_tre_em_m1_new, 0, ",", ".") . ' vnđ';
    $price_tre_em_m2_new_format = number_format((float)$price_tre_em_m2_new, 0, ",", ".") . ' vnđ';
    $price_tre_em_m3_new_format = number_format((float)$price_tre_em_m3_new, 0, ",", ".") . ' vnđ';

    $table_tour = '<tr> <td class="center">1</td><td><a id="name_tour_table">' . $name_tour . '</a></td>
        <td><span id="price_format_span">' . $price_new_format . '</span>';


    $table_tour .= '<input hidden="" id="input_price_format" value="' . $price_new_format . '">
        <input hidden="" title="giá sửa" id="input_price" value="' . $price_new . '">
        <input hidden="" id="input_price_old" title="giá cũ" value="' . $price_new . '"> ';
    if ($_SESSION['user_role'] == 1 || (isset($data['data_user'][0]->dieuhanh_id)&& $data['data_user'][0]->dieuhanh_id==$_SESSION['user_id'] && $tour_custom!=1) ) {
        $table_tour .= '| <a id="edit_price" href="javascript:void(0)"><i class="fa fa-edit" title="Sửa đơn giá"></i></a>
        <a id="reset_price" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
    } else {
        $show_add_tour = 'hidden';
    }

    // trẻ em mức 1
    $table_tour .= '</td>
    <td><span id="price_format_span_tre_em_m1">' . $price_tre_em_m1_new_format . '</span>';
    $table_tour .= '<input hidden="" title="giá sửa" id="input_price_tre_em_m1" value="' . $price_tre_em_m1_new . '"> <input hidden="" id="input_price_tre_em_m1_old" title="giá cũ" value="' . $price_tre_em_m1_new . '">';
    if ($_SESSION['user_role'] == 1 || (isset($data['data_user'][0]->dieuhanh_id)&& $data['data_user'][0]->dieuhanh_id==$_SESSION['user_id']  && $tour_custom!=1) ) {
        $table_tour .= '| <a id="edit_price_tre_em_m1" href="javascript:void(0)">
        <i class="fa fa-edit" title="Sửa đơn giá"></i></a>
        <a id="reset_price_tre_em_m1" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
    }

     // trẻ em mức 2
     $table_tour .= '</td>
     <td><span id="price_format_span_tre_em_m2">' . $price_tre_em_m2_new_format . '</span>';
     $table_tour .= '<input hidden="" title="giá sửa" id="input_price_tre_em_m2" value="' . $price_tre_em_m2_new . '"> <input hidden="" id="input_price_tre_em_m2_old" title="giá cũ" value="' . $price_tre_em_m2_new . '">';
     if ($_SESSION['user_role'] == 1 || (isset($data['data_user'][0]->dieuhanh_id)&& $data['data_user'][0]->dieuhanh_id==$_SESSION['user_id']  && $tour_custom!=1) ) {
         $table_tour .= '| <a id="edit_price_tre_em_m2" href="javascript:void(0)">
         <i class="fa fa-edit" title="Sửa đơn giá"></i></a>
         <a id="reset_price_tre_em_m2" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
     }

     // trẻ em mức 3
     $table_tour .= '</td>
     <td><span id="price_format_span_tre_em_m3">' . $price_tre_em_m3_new_format . '</span>';
     $table_tour .= '<input hidden="" title="giá sửa" id="input_price_tre_em_m3" value="' . $price_tre_em_m3_new . '"> <input hidden="" id="input_price_tre_em_m3_old" title="giá cũ" value="' . $price_tre_em_m3_new . '">';
     if ($_SESSION['user_role'] == 1 || (isset($data['data_user'][0]->dieuhanh_id)&& $data['data_user'][0]->dieuhanh_id==$_SESSION['user_id']  && $tour_custom!=1) ) {
         $table_tour .= '| <a id="edit_price_tre_em_m3" href="javascript:void(0)">
         <i class="fa fa-edit" title="Sửa đơn giá"></i></a>
         <a id="reset_price_tre_em_m3" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a>';
     }

    $table_tour .= '</td> <td style="color:red">' . $so_cho . '</td></tr>';
    $total=_returnDataEditAdd($data['data_user'], 'total_price');
    if($total==''){
        $total=0;
    }

    $total_format = number_format((float)$total, 0, ",", ".") . ' vnđ';
    if ($vat == 1) {
        $vat_price = ($total * 0.1);
        $vat_format = number_format((float)$vat_price, 0, ",", ".") . ' vnđ';
        $total = $total + $vat_price;
    }
    if (is_numeric($dat_coc) && $dat_coc > 0) {
        $total = $total - $dat_coc;
    }
    $conlai_format = number_format((float)$total, 0, ",", ".") . ' vnđ';

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
                    $price_item = '';
                } else {
                    if ($row_sub_cus->do_tuoi_number == 3) {
                        $price_item = '';
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

    $ma_doan = _returnDataEditAdd($data['data_user'], 'ma_doan');
    $cong_ty = _returnDataEditAdd($data['data_user'], 'cong_ty');
    $tien_te = _returnDataEditAdd($data['data_user'], 'tien_te');
    $data_tien_te = tien_te_getById($tien_te);
    $tien_te_name = '';
    if (count($data_tien_te) > 0) {
        $tien_te_name = $data_tien_te[0]->name;
    }
    $data_list_tien_tee = tien_te_getByTop('', '', 'position asc');
    $thuong_hieu = _returnDataEditAdd($data['data_user'], 'thuong_hieu');
    $data_thuong_hieu = tien_te_getById($thuong_hieu);
    $thuong_hieu_name = '';
    if (count($data_thuong_hieu) > 0) {
        $thuong_hieu_name = $data_thuong_hieu[0]->name;
    }
    $data_list_thuong_hieu = thuong_hieu_getByTop('', 'active=1', 'name asc');
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

