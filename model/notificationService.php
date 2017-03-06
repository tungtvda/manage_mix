<?php
require_once DIR.'/model/notification.php';
require_once DIR.'/model/sqlconnection.php';
//
function notification_Get($command)
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
                $new_obj=new notification($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'notification');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new notification($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function notification_getById($id)
{
    return notification_Get('select * from notification where id='.$id);
}
//
function notification_getByAll()
{
    return notification_Get('select * from notification');
}
//
function notification_getByTop($top,$where,$order)
{
    return notification_Get("select * from notification ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function notification_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return notification_Get("SELECT * FROM  notification ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function notification_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return notification_Get("SELECT notification.id, notification.user_id, notification.user_send_id, notification.name, notification.link, notification.status, notification.content, notification.created FROM  notification ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function notification_insert($obj)
{
    return exe_query("insert into notification (user_id,user_send_id,name,link,status,content,created) values ('$obj->user_id','$obj->user_send_id','$obj->name','$obj->link','$obj->status','$obj->content','$obj->created')",'notification');
}
//
function notification_update($obj)
{
    return exe_query("update notification set user_id='$obj->user_id',user_send_id='$obj->user_send_id',name='$obj->name',link='$obj->link',status='$obj->status',content='$obj->content',created='$obj->created' where id=$obj->id",'notification');
}
//
function notification_delete($obj)
{
    return exe_query('delete from notification where id='.$obj->id,'notification');
}
//
function notification_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from notification '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
