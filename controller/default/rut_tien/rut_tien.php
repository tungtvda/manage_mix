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
//require_once DIR.'/email_template/tem_smt/register.php';

$data=array();
_returnCheckPermison(9,17);
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Yêu cầu rút tiền</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Yêu cầu rút tiền';
$count=5;
//_returnCreateUser(1,'/thanh-vien/',$email_tem);
_deleteSubmitForm('rut_tien', 'rut_tien_delete',9,17,44);
$data_dk_fill='user_role=2';
if($_SESSION['user_role']!=1)
{
    redict(_returnLinkDangNhap());
}
$data['list']=ruttienAllDongHang('','','date_send desc');
$data['module_valid'] = "ruttien";
$data['title_print'] = "Danh sách yêu cầu rút tiền";
show_header($data);
show_left($data,'thanh_vien','rut_tien_hoa_hong');
show_breadcrumb($data);
show_navigation($data);
show_ruttien_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);