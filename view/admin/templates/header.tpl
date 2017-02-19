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
                <li class="dropdown {kichhoat_thucdon}" ><a href="#"><span class="icon-wrench"></span> Phân quyền module</a>
                    <ul>
                        <li><a href="{SITE-NAME}/controller/admin/permison_module.php">Quyền module</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/permison_form.php">Quyền form</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/permison_action.php">Quyền action</a></li>
                    </ul>
                </li>
                <li class="{kichhoat_chucvu_nhanvien}" ><a href="{SITE-NAME}/controller/admin/user_chucvu.php"><span class="icon-user"></span> Chức vụ nhân viên</a></li>
                <li class="{kichhoat_phongban_nhanvien}" ><a href="{SITE-NAME}/controller/admin/user_phongban.php"><span class="icon-user"></span> Phòng ban nhân viên</a></li>
                <li class="dropdown {kichhoat_thucdon}" ><a href="#"><span class="icon-wrench"></span> Quản lý khách  hàng</a>
                    <ul>
                        <li><a href="{SITE-NAME}/controller/admin/customer_career.php">Nghề nghiệp khách hàng</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/customer_category.php">Danh mục khách hàng</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/customer_resources_to.php">Nguồn khách hàng</a></li>
                    </ul>
                </li>
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