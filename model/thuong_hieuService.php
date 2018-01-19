<?php
require_once DIR.'/model/thuong_hieu.php';
require_once DIR.'/model/sqlconnection.php';
//
function thuong_hieu_Get($command)
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
                $new_obj=new thuong_hieu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'thuong_hieu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new thuong_hieu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function thuong_hieu_getById($id)
{
    return thuong_hieu_Get('select * from thuong_hieu where id='.$id);
}
//
function thuong_hieu_getByAll()
{
    return thuong_hieu_Get('select * from thuong_hieu');
}
//
function thuong_hieu_getByTop($top,$where,$order)
{
    return thuong_hieu_Get("select * from thuong_hieu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function thuong_hieu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return thuong_hieu_Get("SELECT * FROM  thuong_hieu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thuong_hieu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return thuong_hieu_Get("SELECT thuong_hieu.id, thuong_hieu.active, thuong_hieu.name, thuong_hieu.logo, thuong_hieu.icon, thuong_hieu.banner, thuong_hieu.link_banner, thuong_hieu.banner_qc, thuong_hieu.link_banner_qc, thuong_hieu.link_khoi_hanh, thuong_hieu.email, thuong_hieu.mat_khau_ung_dung, thuong_hieu.chu_ky_email FROM  thuong_hieu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thuong_hieu_insert($obj)
{
    return exe_query("insert into thuong_hieu (active,name,logo,icon,banner,link_banner,banner_qc,link_banner_qc,link_khoi_hanh,email,mat_khau_ung_dung,chu_ky_email) values ('$obj->active','$obj->name','$obj->logo','$obj->icon','$obj->banner','$obj->link_banner','$obj->banner_qc','$obj->link_banner_qc','$obj->link_khoi_hanh','$obj->email','$obj->mat_khau_ung_dung','$obj->chu_ky_email')",'thuong_hieu');
}
//
function thuong_hieu_update($obj)
{
    return exe_query("update thuong_hieu set active='$obj->active',name='$obj->name',logo='$obj->logo',icon='$obj->icon',banner='$obj->banner',link_banner='$obj->link_banner',banner_qc='$obj->banner_qc',link_banner_qc='$obj->link_banner_qc',link_khoi_hanh='$obj->link_khoi_hanh',email='$obj->email',mat_khau_ung_dung='$obj->mat_khau_ung_dung',chu_ky_email='$obj->chu_ky_email' where id=$obj->id",'thuong_hieu');
}
//
function thuong_hieu_delete($obj)
{
    return exe_query('delete from thuong_hieu where id='.$obj->id,'thuong_hieu');
}
//
function thuong_hieu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from thuong_hieu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
