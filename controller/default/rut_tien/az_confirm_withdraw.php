<?php
/**
 * Created by PhpStorm.
 * User: Duc Tho
 * Date: 1/1/2018
 * Time: 10:58 PM
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
$res = array(
    'success' => 0,
    'mess' => 'Lỗi! bạn vui lòng F5 và thử lại',
);
if(isset($_POST['id']) && isset($_POST['number_confirm']) && isset($_POST['input_date_confirm']) && isset($_POST['timepicker']) && isset($_POST['input_mo_ta'])){
    $id= $_POST['id'];
    $price_confirm= $_POST['number_confirm'];

    $record = rut_tien_getById($id);
    if(count($record)>0){
       if($record[0]->status==1){
           $res = array(
               'success' => 0,
               'mess' => 'Lỗi! Yêu cầu đã được xác nhận',
           );
       }else{
           if($record[0]->price < $price_confirm){
               $res = array(
                   'success' => 0,
                   'mess' => 'Lỗi! bạn vui lòng nhập lại số tiền',
               );
           }
           else{
               $user = user_getById($record[0]->user_tiep_thi_id);
               if(count($user)>0){
                   if($user[0]->status==1){
                       if($user[0]->hoa_hong > $price_confirm && $price_confirm > 0){
                           $withdraw = new rut_tien((array)$record[0]);
                           $withdraw->price_confirm=$price_confirm;
                           $withdraw->status=1;
                           $withdraw->admin_confirm_id=$_SESSION['user_id'];
                           $withdraw->yeu_cau_confirm=addslashes(strip_tags($_POST['input_mo_ta']));
                           $withdraw->date_confirm=date("Y-m-d", strtotime($_POST['input_date_confirm'])).' '.$_POST['timepicker'];
                           rut_tien_update($withdraw);

                           $user_after = new user((array)$user[0]);
                           $user_after->hoa_hong=(($user[0]->hoa_hong) - $price_confirm);
                           user_update($user_after);
                           $res = array(
                               'success' => 1,
                               'mess' => 'Congratulation. you withdraw money successful',
                           );
                       }else{
                           $res = array(
                               'success' => 0,
                               'mess' => 'Lỗi! bạn vui lòng nhập lại số tiền ',
                           );
                       }
                   }else{
                       $res = array(
                           'success' => 0,
                           'mess' => 'Lỗi! Tài khoản không active.',
                       );
                   }

               }else{
                   $res = array(
                       'success' => 0,
                       'mess' => 'Lỗi! Tài khoản không tồn tại.',
                   );
               }
           }
       }
    }else{
        $res = array(
            'success' => 0,
            'mess' => 'Lỗi! bản ghi không tồn tại',
        );
    }

}
echo json_encode($res);