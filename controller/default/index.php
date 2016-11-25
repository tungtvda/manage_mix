<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}
require_once DIR.'/controller/default/public.php';
$data=array();
$url_bread='<li><a href="">Trang chủ</a></li><li class="active">List</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Hệ thống quản lý MIXTOURIST';

show_header($data);
show_left($data);
show_breadcrumb($data);
show_navigation($data);
show_index($data);
show_footer($data);
show_footer($data);
show_script_table($data);
