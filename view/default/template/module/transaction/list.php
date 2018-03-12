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
        Giao dịch khách hàng
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">

            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                        <?php if (_returnCheckAction(17) == 1) { ?>
                            <a href="#modal-form" role="button" data-toggle="modal" id="create_popup1"
                               class="green btn btn-white btn-create btn-hover-white">
                                <i class="ace-icon fa fa-plus bigger-120 "></i>
                                Create
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
                                <th>Avatar</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Created</th>
                                <th>Lịch sử giao dịch</th>
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
                                                <input type="checkbox" class="ace click_check_list" name_record="<?php echo $row->customer->name ?>" id="check_<?php echo $dem ?>" name="check_box_action[]"
                                                       value="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $dem; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITE_NAME ?>/khach-hang/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->customer->name.' - '.$row->customer->code ?></a>
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                            $row1 = $row->customer;
                                            if ($row1->avatar == '') {
                                                $link_ava = SITE_NAME . '/view/default/themes/images/no-avatar.png';
                                            } else {
                                                $link_ava = SITE_NAME . $row1->avatar;
                                            }
                                            ?>
                                            <img title="<?php echo $row1->name ?>" style="width: 50px"
                                                 src="<?php echo $link_ava ?>"><label
                                                    style="display: none"><?php echo $row1->name ?></label>
                                        </td>
                                        <td><?php echo $row1->email ?></td>
                                        <td><?php echo $row1->phone ?></td>
                                        <td><?php echo $row1->mobi ?></td>
                                        <td >
                                            <?php echo $row1->address ?>
                                        </td>

                                                                                <td>
                                        <?php echo _returnDateFormatConvert($row->created_at) ?></td>
                                        <td>

                                            <a title="Lịch sử giao dịch" class="red view_lich_su_giao_dich_trans"
                                               href="#modal-form-giaodich" role="button" data-toggle="modal"
                                               data-code="<?php echo $row1->code ?>"
                                               data-customer="<?php echo $row1->id ?>"
                                               data-id="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                            >
                                                <i class="ace-icon fa fa-sliders bigger-130"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">

                                                <?php if (_returnCheckAction(19) == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row1->name ?>"
                                                       url_delete="<?php echo SITE_NAME ?>/giao-dich-khach-hang/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
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


                                                        <?php if (_returnCheckAction(19) == 1) { ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   deleteid="<?php echo $row->id ?>"
                                                                   name_record_delete="<?php echo $row->customer->name ?>"
                                                                   url_delete="<?php echo SITE_NAME ?>/giao-dich-khach-hang/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
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
                        <h4 class="blue bigger" id="title_form">Create new transaction</h4>

                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#createTransaction">Using user in system</a></li>
                        <li><a data-toggle="tab" href="#createUser">Create new user</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="createTransaction" class="tab-pane fade in active">
                            <form id="submit_form_trans" method="post" action="">

                                <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> User <span
                                                    style="color: red">*</span></div>
                                        <div class="profile-info-value">
                                            <select name="user_trans" class=" form-control valid">
                                                <?php foreach ($customerList as $user) {?>
                                                  <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>;
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Ngày giao dịch <span
                                                    style="color: red">*</span></div>
                                        <div class="profile-info-value">
                                            <div class="input-group" style="">
                                                <input value=""
                                                       class="form-control date-picker width_100 "
                                                       id="input_created_trans" name="created_trans"
                                                       type="text" data-date-format="dd-mm-yyyy">
                                                <span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                                <input value=""
                                                       class="form-control  width_100 time_trans"
                                                       id="timepicker2" name="time_trans"
                                                       type="text" >
                                                <span class="input-group-addon date_icon">
																		<i class="fa fa-clock-o bigger-110"></i>
																	</span>
                                            </div>
                                            <label hidden
                                                   class="error-color  error-color-size"
                                                   id="error_created_trans">Bạn vui lòng chọn ngày giao dịch</label>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Mô tả <span
                                                    style="color: red">*</span></div>
                                        <div class="profile-info-value">
                                                            <textarea id="input_content_trans" class="form-control" name="content_trans"
                                                                      placeholder="Bạn hãy nhập nội dung giao dịch ..."></textarea>
                                            <label hidden
                                                   class="error-color  error-color-size"
                                                   id="error_content_trans">Bạn vui lòng nhập
                                                nội dung giao dịch</label>
<!--                                            <p hidden id="show_mess_content_trans" class="red">Bạn vui lòng nhập-->
<!--                                                nội dung giao dịch</p>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-sm btn-primary" id="submit_form_action_trans" type="button">
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
                        <div id="createUser" class="tab-pane fade in">
                            <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                                <div class="modal-body">
                                    <p style="font-size: 17px;font-weight: bold">User Info</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <div id="preview">
                                                    <img id="show_img_upload" class="img-responsive" no-avatar="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg"
                                                         src="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg">
                                                </div>
                                                <input class="valid" accept="image/*" name="avatar" type="file" id="id-input-file-2" onchange="loadFile(event)" />
                                            </div>
                                        </div>
                                        <input class="valid" hidden name="check_edit" id="input_check_edit" value="">
                                        <input class="valid" hidden name="id_edit" id="input_id_edit" value="">
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-group" style="float: left; width: 100%">
                                                <div >
                                                    <label for="form-field-select-3">Mã khách hàng <span style="color: red">*</span></label>
                                                    <?php echo _returnInput('code', '', '', 'qrcode', '', 'Bạn vui lòng nhập mã khách hàng','') ?>
                                                </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="form-group" style="float: left; width: 100%">
                                                <label for="form-field-select-3">Họ tên <span
                                                            style="color: red">*</span></label>
                                                <div>
                                                    <style>
                                                        .chosen-single{
                                                            width: 100% !important;
                                                            border: 1px solid #d5d5d5 !important;
                                                            height: 34px !important;
                                                        }
                                                        #form_field_select_3_chosen{
                                                            width: 96% !important;

                                                        }
                                                    </style>
                                                    <div style="float: left;width: 33%;" >
                                                        <select name="mr" class="chosen-select form-control mr_user valid"
                                                                id="form-field-select-3" data-placeholder="Danh xưng ..."
                                                                style="display: none;width: 10px">
                                                            <option value=""></option>
                                                            <option value="Mr">Mr</option>
                                                            <option value="Mrs">Mrs</option>
                                                            <option value="Ms">Ms</option>
                                                        </select>
                                                    </div>
                                                    <div style="float: left;width: 66%" >
                                                        <?php echo _returnInput('name', '', '', 'users', '', 'Bạn vui lòng nhập tên khách hàng','width: 100%') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="form-group" style="float: left; width: 100%">
                                                <label for="form-field-select-3">Ngày sinh </label>
                                                <?php echo _returnInputDate('birthday', '', 'valid', '', '','')?>
                                            </div>
                                            <div class="space-4"></div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="float: left; width: 100%">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Email <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('email', '', '', 'envelope', '', 'Bạn vui lòng kiểm tra email','') ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Địa chỉ <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('address', '', '', 'map-marker', '', 'Bạn vui lòng kiểm tra email','') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="float: left; width: 100%">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Điện thoại <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('phone', '', '', 'phone', '', 'Bạn vui lòng kiểm tra số điện thoại','') ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Di động <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('mobi', '', '', 'mobile', '', 'Bạn vui lòng kiểm tra số di động','') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: 17px;font-weight: bold">Transaction Info</p>
                                    <div class="profile-user-info profile-user-info-striped" style="width: 100%;">

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Ngày giao dịch <span
                                                        style="color: red">*</span></div>
                                            <div class="profile-info-value">
                                                <div class="input-group" style="">
                                                    <input value=""
                                                           class="form-control date-picker width_100 "
                                                           id="input_created" name="created" required
                                                           type="text" data-date-format="dd-mm-yyyy">
                                                    <span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                                    <input value=""
                                                           class="form-control  width_100 time_giaodich"
                                                           id="timepicker1" name="time"
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
                                            <div class="profile-info-name"> Mô tả <span
                                                        style="color: red">*</span></div>
                                            <div class="profile-info-value">
                                                            <textarea id="input_content" class="form-control" name="content"
                                                                      placeholder="Bạn hãy nhập nội dung giao dịch ..."></textarea>
                                                <label hidden
                                                       class="error-color  error-color-size"
                                                       id="error_content">Bạn vui lòng nhập
                                                    nội dung giao dịch</label>
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

<!--        Lịch sử giao dịch-->
<div id="modal-form-giaodich" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger" id="title_form">Lịch sử giao dịch khách hàng "<b
                            id="name-detail-code-booking" class="red"></b>"</h4>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div id="show_loading_giao_dich" style="text-align: center">
                        <img src="<?php echo SITE_NAME . '/view/default/themes/images/loading_1.gif' ?>">
                    </div>
                    <div hidden id="show_red_none_giao_dich" style="text-align: center">
                    </div>
                    <div id="show_list_giao_dich" class="col-xs-12">
                        <div class="widget-box">
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <div id="back_to_top_giao_dich">
                                    </div>
                                    <div class="dialogs" id="list_giao_dich"
                                         style="height: 350px; overflow: scroll">
                                    </div>

                                    <form>
                                        <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngày giao dịch <span
                                                            style="color: red">*</span></div>
                                                <div class="profile-info-value">
                                                    <div class="input-group" style="">
                                                        <input value=""
                                                               class="form-control date-picker width_100 "
                                                               id="created_giaodich" name="created"
                                                               type="text" data-date-format="dd-mm-yyyy">
                                                        <span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                                        <input value=""
                                                               class="form-control  width_100 time_giaodich"
                                                               id="timepicker1" name="time"
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
                                                <div class="profile-info-name"> Mô tả <span
                                                            style="color: red">*</span></div>
                                                <div class="profile-info-value">
                                                            <textarea id="content_giaodich" class="form-control"
                                                                      placeholder="Bạn hãy nhập nội dung giao dịch ..."></textarea>
                                                    <p hidden id="show_mess_content" class="red">Bạn vui lòng nhập
                                                        nội dung giao dịch</p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget-box -->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" id="save_giao_dich" data-id="" data-code="" data-customer=""
                        type="button">
                    <i class="ace-icon fa fa-check"></i>
                    Save
                </button>
                <button style="display: none" class="btn btn-sm btn-primary" id="show_loading_btn"
                        type="button">
                    Loding...
                </button>
                <button type="reset" class="btn btn-sm" data-dismiss="modal" id="reset_form_popup">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>
            </div>


        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->