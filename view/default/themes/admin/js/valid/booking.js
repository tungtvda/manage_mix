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