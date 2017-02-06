<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 11/20/14
 * Time: 11:00 AM
 */
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$array_files=scandir(DIR.'/model');
foreach ($array_files as $filename) {
    $path = DIR.'/model/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}
//
$array_files=scandir(DIR.'/view/default');
foreach ($array_files as $filename) {
    $path = DIR.'/view/default/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}
function show_header($data1=array())
{
    $data=$data1;
    view_header($data);
}

function  show_left($data1=array(),$active='trangchu',$active_sub='trangchu')
{
    $data=array();
    $data['active']=$active;
    $data['active_sub']=$active_sub;
    $data['data_permison_module']=permison_module_getByTop('','id!=1 and status=1','position asc');
    view_left($data);
}
function  show_breadcrumb($data1=array())
{
    $data=$data1;
    view_breadcrumb($data);
}
function  show_navigation($data1=array())
{
    $data=array();
    view_navigation($data);
}

function  show_left2($data1=array())
{
    $data=array();

    $data['danhmuc1']=$data1['danhmuc1'];
    $data['doitac']=$data1['doitac'];
    $data['sanpham_left']=$data1['sanpham_left'];
    $data['tag']=$data1['tag'];

    view_left2($data);
}

function show_menu($data1=array(),$active='trangchu')
{
    $data=array();
    $data['config']=$data1['config'];
    $data['active']=$active;
    $data['menu']=$data1['menu'];
    $data['mangxahoi']=social_getByTop(1,'','');
    $data['danhmuc1']=danhmuc1_getByTop('','id!=1','position asc');
    $data['danhmuc_camnang']=danhmuc_tintuc_getByTop('','','position asc');
    view_menu($data);
}

function show_banner($data1=array())
{
    $data=array();
    $data['banner']=$data1['banner'];
    view_banner($data);
}

function show_footer($data1=array())
{
    $data=array();
    view_footer($data);
}
function show_script_table($data1=array(),$count=5)
{
    $data=array();
    $data['count']=$count;
    view_script_table($data);
}
function show_script_form($data1=array())
{
    $data=array();
    view_script_form($data);
}

