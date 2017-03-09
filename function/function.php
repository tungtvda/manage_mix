<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 4:21 PM
 */
require_once DIR . '/model/userService.php';
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
require_once(DIR . "/common/hash_pass.php");

function _returnCheckPermison($module_id = 0, $form_id = 0, $action_id = 0)
{
    // Kiểm tra có tồn tại user không
    _returnCheckExitUser();
    // Lấy thông tin user
    $data_user = user_getById($_SESSION['user_id']);

    if (count($data_user) == 0) {
        redict(_returnLinkDangNhap());
    }

    // kiểm tra thời gian đăng nhập
    $date_compare = $data_user[0]->time_token;
    $date_check = date('Y-m-d H:i:s', strtotime('+15 minute', strtotime($date_compare)));
    $currentDate = _returnGetDateTime();
    if (strtotime($currentDate) > strtotime($date_check)) {
        redict(_returnLinkDangNhap());
    }

    $user_update = new user();
    $user_update->id = $_SESSION['user_id'];
    $user_update->time_token = _returnGetDateTime();
    user_update_time_login($user_update);
    // kiểm tra quyền có phải là super admin
    if ($data_user[0]->user_role == 1) {
        return true;
    }
    $permison_module = explode(',', $data_user[0]->permison_module);
    $permison_form = explode(',', $data_user[0]->permison_form);
    $permison_action = explode(',', $data_user[0]->permison_action);

    if (!in_array($module_id, $permison_module) || $module_id == 0) {
        redict(_returnLinkDangNhap('Bạn không có quyền truy cập vào hệ thống'));
    }

    if ($form_id != 0) {

        if (!in_array($form_id, $permison_form)) {
            redict(_returnLinkDangNhap('Bạn không có quyền truy cập vào hệ thống'));
        } else {
            return true;
        }
    }


    $_SESSION['user_permison_action'] = $permison_action;
    return true;

}

function _returnCheckAction($action_id = 0)
{
    // Kiểm tra có tồn tại user không
    _returnCheckExitUser();
    // Lấy thông tin user
    $data_user = user_getById($_SESSION['user_id']);
    if (count($data_user) == 0) {
        redict(_returnLinkDangNhap());
    }
    // kiểm tra thời gian đăng nhập
    $date_compare = $data_user[0]->time_token;
    $date_check = date('Y-m-d H:i:s', strtotime('+15 minute', strtotime($date_compare)));
    $currentDate = _returnGetDateTime();
    if (strtotime($currentDate) > strtotime($date_check)) {
        redict(_returnLinkDangNhap());
    }
    $user_update = new user();
    $user_update->id = $_SESSION['user_id'];
    $user_update->time_token = _returnGetDateTime();
    user_update_time_login($user_update);
    // kiểm tra quyền có phải là super admin
    if ($data_user[0]->user_role == 1) {
        return true;
    }
    $permison_action = explode(',', $data_user[0]->permison_action);
    if ($action_id != 0) {
        if (!in_array($action_id, $permison_action)) {
            return false;
        } else {
            return true;
        }
    }
    return true;

}

function _returnCheckPermisonAction($action_id = 0)
{
    _returnCheckExitUser();
    if ($action_id == 0) {
        redict(_returnLinkDangNhap('Bạn không có quyền truy cập vào hệ thống'));
    }
    if (!in_array($action_id, $_SESSION['user_permison_action'])) {
        redict(_returnLinkDangNhap('Bạn không có quyền truy cập vào hệ thống'));
    }
    return true;
}

function _returnCheckExitUser()
{
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        redict(_returnLinkDangNhap());
    }
}

function _returnLinkDangNhap($mess = '')
{
    if ($mess != '') {
        $_SESSION['mess_login'] = $mess;
    }
    return SITE_NAME . '/dang-nhap.html';
}

function _returnGetParamSecurity($param)
{
    if (isset($_GET[$param])) {
        $param_val = addslashes(strip_tags(trim($_GET[$param])));
        return $param_val;
    } else {
        return '';
    }
}

function _returnPostParamSecurity($param)
{
    if (isset($_POST[$param])) {
        $param_val = addslashes(strip_tags(trim($_POST[$param])));
        return $param_val;
    } else {
        return '';
    }
}

function _returnGetDate()
{
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    return date('Y-m-d');
}

function _returnGetDateTime()
{
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    return date('Y-m-d H:i:s');
}

function _returnDateFormatEn($date)
{
    $date = date_create($date);
    return date_format($date, 'g:ia l F j\, Y');
//        return date_format($date, 'j F Y  l');
//        echo date_format($date, 'd/m/y');
//#output: 24/03/12
//
//        echo date_format($date, 'g:i A');
//#output: 5:45 PM
//
//        echo date_format($date, 'G:ia');
//#output: 05:45pm
//
//        echo date_format($date, 'g:ia \o\n l jS F Y');
//#output: 5:45pm on Saturday 24th March 2012
}

function _returnDateFormatEnNot($date)
{
    $date = date_create($date);
    return date_format($date, 'g:i A');
}

function _returnDateFormatEnNotTime($date)
{
    $date = date_create($date);
    return date_format($date, 'F j\, Y');
}

function _returnDateFormatConvert($date)
{
    if ($date == '') {
        $DatesRemainder = '';
    } else {
        $DatesRemainder = date("Y-m-d H:i:s", strtotime($date));
    }
    return $DatesRemainder;
}

function _returnRandString($length)
{
    $str = '';
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

function _returnLogin($data_arr, $user_update)
{
    $_SESSION["user_id"] = $data_arr['user_id'];
    $_SESSION["user_role"] = $data_arr['user_role'];
    $_SESSION["user_name"] = $data_arr['user_name'];
    $_SESSION['user_permison_action'] = $data_arr['user_permison_action'];
    $_SESSION['user_permison_form'] = $data_arr['user_permison_form'];
    $_SESSION['user_permison_module'] = $data_arr['user_permison_module'];
    $user_update->time_token = _returnGetDateTime();
    $user_update->id = $data_arr['user_id'];
    user_update_time_login($user_update);
    if (isset($_SESSION['show_email'])) {
        unset($_SESSION['show_email']);
    }
    if (isset($_SESSION['show_id'])) {
        unset($_SESSION['show_id']);
    }
    if (isset($_SESSION["link_redict"])) {
        redict($_SESSION["link_redict"]);
    } else {
        redict(SITE_NAME);
    }

}

// Define a 32-byte (64 character) hexadecimal encryption key
// Note: The same encryption key used to encrypt the data must be used to decrypt the data
define('ENCRYPTION_KEY', '5a9adddba4556e4784ec17246552f2033c3f6df767516ef92a55efed1408772b');

// Code mã hóa
function _return_mc_encrypt($encrypt, $key)
{
//    $encrypt = serialize($encrypt);
//    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
//    $key = pack('H*', $key);
//    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
//    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
//    $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
    $encode = base64_encode($encrypt);
    $encode = base64_encode($encode);
    $encode = base64_encode($encode);
    $encode = base64_encode($encode);
    $encode = base64_encode($encode);
    $encode = base64_encode($encode);
    $encode = base64_encode($encode);
    return $encode;
}

// Code giải mã
function _return_mc_decrypt($decrypt, $key)
{
//    $decrypt = explode('|', $decrypt);
//    $decoded = base64_decode($decrypt[0]);
//    $iv = base64_decode($decrypt[1]);
//    if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
//        return false;
//    }
//    $key = pack('H*', $key);
//    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
//    $mac = substr($decrypted, -64);
//    $decrypted = substr($decrypted, 0, -64);
//    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
//    if ($calcmac !== $mac) {
//        return false;
//    }
//    $decrypted = unserialize($decrypted);
    $decoded = base64_decode($decrypt);
    $decoded = base64_decode($decoded);
    $decoded = base64_decode($decoded);
    $decoded = base64_decode($decoded);
    $decoded = base64_decode($decoded);
    $decoded = base64_decode($decoded);
    $decoded = base64_decode($decoded);
    return $decoded;
}

function _returnQuyen($stt)
{
    _returnCheckExitUser();
    $id = $_SESSION['user_id'];
    $data_user = user_getById($id);
    if (count($data_user) == 0) {
        redict(_returnLinkDangNhap());
    }
    if ($data_user[0]->user_role == 1) {
        return array();
    } else {
        if ($stt == 1) {
            $permison_module = explode(',', $data_user[0]->permison_module);
            return $permison_module;
        } else {
            if ($stt == 2) {
                $permison_form = explode(',', $data_user[0]->permison_form);
                return $permison_form;
            } else {
                if ($stt == 2) {
                    $permison_action = explode(',', $data_user[0]->permison_action);
                    return $permison_action;
                } else {
                    return array('error');
                }
            }

        }
    }


}

function _returnFolderRoot()
{
    return $_SERVER['DOCUMENT_ROOT'] . '/manage_mix';
}

function _returnmakedirs($dirpath, $mode = 0777)
{
    return is_dir($dirpath) || mkdir($dirpath, $mode, true);
}

function _returnUploadImg($target_dir, $file_name, $link_img)
{
    if (isset($_FILES[$file_name]) && $_FILES[$file_name]["name"] != '') {
        //    print_r($_FILES['avatar']);
        _returnmakedirs($target_dir, $mode = 0777);
        $temp = explode(".", $_FILES[$file_name]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . $newfilename;
        $link_return = $link_img . $newfilename;

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
//    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$file_name]["tmp_name"]);
        if ($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
//        echo "File is not an image.";
            $uploadOk = 0;
        }
//    }
// Check if file already exists
        if (file_exists($target_file)) {
//        echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["avatar"]["size"] > 500000) {
//        echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
//        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
//        echo "Sorry, your file was not uploaded.";
            return 0;
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
                return $link_return;
//            echo "The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";
            } else {
                return 0;
//            echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        return 0;
    }
}

function _returnCreateUser($check_redict)
{
    if (isset($_POST['user_code']) && isset($_POST['full_name']) && isset($_POST['birthday']) && isset($_POST['email_user']) && isset($_POST['address_user']) && isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
        $user_code = _returnPostParamSecurity('user_code');
        $mr = _returnPostParamSecurity('mr');
        $full_name = _returnPostParamSecurity('full_name');
        $input_birthday = _returnPostParamSecurity('birthday');
        $email_user = _returnPostParamSecurity('email_user');
        $user_name = _returnPostParamSecurity('user_name');
        $address_user = _returnPostParamSecurity('address_user');
        $password = _returnPostParamSecurity('password');
        $password_confirm = _returnPostParamSecurity('password_confirm');
        $phone = _returnPostParamSecurity('user_phone');
        $user_role = _returnPostParamSecurity('user_role');
        $ngay_lam_viec = _returnPostParamSecurity('user_ngay_lam_viec');
        $ngay_chinh_thuc = _returnPostParamSecurity('user_ngay_chinh_thuc');
        if ($user_role === "on" || $user_role === 1) {
            $user_role = 1;
        } else {
        }
        if ($user_code != "" && $full_name != '' && $input_birthday != '' && $email_user != '' && $user_name != '' && $password != '' && $password_confirm != '') {
            if (isset($_POST['check_edit']) && isset($_POST['id_edit']) && $_POST['check_edit'] === "edit" && $_POST['id_edit'] != '') {
                $id = _return_mc_decrypt(_returnPostParamSecurity('id_edit'), ENCRYPTION_KEY);
                $data_user_update = user_getById($id);
                if (count($data_user_update) > 0) {
                    $array = (array)$data_user_update[0];
                    $new_obj = new user($array);
                    $new_obj->name = $full_name;
                    $new_obj->birthday = date("Y-m-d", strtotime($input_birthday));
                    $new_obj->address = $address_user;
                    $new_obj->user_role = $user_role;
                    if ($ngay_lam_viec != '') {
                        $new_obj->ngay_lam_viec = date("Y-m-d", strtotime($ngay_lam_viec));
                    }
                    if ($ngay_chinh_thuc != '') {
                        $new_obj->ngay_chinh_thuc = date("Y-m-d", strtotime($ngay_chinh_thuc));
                    }
                    if ($phone != "") {
                        $new_obj->phone = $phone;
                    }
                    if ($mr != '') {
                        $new_obj->mr = $mr;
                    }
                    $folder = LocDau($data_user_update[0]->user_email);
                    $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/users/" . $folder . '/';
                    $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/users/" . $folder . '/');
                    if ($avatar != '') {
                        $new_obj->avatar = $avatar;
                    }

                    $new_obj->updated = _returnGetDateTime();
                    $new_obj->id = $id;
                    user_update($new_obj);
                    if ($check_redict == 1) {
                        redict(SITE_NAME . '/nhan-vien/');
                    } else {
                        return 1;
                    }
                }
            } else {
                if ($password != $password_confirm) {
                    echo '<script>alert("Hai mật khẩu không khớp")</script>';
                } else {
                    $dk_check_user = "user_name='" . $user_name . "'";
                    $dk_check_user .= "or user_email ='" . $email_user . "'";
                    $dk_check_user .= " or user_email ='" . $user_code . "'";
                    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
                    if (count($data_check_exist_user) > 0) {
                        if ($check_redict == 1) {
                            echo "<script>alert('Mã nhân viên, tên đăng nhập, email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                        } else {
                            return 'Mã nhân viên, tên đăng nhập, email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác';
                        }
                    } else {
                        $folder = LocDau($email_user);
                        $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/users/" . $folder . '/';
                        $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/users/" . $folder . '/');
                        if ($avatar === 0) {
                            $avatar = '';
                        }
                        $dangky = new user();
                        $dangky->name = $full_name;
                        $dangky->user_code = $user_code;
                        $dangky->user_name = $user_name;
                        $dangky->mr = $mr;
                        $dangky->birthday = date("Y-m-d", strtotime($input_birthday));
                        $dangky->user_email = $email_user;
                        $dangky->address = $address_user;
                        $Pass = hash_pass($password);
                        $dangky->password = $Pass;
                        $dangky->created = _returnGetDateTime();
                        $dangky->updated = _returnGetDateTime();
                        $dangky->login_two_steps = 0;
                        $dangky->avatar = $avatar;
                        $dangky->status = 1;
                        $dangky->phone = $phone;
                        $dangky->user_role = $user_role;
                        $dangky->created_by = $_SESSION['user_id'];
                        $dangky->login_two_steps = 1;
                        if ($ngay_lam_viec != '') {
                            $dangky->ngay_lam_viec = date("Y-m-d", strtotime($ngay_lam_viec));
                        }
                        if ($ngay_chinh_thuc != '') {
                            $dangky->ngay_chinh_thuc = date("Y-m-d", strtotime($ngay_chinh_thuc));
                        }
                        user_insert($dangky);
                        $subject = "Thông báo đăng ký tài khoản tại hệ thống quản lý MIXTOURIST";
                        $message = '';
                        if ($mr == '') {
                            $name_full_mer = $full_name;
                        } else {
                            $name_full_mer = $mr . '.' . $full_name;
                        }

                        $message .= '<div style="float: left; width: 100%">
                            <p>Xin chào: <span style="color: #132fff; font-weight: bold"> ' . $name_full_mer . '</span>!</p>
                            <p>Chúng tôi đã tạo thành công tài khoản của bạn, giờ đây bạn có thể truy cập và sử dụng hệ thống quản lý MIXTOURIST</p>
                            <p>Link đăng nhập: <span style="color: #132fff; font-weight: bold">' . SITE_NAME . '/dang-nhap.html</span>,</p>
                            <p>Mã nhân viên: <span style="color: #132fff; font-weight: bold">' . $user_code . '</span>,</p>
                            <p>Email: <span style="color: #132fff; font-weight: bold">' . $email_user . '</span>,</p>
                            <p>Username: <span style="color: #132fff; font-weight: bold">' . $user_name . '</span>,</p>
                            <p>Mật khẩu: <span style="color: #132fff; font-weight: bold">' . $password . '</span>,</p>
                            <p>Ngày sinh: <span style="color: #132fff; font-weight: bold">' . $input_birthday . '</span>,</p>
                            <p>Địa chỉ: <span style="color: #132fff; font-weight: bold">' . $address_user . '</span>,</p>
                            <p>Ngày gửi: <span style="color: #132fff; font-weight: bold">' . date("d-m-Y H:i:s", strtotime(_returnGetDateTime())) . '</span>,</p>
                        </div>';
                        SendMail($email_user, $message, $subject);
                        if ($check_redict == 1) {
                            redict(SITE_NAME . '/nhan-vien/');
                        } else {
                            return 1;
                        }

                    }
                }

            }

        } else {
            if ($check_redict == 1) {
                echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';
            } else {
                return 'Bạn vui lòng điền đầy đủ thông tin đăng ký';
            }

        }
    }
}

function _deleteSubmitForm($model, $action_delete)
{
    if (isset($_POST['check_box_action'])) {
        $check_box_action = $_POST['check_box_action'];
        if (count($check_box_action) > 0) {
            foreach ($check_box_action as $val) {
                $id = _return_mc_decrypt($val, ENCRYPTION_KEY);
                $data = $model . '_getById' . ($id);
                if (count($data) > 0) {
                    $new_obj = new $model();
                    $new_obj->id = $id;
                    $action_delete($new_obj);
                }
            }
        }
    }
}

function _returnCreateCustomer($check_redict)
{
    if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['mr']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['mobi'])) {
        $name = _returnPostParamSecurity('name');
        $code = _returnPostParamSecurity('code');
        $mr = _returnPostParamSecurity('mr');
        $birthday = _returnPostParamSecurity('birthday');
        $email = _returnPostParamSecurity('email');
        $address = _returnPostParamSecurity('address');
        $phone = _returnPostParamSecurity('phone');
        $mobi = _returnPostParamSecurity('mobi');
        $avatar = '';

        if ($name != "" && $code != '' && $email != '' && $address != '' && $phone != '' && $mobi != '') {
            if (isset($_POST['check_edit']) && isset($_POST['id_edit']) && $_POST['check_edit'] === "edit" && $_POST['id_edit'] != '') {
                $id = _return_mc_decrypt(_returnPostParamSecurity('id_edit'), ENCRYPTION_KEY);
                $data_user_update = customer_getById($id);
                if (count($data_user_update) > 0) {
                    $array = (array)$data_user_update[0];
                    $new_obj = new customer($array);
                    $new_obj->code = $code;
                    $new_obj->name = $name;
                    $new_obj->email = $email;
                    $new_obj->birthday = date("Y-m-d", strtotime($birthday));
                    $new_obj->address = $address;
                    if ($phone != "") {
                        $new_obj->phone = $phone;
                    }
                    if ($mobi != "") {
                        $new_obj->mobi = $mobi;
                    }
                    if ($mr != '') {
                        $new_obj->mr = $mr;
                    }
                    $folder = LocDau($data_user_update[0]->user_email);
                    $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/customer/" . $folder . '/';
                    $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/customer/" . $folder . '/');
                    if ($avatar != '') {
                        $new_obj->avatar = $avatar;
                    }

                    $new_obj->updated = _returnGetDateTime();
                    $new_obj->id = $id;
                    customer_update($new_obj);
                    if ($check_redict == 1) {
                        redict(SITE_NAME . '/khach-hang/');
                    } else {
                        return 1;
                    }
                }
            } else {


                $dk_check_user = "or email ='" . $email . "'";
                $data_check_exist_user = customer_getByTop('', $dk_check_user, 'id desc');
                if (count($data_check_exist_user) > 0) {
                    if ($check_redict == 1) {
                        echo "<script>alert('Mã khách hàng, email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                    } else {
                        return 'Mã khách hàng, tên đăng nhập, email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác';
                    }
                } else {
                    $folder = LocDau($email);
                    $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/customer/" . $folder . '/';
                    $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/customer/" . $folder . '/');
                    if ($avatar === 0) {
                        $avatar = '';
                    }
                    $dangky = new customer();
                    $dangky->name = $name;
                    $dangky->code = $code;
                    $dangky->mr = $mr;
                    $dangky->birthday = date("Y-m-d", strtotime($birthday));
                    $dangky->email = $email;
                    $dangky->address = $address;
                    $dangky->created = _returnGetDateTime();
                    $dangky->updated = _returnGetDateTime();
                    $dangky->avatar = $avatar;
                    $dangky->mobi = $mobi;
                    $dangky->status = 1;
                    $dangky->phone = $phone;
                    $dangky->created_by = $_SESSION['user_id'];
                    customer_insert($dangky);
                    if ($check_redict == 1) {
                        redict(SITE_NAME . '/khach-hang/');
                    } else {
                        return 1;
                    }

                }
            }

        } else {
            if ($check_redict == 1) {
                echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';
            } else {
                return 'Bạn vui lòng điền đầy đủ thông tin đăng ký';
            }

        }
    }
}

function _returnCreateCustomerFull($check_redict)
{
    if (isset($_POST['name']) && isset($_POST['mr']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['mobi'])) {
        $name = _returnPostParamSecurity('name');
        $code = _returnPostParamSecurity('code');
        $mr = _returnPostParamSecurity('mr');
        $birthday = _returnPostParamSecurity('birthday');
        $email = _returnPostParamSecurity('email');
        $address = _returnPostParamSecurity('address');
        $phone = _returnPostParamSecurity('phone');
        $mobi = _returnPostParamSecurity('mobi');
        $fax=_returnPostParamSecurity('fax');
        $category = _returnPostParamSecurity('category');
        $resources_to = _returnPostParamSecurity('resources_to');
        $nganh_nghe = _returnPostParamSecurity('nganh_nghe');
        $company_name = _returnPostParamSecurity('company_name');
        $chuc_vu = _returnPostParamSecurity('chuc_vu');
        $phong_ban = _returnPostParamSecurity('phong_ban');
        $director_name = _returnPostParamSecurity('director_name');
        $company_email = _returnPostParamSecurity('company_email');

        $skype = _returnPostParamSecurity('skype');
        $facebook = _returnPostParamSecurity('facebook');
        $account_number_bank = _returnPostParamSecurity('account_number_bank');
        $bank = _returnPostParamSecurity('bank');
        $open_bank = _returnPostParamSecurity('open_bank');
        $cmnd = _returnPostParamSecurity('cmnd');
        $date_range_cmnd = _returnPostParamSecurity('date_range_cmnd');
        $issued_by_cmnd = _returnPostParamSecurity('issued_by_cmnd');
        $note=_returnPostParamSecurity('note');

        $avatar = '';

        if ($name != "" && $email != '' && $address != '' && $phone != '' && $mobi != '') {
            if (isset($_POST['check_edit']) && isset($_POST['id_edit']) && $_POST['check_edit'] === "edit" && $_POST['id_edit'] != '') {
                $id = _return_mc_decrypt(_returnPostParamSecurity('id_edit'), ENCRYPTION_KEY);
                $dk_check_user = "email ='" . $email . "' and id!=".$id;
                $data_check_exist_user = customer_getByTop('', $dk_check_user, 'id desc');
                if (count($data_check_exist_user) > 0) {
                    if ($check_redict == 1) {
                        echo "<script>alert('Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                    } else {
                        return 'Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác';
                    }
                }else{
                    $data_user_update = customer_getById($id);
                    if (count($data_user_update) > 0) {
                        $array = (array)$data_user_update[0];
                        $new_obj = new customer($array);
                        $new_obj->name = $name;
                        $new_obj->email = $email;
                        $new_obj->birthday = date("Y-m-d", strtotime($birthday));
                        $new_obj->address = $address;
                        if ($phone != "") {
                            $new_obj->phone = $phone;
                        }
                        if ($mobi != "") {
                            $new_obj->mobi = $mobi;
                        }
                        if ($mr != '') {
                            $new_obj->mr = $mr;
                        }
                        $new_obj->fax = $fax;
                        $folder = LocDau($data_user_update[0]->user_email);
                        $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/customer/" . $folder . '/';
                        $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/customer/" . $folder . '/');
                        if ($avatar != '') {
                            $new_obj->avatar = $avatar;
                        }

                        $new_obj->updated = _returnGetDateTime();
                        $new_obj->id = $id;
                        if($category!=''){
                            $new_obj->category = $category;
                        }
                        if($resources_to!=''){
                            $new_obj->resources_to = $resources_to;
                        }
                        if($nganh_nghe!=''){
                            $new_obj->nganh_nghe = $nganh_nghe;
                        }

                        $new_obj->company_name = $company_name;
                        if($chuc_vu!=''){
                            $new_obj->chuc_vu = $chuc_vu;
                        }

                        if($phong_ban!=''){
                            $new_obj->phong_ban = $phong_ban;
                        }

                        $new_obj->director_name =$director_name;
                        $new_obj->company_email = $company_email;
                        $new_obj->skype = $skype;
                        $new_obj->facebook = $facebook;
                        $new_obj->account_number_bank = $account_number_bank;
                        $new_obj->bank = $bank;
                        $new_obj->open_bank = $open_bank;
                        $new_obj->cmnd= $cmnd;
                        $new_obj->date_range_cmnd =date("Y-m-d", strtotime($date_range_cmnd)); ;
                        $new_obj->issued_by_cmnd =$issued_by_cmnd;
                        $new_obj->note = $note;
                        customer_update($new_obj);
                        if ($check_redict == 1) {
                            redict(SITE_NAME . '/khach-hang/');
                        } else {
                            return 1;
                        }
                    }
                }

            } else {

                $dk_check_user = "email ='" . $email . "'";
                $data_check_exist_user = customer_getByTop('', $dk_check_user, 'id desc');
                if (count($data_check_exist_user) > 0) {
                    if ($check_redict == 1) {
                        echo "<script>alert('Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                    } else {
                        return 'Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác';
                    }
                } else {
                    $folder = LocDau($email);
                    $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/customer/" . $folder . '/';
                    $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/customer/" . $folder . '/');
                    if ($avatar === 0) {
                        $avatar = '';
                    }
                    $dangky = new customer();
                    $dangky->name = $name;
                    $dangky->code = $code;
                    $dangky->mr = $mr;
                    $dangky->birthday = date("Y-m-d", strtotime($birthday));
                    $dangky->email = $email;
                    $dangky->address = $address;
                    $dangky->created = _returnGetDateTime();
                    $dangky->updated = _returnGetDateTime();
                    $dangky->avatar = $avatar;
                    $dangky->mobi = $mobi;
                    $dangky->status = 1;
                    $dangky->phone = $phone;
                    $dangky->fax = $fax;
                    $dangky->created_by = $_SESSION['user_id'];
                    $dangky->category = $category;
                    $dangky->resources_to = $resources_to;
                    $dangky->nganh_nghe = $nganh_nghe;
                    $dangky->company_name = $company_name;
                    $dangky->chuc_vu = $chuc_vu;
                    $dangky->phong_ban = $phong_ban;
                    $dangky->director_name =$director_name;
                    $dangky->company_email = $company_email;
                    $dangky->skype = $skype;
                    $dangky->facebook = $facebook;
                    $dangky->account_number_bank = $account_number_bank;
                    $dangky->bank = $bank;
                    $dangky->open_bank = $open_bank;
                    $dangky->cmnd= $cmnd;
                    $dangky->date_range_cmnd =date("Y-m-d", strtotime($date_range_cmnd)); ;
                    $dangky->issued_by_cmnd =$issued_by_cmnd;
                    $dangky->note = $note;
                    customer_insert($dangky);
                    if ($check_redict == 1) {
                        redict(SITE_NAME . '/khach-hang/');
                    } else {
                        return 1;
                    }

                }
            }

        } else {
            if ($check_redict == 1) {
                echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';
            } else {
                return 'Bạn vui lòng điền đầy đủ thông tin đăng ký';
            }

        }
    }
}

function _returnDataEditAdd($data, $field)
{
    if (isset($data[0]->$field)) {
        return $data[0]->$field;
    } else {
        return '';
    }
}

function _returnInput($name, $value = '', $valid = '', $icon_input = '', $disabled = '', $mess_err = '', $width = '')
{
    return '  <span class="input-icon width_100" style="' . $width . '">
                                                    <input ' . $disabled . ' name="' . $name . '" type="text" id="input_' . $name . '"
                                                           value="' . $value . '"
                                                           class="width_100 ' . $valid . '" >
                                                    <i class="ace-icon fa fa-' . $icon_input . ' blue"></i>
                                                    <i id="icon_error_' . $name . '" style="display: none"
                                                       class="ace-icon fa fa-times-circle icon-right error-color "
                                                       data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                       data-placement="bottom" data-backcolor="red"
                                                       data-textcolor="#ffffff"
                                                       title=""></i>
                                                    <i id="icon_success_' . $name . '" style="display: none"
                                                       class="ace-icon fa fa-check-circle icon-right success-color"
                                                       data-toggle="ggtooltip" data-title="" data-trigger="hover"
                                                       data-placement="bottom" data-backcolor="green"
                                                       data-textcolor="#000000" title="' . $mess_err . '"></i>
                                                </span>
                                                                    <label style="display: none"
                                                                           class="error-color  error-color-size"
                                                                           id="error_' . $name . '">' . $mess_err . '</label>';
}

function _returnInputDate($name, $value = '', $valid = '', $disabled = '', $mess_err = '', $width = '')
{
    return '<div ' . $disabled . '  class="input-group" style="' . $width . '">
                                                                            <input value="' . $value . '"
                                                                                   class="form-control date-picker width_100 ' . $valid . '"
                                                                                   id="input_' . $name . '" name="' . $name . '"
                                                                                   required
                                                                                   type="text"
                                                                                   data-date-format="dd-mm-yyyy">
																	<span id="icon_'.$name.'" class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                                                        </div>
                                                                        <label style="display: none"
                                                                               class="error-color  error-color-size"
                                                                               id="error_'.$name.'">' . $mess_err . '</label>';
}

function _returnInputCheck($name, $valid = '', $disabled = '', $checked = '')
{
    return ' <label>
                                                                        <input ' . $checked . '
                                                                            id="input_' . $name . '" ' . $disabled . '
                                                                            name="' . $name . '"
                                                                            class="ace ace-switch ace-switch-6 ' . $valid . '"
                                                                            type="checkbox">
                                                                        <span class="lbl"></span>
                                                                    </label>';
}

function _returnInputSelect($name, $value, $data_list, $valid = '', $name_title)
{
    $string = '<select name="' . $name . '"
                                                                            class="chosen-select form-control ' . $valid . ' ' . $name . '"
                                                                            id="form-field-select-3"
                                                                            data-placeholder="' . $name_title . '"
                                                                            style="display: none;width: 10px">';

    if (count($data_list) > 0) {
        $string .= '<option  value=""></option>';
        foreach ($data_list as $row) {
            $selectted = '';
            if ($row->id == $value) {
                $selectted = 'selected';
            }
            $string .= '<option ' . $selectted . ' value="' . $row->id . '">' . $row->name . '</option>';
        }
    }
    $string .= ' </select>';
    return $string;
}

function _returnDataAutoCompleteCustomer(){
    $data_khach_hang = customer_getByTop('', 'status=1', 'name asc');
    $string_data='[';
    if(count($data_khach_hang)>0){
        foreach($data_khach_hang as $row_kh){
            $name_kh='';
            if($row_kh->mr!=''){
                $name_kh.=$row_kh->mr.'.';
            }
            $name_kh.=$row_kh->name;

            if($row_kh->avatar!=''){
                $avatar_kh=SITE_NAME.$row_kh->avatar;
            }
            else{
                $avatar_kh=SITE_NAME.'/view/default/themes/images/no-avatar.png';
            }
            $cate_name='Nhóm khách hàng ...';
            $cate_id='';
            if($row_kh->category!=0){
                $data_cate=customer_category_getById($row_kh->category);
                if(count($data_cate)>0){
                    $cate_name=$data_cate[0]->name;
                    $cate_id=$data_cate[0]->id;
                }
            }
            $string_data.="['".$name_kh."','".$avatar_kh."','".$row_kh->id."','".$row_kh->email."','".$row_kh->phone."','".$row_kh->address."','".$row_kh->fax."','".$cate_id."','".$cate_name."'],";
        }
    }
    $string_data.='];';
    return $string_data;
}

function _returnDataAutoCompleteTour(){
    $data_tour = tour_getByTop('', '', 'name asc');
    $string_data='[';
    if(count($data_tour)>0){
        foreach($data_tour as $row_kh){
            $id=$row_kh->id;
            $name=$row_kh->name;
            if($row_kh->price==0||$row_kh->price==''){
                $price_format='Liên hệ';
                $price='Liên hệ';
            }
            else{
                $price_format=number_format((int)$row_kh->price,0,",",".").' vnđ';
                $price=$row_kh->price;
            }
            $durations=$row_kh->durations;
            $vehicle=$row_kh->vehicle;
            $departure_name='';
            $departure_id='';
            if($row_kh->departure!=0){
                $data_departure=departure_getById($row_kh->departure);
                if(count($data_departure)>0){
                    $departure_name=$data_departure[0]->name;
                    $departure_id=$data_departure[0]->id;
                }
            }
            $string_data.="['".$id."','".$name."','".$price_format."','".$durations."','".$vehicle."','".$departure_id."','".$departure_name."','".$price."'],";
        }
    }
    $string_data.='];';
    return $string_data;
}

function _returnDataAutoCompleteUser(){
    if($_SESSION['user_role']==1){
        $data_user = user_getByTop('', 'status=1', 'name asc');
    }else{
        $data_user = user_getByTop('', 'status=1 and id='.$_SESSION['user_id'], 'name asc');
    }

    $string_data='[';
    if(count($data_user)>0){
        foreach($data_user as $row_user){
            $id=$row_user->id;
            $name=$row_user->name;
            $email=$row_user->user_email;
            $phone=$row_user->phone;
            $phong_ban='';
            $number_tour=0;
            $data_phongban=user_phongban_getByTop('','id='.$row_user->phong_ban,'');
            $number_tour=booking_count('user_id='.$row_user->id.' and status!=5');
            if(count($data_phongban)>0){
                $phong_ban=$data_phongban[0]->name;
            }
            $string_data.="['".$id."','".$name."','".$email."','".$phone."','".$phong_ban."','".$number_tour."'],";
        }
    }
    $string_data.='];';
    return $string_data;
}

function _getRandomNumbers($min, $max, $count)
{
    if ($count > (($max - $min)+1))
    {
        return false;
    }
    $values = range($min, $max);
    shuffle($values);
    return array_slice($values,0, $count);
}
function _randomCustommr(){
    $rand=(implode('',_getRandomNumbers(1, 99, 3))).$_SESSION['user_id'];

}
function _randomBooking($code_module,$function_count, $field='code_booking'){
    $rand_number=rand(1,5);
    $rand=$code_module.(implode('',_getRandomNumbers(1, 99, $rand_number))).$_SESSION['user_id'];
    $data_booking=$function_count($field.'="'.$rand.'"');
    if($data_booking>0){
        _randomBooking($code_module,$function_count,$field);
    }
    else{
        return $rand;
    }

}
 function _insertNotification($name='',$user_send_id='',$user_id,$link='',$status=0,$content=''){
     $notification_model=new notification();
     $notification_model->name=$name;
     $notification_model->user_send_id=$user_send_id;
     $notification_model->user_id=$user_id;
     $notification_model->link=$link;
     $notification_model->status=$status;
     $notification_model->content=$content;
     $notification_model->created=_returnGetDateTime();
     notification_insert($notification_model);
 }
function _insertLog($user_id,$module_id,$form_id,$action_id,$item_id,$value_old,$value_new,$description){
    $log_model=new log();
    $log_model->user_id=$user_id;
    $log_model->module_id=$module_id;
    $log_model->form_id=$form_id;
    $log_model->action_id=$action_id;
    $log_model->item_id=$item_id;
    $log_model->value_old=$value_old;
    $log_model->value_new=$value_new;
    $log_model->description=$description;
    $log_model->created=_returnGetDateTime();
    log_insert($log_model);
}