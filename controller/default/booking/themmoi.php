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
_returnCheckPermison(6, 6);

if(isset($_GET['id'])&&$_GET['id']!='')
{   $data['action']=2;
    if (_returnCheckAction(21) == 0) {
        redict(_returnLinkDangNhap());
    }
//    echo $_GET['id'];
     $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user']=customer_getById($id);

    if(count($data['data_user'])==0)
    {
        redict(SITE_NAME.'/booking/');
    }
    $url_bread = '<li><a href="'.SITE_NAME.'/booking/">Danh sách đặt tour</a></li><li class="active">Chỉnh sửa khách hàng "'.$data['data_user'][0]->name.'"</li>';
    $data['title'] = 'Chỉnh sửa khách hàng "'.$data['data_user'][0]->name.'"';
}else{
    if (_returnCheckAction(21) == 0) {
        redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
    }
    $data['data_user']='';
    $data['action']=1;
    $url_bread = '<li><a href="'.SITE_NAME.'/booking/">Danh sách đặt tour</a></li><li class="active">Đặt tour</li>';
    $data['title'] = 'Đặt tour';
}

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$data['breadcrumbs'] = $url_bread;
$data['module_valid'] = "booking";
if(isset($_POST['code_booking']))
{

    $name_user=_returnPostParamSecurity('name_user');
    $id_user=_returnPostParamSecurity('id_user');
     $code_booking=_returnPostParamSecurity('code_booking');
    $tien_te=_returnPostParamSecurity('tien_te');
    $ty_gia='';
    if($tien_te!=''){
        $data_ty_gia=tien_te_getById($tien_te);
        if(count($data_ty_gia)>0){
            $ty_gia=$data_ty_gia[0]->value;
        }
    }

    $nguon_tour=_returnPostParamSecurity('nguon_tour');
    $ngay_bat_dau=_returnPostParamSecurity('ngay_bat_dau');
    $han_thanh_toan=_returnPostParamSecurity('han_thanh_toan');
    $status=_returnPostParamSecurity('status');
    $hinh_thuc_thanh_toan=_returnPostParamSecurity('hinh_thuc_thanh_toan');
    $num_nguoi_lon=_returnPostParamSecurity('num_nguoi_lon');
    $num_tre_em=_returnPostParamSecurity('num_tre_em');
    $num_tre_em_5=_returnPostParamSecurity('num_tre_em_5');
    $vat=_returnPostParamSecurity('vat');
    $name_customer=_returnPostParamSecurity('name_customer');
    $id_customer=_returnPostParamSecurity('id_customer');
    $email=_returnPostParamSecurity('email');
    $address=_returnPostParamSecurity('address');
    $phone=_returnPostParamSecurity('phone');
    $fax=_returnPostParamSecurity('fax');
    $nhom_khach_hang=_returnPostParamSecurity('nhom_khach_hang');
    $diem_don=_returnPostParamSecurity('diem_don');
    $ngay_khoi_hanh=_returnPostParamSecurity('ngay_khoi_hanh');
    $ngay_ket_thuc=_returnPostParamSecurity('ngay_ket_thuc');
    $name_tour=_returnPostParamSecurity('name_tour');
    $id_tour=_returnPostParamSecurity('id_tour');
    $dat_coc=_returnPostParamSecurity('dat_coc');
    $price_submit=_returnPostParamSecurity('price_submit');
    $price_511_submit=_returnPostParamSecurity('price_511_submit');
    $price_5_submit=_returnPostParamSecurity('price_5_submit');
    $check_edit=_returnPostParamSecurity('check_edit');
    $id_edit=_returnPostParamSecurity('id_edit');
    $note=_returnPostParamSecurity('note');
    $name_customer_sub=array();
    $total=0;
    if(is_numeric($num_nguoi_lon)&&is_numeric($price_submit)){
        $total=$total+($num_nguoi_lon*$price_submit);
    }
    if(is_numeric($num_tre_em)&&is_numeric($num_tre_em)){
        $total=$total+($num_tre_em*$price_511_submit);
    }
    if(is_numeric($num_tre_em_5)&&is_numeric($num_tre_em_5)){
        $total=$total+($num_tre_em_5*$price_5_submit);
    }
    if(isset($_POST['name_customer_sub'])){
        $name_customer_sub=$_POST['name_customer_sub'];
    }
    $email_customer=array();
    if(isset($_POST['email_customer'])){
        $email_customer=$_POST['email_customer'];
    }
    $phone_customer=array();
    if(isset($_POST['phone_customer'])){
        $phone_customer=$_POST['phone_customer'];
    }
    $address_customer=array();
    if(isset($_POST['address_customer'])){
        $address_customer=$_POST['address_customer'];
    }


    if($id_user!=''&&$name_user!=''&&$code_booking!=''&&$ngay_bat_dau!=''&&$han_thanh_toan!=''&&$hinh_thuc_thanh_toan!=''&&$num_nguoi_lon!=''&&$num_nguoi_lon!=0&&$name_customer!=''&&$email!='' &&$address!='' &&$phone!='' &&$diem_don!='' &&$name_tour!='' &&$id_tour!=''&&$price_submit!=''){
        // check thông tin khách hàng
        $check_data_khach_hang=customer_getByTop('1','email="'.$email.'"','id desc');
        if(count($check_data_khach_hang)>0){
            $id_customer=$check_data_khach_hang[0]->id;
        }else{
            $dangky = new customer();
            $dangky->name = $name_customer;
            $dangky->code = _randomBooking('cus','booking_count');
            $dangky->mr = '';
            $dangky->email = $email;
            $dangky->address = $address;
            $dangky->created = _returnGetDateTime();
            $dangky->updated = _returnGetDateTime();
            $dangky->mobi = $phone;
            $dangky->fax = $fax;
            $dangky->status = 1;
            $dangky->phone = $phone;
            $dangky->created_by = $_SESSION['user_id'];
            customer_insert($dangky);
            $data_khachhang=customer_getByTop('1','email="'.$email.'"','id desc');
            if(count($data_khachhang)>0){
                $id_customer=$data_khachhang[0]->id;
            }
            else{
                echo '<script>alert("Khách hàng chưa được cập nhật vào hệ thống, bạn vui lòng thử lại")</script>';
                exit;
            }

        }

        $check_data_tour=tour_getById($id_tour);
        if(count($check_data_tour)==0){
            $mess="Tour ".$name_tour.'không tồn tại trong hệ thống';
            echo "<script>alert($mess)</script>";
            exit;
        }
        $price_old=$check_data_tour[0]->price;
        $price_submit=str_replace('.','',$price_submit);
        $price_submit=str_replace(',','',$price_submit);
        $price_511_submit=str_replace('.','',$price_511_submit);
        $price_511_submit=str_replace(',','',$price_511_submit);
        $price_5_submit=str_replace('.','',$price_5_submit);
        $price_5_submit=str_replace(',','',$price_5_submit);


        $check_data_user=user_getById($id_user);
        if(count($check_data_user)==0){
            $mess="Sales ".$name_user.' không tồn tại trong hệ thống';
            echo "<script>alert($mess)</script>";
            exit;
        }
        $booking_model=new booking();
        $booking_model->id_tour=$id_tour;
        $booking_model->name_tour=$check_data_tour[0]->name;
        $booking_model->code_tour=$check_data_tour[0]->code;
        $booking_model->price_tour=$check_data_tour[0]->price;
        $booking_model->price_11=$check_data_tour[0]->price;
        $booking_model->price_5=$check_data_tour[0]->price;
        $booking_model->price_new=$price_submit;
        $booking_model->price_11_new=$price_511_submit;
        $booking_model->price_5_new=$price_5_submit;
        $booking_model->nguon_tour=$nguon_tour;
        $booking_model->tien_te=$tien_te;
        $booking_model->ty_gia=$ty_gia;
        $booking_model->ngay_bat_dau=date("Y-m-d", strtotime($ngay_bat_dau));
        $booking_model->han_thanh_toan=date("Y-m-d", strtotime($han_thanh_toan));;
        $booking_model->loai_khach_hang=$nhom_khach_hang;
        $booking_model->hinh_thuc_thanh_toan=$hinh_thuc_thanh_toan;
        $booking_model->id_customer=$id_customer;
        $booking_model->diem_don=$diem_don;
        $booking_model->diem_tra=$diem_don;
        $booking_model->ngay_khoi_hanh=date("Y-m-d", strtotime($ngay_khoi_hanh));
        $booking_model->ngay_ket_thuc=date("Y-m-d", strtotime($ngay_ket_thuc));
        $booking_model->phuong_tien=$check_data_tour[0]->vehicle;
        $booking_model->num_nguoi_lon=$num_nguoi_lon;
        $booking_model->num_tre_em=$num_tre_em;
        $booking_model->num_tre_em_5=$num_tre_em_5;
        $booking_model->total_price=$total;
        $booking_model->tien_thanh_toan=$dat_coc;
        $booking_model->user_id=$id_user;
        $booking_model->note=$note;
        $booking_model->status=$status;
        if($_SESSION['user_role']==1){
            $booking_model->confirm_admin=1;
        }else{
            $booking_model->confirm_admin=0;
        }

        $booking_model->created_by=$_SESSION['user_id'];
        $booking_model->created=_returnGetDateTime();
        $booking_model->updated=_returnGetDateTime();
        $data_check_code=booking_count('code_booking="'.$code_booking.'"');
        if($data_check_code>0){
            $code_booking=_randomBooking('#','booking_count','code_booking');
        }
        $booking_model->code_booking=$code_booking;
        booking_insert($booking_model);
        $data_booking=booking_getByTop('1','code_booking="'.$code_booking.'"','');
        if(count($data_booking)>0){
            $id_booking=$data_booking[0]->id;
        }
        if(count($name_customer_sub)>0){
            foreach($name_customer_sub as $key=>$value){
                $name_sub=$value;
                $email_sub=$email_customer[$key];
                $phone_sub=$phone_customer[$key];
                $address_sub=$address_customer[$key];
                if($value!=''&&$email_customer[$key]!=''&&$phone_customer[$key]!=''&&$address_customer[$key]){
                    $check_data_khach_hang_sub=customer_getByTop('1','email="'.$email_sub.'"','id desc');
                    if(count($check_data_khach_hang_sub)==0){
                        $customer_new=new customer();
                        $customer_new->name=$name_sub;
                        $customer_new->email=$email_sub;
                        $customer_new->phone=$phone_sub;
                        $customer_new->address=$address_sub;
                        $customer_new->updated = _returnGetDateTime();
                        $customer_new->created = _returnGetDateTime();
                        $customer_new->created_by=$_SESSION['user_id'];
                        $customer_new->status = 1;
                        $customer_new->booking_id = $id_booking;
                        $customer_new->code=_randomBooking('#','customer_count','code');
                        customer_insert($customer_new);
                    }

                }
            }
        }


        _insertLog($_SESSION['user_id'],6,6,21,$id_booking,'','','Nhân viên '.$check_data_user[0]->name.' đã thực hiện việc tạo đơn hàng');
        if($_SESSION['user_role']!=1){
            $data_list_user_admin=user_getByTop('','user_role=1 and status=1','id desc');
            if(count($data_list_user_admin)>0){
                foreach($data_list_user_admin as $row_admin){
                    $name_noti=$check_data_user[0]->name.' đã thêm một đơn hàng';
                    $link_noti=SITE_NAME.'/don-hang/'._return_mc_encrypt($id_booking, ENCRYPTION_KEY);
                    _insertNotification($name_noti,$_SESSION['user_id'],$row_admin->id,$link_noti,0,'');
                }
            }
            $subject='Xác nhận đơn hàng '.$code_booking;
            $message.='<p>Nhân viên '.$check_data_user[0]->name.' vừa tạo đơn hàng mã '.$code_booking.'</p>';
            $message.='<a>Bạn vui lòng truy cập <a href="'.$link_noti.'">đường link</a> để xác nhận đơn hàng</p>';
            SendMail('info@mixtourist.com.vn', $message, $subject);
        }

        redict(SITE_NAME . '/booking/');

    }else{
        echo '<script>alert("Bạn vui lòng kiểm tra lại thông tin đặt tour")</script>';
    }


}
show_header($data);
show_left($data, 'booking', 'booking_list');
show_breadcrumb($data);
show_navigation($data);
show_booking_themmoi($data);
show_footer($data);

show_valid_form($data);
show_script_form($data);

