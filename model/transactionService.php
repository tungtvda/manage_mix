<?php
require_once DIR.'/model/transaction.php';
require_once DIR.'/model/sqlconnection.php';
//
function transaction_Get($command)
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
                $new_obj=new transaction($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'transaction');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new transaction($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function transaction_getById($id)
{
    return transaction_Get('select * from transaction where id='.$id);
}
//
function transaction_getByAll()
{
    return transaction_Get('select * from transaction');
}
//
function transaction_getByTop($top,$where,$order)
{
    return transaction_Get("select * from transaction ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function transaction_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return transaction_Get("SELECT * FROM  transaction ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function transaction_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return transaction_Get("SELECT transaction.id, transaction.created_by, transaction.customer_id, transaction.created_at, transaction.updated_at, transaction.updated_by FROM  transaction ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function transaction_insert($obj)
{
    return exe_query("insert into transaction (created_by,customer_id,created_at,updated_at,updated_by) values ('$obj->created_by','$obj->customer_id','$obj->created_at','$obj->updated_at','$obj->updated_by')",'transaction');
}
//
function transaction_update($obj)
{
    return exe_query("update transaction set created_by='$obj->created_by',customer_id='$obj->customer_id',created_at='$obj->created_at',updated_at='$obj->updated_at',updated_by='$obj->updated_by' where id=$obj->id",'transaction');
}
//
function transaction_delete($obj)
{
    return exe_query('delete from transaction where id='.$obj->id,'transaction');
}
//
function transaction_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from transaction '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
