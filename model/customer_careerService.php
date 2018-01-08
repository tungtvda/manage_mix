<?php
require_once DIR.'/model/customer_career.php';
require_once DIR.'/model/sqlconnection.php';
//
function customer_career_Get($command)
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
                $new_obj=new customer_career($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'customer_career');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new customer_career($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function customer_career_getById($id)
{
    return customer_career_Get('select * from customer_career where id='.$id);
}
//
function customer_career_getByAll()
{
    return customer_career_Get('select * from customer_career');
}
//
function customer_career_getByTop($top,$where,$order)
{
    return customer_career_Get("select * from customer_career ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function customer_career_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return customer_career_Get("SELECT * FROM  customer_career ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_career_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return customer_career_Get("SELECT customer_career.id, customer_career.name, customer_career.position FROM  customer_career ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_career_insert($obj)
{
    return exe_query("insert into customer_career (name,position) values ('$obj->name','$obj->position')",'customer_career');
}
//
function customer_career_update($obj)
{
    return exe_query("update customer_career set name='$obj->name',position='$obj->position' where id=$obj->id",'customer_career');
}
//
function customer_career_delete($obj)
{
    return exe_query('delete from customer_career where id='.$obj->id,'customer_career');
}
//
function customer_career_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from customer_career '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
