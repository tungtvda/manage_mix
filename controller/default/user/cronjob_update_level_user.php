<?php
//define("SITE_NAME", "http://manage.mixtourist.com.vn");
//define("DIR", str_replace('/controller/default/user','',dirname(__FILE__)));
//define('SERVER','localhost');
//define('DB_USERNAME','mixmedia_manage');
//define('DB_PASSWORD','rMzRBcBd');
//define('DB_NAME','mixmedia_manage');
//define('CACHE',false);
//define('DATETIME_FORMAT',"y-m-d H:i:s");
//define('DATETIME_FORMAT_VN',"d-m-y H:i:s");
//define('PRIVATE_KEY','hoidinhnvbk');

define("SITE_NAME", "http://localhost/manage_mix");
define("DIR", str_replace('\controller\default\user','',dirname(__FILE__)));
define('SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','manage_mix');
define('CACHE',false);
define('DATETIME_FORMAT',"y-m-d H:i:s");
define('DATETIME_FORMAT_VN',"d-m-y H:i:s");
define('PRIVATE_KEY','hoidinhnvbk');


require_once DIR . '/model/userService.php';
require_once DIR . '/model/notificationService.php';
require_once DIR . '/model/bookingService.php';
require_once DIR . '/model/setting_hoa_hongService.php';
require_once DIR . '/function/function.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time_now=_returnGetDateTime();

$data_user=user_getByTop('','status=1','');
$data_setting = _returnSettingHoaHong();

$user_list=user_getByTop('','status=1 and user_role=2 and type_tiep_thi!=3','id asc');
if($user_list){
    foreach($user_list as $data_user){
        $created_user = date("Y-m-d", strtotime($data_user->created));
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
//        echo $created_user.' - '.$start_date. ' <br> ';
        $dk_filter_user_3 = "created>='" . $start_date . "' and created<='" . $created_user . " 23:59:59' and status=1 and type_tiep_thi=0 and user_gioi_thieu=" . $data_user->id;
        $dk_filter_user_4 = "created>='" . $start_date . "' and created<='" . $created_user . " 23:59:59' and status=1 and type_tiep_thi=1 and  user_gioi_thieu=" . $data_user->id;
        $dk_filter_booking = "created>='" . $start_date . "' and created<='" . $created_user . " 23:59:59' and  status=5 and user_tiep_thi_id=" . $data_user->id;
        $publisher_count_3 = user_count($dk_filter_user_3);
        $publisher_count_4 = user_count($dk_filter_user_4);
        $booking_count = booking_count($dk_filter_booking);
        $type_tiep_thi_new =$data_user->type_tiep_thi;
        if ($data_user->type_tiep_thi == 2) {
            if ($publisher_count_3 >=$data_setting['muc_5_thanh_vien_3'] && $booking_count >= $data_setting['muc_5_don_hang'] && $publisher_count_4>=$data_setting['muc_5_thanh_vien_4']) {
                $type_tiep_thi_new = 2;
            }else{
                $type_tiep_thi_new = 1;
            }
        } else {
            if ($data_user->type_tiep_thi == 1)
            {
                if ($publisher_count_3 >=$data_setting['muc_4_thanh_vien'] && $booking_count >=$data_setting['muc_4_don_hang']) {
                    $type_tiep_thi_new = 1;
                }else{
                    $type_tiep_thi_new = 0;
                }
            }

        }
        if ($type_tiep_thi_new != $data_user->type_tiep_thi && $today_user>=$created_user) {
            $user_share = new user((array)$data_user);
            $user_share->type_tiep_thi = $type_tiep_thi_new;
            user_update($user_share);
            if ($type_tiep_thi_new == 1) {
                $start = '4 sao';
            } else {
                $start = '3 sao';
            }
            _insertNotification('Trong 3 tháng vừa qua từ ngày '.$start_date.' đến ngày '.$created_user.' bạn đã không giữ được thứ hạng, hiện tại thứ hạng của bạn là ' . $start . '. Bạn hãy click vào tin nhắn để xem tỷ lệ hoa hồng của ' . $start, 0, '', SITE_NAME_AZ . '/tiep-thi-lien-ket-info/hoi-dap.html', 0, '');
        }

    }
}
