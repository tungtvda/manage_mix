<?php
$string_data_customer=_returnDataAutoCompleteCustomer();

$string_data_tour=_returnDataAutoCompleteTour();

$string_data_user=_returnDataAutoCompleteUser();
$string_data_user_tiep_thi=_returnDataAutoCompleteUserTiepThi();

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

                return '<div data-name-price-4="' + item[20] + '" data-price-4-format="' + item[19] + '" data-price-4="' + item[18] + '" data-price-tiep-thi="' + item[17] + '" data-price-tiep-thi-format="' + item[16] + '" data-so-cho="' + item[15] + '" data-name-price-3="' + item[14] + '" data-price-3-format="' + item[13] + '" data-price-3="' + item[12] + '" data-name-price-2="' + item[11] + '" data-price-2-format="' + item[10] + '" data-price-2="' + item[9] + '" data-name-price="' + item[8] + '" title="' + item[0] + '-'+item[3]+'-'+item[4]+'" class="autocomplete-suggestion" data-departure_name="' + item[6] + '" data-vehicle="' + item[4] + '" data-durations="' + item[3] + '" data-name="' + item[1] + '" data-price-format="' + item[2] + '" data-price="' + item[7] + '" data-id="' + item[0] + '" > ' + item[1]+'</div>';
            },
            onSelect: function (e, term, item) {
                $('#input_list_price').html();
                var so_cho='';
                if(item.data('so-cho')!=''){
                    so_cho="<input hidden  id='input_so_cho' value='"+item.data('so-cho')+"'>"+item.data('so-cho');
                }
//                console.log('Item "' + item.data('langname') + ' (' + item.data('lang') + ')" selected by ' + (e.type == 'keydown' ? 'pressing enter or tab' : 'mouse click') + '.');
                $('#input_name_tour').val(item.data('name'));

                $('#input_price_submit').val(item.data('price'));
                $('#input_price_m1_submit').val(item.data('price-2'));
                $('#input_price_m2_submit').val(item.data('price-3'));
                $('#input_price_m3_submit').val(item.data('price-4'));

                $('#name_price_nguoi_lon').html(item.data('name-price'));
                $('#name_price_tre_em_m1').html(item.data('name-price-2'));
                $('#name_price_tre_em_m2').html(item.data('name-price-3'));
                $('#name_price_tre_em_m3').html(item.data('name-price-4'));

                $('.price_tiep_thi').html('<b class="red">'+item.data('price-tiep-thi-format')+'</b>');
                $('#input_hoa_hong_thanh_vien').val(item.data('price-tiep-thi'));
                if(item.data('price-tiep-thi')){
                    $('#input_hoa_hong_thanh_vien').attr('disabled','disabled')
                }else{
                    $('#input_hoa_hong_thanh_vien').removeAttr('disabled');
                }
                var Id=item.data('id');
                var url = $('#url_input').val();
                var table_tour="<tr> <td class='center'>1</td><td><a id='name_tour_table'>"+item.data('name')+"</a></td><td>" +
                    "<span id='price_format_span'>"+item.data('price-format')+"</span>" +
                    "<input hidden id='input_price_format' value='"+item.data('price-format')+"'>" +
                    "<input  hidden title='giá sửa' id='input_price' value='"+item.data('price')+"'>" +
                    "<input hidden id='input_price_old' title='giá cũ' value='"+item.data('price')+"'> " +
                    " | <a id='edit_price' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td> " +
                    "<td>" +
                    "<span id='price_format_span_tre_em_m1'>"+item.data('price-2-format')+"</span>" +
                    "<input hidden title='giá sửa' id='input_price_tre_em_m1' value='"+item.data('price-2')+"'>" +
                    "<input hidden id='input_price_tre_em_m1_old' title='giá cũ' value='"+item.data('price-2')+"'> " +
                    " | <a id='edit_price_tre_em_m1' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price_tre_em_m1' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td><td>" +
                    "<span id='price_format_span_tre_em_m2'>"+item.data('price-3-format')+"</span>" +
                    "<input hidden title='giá sửa' id='input_price_tre_em_m2' value='"+item.data('price-3')+"'>" +
                    "<input hidden id='input_price_tre_em_m2_old' title='giá cũ' value='"+item.data('price-3')+"'> " +
                    " | <a id='edit_price_tre_em_m2' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price_tre_em_m2' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td><td>"+
                    "<span id='price_format_span_tre_em_m3'>"+item.data('price-4-format')+"</span>" +
                    "<input hidden title='giá sửa' id='input_price_tre_em_m3' value='"+item.data('price-4')+"'>" +
                    "<input hidden id='input_price_tre_em_m3_old' title='giá cũ' value='"+item.data('price-4')+"'> " +
                    " | <a id='edit_price_tre_em_m3' href='javascript:void(0)'> <i class='fa fa-edit' title='Sửa đơn giá'></i></a>" +
                    "<a id='reset_price_tre_em_m3' title='Lấy lại giá cũ' href='javascript:void(0)'> <i class='fa fa-refresh' title='Giá gốc'></i></a>" +
                    "</td>"+
                    "<td style='color:red'>" +so_cho+
                    "</td></tr>";
                $('.table_booking_tour').html(table_tour);
//                $('#tong_cong').html('');
//                $('#vat').html('');
//                $('#dat_coc_format').html('');
//                $('#con_lai').html('');
                $('#dat_coc').val('');
                $('#input_id_tour').val(item.data('id'));
                if(item.data('id')!=''){
                    $('#input_id_tour').removeClass("input-error").addClass("valid");
                    $("#error_name_tour").hide();
                    $('#icon_error_name_tour').hide();
                    $('#input_name_tour').removeClass("input-error").addClass("valid");
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
                var so_cho=$('#input_so_cho').val();
                var check_show_table=true;
                var total=input_num_nguoi_lon+input_num_tre_em_m1+input_num_tre_em_m2+input_num_tre_em_m3;
                if(so_cho!=undefined){
                    so_cho=parseInt(so_cho);
                    if(total>so_cho){
                        $('#input_num_nguoi_lon').addClass("input-error").removeClass("valid");
                        $('#error_so_nguoi').show().html('Số người bạn vừa nhập đã vượt quá số chỗ, bạn vui lòng nhập lại số người');
                    }else{
                        $('#input_num_nguoi_lon').addClass("valid").removeClass("input-error");
                        $('#error_so_nguoi').hide().html('Bạn vui lòng kiểm tra lại số người');
                    }
                }
                var type_tour = $('.type_tour').val();
                tinh_tong_tien(type_tour,input_num_nguoi_lon,input_num_tre_em_m1,input_num_tre_em_m2,input_num_tre_em_m3)
            }
        });
        function tinh_tong_tien(type_tour,input_num_nguoi_lon,input_num_tre_em_m1,input_num_tre_em_m2,input_num_tre_em_m3) {
            if (type_tour ==0) {
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
                $('#con_lai').html(total_price);
            }
        }
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
        $('#input_name_dieuhanh').autoComplete({
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
                $('#input_name_dieuhanh').val(item.data('user_name'));
                $('#input_dieuhanh_id').val(item.data('user_id'));
                var table_user="<tr> <td class='center'>1</td><td><a>"+item.data('user_name')+"</a></td><td>" +
                    "<span >"+item.data('user-email')+"</span>" +
                    "</td> " +
                    "<td>" +
                    "<span>"+item.data('user-phone')+"</span>" +
                    "</td><td>" +
                    "<span >"+item.data('user-phong-ban')+"</span>" +
                    "</td><td>"+item.data('number-tour')+"" +
                    "</td></tr>";
                $('.table_booking_dieuhanh').html(table_user);
                if(item.data('user_id')!=''){
                    $('#input_dieuhanh_id').removeClass("input-error").addClass("valid");
                    $("#error_name_dieuhanh").hide();
                    $('#icon_error_name_dieuhanh').hide();
                    $('#input_name_dieuhanh').removeClass("input-error").addClass("valid");
                }
            }
        });

        $('#input_name_user_tiepthi').autoComplete({
            minChars: 0,
            source: function (term, suggest) {
                term = term.toLowerCase();
                var choices =<?php echo $string_data_user_tiep_thi?>
                var suggestions = [];
                for (i = 0; i < choices.length; i++)
                    if (~(choices[i][0] + ' ' + choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            },
            renderItem: function (item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div title="' + item[1] + '-'+item[2]+'-'+item[3]+'" class="autocomplete-suggestion" data-user-id-tt="' + item[0] + '" data-user-code-tt="' + item[1] + '" data-user-name-tt="' + item[2] + '" data-user-email-tt="' + item[3] + '" data-user-phone-tt="' + item[4] + '"> ' + item[1]+' - ' + item[2]+'  - ' + item[3]+' - '+item[4]+'</div>';
            },
            onSelect: function (e, term, item) {
                $('#input_name_user_tiepthi').val(item.data('user-code-tt'));
                $('#input_id_user_tt').val(item.data('user-id-tt'));
                $('#input_name_thanh_vien').val(item.data('user-name-tt')).attr('disabled','disabled').addClass('valid');
                $('#input_email_thanh_vien').val(item.data('user-email-tt')).attr('disabled','disabled').addClass('valid');
                $('#input_phone_thanh_vien').val(item.data('user-phone-tt')).attr('disabled','disabled').addClass('valid');
            }
        });
    });


</script>
