<?php
require_once '../../config.php';
require_once DIR.'/model/user_chucvuService.php';
require_once DIR.'/view/admin/user_chucvu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new user_chucvu();
            $new_obj->id=$_GET["id"];
            user_chucvu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/user_chucvu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=user_chucvu_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/user_chucvu.php');
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
            $List_user_chucvu=user_chucvu_getByAll();
            foreach($List_user_chucvu as $user_chucvu)
            {
                if(isset($_GET["check_".$user_chucvu->id])) user_chucvu_delete($user_chucvu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/user_chucvu.php');
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
      $new_obj=new user_chucvu($array);
        if($insert)
        {
            user_chucvu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/user_chucvu.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            user_chucvu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/user_chucvu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=user_chucvu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=user_chucvu_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_user_chucvu($data);
}
else
{
     header('location: '.SITE_NAME);
}
