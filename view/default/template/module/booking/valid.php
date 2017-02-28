<?php
$string_data_customer=_returnDataAutoCompleteCustomer();

$string_data_tour=_returnDataAutoCompleteTour();

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
                var table_tour="<tr> <td class='center'>1</td><td><a>"+item.data('name')+"</a></td><td><span id='price_format_span'>"+item.data('price-format')+"</span><input hidden id='input_price_format' value='"+item.data('price-format')+"'><input hidden title='giá sửa' id='input_price' value='"+item.data('price')+"'><input hidden id='input_price_old' title='giá cũ' value='"+item.data('price')+"'> <a id='edit_price' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a><a id='reset_price' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a></td> <td>"+item.data('durations')+"</td><td>"+item.data('vehicle')+"</td><td>"+item.data('departure_name')+"</td></tr>";
                $('.table_booking_tour').html(table_tour);
            }
        });
    });


</script>
