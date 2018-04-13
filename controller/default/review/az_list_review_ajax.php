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

$array_res = array(
    'success' => 0,
    'listReview' => '',
    'totalReview' => 0,
    'totalAccess' => 0,
    'percentAccess' => 0,
);
$code_check_send_email=_returnPostParamSecurity('code_check_send_email');
$id_tour=_returnPostParamSecurity('id_tour');
$domain=_returnPostParamSecurity('domain');
if($id_tour!='' && $domain!='' && $code_check_send_email!=''){
    $id_tour=_return_mc_decrypt($id_tour);
    $code_check_send_email=_return_mc_decrypt($code_check_send_email);
    $array_check_submit=explode('_',$code_check_send_email);
    // Đếm tổng số đánh giá
    $count_total_review=review_tour_count('tour_id='.$id_tour.' and domain="'.$domain.'"');
    // Đếm tổng số đánh giá được xác nhận
    $count_total_review_access=review_tour_count('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0');

    $dk='rv.tour_id='.$id_tour.' and rv.domain="'.$domain.'" and rv.status=2';
    if(isset($array_check_submit[0]) && isset($array_check_submit[1]) && isset($array_check_submit[2]) && $array_check_submit[0]=='azmix' && $array_check_submit[2]=='tungtv.soict@gmail.com' && is_numeric($array_check_submit[1])) {
        $array_res['listReview']=review_az_getByPaging(1, 100,'id desc',$dk);
    }
    $array_res['totalReview']=$count_total_review;
    $array_res['totalAccess']=$count_total_review_access;
    if($count_total_review){
        $array_res['percentAccess']=round(($count_total_review_access*100)/$count_total_review);
    }
}
echo json_encode($array_res);
