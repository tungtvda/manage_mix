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
_returnCheckPermison(6,20);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Tour yêu cầu </li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Danh sách tour yêu cầu';
$count=9;
$data_dk_fill='';

$data['list']=tourUserAllDongHang($data_dk_fill);
$data['module_valid'] = "tour_create_user";
$data['title_print'] = "Danh sách tour yêu cầu";
show_header($data);
show_left($data,'booking','tour_yeu_cau');
show_breadcrumb($data);
show_navigation($data);
show_tour_yeu_cau_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);