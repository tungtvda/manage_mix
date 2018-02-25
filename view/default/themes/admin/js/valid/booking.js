jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on('input', '#input_name_customer', function () {
        removeValueCustomer();
        checkNameCustomer();
    });
    $('body').on('keyup', '#input_name_customer', function () {
        removeValueCustomer();
        checkNameCustomer();
    });

    $('body').on('input', '#input_name_tour', function () {
        removeValueTour();
    });
    $('body').on('keyup', '#input_name_tour', function (event) {
        if (event.keyCode != '13') {
            removeValueTour();
        }
    });

    $('body').on('input', '#input_name_user', function () {
        removeValueUser();
    });
    $('body').on('keyup', '#input_name_user', function (event) {
        if (event.keyCode != '13') {
            removeValueUser();
        }
    });

    $('body').on('input', '#input_name_dieuhanh', function () {
        removeValueDieuhanh();
    });
    $('body').on('keyup', '#input_name_dieuhanh', function (event) {
        if (event.keyCode != '13') {
            removeValueDieuhanh();
        }
    });
    $('body').on('input', '#input_email_thanh_vien', function () {
        removeInfoTiepthi();
    });
    $('body').on('input', '#input_name_user_tiepthi', function () {
        var value = $('#input_name_user_tiepthi').val();
        $('#input_name_thanh_vien').val(value);
        checkUserTiepThi();
    });
    $('body').on('keyup', '#input_name_user_tiepthi', function (event) {
        if (event.keyCode != '13') {
            var value = $('#input_name_user_tiepthi').val();
            $('#input_name_thanh_vien').val(value);
            checkUserTiepThi();
        }
    });
    $('body').on('input', '#input_phone_thanh_vien', function () {
        removeInfoTiepthi();
    });

    function checkUserTiepThi() {
        if ($('#input_name_user_tiepthi').val() != '') {
            if ($('#input_id_user_tt').val() != '') {
                $('#input_id_user_tt').val('');
                $('#input_name_thanh_vien')
                    .val('')
                    .addClass('valid')
                    .removeClass('input-error');
                $('#input_email_thanh_vien')
                    .val('')
                    .addClass('valid')
                    .removeAttr('disabled')
                    .removeClass('input-error');
                $('#input_phone_thanh_vien')
                    .val('')
                    .addClass('valid')
                    .removeAttr('disabled')
                    .removeClass('input-error');
                $('.required_label').hide();
                $('#error_email_thanh_vien')
                    .hide()
                    .html('Bạn vui lòng nhập email');
                $('#error_name_thanh_vien').hide();
                $('#error_phone_thanh_vien').hide();
                returnDefaultPriceTiepThi()
            } else {
                removeInfoTiepthi();
            }
            $('#error_name_thanh_vien').hide();
            $('#input_name_thanh_vien')
                .addClass('valid')
                .removeClass('input-error');
        } else {
            $('#input_id_user_tt').val('');
            $('#input_name_thanh_vien')
                .val('')
                .addClass('valid')
                .removeClass('input-error');
            $('#input_email_thanh_vien')
                .val('')
                .addClass('valid')
                .removeAttr('disabled')
                .removeClass('input-error');
            $('#input_phone_thanh_vien')
                .val('')
                .addClass('valid')
                .removeAttr('disabled')
                .removeClass('input-error');
            $('.required_label').hide();
            $('#error_email_thanh_vien')
                .hide()
                .html('Bạn vui lòng nhập email');
            $('#error_name_thanh_vien').hide();
            $('#error_phone_thanh_vien').hide();

            returnDefaultPriceTiepThi();

        }
    }

    function removeInfoTiepthi() {
        var success = 0;
        if (
            $('#input_name_user_tiepthi').val() == '' &&
            $('#input_phone_thanh_vien').val() == '' &&
            $('#input_email_thanh_vien').val() == ''
        ) {
            $('#input_name_thanh_vien')
                .addClass('valid')
                .removeClass('input-error');
            $('#input_email_thanh_vien')
                .addClass('valid')
                .removeClass('input-error');
            $('#input_phone_thanh_vien')
                .addClass('valid')
                .removeClass('input-error');
            returnDefaultPriceTiepThi();
        } else {
            var success_phone = 0;
            if ($('#input_phone_thanh_vien').val() != '') {
                $('#input_phone_thanh_vien')
                    .addClass('valid')
                    .removeClass('input-error');
                $('#error_phone_thanh_vien').hide();
                success_phone = 1;
            } else {
                $('#input_phone_thanh_vien')
                    .removeClass('valid')
                    .addClass('input-error');
                $('#error_phone_thanh_vien').show();
            }


            var success_name = 0;
            if ($('#input_name_user_tiepthi').val() != '') {
                success_name = 1;
            } else {
                $('#error_name_thanh_vien').show();
                $('#input_name_thanh_vien')
                    .removeClass('valid')
                    .addClass('input-error');
            }

            var success_email = 0;
            if ($('#input_email_thanh_vien').val() != '') {
                checkEmailThanhVien(success_name, success_phone);
            } else {
                $('#error_email_thanh_vien')
                    .show()
                    .html('Bạn vui lòng nhập email');
                $('#input_email_thanh_vien')
                    .removeClass('valid')
                    .addClass('input-error');
                returnDefaultPriceTiepThi()
            }

        }
    }

    function returnDefaultPriceTiepThi() {
        if ($('#input_hoa_hong_thanh_vien_hidden').val() == '') {
            $('#input_hoa_hong_thanh_vien')
                .val('')
                .removeAttr('disabled', 'disabled');
            //$('#price_tiep_thi').html('');
        }
    }

    function checkEmailThanhVien(success_name, success_phone) {
        var value = $('#input_email_thanh_vien').val();
        if (value != '') {
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_email = re.test(value);
            if (is_email) {
                link = url + '/check-login.html';
                var key = 'user_email';
                $.ajax({
                    method: 'GET',
                    url: link,
                    data: 'value=' + value + '&key=' + key,
                    success: function (response) {
                        var res = 0;
                        if (response == 1) {
                            $('#error_email_thanh_vien')
                                .hide()
                                .html('Bạn vui lòng nhập email');
                            $('#input_email_thanh_vien')
                                .addClass('valid')
                                .removeClass('input-error');
                            if (success_name && success_phone) {
                                $('#input_hoa_hong_thanh_vien').removeAttr('disabled');
                            }
                        } else {
                            $('#error_email_thanh_vien')
                                .show()
                                .html('Email đã tồn tại trong hệ thống');
                            $('#input_email_thanh_vien')
                                .removeClass('valid')
                                .addClass('input-error');
                            returnDefaultPriceTiepThi()
                        }

                    }
                });
            } else {
                $('#error_email_thanh_vien')
                    .show()
                    .html('Email không đúng định dạng');
                $('#input_email_thanh_vien')
                    .removeClass('valid')
                    .addClass('input-error');
                returnDefaultPriceTiepThi()
            }
        }
    }

    $('body').on('input', '#input_dat_coc', function () {
        returnDatCoc();
    });
    $('body').on('keyup', '#input_dat_coc', function (event) {
        returnDatCoc();
    });

    $('body').on('input', '#input_hoa_hong_thanh_vien', function () {
        returnHoaHongThanhVien();
    });
    $('body').on('keyup', '#input_hoa_hong_thanh_vien', function (event) {
        returnHoaHongThanhVien();
    });

    $('body').on('change', '#input_confirm_dieuhanh', function () {
        var value=$('#input_confirm_dieuhanh').val();
        var role_valid=$('#role_valid').val()
        if(role_valid!=1){
            $('#input_id_user').addClass('valid')
        }
        $('#error_ly_do_dieu_hanh').hide();

        if(value==1){
            $('#input_ly_do_dieu_hanh').hide();
        }else{
            if(value==''){
                $('#error_ly_do_dieu_hanh').show();
                $('#input_ly_do_dieu_hanh').hide();
            }else{
                $('#input_ly_do_dieu_hanh').show().focus();
            }
        }
    });
    $('body').on('change', '#input_confirm_sales', function () {
        var value=$('#input_confirm_sales').val();
        var role_valid=$('#role_valid').val()
        if(role_valid!=1){
            $('#input_dieuhanh_id').addClass('valid')
        }
        $('#error_ly_do_sales').hide();
        if(value==1){
            $('#input_ly_do_sales').hide();
        }else{

            if(value==''){
                $('#error_ly_do_sales').show();
                $('#input_ly_do_sales').hide();
            }else{
                $('#input_ly_do_sales').show().focus();
            }
        }
    });
    $('body').on('click', '#reset_price', function () {
        var price_old = $('#input_price_old').val();
        var price_format = $('#input_price_format').val();
        $('#input_price').val(price_old);
        $('#input_price').hide();
        $('#price_format_span')
            .show()
            .html(price_format);
    });
    $('body').on('click', '#reset_price_tre_em_m1', function () {
        var price_old = $('#input_price_tre_em_m1_old').val();
        var price_format = price_old.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#input_price_tre_em_m1').val(price_old);
        $('#input_price_tre_em_m1').hide();
        $('#price_format_span_tre_em_m1')
            .show()
            .html(price_format);
    });
    $('body').on('click', '#reset_price_tre_em_m2', function () {
        var price_old = $('#input_price_tre_em_m2_old').val();
        var price_format = price_old.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#input_price_tre_em_m2').val(price_old);
        $('#input_price_tre_em_m2').hide();
        $('#price_format_span_tre_em_m2')
            .show()
            .html(price_format);
    });
    $('body').on('click', '#reset_price_tre_em_m3', function () {
        var price_old = $('#input_price_tre_em_m3_old').val();
        var price_format = price_old.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#input_price_tre_em_m3').val(price_old);
        $('#input_price_tre_em_m3').hide();
        $('#price_format_span_tre_em_m3')
            .show()
            .html(price_format);
    });

    $('body').on('click', '#edit_price', function () {
        $('#input_price')
            .show()
            .focus()
            .select();
        $('#price_format_span').hide();
    });
    $('body').on('click', '#edit_price_tre_em_m1', function () {
        $('#input_price_tre_em_m1')
            .show()
            .focus()
            .select();
        $('#price_format_span_tre_em_m1').hide();
    });
    $('body').on('click', '#input_vat', function () {
        // $('#tong_cong').html('');
        // $('#tong_cong').html('');
        // $('#vat').html('');
        //$('#dat_coc_format').html('');
        // $('#con_lai').html('');
        //$('#input_dat_coc').val('');
        var type_tour = $('.type_tour').val();
        tinh_tong_tien(type_tour);
    });

    $('body').on('click', '#edit_price_tre_em_m2', function () {
        $('#input_price_tre_em_m2')
            .show()
            .focus()
            .select();
        $('#price_format_span_tre_em_m2').hide();
    });
    $('body').on('click', '#edit_price_tre_em_m3', function () {
        $('#input_price_tre_em_m3')
            .show()
            .focus()
            .select();
        $('#price_format_span_tre_em_m3').hide();
    });
    $('body').on('blur', '#input_price', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#input_price_submit').val(price);
        } else {
            var price_old = $('#input_price_old').val();
            $('#input_price').val(price_old);
            $('#input_price_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price').hide();
        $('#price_format_span')
            .show()
            .html(price_format);
        checkSoNguoi();
        tinh_tong_tien(0);
    });
    $('body').on('blur', '#input_price_tre_em_m1', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#input_price_m1_submit').val(price);
        } else {
            var price_old = $('#input_price_tre_em_m1_old').val();
            $('#input_price_tre_em_m1').val(price_old);
            $('#input_price_m1_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price_tre_em_m1').hide();
        $('#price_format_span_tre_em_m1')
            .show()
            .html(price_format);
        checkSoNguoi();
        tinh_tong_tien(0);
    });
    $('body').on('blur', '#input_price_tre_em_m2', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#input_price_m2_submit').val(price);
        } else {
            var price_old = $('#input_price_tre_em_m2_old').val();
            $('#input_price_tre_em_m2').val(price_old);
            $('#input_price_m2_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price_tre_em_m2').hide();
        $('#price_format_span_tre_em_m2')
            .show()
            .html(price_format);
        checkSoNguoi();
        tinh_tong_tien(0);
    });
    $('body').on('blur', '#input_price_tre_em_m3', function () {
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#input_price_m3_submit').val(price);
        } else {
            var price_old = $('#input_price_tre_em_m3_old').val();
            $('#input_price_tre_em_m3').val(price_old);
            $('#input_price_m3_submit').val(price_old);
            var price_format = $('#input_price_format').val();
        }

        $('#input_price_tre_em_m3').hide();
        $('#price_format_span_tre_em_m3')
            .show()
            .html(price_format);
        checkSoNguoi();
        tinh_tong_tien(0);
    });

    $('body').on('click', '.btn_add_customer_bk', function () {
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
                var mess = 'Bạn vui lòng nhập số người';
                $('#input_num_nguoi_lon')
                    .show()
                    .focus()
                    .select();
            } else {
                var mess = 'Bạn đã nhập đủ số người';
            }
            lnv.alert({
                title: 'Lỗi',
                content: mess,
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        } else {
            var i = 1;
            $('.table_add_customer > tbody  > tr').each(function () {
                var tds = $(this).find('td.stt_cus');
                tds.eq(0).text(i);
                i = i + 1;
            });
            var row =
                ' <tbody id="row_customer_' +
                i +
                '"><tr>' +
                '<td class="center stt_cus">' +
                i +
                '</td>' +
                '<td> <span class="input-icon width_100"><input id="input_name_customer_sub_' +
                i +
                '" class="valid" type="text"  name="name_customer_sub[]"><i class="ace-icon fa fa-user blue"></i></span></td>' +
                '<td><span class="input-icon width_100"> <input id="input_email_customer_' +
                i +
                '" type="text" class="valid" name="email_customer[]"><i class="ace-icon fa fa-envelope blue"></i> </span></td>' +
                '<td><span class="input-icon width_100"><input id="input_phone_customer_' +
                i +
                '" class="valid" type="text" name="phone_customer[]"><i class="ace-icon fa fa-phone blue"></i></span></td>' +
                '<td><span class="input-icon width_100"> <input id="input_address_customer_' +
                i +
                '" type="text" name="address_customer[]"><i class="ace-icon fa fa-map-marker blue"></i></span></td>' +
                '<td><a id="stt_custommer_' +
                i +
                '"  deleteid="' +
                i +
                '"  title="Xóa khách hàng"  class="red btn_remove_customer" href="javascript:void()"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>' +
                '</tr></tbody>';

            $('.table_add_customer').append(row);
        }
    });
    $('body').on('click', '.btn_add_customer', function () {
        returnGenDanhSachDoan();
    });
    $('body').on('click', '.btn_remove_customer', function () {
        var deleteid = $(this).attr('deleteid');
        $('#row_customer_' + deleteid).remove();
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
    $('body').on('click', '#tinh_tien', function () {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var price_nguoi_lon = $('#input_price').val();
        var price_tre_em_511 = $('#input_price_511').val();
        var price_tre_em_5 = $('#input_price_5').val();

        var number_nguoi_lon = $('#input_num_nguoi_lon').val();
        var number_tre_em_511 = $('#input_num_tre_em').val();
        var number_tre_em_5 = $('#input_num_tre_em_5').val();
        if (
            numberRegex.test(price_nguoi_lon) &&
            numberRegex.test(price_tre_em_511) &&
            numberRegex.test(price_tre_em_5)
        ) {
            if (number_nguoi_lon > 0 && number_nguoi_lon != '') {
                if (price_nguoi_lon == undefined) {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Bạn vui lòng chọn tour',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#input_name_tour')
                                .show()
                                .focus()
                                .select();
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
                    if ($('#input_vat').is(':checked')) {
                        vat = parseFloat(total * 0.1);
                        vat = Math.round(vat * 1000) / 1000;
                    }
                    con_lai = total + vat;
                    var dat_coc = $('#input_dat_coc').val();
                    if (dat_coc != '' && dat_coc > 0) {
                        dat_coc = dat_coc.toString().split(',');
                        dat_coc = dat_coc.toString().split('.');
                        if (parseInt(dat_coc) > con_lai) {
                            lnv.alert({
                                title: 'Lỗi',
                                content: 'Tiền đặt cọc đã vượt quá số tiền phải thanh toán, vui lòng nhập lại',
                                alertBtnText: 'Ok',
                                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                alertHandler: function () {
                                    $('#input_dat_coc')
                                        .show()
                                        .focus()
                                        .select();
                                }
                            });
                        } else {
                            con_lai = con_lai - parseInt(dat_coc);
                        }
                    }
                    var tong_cong = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                    $('#tong_cong').html(tong_cong);
                    var vat_format = vat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                    $('#vat').html(vat_format);

                    var con_lai_format = con_lai.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                    $('#con_lai').html(con_lai_format);
                }
            } else {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Bạn vui lòng nhập số người trước khi tính tiền',
                    alertBtnText: 'Ok',
                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {}
                });
            }
        } else {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng kiểm tra đơn giá',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                    $('#input_name_tour')
                        .show()
                        .focus()
                        .select();
                }
            });
        }
    });
    // check
    $('body').on('input', '#input_ngay_bat_dau', function () {
        checkNgayBatDau();
    });
    $('body').on('keyup', '#input_ngay_bat_dau', function () {
        checkNgayBatDau();
    });
    $('body').on('change', '#input_ngay_bat_dau', function () {
        checkNgayBatDau();
    });

    // check
    $('body').on('input', '#input_han_thanh_toan', function () {
        checkHanThanhToan();
    });
    $('body').on('keyup', '#input_han_thanh_toan', function () {
        checkHanThanhToan();
    });
    $('body').on('change', '#input_han_thanh_toan', function () {
        checkHanThanhToan();
    });

    // check
    $('body').on('input', '#input_ngay_khoi_hanh', function () {
        checkNgayKhoiHanh();
    });
    $('body').on('keyup', '#input_ngay_khoi_hanh', function () {
        checkNgayKhoiHanh();
    });
    $('body').on('change', '#input_ngay_khoi_hanh', function () {
        checkNgayKhoiHanh();
    });

    // check
    $('body').on('input', '#input_ngay_ket_thuc', function () {
        checkNgayKetThuc();
    });
    $('body').on('keyup', '#input_ngay_ket_thuc', function () {
        checkNgayKetThuc();
    });
    $('body').on('change', '#input_ngay_ket_thuc', function () {
        checkNgayKetThuc();
    });

    $('body').on('input', '#input_email', function () {
        checkEmailCustomer();
    });
    $('body').on('keyup', '#input_email', function () {
        checkEmailCustomer();
    });
    $('body').on('change', '#input_email', function () {
        checkEmailCustomer();
    });

    $('body').on('input', '#input_address', function () {
        checkAddressCustomer();
    });
    $('body').on('keyup', '#input_address', function () {
        checkAddressCustomer();
    });
    $('body').on('change', '#input_address', function () {
        checkAddressCustomer();
    });

    $('body').on('input', '#input_phone', function () {
        checkPhoneCustomer();
    });
    $('body').on('keyup', '#input_phone', function () {
        checkPhoneCustomer();
    });
    $('body').on('change', '#input_phone', function () {
        checkPhoneCustomer();
    });

    $('body').on('change', '.hinh_thuc_thanh_toan', function () {
        $('#error_hinh_thuc_thanh_toan').hide();
    });
    $('body').on('change', '.status', function () {
        $('#error_status').hide();
    });

    $('body').on('input', '#input_diem_don', function () {
        checkDiemDon();
    });
    $('body').on('keyup', '#input_diem_don', function () {
        checkDiemDon();
    });
    $('body').on('change', '#input_diem_don', function () {
        checkDiemDon();
    });

    $('body').on('change', '.type_tour', function () {
        var value = $(this).val();
        $('.show_type_tour').hide();
        if (value == 1) {
            $('#tour_custom').show();
            $('#input_chuong_trinh')
                .val('')
                .removeClass('valid');
            $('#input_thoi_gian')
                .val('')
                .removeClass('valid');
            $('#input_ngay_khoi_hanh_cus')
                .val('')
                .removeClass('valid');
            $('#input_chuong_trinh_price').val(0);
            $('#input_thoi_gian_price').val(0);
            $('#price_chuong_trinh_price').html('0 vnđ');
            $('#price_thoi_gian_price').html('0 vnđ');
            $('#input_name_tour')
                .removeClass('input-error')
                .addClass('valid');
            $('#id_tour')
                .removeClass('input-error')
                .addClass('valid');

            $('#edit_price').hide();
            $('#reset_price').hide();
            $('#edit_price_tre_em_m1').hide();
            $('#reset_price_tre_em_m1').hide();
            $('#edit_price_tre_em_m2').hide();
            $('#reset_price_tre_em_m2').hide();
            $('#edit_price_tre_em_m3').hide();
            $('#reset_price_tre_em_m3').hide();
        }
        if (value == 0) {
            $('#tour_in_system').show();
            $('#input_chuong_trinh')
                .val('')
                .addClass('valid');
            $('#input_thoi_gian')
                .val('')
                .addClass('valid');
            $('#input_ngay_khoi_hanh_cus')
                .val('')
                .addClass('valid');
            $('#input_name_tour').removeClass('valid');
            $('#input_name_tour_cus')
                .val('')
                .addClass('valid');
            $('#id_tour').removeClass('valid');

            $('#edit_price').show();
            $('#reset_price').show();
            $('#edit_price_tre_em_m1').show();
            $('#reset_price_tre_em_m1').show();
            $('#edit_price_tre_em_m2').show();
            $('#reset_price_tre_em_m2').show();
            $('#edit_price_tre_em_m3').show();
            $('#reset_price_tre_em_m3').show();
        }
        $('#error_name_tour').hide();
        $('#error_name_tour_cus').hide();
        $('#error_chuong_trinh').hide();
        $('#error_thoi_gian').hide();
        $('#error_ngay_khoi_hanh_cus').hide();
        $('#input_price').val(0);
        $('#input_price_tre_em_m1').val(0);
        $('#input_price_tre_em_m2').val(0);
        $('#input_price_tre_em_m3').val(0);
        $('#input_price_tre_em_m1_old').val(0);
        $('#input_price_tre_em_m2_old').val(0);
        $('#input_price_tre_em_m3_old').val(0);
        $('#price_format_span').html('0 vnđ');
        $('#input_price_format').html('0 vnđ');
        $('#price_format_span_tre_em_m1').html('0 vnđ');
        $('#price_format_span_tre_em_m2').html('0 vnđ');
        $('#price_format_span_tre_em_m3').html('0 vnđ');
        $('#price_format_span_5').html('0 vnđ');
        $('#input_name_tour').val('');

        $('#name_tour_table').html('');
        $('#error_type_tour').hide();
        $('#tong_cong').html('0 vnđ');
        $('#con_lai').html('0 vnđ');
        $('#vat').html('0 vnđ');
        $('#input_dat_coc').val('');
        $('#input_hoa_hong_thanh_vien')
            .val('').removeAttr('disabled');
        $('#price_tiep_thi').html('');
        $('.price_tiep_thi').html('');
        $('#input_hoa_hong_thanh_vien_hidden').val('');
        $('#list_dichvu').html('');
        $('.show_hide_bang_gia').show();

        $('#input_tong_tien_nguoi_lon').val('');
        $('#input_don_gia_net').val('');
        $('#input_loi_nhuan').val('');
        $('#input_gia_ban').val('');

        $('#input_tyle_m1').val('');
        $('#input_don_gia_net_m1').val('');
        $('#input_loi_nhuan_m1').val('');
        $('#input_gia_ban_m1').val('');

        $('#input_tyle_m2').val('');
        $('#input_don_gia_net_m2').val('');
        $('#input_loi_nhuan_m2').val('');
        $('#input_gia_ban_m2').val('');

        $('#input_tyle_m3').val('');
        $('#input_don_gia_net_m3').val('');
        $('#input_loi_nhuan_m3').val('');
        $('#input_gia_ban_m3').val('');

        _returnDefailBangGia();

    });

    //spinner
    var spinner = $('#spinner').spinner({
        create: function (event, ui) {
            //add custom classes and icons
            $(this)
                .next()
                .addClass('btn btn-success')
                .html('<i class="ace-icon fa fa-plus"></i>')
                .next()
                .addClass('btn btn-danger')
                .html('<i class="ace-icon fa fa-minus"></i>');

            //larger buttons on touch devices
            if ('touchstart' in document.documentElement)
                $(this)
                .closest('.ui-spinner')
                .addClass('ui-spinner-touch');
        }
    });
    $('form').on('focus', '.spinbox-input', function (e) {
        $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault();
        });
    });
    $('form').on('blur', '.spinbox-input', function (e) {
        $(this).off('mousewheel.disableScroll');
    });
    $('form').on('focus', '.input_table', function (e) {
        $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault();
        });
    });
    $('form').on('blur', '.input_table', function (e) {
        $(this).off('mousewheel.disableScroll');
    });
    $('body').on('click', '#input_tyle_m1', function () {
        $(this).select();
    });
    $('body').on('input', '#input_tyle_m1', function (e) {
        input_tyle_1();
    });
    $('body').on('blur', '#input_tyle_m1', function (e) {
        input_tyle_1();
    });

    function input_tyle_1() {
        var value = $('#input_tyle_m1').val();
        if (!$.isNumeric(value)) {
            $('#input_tyle_m1').val(0);
        }
        if (value > 100) {
            $('#input_tyle_m1').val(100);
        }
        total_price_dich_vu(0, 0, 0);
    }
    $('body').on('click', '#input_tyle_m2', function () {
        $(this).select();
    });
    $('body').on('input', '#input_tyle_m2', function (e) {
        input_tyle_2();
    });
    $('body').on('blur', '#input_tyle_m2', function (e) {
        input_tyle_2();
    });

    function input_tyle_2() {
        var value = $('#input_tyle_m2').val();
        if (!$.isNumeric(value)) {
            $('#input_tyle_m2').val(0);
        }
        if (value > 100) {
            $('#input_tyle_m2').val(100);
        }
        total_price_dich_vu(0, 0, 0);
    }
    $('body').on('click', '#input_tyle_m3', function () {
        $(this).select();
    });
    $('body').on('input', '#input_tyle_m3', function (e) {
        input_tyle_3();
    });
    $('body').on('blur', '#input_tyle_m3', function (e) {
        input_tyle_3();
    });

    function input_tyle_3() {
        var value = $('#input_tyle_m3').val();
        if (!$.isNumeric(value)) {
            $('#input_tyle_m3').val(0);
        }
        if (value > 100) {
            $('#input_tyle_m3').val(100);
        }
        total_price_dich_vu(0, 0, 0);
    }

    $('body').on('click', '#input_loi_nhuan', function () {
        $(this).select();
    });
    $('body').on('input', '#input_loi_nhuan', function (e) {
        input_loi_nhuan();
    });
    $('body').on('blur', '#input_loi_nhuan', function (e) {
        input_loi_nhuan();
    });

    function input_loi_nhuan() {
        var value = $('#input_loi_nhuan').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value)) {
            $('#input_loi_nhuan').val(0);
            value = 0;
        }
        var price_format = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#price_loinhuan_format').html(price_format);
        $('#input_loi_nhuan').attr('title', price_format);
        total_price_dich_vu(0, 0, 0);
    }

    $('body').on('click', '#input_loi_nhuan_m1', function () {
        $(this).select();
    });
    $('body').on('input', '#input_loi_nhuan_m1', function (e) {
        input_loi_nhuan_1();
    });
    $('body').on('blur', '#input_loi_nhuan_m1', function (e) {
        input_loi_nhuan_1();
    });

    function input_loi_nhuan_1() {
        var value = $('#input_loi_nhuan_m1').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value)) {
            $('#input_loi_nhuan_m1').val(0);
            value = 0;
        }
        var price_format = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#price_loinhuan_format_1').html(price_format);
        $('#input_loi_nhuan_m1').attr('title', price_format);
        total_price_dich_vu(0, 0, 0);
    }

    $('body').on('click', '#input_loi_nhuan_m2', function () {
        $(this).select();
    });
    $('body').on('input', '#input_loi_nhuan_m2', function (e) {
        input_loi_nhuan_2();
    });
    $('body').on('blur', '#input_loi_nhuan_m2', function (e) {
        input_loi_nhuan_2();
    });

    function input_loi_nhuan_2() {
        var value = $('#input_loi_nhuan_m2').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value)) {
            $('#input_loi_nhuan_m2').val(0);
            value = 0;
        }
        var price_format = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#price_loinhuan_format_2').html(price_format);
        $('#input_loi_nhuan_m2').attr('title', price_format);
        total_price_dich_vu(0, 0, 0);
    }

    $('body').on('click', '#input_loi_nhuan_m3', function () {
        $(this).select();
    });
    $('body').on('input', '#input_loi_nhuan_m3', function (e) {
        input_loi_nhuan_3();
    });
    $('body').on('blur', '#input_loi_nhuan_m3', function (e) {
        input_loi_nhuan_3();
    });

    function input_loi_nhuan_3() {
        var value = $('#input_loi_nhuan_m3').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value)) {
            $('#input_loi_nhuan_m3').val(0);
            value = 0;
        }
        var price_format = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#price_loinhuan_format_3').html(price_format);
        $('#input_loi_nhuan_m3').attr('title', price_format);
        total_price_dich_vu(0, 0, 0);
    }

    $('body').on('click', '#input_num_nguoi_lon', function () {
        $(this).select();
    });
    $('body').on('change', '#input_num_nguoi_lon', function () {
        var error_so_nguoi = $('#error_so_nguoi');
        var value_get = $('#input_num_nguoi_lon').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value_get)) {
            $(this).val(1);
            value_get = 1;
        }
        if (value_get < 1) {
            $('#input_num_nguoi_lon').val(1);
            value_get = 1;
        } else {
            checkSoNguoi();
        }
        $('#input_total_khach').val(value_get);
        total_price_dich_vu(0, 0, 0);
    });
    $('body').on('click', '#input_num_tre_em_m1', function () {
        $(this).select();
    });
    $('body').on('input', '#input_num_tre_em_m1', function () {
        var value_get = $('#input_num_tre_em_m1').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value_get)) {
            $(this).val(0);
            value_get = 0;
        }

        if (value_get == '' || value_get <= 0) {
            $('#input_num_tre_em_m1').val(0);
            value_get = 0;
        }
        checkSoNguoi();
        $('#input_total_khach_m1').val(value_get);
        total_price_dich_vu(0, 0, 0);
    });
    $('body').on('click', '#input_num_tre_em_m2', function () {
        $(this).select();
    });
    $('body').on('input', '#input_num_tre_em_m2', function () {
        var value_get = $('#input_num_tre_em_m2').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value_get)) {
            $(this).val(0);
            value_get = 0;
        }
        if (value_get == '' || value_get <= 0) {
            $('#input_num_tre_em_m2').val(0);
            value_get = 0;
        }
        checkSoNguoi();
        $('#input_total_khach_m2').val(value_get);
        total_price_dich_vu(0, 0, 0);
    });
    $('body').on('click', '#input_num_tre_em_m3', function () {
        $(this).select();
    });
    $('body').on('input', '#input_num_tre_em_m3', function () {
        var value_get = $('#input_num_tre_em_m3').val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (!numberRegex.test(value_get)) {
            $(this).val(0);
            value_get = 0;
        }

        if (value_get == '' || value_get <= 0) {
            $('#input_num_tre_em_m3').val(0);
            value_get = 0;
        }
        checkSoNguoi();
        $('#input_total_khach_m3').val(value_get);
        total_price_dich_vu(0, 0, 0);
    });

    $('body').on('change', '#input_nguoi_lon', function () {
        var error_so_nguoi = $('#error_so_nguoi_cus');
        var value_get = $('#input_nguoi_lon').val();
        if (value_get < 1) {
            $('#input_nguoi_lon').val(1);
            value_get = 1;
        } else {
            $('#input_nguoi_lon')
                .addClass('valid')
                .removeClass('input-error');
            error_so_nguoi.hide();
        }
    });
    $('body').on('change', '#input_tre_em', function () {
        var value_get = $('#input_tre_em').val();
        if (value_get == '' || value_get < 0) {
            $('#input_tre_em').val(0);
        }
    });
    $('body').on('change', '#input_tre_em_5', function () {
        var value_get = $('#input_tre_em_5').val();
        if (value_get == '' || value_get < 0) {
            $('#input_tre_em_5').val(0);
        }
    });

    $('#input_num_nguoi_lon_bk')
        .ace_spinner({
            //                value: 1,
            min: 1,
            max: 200,
            step: 1,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('input.fu.spinbox', function () {
            var error_so_nguoi = $('#error_so_nguoi');
            var value_get = $('#input_num_nguoi_lon').val();
            if (value_get < 1) {
                $('#input_num_nguoi_lon').val(1);
                value_get = 1;

                //$('#input_num_nguoi_lon').addClass("input-error").removeClass("valid");
                //error_so_nguoi.removeClass("success-color");
                //error_so_nguoi.addClass("error-color");
                //error_so_nguoi.html('Bạn vui lòng nhập số người lớn');
                //error_so_nguoi.show();
            } else {
                $('#input_num_nguoi_lon')
                    .addClass('valid')
                    .removeClass('input-error');
                error_so_nguoi.hide();
                checkSoNguoi();
            }
        });
    $('#input_num_tre_em_bk')
        .ace_spinner({
            //                value: '',
            min: 0,
            max: 200,
            step: 1,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function () {
            //console.log($('#spinner1').val())
            checkSoNguoi();
        });
    $('#input_num_tre_em_5_bk')
        .ace_spinner({
            //                value: '',
            min: 0,
            max: 200,
            step: 1,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function () {
            //console.log($('#spinner1').val())
            checkSoNguoi();
        });
    $('#input_nguoi_lon_bk')
        .ace_spinner({
            min: 1,
            max: 200,
            step: 1,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('input.fu.spinbox', function () {
            var error_so_nguoi = $('#error_so_nguoi_cus');
            var value_get = $('#input_nguoi_lon').val();
            if (value_get < 1) {
                $('#input_nguoi_lon').val(1);
                //                    $('#input_nguoi_lon').addClass("input-error").removeClass("valid");
                //                    error_so_nguoi.removeClass("success-color");
                //                    error_so_nguoi.addClass("error-color");
                //                    error_so_nguoi.html('Bạn vui lòng nhập số người lớn');
                //                    error_so_nguoi.show();
            } else {
                $('#input_nguoi_lon')
                    .addClass('valid')
                    .removeClass('input-error');
                error_so_nguoi.hide();
            }
        });
    $('#input_tre_em_5_bk')
        .ace_spinner({
            min: 0,
            max: 200,
            step: 1,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function () {});
    $('#input_tre_em_bk')
        .ace_spinner({
            min: 0,
            max: 200,
            step: 1,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function () {});

    $('body').on('change', '.select_status', function () {
        var id = $(this).attr('count_id');
        var code = $(this).attr('code');
        var status = $(this).val();
        var table = 'booking';
        var field = 'status';
        var link = url + '/update-status/';
        var action = 'booking_update';
        if (id == '' || table == '' || field == '' || code == '' || link == '') {
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        } else {
            var value_old = $('#status_old_' + id).val();
            lnv.confirm({
                title: '<label class="orange">Xác nhận cập nhật trạng thái</label>',
                content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của đơn hàng </br><b>"' + code + '"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: 'GET',
                        url: link,
                        data: 'id=' +
                            id +
                            '&table=' +
                            table +
                            '&field=' +
                            field +
                            '&status=' +
                            status +
                            '&action=' +
                            action,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {}
                                });
                                $('#status_' + id).val(value_old);
                            } else {
                                $('#status_old_' + id).val(status);
                            }
                        }
                    });
                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    $('#status_' + id).val(value_old);
                }
            });
        }
    });

    $('body').on('click', '#confirm_order', function () {
        var id = $(this).attr('count_id');
        var code = $(this).attr('code');
        var link = url + '/booking/confirm-order';

        if (id == '' || link == '' || code == '') {
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        } else {
            lnv.confirm({
                title: '<label class="orange">Xác nhận đơn hàng</label>',
                content: 'Bạn chắc chắn rằng muốn xác đơn hàng </br><b>"' + code + '"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: 'GET',
                        url: link,
                        data: 'id=' + id,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {}
                                });
                            } else {
                                $('#confirm_order').remove();
                            }
                        }
                    });
                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {}
            });
        }
    });

    $('body').on('click', '.confirm_booking_list', function () {
        var id_filed = $(this).attr('id_filed');
        var id = $(this).attr('count_id');
        var code = $(this).attr('code');
        var link = url + '/booking/confirm-order';
        var field_check = 'confirm_booking_' + id_filed;
        if (id == '' || link == '' || code == '' || id_filed == '') {
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        } else {
            lnv.confirm({
                title: '<label class="orange">Xác nhận đơn hàng</label>',
                content: 'Bạn chắc chắn rằng muốn xác đơn hàng </br><b>"' + code + '"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: 'GET',
                        url: link,
                        data: 'id=' + id,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                        document.getElementById(field_check).checked = false;
                                    }
                                });
                            } else {
                                document.getElementById(field_check).disabled = true;
                            }
                        }
                    });
                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    document.getElementById(field_check).checked = false;
                }
            });
        }
    });

    $('body').on('click', '.confirm_tiep_thi', function () {
        var id_filed = $(this).attr('id_filed');
        var id = $(this).attr('count_id');
        var code = $(this).attr('code');
        var user = $(this).attr('user');
        var link = url + '/booking/confirm-tiepthi';
        var field_check = 'confirm_tiep_thi_' + id_filed;
        if (id == '' || link == '' || code == '' || id_filed == '' || user == '') {
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        } else {
            lnv.confirm({
                title: '<label class="orange">Xác nhận hoa hồng</label>',
                content: 'Bạn chắc chắn rằng muốn xác nhận hoa hồng đơn hàng <b>"' +
                    code +
                    '"</b> cho thành viên <b>"' +
                    user +
                    '"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: 'GET',
                        url: link,
                        data: 'id=' + id,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                        document.getElementById(field_check).checked = false;
                                    }
                                });
                            } else {
                                $('#remove_btn_tiepthi_' + id_filed).remove();
                                $('#change_color_' + id_filed).removeClass('red');
                                $('#change_color_' + id_filed).addClass('green');
                            }
                        }
                    });
                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    document.getElementById(field_check).checked = false;
                }
            });
        }
    });
    $('#submit_form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $('body').on('click', '#submit_form_action', function () {
        var form_data = $('#submit_form').serializeArray();
        var error_free = true;
        var type_tour = $('.type_tour').val();
        for (var input in form_data) {
            var name_input = form_data[input]['name'];
            if (
                name_input != 'type_tour' &&
                name_input != 'confirm_sales' &&
                name_input != 'confirm_dieuhanh' &&
                name_input != 'tien_te' &&
                name_input != 'thuong_hieu' &&
                name_input != 'note' &&
                name_input != 'nguon_tour' &&
                name_input != 'category' &&
                name_input != 'nhom_khach_hang' &&
                name_input != 'name_customer_sub[]' &&
                name_input != 'email_customer[]' &&
                name_input != 'phone_customer[]' &&
                name_input != 'address_customer[]' &&
                name_input != 'birthday_customer[]' &&
                name_input != 'tuoi_number_customer[]' &&
                name_input != 'tuoi_customer[]' &&
                name_input != 'date_passport_customer[]' &&
                name_input != 'passport_customer[]' &&
                name_input != 'name_dichvu[]' &&
                name_input != 'type_dichvu[]' &&
                name_input != 'soluong_dichvu[]' &&
                name_input != 'thanhtien_dichvu[]' &&
                name_input != 'ghichu_dichvu[]' &&
                name_input != 'price_dichvu[]'
            ) {
                var element = $('#input_' + name_input);
                var error = $('#error_' + name_input);
                var valid = element.hasClass('valid');
                if (name_input == 'hinh_thuc_thanh_toan') {
                    var httt = $('.hinh_thuc_thanh_toan option:selected').val();
                    if (httt == '') {
                        valid = false;
                    } else {
                        valid = true;
                    }
                }
                if (name_input == 'status') {
                    var status = $('.status option:selected').val();
                    if (status == '') {
                        valid = false;
                    } else {
                        valid = true;
                    }
                }

                if (valid === false) {
                    element.addClass('input-error').removeClass('valid');
                    error.show();
                    error_free = false;
                    console.log(form_data[input]['name']);
                }
            }
        }

        if (!type_tour) {
            $('#error_type_tour').show();
            error_free = false;
        } else {
            $('#error_type_tour').hide();
        }
        if (error_free != false) {
            $('#submit_form_action').hide();
            $('#submit_form').submit();
        } else {
            lnv.alert({
                title: '<label class="red">Lỗi</label>',
                content: 'Bạn vui lòng điền đầy đủ thông tin bắt buộc',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        }
    });

    $('body').on('click', '.view_popup_detail', function () {
        var Id = $(this).attr('countid');
        var code = $(this).attr('name_record');
        show_booking(Id, code);
    });

    $('body').on('click', '#submit_form_tour_action', function () {
        var name_tour_add = $('#input_name_tour_add').val();
        var price_tour_add = $('#input_price_tour_add').val();
        var price_tour_511_add = $('#input_price_tour_511_add').val();
        var price_tour_5_add = $('#input_price_tour_5_add').val();
        var diem_khoi_hanh = $('#input_diem_khoi_hanh').val();
        var link = url + '/check-validate.html';
        if (name_tour_add != '' && price_tour_add != '' && price_tour_511_add != '' && price_tour_5_add != '') {
            $.ajax({
                method: 'GET',
                url: link,
                data: 'value=' + name_tour_add + '&key=name&table=tour',
                success: function (response) {
                    var error = true;
                    if (response == 1) {
                        $('#error_name_tour_add')
                            .hide()
                            .html('');
                        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                        if (numberRegex.test(price_tour_add)) {
                            $('#error_price_tour_add')
                                .hide()
                                .html('');
                        } else {
                            error = false;
                            $('#error_price_tour_add')
                                .show()
                                .html('Đơn giá phải là kiểu số');
                        }
                        if (numberRegex.test(price_tour_511_add)) {
                            $('#error_price_tour_511_add')
                                .hide()
                                .html('');
                        } else {
                            error = false;
                            $('#error_price_tour_511_add')
                                .show()
                                .html('Đơn giá phải là kiểu số');
                        }

                        if (numberRegex.test(price_tour_5_add)) {
                            $('#error_price_tour_5_add')
                                .hide()
                                .html('');
                        } else {
                            error = false;
                            $('#error_price_tour_5_add')
                                .show()
                                .html('Đơn giá phải là kiểu số');
                        }
                        if (error == true) {
                            var link = url + '/booking/insert-tour';
                            $.ajax({
                                method: 'POST',
                                url: link,
                                data: {
                                    // Danh sách các thuộc tính sẽ gửi đi
                                    name_tour_add: name_tour_add,
                                    price_tour_add: price_tour_add,
                                    price_tour_511_add: price_tour_511_add,
                                    price_tour_5_add: price_tour_5_add
                                },
                                success: function (response) {
                                    if (numberRegex.test(response)) {
                                        var price_tour_add_format =
                                            price_tour_add.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                                        var price_tour_511_add_format =
                                            price_tour_511_add.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                                        var price_tour_5_add_format =
                                            price_tour_5_add.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                                        var table_insert =
                                            '<tr> <td class="center">1</td>' +
                                            '<td><a>' +
                                            name_tour_add +
                                            '</a></td>' +
                                            '<td><span id="price_format_span">' +
                                            price_tour_add_format +
                                            '</span>' +
                                            '<input hidden="" id="input_price_format" value="' +
                                            price_tour_add_format +
                                            '">' +
                                            '<input hidden="" title="giá sửa" id="input_price" value="' +
                                            price_tour_add +
                                            '">' +
                                            '<input hidden="" id="input_price_old" title="giá cũ" value="' +
                                            price_tour_add +
                                            '">  | <a id="edit_price" href="javascript:void(0)"> <i class="fa fa-edit" title="Sửa đơn giá"></i></a>' +
                                            '<a id="reset_price" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a></td>' +
                                            '<td><span id="price_format_span_511">' +
                                            price_tour_511_add_format +
                                            '</span>' +
                                            '<input hidden="" title="giá sửa" id="input_price_511" value="' +
                                            price_tour_511_add +
                                            '"> | <a id="edit_price_511" href="javascript:void(0)"> <i class="fa fa-edit" title="Sửa đơn giá"></i></a>' +
                                            '<a id="reset_price_511" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a></td>' +
                                            '<td><span id="price_format_span_5">' +
                                            price_tour_5_add_format +
                                            '</span>' +
                                            '<input hidden="" title="giá sửa" id="input_price_5" value="' +
                                            price_tour_5_add +
                                            '"> | <a id="edit_price_5" href="javascript:void(0)"> <i class="fa fa-edit" title="Sửa đơn giá"></i></a>' +
                                            '<a id="reset_price_5" title="Lấy lại giá cũ" href="javascript:void(0)"> <i class="fa fa-refresh" title="Giá gốc"></i></a></td>' +
                                            '<td>' +
                                            diem_khoi_hanh +
                                            '</td>' +
                                            '</tr>';
                                        $('.table_booking_tour').html(table_insert);
                                        $('#input_name_tour').val(name_tour_add);
                                        $('#modal-form').modal('hide');
                                        $('#input_id_tour').val(response);
                                        $('#input_price_submit').val(price_tour_add);
                                        $('#input_price_511_submit').val(price_tour_511_add);
                                        $('#input_price_5_submit').val(price_tour_5_add);
                                        $('#input_id_tour')
                                            .removeClass('input-error')
                                            .addClass('valid');
                                        $('#input_name_tour')
                                            .removeClass('input-error')
                                            .addClass('valid');
                                    } else {
                                        lnv.alert({
                                            title: 'Lỗi',
                                            content: response,
                                            alertBtnText: 'Ok',
                                            iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                            alertHandler: function () {}
                                        });
                                    }
                                }
                            });
                        }
                    } else {
                        var mess = 'Tên tour "' + name_tour_add + '" đã tồn tại trong hệ thống';
                        $('#error_name_tour_add')
                            .show()
                            .html(mess);
                    }
                }
            });
        } else {
            if (name_tour_add == '') {
                $('#error_name_tour_add')
                    .show()
                    .html('Bạn vui lòng nhập tên tour');
            }
            if (price_tour_add == '') {
                $('#error_price_tour_add')
                    .show()
                    .html('Bạn vui lòng nhập giá người lớn');
            }
            if (price_tour_511_add == '') {
                $('#error_price_tour_511_add')
                    .show()
                    .html('Bạn vui lòng nhập giá trẻ em 5-11 tuổi');
            }
            if (price_tour_5_add == '') {
                $('#error_price_tour_5_add')
                    .show()
                    .html('Bạn vui lòng nhập giá trẻ em dưới 5 tuổi');
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

    $('body').on('click', '#submit_form_action_cot', function () {
        var form_data = $('#submit_form_cot').serializeArray();
        var error_free = true;
        for (var input in form_data) {
            var name_input = form_data[input]['name'];
            if (name_input != 'description') {
                var element = $('#input_' + name_input);
                var error = $('#error_' + name_input);
                var valid = element.hasClass('valid');
                if (valid == false) {
                    element.addClass('input-error').removeClass('valid');
                    error.show();
                    error_free = false;
                }
            }
        }
        if (error_free != false) {
            $('#submit_form_cot').submit();
        }
    });
    $('body').on('input', '#input_name_gia', function () {
        checkNameGia();
    });
    $('body').on('input', '#input_price_cost', function () {
        checkPriceCost();
    });
    $('body').on('change', '#input_created', function () {
        checkNgayThanhToan();
    });
    $('body').on('input', '#input_created', function () {
        checkNgayThanhToan();
    });
    $('body').on('click', '#create_popup_cost', function () {
        $('#input_name_gia').val('');
        $('#input_price_cost').val('');
        $('#input_created').val('');
        $('#description_input').val('');
        $('#price_format_cost')
            .hide()
            .html('');
        $('#title_form').html('Thêm chi phí');
        $('.error-color').hide();
    });
    $('body').on('click', '.view_popup_detail_cost', function () {
        var Id = $(this).attr('countid');
        var code = $(this).attr('name_record');
        show_info_cost(Id, code);
    });

    // show lịch sử giao dịch
    $('body').on('click', '.view_lich_su_giao_dich', function () {
        $('#show_loading_giao_dich').show();
        $('#list_giao_dich')
            .html('')
            .hide();
        $('#show_red_none_giao_dich')
            .html('')
            .hide();
        $('#content_giaodich').val('');
        $('#show_mess_content').hide();
        var code = $(this).attr('data-code');
        var id = $(this).attr('data-id');
        if (code && id) {
            $('#name-detail-code-booking').html(code);
            $('#save_giao_dich').attr('data-id', id);
            $('#save_giao_dich').attr('data-code', code);
            var link = url + '/booking-list-giao-dich.html';
            $.ajax({
                method: 'GET',
                url: link,
                data: 'id=' + id,
                success: function (response) {
                    if (response == 0) {
                        $('#show_red_none_giao_dich')
                            .show()
                            .html('<h4>Đơn hàng "' + code + '" không có giao dịch nào<p>');
                    } else {
                        $('#list_giao_dich')
                            .html(response)
                            .show();
                    }
                    $('#show_loading_giao_dich').hide();
                }
            });
        } else {
            $('#modal-form').modal('hide');
        }
    });
    // show hide text
    $('body').on('click', '.show_content_full', function () {
        var Id = $(this).attr('countid');
        if (Id) {
            var hide = $(this).attr('data-hide');
            if (hide == 'show') {
                $('#short_text_' + Id).hide();
                $('#long_text_' + Id).show();
                $('#icon_show_hide_' + Id)
                    .removeClass('fa-expand')
                    .addClass('fa-compress');
                $(this).attr('data-hide', 'hide');
            } else {
                $('#short_text_' + Id).show();
                $('#long_text_' + Id).hide();
                $('#icon_show_hide_' + Id)
                    .removeClass('fa-compress')
                    .addClass('fa-expand');
                $(this).attr('data-hide', 'show');
            }
        }
    });

    // show hide text
    $('body').on('click', '#save_giao_dich', function () {
        var email=$('#email_cus_submit').val();
        if(email!=''){
            var link = url + '/booking/send_email_bao_gia.html';
            var form = $('#send_email_bao_gia_form')[0];
            // Create an FormData object
            var data = new FormData(form);
            $.ajax({
                method: 'POST',
                url: link,
                enctype: 'multipart/form-data',
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data:  data,
                success: function (response) {
                   console.log(response);
                }
            });
        }else{
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng nhập email báo gi',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {}
            });
        }
    });

    // show hide text
    $('body').on('click', '#save_giao_dich', function () {
        var value = $('#content_giaodich').val();
        var created = $('#created_giaodich').val();
        var time = $('.time_giaodich').val();
        if (value && created && time) {
            $('#show_mess_content').hide();
            $('#error_created').hide();
            var code = $(this).attr('data-code');
            var id = $(this).attr('data-id');
            if (code && id) {
                $(this).hide();
                $('#show_loading_btn').show();
                var link = url + '/booking-save-giao-dich.html';
                $.ajax({
                    method: 'POST',
                    url: link,
                    data: {
                        id: id,
                        code: code,
                        value: value,
                        created: created,
                        time: time
                    },
                    success: function (response) {
                        if (response == 0) {
                            lnv.alert({
                                title: 'Lỗi',
                                content: 'Không thể thêm được giao dịch. Bạn vui lòng ctrl+f5 và thử lại',
                                alertBtnText: 'Ok',
                                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                alertHandler: function () {}
                            });
                        } else {
                            $('#list_giao_dich').html('');
                            $('#list_giao_dich')
                                .html(response)
                                .show();
                            $('#back_to_top_giao_dich').animate({
                                scrollTop: 0
                            }, 1500);
                        }
                        var currentDate = new Date();
                        $('#created_giaodich').datepicker('setDate', currentDate);
                        $('#timepicker1').timepicker();
                        //$("#created_giaodich").val('');
                        //$("#timepicker1").val('');
                        $('#content_giaodich').val('');
                        $('#save_giao_dich').show();
                        $('#show_loading_btn').hide();
                    }
                });
            } else {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Không thể thêm được giao dịch. Bạn vui lòng ctrl+f5 và thử lại',
                    alertBtnText: 'Ok',
                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {}
                });
            }
        } else {
            if (value == '') {
                $('#show_mess_content').show();
            }
            if (created == '' || time == '') {
                $('#error_created').show();
            }
        }
    });

    var currentDate = new Date();
    $('#created_giaodich').datepicker('setDate', currentDate);

    $('body').on('input', '#input_do_tuoi_nguoi_lon', function () {
        var value = $(this).val();
        $('#name_price_nguoi_lon').html('Đơn giá người lớn ' + value);
    });

    $('body').on('input', '#input_do_tuoi_tre_em_m1', function () {
        var value = $(this).val();
        if (value == '') {
            value = 'm1';
        }
        $('#name_price_tre_em_m1').html('Đơn giá trẻ em ' + value);
    });

    $('body').on('input', '#input_do_tuoi_tre_em_m2', function () {
        var value = $(this).val();
        if (value == '') {
            value = 'm2';
        }
        $('#name_price_tre_em_m2').html('Đơn giá trẻ em ' + value);
    });

    $('body').on('input', '#input_do_tuoi_tre_em_m3', function () {
        var value = $(this).val();
        if (value == '') {
            value = 'm3';
        }
        $('#name_price_tre_em_m3').html('Đơn giá trẻ em ' + value);
    });

    $('body').on('click', '.remove_item_dichvu', function () {
        var id = $(this).attr('data-remove');
        $('#item_dichvu_' + id).remove();
        $('.item_dichvu').each(function (index) {
            var n = index + 1;
            var id = $(this).attr('data-value');
            $('#stt_dichvu_td_' + id)
                .html(n)
                .attr('id', 'stt_dichvu_td_' + n);
            $(this).attr('id', 'item_dichvu_' + n);
            $(this).attr('data-value', n);
            $('#input_name_dichvu_' + id).attr('id', 'input_name_dichvu_' + n);
            $('#input_type_dichvu_' + id).attr('id', 'input_type_dichvu_' + n);
            $('#input_soluong_dichvu_' + id).attr('id', 'input_soluong_dichvu_' + n);
            $('#input_ghichu_dichvu_' + id).attr('id', 'input_ghichu_dichvu_' + n);
            $('#remove_item_dichvu_' + id).attr('id', 'remove_item_dichvu_' + n);
            $('#remove_item_dichvu_' + id).attr('data-remove', n);
        });
        total_price_dich_vu(0, 0, 0);
    });
    $('body').on('click', '#add_dichvu', function () {
        var n = $('.item_dichvu').length;
        n = n + 1;
        var list = $('#danhmuc_dichvu_select').html();
        var item =
            ' <tr id="item_dichvu_' +
            n +
            '" data-value="' +
            n +
            '" class="item_dichvu">' +
            '<td id="stt_dichvu_td_' +
            n +
            '">' +
            n +
            '</td>' +
            '<td id="name_dichvu_td"><input style="height: 30px; width: 100%;" value="" name="name_dichvu[]" id="input_name_dichvu_' +
            n +
            '" type="text" class="valid input_table"></td>' +
            '<td> <select style="height: 30px; width: 100%;" name="type_dichvu[]" id="input_type_dichvu_' +
            n +
            '">' +
            list +
            '</select></td>' +
            '<td><input style="height: 30px; width: 86%;" value="0" data-value="' +
            n +
            '" name="price_dichvu[]" id="input_price_dichvu_' +
            n +
            '" type="number" class="valid input_table input_price_dichvu">' +
            ' <div style="width:10%;" class="btn-group">' +
            '<button style="padding: 4px 5px;margin-top: 0px; margin-bottom: 3px;" data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird" aria-expanded="false"> <i class="fa fa-usd" aria-hidden="true"></i></button>' +
            '<ul class="dropdown-menu dropdown-danger"> <li> <a role="button" data-toggle="modal" class="edit_function">Đơn giá: <b id="price_dichvu_format_' +
            n +
            '">0 vnđ</span></a> </li> </ul>' +
            '</div>' +
            '</td>' +
            '<td><input  style="height: 30px; width:100%" data-value="' +
            n +
            '" value="1" name="soluong_dichvu[]" min="1" id="input_soluong_dichvu_' +
            n +
            '" type="number" class="valid input_table input_soluong_dichvu"></td>' +
            '<td><input readonly style="height: 30px; width: 100%;" value="" name="thanhtien_dichvu[]" id="input_thanhtien_dichvu_' +
            n +
            '" type="text" class="valid input_table"></td>' +
            '<td><input  style="height: 30px; width: 100%;" value="" name="ghichu_dichvu[]" id="input_ghichu_dichvu_' +
            n +
            '" type="text" class="valid input_table"></td>' +
            '<td><a style="padding: 0px 5px;" href="javascript:void(0)" id="remove_item_dichvu_' +
            n +
            '" data-remove="' +
            n +
            '" class="red btn  btn-danger remove_item_dichvu"><i class="fa fa-trash-o"></i></a></td>' +
            '</tr>';
        $('#list_dichvu').append(item);
    });
    $('body').on('click', '#add_file', function () {
        $('.div_file_email').append('<input type="file" name="file_email[]" class="file_input"/>');
        $('.file_input').ace_file_input({
            no_file: 'No File ...',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
        });
    });
    $('[data-rel=tooltip]').tooltip();
    $('[data-toggle="tooltip"]').tooltip();
    $('body').on('click', '.input_price_dichvu', function () {
        $(this).select();
    });
    $('body').on('click', '.input_soluong_dichvu', function () {
        $(this).select();
    });
    $('body').on('input', '.input_price_dichvu', function () {
        var price = $(this).val();
        var id = $(this).attr('data-value');
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#don_gia_th').html(price_format);
        } else {
            $(this).val(0);
            price = 0;
            $('#don_gia_th').html('');
        }
        if (price <= 0) {
            price = 0;
            $(this).val(0);
        }
        total_price_dich_vu(price, id);
    });
    $('body').on('input', '.input_soluong_dichvu', function () {
        var soluong = $(this).val();
        var id = $(this).attr('data-value');
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if (!numberRegex.test(soluong)) {
            $(this).val(1);
            soluong = 1;
        }
        total_price_dich_vu(0, id, soluong);
    });
    // show lịch sử giao dịch
    $('body').on('click', '.view_email_bao_gia', function () {

        var id = $(this).attr('data-id');
        var thuong_hieu = $('.thuong_hieu').val();
        var email = $('#input_email').val();
        var code=$('#input_code_booking').val();
        $('#title_form_email').html('Bảng báo giá cho đơn hàng "'+code+'"');
        if (id && email && thuong_hieu) {
            $('#show_loading_giao_dich_email').show();
            $('#modal-form-email-bao-gia').modal('show');
            var link = url + '/gui-bao-gia-booking.html';
            $.ajax({
                method: 'GET',
                url: link,
                data: 'id=' + id+'&email='+email+'&thuong_hieu='+thuong_hieu,
                success: function (response) {
                    $('#show_loading_giao_dich_email').hide();
                    $('#name_cus_email').html($('#input_name_customer').val());
                    $('#email_cus_email').html($('#input_email').val());
                    $('#email_cus_submit').val($('#input_email').val());
                    $('#address_cus_email').html($('#input_address').val());
                    $('#phone_cus_email').html($('#input_phone').val());
                    $('#content_email_bao_gia').show();
                    $('#content_bao_gia').html(response);
                    CKEDITOR.instances.content_bao_gia.setData(response);
                }
            });
        }else{
            if(thuong_hieu=='' && email=='' && id==''){
                var mess='Bạn vui lòng chọn thương hiệu  và nhập email khách hàng';
            }else{
                if(thuong_hieu==''){
                    var mess='Bạn vui lòng chọn thương hiệu';
                }else{
                    if(id==''){
                        var mess='Không tồn tại id booking';
                    }else{
                        var mess='Bạn vui lòng nhập email khách hàng';
                    }
                }
            }
            lnv.alert({
                title: 'Lỗi',
                content: mess,
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }
    });
});
function _returnDefailBangGia() {
    $('#don_gia_th').html('');
    $('#price_loinhuan_format').html('');
    $('#price_loinhuan_format_1').html('');
    $('#price_loinhuan_format_2').html('');
    $('#price_loinhuan_format_3').html('');
    $('#input_tong_tien_nguoi_lon').val('');
    $('#input_tyle_m1').val('');
    $('#input_tyle_m2').val('');
    $('#input_tyle_m3').val('');
    $('#input_don_gia_net').val('');
    $('#input_don_gia_net_m1').val('');
    $('#input_don_gia_net_m2').val('');
    $('#input_don_gia_net_m3').val('');
    $('#input_loi_nhuan').val('');
    $('#input_loi_nhuan_m1').val('');
    $('#input_loi_nhuan_m2').val('');
    $('#input_loi_nhuan_m3').val('');
    $('#input_gia_ban').val('');
    $('#input_gia_ban_m1').val('');
    $('#input_gia_ban_m2').val('');
    $('#input_gia_ban_m3').val('');
    $('#list_dichvu').html('');
}
function total_price_dich_vu(price, item, soluong_dichvu) {
    if (price >= 0 && item > 0) {
        var soluong = $('#input_soluong_dichvu_' + item).val();
        if (soluong <= 0) {
            soluong = 1;
        }
        var thanh_tien = soluong * price;
        var thanh_tien_format = thanh_tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#input_thanhtien_dichvu_' + item).val(thanh_tien_format);
        $('#price_dichvu_format_' + item).html(price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ');
    }
    if (soluong_dichvu >= 0 && item > 0) {
        var price_dichvu = $('#input_price_dichvu_' + item).val();
        if (price_dichvu <= 0) {
            price_dichvu = 0;
        }
        var thanh_tien = soluong_dichvu * price_dichvu;
        var thanh_tien_format = thanh_tien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        $('#input_thanhtien_dichvu_' + item).val(thanh_tien_format);
        $('#price_dichvu_format_' + item).html(
            price_dichvu.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ'
        );
    }
    var total = 0;
    $('.item_dichvu').each(function (index) {
        var n = index + 1;
        var id = $(this).attr('data-value');
        var soluong = $('#input_soluong_dichvu_' + id).val();
        var price_dichvu = $('#input_price_dichvu_' + id).val();
        var thanhtien = soluong * price_dichvu;
        total = total + thanhtien;
    });
    $('#input_tong_tien_nguoi_lon').val(total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ');

    var type_tour = $('.type_tour').val();
    // tính giá người lớn
    var giaban_nguoi_lon = price_nguoi_lon(total, type_tour);

    // tính giá trẻ em mức 1
    var giaban_tre_em_m1 = price_tre_em_m1(total, type_tour);

    // tính giá trẻ em mức 2
    var giaban_tre_em_m2 = price_tre_em_m2(total, type_tour);

    // tính giá trẻ em mức 3
    var giaban_tre_em_m3 = price_tre_em_m3(total, type_tour);

    tinh_tong_tien(type_tour);
}

function tinh_tong_tien(type_tour) {
    // if (type_tour == 1) {
    var input_price = $('#input_price_submit').val();
    if (input_price == '') {
        input_price = 0;
        $('#input_price_submit').val(0);
    }
    var input_price_tre_em_m1 = $('#input_price_m1_submit').val();
    if (input_price_tre_em_m1 == '') {
        input_price_tre_em_m1 = 0;
        $('#input_price_m1_submit').val(0);
    }
    var input_price_tre_em_m2 = $('#input_price_m2_submit').val();
    if (input_price_tre_em_m2 == '') {
        input_price_tre_em_m2 = 0;
        $('#input_price_m2_submit').val(0);
    }
    var input_price_tre_em_m3 = $('#input_price_m3_submit').val();
    if (input_price_tre_em_m3 == '') {
        input_price_tre_em_m3 = 0;
        $('#input_price_m3_submit').val(0);
    }
    var input_num_nguoi_lon = $('#input_num_nguoi_lon').val();
    if (input_num_nguoi_lon == '' || input_num_nguoi_lon <= 0) {
        input_num_nguoi_lon = 1;
        $('#input_num_nguoi_lon').val(1);
    }
    var input_num_tre_em_m1 = $('#input_num_tre_em_m1').val();
    if (input_num_tre_em_m1 == '' || input_num_tre_em_m1 < 0) {
        input_num_tre_em_m1 = 0;
        $('#input_num_tre_em_m1').val(0);
    }
    var input_num_tre_em_m2 = $('#input_num_tre_em_m2').val();
    if (input_num_tre_em_m2 == '' || input_num_tre_em_m2 < 0) {
        input_num_tre_em_m2 = 0;
        $('#input_num_tre_em_m2').val(0);
    }
    var input_num_tre_em_m3 = $('#input_num_tre_em_m3').val();
    if (input_num_tre_em_m3 == '' || input_num_tre_em_m3 < 0) {
        input_num_tre_em_m3 = 0;
        $('#input_num_tre_em_m3').val(0);
    }
    var total_price =
        input_price * input_num_nguoi_lon +
        input_price_tre_em_m1 * input_num_tre_em_m1 +
        input_price_tre_em_m2 * input_num_tre_em_m2 +
        input_price_tre_em_m3 * input_num_tre_em_m3;

    if (parseInt(total_price) == total_price) {
        var total_price_format = total_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var total_price_format = total_price.toFixed(2).replace('.', ',');
        total_price_format = total_price_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#tong_cong').html(total_price_format);
    var vat = 0;
    if ($('#input_vat').is(':checked')) {
        var vat = parseFloat(total_price * 0.1);
        vat = Math.round(vat * 1000) / 1000;
    }
    if (parseInt(vat) == vat) {
        var price_vat_format = vat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var price_vat_format = vat.toFixed(2).replace('.', ',');
        price_vat_format = price_vat_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#vat').html(price_vat_format);
    total_price = total_price + vat;

    var dat_coc = $('#input_dat_coc').val();
    if (dat_coc != '' && dat_coc > 0) {
        dat_coc = dat_coc.toString().split(',');
        // dat_coc = dat_coc.toString().split('.');
        if (parseFloat(dat_coc) > total_price) {
            dat_coc = total_price;
            $('#input_dat_coc').val(total_price);
            if (parseInt(dat_coc) == dat_coc) {
                var dat_coc_format = dat_coc.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            } else {
                var dat_coc_format = dat_coc.toFixed(2).replace('.', ',');
                dat_coc_format = dat_coc_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            }
            $('#dat_coc_format').html(dat_coc_format);
        }
    } else {
        dat_coc = 0;
    }
    dat_coc = parseFloat(dat_coc);
    total_price = total_price - dat_coc;

    if (parseInt(total_price) == total_price) {
        var total_price = total_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var total_price = total_price.toFixed(2).replace('.', ',');
        total_price = total_price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }

    returnHoaHongThanhVien()
    $('#con_lai').html(total_price);
    // }
}

function price_nguoi_lon(total, type_tour) {
    var soluong_nguoi_lon = $('#input_num_nguoi_lon').val();
    if (soluong_nguoi_lon == '' || soluong_nguoi_lon <= 0) {
        soluong_nguoi_lon = 1;
        $('#input_num_nguoi_lon').val();
        $('#input_total_khach').val();
    }

    var price_pax = total / soluong_nguoi_lon;
    var price_pax = parseFloat(price_pax);
    price_pax = Math.round(price_pax * 1000) / 1000;
    if (price_pax % 2 == 0 || soluong_nguoi_lon == 1) {
        var price_pax_format = price_pax.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var price_pax_format = price_pax.toFixed(2).replace('.', ',');
        price_pax_format = price_pax_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }

    $('#input_don_gia_net').val(price_pax_format);
    var loi_nhuan_nguoi_lon = $('#input_loi_nhuan').val();
    if (loi_nhuan_nguoi_lon == '') {
        loi_nhuan_nguoi_lon = 0;
        $('#input_loi_nhuan').val(0);
    }
    var giaban = parseFloat(loi_nhuan_nguoi_lon) + price_pax;
    giaban = Math.round(giaban * 1000) / 1000;
    if (giaban % 2 == 0 || soluong_nguoi_lon == 1) {
        var giaban_format = giaban.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var giaban_format = giaban.toFixed(2).replace('.', ',');
        giaban_format = giaban_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_gia_ban').val(giaban_format);
    if (type_tour == 1) {
        $('#price_format_span').html(giaban_format);
        $('#input_price_format').val(giaban_format);
        $('#input_price').val(giaban);
        $('#input_price_submit').val(giaban);
        $('#input_price_old').val(giaban);
        $('#edit_price').hide();
        $('#reset_price').hide();
    }

    return giaban;
}

function price_tre_em_m1(total, type_tour) {
    var tyle_m1 = $('#input_tyle_m1').val();
    if (tyle_m1 == '') {
        tyle_m1 = 0;
    }
    var total_price_m1 = total * tyle_m1 / 100;
    if (total_price_m1 % 2 != 0) {
        var total_price_m1 = parseFloat(total_price_m1);
        total_price_m1 = Math.round(total_price_m1 * 1000) / 1000;
    }
    var soluong_khach_1 = $('#input_total_khach_m1').val();
    if (soluong_khach_1 == '') {
        soluong_khach_1 = 0;
        $('#input_total_khach_m1').val(0);
    }
    var price_pax_m1 = 0;
    if (soluong_khach_1 > 0) {
        price_pax_m1 = total_price_m1 / soluong_khach_1;
        price_pax_m1 = parseFloat(price_pax_m1);
        price_pax_m1 = Math.round(price_pax_m1 * 1000) / 1000;
    }
    if (price_pax_m1 % 2 == 0 || soluong_khach_1 == 1) {
        var price_pax_m1_format = price_pax_m1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var price_pax_m1_format = price_pax_m1.toFixed(2).replace('.', ',');
        var price_pax_m1_format = price_pax_m1_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_don_gia_net_m1').val(price_pax_m1_format);
    var loi_nhuan_m1 = $('#input_loi_nhuan_m1').val();
    if (loi_nhuan_m1 == '') {
        loi_nhuan_m1 = 0;
        $('#input_loi_nhuan_m1').val(0);
    }

    var giaban_m1 = parseFloat(loi_nhuan_m1) + price_pax_m1;
    giaban_m1 = Math.round(giaban_m1 * 1000) / 1000;
    if (giaban_m1 % 2 == 0 || soluong_khach_1 == 1) {
        var giaban_format_m1 = giaban_m1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var giaban_format_m1 = giaban_m1.toFixed(2).replace('.', ',');
        var giaban_format_m1 = giaban_format_m1.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_gia_ban_m1').val(giaban_format_m1);
    if (type_tour == 1) {
        $('#price_format_span_tre_em_m1').html(giaban_format_m1);
        $('#input_price_tre_em_m1').val(giaban_m1);
        $('#input_price_tre_em_m1_old').val(giaban_m1);
        $('#input_price_m1_submit').val(giaban_m1);
        $('#edit_price_tre_em_m1').hide();
        $('#reset_price_tre_em_m1').hide();
    }
    return giaban_m1;
}

function price_tre_em_m2(total, type_tour) {
    var tyle_m2 = $('#input_tyle_m2').val();
    if (tyle_m2 == '') {
        tyle_m2 = 0;
    }
    var total_price_m2 = total * tyle_m2 / 100;
    if (total_price_m2 % 2 != 0) {
        var total_price_m2 = parseFloat(total_price_m2);
        total_price_m2 = Math.round(total_price_m2 * 1000) / 1000;
    }
    var soluong_khach_2 = $('#input_total_khach_m2').val();
    if (soluong_khach_2 == '') {
        soluong_khach_2 = 0;
        $('#input_total_khach_m2').val(0);
    }
    var price_pax_m2 = 0;
    if (soluong_khach_2 > 0) {
        price_pax_m2 = total_price_m2 / soluong_khach_2;
        price_pax_m2 = parseFloat(price_pax_m2);
        price_pax_m2 = Math.round(price_pax_m2 * 1000) / 1000;
    }

    if (price_pax_m2 % 2 == 0 || soluong_khach_2 == 1) {
        var price_pax_m2_format = price_pax_m2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var price_pax_m2_format = price_pax_m2.toFixed(2).replace('.', ',');
        var price_pax_m2_format = price_pax_m2_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_don_gia_net_m2').val(price_pax_m2_format);
    var loi_nhuan_m2 = $('#input_loi_nhuan_m2').val();
    if (loi_nhuan_m2 == '') {
        loi_nhuan_m2 = 0;
        $('#input_loi_nhuan_m2').val(0);
    }

    var giaban_m2 = parseFloat(loi_nhuan_m2) + price_pax_m2;
    giaban_m2 = Math.round(giaban_m2 * 1000) / 1000;
    if (giaban_m2 % 2 == 0 || soluong_khach_2 == 1) {
        var giaban_format_m2 = giaban_m2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var giaban_format_m2 = giaban_m2.toFixed(2).replace('.', ',');
        var giaban_format_m2 = giaban_format_m2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_gia_ban_m2').val(giaban_format_m2);
    if (type_tour == 1) {
        $('#price_format_span_tre_em_m2').html(giaban_format_m2);
        $('#input_price_tre_em_m2').val(giaban_m2);
        $('#input_price_tre_em_m2_old').val(giaban_m2);
        $('#input_price_m2_submit').val(giaban_m2);
        $('#edit_price_tre_em_m2').hide();
        $('#reset_price_tre_em_m2').hide();
    }
    return giaban_m2;
}

function price_tre_em_m3(total, type_tour) {
    var tyle_m3 = $('#input_tyle_m3').val();
    if (tyle_m3 == '') {
        tyle_m3 = 0;
    }
    var total_price_m3 = total * tyle_m3 / 100;
    if (total_price_m3 % 2 != 0) {
        var total_price_m3 = parseFloat(total_price_m3);
        total_price_m3 = Math.round(total_price_m3 * 1000) / 1000;
    }
    var soluong_khach_3 = $('#input_total_khach_m3').val();
    if (soluong_khach_3 == '') {
        soluong_khach_3 = 0;
        $('#input_total_khach_m3').val(0);
    }
    var price_pax_m3 = 0;
    if (soluong_khach_3 > 0) {
        price_pax_m3 = total_price_m3 / soluong_khach_3;
        price_pax_m3 = parseFloat(price_pax_m3);
        price_pax_m3 = Math.round(price_pax_m3 * 1000) / 1000;
    }

    if (price_pax_m3 % 2 == 0 || soluong_khach_3 == 1) {
        var price_pax_m3_format = price_pax_m3.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var price_pax_m3_format = price_pax_m3.toFixed(2).replace('.', ',');
        var price_pax_m3_format = price_pax_m3_format.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_don_gia_net_m3').val(price_pax_m3_format);
    var loi_nhuan_m3 = $('#input_loi_nhuan_m3').val();
    if (loi_nhuan_m3 == '') {
        loi_nhuan_m3 = 0;
        $('#input_loi_nhuan_m3').val(0);
    }

    var giaban_m3 = parseFloat(loi_nhuan_m3) + price_pax_m3;
    giaban_m3 = Math.round(giaban_m3 * 1000) / 1000;
    if (giaban_m3 % 2 == 0 || soluong_khach_3 == 1) {
        var giaban_format_m3 = giaban_m3.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        var giaban_format_m3 = giaban_m3.toFixed(2).replace('.', ',');
        var giaban_format_m3 = giaban_format_m3.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    }
    $('#input_gia_ban_m3').val(giaban_format_m3);
    if (type_tour == 1) {
        $('#price_format_span_tre_em_m3').html(giaban_format_m3);
        $('#input_price_tre_em_m3').val(giaban_m3);
        $('#input_price_tre_em_m3_old').val(giaban_m3);
        $('#input_price_m3_submit').val(giaban_m3);
        $('#edit_price_tre_em_m3').hide();
        $('#reset_price_tre_em_m3').hide();
    }
    return giaban_m3;
}

function show_info_cost(Id, name) {
    $('#title_form').html('Thôn tin chi tiết "<b>' + name + '</b>"');
    $('#input_check_edit').val('edit');
    if (Id != '') {
        jQuery
            .post(url + '/get-detail-ajax/', {
                id: Id,
                table: 'booking_cost'
            })
            .done(function (data) {
                if (data != 0) {
                    var obj = jQuery.parseJSON(data);
                    $('#input_id_edit').val(Id);
                    $('#input_name_gia').val(obj.name);
                    $('#input_price_cost').val(obj.price);
                    $('#input_created').val(obj.created);
                    $('#description_input').val(obj.description);
                    if (obj.price != '') {
                        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                        if (numberRegex.test(obj.price)) {
                            var price_format = obj.price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                            $('#price_format_cost')
                                .show()
                                .html(price_format);
                        }
                    } else {
                        $('#price_format_cost')
                            .hide()
                            .html('');
                    }
                    if (obj.name != '') {
                        $('#input_name_gia')
                            .removeClass('input-error')
                            .addClass('valid');
                    }
                    if (obj.name != '') {
                        $('#input_price_cost')
                            .removeClass('input-error')
                            .addClass('valid');
                    }
                    if (obj.name != '') {
                        $('#input_created')
                            .removeClass('input-error')
                            .addClass('valid');
                    }
                } else {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Ban không thể xem chi tiết chi phí"' + name + '"',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#modal-form').modal('hide');
                        }
                    });
                }
            });
    } else {
        lnv.alert({
            title: 'Lỗi',
            content: 'Ban không thể xem chi tiết chi phí "' + name + '"',
            alertBtnText: 'Ok',
            iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
            alertHandler: function () {
                $('#modal-form').modal('hide');
            }
        });
    }
}
// check name user
function checkNgayThanhToan() {
    var value = $('#input_created').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập ngày thanh toán';
        showHiddenNgayThanhToan(0, mess);
    } else {
        var mess = '';
        showHiddenNgayThanhToan(1, mess);
    }
}

function showHiddenNgayThanhToan(res, mess) {
    var error_created = $('#error_created');
    if (res == 1) {
        error_created.hide();
        $('#icon_error_created').hide();
        $('#input_created')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_created').show();
        $('#input_created')
            .addClass('input-error')
            .removeClass('valid');
        error_created.removeClass('success-color');
        error_created.addClass('error-color');
        error_created.html(mess);
        error_created.show();
    }
}

// check name user
function checkPriceCost() {
    var value = $('#input_price_cost').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập chi phí';
        showHiddenPriceCost(0, mess);
        $('#input_price_cost').val();
        $('#price_format_cost')
            .hide()
            .html('');
    } else {
        var mess = '';
        showHiddenPriceCost(1, mess);
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if (numberRegex.test(value)) {
            var price_format = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#price_format_cost')
                .show()
                .html(price_format);
        } else {
            $('#input_price_cost').val();
            $('#price_format_cost')
                .hide()
                .html('');
        }
    }
}

function showHiddenPriceCost(res, mess) {
    var error_price_cost = $('#error_price_cost');
    if (res == 1) {
        error_price_cost.hide();
        $('#icon_error_price_cost').hide();
        $('#input_price_cost')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_price_cost').show();
        $('#input_price_cost')
            .addClass('input-error')
            .removeClass('valid');
        error_price_cost.removeClass('success-color');
        error_price_cost.addClass('error-color');
        error_price_cost.html(mess);
        error_price_cost.show();
    }
}

// check name user
function checkNameGia() {
    var value = $('#input_name_gia').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập tên chi phí';
        showHiddenNameGia(0, mess);
    } else {
        var mess = '';
        showHiddenNameGia(1, mess);
    }
}

function showHiddenNameGia(res, mess) {
    var error_name_gia = $('#error_name_gia');
    if (res == 1) {
        error_name_gia.hide();
        $('#icon_error_name_gia').hide();
        $('#input_name_gia')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_name_gia').show();
        $('#input_name_gia')
            .addClass('input-error')
            .removeClass('valid');
        error_name_gia.removeClass('success-color');
        error_name_gia.addClass('error-color');
        error_name_gia.html(mess);
        error_name_gia.show();
    }
}

function checkSoNguoi() {
    returnGenDanhSachDoan();
}

function show_booking(Id, name) {
    $('#title_form').html('Thôn tin chi tiết đơn hàng "<b>' + name + '</b>"');
    $('#input_check_edit').val('edit');
    if (Id != '') {
        jQuery
            .post(url + '/get-detail-ajax-booking/', {
                id: Id,
                table: 'booking'
            })
            .done(function (data) {
                if (data != 0) {
                    var obj = jQuery.parseJSON(data);
                    $('.user_name_link').html(obj.user_name_link);
                    $('.user_text_confirm').html(obj.user_text_confirm);
                    $('.dieuhanh_name_link').html(obj.dieuhanh_name_link);
                    $('.dieuhanh_text_confirm').html(obj.dieuhanh_text_confirm);
                    $('.tien_te').html(obj.tien_te_name + ' - ' + obj.ty_gia);
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
                    $('.gia_tre_em_m1').html(obj.price_tre_em_m1_new_format);
                    $('.gia_tre_em_m2').html(obj.price_tre_em_m2_new_format);
                    $('.gia_tre_em_m3').html(obj.price_tre_em_m3_new_format);
                    $('.tong_cong').html(obj.total_format);
                    $('.vat_thanh_tien').html(obj.vat_price_format);
                    $('.dat_coc').html(obj.tien_thanh_toan_format);
                    $('.con_lai').html(obj.conlai_format);
                    $('#input_num_nguoi_lon').val(obj.num_nguoi_lon);
                    $('#input_do_tuoi_nguoi_lon').val(obj.name_price);
                    $('#input_num_tre_em_m1').val(obj.num_tre_em_m1);
                    $('#input_do_tuoi_tre_em_m1').val(obj.name_price_m1	);
                    $('#input_num_tre_em_m2').val(obj.num_tre_em_m2);
                    $('#input_do_tuoi_tre_em_m2').val(obj.name_price_m2);
                    $('#input_num_tre_em_m3').val(obj.num_tre_em_m3);
                    $('#input_do_tuoi_tre_em_m3').val(obj.name_price_m3);

                    if (obj.user_tiepthi != '') {
                        $('.name_tiepthi').html(obj.user_tiepthi);
                        $('.status_tiep_thi').html(obj.status_tiepthi);
                        $('.price_tiep_thi').html(obj.price_tiep_thi);
                        $('.show_hoa_hong').show();
                    } else {
                        $('.show_hoa_hong').hide();
                        $('.name_tiepthi').html('');
                        $('.status_tiep_thi').html('');
                        $('.price_tiep_thi').html('');
                    }
                } else {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Ban không thể xem chi tiết đơn hàng "' + name + '"',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            $('#modal-form').modal('hide');
                        }
                    });
                }
            });
    } else {
        lnv.alert({
            title: 'Lỗi',
            content: 'Ban không thể xem chi tiết đơn hàng "' + name + '"',
            alertBtnText: 'Ok',
            iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
            alertHandler: function () {
                $('#modal-form').modal('hide');
            }
        });
    }
}

function returnDatCoc() {
    var value = $('#input_dat_coc').val();
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if (numberRegex.test(value)) {
        var price_format = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    } else {
        $('#input_dat_coc').val(0);
        value = 0;
        price_format = '0 vnđ';
    }
    $('#dat_coc_format').html(price_format);
    var type_tour = $('.type_tour').val();
    tinh_tong_tien(type_tour);
}

function returnHoaHongThanhVien() {
    var value = $('#input_hoa_hong_thanh_vien').val();
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    if (numberRegex.test(value)) {
        var price_format = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
        var price_submit=$('#input_price_submit').val();
        price_submit=price_submit*0.1;
        console.log(price_submit);
        if(value>price_submit){
            value = 0;
            $('#input_hoa_hong_thanh_vien').val(0);
            price_format = '0 vnđ';
        }
    } else {
        $('#input_hoa_hong_thanh_vien').val(0);
        value = 0;
        price_format = '0 vnđ';
    }
    if(value<=0){
        $('#input_hoa_hong_thanh_vien').val(0);
        value = 0;
        price_format = '0 vnđ';
    }

    $('.price_tiep_thi').html(price_format);
}

function checkDiemDon() {
    var value = $('#input_diem_don').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập điểm đón';
        showHiddenDiemDon(0, mess);
    } else {
        var mess = '';
        showHiddenDiemDon(1, mess);
    }
}

function showHiddenDiemDon(res, mess) {
    var error_diem_don = $('#error_diem_don');
    if (res == 1) {
        error_diem_don.hide();
        $('#icon_error_diem_don').hide();
        $('#input_diem_don')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_diem_don').show();
        $('#input_diem_don')
            .addClass('input-error')
            .removeClass('valid');
        error_diem_don.removeClass('success-color');
        error_diem_don.addClass('error-color');
        error_diem_don.html(mess);
        error_diem_don.show();
    }
}
//
function checkPhoneCustomer() {
    var value = $('#input_phone').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập điện thoại';
        showHiddenPhoneCustomer(0, mess);
    } else {
        var mess = '';
        showHiddenPhoneCustomer(1, mess);
    }
}

function showHiddenPhoneCustomer(res, mess) {
    var error_phone = $('#error_phone');
    if (res == 1) {
        error_phone.hide();
        $('#icon_error_phone').hide();
        $('#input_phone')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_phone').show();
        $('#input_phone')
            .addClass('input-error')
            .removeClass('valid');
        error_phone.removeClass('success-color');
        error_phone.addClass('error-color');
        error_phone.html(mess);
        error_phone.show();
    }
}

//
function checkAddressCustomer() {
    var value = $('#input_address').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập điện thoại';
        showHiddenAddressCustomer(0, mess);
    } else {
        var mess = '';
        showHiddenAddressCustomer(1, mess);
    }
}

function showHiddenAddressCustomer(res, mess) {
    var error_address = $('#error_address');
    if (res == 1) {
        error_address.hide();
        $('#icon_error_address').hide();
        $('#input_address')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_address').show();
        $('#input_address')
            .addClass('input-error')
            .removeClass('valid');
        error_address.removeClass('success-color');
        error_address.addClass('error-color');
        error_address.html(mess);
        error_address.show();
    }
}

//
function checkEmailCustomer() {
    var value = $('#input_email').val();
    if (value != '') {
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email = re.test(value);
        if (is_email) {
            var mess = '';
            showHiddenEmail(1, mess);
        } else {
            var mess = 'Email không đúng định dạng';
            showHiddenEmail(0, mess);
        }
    } else {
        var mess = 'Bạn vui lòng nhập email';
        showHiddenEmail(0, mess);
    }
}
// check mã nhân viên
function showHiddenEmail(res, mess) {
    var email_user_error = $('#error_email');
    if (res == 1) {
        email_user_error.hide();
        $('#icon_error_email').hide();
        $('#input_email')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        $('#icon_error_email').show();
        $('#input_email')
            .addClass('input-error')
            .removeClass('valid');
        email_user_error.removeClass('success-color');
        email_user_error.addClass('error-color');
        email_user_error.html(mess);
        email_user_error.show();
    }
}
// check name user
function checkNameCustomer() {
    var value = $('#input_name_customer').val();
    if (value == '') {
        var mess = 'Bạn vui lòng nhập tên khách hàng';
        showHiddenNameCustomer(0, mess);
    } else {
        var mess = '';
        showHiddenNameCustomer(1, mess);
    }
}

function showHiddenNameCustomer(res, mess) {
    var error_name_customner = $('#error_name_customer');
    if (res == 1) {
        error_name_customner.hide();
        $('#icon_error_name_customer').hide();
        $('#input_name_customer')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#icon_error_name_customer').show();
        $('#input_name_customer')
            .addClass('input-error')
            .removeClass('valid');
        error_name_customner.removeClass('success-color');
        error_name_customner.addClass('error-color');
        error_name_customner.html(mess);
        error_name_customner.show();
    }
}

// check ngày bắt đầu
function checkNgayKhoiHanh() {
    var value = $('#input_ngay_khoi_hanh').val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn ngày khởi hành';
        showHiddenNgayKhoiHanh(0, mess);
    } else {
        var value_date = value.split('-');
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var eighteenYearsAgo = moment().subtract(18, 'years');
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess = 'Không đúng định dạng ngày tháng năm';
        } else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenNgayKhoiHanh(res, mess);
    }
}

function showHiddenNgayKhoiHanh(res, mess) {
    var error_ngay_khoi_hanh = $('#error_ngay_khoi_hanh');
    if (res == 1) {
        error_ngay_khoi_hanh.hide();
        $('#input_ngay_khoi_hanh')
            .removeClass('input-error')
            .addClass('valid');
        $('#icon_ngay_khoi_hanh').removeClass('error-color');
        var date_khoihanh = $('#input_ngay_khoi_hanh').val();
        $('#input_ngay_khoi_hanh_cus').val(date_khoihanh);
        $('#input_ngay_khoi_hanh_cus')
            .removeClass('input-error')
            .addClass('valid');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_khoi_hanh')
            .addClass('input-error')
            .removeClass('valid');
        $('#icon_ngay_khoi_hanh').addClass('error-color');
        error_ngay_khoi_hanh.removeClass('success-color');
        error_ngay_khoi_hanh.addClass('error-color');
        error_ngay_khoi_hanh.html(mess);
        error_ngay_khoi_hanh.show();
        $('#input_ngay_khoi_hanh_cus').val('');
    }
}

// check ngày bắt đầu
function checkNgayKetThuc() {
    var value = $('#input_ngay_ket_thuc').val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn ngày khởi hành';
        showHiddenNgayKetThuc(0, mess);
    } else {
        var value_date = value.split('-');
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var eighteenYearsAgo = moment().subtract(18, 'years');
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess = 'Không đúng định dạng ngày tháng năm';
        } else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenNgayKetThuc(res, mess);
    }
}

function showHiddenNgayKetThuc(res, mess) {
    var error_ngay_ket_thuc = $('#error_ngay_ket_thuc');
    if (res == 1) {
        error_ngay_ket_thuc.hide();
        $('#input_ngay_ket_thuc')
            .removeClass('input-error')
            .addClass('valid');
        $('#icon_ngay_ket_thuc').removeClass('error-color');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_ket_thuc')
            .addClass('input-error')
            .removeClass('valid');
        $('#icon_ngay_ket_thuc').addClass('error-color');
        error_ngay_ket_thuc.removeClass('success-color');
        error_ngay_ket_thuc.addClass('error-color');
        error_ngay_ket_thuc.html(mess);
        error_ngay_ket_thuc.show();
    }
}

//
function checkHanThanhToan() {
    var value = $('#input_han_thanh_toan').val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn hạn thanh toán';
        showHiddenHanThanhToan(0, mess);
    } else {
        var value_date = value.split('-');
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var birthday = moment(value);
        if (!birthday.isValid()) {
            mess = 'Không đúng định dạng ngày tháng năm';
        } else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenHanThanhToan(res, mess);
    }
}

function showHiddenHanThanhToan(res, mess) {
    var error_han_thanh_toan = $('#error_han_thanh_toan');
    if (res == 1) {
        error_han_thanh_toan.hide();
        $('#input_han_thanh_toan')
            .removeClass('input-error')
            .addClass('valid');
        $('#icon_han_thanh_toan').removeClass('error-color');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_bat_dau')
            .addClass('input-error')
            .removeClass('valid');
        $('#icon_ngay_bat_dau').addClass('error-color');
        error_han_thanh_toan.removeClass('success-color');
        error_han_thanh_toan.addClass('error-color');
        error_han_thanh_toan.html(mess);
        error_han_thanh_toan.show();
    }
}

// check ngày bắt đầu
function checkNgayBatDau() {
    var value = $('#input_ngay_bat_dau').val();
    if (value == '') {
        var mess = 'Bạn vui lòng chọn ngày bắt đầu';
        showHiddenNgayBatDau(0, mess);
    } else {
        var value_date = value.split('-');
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess = '';
        var res = 0;
        var eighteenYearsAgo = moment().subtract(18, 'years');
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess = 'Không đúng định dạng ngày tháng năm';
        } else {
            mess = '';
            res = 1;
        }
        //var mess='';
        showHiddenNgayBatDau(res, mess);
    }
}

function showHiddenNgayBatDau(res, mess) {
    var error_ngay_bat_dau = $('#error_ngay_bat_dau');
    if (res == 1) {
        error_ngay_bat_dau.hide();
        $('#input_ngay_bat_dau')
            .removeClass('input-error')
            .addClass('valid');
        $('#icon_ngay_bat_dau').removeClass('error-color');
    } else {
        if (res != 0) {
            mess = res;
        }
        $('#input_ngay_bat_dau')
            .addClass('input-error')
            .removeClass('valid');
        $('#icon_ngay_bat_dau').addClass('error-color');
        error_ngay_bat_dau.removeClass('success-color');
        error_ngay_bat_dau.addClass('error-color');
        error_ngay_bat_dau.html(mess);
        error_ngay_bat_dau.show();
    }
}

function removeValueCustomer() {
    $('#input_id_customer').val('');
    $('#input_address')
        .val('')
        .removeClass('valid')
        .addClass('input-error');
    $('#input_phone')
        .val('')
        .removeClass('valid')
        .addClass('input-error');
    $('#input_fax').val('');
    $('#input_email')
        .val('')
        .removeClass('valid')
        .addClass('input-error');
    $('.nhom_khach_hang .chosen-default span').html('Nhóm khách hàng ...');
    $('#input_id_category').val('');
}

function removeValueTour() {
    $('#input_list_price').html('');
    $('#input_id_tour').val('');
    $('#tong_cong').html('');
    $('#tong_cong').html('');
    $('#vat').html('');
    $('#dat_coc_format').html('');
    $('#con_lai').html('');
    $('#input_dat_coc').val('');
    $('#input_price_submit').val(0);
    $('#input_price_m1_submit').val(0);
    $('#input_price_m2_submit').val(0);
    $('#input_price_m3_submit').val(0);
    $('.price_tiep_thi').html('');
    $('#input_id_tour')
        .removeClass('valid')
        .addClass('input-error');
    $('#input_name_tour')
        .removeClass('valid')
        .addClass('input-error');
    $('#input_hoa_hong_thanh_vien_hidden').val('');
    $('#input_hoa_hong_thanh_vien').val('').removeAttr('disabled');
    $('#price_tiep_thi').html('');
    var error_name_tour = $('#error_name_tour');
    error_name_tour.removeClass('success-color');
    error_name_tour.addClass('error-color');
    error_name_tour.html('Bạn vui lòng nhập và chọn tour');
    error_name_tour.show();

    //$('.table_booking_tour').html('');
    $('#input_price').val(0);
    $('#input_price_format').val('0 vnđ');
    $('#input_price_tre_em_m1').val(0);
    $('#input_price_tre_em_m2').val(0);
    $('#input_price_tre_em_m3').val(0);
    $('#input_price_old').val(0);
    $('#input_price_tre_em_m1_old').val(0);
    $('#input_price_tre_em_m2_old').val(0);
    $('#input_price_tre_em_m1_old').val(0);
    $('#name_tour_table').html('');
    var type_tour=$('.type_tour').val();
    _returnDefailBangGia();
    tinh_tong_tien(type_tour);
}

function removeValueUser() {
    $('.table_booking_user').html('');
    $('#input_id_user').val('');
    $('#input_id_user')
        .removeClass('valid')
        .addClass('input-error');
    $('#input_name_user')
        .removeClass('valid')
        .addClass('input-error');
    var error_name_user = $('#error_name_user');
    error_name_user.removeClass('success-color');
    error_name_user.addClass('error-color');
    error_name_user.html('Bạn vui lòng nhập và chọn sales');
    error_name_user.show();
}

function removeValueDieuhanh() {
    $('.table_booking_dieuhanh').html('');
    $('#input_dieuhanh_id').val('');
    $('#input_dieuhanh_id')
        .removeClass('valid')
        .addClass('input-error');
    $('#input_name_dieuhanh')
        .removeClass('valid')
        .addClass('input-error');
    var error_name_dieuhanh = $('#error_name_dieuhanh');
    error_name_dieuhanh.removeClass('success-color');
    error_name_dieuhanh.addClass('error-color');
    error_name_dieuhanh.html('Bạn vui lòng nhập và chọn điều hành');
    error_name_dieuhanh.show();
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

function returnDanhSachDoan() {
    var numbe_1 = parseInt($('#input_num_nguoi_lon').val());
    var numbe_2 = parseInt($('#input_num_tre_em').val());
    var numbe_3 = parseInt($('#input_num_tre_em_5').val());

    //var id=$(id_field).attr('id_title');
    var name_1 = $('#name_price_nguoi_lon').html();
    var name_2 = $('#name_price_tre_em_511').html();
    var name_3 = $('#name_price_tre_em_5').html();
    if (numbe_1 == 0) {
        numbe_1 = 1;
        $('#input_num_nguoi_lon').val(1);
    }

    var so_cho = $('#input_so_cho').val();
    var check_show_table = true;
    var total = numbe_1 + numbe_2 + numbe_3;
    //$('#input_total_num').val(total);
    if (so_cho != undefined) {
        so_cho = parseInt(so_cho);
        if (total > so_cho) {
            check_show_table = false;
            $('#input_num_nguoi_lon')
                .addClass('input-error')
                .removeClass('valid');
            $('#error_so_nguoi')
                .show()
                .html('Số người bạn vừa nhập đã vượt quá số chỗ, bạn vui lòng nhập lại số người');
        } else {
            check_show_table = true;
            $('#input_num_nguoi_lon')
                .addClass('valid')
                .removeClass('input-error');
            $('#error_so_nguoi')
                .hide()
                .html('Bạn vui lòng kiểm tra lại số người');
        }
    }
    var row = '';
    var stt = 1;
    var price = $('#input_price').val();
    if (price === '' || price === 0) {
        price === 'Liên hệ';
    }
    var price_2 = $('#input_price_511').val();
    if (price_2 === '' || price_2 === 0) {
        price_2 == price;
    }
    var price_3 = $('#input_price_5').val();
    if (price_3 === '' || price_3 === 0) {
        price_3 == price;
    }
    var total_nguoi_lon = 0;
    var ti_le_nguoi_lon = '';
    if (check_show_table == true) {
        $('.show_hide_table').html('');
        if (numbe_1 > 0) {
            if (price === 'Liên hệ') {
                total_nguoi_lon = 'Liên hệ';
                var price_item = 'Liên hệ';
            } else {
                var price_item = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                total_nguoi_lon = price * numbe_1;
            }

            if (numbe_1 > 1) {
                var price_in_array = $('#input_price_nguoi_lon_' + numbe_1).val();
                alert(price_in_array);

                //alert(price_in_array);
                if (price_in_array != undefined) {
                    if (price_in_array === 'Liên hệ') {
                        total_nguoi_lon = 'Liên hệ';
                    } else {
                        price_item = price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                        total_nguoi_lon = price_in_array * numbe_1;

                        ti_le_nguoi_lon = (price - price_in_array) / price * 100;
                        ti_le_nguoi_lon = Math.round(ti_le_nguoi_lon);
                        if (ti_le_nguoi_lon != 0) {
                            ti_le_nguoi_lon = '(<i class="fa fa-long-arrow-down"></i>' + ti_le_nguoi_lon + '%)';
                        } else {
                            ti_le_nguoi_lon = '';
                        }
                    }
                } else {
                    var price_tu = $('#input_price_nguoi_lon_tu').val();
                    if (price_tu != undefined) {
                        if (parseInt(numbe_1) >= parseInt(price_tu)) {
                            var price_in_array = $('#input_price_nguoi_lon_lon_hon_' + price_tu).val();
                            if (price_in_array === 'Liên hệ') {
                                total_nguoi_lon = 'Liên hệ';
                            } else {
                                price_item = price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                                total_nguoi_lon = price_in_array * numbe_1;

                                ti_le_nguoi_lon = (price - price_in_array) / price * 100;
                                ti_le_nguoi_lon = Math.round(ti_le_nguoi_lon);
                                if (ti_le_nguoi_lon != 0) {
                                    ti_le_nguoi_lon = '(<i class="fa fa-long-arrow-down"></i>' + ti_le_nguoi_lon + '%)';
                                } else {
                                    ti_le_nguoi_lon = '';
                                }
                            }
                        }
                    }
                }
            }
            for (var i = 1; i <= numbe_1; i++) {
                row =
                    row +
                    '<tr id="row_customer_' +
                    stt +
                    '"><td class="center stt_cus">' +
                    stt +
                    '</td>' +
                    '<td><input style="height: 30px" name="name_customer_sub[]" id="input_name_customer_sub_' +
                    stt +
                    '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="birthday_customer[]" id="input_birthday_customer_sub_' +
                    stt +
                    '" type="date" placeholder="dd/MM/yyyy" class="valid input_table datepicker"></td>' +
                    '<td><input style="height: 30px" name="email_customer[]" id="input_email_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="phone_customer[]" id="input_phone_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" name="address_customer[]" id="input_address_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="1"  id="input_tuoi_number_customer_' +
                    stt +
                    '" type="text"  class="valid input_table">' +
                    '<input hidden value="' +
                    name_1 +
                    '"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' +
                    stt +
                    '" type="text" class="valid input_table"><span style="font-size: 12px;">' +
                    name_1 +
                    '</span></td>' +
                    '<td><input style="height: 30px" name="passport_customer[]" id="input_passport_customer_' +
                    stt +
                    '" type="text" class="valid input_table "></td>' +
                    '<td><input style="height: 30px" name="date_passport_customer[]" id="input_date_passport_customer_' +
                    stt +
                    '" type="date" class="valid input_table datepicker"></td>' +
                    '<td style="width: 130px"><span style="font-size: 12px;color: red">' +
                    price_item +
                    ' ' +
                    ti_le_nguoi_lon +
                    '</span></td>' +
                    '</tr>';
                stt = stt + 1;
            }
        }
        var ti_le_tre_em_511 = '';
        var total_tre_em_511 = 0;
        if (numbe_2 > 0) {
            if (price_2 === 'Liên hệ') {
                total_tre_em_511 = 'Liên hệ';
                var price_item = 'Liên hệ';
            } else {
                var price_item = price_2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                total_tre_em_511 = price_2 * numbe_2;
            }
            if (numbe_2 > 1) {
                var price_in_array = $('#input_price_tre_em_511_' + numbe_2).val();
                if (price_in_array != undefined) {
                    if (price_in_array === 'Liên hệ') {
                        total_tre_em_511 = 'Liên hệ';
                    } else {
                        price_item = price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                        total_tre_em_511 = price_in_array * numbe_2;

                        ti_le_tre_em_511 = (price_2 - price_in_array) / price_2 * 100;
                        ti_le_tre_em_511 = Math.round(ti_le_tre_em_511);
                        if (ti_le_tre_em_511 != 0) {
                            ti_le_tre_em_511 = '(<i class="fa fa-long-arrow-down"></i>' + ti_le_tre_em_511 + '%)';
                        } else {
                            ti_le_tre_em_511 = '';
                        }
                    }
                } else {
                    var price_tu = $('#input_price_tre_em_511_tu').val();
                    if (price_tu != undefined) {
                        if (parseInt(numbe_2) >= parseInt(price_tu)) {
                            var price_in_array = $('#input_price_tre_em_511_lon_hon_' + price_tu).val();
                            if (price_in_array === 'Liên hệ') {
                                total_tre_em_511 = 'Liên hệ';
                            } else {
                                price_item = price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                                total_tre_em_511 = price_in_array * numbe_2;

                                ti_le_tre_em_511 = (price_2 - price_in_array) / price_2 * 100;
                                ti_le_tre_em_511 = Math.round(ti_le_tre_em_511);
                                if (ti_le_tre_em_511 != 0) {
                                    ti_le_tre_em_511 =
                                        '(<i class="fa fa-long-arrow-down"></i>' + ti_le_tre_em_511 + '%)';
                                } else {
                                    ti_le_tre_em_511 = '';
                                }
                            }
                        }
                    }
                }
            }

            for (var j = 1; j <= numbe_2; j++) {
                row =
                    row +
                    '<tr id="row_customer_' +
                    stt +
                    '"><td class="center stt_cus">' +
                    stt +
                    '</td>' +
                    '<td><input style="height: 30px" name="name_customer_sub[]" id="input_name_customer_sub_' +
                    stt +
                    '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="birthday_customer[]" id="input_birthday_customer_sub_' +
                    stt +
                    '" type="date" class="valid input_table datepicker"></td>' +
                    '<td><input style="height: 30px" name="email_customer[]" id="input_email_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="phone_customer[]" id="input_phone_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" name="address_customer[]" id="input_address_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="2"  id="input_tuoi_number_customer_' +
                    stt +
                    '" type="text"  class="valid input_table">' +
                    '<input hidden value="' +
                    name_2 +
                    '"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' +
                    stt +
                    '" type="text" class="valid input_table"><span style="font-size: 12px;">' +
                    name_2 +
                    '</span></td>' +
                    '<td><input style="height: 30px" name="passport_customer[]" id="input_passport_customer_' +
                    stt +
                    '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" name="date_passport_customer[]" id="input_date_passport_customer_' +
                    stt +
                    '" type="date"class="valid input_table datepicker"></td>' +
                    '<td><span style="font-size: 12px;color: red">' +
                    price_item +
                    ' ' +
                    ti_le_tre_em_511 +
                    '</span></td>' +
                    '</tr>';
                stt = stt + 1;
            }
        }
        var ti_le_tre_em_5 = '';
        var total_tre_em_5 = 0;
        if (numbe_3 > 0) {
            if (price_3 === 'Liên hệ') {
                total_tre_em_5 = 'Liên hệ';
                var price_item = 'Liên hệ';
            } else {
                var price_item = price_3.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                total_tre_em_5 = price_3 * numbe_3;
            }
            if (numbe_3 > 1) {
                var price_in_array = $('#input_price_tre_em_5_' + numbe_3).val();
                if (price_in_array != undefined) {
                    if (price_in_array === 'Liên hệ') {
                        total_tre_em_5 = 'Liên hệ';
                    } else {
                        price_item = price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                        total_tre_em_5 = price_in_array * numbe_3;

                        ti_le_tre_em_5 = (price_3 - price_in_array) / price_3 * 100;
                        ti_le_tre_em_5 = Math.round(ti_le_tre_em_5);
                        if (ti_le_tre_em_5 != 0) {
                            ti_le_tre_em_5 = '(<i class="fa fa-long-arrow-down"></i>' + ti_le_tre_em_5 + '%)';
                        } else {
                            ti_le_tre_em_5 = '';
                        }
                    }
                } else {
                    var price_tu = $('#input_price_tre_em_5_tu').val();
                    if (price_tu != undefined) {
                        if (parseInt(numbe_3) >= parseInt(price_tu)) {
                            var price_in_array = $('#input_price_tre_em_5_lon_hon_' + price_tu).val();
                            if (price_in_array === 'Liên hệ') {
                                total_tre_em_5 = 'Liên hệ';
                            } else {
                                price_item = price_in_array.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
                                total_tre_em_5 = price_in_array * numbe_3;

                                ti_le_tre_em_5 = (price_3 - price_in_array) / price_3 * 100;
                                ti_le_tre_em_5 = Math.round(ti_le_tre_em_5);
                                if (ti_le_tre_em_5 != 0) {
                                    ti_le_tre_em_5 = '(<i class="fa fa-long-arrow-down"></i>' + ti_le_tre_em_5 + '%)';
                                } else {
                                    ti_le_tre_em_5 = '';
                                }
                            }
                        }
                    }
                }
            }
            for (var k = 1; k <= numbe_3; k++) {
                row =
                    row +
                    '<tr id="row_customer_' +
                    stt +
                    '"><td class="center stt_cus">' +
                    stt +
                    '</td>' +
                    '<td><input style="height: 30px" name="name_customer_sub[]" id="input_name_customer_sub_' +
                    stt +
                    '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="birthday_customer[]" id="input_birthday_customer_sub_' +
                    stt +
                    '" type="date" class="valid input_table datepicker"></td>' +
                    '<td><input style="height: 30px" name="email_customer[]" id="input_email_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" name="phone_customer[]" id="input_phone_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" name="address_customer[]" id="input_address_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="3"  id="input_tuoi_number_customer_' +
                    stt +
                    '" type="text"  class="valid input_table">' +
                    '<input hidden value="' +
                    name_3 +
                    '"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' +
                    stt +
                    '" type="text" class="valid input_table"><span style="font-size: 12px;">' +
                    name_3 +
                    '</span></td>' +
                    '<td><input style="height: 30px" name="passport_customer[]" id="input_passport_customer_' +
                    stt +
                    '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" name="date_passport_customer[]" id="input_date_passport_customer_' +
                    stt +
                    '" type="date"class="valid input_table datepicker"></td>' +
                    '<td><span style="font-size: 12px;color: red">' +
                    price_item +
                    ' ' +
                    ti_le_tre_em_5 +
                    '</span></td>' +
                    '</tr>';
                stt = stt + 1;
            }
        }

        $('.show_hide_table').html(row);

        if (total_nguoi_lon === 'Liên hệ' || total_tre_em_511 === 'Liên hệ' || total_tre_em_5 === 'Liên hệ') {
            $('#amount_total').html('Liên hệ');
        } else {
            var total_price = total_nguoi_lon + total_tre_em_511 + total_tre_em_5;
            total_price = total_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            $('#amount_total').html(total_price);
        }
    }
}

function returnGenDanhSachDoan() {
    var price = $('#input_price_submit').val();
    if (price == '') {
        price = 0;
        $('#input_price_submit').val(0);
    }
    var price_2 = $('#input_price_m1_submit').val();
    if (price_2 == '') {
        price_2 = 0;
        $('#input_price_m1_submit').val(0);
    }
    var price_3 = $('#input_price_m2_submit').val();
    if (price_3 == '') {
        price_3 = 0;
        $('#input_price_m2_submit').val(0);
    }
    var price_4 = $('#input_price_m3_submit').val();
    if (price_4 == '') {
        price_4 = 0;
        $('#input_price_m3_submit').val(0);
    }

    var numbe_1 = parseInt($('#input_num_nguoi_lon').val());
    var numbe_2 = parseInt($('#input_num_tre_em_m1').val());
    var numbe_3 = parseInt($('#input_num_tre_em_m2').val());
    var numbe_4 = parseInt($('#input_num_tre_em_m3').val());

    //var id=$(id_field).attr('id_title');
    var name_price_nguoi_lon = $('#name_price_nguoi_lon').html();
    var name_price_tre_em_m1 = $('#name_price_tre_em_m1').html();
    var name_price_tre_em_m2 = $('#name_price_tre_em_m2').html();
    var name_price_tre_em_m3 = $('#name_price_tre_em_m3').html();

    var so_cho = $('#input_so_cho').val();
    var check_show_table = true;
    var total = numbe_1 + numbe_2 + numbe_3 + numbe_4;
    //$('#input_total_num').val(total);
    if (so_cho != undefined) {
        so_cho = parseInt(so_cho);
        if (total > so_cho) {
            check_show_table = false;
            $('#input_num_nguoi_lon')
                .addClass('input-error')
                .removeClass('valid');
            $('#error_so_nguoi')
                .show()
                .html('Số người bạn vừa nhập đã vượt quá số chỗ, bạn vui lòng nhập lại số người');
        } else {
            check_show_table = true;
            $('#input_num_nguoi_lon')
                .addClass('valid')
                .removeClass('input-error');
            $('#error_so_nguoi')
                .hide()
                .html('Bạn vui lòng kiểm tra lại số người');
        }
    }
    var row = '';
    var stt = 1;

    if (check_show_table == true) {
        if (numbe_1 > 0) {
            if (price === 'Liên hệ') {
                var price_item = 'Liên hệ';
            } else {
                var price_item = price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            }
            for (var i = 1; i <= numbe_1; i++) {
                var name_customer_sub = '';
                if ($('#input_name_customer_sub_' + stt).length) {
                    name_customer_sub = $('#input_name_customer_sub_' + stt).val();
                }
                var birthday_customer = '';
                if ($('#input_birthday_customer_sub_' + stt).length) {
                    birthday_customer = $('#input_birthday_customer_sub_' + stt).val();
                }
                var email_customer = '';
                if ($('#input_email_customer_' + stt).length) {
                    email_customer = $('#input_email_customer_' + stt).val();
                }
                var phone_customer = '';
                if ($('#input_phone_customer_' + stt).length) {
                    phone_customer = $('#input_phone_customer_' + stt).val();
                }
                var address_customer = '';
                if ($('#input_phone_customer_' + stt).length) {
                    address_customer = $('#input_address_customer_' + stt).val();
                }
                var tuoi_customer = '';
                if ($('#input_tuoi_customer_' + stt).length) {
                    tuoi_customer = $('#input_tuoi_customer_' + stt).val();
                }
                if (tuoi_customer == '') {
                    tuoi_customer = name_price_nguoi_lon;
                }
                var passport_customer = '';
                if ($('#input_passport_customer_' + stt).length) {
                    passport_customer = $('#input_passport_customer_' + stt).val();
                }
                var date_passport_customer = '';
                if ($('#input_date_passport_customer_' + stt).length) {
                    date_passport_customer = $('#input_date_passport_customer_' + stt).val();
                }
                row =
                    row +
                    '<tr id="row_customer_' +
                    stt +
                    '"><td class="center stt_cus">' +
                    stt +
                    '</td>' +
                    '<td><input style="height: 30px" value="' +
                    name_customer_sub +
                    '" name="name_customer_sub[]" id="input_name_customer_sub_' +
                    stt +
                    '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    birthday_customer +
                    '" name="birthday_customer[]" id="input_birthday_customer_sub_' +
                    stt +
                    '" type="date"  class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    email_customer +
                    '" name="email_customer[]" id="input_email_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    phone_customer +
                    '" name="phone_customer[]" id="input_phone_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px"  value="' +
                    address_customer +
                    '" name="address_customer[]" id="input_address_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px"  name="tuoi_number_customer[]" value="1"  id="input_tuoi_number_customer_' +
                    stt +
                    '" type="text"  class="valid input_table">' +
                    '<input  value="' +
                    tuoi_customer +
                    '" style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' +
                    stt +
                    '" type="text" class="valid input_table">' +
                    '<td><input style="height: 30px" value="' +
                    passport_customer +
                    '" name="passport_customer[]" id="input_passport_customer_' +
                    stt +
                    '" type="text" class="valid input_table "></td>' +
                    '<td><input style="height: 30px" value="' +
                    date_passport_customer +
                    '" name="date_passport_customer[]" id="input_date_passport_customer_' +
                    stt +
                    '" type="date" class="valid input_table"></td>' +
                    '<td style="width: 150px"><span style="font-size: 12px;color: red">' +
                    price_item +
                    '</span></td>' +
                    '</tr>';
                stt = stt + 1;
            }
        }
        if (numbe_2 > 0) {
            if (price === 'Liên hệ') {
                var price_item = 'Liên hệ';
            } else {
                var price_item = price_2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            }
            for (var j = 1; j <= numbe_2; j++) {
                var name_customer_sub = '';
                if ($('#input_name_customer_sub_' + stt).length) {
                    name_customer_sub = $('#input_name_customer_sub_' + stt).val();
                }
                var birthday_customer = '';
                if ($('#input_birthday_customer_sub_' + stt).length) {
                    birthday_customer = $('#input_birthday_customer_sub_' + stt).val();
                }
                var email_customer = '';
                if ($('#input_email_customer_' + stt).length) {
                    email_customer = $('#input_email_customer_' + stt).val();
                }
                var phone_customer = '';
                if ($('#input_phone_customer_' + stt).length) {
                    phone_customer = $('#input_phone_customer_' + stt).val();
                }
                var address_customer = '';
                if ($('#input_phone_customer_' + stt).length) {
                    address_customer = $('#input_address_customer_' + stt).val();
                }
                var tuoi_customer = '';
                if ($('#input_tuoi_customer_' + stt).length) {
                    tuoi_customer = $('#input_tuoi_customer_' + stt).val();
                }
                if (tuoi_customer == '') {
                    tuoi_customer = name_price_tre_em_m1;
                }
                var passport_customer = '';
                if ($('#input_passport_customer_' + stt).length) {
                    passport_customer = $('#input_passport_customer_' + stt).val();
                }
                var date_passport_customer = '';
                if ($('#input_date_passport_customer_' + stt).length) {
                    date_passport_customer = $('#input_date_passport_customer_' + stt).val();
                }
                row =
                    row +
                    '<tr id="row_customer_' +
                    stt +
                    '"><td class="center stt_cus">' +
                    stt +
                    '</td>' +
                    '<td><input style="height: 30px" value="' +
                    name_customer_sub +
                    '" name="name_customer_sub[]" id="input_name_customer_sub_' +
                    stt +
                    '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    birthday_customer +
                    '" name="birthday_customer[]" id="input_birthday_customer_sub_' +
                    stt +
                    '" type="date" class="valid input_table date-picker" data-date-format="dd-mm-yyyy"></td>' +
                    '<td><input style="height: 30px" value="' +
                    email_customer +
                    '" name="email_customer[]" id="input_email_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    phone_customer +
                    '" name="phone_customer[]" id="input_phone_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" value="' +
                    address_customer +
                    '" name="address_customer[]" id="input_address_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px"  name="tuoi_number_customer[]" value="2"  id="input_tuoi_number_customer_' +
                    stt +
                    '" type="text"  class="valid input_table">' +
                    '<input   value="' +
                    tuoi_customer +
                    '"  style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' +
                    stt +
                    '" type="text" class="valid input_table">' +
                    '<td><input style="height: 30px" value="' +
                    passport_customer +
                    '" name="passport_customer[]" id="input_passport_customer_' +
                    stt +
                    '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" value="' +
                    date_passport_customer +
                    '" name="date_passport_customer[]" id="input_date_passport_customer_' +
                    stt +
                    '" type="date" class="valid input_table date-picker"></td>' +
                    '<td style="width: 150px"><span style="font-size: 12px;color: red">' +
                    price_item +
                    '</span></td>' +
                    '</tr>';
                stt = stt + 1;
            }
        }
        if (numbe_3 > 0) {
            if (price === 'Liên hệ') {
                var price_item = 'Liên hệ';
            } else {
                var price_item = price_3.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
            }
            for (var k = 1; k <= numbe_3; k++) {
                var name_customer_sub = '';
                if ($('#input_name_customer_sub_' + stt).length) {
                    name_customer_sub = $('#input_name_customer_sub_' + stt).val();
                }
                var birthday_customer = '';
                if ($('#input_birthday_customer_sub_' + stt).length) {
                    birthday_customer = $('#input_birthday_customer_sub_' + stt).val();
                }
                var email_customer = '';
                if ($('#input_email_customer_' + stt).length) {
                    email_customer = $('#input_email_customer_' + stt).val();
                }
                var phone_customer = '';
                if ($('#input_phone_customer_' + stt).length) {
                    phone_customer = $('#input_phone_customer_' + stt).val();
                }
                var address_customer = '';
                if ($('#input_phone_customer_' + stt).length) {
                    address_customer = $('#input_address_customer_' + stt).val();
                }
                var tuoi_customer = '';
                if ($('#input_tuoi_customer_' + stt).length) {
                    tuoi_customer = $('#input_tuoi_customer_' + stt).val();
                }
                if (tuoi_customer == '') {
                    tuoi_customer = name_price_tre_em_m2;
                }
                var passport_customer = '';
                if ($('#input_passport_customer_' + stt).length) {
                    passport_customer = $('#input_passport_customer_' + stt).val();
                }
                var date_passport_customer = '';
                if ($('#input_date_passport_customer_' + stt).length) {
                    date_passport_customer = $('#input_date_passport_customer_' + stt).val();
                }
                row =
                    row +
                    '<tr id="row_customer_' +
                    stt +
                    '"><td class="center stt_cus">' +
                    stt +
                    '</td>' +
                    '<td><input style="height: 30px" value="' +
                    name_customer_sub +
                    '" name="name_customer_sub[]" id="input_name_customer_sub_' +
                    stt +
                    '" type="text"class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    birthday_customer +
                    '" name="birthday_customer[]" id="input_birthday_customer_sub_' +
                    stt +
                    '" type="date" class="valid input_table date-picker"></td>' +
                    '<td><input style="height: 30px" value="' +
                    email_customer +
                    '" name="email_customer[]" id="input_email_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input style="height: 30px" value="' +
                    phone_customer +
                    '" name="phone_customer[]" id="input_phone_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td><input  style="height: 30px" value="' +
                    address_customer +
                    '" name="address_customer[]" id="input_address_customer_' +
                    stt +
                    '" type="text" class="valid input_table"></td>' +
                    '<td>' +
                    '<input hidden style="height: 30px" name="tuoi_number_customer[]" value="3"  id="input_tuoi_number_customer_' +
                    stt +
                    '" type="text"  class="valid input_table">' +
                    '<input  value="' +
                    tuoi_customer +
                    '" style="height: 30px" name="tuoi_customer[]" id="input_tuoi_customer_' +
                    stt +
                    '" type="text" class="valid input_table">' +
                    '<td><input style="height: 30px" value="' +
                    passport_customer +
                    '" name="passport_customer[]" id="input_passport_customer_' +
                    stt +
                    '" type="text"class="valid input_table "></td>' +
                    '<td><input style="height: 30px" value="' +
                    date_passport_customer +
                    '" name="date_passport_customer[]" id="input_date_passport_customer_' +
                    stt +
                    '" type="date" class="valid input_table date-picker" data-date-format="dd-mm-yyyy"></td>' +
                    '<td style="width: 150px"><span style="font-size: 12px;color: red">' +
                    price_item +
                    '</span></td>' +
                    '</tr>';
                stt = stt + 1;
            }
        }
        $('.show_hide_table').html('');
        $('.show_hide_table').html(row);
        returnTinhTien(price, price_2, price_3);
    }
}

function returnTinhTien(price_nguoi_lon, price_tre_em_511, price_tre_em_5) {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    //var price_nguoi_lon = $('#input_price').val();
    //var price_tre_em_511 = $('#input_price_511').val();
    //var price_tre_em_5 = $('#input_price_5').val();
    // var number_nguoi_lon = $('#input_num_nguoi_lon').val();
    // var number_tre_em_511 = $('#input_num_tre_em').val();
    // var number_tre_em_5 = $('#input_num_tre_em_5').val();
    // if (price_nguoi_lon == 'Liên hệ') {
    //     price_nguoi_lon = 0;
    // }
    // if (price_tre_em_511 == 'Liên hệ') {
    //     price_tre_em_511 = 0;
    // }
    // if (price_tre_em_5 == 'Liên hệ') {
    //     price_tre_em_5 = 0;
    // }

    // if (numberRegex.test(price_nguoi_lon) && numberRegex.test(price_tre_em_511) && numberRegex.test(price_tre_em_5)) {
    //     if (number_nguoi_lon > 0 && number_nguoi_lon != '') {
    //         if (price_nguoi_lon == undefined) {
    //             lnv.alert({
    //                 title: 'Lỗi',
    //                 content: 'Bạn vui lòng chọn tour',
    //                 alertBtnText: 'Ok',
    //                 iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
    //                 alertHandler: function() {
    //                     $('#input_name_tour')
    //                         .show()
    //                         .focus()
    //                         .select();
    //                 }
    //             });
    //         } else {
    //             var con_lai = 0;
    //             var total = 0;
    //             if (number_tre_em_511 == '') {
    //                 number_tre_em_511 = 0;
    //             }
    //             if (number_tre_em_5 == '') {
    //                 number_tre_em_5 = 0;
    //             }
    //             var total_nguoi_lon = parseInt(number_nguoi_lon) * parseInt(price_nguoi_lon);
    //             var total_tre_em_511 = parseInt(number_tre_em_511) * parseInt(price_tre_em_511);
    //             var total_tre_em_5 = parseInt(number_tre_em_5) * parseInt(price_tre_em_5);
    //             total = total_nguoi_lon + total_tre_em_511 + total_tre_em_5;
    //             var vat = 0;
    //             if ($('#input_vat').is(':checked')) {
    //                 vat = total * 0.1;
    //                 vat = parseFloat(total * 0.1);
    //                 vat = Math.round(vat * 1000) / 1000;
    //             }
    //             con_lai = total + vat;
    //             var dat_coc = $('#input_dat_coc').val();
    //             if (dat_coc != '' && dat_coc > 0) {
    //                 dat_coc = dat_coc.toString().split(',');
    //                 dat_coc = dat_coc.toString().split('.');
    //                 if (parseInt(dat_coc) > con_lai) {
    //                     lnv.alert({
    //                         title: 'Lỗi',
    //                         content: 'Tiền đặt cọc đã vượt quá số tiền phải thanh toán, vui lòng nhập lại',
    //                         alertBtnText: 'Ok',
    //                         iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
    //                         alertHandler: function() {
    //                             $('#input_dat_coc')
    //                                 .show()
    //                                 .focus()
    //                                 .select()
    //                                 .val(0);
    //                         }
    //                     });
    //                 } else {
    //                     con_lai = con_lai - parseInt(dat_coc);
    //                 }
    //             }
    //             var tong_cong = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    //             $('#tong_cong').html(tong_cong);
    //             var vat_format = vat.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    //             $('#vat').html(vat_format);

    //             var con_lai_format = con_lai.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' vnđ';
    //             $('#con_lai').html(con_lai_format);
    //         }
    //     } else {
    //         lnv.alert({
    //             title: 'Lỗi',
    //             content: 'Bạn vui lòng nhập số người trước khi tính tiền',
    //             alertBtnText: 'Ok',
    //             iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
    //             alertHandler: function() {}
    //         });
    //     }
    // } else {
    //     lnv.alert({
    //         title: 'Lỗi',
    //         content: 'Bạn vui lòng kiểm tra đơn giá',
    //         alertBtnText: 'Ok',
    //         iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
    //         alertHandler: function() {
    //             $('#input_name_tour')
    //                 .show()
    //                 .focus()
    //                 .select();
    //         }
    //     });
    // }
}