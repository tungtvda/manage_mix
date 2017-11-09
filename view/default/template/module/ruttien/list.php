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
        <?php echo $title_module?>
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                        <?php if (_returnCheckAction(42) == 1) { ?>
                            <a href="#modal-form" role="button" data-toggle="modal" id="create_popup" data-type="az"
                               class="green btn btn-white btn-create btn-hover-white">
                                <i class="ace-icon fa fa-plus bigger-120 "></i>
                               Rút tiền
                                <i class="ace-icon fa fa-external-link"></i>
                            </a>
<!--                            <a href="--><?php //echo SITE_NAME ?><!--/nhan-vien/them-moi"-->
<!--                               class="btn btn-white  btn-create-new-tab btn-create-new-tab-hover">-->
<!--                                <i class="ace-icon fa fa-plus bigger-120 "></i>-->
<!--                                Create new tab-->
<!--                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>-->
<!--                            </a>-->
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
                                <?php if (_returnCheckAction(44) == 1) { ?>
                                    <li>
                                        <a class="delete_function"
                                           href="javascript:void()">Xóa</a>
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
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace"/>
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>#</th>
                            <th>Họ tên</th>
                            <th>Tiền yêu cầu</th>
                            <th>Trạng thái</th>
                            <th>Xác nhận</th>
                            <th>Ghi chú</th>
                            <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1"
                                aria-label="

															Update
														: activate to sort column ascending">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Ngày gửi
                            </th>
                            <th>Action</th>

                        </tr>
                        </thead>

                            <tbody>
                            <?php if (count($list) > 0 && _returnCheckAction(37) == 1) { ?>
                                <?php $dem = 1; ?>
                                <?php foreach ($list as $row) { ?>
                                    <tr class="row_<?php echo $row->id?>">
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace click_check_list" name_record="<?php echo $row->name_user ?>" id="check_<?php echo $dem ?>" name="check_box_action[]"
                                                       value="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $dem; ?>
                                        </td>
                                        <td style="position: relative">
                                            <p>
                                                <a   href="<?php echo SITE_NAME ?>/thanh-vien/sua?id=<?php echo _return_mc_encrypt($row->user_tiep_thi_id, ENCRYPTION_KEY); ?>"><?php echo $row->name_user.' - '.$row->user_code ?></a>
                                                <a data-name="<?php echo $row->name_user ?> - <?php echo $row->user_code?>" data-id="<?php echo $row->id?>" role="button" data-toggle="modal"   class="show_info" href="#modal-form-info"><i  id="icon_show_<?php echo $row->id?>" class="fa fa-arrows-alt icon_show"></i></a>
                                            </p>
                                            <div style="display: none" id="info_user_<?php echo $row->id?>">
                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Họ tên</div>
                                                        <div class="profile-info-value form-group">
                                                            <span class="editable editable-click hidden_edit"><?php echo $row->name_user?> - <?php echo $row->user_code?></span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Email</div>
                                                        <div class="profile-info-value">
                                                            <span class="editable editable-click"><?php echo $row->user_email?></span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Địa chỉ</div>
                                                        <div class="profile-info-value">
                                                            <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                            <span class="editable editable-click"><?php echo $row->address?></span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Điện thoại</div>
                                                        <div class="profile-info-value">
                                                            <span class="editable editable-click"><?php echo $row->phone?></span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Di động</div>

                                                        <div class="profile-info-value">
                                                            <span class="editable editable-click"><?php echo $row->mobi?></span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name">Số tài khoản</div>
                                                        <div class="profile-info-value">
                                                            <?php echo $row->account_number_bank?>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Ngân hàng</div>
                                                        <div class="profile-info-value">
                                                           <span style="font-style: italic;color: #ff892a; font-size: 12px">  <?php echo $row->bank?></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Chi nhánh</div>
                                                        <div class="profile-info-value">
                                                            <span style="font-style: italic;color: #ff892a; font-size: 12px">  <?php echo $row->open_bank?></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <?php
                                            if($row->price!=''&&$row->price!=null){
                                                echo '<b class="red">'.number_format((int)$row->price,0,",",".").' vnđ </b>';
                                            }else{
                                                echo '<b class="red">0 vnđ</b>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <span hidden><?php echo (int)$row->status ?></span>
                                    <?php if (_returnCheckAction(39) == 1) { ?>
                                            <label>

                                                <input disabled <?php if ($row->status) echo 'checked' ?>
                                                    id="checkbox_status_<?php echo $row->id ?>" class="ace ace-switch ace-switch-7" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
                                    <?php }else{?>
                                        <?php if ($row->status == 0) echo '<i  style="font-size: 20px;" class="fa fa-check-square-o "></i>' ?>
                                        <?php if ($row->status == 1) echo ' <i  style="font-size: 20px;color:green" class="fa fa-check-square-o "></i>' ?>
                                        <?php }?>
                                        </td>
                                        <td>
                                            <a class="btn_confirm" href="#modal-form" data-id="<?php echo $row->id ?>" data-code="<?php echo $row->code ?>" data-name="<?php echo $row->name_user?> - <?php echo $row->user_code?>" role="button" data-toggle="modal"><i class="fa fa-check-square-o" aria-hidden="true"></i> Xác nhận</a>
                                            <div hidden id="cmt_yeu_cau_<?php echo $row->id ?>">
                                                <?php echo $row->yeu_cau ?>
                                            </div>
                                            <div hidden id="date_send_<?php echo $row->id ?>">
                                                <?php echo date('d-m-Y',strtotime($row->date_send)) ?>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td><?php echo _returnDateFormatConvert($row->date_send) ?></td>

                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">

                                                <?php if (_returnCheckAction(39) == 1) { ?>
                                                    <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name_user ?>" data-toggle="modal" table="user" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                       href="#modal-form"
                                                       title="Chi tiết">
                                                        <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if (_returnCheckAction(40) == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row->name ?>"
                                                       url_delete="<?php echo SITE_NAME ?>/nhan-vien/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
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

                                                        <?php if (_returnCheckAction(39) == 1) { ?>
                                                            <li>
                                                                <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name ?>" data-toggle="modal" table="user" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   href="#modal-form"
                                                                   title="Chi tiết">
                                                                    <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                                </a>
                                                            </li>
<!--                                                            <li>-->
<!--                                                                <a  href="--><?php //echo SITE_NAME ?><!--/nhan-vien/sua?id=--><?php //echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?><!--"-->
<!--                                                                   class="tooltip-success" data-rel="tooltip"-->
<!--                                                                   title="Sửa tab mới">-->
<!--																				<span class="green">-->
<!--																					<i class="ace-icon fa fa-pencil bigger-120"></i>-->
<!--																				</span>-->
<!--                                                                </a>-->
<!--                                                            </li>-->
                                                        <?php } ?>
                                                        <?php if (_returnCheckAction(40) == 1) { ?>
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
                        <?php if (_returnCheckAction(2) == 1) { ?>
                            <li>
                                <a href="#modal-form"  role="button"  data-toggle="modal" class="edit_function">Sửa</a>
                            </li>
                        <?php } ?>
                        <?php if (_returnCheckAction(3) == 1) { ?>
                            <li>
                                <a class="delete_function"
                                   href="javascript:void()">Xóa</a>
                            </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <?php if (_returnCheckAction(1) == 1) { ?>
                            <li>
                                <a href="<?php echo SITE_NAME ?>/nhan-vien/them-moi">Thêm</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <style>
            .modal-backdrop{
                height: 1000px !important;
            }
        </style>
        <div  id="modal-form" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger" id="title_form_confirm">Xác nhận rút tiền "<span id="info_user"></span>"</h4>

                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Tiền yêu cầu <span style="color: red">*</span></div>
                                    <div class="profile-info-value">
                                                  <span class="input-icon width_100" style="">
                                                    <input disabled name="price" type="text" id="input_price" value="" class="width_100 ">
                                                    <i class="ace-icon fa fa-usd blue"></i>
                                                </span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Tiền xác nhận <span style="color: red">*</span></div>
                                    <div class="profile-info-value">
                                                  <span class="input-icon width_100" style="">
                                                    <input name="price_confirm" type="number" id="input_price_confirm" value="" class="width_100 ">
                                                    <i class="ace-icon fa fa-usd blue"></i>
                                                </span>
                                        <label style="display: none" class="error-color  error-color-size" id="error_price_confirm">Bạn vui lòng xác nhận tiền thanh toán</label>                                                <label style="display: none" class="  error-color-size" id="price_format_cost"></label>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Ngày yêu cầu </div>
                                    <div class="profile-info-value">
                                        <div class="input-group" style="">
                                            <input value=""
                                                   class="form-control width_100 " disabled
                                                   id="input_send"
                                                   type="text">
																	<span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Ngày thanh toán <span style="color: red">*</span></div>
                                    <div class="profile-info-value">
                                        <div class="input-group" style="">
                                            <input value=""
                                                   class="form-control date-picker width_100 "
                                                   id="input_date_confirm" name="date_confirm"
                                                   type="text" data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                            <input value=""
                                                   class="form-control  width_100 time_confirm"
                                                   id="timepicker1" name="time_confirm"
                                                   type="text" >
																	<span class="input-group-addon date_icon">
																		<i class="fa fa-clock-o bigger-110"></i>
																	</span>
                                        </div>
                                        <label hidden
                                               class="error-color  error-color-size"
                                               id="error_created">Bạn vui lòng chọn ngày giao dịch</label>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Yêu cầu</div>
                                    <div class="profile-info-value">
                                        <textarea disabled id="input_yeu_cau" style="width: 100%" rows="5">sdfsdfsdfsdfsdfsdf askldfhlksadjkhfjkl asdlkjfh klasjdfh jklasdfhjklasdfhjklasdfh jklasđfhkljádfhjkládfhjkládfhjkládfh kljasdh kjasdfhuiashfjkasdghfjkhasgdfasdfjk asgfjkgfasdhfasdjkhgfjkasdgh jkasdgfashdfjkasdgh fjkasgdhf</textarea>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Mô tả</div>
                                    <div class="profile-info-value">
                                        <textarea id="input_yeu_cau" style="width: 100%" name="yeu_cau" rows="5"></textarea>
                                    </div>
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

<div id="modal-form-info" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger" id="title_form_detail"></h4>
            </div>


            <div id="content_form_detail" class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="reset" class="btn btn-sm" data-dismiss="modal" id="reset_form_popup">
                    <i class="ace-icon fa fa-times"></i>
                    Close
                </button>
            </div>


        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->

<style>
    .bootstrap-timepicker-widget.dropdown-menu{
        z-index: 11111111111;
    }
</style>