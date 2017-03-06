<?php
require_once '../../config.php';
require_once DIR.'/model/notificationService.php';
require_once DIR.'/view/admin/notification.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new notification();
            $new_obj->id=$_GET["id"];
            notification_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/notification.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=notification_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/notification.php');
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
            $List_notification=notification_getByAll();
            foreach($List_notification as $notification)
            {
                if(isset($_GET["check_".$notification->id])) notification_delete($notification);
            }
            header('Location: '.SITE_NAME.'/controller/admin/notification.php');
        }
    }
    if(isset($_POST["user_id"])&&isset($_POST["user_send_id"])&&isset($_POST["name"])&&isset($_POST["link"])&&isset($_POST["status"])&&isset($_POST["content"])&&isset($_POST["created"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['user_id']))
       $array['user_id']='0';
       if(!isset($array['user_send_id']))
       $array['user_send_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['link']))
       $array['link']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['content']))
       $array['content']='0';
       if(!isset($array['created']))
       $array['created']='0';
      $new_obj=new notification($array);
        if($insert)
        {
            notification_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/notification.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            notification_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/notification.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=notification_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=notification_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_notification($data);
}
else
{
     header('location: '.SITE_NAME);
}
