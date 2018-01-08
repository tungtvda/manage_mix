<?php
require_once DIR.'/model/booking_list_dichvu.php';
require_once DIR.'/model/sqlconnection.php';
//
function booking_list_dichvu_Get($command)
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
                $new_obj=new booking_list_dichvu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'booking_list_dichvu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new booking_list_dichvu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function booking_list_dichvu_getById($id)
{
    return booking_list_dichvu_Get('select * from booking_list_dichvu where id='.$id);
}
//
function booking_list_dichvu_getByAll()
{
    return booking_list_dichvu_Get('select * from booking_list_dichvu');
}
//
function booking_list_dichvu_getByTop($top,$where,$order)
{
    return booking_list_dichvu_Get("select * from booking_list_dichvu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function booking_list_dichvu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return booking_list_dichvu_Get("SELECT * FROM  booking_list_dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_list_dichvu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return booking_list_dichvu_Get("SELECT booking_list_dichvu.id, booking_list_dichvu.booking_id, booking_list_dichvu.name, booking_list_dichvu.type, booking_list_dichvu.price, booking_list_dichvu.number, booking_list_dichvu.total, booking_list_dichvu.note FROM  booking_list_dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_list_dichvu_insert($obj)
{
    return exe_query("insert into booking_list_dichvu (booking_id,name,type,price,number,total,note) values ('$obj->booking_id','$obj->name','$obj->type','$obj->price','$obj->number','$obj->total','$obj->note')",'booking_list_dichvu');
}
//
function booking_list_dichvu_update($obj)
{
    return exe_query("update booking_list_dichvu set booking_id='$obj->booking_id',name='$obj->name',type='$obj->type',price='$obj->price',number='$obj->number',total='$obj->total',note='$obj->note' where id=$obj->id",'booking_list_dichvu');
}
//
function booking_list_dichvu_delete($obj)
{
    return exe_query('delete from booking_list_dichvu where id='.$obj->id,'booking_list_dichvu');
}
//
function booking_list_dichvu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from booking_list_dichvu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
