<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../../config.php';
}
require_once DIR.'/controller/default/public.php';
$data=array();
_returnCheckPermison(6,6);

$url_bread='<li class="active">Khách hàng</li>';
$data['breadcrumbs']=$url_bread;
$count=13;


if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['mr']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['mobi'])) {
    $name = _returnPostParamSecurity('name');
    $code = _returnPostParamSecurity('code');
    $mr = _returnPostParamSecurity('mr');
    $birthday = _returnPostParamSecurity('birthday');
    $email = _returnPostParamSecurity('email');
    $address = _returnPostParamSecurity('address');
    $phone = _returnPostParamSecurity('phone');
    $mobi = _returnPostParamSecurity('mobi');
    $created = _returnPostParamSecurity('created');
    $content = _returnPostParamSecurity('content');
    $time = _returnPostParamSecurity('time');
    $avatar = '';

    if ($name != "" && $code != '' && $email != '' && $address != '' && $phone != '' && $mobi != '' && $created !='' && $content !='') {

            $dk_check_user = "or email ='" . $email . "'";
            $data_check_exist_user = customer_getByTop('', $dk_check_user, 'id desc');
            if (count($data_check_exist_user) > 0) {
                echo "<script>alert('Mã khách hàng, email đã tồn tại trong hệ thống, vui lòng điền lại thông tin khác')</script>";
            } else {
                $folder = LocDau($email);
                $target_dir = _returnFolderRoot() . "/view/default/themes/uploads/customer/" . $folder . '/';
                $avatar = _returnUploadImg($target_dir, 'avatar', "/view/default/themes/uploads/customer/" . $folder . '/');
                if ($avatar === 0) {
                    $avatar = '';
                }
                $dangky = new customer();
                $dangky->name = $name;
                $dangky->code = $code;
                $dangky->mr = $mr;
                $dangky->birthday = date("Y-m-d", strtotime($birthday));
                $dangky->email = $email;
                $dangky->address = $address;
                $dangky->created = _returnGetDateTime();
                $dangky->updated = _returnGetDateTime();
                $dangky->avatar = $avatar;
                $dangky->mobi = $mobi;
                $dangky->status = 1;
                $dangky->phone = $phone;
                $dangky->created_by = $_SESSION['user_id'];
                customer_insert($dangky);
                $customer = customer_getByTop(1,'','Id DESC');
                $idCustomer = $customer[0]->id;
                $newtransaction = new transaction();
                $newtransaction->customer_id=$idCustomer;
                $newtransaction->created_by=$_SESSION['user_id'];
                $newtransaction->created_at = _returnGetDateTime();
                $newtransaction->updated_at = _returnGetDateTime();
                transaction_insert($newtransaction);

                $transaction = transaction_getByTop(1,'','Id DESC');
                $idTrans = $transaction[0]->id;
                $newtranscus= new customer_transaction();
                $newtranscus->transaction_id=$idTrans;
                $newtranscus->customer_id=$idCustomer;
                $newtranscus->description=$content;
                $newtranscus->created_by=$_SESSION['user_id'];;
                $newtranscus->updated_by=$_SESSION['user_id'];;
                $newtranscus->created_at = _returnGetDateTime();
                $newtranscus->updated_at = _returnGetDateTime();
                $newtranscus->date = $created;
                $newtranscus->time = $time;
                customer_transaction_insert($newtranscus);

            }


    } else {
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';

    }
};

if (isset($_POST['user_trans']) && isset($_POST['content_trans']) && isset($_POST['time_trans']) && isset($_POST['created_trans'])) {

    $created = _returnPostParamSecurity('created_trans');
    $content = _returnPostParamSecurity('content_trans');
    $time = _returnPostParamSecurity('time_trans');
    $user_id = _returnPostParamSecurity('user_trans');

    if ($created !='' && $content !='' && $user_id!='') {

        $dk_check_user = "customer_id ='" . $user_id . "'";
        $data_check_exist_user = transaction_getByTop('', $dk_check_user, 'id desc');
        if (count($data_check_exist_user) > 0) {
            $idTrans = $data_check_exist_user[0]->id;
            $newtranscus= new customer_transaction();
            $newtranscus->transaction_id=$idTrans;
            $newtranscus->customer_id=$user_id;
            $newtranscus->description=$content;
            $newtranscus->created_by=$_SESSION['user_id'];;
            $newtranscus->updated_by=$_SESSION['user_id'];;
            $newtranscus->created_at = _returnGetDateTime();
            $newtranscus->updated_at = _returnGetDateTime();
            $newtranscus->date = $created;
            $newtranscus->time = $time;
            customer_transaction_insert($newtranscus);
        } else {

            $newtransaction = new transaction();
            $newtransaction->customer_id=$user_id;
            $newtransaction->created_by=$_SESSION['user_id'];
            $newtransaction->created_at = _returnGetDateTime();
            $newtransaction->updated_at = _returnGetDateTime();
            transaction_insert($newtransaction);
            $transaction = transaction_getByTop(1,'','Id DESC');
            $idTrans = $transaction[0]->id;
            $newtranscus= new customer_transaction();
            $newtranscus->transaction_id=$idTrans;
            $newtranscus->customer_id=$user_id;
            $newtranscus->description=$content;
            $newtranscus->created_by=$_SESSION['user_id'];;
            $newtranscus->updated_by=$_SESSION['user_id'];;
            $newtranscus->created_at = _returnGetDateTime();
            $newtranscus->updated_at = _returnGetDateTime();
            $newtranscus->date = $created;
            $newtranscus->time = $time;
            customer_transaction_insert($newtranscus);

        }


    } else {
        echo '<script>alert("Bạn vui lòng điền đầy đủ thông tin đăng ký")</script>';

    }
}

$data['list']=transaction_getByAll();
foreach ($data['list'] as $item){
    $item->customer= customer_getById($item->customer_id)[0];
}
$data['customerList']=customer_getByAll();

$data['module_valid'] = "transaction";
$data['title_print'] = 'Giao dịch khách hàng';
$data['title']='Giao dịch khách hàng';
show_header($data);
show_left($data,'khach_hang','giao_dich_khach_hang');
show_breadcrumb($data);
show_navigation($data);
show_transaction_list($data);
show_footer($data);
show_valid_form($data);
show_script_table($data,$count);