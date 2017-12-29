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
//echo json_encode($_POST);
//exit;
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['user_email']) && isset($_POST['user_code']) && isset($_POST['token_code'])) {
    $id = _return_mc_decrypt(_returnPostParamSecurity('id'));
    $name = _return_mc_decrypt(_returnPostParamSecurity('name'));
    $user_email = _return_mc_decrypt(_returnPostParamSecurity('user_email'));
    $user_code = _return_mc_decrypt(_returnPostParamSecurity('user_code'));
    $token_code = _return_mc_decrypt(_returnPostParamSecurity('token_code'));
    $dk_check_user = "id=" . $id . " and user_email ='" . $user_email . "' and name='" . $name . "' and user_code='" . $user_code . "' and token_code ='" . $token_code . "'";
    $data_check_exist_user = user_getByTop('', $dk_check_user, 'id desc');
    if (count($data_check_exist_user) > 0) {
        if(isset($_POST['type'])){
            $type=_returnPostParamSecurity('type');
        }else{
            $type='';
        }
        $data['current']=isset($_POST['page'])?_returnPostParamSecurity('page'):'1';
        $data['pagesize']=isset($_POST['pagesize'])?_returnPostParamSecurity('pagesize'):'10';
        $data['site_name']=isset($_POST['site_name'])?_returnPostParamSecurity('site_name'):SITE_NAME;
        $link='/tiep-thi-lien-ket/users?type='.$type;
        $dk ='(us.user_gioi_thieu='.$id.') ';
        switch($type){
            case '0':
                $dk .=' and  us.type_tiep_thi=0';
                break;
            case '1':
                $dk .=' and us.type_tiep_thi=1';
                break;
            case '2':
                $dk .=' and us.type_tiep_thi=2';
                break;
        }

        $data['count']=user_count($dk);
        $res['danhsach']=user_az_getByPaging($data['current'],$data['pagesize'],'id desc',$dk);
//        $data_res=array();
//        foreach($res['danhsach'] as $row){
//            if($row->avatar=="")
//            {
//                $avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
//            }
//            else{
//                $avatar=SITE_NAME.$row->avatar;
//            }
//            $item=array(
//                'name'=>$row->name,
//                'user_email'=>$row->user_email,
//                'avatar'=>$avatar,
//                'phone'=>$row->phone,
//                'status'=>$row->status,
//                'type_tiep_thi'=>$row->type_tiep_thi,
//                'mobi'=>$row->mobi,
//                'address'=>$row->address,
//                'skype'=>$row->skype,
//                'facebook'=>$row->facebook,
//                'created'=>$row->created,
//            );
//            array_push($data_res,$item);
//        }
//        $res['danhsach']=$res['danhsach'];
        $res['PAGING'] = showPagingAtLinkTiepThi($data['count'], $data['pagesize'], $data['current'], '' .  $data['site_name'] . $link);
    }
}
echo json_encode($res);