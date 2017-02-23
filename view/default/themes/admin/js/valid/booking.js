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