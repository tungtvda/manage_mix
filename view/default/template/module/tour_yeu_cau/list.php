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
        <?php echo $title?>
    </h1>

</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 pink" style="padding-left: 0px">
<!--                        --><?php //if (_returnCheckAction(54) == 1) { ?>
<!--                            <a href="#modal-form" role="button" data-toggle="modal" id="create_popup"-->
<!--                               class="green btn btn-white btn-create btn-hover-white">-->
<!--                                <i class="ace-icon fa fa-plus bigger-120 "></i>-->
<!--                                Create popup-->
<!--                                <i class="ace-icon fa fa-external-link"></i>-->
<!--                            </a>-->
<!--                        --><?php //} ?>
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
                                <?php if (_returnCheckAction(55) == 1) { ?>
                                    <li>
                                        <a href="#modal-form"  role="button"  data-toggle="modal" class="edit_function">Sửa</a>
                                    </li>
                                <?php } ?>
                                <?php if (_returnCheckAction(56) == 1) { ?>
                                    <li>
                                        <a class="delete_function"
                                           href="javascript:void()">Xóa</a>
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
                            <th>Thông tin khách hàng</th>
                            <th>Mã tour</th>
                            <th>Tên tour</th>
                            <th>Thời gian</th>
                            <th>Ngày khởi hành</th>
                            <th>Nơi khởi hành</th>
                            <th>Trạng thái</th>
                            <th>Người tạo</th>
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
                                                <input type="checkbox" class="ace click_check_list" name_record="<?php echo $row->name_tour ?>" id="check_<?php echo $dem ?>" name="check_box_action[]"
                                                       value="<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $dem; ?>
                                        </td>
                                        <td>
                                            <p><i class="fa fa-user"></i> <a href="<?php echo SITE_NAME ?>/khach-hang/sua?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"><?php echo $row->name_cus ?></a></p>
                                            <?php if($row->email_cus) {?>
                                                <p><i class="fa fa-envelope"></i> <?php echo $row->email_cus?></p>
                                            <?php } ?>
                                            <?php if($row->phone_cus) {?>
                                                <p><i class="fa fa-phone"></i> <?php echo $row->phone_cus?></p>
                                            <?php } ?>
                                            <?php if($row->address_cus) {?>
                                                <p><i class="fa fa fa-map-marker"></i> <?php echo $row->address_cus?></p>
                                            <?php } ?>
                                            <p>
                                                <input hidden id="id_cus_<?php echo $row->id?>" value="<?php echo $row->customer_id?>">
                                                <input hidden id="name_cus_<?php echo $row->id?>" value="<?php echo $row->name_cus?>">
                                                <input hidden id="email_cus_<?php echo $row->id?>" value="<?php echo $row->email_cus?>">
                                                <input hidden id="phone_cus_<?php echo $row->id?>" value="<?php echo $row->phone_cus?>">
                                                <input hidden id="address_cus_<?php echo $row->id?>" value="<?php echo $row->address_cus?>">
                                                <input hidden id="status_tour_<?php echo $row->id?>" value="<?php echo $row->status?>">
                                                <input hidden id="code_tour_<?php echo $row->id?>" value="<?php echo $row->code_tour?>">
                                                <input hidden id="name_tour_<?php echo $row->id?>" value="<?php echo $row->name_tour?>">
                                                <input hidden id="time_tour_<?php echo $row->id?>" value="<?php echo $row->time_tour?>">
                                                <input hidden id="date_tour_<?php echo $row->id?>" value="<?php echo $row->date_tour?>">
                                                <input hidden id="address_tour_<?php echo $row->id?>" value="<?php echo $row->address_tour?>">
                                                <input hidden id="note_tour_<?php echo $row->id?>" value="<?php echo $row->note_tour?>">
                                                <input hidden id="note_confirm_<?php echo $row->id?>" value="<?php echo $row->note_confirm?>">
                                                <input hidden id="user_id_<?php echo $row->id?>" value="<?php echo $row->user_id?>">
                                                <input hidden id="user_id_mahoa_<?php echo $row->id?>" value="<?php echo _return_mc_encrypt($row->user_id, ENCRYPTION_KEY); ?>">
                                                <input hidden id="user_name_<?php echo $row->id?>" value="<?php echo $row->name_user?>">
                                                <input hidden id="user_code_<?php echo $row->id?>" value="<?php echo $row->user_code?>">
                                            </p>
                                        </td>
                                        <td><?php echo $row->code_tour ?></td>
                                        <td><?php echo $row->name_tour ?></td>
                                        <td><?php echo $row->time_tour ?></td>
                                        <td><?php echo $row->date_tour ?></td>
                                        <td >
                                            <?php echo $row->address_tour ?>
                                        </td>
                                        <td>
                                            <span hidden><?php echo (int)$row->status ?></span>
                                            <?php
                                            $classSelect='chua_xac_nhan';
                                            $selected0='';
                                            $selected1='';
                                            $selected2='';
                                                if($row->status==2){
                                                    $selected2='selected';
                                                    $classSelect='da_huy';
                                                }else{
                                                    if($row->status==1){
                                                        $selected1='selected';
                                                        $classSelect='da_xac_nhan';
                                                    }else{
                                                        $selected0='selected';
                                                    }
                                                }
                                            $disabled='disabled';
                                                if(_returnCheckAction(55) == 1 && $row->status==0){
                                                    $disabled='';
                                                }
                                            ?>
                                            <select id="change_status_<?php echo $row->id ?>" class="change_status_tour_user <?php echo $classSelect?>" name_khachhang="<?php echo $row->name_cus ?>" name_record="<?php echo $row->name_tour ?>" countid="<?php echo $row->id ?>" <?php echo $disabled?>>
                                                <option <?php echo $selected0?> value="0">
                                                    Chưa xác nhận
                                                </option>
                                                <option <?php echo $selected1?> value="1">
                                                    Xác nhận
                                                </option>
                                                <option <?php echo $selected2?> value="2">
                                                    Đã hủy
                                                </option>
                                            </select>
                                        </td>
                                        <td><a target="_blank" href="<?php echo SITE_NAME ?>/thanh-vien/sua?id=<?php echo _return_mc_encrypt($row->user_id, ENCRYPTION_KEY); ?>"><?php echo $row->name_user ?></a></td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">

                                                <?php if (_returnCheckAction(18) == 1) { ?>
                                                    <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name_tour ?>" data-toggle="modal" table="customer" countid="<?php echo $row->id; ?>"
                                                       href="javascript:void(0)"
                                                       title="Chi tiết">
                                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if (_returnCheckAction(19) == 1) { ?>
                                                    <a title="Xóa" class="red delete_record" href="javascript:void(0)"
                                                       deleteid="<?php echo $row->id ?>"
                                                       name_record_delete="<?php echo $row->name_tour ?>"
                                                       url_delete="<?php echo SITE_NAME ?>/tour-yeu-cau/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>">
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

                                                        <?php if (_returnCheckAction(18) == 1) { ?>
                                                            <li>
                                                                <a class="blue view_popup_detail" role="button" name_record="<?php echo $row->name_tour ?>" data-toggle="modal" table="customer" countid="<?php echo $row->id; ?>"
                                                                   href="javascript:void(0)"
                                                                   title="Chi tiết">
                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if (_returnCheckAction(19) == 1) { ?>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   deleteid="<?php echo $row->id ?>"
                                                                   name_record_delete="<?php echo $row->name_tour ?>"
                                                                   url_delete="<?php echo SITE_NAME ?>/tour-yeu-cau/xoa?id=<?php echo _return_mc_encrypt($row->id, ENCRYPTION_KEY); ?>"
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
                <?php echo $tour_id_show_popup?>
                <div class="hr hr-18 dotted hr-double"></div>
                <div class="btn-groupn col-md-12" style="padding-left: 0px">
                    <button data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird"
                            aria-expanded="false">
                        Action
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-danger">

                        <?php if (_returnCheckAction(56) == 1) { ?>
                            <li>
                                <a class="delete_function"
                                   href="javascript:void()">Xóa</a>
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
                        <h4 class="blue bigger" id="title_form">Tour theo yêu cầu khách hàng</h4>

                    </div>
                    <form id="submit_form" role="form" action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <input class="valid" hidden name="check_edit" id="input_check_edit" value="1">
                                <input class="valid" hidden name="id_edit" id="input_id_edit" value="">
                                <div class="col-xs-12">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Người tạo</div>
                                            <div class="profile-info-value">
                                                <span style="font-weight: bold; color:#478fca !important; "
                                                      class="editable editable-click ">
                                                    <a id="user_create" target="_blank" href=""></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div  class="profile-info-row">
                                            <div class="profile-info-name"> Trạng thái</div>
                                            <div class="profile-info-value" id="input_status">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <fieldset style="margin-bottom: 20px"><legend><i class="fa fa-user"></i> Thông tin khách hàng</legend>
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Tên khách hàng <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('name_cus', '', '', 'user', 'readonly', 'Bạn vui lòng điền tên khách hàng','') ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Email <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('email_cus', '', '', 'envelope', 'readonly', 'Bạn vui lòng kiểm tra email','') ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div style="float: left; width: 100%">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label  for="form-field-select-3">Điện thoại <span
                                                                    style="color: red">*</span></label>
                                                        <?php echo _returnInput('phone_cus', '', '', 'phone', 'readonly', 'Bạn vui lòng kiểm tra số điện thoại','') ?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="form-field-select-3">Địa chỉ</label>
                                                        <?php echo _returnInput('address_cus', '', 'valid', 'map-marker', 'readonly', 'Bạn vui lòng kiểm tra email','') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <fieldset style="margin-bottom: 20px"><legend><i class="fa fa-plane"></i> Thông tin tour</legend>
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Tên tour - điểm đến <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('name_tour', '', '', 'plane', 'readonly', 'Bạn vui lòng điền tên tour, điểm đến','') ?>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Thời gian (VD: 3 ngày 2 đêm ) <span
                                                                style="color: red">*</span></label>
                                                    <?php echo _returnInput('time_tour', '', '', 'clock-o', 'readonly', 'Bạn vui lòng kiểm tra thời gian','') ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div style="float: left; width: 100%">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="form-field-select-3">Ngày khởi hành dự kiến <span
                                                                    style="color: red">*</span></label>
                                                        <?php echo _returnInput('date_tour', '', '', 'calendar', 'readonly', 'Bạn vui lòng kiểm tra ngày khởi hành','') ?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="form-field-select-3">Điểm khởi hành <span
                                                                    style="color: red">*</span></label>
                                                        <?php echo _returnInput('address_tour', '', '', 'map-marker', 'readonly', 'Bạn vui lòng kiểm tra điểm khởi hành','') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div style="float: left; width: 100%">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="form-field-select-3">Chương trình + phương tiện + khách sạn + ghi chú khác</label>
                                                        <textarea readonly class="valid" name="note_tour" id="input_note_tour" style="width: 100%"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="float: left; width: 100%">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="form-field-select-3">Ghi chú xác nhận admin</label>
                                                        <textarea readonly class="valid" name="note_confirm" id="input_note_confirm" style="width: 100%"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
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

        <div  id="modal-form-confirm" class="modal cancel_confirm" tabindex="0">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close cancel_confirm" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger" id="title_form_confirm">Tour theo yêu cầu khách hàng</h4>

                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div style="float: left; width: 100%">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="form-field-select-3">Ghi chú xác nhận admin</label>
                                                    <input hidden id="idSelectConfirm" value="">
                                                    <input hidden id="idValueConfirm" value="">
                                                    <textarea  class="valid" id="input_note_confirm_popup" name="note_confirm"  style="width: 100%"></textarea>
                                                    <label style="display: none" class="error-color  error-color-size" id="error_note_confirm">Bạn vui lòng nhập ghi chú</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" id="submit_form_confirm" type="button">
                                <i class="ace-icon fa fa-check"></i>
                                Save
                            </button>
                            <button type="reset" class="btn btn-sm cancel_confirm" data-dismiss="modal" >
                                <i class="ace-icon fa fa-times"></i>
                                Cancel
                            </button>
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
    fieldset {
        border: 1px dotted #007e00;
        padding: 10px;
        border-radius: 4px;
    }
    legend {
        width: inherit !important;
        color: #337ab7;
        margin-bottom: 0px;
        font-size: 15px;
        font-weight: bold;
        border-bottom: 0px;
    }
    .chua_xac_nhan{
        background: #ff9603;
        color: #ffffff;
    }
    .da_xac_nhan{
        background: green;
        color: #ffffff;
    }
    .da_huy{
        background: #d15b47!important;
        color: #ffffff;
    }
</style>
