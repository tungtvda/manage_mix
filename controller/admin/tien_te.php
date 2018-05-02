<?php
require_once '../../config.php';
require_once DIR.'/model/tien_teService.php';
require_once DIR.'/view/admin/tien_te.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new tien_te();
            $new_obj->id=$_GET["id"];
            tien_te_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/tien_te.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=tien_te_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/tien_te.php');
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
            $List_tien_te=tien_te_getByAll();
            foreach($List_tien_te as $tien_te)
            {
                if(isset($_GET["check_".$tien_te->id])) tien_te_delete($tien_te);
            }
            header('Location: '.SITE_NAME.'/controller/admin/tien_te.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["value"])&&isset($_POST["position"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['value']))
       $array['value']='0';
       if(!isset($array['position']))
       $array['position']='0';
      $new_obj=new tien_te($array);
        if($insert)
        {
            tien_te_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/tien_te.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            tien_te_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/tien_te.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=tien_te_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=tien_te_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_tien_te($data);
}
else
{
     header('location: '.SITE_NAME);
}
