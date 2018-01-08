<?php
if (!defined('DIR')) require_once '../../../config.php';

require_once DIR . '/model/tourService.php';
_returnCheckPermison(6,6);
if (_returnCheckAction(20) == 0) {
    echo '';
}
if (isset($_POST['id'])) {
    $id=_returnPostParamSecurity('id');
   $data=tour_getById($id);
    if(count($data)>0){
        $row_kh=$data[0];
            $price_number= $row_kh->price_number;
            $price_number_2= $row_kh->price_number_2;
            $price_number_3= $row_kh->price_number_3;

            $list_price_nguoi_lon=returnInput_price($price_number,'price_nguoi_lon_');
            $list_price_tre_em_511=returnInput_price($price_number_2,'price_tre_em_511_');
            $list_price_tre_em_5=returnInput_price($price_number_3,'price_tre_em_5_');
        echo $list_price_nguoi_lon.$list_price_tre_em_511.$list_price_tre_em_5;
    }else{
        echo '';
    }
} else {
    echo '';
}