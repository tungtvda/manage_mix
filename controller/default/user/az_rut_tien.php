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
$res = array(
    'success' => 0,
    'mess' => 'Lỗi! bạn vui lòng F5 và thử lại',
);

if (isset($_POST['price'])&&isset($_POST['input_yeu_cau']) && isset($_POST['form_noti'])) {
    $id = '';
    $name = '';
    $user_email = '';
    $user_code = '';
    $token_code = '';
    foreach($_POST['form_noti'] as $row_check){
        if(isset($row_check['name']) && isset($row_check['value'])){
            if($row_check['name']=='id'){
                $id = _return_mc_decrypt($row_check['value']);
            }
            if($row_check['name']=='name'){
                $name = _return_mc_decrypt($row_check['value']);
            }
            if($row_check['name']=='user_email'){
                $user_email = _return_mc_decrypt($row_check['value']);
            }
            if($row_check['name']=='user_code'){
                $user_code = _return_mc_decrypt($row_check['value']);
            }
            if($row_check['name']=='token_code'){
                $token_code = _return_mc_decrypt($row_check['value']);
            }
        }
    }
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
       $hoa_hong=$data_check_exist_user[0]->hoa_hong;
        $price=_returnPostParamSecurity('price');
        $yeu_cau=_returnPostParamSecurity('input_yeu_cau');
        if($price==''){
            $res['mess']='Bạn vui lòng nhập số tiền cần rút';
        }else{
            if($price>$hoa_hong){
                $res['mess']='Số tiền bạn rút đã vượt quá số tiền tích lũy';
            }else{
                $dk='user_tiep_thi_id='.$id.' and status=0 and date_send>="'._returnGetDate().' 00:00:00" and date_send<="'._returnGetDate().' 23:59:59"';
                $data_check_rut_tien=rut_tien_getByTop(1,$dk,'id desc');
                if($data_check_rut_tien){
                    $res['mess']='Bạn đã gửi yêu cầu rút tiền, bạn vui lòng đợi AZBOOKING.VN xác nhận';
                }else{
                    $new=new rut_tien();
                    $new->user_tiep_thi_id=$id;
                    $new->price=$price;
                    $new->yeu_cau=$yeu_cau;
                    $code=_randomBooking('#','rut_tien_count','code');
                    $new->code=$code;
                    $new->date_send=_returnGetDateTime();
                    rut_tien_insert($new);
                    $data_insert=rut_tien_getByTop('1','code="'.$code.'"','');
                    if(count($data_insert)>0){
                        $message='';
                        $name_noti='Thành viên  '.$name.' đã yêu cầu rút tiền hoa hồng '.number_format((int)$hoa_hong,0,",",".").' vnđ';
                        $link_noti='/rut-tien/sua?noti=1&confirm=1&id='._return_mc_encrypt($data_insert[0]->id, ENCRYPTION_KEY);
                        $data_list_user_admin=user_getByTop('','user_role=1 and status=1','id desc');
                        if(count($data_list_user_admin)>0){
                            foreach($data_list_user_admin as $row_admin){
                                _insertNotification($name_noti,0,$row_admin->id,$link_noti,0,'');
                            }
                        }
                        $subject='Xác nhận rút tiền hoa hồng';
                        $message.=$name_noti='Thành viên  '.$name.' đã yêu cầu rút tiền hoa hồng '.number_format((int)$hoa_hong,0,",",".").' vnđ';
                        $message.='</br><a>Bạn vui lòng truy cập <a href="'.SITE_NAME.$link_noti.'">đường link</a> để xác nhận rút tiền hoa hồng</p>';
                        SendMail(SEND_EMAIL, $message, $subject);
//                        SendMail('tungtv.soict@gmail.com', $message, $subject);
//                        $mess_log='Khách hàng '.$name_customer.' đã thêm một đơn hàng từ '.$nguon_tour;
//                        _insertLog(0,6,6,21,$id_booking,'','',$mess_log);
                        $res['success']=1;
                        $res['data']=$data_insert[0];
                    }

                }

            }
        }

    }
}

echo json_encode($res);