<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/thuong_hieuService.php';

if(isset($_GET['id'])){

    $id=_returnGetParamSecurity('id');
    $data_thuong_hieu=thuong_hieu_getById($id);
    $doman='azbooking.vn';
    if($data_thuong_hieu){
        $doman=$data_thuong_hieu[0]->domain;
    }
    if(!strpos($doman,"http")){
        $doman='http://'.$doman;
    }
    $array_check_noti = array(
        'domain'=>$doman,
    );
    $content_noti= returnCURL($array_check_noti, $doman.'/noi-dung-email/danh-sach-tour-giam-gia.html');
  echo $content_noti;
//    $content_noti=json_decode($content_noti,true);

}
