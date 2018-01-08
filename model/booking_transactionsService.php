<?php
require_once DIR.'/model/booking_transactions.php';
require_once DIR.'/model/sqlconnection.php';
//
function booking_transactions_Get($command)
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
                $new_obj=new booking_transactions($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'booking_transactions');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new booking_transactions($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function booking_transactions_getById($id)
{
    return booking_transactions_Get('select * from booking_transactions where id='.$id);
}
//
function booking_transactions_getByAll()
{
    return booking_transactions_Get('select * from booking_transactions');
}
//
function booking_transactions_getByTop($top,$where,$order)
{
    return booking_transactions_Get("select * from booking_transactions ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function booking_transactions_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return booking_transactions_Get("SELECT * FROM  booking_transactions ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_transactions_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return booking_transactions_Get("SELECT booking_transactions.id, booking_transactions.booking_id, booking_transactions.customer_id, booking_transactions.user_id, booking_transactions.name, booking_transactions.description, booking_transactions.created, booking_transactions.updated FROM  booking_transactions ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_transactions_insert($obj)
{
    return exe_query("insert into booking_transactions (booking_id,customer_id,user_id,name,description,created,updated) values ('$obj->booking_id','$obj->customer_id','$obj->user_id','$obj->name','$obj->description','$obj->created','$obj->updated')",'booking_transactions');
}
//
function booking_transactions_update($obj)
{
    return exe_query("update booking_transactions set booking_id='$obj->booking_id',customer_id='$obj->customer_id',user_id='$obj->user_id',name='$obj->name',description='$obj->description',created='$obj->created',updated='$obj->updated' where id=$obj->id",'booking_transactions');
}
//
function booking_transactions_delete($obj)
{
    return exe_query('delete from booking_transactions where id='.$obj->id,'booking_transactions');
}
//
function booking_transactions_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from booking_transactions '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
function booking_giao_dich($where){
    $query="select bk.* , ";
    $query.=" us.name as name_user, us.avatar, us.user_role, us.user_code , ";
    $query.=" ctm.name as name_cus, ctm.avatar as avatar_cus, ctm.code as code_cus ";
    $query.=" FROM booking_transactions bk ";
    $query.=" LEFT JOIN user us on us.id = bk.user_id  ";
    $query.=" LEFT JOIN customer ctm on ctm.id = bk.customer_id ";
    if($where!=''){
        $query.=' where '.$where;
    }
    $query.=" ORDER BY bk.id desc";
    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    if($result!=false)while($row=mysqli_fetch_array($result))
    {
        array_push($array_result,$row);
    }
    return $array_result;
}
