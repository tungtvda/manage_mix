<?php
require_once '../../config.php';
require_once DIR.'/model/danhmuc_2Service.php';
require_once DIR.'/model/danhmuc_1Service.php';
require_once DIR.'/view/admin/danhmuc_2.php';
require_once DIR.'/common/messenger.php';
require_once DIR.'/common/locdautiengviet.php';
$data=array();
$insert=true;
returnCountData();
if(isset($_SESSION["Admin"]))
{
    $danhmuc_id_get='';
    if(isset($_GET['danhmuc1_id'])&&$_GET['danhmuc1_id']!=''){
        $danhmuc_id_get='?danhmuc1_id='.$_GET['danhmuc1_id'];
    }
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new danhmuc_2();
            $new_obj->id=$_GET["id"];
            danhmuc_2_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_2.php'.$danhmuc_id_get);
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=danhmuc_2_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/danhmuc_2.php'.$danhmuc_id_get);
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
    $data['listfkey']['danhmuc1_id']=danhmuc_1_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_danhmuc_2=danhmuc_2_getByAll();
            foreach($List_danhmuc_2 as $danhmuc_2)
            {
                if(isset($_GET["check_".$danhmuc_2->id])) danhmuc_2_delete($danhmuc_2);
            }
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_2.php');
        }
    }
    if(isset($_POST["danhmuc1_id"])&&isset($_POST["name"])&&isset($_POST["name_url"])&&isset($_POST["img"])&&isset($_POST["position"])&&isset($_POST["title"])&&isset($_POST["keyword"])&&isset($_POST["description"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['danhmuc1_id']))
       $array['danhmuc1_id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['name_url']))
       $array['name_url']='0';
        $array['name_url']=LocDau($array['name']);
       if(!isset($array['img']))
       $array['img']='0';
       if(!isset($array['position']))
       $array['position']='0';
       if(!isset($array['title']))
       $array['title']='0';
       if(!isset($array['keyword']))
       $array['keyword']='0';
       if(!isset($array['description']))
       $array['description']='0';
      $new_obj=new danhmuc_2($array);
        if($insert)
        {
            danhmuc_2_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_2.php'.$danhmuc_id_get);
        }
        else
        {
            $new_obj->id=$_GET["id"];
            danhmuc_2_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/danhmuc_2.php'.$danhmuc_id_get);
        }
    }
    $dk='';
    $dk_count='';
    if(isset($_GET['giatri'])&&$_GET['giatri']!=''){
        $key_timkiem=mb_strtolower(addslashes(strip_tags($_GET['giatri'])));
        $dk_count='name LIKE "%'.$key_timkiem.'%"  ';
        $dk='(danhmuc_2.name LIKE "%'.$key_timkiem.'%")';
    }
    if(isset($_GET['danhmuc1_id'])&&$_GET['danhmuc1_id']!=''){
        $danhmuc_id=mb_strtolower(addslashes(strip_tags($_GET['danhmuc1_id'])));
        if($dk!='')
        {
            $dk.=' (and danhmuc_2.danhmuc1_id='.$danhmuc_id.')';
            $dk_count.=' and danhmuc1_id='.$danhmuc_id;
        }
        else{
            $dk.='  danhmuc_2.danhmuc1_id='.$danhmuc_id.'';
            $dk_count.='  danhmuc1_id='.$danhmuc_id;
        }

    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=danhmuc_2_count($dk_count);
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=danhmuc_2_getByPagingReplace($data['page'],20,'id DESC',$dk);
    // gọi phương thức trong tầng view để hiển thị
    view_danhmuc_2($data);
}
else
{
     header('location: '.SITE_NAME);
}
