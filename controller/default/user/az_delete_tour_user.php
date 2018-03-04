<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$array_res = array(
    'success' => 0,
    'mess' => 'Bạn không thể xóa tour, vui lòng Ctrl+F5 và thử lại'
);
if (isset($_POST['id']) && isset($_POST['user_tiep_thi'])) {

    $id = _returnPostParamSecurity('id');
    $user_tiep_thi = _return_mc_decrypt(_returnPostParamSecurity('user_tiep_thi'));
    $data_user = user_getById($user_tiep_thi);
    if($data_user){
        $dataTour=tour_create_user_getByTop('1','user_id='.$data_user[0]->id.' && id='.$id,'id desc');
        if($dataTour){
            $tour=new tour_create_user();
            $tour->id=$id;
            tour_create_user_delete($tour);
            $array_res = array(
                'success' => 1,
                'mess' => 'Tour "'.$dataTour[0]->name_tour.'" đã được xóa khỏi hệ thống'
            );
        }
    }
}
echo json_encode($array_res);