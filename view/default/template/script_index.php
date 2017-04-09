<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.easypiechart.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.sparkline.index.min.js"></script>

<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.flot.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.flot.pie.min.js"></script>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/assets/js/jquery.flot.resize.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        $('.easy-pie-chart.percentage').each(function () {
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 10),
                animate: ace.vars['old_ie'] ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function () {
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html',
                {
                    tagValuesAttribute: 'data-values',
                    type: 'bar',
                    barColor: barColor,
                    chartRangeMin: $(this).data('min') || 0
                });
        });


        //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
        //but sometimes it brings up errors with normal resize event handlers
        $.resize.throttleWindow = false;

        var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
        var data = [
            {label: "Đơn hàng mới", data: <?php echo $count_don_hang_moi_rate?>, color: "#68BC31"},
            {label: "Đang giao dịch", data: <?php echo $count_dang_giao_dich_rate?>, color: "#2091CF"},
            {label: "Tạm dừng", data: <?php echo $count_tam_dung_rate?>, color: "#AF4E96"},
            {label: "Nợ tiền", data: <?php echo $count_no_tien_rate?>, color: "#DA5430"},
            {label: "Kết thúc", data: <?php echo $count_ket_thuc_rate?>, color: "#000000"},
            {label: "Bản nháp", data: <?php echo $count_ban_nhap_rate?>, color: "#FEE074"}
        ]
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt: 0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin: [-30, 15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }

        drawPieChart(placeholder, data);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder.data('chart', data);
        placeholder.data('draw', drawPieChart);


        //pie chart tooltip example
        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;

        placeholder.on('plothover', function (event, pos, item) {
            if (item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + Math.round(item.series['percent']*100)/100 + '%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });

        /////////////////////////////////////
        $(document).one('ajaxloadstart.page', function (e) {
            $tooltip.remove();
        });


        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }


        var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
        $.plot("#sales-charts", [
            {label: "Domains", data: d1},
            {label: "Hosting", data: d2},
            {label: "Services", data: d3}
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: {show: true},
                points: {show: true}
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: {colors: ["#fff", "#fff"]},
                borderWidth: 1,
                borderColor: '#555'
            }
        });


        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            //var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }


        $('.dialogs,.comments').ace_scroll({
            size: 300
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if (ace.vars['touch'] && ace.vars['android']) {
            $('#tasks').on('touchstart', function (e) {
                var li = $(e.target).closest('#tasks li');
                if (li.length == 0)return;
                var label = li.find('label.inline').get(0);
                if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
            });
        }

        $('#tasks').sortable({
                opacity: 0.8,
                revert: true,
                forceHelperSize: true,
                placeholder: 'draggable-placeholder',
                forcePlaceholderSize: true,
                tolerance: 'pointer',
                stop: function (event, ui) {
                    //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                    $(ui.item).css('z-index', 'auto');
                }
            }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function () {
            if (this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });


        //show the dropdowns on top or bottom depending on window height and menu position
        $('#task-tab .dropdown-hover').on('mouseenter', function (e) {
            var offset = $(this).offset();

            var $w = $(window)
            if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                $(this).addClass('dropup');
            else $(this).removeClass('dropup');
        });

    });
    $('body').on("change", '#check_all_form_birthday', function () {
        $('#value_1').prop('checked', true);
        if($(this).is(':checked')){
            $("form input[type='checkbox']").prop('checked', true);
        }else{
            $("form input[type='checkbox']").prop('checked', false);
        }
    });
    $('body').on("click", '#btn_send_birthday', function () {
        var lenght = $('.click_check_list:checked').length;
        if (lenght == 0) {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng chọn khách hàng',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }
        else{
            var mess=$('#message_birthday').val();
            if(mess=="")
            {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Bạn vui lòng nhập nội dung tin nhắn chúc mừng',
                    alertBtnText: 'Ok',
                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {
                        $('#message_birthday').show().focus().select();
                    }
                });
            }else{
                var length_text=$('#message_birthday').val().length;
                if(length_text>150){
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Bạn vui lòng nhập quá số ký tự quy định',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#message_birthday').show().focus();
                        }
                    });
                }else{
                    var url = $('#url_input').val();
                    var link = url + '/chuc-mung-sinh-nhat/send-sms-birthday/';
                    $.ajax({
                        method: "POST",
                        url:link,
                        data: $("#form_birthday").serialize(),
                        success: function (response) {
                            if(response=='1'){
                                lnv.alert({
                                    title: '<label class="green">Thông báo</label>',
                                    content: 'Lưu tin nhắn thành công, hệ thống sẽ tự động gửi tin nhắn trong 1 phút tới',
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-check green"></i>',
                                    alertHandler: function () {
                                        location.reload();
                                    }
                                });
                            }else{
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                    }
                                });
                            }
                        }
                    });
//                    $("#form_birthday").submit();
                }

            }

        }
    });
    $('body').on("click", '.remove_birthday', function () {
        var deleteid = $(this).attr('countid');
        var name_record_delete=$(this).attr('name_record_delete');
        lnv.confirm({
            title: 'Xác nhận xóa bản ghi',
            content: 'Bạn chắc chắn rằng muốn xóa bản ghi </br><b>"'+name_record_delete+'"</b>',
            confirmBtnText: 'Ok',
            iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
            confirmHandler: function () {
                if(deleteid==''||name_record_delete==''){
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Các thông tin xóa không hợp lệ',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else{
                   var count_birthday_hien_tai=parseInt($('#count_birthday_hien_tai').html());
                    if(count_birthday_hien_tai>0){
                        count_birthday_hien_tai=count_birthday_hien_tai-1;
                        $('#count_birthday_hien_tai').html(count_birthday_hien_tai);
                    }

                    $( "#row_birthday_"+deleteid).remove();
                }
            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
            }
        })
    });
</script>