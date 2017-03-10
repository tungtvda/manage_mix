<?php
require_once DIR.'/model/booking.php';
require_once DIR.'/model/sqlconnection.php';
//
function booking_Get($command)
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
                $new_obj=new booking($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'booking');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new booking($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function booking_getById($id)
{
    return booking_Get('select * from booking where id='.$id);
}
//
function booking_getByAll()
{
    return booking_Get('select * from booking');
}
//
function booking_getByTop($top,$where,$order)
{
    return booking_Get("select * from booking ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function booking_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return booking_Get("SELECT * FROM  booking ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return booking_Get("SELECT booking.id, booking.code_booking, booking.id_tour, booking.name_tour, booking.code_tour, booking.price_tour, booking.price_11, booking.price_5, booking.price_new, booking.price_11_new, booking.price_5_new, booking.vat, booking.nguon_tour, booking.tien_te, booking.ty_gia, booking.ngay_bat_dau, booking.han_thanh_toan, booking.loai_khach_hang, booking.hinh_thuc_thanh_toan, booking.id_customer, booking.diem_don, booking.diem_tra, booking.ngay_khoi_hanh, booking.ngay_ket_thuc, booking.phuong_tien, booking.num_nguoi_lon, booking.num_tre_em, booking.num_tre_em_5, booking.total_price, booking.tien_thanh_toan, booking.user_id, booking.status, booking.confirm_admin, booking.created_by, booking.updated_by, booking.created, booking.updated, booking.note FROM  booking ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_insert($obj)
{
    return exe_query("insert into booking (code_booking,id_tour,name_tour,code_tour,price_tour,price_11,price_5,price_new,price_11_new,price_5_new,vat,nguon_tour,tien_te,ty_gia,ngay_bat_dau,han_thanh_toan,loai_khach_hang,hinh_thuc_thanh_toan,id_customer,diem_don,diem_tra,ngay_khoi_hanh,ngay_ket_thuc,phuong_tien,num_nguoi_lon,num_tre_em,num_tre_em_5,total_price,tien_thanh_toan,user_id,status,confirm_admin,created_by,updated_by,created,updated,note) values ('$obj->code_booking','$obj->id_tour','$obj->name_tour','$obj->code_tour','$obj->price_tour','$obj->price_11','$obj->price_5','$obj->price_new','$obj->price_11_new','$obj->price_5_new','$obj->vat','$obj->nguon_tour','$obj->tien_te','$obj->ty_gia','$obj->ngay_bat_dau','$obj->han_thanh_toan','$obj->loai_khach_hang','$obj->hinh_thuc_thanh_toan','$obj->id_customer','$obj->diem_don','$obj->diem_tra','$obj->ngay_khoi_hanh','$obj->ngay_ket_thuc','$obj->phuong_tien','$obj->num_nguoi_lon','$obj->num_tre_em','$obj->num_tre_em_5','$obj->total_price','$obj->tien_thanh_toan','$obj->user_id','$obj->status','$obj->confirm_admin','$obj->created_by','$obj->updated_by','$obj->created','$obj->updated','$obj->note')",'booking');
}
//
function booking_update($obj)
{
    return exe_query("update booking set code_booking='$obj->code_booking',id_tour='$obj->id_tour',name_tour='$obj->name_tour',code_tour='$obj->code_tour',price_tour='$obj->price_tour',price_11='$obj->price_11',price_5='$obj->price_5',price_new='$obj->price_new',price_11_new='$obj->price_11_new',price_5_new='$obj->price_5_new',vat='$obj->vat',nguon_tour='$obj->nguon_tour',tien_te='$obj->tien_te',ty_gia='$obj->ty_gia',ngay_bat_dau='$obj->ngay_bat_dau',han_thanh_toan='$obj->han_thanh_toan',loai_khach_hang='$obj->loai_khach_hang',hinh_thuc_thanh_toan='$obj->hinh_thuc_thanh_toan',id_customer='$obj->id_customer',diem_don='$obj->diem_don',diem_tra='$obj->diem_tra',ngay_khoi_hanh='$obj->ngay_khoi_hanh',ngay_ket_thuc='$obj->ngay_ket_thuc',phuong_tien='$obj->phuong_tien',num_nguoi_lon='$obj->num_nguoi_lon',num_tre_em='$obj->num_tre_em',num_tre_em_5='$obj->num_tre_em_5',total_price='$obj->total_price',tien_thanh_toan='$obj->tien_thanh_toan',user_id='$obj->user_id',status='$obj->status',confirm_admin='$obj->confirm_admin',created_by='$obj->created_by',updated_by='$obj->updated_by',created='$obj->created',updated='$obj->updated',note='$obj->note' where id=$obj->id",'booking');
}
//
function booking_delete($obj)
{
    return exe_query('delete from booking where id='.$obj->id,'booking');
}
//
function booking_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from booking '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
