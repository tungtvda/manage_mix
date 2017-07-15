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
$data = array();
if (isset($_POST['name_customer']) && isset($_POST['email'])&& isset($_POST['phone'])&& isset($_POST['address'])&& isset($_POST['ngay_khoi_hanh'])&& isset($_POST['id_tour'])&& isset($_POST['name_tour'])&& isset($_POST['code_tour'])&& isset($_POST['ng_tour'])&& isset($_POST['n1'])&& isset($_POST['n2'])&& isset($_POST['n3'])&& isset($_POST['po1'])&& isset($_POST['po2'])&& isset($_POST['po3'])&& isset($_POST['pn1'])&& isset($_POST['pn2'])&& isset($_POST['pn3'])) {
    $name_customer = _return_mc_decrypt(_returnPostParamSecurity('name_customer'), '');
    $email = _return_mc_decrypt(_returnPostParamSecurity('email'), '');
    $address = _return_mc_decrypt(_returnPostParamSecurity('address'), '');
    $phone = _return_mc_decrypt(_returnPostParamSecurity('phone'), '');
    $diem_don = $address;
    $ngay_khoi_hanh = _return_mc_decrypt(_returnPostParamSecurity('ngay_khoi_hanh'), '');
    $name_tour = _return_mc_decrypt(_returnPostParamSecurity('name_tour'), '');
    $code_tour = _return_mc_decrypt(_returnPostParamSecurity('code_tour'), '');
    $id_tour = _return_mc_decrypt(_returnPostParamSecurity('id_tour'), '');
    $nguon_tour = _return_mc_decrypt(_returnPostParamSecurity('ng_tour'), '');
    $phuong_tien= _return_mc_decrypt(_returnPostParamSecurity('phuong_tien'), '');

    $price = _return_mc_decrypt(_returnPostParamSecurity('po1'), '');
    $price_511 = _return_mc_decrypt(_returnPostParamSecurity('po2'), '');
    $price_5 = _return_mc_decrypt(_returnPostParamSecurity('po3'), '');

    $price_new = _return_mc_decrypt(_returnPostParamSecurity('pn1'), '');
    $price_511_new = _return_mc_decrypt(_returnPostParamSecurity('pn2'), '');
    $price_5_new = _return_mc_decrypt(_returnPostParamSecurity('pn3'), '');

    $httt = _return_mc_decrypt(_returnPostParamSecurity('httt'), '');
    $note = _return_mc_decrypt(_returnPostParamSecurity('note'), '');
    $ngay_khoi_hanh = _return_mc_decrypt(_returnPostParamSecurity('ngay_khoi_hanh'), '');
    $status=1;
    $num_nguoi_lon=_return_mc_decrypt(_returnPostParamSecurity('n1'), '');
    $num_tre_em=_return_mc_decrypt(_returnPostParamSecurity('n2'), '');
    $num_tre_em_5=_return_mc_decrypt(_returnPostParamSecurity('n3'), '');

    $name_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('name_customer_sub'), ''));
    $email_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('email_customer_sub'), ''));
    $phone_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('phone_customer_sub'), ''));
    $address_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('address_customer_sub'), ''));
    $tuoi_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('tuoi_customer_sub'), ''));
    $tuoi_number_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('tuoi_number_customer_sub'), ''));
    $birthday_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('birthday_customer_sub'), ''));
    $passport_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('passport_customer_sub'), ''));
    $date_passport_customer_sub=json_decode(_return_mc_decrypt(_returnPostParamSecurity('date_passport_customer_sub'), ''));

    $name_price=_return_mc_decrypt(_returnPostParamSecurity('name_price'), '');
    $name_price_2=_return_mc_decrypt(_returnPostParamSecurity('name_price_2'), '');
    $name_price_3=_return_mc_decrypt(_returnPostParamSecurity('name_price_3'), '');

    $number=_return_mc_decrypt(_returnPostParamSecurity('number'), '');
    $number_2=_return_mc_decrypt(_returnPostParamSecurity('number_2'), '');
    $number_3=_return_mc_decrypt(_returnPostParamSecurity('number_3'), '');
    $gen=_return_mc_decrypt(_returnPostParamSecurity('gen'), '');
    $tol=_return_mc_decrypt(_returnPostParamSecurity('tol'), '');
    $key_user=_return_mc_decrypt(_returnPostParamSecurity('key_user'), '');
    if($nguon_tour!=''){
        $data_nguon_tour=nguon_tour_getByTop('1','name="'.$nguon_tour.'"','id desc');
        if(count($data_nguon_tour)>0){
            $nguon_tour=$data_nguon_tour[0]->id;
        }else{
            $nguon_tour_model=new nguon_tour();
            $nguon_tour_model->name=$nguon_tour;
            $nguon_tour_model->position=1;
            nguon_tour_insert($nguon_tour_model);
            $data_nguon_tour=nguon_tour_getByTop('1','name="'.$nguon_tour.'"','id desc');
            if(count($data_nguon_tour)>0){
                $nguon_tour=$data_nguon_tour[0]->id;
            }
        }
    }
    if($name_customer!=''&&$email!=''&&$phone!=''&&$address!=''){
        $check_data_khach_hang=customer_getByTop('1','email="'.$email.'"','id desc');
        if(count($check_data_khach_hang)>0){
            $id_customer=$check_data_khach_hang[0]->id;
        }else{
            $dangky = new customer();
            $dangky->name = $name_customer;
            $dangky->code = _randomBooking('cus','customer_count');
            $dangky->mr = '';
            $dangky->email = $email;
            $dangky->address = $address;
            $dangky->created = _returnGetDateTime();
            $dangky->updated = _returnGetDateTime();
            $dangky->mobi = $phone;
            $dangky->status = 1;
            $dangky->phone = $phone;
            $dangky->created_by = '';
            $dangky->category=0;
            customer_insert($dangky);
            $data_khachhang=customer_getByTop('1','email="'.$email.'"','id desc');
            if(count($data_khachhang)>0){
                $id_customer=$data_khachhang[0]->id;
            }
            else{
                echo 0;
                exit;
            }
        }
        if($key_user!=''&&$key_user!=0){
            $data_user_tiep_thi=user_getById($key_user);
            if(count($data_user_tiep_thi)==0){
                $key_user=0;
            }
        }else{
            $key_user=0;
        }

        $booking_model=new booking();
        $booking_model->id_tour=$id_tour;
        $booking_model->name_tour=$name_tour;
        $booking_model->code_tour=$code_tour;
        $booking_model->price_tour=$price;
        $booking_model->price_11=$price_511;
        $booking_model->price_5=$price_5;
        $booking_model->price_new=$price_new;
        $booking_model->price_11_new=$price_511_new;
        $booking_model->price_5_new=$price_5_new;
        $booking_model->nguon_tour=$nguon_tour;
        $booking_model->ngay_bat_dau=_returnGetDateTime();
        $booking_model->hinh_thuc_thanh_toan=$httt;
        $booking_model->id_customer=$id_customer;
        $booking_model->diem_don=$diem_don;
        $booking_model->diem_tra=$diem_don;
        $booking_model->ngay_khoi_hanh=date("Y-m-d", strtotime($ngay_khoi_hanh));
        $booking_model->phuong_tien=$phuong_tien;
        $booking_model->num_nguoi_lon=$num_nguoi_lon;
        $booking_model->num_tre_em=$num_tre_em;
        $booking_model->num_tre_em_5=$num_tre_em_5;
        $booking_model->total_price=$tol;
        $booking_model->tien_thanh_toan='';
        $booking_model->user_id=$key_user;
        $booking_model->note=$note;
        $booking_model->status=1;
        $booking_model->confirm_admin=0;
        $booking_model->created_by=0;
        $booking_model->name_price=$name_price;
        $booking_model->name_price_2=$name_price_2;
        $booking_model->name_price_3=$name_price_3;
        $booking_model->created=_returnGetDateTime();
        $booking_model->updated=_returnGetDateTime();
        $code_booking=_randomBooking('#','booking_count','code_booking');
        $booking_model->code_booking=$code_booking;
        booking_insert($booking_model);
        $data_booking=booking_getByTop('1','code_booking="'.$code_booking.'"','');
        $array_user=array();
        if(count($data_booking)>0){
            $id_booking=$data_booking[0]->id;
            if($key_user!=0){
                $array_user['user_name']=$data_user_tiep_thi[0]->name;
                $array_user['user_email']=$data_user_tiep_thi[0]->user_email;
                _insertNotification('Khách hàng '.$name_customer.' đã đặt tour được gắn mã tiếp thị của bạn',0,$key_user,'/tiep-thi-lien-ket/booking-detail/?noti=1&confirm=1&id='._return_mc_encrypt($id_booking, ENCRYPTION_KEY).'',0,'');
            }
        }

        _updateCustomerBooking($name_customer_sub,$email_customer_sub,$phone_customer_sub,$address_customer_sub,$tuoi_customer_sub,$tuoi_number_customer_sub,$birthday_customer_sub,$passport_customer_sub,$date_passport_customer_sub,$id_booking);
        $message='';
        $name_noti='Khách hàng '.$name_customer.' đã thêm một đơn hàng từ '.$nguon_tour;
        $link_noti=SITE_NAME.'/booking-new/sua?noti=1&confirm=1&id='._return_mc_encrypt($id_booking, ENCRYPTION_KEY);
        $data_list_user_admin=user_getByTop('','user_role=1 and status=1','id desc');
        if(count($data_list_user_admin)>0){
            foreach($data_list_user_admin as $row_admin){
                _insertNotification($name_noti,0,$row_admin->id,$link_noti,0,'');
            }
        }
        $subject='Xác nhận đơn hàng '.$code_booking;
        $message.='<p>Khách hàng '.$name_customer.' đã thêm một đơn hàng từ '.$nguon_tour.'</p>';
        $message.='<a>Bạn vui lòng truy cập <a href="'.$link_noti.'">đường link</a> để xác nhận đơn hàng</p>';
//         SendMail('info@mixtourist.com.vn', $message, $subject);
//        SendMail('tungtv.soict@gmail.com', $message, $subject);
        $mess_log='Khách hàng '.$name_customer.' đã thêm một đơn hàng từ '.$nguon_tour;
        _insertLog(0,6,6,21,$id_booking,'','',$mess_log);
        $item_res=array(
            'code_booking'=>$code_booking,
            'user'=>$array_user,
            'id_booking'=>_return_mc_encrypt($id_booking, ENCRYPTION_KEY)
        );
        echo json_encode($item_res);
    }


} else {
    echo 0;
}