<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/tien_teService.php';
require_once DIR . '/model/trang_thai_don_hangService.php';
require_once DIR . '/model/htttService.php';
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/customer_categoryService.php';
require_once DIR . '/model/tourService.php';
_returnCheckPermison(0,0);
if (isset($_POST['id']) && isset($_POST['table'])) {
    $id=_return_mc_decrypt(_returnPostParamSecurity('id'), ENCRYPTION_KEY);
    $table = _returnPostParamSecurity('table');
    if ($id != '' && $table != '') {


        $file_model = $table . 'Service.php';
        require_once DIR . '/model/' . $file_model;

        $function_id = $table . '_getById';
        $data_check = $function_id($id);
        if (count($data_check) > 0) {
            $user_data=user_getById($data_check[0]->user_id);
            $data_check[0]->user_name='';
            if(count($user_data)>0){
                $data_check[0]->user_id=$user_data[0]->id;
                $data_check[0]->user_name=$user_data[0]->name;
            }
            $tiente_data=tien_te_getById($data_check[0]->tien_te);
            $data_check[0]->tien_te_name='';
            if(count($tiente_data)>0){
                $data_check[0]->tien_te=$tiente_data[0]->id;
                $data_check[0]->tien_te_name=$tiente_data[0]->name;
            }
            if($data_check[0]->ty_gia!=''){
                $data_check[0]->ty_gia=number_format((int)$data_check[0]->ty_gia,0,",",".").' vnđ';
            }
            if($data_check[0]->ngay_bat_dau!='0000-00-00'){
                $data_check[0]->ngay_bat_dau=date("d-m-Y", strtotime($data_check[0]->ngay_bat_dau));
            }else{
                $data_check[0]->ngay_bat_dau='';
            }
            if($data_check[0]->han_thanh_toan!='0000-00-00'){
                $data_check[0]->han_thanh_toan=date("d-m-Y", strtotime($data_check[0]->han_thanh_toan));
            }else{
                $data_check[0]->han_thanh_toan='';
            }

            $status_data=trang_thai_don_hang_getById($data_check[0]->status);
            $data_check[0]->status_name='';
            if(count($status_data)>0){
                $data_check[0]->status_name=$status_data[0]->name;
            }

            $httt_data=httt_getById($data_check[0]->hinh_thuc_thanh_toan);
            $data_check[0]->httt_name='';
            if(count($httt_data)>0){
                $data_check[0]->httt_name=$httt_data[0]->name;
            }
            if($data_check[0]->num_nguoi_lon==''){
                $data_check[0]->num_nguoi_lon=0;
            }

            if($data_check[0]->num_tre_em==''){
                $data_check[0]->num_tre_em=0;
            }
            if($data_check[0]->num_tre_em_5==''){
                $data_check[0]->num_tre_em_5=0;
            }
            $data_check[0]->so_nguoi=$data_check[0]->num_nguoi_lon.' người lớn | '.$data_check[0]->num_tre_em.' trẻ em 5-11 tuổi | '.$data_check[0]->num_tre_em_5.' dưới 5 tuổi';
            $checked_vat='';
            if($data_check[0]->vat==1){
                $checked_vat='checked';
            }
            $data_check[0]->vat_check_box=' <label> <input '.$checked_vat.' id="thue_vat" name="vat" class="ace ace-switch ace-switch-6 thue_vat" type="checkbox"><span class="lbl"></span></label>';

            $khach_hang=customer_getById($data_check[0]->id_customer);
            $data_check[0]->name_customer='';
            $data_check[0]->phone_customer='';
            $data_check[0]->email_customer='';
            $data_check[0]->address_customer='';
            $data_check[0]->fax_customer='';
            $data_check[0]->nhom_customer='';
            if(count($khach_hang)>0){
                $data_check[0]->name_customer=$khach_hang[0]->name;
                $data_check[0]->phone_customer=$khach_hang[0]->phone;
                $data_check[0]->email_customer=$khach_hang[0]->email;
                $data_check[0]->address_customer=$khach_hang[0]->address;
                $data_check[0]->fax_customer=$khach_hang[0]->fax;
                $data_cate=customer_category_getById($khach_hang[0]->category);
                if($data_cate>0){
                    $data_check[0]->nhom_customer=$data_cate[0]->name;
                }
            }

            if($data_check[0]->ngay_khoi_hanh!='0000-00-00 00:00:00'){
                $data_check[0]->ngay_khoi_hanh=date("d-m-Y", strtotime($data_check[0]->ngay_khoi_hanh));
            }else{
                $data_check[0]->ngay_khoi_hanh='';
            }
            if($data_check[0]->ngay_ket_thuc!='0000-00-00 00:00:00'){
                $data_check[0]->ngay_ket_thuc=date("d-m-Y", strtotime($data_check[0]->ngay_ket_thuc));
            }else{
                $data_check[0]->ngay_ket_thuc='';
            }

            $tour_data=tour_getById($data_check[0]->id_tour);
            $data_check[0]->tour_name='';
            if(count($tour_data)>0){
                $data_check[0]->tour_name=$tour_data[0]->name;
            }
            $data_check[0]->price_new_format='';
            if($data_check[0]->price_new!=''){
                $data_check[0]->price_new_format=number_format((int)$data_check[0]->price_new,0,",",".").' vnđ';
            }else{
                $data_check[0]->price_new=0;
            }

            $data_check[0]->price_5_new_format='';
            if($data_check[0]->price_5_new!=''){
                $data_check[0]->price_5_new_format=number_format((int)$data_check[0]->price_5_new,0,",",".").' vnđ';
            }else{
                $data_check[0]->price_5_new=0;
            }

            $data_check[0]->price_11_new_format='';
            if($data_check[0]->price_11_new!=''){
                $data_check[0]->price_11_new_format=number_format((int)$data_check[0]->price_11_new,0,",",".").' vnđ';
            }else{
                $data_check[0]->price_11_new=0;
            }

            $data_check[0]->tien_thanh_toan_format='';
            if($data_check[0]->tien_thanh_toan!=''){
                $data_check[0]->tien_thanh_toan_format=number_format((int)$data_check[0]->tien_thanh_toan,0,",",".").' vnđ';
            }
            else{
                $data_check[0]->tien_thanh_toan=0;
            }


            $total=0;
            if($data_check[0]->num_nguoi_lon==''){
                $data_check[0]->num_nguoi_lon=0;
            }

            if($data_check[0]->num_tre_em==''){
                $data_check[0]->num_tre_em=0;
            }
            if($data_check[0]->num_tre_em_5==''){
                $data_check[0]->num_tre_em_5=0;
            }


            if(is_numeric($data_check[0]->num_nguoi_lon)&&is_numeric($data_check[0]->price_new)){
                $total=$total+($data_check[0]->num_nguoi_lon*$data_check[0]->price_new);
            }
            if(is_numeric($data_check[0]->num_tre_em)&&is_numeric($data_check[0]->price_11_new)){
                $total=$total+( $data_check[0]->num_tre_em*$data_check[0]->price_11_new);
            }
            if(is_numeric($data_check[0]->num_tre_em_5)&&is_numeric($data_check[0]->price_5_new)){
                $total=$total+($data_check[0]->num_tre_em_5*$data_check[0]->price_5_new);
            }
            $vat_price=0;
            if($data_check[0]->vat==1){
                $vat_price=($total*0.1);
                $total=$total+$vat_price;
            }
            $conlai=$total-$data_check[0]->tien_thanh_toan;

            $data_check[0]->total_format=number_format((int)$total,0,",",".").' vnđ';
            $data_check[0]->vat_price_format=number_format((int)$vat_price,0,",",".").' vnđ';
            $data_check[0]->conlai_format=number_format((int)$conlai,0,",",".").' vnđ';

          echo $data=json_encode($data_check[0]);
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}