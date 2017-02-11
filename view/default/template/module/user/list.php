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
        Danh sách nhân viên
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
                        <?php if (_returnCheckAction(1) == 1) { ?>
                            <a href="#modal-form" role="button" data-toggle="modal" id="create_popup"
                               class="green btn btn-white btn-create btn-hover-white">
                                <i class="ace-icon fa fa-plus bigger-120 "></i>
                                Create popup
                                <i class="ace-icon fa fa-external-link"></i>
                            </a>
                            <a href="<?php echo SITE_NAME ?>/nhan-vien/them-moi"
                               class="btn btn-white  btn-create-new-tab btn-create-new-tab-hover">
                                <i class="ace-icon fa fa-plus bigger-120 "></i>
                                Create new tab
                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
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
                            <th>Admin</th>
                            <th>Status</th>

                            <!--<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1"
                                aria-label="

															Update
														: activate to sort column ascending">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Created
                            </th>-->
                            <th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1"
                                aria-label="

															Update
														: activate to sort column ascending">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Update
                            </th>
                            <th>Action</th>

                        </tr>
                        </thead>

                            <tbody>
                            <?php if (count($list) > 0 && _returnCheckAction(5) == 1) { ?>
                                <?php $dem = 1; ?>
                                <?php foreach ($list as $row) { ?>
                                    <tr>
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
                                            <a href="<?php echo SITE_NAME ?>/nhan-vien/chi-tiet?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->name ?></a>
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
                                        <td><?php echo $row->user_email ?></td>
                                        <td><?php echo $row->phone ?></td>
                                        <td >
                                            <span hidden><?php echo (int)$row->user_role ?></span>
                                            <?php if ($row->user_role == 0) echo '<i id="user-md-active-'.$row->id.'" style="font-size: 20px;" class="fa fa-user-md hidden-xs"></i>' ?>
                                            <?php if ($row->user_role == 1) echo ' <i id="user-md-active-'.$row->id.'" style="font-size: 20px;" class="fa fa-user-md active-user-role hidden-xs"></i>' ?>
                                            <label>
                                                <input <?php if ($row->user_role) echo 'checked' ?>
                                                    id="checkbox_user_role_<?php echo $row->id ?>"
                                                    countid="<?php echo $row->id ?>"
                                                    name_record="<?php echo $row->name ?>" table="user" field="user_role"
                                                    class=" ace ace-switch ace-switch-7 checkbox_user_role" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <span hidden><?php echo (int)$row->status ?></span>
                                            <label>
                                                <input <?php if ($row->status) echo 'checked' ?>
                                                    id="checkbox_status_<?php echo $row->id ?>"
                                                    countid="<?php echo $row->id ?>"
                                                    name_record="<?php echo $row->name ?>" table="user" field="status"
                                                    class="ace ace-switch ace-switch-7 checkbox_status" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <!--                                        <td>-->
                                        <?php //echo _returnDateFormatConvert($row->created) ?><!--</td>-->
                                        <td><?php echo _returnDateFormatConvert($row->updated) ?></td>

                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name ?>" data-toggle="modal" table="user" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                   href="#modal-form"
                                                   title="Chi tiết">
                                                    <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                </a>
                                                <?php if (_returnCheckAction(2) == 1) { ?>
<!--                                                    <a class="" href="#" title="Sửa popup">-->
<!--                                                        <i class="ace-icon glyphicon glyphicon-edit"></i>-->
<!--                                                    </a>-->

                                                    <a title="Sửa tab mới" class="green"
                                                       href="<?php echo SITE_NAME ?>/nhan-vien/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if (_returnCheckAction(3) == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row->name ?>"
                                                       url_delete="<?php echo SITE_NAME ?>/nhan-vien/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if (_returnCheckAction(4) == 1) { ?>
                                                    <a title="Phân quyền" class="blue"
                                                       href="<?php echo SITE_NAME ?>/nhan-vien/phan-quyen?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-cogs bigger-130"></i>
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
                                                        <li>
                                                            <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name ?>" data-toggle="modal" table="user" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                               href="#modal-form"
                                                               title="Chi tiết">
                                                                <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                            </a>
                                                        </li>
                                                        <?php if (_returnCheckAction(2) == 1) { ?>
                                                            <li>
                                                                <a href="#" class="tooltip-success" data-rel="tooltip"
                                                                   title="Sửa popup">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo SITE_NAME ?>/nhan-vien/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   class="tooltip-success" data-rel="tooltip"
                                                                   title="Sửa tab mới">
																				<span class="">
																					<i class="ace-icon glyphicon glyphicon-edit  bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if (_returnCheckAction(3) == 1) { ?>
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
                                                        <?php if (_returnCheckAction(4) == 1) { ?>
                                                            <li>
                                                                <a href="#" class="tooltip-success " data-rel="tooltip"
                                                                   title="Phân quyền">
																				<span class="blue">
																					<i class="ace-icon fa fa-cogs bigger-120"></i>
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
                        <h4 class="blue bigger" id="title_form">Tạo mới nhân viên</h4>

                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <div id="preview">
                                            <img id="show_img_upload" class="img-responsive" no-avatar="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg"
                                                 src="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg">
                                        </div>
                                        <input accept="image/*" name="avatar" type="file" id="id-input-file-2" onchange="loadFile(event)" />
                                    </div>
                                </div>
                                <input class="valid" hidden name="check_edit" id="input_check_edit" value="">
                                <input class="valid" hidden name="id_edit" id="input_id_edit" value="">
                                <div class="col-xs-12 col-sm-8">
                                    <div class="form-group" style="float: left; width: 100%">


                                        <div style="float: left;width: 66%" >
                                            <label for="form-field-select-3">Mã nhân viên <span style="color: red">*</span></label>
                                           <span class="input-icon width_100">
												<input readonly name="user_code" type="text" id="input_user_code"
                                                       class="width_100" required>
												<i class="ace-icon fa fa-qrcode blue"></i>
                                                <i id="user_code_error_icon" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                   data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff"
                                                   title=""></i>
                                                <i id="user_code_success_icon" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                   data-placement="bottom" data-backcolor="green"
                                                   data-textcolor="#000000" title="Mã nhân viên hợp lệ"></i>
											</span>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_user_code">Bạn vui lòng nhập mã nhân viên</label>
                                        </div>
                                        <div style="float: left;width: 33%; text-align: center" >
                                            <label for="form-field-select-3">Admin hệ thống</label>
                                            <label>
                                                <input id="input_user_role" name="user_role" class="ace ace-switch ace-switch-6" type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
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
                                            <select name="mr" class="chosen-select form-control mr_user"
                                                    id="form-field-select-3" data-placeholder="Danh xưng ..."
                                                    style="display: none;width: 10px">
                                                <option value=""></option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Ms">Ms</option>
                                            </select>
                                            </div>
                                            <div style="float: left;width: 66%" >
											<span class="input-icon " style="width: 100%" >
												<input name="full_name" type="text" id="input_full_name"
                                                       class="width_100" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="name_user_error_icon" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                   data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff"
                                                   title=""></i>
											</span>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_full_name">Bạn vui lòng nhập tên nhân viên</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="form-group" style="float: left; width: 100%">
                                        <label for="form-field-select-3">Ngày sinh <span
                                                style="color: red">*</span></label>
                                        <div class="input-group" style="">
                                            <input class="form-control date-picker width_100" id="input_birthday"
                                                   name="birthday" required type="text" data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                        </div>
                                        <label style="display: none" class="error-color  error-color-size"
                                               id="error_birthday">Bạn vui lòng chọn ngày sinh</label>
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
                                            <div>
                                           <span class="input-icon width_100">
												<input readonly name="email_user" type="email" id="input_email_user"
                                                       class="width_100" required>
												<i class="ace-icon fa fa-envelope blue"></i>
                                                <i id="email_user_error_icon" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Bạn vui lòng kiểm tra lại email"></i>
                                                <i id="email_user_success_icon" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   title="Email hợp lệ"></i>
											</span>
                                                <label style="display: none" class="error-color  error-color-size"
                                                       id="error_email_user">Bạn vui lòng nhập email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="form-field-select-3">Địa chỉ <span
                                                    style="color: red">*</span></label>
                                            <div>
                                            <span class="input-icon width_100">
												<input name="address_user" type="text" id="input_address_user" class="width_100" required>
												<i class="ace-icon fa fa-map-marker blue"></i>
                                                <i id="error_icon_address_user" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                                <label  style="display: none" class="error-color  error-color-size" id="error_address_user">Bạn vui lòng nhập địa chỉ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="float: left; width: 100%">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="form-field-select-3">Tên đăng nhập <span
                                                    style="color: red">*</span></label>
                                            <div>
                                          <span class="input-icon width_100">
												<input readonly name="user_name" type="text" id="input_user_name" class="width_100" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="error_icon_user_name" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng kiểm tra tên đăng nhập"></i>
                                                <i id="success_icon_user_name" style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" title="Tên đăng nhập hợp lệ"></i>
											</span>
                                                <label  style="display: none" class="error-color  error-color-size" id="error_user_name">Bạn vui lòng điền tên đăng nhập</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="form-field-select-3">Số điện thoại <span
                                                    style="color: red">*</span></label>
                                            <div>
                                          <span class="input-icon width_100">
												<input name="user_phone" type="text" id="input_user_phone" class="width_100" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="error_icon_user_phone" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng điền số điện thoại"></i>

											</span>
                                                <label  style="display: none" class="error-color  error-color-size" id="error_user_phone">Bạn vui lòng điền số điện thoại</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="float: left; width: 100%" id="hidden_edit_pass">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="form-field-select-3">Mật khẩu <span
                                                    style="color: red">*</span></label>
                                            <div>
                                         <span class="input-icon width_100">
												<input readonly name="password" type="password" id="input_password" class="width_100" required>
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="error_icon_user_pass" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                                <label  style="display: none" class="error-color  error-color-size" id="error_password">Bạn vui lòng nhập mật khẩu</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="form-field-select-3">Xác nhận mật khẩu <span
                                                    style="color: red">*</span></label>
                                            <div>
                                         <span class="input-icon width_100">
											<span class="input-icon width_100">
												<input readonly name="password_confirm" type="password" id="input_password_confirm" class="width_100" required>
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="error_icon_user_pass_con" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title=""></i>
											</span>
                                    <label  style="display: none" class="error-color  error-color-size" id="error_password_confirm">Bạn vui lòng xác nhận mật khẩu</label>
                                            </div>
                                        </div>
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
