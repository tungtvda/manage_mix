<?php
require_once '../../config.php';
require_once DIR.'/model/customer_transactionService.php';
require_once DIR.'/view/admin/customer_transaction.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new customer_transaction();
            $new_obj->id=$_GET["id"];
            customer_transaction_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_transaction.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=customer_transaction_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/customer_transaction.php');
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
            $List_customer_transaction=customer_transaction_getByAll();
            foreach($List_customer_transaction as $customer_transaction)
            {
                if(isset($_GET["check_".$customer_transaction->id])) customer_transaction_delete($customer_transaction);
            }
            header('Location: '.SITE_NAME.'/controller/admin/customer_transaction.php');
        }
    }
    if(isset($_POST["transaction_id"])&&isset($_POST["title"])&&isset($_POST["description"])&&isset($_POST["created_at"])&&isset($_POST["update_at"])&&isset($_POST["created_by"])&&isset($_POST["updated_by"])&&isset($_POST["date"])&&isset($_POST["time"])&&isset($_POST["customer_id"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['transaction_id']))
       $array['transaction_id']='0';
       if(!isset($array['title']))
       $array['title']='0';
       if(!isset($array['description']))
       $array['description']='0';
       if(!isset($array['created_at']))
       $array['created_at']='0';
       if(!isset($array['update_at']))
       $array['update_at']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
       if(!isset($array['updated_by']))
       $array['updated_by']='0';
       if(!isset($array['date']))
       $array['date']='0';
       if(!isset($array['time']))
       $array['time']='0';
       if(!isset($array['customer_id']))
       $array['customer_id']='0';
      $new_obj=new customer_transaction($array);
        if($insert)
        {
            customer_transaction_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer_transaction.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            customer_transaction_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/customer_transaction.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=customer_transaction_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=customer_transaction_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_customer_transaction($data);
}
else
{
     header('location: '.SITE_NAME);
}
