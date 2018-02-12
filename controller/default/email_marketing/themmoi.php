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
require_once DIR . '/email_template/tem_01_2018/index.php';
$data['email_tem'] = returnEmail01218();

$data['email_tem']=_returnReplaceEmailTem($data['email_tem']);
//$action_link=str_replace('manage_mix','',$_SERVER['REQUEST_URI']);
//$action_link=str_replace('them','',$action_link);
//$action_link=str_replace('/','',$action_link);
$data_dk_fill='status=1';
if($_SESSION['user_role']==0)
{
    $data['dk_find'] = " and created_by=".$_SESSION['user_id'];
    $data_dk_fill=' and created_by='.$_SESSION['user_id'];
}

if(isset($_GET['type'])&&$_GET['type']==1){
    _returnCheckPermison(7,13);
    $action_link='chuc-mung-sinh-nhat';
    $data['type']=1;
    $active_tab_left='chuc_mung_sinh_nhat';
    $name_bread="Email - SMS chúc mừng sinh nhật";
    $data['list']=customer_getByTop('',$data_dk_fill,'updated desc');
    $data['list_short_code']=short_code_getByTop('','type=1','position asc');
}
else{
    if(isset($_GET['type'])&&$_GET['type']==2){
        _returnCheckPermison(7,18);
        $action_link='cham-soc-thanh-vien';
        $data['type']=2;
        $active_tab_left='cham_soc_thanh_vien';
        $name_bread="Email - SMS chăm sóc thành viên tiếp thị";
        $data['list']=user_getByTop('',$data_dk_fill.' and user_role=2','updated desc');
        $data['list_short_code']=short_code_getByTop('','type=2','position asc');
    }else{
        $data['list']=customer_getByTop('',$data_dk_fill,'updated desc');
        _returnCheckPermison(7, 14);
        $action_link='cham-soc-khach-hang';
        $data['type']=0;
        $active_tab_left='cham_soc_khach_hang';
        $name_bread="Email - SMS chăm sóc khách hàng";
        $data['list_short_code']=short_code_getByTop('','type=1','position asc');
    }

}
if(isset($_GET['id'])&&$_GET['id']!='')
{
    if(isset($_GET['type'])&&$_GET['type']==1){
        if (_returnCheckAction(26) == 0) {
            redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
        }
    }else{
        if(isset($_GET['type'])&&$_GET['type']==2){
            if (_returnCheckAction(47) == 0) {
                redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
            }
        }else{
            if (_returnCheckAction(30) == 0) {
                redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
            }
        }
    }
    $data['action']=2;

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
    if(isset($_GET['type'])&&$_GET['type']==1){
        if (_returnCheckAction(26) == 0) {
            redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
        }
    }else{
        if(isset($_GET['type'])&&$_GET['type']==2){
            if (_returnCheckAction(46) == 0) {
                redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
            }
        }else{
            if (_returnCheckAction(29) == 0) {
                redict(_returnLinkDangNhap('Bạn không có quyền thực hiện chức năng này'));
            }
        }
    }

    $data['data_user']='';
    $data['action']=1;
    $url_bread = '<li><a href="'.SITE_NAME.'/'.$action_link.'/">'.$name_bread.'</a></li><li class="active">Soạn tin</li>';
    $data['title'] = 'Soạn Email - SMS';
}

$_SESSION['link_redict'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$data['breadcrumbs'] = $url_bread;
$data['module_valid'] = "email";

$count=6;


show_header($data);
show_left($data, 'email', $active_tab_left);
show_breadcrumb($data);
show_navigation($data);
show_email_marketing_themmoi($data);
show_footer($data);

show_valid_form($data);
show_script_form($data);
show_script_table($data,$count);

