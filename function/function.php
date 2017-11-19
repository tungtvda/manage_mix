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
    $date_compare = $_SESSION['time_token'];
    $date_check = date('Y-m-d H:i:s', strtotime('+25 minute', strtotime($date_compare)));
    $currentDate = _returnGetDateTime();
    if (strtotime($currentDate) > strtotime($date_check)) {
        redict(_returnLinkDangNhap('Hết thời hạn đăng nhập'));
    }

    $_SESSION['time_token'] = _returnGetDateTime();
    // kiểm tra quyền có phải là super admin
    if ($_SESSION['user_role'] == 1) {
        return true;
    }
    $permison_module = explode(',', $_SESSION['user_permison_module']);
    $permison_form = explode(',', $_SESSION['user_permison_form']);
    $permison_action = explode(',', $_SESSION['user_permison_action']);

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
//    $_SESSION['user_permison_action'] = $permison_action;
    return true;

}

function _returnCheckAction($action_id = 0)
{
    // Kiểm tra có tồn tại user không
    _returnCheckExitUser();
    // Lấy thông tin user
//    $data_user = user_getById($_SESSION['user_id']);
//    if (count($data_user) == 0) {
//        redict(_returnLinkDangNhap());
//    }
    // kiểm tra thời gian đăng nhập
//    $date_compare = $data_user[0]->time_token;
//    $date_check = date('Y-m-d H:i:s', strtotime('+15 minute', strtotime($date_compare)));
//    $currentDate = _returnGetDateTime();
//    if (strtotime($currentDate) > strtotime($date_check)) {
//        redict(_returnLinkDangNhap());
//    }
//    $user_update = new user();
//    $user_update->id = $_SESSION['user_id'];
//    $user_update->time_token = _returnGetDateTime();
//    user_update_time_login($user_update);
    $date_compare = $_SESSION['time_token'];
    $date_check = date('Y-m-d H:i:s', strtotime('+25 minute', strtotime($date_compare)));
    $currentDate = _returnGetDateTime();
    if (strtotime($currentDate) > strtotime($date_check)) {
        redict(_returnLinkDangNhap('Hết thời hạn đăng nhập'));
    }

    $_SESSION['time_token'] = _returnGetDateTime();
    // kiểm tra quyền có phải là super admin
    if ($_SESSION['user_role'] == 1) {
        return true;
    }
    $permison_action = explode(',', $_SESSION['user_permison_action']);
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
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    return date('Y-m-d', time());
//    return gmdate('Y-m-d', time());
}

function _returnGetDateMouth()
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
//    return gmdate('m-d', time());
    return date('m-d', time());
}

function _returnGetDateTime()
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
//    return gmdate("Y-m-d H:i:s", time());
    return date('Y-m-d H:i:s',time());
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

function _returnDateFormatConvertVN($date)
{
    if ($date == '') {
        $DatesRemainder = '';
    } else {
        $DatesRemainder = date("d-m-Y H:i:s", strtotime($date));
    }
    return $DatesRemainder;
}


function _returnDateNotTimieFormatConvertVn($date)
{
    if ($date == '0000-00-00') {
        $DatesRemainder = '';
    } else {
        $DatesRemainder = date("d-m-Y", strtotime($date));
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
    $_SESSION['time_token'] = $data_arr['time_token'];
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
function _return_mc_encrypt($encrypt, $key = '', $code_key = '')
{
    if ($code_key == 1) {
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encode = base64_encode($passcrypt) . '|' . base64_encode($iv);

    } else {
        $encode = base64_encode($encrypt);
        $encode = base64_encode($encode);
        $encode = base64_encode($encode);
        $encode = base64_encode($encode);
        $encode = base64_encode($encode);
        $encode = base64_encode($encode);
        $encode = base64_encode($encode);
    }
    return $encode;
}

// Code giải mã
function _return_mc_decrypt($decrypt, $key = '', $code_key = '')
{
    if ($code_key == 1) {
        $decrypt = explode('|', $decrypt);
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decoded = unserialize($decrypted);
    } else {
        $decoded = base64_decode($decrypt);
        $decoded = base64_decode($decoded);
        $decoded = base64_decode($decoded);
        $decoded = base64_decode($decoded);
        $decoded = base64_decode($decoded);
        $decoded = base64_decode($decoded);
        $decoded = base64_decode($decoded);
    }
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
    //  server
    return $_SERVER['DOCUMENT_ROOT'];

    // local
//    return $_SERVER['DOCUMENT_ROOT'] . '/manage_mix';

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

function _returnCreateUser($check_redict,$ridict='/nhan-vien/',$email_tem='')
{
    if (isset($_POST['user_code']) && isset($_POST['full_name']) && isset($_POST['birthday']) && isset($_POST['email_user']) && isset($_POST['address_user']) && isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
        $user_code = _returnPostParamSecurity('user_code');
        $type_tiep_thi = _returnPostParamSecurity('type_tiep_thi');
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
        $mobi = _returnPostParamSecurity('mobi');
        $gender= _returnPostParamSecurity('gender');
        $skype= _returnPostParamSecurity('skype');
        $facebook= _returnPostParamSecurity('facebook');
        $address= _returnPostParamSecurity('address');
        $cmnd= _returnPostParamSecurity('cmnd');
        $date_range_cmnd= _returnPostParamSecurity('date_range_cmnd');
        $account_number_bank= _returnPostParamSecurity('account_number_bank');
        $bank= _returnPostParamSecurity('bank');
        $issued_by_cmnd= _returnPostParamSecurity('issued_by_cmnd');
        $open_bank= _returnPostParamSecurity('open_bank');
        $id_thanhvien= _returnPostParamSecurity('id_thanhvien');
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
                    if($id_thanhvien){
                        $new_obj->mobi = $mobi;
                        $new_obj->gender = $gender;
                        $new_obj->skype = $skype;
                        $new_obj->facebook = $facebook;
                        $new_obj->address = $address;
                        $new_obj->cmnd = $cmnd;
                        if($date_range_cmnd!=''){
                            $new_obj->date_range_cmnd = date("Y-m-d", strtotime($date_range_cmnd));
                        }
                        $new_obj->account_number_bank = $account_number_bank;
                        $new_obj->type_tiep_thi = $type_tiep_thi;
                        $new_obj->bank = $bank;
                        $new_obj->open_bank = $open_bank;
                        $new_obj->issued_by_cmnd = $issued_by_cmnd;
                    }

                    $new_obj->updated = _returnGetDateTime();
                    $new_obj->id = $id;
                    user_update($new_obj);
//                    _insertLog($_SESSION['user_id'],3,2,1,$data_get_user[0]->id,'','',$_SESSION['user_name'].' đã tạo nhân viên mã "'.$user_code.'"');
                    if ($check_redict == 1) {
                        redict(SITE_NAME . $ridict);
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
                        if($user_name==''){
                            $user_name=$email_user;
                        }
                        $dangky = new user();
                        $dangky->name = $full_name;
                        $dangky->user_code = $user_code;
                        $dangky->type_tiep_thi = $type_tiep_thi;
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
                        $dangky->login_two_steps = 0;
                        if ($ngay_lam_viec != '') {
                            $dangky->ngay_lam_viec = date("Y-m-d", strtotime($ngay_lam_viec));
                        }
                        if ($ngay_chinh_thuc != '') {
                            $dangky->ngay_chinh_thuc = date("Y-m-d", strtotime($ngay_chinh_thuc));
                        }
                        user_insert($dangky);
                        $data_get_user = user_getByTop('1', 'user_code="' . $user_code . '""', 'id desc');
                        if (count($data_get_user) > 0) {
                            _insertLog($_SESSION['user_id'], 3, 2, 1, $data_get_user[0]->id, '', '', $_SESSION['user_name'] . ' đã tạo nhân viên mã "' . $user_code . '"');
                        }
                        if($ridict=='/nhan-vien/'){
                            $title_mail='';
                            $type_tiep_thi_name='';
                            $subject = "Thông báo đăng ký tài khoản tại hệ thống quản lý MIXTOURIST";
                            $title = "Chào mừng bạn đến với hệ thống quản lý MIXTOURIST";
                            $link_dang_nhap=SITE_NAME.'/dang-nhap.html';
                            $content_bottom=' <p style="margin-bottom: 5px;margin-top: 0px;"> Hệ thống quản lý MIXTOURIST đã tạo thành công tài khoản của bạn</p>';
                        }else{
                            $title_mail='Hệ thống tiếp thị liên kết AZBOOKING.VN';
                            switch($type_tiep_thi){
                                case '3':
                                    $type_tiep_thi_name='Đại lý';
                                    break;
                                case '2':
                                    $type_tiep_thi_name='5 sao';
                                    break;
                                case '1':
                                    $type_tiep_thi_name='4 sao';
                                    break;
                                default:
                                    $type_tiep_thi_name='3 sao';

                            }
                            $subject = "Thông báo đăng ký tài khoản tiếp thị liên kết AZBOOKING.VN";
                            $title = "Chào mừng bạn đến với hệ thống quản lý MIXTOURIST";
                            $link_dang_nhap=SITE_NAME_AZ.'/tiep-thi-lien-ket/thanh-vien/';
                            $content_bottom=' <p style="margin-bottom: 5px;margin-top: 0px;"> Chào mừng bạn đến với hệ thống tiếp thị liên kết của <b>AZBOOKING.VN</b>.</p>
                                        <p style="margin-bottom: 5px;margin-top: 0px;"> <b>AZBOOKING.VN</b> vừa tạo thành công tài khoản cho bạn. Giờ đây bạn có thể đăng nhập và tạo chiến dịch tiếp thị cho mình</p>';
                        }
                        $email_tem=str_replace('__TITLE__',$title,$email_tem);
                        $message = '';
                        if ($mr == '') {
                            $name_full_mer = $full_name;
                        } else {
                            $name_full_mer = $mr . '.' . $full_name;
                        }
                        $email_tem=str_replace('__FULL_NAME__',$name_full_mer,$email_tem);
                        $email_tem=str_replace('__HTML_URL__',$link_dang_nhap,$email_tem);
                        $email_tem=str_replace('__EMAIL_TO__',$email_user,$email_tem);
                        $email_tem=str_replace('__PASSWORD__',$password,$email_tem);
                        $email_tem=str_replace('__CODE__',$user_code,$email_tem);
                        $email_tem=str_replace('__LEVEL__',$type_tiep_thi_name,$email_tem);
                        $email_tem=str_replace('__CONTENT_BOTTOM__',$content_bottom,$email_tem);
                        $email_tem=str_replace('__CREATED__',date("d-m-Y H:i:s", strtotime(_returnGetDateTime())),$email_tem);
                        $message=$email_tem;
//                        $message .= '<div style="float: left; width: 100%">
//                            <p>Xin chào: <span style="color: #132fff; font-weight: bold"> ' . $name_full_mer . '</span>!</p>
//                            <p>Chúng tôi đã tạo thành công tài khoản của bạn, giờ đây bạn có thể truy cập và sử dụng hệ thống quản lý MIXTOURIST</p>
//                            <p>Link đăng nhập: <span style="color: #132fff; font-weight: bold">' . SITE_NAME . '/dang-nhap.html</span>,</p>
//                            <p>Mã nhân viên: <span style="color: #132fff; font-weight: bold">' . $user_code . '</span>,</p>
//                            <p>Email: <span style="color: #132fff; font-weight: bold">' . $email_user . '</span>,</p>
//                            <p>Username: <span style="color: #132fff; font-weight: bold">' . $user_name . '</span>,</p>
//                            <p>Mật khẩu: <span style="color: #132fff; font-weight: bold">' . $password . '</span>,</p>
//                            <p>Ngày sinh: <span style="color: #132fff; font-weight: bold">' . $input_birthday . '</span>,</p>
//                            <p>Địa chỉ: <span style="color: #132fff; font-weight: bold">' . $address_user . '</span>,</p>
//                            <p>Ngày gửi: <span style="color: #132fff; font-weight: bold">' . date("d-m-Y H:i:s", strtotime(_returnGetDateTime())) . '</span>,</p>
//                        </div>';
                        SendMail($email_user, $message, $subject,'',$title_mail);
                        if ($check_redict == 1) {
                            redict(SITE_NAME .$ridict);
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

function _deleteSubmitForm($model, $action_delete, $module, $form, $action)
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
                    _insertLog($_SESSION['user_id'], $module, $form, $action, $id, '', '', $_SESSION['user_name'] . ' đã xóa bản ghi "' . $id . '"');
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
        $fax = _returnPostParamSecurity('fax');
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
        $note = _returnPostParamSecurity('note');

        $avatar = '';

        if ($name != "" && $email != '' && $address != '' && $phone != '' && $mobi != '') {
            if (isset($_POST['check_edit']) && isset($_POST['id_edit']) && $_POST['check_edit'] === "edit" && $_POST['id_edit'] != '') {
                $id = _return_mc_decrypt(_returnPostParamSecurity('id_edit'), ENCRYPTION_KEY);
                $dk_check_user = "email ='" . $email . "' and id!=" . $id;
                $data_check_exist_user = customer_getByTop('', $dk_check_user, 'id desc');
                if (count($data_check_exist_user) > 0) {
                    if ($check_redict == 1) {
                        echo "<script>alert('Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
                    } else {
                        return 'Email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác';
                    }
                } else {
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
                        if ($category != '') {
                            $new_obj->category = $category;
                        }
                        if ($resources_to != '') {
                            $new_obj->resources_to = $resources_to;
                        }
                        if ($nganh_nghe != '') {
                            $new_obj->nganh_nghe = $nganh_nghe;
                        }

                        $new_obj->company_name = $company_name;
                        if ($chuc_vu != '') {
                            $new_obj->chuc_vu = $chuc_vu;
                        }

                        if ($phong_ban != '') {
                            $new_obj->phong_ban = $phong_ban;
                        }

                        $new_obj->director_name = $director_name;
                        $new_obj->company_email = $company_email;
                        $new_obj->skype = $skype;
                        $new_obj->facebook = $facebook;
                        $new_obj->account_number_bank = $account_number_bank;
                        $new_obj->bank = $bank;
                        $new_obj->open_bank = $open_bank;
                        $new_obj->cmnd = $cmnd;
                        $new_obj->date_range_cmnd = date("Y-m-d", strtotime($date_range_cmnd));
                        $new_obj->issued_by_cmnd = $issued_by_cmnd;
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
                    $dangky->director_name = $director_name;
                    $dangky->company_email = $company_email;
                    $dangky->skype = $skype;
                    $dangky->facebook = $facebook;
                    $dangky->account_number_bank = $account_number_bank;
                    $dangky->bank = $bank;
                    $dangky->open_bank = $open_bank;
                    $dangky->cmnd = $cmnd;
                    $dangky->date_range_cmnd = date("Y-m-d", strtotime($date_range_cmnd));;
                    $dangky->issued_by_cmnd = $issued_by_cmnd;
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

function _returnInput($name, $value = '', $valid = '', $icon_input = '', $disabled = '', $mess_err = '', $width = '', $type = 'text')
{
    return '  <span class="input-icon width_100" style="' . $width . '">
                                                    <input ' . $disabled . ' name="' . $name . '" type="' . $type . '" id="input_' . $name . '"
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
																	<span id="icon_' . $name . '" class="input-group-addon date_icon">
																		<i class="fa fa-calendar bigger-110"></i>
																	</span>

                                                                        </div>
                                                                        <label style="display: none"
                                                                               class="error-color  error-color-size"
                                                                               id="error_' . $name . '">' . $mess_err . '</label>';
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

function _returnDataAutoCompleteCustomer()
{
    $data_khach_hang = customer_getByTop('', 'status=1', 'name asc');
    $string_data = '[';
    if (count($data_khach_hang) > 0) {
        foreach ($data_khach_hang as $row_kh) {
            $name_kh = '';
            if ($row_kh->mr != '') {
                $name_kh .= $row_kh->mr . '.';
            }
            $name_kh .= $row_kh->name;

            if ($row_kh->avatar != '') {
                $avatar_kh = SITE_NAME . $row_kh->avatar;
            } else {
                $avatar_kh = SITE_NAME . '/view/default/themes/images/no-avatar.png';
            }
            $cate_name = 'Nhóm khách hàng ...';
            $cate_id = '';
            if ($row_kh->category != 0) {
                $data_cate = customer_category_getById($row_kh->category);
                if (count($data_cate) > 0) {
                    $cate_name = $data_cate[0]->name;
                    $cate_id = $data_cate[0]->id;
                }
            }
            $string_data .= "['" . $name_kh . "','" . $avatar_kh . "','" . $row_kh->id . "','" . $row_kh->email . "','" . $row_kh->phone . "','" . $row_kh->address . "','" . $row_kh->fax . "','" . $cate_id . "','" . $cate_name . "'],";
        }
    }
    $string_data .= '];';
    return $string_data;
}

function _returnDataAutoCompleteTour()
{
    $data_tour = tour_getByTop('', '', 'name asc');
    $string_data = '[';
    if (count($data_tour) > 0) {
        foreach ($data_tour as $row_kh) {
            $id = $row_kh->id;
            $name = $row_kh->name;
            if ($row_kh->price == 0 || $row_kh->price == '') {
                $price_format = 'Liên hệ';
                $price = 'Liên hệ';
            } else {
                $price_format = number_format((int)$row_kh->price, 0, ",", ".") . ' vnđ';
                $price = $row_kh->price;
            }
            if ($row_kh->price_2 == '') {
                $price_2_format = $price_format;
                $price_2 = $price;
            } else {
                $price_2_format = number_format((int)$row_kh->price_2, 0, ",", ".") . ' vnđ';
                $price_2 = $row_kh->price_2;
            }
            if ($row_kh->price_3 == '') {
                $price_3_format = $price_format;
                $price_3 = $price;
            } else {
                $price_3_format = number_format((int)$row_kh->price_3, 0, ",", ".") . ' vnđ';
                $price_3 = $row_kh->price_3;
            }
            $so_cho = $row_kh->so_cho;
//            $price_number= $row_kh->price_number;
//            $price_number_2= $row_kh->price_number_2;
//            $price_number_3= $row_kh->price_number_3;

//            $list_price_nguoi_lon=json_encode(returnInput_price($price_number,'price_nguoi_lon_'));
//            $list_price_tre_em_511=returnInput_price($price_number_2,'price_tre_em_511_');
//            $list_price_tre_em_5=returnInput_price($price_number_3,'price_tre_em_5_');
            $price_tiep_thi_format = '';
            if ($row_kh->price_tiep_thi != '' && $row_kh->price_tiep_thi > 0) {
                $price_tiep_thi_format = number_format((int)$row_kh->price_tiep_thi, 0, ",", ".") . ' vnđ';
            }
            $name_price = 'Giá người lớn';
            $name_price_2 = 'Giá trẻ em 5-11 tuổi';
            $name_price_3 = 'Giá trẻ em dưới 5 tuổi';
            if ($row_kh->name_price != '') {
                $name_price = $row_kh->name_price;
            }
            if ($row_kh->name_price_2 != '') {
                $name_price_2 = $row_kh->name_price_2;
            }
            if ($row_kh->name_price_3 != '') {
                $name_price_3 = $row_kh->name_price_3;
            }

            $durations = $row_kh->durations;
            $vehicle = $row_kh->vehicle;
            $departure_name = '';
            $departure_id = '';
            if ($row_kh->departure != 0) {
                $data_departure = departure_getById($row_kh->departure);
                if (count($data_departure) > 0) {
                    $departure_name = $data_departure[0]->name;
                    $departure_id = $data_departure[0]->id;
                }
            }
            $string_data .= "['" . $id . "','" . $name . "','" . $price_format . "','" . $durations . "','" . $vehicle . "','" . $departure_id . "','" . $departure_name . "','" . $price . "','" . $name_price . "','" . $price_2 . "','" . $price_2_format . "','" . $name_price_2 . "','" . $price_3 . "','" . $price_3_format . "','" . $name_price_3 . "','" . $so_cho . "','" . $price_tiep_thi_format . "'],";
        }
    }
    $string_data .= '];';
    return $string_data;
}

function returnInput_price($price, $name_price)
{
    $string = '';
    if ($price != '') {
        $array_price = explode(',', $price);
        if (count($array_price) > 0) {
            foreach ($array_price as $row) {
                if ($row != '') {
                    $array_item = explode('-', $row);
                    if (count($array_item) > 0) {
                        if (isset($array_item[0]) && isset($array_item[1]) && $array_item[0] != '' && $array_item[1] != '') {
                            $check_lon_hon = strstr($array_item[0], ">");
                            $input_lon_hon = '';
                            if ($check_lon_hon != '') {
                                $number_lonhon = str_replace('>', '', $check_lon_hon);
                                $input_lon_hon = '<input hidden value="' . $number_lonhon . '" id="input_' . $name_price . 'tu" class="valid" name="' . $name_price . 'tu">';
                                $array_item[0] = str_replace('>', 'lon_hon_', $array_item[0]);
                            }
                            $string .= '<input hidden value="' . $array_item[1] . '" id="input_' . $name_price . $array_item[0] . '" class="valid" name="' . $name_price . $array_item[0] . '">' . $input_lon_hon;

                        }
                    }
                }
            }
        }
    }
    return $string;
}

function _returnDataAutoCompleteUser()
{
    if ($_SESSION['user_role'] == 1) {
        $data_user = user_getByTop('', 'status=1 and user_role !=2', 'name asc');
    } else {
        $data_user = user_getByTop('', 'user_role !=2 and status=1 and (id=' . $_SESSION['user_id'] . ' or created_by=' . $_SESSION['user_id'] . ')', 'name asc');
    }


    $string_data = '[';
    if (count($data_user) > 0) {
        foreach ($data_user as $row_user) {
            $id = $row_user->id;
            $name = $row_user->name;
            $email = $row_user->user_email;
            $phone = $row_user->phone;
            $phong_ban = '';
            $number_tour = 0;
            $data_phongban = user_phongban_getByTop('', 'id=' . $row_user->phong_ban, '');
            $number_tour = booking_count('user_id=' . $row_user->id . ' and status!=5');
            if (count($data_phongban) > 0) {
                $phong_ban = $data_phongban[0]->name;
            }
            $string_data .= "['" . $id . "','" . $name . "','" . $email . "','" . $phone . "','" . $phong_ban . "','" . $number_tour . "'],";
        }
    }
    $string_data .= '];';
    return $string_data;
}

function _returnDataAutoCompleteUserTiepThi()
{
    $data_user = user_getByTop('', 'status=1 and user_role =2', 'name asc');

    $string_data = '[';
    if (count($data_user) > 0) {
        foreach ($data_user as $row_user) {
            $id = $row_user->id;
            $user_code = $row_user->user_code;
            $name = $row_user->name;
            $email = $row_user->user_email;
            $phone = $row_user->phone;
            $string_data .= "['" . $id . "','" . $user_code . "','" . $name . "','" . $email . "','" . $phone . "'],";
        }
    }
    $string_data .= '];';
    return $string_data;
}


function _getRandomNumbers($min, $max, $count)
{
    if ($count > (($max - $min) + 1)) {
        return false;
    }
    $values = range($min, $max);
    shuffle($values);
    return array_slice($values, 0, $count);
}

function _randomCustommr()
{
    $rand = (implode('', _getRandomNumbers(1, 99, 3))) . $_SESSION['user_id'];

}

function _randomBooking($code_module, $function_count, $field = 'code_booking')
{
    $rand_number = rand(1, 5);
    $user_id = '';
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    if ($code_module == 'az') {
        $code = implode('', _getRandomNumbers(1, 1000, $rand_number));
        if (strlen($code) <= 3) {
            $code = $code . rand(1000, 10000);
        }
        $key = array("68", "86", "69", "99", "66", '88', '66', '55', '26', '28', '83', '39', '79', '456', '486', '456', '569', '686', '868', '656', '1618', '8888', '6666');
        $code = substr($code, rand(2, 3), rand(3, 4));
        $code = $code . $key[array_rand($key)];;
        $rand = $code_module . '_' . $code;
    } else {
        $rand = $code_module . '_' . (implode('', _getRandomNumbers(1, 99, $rand_number))) . $user_id;
    }

    $data_booking = $function_count($field . '="' . $rand . '"');
    if ($data_booking > 0) {
        _randomBooking($code_module, $function_count, $field);
    } else {
        return $rand;
    }

}

function _insertNotification($name = '', $user_send_id = '', $user_id, $link = '', $status = 0, $content = '')
{
    $notification_model = new notification();
    $notification_model->name = $name;
    $notification_model->user_send_id = $user_send_id;
    $notification_model->user_id = $user_id;
    $notification_model->link = $link;
    $notification_model->status = $status;
    $notification_model->content = $content;
    $notification_model->created = _returnGetDateTime();
    notification_insert($notification_model);
}

function _insertLog($user_id, $module_id, $form_id, $action_id, $item_id, $value_old, $value_new, $description)
{
    $log_model = new log();
    $log_model->user_id = $user_id;
    $log_model->module_id = $module_id;
    $log_model->form_id = $form_id;
    $log_model->action_id = $action_id;
    $log_model->item_id = $item_id;
    $log_model->value_old = $value_old;
    $log_model->value_new = $value_new;
    $log_model->description = $description;
    $log_model->created = _returnGetDateTime();
    log_insert($log_model);
}

function _updateCustomerBooking($name_customer_sub, $email_customer, $phone_customer, $address_customer, $do_tuoi_customer, $tuoi_number_customer_sub, $birthday_customer_sub, $passport_customer_sub, $date_passport_customer_sub, $id_booking, $created_by = '')
{
    $booking_cus = new customer_booking();
    $booking_cus->booking_id = $id_booking;
    customer_booking_delete_all($booking_cus);
    if (count($name_customer_sub) > 0 && $name_customer_sub != '') {
        foreach ($name_customer_sub as $key => $value) {
            $name_sub = $value;
            $email_sub = '';
            if (isset($email_customer[$key])) {
                $email_sub = $email_customer[$key];
            }
            $phone_sub = '';
            if (isset($phone_customer[$key])) {
                $phone_sub = $phone_customer[$key];
            }

            $address_sub = '';
            if (isset($address_customer[$key])) {
                $address_sub = $address_customer[$key];
            }

            $dotuoi_sub = '';
            if (isset($do_tuoi_customer[$key])) {
                $dotuoi_sub = $do_tuoi_customer[$key];
            }
            $dotuoi_number_sub = 1;
            if (isset($tuoi_number_customer_sub[$key])) {
                $dotuoi_number_sub = $tuoi_number_customer_sub[$key];
            }

            $ngaysinh_sub = '';
            if (isset($birthday_customer_sub[$key])) {
                if ($birthday_customer_sub[$key] != '') {
                    $birthday_customer_sub[$key] = str_replace('/', '-', $birthday_customer_sub[$key]);
                    $ngaysinh_sub = date("Y-m-d", strtotime($birthday_customer_sub[$key]));
                }
            }
            $pass_sub = '';
            if (isset($passport_customer_sub[$key])) {
                $pass_sub = $passport_customer_sub[$key];
            }
            $date_pass_sub = '';
            if (isset($date_passport_customer_sub[$key])) {
                if ($date_passport_customer_sub[$key] != '') {
                    $date_passport_customer_sub[$key] = str_replace('/', '-', $date_passport_customer_sub[$key]);
                    $date_pass_sub = date("Y-m-d", strtotime($date_passport_customer_sub[$key]));
                }
            }
            if ($value != '') {
                $customer_new = new customer_booking();
                $customer_new->name = $name_sub;
                $customer_new->email = $email_sub;
                $customer_new->phone = $phone_sub;
                $customer_new->address = $address_sub;
                $customer_new->do_tuoi = $dotuoi_sub;
                $customer_new->do_tuoi_number = $dotuoi_number_sub;
                $customer_new->birthday = $ngaysinh_sub;
                $customer_new->passport = $pass_sub;
                $customer_new->date_passport = $date_pass_sub;
                $customer_new->updated = _returnGetDateTime();
                $customer_new->created = _returnGetDateTime();
                $customer_new->created_by = $created_by;
                $customer_new->booking_id = $id_booking;
                customer_booking_insert($customer_new);
            }
        }
    }
}

function _updateStatusNoti()
{
    if (isset($_GET['id_noti']) && $_GET['id_noti'] != '' && isset($_GET['noti'])) {
        $id_noti = _return_mc_decrypt(_returnGetParamSecurity('id_noti'), ENCRYPTION_KEY);
        $data_noti_id = notification_getById($id_noti);
        if (count($data_noti_id) > 0) {
            $noti_model = new notification((array)$data_noti_id[0]);
            $noti_model->status = 1;
            notification_update($noti_model);
        }
    }
}

function _returnLinkBooking($status)
{
    $action_link = '';
    switch ($status) {
        case '2':
            $action_link = 'booking-giao-dich';
            break;
        case '3':
            $action_link = 'booking-tam-dung';
            break;
        case '4':
            $action_link = 'booking-no-tien';
            break;
        case '5':
            $action_link = 'booking-ket-thuc';
            break;
        case '6':
            $action_link = 'booking-ban-nhap';
            break;
        default:
            $action_link = 'booking-new';
    }
    return $action_link;

}

function _returnGetAge($birthdate = '0000-00-00')
{
    if ($birthdate == '0000-00-00') return '';

    $bits = explode('-', $birthdate);

    $age = date('Y') - $bits[0] - 1;

    $arr[1] = 'm';
    $arr[2] = 'd';
    for ($i = 1; $arr[$i]; $i++) {

        $n = date($arr[$i]);
        if ($n < $bits[$i])
            break;
        if ($n > $bits[$i]) {
            ++$age;
            break;
        }
        if (!isset($arr[$i + 1])) {
            break;
        }
    }
    if ($age < -1) {
        return '';
    } else {
        return str_replace('-', '', $age + 1);
    }
}

function _returnRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function _returnUpdateTypeTiepThi($data_user, $user_tiep_thi)
{
    $data_user=user_getById($user_tiep_thi);
    $data_setting = _returnSettingHoaHong();
    if ($data_user[0]->type_tiep_thi == 0 || $data_user[0]->type_tiep_thi == 1) {
        $created_user = date("Y-m-d", strtotime($data_user[0]->created));
        $today_user = date("Y-m-d");
        $first_date = strtotime($created_user);
        $second_date = strtotime($today_user);
        $datediff = abs($first_date - $second_date);
        $count_day = floor($datediff / (60 * 60 * 24));
        $count_day = round($count_day / 30) + 1;
        for ($i = 1; $i <= $count_day; $i++) {
            $created_user = date('Y-m-d', strtotime('+3 months', strtotime($created_user)));
            if (strtotime($created_user) >= strtotime($today_user)) {
                break;
            }
        }
        $start_date = date('Y-m-d', strtotime('-3 months', strtotime($created_user))) . ' 00:00:00';
        $dk_filter_user_3 = "created>='" . $start_date . "' and created<='" . $today_user . " 23:59:59' and status=1 and type_tiep_thi=0 and user_gioi_thieu=" . $user_tiep_thi;
        $dk_filter_user_4 = "created>='" . $start_date . "' and created<='" . $today_user . " 23:59:59' and status=1 and type_tiep_thi=1 and  user_gioi_thieu=" . $user_tiep_thi;
        $dk_filter_booking = "created>='" . $start_date . "' and created<='" . $today_user . " 23:59:59' and  status=5 and user_tiep_thi_id=" . $user_tiep_thi;
        $type_tiep_thi = $data_user[0]->type_tiep_thi;
        $publisher_count_3 = user_count($dk_filter_user_3);
        $publisher_count_4 = user_count($dk_filter_user_4);
        $booking_count = booking_count($dk_filter_booking);
        $type_tiep_thi_new = $type_tiep_thi;
        if ($type_tiep_thi == 1) {
            if ($publisher_count_3 >=$data_setting['muc_5_thanh_vien_3'] && $booking_count >= $data_setting['muc_5_don_hang'] && $publisher_count_4>=$data_setting['muc_5_thanh_vien_4']) {
                $type_tiep_thi_new = 2;
            }
        } else {
            if ($publisher_count_3 >=$data_setting['muc_4_thanh_vien'] && $booking_count >=$data_setting['muc_4_don_hang']) {
                $type_tiep_thi_new = 1;
            }
        }
        if ($type_tiep_thi_new != $type_tiep_thi) {
            $user_share = new user((array)$data_user[0]);
            $user_share->type_tiep_thi = $type_tiep_thi_new;
            user_update($user_share);
            if ($type_tiep_thi_new == 1) {
                $start = '4 sao';
            } else {
                $start = '5 sao';
            }
            _insertNotification('Chúc mừng bạn đã được thăng hạng lên ' . $start . '. Bạn hãy click vào tin nhắn để xem tỷ lệ hoa hồng của ' . $start, 0, '','/tiep-thi-lien-ket-info/hoi-dap.html', 0, '');
        }
    }
}

function _returnConfirmTiepthi($data_check, $return = '', $return_array=0)
{
    if($data_check[0]->status_tiep_thi==0) {
        $data_user = user_getById($data_check[0]->user_tiep_thi_id);
        $string_return = '';
        if (count($data_user) > 0) {
            if ($data_user[0]->user_role == 2) {
                if ($data_check[0]->price_tiep_thi != '') {
                    $array = (array)$data_check[0];
                    $new = new booking($array);
                    $new->id = $data_check[0]->id;
                    $new->confirm_admin_tiep_thi = $_SESSION['user_id'];
                    $new->status_tiep_thi = 1;
                    $new->updated = _returnGetDateTime();
                    booking_update($new);
//                $name_noti = $_SESSION['user_name'] . ' đã xác nhận hoa hồng đơn hàng "' . $data_check[0]->code_booking . '"';
                    $name_noti = 'AZBOOKING.VN đã xác nhận hoa hồng đơn hàng "' . $data_check[0]->code_booking . '"';
                    _returnUpdateHoahong($data_user, $data_check[0]->price_tiep_thi, $data_check, $name_noti,$data_check[0]->user_tiep_thi_id);
                    if ($data_check[0]->level_gioi_thieu_tiep_thi_4 && $data_check[0]->hoa_hong_gioi_thieu_4 != '') {
                        $data_user_4 = user_getById($data_check[0]->level_gioi_thieu_tiep_thi_4);
                        if (count($data_user_4)) {
                            $name_noti = 'AZBOOKING.VN đã xác nhận hoa hồng giới thiệu thành viên cho đơn hàng "' . $data_check[0]->code_booking . '"';
                            _returnUpdateHoahong($data_user_4, $data_check[0]->hoa_hong_gioi_thieu_4, $data_check, $name_noti,$data_check[0]->level_gioi_thieu_tiep_thi_4);
                        }
                    }
                    if ($data_check[0]->level_gioi_thieu_tiep_thi_5 && $data_check[0]->hoa_hong_gioi_thieu_5 != '') {
                        $data_user_5 = user_getById($data_check[0]->level_gioi_thieu_tiep_thi_5);
                        if (count($data_user_5)) {
                            $name_noti = 'AZBOOKING.VN đã xác nhận hoa hồng giới thiệu thành viên cho đơn hàng "' . $data_check[0]->code_booking . '"';
                            _returnUpdateHoahong($data_user_5, $data_check[0]->hoa_hong_gioi_thieu_4, $data_check, $name_noti,$data_check[0]->level_gioi_thieu_tiep_thi_5);
                        }
                    }
                    if($return_array==1){
                        return $new;
                    }
                    $string_return = 1;
                } else {
                    $string_return = 'Đơn hàng không có hoa hồng';
                }
            } else {
                $string_return = 'Thành viên không có quyền nhận hoa hồng';
            }
            _returnUpdateTypeTiepThi(array(), $data_check[0]->user_tiep_thi_id);

        } else {
            $string_return = 'Sales không tồn tại trong hệ thống';
        }
    }else{
        $string_return = 'Hoa hồng đã được xác nhận';
    }
    if ($return == 1) {
        return $string_return;
    }
}
function _returnUpdateHoahong($data_user, $price_ho_hong, $data_check,$name_noti,$user_tiep_thi_id){
    $hoa_hong = $data_user[0]->hoa_hong + $price_ho_hong;
    $array_user = (array)$data_user[0];
    $new_user = new user($array_user);
    $new_user->hoa_hong = $hoa_hong;
    user_update($new_user);
//    $name_noti = $_SESSION['user_name'] . ' đã xác nhận hoa hồng đơn hàng "' . $data_check[0]->code_booking . '"';
    $link_noti = '/tiep-thi-lien-ket/don-hang/chi-tiet?noti=1&id=' . _return_mc_encrypt($data_check[0]->id, ENCRYPTION_KEY);
    _insertNotification($name_noti, $_SESSION['user_id'], $user_tiep_thi_id, $link_noti, 0, '');
    _insertLog($_SESSION['user_id'], 6, 6, 22, $data_check[0]->id, '', '', $name_noti);

}

function _returnHoaHongBooking($booking_model, $data_user_tiep_thi, $price_tiep_thi_thuc_te)
{
    $data_setting = _returnSettingHoaHong();
    $hoa_hong_gioi_thieu_4='';
    $hoa_hong_gioi_thieu_5_3='';
    $hoa_hong_gioi_thieu_5_4='';
    switch ($data_user_tiep_thi[0]->type_tiep_thi) {
        case '1':
            $price_tiep_thi = round(($price_tiep_thi_thuc_te * $data_setting['hoa_hong_4']) / 100);
            $hoa_hong_gioi_thieu_5_4 = round(($price_tiep_thi * $data_setting['hoa_hong_gt_5_4']) / 100);
            break;
        case '2':
            $price_tiep_thi = round(($price_tiep_thi_thuc_te * $data_setting['hoa_hong_5']) / 100);
            break;
        case '3':
            $price_tiep_thi = round(($price_tiep_thi_thuc_te * $data_setting['hoa_hong_dai_ly']) / 100);;
            break;
        default;
            $price_tiep_thi = round(($price_tiep_thi_thuc_te * $data_setting['hoa_hong_3']) / 100);
            $hoa_hong_gioi_thieu_4=round(($price_tiep_thi * $data_setting['hoa_hong_gt_4']) / 100);
            $hoa_hong_gioi_thieu_5_4=round(($hoa_hong_gioi_thieu_4 * $data_setting['hoa_hong_gt_5_4']) / 100);
            $hoa_hong_gioi_thieu_5_3=round(($price_tiep_thi * $data_setting['hoa_hong_gt_5_3']) / 100);
    }
    $booking_model->price_tiep_thi = $price_tiep_thi;
    $booking_model->level_tiep_thi = $data_user_tiep_thi[0]->type_tiep_thi;
    if ($data_user_tiep_thi[0]->user_gioi_thieu != 0 && $data_user_tiep_thi[0]->type_tiep_thi!=2 && $data_user_tiep_thi[0]->type_tiep_thi!=3) {
            $data_user_gioithieu = user_getById($data_user_tiep_thi[0]->user_gioi_thieu);
            if ($data_user_gioithieu) {
                switch ($data_user_gioithieu[0]->type_tiep_thi) {
                    case '1':
                        $booking_model->level_gioi_thieu_tiep_thi_4 = $data_user_tiep_thi[0]->user_gioi_thieu;
                        if($data_user_tiep_thi[0]->type_tiep_thi<$data_user_gioithieu[0]->type_tiep_thi && $hoa_hong_gioi_thieu_4!=''){
                            $booking_model->hoa_hong_gioi_thieu_4=$hoa_hong_gioi_thieu_4;
                        }
                        if($data_user_gioithieu[0]->user_gioi_thieu){
                            $data_user_gioithieu_c1 = user_getById($data_user_gioithieu[0]->user_gioi_thieu);
                            if($data_user_gioithieu_c1){
                                if($data_user_gioithieu_c1[0]->type_tiep_thi==2){
                                    $booking_model->level_gioi_thieu_tiep_thi_5 = $data_user_gioithieu[0]->user_gioi_thieu;
                                    if($data_user_gioithieu_c1[0]->type_tiep_thi>$data_user_gioithieu[0]->type_tiep_thi && $hoa_hong_gioi_thieu_5_4!=''){
                                        $booking_model->hoa_hong_gioi_thieu_5=$hoa_hong_gioi_thieu_5_4;
                                    }
                                }
                            }
                        }
                        break;
                    case '2':
                        $booking_model->level_gioi_thieu_tiep_thi_5 = $data_user_tiep_thi[0]->user_gioi_thieu;
                        if($data_user_tiep_thi[0]->type_tiep_thi<$data_user_gioithieu[0]->type_tiep_thi){
                            if($data_user_tiep_thi[0]->type_tiep_thi==0 && $hoa_hong_gioi_thieu_5_3!=''){
                                $booking_model->hoa_hong_gioi_thieu_5=$hoa_hong_gioi_thieu_5_3;
                            }
                            if($data_user_tiep_thi[0]->type_tiep_thi==1 && $hoa_hong_gioi_thieu_5_4!=''){
                                $booking_model->hoa_hong_gioi_thieu_5=$hoa_hong_gioi_thieu_5_4;
                            }

                        }
                        break;
                    default;
                        $booking_model->level_gioi_thieu_tiep_thi_3 = $data_user_tiep_thi[0]->user_gioi_thieu;
                        if($data_user_gioithieu[0]->user_gioi_thieu){
                            $data_user_gioithieu_c1 = user_getById($data_user_gioithieu[0]->user_gioi_thieu);
                            if($data_user_gioithieu_c1){
                                if($data_user_gioithieu_c1[0]->type_tiep_thi==2){
                                    $booking_model->level_gioi_thieu_tiep_thi_5 = $data_user_gioithieu[0]->user_gioi_thieu;
                                }
                                if($data_user_gioithieu_c1[0]->type_tiep_thi==1){
                                    $booking_model->level_gioi_thieu_tiep_thi_4 = $data_user_gioithieu[0]->user_gioi_thieu;
                                }
                            }
                        }
                }
            }
    }
    return $booking_model;
}

function _returnHoahongGioiThieuTiepthi($data_user, $hoa_hong)
{
//    if($data_user[0]->user_tiep_thi_1)
}

function _returnSettingHoaHong()
{
    $data = setting_hoa_hong_getByTop('1', '', 'id desc');
    if ($data) {
        $res =(array) $data[0];
    } else {
        $res = array(
            'hoa_hong_3' => '30',
            'hoa_hong_4' => '50',
            'hoa_hong_5' => '70',
            'hoa_hong_dai_ly' => '100',
            'hoa_hong_gt_3' => '0',
            'hoa_hong_gt_4' => '10',
            'hoa_hong_gt_5_3' => '5',
            'hoa_hong_gt_5_4' => '10',
            'hoa_hong_gt_dl' => '0',
            'muc_4_don_hang' => '20',
            'muc_4_thanh_vien' => '10',
            'muc_5_don_hang' => '10',
            'muc_5_thanh_vien_3' => '10',
            'muc_5_thanh_vien_4' => '5',
        );
    }
    return $res;
}
function _returnListGiaodich($id){
    $data=booking_giao_dich('bk.booking_id='.$id);
    if($data){
        $array_data=array();
        $string_res='';
        $count=0;
        foreach($data as $row){
            $admin_icon='';
            if($row['customer_id']){
                if ($row['avatar_cus'] == '') {
                    $link_ava = SITE_NAME . '/view/default/themes/images/no-avatar.png';
                } else {
                    $link_ava = SITE_NAME .$row['avatar_cus'];
                }
                $name_user=$row['name_cus'].' '.$row['code_cus'];
                $link=SITE_NAME.'/khach-hang/sua?id='._return_mc_encrypt($row['customer_id']);
                $admin_icon=' <span class="label label-info arrowed arrowed-in-right">Khách hàng</span>';
            }else{
                if ($row['avatar'] == '') {
                    $link_ava = SITE_NAME . '/view/default/themes/images/no-avatar.png';
                } else {
                    $link_ava = SITE_NAME .$row['avatar'];
                }
                $name_user=$row['name_user'].' '.$row['user_code'];;
                $link=SITE_NAME.'/nhan-vien/sua?id='._return_mc_encrypt($row['user_id']);
                if($row['user_role']==1){
                    $admin_icon=' <span class="label label-info arrowed arrowed-in-right">admin</span>';
                }else{
                    if($row['user_role']==2){
                        $admin_icon=' <span class="label label-info arrowed arrowed-in-right">Thành viên tiếp thị</span>';
                    }
                }
            }

            $content=$row['description'];
            $hidde_btn_show='display: none!important;';

            if (strlen($content) > 100) {
                $ten1=strip_tags($content);
                $ten = substr($ten1, 0, 100);
                $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                $content=$name;
                $hidde_btn_show='';
            }


            $backgroup='';
            if($count%2==0){
                $backgroup='background: #f1f9ee;';
            }
            $string_res.='<div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="'.$name_user.'" src="'.$link_ava.'"/>
                                                        </div>
                                                        <div style="'.$backgroup.'" class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="orange">'._returnDateFormatConvertVN($row['created']).'</span>
                                                            </div>

                                                            <div class="name">
                                                                <a target="_blank" href="'.$link.'">'.$name_user.'</a>
                                                               '.$admin_icon.'
                                                            </div>
                                                            <div class="text" id="short_text_'.$row['id'].'">'.$content.'</div>
                                                            <div hidden id="long_text_'.$row['id'].'">
                                                               '.$row['description'].'
                                                            </div>
                                                            <div style="display:block; '.$hidde_btn_show.'" class="tools">
                                                                <a title="Xem chi tiết" href="javascript:void(0)" countid="'.$row['id'].'" data-hide="show" class="show_content_full">
                                                                    <i id="icon_show_hide_'.$row['id'].'" class="icon-only ace-icon fa fa-expand"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>';
            $item=array(
                'id'=>$row['id'],
                'booking_id'=>$row['booking_id'],
                'user_id'=>$row['user_id'],
                'name'=>$row['name'],
                'description'=>$row['description'],
                'created'=>$row['created'],
                'name_user'=>$row['name_user'],
                'avatar'=>$link_ava
            );
            array_push($array_data,$item);
            $count++;
        }
        if($array_data){
            return $string_res;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

function _returnInsertChiphiBooking($booking_id, $user_id, $name,$price,$description,$created, $mess_log){
    $obj = new booking_cost();
    $obj->booking_id = $booking_id;
    $obj->user_id = $user_id;
    $obj->name = $name;
    $obj->price = $price;
    $obj->description = $description;
    $obj->created = date('Y-m-d', strtotime($created));
    $obj->created_by = $_SESSION['user_id'];
    booking_cost_insert($obj);
    _insertLog($_SESSION['user_id'],6,6,33,0,'','',$mess_log);
}