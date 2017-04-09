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
                $('#input_title').focus().select();

            }else{
                $('#step_tab_2').removeClass('active');
                $('#step_tab_2').addClass('complete');
                var title=$('#input_title').val();
                var type=$('#input_type').val();
                if(type==''){
                    type=0;
                }
                var date_send=$('#id-date-picker-1').val();
                var time_send=$('#timepicker1').val();
                var message_birthday=$('#message_birthday').val();
                var content_email=CKEDITOR.instances['content_email'].getData();
                var customer_birthday = [];
                $.each($("#submit_form").serializeArray(), function (i, field) {
                    if(field.name=='customer_birthday[]'){
                        customer_birthday.push(field.value);
                    }
                });
                console.log(customer_birthday);
                //console.log($("#submit_form").serializeArray().name);
                var success=true;
                if(title==''){
                    success=false;
                    $('#error_title').show();
                }
                if(date_send==''){
                    success=false;
                    $('#error_date_send').show();
                }
                if(time_send==''){
                    success=false;
                    $('#error_time_send').show();
                }
                console.log(content_email);
                if(message_birthday==''&&content_email==''){
                    success=false;
                    $('#error_content').show();
                }
                if(success){
                    var link = url + '/chuc-mung-sinh-nhat/send-sms-birthday/';
                    $.ajax({
                        method: "POST",
                        url:link,
                        data: {
                            'title':title,
                            'type':type,
                            'date_send':date_send,
                            'time_send':time_send,
                            'message_birthday':message_birthday,
                            'content_email':content_email,
                            'customer_birthday':customer_birthday
                        },
                        success: function (response) {
                            if(response=='1'){
                                lnv.alert({
                                    title: '<label class="green">Thông báo</label>',
                                    content: 'Lưu tin nhắn thành công, hệ thống sẽ tự động gửi tin nhắn trong 1 phút tới',
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-check green"></i>',
                                    alertHandler: function () {
                                        if(type==0){
                                            var link_re = url + '/cham-soc-khach-hang/';
                                        }else{
                                            var link_re = url + '/chuc-mung-sinh-nhat/';
                                        }
                                        window.location=link_re;
                                    }
                                });
                            }else{
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                    }
                                });
                            }
                        }
                    });
                }else{
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Bạn vui lòng kiểm các trường thông tin',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
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

