<?php
require_once DIR.'/model/danhmuc_1.php';
require_once DIR.'/model/sqlconnection.php';
//
function danhmuc_1_Get($command)
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
                $new_obj=new danhmuc_1($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'danhmuc_1');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new danhmuc_1($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function danhmuc_1_getById($id)
{
    return danhmuc_1_Get('select * from danhmuc_1 where id='.$id);
}
//
function danhmuc_1_getByAll()
{
    return danhmuc_1_Get('select * from danhmuc_1');
}
//
function danhmuc_1_getByTop($top,$where,$order)
{
    return danhmuc_1_Get("select * from danhmuc_1 ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function danhmuc_1_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuc_1_Get("SELECT * FROM  danhmuc_1 ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuc_1_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuc_1_Get("SELECT danhmuc_1.id,danhmuc_1.tour_quoc_te, danhmuc_1.name, danhmuc_1.name_url, danhmuc_1.img, danhmuc_1.position, danhmuc_1.title, danhmuc_1.keyword, danhmuc_1.description FROM  danhmuc_1 ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuc_1_insert($obj)
{
    return exe_query("insert into danhmuc_1 (tour_quoc_te,name,name_url,img,position,title,keyword,description) values ('$obj->tour_quoc_te','$obj->name','$obj->name_url','$obj->img','$obj->position','$obj->title','$obj->keyword','$obj->description')",'danhmuc_1');
}
//
function danhmuc_1_update($obj)
{
    return exe_query("update danhmuc_1 set name='$obj->name',tour_quoc_te='$obj->tour_quoc_te',name_url='$obj->name_url',img='$obj->img',position='$obj->position',title='$obj->title',keyword='$obj->keyword',description='$obj->description' where id=$obj->id",'danhmuc_1');
}
//
function danhmuc_1_delete($obj)
{
    return exe_query('delete from danhmuc_1 where id='.$obj->id,'danhmuc_1');
}
//
function danhmuc_1_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from danhmuc_1 '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
