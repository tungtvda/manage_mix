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
            title: '<label class="orange">Xác nhận cập nhật trạng thái</label>',
            content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của </br><b>"'+name_record+'"</b> ?',
            confirmBtnText: 'Ok',
            iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
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
    $('.checkbox_user_role').on('click', function () {
        var status = 0;
        if ($(this).is(":checked")) {
            status = 1;
        }

        var idSelect = $(this).attr('countid');
        var table = $(this).attr('table');
        var field = $(this).attr('field');
        var name_record=$(this).attr('name_record');
        var link = url + '/update-status/';
        var field_check = "checkbox_user_role_" + idSelect;
        if(status==1)
        {
            var mess='Bạn chắc chắn rằng muốn người dùng </br><b>"'+name_record+'"</b> trở thành admin hệ thống?'
        }
        else{
            var mess='Bạn chắc chắn rằng muốn hủy quyền admin của người dùng </br><b>"'+name_record+'"</b>?'
        }
        lnv.confirm({
            title: '<label class="orange">Xác nhận trở thành admin hệ thống</label>',
            content: mess,
            confirmBtnText: 'Ok',
            iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
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
                        data: "id=" + idSelect + '&table=' + table + '&field=' + field + '&status=' + status +'&action=user_update_role',
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
                            else{
                                if(status==0){
                                    $("#user-md-active-"+idSelect).removeClass("active-user-role");
                                }
                                else{
                                    $("#user-md-active-"+idSelect).addClass("active-user-role");
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
        var url = $('#url_input').val();
        var link = url + '/update-phan-quyen';
        id = $('#id_user_hidden').val();
        $.ajax({
            method: "POST",
            url: link,
            data : { // Danh sách các thuộc tính sẽ gửi đi
                value : test,
                id: id
            },
            success: function (response) {
                if (response != 1) {
                    lnv.alert({
                        title: '<label class="red">Lỗi</label>',
                        content: response,
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else{
                    lnv.alert({
                        title: '<label class="green">Thông báo</label>',
                        content: 'Cập nhật quyền thành công',
                        alertBtnText: 'Ok',
                        iconBtnText:'<i style="color: red;" class="ace-icon fa fa-check green"></i>',
                        alertHandler: function () {

                        }
                    });
                }
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
    $('body').on('click','.fa-angle-double-left', function () {
        $( "#sidebar" ).addClass("menu-min");
        $( "#sidebar-toggle-icon" ).removeClass("fa-angle-double-left");
        $( "#sidebar-toggle-icon" ).addClass("fa-angle-double-right");
    });

    $('body').on('click','.fa-angle-double-right',function(){
        $( "#sidebar" ).removeClass("menu-min");
        $( "#sidebar-toggle-icon" ).removeClass("fa-angle-double-right");
        $( "#sidebar-toggle-icon" ).addClass("fa-angle-double-left");

    });
    $('body').on('click','.delete_function', function () {
        var lenght = $('.click_check_list:checked').length;
        if (lenght == 0) {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng chọn bản ghi',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }
        else{
            lnv.confirm({
                title: 'Xác nhận xóa bản ghi',
                content: 'Bạn chắc chắn rằng muốn xóa những bản ghi đã được check',
                confirmBtnText: 'Ok',
                iconBtnText:'<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
                confirmHandler: function () {
                    $("#form_submit_delete").submit();
                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                }
            })
        }

    });



    //$('i').ggtooltip();
});

var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('show_img_upload');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
