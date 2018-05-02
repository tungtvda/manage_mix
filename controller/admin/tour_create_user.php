<?php
require_once '../../config.php';
require_once DIR.'/model/tour_create_userService.php';
require_once DIR.'/view/admin/tour_create_user.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new tour_create_user();
            $new_obj->id=$_GET["id"];
            tour_create_user_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/tour_create_user.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=tour_create_user_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/tour_create_user.php');
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
            $List_tour_create_user=tour_create_user_getByAll();
            foreach($List_tour_create_user as $tour_create_user)
            {
                if(isset($_GET["check_".$tour_create_user->id])) tour_create_user_delete($tour_create_user);
            }
            header('Location: '.SITE_NAME.'/controller/admin/tour_create_user.php');
        }
    }
    if(isset($_POST["user_id"])&&isset($_POST["customer_id"])&&isset($_POST["status"])&&isset($_POST["name_cus"])&&isset($_POST["email_cus"])&&isset($_POST["phone_cus"])&&isset($_POST["address_cus"])&&isset($_POST["code_tour"])&&isset($_POST["name_tour"])&&isset($_POST["time_tour"])&&isset($_POST["date_tour"])&&isset($_POST["address_tour"])&&isset($_POST["note_tour"])&&isset($_POST["created"])&&isset($_POST["updated"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['user_id']))
       $array['user_id']='0';
       if(!isset($array['customer_id']))
       $array['customer_id']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['name_cus']))
       $array['name_cus']='0';
       if(!isset($array['email_cus']))
       $array['email_cus']='0';
       if(!isset($array['phone_cus']))
       $array['phone_cus']='0';
       if(!isset($array['address_cus']))
       $array['address_cus']='0';
       if(!isset($array['code_tour']))
       $array['code_tour']='0';
       if(!isset($array['name_tour']))
       $array['name_tour']='0';
       if(!isset($array['time_tour']))
       $array['time_tour']='0';
       if(!isset($array['date_tour']))
       $array['date_tour']='0';
       if(!isset($array['address_tour']))
       $array['address_tour']='0';
       if(!isset($array['note_tour']))
       $array['note_tour']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['updated']))
       $array['updated']='0';
      $new_obj=new tour_create_user($array);
        if($insert)
        {
            tour_create_user_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/tour_create_user.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            tour_create_user_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/tour_create_user.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=tour_create_user_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=tour_create_user_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_tour_create_user($data);
}
else
{
     header('location: '.SITE_NAME);
}
