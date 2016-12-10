<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 8/15/14
 * Time: 3:43 PM
 */
require_once DIR.'/view/default/public.php';
function view_left($data=array())
{
    $asign=array();
    $trangchu_active = ($data['active'] == 'trangchu') ? 'active' : '';
    $user_active = ($data['active'] == 'user') ? 'active open' : '';

    $user_active_sub = ($data['active_sub'] == 'user_list') ? 'active' : '';
    require_once DIR . '/view/default/template/left.php';
}
