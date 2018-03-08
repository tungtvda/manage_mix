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
_returnCheckPermison(6,6);

$url_bread='<li class="active">Khách hàng</li>';
$data['breadcrumbs']=$url_bread;
$count=13;

$data['list']=transaction_getByAll();
foreach ($data['list'] as $item){
    $item->customer= customer_getById($item->customer_id)[0];
}
$data['customerList']=customer_getByAll();
$data['module_valid'] = "transaction";
$data['title_print'] = 'Giao dịch khách hàng';
$data['title']='Giao dịch khách hàng';
show_header($data);
show_left($data,'khach_hang','giao_dich_khach_hang');
show_breadcrumb($data);
show_navigation($data);
show_transaction_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);