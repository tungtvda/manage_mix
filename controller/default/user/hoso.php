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
if (_returnCheckAction(15) == 0) {
    redict(_returnLinkDangNhap());
}
_returnCheckExitUser();
$data['data_user']=user_getById($_SESSION['user_id']);
if(count($data['data_user'])==0){
    redict(_returnLinkDangNhap());
}
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li><a href="'.SITE_NAME.'/nhan-vien/">Nhân viên</a></li><li class="active">Hồ sơ</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Hồ sơn nhân viên "'.$data['data_user'][0]->name.'"';
$count=8;
_deleteSubmitForm('user', 'user_delete');
$data['list']=user_getByTop('','','updated desc');
$data['module_valid'] = "user";
$data['title_print'] = 'Hồ sơn nhân viên "'.$data['data_user'][0]->name.'"';
show_header($data);
show_left($data,'user','user_list');
show_breadcrumb($data);
show_navigation($data);
show_user_hoso($data);
show_footer($data);
show_valid_form($data);
show_script_form($data);