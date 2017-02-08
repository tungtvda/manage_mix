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
if(isset($_POST['login'])&&isset($_POST['username_login'])&&isset($_POST['password_login']))
{
    $username=_returnPostParamSecurity('username_login');
    $password=_returnPostParamSecurity('password_login');
    if($username==''||$password==''){
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng nhập")</script>';
    }
    else{
        $Pass=hash_pass($password);
        $dk="(user_name='".$username."' or user_email='".$username."') and password='".$Pass."'";
        $data_check=user_getByTop('1',$dk,'');
        if(count($data_check)==0){
            echo '<script>alert("Đăng nhập thất bại!. Bạn vui lòng kiểm tra lại thông tin đăng nhập")</script>';
        }
        else{
            if($data_check[0]->status==0)
            {
                echo '<script>alert("Đăng nhập thất bại!. Tài khoản của bạn hiện chưa được kích hoạt")</script>';
            }
            else{
                $id=$data_check[0]->id;
                $user_role=$data_check[0]->user_role;
                $login_two_steps=$data_check[0]->login_two_steps;
                $user_email=$data_check[0]->user_email;
                $user_name=$data_check[0]->name;
                $user_role=$data_check[0]->user_role;
                $user_permison_action=$data_check[0]->permison_action;
                $user_permison_form=$data_check[0]->permison_form;
                $user_permison_module=$data_check[0]->permison_module;
                $user_update=new user();
                $user_update->id=$id;
                if($login_two_steps==1){
                    $rand_string=_returnRandString(15);
                    $user_update->code_login=$rand_string;
                    $_SESSION['show_email']=$user_email;
                    $_SESSION['show_id']=$id;
                    user_update_code_login($user_update);
                    $subject = "Mã đăng nhập vào hệ thống MIXTOURIST";
                    $message='';
                    $message .='<div style="float: left; width: 100%">
                            <p>Mã đăng nhập: <span style="color: #132fff; font-weight: bold"> '.$rand_string.'</span></p>
                            <p>Bạn hãy nhập mã xác nhận '.$rand_string.' để đăng nhập được vào hệ thống</p>
                        </div>';
                    SendMail($user_email, $message, $subject);
                    redict(SITE_NAME.'/xac-nhan.html');
                }
                else{
                    $data_arr=array(
                        'user_id'=>$id,
                        'user_role'=>$user_role,
                        'user_name'=>$user_name,
                        'user_permison_action'=>$user_permison_action,
                        'user_permison_form'=>$user_permison_form,
                        'user_permison_module'=>$user_permison_module
                    );
                    _returnLogin($data_arr,$user_update);
//
                }
            }

        }
    }

}
if(isset($_POST['dangky_name'])&&isset($_POST['email_dangky'])&&isset($_POST['username_dangky'])&&isset($_POST['password_dangky'])&&isset($_POST['confirm_password_dangky'])){
    $email=_returnPostParamSecurity('email_dangky');
    $username_dk=_returnPostParamSecurity('username_dangky');
    $password_dk=_returnPostParamSecurity('password_dangky');
    $confirm_password=_returnPostParamSecurity('confirm_password_dangky');
    if($email==''||$username_dk==''||$password_dk==''||$confirm_password==''){
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';
    }
    else{
        if($password_dk!=$confirm_password){
            echo '<script>alert("Hai mật khẩu không khớp")</script>';
        }
        else{
            $dk_check_username="user_name='".$username_dk."'";
            $dk_check_email="user_email ='".$email."'";
            $data_check_exist_name=user_getByTop('',$dk_check_username,'id desc');
            $data_check_exist_email=user_getByTop('',$dk_check_email,'id desc');
            if(count($data_check_exist_name)>0||count($data_check_exist_email)>0){
                if(count($data_check_exist_name)>0&&count($data_check_exist_email)>0)
                {
                    echo "<script>alert('Username và email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                }
                else{
                    if(count($data_check_exist_name)>0)
                    {
                        echo "<script>alert('Username đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                    }
                    else{
                        echo "<script>alert('Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                    }
                }

            }
            else{
                $dangky = new user();
                $dangky->user_name=$username_dk;
                $dangky->user_email=$email;
                $Pass=hash_pass($password_dk);
                $dangky->password=$Pass;
                $dangky->created=_returnGetDateTime();
                $dangky->login_two_steps=1;
                user_insert($dangky);
                $subject = "Thông báo đăng ký tài khoản tại hệ thống quản ký MIXTOURIST";
                $message='';
                $message .='<div style="float: left; width: 100%">
                            <p>Xin chào: <span style="color: #132fff; font-weight: bold"> '.$username_dk.'</span>!</p>
                            <p>Cảm ơn bạn đã đăng ký tại hệ thống quản trị MIXTOURIST, bạn vui lòng đợi hệ thống của chúng tôi xác nhận tài khoản của bạn, Xin cảm ơn!</p>
                            <p>Email: <span style="color: #132fff; font-weight: bold">'.$email.'</span>,</p>
                            <p>Username: <span style="color: #132fff; font-weight: bold">'.$username_dk.'</span>,</p>
                            <p>Ngày gửi: <span style="color: #132fff; font-weight: bold">'.date("Y-m-d H:i:s", strtotime(_returnGetDateTime())).'</span>,</p>
                        </div>';
                SendMail($email, $message, $subject);
                $email='';
                $username_dk='';
                echo "<script>alert('Bạn đã đăng ký thành công, vui lòng đợi chúng tôi xác nhận tài khoản của bạn, xin cảm ơn!')</script>";
            }


        }
    }
}
if(isset($_POST['send_forgot'])&&isset($_POST['email_forgot'])){
    $email_forgot=_returnPostParamSecurity('email_forgot');
    if($email_forgot==''){
        echo '<script>alert("Bạn vui lòng điền email của bạn, chúng tôi sẽ hướng dẫn bạn đổi lại mật khẩu")</script>';
    }
    else{
        $dk="user_email='".$email_forgot."' and status=1";
        $data_check=user_getByTop('1',$dk,'');
        if(count($data_check)==0){
            echo '<script>alert("Bạn vui lòng kiểm tra lại email")</script>';
        }
        else{
            $rand_string=_returnRandString(15);
            $user_update=new user();
            $user_update->id=$data_check[0]->id;
            $user_update->code_login=$rand_string;
            user_update_code_login($user_update);
            $rand_string_param1=_returnRandString(1999);
            $rand_string_param2=_returnRandString(1999);
            $rand_string_param3=_returnRandString(1999);
            $link=SITE_NAME.'/doi-mat-khau-login/'.$rand_string_param1.'/'.$rand_string.'/'.$rand_string_param2.'/'.$data_check[0]->id.'/'.$rand_string_param3.'/';
            $subject = "Hướng đãn đổi mật khẩu";
            $message='';
            $message .='<div style="float: left; width: 100%">

                            <p>Bạn vui lòng clik  <b><a href="'.$link.'">vào đây</a></b> để thực hiện đổi mật khẩu </p>
                        </div>';
            SendMail($email_forgot, $message, $subject);
            echo "<script>alert('Hệ thống đã gửi hướng dẫn về email của bạn, vui lòng kiểm tra email và làm theo hướng dẫn')</script>";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Đăng nhập - MIXTOURIST</title>

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
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/css/login.css" />

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
                                    <h6 style="font-size: 13px" class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-user-md green"></i>
                                        Vui lòng nhập đầy đủ thông tin đăng nhập
                                    </h6>

                                    <div class="space-6"></div>

                                    <form action="" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="username_login" type="text" class="form-control" required placeholder="Username/email" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="password_login" type="password" required class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" name="ghinho_login" class="ace" />
                                                    <span class="lbl"> Ghi nhớ tài khoản</span>
                                                </label>
                                                <button name="login" type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Login</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>

                                    <div class="social-or-login center">
                                        <span class="bigger-110">Hoặc đăng nhập bằng</span>
                                    </div>

                                    <div class="space-6"></div>

                                    <div class="social-login center">
                                        <a class="btn btn-primary">
                                            <i class="ace-icon fa fa-facebook"></i>
                                        </a>

                                        <a class="btn btn-info">
                                            <i class="ace-icon fa fa-twitter"></i>
                                        </a>

                                        <a class="btn btn-danger">
                                            <i class="ace-icon fa fa-google-plus"></i>
                                        </a>
                                    </div>
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>
                                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            Quên mật khẩu
                                        </a>
                                    </div>

                                    <div>
                                        <a href="#" data-target="#signup-box" class="user-signup-link">
                                            Đăng ký tài khoản
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        Quên mật khẩu
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        Nhập email của bạn và nhận được hướng dẫn
                                    </p>

                                    <form action="" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" required name="email_forgot" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="submit" name="send_forgot" class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">Send Me!</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        Đăng nhập
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.forgot-box -->

                        <div id="signup-box" class="signup-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header green lighter bigger">
                                        <i class="ace-icon fa fa-users blue"></i>
                                        Đăng ký tài khoản mới
                                    </h4>

                                    <div class="space-6"></div>
                                    <p> Nhập chi tiết của bạn để bắt đầu: </p>

                                    <form action="" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" id="email_dangky" name="email_dangky" required class="form-control" placeholder="Email" value="<?php if(isset($email)) echo $email?>" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                                <input type="password" id="check_show_email" hidden value="0">
                                                <span hidden id="mess_email_dang_ky" style="color: red; font-size: 13px">Email đã tồn tại trong hệ thống</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="username_dangky" name="username_dangky" required class="form-control" value="<?php if(isset($username_dk)) echo $username_dk?>" placeholder="Tên đăng nhập" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                                                <input type="password" id="check_show_username" hidden value="0">
                                                <span hidden id="mess_username_dang_ky" style="color: red; font-size: 13px">Username đã tồn tại trong hệ thống</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="password_dangky" name="password_dangky" required class="form-control" placeholder="Mật khẩu" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                                <input type="password" id="check_show_pass" hidden value="0">
                                                <span  id="power_pass" style="font-size: 13px"></span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" id="confirm_password_dangky" name="confirm_password_dangky" required class="form-control" placeholder="Xác nhận mật khẩu" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
                                                <span hidden id="mess_confirm_password_dangky" style="color: red; font-size: 13px">Hai mật khẩu không khớp</span>
                                            </label>

                                            <div class="clearfix">
                                                <input type="password" id="site_name" hidden value="<?php echo SITE_NAME?>">

                                                <button id="reset_login" type="reset" class="width-30 pull-left btn btn-sm">
                                                    <i class="ace-icon fa fa-refresh"></i>
                                                    <span class="bigger-110">Hủy</span>
                                                </button>

                                                <button type="submit" id="dangky_name" name="dangky_name" class="width-65 pull-right btn btn-sm btn-success">
                                                    <span class="bigger-110">Đăng ký</span>

                                                    <i class="ace-icon fa fa-sign-in icon-on-right"></i>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        Đăng nhập
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.signup-box -->
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
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/login.js"></script>
</body>
</html>

