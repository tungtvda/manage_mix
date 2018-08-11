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
        Danh sách phản hồi
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-8 col-sm-8 col-xs-12 pink" style="padding-left: 0px">

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
                                        <a href="">Thêm</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 " style="padding-left: 0px">
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
                                <th>Hotel Name</th>
                                <th>Hotel Code</th>
                                <th>Total</th>
                                <th>Customer Name</th>
                                <th>Comment</th>
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
                                    <tr class="row_<?php echo $row->id?>">
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
                                            <a href="<?php echo SITE_NAME ?>/phan-hoi-khach-san/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->hotel_name ?></a>
                                        </td>
                                        <td><?php echo $row->hotel_code ?></td>
                                        <td><?php echo $row->total ?></td>
                                        <td><?php echo $row->customer?$row->customer->name:'' ?></td>
                                        <td><?php echo $row->comment ?></td>
                                        <td>
                                            <span hidden><?php echo (int)$row->status ?></span>
                                            <?php if (_returnCheckAction(2) == 1) { ?>
                                                <label>

                                                    <input <?php if ($row->status) echo 'checked' ?>
                                                            id="checkbox_status_<?php echo $row->id ?>"
                                                            countid="<?php echo $row->id ?>"
                                                            name_record="<?php echo $row->hotel_name ?>" table="review_hotel" field="status" action="review_hotel_update"
                                                            class="ace ace-switch ace-switch-7 checkbox_status" type="checkbox">
                                                    <span class="lbl"></span>
                                                </label>
                                            <?php }else{?>
                                                <?php if ($row->status == 0) echo '<i  style="font-size: 20px;" class="fa fa-check-square-o "></i>' ?>
                                                <?php if ($row->status == 1) echo ' <i  style="font-size: 20px;color:green" class="fa fa-check-square-o "></i>' ?>
                                            <?php }?>
                                        </td>
                                        <!--                                        <td>-->
                                        <?php //echo _returnDateFormatConvert($row->created) ?><!--</td>-->
                                        <td><?php echo _returnDateFormatConvert($row->updated) ?></td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">

                                                <?php if (_returnCheckAction(2) == 1) { ?>

                                                    <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->hotel_name ?>" data-toggle="modal" table="review_hotel" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                       href="#modal-form"
                                                       title="Chi tiết">
                                                        <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                    </a>
                                                    <a title="Sửa tab mới" class="green"
                                                       href="<?php echo SITE_NAME ?>/phan-hoi-khach-san/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
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

                                                        <?php if (_returnCheckAction(2) == 1) { ?>
                                                            <li>
                                                                <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->hotel_name ?>" data-toggle="modal" table="review_hotel" countid="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                   href="#modal-form"
                                                                   title="Chi tiết">
                                                                    <i class="ace-icon fa fa-eye-slash bigger-130"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a  href="<?php echo SITE_NAME ?>/phan-hoi-khach-san/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
                                                                    class="tooltip-success" data-rel="tooltip"
                                                                    title="Sửa tab mới">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil bigger-120"></i>
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

            </div>

        </div>


        <style>
            .modal-backdrop{
                height: 1000px !important;
            }
        </style>
        <div  id="modal-form" class="modal" tabindex="-1">
            <div class="modal-dialog" style="width: 900px">
                <div class="modal-content">

                    <form class="form-horizontal"  id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="col-sm-19">
                            <div class="widget-box">

                                <div class="widget-header">
                                    <h4 class="widget-title">Thông tin phản hồi</h4>
                                </div>
                                <style>
                                    .control-label{
                                        font-size: 14px;
                                    }
                                    .form-horizontal .form-group {
                                        margin-left: 0px;
                                        margin-right: 0px;
                                    }
                                </style>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-group" >
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hotel  </label>
                                                        <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="" name="hotel_name" type="text" disabled id="input_hotel_name" class="width_100 " required="">

											</span>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Customer </label>
                                                    <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input value="" name="customer_name" disabled type="text" id="input_customer" class="width_100 " required="">

											</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-group" >
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hotel Code  </label>
                                                        <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value=""  name="hotel_code" disabled type="text" id="input_hotel_code" class="width_100 "  >

											</span>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Domain </label>
                                                    <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input value=""  name="domain" type="text" id="input_domain" disabled class="width_100 " >

											</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-group" >
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start date  </label>
                                                        <div class="col-sm-9">
											<span class="input-icon width_100">
												<input value="" disabled name="content" type="text" id="input_start_date" class="width_100 " >

											</span>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> End date </label>
                                                    <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input value=""  disabled name="content" type="text" id="input_end_date" class="width_100 " >

											</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-4"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group" >
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Clear  </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input  name="input"  type="text" id="input_clear" disabled class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_clear" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comfort </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input disabled name="input"  type="text" id="input_comfort" class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_comfort" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-4"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Convenient </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input disabled  name="input"  type="text" id="input_convenient" class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_convenient" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Staff </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input  name="input"  type="text" disabled id="input_staff" class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_staff" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-4"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Room </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  disabled type="text" id="input_room" class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_room" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  type="text" disabled id="input_price" class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_price" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-4"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Food </label>
                                                    <div class="col-sm-9">
												<span style="width: 50%" class="input-icon width_100">
												<input name="input"  disabled type="text" id="input_food" class="width_100" value=""/>
											</span>
                                                        <label class="inline">
                                                            <input  name="show_food" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Place </label>
                                                    <div class="col-sm-9">
                                                        <span style="width: 50%" class="input-icon width_100">
                                                        <input name="input"  type="text" disabled id="input_place" class="width_100" value=""/>
											            </span>
                                                        <label class="inline">
                                                            <input  name="show_place" type="checkbox" class="ace input-lg">
                                                            <span class="lbl"> Show </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-4"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Upcoming Tour </label>
                                                    <div class="col-sm-9">
                                                        <textarea id="upcoming_tour" name="upcoming_tour" disabled style="width: 100%;height: 70px" ></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Content </label>
                                                    <div class="col-sm-9">

                                           <span class="input-icon width_100">
												<input value=""  name="domain" type="text" id="input_content" disabled class="width_100 " >

											</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-4"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comment </label>
                                                    <div class="col-sm-9">
                                                        <textarea name="comment" id="input_comment" disabled style="width: 100%;height: 100px" ></textarea>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <label class="inline">
                                                    <input name="show_comment" type="checkbox" class="ace input-lg">
                                                    <span class="lbl"> Show </span>
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="inline">
                                                    <input  name="status" type="checkbox" class="ace input-lg">
                                                    <span class="lbl"> Status </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="">
                                    <div class="space-4"></div>

                                    <div class="clearfix">
                                        <div class=" col-md-12" style="text-align: right">
                                            <button class="btn btn-info" type="button" id="submit_form_action">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Submit
                                            </button>

                                        </div>
                                    </div>

                                    <div style="margin-bottom: 11px" class="hr hr-24"></div>

                                </div>
                            </div>
                        </div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.view_popup_detail').click(function () {
            var Id = $(this).attr('countid');
            var code = $(this).attr('name_record');
            if (Id != '') {
                jQuery
                    .post(url + '/get-detail-ajax/', {
                        id: Id,
                        table: 'review_hotel'
                    })
                    .done(function (data) {
                        if (data != 0) {
                            var obj = jQuery.parseJSON(data);
                            $('#input_id_edit').val(Id);

                            $('#input_hotel_name').val(obj.hotel_name);
                            $('#input_hotel_code').val(obj.hotel_code);
                            $('#input_domain').val(obj.domain);
                            $('#input_content').val(obj.content);
                            $('#input_clear').val(obj.clear);
                            $('#input_comfort').val(obj.comfort);
                            $('#input_convenient').val(obj.convenient);
                            $('#input_staff').val(obj.staff);
                            $('#input_room').val(obj.room);
                            $('#input_price').val(obj.price);
                            $('#input_food').val(obj.food);
                            $('#input_place').val(obj.place);
                            $('#input_start_date').val(obj.start_date);
                            $('#input_end_date').val(obj.end_date);
                            $('#input_comment').val(obj.comment);
                            $('#upcoming_tour').val(obj.upcoming_tour);
                            $( "input[name=show_comment]" ).prop( "checked", obj.show_coment=='1'?true:false );
                            $( "input[name=show_food]" ).prop( "checked", obj.show_food=='1'?true:false );
                            $( "input[name=show_place]" ).prop( "checked", obj.show_place=='1'?true:false );
                            $( "input[name=show_clear]" ).prop( "checked", obj.show_clear=='1'?true:false );
                            $( "input[name=show_comfort]" ).prop( "checked", obj.show_comfort=='1'?true:false );
                            $( "input[name=show_convenient]" ).prop( "checked", obj.show_convenient=='1'?true:false );
                            $( "input[name=show_staff]" ).prop( "checked", obj.show_staff=='1'?true:false );
                            $( "input[name=show_room]" ).prop( "checked", obj.show_room=='1'?true:false );
                            $( "input[name=show_price]" ).prop( "checked", obj.show_price=='1'?true:false );
                            $( "input[name=status]" ).prop( "checked", obj.status=='1'?true:false );
                            $("input[name=id]").val(Id);
                            $('#input_customer').val(obj.customer.name);

                        } else {
                            lnv.alert({
                                title: 'Lỗi',
                                content: 'Ban không thể xem chi tiết chi phí"' + name + '"',
                                alertBtnText: 'Ok',
                                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                alertHandler: function () {
                                    $('#modal-form').modal('hide');
                                }
                            });
                        }
                    });
            } else {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Ban không thể xem chi tiết chi phí "' + name + '"',
                    alertBtnText: 'Ok',
                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {
                        $('#modal-form').modal('hide');
                    }
                });
            }
        });
        $('#submit_form_action').click(function () {
            $('form').submit();
        })
    });

</script>