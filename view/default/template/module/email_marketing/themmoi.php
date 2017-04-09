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
        <?php echo $tieude ?>
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="widget-body">
            <div class="widget-main">
                <div id="fuelux-wizard-container">
                    <div>
                        <ul class="steps">
                            <li id="step_tab_1" data-step="1" class="active hidden_tab_step"
                                complete_value="">
                                <span class="step">1</span>
                                <span class="title">Chọn danh sách khách hàng</span>
                            </li>

                            <li id="step_tab_2" data-step="2" class="hidden_tab_step" complete_value="">
                                <span class="step ">2</span>
                                <span class="title">Soạn nội dung</span>
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

                        .widget-main {
                            padding: 0px;
                        }
                    </style>

                    <div class="step-content pos-rel">
                        <form class="form-horizontal" id="submit_form" role="form" action="" method="post"
                              enctype="multipart/form-data">
                            <div class="step-pane active" data-step="1" id="step_edit_1">
                                <div class="col-md-8 col-sm-8 col-xs-12  "
                                     style="height: 300px; overflow: scroll">
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
                                                <th>Họ tên</th>
                                                <th>Avatar</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Mobile</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php if (count($list) > 0 && _returnCheckAction(16) == 1) { ?>
                                                <?php $dem = 1; ?>
                                                <?php foreach ($list as $row) { ?>
                                                    <tr class="row_<?php echo $row->id ?> row_tr_click"
                                                        value="<?php echo $row->id ?>"
                                                        email_record="<?php echo $row->email ?>">
                                                        <td class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace click_check_list"
                                                                       email_record="<?php echo $row->email ?>"
                                                                       id="check_<?php echo $dem ?>"
                                                                       name="customer_birthday[]"
                                                                       value="<?php echo $row->id ?>"/>
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php echo $dem; ?>
                                                        </td>
                                                        <td>
                                                            <a target="_blank"
                                                               href="<?php echo SITE_NAME ?>/khach-hang/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->name . ' - ' . $row->code ?></a>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php
                                                            if ($row->avatar == '') {
                                                                $link_ava = SITE_NAME . '/view/default/themes/images/no-avatar.png';
                                                            } else {
                                                                $link_ava = SITE_NAME . $row->avatar;
                                                            }
                                                            ?>
                                                            <img title="<?php echo $row->name ?>" style="width: 30px"
                                                                 src="<?php echo $link_ava ?>"><label
                                                                style="display: none"><?php echo $row->name ?></label>
                                                        </td>
                                                        <td><?php echo $row->email ?></td>
                                                        <td><?php echo $row->phone ?></td>
                                                        <td><?php echo $row->mobi ?></td>


                                                        <td hidden>
                                                            <div class="hidden-sm hidden-xs action-buttons">


                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button
                                                                        class="btn btn-minier btn-yellow dropdown-toggle"
                                                                        data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

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
                                </div>
                                <div style="height: 300px; overflow: scroll" class="col-md-4 col-sm-4 col-xs-12">
                                    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                        <div class="row" style="height: 57px">
                                            <div class="col-xs-12">
                                                <div class="dataTables_length">Số khách hàng được lựa chọn: <span
                                                        id="number_email"
                                                        style="font-size: 16px; font-weight: bold; color: red">0</span>


                                                </div>

                                            </div>
                                        </div>
                                        <table id="table_list_email_customer"
                                               class="table table-striped table-bordered table-hover table-responsive dataTable no-footer DTTT_selectable">

                                        </table>
                                    </div>

                                </div>
                            </div>


                            <div class="step-pane" id="step_edit_2" data-step="2">
                                <div class="col-md-8 col-sm-8 col-xs-12  "
                                     style="height: 300px; overflow: scroll">
                                    <div class="form-group" style="float: left; width: 100%">
                                        <div>
                                            <label for="form-field-select-3">Tiêu đề <span
                                                    style="color: red">*</span></label>
                                              <span class=" width_100" style="">
                                                    <input name="title" type="text" id="input_title" value=""
                                                           class="width_100">
                                                   <input hidden name="type" type="text" id="input_type" value="0"
                                                          class="width_100">
                                                </span>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_title">Bạn vui lòng nhập tiêu đề thư</label></div>
                                    </div>
                                    <div class="form-group" style="float: left; width: 50%; margin-right: 0px">
                                        <div>
                                            <label for="form-field-select-3">Ngày gửi <span
                                                    style="color: red">*</span></label>
                                            <div class="input-group">
                                                <input class="form-control date-picker" name="date_send" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy">
																	<span class="input-group-addon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>
                                            </div>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_date_send">Bạn vui lòng chọn ngày gửi</label></div>
                                    </div>
                                    <div class="form-group" style="float: left; width: 50%; margin-left: 0px">
                                        <div>
                                            <label for="form-field-select-3">Giờ gửi <span
                                                    style="color: red">*</span></label>
                                            <div class="input-group bootstrap-timepicker">
                                                <input id="timepicker1" name="time_send" type="text" class="form-control">
															<span class="input-group-addon">
																<i class="fa fa-clock-o bigger-110"></i>
															</span>
                                            </div>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_time_send">Bạn vui lòng chọn giờ gửi</label></div>
                                    </div>
                                    <div class="form-group" style="float: left; width: 100%">
                                        <div>
                                            <label for="form-field-select-3">Nội dung SMS (<span
                                                    style="color:#68BC31; font-size: 13px"
                                                    id="count_ky_tu">160 ký tự</span>) - <span
                                                    style="color:red; font-style: italic;font-size: 13px"> (Chú ý: không được sử dụng tiếng Việt có dấu)</label>
                                            <style>
                                                #message_birthday {
                                                    border: 1px solid #b5b5b5 !important;
                                                }
                                            </style>
                                            <textarea placeholder="Tin nhắn SMS chúc mừng sinh nhật ..."
                                                      class="form-control" name="message_birthday" id="message_birthday"
                                                      class="required" cols="20" rows="2"></textarea>
                                            <label style="display: none" class="error-color  error-color-size"
                                                   id="error_content">Bạn vui lòng nhập nôi dung SMS hoặc Email</label></div>
                                    </div>
                                    <div class="form-group" style="float: left; width: 100%">
                                        <div>
                                            <label for="form-field-select-3">Nội dung Email
                                                <style>
                                                    #message_birthday {
                                                        border: 1px solid #b5b5b5 !important;
                                                    }
                                                </style>
                                                <script type="text/javascript"
                                                        src="<?php echo SITE_NAME ?>/view/admin/Themes/ckeditor/ckeditor.js"></script>
                                                <textarea name="content_email" id="content_email"></textarea>
                                                <script
                                                    type="text/javascript">CKEDITOR.replace('content_email'); </script>
                                                <label style="display: none" class="error-color  error-color-size"
                                                       id="error_title">Bạn vui lòng nhập tiêu đề thư</label></div>
                                    </div>
                                </div>
                                <div style="height: 300px; overflow: scroll" class="col-md-4 col-sm-4 col-xs-12">
                                    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="dataTables_length">Từ khóa gửi tin nhắn</div>

                                            </div>
                                        </div>
                                        <style>
                                            .key_birthday {
                                                cursor: pointer;
                                            }
                                        </style>
                                        <table id=""
                                               class="table table-striped table-bordered table-hover table-responsive dataTable no-footer DTTT_selectable">
                                            <tr>
                                                <?php echo $list_short_code ?>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </form>
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
</div><!-- /.col -->
</div>

<style>
    .form-group {
        margin-bottom: 8px;
    }
</style>
