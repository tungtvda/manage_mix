<?php
require_once DIR.'/model/tour_list_dichvu.php';
require_once DIR.'/model/sqlconnection.php';
//
function tour_list_dichvu_Get($command)
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
                $new_obj=new tour_list_dichvu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'tour_list_dichvu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new tour_list_dichvu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function tour_list_dichvu_getById($id)
{
    return tour_list_dichvu_Get('select * from tour_list_dichvu where id='.$id);
}
//
function tour_list_dichvu_getByAll()
{
    return tour_list_dichvu_Get('select * from tour_list_dichvu');
}
//
function tour_list_dichvu_getByTop($top,$where,$order)
{
    return tour_list_dichvu_Get("select * from tour_list_dichvu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function tour_list_dichvu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return tour_list_dichvu_Get("SELECT * FROM  tour_list_dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tour_list_dichvu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return tour_list_dichvu_Get("SELECT tour_list_dichvu.id, tour.name as tour_id, tour_list_dichvu.name, tour_list_dichvu.type, tour_list_dichvu.price, tour_list_dichvu.number, tour_list_dichvu.total, tour_list_dichvu.note FROM  tour_list_dichvu, tour where tour.id=tour_list_dichvu.tour_id  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tour_list_dichvu_insert($obj)
{
    return exe_query("insert into tour_list_dichvu (tour_id,name,type,price,number,total,note) values ('$obj->tour_id','$obj->name','$obj->type','$obj->price','$obj->number','$obj->total','$obj->note')",'tour_list_dichvu');
}
//
function tour_list_dichvu_update($obj)
{
    return exe_query("update tour_list_dichvu set tour_id='$obj->tour_id',name='$obj->name',type='$obj->type',price='$obj->price',number='$obj->number',total='$obj->total',note='$obj->note' where id=$obj->id",'tour_list_dichvu');
}
//
function tour_list_dichvu_delete($obj)
{
    return exe_query('delete from tour_list_dichvu where id='.$obj->id,'tour_list_dichvu');
}
//
function tour_list_dichvu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from tour_list_dichvu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
