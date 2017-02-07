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

_returnCheckPermison(3,2);
if(_returnCheckAction(1)==0){
    redict(_returnLinkDangNhap());
}

$_SESSION['link_redict']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_bread='<li class="active">Thêm nhân viên</li>';
$data['breadcrumbs']=$url_bread;
$data['title']='Thêm nhân viên';
$data['module_valid']="user";
$count=8;
show_header($data);
show_left($data,'user','user_list');
show_breadcrumb($data);
show_navigation($data);
show_user_themmoi($data);
show_footer($data);
show_valid_form($data);
show_script_form($data);
if(isset($_FILES['avatar'])){
//    print_r($_FILES['avatar']);
    $target_dir = _returnFolderRoot()."/view/default/themes/uploads/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
//    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
//    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["avatar"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["avatar"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}