<?php
/**
 * Created by PhpStorm.
 * User: tholv
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
$count=8;
$data['list']=review_tour_getByTop('','','Id DESC');
foreach ($data['list'] as $item){
    $customer= customer_getById($item->customer_id);
    if($customer){
        $item->customer= $customer[0];
    }else{
        $item->customer=array();
    }

}
//update comment
if(isset($_POST['id'])){
    $id=_return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $review = review_tour_getById($id);
    if($review){
        $new = $review[0];
        $new->status=isset($_POST['status'])?1:0;
        $new->show_program=isset($_POST['show_program'])?1:0;
        $new->show_tour_guide_full=isset($_POST['show_tour_guide_full'])?1:0;
        $new->show_tour_guide_local=isset($_POST['show_tour_guide_local'])?1:0;
        $new->show_hotel=isset($_POST['show_hotel'])?1:0;
        $new->show_restaurant=isset($_POST['show_restaurant'])?1:0;
        $new->show_transportation=isset($_POST['show_transportation'])?1:0;
        $new->show_coment=isset($_POST['show_coment'])?1:0;
        review_tour_update($new);
        redict(SITE_NAME.'/phan-hoi-khach-hang/');
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