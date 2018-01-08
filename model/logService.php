<?php
require_once DIR.'/model/log.php';
require_once DIR.'/model/sqlconnection.php';
//
function log_Get($command)
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
                $new_obj=new log($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'log');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new log($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function log_getById($id)
{
    return log_Get('select * from log where id='.$id);
}
//
function log_getByAll()
{
    return log_Get('select * from log');
}
//
function log_getByTop($top,$where,$order)
{
    return log_Get("select * from log ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function log_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return log_Get("SELECT * FROM  log ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function log_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return log_Get("SELECT log.id, log.user_id, log.module_id, log.form_id, log.action_id, log.item_id, log.value_old, log.value_new, log.description, log.created FROM  log ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function log_insert($obj)
{
    return exe_query("insert into log (user_id,module_id,form_id,action_id,item_id,value_old,value_new,description,created) values ('$obj->user_id','$obj->module_id','$obj->form_id','$obj->action_id','$obj->item_id','$obj->value_old','$obj->value_new','$obj->description','$obj->created')",'log');
}
//
function log_update($obj)
{
    return exe_query("update log set user_id='$obj->user_id',module_id='$obj->module_id',form_id='$obj->form_id',action_id='$obj->action_id',item_id='$obj->item_id',value_old='$obj->value_old',value_new='$obj->value_new',description='$obj->description',created='$obj->created' where id=$obj->id",'log');
}
//
function log_delete($obj)
{
    return exe_query('delete from log where id='.$obj->id,'log');
}
//
function log_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from log '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
