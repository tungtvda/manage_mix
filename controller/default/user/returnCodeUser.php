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
if(!isset($_SESSION['user_role']))
{
   echo 0;
    exit;
}
if($_GET['key_code'] && $_GET['key_code']=='az'){
    echo _randomBooking('az', 'user_count');
    exit;
}
echo 0;
