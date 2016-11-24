<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_index($data = array())
{
    $asign = array();
    $asign['about_contents_short']=$data['about'][1]->contents_short;
    $asign['about_img']=$data['about'][1]->img;
    $asign['about_name']=$data['about'][1]->name;
    $asign['daubep_contents_short']=$data['about'][0]->contents_short;
    $asign['daubep_img']=$data['about'][0]->img;
    $asign['daubep_name']=$data['about'][0]->name;

    $asign['yeuthich'] ="";
    if(count($data['yeuthich'])>0)
    {
        $asign['yeuthich'] = print_item('menu_item_index', $data['yeuthich']);
    }

    $asign['giamgia'] ="";
    if(count($data['giamgia'])>0)
    {
        $asign['giamgia'] = print_item('menu_item_index', $data['giamgia']);
    }

    $asign['noibat'] ="";
    if(count($data['noibat'])>0)
    {
        $asign['noibat'] = print_item('menu_item_index', $data['noibat']);
    }

    $asign['noibat_2'] ="";
    if(count($data['noibat_2'])>0)
    {
        $asign['noibat_2'] = print_item('danhmuc_noirbat_index', $data['noibat_2']);
    }
    $asign['camnang_index'] ="";
    if(count($data['camnang_index'])>0)
    {
        $asign['camnang_index'] = print_item('camnang_index', $data['camnang_index']);
    }

    $asign['ykien'] ="";
    if(count($data['ykien'])>0)
    {
        $asign['ykien'] = print_item('ykien', $data['ykien']);
    }


    print_template($asign, 'index');
}



