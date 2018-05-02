<?php
require_once DIR.'/model/danhmuc_2.php';
require_once DIR.'/model/sqlconnection.php';
//
function danhmuc_2_Get($command)
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
                $new_obj=new danhmuc_2($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'danhmuc_2');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new danhmuc_2($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function danhmuc_2_getById($id)
{
    return danhmuc_2_Get('select * from danhmuc_2 where id='.$id);
}
//
function danhmuc_2_getByAll()
{
    return danhmuc_2_Get('select * from danhmuc_2');
}
//
function danhmuc_2_getByTop($top,$where,$order)
{
    return danhmuc_2_Get("select * from danhmuc_2 ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function danhmuc_2_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuc_2_Get("SELECT * FROM  danhmuc_2 ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuc_2_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuc_2_Get("SELECT danhmuc_2.id, danhmuc_1.name as danhmuc1_id, danhmuc_2.name, danhmuc_2.name_url, danhmuc_2.img, danhmuc_2.position,danhmuc_2.content_short, danhmuc_2.title, danhmuc_2.keyword, danhmuc_2.description FROM  danhmuc_2, danhmuc_1 where danhmuc_1.id=danhmuc_2.danhmuc1_id  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuc_2_insert($obj)
{
    return exe_query("insert into danhmuc_2 (danhmuc1_id,name,name_url,img,position,content_short,title,keyword,description) values ('$obj->danhmuc1_id','$obj->name','$obj->name_url','$obj->img','$obj->position','$obj->content_short','$obj->title','$obj->keyword','$obj->description')",'danhmuc_2');
}
//
function danhmuc_2_update($obj)
{
    return exe_query("update danhmuc_2 set danhmuc1_id='$obj->danhmuc1_id',name='$obj->name',name_url='$obj->name_url',img='$obj->img',position='$obj->position', content_short='$obj->content_short',title='$obj->title',keyword='$obj->keyword',description='$obj->description' where id=$obj->id",'danhmuc_2');
}
//
function danhmuc_2_delete($obj)
{
    return exe_query('delete from danhmuc_2 where id='.$obj->id,'danhmuc_2');
}
//
function danhmuc_2_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from danhmuc_2 '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
