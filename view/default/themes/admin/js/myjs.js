jQuery(function ($) {
    url = $('#url_input').val();
    $('.checkbox_status').on('click', function () {
        var status = 0;
        if ($(this).is(":checked")) {
            status = 1;
        }

        var idSelect = $(this).attr('countid');
        var action = $(this).attr('action');
        var table = $(this).attr('table');
        var field = $(this).attr('field');
        var name_record = $(this).attr('name_record');
        var link = url + '/update-status/';
        var field_check = "checkbox_status_" + idSelect;
        lnv.confirm({
            title: '<label class="orange">Xác nhận cập nhật trạng thái</label>',
            content: 'Bạn chắc chắn rằng muốn cập nhật trạng thái của </br><b>"' + name_record + '"</b> ?',
            confirmBtnText: 'Ok',
            iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
            confirmHandler: function () {
                if (idSelect == '' || table == '' || field == '' || name_record == '' || link == '') {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Các thông tin cập nhật không hợp lệ',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + idSelect + '&table=' + table + '&field=' + field + '&status=' + status + '&action=' + action,
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
                }

            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
                if (status == 0) {
                    document.getElementById(field_check).checked = true;

                }
                else {
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
        var name_record = $(this).attr('name_record');
        var link = url + '/update-status/';
        var field_check = "checkbox_user_role_" + idSelect;
        if (status == 1) {
            var mess = 'Bạn chắc chắn rằng muốn người dùng </br><b>"' + name_record + '"</b> trở thành admin hệ thống?'
        }
        else {
            var mess = 'Bạn chắc chắn rằng muốn hủy quyền admin của người dùng </br><b>"' + name_record + '"</b>?'
        }
        lnv.confirm({
            title: '<label class="orange">Xác nhận trở thành admin hệ thống</label>',
            content: mess,
            confirmBtnText: 'Ok',
            iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
            confirmHandler: function () {
                if (idSelect == '' || table == '' || field == '' || name_record == '' || link == '') {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Các thông tin cập nhật không hợp lệ',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + idSelect + '&table=' + table + '&field=' + field + '&status=' + status + '&action=user_update_role',
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
                            else {
                                if (status == 0) {
                                    $("#user-md-active-" + idSelect).removeClass("active-user-role");
                                }
                                else {
                                    $("#user-md-active-" + idSelect).addClass("active-user-role");
                                }
                            }
                        }
                    });
                }

            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
                if (status == 0) {
                    document.getElementById(field_check).checked = true;

                }
                else {
                    document.getElementById(field_check).checked = false;
                }
            }
        })


    });
    $('.delete_record').on('click', function () {
        var deleteid = $(this).attr('deleteid');
        var url_delete = $(this).attr('url_delete');
        var name_record_delete = $(this).attr('name_record_delete');
        lnv.confirm({
            title: 'Xác nhận xóa bản ghi',
            content: 'Bạn chắc chắn rằng muốn xóa bản ghi </br><b>"' + name_record_delete + '"</b>',
            confirmBtnText: 'Ok',
            iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
            confirmHandler: function () {
                if (deleteid == '' || url_delete == '' || name_record_delete == '') {
                    lnv.alert({
                        title: 'Lỗi',
                        content: 'Các thông tin xóa không hợp lệ',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else {
                    $.ajax({
                        method: "GET",
                        url: url_delete,
                        data: '',
                        success: function (response) {
                            if (response == 1) {
                                $(".row_" + deleteid).remove();
                            } else {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: 'Xóa dữ liệu thất bại',
                                    alertBtnText: 'Ok',
                                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {

                                    }
                                });
                            }
                        }
                    });
                    //window.location.replace(url_delete+deleteid);
                }
            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
            }
        })
    });
    $('.easyui-linkbutton').on('click', function () {
        var nodes = $('#tt').tree('getChecked');
        var test = JSON.stringify($('#tt').tree('getChecked'));
        var url = $('#url_input').val();
        var link = url + '/update-phan-quyen';
        id = $('#id_user_hidden').val();
        $.ajax({
            method: "POST",
            url: link,
            data: { // Danh sách các thuộc tính sẽ gửi đi
                value: test,
                id: id
            },
            success: function (response) {
                if (response != 1) {
                    lnv.alert({
                        title: '<label class="red">Lỗi</label>',
                        content: response,
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {

                        }
                    });
                }
                else {
                    lnv.alert({
                        title: '<label class="green">Thông báo</label>',
                        content: 'Cập nhật quyền thành công',
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-check green"></i>',
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
    $('body').on('click', '.fa-angle-double-left', function () {
        $("#sidebar").addClass("menu-min");
        $("#sidebar-toggle-icon").removeClass("fa-angle-double-left");
        $("#sidebar-toggle-icon").addClass("fa-angle-double-right");
    });

    $('body').on('click', '.fa-angle-double-right', function () {
        $("#sidebar").removeClass("menu-min");
        $("#sidebar-toggle-icon").removeClass("fa-angle-double-right");
        $("#sidebar-toggle-icon").addClass("fa-angle-double-left");

    });
    $('body').on('click', '.delete_function', function () {
        var lenght = $('.click_check_list:checked').length;
        if (lenght == 0) {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng chọn bản ghi',
                alertBtnText: 'Ok',
                iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {

                }
            });
        }
        else {
            lnv.confirm({
                title: 'Xác nhận xóa bản ghi',
                content: 'Bạn chắc chắn rằng muốn xóa những bản ghi đã được check',
                confirmBtnText: 'Ok',
                iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-check"></i>',
                confirmHandler: function () {
                    $("#form_submit_delete").submit();
                },
                cancelBtnText: 'Cancel',
                cancelHandler: function () {
                }
            })
        }

    });
    $('body').on('click', '.tab_list', function () {
        var id = $(this).attr('href');
        $('.tab_content').removeClass('active');
        //$('.tab_content').hide();
        $('#' + id).addClass('active');
    });
    $('body').on('click', '#xac_minh_2_buoc', function () {
        var status = 0;
        if ($(this).is(":checked")) {
            status = 1;
        }

        var idSelect = $(this).attr('countid');
        var table = $(this).attr('table');
        var field = $(this).attr('field');
        var name_record = $(this).attr('name_record');
        var link = url + '/update-status/';
        if (status == 1) {
            var mess = 'Bạn chắc chắn muốn kích hoạt chức năng đăng nhập 2 bước?';
            var mess_res = "Kích hoạt thành công";
            var mess_er = "Kích hoạt thất bại";
            var class_mes = 'blue';
            var mess_lable = ' Chức năng đăng nhập 2 bước đã được kích hoạt';
        }
        else {
            var mess = 'Bạn chắc chắn muốn hủy bỏ chức năng đăng nhập 2 bước ?';
            var mess_res = "Hủy bỏ thành công";
            var mess_er = "Hủy bỏ thất bại";
            var class_mes = '';
            var mess_lable = ' Kích hoạt chức năng đăng nhập 2 bước';
        }
        lnv.confirm({
            title: '<label class="orange">Xác nhận đăng nhập 2 bước</label>',
            content: mess,
            confirmBtnText: 'Ok',
            iconBtnText: '<i style="color: #669fc7;" class="ace-icon fa fa-question orange"></i>',
            confirmHandler: function () {
                if (idSelect == '' || table == '' || field == '' || name_record == '' || link == '') {
                    lnv.alert({
                        title: 'Lỗi',
                        content: mess_er,
                        alertBtnText: 'Ok',
                        iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                        alertHandler: function () {
                            if (status == 0) {
                                document.getElementById('xac_minh_2_buoc').checked = true;

                            }
                            else {
                                document.getElementById('xac_minh_2_buoc').checked = false;
                            }
                        }
                    });
                }
                else {
                    $.ajax({
                        method: "GET",
                        url: link,
                        data: "id=" + idSelect + '&table=' + table + '&field=' + field + '&status=' + status + '&action=user_update_login_two_steps',
                        success: function (response) {
                            if (response != 1) {
                                lnv.alert({
                                    title: 'Lỗi',
                                    content: response,
                                    alertBtnText: 'Ok',
                                    iconBtnText: '<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                                    alertHandler: function () {
                                        if (status == 0) {
                                            document.getElementById('xac_minh_2_buoc').checked = true;

                                        }
                                        else {
                                            document.getElementById('xac_minh_2_buoc').checked = false;
                                        }
                                    }
                                });
                            }
                            else {
                                $('#mess_xacminh').html(mess_lable);
                                if (status == 1) {
                                    $('#mess_xacminh').addClass('blue');
                                }
                                else {
                                    $('#mess_xacminh').removeClass('blue');
                                }
                            }
                        }
                    });
                }

            },
            cancelBtnText: 'Cancel',
            cancelHandler: function () {
                if (status == 0) {
                    document.getElementById('xac_minh_2_buoc').checked = true;

                }
                else {
                    document.getElementById('xac_minh_2_buoc').checked = false;
                }
            }
        })


    });
    $('body').on("input", '#message_birthday', function () {
        var value = change_alias($(this).val());
        var MaxLength = 160;
        $(this).val(value);
        var length_text = value.length;
        var length_con_lai = MaxLength - length_text;
        if (length_con_lai <= 0) {
            $('#error_check_length').show();
            $(this).css("border", "1px solid red");
            $('#count_ky_tu').css("color", "red");
            $('#message_birthday').show().focus();
            $('#count_ky_tu').html('0 ký tự');
        } else {
            $('#error_check_length').hide();
            $(this).css("border", "none");
            if (length_con_lai <= 50) {
                $('#count_ky_tu').css("color", "#f89406");
            } else {
                $('#count_ky_tu').css("color", "#68BC31");
            }
            $('#count_ky_tu').html(length_con_lai + ' ký tự');
        }


    });
    function change_alias(alias) {
        var str = alias;
        //str= str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
//        str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
        /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
        str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
        str = str.replace(/^\-+|\-+$/g, "");
        //cắt bỏ ký tự - ở đầu và cuối chuỗi
        return str;
    }

    $('body').on('click', '.key_birthday', function () {
        var id = $(this).attr('countId');
        copyToClipboard(document.getElementById('value_key_' + id));
    });
    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }

    $('body').on("input", '.valid-input', function () {
        var name = $(this).attr('name');
        var valid = $(this).attr('data-valid');
        if(valid=='required'){
            var value=$(this).val();
            console.log(value);

           if(value && name){
               $('#error_'+name).hide();
               $(this).addClass('valid');
               $(this).removeClass('input-error');
           }else{
               $('#error_'+name).show();
               $(this).removeClass('valid');
           }
        }
    });
    $('body').on("change", '.valid-input', function () {
        var name = $(this).attr('name');
        var valid = $(this).attr('data-valid');
        var value=$(this).val();
        if(valid=='required'){
            if(value && name){
                $('#error_'+name).hide();
                $(this).addClass('valid');
                $(this).removeClass('input-error');
            }else{
                $('#error_'+name).show();
                $(this).removeClass('valid');
            }
        }
        switch (name){
            case 'name_tour_cus':
                if(value!=''){
                    $('#name_tour_table').html(value)
                }
                break;
        }
    });
    $('body').on("click", '.input_price_cus', function () {
       $(this).select();
    });
    $('body').on("input", '.input_price_cus', function () {
        var name = $(this).attr('name');
        var price = $(this).val();
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;

        if (numberRegex.test(price)) {
            var price_format = price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
        }
        else {
            $(this).val(0);
            price_format='0 vnđ';
        }
        $('#price_'+name).html(price_format);
        var total_price=0;
        $(".input_price_cus").each(function( index ) {
          var value_price=parseInt($(this).val());
            total_price=total_price+value_price;
        });
        total_price=total_price.toString();
        $('#input_price').val(total_price);
        $('#input_price_511').val(total_price);
        $('#input_price_5').val(total_price);
        $('#input_price_submit').val(total_price);
        $('#input_price_511_submit').val(total_price);
        $('#input_price_5_submit').val(total_price);
        var total_price = total_price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + ' vnđ';
        $('#price_format_span').html(total_price);
        $('#input_price_format').html(total_price);
        $('#price_format_span_511').html(total_price);
        $('#price_format_span_5').html(total_price);
    });

// Select all tabs
//    $('.nav-tabs a').click(function(){
//        $(this).tab('show');
//    })
//
//// Select tab by name
//    $('.nav-tabs a[href="#home"]').tab('show')
//
//// Select first tab
//    $('.nav-tabs a:first').tab('show')
//
//// Select last tab
//    $('.nav-tabs a:last').tab('show')
//
//// Select fourth tab (zero-based)
//    $('.nav-tabs li:eq(3) a').tab('show')

    //$('i').ggtooltip();
});

var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('show_img_upload');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
