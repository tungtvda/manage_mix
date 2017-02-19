<?php
require_once '../../config.php';
require_once DIR.'/model/customer_categoryService.php';
require_once DIR.'/view/admin/customer_category.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new customer_category();
            $new_obj->id=$_GET["id"];
            customer_category_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_category.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=customer_category_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/customer_category.php');
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
            $List_customer_category=customer_category_getByAll();
            foreach($List_customer_category as $customer_category)
            {
                if(isset($_GET["check_".$customer_category->id])) customer_category_delete($customer_category);
            }
            header('Location: '.SITE_NAME.'/controller/admin/customer_category.php');
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
      $new_obj=new customer_category($array);
        if($insert)
        {
            customer_category_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_category.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            customer_category_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/customer_category.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=customer_category_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=customer_category_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_customer_category($data);
}
else
{
     header('location: '.SITE_NAME);
}
