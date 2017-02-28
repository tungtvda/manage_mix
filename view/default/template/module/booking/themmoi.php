<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 8:04 AM
 */
?>
<div class="page-header">

    <h1>
        <?php echo $tieude ?>
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
                                            <?php echo _returnInput('code_booking', $Random, 'valid', 'qrcode', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tiền tệ <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('tien_te', $tien_te, $data_list_tien_tee, 'valid', 'Tiền tệ ...') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tỷ giá</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('ty_gia', '', 'valid', 'exchange', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Ngày bắt đầu <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('ngay_bat_dau', '', '', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Hạn thanh toán <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('han_thanh_toan', '', '', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tình trạng</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('status', $status, $data_list_status, 'valid', 'Trạng thái ...') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Httt <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('hinh_thuc_thanh_toan', $hinh_thuc_thanh_toan, $data_list_httt, 'valid', 'Hình thức thanh toán ...') ?>
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
                                            <input name="num_nguoi_lon" type="text" id="input_num_nguoi_lon"
                                                   title="Số người lớn" class="spinbox-input form-control text-center"
                                                   placeholder="Người lớn">
                                            <input name="num_tre_em" type="text" id="input_num_tre_em"
                                                   title="Số trẻ em từ 5 đến 11 tuổi"
                                                   class="spinbox-input form-control text-center"
                                                   placeholder="Trẻ em  5-11 tuổi">
                                            <input name="num_tre_em_5" type="text" id="input_num_tre_em_5"
                                                   title="Số trẻ em dưới 5 tuổi"
                                                   class="spinbox-input form-control text-center"
                                                   placeholder="Trẻ em dưới 5 tuổi">
                                        </div>
                                    </div>
                                    <div class="profile-info-row check_div">
                                        <div class="profile-info-name"> Thuế VAT(10%)</div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputCheck('vat', 'valid', '', '') ?>
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
                                        <div class="profile-info-name"> Tên khách hàng <span
                                                style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                         <span class="input-icon width_100">
                                            <input id="input_name_customer" type="text" name="name_customner"
                                                   placeholder="Nhập tên khách hàng ..."
                                                   style="width:100%;max-width:100%;outline:0" autocomplete="off">
                                             <i class="ace-icon fa fa-user blue"></i>
                                             <i id="icon_error_name_customer" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff" title=""></i>
                                             <i id="icon_success_name_customer" style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="green" data-textcolor="#000000" title=""></i>
                                         </span>
                                            <input hidden id="input_id_customner" type="text" name="id_customner">
                                            <label style="display: none" class="error-color  error-color-size" id="error_name_customer"></label>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Email <span style="color: red; font-size: 12px">*</span>
                                        </div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('email', '', '', 'envelope', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Địa chỉ <span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('address', '', '', 'map-marker', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Số điện thoại <span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('phone', '', '', 'phone', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Fax</div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('fax', '', 'valid', 'fax', '', '', '') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Nhóm khách hàng <span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group nhom_khach_hang">
                                            <?php echo _returnInputSelect('nhom_khach_hang', '', $data_list_customer_category, 'valid', 'Nhóm khách hàng ...') ?>
                                        </div>
                                        <input hidden id="input_id_category" type="text" name="id_category">
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Điểm đón <span
                                                style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('diem_don', '', '', 'map-marker', '', '', '') ?>
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
                            <div class="form-group border-sloid-1-x"
                                 style="float: left; width: 100%;    margin-left: 0px;margin-right: 0px;">
                                <div style="float: left;width: 66%">
                                           <span class="input-icon width_100">
                                                <input id="input_name_tour" type="text" name="name_tour"
                                                       placeholder="Nhập tên tour ..."
                                                       style="width:100%;max-width:600px;outline:0" autocomplete="off">
                                                 <i class="ace-icon fa fa-plane blue"></i>
                                             </span>
                                    <input hidden id="input_id_tour" type="text" name="id_tour">
                                </div>
                                <div style="float: left;width: 33%;">
                                    <div class="btn-group">
                                        <button style="padding: 7px 10px" class="green btn btn-xs btn-success"
                                                type="button">
                                            <i class=" fa fa-plus bigger-120"></i>
                                        </button>

                                        <button style="padding: 7px 10px" class="green btn btn-xs btn-info"
                                                type="button">
                                            <i class=" fa fa-refresh bigger-120"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Tên tour</th>
                                    <th>Giá</th>
                                    <th>Thời gian</th>
                                    <th>Phương tiện</th>
                                    <th>Khởi hành</th>
                                </tr>
                                </thead>

                                <tbody class="table_booking_tour">

                                </tbody>
                            </table>
                            <div class="hr hr8 hr-double hr-dotted"></div>
                            <div class="row">
                                <div class="col-sm-8 pull-right">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tồng cộng</div>

                                            <div class="profile-info-value form-group">
                                                <span class="red">$395</span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Thuế VAT 10%</div>

                                            <div class="profile-info-value form-group">
                                                <span class="red">$395</span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Đặt cọc</div>

                                            <div class="profile-info-value form-group">
                                                     <span class="input-icon width_100">
                                                        <input id="input_dat_coc" type="text" name="dat_coc">
                                                         <i class="ace-icon fa fa-user blue"></i>
                                                     </span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Còn Lại</div>

                                            <div class="profile-info-value form-group">
                                                <span class="red">$395</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <h3 class="row header smaller lighter purple">
                            <i class="ace-icon fa fa-users"></i>
                            Danh sách đoàn
                            <button title="Thêm dòng" style="padding: 0px 5px"
                                    class="green btn btn-xs btn-success btn_add_customer" type="button">
                                <i class=" fa fa-plus bigger-120"></i>
                            </button>
                        </h3>
                        <div class="col-xs-12 row" style="padding-left: 0px; padding-right: 0px">
                            <table class="table table-striped table-bordered table_add_customer">
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
                        <button title="Thêm dòng" style="padding: 5px 5px"
                                class="green btn btn-xs btn-success btn_add_customer" type="button">
                            <i class=" fa fa-plus bigger-120"></i> Thêm khách hàng
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
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






