<?php
require_once DIR.'/model/danhmuc_dichvu.php';
require_once DIR.'/model/sqlconnection.php';
//
function danhmuc_dichvu_Get($command)
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
                $new_obj=new danhmuc_dichvu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'danhmuc_dichvu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new danhmuc_dichvu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function danhmuc_dichvu_getById($id)
{
    return danhmuc_dichvu_Get('select * from danhmuc_dichvu where id='.$id);
}
//
function danhmuc_dichvu_getByAll()
{
    return danhmuc_dichvu_Get('select * from danhmuc_dichvu');
}
//
function danhmuc_dichvu_getByTop($top,$where,$order)
{
    return danhmuc_dichvu_Get("select * from danhmuc_dichvu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function danhmuc_dichvu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuc_dichvu_Get("SELECT * FROM  danhmuc_dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuc_dichvu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuc_dichvu_Get("SELECT danhmuc_dichvu.id, danhmuc_dichvu.name, danhmuc_dichvu.position FROM  danhmuc_dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuc_dichvu_insert($obj)
{
    return exe_query("insert into danhmuc_dichvu (name,position) values ('$obj->name','$obj->position')",'danhmuc_dichvu');
}
//
function danhmuc_dichvu_update($obj)
{
    return exe_query("update danhmuc_dichvu set name='$obj->name',position='$obj->position' where id=$obj->id",'danhmuc_dichvu');
}
//
function danhmuc_dichvu_delete($obj)
{
    return exe_query('delete from danhmuc_dichvu where id='.$obj->id,'danhmuc_dichvu');
}
//
function danhmuc_dichvu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from danhmuc_dichvu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
