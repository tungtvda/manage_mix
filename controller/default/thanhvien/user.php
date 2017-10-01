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
_returnCheckPermison(9,16);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Nhân viên</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Danh sách nhân viên';
$count=9;
_returnCreateUser(1);
_deleteSubmitForm('user', 'user_delete',3,2,3);
$data_dk_fill='user_role=2';
if($_SESSION['user_role']==0)
{
    $data['dk_find'] = "user_role=2 and created_by=".$_SESSION['user_id'];
    $data_dk_fill=' and created_by='.$_SESSION['user_id'];
}
$data['list']=user_getByTop('',$data_dk_fill,'updated desc');
$data['module_valid'] = "user";
$data['title_print'] = "Danh sách thành viên tiếp thị";
show_header($data);
show_left($data,'thanh_vien','thanh_vien_list');
show_breadcrumb($data);
show_navigation($data);
show_thanhvien_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);