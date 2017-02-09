<?php
require_once '../../config.php';
require_once DIR.'/model/userService.php';
require_once DIR.'/view/admin/user.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new user();
            $new_obj->id=$_GET["id"];
            user_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/user.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=user_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/user.php');
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
            $List_user=user_getByAll();
            foreach($List_user as $user)
            {
                if(isset($_GET["check_".$user->id])) user_delete($user);
            }
            header('Location: '.SITE_NAME.'/controller/admin/user.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["permison_module"])&&isset($_POST["permison_form"])&&isset($_POST["permison_action"])&&isset($_POST["mr"])&&isset($_POST["address"])&&isset($_POST["phone"])&&isset($_POST["mobi"])&&isset($_POST["user_name"])&&isset($_POST["user_code"])&&isset($_POST["user_email"])&&isset($_POST["password"])&&isset($_POST["login_two_steps"])&&isset($_POST["code_login"])&&isset($_POST["phong_ban"])&&isset($_POST["chuc_vu"])&&isset($_POST["nganh_nghe"])&&isset($_POST["birthday"])&&isset($_POST["avatar"])&&isset($_POST["guides"])&&isset($_POST["guide_card_number"])&&isset($_POST["tax_code"])&&isset($_POST["cmnd"])&&isset($_POST["date_range_cmnd"])&&isset($_POST["issued_by_cmnd"])&&isset($_POST["number_passport"])&&isset($_POST["date_range_passport"])&&isset($_POST["issued_by_passport"])&&isset($_POST["expiration_date_passport"])&&isset($_POST["dan_toc"])&&isset($_POST["ho_khau_tt"])&&isset($_POST["hon_nhan"])&&isset($_POST["bang_cap"])&&isset($_POST["language"])&&isset($_POST["account_number_bank"])&&isset($_POST["bank"])&&isset($_POST["open_bank"])&&isset($_POST["religion"])&&isset($_POST["note"])&&isset($_POST["created"])&&isset($_POST["token_code"])&&isset($_POST["time_token"])&&isset($_POST["updated"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['user_role']))
       $array['user_role']='0';
       if(!isset($array['permison_module']))
       $array['permison_module']='0';
       if(!isset($array['permison_form']))
       $array['permison_form']='0';
       if(!isset($array['permison_action']))
       $array['permison_action']='0';
       if(!isset($array['mr']))
       $array['mr']='0';
       if(!isset($array['address']))
       $array['address']='0';
       if(!isset($array['phone']))
       $array['phone']='0';
       if(!isset($array['mobi']))
       $array['mobi']='0';
       if(!isset($array['user_name']))
       $array['user_name']='0';
       if(!isset($array['user_code']))
       $array['user_code']='0';
       if(!isset($array['user_email']))
       $array['user_email']='0';
       if(!isset($array['password']))
       $array['password']='0';
       if(!isset($array['login_two_steps']))
       $array['login_two_steps']='0';
       if(!isset($array['code_login']))
       $array['code_login']='0';
       if(!isset($array['phong_ban']))
       $array['phong_ban']='0';
       if(!isset($array['chuc_vu']))
       $array['chuc_vu']='0';
       if(!isset($array['nganh_nghe']))
       $array['nganh_nghe']='0';
       if(!isset($array['gender']))
       $array['gender']='0';
       if(!isset($array['birthday']))
       $array['birthday']='0';
       if(!isset($array['avatar']))
       $array['avatar']='0';
       if(!isset($array['guides']))
       $array['guides']='0';
       if(!isset($array['guide_card_number']))
       $array['guide_card_number']='0';
       if(!isset($array['tax_code']))
       $array['tax_code']='0';
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
       if(!isset($array['dan_toc']))
       $array['dan_toc']='0';
       if(!isset($array['ho_khau_tt']))
       $array['ho_khau_tt']='0';
       if(!isset($array['hon_nhan']))
       $array['hon_nhan']='0';
       if(!isset($array['bang_cap']))
       $array['bang_cap']='0';
       if(!isset($array['language']))
       $array['language']='0';
       if(!isset($array['account_number_bank']))
       $array['account_number_bank']='0';
       if(!isset($array['bank']))
       $array['bank']='0';
       if(!isset($array['open_bank']))
       $array['open_bank']='0';
       if(!isset($array['religion']))
       $array['religion']='0';
       if(!isset($array['note']))
       $array['note']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['token_code']))
       $array['token_code']='0';
       if(!isset($array['time_token']))
       $array['time_token']='0';
       if(!isset($array['updated']))
       $array['updated']='0';

        if(!isset($array['updated_by']))
            $array['updated_by']='0';
        if(!isset($array['created_by']))
            $array['created_by']='0';

      $new_obj=new user($array);
        if($insert)
        {
            user_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/user.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            user_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/user.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=user_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=user_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_user($data);
}
else
{
     header('location: '.SITE_NAME);
}
