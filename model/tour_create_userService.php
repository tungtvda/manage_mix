<?php
require_once DIR.'/model/tour_create_user.php';
require_once DIR.'/model/sqlconnection.php';
//
function tour_create_user_Get($command)
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
                $new_obj=new tour_create_user($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'tour_create_user');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new tour_create_user($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function tour_create_user_getById($id)
{
    return tour_create_user_Get('select * from tour_create_user where id='.$id);
}
//
function tour_create_user_getByAll()
{
    return tour_create_user_Get('select * from tour_create_user');
}
//
function tour_create_user_getByTop($top,$where,$order)
{
    return tour_create_user_Get("select * from tour_create_user ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function tour_create_user_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return tour_create_user_Get("SELECT * FROM  tour_create_user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tour_create_user_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return tour_create_user_Get("SELECT tour_create_user.id, tour_create_user.user_id, tour_create_user.customer_id, tour_create_user.status, tour_create_user.name_cus, tour_create_user.email_cus, tour_create_user.phone_cus, tour_create_user.address_cus, tour_create_user.code_tour, tour_create_user.name_tour, tour_create_user.time_tour, tour_create_user.date_tour, tour_create_user.address_tour, tour_create_user.note_tour, tour_create_user.created, tour_create_user.updated FROM  tour_create_user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tour_create_user_insert($obj)
{
    return exe_query("insert into tour_create_user (user_id,customer_id,status,name_cus,email_cus,phone_cus,address_cus,code_tour,name_tour,time_tour,date_tour,address_tour,note_tour,created,updated) values ('$obj->user_id','$obj->customer_id','$obj->status','$obj->name_cus','$obj->email_cus','$obj->phone_cus','$obj->address_cus','$obj->code_tour','$obj->name_tour','$obj->time_tour','$obj->date_tour','$obj->address_tour','$obj->note_tour','$obj->created','$obj->updated')",'tour_create_user');
}
//
function tour_create_user_update($obj)
{
    return exe_query("update tour_create_user set user_id='$obj->user_id',customer_id='$obj->customer_id',status='$obj->status',name_cus='$obj->name_cus',email_cus='$obj->email_cus',phone_cus='$obj->phone_cus',address_cus='$obj->address_cus',code_tour='$obj->code_tour',name_tour='$obj->name_tour',time_tour='$obj->time_tour',date_tour='$obj->date_tour',address_tour='$obj->address_tour',note_tour='$obj->note_tour',created='$obj->created',updated='$obj->updated' where id=$obj->id",'tour_create_user');
}
//
function tour_create_user_delete($obj)
{
    return exe_query('delete from tour_create_user where id='.$obj->id,'tour_create_user');
}
//
function tour_create_user_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from tour_create_user '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}

function tourUserAllDongHang($where){
    $query="select ts.*, us.name as name_user, us.user_role as type_user, us.user_code ";
    $query.=" FROM tour_create_user ts ";
    $query.=" LEFT JOIN user us on ts.user_id = us.id";
    if($where!=''){
        $query.=' where '.$where;
    }
    $query.=" ORDER BY id desc";
    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    if($result!=false)while($row=mysqli_fetch_array($result))
    {
        $new_obj=new tour_create_user($row);
        $new_obj->name_user=$row['name_user'];
        $new_obj->type_user=$row['type_user'];
        $new_obj->user_code=$row['user_code'];
        $new_obj->decode();
        array_push($array_result,$new_obj);
    }
    return $array_result;
}
