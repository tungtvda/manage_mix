<?php
require_once DIR.'/model/departure.php';
require_once DIR.'/model/sqlconnection.php';
//
function departure_Get($command)
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
                $new_obj=new departure($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'departure');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new departure($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function departure_getById($id)
{
    return departure_Get('select * from departure where id='.$id);
}
//
function departure_getByAll()
{
    return departure_Get('select * from departure');
}
//
function departure_getByTop($top,$where,$order)
{
    return departure_Get("select * from departure ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function departure_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return departure_Get("SELECT * FROM  departure ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function departure_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return departure_Get("SELECT departure.id, departure.name, departure.position FROM  departure ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function departure_insert($obj)
{
    return exe_query("insert into departure (name,position) values ('$obj->name','$obj->position')",'departure');
}
//
function departure_update($obj)
{
    return exe_query("update departure set name='$obj->name',position='$obj->position' where id=$obj->id",'departure');
}
//
function departure_delete($obj)
{
    return exe_query('delete from departure where id='.$obj->id,'departure');
}
//
function departure_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from departure '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
