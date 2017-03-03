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
    if (_returnCheckAction(1) == 0) {
        redict(_returnLinkDangNhap());
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
    print_r($_POST);
    $name_user=_returnPostParamSecurity('name_user');
    $id_user=_returnPostParamSecurity('id_user');
    $code_booking=_returnPostParamSecurity('code_booking');
    $tien_te=_returnPostParamSecurity('tien_te');
    $ty_gia=_returnPostParamSecurity('ty_gia');
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
    $name_tour=_returnPostParamSecurity('name_tour');
    $id_tour=_returnPostParamSecurity('id_tour');
    $dat_coc=_returnPostParamSecurity('dat_coc');
    $price_submit=_returnPostParamSecurity('price_submit');
    $price_511_submit=_returnPostParamSecurity('price_511_submit');
    $price_5_submit=_returnPostParamSecurity('price_5_submit');
    $check_edit=_returnPostParamSecurity('check_edit');
    $id_edit=_returnPostParamSecurity('id_edit');
    $name_customer_sub=$_POST['name_customer_sub'];
    $email_customer=$_POST['email_customer'];
    $phone_customer=$_POST['phone_customer'];
    $address_customer=$_POST['address_customer'];
    if($id_user!=''&&$name_user!=''&&$code_booking!=''&&$ngay_bat_dau!=''&&$han_thanh_toan!=''&&$hinh_thuc_thanh_toan!=''&&$num_nguoi_lon!=''&&$num_nguoi_lon!=0&&$name_customer!=''&&$email!='' &&$address!='' &&$phone!='' &&$diem_don!='' &&$name_tour!='' &&$id_tour!=''&&$price_submit!=''){
        // check thông tin khách hàng
        $check_data_khach_hang=customer_getByTop('1','email="'.$email.'"','id desc');
        if(count($check_data_khach_hang)>0){
            $id_customer=$check_data_khach_hang[0]->id;
        }else{
            $dangky = new customer();
            $dangky->name = $name_customer;
            $dangky->code = '';
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

