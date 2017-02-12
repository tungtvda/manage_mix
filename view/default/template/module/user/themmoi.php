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
        <?php echo $tieude?>
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
                <input class="valid" hidden name="check_edit" id="input_check_edit" value="<?php echo $action_name ?>">
                <input class="valid" hidden name="id_edit" id="input_id_edit" value="<?php echo $id ?>">
                <div class="widget-body">
                    <div class="widget-main">
                        <?php if($action==1){?>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input accept="image/*" name="avatar" class="valid" multiple="" type="file" id="id-input-file-3" />
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
                                <input type="checkbox"  name="file-format" id="id-file-format" class="ace valid" checked="checked" />
                                <span class="lbl"> Chỉ cho chép upload hình ảnh</span>
                            </label>
                         <?php }?>
                        <?php if($action==2){?>
                            <div class="form-group">
                                <div id="preview">
                                    <img id="show_img_upload" class="img-responsive" no-avatar="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg"
                                         src="<?php echo $avatar ?>">
                                </div>
                                <input accept="image/*" name="avatar" type="file" id="id-input-file-2" onchange="loadFile(event)" />
                            </div>
                        <?php }?>

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
											<span style="width: 60%" class="input-icon width_100">
												<input <?php echo $readonly?>  name="user_code"  type="text" id="input_user_code" class="width_100 <?php echo $valid_user_code?>" required value="<?php echo $user_code?>">
												<i class="ace-icon fa fa-qrcode blue"></i>
                                                <i  id="user_code_error_icon" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff" title=""></i>
                                                <i id="user_code_success_icon" style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="green" data-textcolor="#000000" title="Mã nhân viên hợp lệ"></i>
											</span>
                                        <label class="inline">
                                            <input <?php echo $user_role?> name="user_role" type="checkbox" class="ace input-lg">
                                            <span class="lbl"> Admin hệ thống</span>
                                        </label>
<!--                                        <label class="" >-->
<!--                                            <input name="user_role" type="checkbox" class="ace input-lg">-->
<!--                                            <span class="lbl bigger-120" style="font-size: 14px !important;"> Admin hệ thống</span>-->
<!--                                        </label>-->
                                        <label style="display: none" class="error-color  error-color-size" id="error_user_code">Bạn vui lòng nhập mã nhân viên</label>
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
                                            <option  value=""></option>
                                            <option  <?php if($mr=="Mr") echo "selected"?> value="Mr">Mr</option>
                                            <option <?php if($mr=="Mrs") echo "selected"?> value="Mrs">Mrs</option>
                                            <option <?php if($mr=="Ms") echo "selected"?> value="Ms">Ms</option>
                                        </select>
											<span class="input-icon " style="width: 68%;">
												<input value="<?php echo $name?>" name="full_name" type="text" id="input_full_name" class="width_100 <?php echo $valid_name?>" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="name_user_error_icon" style="display: none"  class="ace-icon fa fa-times-circle icon-right error-color " data-toggle="ggtooltip" data-title="" data-trigger="hover" data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff" title=""></i>
											</span>
                                        <label style="display: none" class="error-color  error-color-size" id="error_full_name">Bạn vui lòng nhập tên nhân viên</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="space-4"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" >
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ngày sinh <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="input-group" style="">
                                            <input value="<?php echo $birthday?>" class="form-control date-picker width_100 <?php echo $valid_birthday?>" id="input_birthday" name="birthday" required type="text" data-date-format="dd-mm-yyyy">
																	<span   class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                        </div>
                                        <label  style="display: none" class="error-color  error-color-size" id="error_birthday">Bạn vui lòng chọn ngày sinh</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $user_email?>" name="email_user" <?php echo $readonly?> type="email" id="input_email_user" class="width_100 <?php echo $valid_email?>" required>
												<i class="ace-icon fa fa-envelope blue"></i>
                                                <i id="email_user_error_icon" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng kiểm tra lại email"></i>
                                                <i id="email_user_success_icon" style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" title="Email hợp lệ"></i>
											</span>
                                        <label  style="display: none" class="error-color  error-color-size" id="error_email_user">Bạn vui lòng nhập email</label>
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
												<input value="<?php echo $address?>" name="address_user" type="text" id="input_address_user" class="width_100 <?php echo $valid_address?>" required>
												<i class="ace-icon fa fa-map-marker blue"></i>
                                                <i id="error_icon_address_user" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                        <label  style="display: none" class="error-color  error-color-size" id="error_address_user">Bạn vui lòng nhập địa chỉ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tên đăng nhập <span style="color: red">*</span></label>
                                    <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $user_name?>" name="user_name" type="text" <?php echo $readonly?> id="input_user_name" class="width_100 <?php echo $valid_user_name?>" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="error_icon_user_name" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng kiểm tra tên đăng nhập"></i>
                                                <i id="success_icon_user_name" style="display: none" class="ace-icon fa fa-check-circle icon-right success-color" title="Tên đăng nhập hợp lệ"></i>
											</span>
                                        <label  style="display: none" class="error-color  error-color-size" id="error_user_name">Bạn vui lòng điền tên đăng nhập</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="space-4"></div>
                                <div <?php echo $show_phone?> class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Điện thoại <span style="color: red">*</span></label>
                                        <div class="col-sm-9">
                                       <span class="input-icon width_100">
												<input name="user_phone" type="text" id="input_user_phone" class="width_100 <?php echo $valid_phone?>" required value="<?php echo $phone?>">
												<i class="ace-icon fa fa-mobile blue"></i>
                                                <i id="error_icon_user_phone" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng điền số điện thoại"></i>

											</span>
                                            <label  style="display: none" class="error-color  error-color-size" id="error_user_phone">Bạn vui lòng điền số điện thoại</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        <div <?php echo $hidden?> class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mật khẩu <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                      <span class="input-icon width_100">
												<input value="<?php echo $password?>" name="password" type="password" id="input_password" class="width_100 <?php echo $valid_pass?>" required>
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="error_icon_user_pass" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                    <label  style="display: none" class="error-color  error-color-size" id="error_password">Bạn vui lòng nhập mật khẩu</label>
                                </div>
                            </div>
                        </div>
                        <div <?php echo $hidden?> class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Xác nhận mật khẩu <span style="color: red">*</span></label>
                                <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="<?php echo $password?>" name="password_confirm" type="password" id="input_password_confirm" class="width_100 <?php echo $valid_pass?>" required>
												<input value="<?php echo $password?>" name="password_confirm" type="password" id="input_password_confirm" class="width_100 <?php echo $valid_pass?>" required>
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="error_icon_user_pass_con" style="display: none" class="ace-icon fa fa-times-circle icon-right error-color " title=""></i>
											</span>
                                    <label  style="display: none" class="error-color  error-color-size" id="error_password_confirm">Bạn vui lòng xác nhận mật khẩu</label>
                                </div>
                            </div>
                        </div>
                                </div>

                        <div class="space-4"></div>

                            <div class="clearfix">
                                <div class=" col-md-12" style="text-align: right">
                                    <button class="btn btn-info" type="button" id="submit_form_action">
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

                            <div style="margin-bottom: 11px" class="hr hr-24"></div>

                    </div>
                </div>
            </div>

        </div>
        </form>
        <!-- PAGE CONTENT BEGINS -->

    </div><!-- /.col -->
</div><!-- /.row -->






