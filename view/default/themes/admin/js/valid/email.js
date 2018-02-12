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
    $('body').on("click",'#check_all', function () {
        var lenght = $('.click_check_list:checked').length;
        var th_checked = this.checked;//checkbox inside "TH" table header
        var number_email=0;
        $('#table_list_email_customer').html('');
        if(th_checked==true){
            $('#dynamic-table > tbody  > tr').each(function() {
               var email=$(this).attr('email_record');
                var id=$(this).attr('value');
                if(email!=''){
                    var check_exit=$('#row_email_'+id).html();
                    if(check_exit==undefined){
                        $('#table_list_email_customer').append(" <tbody id='row_email_"+id+"'><tr > <td>"+email+"</td> </tr></tbody>");
                        number_email=parseInt(number_email)+1;
                    }
                }
            });

        }
        $('#number_email').html(number_email);
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
                var id=$('#input_id').val();
                var status=$('.status_sms').val();
                var time_send=$('#timepicker1').val();
                var message_birthday=$('#message_birthday').val();
                var content_email=CKEDITOR.instances['content_email'].getData();
                var customer_birthday = [];
                $.each($("#submit_form").serializeArray(), function (i, field) {
                    if(field.name=='customer_birthday[]'){
                        customer_birthday.push(field.value);
                    }
                });
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
                            'customer_birthday':customer_birthday,
                            'id':id,
                            'status':status
                        },
                        success: function (response) {
                            if(response=='1'){
                                var mes='Lưu tin nhắn thành công, hệ thống sẽ tự động gửi tin nhắn theo thời gian bạn đã cài đặt';
                                if(id!=''){
                                    var mes='Lưu tin nhắn thành công';
                                }
                                lnv.alert({
                                    title: '<label class="green">Thông báo</label>',
                                    content: mes,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-check green"></i>',
                                    alertHandler: function () {
                                        if(type==0){
                                            var link_re = url + '/cham-soc-khach-hang/';
                                        }else{
                                            if(type==2){
                                                var link_re = url + '/chuc-mung-sinh-nhat/?type=2';
                                            }else{
                                                var link_re = url + '/chuc-mung-sinh-nhat/?type=1';
                                            }

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

    $('body').on("click", '.view_popup_detail', function () {
        var Id = $(this).attr("countid");
        var name = $(this).attr("name_record");
        show_edit_info_mess(Id, name);
    });
    function show_edit_info_mess(Id, name) {
        $("#title_form").html('Chi tiết SMS - Email "<b>' + name + '</b>"');
        if (Id != '') {
            jQuery.post(url + "/get-detail-ajax/",
                {
                    id: Id,
                    table: 'sms_email'
                }
                )
                .done(function (data) {
                    if (data != 0) {
                        var obj = jQuery.parseJSON(data);
                        $('.show_cus_list').html(obj.customer);
                        $('#count_cus').html(obj.count_cus);
                        $('.tieu_de_detail').html(obj.title);
                        var ststus='Draft';
                        if(obj.status==1){
                            ststus='Processing';
                        }else{
                            if(obj.status==2){
                                ststus='Sent';
                            }else{
                                if(obj.status==3){
                                    ststus='Paused';
                                }
                            }
                        }
                        $('.trang_thai_detail').html(ststus);
                        $('.ngay_gui_detail').html(obj.date_time_send);
                        $("#div_list_cus").addClass(obj.css_height);
                    }else{
                        lnv.alert({
                            title: 'Lỗi',
                            content: 'Ban không thể xem chi tiết SMS - Email "'+name+'"',
                            alertBtnText: 'Ok',
                            iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                            alertHandler: function () {
                                $('#modal-form').modal('hide');
                            }
                        });
                    }
                });
        }
        else {
            lnv.alert({
                title: 'Lỗi',
                content: 'Ban không thể xem chi tiết khách hàng "'+name+'"',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                    $('#modal-form').modal('hide');
                }
            });
        }
    }
    $('body').on("change", '.select_status', function () {

        var id=$(this).attr('count_id');
        var code=$(this).attr('code');
        var status=$(this).val();
        var table = 'sms_email';
        var field = 'status';
        var link = url + '/update-status/';
        var action='sms_email_update';
        if(id==''||table==''||field==''||code==''||link==''){
            lnv.alert({
                title: 'Lỗi',
                content: 'Các thông tin cập nhật không hợp lệ',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }else{
            var value_old=$('#status_old_'+id).val();
            lnv.confirm({
                title: '<label class="orange">Xác nhận cập nhật trạng thái</label>',
                content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của tin nhắn </br><b>"'+code+'"</b> ?',
                confirmBtnText: 'Ok',
                iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
                confirmHandler: function () {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + id + '&table=' + table + '&field=' + field + '&status=' + status+'&action='+action,
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {

                                    }
                                });
                                $("#status_"+id).val(value_old);
                            }else{
                                $('#status_old_'+id).val(status);
                            }
                        }
                    });

                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                    $("#status_"+id).val(value_old);
                }
            })
        }

    });

});

