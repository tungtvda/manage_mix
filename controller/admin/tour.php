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
returnCountData();
if(isset($_SESSION["Admin"]))
{
    $danhmuc_id_get='';
    if(isset($_GET['DanhMuc1Id'])&&$_GET['DanhMuc1Id']!=''){
        $danhmuc_id_get='?DanhMuc1Id='.$_GET['DanhMuc1Id'];
    }
    else{
        if(isset($_GET['DanhMuc2Id'])&&$_GET['DanhMuc2Id']!=''){
            $danhmuc_id_get='?DanhMuc2Id='.$_GET['DanhMuc2Id'];
        }
    }
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new tour();
            $new_obj->id=$_GET["id"];
            tour_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/tour.php'.$danhmuc_id_get);
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=tour_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/tour.php'.$danhmuc_id_get);
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
    $data['listfkey']['DanhMuc1Id']=danhmuc_1_getByAll();
    $data['listfkey']['DanhMuc2Id']=danhmuc_2_getByAll();
    $data['listfkey']['departure']=departure_getByTop('','','position asc');
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_tour=tour_getByAll();
            foreach($List_tour as $tour)
            {
                if(isset($_GET["check_".$tour->id])) tour_delete($tour);
            }
            header('Location: '.SITE_NAME.'/controller/admin/tour.php');
        }
    }
    if(isset($_POST["DanhMuc1Id"])&&isset($_POST["DanhMuc2Id"])&&isset($_POST["name"])&&isset($_POST["name_url"])&&isset($_POST["count_down"])&&isset($_POST["code"])&&isset($_POST["img"])&&isset($_POST["price_sales"])&&isset($_POST["price"])&&isset($_POST["price_2"])&&isset($_POST["price_3"])&&isset($_POST["price_4"])&&isset($_POST["price_5"])&&isset($_POST["price_6"])&&isset($_POST["durations"])&&isset($_POST["departure"])&&isset($_POST["departure_time"])&&isset($_POST["destination"])&&isset($_POST["vehicle"])&&isset($_POST["hotel"])&&isset($_POST["summary"])&&isset($_POST["highlights"])&&isset($_POST["schedule"])&&isset($_POST["price_list"])&&isset($_POST["content"])&&isset($_POST["list_img"])&&isset($_POST["title"])&&isset($_POST["keyword"])&&isset($_POST["description"])&&isset($_POST["inclusion"])&&isset($_POST["exclusion"]))
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
        $departure='';
        if(isset($_POST["departure"])&&$_POST["departure"]!=''){
            $departure=implode(',',$_POST["departure"]);
            $array['departure']=$departure;
        }
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
        if($insert)
        {
            tour_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/tour.php'.$danhmuc_id_get);
        }
        else
        {
            $new_obj->id=$_GET["id"];
            tour_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/tour.php'.$danhmuc_id_get);
        }
    }
    $dk='';
    $dk_count='';
    if(isset($_GET['giatri'])&&$_GET['giatri']!=''){
        $key_timkiem=mb_strtolower(addslashes(strip_tags($_GET['giatri'])));
        $dk_count='name LIKE "%'.$key_timkiem.'%" or name_url LIKE "%'.$key_timkiem.'%" or code LIKE "%'.$key_timkiem.'%" or price_sales LIKE "%'.$key_timkiem.'%" or price LIKE "%'.$key_timkiem.'%" or durations LIKE "%'.$key_timkiem.'%"  or departure LIKE "%'.$key_timkiem.'%" or departure_time LIKE "%'.$key_timkiem.'%" or destination LIKE "%'.$key_timkiem.'%" or destination LIKE "%'.$key_timkiem.'%"';
        $dk='(tour.name LIKE "%'.$key_timkiem.'%" or tour.name_url LIKE "%'.$key_timkiem.'%" or tour.code LIKE "%'.$key_timkiem.'%" or tour.price_sales LIKE "%'.$key_timkiem.'%" or tour.price LIKE "%'.$key_timkiem.'%" or tour.durations LIKE "%'.$key_timkiem.'%"  or tour.departure LIKE "%'.$key_timkiem.'%" or tour.departure_time LIKE "%'.$key_timkiem.'%" or tour.destination LIKE "%'.$key_timkiem.'%" or tour.destination LIKE "%'.$key_timkiem.'%")';
    }
    if(isset($_GET['DanhMuc1Id'])&&$_GET['DanhMuc1Id']!=''){
        $danhmuc_id=mb_strtolower(addslashes(strip_tags($_GET['DanhMuc1Id'])));
        if($dk!='')
        {
            $dk.=' (and tour.DanhMuc1Id='.$danhmuc_id.')';
            $dk_count.=' and DanhMuc1Id='.$danhmuc_id;
        }
        else{
            $dk.='  tour.DanhMuc1Id='.$danhmuc_id.'';
            $dk_count.='  DanhMuc1Id='.$danhmuc_id;
        }

    }else{
        if(isset($_GET['DanhMuc2Id'])&&$_GET['DanhMuc2Id']!=''){
            $danhmuc_id=mb_strtolower(addslashes(strip_tags($_GET['DanhMuc2Id'])));
            if($dk!='')
            {
                $dk.=' (and tour.DanhMuc2Id='.$danhmuc_id.')';
                $dk_count.=' and DanhMuc2Id='.$danhmuc_id;
            }
            else{
                $dk.='  tour.DanhMuc2Id='.$danhmuc_id.'';
                $dk_count.='  DanhMuc2Id='.$danhmuc_id;
            }

        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=tour_count($dk_count);
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=tour_getByPagingReplace($data['page'],20,'id DESC',$dk);
    // gọi phương thức trong tầng view để hiển thị
    view_tour($data);
}
else
{
     header('location: '.SITE_NAME);
}
