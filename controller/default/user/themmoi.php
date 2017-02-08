<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR."/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();

_returnCheckPermison(3, 2);
if (_returnCheckAction(1) == 0) {
    redict(_returnLinkDangNhap());
}

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_bread = '<li class="active">Thêm nhân viên</li>';
$data['breadcrumbs'] = $url_bread;
$data['title'] = 'Thêm nhân viên';
$data['module_valid'] = "user";
$count = 8;
show_header($data);
show_left($data, 'user', 'user_list');
show_breadcrumb($data);
show_navigation($data);
show_user_themmoi($data);
show_footer($data);
show_valid_form($data);
show_script_form($data);
if (isset($_POST['user_code']) && isset($_POST['full_name']) && isset($_POST['birthday']) && isset($_POST['email_user']) && isset($_POST['address_user']) && isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
    $user_code = _returnPostParamSecurity('user_code');
    $full_name = _returnPostParamSecurity('full_name');
    $mr = _returnPostParamSecurity('mr');
    $input_birthday = _returnPostParamSecurity('birthday');
    $email_user = _returnPostParamSecurity('email_user');
    $user_name = _returnPostParamSecurity('user_name');
    $address_user = _returnPostParamSecurity('address_user');
    $password = _returnPostParamSecurity('password');
    $password_confirm = _returnPostParamSecurity('password_confirm');
    $avatar='';
    if ($user_code != "" && $full_name != '' && $input_birthday != '' && $email_user != '' && $user_name != '' && $password != '' && $password_confirm != '') {
        if($password!=$password_confirm){
            echo '<script>alert("Hai mật khẩu không khớp")</script>';
        }else{
            $dk_check_user="user_name='".$user_name."'";
            $dk_check_user.="or user_email ='".$email_user."'";
            $dk_check_user.=" or user_email ='".$user_code."'";
            $data_check_exist_user=user_getByTop('',$dk_check_user,'id desc');
            if(count($data_check_exist_user)>0)
            {
                 echo "<script>alert('Mã nhân viên, tên đăng nhập, email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
            }else{
                $folder = LocDau($email_user);
                $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/" . $folder . '/';
                $avatar=_returnUploadImg($target_dir, 'avatar',"/view/default/themes/uploads/" . $folder . '/');
                $dangky = new user();
                $dangky->name=$full_name;
                $dangky->user_code=$user_code;
                $dangky->user_name=$user_name;
                $dangky->mr=$mr;
                $dangky->birthday=date("Y-m-d", strtotime($input_birthday));
                $dangky->user_email=$email_user;
                $dangky->address=$address_user;
                $Pass=hash_pass($password);
                $dangky->password=$Pass;
                $dangky->created=_returnGetDateTime();
                $dangky->login_two_steps=1;
                $dangky->status=1;
                user_insert($dangky);
                $subject = "Thông báo đăng ký tài khoản tại hệ thống quản lý MIXTOURIST";
                $message='';
                if($mr=='')
                {
                    $name_full_mer=$full_name;
                }else{
                    $name_full_mer=$mr.'.'.$full_name;
                }

                $message .='<div style="float: left; width: 100%">
                            <p>Xin chào: <span style="color: #132fff; font-weight: bold"> '.$name_full_mer.'</span>!</p>
                            <p>Chúng tôi đã tạo thành công tài khoản của bạn, giờ đây bạn có thể truy cập và sử dụng hệ thống quản lý MIXTOURIST</p>
                            <p>Link đăng nhập: <span style="color: #132fff; font-weight: bold">'.SITE_NAME.'/dang-nhap.html</span>,</p>
                            <p>Mã nhân viên: <span style="color: #132fff; font-weight: bold">'.$user_code.'</span>,</p>
                            <p>Email: <span style="color: #132fff; font-weight: bold">'.$email_user.'</span>,</p>
                            <p>Username: <span style="color: #132fff; font-weight: bold">'.$user_name.'</span>,</p>
                            <p>Mật khẩu: <span style="color: #132fff; font-weight: bold">'.$password.'</span>,</p>
                            <p>Ngày sinh: <span style="color: #132fff; font-weight: bold">'.$input_birthday.'</span>,</p>
                            <p>Địa chỉ: <span style="color: #132fff; font-weight: bold">'.$address_user.'</span>,</p>
                            <p>Ngày gửi: <span style="color: #132fff; font-weight: bold">'.date("d-m-Y H:i:s", strtotime(_returnGetDateTime())).'</span>,</p>
                        </div>';
                SendMail($email_user, $message, $subject);
//                echo "<script>alert('Bạn đã đăng ký thành công, vui lòng đợi chúng tôi xác nhận tài khoản của bạn, xin cảm ơn!')</script>";
            }
        }
    }else{
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';
    }
}
exit;
if (isset($_FILES['avatar'])) {
//    print_r($_FILES['avatar']);
    $folder = LocDau($email_user);
    $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/" . $folder . '/';
    _returnmakedirs($target_dir, $mode = 0777);
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
//    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
//    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["avatar"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}