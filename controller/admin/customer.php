<?php
require_once '../../config.php';
require_once DIR.'/model/customerService.php';
require_once DIR.'/view/admin/customer.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new customer();
            $new_obj->id=$_GET["id"];
            customer_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=customer_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/customer.php');
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
            $List_customer=customer_getByAll();
            foreach($List_customer as $customer)
            {
                if(isset($_GET["check_".$customer->id])) customer_delete($customer);
            }
            header('Location: '.SITE_NAME.'/controller/admin/customer.php');
        }
    }
    if(isset($_POST["booking_id"])&&isset($_POST["name"])&&isset($_POST["mr"])&&isset($_POST["avatar"])&&isset($_POST["code"])&&isset($_POST["category"])&&isset($_POST["company_name"])&&isset($_POST["director_name"])&&isset($_POST["address"])&&isset($_POST["phone"])&&isset($_POST["mobi"])&&isset($_POST["fax"])&&isset($_POST["email"])&&isset($_POST["company_email"])&&isset($_POST["skype"])&&isset($_POST["facebook"])&&isset($_POST["customer_group"])&&isset($_POST["resources_to"])&&isset($_POST["chuc_vu"])&&isset($_POST["phong_ban"])&&isset($_POST["nganh_nghe"])&&isset($_POST["account_number_bank"])&&isset($_POST["bank"])&&isset($_POST["open_bank"])&&isset($_POST["birthday"])&&isset($_POST["cmnd"])&&isset($_POST["date_range_cmnd"])&&isset($_POST["issued_by_cmnd"])&&isset($_POST["number_passport"])&&isset($_POST["date_range_passport"])&&isset($_POST["issued_by_passport"])&&isset($_POST["expiration_date_passport"])&&isset($_POST["gender"])&&isset($_POST["status"])&&isset($_POST["created"])&&isset($_POST["updated"])&&isset($_POST["created_by"])&&isset($_POST["update_by"])&&isset($_POST["note"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['booking_id']))
       $array['booking_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['mr']))
       $array['mr']='0';
       if(!isset($array['avatar']))
       $array['avatar']='0';
       if(!isset($array['code']))
       $array['code']='0';
       if(!isset($array['category']))
       $array['category']='0';
       if(!isset($array['company_name']))
       $array['company_name']='0';
       if(!isset($array['director_name']))
       $array['director_name']='0';
       if(!isset($array['address']))
       $array['address']='0';
       if(!isset($array['phone']))
       $array['phone']='0';
       if(!isset($array['mobi']))
       $array['mobi']='0';
       if(!isset($array['fax']))
       $array['fax']='0';
       if(!isset($array['email']))
       $array['email']='0';
       if(!isset($array['company_email']))
       $array['company_email']='0';
       if(!isset($array['skype']))
       $array['skype']='0';
       if(!isset($array['facebook']))
       $array['facebook']='0';
       if(!isset($array['customer_group']))
       $array['customer_group']='0';
       if(!isset($array['resources_to']))
       $array['resources_to']='0';
       if(!isset($array['chuc_vu']))
       $array['chuc_vu']='0';
       if(!isset($array['phong_ban']))
       $array['phong_ban']='0';
       if(!isset($array['nganh_nghe']))
       $array['nganh_nghe']='0';
       if(!isset($array['account_number_bank']))
       $array['account_number_bank']='0';
       if(!isset($array['bank']))
       $array['bank']='0';
       if(!isset($array['open_bank']))
       $array['open_bank']='0';
       if(!isset($array['birthday']))
       $array['birthday']='0';
       if(!isset($array['cmnd']))
       $array['cmnd']='0';
       if(!isset($array['date_range_cmnd']))
       $array['date_range_cmnd']='0';
       if(!isset($array['issued_by_cmnd']))
       $array['issued_by_cmnd']='0';
       if(!isset($array['number_passport']))
       $array['number_passport']='0';
       if(!isset($array['date_range_passport']))
       $array['date_range_passport']='0';
       if(!isset($array['issued_by_passport']))
       $array['issued_by_passport']='0';
       if(!isset($array['expiration_date_passport']))
       $array['expiration_date_passport']='0';
       if(!isset($array['gender']))
       $array['gender']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['updated']))
       $array['updated']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
       if(!isset($array['update_by']))
       $array['update_by']='0';
       if(!isset($array['note']))
       $array['note']='0';
      $new_obj=new customer($array);
        if($insert)
        {
            customer_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/customer.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            customer_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/customer.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=customer_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=customer_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_customer($data);
}
else
{
     header('location: '.SITE_NAME);
}
