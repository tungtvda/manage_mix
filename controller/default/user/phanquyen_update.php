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
if(isset($_GET['id'])){
    $data=(json_decode($_GET['id'],true));
    foreach($data as $row)
    {
        if(isset($row['check_action'])&&$row['check_action']==1){
            print_r($row);
        }
    }
}