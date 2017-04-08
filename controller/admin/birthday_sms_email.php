<?php
require_once '../../config.php';
require_once DIR.'/model/birthday_sms_emailService.php';
require_once DIR.'/view/admin/birthday_sms_email.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new birthday_sms_email();
            $new_obj->id=$_GET["id"];
            birthday_sms_email_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/birthday_sms_email.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=birthday_sms_email_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/birthday_sms_email.php');
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
            $List_birthday_sms_email=birthday_sms_email_getByAll();
            foreach($List_birthday_sms_email as $birthday_sms_email)
            {
                if(isset($_GET["check_".$birthday_sms_email->id])) birthday_sms_email_delete($birthday_sms_email);
            }
            header('Location: '.SITE_NAME.'/controller/admin/birthday_sms_email.php');
        }
    }
    if(isset($_POST["user"])&&isset($_POST["customer"])&&isset($_POST["content_sms"])&&isset($_POST["content_email"])&&isset($_POST["status"])&&isset($_POST["count_cus"])&&isset($_POST["count_success_sms"])&&isset($_POST["count_success_email"])&&isset($_POST["cus_false_sms"])&&isset($_POST["cus_false_email"])&&isset($_POST["date_send"])&&isset($_POST["created"])&&isset($_POST["created_by"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['user']))
       $array['user']='0';
       if(!isset($array['customer']))
       $array['customer']='0';
       if(!isset($array['content_sms']))
       $array['content_sms']='0';
       if(!isset($array['content_email']))
       $array['content_email']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['count_cus']))
       $array['count_cus']='0';
       if(!isset($array['count_success_sms']))
       $array['count_success_sms']='0';
       if(!isset($array['count_success_email']))
       $array['count_success_email']='0';
       if(!isset($array['cus_false_sms']))
       $array['cus_false_sms']='0';
       if(!isset($array['cus_false_email']))
       $array['cus_false_email']='0';
       if(!isset($array['date_send']))
       $array['date_send']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['created_by']))
       $array['created_by']='0';
      $new_obj=new birthday_sms_email($array);
        if($insert)
        {
            birthday_sms_email_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/birthday_sms_email.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            birthday_sms_email_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/birthday_sms_email.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=birthday_sms_email_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=birthday_sms_email_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_birthday_sms_email($data);
}
else
{
     header('location: '.SITE_NAME);
}
