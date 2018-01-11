<?php
require_once DIR.'/model/thuong_hieu.php';
require_once DIR.'/model/sqlconnection.php';
//
function thuong_hieu_Get($command)
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
                $new_obj=new thuong_hieu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'thuong_hieu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new thuong_hieu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function thuong_hieu_getById($id)
{
    return thuong_hieu_Get('select * from thuong_hieu where id='.$id);
}
//
function thuong_hieu_getByAll()
{
    return thuong_hieu_Get('select * from thuong_hieu');
}
//
function thuong_hieu_getByTop($top,$where,$order)
{
    return thuong_hieu_Get("select * from thuong_hieu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function thuong_hieu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return thuong_hieu_Get("SELECT * FROM  thuong_hieu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thuong_hieu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return thuong_hieu_Get("SELECT thuong_hieu.id, thuong_hieu.active, thuong_hieu.name, thuong_hieu.logo, thuong_hieu.email, thuong_hieu.mat_khau_send_email, thuong_hieu.email_template FROM  thuong_hieu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thuong_hieu_insert($obj)
{
    return exe_query("insert into thuong_hieu (active,name,logo,email,mat_khau_send_email,email_template) values ('$obj->active','$obj->name','$obj->logo','$obj->email','$obj->mat_khau_send_email','$obj->email_template')",'thuong_hieu');
}
//
function thuong_hieu_update($obj)
{
    return exe_query("update thuong_hieu set active='$obj->active',name='$obj->name',logo='$obj->logo',email='$obj->email',mat_khau_send_email='$obj->mat_khau_send_email',email_template='$obj->email_template' where id=$obj->id",'thuong_hieu');
}
//
function thuong_hieu_delete($obj)
{
    return exe_query('delete from thuong_hieu where id='.$obj->id,'thuong_hieu');
}
//
function thuong_hieu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from thuong_hieu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
