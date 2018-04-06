<?php
require_once '../../config.php';
require_once DIR.'/model/review_tourService.php';
require_once DIR.'/view/admin/review_tour.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new review_tour();
            $new_obj->id=$_GET["id"];
            review_tour_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/review_tour.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=review_tour_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/review_tour.php');
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
            $List_review_tour=review_tour_getByAll();
            foreach($List_review_tour as $review_tour)
            {
                if(isset($_GET["check_".$review_tour->id])) review_tour_delete($review_tour);
            }
            header('Location: '.SITE_NAME.'/controller/admin/review_tour.php');
        }
    }
    if(isset($_POST["customer_id"])&&isset($_POST["tour_id"])&&isset($_POST["tour_name"])&&isset($_POST["tour_code"])&&isset($_POST["domain"])&&isset($_POST["status"])&&isset($_POST["program"])&&isset($_POST["tour_guide_full"])&&isset($_POST["tour_guide_local"])&&isset($_POST["hotel"])&&isset($_POST["restaurant"])&&isset($_POST["transportation"])&&isset($_POST["comment"])&&isset($_POST["show_coment"])&&isset($_POST["upcoming_tour"])&&isset($_POST["created"])&&isset($_POST["updated"])&&isset($_POST["updated_by"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['customer_id']))
       $array['customer_id']='0';
       if(!isset($array['tour_id']))
       $array['tour_id']='0';
       if(!isset($array['tour_name']))
       $array['tour_name']='0';
       if(!isset($array['tour_code']))
       $array['tour_code']='0';
       if(!isset($array['domain']))
       $array['domain']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['program']))
       $array['program']='0';
       if(!isset($array['tour_guide_full']))
       $array['tour_guide_full']='0';
       if(!isset($array['tour_guide_local']))
       $array['tour_guide_local']='0';
       if(!isset($array['hotel']))
       $array['hotel']='0';
       if(!isset($array['restaurant']))
       $array['restaurant']='0';
       if(!isset($array['transportation']))
       $array['transportation']='0';
       if(!isset($array['comment']))
       $array['comment']='0';
       if(!isset($array['show_coment']))
       $array['show_coment']='0';
       if(!isset($array['upcoming_tour']))
       $array['upcoming_tour']='0';
       if(!isset($array['created']))
       $array['created']='0';
       if(!isset($array['updated']))
       $array['updated']='0';
       if(!isset($array['updated_by']))
       $array['updated_by']='0';
      $new_obj=new review_tour($array);
        if($insert)
        {
            review_tour_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/review_tour.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            review_tour_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/review_tour.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=review_tour_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=review_tour_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_review_tour($data);
}
else
{
     header('location: '.SITE_NAME);
}
