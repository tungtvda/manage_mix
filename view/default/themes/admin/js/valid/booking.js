jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on("input", '#input_name_customner', function () {
        removeValueCustomer();
    });
    $('body').on("keyup", '#input_name_customner', function () {
        removeValueCustomer();
    });

    $('body').on("input", '#input_name_tour', function () {
        removeValueTour();
    });
    $('body').on("keyup", '#input_name_tour', function () {
        removeValueTour();
    });

    $('body').on("keyup", '#input_name_tour', function () {
        removeValueTour();
    });

    $('body').on("click", '#reset_price', function () {
       var price_old=$('#input_price_old').val();
        var price_format=$('#input_price_format').val();
        $('#input_price').val(price_old);
        $('#input_price').hide();
        $('#price_format_span').show().html(price_format);

    });
    $('body').on("click", '#edit_price', function () {
        $('#input_price').show().focus().select();;
        $('#price_format_span').hide();
    });
    $('body').on("blur", '#input_price', function () {
        var price=$(this).val();
        var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $('#input_price').hide();
        $('#price_format_span').show().html(price_format);
    });

    $('body').on("click", '.btn_add_customer', function () {
        var row=' <tr id="row_customer_1">' +
            '<td class="center">1</td>' +
            '<td> <span class="input-icon width_100"><input id="input_name_customer_1" class="valid" type="text"  name="name_customer[]"><i class="ace-icon fa fa-user blue"></i></span></td>'+
            '<td><span class="input-icon width_100"> <input id="input_name_customer_1" type="text" class="valid" name="email_customer[]"><i class="ace-icon fa fa-envelope blue"></i> </span></td>'+
            '<td><span class="input-icon width_100"><input id="input_phone_customer_1" class="valid" type="text" name="phone_customer[]"><i class="ace-icon fa fa-phone blue"></i></span></td>'+
            '<td><span class="input-icon width_100"> <input id="address_phone_customer_1" type="text" name="address_customer[]"><i class="ace-icon fa fa-map_marker blue"></i></span></td>'+
            '<td><a id="stt_custommer_1" title="Xóa khách hàng"  class="red btn_remove_customer" href="javascript:void()"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>'+
            '</tr>';
    });


    //$('i').ggtooltip();
});
function removeValueCustomer(){
    $('#input_id_customner').val('');
    $('#input_address').val('');
    $('#input_phone').val('');
    $('#input_fax').val('');
    $('#input_email').val('');
    $(".nhom_khach_hang .chosen-default span").html('Nhóm khách hàng ...');
    $('#input_id_category').val('');
}

function removeValueTour(){
    $('.table_booking_tour').html('');
    $('#input_id_tour').val('');

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