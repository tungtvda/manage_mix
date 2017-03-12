<?php
$string_data_customer=_returnDataAutoCompleteCustomer();

$string_data_tour=_returnDataAutoCompleteTour();

$string_data_user=_returnDataAutoCompleteUser();

?>
<script src="<?php echo SITE_NAME?>/view/default/themes/admin/js/valid/booking.js"></script>
<link rel="stylesheet"
      href="<?php echo SITE_NAME ?>/view/default/themes/admin/js/autoComplete/jquery.auto-complete.css">
<script src="<?php echo SITE_NAME ?>/view/default/themes/admin/js/autoComplete/jquery.auto-complete.js"></script>


<script>
    $(function () {
        $('#hero-demo').autoComplete({
            minChars: 1,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices = ['ActionScript', 'AppleScript', 'Asp', 'Assembly', 'BASIC', 'Batch', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'PowerShell', 'Python', 'Ruby', 'Scala', 'Scheme', 'SQL', 'TeX', 'XML'];
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            }
        });
        $('#input_name_customer').autoComplete({
            minChars: 0,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices =<?php echo $string_data_customer?>
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~(choices[i][0] + ' ' + choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            },
            renderItem: function (item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div title="' + item[0] + '-'+item[3]+'-'+item[4]+'" class="autocomplete-suggestion" data-langname="' + item[0] + '" data-id="' + item[2] + '" data-phone="' + item[4] + '" data-fax="' + item[6] + '" data-cateid="' + item[7] + '" data-catename="' + item[8] + '" data-email="' + item[3] + '" data-address="' + item[5] + '" data-val="' + search + '"><img style="width: 40px; height: 40px" src="' + item[1] + '"> ' + item[0] + '-'+item[3]+'</div>';
            },
            onSelect: function (e, term, item) {
//                console.log('Item "' + item.data('langname') + ' (' + item.data('lang') + ')" selected by ' + (e.type == 'keydown' ? 'pressing enter or tab' : 'mouse click') + '.');

                $("#error_name_customer").hide();
                $('#icon_error_name_customer').hide();
                $('#input_name_customer').removeClass("input-error").addClass("valid");

                if(item.data('email')!=''){
                    $("#error_email").hide();
                    $('#icon_error_email').hide();
                    $('#input_email').removeClass("input-error").addClass("valid");
                }

                if(item.data('phone')!=''){
                    $("#error_phone").hide();
                    $('#icon_error_phone').hide();
                    $('#input_phone').removeClass("input-error").addClass("valid");
                }

                if(item.data('address')!=''){
                    $("#error_address").hide();
                    $('#icon_error_address').hide();
                    $('#input_address').removeClass("input-error").addClass("valid");
                }
                if(item.data('id')!=''){
                    $('#input_id_customer').removeClass("input-error").addClass("valid");
                }

                $('#input_name_customer').val(item.data('langname'));
                $('#input_id_customer').val(item.data('id'));
                $('#input_address').val(item.data('address'));
                $('#input_phone').val(item.data('phone'));
                $('#input_fax').val(item.data('fax'));
                $('#input_email').val(item.data('email'));
                $(".nhom_khach_hang .chosen-default span").html(item.data('catename'));
                $('#input_id_category').val(item.data('cateid'));
            }
        });

        $('#input_name_tour').autoComplete({
            minChars: 0,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices =<?php echo $string_data_tour?>
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~(choices[i][0] + ' ' + choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            },
            renderItem: function (item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div title="' + item[0] + '-'+item[3]+'-'+item[4]+'" class="autocomplete-suggestion" data-departure_name="' + item[6] + '" data-vehicle="' + item[4] + '" data-durations="' + item[3] + '" data-name="' + item[1] + '" data-price-format="' + item[2] + '" data-price="' + item[7] + '" data-id="' + item[0] + '" > ' + item[1]+'</div>';
            },
            onSelect: function (e, term, item) {
//                console.log('Item "' + item.data('langname') + ' (' + item.data('lang') + ')" selected by ' + (e.type == 'keydown' ? 'pressing enter or tab' : 'mouse click') + '.');
                $('#input_name_tour').val(item.data('name'));

                $('#input_price_submit').val(item.data('price'));
                $('#input_price_511_submit').val(item.data('price'));
                $('#input_price_5_submit').val(item.data('price'));
                var table_tour="<tr> <td class='center'>1</td><td><a>"+item.data('name')+"</a></td><td>" +
                    "<span id='price_format_span'>"+item.data('price-format')+"</span>" +
                    "<input hidden id='input_price_format' value='"+item.data('price-format')+"'>" +
                    "<input  hidden title='giá sửa' id='input_price' value='"+item.data('price')+"'>" +
                    "<input hidden id='input_price_old' title='giá cũ' value='"+item.data('price')+"'> " +
                    " | <a id='edit_price' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td> " +
                    "<td>" +
                    "<span id='price_format_span_511'>"+item.data('price-format')+"</span>" +
                    "<input hidden title='giá sửa' id='input_price_511' value='"+item.data('price')+"'>" +
                    " | <a id='edit_price_511' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price_511' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td><td>" +
                    "<span id='price_format_span_5'>"+item.data('price-format')+"</span>" +
                    "<input hidden title='giá sửa' id='input_price_5' value='"+item.data('price')+"'>" +
                    " | <a id='edit_price_5' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price_5' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td><td>"+item.data('departure_name')+"" +
                    "</td></tr>";
                $('.table_booking_tour').html(table_tour);
                $('#tong_cong').html('');
                $('#vat').html('');
                $('#dat_coc_format').html('');
                $('#con_lai').html('');
                $('#dat_coc').val('');
                $('#input_id_tour').val(item.data('id'));
                if(item.data('id')!=''){
                    $('#input_id_tour').removeClass("input-error").addClass("valid");
                    $("#error_name_tour").hide();
                    $('#icon_error_name_tour').hide();
                    $('#input_name_tour').removeClass("input-error").addClass("valid");
                }
            }
        });

        $('#input_name_user').autoComplete({
            minChars: 0,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices =<?php echo $string_data_user?>
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~(choices[i][0] + ' ' + choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            },
            renderItem: function (item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div title="' + item[1] + '-'+item[2]+'-'+item[3]+'" class="autocomplete-suggestion" data-user_id="' + item[0] + '" data-user_name="' + item[1] + '" data-user-email="' + item[2] + '" data-user-phone="' + item[3] + '" data-user-phong-ban="' + item[4] + '" data-number-tour="' + item[5] + '" > ' + item[1]+' - ' + item[2]+'  - ' + item[3]+'</div>';
            },
            onSelect: function (e, term, item) {
                $('#input_name_user').val(item.data('user_name'));
                $('#input_id_user').val(item.data('user_id'));
                var table_user="<tr> <td class='center'>1</td><td><a>"+item.data('user_name')+"</a></td><td>" +
                    "<span >"+item.data('user-email')+"</span>" +
                    "</td> " +
                    "<td>" +
                    "<span>"+item.data('user-phone')+"</span>" +
                    "</td><td>" +
                    "<span >"+item.data('user-phong-ban')+"</span>" +
                    "</td><td>"+item.data('number-tour')+"" +
                    "</td></tr>";
                $('.table_booking_user').html(table_user);
                if(item.data('user_id')!=''){
                    $('#input_id_user').removeClass("input-error").addClass("valid");
                    $("#error_name_user").hide();
                    $('#icon_error_name_user').hide();
                    $('#input_name_user').removeClass("input-error").addClass("valid");
                }
            }
        });
    });


</script>
