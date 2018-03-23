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
$data['id_detail']='';
if(isset($_GET['noti']) && isset($_GET['id'])&& isset($_GET['id_noti'])){
    $id=_return_mc_decrypt(_returnGetParamSecurity('id'));
    $id_noti=_return_mc_decrypt(_returnGetParamSecurity('id_noti'));
    if($id && $id_noti){
        $data['id_detail']=$id;
        $data_detail_tour=tour_create_user_getById($id);
        if($data_detail_tour){
            $data['detailTour']=tourUserAllDongHang('ts.id='.$id);
        }

        $data_dk_fill='ts.id !='.$id;
        $data_detail_noti=notification_getByTop(1,'user_id='.$_SESSION['user_id'].' and status!=1','id desc');
        if($data_detail_noti){
            $update_noti_detail=new notification((array)$data_detail_noti[0]);
            $update_noti_detail->status=1;
            notification_update($update_noti_detail);
        }
    }
}
$dataAll=tourUserAllDongHang($data_dk_fill);
$data['list']=array();
if(isset($data['detailTour'])){
    $data['list']=array_merge($data['list'],$data['detailTour']);
}
if($dataAll){
    $data['list']=array_merge($data['list'],$dataAll);
}
//$data['list']=tourUserAllDongHang($data_dk_fill);
//print_r($data['list']);
//exit;
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