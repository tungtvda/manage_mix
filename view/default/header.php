<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 8/15/14
 * Time: 3:43 PM
 */
require_once DIR.'/view/default/public.php';
function view_header($data=array())
{
    $title=$data['title'];
    require_once DIR . '/view/default/template/header.php';
}
