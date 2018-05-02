<?php
require_once DIR.'/model/rut_tien.php';
require_once DIR.'/model/sqlconnection.php';
//
function rut_tien_Get($command)
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
                $new_obj=new rut_tien($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'rut_tien');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new rut_tien($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function rut_tien_getById($id)
{
    return rut_tien_Get('select * from rut_tien where id='.$id);
}
//
function rut_tien_getByAll()
{
    return rut_tien_Get('select * from rut_tien');
}
//
function rut_tien_getByTop($top,$where,$order)
{
    return rut_tien_Get("select * from rut_tien ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function rut_tien_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return rut_tien_Get("SELECT * FROM  rut_tien ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function rut_tien_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return rut_tien_Get("SELECT rut_tien.id, rut_tien.code, rut_tien.user_tiep_thi_id, rut_tien.admin_confirm_id, rut_tien.name, rut_tien.price, rut_tien.price_confirm, rut_tien.status, rut_tien.yeu_cau, rut_tien.yeu_cau_confirm, rut_tien.date_send, rut_tien.date_confirm FROM  rut_tien ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function rut_tien_insert($obj)
{
    return exe_query("insert into rut_tien (code,user_tiep_thi_id,admin_confirm_id,name,price,price_confirm,status,yeu_cau,yeu_cau_confirm,date_send,date_confirm) values ('$obj->code','$obj->user_tiep_thi_id','$obj->admin_confirm_id','$obj->name','$obj->price','$obj->price_confirm','$obj->status','$obj->yeu_cau','$obj->yeu_cau_confirm','$obj->date_send','$obj->date_confirm')",'rut_tien');
}
//
function rut_tien_update($obj)
{
    return exe_query("update rut_tien set code='$obj->code',user_tiep_thi_id='$obj->user_tiep_thi_id',admin_confirm_id='$obj->admin_confirm_id',name='$obj->name',price='$obj->price',price_confirm='$obj->price_confirm',status='$obj->status',yeu_cau='$obj->yeu_cau',yeu_cau_confirm='$obj->yeu_cau_confirm',date_send='$obj->date_send',date_confirm='$obj->date_confirm' where id=$obj->id",'rut_tien');
}
//
function rut_tien_delete($obj)
{
    return exe_query('delete from rut_tien where id='.$obj->id,'rut_tien');
}
//
function rut_tien_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from rut_tien '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}

function ruttienAllDongHang($where){
    $query="select rt.*, us.name as name_user, us.user_role as type_user, us.user_code,us.address, us.avatar as avatar_tt,us.user_email,us.phone, us.mobi, us.account_number_bank, us.bank, us.open_bank,";
    $query.="  us_cr.name as name_user_cr, us_cr.user_role as type_user_cr, us_cr.user_code as user_code_cr  ";
    $query.=" FROM rut_tien rt ";
    $query.=" INNER JOIN user us on rt.user_tiep_thi_id = us.id";
    $query.=" LEFT JOIN user us_cr on rt.admin_confirm_id = us_cr.id";
    if($where!=''){
        $query.=' where '.$where;
    }
    $query.=" ORDER BY id desc";
    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    if($result!=false)while($row=mysqli_fetch_array($result))
    {
        $new_obj=new rut_tien($row);
        $new_obj->name_user=$row['name_user'];
        $new_obj->type_user=$row['type_user'];
        $new_obj->user_code=$row['user_code'];
        $new_obj->avatar_tt=$row['avatar_tt'];
        $new_obj->user_email=$row['user_email'];
        $new_obj->address=$row['address'];
        $new_obj->phone=$row['phone'];
        $new_obj->mobi=$row['mobi'];
        $new_obj->account_number_bank=$row['account_number_bank'];
        $new_obj->bank=$row['bank'];
        $new_obj->open_bank=$row['open_bank'];

        $new_obj->name_user_cr=$row['name_user_cr'];
        $new_obj->type_user_cr=$row['type_user_cr'];
        $new_obj->user_code_cr=$row['user_code_cr'];

        $new_obj->decode();
        array_push($array_result,$new_obj);
    }
    return $array_result;
}

