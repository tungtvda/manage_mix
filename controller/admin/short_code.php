<?php
require_once '../../config.php';
require_once DIR.'/model/short_codeService.php';
require_once DIR.'/view/admin/short_code.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new short_code();
            $new_obj->id=$_GET["id"];
            short_code_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/short_code.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=short_code_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/short_code.php');
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
            $List_short_code=short_code_getByAll();
            foreach($List_short_code as $short_code)
            {
                if(isset($_GET["check_".$short_code->id])) short_code_delete($short_code);
            }
            header('Location: '.SITE_NAME.'/controller/admin/short_code.php');
        }
    }
    if(isset($_POST["type"])&&isset($_POST["name"])&&isset($_POST["field"])&&isset($_POST["description"])&&isset($_POST["position"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['type']))
       $array['type']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['field']))
       $array['field']='0';
       if(!isset($array['description']))
       $array['description']='0';
       if(!isset($array['position']))
       $array['position']='0';
      $new_obj=new short_code($array);
        if($insert)
        {
            short_code_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/short_code.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            short_code_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/short_code.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=short_code_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=short_code_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_short_code($data);
}
else
{
     header('location: '.SITE_NAME);
}
