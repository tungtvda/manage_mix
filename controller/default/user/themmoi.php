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
if(_returnCheckAction(1)==0){
    redict(_returnLinkDangNhap());
}

$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Thêm nhân viên</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Thêm nhân viên';
$count=8;
show_header($data);
show_left($data,'user','user_list');
show_breadcrumb($data);
show_navigation($data);
show_user_themmoi($data);
show_footer($data);
show_script_form($data);
