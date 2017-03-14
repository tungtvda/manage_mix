<?php
require_once DIR.'/model/customer.php';
require_once DIR.'/model/sqlconnection.php';
//
function customer_Get($command)
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
                $new_obj=new customer($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'customer');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new customer($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function customer_getById($id)
{
    return customer_Get('select * from customer where id='.$id);
}
//
function customer_getByAll()
{
    return customer_Get('select * from customer');
}
//
function customer_getByTop($top,$where,$order)
{
    return customer_Get("select * from customer ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function customer_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return customer_Get("SELECT * FROM  customer ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return customer_Get("SELECT customer.id, customer.name, customer.mr, customer.avatar, customer.code, customer.category, customer.company_name, customer.director_name, customer.address, customer.phone, customer.mobi, customer.fax, customer.email, customer.company_email, customer.skype, customer.facebook, customer.customer_group, customer.resources_to, customer.chuc_vu, customer.phong_ban, customer.nganh_nghe, customer.account_number_bank, customer.bank, customer.open_bank, customer.birthday, customer.cmnd, customer.date_range_cmnd, customer.issued_by_cmnd, customer.number_passport, customer.date_range_passport, customer.issued_by_passport, customer.expiration_date_passport, customer.gender, customer.status, customer.created, customer.updated, customer.created_by, customer.update_by, customer.note FROM  customer ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function customer_insert($obj)
{
    return exe_query("insert into customer (name,mr,avatar,code,category,company_name,director_name,address,phone,mobi,fax,email,company_email,skype,facebook,customer_group,resources_to,chuc_vu,phong_ban,nganh_nghe,account_number_bank,bank,open_bank,birthday,cmnd,date_range_cmnd,issued_by_cmnd,number_passport,date_range_passport,issued_by_passport,expiration_date_passport,gender,status,created,updated,created_by,update_by,note) values ('$obj->name','$obj->mr','$obj->avatar','$obj->code','$obj->category','$obj->company_name','$obj->director_name','$obj->address','$obj->phone','$obj->mobi','$obj->fax','$obj->email','$obj->company_email','$obj->skype','$obj->facebook','$obj->customer_group','$obj->resources_to','$obj->chuc_vu','$obj->phong_ban','$obj->nganh_nghe','$obj->account_number_bank','$obj->bank','$obj->open_bank','$obj->birthday','$obj->cmnd','$obj->date_range_cmnd','$obj->issued_by_cmnd','$obj->number_passport','$obj->date_range_passport','$obj->issued_by_passport','$obj->expiration_date_passport','$obj->gender','$obj->status','$obj->created','$obj->updated','$obj->created_by','$obj->update_by','$obj->note')",'customer');
}
//
function customer_update($obj)
{
    return exe_query("update customer set name='$obj->name',mr='$obj->mr',avatar='$obj->avatar',code='$obj->code',category='$obj->category',company_name='$obj->company_name',director_name='$obj->director_name',address='$obj->address',phone='$obj->phone',mobi='$obj->mobi',fax='$obj->fax',email='$obj->email',company_email='$obj->company_email',skype='$obj->skype',facebook='$obj->facebook',customer_group='$obj->customer_group',resources_to='$obj->resources_to',chuc_vu='$obj->chuc_vu',phong_ban='$obj->phong_ban',nganh_nghe='$obj->nganh_nghe',account_number_bank='$obj->account_number_bank',bank='$obj->bank',open_bank='$obj->open_bank',birthday='$obj->birthday',cmnd='$obj->cmnd',date_range_cmnd='$obj->date_range_cmnd',issued_by_cmnd='$obj->issued_by_cmnd',number_passport='$obj->number_passport',date_range_passport='$obj->date_range_passport',issued_by_passport='$obj->issued_by_passport',expiration_date_passport='$obj->expiration_date_passport',gender='$obj->gender',status='$obj->status',created='$obj->created',updated='$obj->updated',created_by='$obj->created_by',update_by='$obj->update_by',note='$obj->note' where id=$obj->id",'customer');
}
//
function customer_delete($obj)
{
    return exe_query('delete from customer where id='.$obj->id,'customer');
}
//
function customer_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from customer '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
function customer_update_booking($obj,$booking_id)
{
    return exe_query("update customer set booking_id='$obj->booking_id' where booking_id=$booking_id",'customer');
}
