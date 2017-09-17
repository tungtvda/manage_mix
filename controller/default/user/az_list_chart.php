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
$data = array();
$res = array(
    'success' => 0,
);
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['user_email']) && isset($_POST['user_code']) && isset($_POST['token_code'])&& isset($_POST['start_date'])&& isset($_POST['end_date'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $name = _return_mc_decrypt(_returnPostParamSecurity('name'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $user_code = _return_mc_decrypt(_returnPostParamSecurity('user_code'));
    $token_code = _return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $today_user =_returnPostParamSecurity('end_date');
    $start_date =_returnPostParamSecurity('start_date');
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        $datediff = abs(strtotime($start_date) - strtotime($today_user));
        $datediff= floor($datediff / (60*60*24));
        if($datediff){
            for($i=0;$i<=$datediff;$i++){
                $date_total = date('Y-m-d', strtotime('+'.$i.' days', strtotime($start_date)));
                        $dk_filter_booking = "created>='" . $date_total . " 00:00:00' and created<='" . $today_user . " 23:59:59' and  status=5 and user_tiep_thi_id=" . $user_tiep_thi;
                if($date_total==$today_user){
                    break;
                }
            }
        }
        exit;
//        $dk_filter_user_3 = "created>='" . $start_date . "' and created<='" . $today_user . " 23:59:59' and status=1 and type_tiep_thi=0 and user_tiep_thi_1=" . $user_tiep_thi;
//        $dk_filter_user_4 = "created>='" . $start_date . "' and created<='" . $today_user . " 23:59:59' and status=1 and type_tiep_thi=1 and  user_tiep_thi_2=" . $user_tiep_thi;
//        $dk_filter_booking = "created>='" . $start_date . "' and created<='" . $today_user . " 23:59:59' and  status=5 and user_tiep_thi_id=" . $user_tiep_thi;
    }

}
echo json_encode($res);