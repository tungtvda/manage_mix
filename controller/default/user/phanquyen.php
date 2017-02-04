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
if(!isset($_GET['id'])||$_GET['id']=='')
{
    redict(_returnLinkDangNhap());
}

$data=array();
$data['id_user']=_returnGetParamSecurity('id');
_returnCheckPermison(0,0);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Nhân viên</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Phân quyền tài khoản người dùng';
$count=8;
$data['list']=user_getByTop('','','updated asc');
if(isset($_FILES['image'])){
    print_r($_FILES['image']);
    exit;
}
show_header($data);
show_left($data,'user','user_list');
show_breadcrumb($data);
show_navigation($data);
show_user_phanquyen($data);
show_footer($data);
//show_script_table($data);
