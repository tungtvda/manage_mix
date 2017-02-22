<?php
require_once '../../config.php';
require_once DIR.'/model/trang_thai_don_hangService.php';
require_once DIR.'/view/admin/trang_thai_don_hang.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new trang_thai_don_hang();
            $new_obj->id=$_GET["id"];
            trang_thai_don_hang_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/trang_thai_don_hang.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=trang_thai_don_hang_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/trang_thai_don_hang.php');
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
            $List_trang_thai_don_hang=trang_thai_don_hang_getByAll();
            foreach($List_trang_thai_don_hang as $trang_thai_don_hang)
            {
                if(isset($_GET["check_".$trang_thai_don_hang->id])) trang_thai_don_hang_delete($trang_thai_don_hang);
            }
            header('Location: '.SITE_NAME.'/controller/admin/trang_thai_don_hang.php');
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
      $new_obj=new trang_thai_don_hang($array);
        if($insert)
        {
            trang_thai_don_hang_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/trang_thai_don_hang.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            trang_thai_don_hang_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/trang_thai_don_hang.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=trang_thai_don_hang_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=trang_thai_don_hang_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_trang_thai_don_hang($data);
}
else
{
     header('location: '.SITE_NAME);
}
