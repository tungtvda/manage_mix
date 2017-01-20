<?php
require_once '../../config.php';
require_once DIR.'/model/permison_actionService.php';
require_once DIR.'/model/permison_moduleService.php';
require_once DIR.'/model/permison_formService.php';
require_once DIR.'/view/admin/permison_action.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new permison_action();
            $new_obj->id=$_GET["id"];
            permison_action_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/permison_action.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=permison_action_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/permison_action.php');
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
    $data['listfkey']['form_id']=permison_form_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_permison_action=permison_action_getByAll();
            foreach($List_permison_action as $permison_action)
            {
                if(isset($_GET["check_".$permison_action->id])) permison_action_delete($permison_action);
            }
            header('Location: '.SITE_NAME.'/controller/admin/permison_action.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["module_id"])&&isset($_POST["form_id"])&&isset($_POST["position"])&&isset($_POST["note"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['module_id']))
       $array['module_id']='0';
       if(!isset($array['form_id']))
       $array['form_id']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['position']))
       $array['position']='0';
       if(!isset($array['note']))
       $array['note']='0';
      $new_obj=new permison_action($array);
        if($insert)
        {
            permison_action_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/permison_action.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            permison_action_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/permison_action.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=permison_action_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=permison_action_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_permison_action($data);
}
else
{
     header('location: '.SITE_NAME);
}
