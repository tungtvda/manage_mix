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
require_once(DIR . "/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$array_res = array(
    'success' => 0,
    'mess' => 'Bạn vui lòng kiểu tra thông tin đăng ký'
);
if (isset($_POST['mail_create']) && isset($_POST['email_dangky']) && isset($_POST['username_dangky']) && isset($_POST['password_dangky']) && isset($_POST['confirm_password_dangky']) && isset($_POST['confirm_res'])) {

    $user_email = _returnPostParamSecurity('email_dangky');
    $mail_create = _return_mc_decrypt(_returnPostParamSecurity('mail_create'), '');
    $name = _returnPostParamSecurity('username_dangky');
    $password = _returnPostParamSecurity('password_dangky');
    $password_confirm = _returnPostParamSecurity('confirm_password_dangky');
    $confirm_res = _returnPostParamSecurity('confirm_res');
    if ($user_email != '' && $name != '' && $password != '' && $password_confirm != '' && $confirm_res == 1 && $mail_create != '') {
        $dk_check_user = "user_email ='" . $user_email . "'";
        $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $array_res['mess'] = 'Email đã tồn tại trong hệ thống, vui lòng nhập email khác';
        } else {
            if ($password != $password_confirm) {
                $array_res['mess'] = 'Hai mật khẩu không khớp';
            } else {
                $link_check = 'tiep-thi-lien-ket/thanh-vien/?type=xac-nhan&key=' . base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($user_email)))));
                $mail_create = str_replace('[username_dangky]', $name, $mail_create);
                $mail_create = str_replace('[link_dangky]', $link_check, $mail_create);
                $dangky = new user();
                $dangky->name = $name;
                $dangky->user_email = $user_email;
                $dangky->user_name = $user_email;
                $dangky->type_tiep_thi = 0;
                $check_pass=1;
                if (isset($_POST['user_tiep_thi']) && $_POST['user_tiep_thi']!='') {
                    $user_tiep_thi = _return_mc_decrypt(_returnPostParamSecurity('user_tiep_thi'));
                    $data_user = user_getById($user_tiep_thi);
                    if(count($data_user)>0){

                        $dangky->user_gioi_thieu = $user_tiep_thi;
                    }else{
                        $check_pass=0;
                        $array_res['mess'] = 'Tạo tài khoản thất bại, bạn vui lòng nhấn Ctrl+f5 và thử lại';
                    }
                }
                if(isset($_POST['type']) && $_POST['type']==1){
                    $password=_returnRandomString();
                    if (isset($_POST['phone']) && $_POST['phone']!=''){
                        $dangky->phone = _returnPostParamSecurity('phone');
                        $dangky->mobi = _returnPostParamSecurity('mobi');
                    }else{
                        $check_pass=0;
                        $array_res['mess'] = 'Bạn vui lòng nhập số điện thoại';
                    }
                    if (isset($_POST['address']) && $_POST['address']!=''){
                        $dangky->address = _returnPostParamSecurity('address');
                    }else{
                        $check_pass=0;
                        $array_res['mess'] = 'Bạn vui lòng nhập địa chỉ';
                    }
                    $array_res['mess'] = 'Tài khoản '.$name.' đã được tạo thành công';
                }else{
                    $array_res['mess'] = 'Azbooking.vn cảm ơn quý khách đã đăng ký tài khoản tiếp thị liên kết. Quý khách vui lòng truy cập email <b style="color: #2e7ec7">' . $user_email . '</b>  để xác thực tài khoản.';
                }
                if($check_pass){
                    $Pass = hash_pass($password);
                    $dangky->password = $Pass;
                    $dangky->created = _returnGetDateTime();
                    $dangky->login_two_steps = 0;
                    $dangky->user_role = 2;
                    $subject = "Thông báo đăng ký tài khoản tại AZBOOKING.VN";
                    if (SendMail($user_email, $mail_create, $subject, 1, 'AZBOOKING.VN')) {
                        $dangky->user_code = _randomBooking('az', 'user_count');
                        user_insert($dangky);
                        $array_res['success'] = 1;
                        if (isset($data_user)) {
                            _returnUpdateTypeTiepThi($data_user,$user_tiep_thi);
                        }
                    if(isset($_POST['type']) && $_POST['type']==1){
                        $array_res['danhsach'] = '<tr>
            <td ><i class="fa fa-check-square-o " style="color: green" aria-hidden="true"></i></td>
            <td ><img style="width: 50px" src="'.SITE_NAME.'/view/default/themes/images/no-avatar.png"></td>
            <td>'.$dangky->name.'</td>
            <td class="lienhe_thanhvien">
                <p><i class="fa fa-phone" ></i> '.$dangky->phone.'</p>
            </td>
            <td><a class="btn btn-warning">3 sao</a></td>
            <td><a class="btn btn-danger">Chưa kích hoạt</a></td>
            <td>'._returnDateFormatConvert($dangky->created).'</td>';
                    }
                    }
                }else{

                }


            }
        }
    }
}
echo json_encode($array_res);