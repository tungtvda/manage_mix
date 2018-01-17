<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/tien_teService.php';
require_once DIR . '/model/trang_thai_don_hangService.php';
require_once DIR . '/model/htttService.php';
require_once DIR . '/model/customerService.php';
require_once DIR . '/model/customer_categoryService.php';
require_once DIR . '/model/tourService.php';
require_once DIR . '/model/tour_list_dichvuService.php';
require_once DIR . '/model/danhmuc_dichvuService.php';
$item_tour=array(
    'total_dichvu'=>'',
    'total_dichvu_format'=>'',
    'gia_net'=>'',
    'gia_net_m1'=>'',
    'gia_net_m2'=>'',
    'gia_net_m3'=>'',
    'ty_le_m1'=>'',
    'ty_le_m2'=>'',
    'ty_le_m3'=>'',
    'loi_nhuan'=>'',
    'loi_nhuan_m1'=>'',
    'loi_nhuan_m2'=>'',
    'loi_nhuan_m3'=>'',
    'loi_nhuan_format'=>'',
    'loi_nhuan_m1_format'=>'',
    'loi_nhuan_m2_format'=>'',
    'loi_nhuan_m3_format'=>'',
    'gia_ban'=>'',
    'gia_ban_m1'=>'',
    'gia_ban_m2'=>'',
    'gia_ban_m3'=>'',
);
$res=array(
    'success'=>0,
    'mess'=>'',
    'data'=>$item_tour,
    'list_dich_vu'=>''
);

if(isset($_GET['id'])){
    $data_danhmuc_dichvu=danhmuc_dichvu_getByTop('','','position asc');
    $id=_returnGetParamSecurity('id');
    $data_tour=tour_getById($id);
    if($data_tour){
        $data_list_dichvu=tour_list_dichvu_getByTop('','tour_id='.$id,'id asc');
        $list_dich_vu='';
        $total_dicvu=0;
        if($data_list_dichvu>0){
            $count_dv=1;
            foreach ($data_list_dichvu as $row_dv){
                if($row_dv->price==''){
                    $row_dv->price=0;
                }
                if($row_dv->number=='' || $row_dv->number==0){
                    $row_dv->number=1;
                }
                $thanh_tien_dv=$row_dv->price*$row_dv->number;
                $total_dicvu=$total_dicvu+$thanh_tien_dv;
                $price_item_dv= number_format((float)$row_dv->price, 0, ",", ".") . ' vnđ';
                $list_dich_vu.=' <tr id="item_dichvu_'.$count_dv.'" data-value="'.$count_dv.'" class="item_dichvu">
                                            <td id="stt_dichvu_td_'.$count_dv.'">'.$count_dv.'</td>
                                            <td><input disabled style="height: 30px;     width: 100%;" value="'.$row_dv->name.'" name="name_dichvu[]" id="input_name_dichvu_'.$count_dv.'" type="text" class="valid input_table"></td>
                                            <td>
                                                <select disabled  style="width: 100%;" name="type_dichvu[]" id="input_type_dichvu_'.$count_dv.'">';
                if($data_danhmuc_dichvu){
                    foreach($data_danhmuc_dichvu as $row_dm){
                        $selected='';
                        if($row_dv->type==$row_dm->id){
                            $selected='selected="selected"';
                        }
                        $list_dich_vu .='<option '.$selected.' value="'.$row_dm->id.'">'.$row_dm->name.'</option>';
                    }
                }
                $list_dich_vu.='</select>
                                            </td>
                                            <td>
                                                <input disabled data-value="'.$count_dv.'" style="height: 30px;width: 86%;" value="'.$row_dv->price.'" name="price_dichvu[]" id="input_price_dichvu_'.$count_dv.'" type="number" class="valid input_table input_price_dichvu">
                                                <div class="btn-group" style="width: 10%;">
                                                    <button style="padding: 4px 5px;margin-top: 0px; margin-bottom: 3px;" data-toggle="dropdown" class="btn btn-sm btn-danger dropdown-toggle btn-action-gird" aria-expanded="false"> <i class="fa fa-usd" aria-hidden="true"></i></button>
                                                    <ul class="dropdown-menu dropdown-danger"> <li> <a role="button" data-toggle="modal" class="edit_function">Đơn giá: <b id="price_dichvu_format_'.$count_dv.'">'.$price_item_dv.'</span></a> </li> </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <input disabled data-value="'.$count_dv.'"  style="height: 30px; width:100%" value="'.$row_dv->number.'" name="soluong_dichvu[]" min="1" id="input_soluong_dichvu_'.$count_dv.'" type="number" class="valid input_table input_soluong_dichvu">
                                            </td>
                                            <td><input disabled style="height: 30px; width: 100%;" value="'.$row_dv->total.'" name="thanhtien_dichvu[]" id="input_thanhtien_dichvu_'.$count_dv.'" type="text" class="valid input_table "></td>
                                            <td><input disabled style="height: 30px; width: 100%;" value="'.$row_dv->note.'" name="ghichu_dichvu[]" id="input_ghichu_dichvu_'.$count_dv.'" type="text" class="valid input_table"></td>
                                            <td><a  id="remove_item_dichvu_'.$count_dv.'" data-remove="'.$count_dv.'" style="padding: 0px 5px;" href="javascript:void(0)" class="red btn  btn-danger remove_item_dichvu"><i class="fa fa-trash-o"></i></if></a></td>

                                        </tr>';
                $count_dv++;
            }
        }
        $gia_net='';
        $gia_net_m1='';
        $gia_net_m2='';
        $gia_net_m3='';
        $ty_le_m1='';
        $ty_le_m2='';
        $ty_le_m3='';
        $loi_nhuan='';
        $loi_nhuan_m1='';
        $loi_nhuan_m2='';
        $loi_nhuan_m3='';
        $loi_nhuan_format='';
        $loi_nhuan_m1_format='';
        $loi_nhuan_m2_format='';
        $loi_nhuan_m3_format='';
        $gia_ban='';
        $gia_ban_m1='';
        $gia_ban_m2='';
        $gia_ban_m3='';
//        if()
        $total_dicvu_format= number_format((float)$total_dicvu, 0, ",", ".") . ' vnđ';
        if($data_tour[0]->loi_nhuan!=''){
            $loi_nhuan_format=number_format((float)$data_tour[0]->loi_nhuan, 0, ",", ".") . ' vnđ';
        }
        if($data_tour[0]->loi_nhuan_m1!=''){
            $loi_nhuan_m1_format=number_format((float)$data_tour[0]->loi_nhuan_m1, 0, ",", ".") . ' vnđ';
        }
        if($data_tour[0]->loi_nhuan_m2!=''){
            $loi_nhuan_m2_format=number_format((float)$data_tour[0]->loi_nhuan_m2, 0, ",", ".") . ' vnđ';
        }
        if($data_tour[0]->loi_nhuan_m3!=''){
            $loi_nhuan_m3_format=number_format((float)$data_tour[0]->loi_nhuan_m3, 0, ",", ".") . ' vnđ';
        }
        $item_tour=array(
            'total_dichvu'=>$total_dicvu,
            'total_dichvu_format'=>$total_dicvu_format,
            'gia_net'=>'',
            'gia_net_m1'=>'',
            'gia_net_m2'=>'',
            'gia_net_m3'=>'',
            'ty_le_m1'=>$data_tour[0]->ty_le_m1,
            'ty_le_m2'=>$data_tour[0]->ty_le_m2,
            'ty_le_m3'=>$data_tour[0]->ty_le_m3,
            'loi_nhuan'=>$data_tour[0]->loi_nhuan,
            'loi_nhuan_m1'=>$data_tour[0]->loi_nhuan_m1,
            'loi_nhuan_m2'=>$data_tour[0]->loi_nhuan_m2,
            'loi_nhuan_m3'=>$data_tour[0]->loi_nhuan_m3,
            'loi_nhuan_format'=>$loi_nhuan_format,
            'loi_nhuan_m1_format'=>$loi_nhuan_m1_format,
            'loi_nhuan_m2_format'=>$loi_nhuan_m2_format,
            'loi_nhuan_m3_format'=>$loi_nhuan_m3_format,
            'gia_ban'=>'',
            'gia_ban_m1'=>'',
            'gia_ban_m2'=>'',
            'gia_ban_m3'=>'',
        );
        $res=array(
            'success'=>1,
            'mess'=>'',
            'data'=>$item_tour,
            'list_dich_vu'=>$list_dich_vu
        );
    }
}
echo json_encode($res);