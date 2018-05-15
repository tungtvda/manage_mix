<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../../config.php';
}
require_once DIR.'/controller/default/public.php';
$success= _checkSecurityParamCurl($_POST);
$data_res=array(
    'mess'=>'Không thể kết nối dữ liệu',
    'success'=>0,
    'data'=>array(
        'name'=>'Azbooking.vn',
        'domain'=>'azbooking.vn',
        'logo'=>'http://manage.mixmedia.vn/view/admin/Themes/kcfinder/upload/images/config/logoazbooking.vn.png',
        'icon'=>'http://manage.mixmedia.vn/view/admin/Themes/kcfinder/upload/images/config/favicon.png',
        'banner'=>'http://manage.mixmedia.vn/view/admin/Themes/kcfinder/upload/images/config/travel.gif',
        'link_banner'=>'http://azbooking.vn/',
        'banner_qc'=>'http://manage.mixmedia.vn/view/admin/Themes/kcfinder/upload/images/config/banner.jpg',
        'link_banner_qc'=>'http://azbooking.vn/',
        'link_khoi_hanh'=>'http://azbooking.vn/',
        'code_email'=>'',
        'email'=>'tiepthilienket.azbooking@gmail.com',
        'email_reply'=>'tiepthilienket.azbooking@gmail.com',
        'chu_ky_email'=>'',
    )
);
if($success){

    $domain=_returnGetParamSecurity('domain');
    if(!$domain){
        $domain=SITE_NAME_AZ;
    }
    $domain=str_replace('http://','',$domain);
    $domain=str_replace('https://','',$domain);
    $domain=str_replace('https://www.','',$domain);
    $domain=str_replace('http://www.','',$domain);
    $config=thuong_hieu_getByTop('1','active=1 and domain="'.$domain.'"','id desc');
    if($config){
        $data_res['data']=array(
            'name'=>$config[0]->name,
            'domain'=>$config[0]->domain,
            'logo'=>_returnDomainUrlImage(SITE_NAME,$config[0]->logo),
            'icon'=>_returnDomainUrlImage(SITE_NAME,$config[0]->icon),
            'banner'=>_returnDomainUrlImage(SITE_NAME,$config[0]->banner),
            'link_banner'=>$config[0]->link_banner,
            'banner_qc'=>_returnDomainUrlImage(SITE_NAME,$config[0]->banner_qc),
            'link_banner_qc'=>$config[0]->link_banner_qc,
            'link_khoi_hanh'=>$config[0]->link_khoi_hanh,
//            'code_email'=>_return_mc_encrypt($config[0]->mat_khau_ung_dung,'ENCRYPTION_KEY'),
            'email'=>$config[0]->email,
            'email_reply'=>$config[0]->email_reply,
            'chu_ky_email'=>$config[0]->chu_ky_email,
        );
    }
}
echo json_encode($data_res);
?>


