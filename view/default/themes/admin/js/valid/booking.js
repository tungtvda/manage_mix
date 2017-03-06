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
        var price_old = $('#input_price_old').val();
        var price_format = price_old.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
        $('#input_price_511').val(price_old);
        $('#input_price_511').hide();
        $('#price_format_span_511').show().html(price_format);

    });

    $('body').on("click", '#reset_price_5', function () {
        var price_old = $('#input_price_old').val();
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
        $('#dat_coc_format').html('');
        $('#con_lai').html('');
        $('#input_dat_coc').val('');
    });

    $('body').on("click", '#edit_price_5', function () {
        $('#input_price_5').show().focus().select();
        ;
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
    });

    $('body').on("click", '.btn_add_customer', function () {
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


    $('body').on("click", '#submit_form_action', function () {
        var form_data = $("#submit_form").serializeArray();
        var error_free = true;
        for (var input in form_data) {
            var name_input=form_data[input]['name'];
            if (name_input != "tien_te"&&name_input != "nguon_tour"&&name_input!='category'&&name_input!='nhom_khach_hang'&&name_input!='name_customer_sub[]'&&name_input!='email_customer[]'&&name_input!='phone_customer[]'&&name_input!='address_customer[]') {
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
                    console.log(name_input);
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

    //$('i').ggtooltip();
});
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