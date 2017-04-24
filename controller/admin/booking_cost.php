<?php
require_once '../../config.php';
require_once DIR.'/model/booking_costService.php';
require_once DIR.'/view/admin/booking_cost.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new booking_cost();
            $new_obj->id=$_GET["id"];
            booking_cost_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking_cost.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=booking_cost_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/booking_cost.php');
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
            $List_booking_cost=booking_cost_getByAll();
            foreach($List_booking_cost as $booking_cost)
            {
                if(isset($_GET["check_".$booking_cost->id])) booking_cost_delete($booking_cost);
            }
            header('Location: '.SITE_NAME.'/controller/admin/booking_cost.php');
        }
    }
    if(isset($_POST["booking_id"])&&isset($_POST["user_id"])&&isset($_POST["name"])&&isset($_POST["price"])&&isset($_POST["description"])&&isset($_POST["created"])&&isset($_POST["created_by"])&&isset($_POST["updated"])&&isset($_POST["updated_by"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['booking_id']))
       $array['booking_id']='0';
       if(!isset($array['user_id']))
       $array['user_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['price']))
       $array['price']='0';
       if(!isset($array['description']))
       $array['description']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
       if(!isset($array['updated']))
       $array['updated']='0';
       if(!isset($array['updated_by']))
       $array['updated_by']='0';
      $new_obj=new booking_cost($array);
        if($insert)
        {
            booking_cost_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/booking_cost.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            booking_cost_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/booking_cost.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=booking_cost_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=booking_cost_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_booking_cost($data);
}
else
{
     header('location: '.SITE_NAME);
}
