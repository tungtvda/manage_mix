<?php
require_once '../../config.php';
require_once DIR.'/model/customer_resources_toService.php';
require_once DIR.'/view/admin/customer_resources_to.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new customer_resources_to();
            $new_obj->id=$_GET["id"];
            customer_resources_to_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_resources_to.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=customer_resources_to_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/customer_resources_to.php');
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
            $List_customer_resources_to=customer_resources_to_getByAll();
            foreach($List_customer_resources_to as $customer_resources_to)
            {
                if(isset($_GET["check_".$customer_resources_to->id])) customer_resources_to_delete($customer_resources_to);
            }
            header('Location: '.SITE_NAME.'/controller/admin/customer_resources_to.php');
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
      $new_obj=new customer_resources_to($array);
        if($insert)
        {
            customer_resources_to_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_resources_to.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            customer_resources_to_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/customer_resources_to.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=customer_resources_to_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=customer_resources_to_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_customer_resources_to($data);
}
else
{
     header('location: '.SITE_NAME);
}
