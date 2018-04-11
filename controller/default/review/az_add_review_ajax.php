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
    'mess' => 'Đánh giá thất bại, bạn vui lòng kiểm tra thông tin đánh giá',
);
$code_check_send_email=_returnPostParamSecurity('code_check_send_email');
$program=_returnPostParamSecurity('program');
$tour_guide_full=_returnPostParamSecurity('tour_guide_full');
$tour_guide_local=_returnPostParamSecurity('tour_guide_local');
$hotel=_returnPostParamSecurity('hotel');
$restaurant=_returnPostParamSecurity('restaurant');
$transportation=_returnPostParamSecurity('transportation');
$content=_returnPostParamSecurity('content_review');
$name=_returnPostParamSecurity('name_cus_review');
$email=_returnPostParamSecurity('email_cus_review');
$phone=_returnPostParamSecurity('phone_cus_review');
$departure=_returnPostParamSecurity('ngay_khoi_hanh_review');
$comment=_returnPostParamSecurity('comment_review');
$upcoming_tour=_returnPostParamSecurity('comment_upcoming');
$tour_id=_returnPostParamSecurity('tour_id');
$tour_name=_returnPostParamSecurity('tour_name');
$tour_code=_returnPostParamSecurity('tour_code');
$domain=_returnPostParamSecurity('domain');

if($tour_id!='' && $tour_name!='' && $domain!='' && $code_check_send_email!='' && $tour_guide_full!='' && $tour_guide_local!='' && $hotel!='' && $restaurant!='' && $transportation!='' && $name!='' && $name!='' && $email!='' && $phone!=''){
    $code_check_send_email=_return_mc_decrypt($code_check_send_email);
    $array_check_submit=explode('_',$code_check_send_email);
    if(isset($array_check_submit[0]) && isset($array_check_submit[1]) && isset($array_check_submit[2]) && $array_check_submit[0]=='azmix' && $array_check_submit[2]=='tungtv.soict@gmail.com' && is_numeric($array_check_submit[1])){
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
            if($departure!=''){
                $departure=   date("Y-m-d", strtotime($departure));
            }
            $tour_id=_return_mc_decrypt($tour_id);
            $array_domain=['azbooking.vn','mixtourist.com.vn'];
            if(!in_array($domain,$array_domain)){
                $domain='azbooking.vn';
            }
            $review = new review_tour();
            $review->customer_id=$customer_id;
            $review->tour_id=$tour_id;
            $review->tour_name=$tour_name;
            $review->tour_code=$tour_code;
            $review->domain=$domain;
            $review->content=$content;
            $review->departure=$departure;
            $review->status=0;
            $review->program=$program;
            $review->tour_guide_full=$tour_guide_full;
            $review->tour_guide_local=$tour_guide_local;
            $review->hotel=$hotel;
            $review->restaurant=$restaurant;
            $review->transportation=$transportation;
            $review->comment=$comment;
            $review->upcoming_tour=$upcoming_tour;
            $review->created=_returnGetDateTime();
            review_tour_insert($review);
            $array_res = array(
                'success' => 1,
                'mess' => mb_convert_case($domain, MB_CASE_UPPER, "UTF-8").' cảm ơn quý khách "'.$name.'" đã đánh giá về dịch vụ của chúng tôi, hệ thống sẽ xác nhận đánh giá phản hồi của bạn',
            );
        }

    }

}
echo json_encode($array_res);
