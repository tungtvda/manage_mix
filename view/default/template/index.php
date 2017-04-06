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
        Users
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            List users
        </small>
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>

            <i class="ace-icon fa fa-check green"></i>

            Welcome to
            <strong class="green">
                MIXTOURISt
                <small>(v1.1)</small>
            </strong>
        </div>

        <div class="row">
            <div class="space-6"></div>

            <div class="col-sm-7 infobox-container">
                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-comments"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">32</span>
                        <div class="infobox-content">comments + 2 reviews</div>
                    </div>

                    <div class="stat stat-success">8%</div>
                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-twitter"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">11</span>
                        <div class="infobox-content">new followers</div>
                    </div>

                    <div class="badge badge-success">
                        +32%
                        <i class="ace-icon fa fa-arrow-up"></i>
                    </div>
                </div>

                <div class="infobox infobox-pink">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-shopping-cart"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">8</span>
                        <div class="infobox-content">new orders</div>
                    </div>
                    <div class="stat stat-important">4%</div>
                </div>

                <div class="infobox infobox-red">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-flask"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">7</span>
                        <div class="infobox-content">experiments</div>
                    </div>
                </div>

                <div class="infobox infobox-orange2">
                    <div class="infobox-chart">
                        <span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">6,251</span>
                        <div class="infobox-content">pageviews</div>
                    </div>

                    <div class="badge badge-success">
                        7.2%
                        <i class="ace-icon fa fa-arrow-up"></i>
                    </div>
                </div>

                <div class="infobox infobox-blue2">
                    <div class="infobox-progress">
                        <div class="easy-pie-chart percentage" data-percent="42" data-size="46">
                            <span class="percent">42</span>%
                        </div>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-text">traffic used</span>

                        <div class="infobox-content">
                            <span class="bigger-110">~</span>
                            58GB remaining
                        </div>
                    </div>
                </div>

                <div class="space-6"></div>

                <div class="infobox infobox-green infobox-small infobox-dark">
                    <div class="infobox-progress">
                        <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
                            <span class="percent">61</span>%
                        </div>
                    </div>

                    <div class="infobox-data">
                        <div class="infobox-content">Task</div>
                        <div class="infobox-content">Completion</div>
                    </div>
                </div>

                <div class="infobox infobox-blue infobox-small infobox-dark">
                    <div class="infobox-chart">
                        <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                    </div>

                    <div class="infobox-data">
                        <div class="infobox-content">Earnings</div>
                        <div class="infobox-content">$32,000</div>
                    </div>
                </div>

                <div class="infobox infobox-grey infobox-small infobox-dark">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-download"></i>
                    </div>

                    <div class="infobox-data">
                        <div class="infobox-content">Downloads</div>
                        <div class="infobox-content">1,205</div>
                    </div>
                </div>
            </div>

            <div class="vspace-12-sm"></div>

            <div class="col-sm-5">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat widget-header-small">
                        <h5 class="widget-title">
                            <i class="ace-icon fa fa-signal"></i>
                            Trạng thái đơn hàng
                        </h5>


                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div id="piechart-placeholder"></div>

                            <div class="hr hr8 hr-double"></div>

                            <div class="clearfix">
                                <div class="grid3">
															<span style="color:#68BC31" class="">
																<i class="ace-icon fa fa-tasks fa-2x "></i>
																&nbsp; Đơn hàng mới
															</span>
                                    <h4 class="bigger pull-right"><?php echo $count_don_hang_moi ?></h4>
                                </div>

                                <div class="grid3">
															<span style="color:#2091CF" class="">
																<i class="ace-icon fa fa-tasks fa-2x "></i>
																&nbsp; Đang giao dịch
															</span>
                                    <h4 class="bigger pull-right"><?php echo $count_dang_giao_dich ?></h4>
                                </div>

                                <div class="grid3">
															<span style="color:#AF4E96" class="">
																<i class="ace-icon fa fa-tasks fa-2x "></i>
																&nbsp; Tạm dừng
															</span>
                                    <h4 class="bigger pull-right"><?php echo $count_tam_dung ?></h4>
                                </div>
                                <div class="grid3">
															<span style="color:#DA5430" class="">
																<i class="ace-icon fa fa-tasks fa-2x "></i>
																&nbsp; Nợ tiền
															</span>
                                    <h4 class="bigger pull-right"><?php echo $count_no_tien ?></h4>
                                </div>
                                <div class="grid3">
															<span style="color:#000000" class="">
																<i class="ace-icon fa fa-tasks fa-2x "></i>
																&nbsp; Kết thúc
															</span>
                                    <h4 class="bigger pull-right"><?php echo $count_ket_thuc ?></h4>
                                </div>
                                <div class="grid3">
															<span style="color:#FEE074" class="">
																<i class="ace-icon fa fa-tasks fa-2x "></i>
																&nbsp; Bản nháp
															</span>
                                    <h4 class="bigger pull-right"><?php echo $count_ban_nhap ?></h4>
                                </div>
                            </div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="hr hr32 hr-dotted"></div>

        <div class="row">
            <div class="col-sm-6">
                <div class="widget-box transparent" id="recent-box">
                    <div class="widget-header">
                        <h4 style="color: #ff00bd" class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-gift"></i>Sinh nhật khách hàng
                        </h4>

                        <div class="widget-toolbar no-border">
                            <ul class="nav nav-tabs" id="recent-tab">
                                <li class="active">
                                    <a data-toggle="tab" href="#task-tab">Hôm nay</a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#member-tab">Trong Tuần</a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#comment-tab">Trong Tháng</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div class="tab-content padding-8">
                                <div id="task-tab" class="tab-pane active">
                                    <h4 style="border-bottom: 1px solid #e8b110; padding-bottom: 10px; margin-bottom: 0px;" class="smaller lighter green">
                                        <i class="ace-icon fa fa-check"></i>
                                        Gửi lời chúc tới khách hàng
                                        <a style="float: right;margin-left: 10px" title="Soạn tin nhắn và email chúc mừng sinh nhật" href="<?php echo SITE_NAME?>/sinh-nhat?type=khach_hang" >
                                            <i class="ace-icon fa fa-hand-o-right "></i>
                                        </a>
                                        <a style="float: right">|</a>
                                        <a style="float: right; margin-right: 10px ">
                                            <label class="pos-rel">
                                                <input id="check_all_form_birthday" value="" type="checkbox" class="ace">
                                                <span class="lbl"></span>
                                            </label>
                                        </a>

                                    </h4>

                                    <style>
                                        .item-list > li.selected label, .item-list > li.selected .lbl {
                                            text-decoration: none;
                                        }
                                        .key_birthday{
                                            cursor: pointer;
                                        }
                                    </style>
                                    <form id="form_birthday" method="post">


                                    <div class="comments birthday_content">
                                        <ul id="tasks" class="item-list">
                                            <?php echo $list_customer_sinh_nhat_hien_tai ?>
                                        </ul>

                                    </div>
                                    <div style="margin-top: 0px" class="form-actions">
                                        <div style="background-color: #ffffff; padding: 10px; width: 100%" class="input-group" >
                                            <h4 style="font-size: 13px"  class="smaller lighter green">
                                                <i class="ace-icon fa fa-key"></i>
                                                Từ khóa gửi tin nhắn <span style="color:red"> (Chú ý: không được sử dụng tiếng Việt có dấu)</span>
                                            </h4>
                                            <span class="label label-warning arrowed-right arrowed-in key_birthday" countId="1">[ten_kh] <input id="value_key_1" hidden value="[ten_kh]"></span>
                                            <span class="label label-warning arrowed-right arrowed-in key_birthday" countId="1">[tuoi_kh]<input id="value_key_2" hidden value="[tuoi_kh]"></span>
                                        </div>
                                        <div style="background-color: #ffffff;    border-top: 1px solid #E5E5E5;"  class="input-group">
                                            <textarea style="border: none" placeholder="Tin nhắn SMS chúc mừng sinh nhật ..." class="form-control" name="message_birthday" id="message_birthday" class="required" cols="20" rows="2"></textarea>
                                            <span style="position: absolute;color:#68BC31" id="count_ky_tu">150 ký tự</span>
																<span style="vertical-align: bottom;" class="input-group-btn">
																	<button id="btn_send_birthday" class="btn btn-sm btn-info no-radius"
                                                                            type="button">
                                                                        <i class="ace-icon fa fa-share"></i>
                                                                        Send
                                                                    </button>
																</span>

                                        </div>
                                        <p id="error_check_length" hidden style="color: red">Bạn đã nhập quá số ký tự cho phép</p>
                                    </div>
                                    </form>
                                </div>

                                <div id="member-tab" class="tab-pane">
                                    <div class="clearfix">
                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Bob Doe's avatar"
                                                     src="assets/images/avatars/user.jpg"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Bob Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">20 min</span>
                                                </div>

                                                <div>
                                                    <span class="label label-warning label-sm">pending</span>

                                                    <div class="inline position-relative">
                                                        <button
                                                            class="btn btn-minier btn-yellow btn-no-border dropdown-toggle"
                                                            data-toggle="dropdown"
                                                            data-position="auto">
                                                            <i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-success"
                                                                   data-rel="tooltip" title="Approve">
																							<span class="green">
																								<i class="ace-icon fa fa-check bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-warning"
                                                                   data-rel="tooltip" title="Reject">
																							<span class="orange">
																								<i class="ace-icon fa fa-times bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-error"
                                                                   data-rel="tooltip" title="Delete">
																							<span class="red">
																								<i class="ace-icon fa fa-trash-o bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Joe Doe's avatar"
                                                     src="assets/images/avatars/avatar2.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Joe Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">1 hour</span>
                                                </div>

                                                <div>
                                                    <span class="label label-warning label-sm">pending</span>

                                                    <div class="inline position-relative">
                                                        <button
                                                            class="btn btn-minier btn-yellow btn-no-border dropdown-toggle"
                                                            data-toggle="dropdown"
                                                            data-position="auto">
                                                            <i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-success"
                                                                   data-rel="tooltip" title="Approve">
																							<span class="green">
																								<i class="ace-icon fa fa-check bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-warning"
                                                                   data-rel="tooltip" title="Reject">
																							<span class="orange">
																								<i class="ace-icon fa fa-times bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-error"
                                                                   data-rel="tooltip" title="Delete">
																							<span class="red">
																								<i class="ace-icon fa fa-trash-o bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Jim Doe's avatar"
                                                     src="assets/images/avatars/avatar.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Jim Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">2 hour</span>
                                                </div>

                                                <div>
                                                    <span class="label label-warning label-sm">pending</span>

                                                    <div class="inline position-relative">
                                                        <button
                                                            class="btn btn-minier btn-yellow btn-no-border dropdown-toggle"
                                                            data-toggle="dropdown"
                                                            data-position="auto">
                                                            <i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-success"
                                                                   data-rel="tooltip" title="Approve">
																							<span class="green">
																								<i class="ace-icon fa fa-check bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-warning"
                                                                   data-rel="tooltip" title="Reject">
																							<span class="orange">
																								<i class="ace-icon fa fa-times bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-error"
                                                                   data-rel="tooltip" title="Delete">
																							<span class="red">
																								<i class="ace-icon fa fa-trash-o bigger-110"></i>
																							</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Alex Doe's avatar"
                                                     src="assets/images/avatars/avatar5.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Alex Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">3 hour</span>
                                                </div>

                                                <div>
                                                    <span class="label label-danger label-sm">blocked</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Bob Doe's avatar"
                                                     src="assets/images/avatars/avatar2.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Bob Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">6 hour</span>
                                                </div>

                                                <div>
                                                    <span
                                                        class="label label-success label-sm arrowed-in">approved</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Susan's avatar"
                                                     src="assets/images/avatars/avatar3.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Susan</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">yesterday</span>
                                                </div>

                                                <div>
                                                    <span
                                                        class="label label-success label-sm arrowed-in">approved</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Phil Doe's avatar"
                                                     src="assets/images/avatars/avatar4.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Phil Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">2 days ago</span>
                                                </div>

                                                <div>
                                                    <span class="label label-info label-sm arrowed-in arrowed-in-right">online</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv memberdiv">
                                            <div class="user">
                                                <img alt="Alexa Doe's avatar"
                                                     src="assets/images/avatars/avatar1.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Alexa Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">3 days ago</span>
                                                </div>

                                                <div>
                                                    <span
                                                        class="label label-success label-sm arrowed-in">approved</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-4"></div>

                                    <div class="center">
                                        <i class="ace-icon fa fa-users fa-2x green middle"></i>

                                        &nbsp;
                                        <a href="#" class="btn btn-sm btn-white btn-info">
                                            See all members &nbsp;
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>

                                    <div class="hr hr-double hr8"></div>
                                </div><!-- /.#member-tab -->

                                <div id="comment-tab" class="tab-pane">
                                    <div class="comments">
                                        <div class="itemdiv commentdiv">
                                            <div class="user">
                                                <img alt="Bob Doe's Avatar"
                                                     src="assets/images/avatars/avatar.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Bob Doe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green">6 min</span>
                                                </div>

                                                <div class="text">
                                                    <i class="ace-icon fa fa-quote-left"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit. Quisque commodo massa sed ipsum porttitor
                                                    facilisis &hellip;
                                                </div>
                                            </div>

                                            <div class="tools">
                                                <div class="inline position-relative">
                                                    <button class="btn btn-minier bigger btn-yellow dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-success"
                                                               data-rel="tooltip" title="Approve">
																						<span class="green">
																							<i class="ace-icon fa fa-check bigger-110"></i>
																						</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-warning"
                                                               data-rel="tooltip" title="Reject">
																						<span class="orange">
																							<i class="ace-icon fa fa-times bigger-110"></i>
																						</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error"
                                                               data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="ace-icon fa fa-trash-o bigger-110"></i>
																						</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv commentdiv">
                                            <div class="user">
                                                <img alt="Jennifer's Avatar"
                                                     src="assets/images/avatars/avatar1.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Jennifer</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="blue">15 min</span>
                                                </div>

                                                <div class="text">
                                                    <i class="ace-icon fa fa-quote-left"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit. Quisque commodo massa sed ipsum porttitor
                                                    facilisis &hellip;
                                                </div>
                                            </div>

                                            <div class="tools">
                                                <div class="action-buttons bigger-125">
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-pencil blue"></i>
                                                    </a>

                                                    <a href="#">
                                                        <i class="ace-icon fa fa-trash-o red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv commentdiv">
                                            <div class="user">
                                                <img alt="Joe's Avatar"
                                                     src="assets/images/avatars/avatar2.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Joe</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="orange">22 min</span>
                                                </div>

                                                <div class="text">
                                                    <i class="ace-icon fa fa-quote-left"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit. Quisque commodo massa sed ipsum porttitor
                                                    facilisis &hellip;
                                                </div>
                                            </div>

                                            <div class="tools">
                                                <div class="action-buttons bigger-125">
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-pencil blue"></i>
                                                    </a>

                                                    <a href="#">
                                                        <i class="ace-icon fa fa-trash-o red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="itemdiv commentdiv">
                                            <div class="user">
                                                <img alt="Rita's Avatar"
                                                     src="assets/images/avatars/avatar3.png"/>
                                            </div>

                                            <div class="body">
                                                <div class="name">
                                                    <a href="#">Rita</a>
                                                </div>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="red">50 min</span>
                                                </div>

                                                <div class="text">
                                                    <i class="ace-icon fa fa-quote-left"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit. Quisque commodo massa sed ipsum porttitor
                                                    facilisis &hellip;
                                                </div>
                                            </div>

                                            <div class="tools">
                                                <div class="action-buttons bigger-125">
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-pencil blue"></i>
                                                    </a>

                                                    <a href="#">
                                                        <i class="ace-icon fa fa-trash-o red"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr hr8"></div>

                                    <div class="center">
                                        <i class="ace-icon fa fa-comments-o fa-2x green middle"></i>

                                        &nbsp;
                                        <a href="#" class="btn btn-sm btn-white btn-info">
                                            See all comments &nbsp;
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>

                                    <div class="hr hr-double hr8"></div>
                                </div>
                            </div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->

            <div class="col-sm-6">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-comment blue"></i>
                            Conversation
                        </h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="dialogs">
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
                                            adipiscing elit. Quisque commodo massa sed ipsum porttitor
                                            facilisis.
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
                                            <span class="orange">2 min</span>
                                        </div>

                                        <div class="name">
                                            <a href="#">Bob</a>
                                            <span class="label label-info arrowed arrowed-in-right">admin</span>
                                        </div>
                                        <div class="text">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Quisque commodo massa sed ipsum porttitor
                                            facilisis.
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
                                                <i class="icon-only ace-icon fa fa-share"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form>
                                <div class="form-actions">
                                    <div class="input-group">
                                        <input placeholder="Type your message here ..." type="text"
                                               class="form-control" name="message"/>
																<span class="input-group-btn">
																	<button class="btn btn-sm btn-info no-radius"
                                                                            type="button">
                                                                        <i class="ace-icon fa fa-share"></i>
                                                                        Send
                                                                    </button>
																</span>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="hr hr32 hr-dotted"></div>
        <div class="row">
            <div class="col-sm-5">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Popular Domains
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table class="table table-bordered table-striped">
                                <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>name
                                    </th>

                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>price
                                    </th>

                                    <th class="hidden-480">
                                        <i class="ace-icon fa fa-caret-right blue"></i>status
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>internet.com</td>

                                    <td>
                                        <small>
                                            <s class="red">$29.99</s>
                                        </small>
                                        <b class="green">$19.99</b>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-info arrowed-right arrowed-in">on sale</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>online.com</td>

                                    <td>
                                        <b class="blue">$16.45</b>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-success arrowed-in arrowed-in-right">approved</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>newnet.com</td>

                                    <td>
                                        <b class="blue">$15.00</b>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-danger arrowed">pending</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>web.com</td>

                                    <td>
                                        <small>
                                            <s class="red">$24.99</s>
                                        </small>
                                        <b class="green">$19.95</b>
                                    </td>

                                    <td class="hidden-480">
																	<span class="label arrowed">
																		<s>out of stock</s>
																	</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>domain.com</td>

                                    <td>
                                        <b class="blue">$12.00</b>
                                    </td>

                                    <td class="hidden-480">
                                        <span class="label label-warning arrowed arrowed-right">SOLD</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->

            <div class="col-sm-7">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-signal"></i>
                            Sale Stats
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div id="sales-charts"></div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->


        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
