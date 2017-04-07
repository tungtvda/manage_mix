<?php
if (!defined('DIR')) require_once '../../../config.php';
if(!isset($_SESSION['user_id'])){
    echo 'Bạn không thể cập nhật dữ liệu';
    exit;
}
if (isset($_POST['message_birthday']) && isset($_POST['customer_birthday'])) {
    print_r($_POST);

} else {
    echo 'Cập nhật trạng thái thất bại, vui lòng kiểm tra lại các tham số';
}