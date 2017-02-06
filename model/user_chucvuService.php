<?php
require_once DIR.'/model/user_chucvu.php';
require_once DIR.'/model/sqlconnection.php';
//
function user_chucvu_Get($command)
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
                $new_obj=new user_chucvu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'user_chucvu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new user_chucvu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function user_chucvu_getById($id)
{
    return user_chucvu_Get('select * from user_chucvu where id='.$id);
}
//
function user_chucvu_getByAll()
{
    return user_chucvu_Get('select * from user_chucvu');
}
//
function user_chucvu_getByTop($top,$where,$order)
{
    return user_chucvu_Get("select * from user_chucvu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function user_chucvu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return user_chucvu_Get("SELECT * FROM  user_chucvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_chucvu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return user_chucvu_Get("SELECT user_chucvu.id, user_chucvu.name, user_chucvu.position, user_chucvu.description FROM  user_chucvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_chucvu_insert($obj)
{
    return exe_query("insert into user_chucvu (name,position,description) values ('$obj->name','$obj->position','$obj->description')",'user_chucvu');
}
//
function user_chucvu_update($obj)
{
    return exe_query("update user_chucvu set name='$obj->name',position='$obj->position',description='$obj->description' where id=$obj->id",'user_chucvu');
}
//
function user_chucvu_delete($obj)
{
    return exe_query('delete from user_chucvu where id='.$obj->id,'user_chucvu');
}
//
function user_chucvu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from user_chucvu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
