jQuery(function ($) {
    url = $('#url_input').val();
    $('body').on("click", '.view_popup_detail', function () {
        var id = $(this).attr('countid')
        if (id) {
            var status = $('#status_tour_' + id).val();
            if (status == 1) {
                $('#input_status').text('Đã xác nhận')
            } else {
                if (status == 2) {
                    $('#input_status').text('Đã hủy')
                } else {
                    $('#input_status').text('Chưa xác nhận')
                }
            }
            var url_href = url + '/thanh-vien/sua?id=' + $('#user_id_mahoa_' + id).val();
            $('#user_create').html($('#user_name_' + id).val() + ' - ' + $('#user_code_' + id).val()).attr('href', url_href);
            $('#input_id_edit').val(id).addClass('valid');
            $('#input_name_cus').val($('#name_cus_' + id).val()).addClass('valid');
            $('#input_email_cus').val($('#email_cus_' + id).val()).addClass('valid');
            $('#input_phone_cus').val($('#phone_cus_' + id).val()).addClass('valid');
            $('#input_address_cus').val($('#address_cus_' + id).val()).addClass('valid');
            $('#input_name_tour').val($('#name_tour_' + id).val()).addClass('valid');
            $('#input_time_tour').val($('#time_tour_' + id).val()).addClass('valid');
            $('#input_date_tour').val($('#date_tour_' + id).val()).addClass('valid');
            $('#input_address_tour').val($('#address_tour_' + id).val()).addClass('valid');
            $('#input_note_tour').val($('#note_tour_' + id).val()).addClass('valid');
            $('#input_note_confirm').val($('#note_confirm_' + id).val()).addClass('valid');
            $('#modal-form').modal('show');
        } else {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng Ctrl+f5 và thử lại',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                    $('#modal-form').modal('hide');
                }
            });
        }
    });
    // show popup detail
    showPopupTourUser();
    function showPopupTourUser(){
        var id=$('#tour_id_show_popup').val();
        var name=$('#tour_name_show_popup').val();
        if(id&&name){
            setDataFormCreateTourUser(id)
        }

    }
    function setDataFormCreateTourUser(id){
        var status = $('#status_tour_' + id).val();
        if (status == 1) {
            $('#input_status').text('Đã xác nhận')
        } else {
            if (status == 2) {
                $('#input_status').text('Đã hủy')
            } else {
                $('#input_status').text('Chưa xác nhận')
            }
        }
        var url_href = url + '/thanh-vien/sua?id=' + $('#user_id_mahoa_' + id).val();
        $('#user_create').html($('#user_name_' + id).val() + ' - ' + $('#user_code_' + id).val()).attr('href', url_href);
        $('#input_id_edit').val(id).addClass('valid');
        $('#input_name_cus').val($('#name_cus_' + id).val()).addClass('valid');
        $('#input_email_cus').val($('#email_cus_' + id).val()).addClass('valid');
        $('#input_phone_cus').val($('#phone_cus_' + id).val()).addClass('valid');
        $('#input_address_cus').val($('#address_cus_' + id).val()).addClass('valid');
        $('#input_name_tour').val($('#name_tour_' + id).val()).addClass('valid');
        $('#input_time_tour').val($('#time_tour_' + id).val()).addClass('valid');
        $('#input_date_tour').val($('#date_tour_' + id).val()).addClass('valid');
        $('#input_address_tour').val($('#address_tour_' + id).val()).addClass('valid');
        $('#input_note_tour').val($('#note_tour_' + id).val()).addClass('valid');
        $('#input_note_confirm').val($('#note_confirm_' + id).val()).addClass('valid');
        $('#modal-form').modal('show');
    }
    $('body').on("change", '.change_status_tour_user', function () {
        var idSelect = $(this).attr('countid');
        var value = $(this).val();
        $('#idSelectConfirm').val(idSelect);
        $('#idValueConfirm').val(value);
        $('#error_note_confirm').hide();
        var name_record = $(this).attr('name_record');
        var name_khachhang = $(this).attr('name_khachhang');
        if (value && idSelect && name_record && name_khachhang) {
            var mess = '';
            if (value == 1) {
                mess = '<p>Bạn chắc chắn muốn xác nhận tour </br><b>"' + name_record + '"</b> của khách hàng "' + name_khachhang + '" ?</p>';
            } else {
                if (value == 2) {
                    mess = '<p>Bạn chắc chắn muốn hủy tour </br><b>"' + name_record + '"</b> của khách hàng "' + name_khachhang + '" ?</p>';
                }
            }
            $('#title_form_confirm').html(mess);
            $('#modal-form-confirm').modal('show');
        } else {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng Ctrl+f5 và thử lại',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                }
            });
        }



    });
    $('body').on("click",'#submit_form_confirm',function (){
        var note=$('#input_note_confirm_popup').val();
        var idSelect=$('#idSelectConfirm').val();
        var value=$('#idValueConfirm').val();
       if(note){
           $('#error_note_confirm').hide();
           var link=url+'/tour-yeu-cau/sua';
           $.ajax({
               method: "POST",
               url: link,
               data:{
                   id:idSelect,
                   value:value,
                   note_confirm:note
               },
               success: function (response) {
                   if (response != 1) {
                       lnv.alert({
                           title: 'Lỗi',
                           content: response,
                           alertBtnText: 'Ok',
                           iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                           alertHandler: function () {
                               $('#change_status_' + idSelect + ' option').each(function () {
                                   if ($(this).val() == '0') {
                                       $(this).prop("selected", true);
                                   }
                               });
                           }
                       });
                   }else{
                       $('#change_status_'+idSelect).attr('disabled','disabled');
                       $('#change_status_'+idSelect).removeClass('chua_xac_nhan');
                       if(value==1){
                           $('#change_status_'+idSelect).addClass('da_xac_nhan');
                       }else{
                           if(value==2){
                               $('#change_status_'+idSelect).addClass('da_huy');
                           }else{
                               $('#change_status_'+idSelect).addClass('chua_xac_nhan');
                           }
                       }
                       var dataNoti = {domain:"az", modul:"tour_user", action:"create", admin:2};
                       socket.emit('sendNotification',dataNoti);
                   }
               }
           });

       }else{
           $('#error_note_confirm').show();
       }
    });
    $('body').on("click",'cancel_confirm',function(){
        //        $('#change_status_' + idSelect + ' option').each(function () {
        //            if ($(this).val() == '0') {
        //                $(this).prop("selected", true);
        //            }
        //        });
    });
});




