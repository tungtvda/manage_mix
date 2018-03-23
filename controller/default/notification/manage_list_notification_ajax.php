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

$res = array(
    'success' => 0,
    'string_noti' => '',
);

if (isset($_GET['user_id'])) {
    if($_GET['user_id']==$_SESSION['user_id']){

        $res['success']=1;
        if(isset($_GET['update']) && isset($_GET['count'])){
            $notification_obj = new notification();
            $notification_obj->status = 2;
            notification_update_list($notification_obj, 'user_id=' . $_SESSION['user_id'] . ' and status=0');
        }
        $count_all_active=notification_count('user_id='.$_SESSION['user_id']);
        $count_un_read=notification_count('status=2 and user_id='.$_SESSION['user_id']);
        $current=isset($_GET['pages'])?$_GET['pages']:1;
        $pagesize=5;
        $data_noti=notification_getByPaging($current,$pagesize,'id desc','user_id='.$_SESSION['user_id']);

        $string_noti='';
        foreach($data_noti as $row_noti_menu){
            $data_user_noti=user_getById($row_noti_menu->user_send_id);
            $name_user_noti='';
            $avatar_noti=SITE_NAME.'/view/default/themes/images/no-avatar.png';
            if(count($data_user_noti)>0){
                if($data_user_noti[0]->avatar!=""){
                    $avatar_noti=SITE_NAME.$data_user_noti[0]->avatar;
                }
                $name_user_noti=$data_user_noti[0]->name;
            }
            $bg="";
            $icon='<i style="color:#4a96d9 !important;" title="Đã đọc" class="ace-icon fa fa-check"></i>';
            if($row_noti_menu->status==2){
                $bg=" background-color: #edf2fa;";
                $icon='<i style="color:#4a96d9 !important;" title="Chưa đọc" class="ace-icon fa fa-sun-o"></i>';
            }
            $time=_timeAgo($row_noti_menu->created);
            if(strstr($row_noti_menu->link,SITE_NAME)!=''){
                $link=$row_noti_menu->link;
            }else{
                $link=SITE_NAME.'/'.$row_noti_menu->link;
            }
            $string_noti.='  <li style="position: relative; '.$bg.'">
                                    <a title="Chi tiết bài viết" href="'.$link.'&id_noti='._return_mc_encrypt($row_noti_menu->id, ENCRYPTION_KEY).'" class="clearfix">
                                        <img src="'.$avatar_noti.'" class="msg-photo" alt="'.$name_user_noti.'" />
												<span class="msg-body">
													<span class="msg-title">
														'.$row_noti_menu->name.'
													</span>

													<span title="'.date("d-m-Y H:i:s", strtotime($row_noti_menu->created)).'" class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>'.$time.' </span>

													</span>
												</span>
                                    </a>
                                    <a title="Chi tiết thông báo" href="'.$link.'&id_noti='._return_mc_encrypt($row_noti_menu->id, ENCRYPTION_KEY).'" style="border: none;;position: absolute;right: 0%;bottom: 5%; ">
                                    '.$icon.'
                                    </a>
                                </li>';
        }
//        $res['count_active']=$count_active;
//        $res['count_un_read']=$count_un_read;
        $res['count_all_active']=$count_all_active;
        $res['data_noti']=$data_noti;
        $res['count_un_read']=$count_un_read;
        if(count($data_noti)>0){
            $res['current']=$current+1;
        }else{
            $res['current']=$current;
        }
        $res['pagesize']=$pagesize;
        $res['string_noti']=$string_noti;
    }

}
echo json_encode($res);