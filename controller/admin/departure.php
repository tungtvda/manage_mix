<?php
require_once '../../config.php';
require_once DIR.'/model/departureService.php';
require_once DIR.'/view/admin/departure.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new departure();
            $new_obj->id=$_GET["id"];
            departure_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/departure.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=departure_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/departure.php');
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
            $List_departure=departure_getByAll();
            foreach($List_departure as $departure)
            {
                if(isset($_GET["check_".$departure->id])) departure_delete($departure);
            }
            header('Location: '.SITE_NAME.'/controller/admin/departure.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["position"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['position']))
       $array['position']='0';
      $new_obj=new departure($array);
        if($insert)
        {
            departure_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/departure.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            departure_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/departure.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=departure_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=departure_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_departure($data);
}
else
{
     header('location: '.SITE_NAME);
}
