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

$url_bread='<li class="active">Phản hồi</li>';
$data['breadcrumbs']=$url_bread;
$count=7;

$data['list']=review_tour_getByAll();
foreach ($data['list'] as $item){
    $customer= customer_getById($item->customer_id);
    if($customer){
        $item->customer= $customer[0];
    }else{
        $item->customer=array();
    }

}

$data['module_valid'] = "phan_hoi";
$data['title_print'] = 'Phản hồi khách hàng';
$data['title']='Phản hồi khách hàng';
show_header($data);
show_left($data,'phan_hoi','phan_hoi_khach_hang');
show_breadcrumb($data);
show_navigation($data);
show_response_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);