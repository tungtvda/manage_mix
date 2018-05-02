<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nguyenvietdinh
 * Date: 2/6/14
 * Time: 3:51 PM
 * To change this template use File | Settings | File Templates.
 */
require_once DIR.'/common/cls_fast_template.php';
require_once DIR.'/common/locdautiengviet.php';
function print_template($data=array(),$tem)
{
    $ft=new FastTemplate(DIR.'/view/default/template');
    $ft->define($tem,$tem.'.tpl');
    $ft->assign('SITE-NAME',SITE_NAME);
    if(count($data)>0)
    {
        $keys=array_keys($data);
        foreach($keys as $item)
        {
            $ft->assign($item,$data[$item]);
        }
    }
    print $ft->parse_and_return($tem);
}

function print_item($file,$ListItem,$LocDau=false,$LocDauAssign=false,$numberformat=false)
{
    if(count($ListItem)>0)
    {
        $array_var=get_object_vars($ListItem[0]);
        $var_name_array=array_keys($array_var);
        $result='';
        $ft=new FastTemplate(DIR.'/view/default/template/item');
        $ft->define('item',$file.'.tpl');
        $ft->assign('SITE-NAME',SITE_NAME);
        $dem=1;
        foreach($ListItem as $item)
        {

            foreach($var_name_array as $var)
            {
                if($LocDau!=false)
                {
                    if($LocDau==$var)
                    {
                        $ft->assign($LocDauAssign,LocDau($item->$var));
                    }
                }

                if($numberformat!=false)
                {
                    if($numberformat==$var)
                    {
                        $ft->assign($var,number_format($item->$var,0,'.','.'));
                    }
                    else
                    {
                        $ft->assign($var,$item->$var);
                    }
                }
                else
                {
                    $ft->assign($var,$item->$var);
                }
            }
            if(get_class($item)=='danhgia')
            {
                $data['config_logo']=config_getByTop(1,'','');
                if(count($data['config_logo'])>0){
                    $ft->assign('icon',$data['config_logo'][0]->Icon);
                }
                $ft->assign('start',sao_detail($item->start));
            }
            if(get_class($item)=='sanpham')
            {
                $content=$item->content;
                if (strlen($content) > 200) {
                    $ten1=strip_tags($content);

                    $ten = substr($ten1, 0, 200);
                    $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                    $ft->assign('content',$name);
                } else {
                    $ft->assign('content',strip_tags($content));
                }
                $sales='';
                $price_sales='';
                if($item->price_sale!=''){
                    $sales='<span class="onsale">Sale!</span>';
                    $price_sales='<span class="woocommerce-Price-currencySymbol"></span>'.number_format($item->price_sale,0,",",".").' vnđ</span>';
                }
                $ft->assign('price_format',number_format($item->price,0,",","."));
                $ft->assign('price_sales_format',$price_sales);
                $ft->assign('sales',$sales);
                $ft->assign('link',link_sanphamdetail($item));
                $ft->assign('start',sao($item->start));
            }
            if(get_class($item)=='danhmuc_tintuc') {
//                $ft->assign('link',link_news($item));
//                $ft->assign('view_all', returnLanguage('view_all', 'VIEW ALL'));
            }
            if(get_class($item)=='news')
            {
                $name_danhmuc='Cẩm nang';
                $link_danhmuc=SITE_NAME.'/cam-nang/';
                if($item->danhmuc_id!=0)
                {
                    $data_danhmuc_camnang=danhmuc_tintuc_getByTop('1','id='.$item->danhmuc_id,'id desc');
                    if(count($data_danhmuc_camnang)>0){
                        $name_danhmuc=$data_danhmuc_camnang[0]->name;
                        $link_danhmuc=SITE_NAME.'/cam-nang/'.$data_danhmuc_camnang[0]->name_url;
                    }
                }
                $ft->assign('name_danhmuc',$name_danhmuc);
                $ft->assign('link_danhmuc',$link_danhmuc);
                $ft->assign('link',link_newsdetail($item));
                $content=$item->content;
                if (strlen($content) > 400) {
                    $ten1=strip_tags($content);

                    $ten = substr($ten1, 0, 400);
                    $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                    $ft->assign('content',$name);
                } else {
                    $ft->assign('content',strip_tags($content));
                }
            }
            if(get_class($item)=='tuyendung')
            {
                $link_danhmuc=SITE_NAME.'/tuyen-dung/';
                $ft->assign('name_danhmuc','Tuyển dụng');
                $ft->assign('link_danhmuc',$link_danhmuc);
                $ft->assign('link',link_tuyendung($item));
                $content=$item->content;
                if (strlen($content) > 400) {
                    $ten1=strip_tags($content);

                    $ten = substr($ten1, 0, 400);
                    $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                    $ft->assign('content',$name);
                } else {
                    $ft->assign('content',strip_tags($content));
                }
            }


                $dem=$dem+1;
            $result.=$ft->parse_and_return('item');
        }
        return $result;
    }
    else
    {
        return '';
    }

}
function link_sanpham($app)
{
    return SITE_NAME.'/thuc-don/'.$app->name_url.'/';
}
function link_sanphamdetail($app)
{
    return SITE_NAME.'/'.$app->name_url.'.html';
}

function link_news($app)
{
    return SITE_NAME.'/news/'.$app->name_url.'/';
}
function link_camnang($app)
{
    return SITE_NAME.'/cam-nang/'.$app->name_url.'/';
}
function link_newsdetail($app)
{
    return SITE_NAME.'/cam-nang/'.$app->name_url.'.html';
}
function link_tuyendung($app)
{
    return SITE_NAME.'/tuyen-dung/'.$app->name_url.'.html';
}


function sao($start)
{
    $sao='<span style="width:0%"> <strong class="rating">0</strong></span>';
    switch($start){
        case 0.5:
            $sao='<span style="width:10%"> <strong class="rating">0.5</strong></span>';
            break;
        case 1:
            $sao='<span style="width:20%"> <strong class="rating">1</strong></span>';
            break;
        case 1.5:
            $sao='<span style="width:30%"> <strong class="rating">1.5</strong></span>';
            break;
        case 2:
            $sao='<span style="width:38%"> <strong class="rating">2</strong></span>';
            break;
        case 2.5:
            $sao='<span style="width:45%"> <strong class="rating">2.5</strong></span>';
            break;
        case 3:
            $sao='<span style="width:55%"> <strong class="rating">3</strong></span>';
            break;
        case 3.5:
            $sao='<span style="width:65%"> <strong class="rating">3.5</strong></span>';
            break;
        case 4:
            $sao='<span style="width:70%"> <strong class="rating">4</strong></span>';
            break;
        case 4.5:
            $sao='<span style="width:80%"> <strong class="rating">4.5</strong></span>';
            break;
        case 5:
            $sao='<span style="width:100%"> <strong class="rating">5</strong></span>';
            break;
    }
    return $sao;
}
function sao_detail($start)
{
    $sao='<span style="width:0%"> <strong class="rating">0</strong></span>';
    switch($start){
        case 0.5:
            $sao='<span style="width:6%"> <strong class="rating">0.5</strong></span>';
            break;
        case 1:
            $sao='<span style="width:12%"> <strong class="rating">1</strong></span>';
            break;
        case 1.5:
            $sao='<span style="width:20%"> <strong class="rating">1.5</strong></span>';
            break;
        case 2:
            $sao='<span style="width:27%"> <strong class="rating">2</strong></span>';
            break;
        case 2.5:
            $sao='<span style="width:33%"> <strong class="rating">2.5</strong></span>';
            break;
        case 3:
            $sao='<span style="width:39%"> <strong class="rating">3</strong></span>';
            break;
        case 3.5:
            $sao='<span style="width:46%"> <strong class="rating">3.5</strong></span>';
            break;
        case 4:
            $sao='<span style="width:51%"> <strong class="rating">4</strong></span>';
            break;
        case 4.5:
            $sao='<span style="width:57%"> <strong class="rating">4.5</strong></span>';
            break;
        case 5:
            $sao='<span style="width:63%"> <strong class="rating">5</strong></span>';
            break;
    }
    return $sao;
}

