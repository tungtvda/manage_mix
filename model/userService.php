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
    return user_Get('select user.id, user.truong_phong_id, user.name, user.user_role,user.type_tiep_thi,user.user_gioi_thieu, user.permison_module, user.permison_form, user.permison_action, user.mr,user.hoa_hong, user.address, user.phone, user.mobi, user.user_name, user.user_code, user.user_email, user.password, user.login_two_steps, user.code_login, user.phong_ban, user.chuc_vu, user.nganh_nghe, user.gender,DATE_FORMAT(user.birthday,\'%d-%m-%Y\') as birthday , user.avatar, user.guides, user.guide_card_number, user.tax_code, user.cmnd, user.date_range_cmnd, user.issued_by_cmnd, user.number_passport, user.date_range_passport, user.issued_by_passport, user.expiration_date_passport, user.dan_toc, user.ho_khau_tt, user.hon_nhan, user.bang_cap, user.language, user.account_number_bank, user.bank, user.open_bank, user.religion, user.note, user.status, user.created, user.token_code, user.time_token, user.updated, user.updated_by, user.created_by, user.skype , user.facebook , DATE_FORMAT(user.ngay_lam_viec,\'%d-%m-%Y\') as ngay_lam_viec, DATE_FORMAT(user.ngay_chinh_thuc,\'%d-%m-%Y\') as ngay_chinh_thuc  from user where id='.$id);
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
    return user_Get("SELECT user.id, user.truong_phong_id, user.name, user.user_role,user.type_tiep_thi,user.user_gioi_thieu, user.permison_module, user.permison_form, user.permison_action, user.mr, user.hoa_hong, user.address, user.phone, user.mobi, user.user_name, user.user_code, user.user_email, user.password, user.login_two_steps, user.code_login, user.phong_ban, user.chuc_vu, user.nganh_nghe, user.gender,DATE_FORMAT(user.birthday,'%d-%m-%Y') as birthday , user.avatar, user.guides, user.guide_card_number, user.tax_code, user.cmnd, user.date_range_cmnd, user.issued_by_cmnd, user.number_passport, user.date_range_passport, user.issued_by_passport, user.expiration_date_passport, user.dan_toc, user.ho_khau_tt, user.hon_nhan, user.bang_cap, user.language, user.account_number_bank, user.bank, user.open_bank, user.religion, user.note, user.status, user.created, user.token_code, user.time_token, user.memori_login, user.updated, user.updated_by, user.created_by, user.skype , user.facebook , DATE_FORMAT(user.ngay_lam_viec,'%d-%m-%Y') as ngay_lam_viec, DATE_FORMAT(user.ngay_chinh_thuc,'%d-%m-%Y') as ngay_chinh_thuc FROM  user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_insert($obj)
{
    return exe_query("insert into user (truong_phong_id,name,user_role,type_tiep_thi,user_gioi_thieu,permison_module,permison_form,permison_action,mr,hoa_hong,address,phone,mobi,user_name,user_code,user_email,password,login_two_steps,code_login,phong_ban,chuc_vu,nganh_nghe,gender,birthday,avatar,guides,guide_card_number,tax_code,cmnd,date_range_cmnd,issued_by_cmnd,number_passport,date_range_passport,issued_by_passport,expiration_date_passport,dan_toc,ho_khau_tt,hon_nhan,bang_cap,language,account_number_bank,bank,open_bank,religion,note,status,created,token_code,time_token, memori_login,updated, updated_by, created_by, skype,facebook, ngay_lam_viec, ngay_chinh_thuc) values ('$obj->truong_phong_id','$obj->name','$obj->user_role','$obj->type_tiep_thi','$obj->user_gioi_thieu','$obj->permison_module','$obj->permison_form','$obj->permison_action','$obj->mr','$obj->hoa_hong','$obj->address','$obj->phone','$obj->mobi','$obj->user_name','$obj->user_code','$obj->user_email','$obj->password','$obj->login_two_steps','$obj->code_login','$obj->phong_ban','$obj->chuc_vu','$obj->nganh_nghe','$obj->gender','$obj->birthday','$obj->avatar','$obj->guides','$obj->guide_card_number','$obj->tax_code','$obj->cmnd','$obj->date_range_cmnd','$obj->issued_by_cmnd','$obj->number_passport','$obj->date_range_passport','$obj->issued_by_passport','$obj->expiration_date_passport','$obj->dan_toc','$obj->ho_khau_tt','$obj->hon_nhan','$obj->bang_cap','$obj->language','$obj->account_number_bank','$obj->bank','$obj->open_bank','$obj->religion','$obj->note','$obj->status','$obj->created','$obj->token_code','$obj->time_token','$obj->memori_login','$obj->updated','$obj->updated_by','$obj->created_by','$obj->skype','$obj->facebook','$obj->ngay_lam_viec','$obj->ngay_chinh_thuc')",'user');
}
//
function user_update($obj)
{
    return exe_query("update user set truong_phong_id='$obj->truong_phong_id', name='$obj->name',user_role='$obj->user_role',type_tiep_thi='$obj->type_tiep_thi',user_gioi_thieu='$obj->user_gioi_thieu',permison_module='$obj->permison_module',permison_form='$obj->permison_form',permison_action='$obj->permison_action',mr='$obj->mr',hoa_hong='$obj->hoa_hong',address='$obj->address',phone='$obj->phone',mobi='$obj->mobi',user_name='$obj->user_name',user_code='$obj->user_code',user_email='$obj->user_email',password='$obj->password',login_two_steps='$obj->login_two_steps',code_login='$obj->code_login',phong_ban='$obj->phong_ban',chuc_vu='$obj->chuc_vu',nganh_nghe='$obj->nganh_nghe',gender='$obj->gender',birthday='$obj->birthday',avatar='$obj->avatar',guides='$obj->guides',guide_card_number='$obj->guide_card_number',tax_code='$obj->tax_code',cmnd='$obj->cmnd',date_range_cmnd='$obj->date_range_cmnd',issued_by_cmnd='$obj->issued_by_cmnd',number_passport='$obj->number_passport',date_range_passport='$obj->date_range_passport',issued_by_passport='$obj->issued_by_passport',expiration_date_passport='$obj->expiration_date_passport',dan_toc='$obj->dan_toc',ho_khau_tt='$obj->ho_khau_tt',hon_nhan='$obj->hon_nhan',bang_cap='$obj->bang_cap',language='$obj->language',account_number_bank='$obj->account_number_bank',bank='$obj->bank',open_bank='$obj->open_bank',religion='$obj->religion',note='$obj->note',status='$obj->status',created='$obj->created',token_code='$obj->token_code',time_token='$obj->time_token',memori_login='$obj->memori_login',updated='$obj->updated',updated_by='$obj->updated_by',created_by='$obj->created_by',skype='$obj->skype',facebook='$obj->facebook',ngay_lam_viec='$obj->ngay_lam_viec',ngay_chinh_thuc='$obj->ngay_chinh_thuc' where id=$obj->id",'user');
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
function user_update_login_two_steps($obj)
{
    return exe_query("update user set login_two_steps='$obj->login_two_steps' where id=$obj->id",'user');
}

function userAll($where){
    $query="select bk.*, us.name as name_user, us.user_role as type_user, us.user_code, ";
    $query.="  us_tt.name as name_user_tt, us_tt.user_role as type_user_tt, us_tt.user_code as user_code_tt ,";
    $query.="  us_cr.name as name_user_cr, us_cr.user_role as type_user_cr, us_cr.user_code as user_code_cr ";
    $query.=" FROM booking bk ";
    $query.=" LEFT JOIN user us on bk.user_id = us.id";
    $query.=" LEFT JOIN user us_tt on us_tt.id=bk.user_tiep_thi_id";
    $query.=" LEFT JOIN user us_cr on bk.created_by = us_cr.id";
    if($where!=''){
        $query.=' where '.$where;
    }
    $query.=" ORDER BY id desc";
    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    if($result!=false)while($row=mysqli_fetch_array($result))
    {
        $new_obj=new booking($row);
        $new_obj->name_user=$row['name_user'];
        $new_obj->type_user=$row['type_user'];
        $new_obj->user_code=$row['user_code'];

        $new_obj->name_user_tt=$row['name_user_tt'];
        $new_obj->type_user_tt=$row['type_user_tt'];
        $new_obj->user_code_tt=$row['user_code_tt'];

        $new_obj->name_user_cr=$row['name_user_cr'];
        $new_obj->type_user_cr=$row['type_user_cr'];
        $new_obj->user_code_cr=$row['user_code_cr'];

        $new_obj->decode();
        array_push($array_result,$new_obj);
    }
    return $array_result;
}
function user_getByTopCustomField($file='*',$top,$where,$order)
{
    return user_Get("select ".$file." from user ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}

function user_az_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
    $query="
SELECT us.* ,
us1.id as user_id_1,us1.name as name_user_1, us1.user_role as type_user_1, us1.user_code as user_code_1, us1.phone as user_phone_1,
us2.id as user_id_2,us2.name as name_user_2, us2.user_role as type_user_2, us2.user_code as user_code_2, us2.phone as user_phone_2
FROM  
user as us
LEFT JOIN user us1 on us.user_gioi_thieu = us1.id
LEFT JOIN user us2 on us1.user_gioi_thieu = us2.id
".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize;

    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    if($result!=false)while($row=mysqli_fetch_array($result))
    {

        $new_obj=new user($row);
        if($new_obj->avatar=="")
        {
            $avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
        }
        else{
            $avatar=SITE_NAME.$new_obj->avatar;
        }
        $item=array(
            'name'=>$new_obj->name,
            'user_email'=>$new_obj->user_email,
            'avatar'=>$avatar,
            'phone'=>$new_obj->phone,
            'status'=>$new_obj->status,
            'type_tiep_thi'=>$new_obj->type_tiep_thi,
            'mobi'=>$new_obj->mobi,
            'address'=>$new_obj->address,
            'skype'=>$new_obj->skype,
            'facebook'=>$new_obj->facebook,
            'created'=>$new_obj->created,
            'user_id_1'=>$row['user_id_1'],
            'type_user_1'=>$row['type_user_1'],
            'name_user_1'=>$row['name_user_1'],
            'user_code_1'=>$row['user_code_1'],
            'user_phone_1'=>$row['user_phone_1'],
            'user_id_2'=>$row['user_id_2'],
            'type_user_2'=>$row['type_user_2'],
            'name_user_2'=>$row['name_user_2'],
            'user_code_2'=>$row['user_code_2'],
            'user_phone_2'=>$row['user_phone_2'],
        );
        array_push($array_result,$item);
    }
    return $array_result;
}