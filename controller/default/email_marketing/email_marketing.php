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
// $action_link=str_replace('manage_mix','',$_SERVER['REQUEST_URI']);
//$action_link=str_replace('/','',$action_link);

if(isset($_GET['type'])&&$_GET['type']==1){
    $action_link='chuc-mung-sinh-nhat';
    $data['type']=1;
    $active_tab_left='chuc_mung_sinh_nhat';
    $name_bread="Email - SMS chúc mừng sinh nhật";
    $data_dk_fill='type=1';
    $data['title']='Danh sách email-sms chúc mừng sinh nhật khách hàng ';
    $data['form']=13;
    $data['action_list']=24;
    $data['action_them']=25;
    $data['action_sua']=26;
    $data['action_xoa']=27;
}
else{
    $action_link='cham-soc-khach-hang';
    $data['type']=0;
    $active_tab_left='cham_soc_khach_hang';
    $name_bread="Email - SMS chăm sóc khách hàng";
    $data_dk_fill='type=0';
    $data['title']='Danh sách email-sms chăm sóc khách hàng ';
    $data['form']=14;
    $data['action_list']=28;
    $data['action_them']=29;
    $data['action_sua']=30;
    $data['action_xoa']=31;
}


if($_SESSION['user_role']==0)
{
    $data_dk_fill='and created_by='.$_SESSION['user_id'];
}
_deleteSubmitForm('sms_email', 'sms_email_delete',7,$data['form'],$data['action_xoa']);



$data['dk_find'] =$data_dk_fill;
$url_bread='<li class="active">'.$name_bread.'</li>';
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