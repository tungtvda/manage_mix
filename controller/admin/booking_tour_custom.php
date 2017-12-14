<?php
require_once '../../config.php';
require_once DIR.'/model/booking_tour_customService.php';
require_once DIR.'/view/admin/booking_tour_custom.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new booking_tour_custom();
            $new_obj->id=$_GET["id"];
            booking_tour_custom_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking_tour_custom.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=booking_tour_custom_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/booking_tour_custom.php');
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
            $List_booking_tour_custom=booking_tour_custom_getByAll();
            foreach($List_booking_tour_custom as $booking_tour_custom)
            {
                if(isset($_GET["check_".$booking_tour_custom->id])) booking_tour_custom_delete($booking_tour_custom);
            }
            header('Location: '.SITE_NAME.'/controller/admin/booking_tour_custom.php');
        }
    }
    if(isset($_POST["booking_id"])&&isset($_POST["name"])&&isset($_POST["code"])&&isset($_POST["chuong_trinh"])&&isset($_POST["chuong_trinh_price"])&&isset($_POST["thoi_gian"])&&isset($_POST["thoi_gian_price"])&&isset($_POST["nguoi_lon"])&&isset($_POST["tre_em"])&&isset($_POST["tre_em_5"])&&isset($_POST["so_nguoi_price"])&&isset($_POST["khach_san"])&&isset($_POST["khach_san_price"])&&isset($_POST["ngay_khoi_hanh_cus"])&&isset($_POST["ngay_khoi_hanh_price"])&&isset($_POST["hang_bay"])&&isset($_POST["hang_bay_price"])&&isset($_POST["khac"])&&isset($_POST["khac_price"])&&isset($_POST["note"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['booking_id']))
       $array['booking_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['code']))
       $array['code']='0';
       if(!isset($array['chuong_trinh']))
       $array['chuong_trinh']='0';
       if(!isset($array['chuong_trinh_price']))
       $array['chuong_trinh_price']='0';
       if(!isset($array['thoi_gian']))
       $array['thoi_gian']='0';
       if(!isset($array['thoi_gian_price']))
       $array['thoi_gian_price']='0';
       if(!isset($array['nguoi_lon']))
       $array['nguoi_lon']='0';
       if(!isset($array['tre_em']))
       $array['tre_em']='0';
       if(!isset($array['tre_em_5']))
       $array['tre_em_5']='0';
       if(!isset($array['so_nguoi_price']))
       $array['so_nguoi_price']='0';
       if(!isset($array['khach_san']))
       $array['khach_san']='0';
       if(!isset($array['khach_san_price']))
       $array['khach_san_price']='0';
       if(!isset($array['ngay_khoi_hanh_cus']))
       $array['ngay_khoi_hanh_cus']='0';
       if(!isset($array['ngay_khoi_hanh_price']))
       $array['ngay_khoi_hanh_price']='0';
       if(!isset($array['hang_bay']))
       $array['hang_bay']='0';
       if(!isset($array['hang_bay_price']))
       $array['hang_bay_price']='0';
       if(!isset($array['khac']))
       $array['khac']='0';
       if(!isset($array['khac_price']))
       $array['khac_price']='0';
       if(!isset($array['note']))
       $array['note']='0';
      $new_obj=new booking_tour_custom($array);
        if($insert)
        {
            booking_tour_custom_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking_tour_custom.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            booking_tour_custom_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/booking_tour_custom.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=booking_tour_custom_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=booking_tour_custom_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_booking_tour_custom($data);
}
else
{
     header('location: '.SITE_NAME);
}
