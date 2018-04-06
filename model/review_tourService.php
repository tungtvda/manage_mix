<?php
require_once DIR.'/model/review_tour.php';
require_once DIR.'/model/sqlconnection.php';
//
function review_tour_Get($command)
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
                $new_obj=new review_tour($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'review_tour');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new review_tour($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function review_tour_getById($id)
{
    return review_tour_Get('select * from review_tour where id='.$id);
}
//
function review_tour_getByAll()
{
    return review_tour_Get('select * from review_tour');
}
//
function review_tour_getByTop($top,$where,$order)
{
    return review_tour_Get("select * from review_tour ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function review_tour_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return review_tour_Get("SELECT * FROM  review_tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function review_tour_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return review_tour_Get("SELECT review_tour.id, review_tour.customer_id, review_tour.tour_id, review_tour.tour_name, review_tour.tour_code, review_tour.domain, review_tour.status, review_tour.program, review_tour.tour_guide_full, review_tour.tour_guide_local, review_tour.hotel, review_tour.restaurant, review_tour.transportation, review_tour.comment, review_tour.show_coment, review_tour.upcoming_tour, review_tour.created, review_tour.updated, review_tour.updated_by FROM  review_tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function review_tour_insert($obj)
{
    return exe_query("insert into review_tour (customer_id,tour_id,tour_name,tour_code,domain,status,program,tour_guide_full,tour_guide_local,hotel,restaurant,transportation,comment,show_coment,upcoming_tour,created,updated,updated_by) values ('$obj->customer_id','$obj->tour_id','$obj->tour_name','$obj->tour_code','$obj->domain','$obj->status','$obj->program','$obj->tour_guide_full','$obj->tour_guide_local','$obj->hotel','$obj->restaurant','$obj->transportation','$obj->comment','$obj->show_coment','$obj->upcoming_tour','$obj->created','$obj->updated','$obj->updated_by')",'review_tour');
}
//
function review_tour_update($obj)
{
    return exe_query("update review_tour set customer_id='$obj->customer_id',tour_id='$obj->tour_id',tour_name='$obj->tour_name',tour_code='$obj->tour_code',domain='$obj->domain',status='$obj->status',program='$obj->program',tour_guide_full='$obj->tour_guide_full',tour_guide_local='$obj->tour_guide_local',hotel='$obj->hotel',restaurant='$obj->restaurant',transportation='$obj->transportation',comment='$obj->comment',show_coment='$obj->show_coment',upcoming_tour='$obj->upcoming_tour',created='$obj->created',updated='$obj->updated',updated_by='$obj->updated_by' where id=$obj->id",'review_tour');
}
//
function review_tour_delete($obj)
{
    return exe_query('delete from review_tour where id='.$obj->id,'review_tour');
}
//
function review_tour_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from review_tour '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
