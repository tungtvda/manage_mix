<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../../config.php';
}
require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
require_once(DIR."/common/hash_pass.php");
require_once DIR . '/common/class.phpmailer.php';
require_once(DIR . "/common/Mail.php");
$data = array();
_returnCheckPermison(7, 14);

//$action_link=str_replace('manage_mix','',$_SERVER['REQUEST_URI']);
//$action_link=str_replace('them','',$action_link);
//$action_link=str_replace('/','',$action_link);


if(isset($_GET['type'])&&$_GET['type']==1){
    $action_link='chuc-mung-sinh-nhat';
    $data['type']=1;
    $active_tab_left='chuc_mung_sinh_nhat';
    $name_bread="Email - SMS chúc mừng sinh nhật";
}
else{
    $action_link='cham-soc-khach-hang';
    $data['type']=0;
    $active_tab_left='cham_soc_khach_hang';
    $name_bread="Email - SMS chăm sóc khách hàng";
}
if(isset($_GET['id'])&&$_GET['id']!='')
{
    $data['action']=2;
    if (_returnCheckAction(30) == 0) {
        redict(_returnLinkDangNhap());
    }
//    echo $_GET['id'];
     $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    $data['data_user']=sms_email_getById($id);

    if(count($data['data_user'])==0)
    {
        redict(SITE_NAME.'/'.$action_link.'/');
    }
    $url_bread = '<li><a href="'.SITE_NAME.'/'.$action_link.'/">'.$name_bread.'</a></li><li class="active">Chỉnh sửa Email - SMS "'.$data['data_user'][0]->code.'"</li>';
    $data['title'] = 'Chỉnh sửa Email - SMS "'.$data['data_user'][0]->code.'"';

}else{
    if (_returnCheckAction(29) == 0) {
        redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
    }
    $data['data_user']='';
    $data['action']=1;
    $url_bread = '<li><a href="'.SITE_NAME.'/'.$action_link.'/">'.$name_bread.'</a></li><li class="active">Soạn tin</li>';
    $data['title'] = 'Soạn Email - SMS';
}

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$data['breadcrumbs'] = $url_bread;
$data['module_valid'] = "email";
$data_dk_fill='status=1';
if($_SESSION['user_role']==0)
{
    $data['dk_find'] = " and created_by=".$_SESSION['user_id'];
    $data_dk_fill=' and created_by='.$_SESSION['user_id'];
}
$count=6;
$data['list_short_code']=short_code_getByTop('','type=1','position asc');
$data['list']=customer_getByTop('',$data_dk_fill,'updated desc');
show_header($data);
show_left($data, 'email', $active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_email_marketing_themmoi($data);
show_footer($data);

show_valid_form($data);
show_script_form($data);
show_script_table($data,$count);

