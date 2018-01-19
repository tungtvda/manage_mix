<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/thuong_hieuService.php';

if(isset($_GET['id'])){
    $id=_returnGetParamSecurity('id');
    $data_thuong_hieu=thuong_hieu_getById($id);
    echo($data_thuong_hieu[0]->chu_ky_email);
}
