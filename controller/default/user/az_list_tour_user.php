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
require_once DIR . '/common/paging.php';
$data = array();
$res = array(
    'success' => 0,
);
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['user_email']) && isset($_POST['user_code']) && isset($_POST['token_code'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $name = _return_mc_decrypt(_returnPostParamSecurity('name'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $user_code = _return_mc_decrypt(_returnPostParamSecurity('user_code'));
    $token_code = _return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        $dk_filter='';
        if(isset($_POST['id_detail']) && $_POST['id_detail']!=''){
            $id_detail=_returnPostParamSecurity('id_detail');
            $dk_filter=' and id!='.$id_detail;
            $data_detail_tour=tour_create_user_getById($id_detail);
            if($data_detail_tour){
                $res['detailTour']=$data_detail_tour[0];
            }

        }
        // update noti detail
        if(isset($_POST['update_noti'])){
           $id_noti=_return_mc_decrypt(_returnPostParamSecurity('update_noti'));
            $data_detail_noti=notification_getByTop(1,'user_id='.$id.' and status!=1','id desc');
            if($data_detail_noti){
                $update_noti_detail=new notification((array)$data_detail_noti[0]);
                $update_noti_detail->status=1;
                notification_update($update_noti_detail);
            }
        }

        if(isset($_POST['type'])){
            $type=_returnPostParamSecurity('type');
        }else{
            $type='';
        }
        $data['current']=isset($_POST['page'])?_returnPostParamSecurity('page'):'1';
        $data['pagesize']=isset($_POST['pagesize'])?_returnPostParamSecurity('pagesize'):'10';
        $data['site_name']=isset($_POST['site_name'])?_returnPostParamSecurity('site_name'):SITE_NAME;
        $link='/tiep-thi-lien-ket/tour-yeu-cau?type='.$type;
        $dk ='(user_id='.$id.') ';
        switch($type){
            case '0':
                $dk .=' and  status=0';
                break;
            case '1':
                $dk .=' and status=1';
                break;
            case '2':
                $dk .=' and status=2';
                break;
        }
        $data['count']=tour_create_user_count($dk.$dk_filter);
        $res['danhsach']=tour_create_user_getByPaging($data['current'],$data['pagesize'],'id desc',$dk.$dk_filter);
        $res['PAGING'] = showPagingAtLinkTiepThi($data['count'], $data['pagesize'], $data['current'], '' .  $data['site_name'] . $link);
    }
}
echo json_encode($res);