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
_returnCheckPermison(5,0);
$url_bread='<li><a href="">Trang chủ</a></li><li class="active">List</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Hệ thống quản lý MIXTOURIST';
$data_dk_fill='';
if($_SESSION['user_role']==0)
{
    $data_dk_fill='user_id='.$_SESSION['user_id'].' and ';
}
$data['count_don_hang_moi']=booking_count($data_dk_fill.' status=1 ');
$data['count_dang_giao_dich']=booking_count($data_dk_fill.' status=2 ');
$data['count_tam_dung']=booking_count($data_dk_fill.' status=3 ');
$data['count_no_tien']=booking_count($data_dk_fill.' status=4 ');
$data['count_ket_thuc']=booking_count($data_dk_fill.' status=5 ');
$data['count_ban_nhap']=booking_count($data_dk_fill.' status=6 ');
$data['count_all']=$data['count_don_hang_moi']+$data['count_dang_giao_dich']+$data['count_tam_dung']+$data['count_no_tien']+$data['count_ket_thuc']+$data['count_ban_nhap'];
$date_hien_tai=_returnGetDateMouth();
$dk_hien_tai='birthday LIKE "%'.$date_hien_tai.'%"';

$data['customer_sinh_nhat_hien_tai']=customer_getByTop('',$dk_hien_tai,'name asc');
$data['count_hien_tai']=count($data['customer_sinh_nhat_hien_tai']);

show_header($data);
show_left($data,'trangchu');
show_breadcrumb($data);
show_navigation($data);
show_index($data);
show_footer($data);
show_script_index($data);
