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
    'mess' => '',
);
if (isset($_POST['user']) && isset($_POST['form_noti'])) {
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
        $user =new user((array)$data_check_exist_user[0]);
        foreach($_POST['user'] as $row_user){
            $data[$row_user['name']]= addslashes(strip_tags(trim($row_user['value'])));
        }
        $user->name=$data['full_name'];
        if($data['birthday']!=''){
            $user->birthday=date('Y-m-d', strtotime($data['birthday']));
        }
        if($user->name==''){
            $res['mess'].="<p>Bạn vui lòng nhập họ tên</p>";
        }
        $user->phone=$data['user_phone'];
        if($user->phone==''){
            $res['mess'].="Bạn vui lòng nhập số điện thoại";
        }
        $user->mobi=$data['mobi'];
        $user->gender=$data['gender'];
        $user->skype=$data['skype'];
        $user->facebook=$data['facebook'];
        $user->address=$data['address_user'];
        $user->cmnd=$data['cmnd'];
        if($data['date_range_cmnd']!=''){
            $user->date_range_cmnd=date('Y-m-d', strtotime($data['date_range_cmnd']));
        }
        $user->issued_by_cmnd=$data['issued_by_cmnd'];
        $user->account_number_bank=$data['account_number_bank'];
        $user->bank=$data['bank'];
        $user->open_bank=$data['open_bank'];
        $user->note=$data['note'];
        if($res['mess']==''){
            user_update($user);
            $res['success']=1;
        }
    }
}
echo json_encode($res);