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

if(isset($_GET['id'])&&$_GET['id']!='')
{   $data['action']=2;
    if (_returnCheckAction(2) == 0) {
        redict(_returnLinkDangNhap());
    }
//    echo $_GET['id'];
     $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user']=customer_getById($id);

    if(count($data['data_user'])==0)
    {
        redict(SITE_NAME.'/khach-hang/');
    }
    $url_bread = '<li><a href="'.SITE_NAME.'/khach-hang/">Khách hàng</a></li><li class="active">Chỉnh sửa khách hàng "'.$data['data_user'][0]->name.'"</li>';
    $data['title'] = 'Chỉnh sửa khách hàng "'.$data['data_user'][0]->name.'"';
}else{
    if (_returnCheckAction(1) == 0) {
        redict(_returnLinkDangNhap());
    }
    $data['data_user']='';
    $data['action']=1;
    $url_bread = '<li><a href="'.SITE_NAME.'/khach-hang/">Khách hàng</a></li><li class="active">Thêm khách hàng</li>';
    $data['title'] = 'Thêm khách hàng';
}



$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$data['breadcrumbs'] = $url_bread;

$data['module_valid'] = "customer";
$count = 8;
show_header($data);
show_left($data, 'khach_hang', 'customer_list');
show_breadcrumb($data);
show_navigation($data);
show_customer_themmoi($data);
show_footer($data);
_returnCreateUser(1);
show_valid_form($data);
show_script_form($data);

