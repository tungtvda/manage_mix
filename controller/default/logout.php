<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}
if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
}
if(isset($_SESSION['user_role'])){
    unset($_SESSION['user_role']);
}
if(isset($_SESSION['user_permison_action'])){
    unset($_SESSION['user_permison_action']);
}
if(isset($_SESSION['user_permison_form'])){
    unset($_SESSION['user_permison_form']);
}
if(isset($_SESSION['user_permison_module'])){
    unset($_SESSION['user_permison_module']);
}
redict(_returnLinkDangNhap());


