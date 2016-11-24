<!DOCTYPE html>

<!-- Mirrored from demo.themepixels.com/webpage/katniss/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2015 09:21:11 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MIXTOURIST ADMIN</title>
    <link rel="stylesheet" href="{SITE-NAME}/view/admin/Themes/css/style.default.css" type="text/css"/>
    <link rel="stylesheet" href="{SITE-NAME}/view/admin/Themes/css/prettify.css" type="text/css"/>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/prettify.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery-migrate-1.1.1.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery-ui-1.9.2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#DanhMuc1Id").change(function() {
                $.post('{SITE-NAME}/controller/default/ajax.php',
                        {
                            Tour:$('#DanhMuc1Id  option:selected').val()
                        },
                        function(data,status){
                            $("#DanhMuc2Id").html(data);
                        });
            });

        });

        //
    </script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.flot.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/modernizr.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/detectizr.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/custom.js"></script>
    <!--[if lte IE 8]>
    <script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript">
        var sitename='{SITE-NAME}';
    </script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/ckeditor/ckeditor.js"></script>

</head>

<body>

<div class="mainwrapper">

    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">

        <div class="logopanel" style="text-align: center!important;">
           <a href="{SITE-NAME}"><img style="height: 36px" src="{SITE-NAME}/view/admin/Themes/kcfinder/upload/images/config/logo.png" title="Hệ thống quản trị của Vifonic.com" alt="Hệ thống quản trị của Vifonic.com"></a>
        </div>
        <!--logopanel-->

        <div class="datewidget"><iframe scrolling="no" frameborder="no" style="overflow:hidden;border:0;margin:0;padding:0;width:235px;height:45px;"src="http://clocklink.com/html5embed.php?clock=lat&timezone=ICT&color=gray&size=235&Title=&Message=&Target=&From=2015,1,1,0,0,0&Color=gray"></iframe></div>

        <div class="searchwidget">
            <form action="" method="post">
                <div class="input-append">
                    <input type="text" class="span2 search-query" name="giatri" placeholder="Tìm kiếm...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div>
        <!--searchwidget-->


        <!--plainwidget-->

        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Main Navigation</li>
                <li class="{kichhoat}"><a href="{SITE-NAME}/admin"><span class="icon-align-justify"></span> Dashboard</a></li>
                <li class="{kichhoat_admin}" ><a href="{SITE-NAME}/controller/admin/admin.php"><span class="icon-user"></span> Tài khoản quản trị</a></li>
                <li class="{kichhoat_config}"><a href="{SITE-NAME}/controller/admin/config.php"><span class=" icon-wrench"></span> Cấu hình hệ thống</a></li>
                <li class="{kichhoat_dathang}"><a href="{SITE-NAME}/controller/admin/booking_table.php"><span class="icon-shopping-cart"></span> Đặt Bàn <span style="color: red; float: right">{count_booking}</span></a></li>
                <li class="{kichhoat_lienhe}"><a href="{SITE-NAME}/controller/admin/contact.php"><span class="icon-envelope"></span> Liên hệ <span style="color: red; float: right">{count_contact}</span></a></li>
                <li class="{kichhoat_dangky}"><a href="{SITE-NAME}/controller/admin/dangky_email.php"><span class="icon-envelope"></span> Đăng ký email <span style="color: red; float: right">{count_dangky}</span></a></li>
                <li class="{kichhoat_danhgia}"><a href="{SITE-NAME}/controller/admin/danhgia.php"><span class="icon-envelope"></span> Đánh giá thực đơn <span style="color: red; float: right">{count_danhgia}</span></a></li>

                <li class="dropdown {kichhoat_thucdon}" ><a href="#"><span class=" icon-plane"></span> Thực đơn</a>
                    <ul>
                        <li><a href="{SITE-NAME}/controller/admin/danhmuc1.php">Danh mục 1</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/danhmuc2.php">Danh mục 2</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/sanpham.php">Danh sách thực đơn </a></li>
                    </ul>
                </li>
                <li class="dropdown {kichhoat_tintuc}"><a href="#"><span class=" icon-edit"></span> Cẩm nang</a>
                    <ul>
                        <li><a href="{SITE-NAME}/controller/admin/danhmuc_tintuc.php">Danh mục</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/news.php">Danh sách </a></li>
                    </ul>
                </li>

                <li class="{kichhoat_tuyendung}"><a href="{SITE-NAME}/controller/admin/tuyendung.php"><span class="icon-facetime-video"></span> Tuyển dụng </a></li>
                <li class="{kichhoat_gioithieu}"><a href="{SITE-NAME}/controller/admin/info.php"><span class="icon-facetime-video"></span> Giới thiệu</a></li>
                <li class="{kichhoat_slide}"><a href="{SITE-NAME}/controller/admin/slide.php"><span class="icon-film"></span> Slide</a></li>
                <li class="{kichhoat_menu}"><a href="{SITE-NAME}/controller/admin/menu.php"><span class="icon-th-list"></span> Cấu hình menu</a></li>
                <li class="{kichhoat_mangxahoi}"><a href="{SITE-NAME}/controller/admin/social.php"><span class=" iconfa-facebook"></span> Mạng xã hội</a></li>
                <li class="{kichhoat_ykien}"><a href="{SITE-NAME}/controller/admin/ykien.php"><span class="icon-comment"></span> Ý kiến khách hàng</a></li>
            </ul>
        </div>
        <!--leftmenu-->

    </div>
    <!--mainleft-->
    <!-- END OF LEFT PANEL -->

    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
        <div class="headerpanel">
            <a href="#" class="showmenu"></a>

            <div class="headerright">


                <div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#"
                       href="#">Xin chào, {USER-NAME} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{SITE-NAME}"><span class=" icon-globe"></span>Tới website</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/signout.php"><span class="icon-share"></span> Đăng xuất</a></li>

                    </ul>
                </div>
                <!--dropdown-->

            </div>
            <!--headerright-->

        </div>
        <!--headerpanel-->
        <div class="breadcrumbwidget">

            <ul class="breadcrumb">
                <li><a href="{SITE-NAME}/admin">Home</a> <span class="divider">/</span></li>

            </ul>
        </div>
        <!--breadcrumbwidget-->
        <div class="pagetitle">
            <h1>Hệ thống quản trị {SITE-NAME}</h1>
        </div>
        <!--pagetitle-->

        <div class="maincontent">