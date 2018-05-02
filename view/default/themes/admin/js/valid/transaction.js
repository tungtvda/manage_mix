// show lịch sử giao dịch
$('body').on('click', '.view_lich_su_giao_dich_trans', function () {

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
    var customer_id = $(this).attr('data-customer');
    if (code && id) {
        $('#name-detail-code-booking').html(code);
        $('#save_giao_dich').attr('data-id', id);
        $('#save_giao_dich').attr('data-code', code);
        $('#save_giao_dich').attr('data-customer', customer_id);
        var link = url + '/customer-save-transaction.html';
        $.ajax({
            method: 'GET',
            url: link,
            data: 'id=' + id,
            success: function (response) {
                if (response == 0) {
                    $('#show_red_none_giao_dich')
                        .show()
                        .html('<h4>Customer "' + code + '" không có giao dịch nào<p>');
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
    var value = $('#content_giaodich').val();
    var created = $('#created_giaodich').val();
    var time = $('.time_giaodich').val();
    if (value && created && time) {
        $('#show_mess_content').hide();
        $('#error_created').hide();
        var customer_id = $(this).attr('data-customer');
        var id = $(this).attr('data-id');
        if (customer_id && id) {
            $(this).hide();
            $('#show_loading_btn').show();
            var link = url + '/customer-save-transaction.html';
            $.ajax({
                method: 'POST',
                url: link,
                data: {
                    id: id,
                    customer_id: customer_id,
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