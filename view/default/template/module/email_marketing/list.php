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
                        <?php if (_returnCheckAction($action_them) == 1) { ?>
                            <a href="<?php echo SITE_NAME.'/'.$action_link ?>/them-moi?type=<?php echo $type?>"
                               class="btn btn-white  btn-create-new-tab btn-create-new-tab-hover">
                                <i class="ace-icon fa fa-envelope bigger-120 "></i>
                                Soạn Email - SMS
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
                                <?php if (_returnCheckAction($action_sua) == 1) { ?>
                                    <li>
                                        <a href="#modal-form" role="button" data-toggle="modal" class="edit_function">Sửa</a>
                                    </li>
                                <?php } ?>
                                                                <?php if (_returnCheckAction($action_xoa) == 1) { ?>
                                                                    <li>
                                                                        <a class="delete_function"
                                                                           href="javascript:void()">Xóa</a>
                                                                    </li>
                                                                <?php } ?>
                                <li class="divider"></li>
                                <?php if (_returnCheckAction($action_them) == 1) { ?>
                                    <li>
                                        <a href="<?php echo SITE_NAME.'/'.$action_link ?>/them-moi?type=<?php echo $type?>">Soạn Email - SMS</a>
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
                                <th>Mã</th>
                                <th>Tiêu đề SMS/Email</th>
                                <th>Số khách</th>
                                <th>SMS</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Ngày gửi</th>
                                <th>Ngày tạo</th>
                                <th>Người tạo</th>
                                <th>Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php if (count($list) > 0 && _returnCheckAction($action_list) == 1) { ?>
                                <?php $dem = 1; ?>
                                <?php foreach ($list as $row) { ?>
                                    <tr class="row_<?php echo $row->id ?>">
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace click_check_list"
                                                       name_record="<?php echo $row->code?>"
                                                       id="check_<?php echo $dem ?>" name="check_box_action[]"
                                                       value="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $dem; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>&type=<?php echo $type ?>"><?php echo $row->code ?></a>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>&type=<?php echo $type ?>">
                                                <?php echo $row->title ?>

                                            </a>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $row->count_cus ?>
                                        </td>
                                        <td style="text-align: center">
                                            <span class="green"><?php echo $row->count_success_sms ?></span> |  <span class="red"><?php echo $row->cus_false_sms ?></span>
                                        </td>
                                        <td style="text-align: center">
                                            <span class="green"><?php echo $row->count_success_email ?></span> |  <span class="red"><?php echo $row->cus_false_email ?></span>
                                        <td>
                                            <input id="status_old_<?php echo $row->id ?>"
                                                   value="<?php echo $row->status ?>" hidden>
                                            <label style="display: none"><?php echo $row->status ?></label>
                                            <?php
                                            $disabled = 'disabled';
                                            if (_returnCheckAction($action_list) == 1 || $_SESSION['user_role'] == 1) {
                                                $disabled = '';
                                            }
                                            ?>
                                            <select <?php echo $disabled ?> id="status_<?php echo $row->id ?>"
                                                                            class="select_status"
                                                                            count_id="<?php echo $row->id ?>"
                                                                            code="<?php echo $row->code?>">
                                                <option <?php if($row->status==0) echo "selected"?> value="0">Draft</option>
                                                <option  <?php if($row->status==1) echo "selected";?> value="1">Processing</option>
                                                <option <?php if($row->status==2) echo "selected"?> value="2">Sent</option>
                                                <option <?php if($row->status==3) echo "selected"?> value="3">Paused</option>
                                            </select>
                                        </td>
                                        </td>
                                        <td>
                                            <?php echo date("d-m-Y H:i:s", strtotime($row->date_time_send));?>
                                        </td>
                                        <td>
                                            <?php echo date("d-m-Y H:i:s", strtotime($row->created));?>
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
                                            <div class="hidden-sm hidden-xs action-buttons">

                                                <?php if (_returnCheckAction($action_list) == 1) { ?>
                                                    <a class="blue view_popup_detail" role="button"
                                                       name_record="<?php echo $row->code ?>"
                                                       data-toggle="modal" table="sms_email"
                                                       countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                       href="#modal-form"
                                                       title="Chi tiết">
                                                        <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                    </a>
                                                    <a title="Sửa tab mới" class="green"
                                                       href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>&type=<?php echo $type?>">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if (_returnCheckAction($action_xoa) == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row->code ?>"
                                                       url_delete="<?php echo SITE_NAME.'/'.$action_link ?>/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>&type=<?php echo $type?>">
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

                                                        <?php if (_returnCheckAction($action_sua) == 1) { ?>
                                                            <li>
                                                                <a class="blue view_popup_detail" role="button"
                                                                   name_record="<?php echo $row->code ?>"
                                                                   data-toggle="modal" table="sms_email"
                                                                   countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   href="#modal-form"
                                                                   title="Chi tiết">
                                                                    <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="<?php echo SITE_NAME.'/'.$action_link ?>/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>&type=<?php echo $type?>"
                                                                   class="tooltip-success" data-rel="tooltip"
                                                                   title="Sửa tab mới">
																				<span class="">
																					<i class="ace-icon fa fa-pencil bigger-120"></i>
																				</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if (_returnCheckAction($action_xoa) == 1) { ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   deleteid="<?php echo $row->id ?>"
                                                                   name_record_delete="<?php echo $row->code ?>"
                                                                   url_delete="<?php echo SITE_NAME.'/'.$action_link ?>/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>&type=<?php echo $type?>"
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
<!--                        --><?php //if (_returnCheckAction($action_sua) == 1) { ?>
<!--                            <li>-->
<!--                                <a href="#modal-form" role="button" data-toggle="modal" class="edit_function">Sửa</a>-->
<!--                            </li>-->
<!--                        --><?php //} ?>
                        <?php if (_returnCheckAction($action_xoa) == 1) { ?>
                            <li>
                                <a class="delete_function"
                                   href="javascript:void()">Xóa</a>
                            </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <?php if (_returnCheckAction($action_them) == 1) { ?>
                            <li>
                                <a href="<?php echo SITE_NAME.'/'.$action_link ?>/them-moi?type=<?php echo $type?>">Soạn Email - SMS</a>
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
                        <h4 class="blue bigger" id="title_form">Thông tin SMS - Email</h4>
                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <h3 style="margin-right: 0px; margin-left: 0px;    font-size: 14px;"
                                    class="row header smaller lighter orange">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-comments-o"></i>
												Danh sách khách hàng (<span id="count_cus"></span>)
											</span>
                                </h3>
                                <style>
                                    .div_list_cus{
                                        height: 300px;
                                        overflow: scroll
                                    }

                                </style>
                                <div class="col-xs-12 col-sm-12" id="div_list_cus">
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover table-responsive dataTable no-footer DTTT_selectable" role="grid" aria-describedby="dynamic-table_info">
                                        <thead>
                                        <tr role="row">
                                            <th >#</th>
                                            <th >Họ tên</th>
                                            <th >Avatar</th>
                                            <th >Email</th>
                                            <th>Phone</th>
                                            <th>Mobile</th>
                                        </tr>
                                        </thead>

                                        <tbody  class="show_cus_list">

                                        </tbody>


                                    </table>
                                    <div class="space-6"></div>


                                </div>


                            </div>
                            <div class="row">
                                <h3 style="margin-right: 0px; margin-left: 0px;    font-size: 14px;"
                                    class="row header smaller lighter blue">
                                   <span class="col-sm-8">
												<i class="ace-icon fa fa-comments-o"></i>
												Nội dung tin nhắn
											</span>
                                </h3>
                                <div class="col-xs-12 col-sm-12">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Tiêu đề</div>
                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click tieu_de_detail"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Trạng thái</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click trang_thai_detail"></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Ngày - giờ gửi</div>
                                            <div class="profile-info-value">
                                                <span class="editable editable-click ngay_gui_detail"></span>
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