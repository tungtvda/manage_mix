<?php
require_once DIR.'/model/customer_booking.php';
require_once DIR.'/model/sqlconnection.php';
//
function customer_booking_Get($command)
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
                $new_obj=new customer_booking($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'customer_booking');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new customer_booking($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function customer_booking_getById($id)
{
    return customer_booking_Get('select * from customer_booking where id='.$id);
}
//
function customer_booking_getByAll()
{
    return customer_booking_Get('select * from customer_booking');
}
//
function customer_booking_getByTop($top,$where,$order)
{
    return customer_booking_Get("select * from customer_booking ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function customer_booking_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return customer_booking_Get("SELECT * FROM  customer_booking ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_booking_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return customer_booking_Get("SELECT customer_booking.id, customer_booking.booking_id, customer_booking.name, customer_booking.email, customer_booking.phone, customer_booking.address, customer_booking.do_tuoi, customer_booking.created_by, customer_booking.created, customer_booking.updated FROM  customer_booking ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_booking_insert($obj)
{
    return exe_query("insert into customer_booking (booking_id,name,email,phone,address,do_tuoi,created_by,created,updated) values ('$obj->booking_id','$obj->name','$obj->email','$obj->phone','$obj->address','$obj->do_tuoi','$obj->created_by','$obj->created','$obj->updated')",'customer_booking');
}
//
function customer_booking_update($obj)
{
    return exe_query("update customer_booking set booking_id='$obj->booking_id',name='$obj->name',email='$obj->email',phone='$obj->phone',address='$obj->address',do_tuoi='$obj->do_tuoi',created_by='$obj->created_by',created='$obj->created',updated='$obj->updated' where id=$obj->id",'customer_booking');
}
//
function customer_booking_delete($obj)
{
    return exe_query('delete from customer_booking where id='.$obj->id,'customer_booking');
}
//
function customer_booking_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from customer_booking '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
