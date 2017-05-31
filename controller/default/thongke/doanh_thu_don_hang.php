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
    $data_dk_fill.='bk.created_by='.$_SESSION['user_id'];
}
$data['start']='';
$data['end']='';

if(isset($_GET['start'])&&isset($_GET['end'])){
    $start=date('Y-m-d', strtotime(_returnGetParamSecurity('start')));
    $end=date('Y-m-d', strtotime(_returnGetParamSecurity('end')));
    $data['start']=_returnGetParamSecurity('start');
    $data['end']=_returnGetParamSecurity('end');
    if($_GET['start']!=''&&$_GET['end']!=''){
        $data_dk_fill.=" and ngay_bat_dau>='".$start."' and ngay_bat_dau<='".$end."'";
    }else{
        if($_GET['start']!=''){
            $data_dk_fill.=" and ngay_bat_dau='".$start."'";
        }else{
            if($_GET['end']!=''){
                $data_dk_fill.=" and ngay_bat_dau='".$end."'";
            }
        }
    }
}else{
    $today = getdate();
    $number = cal_days_in_month(CAL_GREGORIAN, $today['mon'], $today['year']); // 31
    $mon=$today['mon'];
    if($mon){
        $mon='0'.$mon;
    }
    $start=$today['year'].'-'.$today['mon'].'-01';
    $end=$today['year'].'-'.$today['mon'].'-'.$number;
    $data_dk_fill.=" and ngay_bat_dau>='".$start."' and ngay_bat_dau<='".$end."'";
    $data['start']='01-'.$mon.'-'.$today['year'];
    $data['end']=$number.'-'.$mon.'-'.$today['year'];
}
if(isset($_GET['status'])&&$_GET['status']!=''){
    $data_dk_fill.=" and status="._returnGetParamSecurity('status');
}
$data['list']=booking_thongke_doanh_thu($data_dk_fill);
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