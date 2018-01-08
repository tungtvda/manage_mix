<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/tourService.php';
require_once DIR.'/common/locdautiengviet.php';
if(!isset($_SESSION['user_id'])){
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
if (isset($_POST['name_tour_add']) && isset($_POST['price_tour_add']) && isset($_POST['price_tour_511_add']) && isset($_POST['price_tour_5_add'])) {
    $name_tour_add = _returnPostParamSecurity('name_tour_add');
    $price_tour_add = _returnPostParamSecurity('price_tour_add');
    $price_tour_511_add = _returnPostParamSecurity('price_tour_511_add');
    $price_tour_5_add = _returnPostParamSecurity('price_tour_5_add');
    if ($name_tour_add != '' && $price_tour_add != '' && $price_tour_511_add != '' && $price_tour_5_add != '') {
        $count_tour=tour_count('name="'.$name_tour_add.'"');
        if($count_tour>0){
            echo 'Tour "'.$name_tour_add.'" đã tồn tại trong hệ thống';
        }else{
            $tour_boj=new tour();
            $tour_boj->name=$name_tour_add;
            $tour_boj->name_url=LocDau($name_tour_add);
            $tour_boj->price=$price_tour_add;
            tour_insert($tour_boj);
            $data_tour=tour_getByTop('1','name="'.$name_tour_add.'"','id desc');
            if(count($data_tour)>0){
                echo $data_tour[0]->id;

            }else{
                echo 'Thêm tour thất bại, bạn vui lòng thử lại';
            }
        }

    } else {
        echo 'Thêm tour thất bại, vui lòng kiểm tra lại các tham số';
    }
} else {
    echo 'Thêm tour thất bại, vui lòng kiểm tra lại các tham số';
}