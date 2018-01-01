<?php
require_once '../../config.php';
require_once DIR.'/model/danhmuc_dichvuService.php';
require_once DIR.'/view/admin/danhmuc_dichvu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new danhmuc_dichvu();
            $new_obj->id=$_GET["id"];
            danhmuc_dichvu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_dichvu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=danhmuc_dichvu_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/danhmuc_dichvu.php');
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
            $List_danhmuc_dichvu=danhmuc_dichvu_getByAll();
            foreach($List_danhmuc_dichvu as $danhmuc_dichvu)
            {
                if(isset($_GET["check_".$danhmuc_dichvu->id])) danhmuc_dichvu_delete($danhmuc_dichvu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_dichvu.php');
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
      $new_obj=new danhmuc_dichvu($array);
        if($insert)
        {
            danhmuc_dichvu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_dichvu.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            danhmuc_dichvu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_dichvu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=danhmuc_dichvu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=danhmuc_dichvu_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_danhmuc_dichvu($data);
}
else
{
     header('location: '.SITE_NAME);
}
