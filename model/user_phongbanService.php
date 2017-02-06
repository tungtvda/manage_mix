<?php
require_once DIR.'/model/user_phongban.php';
require_once DIR.'/model/sqlconnection.php';
//
function user_phongban_Get($command)
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
                $new_obj=new user_phongban($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'user_phongban');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new user_phongban($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function user_phongban_getById($id)
{
    return user_phongban_Get('select * from user_phongban where id='.$id);
}
//
function user_phongban_getByAll()
{
    return user_phongban_Get('select * from user_phongban');
}
//
function user_phongban_getByTop($top,$where,$order)
{
    return user_phongban_Get("select * from user_phongban ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function user_phongban_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return user_phongban_Get("SELECT * FROM  user_phongban ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_phongban_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return user_phongban_Get("SELECT user_phongban.id, user_phongban.name, user_phongban.position, user_phongban.description FROM  user_phongban ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_phongban_insert($obj)
{
    return exe_query("insert into user_phongban (name,position,description) values ('$obj->name','$obj->position','$obj->description')",'user_phongban');
}
//
function user_phongban_update($obj)
{
    return exe_query("update user_phongban set name='$obj->name',position='$obj->position',description='$obj->description' where id=$obj->id",'user_phongban');
}
//
function user_phongban_delete($obj)
{
    return exe_query('delete from user_phongban where id='.$obj->id,'user_phongban');
}
//
function user_phongban_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from user_phongban '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
