<?php
require_once '../../config.php';
require_once DIR.'/model/ton_giaoService.php';
require_once DIR.'/view/admin/ton_giao.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new ton_giao();
            $new_obj->id=$_GET["id"];
            ton_giao_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/ton_giao.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=ton_giao_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/ton_giao.php');
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
            $List_ton_giao=ton_giao_getByAll();
            foreach($List_ton_giao as $ton_giao)
            {
                if(isset($_GET["check_".$ton_giao->id])) ton_giao_delete($ton_giao);
            }
            header('Location: '.SITE_NAME.'/controller/admin/ton_giao.php');
        }
    }
    if(isset($_POST["name"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
      $new_obj=new ton_giao($array);
        if($insert)
        {
            ton_giao_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/ton_giao.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            ton_giao_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/ton_giao.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=ton_giao_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=ton_giao_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_ton_giao($data);
}
else
{
     header('location: '.SITE_NAME);
}
