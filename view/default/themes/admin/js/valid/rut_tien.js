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
        var show=$(this).attr('data-show');
        $('.pop-up-table').hide();
        $('.icon_show').removeClass('fa-compress').addClass('fa-arrows-alt');
        if(show=='show'){
            $('#info_user_'+id).show();
            $(this).attr('data-show','hide');
            $('#icon_show_'+id).removeClass('fa-arrows-alt').addClass('fa-compress');
        }else{
            $('#info_user_'+id).hide();
            $(this).attr('data-show','show');
            $('#icon_show_'+id).removeClass('fa-compress').addClass('fa-arrows-alt');
        }
        //$('#info_user_'+id).show().css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    });

    $('body').on("click",'.close_pop_up', function (e) {
        var id=$(this).attr('data-id');
        $('.pop-up-table').hide();
        $('.icon_show').removeClass('fa-compress').addClass('fa-arrows-alt');
        $('.show_info').attr('data-show','show');
        //$('#info_user_'+id).show().css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    });

});



$(function() {
    var moveLeft = 20;
    var moveDown = 10;

    $('a#trigger').hover(function(e) {
        $('div#pop-up').show();
        //.css('top', e.pageY + moveDown)
        //.css('left', e.pageX + moveLeft)
        //.appendTo('body');
    }, function() {
        $('div#pop-up').hide();
    });

    $('a#trigger').mousemove(function(e) {
        $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    });

});



