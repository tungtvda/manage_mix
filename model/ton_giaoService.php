<?php
require_once DIR.'/model/ton_giao.php';
require_once DIR.'/model/sqlconnection.php';
//
function ton_giao_Get($command)
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
                $new_obj=new ton_giao($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'ton_giao');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new ton_giao($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function ton_giao_getById($id)
{
    return ton_giao_Get('select * from ton_giao where id='.$id);
}
//
function ton_giao_getByAll()
{
    return ton_giao_Get('select * from ton_giao');
}
//
function ton_giao_getByTop($top,$where,$order)
{
    return ton_giao_Get("select * from ton_giao ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function ton_giao_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return ton_giao_Get("SELECT * FROM  ton_giao ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function ton_giao_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return ton_giao_Get("SELECT ton_giao.id, ton_giao.name FROM  ton_giao ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function ton_giao_insert($obj)
{
    return exe_query("insert into ton_giao (name) values ('$obj->name')",'ton_giao');
}
//
function ton_giao_update($obj)
{
    return exe_query("update ton_giao set name='$obj->name' where id=$obj->id",'ton_giao');
}
//
function ton_giao_delete($obj)
{
    return exe_query('delete from ton_giao where id='.$obj->id,'ton_giao');
}
//
function ton_giao_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from ton_giao '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
