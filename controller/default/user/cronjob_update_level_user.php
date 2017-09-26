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
        echo $created_user.' - '.$start_date. ' <br> ';
    }
}
