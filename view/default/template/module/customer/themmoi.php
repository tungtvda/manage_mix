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
            <div class="modal-body">
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="">
                            <div id="preview">
                                <img id="show_img_upload" class="img-responsive" no-avatar="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg"
                                     src="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg">
                            </div>
                            <input class="valid" accept="image/*" name="avatar" type="file" id="id-input-file-2" onchange="loadFile(event)" />
                        </div>
                    </div>
                    <input class="valid" hidden name="check_edit" id="input_check_edit" value="">
                    <input class="valid" hidden name="id_edit" id="input_id_edit" value="">
                    <div class="col-xs-12 col-sm-8 col-md-8">

                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="form-field-1"> Mã nhân viên <span style="color: red">*</span></label>
                                <div class="col-xs-12 col-sm-9 ">
                                    <?php echo _returnInput('code', $code, $valid_code, 'qrcode', '', 'Bạn vui lòng kiểm tra mã khách hàng','') ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 row">
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
                                    <?php echo _returnInput('name', $name, $valid_name, 'user', '', 'Bạn vui lòng kiểm tra tên khách hàng','width: 68%;') ?>

                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Họ tên <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>


                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 100%">
                        <div class="col-xs-12 col-sm-6 col-md-6">

                                <label for="form-field-select-3">Email <span
                                        style="color: red">*</span></label>
                                <?php echo _returnInput('email', '', '', 'envelope', '', 'Bạn vui lòng kiểm tra email','') ?>

                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                                <label for="form-field-select-3">Địa chỉ <span
                                        style="color: red">*</span></label>
                                <?php echo _returnInput('address', '', '', 'map-marker', '', 'Bạn vui lòng kiểm tra email','') ?>

                        </div>
                    </div>
                    <div style="float: left; width: 100%">
                        <div class="col-xs-12 col-sm-6 col-md-6">

                                <label for="form-field-select-3">Điện thoại <span
                                        style="color: red">*</span></label>
                                <?php echo _returnInput('phone', '', '', 'phone', '', 'Bạn vui lòng kiểm tra số điện thoại','') ?>

                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                                <label for="form-field-select-3">Di động <span
                                        style="color: red">*</span></label>
                                <?php echo _returnInput('mobi', '', '', 'mobile', '', 'Bạn vui lòng kiểm tra số di động','') ?>
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
        <!-- PAGE CONTENT BEGINS -->

    </div><!-- /.col -->
</div><!-- /.row -->






