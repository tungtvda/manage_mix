<?php
require_once DIR.'/model/booking_cost.php';
require_once DIR.'/model/sqlconnection.php';
//
function booking_cost_Get($command)
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
                $new_obj=new booking_cost($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'booking_cost');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new booking_cost($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function booking_cost_getById($id)
{
    return booking_cost_Get('select * from booking_cost where id='.$id);
}
//
function booking_cost_getByAll()
{
    return booking_cost_Get('select * from booking_cost');
}
//
function booking_cost_getByTop($top,$where,$order)
{
    return booking_cost_Get("select * from booking_cost ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function booking_cost_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return booking_cost_Get("SELECT * FROM  booking_cost ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_cost_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return booking_cost_Get("SELECT booking_cost.id, booking_cost.booking_id, booking_cost.user_id, booking_cost.name, booking_cost.price, booking_cost.description, booking_cost.created, booking_cost.created_by, booking_cost.updated, booking_cost.updated_by FROM  booking_cost ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_cost_insert($obj)
{
    return exe_query("insert into booking_cost (booking_id,user_id,name,price,description,created,created_by,updated,updated_by) values ('$obj->booking_id','$obj->user_id','$obj->name','$obj->price','$obj->description','$obj->created','$obj->created_by','$obj->updated','$obj->updated_by')",'booking_cost');
}
//
function booking_cost_update($obj)
{
    return exe_query("update booking_cost set booking_id='$obj->booking_id',user_id='$obj->user_id',name='$obj->name',price='$obj->price',description='$obj->description',created='$obj->created',created_by='$obj->created_by',updated='$obj->updated',updated_by='$obj->updated_by' where id=$obj->id",'booking_cost');
}
//
function booking_cost_delete($obj)
{
    return exe_query('delete from booking_cost where id='.$obj->id,'booking_cost');
}
//
function booking_cost_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from booking_cost '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
