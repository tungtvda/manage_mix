<?php
require_once '../../config.php';
require_once DIR.'/model/review_hotelService.php';
require_once DIR.'/view/admin/review_hotel.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new review_hotel();
            $new_obj->id=$_GET["id"];
            review_hotel_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/review_hotel.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=review_hotel_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/review_hotel.php');
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
            $List_review_hotel=review_hotel_getByAll();
            foreach($List_review_hotel as $review_hotel)
            {
                if(isset($_GET["check_".$review_hotel->id])) review_hotel_delete($review_hotel);
            }
            header('Location: '.SITE_NAME.'/controller/admin/review_hotel.php');
        }
    }
    if(isset($_POST["customer_id"])&&isset($_POST["hotel_id"])&&isset($_POST["hotel_name"])&&isset($_POST["hotel_code"])&&isset($_POST["domain"])&&isset($_POST["content"])&&isset($_POST["start_date"])&&isset($_POST["end_date"])&&isset($_POST["status"])&&isset($_POST["clear"])&&isset($_POST["show_clear"])&&isset($_POST["comfort"])&&isset($_POST["show_comfort"])&&isset($_POST["convenient"])&&isset($_POST["show_convenient"])&&isset($_POST["staff"])&&isset($_POST["show_staff"])&&isset($_POST["room"])&&isset($_POST["show_room"])&&isset($_POST["price"])&&isset($_POST["show_price"])&&isset($_POST["food"])&&isset($_POST["show_food"])&&isset($_POST["place"])&&isset($_POST["show_place"])&&isset($_POST["total"])&&isset($_POST["comment"])&&isset($_POST["show_coment"])&&isset($_POST["upcoming_tour"])&&isset($_POST["created"])&&isset($_POST["updated"])&&isset($_POST["updated_by"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['customer_id']))
       $array['customer_id']='0';
       if(!isset($array['hotel_id']))
       $array['hotel_id']='0';
       if(!isset($array['hotel_name']))
       $array['hotel_name']='0';
       if(!isset($array['hotel_code']))
       $array['hotel_code']='0';
       if(!isset($array['domain']))
       $array['domain']='0';
       if(!isset($array['content']))
       $array['content']='0';
       if(!isset($array['start_date']))
       $array['start_date']='0';
       if(!isset($array['end_date']))
       $array['end_date']='0';
       if(!isset($array['status']))
       $array['status']='0';
       if(!isset($array['clear']))
       $array['clear']='0';
       if(!isset($array['show_clear']))
       $array['show_clear']='0';
       if(!isset($array['comfort']))
       $array['comfort']='0';
       if(!isset($array['show_comfort']))
       $array['show_comfort']='0';
       if(!isset($array['convenient']))
       $array['convenient']='0';
       if(!isset($array['show_convenient']))
       $array['show_convenient']='0';
       if(!isset($array['staff']))
       $array['staff']='0';
       if(!isset($array['show_staff']))
       $array['show_staff']='0';
       if(!isset($array['room']))
       $array['room']='0';
       if(!isset($array['show_room']))
       $array['show_room']='0';
       if(!isset($array['price']))
       $array['price']='0';
       if(!isset($array['show_price']))
       $array['show_price']='0';
       if(!isset($array['food']))
       $array['food']='0';
       if(!isset($array['show_food']))
       $array['show_food']='0';
       if(!isset($array['place']))
       $array['place']='0';
       if(!isset($array['show_place']))
       $array['show_place']='0';
       if(!isset($array['total']))
       $array['total']='0';
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
      $new_obj=new review_hotel($array);
        if($insert)
        {
            review_hotel_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/review_hotel.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            review_hotel_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/review_hotel.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=review_hotel_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=review_hotel_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_review_hotel($data);
}
else
{
     header('location: '.SITE_NAME);
}
