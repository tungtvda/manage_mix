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
    }

}



