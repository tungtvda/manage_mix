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
_returnCheckPermison(3,2);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Khách hàng</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Danh sách khách hàng';
$count=8;
_returnCreateCustomer(1);
_deleteSubmitForm('user', 'user_delete');
$data['list']=customer_getByTop('','status=1','updated desc');
$data['module_valid'] = "customer";
$data['title_print'] = "Danh sách khách hàng";
show_header($data);
show_left($data,'khach_hang','customer_list');
show_breadcrumb($data);
show_navigation($data);
show_customer_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);