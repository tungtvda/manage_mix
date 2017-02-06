<?php
require_once DIR.'/model/permison_form.php';
require_once DIR.'/model/sqlconnection.php';
//
function permison_form_Get($command)
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
                $new_obj=new permison_form($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'permison_form');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new permison_form($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function permison_form_getById($id)
{
    return permison_form_Get('select * from permison_form where id='.$id);
}
//
function permison_form_getByAll()
{
    return permison_form_Get('select * from permison_form');
}
//
function permison_form_getByTop($top,$where,$order)
{
    return permison_form_Get("select * from permison_form ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function permison_form_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return permison_form_Get("SELECT * FROM  permison_form ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function permison_form_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return permison_form_Get("SELECT permison_form.id, permison_module.name as module_id, permison_form.name, permison_form.url, permison_form.action_count, permison_form.dk_count, permison_form.active, permison_form.status, permison_form.position FROM  permison_form, permison_module where permison_module.id=permison_form.module_id  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function permison_form_insert($obj)
{
    return exe_query("insert into permison_form (module_id,name,url,action_count,dk_count,active,status,position) values ('$obj->module_id','$obj->name','$obj->url','$obj->action_count','$obj->dk_count','$obj->active','$obj->status','$obj->position')",'permison_form');
}
//
function permison_form_update($obj)
{
    return exe_query("update permison_form set module_id='$obj->module_id',name='$obj->name',url='$obj->url',action_count='$obj->action_count',dk_count='$obj->dk_count',active='$obj->active',status='$obj->status',position='$obj->position' where id=$obj->id",'permison_form');
}
//
function permison_form_delete($obj)
{
    return exe_query('delete from permison_form where id='.$obj->id,'permison_form');
}
//
function permison_form_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from permison_form '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
