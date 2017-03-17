<?php /* Smarty version 2.6.25, created on 2017-03-16 20:05:23
         compiled from tpl_body:23 */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'search', 'tpl_body:23', 27, false), array('function', 'menu', 'tpl_body:23', 36, false), array('function', 'news', 'tpl_body:23', 51, false), array('function', 'cms_module', 'tpl_body:23', 58, false), array('function', 'cms_selflink', 'tpl_body:23', 76, false), array('function', 'global_content', 'tpl_body:23', 136, false), array('function', 'Statistics', 'tpl_body:23', 174, false), array('function', 'content', 'tpl_body:23', 179, false),)), $this); ?>
<?php $this->_cache_serials['/home/dulichado/domains/tourdulichmy.vn/public_html/tmp/templates_c/%%01^013^01360D26%%tpl_body%3A23.inc'] = '9ac7b4943c1309869ad9d28717df7d5c'; ?>
<body>
<div class="header">
    <div class="menutop">
        <div class="mnutop">
            <a class=" " href="http://tourdulichmy.vn/y-kien-khach-hang/">Ý kiến khách hàng</a> | <a
                href="http://tourdulichmy.vn/gioi-thieu ">Giới thiệu</a> | <a href="http://tourdulichmy.vn/lien-he">Liên
                hệ</a>
        </div>
    </div>
    <div id="header">
        <div id="logo">
            <a href="http://tourdulichmy.vn"><img src="http://mixtourist.com.vn/images/logomix.png"
                                                  alt="Tour du lịch Mỹ"/></a>
            <div class="logotop">
                <p>
                    <span style="margin-right:5px;">0943 838 222</span>
                </p>
                <p>
                    <span style="margin-right:5px;">info@mixtourist.com.vn</span>
                </p>
            </div>
        </div>
        <div id="thongtinheader">
            <img src="jv/layout/images/sloganmy.jpg" alt="du lich My"/>
            <h1 style="display:none;">Du lịch Mỹ, Du lịch Hoa Kỳ</h1>
        </div>
        <div class="top">
            <div class="msearch">
                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#0}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '0');
                echo smarty_cms_function_search(array('resultpage' => "tim-kiem", 'searchtext' => "Tìm kiếm...", 'submit' => "Tìm kiếm"), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#0}'; endif; ?>

            </div> <!-- //search-->
        </div>

    </div>
</div>
<div class="menu">
    <div id="pmenu">
        <div id="container">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#1}'; endif;
            $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '1');
            echo smarty_cms_function_menu(array('template' => 'cssmain_menu.tpl', 'childrenof' => 'vn', 'number_of_levels' => '2'), $this);
            if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#1}'; endif; ?>

        </div>
        <nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-top">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#2}'; endif;
            $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '2');
            echo smarty_cms_function_menu(array('template' => 'menu_mobi.tpl', 'number_of_levels' => 2, 'childrenof' => 'vn'), $this);
            if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#2}'; endif; ?>

        </nav>
    </div>
    <?php echo '<script type="text/javascript">tabs.init("pmenu", 0)</script>'; ?>

</div>

<div class="main">
    <div class="focus">
        <div class="lfocus"></div>
        <div class="cfocus">
            <div class="slidedonv">
                <div id="ct_left">
                    <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#3}'; endif;
                    $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '3');
                    echo smarty_cms_function_news(array('summarytemplate' => 'tmpslideshow', 'number' => '4', 'category' => "Tin tức Sự kiện,Văn hóa Lịch sử,Thắng cảnh nổi tiếng,Thông tin hữu ích,Ẩm thực", 'detailpage' => "thong-tin", 'classification' => '1'), $this);
                    if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#3}'; endif; ?>

                </div>
                <div id="ct_right">
                    <div id="featured_destinations" class="right_all featured_destinations01">
                        <!--							<div class="msupport">-->
                        <!--								<div id="title1"><img src="jv/layout/images/hotro.png" alt="Hỗ trợ trực tuyến" /></div>-->
                        <!--								<div id="hLine2"></div>-->
                        <!--								 --><?php //if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#4}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c','4');echo smarty_cms_function_cms_module(array('module' => 'support'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#4}'; endif;?>
                        <!---->
                        <!--							</div>-->
                        <div class="msupport">
                            <div id="title1"><img src="jv/layout/images/hotro.png" alt="Hỗ trợ trực tuyến"></div>
                            <div id="hLine2"></div>
								 <span id="sp">
	<p><a class="yahoo" href="ymsgr:sendIM?mixtourist">
            <img style=" width: 80px;" src="jv/layout/images/yahoo.png" alt="mixtourist">
        </a>
        <a href="skype:mixtourist?chat">
            <img src="http://vemaybay.azbooking.vn/image/sky.png" style="border: none;" alt="Skype Me™!">
        </a></p>
	<p><a class="yahoo" href="ymsgr:sendIM?mixtourist">Văn phòng Hà Nội</a> -
        <b>0975 820 479</b>
    </p>
	<div class="clear"></div>
</span>
<span id="sp">
	<p><a class="yahoo" href="ymsgr:sendIM?mixtourist">
            <img style=" width: 80px;" src="jv/layout/images/yahoo.png" alt="mixtourist">
        </a>
        <a href="skype:mixtourist?chat">
            <img src="http://vemaybay.azbooking.vn/image/sky.png" style="border: none;" alt="Skype Me™!">
        </a></p>
	<p><a class="yahoo" href="ymsgr:sendIM?mixtourist">Văn phòng TP.HCM</a> -
        <b>094 3838 222</b>
    </p>
	<div class="clear"></div>
</span>
<span id="sp">
	<p><a class="yahoo" href="ymsgr:sendIM?hoangthuy_mixtourist">
            <img style=" width: 80px;" src="jv/layout/images/yahoo.png" alt="hoangthuy_mixtourist">
        </a>
        <a href="skype:hoangthuy_mixtourist?chat">
            <img src="http://vemaybay.azbooking.vn/image/sky.png" style="border: none;" alt="Skype Me™!">
        </a></p>
	<p><a class="yahoo" href="ymsgr:sendIM?hoangthuy_mixtourist">Tour nước ngoài khác</a> -
        <b>0974.910.891</b>
    </p>
	<div class="clear"></div>
</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rfocus"></div>
        <div class="clear"></div>
    </div>


    <div class="content">
        <div class="view">
            <div class="tview"></div>
            <!-- danh sach tour-->
            <div class="mview">
                <!--<div id="left_tour">
					<div id="title">
						<h3><a href="<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#5}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '5');
                echo smarty_cms_function_cms_selflink(array('href' => 'khoi-hanh-tu-ha-noi'), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#5}'; endif; ?>
">
						<img alt="Du lịch Mỹ Khởi hành từ Hà Nội" src="jv/layout/images/dulichvn.png" />
						<img alt="Du lịch Mỹ Khởi hành từ Hà Nội" src="jv/layout/images/new.gif" />
						</a>
						</h3>
					</div>
					<div id="hLine2"></div>
									</div> <!-- left tour-->

                <!--<div id="right_tour">
					<div id="title">
						<h3><a href="<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#6}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '6');
                echo smarty_cms_function_cms_selflink(array('href' => 'khoi-hanh-tu-tp-hcm'), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#6}'; endif; ?>
">
							<img alt="Du lịch TPHCM Khởi hành từ TPHCM" src="jv/layout/images/dulichnn.png" />
							<img alt="Du lịch TPHCM Khởi hành từ TPHCM" src="jv/layout/images/new.gif" /></a>
						</h3>
					</div>
					<div id="hLine2"></div>
									</div><!-- right tour-->
                <div id="title1">
                    <h3>
                        <a href="<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#7}'; endif;
                        $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '7');
                        echo smarty_cms_function_cms_selflink(array('href' => 'du-lich-my'), $this);
                        if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#7}'; endif; ?>
"><img src="jv/layout/images/tour-noi-bat.png" alt="Tour du lich My"/></a></h3>
                </div>
                <div id="hLine2"></div>
                <div class="top_tour">
                    <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#8}'; endif;
                    $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '8');
                    echo smarty_cms_function_cms_module(array('module' => 'quanlytour', 'query' => '12', 'nbperpage' => '4', 'orderby' => 'created', 'listtemplate' => 'tmp_noibat', 'detailpage' => "du-lich-my", 'forcelist' => '1'), $this);
                    if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#8}'; endif; ?>

                </div>

            </div> <!-- //mview -->
            <div class="bview"></div>
            <div class="clear"></div>

            <!--Tin tuc - su kien-->
            <div class="tnews"></div>
            <div class="mnews">
                <div id="title1">
                    <h3>
                        <a href="<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#9}'; endif;
                        $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '9');
                        echo smarty_cms_function_cms_selflink(array('href' => 'du-lich-my'), $this);
                        if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#9}'; endif; ?>
"><img src="jv/layout/images/tourbanchay.png" alt="Tour du lich My"/></a></h3>
                </div>
                <div id="hLine2"></div>
                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#10}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '10');
                echo smarty_cms_function_cms_module(array('module' => 'quanlytour', 'nbperpage' => '8', 'orderby' => 'created', 'listtemplate' => 'tmp_banchay', 'detailpage' => "du-lich-my", 'forcelist' => '1'), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#10}'; endif; ?>

                <div class="clear"></div>
            </div>
            <div class="bnews"></div>


        </div> <!-- // view left website-->

        <div class="rview">
            <div class=" customer">
                <div id="title1"><a class="sendinfo" href="http://tourdulichmy.vn/y-kien-khach-hang/"><img
                            src="http://tourdulichmyanmar.vn/jv/layout/images/ykienkhachhang-title.png"
                            alt="Ý kiến khách hàng"/></a></div>
                <div id="hLine2"></div>
                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#11}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '11');
                echo smarty_cms_function_news(array('summarytemplate' => 'title2', 'number' => '9', 'category' => "Ý kiến khách hàng", 'detailpage' => "y-kien-khach-hang"), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#11}'; endif; ?>

            </div>
            <!-- //y kien khach hang-->
            <div class=" customer">
                <div id="title1"><a class="sendinfo" href="http://tourdulichmy.vn/thong-tin"><img
                            src="jv/layout/images/tintuc.png" alt="Tin tuc"/></a></div>
                <div id="hLine2"></div>
                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#12}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '12');
                echo smarty_cms_function_news(array('summarytemplate' => 'title2', 'number' => '8', 'category' => "Tin tức Sự kiện,Văn hóa Lịch sử,Thắng cảnh nổi tiếng,Thông tin hữu ích,Ẩm thực", 'detailpage' => "thong-tin"), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#12}'; endif; ?>

            </div>

            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#13}'; endif;
            $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '13');
            echo smarty_cms_function_global_content(array('name' => 'googleplus'), $this);
            if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#13}'; endif; ?>

            <div class="social">
                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#14}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '14');
                echo smarty_cms_function_global_content(array('name' => 'block_fanpage'), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#14}'; endif; ?>

                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#15}'; endif;
                $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '15');
                echo smarty_cms_function_global_content(array('name' => 'mang-xa-hoi'), $this);
                if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#15}'; endif; ?>

            </div>
        </div>

    </div><!-- //content-->

    <div class="clear"></div>
    <!-- quang cao -->
    <!--<div class="advs">
		<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#16}'; endif;
    $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '16');
    echo smarty_cms_function_global_content(array('name' => 'quangcaobottom'), $this);
    if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#16}'; endif; ?>

	</div>
	<div class="clear"></div>-->
    <div class="listvideo">
        <div id="title1"><a class="sendinfo" href="http://tourdulichmy.vn/videos"><img
                    src="jv/layout/images/videomy.png" alt="Video du lich my"/></a></div>
        <div id="hLine2"></div>
        <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#17}'; endif;
        $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '17');
        echo smarty_cms_function_cms_module(array('module' => 'youtubeplayer', 'listtemplate' => 'list_slide', 'detailpage' => 'videos'), $this);
        if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#17}'; endif; ?>

    </div>
    <div id="bottom_menu">
        <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#18}'; endif;
        $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '18');
        echo smarty_cms_function_menu(array('template' => 'cssmenu_bottom.tpl', 'childrenof' => 'vn', 'number_of_levels' => '1'), $this);
        if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#18}'; endif; ?>

    </div>

    <?php echo '
			<style type="text/css">
				#footer{line-height: 19px; width: 81%;}
				.counter{float: right;
					margin-top: 22px;
					padding: 5px;
					text-align: right;}
			</style>
		'; ?>

    <div class="footer">
        <div id="footer">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#19}'; endif;
            $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '19');
            echo smarty_cms_function_global_content(array('name' => 'footer'), $this);
            if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#19}'; endif; ?>

        </div>
        <div class="counter">
			<span class="online"><p>Đang online:
                    200<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#20}'; endif;
                    $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '20');
                    echo $this->_plugins['function']['Statistics'][0][0]->function_plugin(array('what' => 'online'), $this);
                    if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#20}'; endif; ?>
                </p></span>
			<span class="all"><p>Tổng số truy cập:
                    2<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#21}'; endif;
                    $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '21');
                    echo $this->_plugins['function']['Statistics'][0][0]->function_plugin(array('what' => 'total'), $this);
                    if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#21}'; endif; ?>
                </p></span>
        </div>
    </div>
</div> <!-- //main-->
<div
    style="display:none;"><?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#22}'; endif;
    $_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '22');
    echo smarty_cms_function_content(array(), $this);
    if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#22}'; endif; ?>
</div>
<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#23}'; endif;
$_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '23');
echo smarty_cms_function_global_content(array('name' => 'googleanalaytics'), $this);
if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#23}'; endif; ?>

<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#24}'; endif;
$_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '24');
echo smarty_cms_function_global_content(array('name' => 'zopim'), $this);
if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#24}'; endif; ?>

<?php if ($this->caching && !$this->_cache_including): echo '{nocache:9ac7b4943c1309869ad9d28717df7d5c#25}'; endif;
$_cache_attrs =& $this->_smarty_cache_attrs('9ac7b4943c1309869ad9d28717df7d5c', '25');
echo smarty_cms_function_global_content(array('name' => 'back_to_top'), $this);
if ($this->caching && !$this->_cache_including): echo '{/nocache:9ac7b4943c1309869ad9d28717df7d5c#25}'; endif; ?>

</body>
</html>