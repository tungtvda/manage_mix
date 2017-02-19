<?php
require_once DIR.'/model/customer_category.php';
require_once DIR.'/model/sqlconnection.php';
//
function customer_category_Get($command)
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
                $new_obj=new customer_category($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'customer_category');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new customer_category($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function customer_category_getById($id)
{
    return customer_category_Get('select * from customer_category where id='.$id);
}
//
function customer_category_getByAll()
{
    return customer_category_Get('select * from customer_category');
}
//
function customer_category_getByTop($top,$where,$order)
{
    return customer_category_Get("select * from customer_category ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function customer_category_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return customer_category_Get("SELECT * FROM  customer_category ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_category_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return customer_category_Get("SELECT customer_category.id, customer_category.name, customer_category.position FROM  customer_category ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_category_insert($obj)
{
    return exe_query("insert into customer_category (name,position) values ('$obj->name','$obj->position')",'customer_category');
}
//
function customer_category_update($obj)
{
    return exe_query("update customer_category set name='$obj->name',position='$obj->position' where id=$obj->id",'customer_category');
}
//
function customer_category_delete($obj)
{
    return exe_query('delete from customer_category where id='.$obj->id,'customer_category');
}
//
function customer_category_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from customer_category '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
