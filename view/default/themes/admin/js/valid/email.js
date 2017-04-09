jQuery(function ($) {
    url = $('#url_input').val();

    //$('body').on("click",'.click_check_list', function () {
    //    alert('asdf');
    //});
    $('body').on("click",'.row_tr_click', function () {
        var id=$(this).attr('value');
        var email=$(this).attr('email_record');
        var number_email=$('#number_email').html();
        if(id!='' && email!=''&&number_email!=''){
            if($(this).hasClass("success")){
                $('#table_list_email_customer').append(" <tbody><tr id='row_email_"+id+"'> <td>"+email+"</td> </tr></tbody>");
                number_email=parseInt(number_email)+1;
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
    $('body').on("click",'#next_edit_user', function () {
        var stt=$('.steps .active').attr('data-step');
        var lenght = $('.click_check_list:checked').length;
        if (lenght == 0) {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng chọn khách hàng',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }else{
            if(stt==1){
                $('#step_tab_1').removeClass('active');
                $('#step_tab_1').addClass('complete');
                $('#step_tab_2').addClass('active');
                $('#step_edit_1').removeClass('active');
                $('#step_edit_2').addClass('active');

            }else{
                $('#step_tab_2').removeClass('active');
                $('#step_tab_2').addClass('complete');
            }
            $( "#prev_edit_user" ).prop( "disabled", false );
        }
    });
    $('body').on("click",'#prev_edit_user, #step_tab_1', function () {
        $('#step_tab_2').removeClass('active');
        $('#step_tab_1').removeClass('complete');
        $('#step_tab_1').addClass('active');
        $('#step_edit_1').addClass('active');
        $('#step_edit_2').removeClass('active');
    });

});

