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
        Thêm nhân viên
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">


        <div class="col-sm-3">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Hình ảnh đại diện</h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="avatar" multiple="" type="file" id="id-input-file-3" />
                            </div>
                        </div>
                        <style>
                            .ace-file-multiple .ace-file-container{
                                height: 260px;
                            }
                            .ace-file-multiple .ace-file-container:before
                            {
                                top:60px;
                            }
                            .ace-file-multiple .ace-file-container .ace-file-name:last-child{
                                top:80px;
                            }
                        </style>
                        <label>
                            <input type="checkbox" name="file-format" id="id-file-format" class="ace" checked="checked" />
                            <span class="lbl"> Chỉ cho chép upload hình ảnh</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="widget-box">

                <div class="widget-header">
                    <h4 class="widget-title">Thông tin bắt buộc</h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mã nhân viên <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
											<span class="input-icon width_100">
												<input name="user_code"  type="text" id="user_code" class="width_100" required>
												<i class="ace-icon fa fa-qrcode blue"></i>
                                                <i  id="user_code_error_icon" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff" title=""></i>
                                                <i id="user_code_success_icon" style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="green" data-textcolor="#000000" title=""></i>
											</span>
                                        <label class="error-color  error-color-size" id="user_code_error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Họ tên <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <style>
                                            #form_field_select_3_chosen{
                                                width: 30% !important;
                                            }
                                        </style>
                                        <select name="mr"  class="chosen-select form-control" id="form-field-select-3" data-placeholder="Danh xưng ..." style="display: none;width: 10px">
                                            <option value=""></option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Mrs">Ms</option>

                                        </select>
											<span class="input-icon " style="width: 68%;">
												<input name="name" type="text" id="name_user" class="width_100" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="name_user_error_icon" style="display: none"  class="ace-icon fa fa-times-circle icon-right error-color " data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff" title=""></i>
											</span>
                                        <label class="error-color  error-color-size" id="name_user_error"></label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="space-4"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ngày sinh <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input class="form-control date-picker" id="id-date-picker-1" name="birthday" required type="text" data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
											<span class="input-icon width_100">
												<input name="user_email" type="email" id="form-field-icon-1" class="width_100" required>
												<i class="ace-icon fa fa-envelope blue"></i>
                                                <i style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập email"></i>
                                                <i style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" title="Email hợp lệ"></i>
											</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="space-4"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Địa chỉ <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                      <span class="input-icon width_100">
												<input name="address" type="text" id="form-field-icon-1" class="width_100" required>
												<i class="ace-icon fa fa-map-marker blue"></i>
                                                <i style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tên đăng nhập <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
											<span class="input-icon width_100">
												<input name="user_name" type="text" id="form-field-icon-1" class="width_100" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập tên đăng nhập"></i>
                                                <i style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" title="Tên đăng nhập hợp lệ"></i>
											</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="space-4"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mật khẩu <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                      <span class="input-icon width_100">
												<input name="password" type="password" id="form-field-icon-1" class="width_100" required>
												<i class="ace-icon fa fa-key blue"></i>
                                                <i style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Xác nhận mật khẩu <span style="color: red">*</span></label>
                                <div class="col-sm-9">
											<span class="input-icon width_100">
												<input name="password_confirm" type="password" id="form-field-icon-1" class="width_100" required>
												<i class="ace-icon fa fa-key blue"></i>
                                                <i style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập tên đăng nhập"></i>
                                                <i style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" title="Tên đăng nhập hợp lệ"></i>
											</span>
                                </div>
                            </div>
                        </div>
                                </div>

                        <div class="space-4"></div>

                            <div class="clearfix">
                                <div class=" col-md-12" style="text-align: right">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>

                    </div>
                </div>
            </div>

        </div>
        </form>
        <!-- PAGE CONTENT BEGINS -->

    </div><!-- /.col -->
</div><!-- /.row -->






