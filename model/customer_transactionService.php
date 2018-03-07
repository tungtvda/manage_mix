<?php
require_once DIR.'/model/customer_transaction.php';
require_once DIR.'/model/sqlconnection.php';
//
function customer_transaction_Get($command)
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
                $new_obj=new customer_transaction($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'customer_transaction');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new customer_transaction($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function customer_transaction_getById($id)
{
    return customer_transaction_Get('select * from customer_transaction where id='.$id);
}
//
function customer_transaction_getByAll()
{
    return customer_transaction_Get('select * from customer_transaction');
}
//
function customer_transaction_getByTop($top,$where,$order)
{
    return customer_transaction_Get("select * from customer_transaction ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function customer_transaction_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return customer_transaction_Get("SELECT * FROM  customer_transaction ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_transaction_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return customer_transaction_Get("SELECT customer_transaction.id, customer_transaction.transaction_id, customer_transaction.title, customer_transaction.description, customer_transaction.created_at, customer_transaction.update_at, customer_transaction.created_by, customer_transaction.updated_by FROM  customer_transaction ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_transaction_insert($obj)
{
    return exe_query("insert into customer_transaction (transaction_id,title,description,created_at,update_at,created_by,updated_by) values ('$obj->transaction_id','$obj->title','$obj->description','$obj->created_at','$obj->update_at','$obj->created_by','$obj->updated_by')",'customer_transaction');
}
//
function customer_transaction_update($obj)
{
    return exe_query("update customer_transaction set transaction_id='$obj->transaction_id',title='$obj->title',description='$obj->description',created_at='$obj->created_at',update_at='$obj->update_at',created_by='$obj->created_by',updated_by='$obj->updated_by' where id=$obj->id",'customer_transaction');
}
//
function customer_transaction_delete($obj)
{
    return exe_query('delete from customer_transaction where id='.$obj->id,'customer_transaction');
}
//
function customer_transaction_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from customer_transaction '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
