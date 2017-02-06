<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_user_phanquyen($data = array())
{
    $asign = array();
    $user_id=$data['id_user'];
    $id_user=_return_mc_decrypt($data['id_user'], ENCRYPTION_KEY);
    $data_user=user_getById($id_user);
    if(count($data_user)==0)
    {
        redict(_returnLinkDangNhap());
    }
    $user_name=$data_user[0]->name;
    require_once DIR . '/view/default/template/module/user/phanquyen_list.php';
}



