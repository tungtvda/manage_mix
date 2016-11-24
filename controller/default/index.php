<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}

require_once DIR.'/controller/default/public.php';
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data['menu']=menu_getByTop('','','');
$data['config']=config_getByTop(1,'','');

//$data['tour_quocte_ghepdoi']=tourtrongnuoc_getByTop('','TourGhepDoi=1 and LoaiTour=2','Id desc');
//$data['khachsan_index']=khachsan_getByTop('','NoiBat=1','Id desc');
//$data['thuexe_index']=thuexe_getByTop('','NoiBat=1','Id desc');
//$data['ykien_index']=ykien_getByTop('6','','View desc');

$data['about']=info_getByTop('','','id desc');

$data['yeuthich']=sanpham_getByTop(5,'','num_like desc');
$data['giamgia']=sanpham_getByTop(5,'price_sale!=""','id desc');
$data['noibat']=sanpham_getByTop(5,'highlights=1','id desc');
$data['noibat_2']=sanpham_getByTop(8,'highlights=1','id desc');
$data['camnang_index']=news_getByTop(4,'','created desc');
$data['ykien']=ykien_getByTop('','','id desc');

$title=$data['menu'][0]->title;
$description= $data['menu'][0]->keyword;
$keyword=$data['menu'][0]->description;
$title=($title)?$title:'Viet Gardens';
$description=($description)?$description:'Viet Gardens ';
$keywords=($keyword)?$keyword:'Viet Gardens ';

show_header($title,$description,$keywords,$data);
show_menu($data,'home');
show_slide($data);
show_index($data);
show_footer($data);
show_link_js($data);
booking_table();