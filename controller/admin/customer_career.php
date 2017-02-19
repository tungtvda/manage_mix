<?php
require_once '../../config.php';
require_once DIR.'/model/customer_careerService.php';
require_once DIR.'/view/admin/customer_career.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new customer_career();
            $new_obj->id=$_GET["id"];
            customer_career_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_career.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=customer_career_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/customer_career.php');
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
            $List_customer_career=customer_career_getByAll();
            foreach($List_customer_career as $customer_career)
            {
                if(isset($_GET["check_".$customer_career->id])) customer_career_delete($customer_career);
            }
            header('Location: '.SITE_NAME.'/controller/admin/customer_career.php');
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
      $new_obj=new customer_career($array);
        if($insert)
        {
            customer_career_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_career.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            customer_career_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/customer_career.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=customer_career_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=customer_career_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_customer_career($data);
}
else
{
     header('location: '.SITE_NAME);
}
