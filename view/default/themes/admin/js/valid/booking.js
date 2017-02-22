jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on("input", '#input_name_customner', function () {
        removeValue();
    });
    $('body').on("keyup", '#input_name_customner', function () {
        removeValue();
    });

    //$('i').ggtooltip();
});
function removeValue(){
    $('#input_id_customner').val('');
    $('#input_address').val('');
    $('#input_phone').val('');
    $('#input_fax').val('');
    $('#input_email').val('');
    $(".nhom_khach_hang .chosen-default span").html('Nhóm khách hàng ...');
    $('#input_id_category').val('');
}