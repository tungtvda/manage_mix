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
            title: 'Xác nhận cập nhật trạng thái',
            content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của </br><b>"'+name_record+'"</b>',
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
            title: 'Xác nhận xóa bản ghi',
            content: 'Bạn chắc chắn rằng muốn xóa bản ghi </br><b>"'+name_record_delete+'"</b>',
            confirmBtnText: 'Ok',
            iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
            confirmHandler: function () {
                if(deleteid==''||url_delete==''||name_record_delete==''){
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Các thông tin xóa không hợp lệ',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else{
                    window.location.replace(url_delete+deleteid);
                }
            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
            }
        })
    });
    $('.easyui-linkbutton').on('click', function () {
        var nodes = $('#tt').tree('getChecked');
        var test=JSON.stringify($('#tt').tree('getChecked'));
        id = $('#id_user_hidden').val();
        $.ajax({
            method: "POST",
            url: 'http://localhost/manage_mix/update-phan-quyen',
            data : { // Danh sách các thuộc tính sẽ gửi đi
                value : test,
                id: id
            },
            success: function (response) {

            }
        });
                                    //$.ajax({
                                    //    "url": 'http://localhost/manage_mix/update-phan-quyen',
                                    //    "method": 'POST',
                                    //    "processData": false, // Don't process the files
                                    //    "contentType": false,
                                    //    "dataType": "json",
                                    //    "data": nodes, // $form.serialize()
                                    //    error: function (xhr, status, error) {
                                    //    }
                                    //})
//                                    var s = '';
//                                    for(var i=0; i<nodes.length; i++){
//                                        if (s != '') s += ',';
//                                        s += nodes[i].text;
//                                    }
    });

});