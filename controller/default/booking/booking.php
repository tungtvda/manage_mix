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
$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 $action_link=str_replace('manage_mix','',$_SERVER['REQUEST_URI']);
$action_link=str_replace('/','',$action_link);
$data_dk_fill='';
$active_tab_left='booking_list';
//if($_SESSION['user_role']==0)
//{
//    $data_dk_fill='user_id='.$_SESSION['user_id'];
//}

switch($action_link){
    case 'booking-new':
        $data['title']='Danh sách đơn hàng báo giá';
        $active_tab_left='booking_new';
        if($data_dk_fill!=''){
            $data_dk_fill.=' and ';
        }
        $data_dk_fill.=' bk.status=1';
        break;
    case 'booking-giao-dich':
        $data['title']='Danh sách đơn hàng ký hợp đồng';
        $active_tab_left='booking_giao_dich';
        if($data_dk_fill!=''){
            $data_dk_fill.=' and ';
        }
        $data_dk_fill.=' bk.status=2 ';
        break;
    case 'booking-tam-dung':
        $data['title']='Danh sách đơn hàng tạm dừng';
        $active_tab_left='booking_tam_dung';
        if($data_dk_fill!=''){
            $data_dk_fill.=' and ';
        }
        $data_dk_fill.=' bk.status=6 ';
        break;
    case 'booking-thanh-ly':
        $data['title']='Danh sách đơn hàng thanh lý';
        $active_tab_left='booking_thanh_ly';
        if($data_dk_fill!=''){
            $data_dk_fill.=' and ';
        }
        $data_dk_fill.=' bk.status=3 ';
        break;
    case 'booking-ket-thuc':
        $data['title']='Danh sách đơn hàng giao dịch thành công';
        $active_tab_left='booking_ket_thuc';
        if($data_dk_fill!=''){
            $data_dk_fill.=' and ';
        }
        $data_dk_fill.=' bk.status=4 ';
        break;
    case 'booking-ban-nhap':
        $data['title']='Danh sách đơn hàng đã hủy';
        $active_tab_left='booking_ban_nhap';
        if($data_dk_fill!=''){
            $data_dk_fill.=' and ';
        }
        $data_dk_fill.=' bk.status=5 ';
        break;
    default:
        $data['title']='Danh sách đặt tour';
        $active_tab_left='booking_list';

}
if($_SESSION['user_role']!=1){
    $data_dk_fill=$data_dk_fill.' and  (bk.user_id='.$_SESSION['user_id'].' or bk.dieuhanh_id='.$_SESSION['user_id'].' or bk.created_by='.$_SESSION['user_id'].')';
    $data['dk_find']=' (user_id='.$_SESSION['user_id'].' or dieuhanh_id='.$_SESSION['user_id'].' or created_by='.$_SESSION['user_id'].')';
}else{

}

$url_bread='<li class="active">Booking</li>';
$data['breadcrumbs']=$url_bread;
$data['action_link']=$action_link;
$count=13;
//_returnCreateCustomer(1);
//_deleteSubmitForm('customer', 'customer_delete');



//$data['list']=booking_getByTop('','','updated desc');
$data['list']=bookingAllDongHang($data_dk_fill);
$data['module_valid'] = "booking";
$data['title_print'] = $data['title'];
show_header($data);
show_left($data,'booking',$active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_booking_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);