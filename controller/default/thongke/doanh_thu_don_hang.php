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
_returnCheckPermison(2,5);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Thống kê</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Doanh thu đơn hàng';
$count=9;
$data_dk_fill=' bk.id>0 ';
if($_SESSION['user_role']==0)
{
    $data_dk_fill='bk.created_by='.$_SESSION['user_id'];
}
if(isset($_GET['start'])&&$_GET['start']!='')
//$data['list']=booking_thongke_doanh_thu($data_dk_fill);
//print_r($data['list']);
//exit;
$data['list']=customer_getByTop('',$data_dk_fill,'updated desc');
$data['module_valid'] = "thong-ke";
$data['title_print'] = "Doanh thu đơn hàng";
$data['trang_thai_don_hang']=trang_thai_don_hang_getByTop('','','position desc');
show_header($data);
show_left($data,'thong-ke','doanh_thu_don_hang');
show_breadcrumb($data);
show_navigation($data);
show_thong_ke_danh_thu($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);