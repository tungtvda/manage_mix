<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */

require_once DIR . '/common/cls_fast_template.php';
function show_index($data = array())
{
    $asign = array();
    $count_don_hang_moi=$data['count_don_hang_moi'];
    $count_dang_giao_dich=$data['count_dang_giao_dich'];
    $count_tam_dung=$data['count_tam_dung'];
    $count_no_tien=$data['count_no_tien'];
    $count_ket_thuc=$data['count_ket_thuc'];
    $count_ban_nhap=$data['count_ban_nhap'];
    $list_customer_sinh_nhat_hien_tai='';
    if(count($data['customer_sinh_nhat_hien_tai'])>0){
        $count_hien_tai=1;
        foreach($data['customer_sinh_nhat_hien_tai'] as $row_hien_tai){
            $backgroup='';
            if($count_hien_tai%2==0){
                $backgroup='background-color: #f9f9f9;';
            }
            $link_profile=SITE_NAME.'/khach-hang/sua?id='._return_mc_encrypt($row_hien_tai->id, ENCRYPTION_KEY);
            $avatar_noti=SITE_NAME.'/view/default/themes/images/no-avatar.png';
            if($row_hien_tai->avatar!=''){
                $avatar_noti=SITE_NAME.$row_hien_tai->avatar;
            }
            $birthday=date('d-m-Y', strtotime($row_hien_tai->birthday));
            $tuoi=_returnGetAge($row_hien_tai->birthday);
            $list_customer_sinh_nhat_hien_tai.='<li id="row_birthday_'.$row_hien_tai->id.'" style="'.$backgroup.'" class="item-orange clearfix">
                                            <div class="itemdiv commentdiv">
                                                <div class="user">
                                                    <img alt="'.$row_hien_tai->name.'"
                                                         src="'.$avatar_noti.'"/>
                                                </div>
                                                <div class="body">
                                                    <div class="name">
                                                        <a href="'.$link_profile.'">'.$row_hien_tai->name.' | <span style="color: #ff00bd;"><i class="fa fa-calendar"></i> '.$birthday.'</span></a>
                                                    </div>
                                                    <div class="time">
                                                        <i style="color: #ff00bd;" class="ace-icon fa fa-birthday-cake "></i>
                                                        <span class="blue">'.$tuoi.' tuổi</span>
                                                    </div>
                                                    <div style="padding-left: 0px" class="text">
                                                       <a href=""> <i class="ace-icon fa fa-envelope"></i> '.$row_hien_tai->email.'</a>
                                                        | <a href=""> <i class="ace-icon fa fa-phone"></i> '.$row_hien_tai->phone.'</a>
                                                    </div>
                                                </div>
                                                <div class="tools item_check_sinh_nhat">
                                                    <div class="action-buttons bigger-125">
                                                        <a href="" title="Đã gửi tin nhắn chúc mừng"><i  class="fa fa-comments-o "></i> </a>
                                                        <a href="" title="Đã gửi mail chúc mừng"><i class="fa fa-envelope-o blue "></i> </a>
                                                        <a> <label class="inline">
                                                                <input name="customer_birthday[]" id="value_'.$row_hien_tai->id.'" value="'.$row_hien_tai->id.'" type="checkbox" class="ace click_check_list"/>
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </a>
                                                        <a href="javascript:void(0)" class="remove_birthday" countId="'.$row_hien_tai->id.'">
                                                            <i class="ace-icon fa fa-trash-o red"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>';
            $count_hien_tai++;
        }
    }else{
        $list_customer_sinh_nhat_hien_tai='Không có khách hàng sinh nhật trong ngày hôm nay';
    }
    require_once DIR . '/view/default/template/index.php';
}



