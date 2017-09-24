<?php
define("SITE_NAME", "http://manage.mixtourist.com.vn");
define("DIR", str_replace('/controller/default/email_marketing','',dirname(__FILE__)));
define('SERVER','localhost');
define('DB_USERNAME','mixmedia_manage');
define('DB_PASSWORD','rMzRBcBd');
define('DB_NAME','mixmedia_manage');
define('CACHE',false);
define('DATETIME_FORMAT',"y-m-d H:i:s");
define('DATETIME_FORMAT_VN',"d-m-y H:i:s");
define('PRIVATE_KEY','hoidinhnvbk');

require_once DIR . '/model/userService.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');
$time_now=gmdate("Y-m-d H:i:s", time());

$data_user=user_getByTop('','status=1','');
print_r($data_user);