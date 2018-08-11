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
$data = array();
_returnCheckPermison(6, 6);

$url_bread = '<li class="active">Phản hồi</li>';
$data['breadcrumbs'] = $url_bread;
$count = 8;
$data['list'] = review_hotel_getByTop('', '', 'Id DESC');
foreach ($data['list'] as $item) {
    $customer = customer_getById($item->customer_id);
    if ($customer) {
        $item->customer = $customer[0];
    } else {
        $item->customer = array();
    }

}
//update comment
if (isset($_POST['id'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $review = review_hotel_getById($id);
    if ($review) {
        $new = $review[0];
        $new->status = isset($_POST['status']) ? 1 : 0;
        $new->show_coment = isset($_POST['show_comment']) ? 1 : 0;
        $new->show_food = isset($_POST['show_food']) ? 1 : 0;
        $new->show_place = isset($_POST['show_place']) ? 1 : 0;
        $new->show_clear = isset($_POST['show_clear']) ? 1 : 0;
        $new->show_comfort = isset($_POST['show_comfort']) ? 1 : 0;
        $new->show_convenient = isset($_POST['show_convenient']) ? 1 : 0;
        $new->show_staff = isset($_POST['show_staff']) ? 1 : 0;
        $new->show_room = isset($_POST['show_room']) ? 1 : 0;
        $new->show_price = isset($_POST['show_price']) ? 1 : 0;
        review_hotel_update($new);
        redict(SITE_NAME . '/phan-hoi-khach-san/');
        $review_list = review_hotel_avg_getByTop('status = 1 and hotel_id=' . $new->hotel_id);
        $point = 0;
        foreach ($review_list as $item) {
            $point += $item->total;
        }
        if (count($review_list) > 0) {
            $array_check_noti = array(
                'id_hotel' => $new->hotel_id,
                'review' => count($review_list),
                'review_point' => round($point / count($review_list), 1)

            );
            $list_review = returnCURL($array_check_noti, SITE_NAME_KS . '/update-hotel-review.html');
        }

    }

}

$data['module_valid'] = "phan_hoi";
$data['title_print'] = 'Phản hồi khách sạn';
$data['title'] = 'Phản hồi khách sạn';
show_header($data);
show_left($data, 'phan_hoi', 'phan_hoi_khach_san');
show_breadcrumb($data);
show_navigation($data);
show_response_hotel_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data, $count);