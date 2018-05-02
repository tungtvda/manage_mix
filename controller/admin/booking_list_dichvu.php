<?php
require_once '../../config.php';
require_once DIR.'/model/booking_list_dichvuService.php';
require_once DIR.'/view/admin/booking_list_dichvu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new booking_list_dichvu();
            $new_obj->id=$_GET["id"];
            booking_list_dichvu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking_list_dichvu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=booking_list_dichvu_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/booking_list_dichvu.php');
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
            $List_booking_list_dichvu=booking_list_dichvu_getByAll();
            foreach($List_booking_list_dichvu as $booking_list_dichvu)
            {
                if(isset($_GET["check_".$booking_list_dichvu->id])) booking_list_dichvu_delete($booking_list_dichvu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/booking_list_dichvu.php');
        }
    }
    if(isset($_POST["booking_id"])&&isset($_POST["name"])&&isset($_POST["type"])&&isset($_POST["price"])&&isset($_POST["number"])&&isset($_POST["total"])&&isset($_POST["note"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['booking_id']))
       $array['booking_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['type']))
       $array['type']='0';
       if(!isset($array['price']))
       $array['price']='0';
       if(!isset($array['number']))
       $array['number']='0';
       if(!isset($array['total']))
       $array['total']='0';
       if(!isset($array['note']))
       $array['note']='0';
      $new_obj=new booking_list_dichvu($array);
        if($insert)
        {
            booking_list_dichvu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking_list_dichvu.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            booking_list_dichvu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/booking_list_dichvu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=booking_list_dichvu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=booking_list_dichvu_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_booking_list_dichvu($data);
}
else
{
     header('location: '.SITE_NAME);
}
