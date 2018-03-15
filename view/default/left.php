<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 8/15/14
 * Time: 3:43 PM
 */
require_once DIR.'/view/default/public.php';
function view_left($data=array())
{
    $asign=array();
    $trangchu_active = ($data['active'] == 'trangchu') ? 'active' : '';
    $permison_module=_returnQuyen(1);
    $permison_form=_returnQuyen(2);
    $string_left_menu="";
    $array_show_form=array(7,8,9,10,11,12);
    if(count($data['data_permison_module'])>0){
        foreach($data['data_permison_module'] as $row_module){
            if(in_array($row_module->id,$permison_module)||$permison_module==null) {
                $url_module=SITE_NAME.'/'.$row_module->url;
                $icon_module=$row_module->icon;
                $name_module=$row_module->name;
                $user_active = ($data['active'] == $row_module->active) ? 'active open' : '';
                $data_permison_form=permison_form_getByTop('','id!=1 and status=1 and module_id='.$row_module->id,'position asc');
                if(count($data_permison_form)>0){

                    $string_left_menu.=' <li class="'.$user_active.'">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa '.$icon_module.'"></i>
                                <span class="menu-text">
                                   '.$name_module.'
                                </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                <b class="arrow"></b>

                <ul class="submenu">';
                    foreach($data_permison_form as $row_form)
                    {
                        if(in_array($row_form->id,$permison_form)||$permison_form==null){
                            $url_form=SITE_NAME.'/'.$row_form->url;
                            $name_form=$row_form->name;
                            $data_permison_action=permison_action_getByTop('',' status=1 and form_id='.$row_form->id,'position desc');
                            $user_active_sub = ($data['active_sub'] == $row_form->active) ? 'active' : '';
                            if(count($data_permison_action)>0||in_array($row_form->id,$array_show_form))
                            {
                                $action_count=$row_form->action_count;
                                $count_form='';
                                if($data['active_sub'] == $row_form->active&&$row_form->action_count!='')
                                {
                                    $dk_count='';
                                    if(isset($data['dk_find']))
                                    {
                                        if($row_form->dk_count!=''){
                                            $dk_count=$row_form->dk_count.' and '.$data['dk_find'];
                                        }else{
                                            $dk_count=$data['dk_find'];
                                        }

                                    }else{
                                        $dk_count=$row_form->dk_count;
                                    }
                                    $data_count=$action_count($dk_count);
                                    $count_form='<span class="badge badge-primary">'.$data_count.'</span>';
                                }else{
                                    if($user_active!=''&&$row_form->action_count!=''){
                                        if(in_array($row_form->id,$array_show_form)&&$_SESSION['user_role']!=1){
                                            $dk_count=$row_form->dk_count.' and user_id='.$_SESSION['user_id'];
                                        }else{
                                            if($row_form->id==6&&$_SESSION['user_role']!=1){
                                                $dk_count=' user_id='.$_SESSION['user_id'];
                                            }
                                            else{
                                                $dk_count=$row_form->dk_count;
                                            }

                                        }
                                        $data_count=$action_count($dk_count);
                                        $count_form='<span class="badge" style="color: #428bca;background: none;">'.$data_count.'</span>';
                                    }

                                }

                                $string_left_menu.='<li class="'.$user_active_sub.'">
                        <a href="'.$url_form.'">
                            <i class="menu-icon fa fa-caret-right"></i>
                           '.$name_form.'
                          '.$count_form.'
                        </a>

                        <b class="arrow"></b>
                    </li>';
                            }
                        }


                    }


                    $string_left_menu.='</ul>
            </li>';
                }
                else{
                    $data_permison_action=permison_action_getByTop('','status=1 and module_id='.$row_module->id,'position desc');
                    if(count($data_permison_action)>0)
                    {
                        $count_module='';
                        if($data['active_sub'] == $row_module->active&&$row_module->action_count!='')
                        {
                            $action_count=$row_module->action_count;
                            $data_count=$action_count($row_module->dk_count);
                            $count_module='<span class="badge badge-primary">'.$data_count.'</span>';
                        }

                        $string_left_menu.='<li class="'.$user_active.'">
                <a href="'.$url_module.'">
                    <i class="menu-icon fa '.$icon_module.'"></i>
                    <span class="menu-text"> '.$name_module.'</span>
                    '.$count_module.'
                </a>

                <b class="arrow"></b>
                </li>';
                    }

                }
            }
        }
    }
    if(count($data['user_left'])==0)
    {
        redict(_returnLinkDangNhap());
    }
    $name_user=$data['user_left'][0]->name;
    if($data['user_left'][0]->avatar=="")
    {
        $avatar=SITE_NAME.'/view/default/themes/images/no-avatar.png';
    }
    else{
        $avatar=SITE_NAME.$data['user_left'][0]->avatar;
    }
    $count_noti=notification_count('status=0 and user_id='.$_SESSION['user_id']);
    $data_notifi_nenu=notification_getByTop(5,'status=0 and user_id='.$_SESSION['user_id'],'created desc');
    $string_noti='';
    foreach($data_notifi_nenu as $row_noti_menu){
        $data_user_noti=user_getById($row_noti_menu->user_send_id);
        $name_user_noti='';
        $avatar_noti=SITE_NAME.'/view/default/themes/images/no-avatar.png';
        if(count($data_user_noti)>0){
            if($data_user_noti[0]->avatar!=""){
                $avatar_noti=SITE_NAME.$data_user_noti[0]->avatar;
            }
            $name_user_noti=$data_user_noti[0]->name;
        }
        $string_noti.='  <li style="position: relative;">
                                    <a title="Chi tiết bài viết" href="'.$row_noti_menu->link.'&id_noti='._return_mc_encrypt($row_noti_menu->id, ENCRYPTION_KEY).'" class="clearfix">
                                        <img src="'.$avatar_noti.'" class="msg-photo" alt="'.$name_user_noti.'" />
												<span class="msg-body">
													<span class="msg-title">
														'.$row_noti_menu->name.'
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>'.date("d-m-Y H:i:s", strtotime($row_noti_menu->created)).' </span>

													</span>
												</span>
                                    </a>
                                    <a title="Chi tiết thông báo" href="'.SITE_NAME.'/notification/detail?id='._return_mc_encrypt($row_noti_menu->id, ENCRYPTION_KEY).'" style="position: absolute;right: 0%;bottom: 5%; "><i style="color:#4a96d9 !important;" class="ace-icon fa fa-hand-o-right"></i></a>
                                </li>';
    }
    require_once DIR . '/view/default/template/left.php';
}
