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
$code_tour_review=_returnPostParamSecurity('code_tour_review');
$id_tour=_returnPostParamSecurity('id_tour');
$domain=_returnPostParamSecurity('domain');
if($id_tour!='' && $code_tour_review!='' && $domain!='' && $code_check_send_email!=''){
    $id_tour=_return_mc_decrypt($id_tour);
    $code_check_send_email=_return_mc_decrypt($code_check_send_email);
    $array_check_submit=explode('_',$code_check_send_email);
    // Đếm tổng số đánh giá
    $count_total_review=review_tour_count('tour_id='.$id_tour.' and domain="'.$domain.'"');
    // Đếm tổng số đánh giá được xác nhận
    $count_total_review_access=review_tour_count('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0');
    // Đếm tổng số đánh giá chưa được xác nhận
    $count_total_review_no_access=review_tour_count('tour_id='.$id_tour.' and domain="'.$domain.'" and status=0');

    $dk='rv.tour_id='.$id_tour.' and rv.domain="'.$domain.'" and rv.status!=0';
    if(isset($array_check_submit[0]) && isset($array_check_submit[1]) && isset($array_check_submit[2]) && $array_check_submit[0]=='azmix' && $array_check_submit[2]=='tungtv.soict@gmail.com' && is_numeric($array_check_submit[1]) && $array_check_submit[1]==$code_tour_review) {
        $array_res['listReview']=review_az_getByPaging(1, 10,'id desc',$dk);
    }
    $array_res['totalReview']=$count_total_review;
    $array_res['totalAccess']=$count_total_review_access;
    $array_res['totalNoAccess']=$count_total_review_no_access;
    if($count_total_review){
        $array_res['percentAccess']=round(($count_total_review_access*100)/$count_total_review);
    }

    $show_statistics=1;
    // Đếm chương trình
    $program_point=0;
    $data_count=review_tour_sum('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 ','program');
    if($data_count && $data_count['countReview']>0){
        $program_point=round($data_count['sumPoint']/$data_count['countReview'],1);
    }
    // Đếm hướng dẫn viên suốt tuyến
    $tour_guide_full_point=0;
    $data_count=review_tour_sum('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 ','tour_guide_full');
    if($data_count && $data_count['countReview']>0){
        $tour_guide_full_point=round($data_count['sumPoint']/$data_count['countReview'],1);
    }

    // Đếm Hướng dẫn viên địa phương
//    $tour_guide_local_point=0;
//    $data_count=review_tour_sum('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 ','tour_guide_local');
//    if($data_count && $data_count['countReview']>0){
//        $tour_guide_local_point=round($data_count['sumPoint']/$data_count['countReview'],1);
//    }

    // Đếm Khách sạn
    $hotel_point=0;
    $data_count=review_tour_sum('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 ','hotel');
    if($data_count && $data_count['countReview']>0){
        $hotel_point=round($data_count['sumPoint']/$data_count['countReview'],1);
    }

    // Đếm Ăn uống
    $restaurant_point=0;
    $data_count=review_tour_sum('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 ','restaurant');
    if($data_count && $data_count['countReview']>0){
        $restaurant_point=round($data_count['sumPoint']/$data_count['countReview'],1);
    }

    // Đếm Phương tiện vận chuyển
    $transportation_point=0;
    $data_count=review_tour_sum('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 ','transportation');
    if($data_count && $data_count['countReview']>0){
        $transportation_point=round($data_count['sumPoint']/$data_count['countReview'],1);
    }
    if($program_point<7 || $tour_guide_full_point<7||  $hotel_point<7|| $restaurant_point<7|| $transportation_point<7){
        $show_statistics=0;
    }
    $array_res['programPoint']=$program_point;
    $array_res['tourGuideFullPoint']=$tour_guide_full_point;
//    $array_res['tourGuideLocalPoint']=$tour_guide_local_point;
    $array_res['hotelPoint']=$hotel_point;
    $array_res['restaurantPoint']=$restaurant_point;
    $array_res['transportationPoint']=$transportation_point;
    $array_res['totalPoint']=round(($program_point+$tour_guide_full_point+$hotel_point+$restaurant_point+$transportation_point)/5,1);

   // đếm số người đánh giá 1-3
    $array_res['count13']=review_tour_count_statis('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 and total>=1 and total<=2.9');
    // đếm số người đánh giá 3-5
    $array_res['count35']=review_tour_count_statis('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 and total>=3 and total<=3.9');
    // đếm số người đánh giá 5-7
    $array_res['count57']=review_tour_count_statis('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 and total>=5 and total<=6.9');
    // đếm số người đánh giá 7-9
    $array_res['count79']=review_tour_count_statis('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 and total>=7 and total<=7.9');
    // đếm số người đánh giá 9-10
    $array_res['count910']=review_tour_count_statis('tour_id='.$id_tour.' and domain="'.$domain.'" and status!=0 and total>=9');
    $totalCountStatistics=($array_res['count13']+$array_res['count35']+$array_res['count57']+ $array_res['count79']+$array_res['count910']);
    if($totalCountStatistics){
        $array_res['countPercent13']=round((($array_res['count13']*100) / $totalCountStatistics));
        $array_res['countPercent35']=round((($array_res['count35']*100) / $totalCountStatistics));
        $array_res['countPercent57']=round((($array_res['count57']*100) / $totalCountStatistics));
        $array_res['countPercent79']=round((($array_res['count79']*100) / $totalCountStatistics));
        $array_res['countPercent910']=round((($array_res['count910']*100) / $totalCountStatistics));
    }


}
echo json_encode($array_res);
