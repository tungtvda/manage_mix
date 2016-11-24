<script type="text/javascript">(function () {
        function addEventListener(element, event, handler) {
            if (element.addEventListener) {
                element.addEventListener(event, handler, false);
            } else if (element.attachEvent) {
                element.attachEvent('on' + event, handler);
            }
        }

        function maybePrefixUrlField() {
            if (this.value.trim() !== '' && this.value.indexOf('http') !== 0) {
                this.value = "http://" + this.value;
            }
        }

        var urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]');
        if (urlFields && urlFields.length > 0) {
            for (var j = 0; j < urlFields.length; j++) {
                addEventListener(urlFields[j], 'blur', maybePrefixUrlField);
            }
        }
        /* test if browser supports date fields */
        var testInput = document.createElement('input');
        testInput.setAttribute('type', 'date');
        if (testInput.type !== 'date') {

            /* add placeholder & pattern to all date fields */
            var dateFields = document.querySelectorAll('.mc4wp-form input[type="date"]');
            for (var i = 0; i < dateFields.length; i++) {
                if (!dateFields[i].placeholder) {
                    dateFields[i].placeholder = 'YYYY-MM-DD';
                }
                if (!dateFields[i].pattern) {
                    dateFields[i].pattern = '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])';
                }
            }
        }

    })();</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/contact-form-7/includes/js/jquery.form.mind03d.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-content/plugins/contact-form-7/includes/js/scripts8686.js?ver=4.5.1'></script>
<!--<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min72e6.js?ver=2.6.4'></script>-->
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min005e.js?ver=3.1.6'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.init.min72e6.js?ver=2.6.4'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wc_single_product_params = {
        "i18n_required_rating_text": "Please select a rating",
        "review_rating_required": "yes"
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min72e6.js?ver=2.6.4'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min44fd.js?ver=2.70'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min72e6.js?ver=2.6.4'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min330a.js?ver=1.4.1'></script>
<!--<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min72e6.js?ver=2.6.4'></script>-->
<!--<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-compare/assets/js/woocompareffdc.js?ver=2.0.9'></script>-->
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-compare/assets/js/jquery.colorbox-min13ac.js?ver=1.4.21'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.selectBox.min7359.js?ver=1.2.0'></script>
<!--<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl9c6b.js?ver=2.0.16'></script>-->
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/themes/echion/assets/js/jquery.unveil.mina578.js?ver=3022016'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/themes/echion/assets/js/jquery.magnify.mine7f0.js?ver=1.3.1'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/comment-reply.min1c9b.js?ver=4.6.1'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/themes/echion/assets/js/jquery.mb-comingsoon.mina578.js?ver=3022016'></script>

<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/themes/echion/assets/js/library-jquery.min1c9b.js?ver=4.6.1'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-content/themes/echion/assets/js/sideNav.min1c9b.js?ver=4.6.1'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-content/themes/echion/assets/js/theme.min1c9b.js?ver=4.6.1'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/core.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/datepicker.mine899.js?ver=1.11.4'></script>
<script type='text/javascript'>
    jQuery(document).ready(function (jQuery) {
        jQuery.datepicker.setDefaults({
            "closeText": "Close",
            "currentText": "Today",
            "monthNames": ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            "monthNamesShort": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "nextText": "Next",
            "prevText": "Previous",
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "dateFormat": "MM d, yy",
            "firstDay": 1,
            "isRTL": false
        });
        var i = "active", r = "product-grid", a = "product-list";
        jQuery(".switchToList").click(function () {
            jQuery(".switchToList").addClass(i), jQuery(".switchToGrid").removeClass(i), jQuery(".archive_switch").fadeOut(300, function () {
                jQuery(this).removeClass(r).addClass(a).fadeIn(300)
            })
        }), jQuery(".switchToGrid").click(function () {
            jQuery(".switchToGrid").addClass(i), jQuery(".switchToList").removeClass(i), jQuery(".archive_switch").fadeOut(300, function () {
                jQuery(this).removeClass(a).addClass(r).fadeIn(300)
            })
        });
        jQuery(".add_to_wishlist").click(function() {
            idSelect = jQuery(this).attr('data-product-id-like');
            num_like="#num_like_"+idSelect;
            link='{SITE-NAME}/like/'+idSelect+'/';
            jQuery.ajax({
                method: "GET",// phương thức dữ liệu được truyền đi
                url: link,// gọi đến file server show_data.php để xử lý
                success : function(response){
                if(response>0){
                    jQuery(num_like).html(response);
                }
            }
        });

        });
    });
</script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/widget.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/button.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/spinner.mine899.js?ver=1.11.4'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/kingcomposer/assets/frontend/js/kingcomposer355d.js?ver=2.5.7'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/wp-embed.min1c9b.js?ver=4.6.1'></script>
<script type='text/javascript'>
    jQuery(document).ready(function (jQuery) {
        jQuery(".ajax_add_to_cart").click(function() {
            idSelect = jQuery(this).attr('data-product_id');
            field="#show_loading_cart_"+idSelect;
            field_name="#name_sp_show_"+idSelect;
            var name=jQuery(field_name).html();
            jQuery(field).show();
            link='{SITE-NAME}/cart/'+idSelect+'/';
            jQuery.ajax({
                method: "GET",// phương thức dữ liệu được truyền đi
                url: link,// gọi đến file server show_data.php để xử lý
                success : function(response){
                    if(response==11111111){
                        alert('Thực đơn bạn vừa đặt đã có trong giỏ hàng, bạn vui lòng đi tới giở hàng để cập nhật số lượng');
                    }
                    else{
                        alert('Bạn vừa thêm '+name+' vào giỏ hàng');
                        jQuery('.wrapper-items-number').html(response);
                    }
                }

            });
            jQuery(field).hide().delay(800);
        });
    });
</script>
<script type="text/javascript">
    function ConfirmDelete()
    {
        confirm('Bạn có chắc chắn muốn xóa');
    }
</script>
<!--<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/mailchimp-for-wp/assets/js/forms-api.min8603.js?ver=4.0.6'></script>-->
<script>
</script>
</body>
</html>