<?php
require_once DIR.'/model/httt.php';
require_once DIR.'/model/sqlconnection.php';
//
function httt_Get($command)
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
                $new_obj=new httt($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'httt');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new httt($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function httt_getById($id)
{
    return httt_Get('select * from httt where id='.$id);
}
//
function httt_getByAll()
{
    return httt_Get('select * from httt');
}
//
function httt_getByTop($top,$where,$order)
{
    return httt_Get("select * from httt ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function httt_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return httt_Get("SELECT * FROM  httt ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function httt_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return httt_Get("SELECT httt.id, httt.name, httt.position FROM  httt ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function httt_insert($obj)
{
    return exe_query("insert into httt (name,position) values ('$obj->name','$obj->position')",'httt');
}
//
function httt_update($obj)
{
    return exe_query("update httt set name='$obj->name',position='$obj->position' where id=$obj->id",'httt');
}
//
function httt_delete($obj)
{
    return exe_query('delete from httt where id='.$obj->id,'httt');
}
//
function httt_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from httt '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
