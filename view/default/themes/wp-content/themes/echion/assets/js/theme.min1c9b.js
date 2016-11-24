function SmoothTransition() {
    jQuery(window).focus(function () {
        jQuery(".wrapper-container").fadeIn(0)
    }), jQuery("a").not(".yith_magnifier_thumbnail").click(function (e) {
        var t = jQuery(this), i = jQuery(this).attr("href");
        "undefined" != typeof i && i !== !1 && 1 == e.which && "undefined" == typeof t.data("rel") && "undefined" == typeof t.attr("rel") && !t.hasClass("eltd-like") && t.attr("href").indexOf(window.location.host) >= 0 && ("undefined" == typeof t.attr("target") || "_self" === t.attr("target")) && (t.parents(".shop-top").length > 0 || t.attr("href").match(/^#/gi) || t.attr("href").match(/#/gi) || (e.preventDefault(), jQuery(".wrapper-container").fadeOut(200, function () {
            window.location = t.attr("href")
        })))
    })
}
!function (e) {
    "use strict";
    e.avia_utilities = e.avia_utilities || {}, e.avia_utilities.supported = {}, e.avia_utilities.supports = function () {
        var e = document.createElement("div"), t = ["Khtml", "Ms", "Moz", "Webkit", "O"];
        return function (i, r) {
            if (void 0 !== e.style.prop)return "";
            void 0 !== r && (t = r), i = i.replace(/^[a-z]/, function (e) {
                return e.toUpperCase()
            });
            for (var a = t.length; a--;)if (void 0 !== e.style[t[a] + i])return "-" + t[a].toLowerCase() + "-";
            return !1
        }
    }(), function (e, t) {
        var i = function (e, t, i) {
            var r;
            return function () {
                function a() {
                    i || e.apply(s, o), r = null
                }

                var s = this, o = arguments;
                r ? clearTimeout(r) : i && e.apply(s, o), r = setTimeout(a, t || 100)
            }
        };
        jQuery.fn[t] = function (e) {
            return e ? this.bind("resize", i(e)) : this.trigger(t)
        }
    }(jQuery, "smartresize")
}(jQuery);
var custom_js = {
    init: function () {
        jQuery("#masthead").imagesLoaded(function () {
            var e = jQuery(".wrapper-header_overlay .site-header").outerHeight(!0);
            jQuery("#masthead").outerHeight(!0);
            jQuery(".wrapper-header_overlay").find(".top-site-no-image,.vi-loginForm").css({"padding-top": e + "px"}), jQuery(".wrapper-header_overlay").find(".top-site-no-image-custom").css({"padding-top": e + "px"}), e > 0 && jQuery(".top_site_main").css({"padding-top": e + "px"})
        }), jQuery(window).load(function () {
            jQuery("#preload").delay(100).fadeOut(500, function () {
                jQuery(this).remove()
            })
        }), jQuery(".button-collapse").sideNav();
        var e = jQuery("#wpadminbar").outerHeight();
        jQuery(".navbar-nav li a,.arrow-scroll > a").click(function (t) {
            if (parseInt(jQuery(window).scrollTop(), 10) < 2)var i = 74; else i = 0;
            var r = jQuery("#masthead").outerHeight(), a = jQuery(this).attr("href");
            a && 0 == a.indexOf("#") && a.length > 1 && (t.preventDefault(), jQuery("html,body").animate({scrollTop: jQuery(a).offset().top - e - r + i}, 850)), jQuery(".wrapper-container").removeClass("mobile-menu-open")
        }), jQuery("body").bind("added_to_cart", function (e, t, i, r) {
            var a, s, o, n = r.hasClass("single_add_to_cart_button");
            if (n) {
                var u = parseInt(r.data("product_id"), 10);
                isNaN(u) || (s = jQuery("#product-" + u))
            } else s = jQuery(r).parent().parent().parent().parent();
            if (n || setTimeout(function () {
                    s.addClass("added").removeClass("active")
                }, 300), n)a = jQuery($(".woocommerce-main-image", s)[0]), o = jQuery("img", a); else {
                if (0 == s.length)return;
                a = jQuery(".product-top", s), o = jQuery(".product-image > img.primary-image", s), 0 == o.length && (o = jQuery(".product-image > img", s))
            }
            if (0 != a.length) {
                var l = a.offset();
                jQuery("body").append('<div class="floating-cart"></div>');
                var c = jQuery("div.floating-cart");
                o.clone().appendTo(c);
                var d = jQuery("#header-mini-cart");
                0 != d.length && (jQuery(c).css({
                    top: l.top + "px",
                    left: l.left + "px",
                    width: a.width() + "px",
                    height: a.height() + "px"
                }).fadeIn("slow"), jQuery(c).animate({
                    width: a.width() / 2 + "px",
                    height: a.height() / 2 + "px",
                    top: "+=" + a.height() / 4 + "px",
                    left: "+=" + a.width() / 4 + "px"
                }, 400, "swing", function () {
                    jQuery(c).animate({
                        top: d.offset().top + "px",
                        left: d.offset().left + "px",
                        height: "18px",
                        width: "25px"
                    }, 800, "swing", function () {
                        jQuery("div.floating-cart").fadeIn("fast", function () {
                            jQuery("div.floating-cart").remove()
                        }), d.addClass("animated").addClass("tada"), setTimeout(function () {
                            d.removeClass("animated").removeClass("tada")
                        }, 4e3)
                    })
                }))
            }
        }), jQuery(document).ready(function () {
            jQuery("img.vi-load").unveil(100, function () {
                jQuery(this).load(function () {
                    jQuery(this).closest(".product-top").find(".vi-placeholder").hide()
                })
            }), jQuery().datepicker && jQuery(".vi-reservation-date").datepicker({dateFormat: "dd/mm/yy"})
        }), jQuery(".timer-bar-countdown").length > 0 && jQuery(".timer-bar-countdown").each(function () {
            var e = jQuery(this).data();
            jQuery(this).mbComingsoon({
                expiryDate: new Date(e.y, e.m, e.d, e.g, e.i, e.s),
                speed: 100,
                gmt: e.gmt,
                showText: 1,
                localization: {days: e.tday, hours: e.thour, minutes: e.tmin, seconds: e.tsec}
            })
        })
    }, totop: function () {
        jQuery("#topcontrol").hasClass("totop-right") && jQuery(window).scroll(function () {
            jQuery(this).scrollTop() > 100 ? jQuery("#topcontrol").css({bottom: "15px"}) : jQuery("#topcontrol").css({bottom: "-100px"})
        }), jQuery("#topcontrol").click(function () {
            return jQuery("html, body").animate({scrollTop: "0px"}, 800), !1
        })
    }, sticky_header: function () {
        var e = jQuery("#masthead.sticky-header.header_default"), t = jQuery("#wrapper-container .content-pusher"), i = e.outerHeight(!0);
        t.css({"padding-top": i + "px"}), jQuery(window).resize(function () {
            var i = e.outerHeight(!0);
            t.css({"padding-top": i + "px"})
        });
        var e = jQuery(".sticky-header"), r = e.outerHeight(), a = jQuery(".topbar-header").outerHeight(!0) + jQuery(".header_v1 .wrapper-logo").outerHeight(!0) + 1, s = 0;
        jQuery(window).scrollTop() > a && e.removeClass("affix-top").addClass("affix"), jQuery(".wrapper-content").css({"padding-top": r + "px"}), jQuery(window).scroll(function () {
            var t = jQuery(this).scrollTop();
            t > a ? e.removeClass("affix-top").addClass("affix") : e.removeClass("affix").addClass("affix-top"), t > s && t > r ? e.hasClass("menu-hidden") || e.addClass("menu-hidden") : e.hasClass("menu-hidden") && e.removeClass("menu-hidden"), s = t
        })
    }, menu: function () {
        jQuery(".navbar-nav li.menu-item-has-children >a,.navbar-nav li.menu-item-has-children >span,.navbar-nav li.widget_area >a,.navbar-nav li.widget_area >span").after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>'), jQuery(".navbar-nav>li.menu-item-has-children .icon-toggle,.navbar-nav>li.widget_area .icon-toggle").click(function () {
            jQuery(this).next("ul.sub-menu,div.sub-menu").is(":hidden") ? (jQuery(this).next("ul.sub-menu,div.sub-menu").slideDown(500, "linear"), jQuery(this).html('<i class="fa fa-angle-up"></i>')) : (jQuery(this).next("ul.sub-menu,div.sub-menu").slideUp(500, "linear"), jQuery(this).html('<i class="fa fa-angle-down"></i>'))
        })
    }, menu_one_page: function () {
        var e = !1, t = function () {
            var e = parseInt(jQuery(window).scrollTop(), 10);
            jQuery('.navbar-nav li a[href^="#"]').each(function () {
                var t = jQuery(this).attr("href");
                if (jQuery(t).length) {
                    var i = parseInt(jQuery(t).offset().top, 10);
                    if (jQuery("#wpadminbar").length)var r = jQuery("#wpadminbar").height(); else r = 0;
                    var a = i - (jQuery("#masthead").outerHeight() + r);
                    e <= parseInt(jQuery(jQuery('.navbar-nav li a[href^="#"]').first().attr("href")).height(), 10) ? e >= a && (jQuery('.navbar-nav li a[href^="#"]').removeClass("nav-active"), jQuery('.navbar-nav li a[href="' + t + '"]').addClass("nav-active")) : (e >= a || e >= a) && (jQuery('.navbar-nav li a[href^="#"]').removeClass("nav-active"), jQuery('.navbar-nav li a[href="' + t + '"]').addClass("nav-active"))
                }
            })
        };
        window.clearTimeout(e), t(), jQuery(window).scroll(function () {
            window.clearTimeout(e), e = window.setTimeout(function () {
                t()
            }, 20)
        })
    }, owl_Carousel: function () {
        jQuery().owlCarousel && (window.onload = function () {
            var e = jQuery(".vi-video-slider,.related-our-teams .our-teams,.vi-teams-slider .our-teams").data("item");
            jQuery(".vi-video-slider,.related-our-teams .our-teams,.vi-teams-slider .our-teams").owlCarousel({
                items: e,
                itemsDesktopSmall: [900, 2],
                itemsTablet: [600, 2],
                itemsMobile: [479, 1]
            }), jQuery(".vi-teams-slider .next").click(function () {
                owl.trigger("owl.next")
            }), jQuery(".vi-teams-slider .prev").click(function () {
                owl.trigger("owl.prev")
            }), jQuery(".vi-product-slider").each(function () {
                var e = jQuery(this), t = e.find(".product-slider"), i = t.data("item"), r = !1;
                e.hasClass("fix-responsive") ? t.owlCarousel({
                    items: i,
                    itemsDesktop: [1199, 2],
                    itemsDesktopSmall: [979, 2],
                    itemsTablet: [767, 3],
                    itemsTabletSmall: [600, 2],
                    itemsMobile: [479, 1],
                    responsive: !0,
                    navigation: !1,
                    autoPlay: !1,
                    pagination: !1,
                    baseClass: "vi-carousel",
                    afterAction: function () {
                        jQuery("img.vi-load").unbind(), jQuery("img.vi-load").unveil(0, function () {
                            jQuery(this).load(function () {
                                jQuery(this).closest(".product-top").find(".vi-placeholder").hide()
                            })
                        })
                    }
                }) : t.owlCarousel({
                    items: i,
                    itemsDesktopSmall: [979, 3],
                    itemsTablet: [767, 3],
                    itemsTabletSmall: [600, 2],
                    itemsMobile: [479, 1],
                    responsive: !0,
                    navigation: !1,
                    autoPlay: !1,
                    pagination: r,
                    baseClass: "vi-carousel",
                    afterAction: function () {
                        jQuery("img.vi-load").unbind(), jQuery("img.vi-load").unveil(0, function () {
                            jQuery(this).load(function () {
                                jQuery(this).closest(".product-top").find(".vi-placeholder").hide()
                            })
                        })
                    }
                }), t.owlCarousel({
                    items: i,
                    itemsDesktopSmall: [979, 3],
                    itemsTablet: [767, 2],
                    itemsMobile: [479, 1],
                    responsive: !0,
                    navigation: !1,
                    autoPlay: !1,
                    pagination: !1,
                    baseClass: "vi-carousel",
                    afterAction: function () {
                        jQuery("img.vi-load").unbind(), jQuery("img.vi-load").unveil(0, function () {
                            jQuery(this).load(function () {
                                jQuery(this).closest(".product-top").find(".vi-placeholder").hide()
                            })
                        })
                    }
                }), t.on("changed.owl.carousel", function (e) {
                    alert("changed")
                }), e.find(".next").click(function () {
                    t.trigger("owl.next")
                }), e.find(".prev").click(function () {
                    t.trigger("owl.prev")
                })
            }), jQuery(".vi-testimonials").each(function () {
                var e = jQuery(this), t = e.find(".vi-inner-testimonials");
                t.owlCarousel({autoPlay: !1, singleItem: !0, responsive: !0, navigation: !1, pagination: !0})
            }), jQuery(".twitter-feed").each(function () {
                var e = jQuery(this);
                e.owlCarousel({autoPlay: !0, singleItem: !0, responsive: !0, navigation: !1, pagination: !1})
            })
        })
    }
}, blog = {
    post_gallery: function () {
        jQuery(".flexslider").flexslider({
            slideshow: !0,
            animation: "fade",
            pauseOnHover: !0,
            animationSpeed: 400,
            smoothHeight: !0,
            directionNav: !1,
            controlNav: !0
        })
    }
}, product = {
    single_product: function () {
        if (jQuery().flexslider && jQuery(".woocommerce #carousel").length >= 1) {
            "undefined" != typeof jQuery(".woocommerce #carousel").data("flexslider") && (jQuery(".woocommerce #carousel").flexslider("destroy"), jQuery(".woocommerce #slider").flexslider("destroy")), jQuery(".woocommerce #carousel").flexslider({
                animation: "slide",
                controlNav: !1,
                directionNav: !0,
                animationLoop: !1,
                slideshow: !1,
                itemWidth: 120,
                maxItems: 4,
                itemMargin: 20,
                touch: !1,
                useCSS: !1,
                asNavFor: ".woocommerce #slider",
                smoothHeight: !1
            }), jQuery(".woocommerce #slider").flexslider({
                animation: "slide",
                controlNav: !1,
                directionNav: !1,
                animationLoop: !1,
                slideshow: !1,
                smoothHeight: !1,
                touch: !0,
                useCSS: !1,
                sync: ".woocommerce #carousel"
            })
        }
    }, quick_view: function () {
        //jQuery(".quick-view").click(function (e) {
        //    jQuery(".quick-view a").css("display", "none"), jQuery(this).append('<a href="javascript:;" class="loading dark"></a>');
        //    var t = jQuery(this).attr("data-prod"), i = {action: "jck_quickview", product: t};
        //    jQuery.post(ajaxurl, i, function (e) {
        //        jQuery.magnificPopup.open({
        //            mainClass: "my-mfp-zoom-in",
        //            items: {src: '<div class="mfp-iframe-scaler">' + e + "</div>", type: "inline"}
        //        }), jQuery(".quick-view a").css("display", "inline-block"), jQuery(".loading").remove(), jQuery(".product-card .wrapper").removeClass("animate"), setTimeout(function () {
        //            jQuery(".product-lightbox form").wc_variation_form()
        //        }, 600), product.single_product()
        //    }), e.preventDefault()
        //})
    }, mini_cart: function () {
        //jQuery(document).on("click", ".minicart_hover", function () {
        //    jQuery(this).next(".widget_shopping_cart_content").slideDown()
        //}).on("mouseleave", ".minicart_hover", function () {
        //    jQuery(this).next(".widget_shopping_cart_content").delay(100).stop(!0, !1).slideUp()
        //}), jQuery(document).on("mouseenter", ".widget_shopping_cart_content", function () {
        //    jQuery(this).stop(!0, !1).show()
        //}).on("mouseleave", ".widget_shopping_cart_content", function () {
        //    jQuery(this).delay(100).stop(!0, !1).slideUp()
        //})
    },
    check_list_grid: function () {
        var e = function () {
            function e() {
                jQuery(".switchToList").addClass(i), jQuery(".switchToGrid").removeClass(i), jQuery(".archive_switch").fadeOut(300, function () {
                    jQuery(this).removeClass(r).addClass(a).fadeIn(300)
                })
            }

            function t() {
                jQuery(".switchToGrid").addClass(i), jQuery(".switchToList").removeClass(i), jQuery(".archive_switch").fadeOut(300, function () {
                    jQuery(this).removeClass(a).addClass(r).fadeIn(300)
                })
            }

            var i = "active", r = "product-grid", a = "product-list";
            jQuery(".switchToList").click(function () {
                e()
            }), jQuery(".switchToGrid").click(function () {
                t()
            })
        };
        jQuery("body.woocommerce").length && e()
    }, control_botton: function () {
        jQuery(".product-grid .product-desc").each(function () {
            var e = jQuery(this).outerHeight(!0);
            jQuery(this).find(".controls").css({bottom: e})
        })
    }, quantity_buttons: function () {
        jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />'), jQuery(document).on("click", ".plus, .minus", function () {
            var e = jQuery(this).closest(".quantity").find(".qty"), t = parseFloat(e.val()), i = parseFloat(e.attr("max")), r = parseFloat(e.attr("min")), a = e.attr("step");
            jQuery(this).is(".plus") ? i && (i == t || t > i) ? e.val(i) : e.val(t + parseFloat(a)) : r && (r == t || r > t) ? e.val(r) : t > 0 && e.val(t - parseFloat(a)), e.trigger("change")
        })
    }
}, short_code_js = {
    bg_video: function () {
        jQuery(document).delegate(".bg-video-play", "click", function () {
            jQuery(".full-screen-video").get(0).paused ? (jQuery(".full-screen-video").get(0).play(), jQuery(this).addClass("bg-pause")) : (jQuery(".full-screen-video").get(0).pause(), jQuery(this).removeClass("bg-pause"))
        })
    }, vi_product_cat: function () {
        jQuery(".vi-product-img").unbind(), jQuery(".vi-product-img").hover(function () {
            var e = jQuery(this).data("image");
            e && jQuery(this).closest(".vi-product-category-wrapper").find(".vi-product-category-img").attr("src", e)
        }, function () {
            var e = jQuery(this).closest(".vi-product-category-wrapper").find(".vi-product-category-img").data("default-src");
            e && jQuery(this).closest(".vi-product-category-wrapper").find(".vi-product-category-img").attr("src", e)
        })
    }, deal_of_day: function () {
        jQuery().mbComingsoon && jQuery(".dealofday-timer").each(function () {
            var e = jQuery(this).data(), t = e.text;
            t = t.split(","), jQuery(this).mbComingsoon({
                expiryDate: new Date(e.year, e.month - 1, e.date, e.hour, e.min, e.sec),
                speed: 500,
                gmt: e.gmt,
                showText: 1,
                localization: {days: t[0], hours: t[1], minutes: t[2], seconds: t[3]}
            })
        }), jQuery().magnify && jQuery(".woocommerce-main-image.zoom img").each(function () {
            jQuery(this).magnify()
        })
    }
}, custom_select = {
    select: function () {
        jQuery(".variations select,.woocommerce-ordering select").each(function () {
            var e = jQuery(this), t = jQuery(this).children("option").length;
            e.addClass("s-hidden"), e.wrap('<div class="select"></div>'), e.after('<div class="styledSelect"></div>');
            var i = e.next("div.styledSelect");
            i.text(e.children("option").eq(0).text());
            for (var r = jQuery("<ul />", {"class": "options"}).insertAfter(i), a = 0; t > a; a++)jQuery("<li />", {
                text: e.children("option").eq(a).text(),
                rel: e.children("option").eq(a).val()
            }).appendTo(r);
            var s = r.children("li");
            i.click(function (e) {
                e.stopPropagation(), jQuery("div.styledSelect.active").each(function () {
                    jQuery(this).removeClass("active").next("ul.options").hide()
                }), jQuery(this).toggleClass("active").next("ul.options").toggle()
            }), s.click(function (t) {
                t.stopPropagation(), i.text(jQuery(this).text()).removeClass("active"), e.val(jQuery(this).attr("rel")), r.hide()
            }), jQuery(document).click(function () {
                i.removeClass("active"), r.hide()
            })
        })
    }
}, search = {
    button_search: function () {
        jQuery("#header-search").on("click", function (e) {
            e.preventDefault(), jQuery(".wrapper-header-search-form").addClass("open"), jQuery(".header-search-form-input #s").focus()
        }), jQuery(".search-popup-bg").bind("touchstart click", function () {
            jQuery(".wrapper-header-search-form").removeClass("open")
        }), jQuery(".vi_search_form").on("keyup", function (e) {
            27 == e.which && (jQuery(".wrapper-header-search-form").removeClass("open"), jQuery(this).val(""), jQuery(this).stop(), jQuery(".vi-search-results").html(""))
        })
    }, search_result: function () {
        function e(e) {
            var t = jQuery(".vi-search-input").val(), i = jQuery(".vi-search-input").data("limit");
            if (t) {
                if (!e && t.length < 3)return;
                jQuery(".vi_search_form").addClass("search-loading"), jQuery.ajax({
                    type: "POST",
                    data: "action=vi_ajax_search&keyword=" + t + "&limit=" + i,
                    url: ajaxurl,
                    success: function (e) {
                        var t = "", i = jQuery.parseJSON(e);
                        jQuery.each(i, function (e) {
                            t += 0 == e && 0 != parseInt(this.id) ? '<li class="ui-menu-item' + this.id + ' selected"><a id="ui-id-' + this.id + '" class="ui-corner-all" href="' + this.guid + '"><span class="search-title">' + this.title + '</span><span class="search-date">' + this.date + "</span></a></li>" : 0 != parseInt(this.id) ? '<li class="ui-menu-item' + this.id + '"><a id="ui-id-' + this.id + '" class="ui-corner-all" href="' + this.guid + '"><span class="search-title">' + this.title + '</span><span class="search-date">' + this.date + "</span></a></li>" : '<li class="ui-menu-item' + this.id + '"><a id="ui-id-' + this.id + '" class="ui-corner-all" href="' + this.guid + '"><span class="search-title">' + this.title + "</span></a></li>"
                        }), jQuery(".vi-search-results").html("").append(t), jQuery(".vi_search_form").removeClass("search-loading")
                    },
                    error: function (e) {
                    }
                })
            }
        }

        jQuery(".vi-search-input").on("keyup", function (t) {
            if (clearTimeout(jQuery.data(this, "timer")), 13 == t.which)t.preventDefault(), jQuery(this).stop(); else if (38 == t.which) {
                if (-1 != navigator.userAgent.indexOf("Chrome") && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf("Chrome") + 7).split(" ")[0]) >= 15) {
                    var i = jQuery(".selected");
                    jQuery(".vi-search-results li").removeClass("selected"), 0 == i.prev().length ? i.siblings().last().addClass("selected") : i.prev().addClass("selected")
                }
            } else if (40 == t.which) {
                if (-1 != navigator.userAgent.indexOf("Chrome") && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf("Chrome") + 7).split(" ")[0]) >= 15) {
                    var i = jQuery(".selected");
                    jQuery(".vi-search-results li").removeClass("selected"), 0 == i.next().length ? i.siblings().first().addClass("selected") : i.next().addClass("selected")
                }
            } else 27 == t.which ? (jQuery(".main-header-search-form-input").hide(), jQuery(".header .sm-logo,.header nav").css({opacity: 1}), jQuery(".header-search-close").html('<i class="fa fa-times"></i>'), jQuery(".vi-search-results").html(""), jQuery(this).val(""), jQuery(this).stop()) : jQuery(this).data("timer", setTimeout(e, 1e3))
        }), jQuery(".vi-search-input").on("keypress", function (e) {
            if (13 == e.keyCode) {

                var giatri = jQuery("#value_timkiem").val();
                var url = jQuery("#url_tk").val();
                if (giatri.length > 0) {
                    window.location=url+'giatri-'+giatri;
                }
                else{
                    alert('Bạn vui lòng nhập từ khóa tìm kiếm')
                }
                e.preventDefault()
            }
        })
            , jQuery("#timkiem-bt").on("click", function (e) {
            var giatri = jQuery("#value_timkiem").val();
            var url = jQuery("#url_tk").val();
            if (giatri.length > 0) {
                window.location=url+'giatri-'+giatri;
            }
            else{
                alert('Bạn vui lòng nhập từ khóa tìm kiếm')
            }
            e.preventDefault()
        })
    }
};
jQuery(document).ready(function (e) {
    custom_js.init(), custom_js.totop(), custom_js.sticky_header(), custom_js.menu(), custom_js.menu_one_page(), custom_js.owl_Carousel(), blog.post_gallery(), product.quick_view(), product.single_product(), product.check_list_grid(), product.quantity_buttons(), product.control_botton(), short_code_js.bg_video(), short_code_js.deal_of_day(), short_code_js.vi_product_cat(), search.button_search(), search.search_result(), SmoothTransition(), e(".vi-woo-cate-tabs").tabCollapse()
});