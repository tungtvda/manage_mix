jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on("input",'#input_code', function () {
        ajaxCheckUserCode();
    });
    $('body').on("keyup",'#input_code', function () {
        ajaxCheckUserCode();
    });
    // check name
    $('body').on("input",'#input_name', function () {
        checkNameUser();
    });
    $('body').on("keyup",'#input_name', function () {
        checkNameUser();
    });

    // check email
    $('body').on("input",'#input_email', function () {
        checkEmailUser();
    });
    $('body').on("keyup",'#input_email', function () {
        checkEmailUser();
    });

    // check address
    $('body').on("input",'#input_address', function () {
        checkAddressUser();
    });
    $('body').on("keyup",'#input_address', function () {
        checkAddressUser();
    });

    // check address
    $('body').on("input",'#input_phone', function () {
        checkPhoneUser();
    });
    $('body').on("keyup",'#input_phone', function () {
        checkPhoneUser();
    });
    // check address
    $('body').on("input",'#input_mobi', function () {
        checkMobiUser();
    });
    $('body').on("keyup",'#input_mobi', function () {
        checkMobiUser();
    });

    $('body').on("click",'#submit_form_action', function () {
            var form_data=$("#submit_form").serializeArray();
            var error_free=true;
            for (var input in form_data){
                if(form_data[input]['name']!="mr"){
                    var element=$("#input_"+form_data[input]['name']);
                    var error=$("#error_"+form_data[input]['name']);
                    var valid=element.hasClass("valid");
                    if (valid==false){
                        alert(form_data[input]['name']);
                        element.addClass("input-error").removeClass("valid");
                        error.show();
                        error_free=false
                    }
                }
            }
            if (error_free!=false){
                $( "#submit_form" ).submit();
            }

    });

    $('body').on("click",'.view_popup_detail', function () {
        document.getElementById("input_user_code").readOnly = true;
        document.getElementById("input_email_user").readOnly = true;
        document.getElementById("input_user_name").readOnly = true;
        document.getElementById("input_password").readOnly = true;
        document.getElementById("input_password_confirm").readOnly = true;
        var Id = $(this).attr("countid");
        var name = $(this).attr("name_record");
        show_edit_nhanvien(Id,name);
    });
    $('body').on("click",'#reset_form_popup', function () {
        $( "#input_check_edit" ).val('add');
        resetForm("#submit_form");
    });
    $('body').on("click",'#create_popup', function () {
        var output = document.getElementById('show_img_upload');
        output.src = url+'/view/default/themes/images/no-image.jpg';
        resetForm("#submit_form");
        $( "#input_check_edit" ).val('add');
        $( "#title_form" ).html('Tạo mới khách hàng');
    });

    $('body').on('click','.edit_function', function () {
        document.getElementById("input_user_code").readOnly = true;
        document.getElementById("input_email_user").readOnly = true;
        document.getElementById("input_user_name").readOnly = true;
        document.getElementById("input_password").readOnly = true;
        document.getElementById("input_password_confirm").readOnly = true;
        var lenght = $('.click_check_list:checked').length;
        if (lenght == 0) {
            lnv.alert({
                title: 'Lỗi',
                content: 'Bạn vui lòng chọn bản ghi',
                alertBtnText: 'Ok',
                iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                alertHandler: function () {
                    $('#modal-form').modal('hide');
                }
            });
        }else{
            if(lenght>1)
            {
                lnv.alert({
                    title: 'Lỗi',
                    content: 'Bạn chỉ được chọn một bản ghi',
                    alertBtnText: 'Ok',
                    iconBtnText:'<i style="color: red;" class="ace-icon fa fa-exclamation-triangle red"></i>',
                    alertHandler: function () {
                        $('#modal-form').modal('hide');
                    }
                });
            }else{
                $('.click_check_list:checked').each(function() {
                    var Id = $(this).attr("value");
                    var name = $(this).attr("name_record");
                    show_edit_nhanvien(Id,name)
                });
            }
        }
    });

    //$('i').ggtooltip();
});

function show_edit_nhanvien(Id,name){
    $( "#title_form" ).html('Chỉnh sửa nhân viên "<b>'+name+'</b>"');
    resetForm("#submit_form");
    $( "#input_check_edit" ).val('edit');
    if(Id!=''){
        jQuery.post(url+"/get-detail-ajax/",
            {
                id: Id,
                table:'user'
            }
            )
            .done(function (data) {
                if(data!=0)
                {
                    var obj = jQuery.parseJSON(data);
                    if(obj.avatar!=''){
                        var output = document.getElementById('show_img_upload');
                        output.src = url+obj.avatar;
                    }
                    if(obj.user_code!=''){
                        $('#input_user_code').val(obj.user_code);
                        $('#input_user_code').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_user_code').addClass("input-error").removeClass("valid");
                    }

                    if(obj.user_role==1)
                    {
                        $("#input_user_role").prop('checked', true);
                    }else{
                        $("#input_user_role").prop('checked', false);
                    }
                    if(obj.name!=''){
                        $('#input_full_name').val(obj.name);
                        $('#input_full_name').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_full_name').addClass("input-error").removeClass("valid");
                    }
                    var mr=obj.mr;
                    if(mr!='')
                    {
                        $(".chosen-default span").html(mr);
                        //$('.mr_user option').each(function() {
                        //
                        //    if($(this).val() == mr) {
                        //        $(this).prop("selected", true);
                        //    }
                        //});
                    }
                    if(obj.birthday!=''){
                        $('#input_birthday').val(obj.birthday);
                        $('#input_birthday').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_birthday').addClass("input-error").removeClass("valid");
                    }
                    if(obj.user_email!=''){
                        $('#input_email_user').val(obj.user_email);
                        $('#input_email_user').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_email_user').addClass("input-error").removeClass("valid");
                    }
                    if(obj.address!=''){
                        $('#input_address_user').val(obj.address);
                        $('#input_address_user').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_address_user').addClass("input-error").removeClass("valid");
                    }
                    if(obj.user_name!=''){
                        $('#input_user_name').val(obj.user_name);
                        $('#input_user_name').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_user_name').addClass("input-error").removeClass("valid");
                    }
                    if(obj.phone!=''){
                        $('#input_user_phone').val(obj.phone);
                        $('#input_user_phone').removeClass("input-error").addClass("valid");
                    }
                    else{
                        $('#input_user_phone').addClass("input-error").removeClass("valid");
                    }
                    $('#input_user_ngay_lam_viec').val(obj.ngay_lam_viec);
                    $('#input_user_ngay_chinh_thuc').val(obj.ngay_chinh_thuc);

                    $('#input_password').val('code');
                    $('#input_password').removeClass("input-error").addClass("valid");
                    $('#input_password_confirm').val('code');
                    $('#input_password_confirm').removeClass("input-error").addClass("valid");
                    $('#hidden_edit_pass').hide();
                    $('#input_id_edit').val(Id);
                    //$('.mr_user').val(mr).prop('selected', true);
                    //$(".chosen-default span").val(mr);

                }
            });
    }
    else{
        alert('Ban không thể xem chi tiết nhân viên');
    }
}
function resetForm(form){
    $(form).trigger('reset');
}
//check địa chỉ nhân viên
function checkPhoneUser(){
    var value = $("#input_phone").val();
    if(value==''){
        var mess='Bạn vui lòng nhập số điện thoại';
        showHiddenPhoneUser(0,mess);
    }else{
        var mess='';
        showHiddenPhoneUser(1,mess);
    }
}
function showHiddenPhoneUser(res,mess){
    var error_user_phone=$("#error_phone" );
    if (res == 1) {
        error_user_phone.hide();
        $('#icon_error_phone').hide();
        $('#input_phone').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#icon_error_phone').show();
        $('#input_phone').addClass("input-error").removeClass("valid");
        error_user_phone.removeClass("success-color");
        error_user_phone.addClass("error-color");
        error_user_phone.html(mess);
        error_user_phone.show();
    }
}

function checkMobiUser(){
    var value = $("#input_mobi").val();
    if(value==''){
        var mess='Bạn vui lòng nhập số di động';
        showHiddenMobiUser(0,mess);
    }else{
        var mess='';
        showHiddenMobiUser(1,mess);
    }
}
function showHiddenMobiUser(res,mess){
    var error_user_phone=$("#error_mobi" );
    if (res == 1) {
        error_user_phone.hide();
        $('#icon_error_mobi').hide();
        $('#input_mobi').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#icon_error_mobi').show();
        $('#input_mobi').addClass("input-error").removeClass("valid");
        error_user_phone.removeClass("success-color");
        error_user_phone.addClass("error-color");
        error_user_phone.html(mess);
        error_user_phone.show();
    }
}


//check địa chỉ nhân viên
function checkAddressUser(){
    var value = $("#input_address").val();
    if(value==''){
        var mess='Bạn vui lòng nhập địa chỉ';
        showHiddenAddressUser(0,mess);
    }else{
        var mess='';
        showHiddenAddressUser(1,mess);
    }
}
function showHiddenAddressUser(res,mess){
    var error_address_user=$("#error_address" );
    if (res == 1) {
        error_address_user.hide();
        $('#icon_error_address').hide();
        $('#input_address').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#icon_error_address').show();
        $('#input_address').addClass("input-error").removeClass("valid");
        error_address_user.removeClass("success-color");
        error_address_user.addClass("error-color");
        error_address_user.html(mess);
        error_address_user.show();
    }
}


// check mã nhân viên
function showHiddenUserEmail(res,mess){
    var email_user_error=$("#error_email" );
    if (res == 1) {
        email_user_error.hide();
        $('#icon_error_email').hide();
        $('#icon_success_email').show();
        $('#input_email').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#icon_error_email').show();
        $('#icon_success_email').hide();
        $('#input_email').addClass("input-error").removeClass("valid");
        email_user_error.removeClass("success-color");
        email_user_error.addClass("error-color");
        email_user_error.html(mess);
        email_user_error.show();
    }
}
function checkEmailUser(){
    var value = $("#input_email").val();
    var link = url + '/check-validate.html';
    var input_check_edit=$("#input_check_edit").val();
    if(input_check_edit=='add')
    {
    if(value!=''){
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email=re.test(value);
        if(is_email){
            $.ajax({
                method: "GET",
                url: link,
                data: "value=" + value + '&key=email&table=customer',
                success: function (response) {
                    var mess='Email "'+value+'" đã tồn tại trong hệ thống';
                    showHiddenUserEmail(response,mess);
                }
            });
        }
        else{
            var mess='Email không đúng định dạng';
            showHiddenUserEmail(0,mess);
        }
    }
    else{
        var mess='Bạn vui lòng nhập email';
        showHiddenUserEmail(0,mess);
    }}
}


// check ngày sinh
function checkBirthdayUser(){
    var value = $("#input_birthday").val();
    if(value==''){
        var mess='Bạn vui lòng nhập ngày tháng năm sinh';
        showHiddenBirthdayUser(0,mess);
    }else{
        var value_date = value.split("-");
        var value = new Date(value_date[2], value_date[1] - 1, value_date[0]);
        var mess='';
        var res=0;
        var eighteenYearsAgo = moment().subtract(18, "years");
        var birthday = moment(value);

        if (!birthday.isValid()) {
            mess="Không đúng định dạng ngày tháng năm";
        }
        else if (eighteenYearsAgo.isAfter(birthday)) {
            mess='';
            res=1;
        }
        else {
            mess='Ngày sinh của bạn không đủ tuổi đăng ký';
        }
        //var mess='';
        showHiddenBirthdayUser(res,mess);
    }
}
function showHiddenBirthdayUser(res,mess){
    var birthday_user_error=$("#error_birthday" );
    if (res == 1) {
        birthday_user_error.hide();
        $('#input_birthday').removeClass("input-error").addClass("valid");
        $('.date_icon').removeClass("error-color");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#input_birthday').addClass("input-error").removeClass("valid");
        $('.date_icon').addClass("error-color");
        birthday_user_error.removeClass("success-color");
        birthday_user_error.addClass("error-color");
        birthday_user_error.html(mess);
        birthday_user_error.show();
    }
}

// check mã nhân viên
function showHiddenUserCode(res,mess){
    var error_user_code=$("#error_code" );
    if (res == 1) {
        error_user_code.hide();
        $('#icon_error_code').hide();
        $('#icon_success_code').show();
        $('#input_code').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#icon_error_code').show();
        $('#icon_success_code').hide();
        $('#input_code').addClass("input-error").removeClass("valid");
        error_user_code.removeClass("success-color");
        error_user_code.addClass("error-color");
        error_user_code.html(mess);
        error_user_code.show();
    }
}
function ajaxCheckUserCode(){
    var value = $("#input_code").val();
    var link = url + '/check-validate.html';
    var input_check_edit=$("#input_check_edit").val();
    if(input_check_edit=='add')
    {
        if(value!=''){
            $.ajax({
                method: "GET",
                url: link,
                data: "value=" + value + '&key=code&table=customer',
                success: function (response) {
                    var mess='Mã khách hàng "'+value+'" đã tồn tại trong hệ thống';
                    showHiddenUserCode(response,mess);
                }
            });
        }
        else{
            var mess='Bạn vui lòng nhập mã nhân viên';
            showHiddenUserCode(0,mess);
        }
    }

}

// check name user
function checkNameUser(){
    var value = $("#input_name").val();
    if(value==''){
        var mess='Bạn vui lòng nhập tên';
        showHiddenNameUser(0,mess);
    }else{
        var mess='';
        showHiddenNameUser(1,mess);
    }
}
function showHiddenNameUser(res,mess){
    var name_user_error=$("#error_name" );
    if (res == 1) {
        name_user_error.hide();
        $('#icon_error_name').hide();
        $('#input_name').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#icon_error_name').show();
        $('#input_name').addClass("input-error").removeClass("valid");
        name_user_error.removeClass("success-color");
        name_user_error.addClass("error-color");
        name_user_error.html(mess);
        name_user_error.show();
    }
}

function validate(date){
    var eighteenYearsAgo = moment().subtract(18, "years");
    var birthday = moment(date);

    if (!birthday.isValid()) {
        return "invalid date";
    }
    else if (eighteenYearsAgo.isAfter(birthday)) {
        return "okay, you're good";
    }
    else {
        return "sorry, no";
    }
}
