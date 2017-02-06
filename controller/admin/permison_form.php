<?php
require_once '../../config.php';
require_once DIR.'/model/permison_formService.php';
require_once DIR.'/model/permison_moduleService.php';
require_once DIR.'/view/admin/permison_form.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new permison_form();
            $new_obj->id=$_GET["id"];
            permison_form_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/permison_form.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=permison_form_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/permison_form.php');
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
    $data['listfkey']['module_id']=permison_module_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_permison_form=permison_form_getByAll();
            foreach($List_permison_form as $permison_form)
            {
                if(isset($_GET["check_".$permison_form->id])) permison_form_delete($permison_form);
            }
            header('Location: '.SITE_NAME.'/controller/admin/permison_form.php');
        }
    }
    if(isset($_POST["module_id"])&&isset($_POST["name"])&&isset($_POST["url"])&&isset($_POST["action_count"])&&isset($_POST["dk_count"])&&isset($_POST["active"])&&isset($_POST["position"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['module_id']))
       $array['module_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['url']))
       $array['url']='0';
       if(!isset($array['action_count']))
       $array['action_count']='0';
       if(!isset($array['dk_count']))
       $array['dk_count']='0';
       if(!isset($array['active']))
       $array['active']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['position']))
       $array['position']='0';
      $new_obj=new permison_form($array);
        if($insert)
        {
            permison_form_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/permison_form.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            permison_form_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/permison_form.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=permison_form_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=permison_form_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_permison_form($data);
}
else
{
     header('location: '.SITE_NAME);
}
