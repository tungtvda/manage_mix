<?php
require_once DIR.'/model/user.php';
require_once DIR.'/model/sqlconnection.php';
//
function user_Get($command)
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
                $new_obj=new user($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'user');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new user($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function user_getById($id)
{
    return user_Get('select user.id, user.name, user.user_role, user.permison_module, user.permison_form, user.permison_action, user.mr, user.address, user.phone, user.mobi, user.user_name, user.user_code, user.user_email, user.password, user.login_two_steps, user.code_login, user.phong_ban, user.chuc_vu, user.nganh_nghe, user.gender,DATE_FORMAT(user.birthday,\'%d-%m-%Y\') as birthday , user.avatar, user.guides, user.guide_card_number, user.tax_code, user.cmnd, user.date_range_cmnd, user.issued_by_cmnd, user.number_passport, user.date_range_passport, user.issued_by_passport, user.expiration_date_passport, user.dan_toc, user.ho_khau_tt, user.hon_nhan, user.bang_cap, user.language, user.account_number_bank, user.bank, user.open_bank, user.religion, user.note, user.status, user.created, user.token_code, user.time_token, user.updated, user.updated_by, user.created_by from user where id='.$id);
}
//
function user_getByAll()
{
    return user_Get('select * from user');
}
//
function user_getByTop($top,$where,$order)
{
    return user_Get("select * from user ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function user_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return user_Get("SELECT * FROM  user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return user_Get("SELECT user.id, user.name, user.user_role, user.permison_module, user.permison_form, user.permison_action, user.mr, user.address, user.phone, user.mobi, user.user_name, user.user_code, user.user_email, user.password, user.login_two_steps, user.code_login, user.phong_ban, user.chuc_vu, user.nganh_nghe, user.gender,DATE_FORMAT(user.birthday,'%d-%m-%Y') as birthday , user.avatar, user.guides, user.guide_card_number, user.tax_code, user.cmnd, user.date_range_cmnd, user.issued_by_cmnd, user.number_passport, user.date_range_passport, user.issued_by_passport, user.expiration_date_passport, user.dan_toc, user.ho_khau_tt, user.hon_nhan, user.bang_cap, user.language, user.account_number_bank, user.bank, user.open_bank, user.religion, user.note, user.status, user.created, user.token_code, user.time_token, user.updated, user.updated_by, user.created_by FROM  user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_insert($obj)
{
    return exe_query("insert into user (name,user_role,permison_module,permison_form,permison_action,mr,address,phone,mobi,user_name,user_code,user_email,password,login_two_steps,code_login,phong_ban,chuc_vu,nganh_nghe,gender,birthday,avatar,guides,guide_card_number,tax_code,cmnd,date_range_cmnd,issued_by_cmnd,number_passport,date_range_passport,issued_by_passport,expiration_date_passport,dan_toc,ho_khau_tt,hon_nhan,bang_cap,language,account_number_bank,bank,open_bank,religion,note,status,created,token_code,time_token,updated, updated_by, created_by) values ('$obj->name','$obj->user_role','$obj->permison_module','$obj->permison_form','$obj->permison_action','$obj->mr','$obj->address','$obj->phone','$obj->mobi','$obj->user_name','$obj->user_code','$obj->user_email','$obj->password','$obj->login_two_steps','$obj->code_login','$obj->phong_ban','$obj->chuc_vu','$obj->nganh_nghe','$obj->gender','$obj->birthday','$obj->avatar','$obj->guides','$obj->guide_card_number','$obj->tax_code','$obj->cmnd','$obj->date_range_cmnd','$obj->issued_by_cmnd','$obj->number_passport','$obj->date_range_passport','$obj->issued_by_passport','$obj->expiration_date_passport','$obj->dan_toc','$obj->ho_khau_tt','$obj->hon_nhan','$obj->bang_cap','$obj->language','$obj->account_number_bank','$obj->bank','$obj->open_bank','$obj->religion','$obj->note','$obj->status','$obj->created','$obj->token_code','$obj->time_token','$obj->updated','$obj->updated_by','$obj->created_by')",'user');
}
//
function user_update($obj)
{
    return exe_query("update user set name='$obj->name',user_role='$obj->user_role',permison_module='$obj->permison_module',permison_form='$obj->permison_form',permison_action='$obj->permison_action',mr='$obj->mr',address='$obj->address',phone='$obj->phone',mobi='$obj->mobi',user_name='$obj->user_name',user_code='$obj->user_code',user_email='$obj->user_email',password='$obj->password',login_two_steps='$obj->login_two_steps',code_login='$obj->code_login',phong_ban='$obj->phong_ban',chuc_vu='$obj->chuc_vu',nganh_nghe='$obj->nganh_nghe',gender='$obj->gender',birthday='$obj->birthday',avatar='$obj->avatar',guides='$obj->guides',guide_card_number='$obj->guide_card_number',tax_code='$obj->tax_code',cmnd='$obj->cmnd',date_range_cmnd='$obj->date_range_cmnd',issued_by_cmnd='$obj->issued_by_cmnd',number_passport='$obj->number_passport',date_range_passport='$obj->date_range_passport',issued_by_passport='$obj->issued_by_passport',expiration_date_passport='$obj->expiration_date_passport',dan_toc='$obj->dan_toc',ho_khau_tt='$obj->ho_khau_tt',hon_nhan='$obj->hon_nhan',bang_cap='$obj->bang_cap',language='$obj->language',account_number_bank='$obj->account_number_bank',bank='$obj->bank',open_bank='$obj->open_bank',religion='$obj->religion',note='$obj->note',status='$obj->status',created='$obj->created',token_code='$obj->token_code',time_token='$obj->time_token',updated='$obj->updated',updated_by='$obj->updated_by',created_by='$obj->created_by' where id=$obj->id",'user');
}
//
function user_delete($obj)
{
    return exe_query('delete from user where id='.$obj->id,'user');
}
//
function user_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from user '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}

// custom code
function user_update_code_login($obj)
{
    return exe_query("update user set code_login='$obj->code_login' where id=$obj->id",'user');
}
function user_update_time_login($obj)
{
    return exe_query("update user set time_token='$obj->time_token' where id=$obj->id",'user');
}
function user_update_password($obj)
{
    return exe_query("update user set password='$obj->password' where id=$obj->id",'user');
}
function user_update_status($obj)
{
    return exe_query("update user set status='$obj->status' where id=$obj->id",'user');
}
function user_update_quyen($obj)
{
    return exe_query("update user set permison_module='$obj->permison_module', permison_form='$obj->permison_form',permison_action='$obj->permison_action' where id=$obj->id",'user');
}
function user_update_role($obj)
{
    return exe_query("update user set user_role='$obj->user_role' where id=$obj->id",'user');
}