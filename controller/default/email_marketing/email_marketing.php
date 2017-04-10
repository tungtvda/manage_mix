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
_returnCheckPermison(7,14);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 $action_link=str_replace('manage_mix','',$_SERVER['REQUEST_URI']);
$action_link=str_replace('/','',$action_link);
$data_dk_fill='type=0';
$active_tab_left='cham_soc_khach_hang';
if($_SESSION['user_role']==0)
{
    $data_dk_fill='and created_by='.$_SESSION['user_id'];
}

$data['title']='Danh sách email-sms chăm sóc khách hàng ';


$data['dk_find'] =$data_dk_fill;
$url_bread='<li class="active">Email - SMS chăm sóc khách hàng</li>';
$data['breadcrumbs']=$url_bread;
$data['action_link']=$action_link;
$count=10;
//_returnCreateCustomer(1);
//_deleteSubmitForm('customer', 'customer_delete');



$data['list']=sms_email_getByTop('',$data_dk_fill,'updated desc');
$data['module_valid'] = "email";
$data['title_print'] = $data['title'];
show_header($data);
show_left($data,'email',$active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_email_marketing_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);