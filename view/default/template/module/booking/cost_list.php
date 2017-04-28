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
       Danh sách chi phí cho đơn hàng "<?php echo $code_booking?>"
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="clearfix">
                  Chi tiết đơn hàng
                </div>

                <div class="hr hr-18 dotted hr-double"></div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                        <?php if (_returnCheckAction(21) == 1) { ?>
                            <a href="#modal-form" role="button" data-toggle="modal" id="create_popup"
                               class="green btn btn-white btn-create btn-hover-white">
                                <i class="ace-icon fa fa-plus bigger-120 "></i>
                                Create popup
                                <i class="ace-icon fa fa-external-link"></i>
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
                                        <a href="<?php echo SITE_NAME.'/'.$action_link ?>/dat-tour">Đặt tour</a>
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
                                <th>Sales</th>
                                <th>Người tạo</th>
                                <th>Xác nhận</th>
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
                                            <a href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->code_booking ?></a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->name_tour ?></a>
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
                                        <td><?php
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
                                        <td>
                                            <?php
                                            $data_sales = user_getById($row->user_id);
                                            if (count($data_sales) > 0) {
                                                echo '<a href="' . SITE_NAME . '/nhan-vien/sua?id=' . _return_mc_encrypt($data_sales[0]->id, ENCRYPTION_KEY) . '">' . $data_sales[0]->name . '</a>';
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            $data_created_by = user_getById($row->created_by);
                                            if (count($data_created_by) > 0) {
                                                echo '<a href="' . SITE_NAME . '/nhan-vien/sua?id=' . _return_mc_encrypt($data_created_by[0]->id, ENCRYPTION_KEY) . '">' . $data_created_by[0]->name . '</a>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <span hidden><?php echo (int)$row->confirm_admin ?></span>
                                            <?php if ($row->confirm_admin > 0) { ?>
                                                <?php
                                                $data_user_confirm=user_getById($row->confirm_admin);
                                                $name_user_confirm='';
                                                if(count($data_user_confirm)>0){
                                                    $name_user_confirm=$data_user_confirm[0]->name;
                                                }
                                                ?>
                                                <label title="<?php echo $name_user_confirm ?>">
                                                    <input disabled checked name="switch-field-1" class="ace ace-switch ace-switch-3" type="checkbox">
                                                    <span class="lbl"></span>
                                                </label>
                                            <?php } else { ?>
                                                <label title="Chưa được xác nhận">
                                                    <input  name="switch-field-1"
                                                            class="ace ace-switch ace-switch-3 <?php if($_SESSION['user_role']==1){?> confirm_booking_list<?php }?>"
                                                            <?php if($_SESSION['user_role']==1){?>
                                                            count_id="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY)  ?>"
                                                                id_filed="<?php echo $row->id  ?>"
                                                            code="<?php echo $row->code_booking ?>"
                                                                id="confirm_booking_<?php echo $row->id ?>"
                                                            <?php }?>
                                                            type="checkbox">

                                                    <span class="lbl"></span>
                                                </label>

                                            <?php } ?>
                                        </td>
                                        <!--                                        <td>-->
                                        <?php //echo _returnDateFormatConvert($row->created) ?><!--</td>-->

                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">

                                                <?php if (_returnCheckAction(18) == 1) { ?>
                                                    <a title="Danh sách chi phí" class="red"
                                                       href="<?php echo SITE_NAME.'/'.$action_link ?>/chi-phi?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-usd bigger-130"></i>
                                                    </a>
                                                <?php } ?>
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
                                                       href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($_SESSION['user_role'] == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row->code_booking ?>"
                                                       url_delete="<?php echo SITE_NAME.'/'.$action_link ?>/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
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

                                                        <?php if (_returnCheckAction(18) == 1) { ?>
                                                            <li  class="red">
                                                                <a href="<?php echo SITE_NAME.'/'.$action_link ?>/chi-phi?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   class="tooltip-success" data-rel="tooltip"
                                                                   title="Danh sách chi phí">
																				<span class="">
																					<i class="ace-icon fa fa-usd bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
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
                                                                <a href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
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
                                                                   url_delete="<?php echo SITE_NAME.'/'.$action_link ?>/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
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
                                <a href="<?php echo SITE_NAME.'/'.$action_link ?>/them-moi">Đặt tour</a>
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
                    width: 40%;
                    margin: 30px auto;
                }
            }

        </style>
        <div id="modal-form" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger" id="title_form">Thêm chi phí</h4>
                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tên chi phí</div>
                                            <div class="profile-info-value">
                                                <?php echo _returnInput('name', '', '', 'qrcode', '', 'Bạn vui lòng nhập tên chi phí','') ?>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tiề tệ</div>
                                            <div class="profile-info-value">
                                                <?php echo _returnInput('price', '', '', 'usd', '', 'Bạn vui lòng nhập chi phí','') ?>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Mô tả</div>
                                            <div class="profile-info-value">
                                                <textarea style="width: 100%" name="description"  rows="8"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>


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