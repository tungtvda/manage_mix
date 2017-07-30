jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on("input", '#input_name_customer', function () {
        removeValueCustomer();
        checkNameCustomer();
    });
    $('body').on("keyup", '#input_name_customer', function () {
        removeValueCustomer();
        checkNameCustomer();
    });

    $('body').on("input", '#input_name_tour', function () {
        removeValueTour();
    });
    $('body').on("keyup", '#input_name_tour', function (event) {
        if (event.keyCode != "13") {
            removeValueTour();
        }
    });

    $('body').on("input", '#input_name_user', function () {
        removeValueUser();
    });
    $('body').on("keyup", '#input_name_user', function (event) {
        if (event.keyCode != "13") {
            removeValueUser();
        }
    });

    $('body').on("input", '#input_name_user_tiepthi', function () {
        $('#input_id_user_tt').val('');
    });
    $('body').on("keyup", '#input_name_user_tiepthi', function (event) {
        if (event.keyCode != "13") {
            $('#input_id_user_tt').val('');
        }
    });


    $('body').on("input", '#input_dat_coc', function () {
        returnDatCoc();
    });
    $('body').on("keyup", '#input_dat_coc', function (event) {
        returnDatCoc();
    });

    $('body').on("click", '#reset_price', function () {
        var price_old = $('#input_price_old').val();
        var price_format = $('#input_price_format').val();
        $('#input_price').val(price_old);
        $('#input_price').hide();
        $('#price_format_span').show().html(price_format);

    });
    $('body').on("click", '#reset_price_511', function () {
        var price_old = $('#input_price_511_old').val();
        var price_format = price_old.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
        $('#input_price_511').val(price_old);
        $('#input_price_511').hide();
        $('#price_format_span_511').show().html(price_format);

    });

    $('body').on("click", '#reset_price_5', function () {
        var price_old = $('#input_price_5_old').val();
        var price_format = price_old.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
        $('#input_price_5').val(price_old);
        $('#input_price_5').hide();
        $('#price_format_span_5').show().html(price_format);

    });

    $('body').on("click", '#edit_price', function () {
        $('#input_price').show().focus().select();
        $('#price_format_span').hide();
    });
    $('body').on("click", '#edit_price_511', function () {
        $('#input_price_511').show().focus().select();
        $('#price_format_span_511').hide();
    });
    $('body').on("click", '#input_vat', function () {
        $('#tong_cong').html('');    $('#tong_cong').html('');
        $('#vat').html('');
        //$('#dat_coc_format').html('');
        $('#con_lai').html('');
        //$('#input_dat_coc').val('');
    });

    $('body').on("click", '#edit_price_5', function () {
        $('#input_price_5').show().focus().select();
        $('#price_format_span_5').hide();
    });
    $('body').on("blur", '#input_price', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            $('#input_price_submit').val(price);
        }
        else {
            var price_old = $('#input_price_old').val();
            $('#input_price').val(price_old);
            $('#input_price_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price').hide();
        $('#price_format_span').show().html(price_format);
        checkSoNguoi();
    });
    $('body').on("blur", '#input_price_511', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            $('#input_price_511_submit').val(price);
        }
        else {
            var price_old = $('#input_price_old').val();
            $('#input_price_511').val(price_old);
            $('#input_price_511_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price_511').hide();
        $('#price_format_span_511').show().html(price_format);
        checkSoNguoi();
    });
    $('body').on("blur", '#input_price_5', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            $('#input_price_5_submit').val(price);
        }
        else {
            var price_old = $('#input_price_old').val();
            $('#input_price_5').val(price_old);
            $('#input_price_5_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price_5').hide();
        $('#price_format_span_5').show().html(price_format);
        checkSoNguoi();
    });

    $('body').on("click", '.btn_add_customer_bk', function () {
        var check_number_member = 0;
        var lenght = $('.table_add_customer > tbody  > tr').length;
        var input_num_nguoi_lon = $('#input_num_nguoi_lon').val();
        var input_num_tre_em = $('#input_num_tre_em').val();
        var input_num_tre_em_5 = $('#input_num_tre_em_5').val();
        if (input_num_nguoi_lon != '' && parseInt(input_num_nguoi_lon) > 0) {
            check_number_member = check_number_member + parseInt(input_num_nguoi_lon);
        }
        if (input_num_tre_em != '' && parseInt(input_num_tre_em) > 0) {
            check_number_member = check_number_member + parseInt(input_num_tre_em);
        }
        if (input_num_tre_em_5 != '' && parseInt(input_num_tre_em_5) > 0) {
            check_number_member = check_number_member + parseInt(input_num_tre_em_5);
        }
        if (lenght >= check_number_member) {
            if (check_number_member == 0) {
                var mess = "Bạn vui lòng nhập số người";
                $('#input_num_nguoi_lon').show().focus().select();
                ;
            } else {
                var mess = "Bạn đã nhập đủ số người"
            }
            lnv.alert({
                title: 'Lỗi',
                content: mess,
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        } else {
            var i = 1;
            $('.table_add_customer > tbody  > tr').each(function () {
                var tds = $(this).find('td.stt_cus');
                tds.eq(0).text(i);
                i = i + 1;
            });
            var row = ' <tbody id="row_customer_' + i + '"><tr>' +
                '<td class="center stt_cus">' + i + '</td>' +
                '<td> <span class="input-icon width_100"><input id="input_name_customer_sub_' + i + '" class="valid" type="text"  name="name_customer_sub[]"><i class="ace-icon fa fa-user blue"></i></span></td>' +
                '<td><span class="input-icon width_100"> <input id="input_email_customer_' + i + '" type="text" class="valid" name="email_customer[]"><i class="ace-icon fa fa-envelope blue"></i> </span></td>' +
                '<td><span class="input-icon width_100"><input id="input_phone_customer_' + i + '" class="valid" type="text" name="phone_customer[]"><i class="ace-icon fa fa-phone blue"></i></span></td>' +
                '<td><span class="input-icon width_100"> <input id="input_address_customer_' + i + '" type="text" name="address_customer[]"><i class="ace-icon fa fa-map-marker blue"></i></span></td>' +
                '<td><a id="stt_custommer_' + i + '"  deleteid="' + i + '"  title="Xóa khách hàng"  class="red btn_remove_customer" href="javascript:void()"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>' +
                '</tr></tbody>';

            $(".table_add_customer").append(row);
        }


    });
    $('body').on("click", '.btn_add_customer', function () {
        var price=$('#input_price_submit').val();
        var price_2=$('#input_price_511_submit').val();
        var price_3=$('#input_price_5_submit').val();
        if(price!=''){
            returnGenDanhSachDoan(price,price_2,price_3);
        }else{
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng chọn tour',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                    $('#input_name_tour').show().focus().select();
                }
            });
        }
    });
    $('body').on("click", '.btn_remove_customer', function () {
        var deleteid = $(this).attr('deleteid');
        $("#row_customer_" + deleteid).remove();
        var i = 1;
        $('.table_add_customer > tbody  > tr').each(function () {
            var tds = $(this).find('td.stt_cus');
            var id_current = tds.eq(0).text();
            tds.eq(0).text(i);
            $('#row_customer_' + id_current).attr('id', 'row_customer_' + i);
            $('#input_name_customer_' + id_current).attr('id', 'input_name_customer_' + i);
            $('#input_email_customer_' + id_current).attr('id', 'input_email_customer_' + i);
            $('#input_phone_customer_' + id_current).attr('id', 'input_phone_customer_' + i);
            $('#input_address_customer_' + id_current).attr('id', 'input_address_customer_' + i);
            $('#stt_custommer_' + id_current).attr('id', 'stt_custommer_' + i);
            $('#stt_custommer_' + id_current).attr('deleteid', i);
            i = i + 1;
        });
    });
    $('body').on("click", '#tinh_tien', function () {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var price_nguoi_lon = $('#input_price').val();
        var price_tre_em_511 = $('#input_price_511').val();
        var price_tre_em_5 = $('#input_price_5').val();

        var number_nguoi_lon = $('#input_num_nguoi_lon').val();
        var number_tre_em_511 = $('#input_num_tre_em').val();
        var number_tre_em_5 = $('#input_num_tre_em_5').val();
        if(numberRegex.test(price_nguoi_lon)&&numberRegex.test(price_tre_em_511)&&numberRegex.test(price_tre_em_5)) {
            if (number_nguoi_lon > 0 && number_nguoi_lon != '') {
                if (price_nguoi_lon == undefined) {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Bạn vui lòng chọn tour',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#input_name_tour').show().focus().select();
                        }
                    });
                } else {
                    var con_lai = 0;
                    var total = 0;
                    if (number_tre_em_511 == '') {
                        number_tre_em_511 = 0;
                    }
                    if (number_tre_em_5 == '') {
                        number_tre_em_5 = 0;
                    }
                    var total_nguoi_lon = parseInt(number_nguoi_lon) * parseInt(price_nguoi_lon);
                    var total_tre_em_511 = parseInt(number_tre_em_511) * parseInt(price_tre_em_511);
                    var total_tre_em_5 = parseInt(number_tre_em_5) * parseInt(price_tre_em_5);
                    total = total_nguoi_lon + total_tre_em_511 + total_tre_em_5;
                    var vat = 0;
                    if ($("#input_vat").is(':checked')) {
                        vat = total * 0.1
                    }
                    con_lai = total + vat;
                    var dat_coc = $("#input_dat_coc").val();
                    if (dat_coc != '' && dat_coc > 0) {
                        dat_coc = dat_coc.toString().split(",");
                        dat_coc = dat_coc.toString().split(".");
                        if (parseInt(dat_coc) > con_lai) {
                            lnv.alert({
                                title: 'Lỗi',
                                content: 'Tiền đặt cọc đã vượt quá số tiền phải thanh toán, vui lòng nhập lại',
                                alertBtnText: 'Ok',
                                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                alertHandler: function () {
                                    $('#input_dat_coc').show().focus().select();
                                }
                            });
                        } else {
                            con_lai = con_lai - parseInt(dat_coc);
                        }
                    }
                    var tong_cong = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                    $('#tong_cong').html(tong_cong);
                    var vat_format = vat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                    $('#vat').html(vat_format);

                    var con_lai_format = con_lai.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                    $('#con_lai').html(con_lai_format);
                }
            } else {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Bạn vui lòng nhập số người trước khi tính tiền',
                    alertBtnText: 'Ok',
                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {

                    }
                });
            }

        }else{
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng kiểm tra đơn giá',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                    $('#input_name_tour').show().focus().select();
                }
            });
        }

    });
    // check
    $('body').on("input", '#input_ngay_bat_dau', function () {
        checkNgayBatDau();
    });
    $('body').on("keyup", '#input_ngay_bat_dau', function () {
        checkNgayBatDau();
    });
    $('body').on("change", '#input_ngay_bat_dau', function () {
        checkNgayBatDau();
    });

    // check
    $('body').on("input", '#input_han_thanh_toan', function () {
        checkHanThanhToan();
    });
    $('body').on("keyup", '#input_han_thanh_toan', function () {
        checkHanThanhToan();
    });
    $('body').on("change", '#input_han_thanh_toan', function () {
        checkHanThanhToan();
    });

    // check
    $('body').on("input", '#input_ngay_khoi_hanh', function () {
        checkNgayKhoiHanh();
    });
    $('body').on("keyup", '#input_ngay_khoi_hanh', function () {
        checkNgayKhoiHanh();
    });
    $('body').on("change", '#input_ngay_khoi_hanh', function () {
        checkNgayKhoiHanh();
    });

    // check
    $('body').on("input", '#input_ngay_ket_thuc', function () {
        checkNgayKetThuc();
    });
    $('body').on("keyup", '#input_ngay_ket_thuc', function () {
        checkNgayKetThuc();
    });
    $('body').on("change", '#input_ngay_ket_thuc', function () {
        checkNgayKetThuc();
    });




    $('body').on("input", '#input_email', function () {
        checkEmailCustomer();
    });
    $('body').on("keyup", '#input_email', function () {
        checkEmailCustomer();
    });
    $('body').on("change", '#input_email', function () {
        checkEmailCustomer();
    });

    $('body').on("input", '#input_address', function () {
        checkAddressCustomer();
    });
    $('body').on("keyup", '#input_address', function () {
        checkAddressCustomer();
    });
    $('body').on("change", '#input_address', function () {
        checkAddressCustomer();
    });

    $('body').on("input", '#input_phone', function () {
        checkPhoneCustomer();
    });
    $('body').on("keyup", '#input_phone', function () {
        checkPhoneCustomer();
    });
    $('body').on("change", '#input_phone', function () {
        checkPhoneCustomer();
    });

    $('body').on("change", '.hinh_thuc_thanh_toan', function () {
        $('#error_hinh_thuc_thanh_toan').hide();
    });
    $('body').on("change", '.status', function () {
        $('#error_status').hide();
    });


    $('body').on("input", '#input_diem_don', function () {
        checkDiemDon();
    });
    $('body').on("keyup", '#input_diem_don', function () {
        checkDiemDon();
    });
    $('body').on("change", '#input_diem_don', function () {
        checkDiemDon();
    });

    $('body').on("change", '.select_status', function () {

        var id=$(this).attr('count_id');
        var code=$(this).attr('code');
        var status=$(this).val();
        var table = 'booking';
        var field = 'status';
        var link = url + '/update-status/';
        var action='booking_update';
        if(id==''||table==''||field==''||code==''||link==''){
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }else{
            var value_old=$('#status_old_'+id).val();
            lnv.confirm({
                title: '<label class="orange">Xác nhận cập nhật trạng thái</label>',
                content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của đơn hàng </br><b>"'+code+'"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + id + '&table=' + table + '&field=' + field + '&status=' + status+'&action='+action,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {

                                    }
                                });
                                $("#status_"+id).val(value_old);
                            }else{
                                $('#status_old_'+id).val(status);
                            }
                        }
                    });

                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    $("#status_"+id).val(value_old);
                }
            })
        }

    });

    $('body').on("click", '#confirm_order', function () {

        var id=$(this).attr('count_id');
        var code=$(this).attr('code');
        var link = url + '/booking/confirm-order';

        if(id==''||link==''||code==''){
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }else{
            lnv.confirm({
                title: '<label class="orange">Xác nhận đơn hàng</label>',
                content: 'Bạn chắc chắn rằng muốn xác đơn hàng </br><b>"'+code+'"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + id,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {

                                    }
                                });
                            }else{
                                $('#confirm_order').remove();
                            }
                        }
                    });

                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {

                }
            })
        }

    });

    $('body').on("click", '.confirm_booking_list', function () {
        var id_filed=$(this).attr('id_filed');
        var id=$(this).attr('count_id');
        var code=$(this).attr('code');
        var link = url + '/booking/confirm-order';
        var field_check = "confirm_booking_" + id_filed;
        if(id==''||link==''||code==''||id_filed==''){
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }else{
            lnv.confirm({
                title: '<label class="orange">Xác nhận đơn hàng</label>',
                content: 'Bạn chắc chắn rằng muốn xác đơn hàng </br><b>"'+code+'"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + id,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                        document.getElementById(field_check).checked = false;
                                    }
                                });
                            }else{
                                document.getElementById(field_check).disabled = true;
                            }
                        }
                    });

                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    document.getElementById(field_check).checked = false;
                }
            })
        }

    });

    $('body').on("click", '.confirm_tiep_thi', function () {
        var id_filed=$(this).attr('id_filed');
        var id=$(this).attr('count_id');
        var code=$(this).attr('code');
        var user=$(this).attr('user');
        var link = url + '/booking/confirm-tiepthi';
        var field_check = "confirm_tiep_thi_" + id_filed;
        if(id==''||link==''||code==''||id_filed==''||user==''){
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }else{
            lnv.confirm({
                title: '<label class="orange">Xác nhận hoa hồng</label>',
                content: 'Bạn chắc chắn rằng muốn xác nhận hoa hồng đơn hàng <b>"'+code+'"</b> cho thành viên <b>"'+user+'"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + id,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                        document.getElementById(field_check).checked = false;
                                    }
                                });
                            }else{
                                $('#remove_btn_tiepthi_'+id_filed).remove();
                                $('#change_color_'+id_filed).removeClass('red');
                                $('#change_color_'+id_filed).addClass('green');
                            }
                        }
                    });

                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    document.getElementById(field_check).checked = false;
                }
            })
        }

    });


    $('body').on("click", '#submit_form_action', function () {
        var form_data = $("#submit_form").serializeArray();
        var error_free = true;
        for (var input in form_data) {
            var name_input=form_data[input]['name'];
            if (name_input != "tien_te"&&name_input != "note"&&name_input != "nguon_tour"&&name_input!='category'&&name_input!='nhom_khach_hang'&&name_input!='name_customer_sub[]'&&name_input!='email_customer[]'&&name_input!='phone_customer[]'&&name_input!='address_customer[]'&&name_input!='birthday_customer[]'&&name_input!='tuoi_number_customer[]'&&name_input!='tuoi_customer[]'&&name_input!='date_passport_customer[]'&&name_input!='passport_customer[]') {
                var element = $("#input_" + name_input);
                var error = $("#error_" + name_input);
                var valid = element.hasClass("valid");
                if(name_input=="hinh_thuc_thanh_toan"){
                   var httt= $( ".hinh_thuc_thanh_toan option:selected" ).val();
                   if(httt==''){
                       valid=false;
                   }else{
                       valid=true;
                   }
                }
                if(name_input=="status"){
                    var status= $( ".status option:selected" ).val();
                    if(status==''){
                        valid=false;
                    }else{
                        valid=true;
                    }
                }
                if (valid == false) {
                    element.addClass("input-error").removeClass("valid");
                    error.show();
                    error_free = false
                }
            }
        }
        if (error_free != false) {
            $("#submit_form").submit();
        }

    });

    $('body').on("click",'.view_popup_detail', function () {
        var Id = $(this).attr("countid");
        var code = $(this).attr("name_record");
        show_booking(Id,code);
    });

    $('body').on("click", '#submit_form_tour_action', function () {
        var name_tour_add=$('#input_name_tour_add').val();
        var price_tour_add=$('#input_price_tour_add').val();
        var price_tour_511_add=$('#input_price_tour_511_add').val();
        var price_tour_5_add=$('#input_price_tour_5_add').val();
        var diem_khoi_hanh=$('#input_diem_khoi_hanh').val();
        var link = url + '/check-validate.html';
        if(name_tour_add!=''&&price_tour_add!=''&&price_tour_511_add!=''&&price_tour_5_add!=''){
            $.ajax({
                method: "GET",
                url: link,
                data: "value=" + name_tour_add + '&key=name&table=tour',
                success: function (response) {
                    var error=true;
                    if(response==1){
                        $('#error_name_tour_add').hide().html('');
                        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                        if (numberRegex.test(price_tour_add)) {
                            $('#error_price_tour_add').hide().html('');
                        }
                        else {
                            error=false;
                            $('#error_price_tour_add').show().html('Đơn giá phải là kiểu số');
                        }
                        if (numberRegex.test(price_tour_511_add)) {
                            $('#error_price_tour_511_add').hide().html('');
                        }
                        else {
                            error=false;
                            $('#error_price_tour_511_add').show().html('Đơn giá phải là kiểu số');
                        }

                        if (numberRegex.test(price_tour_5_add)) {
                            $('#error_price_tour_5_add').hide().html('');
                        }
                        else {
                            error=false;
                            $('#error_price_tour_5_add').show().html('Đơn giá phải là kiểu số');
                        }
                        if(error==true){
                            var link = url + '/booking/insert-tour';
                            $.ajax({
                                method: "POST",
                                url: link,
                                data : { // Danh sách các thuộc tính sẽ gửi đi
                                    name_tour_add : name_tour_add,
                                    price_tour_add: price_tour_add,
                                    price_tour_511_add: price_tour_511_add,
                                    price_tour_5_add: price_tour_5_add,
                                },
                                success: function (response) {
                                    if (numberRegex.test(response)) {
                                        var price_tour_add_format = price_tour_add.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                                        var price_tour_511_add_format = price_tour_511_add.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                                        var price_tour_5_add_format = price_tour_5_add.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                                        var table_insert='<tr> <td class="center">1</td>' +
                                            '<td><a>'+name_tour_add+'</a></td>' +
                                            '<td><span id="price_format_span">'+price_tour_add_format+'</span>' +
                                            '<input hidden="" id="input_price_format" value="'+price_tour_add_format+'">' +
                                            '<input hidden="" title="giá sửa" id="input_price" value="'+price_tour_add+'">' +
                                            '<input hidden="" id="input_price_old" title="giá cũ" value="'+price_tour_add+'">  | <a id="edit_price" href="javascript:void(0)"> <i class="fa fa-edit" title="Sửa đơn giá"></i></a>' +
                                            '<a id="reset_price" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a></td>' +
                                            '<td><span id="price_format_span_511">'+price_tour_511_add_format+'</span>' +
                                            '<input hidden="" title="giá sửa" id="input_price_511" value="'+price_tour_511_add+'"> | <a id="edit_price_511" href="javascript:void(0)"> <i class="fa fa-edit" title="Sửa đơn giá"></i></a>' +
                                            '<a id="reset_price_511" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a></td>' +
                                            '<td><span id="price_format_span_5">'+price_tour_5_add_format+'</span>' +
                                            '<input hidden="" title="giá sửa" id="input_price_5" value="'+price_tour_5_add+'"> | <a id="edit_price_5" href="javascript:void(0)"> <i class="fa fa-edit" title="Sửa đơn giá"></i></a>' +
                                            '<a id="reset_price_5" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a></td>' +
                                            '<td>'+diem_khoi_hanh+'</td>' +
                                            '</tr>'
                                        $('.table_booking_tour').html(table_insert);
                                        $('#input_name_tour').val(name_tour_add);
                                        $('#modal-form').modal('hide');
                                        $('#input_id_tour').val(response);
                                        $('#input_price_submit').val(price_tour_add);
                                        $('#input_price_511_submit').val(price_tour_511_add);
                                        $('#input_price_5_submit').val(price_tour_5_add);
                                        $('#input_id_tour').removeClass("input-error").addClass("valid");
                                        $('#input_name_tour').removeClass("input-error").addClass("valid");
                                    }
                                    else{
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

                        }
                    }else{
                        var mess = 'Tên tour "' + name_tour_add + '" đã tồn tại trong hệ thống';
                        $('#error_name_tour_add').show().html(mess);
                    }
                }
            });

        }else{
            if(name_tour_add==''){
                $('#error_name_tour_add').show().html('Bạn vui lòng nhập tên tour');
            }
            if(price_tour_add==''){
                $('#error_price_tour_add').show().html('Bạn vui lòng nhập giá người lớn');
            }
            if(price_tour_511_add==''){
                $('#error_price_tour_511_add').show().html('Bạn vui lòng nhập giá trẻ em 5-11 tuổi');
            }
            if(price_tour_5_add==''){
                $('#error_price_tour_5_add').show().html('Bạn vui lòng nhập giá trẻ em dưới 5 tuổi');
            }
        }
    });
    //
    //$('body').on("change", '#input_num_nguoi_lon', function () {
    //    checkSoNguoi();
    //});
    //$('body').on("change", '#input_num_tre_em', function () {
    //    checkSoNguoi();
    //});
    //$('body').on("change", '#input_num_tre_em_5', function () {
    //    checkSoNguoi();
    //});
    //$('i').ggtooltip();

    $('body').on("click", '#submit_form_action_cot', function () {
        var form_data = $("#submit_form_cot").serializeArray();
        var error_free = true;
        for (var input in form_data) {
            var name_input=form_data[input]['name'];
            if(name_input!='description'){
                var element = $("#input_" + name_input);
                var error = $("#error_" + name_input);
                var valid = element.hasClass("valid");
                if (valid == false) {
                    element.addClass("input-error").removeClass("valid");
                    error.show();
                    error_free = false
                }
            }

        }
        if (error_free != false) {
            $("#submit_form_cot").submit();
        }
    });
    $('body').on("input", '#input_name_gia', function () {
        checkNameGia();
    });
    $('body').on("input", '#input_price_cost', function () {
        checkPriceCost();
    });
    $('body').on("change", '#input_created', function () {
        checkNgayThanhToan();
    });
    $('body').on("input", '#input_created', function () {
        checkNgayThanhToan();
    });
    $('body').on("click", '#create_popup_cost', function () {
       $('#input_name_gia').val('');
       $('#input_price_cost').val('');
       $('#input_created').val('');
       $('#description_input').val('');
       $('#price_format_cost').hide().html('');
        $('#title_form').html('Thêm chi phí');
        $('.error-color').hide();
    });
    $('body').on("click",'.view_popup_detail_cost', function () {
        var Id = $(this).attr("countid");
        var code = $(this).attr("name_record");
        show_info_cost(Id,code);
    });
});
function show_info_cost(Id,name){
    $( "#title_form" ).html('Thôn tin chi tiết "<b>'+name+'</b>"');
    $( "#input_check_edit" ).val('edit');
    if(Id!=''){
        jQuery.post(url+"/get-detail-ajax/",
            {
                id: Id,
                table:'booking_cost'
            }
            )
            .done(function (data) {
                if(data!=0)
                {
                    var obj = jQuery.parseJSON(data);
                    $('#input_id_edit').val(Id);
                    $('#input_name_gia').val(obj.name);
                    $('#input_price_cost').val(obj.price);
                    $('#input_created').val(obj.created);
                    $('#description_input').val(obj.description);
                    if(obj.price!=''){
                        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                        if (numberRegex.test(obj.price)) {
                            var price_format = obj.price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                            $('#price_format_cost').show().html(price_format);
                        }
                    }else{
                        $('#price_format_cost').hide().html('');
                    }
                    if(obj.name!=''){
                        $('#input_name_gia').removeClass("input-error").addClass("valid");
                    }
                    if(obj.name!=''){
                        $('#input_price_cost').removeClass("input-error").addClass("valid");
                    }
                    if(obj.name!=''){
                        $('#input_created').removeClass("input-error").addClass("valid");
                    }
                }else{
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Ban không thể xem chi tiết chi phí"'+name+'"',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#modal-form').modal('hide');
                        }
                    });
                }
            });
    }
    else{
        lnv.alert({
            title: 'Lỗi',
            content: 'Ban không thể xem chi tiết chi phí "'+name+'"',
            alertBtnText: 'Ok',
            iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
            alertHandler: function () {
                $('#modal-form').modal('hide');
            }
        });
    }
}
// check name user
function checkNgayThanhToan() {
    var value = $("#input_created").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập ngày thanh toán';
        showHiddenNgayThanhToan(0, mess);
    } else {
        var mess = '';
        showHiddenNgayThanhToan(1, mess);
    }
}
function showHiddenNgayThanhToan(res, mess) {
    var error_created = $("#error_created");
    if (res == 1) {
        error_created.hide();
        $('#icon_error_created').hide();
        $('#input_created').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_created').show();
        $('#input_created').addClass("input-error").removeClass("valid");
        error_created.removeClass("success-color");
        error_created.addClass("error-color");
        error_created.html(mess);
        error_created.show();
    }
}

// check name user
function checkPriceCost() {
    var value = $("#input_price_cost").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập chi phí';
        showHiddenPriceCost(0, mess);
        $("#input_price_cost").val();
        $('#price_format_cost').hide().html('');
    } else {
        var mess = '';
        showHiddenPriceCost(1, mess);
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(value)) {
            var price_format = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            $('#price_format_cost').show().html(price_format);
        }else{
            $("#input_price_cost").val();
            $('#price_format_cost').hide().html('');
        }
    }
}
function showHiddenPriceCost(res, mess) {
    var error_price_cost = $("#error_price_cost");
    if (res == 1) {
        error_price_cost.hide();
        $('#icon_error_price_cost').hide();
        $('#input_price_cost').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_price_cost').show();
        $('#input_price_cost').addClass("input-error").removeClass("valid");
        error_price_cost.removeClass("success-color");
        error_price_cost.addClass("error-color");
        error_price_cost.html(mess);
        error_price_cost.show();
    }
}

// check name user
function checkNameGia() {
    var value = $("#input_name_gia").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập tên chi phí';
        showHiddenNameGia(0, mess);
    } else {
        var mess = '';
        showHiddenNameGia(1, mess);
    }
}
function showHiddenNameGia(res, mess) {
    var error_name_gia = $("#error_name_gia");
    if (res == 1) {
        error_name_gia.hide();
        $('#icon_error_name_gia').hide();
        $('#input_name_gia').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_name_gia').show();
        $('#input_name_gia').addClass("input-error").removeClass("valid");
        error_name_gia.removeClass("success-color");
        error_name_gia.addClass("error-color");
        error_name_gia.html(mess);
        error_name_gia.show();
    }
}


function checkSoNguoi(){

    var price=$('#input_price_submit').val();
    var price_2=$('#input_price_511_submit').val();
    var price_3=$('#input_price_5_submit').val();
    if(price!=''){
        returnGenDanhSachDoan(price,price_2,price_3);
    }

}
function show_booking(Id,name){
    $( "#title_form" ).html('Thôn tin chi tiết đơn hàng "<b>'+name+'</b>"');
    $( "#input_check_edit" ).val('edit');
    if(Id!=''){
        jQuery.post(url+"/get-detail-ajax-booking/",
            {
                id: Id,
                table:'booking'
            }
            )
            .done(function (data) {
                if(data!=0)
                {
                    var obj = jQuery.parseJSON(data);
                    $('.name_sales').html(obj.user_name);
                    $('.tien_te').html(obj.tien_te_name+' - '+obj.ty_gia);
                    $('.ngay_bat_dau').html(obj.ngay_bat_dau);
                    $('.han_thanh_toan').html(obj.han_thanh_toan);
                    $('.tinh_trang').html(obj.status_name);
                    $('.httt').html(obj.httt_name);
                    $('.so_nguoi').html(obj.so_nguoi);
                    $('.thue_vat').html(obj.vat_check_box);
                    $('.ghi_chu').html(obj.note);
                    $('.name_khach_hang').html(obj.name_customer);
                    $('.email_customer').html(obj.email_customer);
                    $('.address_customer').html(obj.address_customer);
                    $('.phone_customer').html(obj.phone_customer);
                    $('.fax_customer').html(obj.fax_customer);
                    $('.diem_don').html(obj.diem_don);
                    $('.nhom_kh').html(obj.nhom_customer);
                    $('.ngay_khoi_hanh').html(obj.ngay_khoi_hanh);
                    $('.ngay_ket_thuc').html(obj.ngay_ket_thuc);
                    $('.name_tour').html(obj.name_tour);
                    $('.gia_nguoi_lon').html(obj.price_new_format);
                    $('.gia_tre_em_511').html(obj.price_11_new_format);
                    $('.gia_tre_em_5').html(obj.price_5_new_format);
                    $('.tong_cong').html(obj.total_format);
                    $('.vat_thanh_tien').html(obj.vat_price_format);
                    $('.dat_coc').html(obj.tien_thanh_toan_format);
                    $('.con_lai').html(obj.conlai_format);

                    if(obj.user_tiepthi!=''){
                        $('.name_tiepthi').html(obj.user_tiepthi);
                        $('.status_tiep_thi').html(obj.status_tiepthi);
                        $('.price_tiep_thi').html(obj.price_tiep_thi);
                        $('.show_hoa_hong').show();
                    }else{
                        $('.show_hoa_hong').hide();
                        $('.name_tiepthi').html('');
                        $('.status_tiep_thi').html('');
                        $('.price_tiep_thi').html('');
                    }

                    //var output = document.getElementById('show_img_upload');
                    //if(obj.avatar!=''){
                    //    output.src = url+obj.avatar;
                    //}else{
                    //    var no_ava=$('#show_img_upload').attr('no-avatar');
                    //    output.src = no_ava;
                    //}
                    //if(obj.user_code!=''){
                    //    $('#input_user_code').val(obj.user_code);
                    //    $('#input_user_code').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_user_code').addClass("input-error").removeClass("valid");
                    //}
                    //
                    //if(obj.user_role==1)
                    //{
                    //    $("#input_user_role").prop('checked', true);
                    //}else{
                    //    $("#input_user_role").prop('checked', false);
                    //}
                    //if(obj.name!=''){
                    //    $('#input_full_name').val(obj.name);
                    //    $('#input_full_name').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_full_name').addClass("input-error").removeClass("valid");
                    //}
                    //var mr=obj.mr;
                    //if(mr!='')
                    //{
                    //    $(".chosen-default span").html(mr);
                    //    //$('.mr_user option').each(function() {
                    //    //
                    //    //    if($(this).val() == mr) {
                    //    //        $(this).prop("selected", true);
                    //    //    }
                    //    //});
                    //}
                    //if(obj.birthday!=''){
                    //    $('#input_birthday').val(obj.birthday);
                    //    $('#input_birthday').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_birthday').addClass("input-error").removeClass("valid");
                    //}
                    //if(obj.user_email!=''){
                    //    $('#input_email_user').val(obj.user_email);
                    //    $('#input_email_user').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_email_user').addClass("input-error").removeClass("valid");
                    //}
                    //if(obj.address!=''){
                    //    $('#input_address_user').val(obj.address);
                    //    $('#input_address_user').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_address_user').addClass("input-error").removeClass("valid");
                    //}
                    //if(obj.user_name!=''){
                    //    $('#input_user_name').val(obj.user_name);
                    //    $('#input_user_name').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_user_name').addClass("input-error").removeClass("valid");
                    //}
                    //if(obj.phone!=''){
                    //    $('#input_user_phone').val(obj.phone);
                    //    $('#input_user_phone').removeClass("input-error").addClass("valid");
                    //}
                    //else{
                    //    $('#input_user_phone').addClass("input-error").removeClass("valid");
                    //}
                    //$('#input_user_ngay_lam_viec').val(obj.ngay_lam_viec);
                    //$('#input_user_ngay_chinh_thuc').val(obj.ngay_chinh_thuc);
                    //
                    //$('#input_password').val('code');
                    //$('#input_password').removeClass("input-error").addClass("valid");
                    //$('#input_password_confirm').val('code');
                    //$('#input_password_confirm').removeClass("input-error").addClass("valid");
                    //$('#hidden_edit_pass').hide();
                    //$('#input_id_edit').val(Id);
                    ////$('.mr_user').val(mr).prop('selected', true);
                    ////$(".chosen-default span").val(mr);

                }else{
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Ban không thể xem chi tiết đơn hàng "'+name+'"',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#modal-form').modal('hide');
                        }
                    });
                }
            });
    }
    else{
        lnv.alert({
            title: 'Lỗi',
            content: 'Ban không thể xem chi tiết đơn hàng "'+name+'"',
            alertBtnText: 'Ok',
            iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
            alertHandler: function () {
                $('#modal-form').modal('hide');
            }
        });
    }
}
function returnDatCoc() {
    var value = $('#input_dat_coc').val();
    if(value!=''){
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(value)) {
            var value_format = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            $('#dat_coc_format').html(value_format);

        }else{
            $('#input_dat_coc').focus().select().val();
            $('#dat_coc_format').html('');
        }
    }
    var price=$('#input_price_submit').val();
    var price_2=$('#input_price_511_submit').val();
    var price_3=$('#input_price_5_submit').val();
    if(price!=''){
        returnTinhTien(price,price_2,price_3);
    }

}
function checkDiemDon() {
    var value = $("#input_diem_don").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập điểm đón';
        showHiddenDiemDon(0, mess);
    } else {
        var mess = '';
        showHiddenDiemDon(1, mess);
    }
}
function showHiddenDiemDon(res, mess) {
    var error_diem_don = $("#error_diem_don");
    if (res == 1) {
        error_diem_don.hide();
        $('#icon_error_diem_don').hide();
        $('#input_diem_don').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_diem_don').show();
        $('#input_diem_don').addClass("input-error").removeClass("valid");
        error_diem_don.removeClass("success-color");
        error_diem_don.addClass("error-color");
        error_diem_don.html(mess);
        error_diem_don.show();
    }
}
//
function checkPhoneCustomer() {
    var value = $("#input_phone").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập điện thoại';
        showHiddenPhoneCustomer(0, mess);
    } else {
        var mess = '';
        showHiddenPhoneCustomer(1, mess);
    }
}
function showHiddenPhoneCustomer(res, mess) {
    var error_phone = $("#error_phone");
    if (res == 1) {
        error_phone.hide();
        $('#icon_error_phone').hide();
        $('#input_phone').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_phone').show();
        $('#input_phone').addClass("input-error").removeClass("valid");
        error_phone.removeClass("success-color");
        error_phone.addClass("error-color");
        error_phone.html(mess);
        error_phone.show();
    }
}


//
function checkAddressCustomer() {
    var value = $("#input_address").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập điện thoại';
        showHiddenAddressCustomer(0, mess);
    } else {
        var mess = '';
        showHiddenAddressCustomer(1, mess);
    }
}
function showHiddenAddressCustomer(res, mess) {
    var error_address = $("#error_address");
    if (res == 1) {
        error_address.hide();
        $('#icon_error_address').hide();
        $('#input_address').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_address').show();
        $('#input_address').addClass("input-error").removeClass("valid");
        error_address.removeClass("success-color");
        error_address.addClass("error-color");
        error_address.html(mess);
        error_address.show();
    }
}

//
function checkEmailCustomer() {
    var value = $("#input_email").val();
    if (value != '') {
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email = re.test(value);
        if (is_email) {
            var mess = '';
            showHiddenEmail(1, mess);
        }
        else {
            var mess = 'Email không đúng định dạng';
            showHiddenEmail(0, mess);
        }
    }
    else {
        var mess = 'Bạn vui lòng nhập email';
        showHiddenEmail(0, mess);
    }

}
// check mã nhân viên
function showHiddenEmail(res, mess) {
    var email_user_error = $("#error_email");
    if (res == 1) {
        email_user_error.hide();
        $('#icon_error_email').hide();
        $('#input_email').removeClass("input-error").addClass("valid");
    }
    else {
        $('#icon_error_email').show();
        $('#input_email').addClass("input-error").removeClass("valid");
        email_user_error.removeClass("success-color");
        email_user_error.addClass("error-color");
        email_user_error.html(mess);
        email_user_error.show();
    }
}
// check name user
function checkNameCustomer() {
    var value = $("#input_name_customer").val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập tên khách hàng';
        showHiddenNameCustomer(0, mess);
    } else {
        var mess = '';
        showHiddenNameCustomer(1, mess);
    }
}
function showHiddenNameCustomer(res, mess) {
    var error_name_customner = $("#error_name_customer");
    if (res == 1) {
        error_name_customner.hide();
        $('#icon_error_name_customer').hide();
        $('#input_name_customer').removeClass("input-error").addClass("valid");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_name_customer').show();
        $('#input_name_customer').addClass("input-error").removeClass("valid");
        error_name_customner.removeClass("success-color");
        error_name_customner.addClass("error-color");
        error_name_customner.html(mess);
        error_name_customner.show();
    }
}

// check ngày bắt đầu
function checkNgayKhoiHanh() {
    var value = $("#input_ngay_khoi_hanh").val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn ngày khởi hành';
        showHiddenNgayKhoiHanh(0, mess);
    } else {
        var value_date = value.split("-");
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var eighteenYearsAgo = moment().subtract(18, "years");
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess = "Không đúng định dạng ngày tháng năm";
        }
        else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenNgayKhoiHanh(res, mess);
    }
}
function showHiddenNgayKhoiHanh(res, mess) {
    var error_ngay_khoi_hanh = $("#error_ngay_khoi_hanh");
    if (res == 1) {
        error_ngay_khoi_hanh.hide();
        $('#input_ngay_khoi_hanh').removeClass("input-error").addClass("valid");
        $('#icon_ngay_khoi_hanh').removeClass("error-color");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_khoi_hanh').addClass("input-error").removeClass("valid");
        $('#icon_ngay_khoi_hanh').addClass("error-color");
        error_ngay_khoi_hanh.removeClass("success-color");
        error_ngay_khoi_hanh.addClass("error-color");
        error_ngay_khoi_hanh.html(mess);
        error_ngay_khoi_hanh.show();
    }
}

// check ngày bắt đầu
function checkNgayKetThuc() {
    var value = $("#input_ngay_ket_thuc").val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn ngày khởi hành';
        showHiddenNgayKetThuc(0, mess);
    } else {
        var value_date = value.split("-");
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var eighteenYearsAgo = moment().subtract(18, "years");
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess = "Không đúng định dạng ngày tháng năm";
        }
        else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenNgayKetThuc(res, mess);
    }
}
function showHiddenNgayKetThuc(res, mess) {
    var error_ngay_ket_thuc = $("#error_ngay_ket_thuc");
    if (res == 1) {
        error_ngay_ket_thuc.hide();
        $('#input_ngay_ket_thuc').removeClass("input-error").addClass("valid");
        $('#icon_ngay_ket_thuc').removeClass("error-color");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_ket_thuc').addClass("input-error").removeClass("valid");
        $('#icon_ngay_ket_thuc').addClass("error-color");
        error_ngay_ket_thuc.removeClass("success-color");
        error_ngay_ket_thuc.addClass("error-color");
        error_ngay_ket_thuc.html(mess);
        error_ngay_ket_thuc.show();
    }
}

//
function checkHanThanhToan() {
    var value = $("#input_han_thanh_toan").val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn hạn thanh toán';
        showHiddenHanThanhToan(0, mess);
    } else {
        var value_date = value.split("-");
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var birthday = moment(value);
        if (!birthday.isValid()) {
            mess = "Không đúng định dạng ngày tháng năm";
        }
        else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenHanThanhToan(res, mess);
    }
}
function showHiddenHanThanhToan(res, mess) {
    var error_han_thanh_toan = $("#error_han_thanh_toan");
    if (res == 1) {
        error_han_thanh_toan.hide();
        $('#input_han_thanh_toan').removeClass("input-error").addClass("valid");
        $('#icon_han_thanh_toan').removeClass("error-color");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_bat_dau').addClass("input-error").removeClass("valid");
        $('#icon_ngay_bat_dau').addClass("error-color");
        error_han_thanh_toan.removeClass("success-color");
        error_han_thanh_toan.addClass("error-color");
        error_han_thanh_toan.html(mess);
        error_han_thanh_toan.show();
    }
}

// check ngày bắt đầu
function checkNgayBatDau() {
    var value = $("#input_ngay_bat_dau").val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn ngày bắt đầu';
        showHiddenNgayBatDau(0, mess);
    } else {
        var value_date = value.split("-");
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var eighteenYearsAgo = moment().subtract(18, "years");
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess = "Không đúng định dạng ngày tháng năm";
        }
        else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenNgayBatDau(res, mess);
    }
}
function showHiddenNgayBatDau(res, mess) {
    var error_ngay_bat_dau = $("#error_ngay_bat_dau");
    if (res == 1) {
        error_ngay_bat_dau.hide();
        $('#input_ngay_bat_dau').removeClass("input-error").addClass("valid");
        $('#icon_ngay_bat_dau').removeClass("error-color");
    }
    else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_bat_dau').addClass("input-error").removeClass("valid");
        $('#icon_ngay_bat_dau').addClass("error-color");
        error_ngay_bat_dau.removeClass("success-color");
        error_ngay_bat_dau.addClass("error-color");
        error_ngay_bat_dau.html(mess);
        error_ngay_bat_dau.show();
    }
}

function removeValueCustomer() {
    $('#input_id_customer').val('');
    $('#input_address').val('').removeClass("valid").addClass("input-error");
    $('#input_phone').val('').removeClass("valid").addClass("input-error");
    $('#input_fax').val('');
    $('#input_email').val('').removeClass("valid").addClass("input-error");
    $(".nhom_khach_hang .chosen-default span").html('Nhóm khách hàng ...');
    $('#input_id_category').val('');
}

function removeValueTour() {
    $('#input_list_price').html('');
    $('.table_booking_tour').html('');
    $('#input_id_tour').val('');
    $('#tong_cong').html('');    $('#tong_cong').html('');
    $('#vat').html('');
    $('#dat_coc_format').html('');
    $('#con_lai').html('');
    $('#input_dat_coc').val('');
    $('#input_price_submit').val('');
    $('#input_price_511_submit').val('');
    $('#input_price_5_submit').val('');
    $('.price_tiep_thi').html('');
    $('#input_id_tour').removeClass("valid").addClass("input-error");
    $('#input_name_tour').removeClass("valid").addClass("input-error");
    var error_name_tour=$("#error_name_tour" );
    error_name_tour.removeClass("success-color");
    error_name_tour.addClass("error-color");
    error_name_tour.html("Bạn vui lòng nhập và chọn tour");
    error_name_tour.show();
}
function removeValueUser() {
    $('.table_booking_user').html('');
    $('#input_id_user').val('');
    $('#input_id_user').removeClass("valid").addClass("input-error");
    $('#input_name_user').removeClass("valid").addClass("input-error");
    var error_name_user=$("#error_name_user" );
    error_name_user.removeClass("success-color");
    error_name_user.addClass("error-color");
    error_name_user.html("Bạn vui lòng nhập và chọn sales");
    error_name_user.show();
}

function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}
function returnDanhSachDoan(){
    var numbe_1=parseInt($('#input_num_nguoi_lon').val());
    var numbe_2=parseInt($('#input_num_tre_em').val());
    var numbe_3=parseInt($('#input_num_tre_em_5').val());

    //var id=$(id_field).attr('id_title');
    var name_1=$('#name_price_nguoi_lon').html();
    var name_2=$('#name_price_tre_em_511').html();
    var name_3=$('#name_price_tre_em_5').html();
    if(numbe_1==0){
        numbe_1=1;
        $('#input_num_nguoi_lon').val(1);
    }

    var so_cho=$('#input_so_cho').val();
    var check_show_table=true;
    var total=numbe_1+numbe_2+numbe_3;
    //$('#input_total_num').val(total);
    if(so_cho!=undefined){
        so_cho=parseInt(so_cho);
        if(total>so_cho){
            check_show_table=false;
            $('#input_num_nguoi_lon').addClass("input-error").removeClass("valid");
            $('#error_so_nguoi').show().html('Số người bạn vừa nhập đã vượt quá số chỗ, bạn vui lòng nhập lại số người');
        }else{
            check_show_table=true;
            $('#input_num_nguoi_lon').addClass("valid").removeClass("input-error");
            $('#error_so_nguoi').hide().html('Bạn vui lòng kiểm tra lại số người');
        }
    }
    var row='';
    var stt=1;
    var price= $('#input_price').val();
    if(price===''||price===0){
        price==='Liên hệ'
    }
    var price_2= $('#input_price_511').val();
    if(price_2===''||price_2===0){
        price_2==price
    }
    var price_3= $('#input_price_5').val();
    if(price_3===''||price_3===0){
        price_3==price
    }
    var total_nguoi_lon=0;
    var ti_le_nguoi_lon='';
    if(check_show_table==true){
        $(".show_hide_table").html('');
        if(numbe_1>0){
            if(price==='Liên hệ'){
                total_nguoi_lon='Liên hệ';
                var price_item='Liên hệ';
            }else{
                var price_item= price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                total_nguoi_lon=price*numbe_1;
            }

            if(numbe_1>1){

                var price_in_array=$('#input_price_nguoi_lon_'+numbe_1).val();
                alert(price_in_array);

                //alert(price_in_array);
                if(price_in_array!=undefined){
                    if(price_in_array==='Liên hệ'){
                        total_nguoi_lon='Liên hệ'
                    }else{
                        price_item= price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                        total_nguoi_lon=(price_in_array*numbe_1);

                        ti_le_nguoi_lon=((price-price_in_array)/price)*100;
                        ti_le_nguoi_lon = Math.round(ti_le_nguoi_lon);
                        if(ti_le_nguoi_lon!=0){
                            ti_le_nguoi_lon='(<i class="fa fa-long-arrow-down"></i>'+ti_le_nguoi_lon+'%)';
                        }else{
                            ti_le_nguoi_lon='';
                        }


                    }
                }else{
                    var price_tu=$('#input_price_nguoi_lon_tu').val();
                    if(price_tu!=undefined){
                        if(parseInt(numbe_1)>=parseInt(price_tu)){
                            var price_in_array=$('#input_price_nguoi_lon_lon_hon_'+price_tu).val();
                            if(price_in_array==='Liên hệ'){
                                total_nguoi_lon='Liên hệ'
                            }else{
                                price_item= price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                                total_nguoi_lon=(price_in_array*numbe_1);

                                ti_le_nguoi_lon=((price-price_in_array)/price)*100;
                                ti_le_nguoi_lon = Math.round(ti_le_nguoi_lon);
                                if(ti_le_nguoi_lon!=0){
                                    ti_le_nguoi_lon='(<i class="fa fa-long-arrow-down"></i>'+ti_le_nguoi_lon+'%)';
                                }else{
                                    ti_le_nguoi_lon='';
                                }
                            }
                        }
                    }
                }
            }
            for(var i=1;i<=numbe_1;i++){
                row =row+'<tr id="row_customer_' + stt+ '"><td class="center stt_cus">' + stt + '</td>' +
                    '<td><input style="height: 30px" name="name_customer_sub[]" id="input_name_customer_sub_' + stt + '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="birthday_customer[]" id="input_birthday_customer_sub_' + stt + '" type="date" placeholder="dd/MM/yyyy" class="valid input_table datepicker"></td>' +
                    '<td><input style="height: 30px" name="email_customer[]" id="input_email_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="phone_customer[]" id="input_phone_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" name="address_customer[]" id="input_address_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="1"  id="input_tuoi_number_customer_' + stt + '" type="text"  class="valid input_table">' +
                    '<input hidden value="'+name_1+'"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' + stt + '" type="text" class="valid input_table"><span style="font-size: 12px;">'+name_1+'</span></td>' +
                    '<td><input style="height: 30px" name="passport_customer[]" id="input_passport_customer_' + stt + '" type="text" class="valid input_table "></td>' +
                    '<td><input style="height: 30px" name="date_passport_customer[]" id="input_date_passport_customer_' + stt + '" type="date" class="valid input_table datepicker"></td>' +
                    '<td style="width: 130px"><span style="font-size: 12px;color: red">'+price_item+' '+ti_le_nguoi_lon+'</span></td>' +
                    '</tr>';
                stt=stt+1;
            }
        }
        var ti_le_tre_em_511='';
        var total_tre_em_511=0;
        if(numbe_2>0){
            if(price_2==='Liên hệ'){
                total_tre_em_511='Liên hệ';
                var price_item='Liên hệ';
            }else{
                var price_item= price_2.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                total_tre_em_511=price_2*numbe_2;
            }
            if(numbe_2>1){
                var price_in_array=$('#input_price_tre_em_511_'+numbe_2).val();
                if(price_in_array!=undefined){
                    if(price_in_array==='Liên hệ'){
                        total_tre_em_511='Liên hệ'
                    }else{
                        price_item= price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                        total_tre_em_511=(price_in_array*numbe_2);

                        ti_le_tre_em_511=((price_2-price_in_array)/price_2)*100;
                        ti_le_tre_em_511 = Math.round(ti_le_tre_em_511);
                        if(ti_le_tre_em_511!=0){
                            ti_le_tre_em_511='(<i class="fa fa-long-arrow-down"></i>'+ti_le_tre_em_511+'%)';
                        }else{
                            ti_le_tre_em_511='';
                        }
                    }
                }else{
                    var price_tu=$('#input_price_tre_em_511_tu').val();
                    if(price_tu!=undefined){
                        if(parseInt(numbe_2)>=parseInt(price_tu)){
                            var price_in_array=$('#input_price_tre_em_511_lon_hon_'+price_tu).val();
                            if(price_in_array==='Liên hệ'){
                                total_tre_em_511='Liên hệ'
                            }else{
                                price_item= price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                                total_tre_em_511=(price_in_array*numbe_2);

                                ti_le_tre_em_511=((price_2-price_in_array)/price_2)*100;
                                ti_le_tre_em_511 = Math.round(ti_le_tre_em_511);
                                if(ti_le_tre_em_511!=0){
                                    ti_le_tre_em_511='(<i class="fa fa-long-arrow-down"></i>'+ti_le_tre_em_511+'%)';
                                }else{
                                    ti_le_tre_em_511='';
                                }
                            }
                        }
                    }
                }
            }

            for(var j=1;j<=numbe_2;j++){
                row =row+'<tr id="row_customer_' + stt+ '"><td class="center stt_cus">' + stt + '</td>' +
                    '<td><input style="height: 30px" name="name_customer_sub[]" id="input_name_customer_sub_' + stt + '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="birthday_customer[]" id="input_birthday_customer_sub_' + stt + '" type="date" class="valid input_table datepicker"></td>' +
                    '<td><input style="height: 30px" name="email_customer[]" id="input_email_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="phone_customer[]" id="input_phone_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" name="address_customer[]" id="input_address_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="2"  id="input_tuoi_number_customer_' + stt + '" type="text"  class="valid input_table">' +
                    '<input hidden value="'+name_2+'"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' + stt + '" type="text" class="valid input_table"><span style="font-size: 12px;">'+name_2+'</span></td>' +
                    '<td><input style="height: 30px" name="passport_customer[]" id="input_passport_customer_' + stt + '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" name="date_passport_customer[]" id="input_date_passport_customer_' + stt + '" type="date"class="valid input_table datepicker"></td>' +
                    '<td><span style="font-size: 12px;color: red">'+price_item+' '+ti_le_tre_em_511+'</span></td>' +
                    '</tr>';
                stt=stt+1;
            }
        }
        var ti_le_tre_em_5='';
        var total_tre_em_5=0;
        if(numbe_3>0){
            if(price_3==='Liên hệ'){
                total_tre_em_5='Liên hệ';
                var price_item='Liên hệ';
            }else{
                var price_item= price_3.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                total_tre_em_5=price_3*numbe_3;
            }
            if(numbe_3>1){
                var price_in_array=$('#input_price_tre_em_5_'+numbe_3).val();
                if(price_in_array!=undefined){
                    if(price_in_array==='Liên hệ'){
                        total_tre_em_5='Liên hệ'
                    }else{
                        price_item= price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                        total_tre_em_5=(price_in_array*numbe_3);

                        ti_le_tre_em_5=((price_3-price_in_array)/price_3)*100;
                        ti_le_tre_em_5 = Math.round(ti_le_tre_em_5);
                        if(ti_le_tre_em_5!=0){
                            ti_le_tre_em_5='(<i class="fa fa-long-arrow-down"></i>'+ti_le_tre_em_5+'%)';
                        }else{
                            ti_le_tre_em_5='';
                        }
                    }
                }else{
                    var price_tu=$('#input_price_tre_em_5_tu').val();
                    if(price_tu!=undefined){
                        if(parseInt(numbe_3)>=parseInt(price_tu)){
                            var price_in_array=$('#input_price_tre_em_5_lon_hon_'+price_tu).val();
                            if(price_in_array==='Liên hệ'){
                                total_tre_em_5='Liên hệ'
                            }else{
                                price_item= price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                                total_tre_em_5=(price_in_array*numbe_3);

                                ti_le_tre_em_5=((price_3-price_in_array)/price_3)*100;
                                ti_le_tre_em_5 = Math.round(ti_le_tre_em_5);
                                if(ti_le_tre_em_5!=0){
                                    ti_le_tre_em_5='(<i class="fa fa-long-arrow-down"></i>'+ti_le_tre_em_5+'%)';
                                }else{
                                    ti_le_tre_em_5='';
                                }
                            }
                        }
                    }
                }
            }
            for(var k=1;k<=numbe_3;k++){
                row =row+'<tr id="row_customer_' + stt+ '"><td class="center stt_cus">' + stt + '</td>' +
                    '<td><input style="height: 30px" name="name_customer_sub[]" id="input_name_customer_sub_' + stt + '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="birthday_customer[]" id="input_birthday_customer_sub_' + stt + '" type="date" class="valid input_table datepicker"></td>' +
                    '<td><input style="height: 30px" name="email_customer[]" id="input_email_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="phone_customer[]" id="input_phone_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" name="address_customer[]" id="input_address_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="3"  id="input_tuoi_number_customer_' + stt + '" type="text"  class="valid input_table">' +
                    '<input hidden value="'+name_3+'"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' + stt + '" type="text" class="valid input_table"><span style="font-size: 12px;">'+name_3+'</span></td>' +
                    '<td><input style="height: 30px" name="passport_customer[]" id="input_passport_customer_' + stt + '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" name="date_passport_customer[]" id="input_date_passport_customer_' + stt + '" type="date"class="valid input_table datepicker"></td>' +
                    '<td><span style="font-size: 12px;color: red">'+price_item+' '+ti_le_tre_em_5+'</span></td>' +
                    '</tr>';
                stt=stt+1;
            }
        }

        $(".show_hide_table").html(row);

        if(total_nguoi_lon==="Liên hệ"||total_tre_em_511==="Liên hệ"||total_tre_em_5==="Liên hệ")
        {
            $('#amount_total').html('Liên hệ');
        }else{
            var total_price=total_nguoi_lon+total_tre_em_511+total_tre_em_5;
            total_price= total_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            $('#amount_total').html(total_price);
        }
    }


}

function returnGenDanhSachDoan(price,price_2,price_3){
    var numbe_1=parseInt($('#input_num_nguoi_lon').val());
    var numbe_2=parseInt($('#input_num_tre_em').val());
    var numbe_3=parseInt($('#input_num_tre_em_5').val());

    //var id=$(id_field).attr('id_title');
    var name_1=$('#name_price_nguoi_lon').html();
    var name_2=$('#name_price_tre_em_511').html();
    var name_3=$('#name_price_tre_em_5').html();
    if(numbe_1==0){
        numbe_1=1;
        $('#input_num_nguoi_lon').val(1);
    }

    var so_cho=$('#input_so_cho').val();
    var check_show_table=true;
    var total=numbe_1+numbe_2+numbe_3;
    //$('#input_total_num').val(total);
    if(so_cho!=undefined){
        so_cho=parseInt(so_cho);
        if(total>so_cho){
            check_show_table=false;
            $('#input_num_nguoi_lon').addClass("input-error").removeClass("valid");
            $('#error_so_nguoi').show().html('Số người bạn vừa nhập đã vượt quá số chỗ, bạn vui lòng nhập lại số người');
        }else{
            check_show_table=true;
            $('#input_num_nguoi_lon').addClass("valid").removeClass("input-error");
            $('#error_so_nguoi').hide().html('Bạn vui lòng kiểm tra lại số người');
        }
    }
    var row='';
    var stt=1;
    //var price= $('#input_price').val();
    if(price===''||price===0){
        price==='Liên hệ'
    }
    //var price_2= $('#input_price_511').val();
    if(price_2===''||price_2===0){
        price_2==price
    }
    //var price_3= $('#input_price_5').val();
    if(price_3===''||price_3===0){
        price_3==price
    }
    if(check_show_table==true){

        if(numbe_1>0){
            if(price==='Liên hệ'){
                var price_item='Liên hệ';
            }else{
                var price_item= price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            }
            for(var i=1;i<=numbe_1;i++){
                var name_customer_sub='';
                if($('#input_name_customer_sub_'+ stt).length){
                    name_customer_sub=$('#input_name_customer_sub_'+ stt).val();
                }
                var birthday_customer='';
                if($('#input_birthday_customer_sub_'+ stt).length){
                    birthday_customer=$('#input_birthday_customer_sub_'+ stt).val();
                }
                var email_customer='';
                if($('#input_email_customer_'+ stt).length){
                    email_customer=$('#input_email_customer_'+ stt).val();
                }
                var phone_customer='';
                if($('#input_phone_customer_'+ stt).length){
                    phone_customer=$('#input_phone_customer_'+ stt).val();
                }
                var address_customer='';
                if($('#input_phone_customer_'+ stt).length){
                    address_customer=$('#input_address_customer_'+ stt).val();
                }
                var tuoi_customer='';
                if($('#input_tuoi_customer_'+ stt).length){
                    tuoi_customer=$('#input_tuoi_customer_'+ stt).val();
                }
                if(tuoi_customer==''){
                    tuoi_customer=name_1;
                }
                var passport_customer='';
                if($('#input_passport_customer_'+ stt).length){
                    passport_customer=$('#input_passport_customer_'+ stt).val();
                }
                var date_passport_customer='';
                if($('#input_date_passport_customer_'+ stt).length){
                    date_passport_customer=$('#input_date_passport_customer_'+ stt).val();
                }
                row =row+'<tr id="row_customer_' + stt+ '"><td class="center stt_cus">' + stt + '</td>' +
                    '<td><input style="height: 30px" value="'+name_customer_sub+'" name="name_customer_sub[]" id="input_name_customer_sub_' + stt + '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+birthday_customer+'" name="birthday_customer[]" id="input_birthday_customer_sub_' + stt + '" type="date"  class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+email_customer+'" name="email_customer[]" id="input_email_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+phone_customer+'" name="phone_customer[]" id="input_phone_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px"  value="'+address_customer+'" name="address_customer[]" id="input_address_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td>' +

                    '<input hidden style="height: 30px"  name="tuoi_number_customer[]" value="1"  id="input_tuoi_number_customer_' + stt + '" type="text"  class="valid input_table">' +
                    '<input  value="'+tuoi_customer+'" style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' + stt + '" type="text" class="valid input_table">' +
                    '<td><input style="height: 30px" value="'+passport_customer+'" name="passport_customer[]" id="input_passport_customer_' + stt + '" type="text" class="valid input_table "></td>' +
                    '<td><input style="height: 30px" value="'+date_passport_customer+'" name="date_passport_customer[]" id="input_date_passport_customer_' + stt + '" type="date" class="valid input_table"></td>' +
                    '<td style="width: 150px"><span style="font-size: 12px;color: red">'+price_item+'</span></td>' +
                    '</tr>';
                stt=stt+1;
            }
        }
        if(numbe_2>0){
            if(price==='Liên hệ'){
                var price_item='Liên hệ';
            }else{
                var price_item= price_2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            }
            for(var j=1;j<=numbe_2;j++){
                var name_customer_sub='';
                if($('#input_name_customer_sub_'+ stt).length){
                    name_customer_sub=$('#input_name_customer_sub_'+ stt).val();
                }
                var birthday_customer='';
                if($('#input_birthday_customer_sub_'+ stt).length){
                    birthday_customer=$('#input_birthday_customer_sub_'+ stt).val();
                }
                var email_customer='';
                if($('#input_email_customer_'+ stt).length){
                    email_customer=$('#input_email_customer_'+ stt).val();
                }
                var phone_customer='';
                if($('#input_phone_customer_'+ stt).length){
                    phone_customer=$('#input_phone_customer_'+ stt).val();
                }
                var address_customer='';
                if($('#input_phone_customer_'+ stt).length){
                    address_customer=$('#input_address_customer_'+ stt).val();
                }
                var tuoi_customer='';
                if($('#input_tuoi_customer_'+ stt).length){
                    tuoi_customer=$('#input_tuoi_customer_'+ stt).val();
                }
                if(tuoi_customer==''){
                    tuoi_customer=name_2;
                }
                var passport_customer='';
                if($('#input_passport_customer_'+ stt).length){
                    passport_customer=$('#input_passport_customer_'+ stt).val();
                }
                var date_passport_customer='';
                if($('#input_date_passport_customer_'+ stt).length){
                    date_passport_customer=$('#input_date_passport_customer_'+ stt).val();
                }
                row =row+'<tr id="row_customer_' + stt+ '"><td class="center stt_cus">' + stt + '</td>' +
                    '<td><input style="height: 30px" value="'+name_customer_sub+'" name="name_customer_sub[]" id="input_name_customer_sub_' + stt + '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+birthday_customer+'" name="birthday_customer[]" id="input_birthday_customer_sub_' + stt + '" type="date" class="valid input_table date-picker" data-date-format="dd-mm-yyyy"></td>' +
                    '<td><input style="height: 30px" value="'+email_customer+'" name="email_customer[]" id="input_email_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+phone_customer+'" name="phone_customer[]" id="input_phone_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" value="'+address_customer+'" name="address_customer[]" id="input_address_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px"  name="tuoi_number_customer[]" value="2"  id="input_tuoi_number_customer_' + stt + '" type="text"  class="valid input_table">' +
                    '<input   value="'+tuoi_customer+'"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' + stt + '" type="text" class="valid input_table">' +
                    '<td><input style="height: 30px" value="'+passport_customer+'" name="passport_customer[]" id="input_passport_customer_' + stt + '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" value="'+date_passport_customer+'" name="date_passport_customer[]" id="input_date_passport_customer_' + stt + '" type="date" class="valid input_table date-picker"></td>' +
                    '<td style="width: 150px"><span style="font-size: 12px;color: red">'+price_item+'</span></td>' +
                    '</tr>';
                stt=stt+1;
            }
        }
        if(numbe_3>0){
            if(price==='Liên hệ'){
                var price_item='Liên hệ';
            }else{
                var price_item= price_3.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
            }
            for(var k=1;k<=numbe_3;k++){
                var name_customer_sub='';
                if($('#input_name_customer_sub_'+ stt).length){
                    name_customer_sub=$('#input_name_customer_sub_'+ stt).val();
                }
                var birthday_customer='';
                if($('#input_birthday_customer_sub_'+ stt).length){
                    birthday_customer=$('#input_birthday_customer_sub_'+ stt).val();
                }
                var email_customer='';
                if($('#input_email_customer_'+ stt).length){
                    email_customer=$('#input_email_customer_'+ stt).val();
                }
                var phone_customer='';
                if($('#input_phone_customer_'+ stt).length){
                    phone_customer=$('#input_phone_customer_'+ stt).val();
                }
                var address_customer='';
                if($('#input_phone_customer_'+ stt).length){
                    address_customer=$('#input_address_customer_'+ stt).val();
                }
                var tuoi_customer='';
                if($('#input_tuoi_customer_'+ stt).length){
                    tuoi_customer=$('#input_tuoi_customer_'+ stt).val();
                }
                if(tuoi_customer==''){
                    tuoi_customer=name_3;
                }
                var passport_customer='';
                if($('#input_passport_customer_'+ stt).length){
                    passport_customer=$('#input_passport_customer_'+ stt).val();
                }
                var date_passport_customer='';
                if($('#input_date_passport_customer_'+ stt).length){
                    date_passport_customer=$('#input_date_passport_customer_'+ stt).val();
                }
                row =row+'<tr id="row_customer_' + stt+ '"><td class="center stt_cus">' + stt + '</td>' +
                    '<td><input style="height: 30px" value="'+name_customer_sub+'" name="name_customer_sub[]" id="input_name_customer_sub_' + stt + '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+birthday_customer+'" name="birthday_customer[]" id="input_birthday_customer_sub_' + stt + '" type="date" class="valid input_table date-picker"></td>' +
                    '<td><input style="height: 30px" value="'+email_customer+'" name="email_customer[]" id="input_email_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="'+phone_customer+'" name="phone_customer[]" id="input_phone_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" value="'+address_customer+'" name="address_customer[]" id="input_address_customer_' + stt + '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="3"  id="input_tuoi_number_customer_' + stt + '" type="text"  class="valid input_table">' +
                    '<input  value="'+tuoi_customer+'" style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' + stt + '" type="text" class="valid input_table">' +
                    '<td><input style="height: 30px" value="'+passport_customer+'" name="passport_customer[]" id="input_passport_customer_' + stt + '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" value="'+date_passport_customer+'" name="date_passport_customer[]" id="input_date_passport_customer_' + stt + '" type="date" class="valid input_table date-picker" data-date-format="dd-mm-yyyy"></td>' +
                    '<td style="width: 150px"><span style="font-size: 12px;color: red">'+price_item+'</span></td>' +
                    '</tr>';
                stt=stt+1;
            }
        }
        $(".show_hide_table").html('');
        $(".show_hide_table").html(row);
        returnTinhTien(price,price_2,price_3);
    }


}

function  returnTinhTien(price_nguoi_lon,price_tre_em_511,price_tre_em_5){
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    //var price_nguoi_lon = $('#input_price').val();
    //var price_tre_em_511 = $('#input_price_511').val();
    //var price_tre_em_5 = $('#input_price_5').val();

    var number_nguoi_lon = $('#input_num_nguoi_lon').val();
    var number_tre_em_511 = $('#input_num_tre_em').val();
    var number_tre_em_5 = $('#input_num_tre_em_5').val();
    if(numberRegex.test(price_nguoi_lon)&&numberRegex.test(price_tre_em_511)&&numberRegex.test(price_tre_em_5)) {
        if (number_nguoi_lon > 0 && number_nguoi_lon != '') {
            if (price_nguoi_lon == undefined) {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Bạn vui lòng chọn tour',
                    alertBtnText: 'Ok',
                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {
                        $('#input_name_tour').show().focus().select();
                    }
                });
            } else {
                var con_lai = 0;
                var total = 0;
                if (number_tre_em_511 == '') {
                    number_tre_em_511 = 0;
                }
                if (number_tre_em_5 == '') {
                    number_tre_em_5 = 0;
                }
                var total_nguoi_lon = parseInt(number_nguoi_lon) * parseInt(price_nguoi_lon);
                var total_tre_em_511 = parseInt(number_tre_em_511) * parseInt(price_tre_em_511);
                var total_tre_em_5 = parseInt(number_tre_em_5) * parseInt(price_tre_em_5);
                total = total_nguoi_lon + total_tre_em_511 + total_tre_em_5;
                var vat = 0;
                if ($("#input_vat").is(':checked')) {
                    vat = total * 0.1
                }
                con_lai = total + vat;
                var dat_coc = $("#input_dat_coc").val();
                if (dat_coc != '' && dat_coc > 0) {
                    dat_coc = dat_coc.toString().split(",");
                    dat_coc = dat_coc.toString().split(".");
                    if (parseInt(dat_coc) > con_lai) {
                        lnv.alert({
                            title: 'Lỗi',
                            content: 'Tiền đặt cọc đã vượt quá số tiền phải thanh toán, vui lòng nhập lại',
                            alertBtnText: 'Ok',
                            iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                            alertHandler: function () {
                                $('#input_dat_coc').show().focus().select();
                            }
                        });
                    } else {
                        con_lai = con_lai - parseInt(dat_coc);
                    }
                }
                var tong_cong = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                $('#tong_cong').html(tong_cong);
                var vat_format = vat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                $('#vat').html(vat_format);

                var con_lai_format = con_lai.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
                $('#con_lai').html(con_lai_format);
            }
        } else {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng nhập số người trước khi tính tiền',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }

    }else{
        lnv.alert({
            title: 'Lỗi',
            content: 'Bạn vui lòng kiểm tra đơn giá',
            alertBtnText: 'Ok',
            iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
            alertHandler: function () {
                $('#input_name_tour').show().focus().select();
            }
        });
    }
}
