<?php
require_once DIR.'/model/birthday_sms_email.php';
require_once DIR.'/model/sqlconnection.php';
//
function birthday_sms_email_Get($command)
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
                $new_obj=new birthday_sms_email($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'birthday_sms_email');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new birthday_sms_email($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function birthday_sms_email_getById($id)
{
    return birthday_sms_email_Get('select * from birthday_sms_email where id='.$id);
}
//
function birthday_sms_email_getByAll()
{
    return birthday_sms_email_Get('select * from birthday_sms_email');
}
//
function birthday_sms_email_getByTop($top,$where,$order)
{
    return birthday_sms_email_Get("select * from birthday_sms_email ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function birthday_sms_email_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return birthday_sms_email_Get("SELECT * FROM  birthday_sms_email ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function birthday_sms_email_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return birthday_sms_email_Get("SELECT birthday_sms_email.id, birthday_sms_email.user, birthday_sms_email.customer, birthday_sms_email.content_sms, birthday_sms_email.content_email, birthday_sms_email.status, birthday_sms_email.count_cus, birthday_sms_email.count_success_sms, birthday_sms_email.count_success_email, birthday_sms_email.cus_false_sms, birthday_sms_email.cus_false_email, birthday_sms_email.date_send, birthday_sms_email.created, birthday_sms_email.created_by FROM  birthday_sms_email ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function birthday_sms_email_insert($obj)
{
    return exe_query("insert into birthday_sms_email (user,customer,content_sms,content_email,status,count_cus,count_success_sms,count_success_email,cus_false_sms,cus_false_email,date_send,created,created_by) values ('$obj->user','$obj->customer','$obj->content_sms','$obj->content_email','$obj->status','$obj->count_cus','$obj->count_success_sms','$obj->count_success_email','$obj->cus_false_sms','$obj->cus_false_email','$obj->date_send','$obj->created','$obj->created_by')",'birthday_sms_email');
}
//
function birthday_sms_email_update($obj)
{
    return exe_query("update birthday_sms_email set user='$obj->user',customer='$obj->customer',content_sms='$obj->content_sms',content_email='$obj->content_email',status='$obj->status',count_cus='$obj->count_cus',count_success_sms='$obj->count_success_sms',count_success_email='$obj->count_success_email',cus_false_sms='$obj->cus_false_sms',cus_false_email='$obj->cus_false_email',date_send='$obj->date_send',created='$obj->created',created_by='$obj->created_by' where id=$obj->id",'birthday_sms_email');
}
//
function birthday_sms_email_delete($obj)
{
    return exe_query('delete from birthday_sms_email where id='.$obj->id,'birthday_sms_email');
}
//
function birthday_sms_email_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from birthday_sms_email '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
