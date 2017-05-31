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
        Thống kê doanh thu đơn hàng
    </h1>
<style>
    .input-daterange .input-sm{
        height: 34px!important;
    }
</style>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <form action="" method="get">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>Chọn ngày thống kê</label>
                                <div class="input-daterange input-group">
                                    <input type="text" value="30-05-2017" class="input-sm form-control" name="start">
																	<span class="input-group-addon">
																		<i class="fa fa-exchange"></i>
																	</span>

                                    <input type="text" class="input-sm form-control" name="end">

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <label>Trạng thái đơn hàng</label>
                                <div class="form-group">
                                    <?php echo _returnInputSelect('status', '', $trang_thai_don_hang, 'valid', 'Trạng thái ...') ?>
                                    <label style="display: none" class="error-color  error-color-size"
                                           id="error_status">Bạn vui lòng chọn trạng thái đơn hàng</label>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <label>&nbsp;</label>
                                <button type="submit" class="green btn btn-white btn-create btn-hover-white">
                                    Thống kê
                                </button>
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
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tour</th>
                                    <th>Khách hàng</th>
                                    <th>Đơn giá</th>
                                    <th>Số người</th>
                                    <th>Tổng tiền</th>
                                    <th>Chi phí</th>
                                    <th></th>

                                    <th>Action</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php if (count($list) > 0 && _returnCheckAction(16) == 1) { ?>
                                    <?php $dem = 1; ?>
                                    <?php foreach ($list as $row) { ?>
                                        <tr class="row_<?php echo $row->id?>">
                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace click_check_list" name_record="<?php echo $row->name ?>" id="check_<?php echo $dem ?>" name="check_box_action[]"
                                                           value="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"/>
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td style="text-align: center">
                                                <?php echo $dem; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo SITE_NAME ?>/khach-hang/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->name.' - '.$row->code ?></a>
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                if ($row->avatar == '') {
                                                    $link_ava = SITE_NAME . '/view/default/themes/images/no-avatar.png';
                                                } else {
                                                    $link_ava = SITE_NAME . $row->avatar;
                                                }
                                                ?>
                                                <img title="<?php echo $row->name ?>" style="width: 50px"
                                                     src="<?php echo $link_ava ?>"><label
                                                    style="display: none"><?php echo $row->name ?></label>
                                            </td>
                                            <td><?php echo $row->email ?></td>
                                            <td><?php echo $row->phone ?></td>
                                            <td><?php echo $row->mobi ?></td>
                                            <td><?php echo $row->skype ?></td>
                                            <td >
                                                <?php echo $row->address ?>
                                            </td>
                                            <td>
                                                <span hidden><?php echo (int)$row->status ?></span>
                                                <?php if (_returnCheckAction(18) == 1) { ?>
                                                    <label>

                                                        <input <?php if ($row->status) echo 'checked' ?>
                                                            id="checkbox_status_<?php echo $row->id ?>"
                                                            countid="<?php echo $row->id ?>"
                                                            name_record="<?php echo $row->name ?>" table="customer" field="status" action="customer_update"
                                                            class="ace ace-switch ace-switch-7 checkbox_status" type="checkbox">
                                                        <span class="lbl"></span>
                                                    </label>
                                                <?php }else{?>
                                                    <?php if ($row->status == 0) echo '<i  style="font-size: 20px;" class="fa fa-check-square-o "></i>' ?>
                                                    <?php if ($row->status == 1) echo ' <i  style="font-size: 20px;color:green" class="fa fa-check-square-o "></i>' ?>
                                                <?php }?>
                                            </td>
                                            <!--                                        <td>-->
                                            <?php //echo _returnDateFormatConvert($row->created) ?><!--</td>-->

                                            <td>
                                                <div class="hidden-sm hidden-xs action-buttons">

                                                    <?php if (_returnCheckAction(18) == 1) { ?>
                                                        <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name ?>" data-toggle="modal" table="customer" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                           href="#modal-form"
                                                           title="Chi tiết">
                                                            <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                        </a>
                                                        <!--                                                    <a class="" href="#" title="Sửa popup">-->
                                                        <!--                                                        <i class="ace-icon glyphicon glyphicon-edit"></i>-->
                                                        <!--                                                    </a>-->

                                                        <a title="Sửa tab mới" class="green"
                                                           href="<?php echo SITE_NAME ?>/khach-hang/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (_returnCheckAction(19) == 1) { ?>
                                                        <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                           deleteid="<?php echo $row->id ?>"
                                                           name_record_delete="<?php echo $row->name ?>"
                                                           url_delete="<?php echo SITE_NAME ?>/khach-hang/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
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
                                                                <li>
                                                                    <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name ?>" data-toggle="modal" table="customer" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                       href="#modal-form"
                                                                       title="Chi tiết">
                                                                        <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="<?php echo SITE_NAME ?>/khach-hang/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                       class="tooltip-success" data-rel="tooltip"
                                                                       title="Sửa tab mới">
																				<span class="">
																					<i class="ace-icon fa fa-pencil bigger-120"></i>
																				</span>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if (_returnCheckAction(19) == 1) { ?>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       deleteid="<?php echo $row->id ?>"
                                                                       name_record_delete="<?php echo $row->name ?>"
                                                                       url_delete="<?php echo SITE_NAME ?>/nhan-vien/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
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
                            <?php if (_returnCheckAction(18) == 1) { ?>
                                <li>
                                    <a href="#modal-form"  role="button"  data-toggle="modal" class="edit_function">Sửa</a>
                                </li>
                            <?php } ?>
                            <?php if (_returnCheckAction(19) == 1) { ?>
                                <li>
                                    <a class="delete_function"
                                       href="javascript:void()">Xóa</a>
                                </li>
                            <?php } ?>
                            <li class="divider"></li>
                            <?php if (_returnCheckAction(17) == 1) { ?>
                                <li>
                                    <a href="<?php echo SITE_NAME ?>/nhan-vien/them-moi">Thêm</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </form>

        </div>
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