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
    'mess' => 'Đánh giá thất bại, bạn vui lòng kiểm tra thông tin đánh giá',
);
$code_check_send_email=_returnPostParamSecurity('code_check_send_email');
$code_tour_review=_returnPostParamSecurity('code_tour_review');

$clear=_returnPostParamSecurity('clear');
$comfort=_returnPostParamSecurity('comfort');
$convenient=_returnPostParamSecurity('convenient');
$staff=_returnPostParamSecurity('staff');
$room=_returnPostParamSecurity('room');
$price=_returnPostParamSecurity('price');
$food=_returnPostParamSecurity('food');
$place=_returnPostParamSecurity('place');

$content=_returnPostParamSecurity('content_review');
$name=_returnPostParamSecurity('name_cus_review');
$email=_returnPostParamSecurity('email_cus_review');
$phone=_returnPostParamSecurity('phone_cus_review');
$start_date=_returnPostParamSecurity('start_date_review');
$end_date=_returnPostParamSecurity('end_date_review');
$comment=_returnPostParamSecurity('comment_review');
$upcoming_tour=_returnPostParamSecurity('comment_upcoming');

$hotel_id=_returnPostParamSecurity('hotel_id');
$hotel_name=_returnPostParamSecurity('hotel_name');
$hotel_code=_returnPostParamSecurity('hotel_code');
$domain=_returnPostParamSecurity('domain');


if($hotel_id!='' && $hotel_name!='' && $code_tour_review!='' && $domain!='' && $clear!='' && $comfort!='' && $convenient!='' && $staff!='' && $room!='' && $price!='' && $food!='' && $place!='' && $name!='' && $email!='' && $phone!=''){
    $code_check_send_email=_return_mc_decrypt($code_check_send_email);
    $array_check_submit=explode('_',$code_check_send_email);
    if(isset($array_check_submit[0]) && isset($array_check_submit[1]) && isset($array_check_submit[2]) && $array_check_submit[0]=='azmix' && $array_check_submit[2]=='tungtv.soict@gmail.com' && is_numeric($array_check_submit[1]) && $array_check_submit[1]==$code_tour_review){
        $pattern = '/^[a-zA-Z0-9._]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
        if (preg_match($pattern, $email)) {
            $customer_id = 0;
            $dk_check_customer = "email ='" . $email . "'";
            $data_check_exist_cus = customer_getByTop(1, $dk_check_customer, 'id desc');
            if (count($data_check_exist_cus) > 0) {
                $customer_id = $data_check_exist_cus[0]->id;
                $customer = new customer((array)$data_check_exist_cus[0]);
                $customer->name = $name;
                $customer->email = $email;
                $customer->phone = $phone;
                $customer->mobi = $phone;
                customer_update($customer);
            } else {
                $customer = new customer();
                $customer->name = $name;
                $customer->email = $email;
                $customer->phone = $phone;
                $customer->mobi = $phone;
                $customer->code = _randomBooking('cus', 'customer_count');
                customer_insert($customer);
                $dk_check_customer = "code ='" . $customer->code . "'";
                $data_check_exist_cus = customer_getByTop(1, $dk_check_customer, 'id desc');
                if (count($data_check_exist_cus) > 0) {
                    $customer_id = $data_check_exist_cus[0]->id;
                }
            }
            if($start_date!=''){
                $start_date=   date("Y-m-d", strtotime($start_date));
            }
            if($end_date!=''){
                $end_date=   date("Y-m-d", strtotime($end_date));
            }
            $hotel_id=_return_mc_decrypt($hotel_id);
            $array_domain=array('azbooking.vn','khachsan.azbooking.vn','mixtourist.com.vn');
            if(!in_array($domain,$array_domain)){
                $domain='azbooking.vn';
            }
            // kiểm tra khách hàng đã đánh giá tour chưa
            $data_hotel_review=review_hotel_count('customer_id='.$customer_id.' and hotel_id='.$hotel_id.' and domain="'.$domain.'"');
            if($data_hotel_review==0){
                $total=round(($clear+$comfort+$convenient+$staff+$room+$price+$food+$place)/8,1);
                $review = new review_hotel();
                $review->customer_id=$customer_id;
                $review->hotel_id=$hotel_id;
                $review->hotel_name=$hotel_name;
                $review->hotel_code=$hotel_code;
                $review->domain=$domain;
                $review->content=$content;
                $review->start_date=$start_date;
                $review->end_date=$end_date;
                $review->status=0;
                $review->clear=checkPoint($clear);
                $review->comfort=checkPoint($comfort);
                $review->convenient=checkPoint($convenient);
                $review->staff=checkPoint($staff);
                $review->room=checkPoint($room);
                $review->room=checkPoint($room);
                $review->price=checkPoint($price);
                $review->food=checkPoint($food);
                $review->place=checkPoint($place);
                $review->comment=$comment;
                $review->total=$total;
                $review->upcoming_tour=$upcoming_tour;
                $review->created=_returnGetDateTime();
                review_hotel_insert($review);
                $array_res = array(
                    'success' => 1,
                    'mess' => mb_convert_case($domain, MB_CASE_UPPER, "UTF-8").' cảm ơn quý khách "'.$name.'" đã đánh giá về dịch vụ của chúng tôi, hệ thống sẽ xác nhận đánh giá phản hồi của bạn',
                );
                $data_hotel_review=review_hotel_getByTop('1','customer_id='.$customer_id.' and hotel_id='.$hotel_id.' and domain="'.$domain.'"','id desc');
                if($data_hotel_review){
                    $name_noti = 'Khách hàng  ' . $name . ' đã đánh giá khách sạn "' . $hotel_name . '", bạn hãy xác minh đánh giá này';
                    $link_noti = '/phan-hoi-khach-hang-hotel/sua?noti=1&confirm=1&id=' . _return_mc_encrypt($data_hotel_review[0]->id, ENCRYPTION_KEY);
                    $data_list_user_admin = user_getByTop('', 'user_role=1 and status=1', 'id desc');
                    if (count($data_list_user_admin) > 0) {
                        foreach ($data_list_user_admin as $row_admin) {
                            _insertNotification($name_noti, 0, $row_admin->id, $link_noti, 0, '');
                        }
                    }
                }

            }else{
                $array_res['mess']='Bạn đã từng đánh giá khách sạn "'.$hotel_name.'", bạn không thể đánh giá lại một lần nữa';
            }

        }

    }

}
echo json_encode($array_res);

function checkPoint($point){
    if($point<=0){
        $point=1;
    }else{
        if($point>10){
            $point=10;
        }
    }
    return $point;
}
