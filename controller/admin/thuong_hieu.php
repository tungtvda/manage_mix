<?php
require_once '../../config.php';
require_once DIR.'/model/thuong_hieuService.php';
require_once DIR.'/view/admin/thuong_hieu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new thuong_hieu();
            $new_obj->id=$_GET["id"];
//            thuong_hieu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/thuong_hieu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=thuong_hieu_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/thuong_hieu.php');
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
            $List_thuong_hieu=thuong_hieu_getByAll();
            foreach($List_thuong_hieu as $thuong_hieu)
            {
//                if(isset($_GET["check_".$thuong_hieu->id])) thuong_hieu_delete($thuong_hieu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/thuong_hieu.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["domain"])&&isset($_POST["logo"])&&isset($_POST["icon"])&&isset($_POST["banner"])&&isset($_POST["link_banner"])&&isset($_POST["banner_qc"])&&isset($_POST["link_banner_qc"])&&isset($_POST["link_khoi_hanh"])&&isset($_POST["email"])&&isset($_POST["mat_khau_ung_dung"])&&isset($_POST["chu_ky_email"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['active']))
       $array['active']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['domain']))
       $array['domain']='0';
       if(!isset($array['logo']))
       $array['logo']='0';
       if(!isset($array['icon']))
       $array['icon']='0';
       if(!isset($array['banner']))
       $array['banner']='0';
       if(!isset($array['link_banner']))
       $array['link_banner']='0';
       if(!isset($array['banner_qc']))
       $array['banner_qc']='0';
       if(!isset($array['link_banner_qc']))
       $array['link_banner_qc']='0';
       if(!isset($array['link_khoi_hanh']))
       $array['link_khoi_hanh']='0';
       if(!isset($array['email']))
       $array['email']='0';
       if(!isset($array['mat_khau_ung_dung']))
       $array['mat_khau_ung_dung']='0';
       if(!isset($array['chu_ky_email']))
       $array['chu_ky_email']='0';
      $new_obj=new thuong_hieu($array);
        if($insert)
        {
            thuong_hieu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/thuong_hieu.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            thuong_hieu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/thuong_hieu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=thuong_hieu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=thuong_hieu_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_thuong_hieu($data);
}
else
{
     header('location: '.SITE_NAME);
}
