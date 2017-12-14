<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 8:04 AM
 */
?>
<div class="page-header" style="margin-bottom: 0px">

    <h1>
        <?php echo $tieude ?>
        <input hidden id="current" value="<?php echo $user_current?>">
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" id="submit_form" role="form" action="" method="post"
              enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row" style="margin-bottom: 20px">
                    <style>
                        .header {
                            float: left;
                            width: 100%;
                        }

                        .profile-user-info {
                            width: 100%;
                        }

                        .div_content {
                            padding-left: 0px;
                            padding-right: 0px;
                        }
                    </style>

                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <h3 class="row header smaller lighter blue" style="margin-top: 0px">
                            <i class="ace-icon fa fa-user blue bigger-125"></i>
                            Chọn điều hành
                        </h3>
                        <div class="row col-xs-12 div_content">
                            <div class="form-group border-sloid-1-x"
                                 style="float: left; width: 100%;    margin-left: 0px;margin-right: 0px;">
                                <div style="float: left;width: 66%">
                                           <span class="input-icon width_100">
                                                <input <?php echo $readonly_name_dieuhanh ?>
                                                    class="<?php echo $valid_name_dieuhanh ?>" id="input_name_dieuhanh"
                                                    autofocus type="text" name="name_dieuhanh"
                                                    value="<?php echo $name_dieuhanh ?>"
                                                    placeholder="Nhập tên điều hành ..."
                                                    style="width:100%;max-width:600px;outline:0" autocomplete="off">
                                                 <i class="ace-icon fa fa-user blue"></i>
                                             </span>
                                    <input class="<?php echo $valid_id_dieuhanh ?>" hidden id="input_dieuhanh_id" type="text"
                                           name="dieuhanh_id" value="<?php echo $id_dieuhanh ?>">
                                    <label style="display: none" class="error-color  error-color-size"
                                           id="error_name_dieuhanh">Bạn vui lòng chọn điều hành</label>
                                </div>
                            </div>
                            <table class="table table-striped tablget_detail.phpe-bordered">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Tên điều hành</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Phòng ban</th>
                                    <th>Tour đang điều hành</th>
                                </tr>
                                </thead>

                                <tbody class="table_booking_dieuhanh">
                                <?php echo $table_dieuhanh ?>
                                </tbody>
                            </table>
                            <div class="hr hr8 hr-double hr-dotted"></div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <h3 class="row header smaller lighter blue" style="margin-top: 0px">
                            <i class="ace-icon fa fa-user blue bigger-125"></i>
                            Chọn sales
                        </h3>
                        <div class="row col-xs-12 div_content">
                            <div class="form-group border-sloid-1-x"
                                 style="float: left; width: 100%;    margin-left: 0px;margin-right: 0px;">
                                <div style="float: left;width: 66%">
                                           <span class="input-icon width_100">
                                                <input <?php echo $readonly_name_customer ?>
                                                    class="<?php echo $valid_name_user ?>" id="input_name_user"
                                                    autofocus type="text" name="name_user"
                                                    value="<?php echo $name_user ?>"
                                                    placeholder="Nhập tên sales ..."
                                                    style="width:100%;max-width:600px;outline:0" autocomplete="off">
                                                 <i class="ace-icon fa fa-user blue"></i>
                                             </span>
                                    <input class="<?php echo $valid_id_user ?>" hidden id="input_id_user" type="text"
                                           name="id_user" value="<?php echo $id_user ?>">
                                    <label style="display: none" class="error-color  error-color-size"
                                           id="error_name_user">Bạn vui lòng chọn sales</label>
                                </div>
                            </div>
                            <table class="table table-striped tablget_detail.phpe-bordered">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Tên Sales</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Phòng ban</th>
                                    <th>Tour đang điều hành</th>
                                </tr>
                                </thead>

                                <tbody class="table_booking_user">
                                <?php echo $table_user ?>
                                </tbody>
                            </table>
                            <div class="hr hr8 hr-double hr-dotted"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <h3 class="row header smaller lighter orange">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-shopping-cart"></i>
												Thông tin booking
											</span>
                            </h3>
                            <div class="col-xs-12 row div_content">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Mã booking <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value">
                                            <span class="input-icon width_100" style="">
                                                    <input readonly name="code_booking" type="text"
                                                           id="input_code_booking" value="<?php echo $Random ?>"
                                                           class="width_100 valid">
                                                    <i class="ace-icon fa fa-qrcode blue"></i>
                                                    <i id="icon_error_code_booking" style="display: none"
                                                       class="ace-icon fa fa-times-circle icon-right error-color "
                                                       data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                       data-placement="bottom" data-backcolor="red"
                                                       data-textcolor="#ffffff" title=""></i>
                                                    <i id="icon_success_code_booking" style="display: none"
                                                       class="ace-icon fa fa-check-circle icon-right success-color"
                                                       data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                       data-placement="bottom" data-backcolor="green"
                                                       data-textcolor="#000000" title=""></i>
                                                </span>
                                            <!--                                            --><?php //echo _returnInput('code_booking', $Random, 'valid', 'qrcode', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tiền tệ</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('tien_te', $tien_te, $data_list_tien_tee, 'valid', 'Tiền tệ ...') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Nguồn đơn hàng</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('nguon_tour', $nguon_tour, $data_list_nguon_tour, 'valid', 'Nguồn đơn hàng ...') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Ngày bắt đầu <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('ngay_bat_dau', $ngay_bat_dau, $ngay_bat_dau_valid, '', 'Bạn vui lòng chọn ngày bắt đầu', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Hạn thanh toán <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('han_thanh_toan', $han_thanh_toan, $han_thanh_toan_valid, '', 'Bạn vui lòng chọn ngày thanh toán', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tình trạng</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('status', $status, $data_list_status, 'valid', 'Trạng thái ...') ?>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_status">Bạn vui lòng chọn trạng thái đơn hàng</label>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Httt <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('hinh_thuc_thanh_toan', $hinh_thuc_thanh_toan, $data_list_httt, 'valid', 'Hình thức thanh toán ...') ?>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_hinh_thuc_thanh_toan">Bạn vui lòng chọn hình thức thanh
                                                toán</label>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Số người <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <style>
                                                .ace-spinner {
                                                    width: 32% !important;
                                                }

                                                .check_div label {
                                                    margin-bottom: 0px;
                                                    margin-top: 5px;
                                                }
                                            </style>
                                            <input name="num_nguoi_lon" value="<?php echo $num_nguoi_lon ?>" type="text"
                                                   id="input_num_nguoi_lon"
                                                   title="Số người lớn"
                                                   class="spinbox-input form-control text-center valid"
                                                   placeholder="Người lớn">
                                            <input name="num_tre_em" type="text" id="input_num_tre_em"
                                                   value="<?php echo $num_tre_em ?>"
                                                   title="Số trẻ em từ 5 đến 11 tuổi"
                                                   class="spinbox-input form-control text-center valid"
                                                   placeholder="Trẻ em  5-11 tuổi">
                                            <input name="num_tre_em_5" type="text" id="input_num_tre_em_5"
                                                   value="<?php echo $num_tre_em_5 ?>"
                                                   title="Số trẻ em dưới 5 tuổi"
                                                   class="spinbox-input form-control text-center valid"
                                                   placeholder="Trẻ em dưới 5 tuổi">
                                            <label style="display: none"
                                                   class="error-color  error-color-size"
                                                   id="error_so_nguoi">Bạn vui lòng nhập số người lớn</label>
                                        </div>


                                    </div>
                                    <div class="profile-info-row check_div">
                                        <div class="profile-info-name"> Thuế VAT(10%)</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputCheck('vat', 'valid', '', $checked_vat) ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 ">
                            <h3 class="row header smaller lighter green">
                                <i class="ace-icon fa fa-user"></i>
                                Thông tin khách hàng
                            </h3>
                            <div class="row col-xs-12 div_content">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Họ và tên <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                         <span class="input-icon width_100">
                                            <input <?php echo $readonly_name_customer ?> id="input_name_customer"
                                                                                         type="text"
                                                                                         name="name_customer"
                                                                                         class="<?php echo $valid_name_customer ?>"
                                                                                         value="<?php echo $name_customer ?>"
                                                                                         placeholder="Nhập tên khách hàng ..."
                                                                                         style="width:100%;max-width:100%;outline:0"
                                                                                         autocomplete="off">
                                             <i class="ace-icon fa fa-user blue"></i>
                                             <i id="icon_error_name_customer" style="display: none"
                                                class="ace-icon fa fa-times-circle icon-right error-color "
                                                data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff"
                                                title=""></i>
                                             <i id="icon_success_name_customer" style="display: none"
                                                class="ace-icon fa fa-check-circle icon-right success-color"
                                                data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                data-placement="bottom" data-backcolor="green" data-textcolor="#000000"
                                                title=""></i>

                                         </span>
                                            <input value="<?php echo $id_customer ?>" hidden id="input_id_customer"
                                                   type="text" class="valid" name="id_customer">
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_name_customer">Bạn vui lòng nhập tên khách hàng</label>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Email <span style="color: red; font-size: 12px">*</span>
                                        </div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('email', $email_customer, $email_customer_valid, 'envelope', '', 'Bạn vui lòng nhập email khách hàng', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Địa chỉ <span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('address', $address_customer, $address_customer_valid, 'map-marker', '', 'Bạn vui lòng nhập địa chỉ khách hàng', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Điện thoại<span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('phone', $phone_customer, $phone_customer_valid, 'phone', '', 'Bạn vui lòng nhập số điện thoai', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Fax</div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('fax', $fax_customer, 'valid', 'fax', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Nhóm</div>
                                        <div class="profile-info-value form-group nhom_khach_hang">
                                            <?php echo _returnInputSelect('nhom_khach_hang', $nhom_kh, $data_list_customer_category, 'valid', 'Nhóm khách hàng ...') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Điểm đón <span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('diem_don', $diem_don, $diem_don_customer_valid, 'map-marker', '', 'Bạn vui lòng nhập điểm đón', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Khởi hành <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('ngay_khoi_hanh', $ngay_khoi_hanh, $ngay_khoi_hanh_valid, '', 'Bạn vui lòng chọn ngày khởi hành', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Kết thúc <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('ngay_ket_thuc', $ngay_ket_thuc, $ngay_ket_thuc_valid, '', 'Bạn vui lòng chọn ngày kết thúc', '') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <div class="row col-xs-12 div_content">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Ghi chú </div>

                                        <div class="profile-info-value form-group">
                                         <span class="input-icon width_100">
                                            <textarea class="valid" name="note" id="input_note" style="width: 100%"><?php echo $note ?></textarea>
                                         </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <h3 class="row header smaller lighter blue">
                            <i class="ace-icon fa fa-plane fa-plane blue bigger-125"></i>
                            Thông tin tour
                        </h3>
                        <div class="row col-xs-12 div_content">
                           <h5>Loại tour <span
                                   style="color: red; font-size: 12px">*</span></h5>

                            <div style="float: left;width: 100%; margin-bottom: 20px" >
                                <select name="type_tour" class="chosen-select form-control type_tour"
                                        id="form-field-select-3" data-placeholder="Chọn loại tour ..."
                                        style="display: none;width: 10px">
                                    <option value=""></option>
                                    <option value="0">Tour trong hệ thống</option>
                                    <option value="1">Tour theo yêu cầu khách hàng</option>
                                </select>
                                <label style="display: none" class="error-color  error-color-size" id="error_type_tour">Bạn vui lòng chọn loại tour</label>
                                </span>
                            </div>
                            <div hidden id="tour_custom" class="show_type_tour form-group border-sloid-1-x" style="float: left; width: 100%;background: #ffffff;  margin-left: 0px;margin-right: 0px;">
                                   <div class="profile-user-info profile-user-info-striped">
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Tên tour <span style="color: red; font-size: 12px">*</span></p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                   <span class="input-icon width_100">
                                                <input id="input_name_tour_cus" type="text" data-valid="required" name="name_tour_cus" value="" class="width_100 valid-input" placeholder="Tên tour..." >
                                                 <i class="ace-icon fa fa-plane  blue"></i>
                                                </span>
                                                   <label style="display: none" class="error-color  error-color-size" id="error_name_tour_cus">Bạn vui lòng nhập tên tour</label>
                                                   </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Chương trình <span style="color: red; font-size: 12px">*</span></p>
                                               </br>
                                               <p>Đơn giá <span style="color: red; font-size: 12px">*</span></p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                   <span class="input-icon width_100">
                                                    <textarea class="valid-input" name="chuong_trinh" data-valid="required" id="input_chuong_trinh" placeholder="Chương trình tour" style="width: 100%"></textarea>
                                                    <label style="display: none" class="error-color  error-color-size" id="error_chuong_trinh">Bạn vui lòng nhập chương trình tour</label>
                                                    </span>
                                               </div>
                                               <div class="row col-xs-12">
                                                   <span class="input-icon width_100">
                                                <input id="input_chuong_trinh_price" type="text" name="chuong_trinh_price" value="0" class="valid input_price_cus" placeholder="Đơn giá chương trình ..." >
                                                 <i class="ace-icon fa fa-dollar blue"></i>
                                                 <span id="price_chuong_trinh_price">0 vnđ</span>
                                                </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Thời gian <span style="color: red; font-size: 12px">*</span></p>
                                               <p>Đơn giá <span style="color: red; font-size: 12px">*</span></p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                 <span class="input-icon width_100">
                                                    <input id="input_thoi_gian" type="text" name="thoi_gian" class="width_100 valid-input" data-valid="required" value="" placeholder="Thời gian tour ..." >
                                                    <i class="ace-icon fa fa-clock-o blue"></i>
                                                     <label style="display: none" class="error-color  error-color-size" id="error_thoi_gian">Bạn vui lòng nhập thời gian tour</label>
                                                 </span>
                                               </div>
                                               <div class="row col-xs-12" style="padding-top: 5px">
                                                  <span class="input-icon width_100">
                                                    <input id="input_thoi_gian_price" type="text" name="thoi_gian_price" value="0" class="valid input_price_cus" placeholder="Đơn giá thời gian ..." >
                                                     <i class="ace-icon fa fa-dollar blue"></i>
                                                    <span id="price_thoi_gian_price">0 vnđ</span>
                                                 </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Số người <span style="color: red; font-size: 12px">*</span></p>
                                               <p>Đơn giá <span style="color: red; font-size: 12px">*</span></p>
                                           </div>
                                           <div class="profile-info-value form-group">
                                               <div class="row col-xs-12">
                                                   <input  name="nguoi_lon" value="1" type="text"
                                                          id="input_nguoi_lon"
                                                          title="Số người lớn"
                                                          class="spinbox-input form-control text-center valid"
                                                          placeholder="Người lớn">
                                                   <input name="tre_em" type="text" id="input_tre_em"
                                                          value="0"
                                                          title="Số trẻ em từ 5 đến 11 tuổi"
                                                          class="spinbox-input form-control text-center valid"
                                                          placeholder="Trẻ em  5-11 tuổi">
                                                   <input name="tre_em_5" type="text" id="input_tre_em_5"
                                                          value="0"
                                                          title="Số trẻ em dưới 5 tuổi"
                                                          class="spinbox-input form-control text-center valid"
                                                          placeholder="Trẻ em dưới 5 tuổi">
                                                   <label style="display: none"
                                                          class="error-color  error-color-size"
                                                          id="error_so_nguoi_cus">Bạn vui lòng nhập số người lớn</label>
                                               </div>
                                               <div class="row col-xs-12" style="padding-top: 5px">
                                                  <span class="input-icon width_100">
                                                    <input id="input_so_nguoi_price" type="text" name="so_nguoi_price" value="0" class="valid input_price_cus" placeholder="Đơn giá số người ..." >
                                                     <i class="ace-icon fa fa-dollar blue"></i>
                                                    <span id="price_so_nguoi_price">0 vnđ</span>
                                                 </span>
                                               </div>

                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Khởi hành <span style="color: red; font-size: 12px">*</span></p>
                                               <p>Đơn giá <span style="color: red; font-size: 12px">*</span></p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                 <span class="input-icon width_100">
                                                    <div class="input-group" style="">
                                                        <input value="" class="form-control date-picker width_100 valid-input" data-valid="required" id="input_ngay_khoi_hanh_cus" name="ngay_khoi_hanh_cus" required="" type="text" data-date-format="dd-mm-yyyy">
																	<span id="icon_ngay_khoi_hanh_cus" class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                                    </div>
                                                     <label style="display: none" class="error-color  error-color-size" id="error_ngay_khoi_hanh_cus">Bạn vui lòng nhập ngày khởi hàng</label>
                                                 </span>
                                               </div>
                                               <div class="row col-xs-12" style="padding-top: 5px">
                                                  <span class="input-icon width_100">
                                                    <input id="input_ngay_khoi_hanh_price" type="text" name="ngay_khoi_hanh_price" value="0" class="valid input_price_cus" placeholder="Đơn giá ngày khởi hành ..." >
                                                     <i class="ace-icon fa fa-dollar blue"></i>
                                                    <span id="price_ngay_khoi_hanh_price">0 vnđ</span>
                                                 </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Khách sạn </p>
                                               <p>Đơn giá </p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                 <span class="input-icon width_100">
                                                    <input id="input_khach_san" type="text" name="khach_san" class="width_100 valid" value="" placeholder="Loại khách sạn ..." >
                                                    <i class="ace-icon fa fa-home  blue"></i>
                                                 </span>
                                               </div>
                                               <div class="row col-xs-12" style="padding-top: 5px">
                                                  <span class="input-icon width_100">
                                                    <input id="input_khach_san_price" type="text" name="khach_san_price" value="0" class="valid input_price_cus" placeholder="Đơn giá khách sạn ..." >
                                                     <i class="ace-icon fa fa-dollar blue"></i>
                                                    <span id="price_khach_san_price">0 vnđ</span>
                                                 </span>
                                               </div>
                                           </div>
                                       </div>



                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Hãng bay</p>
                                               <p>Đơn giá </p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                 <span class="input-icon width_100">
                                                    <input id="input_hang_bay" type="text" name="hang_bay" class="width_100 valid" value="" placeholder="Hãng hàng không ..." >
                                                    <i class="ace-icon fa fa-plane  blue"></i>
                                                 </span>
                                               </div>
                                               <div class="row col-xs-12" style="padding-top: 5px">
                                                  <span class="input-icon width_100">
                                                    <input id="input_hang_bay_price" type="text" name="hang_bay_price" value="0" class="valid input_price_cus" placeholder="Đơn giá hãng hàng không ..." >
                                                     <i class="ace-icon fa fa-dollar blue"></i>
                                                    <span id="price_hang_bay_price">0 vnđ</span>
                                                 </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Dịch vụ khác</p>
                                               </br>
                                               <p>Đơn giá</p>
                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                   <span class="input-icon width_100">
                                                    <textarea class="valid" name="khac" id="input_khac" placeholder="Dịch vụ khác" style="width: 100%"></textarea>
                                                    </span>
                                               </div>
                                               <div class="row col-xs-12">
                                                   <span class="input-icon width_100">
                                                <input id="input_khac_price" type="text" name="khac_price" value="0" class="valid input_price_cus" placeholder="Đơn giá dịch vụ khác ..." >
                                                 <i class="ace-icon fa fa-dollar blue"></i>
                                                 <span id="price_khac_price">0 vnđ</span>
                                                </span>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="profile-info-row">
                                           <div class="profile-info-name">
                                               <p>Note</p>

                                           </div>
                                           <div class="profile-info-value">
                                               <div class="row col-xs-12">
                                                   <span class="input-icon width_100">
                                                    <textarea class="valid" name="note_cus" id="input_note_cus" placeholder="Ghi chú" style="width: 100%"></textarea>
                                                    </span>
                                               </div>
                                           </div>
                                       </div>

                                   </div>
                            </div>
                            <div hidden id="tour_in_system" class="form-group border-sloid-1-x show_type_tour"
                                 style="float: left; width: 100%;    margin-left: 0px;margin-right: 0px;">
                                <div style="float: left;width: 50%">
                                           <span class="input-icon width_100">
                                                <input <?php echo $readonly_name_tour ?> id="input_name_tour"
                                                                                         type="text" name="name_tour"
                                                                                         class="<?php echo $valid_name_tour ?>"
                                                                                         value="<?php echo $name_tour ?>"
                                                                                         placeholder="Nhập tên tour ..."
                                                                                         style="width:100%;max-width:600px;outline:0"
                                                                                         autocomplete="off">
                                                 <i class="ace-icon fa fa-plane blue"></i>
                                             </span>
                                    <input hidden id="input_id_tour" type="text" name="id_tour"
                                           value="<?php echo $id_tour ?>" class="<?php echo $valid_name_tour ?>">
                                    <label style="display: none" class="error-color  error-color-size"
                                           id="error_name_tour">Bạn vui lòng chọn tour</label>
                                </div>
                                <div <?php echo $show_add_tour ?> style="float: left;">
                                    <div class="btn-group">
                                        <a href="#modal-form" data-toggle="modal" role="button"
                                           id="btn_add_customer_popup" style="padding: 7px 10px; "
                                           class="green btn btn-xs btn-success" type="button">
                                            <i class=" fa fa-plus bigger-120"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Tên tour</th>
                                    <th id="name_price_nguoi_lon">Đơn giá người lớn</th>
                                    <th id="name_price_tre_em_511">Đơn giá 5-11 tuổi</th>
                                    <th id="name_price_tre_em_5">Đơn giá dưới 5 tuổi</th>
                                    <th>Khởi hành</th>
                                    <th>Số chỗ</th>
                                </tr>
                                </thead>

                                <tbody class="table_booking_tour">
                                <?php echo $table_tour ?>
                                </tbody>
                            </table>
                            <div hidden id="input_list_price">

                            </div>
                            <input hidden="" class="valid" id="input_price_submit" name="price_submit"
                                   value="<?php echo $price_new ?>">
                            <input hidden="" class="valid" id="input_price_511_submit" name="price_511_submit"
                                   value="<?php echo $price_11_new ?>">
                            <input hidden="" class="valid" id="input_price_5_submit" name="price_5_submit"
                                   value="<?php echo $price_5_new ?>">
                            <div class="hr hr8 hr-double hr-dotted"></div>
                            <div class="row">
                                <div class="col-sm-4" style="text-align: right"><a title="Tính tiền" id="tinh_tien"
                                                                                   href="javascript:void(0)"><img
                                            class="tinh_tien"
                                            src="<?php echo SITE_NAME ?>/view/default/themes/images/tinhtien.png"></a>
                                </div>
                                <div class="col-sm-8 pull-right">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tồng cộng</div>

                                            <div class="profile-info-value form-group">
                                                <span class="red" id="tong_cong"><?php echo $total_format ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Thuế VAT 10%</div>

                                            <div class="profile-info-value form-group">
                                                <span class="red" id="vat"><?php echo $vat_format ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Đặt cọc</div>

                                            <div class="profile-info-value form-group">
                                                     <span class="input-icon width_100">
                                                        <input class="valid" id="input_dat_coc" type="number"
                                                               name="dat_coc" value="<?php echo $dat_coc ?>">
                                                          <span class="red"
                                                                id="dat_coc_format"><?php echo $dat_coc_format ?></span>
                                                         <i class="ace-icon fa fa-user blue"></i>
                                                     </span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Còn Lại</div>

                                            <div class="profile-info-value form-group">
                                                <span class="red" id="con_lai"><?php echo $conlai_format ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <h3 class="row header smaller lighter green">
                            <i class="ace-icon fa fa-dollar green bigger-125"></i>
                            Hoa hồng
                        </h3>
                        <div class="row col-xs-12 div_content">
                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Thành viên</div>
                                    <div class="profile-info-value">
                                        <div style="float: left;width: 66%">
                                           <span class="input-icon width_100">
                                                <input <?php echo $readonly_name_user_tt ?>
                                                    class="valid" id="input_name_user_tiepthi"
                                                    autofocus type="text" name="name_user_tiepthi"
                                                    value="<?php echo $name_user_tt ?>"
                                                    placeholder="Nhập mã thành viên ..."
                                                    style="width:100%;max-width:600px;outline:0" autocomplete="off">
                                                 <i class="ace-icon fa fa-user blue"></i>
                                             </span>
                                            <input class="valid" hidden id="input_id_user_tt" type="text"
                                                   name="id_user_tt" value="<?php echo $id_user_tt?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Tiền hoa hồng</div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click price_tiep_thi"><?php echo $price_tiep_thi?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Trạng thái</div>
                                    <div class="profile-info-value">
                                        <?php echo _returnInputCheck('confirm_admin_tiep_thi', 'valid', '', $confirm_admin_tiep_thi) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr8 hr-double hr-dotted"></div>
                        </div>
                    </div>
                    <input class="valid" hidden name="check_edit" id="input_check_edit"
                           value="<?php echo $action_name ?>">
                    <input class="valid" hidden name="id_edit" id="input_id_edit" value="<?php echo $booking_id ?>">
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <h3 class="row header smaller lighter purple">
                            <i class="ace-icon fa fa-users"></i>
                            Danh sách đoàn
                            <button title="Tạo danh sách đoàn" style="padding: 0px 5px"
                                    class="green btn btn-xs btn-success btn_add_customer" type="button">
                                <i class=" fa fa-plus bigger-120"></i>
                            </button>
                        </h3>
                        <div class="col-xs-12 row" style="padding-left: 0px; padding-right: 0px;overflow-x:auto;">
                            <table style="width: 100%" class="table_add_customer">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Độ tuổi</th>
                                    <th>Số Passport</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Đơn giá <i class="fa fa-sort-amount-desc "></i></th>
                                </tr>
                                </thead>
                                <style>
                                    .show_hide_table tr td{
                                        padding: 5px;
                                    }
                                </style>
                                <tbody class="show_hide_table">
                                <?php echo $string_cus_tommer?>
                                </tbody>
                            </table>
                            <table hidden class="table table-striped table-bordered table_add_customer">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>


                                <!--                                <tbody id="row_customer_1">-->
                                <!--                                <tr>-->
                                <!--                                    <td class="center stt_cus">1</td>-->
                                <!--                                    <td> <span class="input-icon width_100"><input id="input_name_customer_1" class="valid" type="text"  name="name_customer[]"><i class="ace-icon fa fa-user blue"></i></span></td>-->
                                <!--                                    <td><span class="input-icon width_100"> <input id="input_name_customer_1" type="text" class="valid" name="email_customer[]"><i class="ace-icon fa fa-envelope blue"></i> </span></td>-->
                                <!--                                    <td><span class="input-icon width_100"><input id="input_phone_customer_1" class="valid" type="text" name="phone_customer[]"><i class="ace-icon fa fa-phone blue"></i></span></td>-->
                                <!--                                    <td><span class="input-icon width_100"> <input id="address_phone_customer_1" type="text" name="address_customer[]"><i class="ace-icon fa fa-map_marker blue"></i></span></td>-->
                                <!--                                    <td><a id="stt_custommer_1" deleteid="1" title="Xóa khách hàng"  class="red btn_remove_customer" href="javascript:void()"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>-->
                                <!--                                </tr>-->
                                <!--                                </tbody>-->
                            </table>
                        </div>
<!--                        <button title="Thêm dòng" style="padding: 5px 5px"-->
<!--                                class="green btn btn-xs btn-success btn_add_customer" type="button">-->
<!--                            <i class=" fa fa-plus bigger-120"></i> Thêm khách hàng-->
<!--                        </button>-->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <?php echo $confirm_admin_tring ?>
                <button class="btn btn-sm btn-primary" id="submit_form_action" type="button">
                    <i class="ace-icon fa fa-check"></i>
                    Save
                </button>
                <button type="reset" class="btn btn-sm" data-dismiss="modal" id="reset_form_popup">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>
            </div>
        </form>
        <!-- PAGE CONTENT BEGINS -->

    </div><!-- /.col -->
</div><!-- /.row -->
<!--<style>-->
<!--    .modal-footer {-->
<!--        position: fixed;-->
<!--        bottom: 60px;-->
<!--        right: 35px;-->
<!--        width: 81%;-->
<!--    }-->
<!--</style>-->

<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger" id="title_form">Tạo tour mới</h4>

            </div>
            <form id="submit_form_tour" role="form" action="" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group" style="float: left; width: 100%">
                                <div>
                                    <label for="form-field-select-3">Tên tour <span style="color: red">*</span></label>
                                    <?php echo _returnInput('name_tour_add', '', '', 'plane', '', 'Bạn vui lòng nhập mã khách hàng', '') ?>
                                </div>
                            </div>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: left; width: 100%">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="form-field-select-3">Giá người lớn<span
                                            style="color: red">*</span></label>
                                    <?php echo _returnInput('price_tour_add', '', '', 'usd', '', 'Bạn vui lòng kiểm giá người lớn', '') ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="form-field-select-3">Giá trẻ em 5-11 tuổi<span
                                            style="color: red">*</span></label>
                                    <?php echo _returnInput('price_tour_511_add', '', '', 'usd', '', 'Bạn vui lòng kiểm tra email', '') ?>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; width: 100%">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="form-field-select-3">Giá trẻ em dưới 5 tuổi <span
                                            style="color: red">*</span></label>
                                    <?php echo _returnInput('price_tour_5_add', '', '', 'usd', '', 'Bạn vui lòng kiểm tra email', '') ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="form-field-select-3">Điểm khởi hành </label>
                                    <?php echo _returnInput('diem_khoi_hanh', '', '', 'map-marker', '', '', '') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" id="submit_form_tour_action" type="button">
                        <i class="ace-icon fa fa-check"></i>
                        Save
                    </button>
                    <button type="reset" class="btn btn-sm" data-dismiss="modal" id="reset_form_tour_popup">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->






