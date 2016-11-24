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
<script type='text/javascript'>
    /* <![CDATA[ */
    var _wpcf7 = {
        "loaderUrl": "http:\/\/new2new.com\/echion\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif",
        "recaptcha": {"messages": {"empty": "Please verify that you are not a robot."}},
        "sending": "Sending ...",
        "jqueryUi": "1"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-content/plugins/contact-form-7/includes/js/scripts8686.js?ver=4.5.1'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wc_add_to_cart_params = {
        "ajax_url": "\/echion\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/echion\/?wc-ajax=%%endpoint%%",
        "i18n_view_cart": "View Cart",
        "cart_url": "http:\/\/new2new.com\/echion\/cart\/",
        "is_cart": "",
        "cart_redirect_after_add": "no"
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min72e6.js?ver=2.6.4'></script>
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
<script type='text/javascript'>
    /* <![CDATA[ */
    var woocommerce_params = {
        "ajax_url": "\/echion\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/echion\/?wc-ajax=%%endpoint%%"
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min72e6.js?ver=2.6.4'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min330a.js?ver=1.4.1'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wc_cart_fragments_params = {
        "ajax_url": "\/echion\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/echion\/?wc-ajax=%%endpoint%%",
        "fragment_name": "wc_fragments"
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min72e6.js?ver=2.6.4'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var yith_woocompare = {
        "ajaxurl": "\/echion\/?wc-ajax=%%endpoint%%",
        "actionadd": "yith-woocompare-add-product",
        "actionremove": "yith-woocompare-remove-product",
        "actionview": "yith-woocompare-view-table",
        "added_label": "Added",
        "table_title": "Product Comparison",
        "auto_open": "yes",
        "loader": "http:\/\/new2new.com\/echion\/wp-content\/plugins\/yith-woocommerce-compare\/assets\/images\/loader.gif",
        "button_text": "Compare"
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-compare/assets/js/woocompareffdc.js?ver=2.0.9'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-compare/assets/js/jquery.colorbox-min13ac.js?ver=1.4.21'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.selectBox.min7359.js?ver=1.2.0'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var yith_wcwl_l10n = {
        "ajax_url": "\/echion\/wp-admin\/admin-ajax.php",
        "redirect_to_cart": "no",
        "multi_wishlist": "",
        "hide_add_button": "1",
        "is_user_logged_in": "",
        "ajax_loader_url": "http:\/\/new2new.com\/echion\/wp-content\/plugins\/yith-woocommerce-wishlist\/assets\/images\/ajax-loader.gif",
        "remove_from_wishlist_after_add_to_cart": "yes",
        "labels": {
            "cookie_disabled": "We are sorry, but this feature is available only if cookies are enabled on your browser.",
            "added_to_cart_message": "<div class=\"woocommerce-message\">Product correctly added to cart<\/div>"
        },
        "actions": {
            "add_to_wishlist_action": "add_to_wishlist",
            "remove_from_wishlist_action": "remove_from_wishlist",
            "move_to_another_wishlist_action": "move_to_another_wishlsit",
            "reload_wishlist_and_adding_elem_action": "reload_wishlist_and_adding_elem"
        }
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl9c6b.js?ver=2.0.16'></script>
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
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
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
    });
</script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/widget.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/button.mine899.js?ver=1.11.4'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/jquery/ui/spinner.mine899.js?ver=1.11.4'></script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/kingcomposer/assets/frontend/js/kingcomposer355d.js?ver=2.5.7'></script>
<script type='text/javascript' src='{SITE-NAME}/view/default/themes/wp-includes/js/wp-embed.min1c9b.js?ver=4.6.1'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var mc4wp_forms_config = [];
    /* ]]> */
</script>
<script type='text/javascript'
        src='{SITE-NAME}/view/default/themes/wp-content/plugins/mailchimp-for-wp/assets/js/forms-api.min8603.js?ver=4.0.6'></script>
<!--[if lte IE 9]>
<script type='text/javascript'
        src='http://new2new.com/echion/wp-content/plugins/mailchimp-for-wp/assets/js/third-party/placeholders.min.js?ver=4.0.6'></script>
<![endif]-->
</body>

<!-- Mirrored from new2new.com/echion/menu/semperduis-fusce/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Oct 2016 03:59:58 GMT -->
</html>