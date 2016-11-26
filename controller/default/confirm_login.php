<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}
require_once DIR.'/controller/default/public.php';
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
require_once DIR.'/model/userService.php';
require_once(DIR."/common/hash_pass.php");
if(isset($_SESSION['show_email'])&&isset($_SESSION['show_id'])){
    $email=$_SESSION['show_email'];
    $id=$_SESSION['show_id'];
}
else{
    redict(_returnLinkDangNhap());
}
if(isset($_POST['xacnhan'])&&isset($_POST['code']))
{
    $code_login=_returnPostParamSecurity('code');
    $dk="(user_name='".$email."' or user_email='".$email."') and id='".$id."' and status=1 and code_login='".$code_login."'";
    $data_check=user_getByTop('1',$dk,'');
    if(count($data_check)==0){
        echo '<script>alert("Mã xác nhận không chính xác, bạn vui lòng nhập lại")</script>';
    }
    else{
        $id=$data_check[0]->id;
        $user_role=$data_check[0]->user_role;
        $login_two_steps=$data_check[0]->login_two_steps;
        $user_email=$data_check[0]->user_email;
        $user_role=$data_check[0]->user_role;
        $user_permison_action=$data_check[0]->permison_action;
        $user_permison_form=$data_check[0]->permison_form;
        $user_permison_module=$data_check[0]->permison_module;
        $user_update=new user();
        $user_update->id=$id;
        $data_arr=array(
            'user_id'=>$id,
            'user_role'=>$user_role,
            'user_permison_action'=>$user_permison_action,
            'user_permison_form'=>$user_permison_form,
            'user_permison_module'=>$user_permison_module
        );
        _returnLogin($data_arr,$user_update);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Xác nhận đăng nhập thệ thống - MIXTOURIST</title>

    <meta name="description" content="User login page" />
    <link rel="shortcut icon" href="<?php echo SITE_NAME?>/view/default/themes/images/faviconmix.png">
    <link rel="apple-touch-icon" href="<?php echo SITE_NAME?>/view/default/themes/images/faviconmix.png">
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo SITE_NAME?>/view/default/themes/images/faviconmix.png">
    <link rel="apple-touch-icon" sizes="114x114"
          href="{<?php echo SITE_NAME?>/view/default/themes/images/faviconmix.png">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/font-awesome/4.2.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace.min.css" />


    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace-part2.min.css" />

    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace-rtl.min.css" />


    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace-ie.min.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/html5shiv.min.js"></script>
    <script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/respond.min.js"></script>
</head>

<body style="background:url('<?php echo SITE_NAME?>/view/default/themes/images/square.gif')" class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <img  src="<?php echo SITE_NAME?>/view/default/themes/images/logo.png">
                        </h1>

                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h6 style="font-size: 12px" class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-user-md green"></i>
                                        Bạn hãy nhập mã xác nhận đã được gửi tới email </br><span style="font-size: 14px; text-align: center">"<?php echo $email?>"</span>
                                    </h6>

                                    <div class="space-6"></div>

                                    <form action="" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="code" type="text" class="form-control" required placeholder="Mã xác nhận" />
															<i class="ace-icon fa fa-barcode"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <button name="xacnhan" type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-thumbs-up"></i>
                                                    <span class="bigger-110">Xác nhận</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>
                                        <a href="<?php echo SITE_NAME?>/dang-nhap.html"  class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            Đăng nhập
                                        </a>
                                    </div>

                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->
                    </div><!-- /.position-relative -->

                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');
            $(target).addClass('visible');
        });
    });



    //you don't need this, just used for changing background
    jQuery(function($) {
        $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });

    });
</script>
</body>
</html>

