<?php
require_once '../../config.php';
require_once DIR.'/model/customer_bookingService.php';
require_once DIR.'/view/admin/customer_booking.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new customer_booking();
            $new_obj->id=$_GET["id"];
            customer_booking_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_booking.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=customer_booking_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/customer_booking.php');
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
            $List_customer_booking=customer_booking_getByAll();
            foreach($List_customer_booking as $customer_booking)
            {
                if(isset($_GET["check_".$customer_booking->id])) customer_booking_delete($customer_booking);
            }
            header('Location: '.SITE_NAME.'/controller/admin/customer_booking.php');
        }
    }
    if(isset($_POST["booking_id"])&&isset($_POST["name"])&&isset($_POST["email"])&&isset($_POST["phone"])&&isset($_POST["address"])&&isset($_POST["do_tuoi"])&&isset($_POST["do_tuoi_number"])&&isset($_POST["birthday"])&&isset($_POST["passport"])&&isset($_POST["date_passport"])&&isset($_POST["created_by"])&&isset($_POST["created"])&&isset($_POST["updated"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['booking_id']))
       $array['booking_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['email']))
       $array['email']='0';
       if(!isset($array['phone']))
       $array['phone']='0';
       if(!isset($array['address']))
       $array['address']='0';
       if(!isset($array['do_tuoi']))
       $array['do_tuoi']='0';
       if(!isset($array['do_tuoi_number']))
       $array['do_tuoi_number']='0';
       if(!isset($array['birthday']))
       $array['birthday']='0';
       if(!isset($array['passport']))
       $array['passport']='0';
       if(!isset($array['date_passport']))
       $array['date_passport']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['updated']))
       $array['updated']='0';
      $new_obj=new customer_booking($array);
        if($insert)
        {
            customer_booking_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_booking.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            customer_booking_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/customer_booking.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=customer_booking_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=customer_booking_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_customer_booking($data);
}
else
{
     header('location: '.SITE_NAME);
}
