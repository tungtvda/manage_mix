jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on("input",'#input_user_code', function () {
        ajaxCheckUserCode();
    });
    $('body').on("keyup",'#input_user_code', function () {
        ajaxCheckUserCode();
    });
    // check name
    $('body').on("input",'#input_full_name', function () {
        checkNameUser();
    });
    $('body').on("keyup",'#input_full_name', function () {
        checkNameUser();
    });

    // check name
    $('body').on("input",'#input_birthday', function () {
        checkBirthdayUser();
    });
    $('body').on("keyup",'#input_birthday', function () {
        checkBirthdayUser();
    });
    $('body').on("change",'#input_birthday', function () {
        checkBirthdayUser();
    });

    // check email
    $('body').on("input",'#input_email_user', function () {
        checkEmailUser();
    });
    $('body').on("keyup",'#input_email_user', function () {
        checkEmailUser();
    });

    // check address
    $('body').on("input",'#input_address_user', function () {
        checkAddressUser();
    });
    $('body').on("keyup",'#input_address_user', function () {
        checkAddressUser();
    });

    // check address
    $('body').on("input",'#input_user_phone', function () {
        checkPhoneUser();
    });
    $('body').on("keyup",'#input_user_phone', function () {
        checkPhoneUser();
    });


    // check address
    $('body').on("input",'#input_user_name', function () {
        checkUserName();
    });
    $('body').on("keyup",'#input_user_name', function () {
        checkUserName();
    });

    // check pass
    $('body').on("input",'#input_password', function () {
        checkUserPassword();
    });
    $('body').on("keyup",'#input_password', function () {
        checkUserPassword();
    });
    // check pass confirm
    $('body').on("input",'#input_password_confirm', function () {
        checkUserPasswordConfirm();
    });
    $('body').on("keyup",'#input_password_confirm', function () {
        checkUserPasswordConfirm();
    });

    $('body').on("click",'#submit_form_action', function () {
            var form_data=$("#submit_form").serializeArray();
            var error_free=true;
            for (var input in form_data){
                if(form_data[input]['name']!="mr"&&form_data[input]['name']!="file-format"&&form_data[input]['name']!="avatar"&&form_data[input]['name']!="user_role")
                {
                    var element=$("#input_"+form_data[input]['name']);
                    var error=$("#error_"+form_data[input]['name']);
                    var valid=element.hasClass("valid");
                    if (valid==false){
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
        $('#hidden_edit_pass').show();
        var output = document.getElementById('show_img_upload');
        output.src = url+'/view/default/themes/images/no-image.jpg';
        document.getElementById("input_user_code").readOnly = false;
        document.getElementById("input_email_user").readOnly = false;
        document.getElementById("input_user_name").readOnly = false;
        document.getElementById("input_password").readOnly = false;
        document.getElementById("input_password_confirm").readOnly = false;
        resetForm("#submit_form");
        $( "#input_check_edit" ).val('add');
        $( "#title_form" ).html('Tạo mới nhân viên');
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
    var value = $("#input_user_phone").val();
    if(value==''){
        var mess='Bạn vui lòng nhập số điện thoại';
        showHiddenPhoneUser(0,mess);
    }else{
        var mess='';
        showHiddenPhoneUser(1,mess);
    }
}
function showHiddenPhoneUser(res,mess){
    var error_user_phone=$("#error_user_phone" );
    if (res == 1) {
        error_user_phone.hide();
        $('#error_icon_user_phone').hide();
        $('#input_user_phone').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#error_icon_user_phone').show();
        $('#input_user_phone').addClass("input-error").removeClass("valid");
        error_user_phone.removeClass("success-color");
        error_user_phone.addClass("error-color");
        error_user_phone.html(mess);
        error_user_phone.show();
    }
}


// check pass confirm
function checkUserPasswordConfirm(){
    var error_password_confirm=$("#error_password_confirm" );
    var value = $("#input_password_confirm").val();
    if(value==''){
        var mess='Bạn vui lòng xác nhận mật khẩu';
        showHiddenPasswordConfirmUser(0,mess);
    }else{
        var password_dangky=$('#input_password').val();
        if(value==password_dangky){
            error_password_confirm.hide();
            error_password_confirm.html('');
            $('#error_icon_user_pass_con').hide();
            $('#input_password_confirm').removeClass("input-error").addClass("valid");
        }else{
            error_password_confirm.show();
            error_password_confirm.html('Hai mật khẩu không khớp');
            $('#error_icon_user_pass_con').show();
            $('#input_password_confirm').addClass("input-error").removeClass("valid");
        }
    }
}

function showHiddenPasswordConfirmUser(res,mess){
    var error_password_confirm=$("#error_password_confirm" );
    if (res == 1) {
        error_password_confirm.hide();
        $('#error_icon_user_pass_con').hide();
        $('#input_password_confirm').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#error_icon_user_pass_con').show();
        $('#input_password_confirm').addClass("input-error").removeClass("valid");
        error_password_confirm.removeClass("success-color");
        error_password_confirm.addClass("error-color");
        error_password_confirm.html(mess);
        error_password_confirm.show();
    }
}


// check password
function checkUserPassword(){
    var error_password_confirm=$("#error_password_confirm" );
    var value = $("#input_password").val();
    var confirm_password_dangky = $('#input_password_confirm').val();
    if(value==''){
        var mess='Bạn vui lòng nhập mật khẩu';
        showHiddenPasswordUser(0,mess);
    }else{
        if(confirm_password_dangky!=""){
            if(value==confirm_password_dangky)
            {
                error_password_confirm.hide();
                error_password_confirm.html('');
                $('#input_password_confirm').removeClass("input-error").addClass("valid");
            }else{
                error_password_confirm.show();
                error_password_confirm.html('Hai mật khẩu không khớp');
                $('#input_password_confirm').addClass("input-error").removeClass("valid");
            }
        }
        // Must have capital letter, numbers and lowercase letters
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

        // Must have either capitals and lowercase letters or lowercase and numbers
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

        // Must be at least 6 characters long
        var okRegex = new RegExp("(?=.{6,}).*", "g");
        if (okRegex.test(value) === false) {
            // If ok regex doesn't match the password
            $('#error_password').removeClass().addClass('error-color').show().html('Mật khẩu tối thiểu 6 ký tự.');
            $('#error_password').addClass('error-color-size');
            $('#input_password').addClass("input-error").removeClass("valid");


        } else if (strongRegex.test(value)) {
            // If reg ex matches strong password
            showHiddenPasswordValidUser('success_pass','Mật khẩu mạnh!');
            //$('#power_pass').removeClass().addClass('success_pass').html('Mật khẩu mạnh!');
        } else if (mediumRegex.test(value)) {
            // If medium password matches the reg ex
            showHiddenPasswordValidUser('medium_pass','Hãy khiến mật khẩu mạnh hơn với chữ in hoa, số, ký tự đặc biệt!');
            //$('#power_pass').removeClass().addClass('medium_pass').html('Hãy khiến mật khẩu mạnh hơn với chữ in hoa, số, ký tự đặc biệt!');
        } else {
            // If password is ok
            showHiddenPasswordValidUser('weak_pass','Mật khẩu yếu, hãy sử dụng số và chữ hoa!');
            //$('#power_pass').removeClass().addClass('weak_pass').html('Mật khẩu yếu, hãy sử dụng số và chữ hoa.');
        }

        //var mess='';
        //showHiddenPasswordUser(1,mess);
    }
}
function  showHiddenPasswordValidUser(res,mess){
    $('#error_password').removeClass().addClass(res).html(mess);
    $('#input_password').removeClass("input-error").addClass("valid");
    $('#error_password').addClass('error-color-size');
    $('#error_icon_user_pass').hide();
}
function showHiddenPasswordUser(res,mess){
    var error_password=$("#error_password" );
    if (res == 1) {
        error_password.hide();
        $('#error_icon_user_pass').hide();
        $('#input_password').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#error_icon_user_pass').show();
        $('#input_password').addClass("input-error").removeClass("valid");
        error_password.removeClass("success-color");
        error_password.addClass("error-color");
        error_password.html(mess);
        error_password.show();
    }
}


// check tên đăng nhập
function showHiddenUserName(res,mess){
    var error_user_name=$("#error_user_name" );
    if (res == 1) {
        error_user_name.hide();
        $('#error_icon_user_name').hide();
        $('#success_icon_user_name').show();
        $('#input_user_name').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#error_icon_user_name').show();
        $('#success_icon_user_name').hide();
        $('#input_user_name').addClass("input-error").removeClass("valid");
        error_user_name.removeClass("success-color");
        error_user_name.addClass("error-color");
        error_user_name.html(mess);
        error_user_name.show();
    }
}
function checkUserName(){
    var value = $("#input_user_name").val();
    var link = url + '/check-login.html';
    var input_check_edit=$("#input_check_edit").val();
    if(input_check_edit=='add')
    {
    if(value!=''){
        $.ajax({
            method: "GET",
            url: link,
            data: "value=" + value + '&key=user_name',
            success: function (response) {
                var mess='Tên đăng nhập "'+value+'" đã tồn tại trong hệ thống';
                showHiddenUserName(response,mess);
            }
        });
    }
    else{
        var mess='Bạn vui lòng điền tên đăng nhập';
        showHiddenUserName(0,mess);
    }}
}


//check địa chỉ nhân viên
function checkAddressUser(){
    var value = $("#input_address_user").val();
    if(value==''){
        var mess='Bạn vui lòng nhập địa chỉ';
        showHiddenAddressUser(0,mess);
    }else{
        var mess='';
        showHiddenAddressUser(1,mess);
    }
}
function showHiddenAddressUser(res,mess){
    var error_address_user=$("#error_address_user" );
    if (res == 1) {
        error_address_user.hide();
        $('#error_icon_address_user').hide();
        $('#input_address_user').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#error_icon_address_user').show();
        $('#input_address_user').addClass("input-error").removeClass("valid");
        error_address_user.removeClass("success-color");
        error_address_user.addClass("error-color");
        error_address_user.html(mess);
        error_address_user.show();
    }
}


// check mã nhân viên
function showHiddenUserEmail(res,mess){
    var email_user_error=$("#error_email_user" );
    if (res == 1) {
        email_user_error.hide();
        $('#email_user_error_icon').hide();
        $('#email_user_success_icon').show();
        $('#input_email_user').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#email_user_error_icon').show();
        $('#email_user_success_icon').hide();
        $('#input_email_user').addClass("input-error").removeClass("valid");
        email_user_error.removeClass("success-color");
        email_user_error.addClass("error-color");
        email_user_error.html(mess);
        email_user_error.show();
    }
}
function checkEmailUser(){
    var value = $("#input_email_user").val();
    var link = url + '/check-login.html';
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
                data: "value=" + value + '&key=user_email',
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
    var error_user_code=$("#error_user_code" );
    if (res == 1) {
        error_user_code.hide();
        $('#user_code_error_icon').hide();
        $('#user_code_success_icon').show();
        $('#input_user_code').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#user_code_error_icon').show();
        $('#user_code_success_icon').hide();
        $('#input_user_code').addClass("input-error").removeClass("valid");
        error_user_code.removeClass("success-color");
        error_user_code.addClass("error-color");
        error_user_code.html(mess);
        error_user_code.show();
    }
}
function ajaxCheckUserCode(){
    var value = $("#input_user_code").val();
    var link = url + '/check-login.html';
    var input_check_edit=$("#input_check_edit").val();
    if(input_check_edit=='add')
    {
        if(value!=''){
            $.ajax({
                method: "GET",
                url: link,
                data: "value=" + value + '&key=user_code',
                success: function (response) {
                    var mess='Mã nhân viên "'+value+'" đã tồn tại trong hệ thống';
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
    var value = $("#input_full_name").val();
    if(value==''){
        var mess='Bạn vui lòng chọn danh xưng và nhập tên';
        showHiddenNameUser(0,mess);
    }else{
        var mess='';
        showHiddenNameUser(1,mess);
    }
}
function showHiddenNameUser(res,mess){
    var name_user_error=$("#error_full_name" );
    if (res == 1) {
        name_user_error.hide();
        $('#name_user_error_icon').hide();
        $('#input_full_name').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#name_user_error_icon').show();
        $('#input_full_name').addClass("input-error").removeClass("valid");
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
