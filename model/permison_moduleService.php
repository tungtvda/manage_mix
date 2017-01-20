<?php
require_once DIR.'/model/permison_module.php';
require_once DIR.'/model/sqlconnection.php';
//
function permison_module_Get($command)
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
                $new_obj=new permison_module($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'permison_module');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new permison_module($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function permison_module_getById($id)
{
    return permison_module_Get('select * from permison_module where id='.$id);
}
//
function permison_module_getByAll()
{
    return permison_module_Get('select * from permison_module');
}
//
function permison_module_getByTop($top,$where,$order)
{
    return permison_module_Get("select * from permison_module ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function permison_module_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return permison_module_Get("SELECT * FROM  permison_module ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function permison_module_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return permison_module_Get("SELECT permison_module.id, permison_module.name, permison_module.url, permison_module.status, permison_module.position FROM  permison_module ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function permison_module_insert($obj)
{
    return exe_query("insert into permison_module (name,url,status,position) values ('$obj->name','$obj->url','$obj->status','$obj->position')",'permison_module');
}
//
function permison_module_update($obj)
{
    return exe_query("update permison_module set name='$obj->name',url='$obj->url',status='$obj->status',position='$obj->position' where id=$obj->id",'permison_module');
}
//
function permison_module_delete($obj)
{
    return exe_query('delete from permison_module where id='.$obj->id,'permison_module');
}
//
function permison_module_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from permison_module '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
