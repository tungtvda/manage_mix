<?php
/**
 * Created by PhpStorm.
 * User: tungtv
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
//    echo $_GET['id'];
     $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user']=review_tour_getById($id);

    if(count($data['data_user'])==0)
    {
        redict(SITE_NAME.'/phan-hoi-khach-hang/');
    }
    $url_bread = '<li><a href="'.SITE_NAME.'/phan-hoi-khach-hang/">Phản hồi</a></li><li class="active">Chỉnh sửa phản hồi "'.$data['data_user'][0]->tour_name.'"</li>';
    $data['title'] = 'Chỉnh sửa phản hồi "'.$data['data_user'][0]->tour_name.'"';
    $data['customer']= customer_getById($data['data_user'][0]->customer_id);

}else{
    redict(SITE_NAME.'/phan-hoi-khach-hang/');
}

if(isset($_POST['id'])){
    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
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

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$data['breadcrumbs'] = $url_bread;

$data['module_valid'] = "phan_hoi";
$count = 8;
show_header($data);
show_left($data, 'phan_hoi', 'phan_hoi_khach_hang');
show_breadcrumb($data);
show_navigation($data);
show_response_themmoi($data);
show_footer($data);
_returnCreateUser(1);
show_valid_form($data);
show_script_form($data);

