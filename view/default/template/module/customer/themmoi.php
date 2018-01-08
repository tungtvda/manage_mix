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
                                <img style="text-align: center; margin: auto" id="show_img_upload" class="img-responsive" no-avatar="<?php echo SITE_NAME ?>/view/default/themes/images/no-image.jpg"
                                     src="<?php echo $avatar ?>">
                            </div>
                            <input class="valid" accept="image/*" name="avatar" type="file" id="id-input-file-2" onchange="loadFile(event)" />
                        </div>
                    </div>
                    <input class="valid" hidden name="check_edit" id="input_check_edit" value="<?php echo $action_name ?>">
                    <input class="valid" hidden name="id_edit" id="input_id_edit" value="<?php echo $id ?>">
                    <div class="col-xs-12 col-sm-8 col-md-8">

                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-3 control-label no-padding-right" for="form-field-1"> Mã khách hàng <span style="color: red">*</span></label>
                                <div class="col-xs-12 col-sm-9 ">
                                    <?php echo _returnInput('code', $code, $valid_code, 'qrcode', $disabled, 'Bạn vui lòng kiểm tra mã khách hàng','') ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Họ tên <span style="color: red">*</span></label>
                                <div class="col-sm-9" id="mr_div">
                                    <style>
                                        #mr_div .chosen-container-single{
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ngày sinh </label>
                                <div class="col-sm-9">
                                    <?php echo _returnInputDate('birthday', $birthday, $valid_birthday, '', '','')?>
                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <?php echo _returnInput('email', $user_email, $valid_email, 'envelope', '', 'Bạn vui lòng kiểm tra email khách hàng','') ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Địa chỉ <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <?php echo _returnInput('address', $address, $valid_address, 'map-marker', '', 'Bạn vui lòng kiểm tra địa chỉ khách hàng','') ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Điện thoại <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <?php echo _returnInput('phone', $phone, $valid_phone, 'phone', '', 'Bạn vui lòng kiểm tra điện thoại khách hàng','') ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Di động <span style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <?php echo _returnInput('mobi', $mobi, $valid_mobi, 'mobile', '', 'Bạn vui lòng kiểm tra điện thoại di động khách hàng','') ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-4"></div>
                        <div class="col-sm-12 col-xs-12 row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fax <span style="color: red"></span></label>
                                <div class="col-sm-9">
                                    <?php echo _returnInput('fax', $fax, 'valid', 'fax', '', '','') ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <style>
                    .form-horizontal .form-group{
                        margin-left: 0px;
                        margin-right: 0px;
                    }
                    .form-group-select{
                        display: inline;
                        float: left;
                        margin-right: 10px !important;
                        width: 31.4%;
                    }
                    .form-group-select .chosen-container-single{
                        width: 100% !important;
                    }
                </style>
                <div class="row">
                    <div style="float: left; width: 100%">
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <div  class="form-group form-group-select">
                                <label for="form-field-select-3">Loại khách hàng </label></br>
                                <?php echo _returnInputSelect('category',$category,$data_list_category,'valid', 'Loại khách hàng ...')?>
                            </div>

                            <div  class="form-group form-group-select">
                                <label for="form-field-select-3">Nguồn khách hàng </label></br>
                                <?php echo _returnInputSelect('resources_to',$resources_to,$data_list_resources_to,'valid', 'Nguồn khách hàng ...')?>
                            </div>
                            <div  class="form-group form-group-select">
                                <label for="form-field-select-3">Ngành nghề </label></br>
                                <?php echo _returnInputSelect('nganh_nghe',$nganh_nghe,$data_list_nganh_nghe,'valid', 'Nghành nghề ...')?>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                                <label for="form-field-select-3">Tên công ty </label>
                                <?php echo _returnInput('company_name', $company_name, 'valid', 'home', '', '','') ?>

                        </div>
                    </div>
                    <div style="float: left; width: 100%">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div  class="form-group form-group-select">
                                <label for="form-field-select-3">Chức vụ </label></br>
                                <?php echo _returnInputSelect('chuc_vu',$chuc_vu,$data_list_chucvu,'valid', 'Chức vụ ...')?>
                            </div>

                            <div  class="form-group form-group-select">
                                <label for="form-field-select-3">Phòng ban </label></br>
                                <?php echo _returnInputSelect('phong_ban',$phong_ban,$data_list_phongban,'valid', 'Phòng ban ...')?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3">Giám đốc</label>
                            <?php echo _returnInput('director_name', $director_name, 'valid', 'user', '', '','') ?>

                        </div>


                    </div>
                    <div style="float: left; width: 100%">

                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3">Email công ty </label>
                            <?php echo _returnInput('company_email', $company_email, 'valid', 'envelope', '', '','') ?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <label for="form-field-select-3">Skype </label>
                            <?php echo _returnInput('skype', $skype, 'valid', 'skype', '', '','') ?>

                        </div>
                    </div>
                    <div style="float: left; width: 100%">

                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3">Facebook</label>
                            <?php echo _returnInput('facebook', $face, 'valid', 'facebook', '', '','') ?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <label for="form-field-select-3">Tài khoản ngân hàng </label>
                            <?php echo _returnInput('account_number_bank', $account_number_bank, 'valid', 'qrcode', '', '','') ?>

                        </div>
                    </div>
                    <div style="float: left; width: 100%">

                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3">Ngân hàng </label>
                            <?php echo _returnInput('bank', $bank, 'valid', 'university', '', '','') ?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <label for="form-field-select-3">Chi nhánh </label>
                            <?php echo _returnInput('open_bank', $open_bank, 'valid', 'map-marker', '', '','') ?>

                        </div>
                    </div>
                    <div style="float: left; width: 100%">

                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3">CMTND </label>
                            <?php echo _returnInput('cmnd', $cmnd, 'valid', 'qrcode', '', '','') ?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <label for="form-field-select-3">Ngày cấp CMTND</label>
                            <?php echo _returnInputDate('date_range_cmnd', $date_range_cmnd, 'valid', '', '','')?>

                        </div>
                    </div>
                    <div style="float: left; width: 100%">

                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3"> Nơi cấp CMTND</label>
                            <?php echo _returnInput('issued_by_cmnd', $issued_by_cmnd, 'valid', 'map-marker', '', '','') ?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                            <label for="form-field-select-3"> Mô tả khách hàng</label><br>
                            <textarea style="width: 100%" name="note"  rows="8"><?php echo $note?></textarea>

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
<!--<style>-->
<!--    .modal-footer {-->
<!--        position: fixed;-->
<!--        bottom: 60px;-->
<!--        right: 35px;-->
<!--        width: 81%;-->
<!--    }-->
<!--</style>-->






