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
                                    <div class="profile-info-name"> Mã booking</div>

                                    <div class="profile-info-value">
                                        <?php echo _returnInput('code_booking', '', 'valid', 'qrcode', '', '','') ?>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Họ tên</div>

                                    <div class="profile-info-value form-group">
                                        <span class="editable editable-click hidden_edit">Mr.Trần Văn Tùng</span>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="row header smaller lighter green">
                            <i class="ace-icon fa fa-user"></i>
                            Thông tin khách hàng
                        </h3>
                        <div class="row col-xs-12">
                            sadfasdfsadfsdaf
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






