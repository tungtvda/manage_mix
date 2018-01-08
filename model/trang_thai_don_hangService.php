<?php
require_once DIR.'/model/trang_thai_don_hang.php';
require_once DIR.'/model/sqlconnection.php';
//
function trang_thai_don_hang_Get($command)
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
                $new_obj=new trang_thai_don_hang($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'trang_thai_don_hang');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new trang_thai_don_hang($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function trang_thai_don_hang_getById($id)
{
    return trang_thai_don_hang_Get('select * from trang_thai_don_hang where id='.$id);
}
//
function trang_thai_don_hang_getByAll()
{
    return trang_thai_don_hang_Get('select * from trang_thai_don_hang');
}
//
function trang_thai_don_hang_getByTop($top,$where,$order)
{
    return trang_thai_don_hang_Get("select * from trang_thai_don_hang ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function trang_thai_don_hang_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return trang_thai_don_hang_Get("SELECT * FROM  trang_thai_don_hang ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function trang_thai_don_hang_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return trang_thai_don_hang_Get("SELECT trang_thai_don_hang.id, trang_thai_don_hang.name, trang_thai_don_hang.position FROM  trang_thai_don_hang ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function trang_thai_don_hang_insert($obj)
{
    return exe_query("insert into trang_thai_don_hang (name,position) values ('$obj->name','$obj->position')",'trang_thai_don_hang');
}
//
function trang_thai_don_hang_update($obj)
{
    return exe_query("update trang_thai_don_hang set name='$obj->name',position='$obj->position' where id=$obj->id",'trang_thai_don_hang');
}
//
function trang_thai_don_hang_delete($obj)
{
    return exe_query('delete from trang_thai_don_hang where id='.$obj->id,'trang_thai_don_hang');
}
//
function trang_thai_don_hang_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from trang_thai_don_hang '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
