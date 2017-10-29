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
        <?php echo $title ?>
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                        <?php if (_returnCheckAction(21) == 1) { ?>
                            <a href="<?php echo SITE_NAME . '/' . $action_link ?>/dat-tour"
                               class="btn btn-white  btn-create-new-tab btn-create-new-tab-hover">
                                <i class="ace-icon fa fa-plane bigger-120 "></i>
                                Đặt tour
                                <i class="ace-icon fa fa-cart-plus icon-on-right"></i>
                            </a>
                        <?php } ?>
                        <a href="" class="btn btn-white  btn-refresh">
                            <i class="ace-icon fa fa-refresh"></i>
                            Refresh
                        </a>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird"
                                    aria-expanded="false">
                                Action
                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-danger">
                                <?php if (_returnCheckAction(22) == 1) { ?>
                                    <li>
                                        <a href="#modal-form" role="button" data-toggle="modal" class="edit_function">Sửa</a>
                                    </li>
                                <?php } ?>
                                <!--                                --><?php //if (_returnCheckAction(23) == 1) { ?>
                                <!--                                    <li>-->
                                <!--                                        <a class="delete_function"-->
                                <!--                                           href="javascript:void()">Xóa</a>-->
                                <!--                                    </li>-->
                                <!--                                --><?php //} ?>
                                <li class="divider"></li>
                                <?php if (_returnCheckAction(21) == 1) { ?>
                                    <li>
                                        <a href="<?php echo SITE_NAME . '/' . $action_link ?>/dat-tour">Đặt tour</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 " style="padding-left: 0px">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                </div>

                <div class="hr hr-18 dotted hr-double"></div>
                <!--<div class="table-header">
                    Results for "Users"
                </div>-->

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <form action="" method="post" id="form_submit_delete">
                        <table id="dynamic-table"
                               class="table table-striped table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>#</th>
                                <th>Mã booking</th>
                                <th>Tên Tour</th>
                                <th>Tên khách hàng</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Còn lại</th>
                                <th>Xác nhận đơn hàng</th>
                                <th>Xác nhận hoa hồng</th>
                                <th>Lịch sử giao dịch</th>
                                <th>Chi phí</th>
                                <th>Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php if (count($list) > 0 && _returnCheckAction(20) == 1) { ?>
                                <?php $dem = 1; ?>
                                <?php foreach ($list as $row) { ?>
                                    <tr class="row_<?php echo $row->id ?>">
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace click_check_list"
                                                       name_record="<?php echo $row->code_booking ?>"
                                                       id="check_<?php echo $dem ?>" name="check_box_action[]"
                                                       value="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $dem; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITE_NAME . '/' . $action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->code_booking ?></a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="<?php echo SITE_NAME . '/' . $action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->name_tour ?></a>
                                        </td>
                                        <td><?php
                                            $data_customer = customer_getById($row->id_customer);
                                            if (count($data_customer) > 0) {
                                                echo '<a href="' . SITE_NAME . '/khach-hang/sua?id=' . _return_mc_encrypt($data_customer[0]->id, ENCRYPTION_KEY) . '">' . $data_customer[0]->name . '</a>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <input id="status_old_<?php echo $row->id ?>"
                                                   value="<?php echo $row->status ?>" hidden>
                                            <label style="display: none"><?php echo $row->status ?></label>
                                            <?php
                                            $disabled = 'disabled';
                                            if ($row->confirm_admin == 1 || $_SESSION['user_role'] == 1) {
                                                $disabled = '';
                                            }
                                            ?>
                                            <select <?php echo $disabled ?> id="status_<?php echo $row->id ?>"
                                                                            class="select_status"
                                                                            count_id="<?php echo $row->id ?>"
                                                                            code="<?php echo $row->code_booking ?>">
                                                <?php
                                                foreach ($data_list_status as $row_status) {
                                                    $select = '';
                                                    if ($row->status == $row_status->id) {
                                                        $select = 'selected';
                                                    }
                                                    echo "<option $select value='$row_status->id'>$row_status->name</option>";

                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><?php echo number_format((int)$row->total_price, 0, ",", ".") . ' vnđ'; ?></td>
                                        <td>
                                            <?php
                                            if ($row->tien_thanh_toan != '') {
                                                echo number_format((int)$row->tien_thanh_toan, 0, ",", ".") . ' vnđ';
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            $thanhtoan = 0;
                                            if ($row->tien_thanh_toan != '') {
                                                $thanhtoan = $row->tien_thanh_toan;
                                            }
                                            $con_lai = $row->total_price - $row->tien_thanh_toan;
                                            echo number_format((int)$con_lai, 0, ",", ".") . ' vnđ';
                                            ?>
                                        </td>

<!--                                        <td>-->
<!--                                            --><?php
//                                            if ($row->name_user != '') {
//                                                echo '<a href="' . SITE_NAME . '/nhan-vien/sua?id=' . _return_mc_encrypt($row->user_id, ENCRYPTION_KEY) . '">' . $row->name_user . '</a>';
//                                            }
//                                            ?>
<!--                                        </td>-->
                                        <td>
                                            <span hidden><?php echo (int)$row->confirm_admin ?></span>
                                            <?php if ($row->confirm_admin > 0) { ?>
                                                <?php
                                                $data_user_confirm = user_getById($row->confirm_admin);
                                                $name_user_confirm = '';
                                                if (count($data_user_confirm) > 0) {
                                                    $name_user_confirm = $data_user_confirm[0]->name;
                                                }
                                                ?>
                                                <label title="<?php echo $name_user_confirm ?>">
                                                    <input disabled checked name="switch-field-1"
                                                           class="ace ace-switch ace-switch-3" type="checkbox">
                                                    <span class="lbl"></span>
                                                </label>
                                            <?php } else { ?>
                                                <label title="Chưa được xác nhận">
                                                    <input name="switch-field-1"
                                                           class="ace ace-switch ace-switch-3 <?php if ($_SESSION['user_role'] == 1) { ?> confirm_booking_list<?php } ?>"
                                                        <?php if ($_SESSION['user_role'] == 1) { ?>
                                                            count_id="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY) ?>"
                                                            id_filed="<?php echo $row->id ?>"
                                                            code="<?php echo $row->code_booking ?>"
                                                            id="confirm_booking_<?php echo $row->id ?>"
                                                        <?php } ?>
                                                           type="checkbox">

                                                    <span class="lbl"></span>
                                                </label>

                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->price_tiep_thi != '' && $row->name_user_tt != '' && $row->type_user_tt==2 && $row->status!=3 && $row->status!=6 ) {
                                                $price_tiep_thi = number_format((int)$row->price_tiep_thi, 0, ",", ".") . ' vnđ';
                                                $function_='hidden';
                                                if($row->status_tiep_thi==1){
                                                    $class='green';
                                                }else{
                                                    $class='red';
                                                }
                                                if($_SESSION['user_role'] == 1 && $row->status_tiep_thi==0){
                                                echo '<label id="remove_btn_tiepthi_'.$row->id.'" title="Chưa được xác nhận">
                                                    <input name="switch-field-1" class="ace ace-switch ace-switch-3  confirm_tiep_thi" user="'.$row->name_user_tt.' - '.$row->user_code_tt.'"
                                                    count_id="'._return_mc_encrypt($row->id, ENCRYPTION_KEY).'" id_filed="'.$row->id.'" code="'.$row->code_booking.'" id="confirm_tiep_thi_'.$row->id.'" type="checkbox">
                                                    <span class="lbl"></span>
                                                </label>';
                                                }
                                                echo '<span id="change_color_'.$row->id.'" class="'.$class.'"><b>' . $price_tiep_thi . '</b></span>';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php if (_returnCheckAction(18) == 1) { ?>
                                                <a title="Lịch sử giao dịch" class="red view_lich_su_giao_dich" href="#modal-form-giaodich" role="button" data-toggle="modal" data-code="<?php echo $row->code_booking ?>" data-id="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                  >
                                                    <i class="ace-icon fa fa-sliders bigger-130"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php if (_returnCheckAction(18) == 1) { ?>
                                                <a title="Danh sách chi phí" class="red"
                                                   href="<?php echo SITE_NAME . '/' . $action_link ?>/chi-phi?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                    <i class="ace-icon fa fa-usd bigger-130"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">


                                                <?php if (_returnCheckAction(18) == 1) { ?>
                                                    <a class="blue view_popup_detail" role="button"
                                                       name_record="<?php echo $row->code_booking ?>"
                                                       data-toggle="modal" table="booking"
                                                       countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                       href="#modal-form"
                                                       title="Chi tiết">
                                                        <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                    </a>

                                                    <a title="Sửa tab mới" class="green"
                                                       href="<?php echo SITE_NAME . '/' . $action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($_SESSION['user_role'] == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row->code_booking ?>"
                                                       url_delete="<?php echo SITE_NAME . '/' . $action_link ?>/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle"
                                                            data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

<!--                                                        --><?php //if (_returnCheckAction(18) == 1) { ?>
<!--                                                            <li class="red">-->
<!--                                                                <a href="--><?php //echo SITE_NAME . '/' . $action_link ?><!--/chi-phi?id=--><?php //echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?><!--"-->
<!--                                                                   class="tooltip-success" data-rel="tooltip"-->
<!--                                                                   title="Danh sách chi phí">-->
<!--																				<span class="">-->
<!--																					<i class="ace-icon fa fa-usd bigger-120"></i>-->
<!--																				</span>-->
<!--                                                                </a>-->
<!--                                                            </li>-->
<!--                                                        --><?php //} ?>
                                                        <?php if (_returnCheckAction(20) == 1) { ?>
                                                            <li>
                                                                <a class="blue view_popup_detail" role="button"
                                                                   name_record="<?php echo $row->code_booking ?>"
                                                                   data-toggle="modal" table="booking"
                                                                   countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   href="#modal-form"
                                                                   title="Chi tiết">
                                                                    <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="<?php echo SITE_NAME . '/' . $action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   class="tooltip-success" data-rel="tooltip"
                                                                   title="Sửa tab mới">
																				<span class="">
																					<i class="ace-icon fa fa-pencil bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($_SESSION['user_role'] == 1) { ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   deleteid="<?php echo $row->id ?>"
                                                                   name_record_delete="<?php echo $row->code_booking ?>"
                                                                   url_delete="<?php echo SITE_NAME . '/' . $action_link ?>/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   class="tooltip-error delete_record" title="Xóa">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $dem++; ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>


                        </table>
                    </form>
                </div>
                <div class="hr hr-18 dotted hr-double"></div>
                <div class="btn-groupn col-md-12" style="padding-left: 0px">
                    <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird"
                            aria-expanded="false">
                        Action
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-danger">
                        <?php if (_returnCheckAction(22) == 1) { ?>
                            <li>
                                <a href="#modal-form" role="button" data-toggle="modal" class="edit_function">Sửa</a>
                            </li>
                        <?php } ?>
                        <?php if (_returnCheckAction(23) == 1) { ?>
                            <li>
                                <a class="delete_function"
                                   href="javascript:void()">Xóa</a>
                            </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <?php if (_returnCheckAction(21) == 1) { ?>
                            <li>
                                <a href="<?php echo SITE_NAME . '/' . $action_link ?>/them-moi">Đặt tour</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <style>
            .modal-backdrop {
                height: 1000px !important;
            }

            @media (min-width: 768px) {
                .modal-dialog {
                    width: 50%;
                    margin: 30px auto;
                }
            }

        </style>
        <div id="modal-form" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger" id="title_form">Thông tin đơn hàng</h4>
                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row show_hoa_hong">
                                <h3 style="margin-right: 0px; margin-left: 0px;    font-size: 14px;    margin-top: 0px;"
                                    class="row header smaller lighter green">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-dollar"></i>
												Hoa hồng
											</span>
                                </h3>
                                <div class="col-xs-12">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Thành viên</div>
                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click name_tiepthi"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tiền hoa hồng</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click price_tiep_thi"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Trạng thái</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click status_tiep_thi"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>
                                </div>
                            </div>
                            <div class="row">
                                <h3 style="margin-right: 0px; margin-left: 0px;    font-size: 14px;"
                                    class="row header smaller lighter orange">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-shopping-cart"></i>
												Thông tin booking
											</span>
                                </h3>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Sales</div>
                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click name_sales"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tiề tệ</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click tien_te"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Ngày bắt đầu</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click ngay_bat_dau"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Hạn thanh toán</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click han_thanh_toan"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tình trạng</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click tinh_trang"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Httt</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click httt"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Số người</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click so_nguoi"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Thuế VAT(10%)</div>
                                            <div class="profile-info-value thue_vat">
                                                <!--                                                <label>-->
                                                <!--                                                    <input checked id="thue_vat" name="vat" class="ace ace-switch ace-switch-6 thue_vat" type="checkbox">-->
                                                <!--                                                    <span class="lbl"></span>-->
                                                <!--                                                </label>-->
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Ghi chú</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click ghi_chu"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>


                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Khách hàng</div>

                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click name_khach_hang"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Email</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click email_customer"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Địa chỉ</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click address_customer"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Điện thoại</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click phone_customer"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Fax</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click fax_customer"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Nhóm kh</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click nhom_kh"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Điểm đón</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click diem_don"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Ngày khởi hành</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click ngay_khoi_hanh"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Ngày kết thúc</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click ngay_ket_thuc"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>

                                </div>

                            </div>
                            <div class="row">
                                <h3 style="margin-right: 0px; margin-left: 0px;    font-size: 14px;"
                                    class="row header smaller lighter blue">
                                    <span class="col-sm-8">
												<i class="ace-icon fa fa-plane blue bigger-125"></i>
												Thông tin tour
											</span>
                                </h3>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tên tour</div>
                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click name_tour"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Giá</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click gia_nguoi_lon"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Giá 5-11</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click gia_tre_em_511"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Giá 5</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click gia_tre_em_5"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>


                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tổng cộng</div>

                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click tong_cong"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Thuế VAT 10%</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click vat_thanh_tien"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Đặt cọc</div>

                                            <div class="profile-info-value">
                                                <span class="editable editable-click dat_coc"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Còn lại</div>

                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click con_lai"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>

                                </div>

                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-sm" data-dismiss="modal" id="reset_form_popup">
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div><!-- PAGE CONTENT ENDS -->

<!--        Lịch sử giao dịch-->
        <div id="modal-form-giaodich" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger" id="title_form">Lịch sử giao dịch đơn hàng "<b id="name-detail-code-booking" class="red"></b>"</h4>
                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <div id="show_loading_giao_dich" style="text-align: center">
                                    <img src="<?php echo SITE_NAME.'/view/default/themes/images/loading_1.gif'?>">
                                </div>
                                <div hidden id="show_red_none_giao_dich" style="text-align: center">

                                </div>

                                <div id="show_list_giao_dich" class="col-xs-12">
                                    <div class="widget-box">
                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <div class="dialogs" id="list_giao_dich" style="height: 350px; overflow: scroll">
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 sec</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit. Quisque commodo massa sed
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="John's Avatar"
                                                                 src="assets/images/avatars/avatar.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="blue">38 sec</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">John</a>
                                                            </div>
                                                            <div class="text">Raw denim you probably haven&#39;t heard of
                                                                them jean shorts Austin.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Bob's Avatar" src="assets/images/avatars/user.jpg"/>
                                                        </div>
                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="orange">2 10-10-2017 01:00</span>
                                                            </div>

                                                            <div class="name" style="">
                                                                <a  href="#">Bob</a>
                                                                <span class="label label-info arrowed arrowed-in-right">admin</span>
                                                            </div>
                                                            <div class="text" id="short_text_1">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit. Q
                                                            </div>
                                                            <div hidden id="long_text_1">
                                                                ádfasdfasdfsdaf asldfklh asdfl;h asdkljhf kljsadhf kljasdhf kljjasdhf kljasdhf kljasdhfjklashfjklasdhfjklasdhfjklasdfhjklashfjklasdfhkasdf
                                                            </div>
                                                            <div class="tools">
                                                                <a href="javascript:void(0)" countid="1" data-hide="show" class="btn btn-minier btn-info show_content_full">
                                                                    <i id="icon_show_hide_1" class="icon-only ace-icon fa fa-expand"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Jim's Avatar"
                                                                 src="assets/images/avatars/avatar4.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="grey">3 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Jim</a>
                                                            </div>
                                                            <div class="text">Raw denim you probably haven&#39;t heard of
                                                                them jean shorts Austin.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-eye "></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="Alexa's Avatar"
                                                                 src="assets/images/avatars/avatar1.png"/>
                                                        </div>

                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">4 min</span>
                                                            </div>

                                                            <div class="name">
                                                                <a href="#">Alexa</a>
                                                            </div>
                                                            <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit.
                                                            </div>

                                                            <div class="tools">
                                                                <a href="#" class="btn btn-minier btn-info">
                                                                    <i class="icon-only ace-icon fa fa-share"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form>
                                                    <div class="form-actions" style="margin-top: 0px; margin-bottom: 0px">
                                                        <div class="input-group">
                                                            <textarea class="form-control" placeholder="Type your message here ..."></textarea>
<!--                                                            <textarea placeholder="Type your message here ..." type="text"-->
<!--                                                                   class="form-control" name="message"/>-->
																<span style="vertical-align: top;" class="input-group-btn">
																	<button class="btn btn-sm btn-info no-radius"
                                                                            type="button">
                                                                        <i class="ace-icon fa fa-floppy-o"></i>
                                                                        Lưu
                                                                    </button>
																</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- /.widget-main -->
                                        </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div><!-- PAGE CONTENT ENDS -->

    </div><!-- /.col -->

</div><!-- /.row -->

<style>
    .form-group {
        margin-bottom: 8px;
    }
</style>

<!--<script type=”text/javascript” src=”http://kbeezie.com/jquery13.js”></script>-->
<!--<script src=”http://kbeezie.com/fancybox/jquery.fancybox-1.3.1.pack.js” type=”text/javascript”></script>-->
<!--<link rel=”stylesheet” href=”http://kbeezie.com/fancybox/jquery.fancybox-1.3.1.css” type=”text/css” media=”screen”/>-->
<!--<div style="display: none;">-->
<!--    <a id=”trigger” href=”#popup”>&nbsp;</a>-->
<!--    <div id=”popup” style="width: 250px; height: 400px;">-->
<!--        <p> Write you message here</p>-->
<!--    </div>-->
<!--</div>-->