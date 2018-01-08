<?php
require_once '../../config.php';
require_once DIR.'/model/bookingService.php';
require_once DIR.'/view/admin/booking.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new booking();
            $new_obj->id=$_GET["id"];
            booking_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=booking_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/booking.php');
        }
        else
        {
            $data['tab1_class']='default-tab current';
        }
    }
    else
    {
        $data['tab1_class']='default-tab current';
    }
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_booking=booking_getByAll();
            foreach($List_booking as $booking)
            {
                if(isset($_GET["check_".$booking->id])) booking_delete($booking);
            }
            header('Location: '.SITE_NAME.'/controller/admin/booking.php');
        }
    }
    if(isset($_POST["code_booking"])&&isset($_POST["id_tour"])&&isset($_POST["name_tour"])&&isset($_POST["code_tour"])&&isset($_POST["price_tour"])&&isset($_POST["price_11"])&&isset($_POST["price_5"])&&isset($_POST["price_new"])&&isset($_POST["price_11_new"])&&isset($_POST["price_5_new"])&&isset($_POST["vat"])&&isset($_POST["nguon_tour"])&&isset($_POST["tien_te"])&&isset($_POST["ty_gia"])&&isset($_POST["ngay_bat_dau"])&&isset($_POST["han_thanh_toan"])&&isset($_POST["loai_khach_hang"])&&isset($_POST["hinh_thuc_thanh_toan"])&&isset($_POST["id_customer"])&&isset($_POST["diem_don"])&&isset($_POST["diem_tra"])&&isset($_POST["ngay_khoi_hanh"])&&isset($_POST["ngay_ket_thuc"])&&isset($_POST["phuong_tien"])&&isset($_POST["num_nguoi_lon"])&&isset($_POST["num_tre_em"])&&isset($_POST["num_tre_em_5"])&&isset($_POST["price_number"])&&isset($_POST["price_number_2"])&&isset($_POST["price_number_3"])&&isset($_POST["name_price"])&&isset($_POST["name_price_2"])&&isset($_POST["name_price_3"])&&isset($_POST["total_price"])&&isset($_POST["tien_thanh_toan"])&&isset($_POST["user_id"])&&isset($_POST["status"])&&isset($_POST["confirm_admin"])&&isset($_POST["created_by"])&&isset($_POST["updated_by"])&&isset($_POST["created"])&&isset($_POST["updated"])&&isset($_POST["note"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['code_booking']))
       $array['code_booking']='0';
       if(!isset($array['id_tour']))
       $array['id_tour']='0';
       if(!isset($array['name_tour']))
       $array['name_tour']='0';
       if(!isset($array['code_tour']))
       $array['code_tour']='0';
       if(!isset($array['price_tour']))
       $array['price_tour']='0';
       if(!isset($array['price_11']))
       $array['price_11']='0';
       if(!isset($array['price_5']))
       $array['price_5']='0';
       if(!isset($array['price_new']))
       $array['price_new']='0';
       if(!isset($array['price_11_new']))
       $array['price_11_new']='0';
       if(!isset($array['price_5_new']))
       $array['price_5_new']='0';
       if(!isset($array['vat']))
       $array['vat']='0';
       if(!isset($array['nguon_tour']))
       $array['nguon_tour']='0';
       if(!isset($array['tien_te']))
       $array['tien_te']='0';
       if(!isset($array['ty_gia']))
       $array['ty_gia']='0';
       if(!isset($array['ngay_bat_dau']))
       $array['ngay_bat_dau']='0';
       if(!isset($array['han_thanh_toan']))
       $array['han_thanh_toan']='0';
       if(!isset($array['loai_khach_hang']))
       $array['loai_khach_hang']='0';
       if(!isset($array['hinh_thuc_thanh_toan']))
       $array['hinh_thuc_thanh_toan']='0';
       if(!isset($array['id_customer']))
       $array['id_customer']='0';
       if(!isset($array['diem_don']))
       $array['diem_don']='0';
       if(!isset($array['diem_tra']))
       $array['diem_tra']='0';
       if(!isset($array['ngay_khoi_hanh']))
       $array['ngay_khoi_hanh']='0';
       if(!isset($array['ngay_ket_thuc']))
       $array['ngay_ket_thuc']='0';
       if(!isset($array['phuong_tien']))
       $array['phuong_tien']='0';
       if(!isset($array['num_nguoi_lon']))
       $array['num_nguoi_lon']='0';
       if(!isset($array['num_tre_em']))
       $array['num_tre_em']='0';
       if(!isset($array['num_tre_em_5']))
       $array['num_tre_em_5']='0';
       if(!isset($array['price_number']))
       $array['price_number']='0';
       if(!isset($array['price_number_2']))
       $array['price_number_2']='0';
       if(!isset($array['price_number_3']))
       $array['price_number_3']='0';
       if(!isset($array['name_price']))
       $array['name_price']='0';
       if(!isset($array['name_price_2']))
       $array['name_price_2']='0';
       if(!isset($array['name_price_3']))
       $array['name_price_3']='0';
       if(!isset($array['total_price']))
       $array['total_price']='0';
       if(!isset($array['tien_thanh_toan']))
       $array['tien_thanh_toan']='0';
       if(!isset($array['user_id']))
       $array['user_id']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['confirm_admin']))
       $array['confirm_admin']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
       if(!isset($array['updated_by']))
       $array['updated_by']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['updated']))
       $array['updated']='0';
       if(!isset($array['note']))
       $array['note']='0';
      $new_obj=new booking($array);
        if($insert)
        {
            booking_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            booking_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/booking.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=booking_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=booking_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_booking($data);
}
else
{
     header('location: '.SITE_NAME);
}
