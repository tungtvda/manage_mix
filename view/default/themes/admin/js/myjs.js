jQuery(function ($) {
    url = $('#url_input').val();
    $('.checkbox_status').on('click', function () {
        var status = 0;
        if ($(this).is(":checked")) {
            status = 1;
        }

        var idSelect = $(this).attr('countid');
        var table = $(this).attr('table');
        var field = $(this).attr('field');
        var name_record=$(this).attr('name_record');
        var link = url + '/update-status/';
        var field_check = "checkbox_status_" + idSelect;
        lnv.confirm({
            title: 'Xác nhận cập nhật trạng thái nhân viên',
            content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của nhân viên </br><b>"'+name_record+'"</b>',
            confirmBtnText: 'Ok',
            iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
            confirmHandler: function () {
                if(idSelect==''||table==''||field==''||name_record==''||link==''){
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Các thông tin cập nhật không hợp lệ',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else{
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + idSelect + '&table=' + table + '&field=' + field + '&status=' + status,
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
                                if(status==0){
                                    document.getElementById(field_check).checked = true;

                                }
                                else{
                                    document.getElementById(field_check).checked = false;
                                }
                            }
                        }
                    });
                }

            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
                if(status==0){
                    document.getElementById(field_check).checked = true;

                }
                else{
                    document.getElementById(field_check).checked = false;
                }
            }
        })


    });
    $('.delete_record').on('click', function () {
        var deleteid = $(this).attr('deleteid');
        var url_delete = $(this).attr('url_delete');
        var name_record_delete=$(this).attr('name_record_delete');
        lnv.confirm({
            title: 'Xác nhận xóa nhân viên',
            content: 'Bạn chắc chắn rằng muốn xóa nhân viên </br><b>"'+name_record_delete+'"</b>',
            confirmBtnText: 'Ok',
            iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
            confirmHandler: function () {
                window.location.replace(url_delete+deleteid);
            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
            }
        })


    });


});