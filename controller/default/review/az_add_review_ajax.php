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
$code_tour_review=_returnPostParamSecurity('code_tour_review');
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

if($tour_id!='' && $tour_name!='' && $code_tour_review!='' && $domain!='' && $code_check_send_email!='' && $tour_guide_full!='' && $hotel!='' && $restaurant!='' && $transportation!='' && $name!='' && $name!='' && $email!='' && $phone!=''){
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
            if($departure!=''){
                $departure=   date("Y-m-d", strtotime($departure));
            }
            $tour_id=_return_mc_decrypt($tour_id);
            $array_domain=array('azbooking.vn','mixtourist.com.vn');
            if(!in_array($domain,$array_domain)){
                $domain='azbooking.vn';
            }
            // kiểm tra khách hàng đã đánh giá tour chưa
            $data_tour_review=review_tour_count('customer_id='.$customer_id.' and tour_id='.$tour_id.' and domain="'.$domain.'"');
            if($data_tour_review==0){
                $total=round(($program+$tour_guide_full+$hotel+$restaurant+$transportation)/5,1);
                $review = new review_tour();
                $review->customer_id=$customer_id;
                $review->tour_id=$tour_id;
                $review->tour_name=$tour_name;
                $review->tour_code=$tour_code;
                $review->domain=$domain;
                $review->content=$content;
                $review->departure=$departure;
                $review->status=0;
                $review->program=checkPoint($program);
                $review->tour_guide_full=checkPoint($tour_guide_full);
//            $review->tour_guide_local=checkPoint($tour_guide_local);
                $review->hotel=checkPoint($hotel);
                $review->restaurant=checkPoint($restaurant);
                $review->transportation=checkPoint($transportation);
                $review->total=checkPoint($total);
                $review->comment=$comment;
                $review->upcoming_tour=$upcoming_tour;
                $review->created=_returnGetDateTime();
                review_tour_insert($review);
                $array_res = array(
                    'success' => 1,
                    'mess' => mb_convert_case($domain, MB_CASE_UPPER, "UTF-8").' cảm ơn quý khách "'.$name.'" đã đánh giá về dịch vụ của chúng tôi, hệ thống sẽ xác nhận đánh giá phản hồi của bạn',
                );
                $data_tour_review=review_tour_getByTop('1','customer_id='.$customer_id.' and tour_id='.$tour_id.' and domain="'.$domain.'"','id desc');
                if($data_tour_review){
                    $name_noti = 'Khách hàng  ' . $name . ' đã đánh giá tour "' . $tour_name . '", bạn hãy xác minh đánh giá này';
                    $link_noti = '/phan-hoi-khach-hang/sua?noti=1&confirm=1&id=' . _return_mc_encrypt($data_tour_review[0]->id, ENCRYPTION_KEY);
                    $data_list_user_admin = user_getByTop('', 'user_role=1 and status=1', 'id desc');
                    if (count($data_list_user_admin) > 0) {
                        foreach ($data_list_user_admin as $row_admin) {
                            _insertNotification($name_noti, $user_tiep_thi, $row_admin->id, $link_noti, 0, '');
                        }
                    }
                }

            }else{
                $array_res['mess']='Bạn đã từng đánh giá tour "'.$tour_name.'", bạn không thể đánh giá lại một lần nữa';
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
