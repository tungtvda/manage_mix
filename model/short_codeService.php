<?php
require_once DIR.'/model/short_code.php';
require_once DIR.'/model/sqlconnection.php';
//
function short_code_Get($command)
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
                $new_obj=new short_code($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'short_code');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new short_code($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function short_code_getById($id)
{
    return short_code_Get('select * from short_code where id='.$id);
}
//
function short_code_getByAll()
{
    return short_code_Get('select * from short_code');
}
//
function short_code_getByTop($top,$where,$order)
{
    return short_code_Get("select * from short_code ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function short_code_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return short_code_Get("SELECT * FROM  short_code ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function short_code_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return short_code_Get("SELECT short_code.id, short_code.type, short_code.name, short_code.field, short_code.description, short_code.position FROM  short_code ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function short_code_insert($obj)
{
    return exe_query("insert into short_code (type,name,field,description,position) values ('$obj->type','$obj->name','$obj->field','$obj->description','$obj->position')",'short_code');
}
//
function short_code_update($obj)
{
    return exe_query("update short_code set type='$obj->type',name='$obj->name',field='$obj->field',description='$obj->description',position='$obj->position' where id=$obj->id",'short_code');
}
//
function short_code_delete($obj)
{
    return exe_query('delete from short_code where id='.$obj->id,'short_code');
}
//
function short_code_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from short_code '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
