<?php
require_once '../../config.php';
require_once DIR.'/model/tourService.php';
require_once DIR.'/model/danhmuc_1Service.php';
require_once DIR.'/model/danhmuc_2Service.php';
require_once DIR.'/model/departureService.php';
require_once DIR.'/view/admin/tour.php';
require_once DIR.'/common/messenger.php';
require_once DIR.'/common/locdautiengviet.php';
$data=array();
$insert=true;
$code_check_send_email='';

if(isset($_POST['code_check_send_email']))
{
    $code_check_send_email=_return_mc_decrypt($_POST['code_check_send_email']);
    if($code_check_send_email=='tungtv_az_mix_12345'){
        $code_check_send_email=1;
        unset($_POST['code_check_send_email']);
    }
}
if($code_check_send_email==1){
    if(isset($_POST['action'])){
        if(isset($_POST['id'])){
            $new_obj= new tour();
            $new_obj->id=$_POST["id"];
            tour_delete($new_obj);
        }
        exit;
    }
}
if($code_check_send_email==1 && isset($_POST["DanhMuc1Id"])&&isset($_POST["DanhMuc2Id"])&&isset($_POST["name"])&&isset($_POST["name_url"])&&isset($_POST["count_down"])&&isset($_POST["code"])&&isset($_POST["img"])&&isset($_POST["price_tiep_thi"])&&isset($_POST["price_sales"])&&isset($_POST["price"])&&isset($_POST["price_2"])&&isset($_POST["price_3"])&&isset($_POST["price_4"])&&isset($_POST["price_5"])&&isset($_POST["price_6"])&&isset($_POST["durations"])&&isset($_POST["departure"])&&isset($_POST["departure_time"])&&isset($_POST["destination"])&&isset($_POST["vehicle"])&&isset($_POST["hotel"])&&isset($_POST["summary"])&&isset($_POST["highlights"])&&isset($_POST["schedule"])&&isset($_POST["price_list"])&&isset($_POST["content"])&&isset($_POST["list_img"])&&isset($_POST["title"])&&isset($_POST["keyword"])&&isset($_POST["description"])&&isset($_POST["inclusion"])&&isset($_POST["exclusion"]))
{

    $array=$_POST;
    if(!isset($array['id']))
        $array['id']='0';
    if(!isset($array['DanhMuc1Id']))
        $array['DanhMuc1Id']='0';
    if(!isset($array['DanhMuc2Id']))
        $array['DanhMuc2Id']='0';
    if(!isset($array['promotion']))
        $array['promotion']='0';
    if(!isset($array['packages']))
        $array['packages']='0';
    if(!isset($array['name']))
        $array['name']='0';
    if(!isset($array['name_url']))
        $array['name_url']='0';
    $array['name_url']=LocDau($array['name']);
    if(!isset($array['count_down']))
        $array['count_down']='';
    if(!isset($array['code']))
        $array['code']='0';
    if(!isset($array['img']))
        $array['img']='0';
    if(!isset($array['price_tiep_thi']))
        $array['price_tiep_thi']='';
    if(!isset($array['price_sales']))
        $array['price_sales']='0';
    if(!isset($array['price']))
        $array['price']='0';
    if(!isset($array['price_2']))
        $array['price_2']='0';
    if(!isset($array['price_3']))
        $array['price_3']='0';
    if(!isset($array['price_4']))
        $array['price_4']='0';
    if(!isset($array['price_5']))
        $array['price_5']='0';
    if(!isset($array['price_6']))
        $array['price_6']='0';
    if(!isset($array['durations']))
        $array['durations']='0';
    if(!isset($array['departure']))
        $array['departure']='0';
    if(!isset($array['departure_time']))
        $array['departure_time']='0';
    if(!isset($array['destination']))
        $array['destination']='0';
    if(!isset($array['vehicle']))
        $array['vehicle']='0';
    if(!isset($array['hotel']))
        $array['hotel']='0';
    if(!isset($array['summary']))
        $array['summary']='0';
    if(!isset($array['highlights']))
        $array['highlights']='0';
    if(!isset($array['schedule']))
        $array['schedule']='0';
    if(!isset($array['price_list']))
        $array['price_list']='0';
    if(!isset($array['content']))
        $array['content']='0';
    if(!isset($array['list_img']))
        $array['list_img']='0';
    if(!isset($array['title']))
        $array['title']='0';
    if(!isset($array['keyword']))
        $array['keyword']='0';
    if(!isset($array['description']))
        $array['description']='0';
    if(!isset($array['inclusion']))
        $array['inclusion']='0';
    if(!isset($array['exclusion']))
        $array['exclusion']='0';
    $array['updated']=date(DATETIME_FORMAT);
    $new_obj=new tour($array);
    if($array['id']==0)
    {
        tour_insert($new_obj);
    }
    else
    {
        $new_obj->id=$array['id'];
        tour_update($new_obj);
    }
}
