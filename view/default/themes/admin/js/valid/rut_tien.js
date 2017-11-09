jQuery(function ($) {
    url = $('#url_input').val();
    $('body').on("click",'.row_tr_click', function () {

        var id=$(this).attr('value');
        var email=$(this).attr('email_record');
        var number_email=$('#number_email').html();
        if(id!='' && email!=''&&number_email!=''){

            if($(this).hasClass("success")){

             var check_exit=$('#row_email_'+id).html();
                if(check_exit==undefined){
                    $('#table_list_email_customer').append(" <tbody id='row_email_"+id+"'><tr > <td>"+email+"</td> </tr></tbody>");
                    number_email=parseInt(number_email)+1;
                }
            }else{
                $('#row_email_'+id).remove();
                number_email=parseInt(number_email)-1;
            }
            $('#number_email').html(number_email);
        }else{
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn không thể chọn khách hàng này',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }

    });

    //$('a.show_info').hover(function(e) {
    //    var id=$(this).attr('data-id');
    //    $('div#info_user_'+id).show();
    //}, function() {
    //    $('div.pop-up-table').hide();
    //});

    var moveLeft = -150;
    var moveDown = -150;
    $('body').on("click",'.show_info', function (e) {
        var id=$(this).attr('data-id');
        var name=$(this).attr('data-name');
        if(id && name){
            $('#title_form_detail').html('Thông tin thành viên "'+name+'"');
            var content=$('#info_user_'+id).html();
            $('#content_form_detail').html(content);
        }else{
            $('#modal-form').modal('hide');
        }
    });

    $('body').on("click",'.close_pop_up', function (e) {
        var id=$(this).attr('data-id');
        $('.pop-up-table').hide();
        $('.icon_show').removeClass('fa-compress').addClass('fa-arrows-alt');
        $('.show_info').attr('data-show','show');
        //$('#info_user_'+id).show().css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    });
    $('body').on("click",'.btn_confirm', function (e) {
        var id=$(this).attr('data-id');
        var code=$(this).attr('data-code');
        var name=$(this).attr('data-name');
        if(id && code && name){
            var cmt_yeu_cau=$('#cmt_yeu_cau_'+id).val();
            var price_send_format=$('#price_send_format_'+id).val();
            var price_send=$('#price_send_'+id).val();
            var date_send=$('#date_send_'+id).val();
            $('#title_form_confirm').html('Xác nhận rút tiền cho thành viên "<span class="red">'+name+'</span>"');
            $('#input_send').val(date_send);
            $('#input_yeu_cau').html(cmt_yeu_cau);
            $('#input_price').val(price_send_format);
            $('#input_price_send').val(price_send);
            var currentDate = new Date();
            $("#input_date_confirm").datepicker("setDate",currentDate);
        }else{
            $('#modal-form').modal('hide');
        }
    });

    $('body').on("blur",'#input_price_confirm', function (e) {
        var price_confirm=$(this).val();
        var price_send=$('#input_price_send').val();
        var mess_error='';
        if(price_send!='' && price_send!=''){
            var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
            if (numberRegex.test(price_send)) {
               console.log('Số');
            }else{
                mess_error='Bạn vui lòng ctrl+F5 để thử lại'
            }
        }else{
            if(price_send==''){
                mess_error='Bạn vui lòng ctrl+F5 để thử lại'
            }
            if(price_confirm==''){
                mess_error='Bạn vui lòng xác nhận số tiền'
            }
        }
        if(mess_error!=''){
            lnv.alert({
                title: 'Lỗi',
                content: mess_error,
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                }
            });
        }
    });

});




