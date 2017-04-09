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
                        <form class="form-horizontal" id="submit_form_profile" role="form" action="" method="post"
                              enctype="multipart/form-data">
                            <div class="step-pane active" data-step="1" id="step_edit_1">
                                <div class="col-md-8 col-sm-8 col-xs-12  "
                                     style="height: 300px; overflow: scroll">
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
                                                                       name="check_box_action[]"
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
                                    </form>
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
                                    asdf
                                </div>
                                <div style="height: 300px; overflow: scroll" class="col-md-4 col-sm-4 col-xs-12">
                                    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                        <div class="row" style="height: 57px">
                                            <div class="col-xs-12">
                                                <div class="dataTables_length">Từ khóa gửi tin nhắn</div>

                                            </div>
                                        </div>
                                        <table id=""
                                               class="table table-striped table-bordered table-hover table-responsive dataTable no-footer DTTT_selectable">
                                            <tr >
                                                <td>
                                                    <span class="label label-warning arrowed-right arrowed-in key_birthday" countId="1">[ten_kh]</span>
                                                    <input class="input_key_birthday" id="value_key_1" countId="1" type="text" value="[ten_kh]">
                                                </td>
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
