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
        <div class="tabbable">
            <ul id="inbox-tabs" class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
                <!--                <li class="li-new-mail pull-right">-->
                <!--                    <a data-toggle="tab" href="#write" data-target="write" class="btn-new-mail">-->
                <!--														<span class="btn btn-primary no-border">-->
                <!--															<i class="ace-icon fa fa-pencil-square-o bigger-130"></i>-->
                <!--															<span class="bigger-110">Chỉnh sửa</span>-->
                <!--														</span>-->
                <!--                    </a>-->
                <!--                </li>-->

                <li class="active">
                    <a data-toggle="tab" href="hoso" data-target="inbox" class="tab_list">
                        <i class="blue ace-icon fa fa-inbox bigger-130"></i>
                        <span class="bigger-110">Hồ sơ</span>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="matkhau" data-target="sent" class="tab_list">
                        <i class="red ace-icon fa fa-key bigger-130"></i>
                        <span class="bigger-110">Mật khẩu</span>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="capnhaphoso" data-target="draft" class="tab_list">
                        <i class="green ace-icon fa fa-pencil bigger-130"></i>
                        <span class="bigger-110">Cập nhật hồ sơ</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="pink ace-icon fa fa-tags bigger-130"></i>

														<span class="bigger-110">
															Tags
															<i class="ace-icon fa fa-caret-down"></i>
														</span>
                    </a>

                    <ul class="dropdown-menu dropdown-light-blue dropdown-125">
                        <li>
                            <a data-toggle="tab" href="#tag-1">
                                <span class="mail-tag badge badge-pink"></span>
                                <span class="pink">Tag#1</span>
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#tag-family">
                                <span class="mail-tag badge badge-success"></span>
                                <span class="green">Family</span>
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#tag-friends">
                                <span class="mail-tag badge badge-info"></span>
                                <span class="blue">Friends</span>
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#tag-work">
                                <span class="mail-tag badge badge-grey"></span>
                                <span class="grey">Work</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- /.dropdown -->
            </ul>

            <div class="tab-content no-border no-padding">
                <div id="hoso" class="tab-pane active tab_content">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="hr dotted"></div>
                        <div id="user-profile-1" class="user-profile row">
                            <div class="col-xs-12 col-sm-3 center">
                                <div>
												<span class="profile-picture">
													<img
                                                        class="editable img-responsive editable-click editable-empty"
                                                        title="<?php echo $name ?>" alt="<?php echo $name ?>"
                                                        src="<?php echo $avatar ?>">
												</span>
                                    <div class="space-4"></div>

                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                        <div class="inline position-relative">
                                            <a href="#" class="user-title-label dropdown-toggle"
                                               data-toggle="dropdown">
                                                <i class="ace-icon fa fa-circle light-green"></i>
                                                &nbsp;
                                                <span class="white"><?php echo $name . ' - ' . $user_code ?> </span>
                                            </a>

                                            <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                                <li class="dropdown-header"> Thay đổi trạng thái</li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-circle green"></i>
                                                        &nbsp;
                                                        <span class="green">Đang online</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-circle red"></i>
                                                        &nbsp;
                                                        <span class="red">Bận</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-circle grey"></i>
                                                        &nbsp;
                                                        <span class="grey">Ẩn</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-6"></div>

                                <div class="profile-contact-info">
                                    <div class="profile-contact-links align-left">
                                        <a href="#" class="btn btn-link">
                                            <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                            Kết bạn
                                        </a>

                                        <a href="#" class="btn btn-link">
                                            <i class="ace-icon fa fa-envelope bigger-120 pink"></i>
                                            Gửi tin nhắn
                                        </a>

                                        <a href="#" class="btn btn-link">
                                            <i class="ace-icon fa fa-globe bigger-125 blue"></i>
                                            www.alexdoe.com
                                        </a>
                                    </div>

                                    <div class="space-6"></div>

                                    <div class="profile-social-links align-center">
                                        <a href="#" class="tooltip-info" title=""
                                           data-original-title="Visit my Facebook">
                                            <i class="middle ace-icon fa fa-facebook-square fa-2x blue"></i>
                                        </a>

                                        <a href="#" class="tooltip-info" title=""
                                           data-original-title="Visit my Twitter">
                                            <i class="middle ace-icon fa fa-twitter-square fa-2x light-blue"></i>
                                        </a>

                                        <a href="#" class="tooltip-error" title=""
                                           data-original-title="Visit my Pinterest">
                                            <i class="middle ace-icon fa fa-pinterest-square fa-2x red"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="hr hr12 dotted"></div>

                                <div class="clearfix">
                                    <div class="grid2">
                                        <span class="bigger-175 blue">25</span>

                                        <br>
                                        Followers
                                    </div>

                                    <div class="grid2">
                                        <span class="bigger-175 blue">12</span>

                                        <br>
                                        Following
                                    </div>
                                </div>

                                <div class="hr hr16 dotted"></div>
                            </div>

                            <div class="col-xs-12 col-sm-9">
                                <form class="form-horizontal" id="submit_form" role="form" action="" method="post"
                                      enctype="multipart/form-data">
                                    <input class="valid" hidden name="check_edit" id="input_check_edit" value="edit">
                                    <input class="valid" hidden name="id_edit" id="input_id_edit"
                                           value="<?php echo $id ?>">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Mã nhân viên</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click hidden_edit"><?php echo $user_code ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Họ tên</div>

                                                <div class="profile-info-value form-group">
                                                    <span
                                                        class="editable editable-click hidden_edit"><?php echo $name_show ?></span>


                                                </div>
                                            </div>


                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngày sinh</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click hidden_edit"><?php echo $birthday ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Giới tính</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click hidden_edit"><?php echo $gender ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Quyền admin</div>

                                                <div class="profile-info-value">
                                                    <label>
                                                        <input disabled <?php echo $user_role ?> type="checkbox"
                                                               class="ace input-lg">
                                                        <span class="lbl"
                                                              style="font-style: italic;color: #ff892a; font-size: 13px"> (Có quyền quản lý toàn bộ hệ thống)</span>
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Tên đăng nhập</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $user_name ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Email</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $user_email ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Địa chỉ</div>

                                                <div class="profile-info-value">
                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                    <span class="editable editable-click"><?php echo $address ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Điện thoại</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $phone ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Di động</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $valid_mobi ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Skype</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $skype ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Facebook</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $face ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngày làm việc</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $ngay_lam_viec ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngày chính thức</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $ngay_chinh_thuc ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Phòng ban</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $phong_ban_name ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Chức vụ</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $chuc_vu_name ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Hướng dẫn viên</div>

                                                <div class="profile-info-value">
                                                    <label>
                                                        <input disabled <?php echo $guides_check ?> type="checkbox"
                                                               class="ace input-lg">
                                                        <span class="lbl"
                                                              style="font-style: italic;color: #ff892a; font-size: 13px"> <?php echo $guide_card_number_name ?></span>
                                                    </label>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="space-6"></div>


                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Mã số thuế</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $tax_code ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> CMTND</div>

                                                <div class="profile-info-value">
                                                    <span style="font-size: 12px"
                                                          class="editable editable-click"><?php echo $cmnd ?><span
                                                            style="font-style: italic;color: #ff892a; "> <?php echo $cmnd_name ?></span></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Hộ chiếu</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $number_passport ?>
                                                        <span
                                                            style="font-style: italic;color: #ff892a; font-size: 12px"> <?php echo $number_passport_name ?></span></span>
                                                </div>
                                            </div>
                                            <?php if ($date_range_passport_name != '') { ?>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> &nbsp;</div>

                                                    <div class="profile-info-value">
                                                        <span style="font-style: italic;color: #ff892a; font-size: 12px"
                                                              class="editable editable-click"><?php echo $date_range_passport_name ?></span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngân hàng</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $account_number_bank_name ?>
                                                        <span
                                                            style="font-style: italic;color: #ff892a; font-size: 12px"> <?php echo $bank_name ?></span></span>
                                                </div>
                                            </div>
                                            <?php if ($open_bank_name != '') { ?>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> &nbsp;</div>

                                                    <div class="profile-info-value">
                                                        <span style="font-style: italic;color: #ff892a; font-size: 12px"
                                                              class="editable editable-click"><?php echo $open_bank_name ?></span>
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Dân tộc</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $dan_toc_name ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Tôn giáo</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $ton_giao_name ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Hộ khẩu TT</div>

                                                <div class="profile-info-value">
                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                    <span
                                                        class="editable editable-click"><?php echo $ho_khau_tt ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Bằng cấp</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $bang_cap_name ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Hôn nhân</div>

                                                <div class="profile-info-value">
                                                    <span
                                                        class="editable editable-click"><?php echo $hon_nhan_name ?></span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngôn ngữ</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $ngon_ngu ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Ngày tạo</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $created ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name">Mô tả</div>

                                                <div class="profile-info-value">
                                                    <span class="editable editable-click"><?php echo $note ?></span>
                                                </div>
                                            </div>


                                            <div class="space-20"></div>


                                        </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div>
            </div>
            <div id="matkhau" class="tab-pane tab_content">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="hr dotted"></div>
                    <div class="widget-body">
                        <style>
                            .widget-main.padding-24 {
                                padding: 0px;
                            }
                        </style>
                        <div class="widget-main padding-24">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
                                            <b>Đổi mật khẩu</b>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 row">
                                        <form action="" method="post" id="submit_chang_pass">
                                            <div class="form-group">
                                                <label for="form-field-select-3">Mật khẩu cũ <span
                                                        style="color: red">*</span></label>
                                                <div>
                                            <span class="input-icon width_100">
												<input name="password_old" type="password" id="input_password_old"
                                                       class="width_100" required="">
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="user_password_old_success_icon" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                   data-placement="bottom" data-backcolor="green"
                                                   data-textcolor="#000000" title="Mật khẩu hợp hệ"></i>
                                                <i id="error_icon_user_password_old" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Vui lòng check lại mật khẩu cũ"></i>
											</span>
                                                    <label style="display: none" class="error-color  error-color-size"
                                                           id="error_password_old">Mật khẩu không đúng</label>
                                                </div>
                                            </div>
                                            <div class="space-10"></div>
                                            <div class="form-group">
                                                <label for="form-field-select-3">Mật khẩu mới <span
                                                        style="color: red">*</span></label>
                                                <div>
                                         <span class="input-icon width_100">
												<input name="password" type="password" id="input_password"
                                                       class="width_100" required="">
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="error_icon_user_pass" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Bạn vui lòng nhập địa chỉ"></i>
											</span>
                                                    <label style="display: none" class="error-color  error-color-size"
                                                           id="error_password">Bạn vui lòng nhập mật khẩu</label>
                                                </div>
                                            </div>
                                            <div class="space-10"></div>
                                            <div class="form-group">
                                                <label for="form-field-select-3">Xác nhận mật khẩu mới <span
                                                        style="color: red">*</span></label>
                                                <div>
                                         <span class="input-icon width_100">
											<span class="input-icon width_100">
												<input name="password_confirm" type="password"
                                                       id="input_password_confirm" class="width_100" required="">
												<i class="ace-icon fa fa-key blue"></i>
                                                <i id="error_icon_user_pass_con" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title=""></i>
											</span>
                                    <label style="display: none" class="error-color  error-color-size"
                                           id="error_password_confirm">Bạn vui lòng xác nhận mật khẩu</label>
                                            </span></div>
                                            </div>
                                            <div class="space-10"></div>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-primary" id="submit_pass_action"
                                                        type="button">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    Save
                                                </button>
                                                <button type="reset" class="btn btn-sm" data-dismiss="modal"
                                                        id="reset_form_popup">
                                                    <i class="ace-icon fa fa-times"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                            <b>Xác minh 2 bước</b>
                                        </div>
                                    </div>

                                    <div class="space-6"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 row">
                                        <div class="space-6"></div>
                                        <div class="space-6"></div>
                                        <div class="space-6"></div>
                                        <div class="form-group">
                                            <label class="block">
                                                <input id="xac_minh_2_buoc" <?php echo $check_xacminh ?>
                                                       countid="<?php echo $id_xac_minh ?>" table="user"
                                                       field="login_two_steps" name_record="<?php echo $name ?>"
                                                       name="form-field-checkbox" type="checkbox" class="ace input-lg">
                                                <span id="mess_xacminh"
                                                      class="lbl bigger-120 <?php echo $color_xacminh ?>"> <?php echo $mess_xacminh ?></span>
                                            </label>
                                        </div>
                                        <div class="space-6"></div>
                                        <div class="well">
                                            <p>Mỗi khi bạn đăng nhập vào Tài khoản Mixtourist của mình, bạn sẽ cần mật
                                                khẩu và mã xác minh.</p>
                                            <div class="space-8"></div>
                                            <div class="media search-media">
                                                <div class="media-left">
                                                    <a>
                                                        <img class="media-object" data-src="holder.js/72x72" alt=""
                                                             src="<?php echo SITE_NAME ?>/view/default/themes/images/email-security.png"
                                                             data-holder-rendered="true" style="width: 95px; ">
                                                    </a>
                                                </div>

                                                <div class="media-body">
                                                    <div>
                                                        <h4 class="media-heading">
                                                            <a class="blue">Thêm lớp bảo mật bổ xung</a>
                                                        </h4>
                                                    </div>
                                                    <p>Nhập mật khẩu và mã xác minh duy nhất được gửi đến email đăng ký
                                                        của bạn.</p>
                                                </div>
                                            </div>
                                            <div class="space-6"></div>
                                            <div class="media search-media">
                                                <div class="media-left">
                                                    <a>
                                                        <img class="media-object" data-src="holder.js/72x72" alt=""
                                                             src="<?php echo SITE_NAME ?>/view/default/themes/images/hacker.png"
                                                             data-holder-rendered="true" style="width: 95px; ">
                                                    </a>
                                                </div>

                                                <div class="media-body">
                                                    <div>
                                                        <h4 class="media-heading">
                                                            <a class="red">Tránh những kẻ xấu ra</a>
                                                        </h4>
                                                    </div>
                                                    <p>Kể cả nếu ai đó lấy được mật khẩu của bạn thì cũng sẽ không đủ để
                                                        đăng nhập vào tài khoản của bạn.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.col -->
                            </div><!-- /.row -->


                        </div>
                    </div>

                </div>
            </div>

            <div id="capnhaphoso" class="tab-pane tab_content">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="hr dotted"></div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div id="fuelux-wizard-container">
                                <div>
                                    <ul class="steps">
                                        <li id="step_tab_1" data-step="1" class="active hidden_tab_step"
                                            complete_value="">
                                            <span class="step">1</span>
                                            <span class="title">Ảnh đại diện</span>
                                        </li>

                                        <li id="step_tab_2" data-step="2" class="hidden_tab_step" complete_value="">
                                            <span class="step ">2</span>
                                            <span class="title">Thông tin đăng nhập</span>
                                        </li>

                                        <li id="step_tab_3" data-step="3" class="hidden_tab_step" complete_value="">
                                            <span class="step">3</span>
                                            <span class="title">Thông tin liên hệ</span>
                                        </li>

                                        <li id="step_tab_4" data-step="4" class="hidden_tab_step" complete_value="">
                                            <span class="step">4</span>
                                            <span class="title">Thông tin khác</span>
                                        </li>
                                    </ul>
                                </div>

                                <hr/>
                                <style>
                                    .step-content .step-pane.active {
                                        display: block;
                                        float: left;
                                        width: 100%;
                                    }

                                    #preview img {
                                        margin: auto;
                                    }
                                </style>

                                <div class="step-content pos-rel">
                                    <div class="step-pane active" data-step="1" id="step_edit_1">
                                        <div class="col-md-4 col-sm-4 col-xs-12 hidden-xs">
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div style="margin: auto" class="widget-box">
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
                                                            <div id="preview">
                                                                <img id="show_img_upload" class="img-responsive"
                                                                     no-avatar="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg"
                                                                     src="<?php echo $avatar ?>">
                                                            </div>
                                                            <div class="space-6"></div>
                                                            <input accept="image/*" name="avatar" type="file"
                                                                   id="id-input-file-2" onchange="loadFile(event)"/>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 hidden-xs">
                                        </div>

                                    </div>

                                    <div class="step-pane" id="step_edit_2" data-step="2">
                                        <div style="margin: auto; float: left;width: 100%" class="widget-box">
                                            <div class="widget-header">
                                                <h4 class="widget-title">Thông tin đăng nhập</h4>

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
                                                    <div class="col-xs-12 col-sm-6">
                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name">Mã nhân viên <span
                                                                        style="color: red">*</span></div>

                                                                <div class="profile-info-value">


                                               <span class="input-icon width_100">
                                                    <input disabled name="user_code" type="text" id="input_user_code"
                                                           value="<?php echo $user_code ?>"
                                                           class="width_100 <?php echo $valid_user_code ?>" required>
                                                    <i class="ace-icon fa fa-qrcode blue"></i>
                                                    <i id="user_code_error_icon" style="display: none"
                                                       class="ace-icon fa fa-times-circle icon-right error-color "
                                                       data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                       data-placement="bottom" data-backcolor="red"
                                                       data-textcolor="#ffffff"
                                                       title=""></i>
                                                    <i id="user_code_success_icon" style="display: none"
                                                       class="ace-icon fa fa-check-circle icon-right success-color"
                                                       data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                       data-placement="bottom" data-backcolor="green"
                                                       data-textcolor="#000000" title="Mã nhân viên hợp lệ"></i>
                                                </span>
                                                    <label style="display: none" class="error-color  error-color-size" id="error_user_code">Bạn vui lòng nhập mã nhân viên</label>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Họ tên <span style="color: red">*</span></div>

                                                                <div class="profile-info-value form-group">
                                                                    <div>
                                                                        <style>
                                                                            .chosen-single {
                                                                                width: 100% !important;
                                                                                border: 1px solid #d5d5d5 !important;
                                                                                height: 34px !important;
                                                                            }

                                                                            #form_field_select_3_chosen {
                                                                                width: 26% !important;

                                                                            }
                                                                        </style>

                                                                        <select name="mr"
                                                                                class="chosen-select form-control mr_user"
                                                                                id="form-field-select-3"
                                                                                data-placeholder="Danh xưng ..."
                                                                                style="display: none;width: 10px">
                                                                            <option value=""></option>
                                                                            <option <?php if ($mr == "Mr") echo "selected" ?>
                                                                                value="Mr">Mr
                                                                            </option>
                                                                            <option <?php if ($mr == "Mrs") echo "selected" ?>
                                                                                value="Mrs">Mrs
                                                                            </option>
                                                                            <option <?php if ($mr == "Ms") echo "selected" ?>
                                                                                value="Ms">Ms
                                                                            </option>
                                                                        </select>
                                                    <span class="input-icon width_100" style="width: 73%">
                                                  <input value="<?php echo $name ?>" name="full_name" type="text"
                                                         id="input_full_name"
                                                         class="width_100 <?php echo $valid_name ?>" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="name_user_error_icon" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                   data-placement="bottom" data-backcolor="red" data-textcolor="#ffffff"
                                                   title=""></i>
                                                </span>
                                                                        <label style="display: none"
                                                                               class="error-color  error-color-size"
                                                                               id="error_full_name">Bạn vui lòng nhập
                                                                            tên nhân
                                                                            viên</label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Ngày sinh</div>

                                                                <div class="profile-info-value">
                                                                    <div>
                                                                        <div class="input-group" style="">
                                                                            <input value="<?php echo $birthday ?>"
                                                                                   class="form-control date-picker width_100 <?php echo $valid_birthday ?>"
                                                                                   id="input_birthday" name="birthday"
                                                                                   required
                                                                                   type="text"
                                                                                   data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                                                        </div>
                                                                        <label style="display: none"
                                                                               class="error-color  error-color-size"
                                                                               id="error_birthday">Bạn vui lòng chọn
                                                                            ngày sinh</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Giới tính</div>

                                                                <div class="profile-info-value">
                                                                    <select name="gender"
                                                                            class="chosen-select form-control valid"
                                                                            id="form-field-select-3"
                                                                            data-placeholder="Giới tính ..."
                                                                            style="display: none;width: 10px">
                                                                        <option <?php if ($gender_edit == 0) echo "selected" ?>
                                                                            value="Ms">Chưa xác định
                                                                        </option>
                                                                        <option <?php if ($gender_edit == 1) echo "selected" ?>
                                                                            value="Mr">Nam
                                                                        </option>
                                                                        <option <?php if ($gender_edit == 2) echo "selected" ?>
                                                                            value="Mrs">Nữ
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Quyền admin</div>

                                                                <div class="profile-info-value">
                                                                    <label>
                                                                        <input <?php echo $user_role ?>
                                                                            id="input_user_role" disabled
                                                                            name="user_role"
                                                                            class="ace ace-switch ace-switch-6 valid"
                                                                            type="checkbox">
                                                                        <span class="lbl"></span>
                                                                    </label>

                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Tên đăng nhập</div>

                                                                <div class="profile-info-value">
                                                   	<span class="input-icon width_100">
												<input disabled value="<?php echo $user_name ?>" name="user_name" type="text"
                                                       id="input_user_name"
                                                       class="width_100 valid" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="error_icon_user_name" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Bạn vui lòng kiểm tra tên đăng nhập"></i>
                                                <i id="success_icon_user_name" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   title="Tên đăng nhập hợp lệ"></i>
											</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Email</div>

                                                                <div class="profile-info-value">
                                                    <span class="input-icon width_100">
												<input value="<?php echo $user_email ?>" name="email_user" readonly
                                                       type="email" id="input_email_user"
                                                       class="width_100 <?php echo $valid_email ?>" required>
												<i class="ace-icon fa fa-envelope blue"></i>
                                                <i id="email_user_error_icon" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Bạn vui lòng kiểm tra lại email"></i>
                                                <i id="email_user_success_icon" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   title="Email hợp lệ"></i>
											</span>
                                                                    <label style="display: none"
                                                                           class="error-color  error-color-size"
                                                                           id="error_email_user">Bạn vui lòng nhập
                                                                        email</label>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="space-6"></div>


                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <div class="profile-user-info profile-user-info-striped">
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name">Ngày làm việc <span
                                                                        style="color: red"></span></div>

                                                                <div class="profile-info-value">


                                               <span class="input-icon width_100">
                                                    <input disabled name="ngay_lam_viec" type="text"
                                                           id="input_ngay_lam_viec"
                                                           value="<?php echo $ngay_lam_viec ?>"
                                                           class="width_100 valid" required>
                                                    <i class="ace-icon fa fa-calendar blue"></i>
                                                </span>
                                                                </div>
                                                            </div>

                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Ngày chính thức</div>

                                                                <div class="profile-info-value form-group">




                                                    <span class="input-icon width_100">
                                                  <input disabled value="<?php echo $ngay_chinh_thuc ?>"
                                                         name="ngay_chinh_thuc" type="text"
                                                         id="input_ngay_chinh_thuc"
                                                         class="width_100 valid">
												 <i class="ace-icon fa fa-calendar blue"></i>

                                                </span>
                                                                </div>


                                                            </div>


                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Địa chỉ</div>

                                                                <div class="profile-info-value">
                                                                    <div>
                                                                        <div class="input-group" style="">
                                                                            <input value="<?php echo $birthday ?>"
                                                                                   class="form-control date-picker width_100 <?php echo $valid_birthday ?>"
                                                                                   id="input_birthday" name="birthday"
                                                                                   required
                                                                                   type="text"
                                                                                   data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                                                        </div>
                                                                        <label style="display: none"
                                                                               class="error-color  error-color-size"
                                                                               id="error_birthday">Bạn vui lòng chọn
                                                                            ngày sinh</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Giới tính</div>

                                                                <div class="profile-info-value">
                                                                    <select name="gender"
                                                                            class="chosen-select form-control"
                                                                            id="form-field-select-3"
                                                                            data-placeholder="Giới tính ..."
                                                                            style="display: none;width: 10px">-->
                                                                        <option <?php if ($gender_edit == 0) echo "selected" ?>
                                                                            value="Ms">Chưa xác định
                                                                        </option>
                                                                        <option <?php if ($gender_edit == 1) echo "selected" ?>
                                                                            value="Mr">Nam
                                                                        </option>
                                                                        <option <?php if ($gender_edit == 2) echo "selected" ?>
                                                                            value="Mrs">Nữ
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Quyền admin</div>

                                                                <div class="profile-info-value">
                                                                    <label>
                                                                        <input <?php echo $user_role ?>
                                                                            id="input_user_role"
                                                                            name="user_role"
                                                                            class="ace ace-switch ace-switch-6"
                                                                            type="checkbox">
                                                                        <span class="lbl"></span>
                                                                    </label>

                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Tên đăng nhập</div>

                                                                <div class="profile-info-value">
                                                   	<span class="input-icon width_100">
												<input value="<?php echo $user_name ?>" name="user_name" type="text"
                                                       id="input_user_name"
                                                       class="width_100 <?php echo $valid_user_name ?>" required>
												<i class="ace-icon fa fa-user blue"></i>
                                                <i id="error_icon_user_name" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Bạn vui lòng kiểm tra tên đăng nhập"></i>
                                                <i id="success_icon_user_name" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   title="Tên đăng nhập hợp lệ"></i>
											</span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-info-row">
                                                                <div class="profile-info-name"> Email</div>

                                                                <div class="profile-info-value">
                                                    <span class="input-icon width_100">
												<input value="<?php echo $user_email ?>" name="email_user" readonly
                                                       type="email" id="input_email_user"
                                                       class="width_100 <?php echo $valid_email ?>" required>
												<i class="ace-icon fa fa-envelope blue"></i>
                                                <i id="email_user_error_icon" style="display: none"
                                                   class="ace-icon fa fa-times-circle icon-right error-color "
                                                   title="Bạn vui lòng kiểm tra lại email"></i>
                                                <i id="email_user_success_icon" style="display: none"
                                                   class="ace-icon fa fa-check-circle icon-right success-color"
                                                   title="Email hợp lệ"></i>
											</span>
                                                                    <label style="display: none"
                                                                           class="error-color  error-color-size"
                                                                           id="error_email_user">Bạn vui lòng nhập
                                                                        email</label>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="space-6"></div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="step-pane" id="step_edit_3" data-step="3">
                                        <div class="center">
                                            <h3 class="blue lighter">This is step 3</h3>
                                        </div>
                                    </div>

                                    <div class="step-pane" id="step_edit_4" data-step="4">
                                        <div class="center">
                                            <h3 class="green">Congrats!</h3>
                                            Your product is ready to ship! Click finish to continue!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <div class="wizard-actions">
                                <button class="btn btn-prev" disabled="disabled" id="prev_edit_user">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Prev
                                </button>

                                <button class="btn btn-success btn-next" id="next_edit_user" data-last="Finish">
                                    Next
                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                </button>
                            </div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div>
            </div>

        </div><!-- /.tab-content -->
    </div><!-- /.tabbable -->
</div><!-- /.col -->
</div>

<style>
    .form-group {
        margin-bottom: 8px;
    }
</style>
