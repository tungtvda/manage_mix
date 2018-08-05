<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../../config.php';
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
$id_hotel=_returnPostParamSecurity('id_hotel');
$domain=_returnPostParamSecurity('domain');

if($id_hotel!='' && $code_tour_review!='' && $domain!='' && $code_check_send_email!=''){
    $id_hotel=_return_mc_decrypt($id_hotel);
    $code_check_send_email=_return_mc_decrypt($code_check_send_email);
    $array_check_submit=explode('_',$code_check_send_email);

    if(isset($array_check_submit[0]) && isset($array_check_submit[1]) && isset($array_check_submit[2]) && $array_check_submit[0]=='azmix' && $array_check_submit[2]=='tungtv.soict@gmail.com' && is_numeric($array_check_submit[1]) && $array_check_submit[1]==$code_tour_review) {
        //Kiểm tra điều kiện
        $dk='rv.hotel_id='.$id_hotel.' and rv.domain="'.$domain.'" and rv.status!=0';
        $dk_count='';
        $review_total=_returnPostParamSecurity('review_total');
        switch($review_total){
            case '9':
                $dk.=' and total>=9 ';
                $dk_count.=' and total>=9 ';
                break;
            case '7':
                $dk.=' and total>=7 and total<=8.9 ';
                $dk_count.=' and total>=7 and total<=8.9 ';
                break;
            case '5':
                $dk.=' and total>=5 and total<=6.9 ';
                $dk_count.=' and total>=5 and total<=6.9 ';
                break;
            case '3':
                $dk.=' and total>=3 and total<=4.9 ';
                $dk_count.=' and total>=3 and total<=4.9 ';
                break;
            case '1':
                $dk.=' and total>=1 and total<=2.9 ';
                $dk_count.=' and total>=1 and total<=2.9 ';
                break;

        }

        // kiểm tra order
        $order='rv.id desc';
        $review_sort=_returnPostParamSecurity('review_sort');
        if($review_sort){
            $review_sort=explode('_',$review_sort);
            if(isset($review_sort[0]) && isset($review_sort[1])){
                $order='rv.'.$review_sort[0].' '.$review_sort[1];
            }
        }
        // kiểm tra start
        $start=1;
        $start_client=_returnPostParamSecurity('start');
        if($start_client){
            $start=$start_client;
        }

        // kiểm tra limit
        $limit=10;
        $review_limit=_returnPostParamSecurity('review_limit');
        if($review_limit){
            $limit=$review_limit;
        }


        // Đếm tổng số đánh giá được xác nhận
        $count_total_review_access=review_hotel_count('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0');
        // Đếm tổng số đánh giá được xác nhận theo điều kiện lọc
        $count_total_review_access=review_hotel_count('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0'.$dk_count);
        // Đếm tổng số đánh giá chưa được xác nhận
        $count_total_review_no_access=review_hotel_count('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status=0');

        // Đếm tổng số đánh giá
        $count_total_review=$count_total_review_access+$count_total_review_no_access;
        // lấy danh sách đánh giá
        $data_res=review_az_hotel_getByPaging($start, $limit,$order,$dk);
        $array_res['listReview']=$data_res['string'];
        $array_res['countList']=$data_res['count'];
        $array_res['totalReview']=$count_total_review;
        $array_res['totalAccess']=$count_total_review_access;
        $array_res['totalAccessFilter']=$count_total_review_access;
        $array_res['totalNoAccess']=$count_total_review_no_access;
        if($count_total_review){
            $array_res['percentAccess']=round(($count_total_review_access*100)/$count_total_review);
        }
        // kiểm tra phân trang
        $array_res['showNext']=1;
        $array_res['showPre']=0;
        $array_res['showPageText']='Hiển thị '.$start.' - '.((($start-1)*$limit)+$array_res['countList']);
        if($start>1){
            $array_res['showPre']=1;
        }
        if(($start*$limit)>=$count_total_review_access || $array_res['countList']>=$count_total_review_access){
            $array_res['showNext']=0;
        }
        $show_statistics=1;
        // Đếm sạch sẽ
        $clear_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','clear');
        if($data_count && $data_count['countReview']>0){
            $clear_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }
        // Đếm thoáng mát
        $comfort_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','comfort');
        if($data_count && $data_count['countReview']>0){
            $comfort_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }
        

        // Đếm tiện ích
        $convenient_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','convenient');
        if($data_count && $data_count['countReview']>0){
            $convenient_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }

        // Đếm nhân viên phục vụ
        $staff_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','staff');
        if($data_count && $data_count['countReview']>0){
            $staff_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }

        // Đếm phòng
        $room_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','room');
        if($data_count && $data_count['countReview']>0){
            $room_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }

        // Đếm giá
        $price_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','price');
        if($data_count && $data_count['countReview']>0){
            $price_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }

        // Đếm đồ ăn
        $food_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','food');
        if($data_count && $data_count['countReview']>0){
            $food_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }

        // Đếm địa điểm
        $place_point=0;
        $data_count=review_hotel_sum('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 ','place');
        if($data_count && $data_count['countReview']>0){
            $place_point=round($data_count['sumPoint']/$data_count['countReview'],1);
        }

        if($clear_point<7 || $comfort_point<7||  $convenient_point<7|| $staff_point<7|| $room_point<7 || $price_point<7 || $food_point<7 || $place_point<7){
            $show_statistics=0;
        }
        $array_res['clearPoint']=$clear_point;
        $array_res['comfortPoint']=$comfort_point;
        $array_res['convenientPoint']=$convenient_point;
        $array_res['staffPoint']=$staff_point;
        $array_res['roomPoint']=$room_point;
        $array_res['pricePoint']=$price_point;
        $array_res['foodPoint']=$food_point;
        $array_res['placePoint']=$place_point;
        $array_res['totalPoint']=round(($clear_point+$comfort_point+$convenient_point+$staff_point+$room_point+$price_point+$food_point+$place_point)/8,1);

        // đếm số người đánh giá 1-3
        $array_res['count13']=review_hotel_count_statis('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 and total>=1 and total<=2.9');
        // đếm số người đánh giá 3-5
        $array_res['count35']=review_hotel_count_statis('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 and total>=3 and total<=4.9');
        // đếm số người đánh giá 5-7
        $array_res['count57']=review_hotel_count_statis('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 and total>=5 and total<=6.9');
        // đếm số người đánh giá 7-9
        $array_res['count79']=review_hotel_count_statis('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 and total>=7 and total<=8.9');
        // đếm số người đánh giá 9-10
        $array_res['count910']=review_hotel_count_statis('hotel_id='.$id_hotel.' and domain="'.$domain.'" and status!=0 and total>=9');
        $totalCountStatistics=($array_res['count13']+$array_res['count35']+$array_res['count57']+ $array_res['count79']+$array_res['count910']);
        if($totalCountStatistics){
            $array_res['countPercent13']=round((($array_res['count13']*100) / $totalCountStatistics));
            $array_res['countPercent35']=round((($array_res['count35']*100) / $totalCountStatistics));
            $array_res['countPercent57']=round((($array_res['count57']*100) / $totalCountStatistics));
            $array_res['countPercent79']=round((($array_res['count79']*100) / $totalCountStatistics));
            $array_res['countPercent910']=round((($array_res['count910']*100) / $totalCountStatistics));
        }
    }

}
echo json_encode($array_res);
