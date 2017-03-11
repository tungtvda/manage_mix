<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../../config.php';
}
require_once DIR.'/controller/default/public.php';
$data=array();
_returnCheckPermison(6,6);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Đặt tour</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Danh sách đặt tour';
$count=10;
//_returnCreateCustomer(1);
//_deleteSubmitForm('customer', 'customer_delete');
$data_dk_fill='';
if($_SESSION['user_role']==0)
{
    $data['dk_find'] = "user_id=".$_SESSION['user_id'];
    $data_dk_fill='user_id='.$_SESSION['user_id'];
}else{
    $data['dk_find'] = "created_by=".$_SESSION['user_id'];
    $data_dk_fill='created_by='.$_SESSION['user_id'];
}

$data['list']=booking_getByTop('',$data_dk_fill,'updated desc');
$data['module_valid'] = "booking";
$data['title_print'] = "Danh sách đặt tour";
show_header($data);
show_left($data,'booking','booking_list');
show_breadcrumb($data);
show_navigation($data);
show_booking_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);