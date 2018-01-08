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
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR . "/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
$string='Không có thành viên trong phòng ban';
$array_res = array(
    'success' => 0,
    'mess' => 'Reset mật khẩu lỗi, vui lòng thử lại',
    'string_select'=>'',
    'string_li'=>''
);
$string_li='';
if (isset($_GET['Id'])) {
     $id = _returnGetParamSecurity('Id');
    $data_user = user_getByTop('', 'status=1 and user_role!=2 and phong_ban=' . $id, 'name asc');
    if ($data_user) {
        $string = '<option  value=""></option>';
        $selectted='';
        foreach ($data_user as $row) {
            $array_res['string_select'] .= '<option ' . $selectted . ' value="' . $row->id . '">' . $row->name . '</option>';
            $array_res['string_li'].='<li class="active-result" data-option-array-index="1" style="">Đỗ Sơn</li>';
        }
        $array_res['success']=1;
        $array_res['mess']='';
    }
}
echo json_encode($array_res);