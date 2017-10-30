<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function view_valid_form($data = array())
{
    switch ($data['module_valid']){
        case 'user':
            require_once DIR . '/view/default/template/module/user/valid.php';
            break;
        case 'customer':
            require_once DIR . '/view/default/template/module/customer/valid.php';
            break;
        case 'booking':
            require_once DIR . '/view/default/template/module/booking/valid.php';
            break;
        case 'email':
            require_once DIR . '/view/default/template/module/email_marketing/valid.php';
            break;
        case 'ruttien':
            require_once DIR . '/view/default/template/module/ruttien/valid.php';
            break;
    }

}



