<?php
require_once DIR.'/model/nguon_tour.php';
require_once DIR.'/model/sqlconnection.php';
//
function nguon_tour_Get($command)
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
                $new_obj=new nguon_tour($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'nguon_tour');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new nguon_tour($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function nguon_tour_getById($id)
{
    return nguon_tour_Get('select * from nguon_tour where id='.$id);
}
//
function nguon_tour_getByAll()
{
    return nguon_tour_Get('select * from nguon_tour');
}
//
function nguon_tour_getByTop($top,$where,$order)
{
    return nguon_tour_Get("select * from nguon_tour ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function nguon_tour_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return nguon_tour_Get("SELECT * FROM  nguon_tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function nguon_tour_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return nguon_tour_Get("SELECT nguon_tour.id, nguon_tour.name, nguon_tour.position FROM  nguon_tour ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function nguon_tour_insert($obj)
{
    return exe_query("insert into nguon_tour (name,position) values ('$obj->name','$obj->position')",'nguon_tour');
}
//
function nguon_tour_update($obj)
{
    return exe_query("update nguon_tour set name='$obj->name',position='$obj->position' where id=$obj->id",'nguon_tour');
}
//
function nguon_tour_delete($obj)
{
    return exe_query('delete from nguon_tour where id='.$obj->id,'nguon_tour');
}
//
function nguon_tour_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from nguon_tour '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
