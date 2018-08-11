<?php
/**
 * Created by PhpStorm.
 * User: tholv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR."/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();

_returnCheckPermison(3, 2);

if(isset($_GET['id'])&&$_GET['id']!='')
{   $data['action']=2;
    if (_returnCheckAction(2) == 0) {
        redict(_returnLinkDangNhap());
    }
    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user']=review_hotel_getById($id);

    if(count($data['data_user'])==0)
    {
        redict(SITE_NAME.'/phan-hoi-khach-san/');
    }
    $url_bread = '<li><a href="'.SITE_NAME.'/phan-hoi-khach-san/">Phản hồi</a></li><li class="active">Chỉnh sửa phản hồi "'.$data['data_user'][0]->hotel_name.'"</li>';
    $data['title'] = 'Chỉnh sửa phản hồi "'.$data['data_user'][0]->hotel_name.'"';
    $data['customer']= customer_getById($data['data_user'][0]->customer_id);

}else{
    redict(SITE_NAME.'/phan-hoi-khach-san/');
}

//update read notification
if (isset($_POST['id_noti'])) {
    $id_noti = _return_mc_decrypt(_returnPostParamSecurity('id_noti'));
    if($id_noti!=''){
        $data_noti=notification_getById($id_noti);
        if(count($data_noti)>0){
            $noti=new notification((array)$data_noti[0]);
            $noti->status=1;
            notification_update($noti);
        }
    }
}
//update comment
if(isset($_POST['id'])){
    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $review = review_hotel_getById($id);
    if($review){
        $new = $review[0];
        $new->status=isset($_POST['status'])?1:0;
        $new->show_coment=isset($_POST['show_comment'])?1:0;
        $new->show_food=isset($_POST['show_food'])?1:0;
        $new->show_place=isset($_POST['show_place'])?1:0;
        $new->show_clear=isset($_POST['show_clear'])?1:0;
        $new->show_comfort=isset($_POST['show_comfort'])?1:0;
        $new->show_convenient=isset($_POST['show_convenient'])?1:0;
        $new->show_staff=isset($_POST['show_staff'])?1:0;
        $new->show_room=isset($_POST['show_room'])?1:0;
        $new->show_price=isset($_POST['show_price'])?1:0;
        review_hotel_update($new);
        redict(SITE_NAME.'/phan-hoi-khach-san/');
    }
}

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$data['breadcrumbs'] = $url_bread;
$data['module_valid'] = "phan_hoi";
$count = 8;
show_header($data);
show_left($data, 'phan_hoi', 'phan_hoi_khach_san');
show_breadcrumb($data);
show_navigation($data);
show_response_hotel_themmoi($data);
show_footer($data);
_returnCreateUser(1);
show_valid_form($data);
show_script_form($data);

