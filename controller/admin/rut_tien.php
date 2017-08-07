<?php
require_once '../../config.php';
require_once DIR.'/model/rut_tienService.php';
require_once DIR.'/view/admin/rut_tien.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new rut_tien();
            $new_obj->id=$_GET["id"];
            rut_tien_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/rut_tien.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=rut_tien_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/rut_tien.php');
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
            $List_rut_tien=rut_tien_getByAll();
            foreach($List_rut_tien as $rut_tien)
            {
                if(isset($_GET["check_".$rut_tien->id])) rut_tien_delete($rut_tien);
            }
            header('Location: '.SITE_NAME.'/controller/admin/rut_tien.php');
        }
    }
    if(isset($_POST["code"])&&isset($_POST["user_tiep_thi_id"])&&isset($_POST["admin_confirm_id"])&&isset($_POST["name"])&&isset($_POST["price"])&&isset($_POST["price_confirm"])&&isset($_POST["status"])&&isset($_POST["yeu_cau"])&&isset($_POST["yeu_cau_confirm"])&&isset($_POST["date_send"])&&isset($_POST["date_confirm"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['code']))
       $array['code']='0';
       if(!isset($array['user_tiep_thi_id']))
       $array['user_tiep_thi_id']='0';
       if(!isset($array['admin_confirm_id']))
       $array['admin_confirm_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['price']))
       $array['price']='0';
       if(!isset($array['price_confirm']))
       $array['price_confirm']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['yeu_cau']))
       $array['yeu_cau']='0';
       if(!isset($array['yeu_cau_confirm']))
       $array['yeu_cau_confirm']='0';
       if(!isset($array['date_send']))
       $array['date_send']='0';
       if(!isset($array['date_confirm']))
       $array['date_confirm']='0';
      $new_obj=new rut_tien($array);
        if($insert)
        {
            rut_tien_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/rut_tien.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            rut_tien_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/rut_tien.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=rut_tien_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=rut_tien_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_rut_tien($data);
}
else
{
     header('location: '.SITE_NAME);
}
