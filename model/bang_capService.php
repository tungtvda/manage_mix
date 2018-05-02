<?php
require_once DIR.'/model/bang_cap.php';
require_once DIR.'/model/sqlconnection.php';
//
function bang_cap_Get($command)
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
                $new_obj=new bang_cap($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'bang_cap');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new bang_cap($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function bang_cap_getById($id)
{
    return bang_cap_Get('select * from bang_cap where id='.$id);
}
//
function bang_cap_getByAll()
{
    return bang_cap_Get('select * from bang_cap');
}
//
function bang_cap_getByTop($top,$where,$order)
{
    return bang_cap_Get("select * from bang_cap ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function bang_cap_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return bang_cap_Get("SELECT * FROM  bang_cap ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function bang_cap_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return bang_cap_Get("SELECT bang_cap.id, bang_cap.name FROM  bang_cap ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function bang_cap_insert($obj)
{
    return exe_query("insert into bang_cap (name) values ('$obj->name')",'bang_cap');
}
//
function bang_cap_update($obj)
{
    return exe_query("update bang_cap set name='$obj->name' where id=$obj->id",'bang_cap');
}
//
function bang_cap_delete($obj)
{
    return exe_query('delete from bang_cap where id='.$obj->id,'bang_cap');
}
//
function bang_cap_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from bang_cap '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
