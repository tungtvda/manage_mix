<?php
require_once '../../config.php';
require_once DIR.'/model/setting_hoa_hongService.php';
require_once DIR.'/view/admin/setting_hoa_hong.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new setting_hoa_hong();
            $new_obj->id=$_GET["id"];
            setting_hoa_hong_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/setting_hoa_hong.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=setting_hoa_hong_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/setting_hoa_hong.php');
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
            $List_setting_hoa_hong=setting_hoa_hong_getByAll();
            foreach($List_setting_hoa_hong as $setting_hoa_hong)
            {
                if(isset($_GET["check_".$setting_hoa_hong->id])) setting_hoa_hong_delete($setting_hoa_hong);
            }
            header('Location: '.SITE_NAME.'/controller/admin/setting_hoa_hong.php');
        }
    }
    if(isset($_POST["hoa_hong_3"])&&isset($_POST["hoa_hong_4"])&&isset($_POST["hoa_hong_5"])&&isset($_POST["hoa_hong_dai_ly"])&&isset($_POST["hoa_hong_gt_f1"])&&isset($_POST["hoa_hong_gt_f2"])&&isset($_POST["hoa_hong_gt_f3"])&&isset($_POST["muc_4_don_hang"])&&isset($_POST["muc_4_thanh_vien"])&&isset($_POST["muc_5_don_hang"])&&isset($_POST["muc_5_thanh_vien_3"])&&isset($_POST["muc_5_thanh_vien_4"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['hoa_hong_3']))
       $array['hoa_hong_3']='0';
       if(!isset($array['hoa_hong_4']))
       $array['hoa_hong_4']='0';
       if(!isset($array['hoa_hong_5']))
       $array['hoa_hong_5']='0';
       if(!isset($array['hoa_hong_dai_ly']))
       $array['hoa_hong_dai_ly']='0';
       if(!isset($array['hoa_hong_gt_f1']))
       $array['hoa_hong_gt_f1']='0';
       if(!isset($array['hoa_hong_gt_f2']))
       $array['hoa_hong_gt_f2']='0';
       if(!isset($array['hoa_hong_gt_f3']))
       $array['hoa_hong_gt_f3']='0';
       if(!isset($array['muc_4_don_hang']))
       $array['muc_4_don_hang']='0';
       if(!isset($array['muc_4_thanh_vien']))
       $array['muc_4_thanh_vien']='0';
       if(!isset($array['muc_5_don_hang']))
       $array['muc_5_don_hang']='0';
       if(!isset($array['muc_5_thanh_vien_3']))
       $array['muc_5_thanh_vien_3']='0';
       if(!isset($array['muc_5_thanh_vien_4']))
       $array['muc_5_thanh_vien_4']='0';
      $new_obj=new setting_hoa_hong($array);
        if($insert)
        {
            setting_hoa_hong_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/setting_hoa_hong.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            setting_hoa_hong_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/setting_hoa_hong.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=setting_hoa_hong_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=setting_hoa_hong_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_setting_hoa_hong($data);
}
else
{
     header('location: '.SITE_NAME);
}
