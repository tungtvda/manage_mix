jQuery(function ($) {
    url = $('#url_input').val();
    $('body').on("click",'.view_popup_detail', function () {
        var id=$(this).attr('countid')
        if(id){
            var status=$('#status_tour_'+id).val();
            if(status==1){
                $('#input_status').attr('checked','checked')
            }
            var url_href=url+'/thanh-vien/sua?id='+$('#user_id_mahoa_'+id).val();
            $('#user_create').html($('#user_name_'+id).val()+' - '+$('#user_code_'+id).val()).attr('href',url_href);
            $('#input_id_edit').val(id).addClass('valid');
            $('#input_name_cus').val($('#name_cus_'+id).val()).addClass('valid');
            $('#input_email_cus').val($('#email_cus_'+id).val()).addClass('valid');
            $('#input_phone_cus').val($('#phone_cus_'+id).val()).addClass('valid');
            $('#input_address_cus').val($('#address_cus_'+id).val()).addClass('valid');
            $('#input_name_tour').val($('#name_tour_'+id).val()).addClass('valid');
            $('#input_time_tour').val($('#time_tour_'+id).val()).addClass('valid');
            $('#input_date_tour').val($('#date_tour_'+id).val()).addClass('valid');
            $('#input_address_tour').val($('#address_tour_'+id).val()).addClass('valid');
            $('#input_note_tour').val($('#note_tour_'+id).val()).addClass('valid');
            $('#modal-form').modal('show');
        }else{
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
    $('body').on("change",'.change_status_tour_user', function () {

        var idSelect = $(this).attr('countid');
        var value=$(this).val();
        var name_record=$(this).attr('name_record');
        var name_khachhang=$(this).attr('name_khachhang');
       if(value && idSelect && name_record && name_khachhang){
           var mess='';
           if(value==1){
               mess='<p>Bạn chắc chắn muốn xác nhận tour </br><b>"' + name_record + '"</b> của khách hàng "'+name_khachhang+'" ?</p>';
           }else{
               if(value==2){
                   mess='<p>Bạn chắc chắn muốn hủy tour </br><b>"' + name_record + '"</b> của khách hàng "'+name_khachhang+'" ?</p>';
               }
           }
           mess=mess+'<p><label>Ghi chú</label>  <textarea class="valid" name="input_note_confirm" id="input_note_confirm" style="width: 100%"></textarea></p>';

           lnv.confirm({
               title: '<label class="orange">Xác nhận thay đổi trạng thái</label>',
               content:mess,
               confirmBtnText: 'Ok',
               iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
               confirmHandler: function () {

                               $.ajax({
                                   method: "GET",
                                   url: link,
                                   data: "id=" + idSelect + '&value=' + value + '&input_note_confirm=' +$('#input_note_confirm').val(),
                                   success: function (response) {
                                       if (response != 1) {
                                           lnv.alert({
                                               title: 'Lỗi',
                                               content: response,
                                               alertBtnText: 'Ok',
                                               iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                               alertHandler: function () {

                                               }
                                           });
                                           if (status == 0) {
                                               document.getElementById(field_check).checked = true;

                                           }
                                           else {
                                               document.getElementById(field_check).checked = false;
                                           }
                                       }
                                   }
                               });
               },
               cancelBtnText: 'Cancel',
               cancelHandler: function () {
                   $('#change_status_'+idSelect+' option').each(function() {
                       if($(this).val() == '0') {
                           $(this).prop("selected", true);
                       }
                   });
               }
           })
       }else{
           lnv.alert({
               title: 'Lỗi',
               content: 'Bạn vui lòng Ctrl+f5 và thử lại',
               alertBtnText: 'Ok',
               iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
               alertHandler: function () {
               }
           });
       }
        // lnv.confirm({
        //     title: '<label class="orange">Xác nhận cập nhật trạng thái</label>',
        //     content: '<p>Bạn chắc chắn rằng muốn cập nhật trạng thái của </br><b>"' + name_record + '"</b></p><p>  <textarea class="valid" name="input_note_confirm" id="input_note_confirm" style="width: 100%"></textarea></p> ?',
        //     confirmBtnText: 'Ok',
        //     iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
        //     confirmHandler: function () {
        //         if (idSelect == '' || table == '' || field == '' || name_record == '' || link == '') {
        //             lnv.alert({
        //                 title: 'Lỗi',
        //                 content: 'Các thông tin cập nhật không hợp lệ',
        //                 alertBtnText: 'Ok',
        //                 iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
        //                 alertHandler: function () {
        //
        //                 }
        //             });
        //         }
        //         else {
        //             console.log($('#input_note_confirm').val());
        //             $.ajax({
        //                 method: "GET",
        //                 url: link,
        //                 data: "id=" + idSelect + '&table=' + table + '&field=' + field + '&status=' + status + '&action=' + action,
        //                 success: function (response) {
        //                     if (response != 1) {
        //                         lnv.alert({
        //                             title: 'Lỗi',
        //                             content: response,
        //                             alertBtnText: 'Ok',
        //                             iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
        //                             alertHandler: function () {
        //
        //                             }
        //                         });
        //                         if (status == 0) {
        //                             document.getElementById(field_check).checked = true;
        //
        //                         }
        //                         else {
        //                             document.getElementById(field_check).checked = false;
        //                         }
        //                     }
        //                 }
        //             });
        //         }
        //
        //     },
        //     cancelBtnText: 'Cancel',
        //     cancelHandler: function () {
        //         if (status == 0) {
        //             document.getElementById(field_check).checked = true;
        //
        //         }
        //         else {
        //             document.getElementById(field_check).checked = false;
        //         }
        //     }
        // })


    });
});




