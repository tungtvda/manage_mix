<?php
require_once '../../config.php';
require_once DIR.'/model/user_phongbanService.php';
require_once DIR.'/view/admin/user_phongban.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new user_phongban();
            $new_obj->id=$_GET["id"];
            user_phongban_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/user_phongban.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=user_phongban_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/user_phongban.php');
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
            $List_user_phongban=user_phongban_getByAll();
            foreach($List_user_phongban as $user_phongban)
            {
                if(isset($_GET["check_".$user_phongban->id])) user_phongban_delete($user_phongban);
            }
            header('Location: '.SITE_NAME.'/controller/admin/user_phongban.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["position"])&&isset($_POST["description"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['position']))
       $array['position']='0';
       if(!isset($array['description']))
       $array['description']='0';
      $new_obj=new user_phongban($array);
        if($insert)
        {
            user_phongban_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/user_phongban.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            user_phongban_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/user_phongban.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=user_phongban_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=user_phongban_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_user_phongban($data);
}
else
{
     header('location: '.SITE_NAME);
}
