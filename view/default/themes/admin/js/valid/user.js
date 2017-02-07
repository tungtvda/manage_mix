jQuery(function ($) {
    url = $('#url_input').val();

    $('body').on("input",'#user_code', function () {
        ajaxCheckUserCode();
    });
    $('body').on("keyup",'#user_code', function () {
        ajaxCheckUserCode();
    });
    // check name
    $('body').on("input",'#name_user', function () {
        checkNameUser();
    });
    $('body').on("keyup",'#name_user', function () {
        checkNameUser();
    });
    //$('i').ggtooltip();
});

function showHiddenUserCode(res,mess){
    var user_code_error=$("#user_code_error" );
    if (res == 1) {
        $('#user_code_error').hide();
        $('#user_code_error_icon').hide();
        $('#user_code_success_icon').show();
        $('#user_code').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#user_code_error_icon').show();
        $('#user_code_success_icon').hide();
        $('#user_code').addClass("input-error").removeClass("valid");
        user_code_error.removeClass("success-color");
        user_code_error.addClass("error-color");
        user_code_error.html(mess);
        user_code_error.show();
    }
}
function ajaxCheckUserCode(){
    var value = $("#user_code").val();
    var link = url + '/check-login.html';
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

// check name user
function checkNameUser(){
    var value = $("#name_user").val();
    if(value==''){
        var mess='Bạn vui lòng chọn danh xưng và nhập tên';
        showHiddenNameUser(0,mess);
    }else{
        var mess='';
        showHiddenNameUser(1,mess);
    }
}
function showHiddenNameUser(res,mess){
    var name_user_error=$("#name_user_error" );
    if (res == 1) {
        name_user_error.hide();
        $('#name_user_error_icon').hide();
        $('#name_user').removeClass("input-error").addClass("valid");
    }
    else {
        if(res!=0)
        {
            mess=res;
        }
        $('#name_user_error_icon').show();
        $('#name_user').addClass("input-error").removeClass("valid");
        name_user_error.removeClass("success-color");
        name_user_error.addClass("error-color");
        name_user_error.html(mess);
        name_user_error.show();
    }
}
