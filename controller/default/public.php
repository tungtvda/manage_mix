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
function show_header($title,$description,$keyword,$data1=array())
{
    $data=array();
    view_header($data);
}
function show_header2($title,$description,$keyword,$data1=array())
{
    $data=array();
    $data['Title']=$title;
    $data['Description']=$description;
    $data['Keyword']=$keyword;
    $data['config']=$data1['config'];
    $_SESSION['lienhe']=$data['config'][0]->Phone;
    view_header2($data);
}

function  show_slide($data1=array())
{
    $data=array();
    $data['slide']=slide_getByTop('','','position desc');
    view_slide($data);
}

function  show_left($data1=array())
{
    $data=array();
    view_left($data);
}
function  show_breadcrumb($data1=array())
{
    $data=array();
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
function  show_right($data1=array())
{
    $data=array();
    $data['config']=$data1['config'];
    $data['ykien']=ykien_getByTop('6','','View desc');
    $data['tour_noi_bat_trongnuoc']=tourtrongnuoc_getByTop('','NoiBat=1','Id desc');
    $data['tour_noi_bat_quocte']=tourquocte_getByTop('','NoiBat=1','Id desc');
    if(isset($_POST['dangky_phone']))
    {
        $name=addslashes(strip_tags($_POST['Name']));
        $phone=addslashes(strip_tags($_POST['Phone']));
        if($name!=""&&$phone!="")
        {
            $new =new dangky();
            $new->Name=$name;
            $new->Phone=$phone;
            dangky_insert($new);
            echo "<script>alert('You have successfully registered consultants, we will contact you as soon as possible, thank you!')</script>";
        }
        else{
            echo "<script>alert('Please enter your name and telephone number for advice')</script>";
        }

    }



    view_right($data);
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

