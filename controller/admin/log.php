<?php
require_once '../../config.php';
require_once DIR.'/model/logService.php';
require_once DIR.'/view/admin/log.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new log();
            $new_obj->id=$_GET["id"];
            log_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/log.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=log_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/log.php');
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
            $List_log=log_getByAll();
            foreach($List_log as $log)
            {
                if(isset($_GET["check_".$log->id])) log_delete($log);
            }
            header('Location: '.SITE_NAME.'/controller/admin/log.php');
        }
    }
    if(isset($_POST["user_id"])&&isset($_POST["module_id"])&&isset($_POST["form_id"])&&isset($_POST["action_id"])&&isset($_POST["item_id"])&&isset($_POST["value_old"])&&isset($_POST["value_new"])&&isset($_POST["description"])&&isset($_POST["created"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['user_id']))
       $array['user_id']='0';
       if(!isset($array['module_id']))
       $array['module_id']='0';
       if(!isset($array['form_id']))
       $array['form_id']='0';
       if(!isset($array['action_id']))
       $array['action_id']='0';
       if(!isset($array['item_id']))
       $array['item_id']='0';
       if(!isset($array['value_old']))
       $array['value_old']='0';
       if(!isset($array['value_new']))
       $array['value_new']='0';
       if(!isset($array['description']))
       $array['description']='0';
       if(!isset($array['created']))
       $array['created']='0';
      $new_obj=new log($array);
        if($insert)
        {
            log_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/log.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            log_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/log.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=log_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=log_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_log($data);
}
else
{
     header('location: '.SITE_NAME);
}
