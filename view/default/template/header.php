<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $title?></title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/font-awesome/4.2.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/chosen.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/daterangepicker.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/colorpicker.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />

    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/ace-ie.min.css" />

    <!-- my style-->
    <link rel="stylesheet" href="<?php echo SITE_NAME?>/view/default/themes/admin/assets/css/mycss.css" />
    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->


    <script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/html5shiv.min.js"></script>
    <script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/respond.min.js"></script>
    <script type="text/javascript">
        var sitename='<?php echo SITE_NAME?>';
    </script>
    <script type="text/javascript" src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        function openKcEditor(output) {
            var T_Tungtv = document.getElementsByName(output);
            var Tungtv = T_Tungtv[0];
            window.KCFinder = {
                callBack: function (url) {
                    window.KCFinder = null;
                    Tungtv.value = url;
                }
            };
            window.open('<?php echo SITE_NAME?>/view/default/themes/admin/assets/kcfinder/browse.php?type=images&dir=images/public',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
        );
        }
        ;
    </script>
</head>

