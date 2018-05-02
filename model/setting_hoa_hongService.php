<?php
require_once DIR.'/model/setting_hoa_hong.php';
require_once DIR.'/model/sqlconnection.php';
//
function setting_hoa_hong_Get($command)
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
                $new_obj=new setting_hoa_hong($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'setting_hoa_hong');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new setting_hoa_hong($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function setting_hoa_hong_getById($id)
{
    return setting_hoa_hong_Get('select * from setting_hoa_hong where id='.$id);
}
//
function setting_hoa_hong_getByAll()
{
    return setting_hoa_hong_Get('select * from setting_hoa_hong');
}
//
function setting_hoa_hong_getByTop($top,$where,$order)
{
    return setting_hoa_hong_Get("select * from setting_hoa_hong ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function setting_hoa_hong_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return setting_hoa_hong_Get("SELECT * FROM  setting_hoa_hong ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function setting_hoa_hong_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return setting_hoa_hong_Get("SELECT setting_hoa_hong.id, setting_hoa_hong.hoa_hong_3, setting_hoa_hong.hoa_hong_4, setting_hoa_hong.hoa_hong_5, setting_hoa_hong.hoa_hong_dai_ly, setting_hoa_hong.hoa_hong_gt_f1, setting_hoa_hong.hoa_hong_gt_f2, setting_hoa_hong.hoa_hong_gt_f3, setting_hoa_hong.muc_4_don_hang, setting_hoa_hong.muc_4_thanh_vien, setting_hoa_hong.muc_5_don_hang, setting_hoa_hong.muc_5_thanh_vien_3, setting_hoa_hong.muc_5_thanh_vien_4 FROM  setting_hoa_hong ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function setting_hoa_hong_insert($obj)
{
    return exe_query("insert into setting_hoa_hong (hoa_hong_3,hoa_hong_4,hoa_hong_5,hoa_hong_dai_ly,hoa_hong_gt_f1,hoa_hong_gt_f2,hoa_hong_gt_f3,muc_4_don_hang,muc_4_thanh_vien,muc_5_don_hang,muc_5_thanh_vien_3,muc_5_thanh_vien_4) values ('$obj->hoa_hong_3','$obj->hoa_hong_4','$obj->hoa_hong_5','$obj->hoa_hong_dai_ly','$obj->hoa_hong_gt_f1','$obj->hoa_hong_gt_f2','$obj->hoa_hong_gt_f3','$obj->muc_4_don_hang','$obj->muc_4_thanh_vien','$obj->muc_5_don_hang','$obj->muc_5_thanh_vien_3','$obj->muc_5_thanh_vien_4')",'setting_hoa_hong');
}
//
function setting_hoa_hong_update($obj)
{
    return exe_query("update setting_hoa_hong set hoa_hong_3='$obj->hoa_hong_3',hoa_hong_4='$obj->hoa_hong_4',hoa_hong_5='$obj->hoa_hong_5',hoa_hong_dai_ly='$obj->hoa_hong_dai_ly',hoa_hong_gt_f1='$obj->hoa_hong_gt_f1',hoa_hong_gt_f2='$obj->hoa_hong_gt_f2',hoa_hong_gt_f3='$obj->hoa_hong_gt_f3',muc_4_don_hang='$obj->muc_4_don_hang',muc_4_thanh_vien='$obj->muc_4_thanh_vien',muc_5_don_hang='$obj->muc_5_don_hang',muc_5_thanh_vien_3='$obj->muc_5_thanh_vien_3',muc_5_thanh_vien_4='$obj->muc_5_thanh_vien_4' where id=$obj->id",'setting_hoa_hong');
}
//
function setting_hoa_hong_delete($obj)
{
    return exe_query('delete from setting_hoa_hong where id='.$obj->id,'setting_hoa_hong');
}
//
function setting_hoa_hong_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from setting_hoa_hong '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
