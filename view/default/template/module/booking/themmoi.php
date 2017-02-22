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
                    <style>
                        .header{
                            float: left;
                            width: 100%;
                        }
                        .profile-user-info {
                            width: 100%;
                        }
                        .div_content{
                            padding-left: 0px;
                            padding-right: 0px;
                        }
                    </style>
                    <div class="col-xs-12 col-sm-12 col-md-12 row">
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <h3 class="row header smaller lighter orange">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-shopping-cart"></i>
												Thông tin booking
											</span>
                            </h3>
                            <div class="col-xs-12 row div_content">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Mã booking <span style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value">
                                            <?php echo _returnInput('code_booking', '', 'valid', 'qrcode', '', '','') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tiền tệ <span style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('tien_te',$tien_te,$data_list_tien_tee,'valid', 'Tiền tệ ...')?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tỷ giá </div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('ty_gia', '', 'valid', 'exchange', '', '','') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Ngày bắt đầu <span style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('ngay_bat_dau', '', '', '', '','')?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Hạn thanh toán <span style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputDate('han_thanh_toan', '', '', '', '','')?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tình trạng </div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('status',$status,$data_list_status,'valid', 'Trạng thái ...')?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Httt <span style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputSelect('hinh_thuc_thanh_toan',$hinh_thuc_thanh_toan,$data_list_httt,'valid', 'Hình thức thanh toán ...')?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Số người <span style="color: red; font-size: 12px">*</span> </div>

                                        <div class="profile-info-value form-group">
                                            <style>
                                                .ace-spinner{
                                                    width: 32% !important;
                                                }
                                                .check_div label{
                                                    margin-bottom: 0px;
                                                    margin-top: 5px;
                                                }
                                            </style>
                                            <input name="num_nguoi_lon" type="text" id="input_num_nguoi_lon" title="Số người lớn" class="spinbox-input form-control text-center" placeholder="Người lớn">
                                            <input name="num_tre_em"  type="text" id="input_num_tre_em" title="Số trẻ em từ 5 đến 11 tuổi" class="spinbox-input form-control text-center" placeholder="Trẻ em  5-11 tuổi">
                                            <input name="num_tre_em_5" type="text" id="input_num_tre_em_5" title="Số trẻ em dưới 5 tuổi" class="spinbox-input form-control text-center" placeholder="Trẻ em dưới 5 tuổi">
                                        </div>
                                    </div>
                                    <div class="profile-info-row check_div">
                                        <div class="profile-info-name"> Thuế VAT(10%) </div>

                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInputCheck('vat', 'valid', '', '')?>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7">
                            <h3 class="row header smaller lighter blue">
                                <i class="ace-icon fa fa-plane fa-plane blue bigger-125"></i>
                                Thông tin tour
                            </h3>
                            <div class="row col-xs-12">
                                sadfasdfsadfsdaf
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 row">
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <h3 class="row header smaller lighter green">
                                <i class="ace-icon fa fa-user"></i>
                                Thông tin khách hàng
                            </h3>
                            <div class="row col-xs-12 div_content">
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Tên khách hàng <span style="color: red; font-size: 12px">*</span></div>

                                        <div class="profile-info-value form-group">
                                         <span class="input-icon width_100">
                                            <input id="input_name_customner" autofocus="" type="text" name="name_customner" placeholder="Nhập tên khách hàng ..." style="width:100%;max-width:600px;outline:0" autocomplete="off">
                                             <i class="ace-icon fa fa-user blue"></i>
                                         </span>
                                            <input hidden id="input_id_customner"  type="text" name="id_customner">
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Email <span style="color: red; font-size: 12px">*</span> </div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('email', '', '', 'envelope', '', '','') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Địa chỉ <span style="color: red; font-size: 12px">*</span> </div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('address', '', '', 'map-marker', '', '','') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Số điện thoại <span style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('phone', '', '', 'phone', '', '','') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Fax</div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('fax', '', 'valid', 'fax', '', '','') ?>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Nhóm khách hàng <span style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group nhom_khach_hang">
                                            <?php echo _returnInputSelect('nhom_khach_hang','',$data_list_customer_category,'valid', 'Nhóm khách hàng ...')?>
                                        </div>
                                        <input hidden  id="input_id_category"  type="text" name="id_category">
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Điểm đón <span style="color: red; font-size: 12px">*</span></div>
                                        <div class="profile-info-value form-group">
                                            <?php echo _returnInput('diem_don', '', '', 'map-marker', '', '','') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7">
                            <h3 class="row header smaller lighter purple">
                                <i class="ace-icon fa fa-users"></i>
                                Danh sách đoàn
                            </h3>
                            <div class="row col-xs-12">
                                sadfasdfsadfsdaf
                            </div>
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






