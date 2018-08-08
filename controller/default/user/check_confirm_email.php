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
require_once DIR . '/email_template/tem_01_2018/index.php';
$data = array();
$array_res = array(
    'success' => 0,
    'mess' => 'Xác nhận tài khoản lỗi, vui lòng thử lại'
);
if (isset($_POST['value']) && isset($_POST['mail_send']) && isset($_POST['key'])) {

    $mail_send = _returnPostParamSecurity('mail_send');
    $email = _returnPostParamSecurity('value');
    $key = _returnPostParamSecurity('key');

    if ($email != '' && $mail_send != '' && $key!='' ) {
        $mail_send=base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($mail_send)))));
        if($mail_send == $email){
            $dk_check_user = "user_email ='" . $mail_send . "'";
            $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
            if (count($data_check_exist_user) > 0) {
                if($data_check_exist_user[0]->status==0){
                    $email_tem = returnEmail01218();
                    $email_tem = _returnReplaceEmailTem($email_tem);
                    $email_tem = str_replace('{{TITLE}}', 'Xác thực tài khoản AZBOOKING.VN thành công', $email_tem);

                    $dangky = new user((array)$data_check_exist_user[0]);
                    $dangky->status=1;
                    $link_check = SITE_NAME_ADMIN_AZ.'/thanh-vien.html';
                    $content = '  <div class="content_data" style="float: left; width: 100%">
                                            <div style="float: left;width: 100%">
                                                <p style="font-weight: normal">
                                                    Chào bạn <b>' . $data_check_exist_user[0]->name . '</b> ! </p>
                                                <p style="font-weight: normal; line-height: 25px"> <b style="color: #0061AB;">AZBOOKING.VN</b> chúc mừng tài khoản <b>' . $data_check_exist_user[0]->user_email . '</b> kích hoạt thành công.  Bạn đã sẵn sàng đăng nhập và tạo chiến dịch tiếp thị liên kết cho riêng mình</p>
                                                 <p >Link đăng nhập: <a style="color: #0091ea;" href="' .$link_check . '">' .$link_check . '</a></p>
                                                 <p>Trân trọng !</p>
                                            </div>
                                         
                                          
                                        </div>';
                    $email_tem = str_replace('{{CONTENT}}', $content, $email_tem);
                    $subject = "Thông báo xác thực tài khoản AZBOOKING.VN";
                    if (SendMail($data_check_exist_user[0]->user_email, $email_tem, $subject, 1, 'AZBOOKING.VN')) {
                        user_update($dangky);
                        $array_res['success'] = 1;
                        $array_res['mess'] = 'Azbooking.vn xác nhận tài khoản của bạn đã đã được kích hoạt, Bạn hãy đăng nhập để bắt đầu chiến dịch tiếp thị liên kết';
                    }
                }else{
                    $array_res['mess']='Bạn không thể thực hiện kích hoạt tài khoản';
                }

            }else{
                $array_res['mess']='Tài khoản không tồn tại trong hệ thống';
            }
        }
    }
}
echo json_encode($array_res);