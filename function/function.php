<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/24/2016
 * Time: 4:21 PM
 */
require_once DIR . '/model/userService.php';

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
        redict(_returnLinkDangNhap());
    }
    if ($form_id != 0) {
        if (!in_array($form_id, $permison_form)) {
            redict(_returnLinkDangNhap());
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
        redict(_returnLinkDangNhap());
    }
    if (!in_array($action_id, $_SESSION['user_permison_action'])) {
        redict(_returnLinkDangNhap());
    }
    return true;
}

function _returnCheckExitUser()
{
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        redict(_returnLinkDangNhap());
    }
}

function _returnLinkDangNhap()
{
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
    return $_SERVER['DOCUMENT_ROOT'].'/manage_mix/';
}