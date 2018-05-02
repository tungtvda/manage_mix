<?php
require_once DIR.'/model/permison_action.php';
require_once DIR.'/model/sqlconnection.php';
//
function permison_action_Get($command)
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
                $new_obj=new permison_action($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'permison_action');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new permison_action($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function permison_action_getById($id)
{
    return permison_action_Get('select * from permison_action where id='.$id);
}
//
function permison_action_getByAll()
{
    return permison_action_Get('select * from permison_action');
}
//
function permison_action_getByTop($top,$where,$order)
{
    return permison_action_Get("select * from permison_action ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function permison_action_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return permison_action_Get("SELECT * FROM  permison_action ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function permison_action_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return permison_action_Get("SELECT permison_action.id, permison_action.name, permison_module.name as module_id, permison_form.name as form_id, permison_action.status, permison_action.position, permison_action.note FROM  permison_action, permison_module, permison_form where permison_module.id=permison_action.module_id and permison_form.id=permison_action.form_id  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function permison_action_insert($obj)
{
    return exe_query("insert into permison_action (name,module_id,form_id,status,position,note) values ('$obj->name','$obj->module_id','$obj->form_id','$obj->status','$obj->position','$obj->note')",'permison_action');
}
//
function permison_action_update($obj)
{
    return exe_query("update permison_action set name='$obj->name',module_id='$obj->module_id',form_id='$obj->form_id',status='$obj->status',position='$obj->position',note='$obj->note' where id=$obj->id",'permison_action');
}
//
function permison_action_delete($obj)
{
    return exe_query('delete from permison_action where id='.$obj->id,'permison_action');
}
//
function permison_action_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from permison_action '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
