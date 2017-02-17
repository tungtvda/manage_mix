<?php
require_once '../../config.php';
require_once DIR.'/model/nguon_tourService.php';
require_once DIR.'/view/admin/nguon_tour.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new nguon_tour();
            $new_obj->id=$_GET["id"];
            nguon_tour_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/nguon_tour.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=nguon_tour_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/nguon_tour.php');
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
            $List_nguon_tour=nguon_tour_getByAll();
            foreach($List_nguon_tour as $nguon_tour)
            {
                if(isset($_GET["check_".$nguon_tour->id])) nguon_tour_delete($nguon_tour);
            }
            header('Location: '.SITE_NAME.'/controller/admin/nguon_tour.php');
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
      $new_obj=new nguon_tour($array);
        if($insert)
        {
            nguon_tour_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/nguon_tour.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            nguon_tour_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/nguon_tour.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=nguon_tour_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=nguon_tour_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_nguon_tour($data);
}
else
{
     header('location: '.SITE_NAME);
}
