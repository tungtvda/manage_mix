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
   return booking_Get("SELECT booking.id, booking.code_booking, booking.id_tour, booking.name_tour, booking.code_tour, booking.price_tour,booking.price_tiep_thi, booking.status_tiep_thi,booking.confirm_admin_tiep_thi, booking.price_11, booking.price_5, booking.price_new, booking.price_11_new, booking.price_5_new, booking.vat, booking.nguon_tour, booking.tien_te, booking.ty_gia, booking.ngay_bat_dau, booking.han_thanh_toan, booking.loai_khach_hang, booking.hinh_thuc_thanh_toan, booking.id_customer, booking.diem_don, booking.diem_tra, booking.ngay_khoi_hanh, booking.ngay_ket_thuc, booking.phuong_tien, booking.num_nguoi_lon, booking.num_tre_em, booking.num_tre_em_5, booking.price_number, booking.price_number_2, booking.price_number_3, booking.name_price, booking.name_price_2, booking.name_price_3, booking.total_price, booking.tien_thanh_toan, booking.user_id,booking.user_tiep_thi_id, booking.status, booking.confirm_admin, booking.created_by, booking.updated_by, booking.created, booking.updated, booking.note FROM  booking ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function booking_insert($obj)
{
    return exe_query("insert into booking (code_booking,id_tour,name_tour,code_tour,price_tour,price_tiep_thi,status_tiep_thi,confirm_admin_tiep_thi,price_11,price_5,price_new,price_11_new,price_5_new,vat,nguon_tour,tien_te,ty_gia,ngay_bat_dau,han_thanh_toan,loai_khach_hang,hinh_thuc_thanh_toan,id_customer,diem_don,diem_tra,ngay_khoi_hanh,ngay_ket_thuc,phuong_tien,num_nguoi_lon,num_tre_em,num_tre_em_5,price_number,price_number_2,price_number_3,name_price,name_price_2,name_price_3,total_price,tien_thanh_toan,user_id,user_tiep_thi_id,status,confirm_admin,created_by,updated_by,created,updated,note) values ('$obj->code_booking','$obj->id_tour','$obj->name_tour','$obj->code_tour','$obj->price_tour','$obj->price_tiep_thi','$obj->status_tiep_thi','$obj->confirm_admin_tiep_thi','$obj->price_11','$obj->price_5','$obj->price_new','$obj->price_11_new','$obj->price_5_new','$obj->vat','$obj->nguon_tour','$obj->tien_te','$obj->ty_gia','$obj->ngay_bat_dau','$obj->han_thanh_toan','$obj->loai_khach_hang','$obj->hinh_thuc_thanh_toan','$obj->id_customer','$obj->diem_don','$obj->diem_tra','$obj->ngay_khoi_hanh','$obj->ngay_ket_thuc','$obj->phuong_tien','$obj->num_nguoi_lon','$obj->num_tre_em','$obj->num_tre_em_5','$obj->price_number','$obj->price_number_2','$obj->price_number_3','$obj->name_price','$obj->name_price_2','$obj->name_price_3','$obj->total_price','$obj->tien_thanh_toan','$obj->user_id','$obj->user_tiep_thi_id','$obj->status','$obj->confirm_admin','$obj->created_by','$obj->updated_by','$obj->created','$obj->updated','$obj->note')",'booking');
}
//
function booking_update($obj)
{
    return exe_query("update booking set code_booking='$obj->code_booking',id_tour='$obj->id_tour',name_tour='$obj->name_tour',code_tour='$obj->code_tour',price_tour='$obj->price_tour',price_tiep_thi='$obj->price_tiep_thi',status_tiep_thi='$obj->status_tiep_thi',confirm_admin_tiep_thi='$obj->confirm_admin_tiep_thi',price_11='$obj->price_11',price_5='$obj->price_5',price_new='$obj->price_new',price_11_new='$obj->price_11_new',price_5_new='$obj->price_5_new',vat='$obj->vat',nguon_tour='$obj->nguon_tour',tien_te='$obj->tien_te',ty_gia='$obj->ty_gia',ngay_bat_dau='$obj->ngay_bat_dau',han_thanh_toan='$obj->han_thanh_toan',loai_khach_hang='$obj->loai_khach_hang',hinh_thuc_thanh_toan='$obj->hinh_thuc_thanh_toan',id_customer='$obj->id_customer',diem_don='$obj->diem_don',diem_tra='$obj->diem_tra',ngay_khoi_hanh='$obj->ngay_khoi_hanh',ngay_ket_thuc='$obj->ngay_ket_thuc',phuong_tien='$obj->phuong_tien',num_nguoi_lon='$obj->num_nguoi_lon',num_tre_em='$obj->num_tre_em',num_tre_em_5='$obj->num_tre_em_5',price_number='$obj->price_number',price_number_2='$obj->price_number_2',price_number_3='$obj->price_number_3',name_price='$obj->name_price',name_price_2='$obj->name_price_2',name_price_3='$obj->name_price_3',total_price='$obj->total_price',tien_thanh_toan='$obj->tien_thanh_toan',user_id='$obj->user_id',user_tiep_thi_id='$obj->user_tiep_thi_id',status='$obj->status',confirm_admin='$obj->confirm_admin',created_by='$obj->created_by',updated_by='$obj->updated_by',created='$obj->created',updated='$obj->updated',note='$obj->note' where id=$obj->id",'booking');
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
function booking_thongke_doanh_thu($where){
    $query="select bk.*, cs.name as name_customer ,";
    $query.=" (select sum(price) from booking_cost where booking_id=bk.id) as total_cost";
    $query.=" FROM booking bk ";
    $query.=" LEFT JOIN customer cs on bk.id_customer = cs.id";
    if($where!=''){
        $query.=' where '.$where;
    }
    $query.=" ORDER BY id desc";
    $result=mysqli_query(ConnectSql(),$query);
    $array_result=array();
    if($result!=false)while($row=mysqli_fetch_array($result))
    {
        array_push($array_result,$row);
    }
    return $array_result;
//    return booking_Get($query);
}
function bookingAllDongHang($where){
    $query="select bk.*, us.name as name_user, us.user_role as type_user, us.user_code, ";
    $query.="  us_tt.name as name_user_tt, us_tt.user_role as type_user_tt, us_tt.user_code as user_code_tt ,";
    $query.="  us_cr.name as name_user_cr, us_cr.user_role as type_user_cr, us_cr.user_code as user_code_cr ";
    $query.=" FROM booking bk ";
    $query.=" LEFT JOIN user us on bk.user_id = us.id";
    $query.=" LEFT JOIN user us_tt on bk.user_tiep_thi_id = us_tt.id";
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
