<?php
require_once DIR.'/model/booking_tour_custom.php';
require_once DIR.'/model/sqlconnection.php';
//
function booking_tour_custom_Get($command)
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
                $new_obj=new booking_tour_custom($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'booking_tour_custom');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new booking_tour_custom($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function booking_tour_custom_getById($id)
{
    return booking_tour_custom_Get('select * from booking_tour_custom where id='.$id);
}
//
function booking_tour_custom_getByAll()
{
    return booking_tour_custom_Get('select * from booking_tour_custom');
}
//
function booking_tour_custom_getByTop($top,$where,$order)
{
    return booking_tour_custom_Get("select * from booking_tour_custom ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function booking_tour_custom_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return booking_tour_custom_Get("SELECT * FROM  booking_tour_custom ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_tour_custom_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return booking_tour_custom_Get("SELECT booking_tour_custom.id, booking_tour_custom.booking_id, booking_tour_custom.chuong_trinh, booking_tour_custom.chuong_trinh_price, booking_tour_custom.thoi_gian, booking_tour_custom.thoi_gian_price, booking_tour_custom.nguoi_lon, booking_tour_custom.tre_em, booking_tour_custom.tre_em_5, booking_tour_custom.so_nguoi_price, booking_tour_custom.khach_san, booking_tour_custom.khach_san_price, booking_tour_custom.ngay_khoi_hanh, booking_tour_custom.ngay_khoi_hanh_price, booking_tour_custom.hang_bay, booking_tour_custom.hang_bay_price, booking_tour_custom.khac, booking_tour_custom.khac_price, booking_tour_custom.note FROM  booking_tour_custom ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_tour_custom_insert($obj)
{
    return exe_query("insert into booking_tour_custom (booking_id,chuong_trinh,chuong_trinh_price,thoi_gian,thoi_gian_price,nguoi_lon,tre_em,tre_em_5,so_nguoi_price,khach_san,khach_san_price,ngay_khoi_hanh,ngay_khoi_hanh_price,hang_bay,hang_bay_price,khac,khac_price,note) values ('$obj->booking_id','$obj->chuong_trinh','$obj->chuong_trinh_price','$obj->thoi_gian','$obj->thoi_gian_price','$obj->nguoi_lon','$obj->tre_em','$obj->tre_em_5','$obj->so_nguoi_price','$obj->khach_san','$obj->khach_san_price','$obj->ngay_khoi_hanh','$obj->ngay_khoi_hanh_price','$obj->hang_bay','$obj->hang_bay_price','$obj->khac','$obj->khac_price','$obj->note')",'booking_tour_custom');
}
//
function booking_tour_custom_update($obj)
{
    return exe_query("update booking_tour_custom set booking_id='$obj->booking_id',chuong_trinh='$obj->chuong_trinh',chuong_trinh_price='$obj->chuong_trinh_price',thoi_gian='$obj->thoi_gian',thoi_gian_price='$obj->thoi_gian_price',nguoi_lon='$obj->nguoi_lon',tre_em='$obj->tre_em',tre_em_5='$obj->tre_em_5',so_nguoi_price='$obj->so_nguoi_price',khach_san='$obj->khach_san',khach_san_price='$obj->khach_san_price',ngay_khoi_hanh='$obj->ngay_khoi_hanh',ngay_khoi_hanh_price='$obj->ngay_khoi_hanh_price',hang_bay='$obj->hang_bay',hang_bay_price='$obj->hang_bay_price',khac='$obj->khac',khac_price='$obj->khac_price',note='$obj->note' where id=$obj->id",'booking_tour_custom');
}
//
function booking_tour_custom_delete($obj)
{
    return exe_query('delete from booking_tour_custom where id='.$obj->id,'booking_tour_custom');
}
//
function booking_tour_custom_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from booking_tour_custom '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
