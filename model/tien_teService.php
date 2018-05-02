<?php
require_once DIR.'/model/tien_te.php';
require_once DIR.'/model/sqlconnection.php';
//
function tien_te_Get($command)
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
                $new_obj=new tien_te($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'tien_te');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new tien_te($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function tien_te_getById($id)
{
    return tien_te_Get('select * from tien_te where id='.$id);
}
//
function tien_te_getByAll()
{
    return tien_te_Get('select * from tien_te');
}
//
function tien_te_getByTop($top,$where,$order)
{
    return tien_te_Get("select * from tien_te ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function tien_te_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return tien_te_Get("SELECT * FROM  tien_te ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tien_te_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return tien_te_Get("SELECT tien_te.id, tien_te.name, tien_te.value, tien_te.position FROM  tien_te ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tien_te_insert($obj)
{
    return exe_query("insert into tien_te (name,value,position) values ('$obj->name','$obj->value','$obj->position')",'tien_te');
}
//
function tien_te_update($obj)
{
    return exe_query("update tien_te set name='$obj->name',value='$obj->value',position='$obj->position' where id=$obj->id",'tien_te');
}
//
function tien_te_delete($obj)
{
    return exe_query('delete from tien_te where id='.$obj->id,'tien_te');
}
//
function tien_te_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from tien_te '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
