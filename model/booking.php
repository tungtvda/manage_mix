<?php
class booking
{
    public $id,$code_booking,$id_tour,$name_tour,$code_tour,$price_tour, $price_tiep_thi,$price_tiep_thi_thuc_te,$level_tiep_thi,$level_gioi_thieu_tiep_thi_3,$level_gioi_thieu_tiep_thi_4,$level_gioi_thieu_tiep_thi_5,$hoa_hong_gioi_thieu_4,$hoa_hong_gioi_thieu_5,$status_tiep_thi,$confirm_admin_tiep_thi,$price_11,$price_5,$price_new,$price_11_new,$price_5_new,$vat,$nguon_tour,$tien_te,$ty_gia,$ngay_bat_dau,$han_thanh_toan,$loai_khach_hang,$hinh_thuc_thanh_toan,$id_customer,$diem_don,$diem_tra,$ngay_khoi_hanh,$ngay_ket_thuc,$phuong_tien,$num_nguoi_lon,$num_tre_em,$num_tre_em_5,$price_number,$price_number_2,$price_number_3,$name_price,$name_price_2,$name_price_3,$total_price,$tien_thanh_toan,$user_id,$dieuhanh_id,$user_tiep_thi_id,$status,$confirm_admin, $confirm_dieuhanh, $confirm_sales,$created_by,$updated_by,$created,$updated,$note;
    public function booking($data=array())
    {
    $this->id=isset($data['id'])?$data['id']:'';
    $this->code_booking=isset($data['code_booking'])?$data['code_booking']:'';
    $this->id_tour=isset($data['id_tour'])?$data['id_tour']:'';
    $this->name_tour=isset($data['name_tour'])?$data['name_tour']:'';
    $this->code_tour=isset($data['code_tour'])?$data['code_tour']:'';
    $this->price_tour=isset($data['price_tour'])?$data['price_tour']:'';
    $this->price_tiep_thi=isset($data['price_tiep_thi'])?$data['price_tiep_thi']:'';
    $this->price_tiep_thi_thuc_te=isset($data['price_tiep_thi_thuc_te'])?$data['price_tiep_thi_thuc_te']:'';
    $this->level_tiep_thi=isset($data['level_tiep_thi'])?$data['level_tiep_thi']:'';
    $this->level_gioi_thieu_tiep_thi_3=isset($data['level_gioi_thieu_tiep_thi_3'])?$data['level_gioi_thieu_tiep_thi_3']:'';
    $this->level_gioi_thieu_tiep_thi_4=isset($data['level_gioi_thieu_tiep_thi_4'])?$data['level_gioi_thieu_tiep_thi_4']:'';
    $this->level_gioi_thieu_tiep_thi_5=isset($data['level_gioi_thieu_tiep_thi_4'])?$data['level_gioi_thieu_tiep_thi_5']:'';
    $this->hoa_hong_gioi_thieu_4=isset($data['hoa_hong_gioi_thieu_4'])?$data['hoa_hong_gioi_thieu_4']:'';
    $this->hoa_hong_gioi_thieu_5=isset($data['hoa_hong_gioi_thieu_5'])?$data['hoa_hong_gioi_thieu_5']:'';
    $this->status_tiep_thi=isset($data['status_tiep_thi'])?$data['status_tiep_thi']:'';
    $this->confirm_admin_tiep_thi=isset($data['confirm_admin_tiep_thi'])?$data['confirm_admin_tiep_thi']:'';
    $this->price_11=isset($data['price_11'])?$data['price_11']:'';
    $this->price_5=isset($data['price_5'])?$data['price_5']:'';
    $this->price_new=isset($data['price_new'])?$data['price_new']:'';
    $this->price_11_new=isset($data['price_11_new'])?$data['price_11_new']:'';
    $this->price_5_new=isset($data['price_5_new'])?$data['price_5_new']:'';
    $this->vat=isset($data['vat'])?$data['vat']:'';
    $this->nguon_tour=isset($data['nguon_tour'])?$data['nguon_tour']:'';
    $this->tien_te=isset($data['tien_te'])?$data['tien_te']:'';
    $this->ty_gia=isset($data['ty_gia'])?$data['ty_gia']:'';
    $this->ngay_bat_dau=isset($data['ngay_bat_dau'])?$data['ngay_bat_dau']:'';
    $this->han_thanh_toan=isset($data['han_thanh_toan'])?$data['han_thanh_toan']:'';
    $this->loai_khach_hang=isset($data['loai_khach_hang'])?$data['loai_khach_hang']:'';
    $this->hinh_thuc_thanh_toan=isset($data['hinh_thuc_thanh_toan'])?$data['hinh_thuc_thanh_toan']:'';
    $this->id_customer=isset($data['id_customer'])?$data['id_customer']:'';
    $this->diem_don=isset($data['diem_don'])?$data['diem_don']:'';
    $this->diem_tra=isset($data['diem_tra'])?$data['diem_tra']:'';
    $this->ngay_khoi_hanh=isset($data['ngay_khoi_hanh'])?$data['ngay_khoi_hanh']:'';
    $this->ngay_ket_thuc=isset($data['ngay_ket_thuc'])?$data['ngay_ket_thuc']:'';
    $this->phuong_tien=isset($data['phuong_tien'])?$data['phuong_tien']:'';
    $this->num_nguoi_lon=isset($data['num_nguoi_lon'])?$data['num_nguoi_lon']:'';
    $this->num_tre_em=isset($data['num_tre_em'])?$data['num_tre_em']:'';
    $this->num_tre_em_5=isset($data['num_tre_em_5'])?$data['num_tre_em_5']:'';
    $this->price_number=isset($data['price_number'])?$data['price_number']:'';
    $this->price_number_2=isset($data['price_number_2'])?$data['price_number_2']:'';
    $this->price_number_3=isset($data['price_number_3'])?$data['price_number_3']:'';
    $this->name_price=isset($data['name_price'])?$data['name_price']:'';
    $this->name_price_2=isset($data['name_price_2'])?$data['name_price_2']:'';
    $this->name_price_3=isset($data['name_price_3'])?$data['name_price_3']:'';
    $this->total_price=isset($data['total_price'])?$data['total_price']:'';
    $this->tien_thanh_toan=isset($data['tien_thanh_toan'])?$data['tien_thanh_toan']:'';
    $this->user_id=isset($data['user_id'])?$data['user_id']:'';
    $this->dieuhanh_id=isset($data['dieuhanh_id'])?$data['dieuhanh_id']:'';
    $this->user_tiep_thi_id=isset($data['user_tiep_thi_id'])?$data['user_tiep_thi_id']:'';
    $this->status=isset($data['status'])?$data['status']:'';
    $this->confirm_admin=isset($data['confirm_admin'])?$data['confirm_admin']:'';
    $this->confirm_dieuhanh=isset($data['confirm_dieuhanh'])?$data['confirm_dieuhanh']:'';
    $this->confirm_sales=isset($data['confirm_sales'])?$data['confirm_sales']:'';
    $this->created_by=isset($data['created_by'])?$data['created_by']:'';
    $this->updated_by=isset($data['updated_by'])?$data['updated_by']:'';
    $this->created=isset($data['created'])?$data['created']:'';
    $this->updated=isset($data['updated'])?$data['updated']:'';
    $this->note=isset($data['note'])?$data['note']:'';
          $this->encode();
    }
    public function encode()
        {
            $this->id=addslashes($this->id);
            $this->code_booking=addslashes($this->code_booking);
            $this->id_tour=addslashes($this->id_tour);
            $this->name_tour=addslashes($this->name_tour);
            $this->code_tour=addslashes($this->code_tour);
            $this->price_tour=addslashes($this->price_tour);
            $this->price_tiep_thi=addslashes($this->price_tiep_thi);
            $this->price_tiep_thi_thuc_te=addslashes($this->price_tiep_thi_thuc_te);
            $this->level_tiep_thi=addslashes($this->level_tiep_thi);
            $this->level_gioi_thieu_tiep_thi_3=addslashes($this->level_gioi_thieu_tiep_thi_3);
            $this->level_gioi_thieu_tiep_thi_4=addslashes($this->level_gioi_thieu_tiep_thi_4);
            $this->level_gioi_thieu_tiep_thi_5=addslashes($this->level_gioi_thieu_tiep_thi_5);
            $this->hoa_hong_gioi_thieu_4=addslashes($this->hoa_hong_gioi_thieu_4);
            $this->hoa_hong_gioi_thieu_5=addslashes($this->hoa_hong_gioi_thieu_5);
            $this->status_tiep_thi=addslashes($this->status_tiep_thi);
            $this->confirm_admin_tiep_thi=addslashes($this->confirm_admin_tiep_thi);
            $this->price_11=addslashes($this->price_11);
            $this->price_5=addslashes($this->price_5);
            $this->price_new=addslashes($this->price_new);
            $this->price_11_new=addslashes($this->price_11_new);
            $this->price_5_new=addslashes($this->price_5_new);
            $this->vat=addslashes($this->vat);
            $this->nguon_tour=addslashes($this->nguon_tour);
            $this->tien_te=addslashes($this->tien_te);
            $this->ty_gia=addslashes($this->ty_gia);
            $this->ngay_bat_dau=addslashes($this->ngay_bat_dau);
            $this->han_thanh_toan=addslashes($this->han_thanh_toan);
            $this->loai_khach_hang=addslashes($this->loai_khach_hang);
            $this->hinh_thuc_thanh_toan=addslashes($this->hinh_thuc_thanh_toan);
            $this->id_customer=addslashes($this->id_customer);
            $this->diem_don=addslashes($this->diem_don);
            $this->diem_tra=addslashes($this->diem_tra);
            $this->ngay_khoi_hanh=addslashes($this->ngay_khoi_hanh);
            $this->ngay_ket_thuc=addslashes($this->ngay_ket_thuc);
            $this->phuong_tien=addslashes($this->phuong_tien);
            $this->num_nguoi_lon=addslashes($this->num_nguoi_lon);
            $this->num_tre_em=addslashes($this->num_tre_em);
            $this->num_tre_em_5=addslashes($this->num_tre_em_5);
            $this->price_number=addslashes($this->price_number);
            $this->price_number_2=addslashes($this->price_number_2);
            $this->price_number_3=addslashes($this->price_number_3);
            $this->name_price=addslashes($this->name_price);
            $this->name_price_2=addslashes($this->name_price_2);
            $this->name_price_3=addslashes($this->name_price_3);
            $this->total_price=addslashes($this->total_price);
            $this->tien_thanh_toan=addslashes($this->tien_thanh_toan);
            $this->user_id=addslashes($this->user_id);
            $this->dieuhanh_id=addslashes($this->dieuhanh_id);
            $this->user_tiep_thi_id=addslashes($this->user_tiep_thi_id);
            $this->status=addslashes($this->status);
            $this->confirm_admin=addslashes($this->confirm_admin);
            $this->confirm_dieuhanh=addslashes($this->confirm_dieuhanh);
            $this->confirm_sales=addslashes($this->confirm_sales);
            $this->created_by=addslashes($this->created_by);
            $this->updated_by=addslashes($this->updated_by);
            $this->created=addslashes($this->created);
            $this->updated=addslashes($this->updated);
            $this->note=addslashes($this->note);
        }
    public function decode()
        {
            $this->id=stripslashes($this->id);
            $this->code_booking=stripslashes($this->code_booking);
            $this->id_tour=stripslashes($this->id_tour);
            $this->name_tour=stripslashes($this->name_tour);
            $this->code_tour=stripslashes($this->code_tour);
            $this->price_tour=stripslashes($this->price_tour);
            $this->price_tiep_thi=stripslashes($this->price_tiep_thi);
            $this->price_tiep_thi_thuc_te=stripslashes($this->price_tiep_thi_thuc_te);
            $this->level_tiep_thi=stripslashes($this->level_tiep_thi);
            $this->level_gioi_thieu_tiep_thi_3=stripslashes($this->level_gioi_thieu_tiep_thi_3);
            $this->level_gioi_thieu_tiep_thi_4=stripslashes($this->level_gioi_thieu_tiep_thi_4);
            $this->level_gioi_thieu_tiep_thi_5=stripslashes($this->level_gioi_thieu_tiep_thi_5);
            $this->hoa_hong_gioi_thieu_4=stripslashes($this->hoa_hong_gioi_thieu_4);
            $this->hoa_hong_gioi_thieu_5=stripslashes($this->hoa_hong_gioi_thieu_5);
            $this->status_tiep_thi=stripslashes($this->status_tiep_thi);
            $this->confirm_admin_tiep_thi=stripslashes($this->confirm_admin_tiep_thi);
            $this->price_11=stripslashes($this->price_11);
            $this->price_5=stripslashes($this->price_5);
            $this->price_new=stripslashes($this->price_new);
            $this->price_11_new=stripslashes($this->price_11_new);
            $this->price_5_new=stripslashes($this->price_5_new);
            $this->vat=stripslashes($this->vat);
            $this->nguon_tour=stripslashes($this->nguon_tour);
            $this->tien_te=stripslashes($this->tien_te);
            $this->ty_gia=stripslashes($this->ty_gia);
            $this->ngay_bat_dau=stripslashes($this->ngay_bat_dau);
            $this->han_thanh_toan=stripslashes($this->han_thanh_toan);
            $this->loai_khach_hang=stripslashes($this->loai_khach_hang);
            $this->hinh_thuc_thanh_toan=stripslashes($this->hinh_thuc_thanh_toan);
            $this->id_customer=stripslashes($this->id_customer);
            $this->diem_don=stripslashes($this->diem_don);
            $this->diem_tra=stripslashes($this->diem_tra);
            $this->ngay_khoi_hanh=stripslashes($this->ngay_khoi_hanh);
            $this->ngay_ket_thuc=stripslashes($this->ngay_ket_thuc);
            $this->phuong_tien=stripslashes($this->phuong_tien);
            $this->num_nguoi_lon=stripslashes($this->num_nguoi_lon);
            $this->num_tre_em=stripslashes($this->num_tre_em);
            $this->num_tre_em_5=stripslashes($this->num_tre_em_5);
            $this->price_number=stripslashes($this->price_number);
            $this->price_number_2=stripslashes($this->price_number_2);
            $this->price_number_3=stripslashes($this->price_number_3);
            $this->name_price=stripslashes($this->name_price);
            $this->name_price_2=stripslashes($this->name_price_2);
            $this->name_price_3=stripslashes($this->name_price_3);
            $this->total_price=stripslashes($this->total_price);
            $this->tien_thanh_toan=stripslashes($this->tien_thanh_toan);
            $this->user_id=stripslashes($this->user_id);
            $this->dieuhanh_id=stripslashes($this->dieuhanh_id);
            $this->user_tiep_thi_id=stripslashes($this->user_tiep_thi_id);
            $this->status=stripslashes($this->status);
            $this->confirm_admin=stripslashes($this->confirm_admin);
            $this->confirm_dieuhanh=stripslashes($this->confirm_dieuhanh);
            $this->confirm_sales=stripslashes($this->confirm_sales);
            $this->created_by=stripslashes($this->created_by);
            $this->updated_by=stripslashes($this->updated_by);
            $this->created=stripslashes($this->created);
            $this->updated=stripslashes($this->updated);
            $this->note=stripslashes($this->note);
        }
}
