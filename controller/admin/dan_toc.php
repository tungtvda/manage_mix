<?php
require_once '../../config.php';
require_once DIR.'/model/dan_tocService.php';
require_once DIR.'/view/admin/dan_toc.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new dan_toc();
            $new_obj->id=$_GET["id"];
            dan_toc_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dan_toc.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=dan_toc_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/dan_toc.php');
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
            $List_dan_toc=dan_toc_getByAll();
            foreach($List_dan_toc as $dan_toc)
            {
                if(isset($_GET["check_".$dan_toc->id])) dan_toc_delete($dan_toc);
            }
            header('Location: '.SITE_NAME.'/controller/admin/dan_toc.php');
        }
    }
    if(isset($_POST["name"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
      $new_obj=new dan_toc($array);
        if($insert)
        {
            dan_toc_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dan_toc.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            dan_toc_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/dan_toc.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=dan_toc_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=dan_toc_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_dan_toc($data);
}
else
{
     header('location: '.SITE_NAME);
}
