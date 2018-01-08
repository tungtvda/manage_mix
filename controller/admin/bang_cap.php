<?php
require_once '../../config.php';
require_once DIR.'/model/bang_capService.php';
require_once DIR.'/view/admin/bang_cap.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new bang_cap();
            $new_obj->id=$_GET["id"];
            bang_cap_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/bang_cap.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=bang_cap_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/bang_cap.php');
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
            $List_bang_cap=bang_cap_getByAll();
            foreach($List_bang_cap as $bang_cap)
            {
                if(isset($_GET["check_".$bang_cap->id])) bang_cap_delete($bang_cap);
            }
            header('Location: '.SITE_NAME.'/controller/admin/bang_cap.php');
        }
    }
    if(isset($_POST["name"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
      $new_obj=new bang_cap($array);
        if($insert)
        {
            bang_cap_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/bang_cap.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            bang_cap_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/bang_cap.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=bang_cap_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=bang_cap_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_bang_cap($data);
}
else
{
     header('location: '.SITE_NAME);
}
