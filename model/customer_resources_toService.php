<?php
require_once DIR.'/model/customer_resources_to.php';
require_once DIR.'/model/sqlconnection.php';
//
function customer_resources_to_Get($command)
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
                $new_obj=new customer_resources_to($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'customer_resources_to');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new customer_resources_to($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function customer_resources_to_getById($id)
{
    return customer_resources_to_Get('select * from customer_resources_to where id='.$id);
}
//
function customer_resources_to_getByAll()
{
    return customer_resources_to_Get('select * from customer_resources_to');
}
//
function customer_resources_to_getByTop($top,$where,$order)
{
    return customer_resources_to_Get("select * from customer_resources_to ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function customer_resources_to_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return customer_resources_to_Get("SELECT * FROM  customer_resources_to ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_resources_to_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return customer_resources_to_Get("SELECT customer_resources_to.id, customer_resources_to.name, customer_resources_to.position FROM  customer_resources_to ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_resources_to_insert($obj)
{
    return exe_query("insert into customer_resources_to (name,position) values ('$obj->name','$obj->position')",'customer_resources_to');
}
//
function customer_resources_to_update($obj)
{
    return exe_query("update customer_resources_to set name='$obj->name',position='$obj->position' where id=$obj->id",'customer_resources_to');
}
//
function customer_resources_to_delete($obj)
{
    return exe_query('delete from customer_resources_to where id='.$obj->id,'customer_resources_to');
}
//
function customer_resources_to_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from customer_resources_to '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
