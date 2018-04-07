
</div><!-- /.page-content -->

</div>
</div><!-- /.main-content -->

<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Tungtv</span>
							Application &copy; 2016-2017
						</span>

            &nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

							<a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

							<a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
						</span>
        </div>
    </div>
</div>
<input hidden value="<?php echo SITE_NAME?>" id="url_input">
<input hidden value="<?php echo $_SESSION['user_id']?>" id="user_id">
<input hidden id="page_noti" name="page" value="1">
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div>

<!--<script src="--><?php //echo SITE_NAME?><!--/view/default/themes/admin/assets/js/jquery-2.1.4.min.js"></script>-->
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.2.1.1.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.1.11.1.min.js"></script>

<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.min.js'>"+"<"+"/script>");
</script>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/bootstrap.min.js"></script>


<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/dataTables.colVis.min.js"></script>


<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/excanvas.min.js"></script>

<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/fuelux.spinner.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/moment.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/daterangepicker.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.knob.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.autosize.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/bootstrap-tag.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/ace-elements.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/ace.min.js"></script>
<script type="text/javascript"
        src="<?php echo SITE_NAME_AZ?>/view/default/themes/js/jquery.timeago.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/myjs.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/dialog.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/myjs.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/ggtooltip.js"></script>
<script type="text/javascript" src="<?php echo SITE_NAME?>/view/default/themes/admin/js/jquery.easyui.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/socket.io.js"></script>

<script>
    var socket=io("<?php echo SERVER_SOCKET?>");
    var data=[
        <?php echo $_SESSION['user_id']?>,
        <?php echo $_SESSION['user_role']?>,
        "<?php echo $_SESSION['user_name']?>"
    ];
    socket.emit('registerAdmin',data);
</script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/read_socket_all.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/show_confirm_noti.js"></script>




























