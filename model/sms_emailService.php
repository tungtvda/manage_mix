<?php
require_once DIR.'/model/sms_email.php';
require_once DIR.'/model/sqlconnection.php';
//
function sms_email_Get($command)
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
                $new_obj=new sms_email($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'sms_email');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new sms_email($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function sms_email_getById($id)
{
    return sms_email_Get('select * from sms_email where id='.$id);
}
//
function sms_email_getByAll()
{
    return sms_email_Get('select * from sms_email');
}
//
function sms_email_getByTop($top,$where,$order)
{
    return sms_email_Get("select * from sms_email ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function sms_email_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return sms_email_Get("SELECT * FROM  sms_email ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function sms_email_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return sms_email_Get("SELECT sms_email.id, sms_email.code, sms_email.type, sms_email.user, sms_email.customer, sms_email.title_sms, sms_email.title_email, sms_email.content_sms, sms_email.content_email, sms_email.status, sms_email.count_cus, sms_email.count_success_sms, sms_email.count_success_email, sms_email.cus_false_sms, sms_email.cus_false_email, sms_email.date_send, sms_email.created, sms_email.created_by FROM  sms_email ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function sms_email_insert($obj)
{
    return exe_query("insert into sms_email (code,type,user,customer,title_sms,title_email,content_sms,content_email,status,count_cus,count_success_sms,count_success_email,cus_false_sms,cus_false_email,date_send,created,created_by) values ('$obj->code','$obj->type','$obj->user','$obj->customer','$obj->title_sms','$obj->title_email','$obj->content_sms','$obj->content_email','$obj->status','$obj->count_cus','$obj->count_success_sms','$obj->count_success_email','$obj->cus_false_sms','$obj->cus_false_email','$obj->date_send','$obj->created','$obj->created_by')",'sms_email');
}
//
function sms_email_update($obj)
{
    return exe_query("update sms_email set code='$obj->code',type='$obj->type',user='$obj->user',customer='$obj->customer',title_sms='$obj->title_sms',title_email='$obj->title_email',content_sms='$obj->content_sms',content_email='$obj->content_email',status='$obj->status',count_cus='$obj->count_cus',count_success_sms='$obj->count_success_sms',count_success_email='$obj->count_success_email',cus_false_sms='$obj->cus_false_sms',cus_false_email='$obj->cus_false_email',date_send='$obj->date_send',created='$obj->created',created_by='$obj->created_by' where id=$obj->id",'sms_email');
}
//
function sms_email_delete($obj)
{
    return exe_query('delete from sms_email where id='.$obj->id,'sms_email');
}
//
function sms_email_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from sms_email '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
