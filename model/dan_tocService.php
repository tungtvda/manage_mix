<?php
require_once DIR.'/model/dan_toc.php';
require_once DIR.'/model/sqlconnection.php';
//
function dan_toc_Get($command)
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
                $new_obj=new dan_toc($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'dan_toc');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new dan_toc($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function dan_toc_getById($id)
{
    return dan_toc_Get('select * from dan_toc where id='.$id);
}
//
function dan_toc_getByAll()
{
    return dan_toc_Get('select * from dan_toc');
}
//
function dan_toc_getByTop($top,$where,$order)
{
    return dan_toc_Get("select * from dan_toc ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function dan_toc_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return dan_toc_Get("SELECT * FROM  dan_toc ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dan_toc_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return dan_toc_Get("SELECT dan_toc.id, dan_toc.name FROM  dan_toc ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dan_toc_insert($obj)
{
    return exe_query("insert into dan_toc (name) values ('$obj->name')",'dan_toc');
}
//
function dan_toc_update($obj)
{
    return exe_query("update dan_toc set name='$obj->name' where id=$obj->id",'dan_toc');
}
//
function dan_toc_delete($obj)
{
    return exe_query('delete from dan_toc where id='.$obj->id,'dan_toc');
}
//
function dan_toc_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from dan_toc '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
