jQuery(function ($) {
    $("#email_dangky").on("keyup", function () {
        var site_name = $('#site_name').val();
        var check_show_email = $('#check_show_email').val();
        var check_show_username = $('#check_show_username').val();
        var check_show_pass = $('#check_show_pass').val();
        var value = $(this).val();
        link = site_name + '/check-login.html';
        var key = "user_email";
        $.ajax({
            method: "GET",
            url: link,
            data: "value=" + value + '&key=' + key,
            success: function (response) {
                if (response == 1) {
                    $('#mess_email_dang_ky').hide();
                    $('#check_show_email').val(1);
                    if (check_show_username == 1&&check_show_pass == 1) {
                        $('#dangky_name').show();
                    }
                    else {
                        $('#dangky_name').hide();
                    }
                }
                else {
                    $('#mess_email_dang_ky').show();
                    $('#check_show_email').val(0);
                    $('#dangky_name').hide();
                }
            }
        });
    });
    $("#email_dangky").on("change", function () {
        var site_name = $('#site_name').val();
        var check_show_email = $('#check_show_email').val();
        var check_show_username = $('#check_show_username').val();
        var check_show_pass = $('#check_show_pass').val();
        var value = $(this).val();
        link = site_name + '/check-login.html';
        var key = "user_email";
        $.ajax({
            method: "GET",
            url: link,
            data: "value=" + value + '&key=' + key,
            success: function (response) {
                if (response == 1) {
                    $('#mess_email_dang_ky').hide();
                    $('#check_show_email').val(1);
                    if (check_show_username == 1&&check_show_pass == 1) {
                        $('#dangky_name').show();
                    }
                    else {
                        $('#dangky_name').hide();
                    }
                }
                else {
                    $('#mess_email_dang_ky').show();
                    $('#check_show_email').val(0);
                    $('#dangky_name').hide();
                }
            }
        });
    });
    $("#username_dangky").on("keyup", function () {
        var site_name = $('#site_name').val();
        var check_show_email = $('#check_show_email').val();
        var check_show_username = $('#check_show_username').val();
        var check_show_pass = $('#check_show_pass').val();
        var value = $(this).val();
        link = site_name + '/check-login.html';
        var key = "user_name";
        $.ajax({
            method: "GET",
            url: link,
            data: "value=" + value + '&key=' + key,
            success: function (response) {
                if (response == 1) {
                    $('#mess_username_dang_ky').hide();
                    $('#check_show_username').val(1);
                    if (check_show_email == 1&&check_show_pass == 1) {
                        $('#dangky_name').show();
                    }
                    else {
                        $('#dangky_name').hide();
                    }
                }
                else {
                    $('#mess_username_dang_ky').show();
                    $('#check_show_username').val(0);
                    $('#dangky_name').hide();
                }
            }
        });
    });
    $("#username_dangky").on("change", function () {
        var site_name = $('#site_name').val();
        var check_show_email = $('#check_show_email').val();
        var check_show_username = $('#check_show_username').val();
        var check_show_pass = $('#check_show_pass').val();
        var value = $(this).val();
        link = site_name + '/check-login.html';
        var key = "user_name";
        $.ajax({
            method: "GET",
            url: link,
            data: "value=" + value + '&key=' + key,
            success: function (response) {
                if (response == 1) {
                    $('#mess_username_dang_ky').hide();
                    $('#check_show_username').val(1);
                    if (check_show_email == 1&&check_show_pass == 1) {
                        $('#dangky_name').show();
                    }
                    else {
                        $('#dangky_name').hide();
                    }
                }
                else {
                    $('#mess_username_dang_ky').show();
                    $('#check_show_username').val(0);
                    $('#dangky_name').hide();
                }
            }
        });
    });
    $("#password_dangky").on("keyup", function () {
        var confirm_password_dangky = $('#confirm_password_dangky').val();
        var check_show_pass = $('#check_show_pass').val();
        if (confirm_password_dangky != '') {
            var value = $(this).val();
            var check_show_email = $('#check_show_email').val();
            var check_show_username = $('#check_show_username').val();
            if(value==confirm_password_dangky){
                $('#mess_confirm_password_dangky').hide();
                $('#check_show_pass').val(1);
                if (check_show_email == 1&&check_show_username == 1) {
                    $('#dangky_name').show();
                }
            }
            else{
                $('#mess_confirm_password_dangky').show();
                $('#check_show_pass').val(0);
                $('#dangky_name').hide();
            }
        }
        // Must have capital letter, numbers and lowercase letters
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

        // Must have either capitals and lowercase letters or lowercase and numbers
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

        // Must be at least 6 characters long
        var okRegex = new RegExp("(?=.{6,}).*", "g");
        if (okRegex.test($(this).val()) === false) {
            // If ok regex doesn't match the password
            $('#power_pass').removeClass().addClass('error_pass').html('Mật khẩu tối thiểu 6 ký tự.');
            $('#check_show_pass').val(0);
            $('#dangky_name').hide();

        } else if (strongRegex.test($(this).val())) {
            // If reg ex matches strong password
            $('#power_pass').removeClass().addClass('success_pass').html('Mật khẩu mạnh!');
        } else if (mediumRegex.test($(this).val())) {
            // If medium password matches the reg ex
            $('#power_pass').removeClass().addClass('medium_pass').html('Hãy khiến mật khẩu mạnh hơn với chữ in hoa, số, ký tự đặc biệt!');
        } else {
            // If password is ok
            $('#power_pass').removeClass().addClass('weak_pass').html('Mật khẩu yếu, hãy sử dụng số và chữ hoa.');
        }
    });
    $("#password_dangky").on("change", function () {
        var confirm_password_dangky = $('#confirm_password_dangky').val();
        var check_show_pass = $('#check_show_pass').val();
        if (confirm_password_dangky != '') {
            var value = $(this).val();
            var check_show_email = $('#check_show_email').val();
            var check_show_username = $('#check_show_username').val();
            if(value==confirm_password_dangky){
                $('#mess_confirm_password_dangky').hide();
                $('#check_show_pass').val(1);
                if (check_show_email == 1&&check_show_username == 1) {
                    $('#dangky_name').show();
                }
            }
            else{
                $('#mess_confirm_password_dangky').show();
                $('#check_show_pass').val(0);
                $('#dangky_name').hide();
            }
        }
        // Must have capital letter, numbers and lowercase letters
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

        // Must have either capitals and lowercase letters or lowercase and numbers
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

        // Must be at least 6 characters long
        var okRegex = new RegExp("(?=.{6,}).*", "g");
        if (okRegex.test($(this).val()) === false) {
            // If ok regex doesn't match the password
            $('#power_pass').removeClass().addClass('error_pass').html('Mật khẩu tối thiểu 6 ký tự.');
            $('#check_show_pass').val(0);
            $('#dangky_name').hide();

        } else if (strongRegex.test($(this).val())) {
            // If reg ex matches strong password
            $('#power_pass').removeClass().addClass('success_pass').html('Mật khẩu mạnh!');
        } else if (mediumRegex.test($(this).val())) {
            // If medium password matches the reg ex
            $('#power_pass').removeClass().addClass('medium_pass').html('Hãy khiến mật khẩu mạnh hơn với chữ in hoa, số, ký tự đặc biệt!');
        } else {
            // If password is ok
            $('#power_pass').removeClass().addClass('weak_pass').html('Mật khẩu yếu, hãy sử dụng số và chữ hoa.');
        }
    });
    $("#confirm_password_dangky").on("keyup", function () {
        var password_dangky=$('#password_dangky').val();
        var check_show_pass = $('#check_show_pass').val();
        if (password_dangky != '') {
            var value = $(this).val();
            var check_show_email = $('#check_show_email').val();
            var check_show_username = $('#check_show_username').val();
            if(value==password_dangky){
                $('#mess_confirm_password_dangky').hide();
                $('#check_show_pass').val(1);
                if (check_show_email == 1&&check_show_username == 1) {
                    $('#dangky_name').show();
                }
            }
            else{
                $('#mess_confirm_password_dangky').show();
                $('#check_show_pass').val(0);
                $('#dangky_name').hide();
            }
        }
        var okRegex = new RegExp("(?=.{6,}).*", "g");
        if (okRegex.test(password_dangky) === false) {
            // If ok regex doesn't match the password
            //$('#power_pass').removeClass().addClass('error_pass').html('Mật khẩu tối thiểu 6 ký tự.');
            $('#check_show_pass').val(0);
            $('#dangky_name').hide();

        }
    });
    $("#confirm_password_dangky").on("change", function () {
        var password_dangky=$('#password_dangky').val();
        var check_show_pass = $('#check_show_pass').val();
        if (password_dangky != '') {
            var value = $(this).val();
            var check_show_email = $('#check_show_email').val();
            var check_show_username = $('#check_show_username').val();
            if(value==password_dangky){
                $('#mess_confirm_password_dangky').hide();
                $('#check_show_pass').val(1);
                if (check_show_email == 1&&check_show_username == 1) {
                    $('#dangky_name').show();
                }
            }
            else{
                $('#mess_confirm_password_dangky').show();
                $('#check_show_pass').val(0);
                $('#dangky_name').hide();
            }
        }
        var okRegex = new RegExp("(?=.{6,}).*", "g");
        if (okRegex.test(password_dangky) === false) {
            // If ok regex doesn't match the password
            //$('#power_pass').removeClass().addClass('error_pass').html('Mật khẩu tối thiểu 6 ký tự.');
            $('#check_show_pass').val(0);
            $('#dangky_name').hide();

        }
    });
    $("#reset_login").on("click", function () {
        $('#mess_confirm_password_dangky').hide();
        $('#mess_email_dang_ky').hide();
        $('#mess_username_dang_ky').hide();
        $('#power_pass').html('');
    });
});