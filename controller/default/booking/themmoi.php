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

$action_link=str_replace('manage_mix','',$_SERVER['REQUEST_URI']);
$action_link=str_replace('dat-tour','',$action_link);
$action_link=str_replace('/','',$action_link);

switch($action_link){
    case 'booking-new':
        $active_tab_left='booking_new';
        break;
    case 'booking-giao-dich':
        $active_tab_left='booking_giao_dich';
        break;
    case 'booking-tam-dung':
        $active_tab_left='booking_tam_dung';
        break;
    case 'booking-no-tien':
        $active_tab_left='booking_no_tien';
        break;
    case 'booking-ket-thuc':
        $active_tab_left='booking_ket_thuc';
        break;
    case 'booking-ban-nhap':
        $active_tab_left='booking_ban_nhap';
        break;
    default:
        $active_tab_left='booking_list';

}

if(isset($_GET['id'])&&$_GET['id']!='')
{   $data['action']=2;
    if (_returnCheckAction(22) == 0) {
        redict(_returnLinkDangNhap());
    }
//    echo $_GET['id'];
     $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user']=booking_getById($id);

    if(count($data['data_user'])==0)
    {
        redict(SITE_NAME.'/'.$action_link.'/');
    }
    $url_bread = '<li><a href="'.SITE_NAME.'/'.$action_link.'/">Danh sách đặt tour</a></li><li class="active">Chỉnh sửa đơn hàng "'.$data['data_user'][0]->code_booking.'"</li>';
    $data['title'] = 'Chỉnh sửa đơn hàng "'.$data['data_user'][0]->code_booking.'"';
    _updateStatusNoti();

}else{
    if (_returnCheckAction(21) == 0) {
        redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
    }
    $data['data_user']='';
    $data['action']=1;
    $url_bread = '<li><a href="'.SITE_NAME.'/'.$action_link.'/">Danh sách đặt tour</a></li><li class="active">Đặt tour</li>';
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
    $action_link=_returnLinkBooking($status);
    $hinh_thuc_thanh_toan=_returnPostParamSecurity('hinh_thuc_thanh_toan');
    $num_nguoi_lon=_returnPostParamSecurity('num_nguoi_lon');
    $num_tre_em=_returnPostParamSecurity('num_tre_em');
    $num_tre_em_5=_returnPostParamSecurity('num_tre_em_5');
    $vat=_returnPostParamSecurity('vat');
    if($vat==''){
        $vat=0;
    }else{
        if ($vat === "on" || $vat === 1||$vat === "On") {
            $vat = 1;
        }
    }
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

    $price_submit=str_replace('.','',$price_submit);
    $price_submit=str_replace(',','',$price_submit);
    $price_511_submit=str_replace('.','',$price_511_submit);
    $price_511_submit=str_replace(',','',$price_511_submit);
    $price_5_submit=str_replace('.','',$price_5_submit);
    $price_5_submit=str_replace(',','',$price_5_submit);

    $name_customer_sub=array();
    $email_customer_sub=array();
    $phone_customer_sub=array();
    $address_customer_sub=array();
    $tuoi_customer_sub=array();
    $tuoi_number_customer_sub=array();
    $birthday_customer_sub=array();
    $passport_customer_sub=array();
    $date_passport_customer_sub=array();

    $total=0;
    if(is_numeric($num_nguoi_lon)&&is_numeric($price_submit)){
        $total=$total+($num_nguoi_lon*$price_submit);
    }
    if(is_numeric($num_tre_em)&&is_numeric($price_511_submit)){
        $total=$total+($num_tre_em*$price_511_submit);
    }
    if(is_numeric($num_tre_em_5)&&is_numeric($price_5_submit)){
        $total=$total+($num_tre_em_5*$price_5_submit);
    }
    if($vat==1){
        $vat_price=($total*0.1);
        $total=$total+$vat_price;
    }
    if(isset($_POST['name_customer_sub'])){
        $name_customer_sub=$_POST['name_customer_sub'];
    }
    if(isset($_POST['email_customer'])){
        $email_customer_sub=$_POST['email_customer'];
    }
    if(isset($_POST['phone_customer'])){
        $phone_customer_sub=$_POST['phone_customer'];
    }
    if(isset($_POST['address_customer'])){
        $address_customer_sub=$_POST['address_customer'];
    }
    if(isset($_POST['tuoi_customer'])){
        $tuoi_customer_sub=$_POST['tuoi_customer'];
    }
    if(isset($_POST['tuoi_number_customer'])){
        $tuoi_number_customer_sub=$_POST['tuoi_number_customer'];
    }
    if(isset($_POST['birthday_customer'])){
        $birthday_customer_sub=$_POST['birthday_customer'];
    }
    if(isset($_POST['passport_customer'])){
        $passport_customer_sub=$_POST['passport_customer'];
    }
    if(isset($_POST['date_passport_customer'])){
        $date_passport_customer_sub=$_POST['date_passport_customer'];
    }

    if(isset($_POST['check_edit'])&&$_POST['check_edit']=='edit'&&isset($_POST['id_edit'])&&$_POST['id_edit']!=''){
        $string_value_old='';
        $string_value_new='';
       $data_detail=$data['data_user'];
        $array_detail=((array)$data_detail[0]);
        $booking_update=new booking($array_detail);
        if($data_detail[0]->confirm_admin==0||$_SESSION['user_role']==1){
            if($id_user!=$array_detail['user_id']){
                $booking_update->user_id=$id_user;
                $string_value_old.=' Sales: "'.$array_detail['user_id'].'" - ';
                $string_value_new.=' Sales: "'.$id_user.'" - ';
                $edit_user=$array_detail['user_id'];
            }

            if($id_customer!=$array_detail['id_customer']){
                $booking_update->id_customer=$id_customer;
                $string_value_old.=' Khách hàng: "'.$array_detail['id_customer'].'" - ';
                $string_value_new.=' Khách hàng: "'.$id_customer.'" - ';
            }

            if($id_tour!=$array_detail['id_tour']){
                $booking_update->id_tour=$id_tour;
                $string_value_old.=' Tour: "'.$array_detail['id_tour'].'" - ';
                $string_value_new.=' Tour: "'.$id_tour.'" - ';
                $check_data_tour=tour_getById($id_tour);
                if(count($check_data_tour)==0){
                    $mess="Tour ".$name_tour.'không tồn tại trong hệ thống';
                    echo "<script>alert($mess)</script>";
                    $link=SITE_NAME.'/'.$action_link.'/';
                    echo '<script>window.location="'.$link.'";</script>';
                    exit;
                }
                $booking_update->price_tour=$check_data_tour[0]->price;
                $booking_update->price_11=$check_data_tour[0]->price;
                $booking_update->price_5=$check_data_tour[0]->price;
            }
            if($price_submit!=$array_detail['price_new']){
                $booking_update->price_new=$price_submit;
                $string_value_old.=' Giá người lớn: "'.$array_detail['price_new'].'" - ';
                $string_value_new.=' Giá người lớn: "'.$price_submit.'" - ';
            }

            if($price_511_submit!=$array_detail['price_11_new']){
                $booking_update->price_11_new=$price_511_submit;
                $string_value_old.=' Giá trẻ em 5->11 tuổi: "'.$array_detail['price_11_new'].'" - ';
                $string_value_new.=' Giá trẻ em 5->11 tuổi: "'.$price_511_submit.'" - ';
            }

            if($price_5_submit!=$array_detail['price_5_new']){
                $booking_update->price_5_new=$price_5_submit;
                $string_value_old.=' Giá trẻ em dưới 5 tuổi: "'.$array_detail['price_5_new'].'" - ';
                $string_value_new.=' Giá trẻ em dưới 5 tuổi: "'.$price_5_submit.'" - ';
            }



        }
        if($tien_te!=$array_detail['tien_te']){
            $booking_update->tien_te=$tien_te;
            $string_value_old.=' Tiền tệ: "'.$array_detail['tien_te'].'" - ';
            $string_value_new.=' Tiền tệ: "'.$tien_te.'" - ';
        }
        if($ty_gia!=$array_detail['ty_gia']){
            $booking_update->ty_gia=$ty_gia;
            $string_value_old.=' Tỷ giá: "'.$array_detail['ty_gia'].'" - ';
            $string_value_new.=' Tỷ giá: "'.$ty_gia.'" - ';
        }
        if($nguon_tour!=$array_detail['nguon_tour']){
            $booking_update->nguon_tour=$nguon_tour;
            $string_value_old.=' Nguồn tour: "'.$array_detail['nguon_tour'].'" - ';
            $string_value_new.=' Nguồn tour: "'.$nguon_tour.'" - ';
        }
        $ngay_bat_dau= date('Y-m-d', strtotime($ngay_bat_dau));
        if($ngay_bat_dau!=$array_detail['ngay_bat_dau']){
            $booking_update->ngay_bat_dau=$ngay_bat_dau;
            $string_value_old.=' Ngày bắt đầu: "'.$array_detail['ngay_bat_dau'].'" - ';
            $string_value_new.=' Ngày bắt đầu: "'.$ngay_bat_dau.'" - ';
        }
        $han_thanh_toan= date('Y-m-d', strtotime($han_thanh_toan));
        if($han_thanh_toan!=$array_detail['han_thanh_toan']){
            $booking_update->han_thanh_toan=$han_thanh_toan;
            $string_value_old.=' Hạn thanh toán: "'.$array_detail['han_thanh_toan'].'" - ';
            $string_value_new.=' Hạn thanh toán: "'.$han_thanh_toan.'" - ';
        }
        if($status!=$array_detail['status']){
            $booking_update->status=$status;
            $string_value_old.=' Trạng thái đơn hàng: "'.$array_detail['status'].'" - ';
            $string_value_new.=' Trạng thái đơn hàng: "'.$status.'" - ';
        }
        if($hinh_thuc_thanh_toan!=$array_detail['hinh_thuc_thanh_toan']){
            $booking_update->hinh_thuc_thanh_toan=$hinh_thuc_thanh_toan;
            $string_value_old.=' Hình thức thanh toán: "'.$array_detail['hinh_thuc_thanh_toan'].'" - ';
            $string_value_new.=' Hình thức thanh toán: "'.$hinh_thuc_thanh_toan.'" - ';
        }
        if($num_nguoi_lon!=$array_detail['num_nguoi_lon']){
            $booking_update->num_nguoi_lon=$num_nguoi_lon;
            $string_value_old.=' Số người lớn: "'.$array_detail['num_nguoi_lon'].'" - ';
            $string_value_new.=' Số người lớn: "'.$num_nguoi_lon.'" - ';
        }
        if($num_tre_em!=$array_detail['num_tre_em']){
            $booking_update->num_tre_em=$num_tre_em;
            $string_value_old.=' Số trẻ em 5->11 tuổi: "'.$array_detail['num_tre_em'].'" - ';
            $string_value_new.=' Số trẻ em 5->11 tuổi: "'.$num_tre_em.'" - ';
        }
        if($num_tre_em_5!=$array_detail['num_tre_em_5']){
            $booking_update->num_tre_em_5=$num_tre_em_5;
            $string_value_old.=' Số trẻ em 5 tuổi: "'.$array_detail['num_tre_em_5'].'" - ';
            $string_value_new.=' Số trẻ em 5 tuổi: "'.$num_tre_em_5.'" - ';
        }
        if($num_tre_em_5!=$array_detail['num_tre_em_5']){
            $booking_update->num_tre_em_5=$num_tre_em_5;
            $string_value_old.=' Số trẻ em 5 tuổi: "'.$array_detail['num_tre_em_5'].'" - ';
            $string_value_new.=' Số trẻ em 5 tuổi: "'.$num_tre_em_5.'" - ';
        }

        if($diem_don!=$array_detail['diem_don']){
            $booking_update->diem_don=$diem_don;
            $string_value_old.=' Điểm đón: "'.$array_detail['diem_don'].'" - ';
            $string_value_new.=' Điểm đón: "'.$diem_don.'" - ';
        }
        $ngay_khoi_hanh= date('Y-m-d', strtotime($ngay_khoi_hanh));
        if($ngay_khoi_hanh!=$array_detail['ngay_khoi_hanh']){
            $booking_update->ngay_khoi_hanh=$ngay_khoi_hanh;
            $string_value_old.=' Ngày khởi hành: "'.$array_detail['ngay_khoi_hanh'].'" - ';
            $string_value_new.=' Ngày khởi hành: "'.$ngay_khoi_hanh.'" - ';
        }
        $ngay_ket_thuc= date('Y-m-d', strtotime($ngay_ket_thuc));
        if($ngay_ket_thuc!=$array_detail['ngay_ket_thuc']){
            $booking_update->ngay_ket_thuc=$ngay_ket_thuc;
            $string_value_old.=' Ngày kết thúc: "'.$array_detail['ngay_ket_thuc'].'" - ';
            $string_value_new.=' Ngày kết thúc: "'.$ngay_ket_thuc.'" - ';
        }
        if($dat_coc!=$array_detail['tien_thanh_toan']){
            $booking_update->tien_thanh_toan=$dat_coc;
            $string_value_old.=' Tiền thanh toán: "'.$array_detail['tien_thanh_toan'].'" - ';
            $string_value_new.=' Tiền thanh toán: "'.$dat_coc.'" - ';
        }

        if($note!=$array_detail['note']){
            $booking_update->note=$note;
            $string_value_old.=' Chú ý: "'.$array_detail['note'].'" - ';
            $string_value_new.=' Chú ý: "'.$note.'" - ';
        }
        $customer_update=new customer();
        $customer_update->booking_id=0;
        customer_update_booking($customer_update,$array_detail['id']);
        _updateCustomerBooking($name_customer_sub,$email_customer_sub,$phone_customer_sub,$address_customer_sub,$tuoi_customer_sub,$tuoi_number_customer_sub,$birthday_customer_sub,$passport_customer_sub,$date_passport_customer_sub,$array_detail['id'], $_SESSION['user_id']);
        $booking_update->updated=_returnGetDateTime();
        booking_update($booking_update);
        
        if($string_value_old!=''){

            $arr_send_noti=array();
            _insertLog($_SESSION['user_id'],6,6,22,$data_detail[0]->id,$string_value_old,$string_value_new,'Cập nhật đơn hàng "'.$data_detail[0]->code_booking.'"');
            $link_noti=SITE_NAME.'/'.$action_link.'/sua?noti=1&id='._return_mc_encrypt($data_detail[0]->id, ENCRYPTION_KEY);
            $content_noti='__________Gía trị cũ_________'.$string_value_old.'__________Gía trị mới_________'.$string_value_new;
            $name_noti=$_SESSION['user_name'].' đã thay đổi thông tin đơn hàng "'.$booking_update->code_booking.'"';
            if($_SESSION['user_role']==1){
                if($_SESSION['user_id']!=$data_detail[0]->user_id){
                    if(isset($edit_user)&&$edit_user>0){
                        $name_noti_edit=$_SESSION['user_name'].' đã rời bạn ra khỏi đơn hàng "'.$booking_update->code_booking.'"';
                        _insertNotification($name_noti_edit,$_SESSION['user_id'],$edit_user,$link_noti,0,$content_noti);
                        array_push($arr_send_noti,$edit_user);
                        array_push($arr_send_noti,$booking_update->user_id);
                        $name_noti=$_SESSION['user_name'].' đã apply đơn hàng "'.$booking_update->code_booking.'" cho bạn';
                        _insertNotification($name_noti,$_SESSION['user_id'],$booking_update->user_id,$link_noti,0,$content_noti);
                    }else{
                        array_push($arr_send_noti,$booking_update->user_id);
                        _insertNotification($name_noti,$_SESSION['user_id'],$booking_update->user_id,$link_noti,0,$content_noti);
                    }
                }
            }else{
                $data_list_user_admin=user_getByTop('','user_role=1 and status=1','id desc');
                if(count($data_list_user_admin)>0){
                    foreach($data_list_user_admin as $row_admin){
                        array_push($arr_send_noti,$row_admin->id);
                        _insertNotification($name_noti,$_SESSION['user_id'],$row_admin->id,$link_noti,0,$content_noti);
                    }
                }
            }
            if(!in_array($data_detail[0]->created_by,$arr_send_noti)){
                if($_SESSION['user_id']!=$data_detail[0]->created_by){
                    $name_noti=$_SESSION['user_name'].' đã thay đổi thông tin đơn hàng "'.$booking_update->code_booking.'"';
                    _insertNotification($name_noti,$_SESSION['user_id'],$data_detail[0]->created_by,$link_noti,0,$content_noti);
                }
            }



        }
        redict(SITE_NAME.'/'.$action_link.'/');


//        print_r($_POST);
    }else{
        if($id_user!=''&&$name_user!=''&&$code_booking!=''&&$ngay_bat_dau!=''&&$han_thanh_toan!=''&&$hinh_thuc_thanh_toan!=''&&$num_nguoi_lon!=''&&$num_nguoi_lon!=0&&$name_customer!=''&&$email!='' &&$address!='' &&$phone!='' &&$diem_don!='' &&$name_tour!='' &&$id_tour!=''&&$price_submit!=''){
            // check thông tin khách hàng
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
                $dangky->fax = $fax;
                $dangky->status = 1;
                $dangky->phone = $phone;
                $dangky->created_by = $_SESSION['user_id'];
                $dangky->category=$nhom_khach_hang;
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
            $booking_model->price_11=$check_data_tour[0]->price_2;
            $booking_model->price_5=$check_data_tour[0]->price_3;
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
            $booking_model->vat=$vat;
            if($status==''){
                $status=1;
            }
            $booking_model->status=$status;
            if($_SESSION['user_role']==1){
                $booking_model->confirm_admin=$_SESSION['user_id'];
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
            if($check_data_tour[0]->so_cho>=0){
                $update_tour=new tour((array)$check_data_tour[0]);
                $con_lai=$check_data_tour[0]->so_cho-($num_nguoi_lon+$num_tre_em+$num_tre_em_5);
                if($con_lai<0){
                    $con_lai=0;
                }
                $update_tour->so_cho=$con_lai;
                tour_update($update_tour);
            }
            _updateCustomerBooking($name_customer_sub,$email_customer_sub,$phone_customer_sub,$address_customer_sub,$tuoi_customer_sub,$tuoi_number_customer_sub,$birthday_customer_sub,$passport_customer_sub,$date_passport_customer_sub,$id_booking, $_SESSION['user_id']);

            $message='';
            if($_SESSION['user_role']!=1){
                $name_noti=$_SESSION['user_name'].' đã thêm một đơn hàng';
                $link_noti=SITE_NAME.'/'.$action_link.'/sua?noti=1&confirm=1&id='._return_mc_encrypt($id_booking, ENCRYPTION_KEY);
                $data_list_user_admin=user_getByTop('','user_role=1 and status=1','id desc');
                if(count($data_list_user_admin)>0){
                    foreach($data_list_user_admin as $row_admin){
                        _insertNotification($name_noti,$_SESSION['user_id'],$row_admin->id,$link_noti,0,'');
                    }
                }
                $subject='Xác nhận đơn hàng '.$code_booking;
                $message.='<p>Nhân viên '.$check_data_user[0]->name.' vừa tạo đơn hàng mã '.$code_booking.'</p>';
                $message.='<a>Bạn vui lòng truy cập <a href="'.$link_noti.'">đường link</a> để xác nhận đơn hàng</p>';
                SendMail('info@mixtourist.com.vn', $message, $subject);
//                SendMail('tungtv.soict@gmail.com', $message, $subject);
                $mess_log='Nhân viên '.$check_data_user[0]->name.' đã thực hiện việc tạo đơn hàng';
            }else{
                $name_noti=$_SESSION['user_name'].' đã thêm một đơn hàng cho bạn';
                $link_noti=SITE_NAME.'/'.$action_link.'/sua?noti=1&id='._return_mc_encrypt($id_booking, ENCRYPTION_KEY);
                _insertNotification($name_noti,$_SESSION['user_id'],$id_user,$link_noti,0,'');

                $subject='Xác nhận đơn hàng '.$code_booking;
                $message.='<p>Admin '.$_SESSION['user_name'].' vừa tạo đơn hàng mã '.$code_booking.'</p>';
                $message.='<a>Bạn vui lòng truy cập <a href="'.$link_noti.'">đường link</a> để xác nhận đơn hàng</p>';
                SendMail($check_data_user[0]->email, $message, $subject);
                $mess_log='Admin '.$_SESSION['user_name'].' đã thực hiện việc tạo đơn hàng';
            }
            _insertLog($_SESSION['user_id'],6,6,21,$id_booking,'','',$mess_log);
            redict(SITE_NAME . '/'.$action_link.'/');

        }else{
            echo '<script>alert("Bạn vui lòng kiểm tra lại thông tin đặt tour")</script>';
        }

    }


}
show_header($data);
show_left($data, 'booking', $active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_booking_themmoi($data);
show_footer($data);

show_valid_form($data);
show_script_form($data);

