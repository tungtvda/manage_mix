<?php
if (!defined('DIR')) require_once '../../../config.php';
require_once DIR . '/model/booking_transactionsService.php';
//_returnCheckPermison(6,6);
if(isset($_GET['id'])) {

    $id=_return_mc_decrypt(_returnGetParamSecurity('id'), ENCRYPTION_KEY);
    if ($id != '') {
       $data=booking_giao_dich('booking_id='.$id);
        if($data){
            $array_data=[];
            $string_res='';
            foreach($data as $row){
                if ($row['avatar'] == '') {
                    $link_ava = SITE_NAME . '/view/default/themes/images/no-avatar.png';
                } else {
                    $link_ava = SITE_NAME .$row['avatar'];
                }
                $content=$row['description'];
                $hidde_btn_show='display: none!important;';

                if (strlen($content) > 100) {
                    $ten1=strip_tags($content);
                    $ten = substr($ten1, 0, 100);
                    $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                    $content=$name;
                    $hidde_btn_show='';
                }
                $admin='';
                if($row['user_role']==1){
                    $admin=' <span class="label label-info arrowed arrowed-in-right">admin</span>';
                }
                $string_res.='<div class="itemdiv dialogdiv">
                                                        <div class="user">
                                                            <img alt="'.$row['name_user'].'" src="'.$link_ava.'"/>
                                                        </div>
                                                        <div class="body">
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="orange">'._returnDateFormatConvertVN($row['created']).'</span>
                                                            </div>

                                                            <div class="name">
                                                                <a target="_blank" href="'.SITE_NAME.'/nhan-vien/sua?id='._return_mc_encrypt($row['user_id']).'">'.$row['name_user'].'</a>
                                                               '.$admin.'
                                                            </div>
                                                            <div class="text" id="short_text_'.$row['id'].'">'.$content.'</div>
                                                            <div hidden id="long_text_'.$row['id'].'">
                                                               '.$row['description'].'
                                                            </div>
                                                            <div style="display:block; '.$hidde_btn_show.'" class="tools">
                                                                <a title="Xem chi tiết" href="javascript:void(0)" countid="'.$row['id'].'" data-hide="show" class="show_content_full">
                                                                    <i id="icon_show_hide_'.$row['id'].'" class="icon-only ace-icon fa fa-expand"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>';
                $item=array(
                    'id'=>$row['id'],
                    'booking_id'=>$row['booking_id'],
                    'user_id'=>$row['user_id'],
                    'name'=>$row['name'],
                    'description'=>$row['description'],
                    'created'=>$row['created'],
                    'name_user'=>$row['name_user'],
                    'avatar'=>$link_ava
                );
                array_push($array_data,$item);
            }
            if($array_data){
                echo $string_res;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}