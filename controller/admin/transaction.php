<?php
require_once '../../config.php';
require_once DIR.'/model/transactionService.php';
require_once DIR.'/view/admin/transaction.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new transaction();
            $new_obj->id=$_GET["id"];
            transaction_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/transaction.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=transaction_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/transaction.php');
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
            $List_transaction=transaction_getByAll();
            foreach($List_transaction as $transaction)
            {
                if(isset($_GET["check_".$transaction->id])) transaction_delete($transaction);
            }
            header('Location: '.SITE_NAME.'/controller/admin/transaction.php');
        }
    }
    if(isset($_POST["created_by"])&&isset($_POST["customer_id"])&&isset($_POST["created_at"])&&isset($_POST["updated_at"])&&isset($_POST["updated_by"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
       if(!isset($array['customer_id']))
       $array['customer_id']='0';
       if(!isset($array['created_at']))
       $array['created_at']='0';
       if(!isset($array['updated_at']))
       $array['updated_at']='0';
       if(!isset($array['updated_by']))
       $array['updated_by']='0';
      $new_obj=new transaction($array);
        if($insert)
        {
            transaction_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/transaction.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            transaction_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/transaction.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=transaction_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=transaction_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_transaction($data);
}
else
{
     header('location: '.SITE_NAME);
}
