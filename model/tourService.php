<?php
require_once DIR.'/model/tour.php';
require_once DIR.'/model/sqlconnection.php';
//
function tour_Get($command)
{
            $array_result=array();
    $key=md5($command);
    if(CACHE)
    {
        $mycache=ConnectCache();
        $cachecommand=$mycache->get($key);
        if($cachecommand)
        {
            $array_result=$cachecommand;
        }
        else
        {
          $result=mysqli_query(ConnectSql(),$command);
            if($result!=false)while($row=mysqli_fetch_array($result))
            {
                $new_obj=new tour($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'tour');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new tour($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function tour_getById($id)
{
    return tour_Get('select * from tour where id='.$id);
}
//
function tour_getByAll()
{
    return tour_Get('select * from tour');
}
//
function tour_getByTop($top,$where,$order)
{
    return tour_Get("select * from tour ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function tour_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return tour_Get("SELECT * FROM  tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tour_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return tour_Get("SELECT tour.id, tour.tour_quoc_te, danhmuc_1.name as DanhMuc1Id, danhmuc_2.name as DanhMuc2Id, tour.danhmuc_multi, tour.promotion, tour.packages, tour.name, tour.name_url, tour.count_down, tour.code, tour.img, tour.price_sales, tour.price, tour.price_2, tour.price_3, tour.price_4, tour.price_5, tour.price_6, tour.durations, tour.departure, tour.destination, tour.departure_time, tour.vehicle, tour.hotel, tour.summary, tour.highlights, tour.schedule, tour.price_list, tour.content, tour.list_img, tour.title, tour.keyword, tour.description, tour.inclusion, tour.exclusion FROM  tour, danhmuc_1, danhmuc_2 where danhmuc_1.id=tour.DanhMuc1Id and danhmuc_2.id=tour.DanhMuc2Id  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tour_insert($obj)
{
    return exe_query("insert into tour (tour_quoc_te,DanhMuc1Id,DanhMuc2Id,danhmuc_multi,promotion,packages,name,name_url,count_down,code,img,price_sales,price,price_2,price_3,price_4,price_5,price_6,durations,departure,destination,departure_time,vehicle,hotel,summary,highlights,schedule,price_list,content,list_img,title,keyword,description,inclusion,exclusion) values ('$obj->tour_quoc_te','$obj->DanhMuc1Id','$obj->DanhMuc2Id','$obj->danhmuc_multi','$obj->promotion','$obj->packages','$obj->name','$obj->name_url','$obj->count_down','$obj->code','$obj->img','$obj->price_sales','$obj->price','$obj->price_2','$obj->price_3','$obj->price_4','$obj->price_5','$obj->price_6','$obj->durations','$obj->departure','$obj->destination','$obj->departure_time','$obj->vehicle','$obj->hotel','$obj->summary','$obj->highlights','$obj->schedule','$obj->price_list','$obj->content','$obj->list_img','$obj->title','$obj->keyword','$obj->description','$obj->inclusion','$obj->exclusion')",'tour');
}
//
function tour_update($obj)
{
    return exe_query("update tour set tour_quoc_te='$obj->tour_quoc_te',DanhMuc1Id='$obj->DanhMuc1Id',DanhMuc2Id='$obj->DanhMuc2Id',danhmuc_multi='$obj->danhmuc_multi',promotion='$obj->promotion',packages='$obj->packages',name='$obj->name',name_url='$obj->name_url',count_down='$obj->count_down',code='$obj->code',img='$obj->img',price_sales='$obj->price_sales',price='$obj->price',price_2='$obj->price_2',price_3='$obj->price_3',price_4='$obj->price_4',price_5='$obj->price_5',price_6='$obj->price_6',durations='$obj->durations',departure='$obj->departure',destination='$obj->destination',departure_time='$obj->departure_time',vehicle='$obj->vehicle',hotel='$obj->hotel',summary='$obj->summary',highlights='$obj->highlights',schedule='$obj->schedule',price_list='$obj->price_list',content='$obj->content',list_img='$obj->list_img',title='$obj->title',keyword='$obj->keyword',description='$obj->description',inclusion='$obj->inclusion',exclusion='$obj->exclusion' where id=$obj->id",'tour');
}
//
function tour_delete($obj)
{
    return exe_query('delete from tour where id='.$obj->id,'tour');
}
//
function tour_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from tour '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
